// Force scroll to top immediately on page load - before any animations
window.history.scrollRestoration = 'manual';
window.scrollTo(0, 0);
document.documentElement.scrollTop = 0;
document.body.scrollTop = 0;

// Disable scrolling initially
document.body.style.overflow = "hidden";

// Loader
function startLoader () {
    let counterElement = document.querySelector('.counter');
    let currentValue = 0;

    function updateCounter() {
        if (currentValue === 100) {
            return;
        }

        currentValue += Math.floor(Math.random() * 10) + 1;

        if (currentValue > 100) {
            currentValue = 100;
        }

        counterElement.innerText = currentValue;

        let delay = Math.floor(Math.random() * 100) + 150;
        setTimeout(updateCounter, delay);
    }

    updateCounter();
}

startLoader();

// Create spokes
const spokesContainer = document.getElementById('spokes');
const numSpokes = 10;

for (let i = 0; i < numSpokes; i++) {
    const angle = (i * 360 / numSpokes);
    
    // Create spoke
    const spoke = document.createElement('div');
    spoke.className = 'spoke';
    spoke.style.transform = `rotate(${angle}deg)`;
    spokesContainer.appendChild(spoke);
    
    // Create bolt
    const bolt = document.createElement('div');
    bolt.className = 'bolt';
    
    // Position bolt along rim
    const boltAngle = angle * (Math.PI / 180);
    const boltRadius = 155;
    bolt.style.left = `${Math.cos(boltAngle) * boltRadius + 200}px`;
    bolt.style.top = `${Math.sin(boltAngle) * boltRadius + 200}px`;
    
    document.querySelector('.wheel').appendChild(bolt);
}

// Initial bounce effect
gsap.from(".wheel", 2, {
    left: "-100%",
    ease: "power2.inOut",
    delay: 0.2,
});

// Start rotation - slow to fast
const wheelTl = gsap.timeline({delay: 1});

// First rotation (slower)
wheelTl.to(".wheel", 3, {
    rotation: 720,
    ease: "power2.inOut",
});

// Continuous fast rotation
wheelTl.to(".wheel", {
    rotation: "+=1080",
    duration: 4,
    ease: "power1.in",
});

gsap.fromTo(
    ".home",
    {
        duration: 2,
        transform: "translateX(150%)",
        scale: 0.1,
        ease: "power4.inOut",
        delay: 2,
    }, {
        duration: 2,
        scale: 0.6,
        transform: "translateX(0%)",
        ease: "power4.inOut",
        delay: 2,
    }
);

gsap.to(".loader", 2.5, {
    scale: 0,
    ease: "power4.inOut",
    delay: 3.5,
});

gsap.to(".home", 2, {
    scale: 1,
    ease: "power4.inOut",
    delay: 3.5,
    onComplete: () => {
        // Re-enable scrolling after animation
        document.body.style.overflow = "auto";
    }
});

// SINGLE PAGE SCROLLING ANIMATION
const sections = document.querySelectorAll("section, div[id$='Container']");
const navLinks = document.querySelectorAll("nav ul li a");

window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (window.scrollY >= sectionTop) {
            current = section.getAttribute("id");
        }
    });

    navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href") === "#" + current) {
            link.classList.add("active");
        }
    });
});