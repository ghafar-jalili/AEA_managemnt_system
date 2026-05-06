/**
 * Premium Animations & Smooth Scroll
 * GSAP, Lenis, and immersive interactions
 */

// Initialize Lenis Smooth Scroll
let lenis;

function initLenis() {
    if (typeof Lenis !== 'undefined') {
        lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);

        // Connect Lenis to GSAP ScrollTrigger
        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0);
    }
}

// Page Loader Animation
function initPageLoader() {
    const loader = document.getElementById('page-loader');
    const progress = document.getElementById('loader-progress');

    if (!loader) return;

    // Animate progress bar
    gsap.to(progress, {
        width: '100%',
        duration: 1.5,
        ease: 'power2.inOut'
    });

    // Hide loader
    gsap.to(loader, {
        opacity: 0,
        duration: 0.8,
        delay: 1.5,
        ease: 'power2.inOut',
        onComplete: () => {
            loader.style.display = 'none';
            loader.style.pointerEvents = 'none';
            // Trigger entrance animations
            initEntranceAnimations();
        }
    });
}

// Scroll Progress Bar
function initScrollProgress() {
    const progressBar = document.getElementById('scroll-progress');
    if (!progressBar) return;

    gsap.to(progressBar, {
        width: '100%',
        ease: 'none',
        scrollTrigger: {
            trigger: document.body,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.3
        }
    });
}

// Entrance Animations
function initEntranceAnimations() {
    // Fade up animations
    gsap.utils.toArray('[data-animate="fade-up"]').forEach((elem, i) => {
        gsap.from(elem, {
            y: 60,
            opacity: 0,
            duration: 1,
            delay: i * 0.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: elem,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // Fade down animations
    gsap.utils.toArray('[data-animate="fade-down"]').forEach((elem) => {
        gsap.from(elem, {
            y: -40,
            opacity: 0,
            duration: 0.8,
            ease: 'power3.out'
        });
    });

    // Scale animations
    gsap.utils.toArray('[data-animate="scale"]').forEach((elem) => {
        gsap.from(elem, {
            scale: 0.8,
            opacity: 0,
            duration: 1,
            ease: 'back.out(1.7)',
            scrollTrigger: {
                trigger: elem,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });
}

// Parallax Effects
function initParallax() {
    gsap.utils.toArray('[data-parallax]').forEach((elem) => {
        const speed = elem.dataset.parallax || 0.5;
        gsap.to(elem, {
            y: () => window.innerHeight * speed * 0.5,
            ease: 'none',
            scrollTrigger: {
                trigger: elem,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true
            }
        });
    });
}

// Text Reveal Animation with SplitType
function initTextReveal() {
    if (typeof SplitType === 'undefined') return;

    gsap.utils.toArray('[data-split]').forEach((elem) => {
        const split = new SplitType(elem, { types: 'lines,words,chars' });

        gsap.from(split.chars, {
            opacity: 0,
            y: 100,
            rotateX: -90,
            stagger: 0.02,
            duration: 1,
            ease: 'power4.out',
            scrollTrigger: {
                trigger: elem,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });
}

// Staggered Card Animations
function initCardAnimations() {
    gsap.utils.toArray('.stagger-cards').forEach((container) => {
        const cards = container.querySelectorAll('.stagger-card');
        gsap.from(cards, {
            y: 80,
            opacity: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: container,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });
}

// Magnetic Button Effect
function initMagneticButtons() {
    const buttons = document.querySelectorAll('.magnetic-btn');

    buttons.forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, {
                x: 0,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}

// Hover Animations for Cards
function initHoverAnimations() {
    gsap.utils.toArray('.hover-lift').forEach((card) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -10,
                boxShadow: '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}

// Navbar Scroll Effect
function initNavbarScroll() {
    const navbar = document.querySelector('nav');
    if (!navbar) return;

    ScrollTrigger.create({
        start: 'top -100',
        onUpdate: (self) => {
            if (self.direction === 1 && self.progress > 0) {
                navbar.classList.add('nav-scrolled');
            } else if (self.progress === 0) {
                navbar.classList.remove('nav-scrolled');
            }
        }
    });
}

// Counter Animation
function initCounters() {
    gsap.utils.toArray('[data-counter]').forEach((counter) => {
        const target = parseInt(counter.dataset.counter);
        const suffix = counter.dataset.suffix || '';
        const prefix = counter.dataset.prefix || '';

        ScrollTrigger.create({
            trigger: counter,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to(counter, {
                    innerHTML: target,
                    duration: 2,
                    ease: 'power2.out',
                    snap: { innerHTML: 1 },
                    onUpdate: function() {
                        counter.innerHTML = prefix + Math.round(this.targets()[0].innerHTML) + suffix;
                    }
                });
            }
        });
    });
}

// Initialize everything
function initAnimations() {
    // Wait for GSAP to be ready
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        setTimeout(initAnimations, 100);
        return;
    }

    // Register ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Initialize all components
    initLenis();
    initPageLoader();
    initScrollProgress();
    initParallax();
    initTextReveal();
    initCardAnimations();
    initMagneticButtons();
    initHoverAnimations();
    initNavbarScroll();
    initCounters();
}

// Run on DOM ready
document.addEventListener('DOMContentLoaded', initAnimations);

// Export for global access
window.initAnimations = initAnimations;
window.lenis = lenis;
