import './bootstrap';
import './course-modals';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Import animations
import './animations';

// GSAP & ScrollTrigger loaded via CDN in blade template
window.Alpine = Alpine;
Alpine.start();

// Initialize AOS (Animate On Scroll)
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50,
    delay: 100,
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
