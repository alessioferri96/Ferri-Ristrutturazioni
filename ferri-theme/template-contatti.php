<?php
/**
 * Template Name: Contatti
 */
get_header(); ?>

<main id="primary" class="site-main">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section: Map Integration Focus -->
        <!-- Increased min-height to ensure form fits fully on desktop screens -->
        <section
            class="relative min-h-[900px] w-full bg-gray-200 overflow-hidden flex flex-col max-[1111px]:h-auto pt-20 md:pt-[120px]">

            <!-- Map Container (Leaflet) -->
            <div id="map" class="absolute inset-0 z-0 max-[1111px]:relative max-[1111px]:h-[500px]"></div>

            <!-- Floating Contact Card -->
            <div
                class="container relative h-full pointer-events-none max-[1111px]:h-auto max-[1111px]:pointer-events-auto max-[1111px]:w-full max-[1111px]:max-w-none max-[1111px]:p-0">
                <div
                    class="absolute top-1/2 md:right-0 transform translate-y-[20%] w-full md:w-[450px] pointer-events-auto px-4 md:px-0 
                max-[1111px]:relative max-[1111px]:top-0 max-[1111px]:right-auto max-[1111px]:translate-y-0 max-[1111px]:w-full max-[1111px]:max-w-2xl max-[1111px]:mx-auto max-[1111px]:px-6 max-[1111px]:py-8">
                    <div
                        class="bg-white/95 backdrop-blur-sm shadow-2xl p-8 md:p-10 border-t-8 border-primary animate-fade-in-up">
                        <h1 class="font-display text-4xl font-bold uppercase mb-2 text-secondary">
                            <?php the_title(); ?>
                        </h1>

                        <div class="prose prose-sm text-gray-500 mb-8">
                            <?php
                            $content = get_the_content();
                            if (!empty($content)) {
                                the_content();
                            } else {
                                echo '<p>Compila il form per una consulenza gratuita.</p>';
                                echo do_shortcode('[contact-form-7 id="1" title="Modulo di contatto 1"]');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Grid Section -->
        <section class="py-20 bg-white">
            <div class="container grid md:grid-cols-3 gap-12 text-center md:text-left">

                <!-- Block 1: Showroom -->
                <div class="group">
                    <div
                        class="w-12 h-12 bg-gray-100 text-primary flex items-center justify-center mb-6 mx-auto md:mx-0 rounded-full group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold uppercase text-secondary mb-4">Showroom & Sede</h3>
                    <p class="text-gray-600 mb-2 font-bold">Via Alessandro Volta, 42 <br> 20121 Milano (MI)</p>
                    <div class="text-sm text-gray-500 space-y-1">
                        <p>Lun - Ven: 09:00 - 18:30</p>
                        <p>Sab: Su appuntamento</p>
                    </div>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Via+Alessandro+Volta+42+Milano"
                        target="_blank"
                        class="inline-block mt-4 text-primary text-sm font-bold uppercase tracking-wider border-b border-primary hover:text-secondary hover:border-secondary transition-colors">Indicazioni
                        Stradali</a>
                </div>

                <!-- Block 2: Contatti Diretti -->
                <div class="group">
                    <div
                        class="w-12 h-12 bg-gray-100 text-primary flex items-center justify-center mb-6 mx-auto md:mx-0 rounded-full group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold uppercase text-secondary mb-4">Ufficio Tecnico</h3>
                    <p class="text-gray-600 mb-4 text-sm">Per informazioni su progetti in corso, preventivi o urgenze di
                        cantiere.</p>
                    <div class="space-y-2 font-bold text-gray-800">
                        <a href="tel:+39021234567" class="block hover:text-primary transition-colors">+39 02 123 4567</a>
                        <a href="mailto:info@ferriristrutturazioni.it"
                            class="block hover:text-primary transition-colors">info@ferriristrutturazioni.it</a>
                    </div>
                </div>

                <!-- Block 3: Lavora con Noi -->
                <div class="group">
                    <div
                        class="w-12 h-12 bg-gray-100 text-primary flex items-center justify-center mb-6 mx-auto md:mx-0 rounded-full group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold uppercase text-secondary mb-4">Lavora con Noi</h3>
                    <p class="text-gray-600 mb-4 text-sm">Siamo sempre alla ricerca di architetti, geometri e artigiani
                        qualificati da inserire nel team.</p>
                    <a href="mailto:careers@ferriristrutturazioni.it"
                        class="group/btn relative inline-flex items-center justify-center gap-2 overflow-hidden bg-gray-100 px-6 py-3 font-bold uppercase tracking-widest text-sm text-secondary transition-colors duration-300 hover:text-white">
                        <span
                            class="absolute inset-0 z-0 h-full w-full -translate-x-full transform bg-primary transition-transform duration-300 ease-out group-hover/btn:translate-x-0"></span>
                        <span
                            class="relative z-10 flex items-center gap-2 transition-all duration-300 group-hover/btn:gap-4">
                            Invia Candidatura
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>

            </div>
        </section>

        <!-- Leaflet Map Initialization Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof L !== 'undefined') {
                    const map = L.map('map', {
                        scrollWheelZoom: false,
                        zoomControl: false
                    }).setView([45.4800, 9.1860], 15);

                    L.control.zoom({ position: 'bottomleft' }).addTo(map);

                    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
                        subdomains: 'abcd',
                        maxZoom: 20
                    }).addTo(map);

                    const customIcon = L.divIcon({
                        className: 'custom-map-marker',
                        html: `<div class="relative flex items-center justify-center w-8 h-8">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <div class="relative w-8 h-8 bg-primary rounded-full border-4 border-white shadow-xl flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                           </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    const marker = L.marker([45.4800, 9.1860], { icon: customIcon }).addTo(map);

                    marker.bindPopup(`
                    <div class="font-sans text-center">
                        <h3 class="font-bold uppercase text-secondary mb-1">Ferri Ristrutturazioni</h3>
                        <p class="text-xs text-gray-500 mb-2">Via Alessandro Volta, 42<br>Milano</p>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=Via+Alessandro+Volta+42+Milano" target="_blank" class="text-primary text-xs font-bold uppercase hover:underline">Indicazioni</a>
                    </div>
                `).openPopup();
                }
            });
        </script>
    <?php endwhile; ?>

</main>

<?php get_footer(); ?>