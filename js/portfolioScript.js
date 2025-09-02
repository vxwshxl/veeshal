document.addEventListener("DOMContentLoaded", function() {
    const imageSources = [
        './assets/projects/1.png',
        './assets/projects/2.png',
        './assets/projects/3.png',
        './assets/projects/4.png',
        './assets/projects/5.png',
        './assets/projects/6.png',
        './assets/projects/7.png'
    ];

    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach((item) => {
        const copyElements = item.querySelectorAll('.info, .name, .tag');

        copyElements.forEach((div) => {
            const copy = div.querySelector("p");

            if (copy) {
                const duplicateCopy = document.createElement("p");
                duplicateCopy.textContent = copy.textContent;
                div.appendChild(duplicateCopy);
            }
        });
    });

    const appendImages = (src) => {
        const preview1 = document.querySelector('.preview-img-1');
        const preview2 = document.querySelector('.preview-img-2');

        const img1 = document.createElement('img');
        const img2 = document.createElement('img');

        img1.src = src;
        img1.style.clipPath = "polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%)";
        img2.src = src;
        img2.style.clipPath = "polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%)";

        preview1.appendChild(img1);
        preview2.appendChild(img2);

        gsap.to([img1, img2], {
            clipPath: "polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%)",
            duration: 1,
            ease: "power3.out",
            onComplete: function() {
                removeExtraImages(preview1);
                removeExtraImages(preview2);
            }
        });
    }

    function removeExtraImages(container) {
        while (container.children.length > 10) {
            container.removeChild(container.firstChild);
        }
    }

    document.querySelectorAll('.menu-item').forEach((item, index) => {
        item.addEventListener('mouseover', () => {
            mouseOverAnimation(item);
            appendImages(imageSources[index]);
        });

        item.addEventListener('mouseout', () => {
            mouseOutAnimation(item);
        });
    });

    const mouseOverAnimation = (elem) => {
        gsap.to(elem.querySelectorAll("p:nth-child(1)"), {
            top: "-100%",
            duration: 0.3,
        });
        gsap.to(elem.querySelectorAll("p:nth-child(2)"), {
            top: "0%",
            duration: 0.3,
        });
    }

    const mouseOutAnimation = (elem) => {
        gsap.to(elem.querySelectorAll("p:nth-child(1)"), {
            top: "0%",
            duration: 0.3,
        });
        gsap.to(elem.querySelectorAll("p:nth-child(2)"), {
            top: "100%",
            duration: 0.3,
        });
    }

    document.querySelector('.menu').addEventListener('mouseout', function() {
        gsap.to('.preview-img img', {
            clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
            duration: 1,
            ease: "power3.out",
        });
    });

    // Fixed mousemove event to account for scroll position
    document.addEventListener('mousemove', function(e) {
        const preview = document.querySelector('.preview');
        
        // Calculate position relative to the document (includes scroll)
        const x = e.pageX || e.clientX + window.scrollX;
        const y = e.pageY || e.clientY + window.scrollY;

        gsap.to(preview, {
            x: x,
            y: y,
            duration: 1,
            ease: "power3.out",
        });
    });
});