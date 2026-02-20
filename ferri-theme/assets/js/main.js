document.addEventListener('DOMContentLoaded', () => {

    /* =========================================
       1. Sticky Header Logic
       ========================================= */
    const header = document.getElementById('site-header');

    // Add 'group' class to header to enable Tailwind group modifiers
    if (header) header.classList.add('group');

    const handleScroll = () => {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Init Check

    /* =========================================
       2. Hero Slideshow Logic
       ========================================= */
    const heroSection = document.getElementById('home');
    const heroSlideshowContainer = document.getElementById('hero-slideshow');

    if (heroSection && heroSlideshowContainer) {
        try {
            const rawSlides = heroSection.getAttribute('data-slides');
            const slides = JSON.parse(rawSlides || '[]'); // Safer parsing
            let currentSlide = 0;

            if (slides.length > 1) {
                // Create a second layer for cross-fade
                const slideLayer1 = heroSlideshowContainer.querySelector('div');
                const slideLayer2 = slideLayer1.cloneNode(true);

                // Setup styling for standard crossfade
                slideLayer1.style.zIndex = 1;
                slideLayer2.style.zIndex = 2;
                slideLayer2.style.opacity = 0; // Start hidden

                heroSlideshowContainer.appendChild(slideLayer2);

                let activeLayer = 1; // 1 is visible, 2 is hidden

                const nextSlide = () => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    const nextImage = `url('${slides[currentSlide]}')`;

                    if (activeLayer === 1) {
                        // Layer 1 is visible. Load next into Layer 2, then fade Layer 2 IN.
                        slideLayer2.style.backgroundImage = nextImage;
                        slideLayer2.style.opacity = 1;
                        activeLayer = 2;

                        // Optional: Reset Layer 1 after transition? Not strictly needed for opacity 1 on top.
                        // But for long run, better to swap z-indices or opacity.
                        // Simpler: Layer 2 is ON TOP. If it fades in, it covers Layer 1.
                        // When transitioning back to Layer 1, we change Layer 1 image, then fade Layer 2 OUT.
                    } else {
                        // Layer 2 is visible (opacity 1). 
                        // Load next into Layer 1.
                        slideLayer1.style.backgroundImage = nextImage;
                        // Fade Layer 2 OUT to reveal Layer 1.
                        slideLayer2.style.opacity = 0;
                        activeLayer = 1;
                    }
                };

                setInterval(nextSlide, 5000); // 5 seconds interval
            }
        } catch (e) {
            console.error("Error initializing slideshow:", e);
        }
    }

    /* =========================================
       3. Mobile Menu Toggle
       ========================================= */
    const menuToggle = document.getElementById('mobile-menu-toggle');

    // Grab the existing mobile menu container created in header.php
    const mobileMenu = document.getElementById('fullscreen-menu');

    // Apply transitions only after element is mounted and initial state (hidden) is rendered
    // It's already in the DOM, but we can ensure it has the transition class
    if (mobileMenu && !mobileMenu.classList.contains('transition-transform')) {
        mobileMenu.classList.add('transition-transform', 'duration-300');
    }

    const toggleMenu = () => {
        const isOpen = mobileMenu.classList.toggle('translate-x-full');

        // Use 'menu-open' class to trigger SVG animation in index.html
        // Note: translate-x-full means HIDDEN. So if we toggle it OFF, it is OPEN.
        // If 'translate-x-full' is present, menu is CLOSED.
        // We want 'menu-open' when menu is VISIBLE (i.e. translate-x-full is NOT present).

        if (mobileMenu.classList.contains('translate-x-full')) {
            menuToggle.classList.remove('menu-open');
            if (header) header.classList.remove('menu-active');
            document.body.classList.remove('overflow-hidden');
        } else {
            menuToggle.classList.add('menu-open');
            if (header) header.classList.add('menu-active');
            document.body.classList.add('overflow-hidden');
        }
    };

    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    const closeBtn = mobileMenu.querySelector('#close-mobile-menu');
    if (closeBtn) closeBtn.addEventListener('click', toggleMenu);

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', toggleMenu);
    });

    /* =========================================
       4. Carousel & Scroll Reveal
       ========================================= */
    // Keep existing carousel logic if ids mismatch? Header refactor changed HTML?
    // IDs in index.html for carousel were NOT changed in my previous edit.

    const carousel = document.getElementById('projects-carousel');
    const prevBtn = document.getElementById('prev-project');
    const nextBtn = document.getElementById('next-project');

    if (carousel && prevBtn && nextBtn) {
        nextBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: carousel.offsetWidth * 0.5, behavior: 'smooth' });
        });

        prevBtn.addEventListener('click', () => {
            carousel.scrollBy({ left: -carousel.offsetWidth * 0.5, behavior: 'smooth' });
        });
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

    /* =========================================
       5. Statistics Counter Animation
       ========================================= */
    const counters = document.querySelectorAll('.counter-animate');

    if (counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    const suffix = counter.getAttribute('data-suffix') || '';
                    const duration = 2000; // Animation duration in ms
                    const startTime = performance.now();

                    const updateCounter = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);

                        // Ease-out Cubic function: smoother start for small numbers
                        const easeProgress = 1 - Math.pow(1 - progress, 3);

                        const current = Math.floor(easeProgress * target);

                        // Ensure we start at 1 if possible, or 0.
                        // For small numbers like 15, we want to see 1..2..3

                        counter.textContent = current + suffix;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target + suffix;
                        }
                    };

                    requestAnimationFrame(updateCounter);
                    counterObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.5 }); // Trigger when 50% visible

        counters.forEach(counter => counterObserver.observe(counter));
    }

    /* =========================================
       6. Timeline Scroll Progress
       ========================================= */
    const timelineLine = document.getElementById('timeline-progress-bar');
    const timelineContainer = document.getElementById('timeline-line-container');

    if (timelineLine && timelineContainer) {
        // The container of the line is the reference for the full height of the timeline
        // actually timeline-line-container IS the line wrapper, but its height depends on its parent due to 'top-0 bottom-0'
        // So we should use the parent of the line container as the reference for the scroll area.
        const scrollReference = timelineContainer.parentElement;

        const timelinePoints = document.querySelectorAll('.timeline-point');

        // Track maximum progress to prevent rewinding
        let maxPercentage = 0;

        const updateTimeline = () => {
            const rect = scrollReference.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // We want the line to fill up to the center of the viewport
            const triggerPoint = windowHeight / 2;

            // Calculate distance from the top of the reference element to the trigger point
            const distanceFromTop = triggerPoint - rect.top;

            let percentage = (distanceFromTop / rect.height) * 100;

            // Clamp between 0 and 100
            percentage = Math.max(0, Math.min(100, percentage));

            // Only update if current percentage is greater than maxPercentage
            if (percentage > maxPercentage) {
                maxPercentage = percentage;
                timelineLine.style.height = `${maxPercentage}%`;
            }

            // Check each point
            timelinePoints.forEach(point => {
                // Calculate point position relative to the start of the timeline line
                // The points are inside relative containers. We need their position relative to the timelineContainer.
                // Simplest way: get point's rect.top and compare with triggerPoint (which is where the line "head" is).

                const pointRect = point.getBoundingClientRect();
                const pointCenter = pointRect.top + (pointRect.height / 2);

                if (pointCenter <= triggerPoint) {
                    point.classList.add('active');

                    // Reveal sibling content
                    // The structure is: parent (.flex) -> children (content, point, image)
                    // We need to find the parent (.flex) and then select .timeline-content inside it.
                    const parentRow = point.closest('.flex');
                    if (parentRow) {
                        const contentItems = parentRow.querySelectorAll('.timeline-content');
                        contentItems.forEach(item => item.classList.add('visible'));
                    }

                }
            });
        };

        window.addEventListener('scroll', updateTimeline);
        window.addEventListener('resize', updateTimeline); // Recalculate on resize
        updateTimeline(); // Initial check
    }

});
