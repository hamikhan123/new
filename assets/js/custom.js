document.addEventListener('DOMContentLoaded', function() {
    const aboutContent = document.querySelector('.mytheme-about-content');
    const aboutImage = document.querySelector('.mytheme-about-image');
    const serviceCards = document.querySelectorAll('.service-card');

    // Function to check if element is in view
    function isInView(element, offset = 0) {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        return elementTop < windowHeight - offset;
    }

    // Function to handle scroll animations
    function handleScrollAnimations() {
        // About content and image animations
        if (isInView(aboutContent, window.innerHeight / 1.2)) {
            aboutContent.classList.add('animated');
        }
        if (isInView(aboutImage, window.innerHeight / 1.2)) {
            aboutImage.classList.add('animated');
        }

        // Service cards animations
        serviceCards.forEach(card => {
            if (isInView(card, 100)) {
                const delay = card.style.getPropertyValue('--delay') || '0s';
                card.style.animationDelay = delay;
                card.classList.add('animate-up');
            }
        });
    }

    // Initial check
    handleScrollAnimations();

    // Optimized scroll event listener
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (!scrollTimeout) {
            scrollTimeout = setTimeout(function() {
                handleScrollAnimations();
                scrollTimeout = null;
            }, 20); // Throttle scroll event
        }
    });
    const services = document.querySelectorAll('.service-item');
    
    const animateServices = () => {
        services.forEach((service, index) => {
            const rect = service.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight - 100;
            
            if (isVisible) {
                service.style.transitionDelay = `${index * 0.1}s`;
                service.style.opacity = '1';
                service.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Set initial state
    services.forEach(service => {
        service.style.opacity = '0';
        service.style.transform = 'translateY(30px)';
        service.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
    });
    
    // Trigger on load and scroll
    animateServices();
    window.addEventListener('scroll', animateServices);
});
