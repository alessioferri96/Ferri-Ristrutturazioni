document.addEventListener('DOMContentLoaded', () => {

    /* =========================================
       1. Sticky Header Logic
       ========================================= */
    const header = document.getElementById('site-header');

    // Add 'group' class to header to enable Tailwind group modifiers
    if (header) header.classList.add('group');

    const handleScroll = () => {
        if (!header) return;
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

    if (menuToggle) {
        menuToggle.type = 'button';
    }

    // Desktop navigation: keep the immersive fullscreen menu on smaller screens,
    // while making the main routes and the contact action immediately visible.
    if (menuToggle?.parentElement) {
        const desktopNav = document.createElement('nav');
        desktopNav.className = 'hidden xl:flex items-center gap-7 font-display text-sm font-bold uppercase tracking-wider';
        desktopNav.setAttribute('aria-label', 'Navigazione principale');
        desktopNav.innerHTML = `
            <a href="chi-siamo.html" class="text-white/80 hover:text-primary transition-colors">Chi siamo</a>
            <a href="servizi.html" class="text-white/80 hover:text-primary transition-colors">Servizi</a>
            <a href="progetti.html" class="text-white/80 hover:text-primary transition-colors">Progetti</a>
            <a href="contatti.html" class="inline-flex items-center min-h-11 px-5 border border-primary bg-primary text-secondary hover:bg-primary-dark hover:border-primary-dark transition-colors">Richiedi sopralluogo</a>
        `;
        const currentPage = window.location.pathname.split('/').pop() || 'index.html';
        desktopNav.querySelectorAll('a').forEach((link) => {
            if (link.getAttribute('href') === currentPage) {
                link.setAttribute('aria-current', 'page');
                link.classList.add('text-primary');
                link.classList.remove('text-white/80');
            }
        });
        menuToggle.parentElement.insertBefore(desktopNav, menuToggle);
        menuToggle.classList.add('xl:hidden');
    }

    // Create mobile menu container dynamically for lightness
    // Start WITHOUT transition classes to prevent flash on load
    const mobileMenu = document.createElement('div');
    mobileMenu.className = 'fixed inset-0 bg-secondary z-[60] pt-24 px-6 transform translate-x-full pointer-events-none flex flex-col items-center justify-center text-center text-white';
    mobileMenu.id = 'mobile-menu';
    mobileMenu.setAttribute('aria-label', 'Menu di navigazione');
    mobileMenu.setAttribute('aria-hidden', 'true');
    mobileMenu.inert = true;
    mobileMenu.innerHTML = `
        <nav class="flex flex-col gap-6 font-display text-4xl font-bold uppercase text-white mb-12" aria-label="Navigazione principale">
            <a href="index.html" class="hover:text-primary transition-colors">Home</a>
            <a href="chi-siamo.html" class="hover:text-primary transition-colors">Chi Siamo</a>
            <a href="servizi.html" class="hover:text-primary transition-colors">Servizi</a>
            <a href="progetti.html" class="hover:text-primary transition-colors">Progetti</a>
            <a href="contatti.html" class="hover:text-primary transition-colors">Contatti</a>
        </nav>
        
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 text-white/70 font-light text-lg">
            <div class="flex flex-col gap-3 items-center md:items-start">
                <a href="tel:+393428556117" class="hover:text-primary transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <span>+39 342 855 6117</span>
                </a>
                <a href="tel:+393408832362" class="hover:text-primary transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <span>+39 340 883 2362</span>
                </a>
            </div>
            <div class="flex flex-col gap-3 items-center md:items-start">
                <a href="mailto:info@ferriristrutturazioni.com" class="hover:text-primary transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <span>info@ferriristrutturazioni.com</span>
                </a>
                <a href="https://www.instagram.com/ferriristrutturazioni/" target="_blank" rel="noopener noreferrer" class="hover:text-primary transition-colors flex items-center gap-2" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                    <span>Instagram</span>
                </a>
            </div>
        </div>
    `;
    document.body.appendChild(mobileMenu);

    // Apply transitions only after element is mounted and initial state (hidden) is rendered
    requestAnimationFrame(() => {
        mobileMenu.classList.add('transition-transform', 'duration-300');
    });

    const setMenuOpen = (open, returnFocus = false) => {
        mobileMenu.classList.toggle('translate-x-full', !open);
        mobileMenu.classList.toggle('pointer-events-none', !open);
        mobileMenu.inert = !open;
        mobileMenu.setAttribute('aria-hidden', String(!open));
        menuToggle?.classList.toggle('menu-open', open);
        menuToggle?.setAttribute('aria-expanded', String(open));
        header?.classList.toggle('menu-active', open);
        document.body.classList.toggle('overflow-hidden', open);

        if (open) {
            requestAnimationFrame(() => mobileMenu.querySelector('a')?.focus());
        } else if (returnFocus) {
            menuToggle?.focus();
        }
    };

    const toggleMenu = () => {
        setMenuOpen(mobileMenu.classList.contains('translate-x-full'));
    };

    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => setMenuOpen(false));
    });

    document.addEventListener('keydown', (event) => {
        if (mobileMenu.inert) return;

        if (event.key === 'Escape') {
            event.preventDefault();
            setMenuOpen(false, true);
            return;
        }

        if (event.key !== 'Tab') return;

        const focusable = [menuToggle, ...mobileMenu.querySelectorAll('a')].filter(Boolean);
        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    /* =========================================
       3. Contact form ergonomics
       ========================================= */
    document.querySelectorAll('form').forEach((form) => {
        const nameField = form.querySelector('[name="name"]');
        const phoneField = form.querySelector('[name="phone"]');
        const emailField = form.querySelector('[name="email"]');

        nameField?.setAttribute('autocomplete', 'name');
        phoneField?.setAttribute('type', 'tel');
        phoneField?.setAttribute('inputmode', 'tel');
        phoneField?.setAttribute('autocomplete', 'tel');
        emailField?.setAttribute('autocomplete', 'email');
    });

    // Consistent feedback for every contact form, including server validation errors.
    const feedback = document.getElementById('form-feedback');
    const status = new URLSearchParams(window.location.search).get('status');
    if (feedback && (status === 'ok' || status === 'errore')) {
        const params = new URLSearchParams(window.location.search);
        feedback.hidden = false;
        feedback.classList.toggle('is-error', status === 'errore');
        feedback.setAttribute('role', status === 'errore' ? 'alert' : 'status');
        feedback.textContent = status === 'ok'
            ? 'Richiesta inviata. Ti ricontatteremo al più presto.'
            : (params.get('msg') || 'Invio non riuscito. Controlla i dati o contattaci telefonicamente.');
        requestAnimationFrame(() => {
            feedback.focus({ preventScroll: true });
            feedback.scrollIntoView({ block: 'center', behavior: 'instant' });
        });
    }

    /* =========================================
       4. Scroll Reveal
       ========================================= */
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

    /* =========================================
       7. Prima/Dopo Slider (Before/After Comparison)
       ========================================= */
    document.querySelectorAll('.ba-slider').forEach((slider) => {
        const handle = slider.querySelector('.ba-slider-handle');
        const beforeMedia = slider.querySelector('.ba-slider-before');
        if (!handle || !beforeMedia) return;

        let dragging = false;

        const setPosition = (percent) => {
            const clamped = Math.min(100, Math.max(0, percent));
            handle.style.left = clamped + '%';
            beforeMedia.style.clipPath = `inset(0 ${100 - clamped}% 0 0)`;
            handle.setAttribute('aria-valuenow', Math.round(clamped));
        };

        const percentFromClientX = (clientX) => {
            const rect = slider.getBoundingClientRect();
            return ((clientX - rect.left) / rect.width) * 100;
        };

        const onPointerMove = (e) => setPosition(percentFromClientX(e.clientX));

        const stopDragging = () => {
            dragging = false;
            window.removeEventListener('pointermove', onPointerMove);
            window.removeEventListener('pointerup', stopDragging);
        };

        slider.addEventListener('pointerdown', (e) => {
            dragging = true;
            setPosition(percentFromClientX(e.clientX));
            window.addEventListener('pointermove', onPointerMove);
            window.addEventListener('pointerup', stopDragging);
        });

        handle.addEventListener('keydown', (e) => {
            const current = parseFloat(handle.style.left) || 50;
            if (e.key === 'ArrowLeft') { setPosition(current - 5); e.preventDefault(); }
            if (e.key === 'ArrowRight') { setPosition(current + 5); e.preventDefault(); }
            if (e.key === 'Home') { setPosition(0); e.preventDefault(); }
            if (e.key === 'End') { setPosition(100); e.preventDefault(); }
        });

        // Se la foto reale non è ancora stata caricata, mostra il placeholder invece dell'icona "immagine rotta"
        slider.querySelectorAll('img').forEach((img) => {
            img.addEventListener('error', () => {
                img.closest('.ba-slider-media').classList.add('ba-slider-missing');
            }, { once: true });
        });
    });

});
