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
       2. Mobile Menu Toggle
       ========================================= */
    const menuToggle = document.getElementById('mobile-menu-toggle');

    // Create mobile menu container dynamically for lightness
    // Start WITHOUT transition classes to prevent flash on load
    const mobileMenu = document.createElement('div');
    mobileMenu.className = 'fixed inset-0 bg-secondary z-[60] pt-24 px-6 transform translate-x-full flex flex-col items-center justify-center text-center text-white';
    mobileMenu.id = 'mobile-menu';
    mobileMenu.setAttribute('aria-label', 'Menu di navigazione');
    mobileMenu.innerHTML = `
        <nav class="flex flex-col gap-6 font-display text-4xl font-bold uppercase text-white mb-12" aria-label="Navigazione principale">
            <a href="index.html" class="hover:text-primary transition-colors">Home</a>
            <a href="chi-siamo.html" class="hover:text-primary transition-colors">Chi Siamo</a>
            <a href="servizi.html" class="hover:text-primary transition-colors">Servizi</a>
            <a href="progetti.html" class="hover:text-primary transition-colors">Progetti</a>
            <a href="contatti.html" class="hover:text-primary transition-colors">Contatti</a>
        </nav>
        
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 text-white/70 font-light text-lg">
            <a href="tel:+391234567890" class="hover:text-primary transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span>+39 123 456 7890</span>
            </a>
            <a href="mailto:info@ferriristrutturazioni.it" class="hover:text-primary transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <span>info@ferriristrutturazioni.it</span>
            </a>
        </div>
    `;
    document.body.appendChild(mobileMenu);

    // Apply transitions only after element is mounted and initial state (hidden) is rendered
    requestAnimationFrame(() => {
        mobileMenu.classList.add('transition-transform', 'duration-300');
    });

    const toggleMenu = () => {
        const isOpen = mobileMenu.classList.toggle('translate-x-full');

        // Use 'menu-open' class to trigger SVG animation in index.html
        // Note: translate-x-full means HIDDEN. So if we toggle it OFF, it is OPEN.
        // If 'translate-x-full' is present, menu is CLOSED.
        // We want 'menu-open' when menu is VISIBLE (i.e. translate-x-full is NOT present).

        if (mobileMenu.classList.contains('translate-x-full')) {
            menuToggle.classList.remove('menu-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            if (header) header.classList.remove('menu-active');
            document.body.classList.remove('overflow-hidden');
        } else {
            menuToggle.classList.add('menu-open');
            menuToggle.setAttribute('aria-expanded', 'true');
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
