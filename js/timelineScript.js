// GSAP Scroll Animations
gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    const timelineItems = document.querySelectorAll(".timeline-item");

    timelineItems.forEach((item, index) => {
        const direction = item.classList.contains("left") ? -50 : 50;

        gsap.fromTo(
            item,
            {
                opacity: 0,
                x: direction,
                y: 50
            },
            {
                opacity: 1,
                x: 0,
                y: 0,
                duration: 0.8,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: item,
                    start: "top 85%", // Trigger when top of element hits 85% of viewport
                    toggleActions: "play none none none"
                }
            }
        );
    });

    // Image Popup Modal Logic
    const modal = document.getElementById("timelineModal");
    const modalImg = document.getElementById("timelinePopupImg");
    const closeBtn = document.querySelector(".close-modal");
    const zoomImages = document.querySelectorAll(".zoom-img");

    // Open modal on click
    zoomImages.forEach(img => {
        img.addEventListener("click", () => {
            modal.classList.add("active");
            modalImg.src = img.src;
        });
    });

    // Close modal on close button click
    closeBtn.addEventListener("click", () => {
        modal.classList.remove("active");
    });

    // Close modal on clicking outside the image
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("active");
        }
    });
});
