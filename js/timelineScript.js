// ============================================================
//  Timeline Script — Snake Path + Scroll Fill + Image Slider
// ============================================================

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {

    // ──────────────────────────────────────────────────────────
    // 1.  GSAP ITEM ANIMATIONS
    // ──────────────────────────────────────────────────────────
    const timelineItems = document.querySelectorAll(".timeline-item");

    timelineItems.forEach((item) => {
        const direction = item.classList.contains("left") ? -60 : 60;

        gsap.fromTo(
            item,
            { opacity: 0, x: direction, y: 30 },
            {
                opacity: 1, x: 0, y: 0,
                duration: 0.8,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: item,
                    start: "top 85%",
                    toggleActions: "play none none none"
                }
            }
        );
    });

    // ──────────────────────────────────────────────────────────
    // 2.  SNAKE SVG PATH
    //     Build a zigzag path through the icon centres
    // ──────────────────────────────────────────────────────────
    const wrapper     = document.getElementById("timelineProgressWrapper");
    const svg         = document.getElementById("snakeSvg");
    const pathBase    = document.getElementById("snakePathBase");
    const pathFill    = document.getElementById("snakePathFill");
    const container   = document.querySelector(".timeline-container");

    function buildSnakePath() {
        const icons = document.querySelectorAll(".timeline-icon");
        if (!icons.length) return;

        const wrapRect = wrapper.getBoundingClientRect();

        // Collect icon centre points relative to the wrapper
        const pts = [];
        icons.forEach(icon => {
            const r = icon.getBoundingClientRect();
            pts.push({
                x: r.left + r.width  / 2 - wrapRect.left,
                y: r.top  + r.height / 2 - wrapRect.top
            });
        });

        // Build a smooth SVG path through the points (cubic bezier)
        let d = `M ${pts[0].x} ${pts[0].y}`;
        for (let i = 1; i < pts.length; i++) {
            const prev = pts[i - 1];
            const curr = pts[i];
            const midY = (prev.y + curr.y) / 2;
            d += ` C ${prev.x} ${midY}, ${curr.x} ${midY}, ${curr.x} ${curr.y}`;
        }

        pathBase.setAttribute("d", d);
        pathFill.setAttribute("d", d);

        // Stroke-dasharray = total path length
        const totalLen = pathFill.getTotalLength();
        pathFill.style.strokeDasharray  = totalLen;
        pathFill.style.strokeDashoffset = totalLen; // starts empty

        return { pts, totalLen };
    }

    // ──────────────────────────────────────────────────────────
    // 3.  SCROLL-DRIVEN FILL (yellow line grows as you scroll)
    // ──────────────────────────────────────────────────────────
    let snakeData = buildSnakePath();

    function updateScrollFill() {
        if (!snakeData) return;

        const { totalLen } = snakeData;
        const icons = document.querySelectorAll(".timeline-icon");
        if (!icons.length) return;

        const wrapRect = wrapper.getBoundingClientRect();

        // First icon top → last icon bottom = scroll range
        const firstIcon = icons[0].getBoundingClientRect();
        const lastIcon  = icons[icons.length - 1].getBoundingClientRect();

        const scrollStart = firstIcon.top  + window.scrollY - window.innerHeight * 0.5;
        const scrollEnd   = lastIcon.bottom + window.scrollY - window.innerHeight * 0.5;

        const scrolled = window.scrollY;
        const progress = Math.min(1, Math.max(0,
            (scrolled - scrollStart) / (scrollEnd - scrollStart)
        ));

        pathFill.style.strokeDashoffset = totalLen * (1 - progress);
    }

    window.addEventListener("scroll", updateScrollFill, { passive: true });

    // Rebuild on resize
    let resizeTimer;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            snakeData = buildSnakePath();
            updateScrollFill();
        }, 200);
    });

    // Initial call after a tick (icons need to be laid out)
    setTimeout(() => {
        snakeData = buildSnakePath();
        updateScrollFill();
    }, 100);

    // ──────────────────────────────────────────────────────────
    // 4.  IMAGE SLIDER (per timeline item)
    // ──────────────────────────────────────────────────────────
    const AUTO_SLIDE_INTERVAL = 2000; // 2 seconds

    document.querySelectorAll(".img-slider").forEach(slider => {
        if (slider.classList.contains("single")) return; // skip single-image

        const imgs  = slider.querySelectorAll(".slider-img");
        const dots  = slider.querySelectorAll(".dot");
        const prevBtn = slider.querySelector(".slider-prev");
        const nextBtn = slider.querySelector(".slider-next");
        let current = 0;
        let autoTimer;

        function goTo(idx) {
            imgs[current].classList.remove("active");
            dots[current]?.classList.remove("active");
            current = (idx + imgs.length) % imgs.length;
            imgs[current].classList.add("active");
            dots[current]?.classList.add("active");
        }

        function startAuto() {
            clearInterval(autoTimer);
            autoTimer = setInterval(() => goTo(current + 1), AUTO_SLIDE_INTERVAL);
        }

        function stopAuto() { clearInterval(autoTimer); }

        prevBtn?.addEventListener("click", (e) => {
            e.stopPropagation();
            goTo(current - 1);
            stopAuto(); startAuto();
        });

        nextBtn?.addEventListener("click", (e) => {
            e.stopPropagation();
            goTo(current + 1);
            stopAuto(); startAuto();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener("click", (e) => {
                e.stopPropagation();
                goTo(i);
                stopAuto(); startAuto();
            });
        });

        startAuto();

        // Open modal on image click (pass all images from data-images attr on parent item)
        slider.addEventListener("click", () => {
            const item   = slider.closest(".timeline-item");
            const images = JSON.parse(item.dataset.images || "[]");
            openModal(images, current);
        });
    });

    // Single-image sliders also open modal
    document.querySelectorAll(".img-slider.single").forEach(slider => {
        slider.addEventListener("click", () => {
            const item   = slider.closest(".timeline-item");
            const images = JSON.parse(item.dataset.images || "[]");
            openModal(images, 0);
        });
    });

    // ──────────────────────────────────────────────────────────
    // 5.  FULLSCREEN MODAL WITH SLIDER
    // ──────────────────────────────────────────────────────────
    const modal    = document.getElementById("timelineModal");
    const modalImg = document.getElementById("timelinePopupImg");
    const closeBtn = document.querySelector(".close-modal");
    const modalPrev = document.querySelector(".modal-prev");
    const modalNext = document.querySelector(".modal-next");
    const modalDots = document.getElementById("modalDots");

    let modalImages  = [];
    let modalCurrent = 0;

    function openModal(images, startIdx) {
        modalImages  = images;
        modalCurrent = startIdx;
        renderModal();
        modal.classList.add("active");
    }

    function renderModal() {
        modalImg.src = modalImages[modalCurrent];

        // Dots
        modalDots.innerHTML = "";
        if (modalImages.length > 1) {
            modalImages.forEach((_, i) => {
                const d = document.createElement("span");
                d.className = "dot" + (i === modalCurrent ? " active" : "");
                d.addEventListener("click", () => { modalCurrent = i; renderModal(); });
                modalDots.appendChild(d);
            });
        }

        // Arrows
        modalPrev.classList.toggle("hidden", modalImages.length <= 1);
        modalNext.classList.toggle("hidden", modalImages.length <= 1);
    }

    modalPrev?.addEventListener("click", (e) => {
        e.stopPropagation();
        modalCurrent = (modalCurrent - 1 + modalImages.length) % modalImages.length;
        renderModal();
    });

    modalNext?.addEventListener("click", (e) => {
        e.stopPropagation();
        modalCurrent = (modalCurrent + 1) % modalImages.length;
        renderModal();
    });

    // Keyboard navigation
    document.addEventListener("keydown", (e) => {
        if (!modal.classList.contains("active")) return;
        if (e.key === "ArrowLeft")  { modalCurrent = (modalCurrent - 1 + modalImages.length) % modalImages.length; renderModal(); }
        if (e.key === "ArrowRight") { modalCurrent = (modalCurrent + 1) % modalImages.length; renderModal(); }
        if (e.key === "Escape")     modal.classList.remove("active");
    });

    closeBtn?.addEventListener("click",  () => modal.classList.remove("active"));
    modal?.addEventListener("click", (e) => { if (e.target === modal) modal.classList.remove("active"); });

});
