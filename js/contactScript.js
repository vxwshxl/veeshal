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

    // EmailJS Initialization
    if (typeof emailjs !== 'undefined' && typeof EMAIL_PUBLIC_KEY !== 'undefined' && EMAIL_PUBLIC_KEY) {
        emailjs.init(EMAIL_PUBLIC_KEY);
    } else {
        console.error("EmailJS or Public Key not found.");
    }

    // Handle Form Submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const submitBtn = this.querySelector('.submit-btn');
            const originalBtnText = submitBtn.innerText;
            submitBtn.innerText = 'Sending...';
            submitBtn.disabled = true;

            // Get values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Get selected category
            const activePill = document.querySelector('.pill-btn.active');
            const category = activePill ? activePill.innerText : 'Not Specified';

            // Generate Gravatar URL (PFP)
            let pfpUrl = "https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"; // Default
            if (email && typeof CryptoJS !== 'undefined') {
                const trimmedEmail = email.trim().toLowerCase();
                const hash = CryptoJS.MD5(trimmedEmail).toString();
                pfpUrl = `https://www.gravatar.com/avatar/${hash}?d=identicon`;
            }

            // Prepare template parameters
            // Note: Keys must match your EmailJS template variables
            const templateParams = {
                to_name: "Veeshal", // Or whoever receives it
                name: name,
                email: email,
                category: category,
                message: message,
                pfp: pfpUrl, // You likely need to add {{pfp}} to your email template HTML
                time: new Date().toLocaleString()
            };

            // Send via EmailJS
            // Use values from .env (Need to pass Service/Template IDs from PHP too, or hardcode if they aren't secret)
            // Ideally should pass via PHP variables like public key.
            // Assuming the variables in .env are public-safe enough to be in JS source (Service/Template IDs usually are)
            // But I will inject them properly via PHP in index.php to be consistent.

            // Wait, I didn't inject Service/Template ID in index.php. 
            // I will use the global variables if available, otherwise I'll need to update index.php or use hardcoded values if the user strictly wanted .env.
            // The user said "make sure credentials are in .env file".
            // I should inject SERVICE_ID and TEMPLATE_ID too.

            if (typeof EMAIL_SERVICE_ID === 'undefined' || typeof EMAIL_TEMPLATE_ID === 'undefined') {
                console.error("Service ID or Template ID not defined.");
                alert("Configuration Error: Missing EmailJS IDs.");
                submitBtn.innerText = originalBtnText;
                submitBtn.disabled = false;
                return;
            }

            emailjs.send(EMAIL_SERVICE_ID, EMAIL_TEMPLATE_ID, templateParams)
                .then(function () {
                    alert('Message Sent Successfully!');
                    contactForm.reset();
                    // Reset pills
                    document.querySelectorAll('.pill-btn').forEach(p => p.classList.remove('active'));
                    document.querySelector('.pill-btn').classList.add('active'); // Set first as default
                }, function (error) {
                    console.error('FAILED...', error);
                    alert('Failed to send message. Please try again.');
                })
                .finally(() => {
                    submitBtn.innerText = originalBtnText;
                    submitBtn.disabled = false;
                });
        });
    }
});
