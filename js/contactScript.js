document.addEventListener('DOMContentLoaded', () => {
    // Handle pill selection
    const pillGroups = document.querySelectorAll('.pills');

    pillGroups.forEach(group => {
        const pills = group.querySelectorAll('.pill-btn');
        
        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                // Remove active class from all pills in this group
                pills.forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked pill
                pill.classList.add('active');
            });
        });
    });
});
