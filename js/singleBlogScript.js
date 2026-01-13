
document.addEventListener('DOMContentLoaded', () => {
    // 1. Smooth Scroll without Hash Update
    const tocLinks = document.querySelectorAll('.toc-link');
    
    tocLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                // Smooth scroll to section
                // Offset calculation (header + padding)
                const headerOffset = 100;
                const elementPosition = targetSection.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
      
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });

    // 2. Scroll Spy (Active Link Highlight)
    // We observe all headings that have IDs matching toc links
    const sections = Array.from(tocLinks).map(link => {
        const id = link.getAttribute('href');
        return document.querySelector(id);
    }).filter(section => section !== null);

    const observerOptions = {
        root: null,
        rootMargin: '-100px 0px -70% 0px', // Trigger when section is near top
        threshold: 0
    };

    const observerCallback = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Remove active class from all
                tocLinks.forEach(link => link.classList.remove('active'));
                
                // Add active class to corresponding link
                const id = '#' + entry.target.getAttribute('id');
                const activeLink = document.querySelector(`.toc-link[href="${id}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                    
                    // Also scroll sidebar if needed (optional polish)
                    // activeLink.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    sections.forEach(section => observer.observe(section));
});
