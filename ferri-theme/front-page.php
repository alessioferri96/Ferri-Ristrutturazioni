<?php
/**
 * Template per la Homepage (Front Page)
 */
get_header(); ?>

<!-- Main Content -->
<main id="primary" class="site-main">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section -->
        <section id="home"
            class="relative min-h-[100dvh] flex items-center justify-center overflow-hidden bg-secondary text-white"
            data-slides='[
            "https://images.unsplash.com/photo-1541976590-713941681591?q=80&w=2070&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?q=80&w=2070&auto=format&fit=crop",
            "https://images.unsplash.com/photo-1581094794329-cd67bcecf552?q=80&w=2073&auto=format&fit=crop"
        ]'>

            <!-- Slideshow Background Container -->
            <div id="hero-slideshow" class="absolute inset-0 z-0">
                <!-- Images will be injected here by JS -->
                <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-100"
                    style="background-image: url('https://images.unsplash.com/photo-1541976590-713941681591?q=80&w=2070&auto=format&fit=crop');">
                </div>
            </div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/30 z-10"></div>

            <!-- Content -->
            <div class="container relative z-20 text-center pt-20 px-6">
                <h2
                    class="text-xs md:text-base font-bold tracking-[0.3em] uppercase mb-4 text-primary animate-fade-in-down">
                    Eccellenza Edile
                </h2>
                <h1
                    class="font-display font-bold text-5xl md:text-8xl uppercase tracking-tighter mb-8 animate-fade-in-up leading-none">
                    Solidi come <br /><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">Ferro</span>
                </h1>
                <div class="w-16 md:w-24 h-1.5 bg-primary mx-auto mb-8 md:mb-10"></div>

                <div class="flex flex-col md:flex-row gap-4 md:gap-6 justify-center items-center animate-fade-in-up"
                    style="animation-delay: 200ms;">
                    <a href="<?php echo esc_url(home_url('/progetti')); ?>"
                        class="w-full md:w-auto group relative px-8 py-3 md:py-4 bg-transparent border-2 border-white text-white font-bold uppercase tracking-widest overflow-hidden hover:text-secondary transition-colors duration-300">
                        <span
                            class="absolute inset-0 w-full h-full bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                        <span class="relative z-10 text-sm md:text-base">I Nostri Progetti</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>"
                        class="w-full md:w-auto group relative px-8 py-3 md:py-4 bg-primary text-white font-bold uppercase tracking-widest overflow-hidden hover:text-secondary transition-colors duration-300 border-2 border-primary">
                        <span
                            class="absolute inset-0 w-full h-full bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                        <span class="relative z-10 text-sm md:text-base">Contattaci</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section PSA: Problem - Solution - Action -->
        <section id="psa" class="py-12 md:py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <!-- Header -->
                <div class="text-center max-w-4xl mx-auto mb-10 md:mb-16 scroll-reveal">
                    <h2
                        class="font-display text-3xl md:text-4xl font-bold uppercase mb-4 md:mb-6 text-secondary tracking-widest leading-tight">
                        Ristrutturare Casa <br><span class="text-primary">Non Deve Essere un Incubo</span>
                    </h2>
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Sappiamo cosa ti spaventa: preventivi che lievitano, ritardi infiniti e stress burocratico.
                        <br class="hidden md:inline">Noi abbiamo scelto un'altra strada.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 md:gap-12 max-w-6xl mx-auto items-start">
                    <!-- Problem Column -->
                    <div class="bg-white p-6 md:p-10 shadow-lg border-l-4 border-red-500 scroll-reveal">
                        <h3
                            class="font-display text-xl md:text-2xl font-bold uppercase mb-6 md:mb-8 text-secondary flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-red-500">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            I Soliti Problemi
                        </h3>
                        <ul class="space-y-6 md:space-y-8">
                            <li class="flex items-start gap-4">
                                <div class="bg-red-50 p-2 rounded-full shrink-0 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base md:text-lg mb-1">Preventivi Lievitati</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">Il prezzo iniziale è solo un'esca. A
                                        metà lavori arrivano le "sorprese" e i costi esplodono.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="bg-red-50 p-2 rounded-full shrink-0 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base md:text-lg mb-1">Ritardi Infiniti</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">"Finiamo tra due settimane" diventa
                                        "tra due mesi". Il cantiere si ferma e nessuno risponde.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="bg-red-50 p-2 rounded-full shrink-0 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base md:text-lg mb-1">Caos Burocratico</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">Permessi, Cila, Scia... vieni lasciato
                                        solo a gestire carte che non conosci e rischi multe.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Solution Column -->
                    <div class="bg-secondary text-white p-6 md:p-10 shadow-xl border-l-4 border-primary relative overflow-hidden scroll-reveal"
                        style="transition-delay: 200ms;">
                        <div
                            class="absolute top-0 right-0 -mt-10 -mr-10 w-32 h-32 bg-primary opacity-20 rounded-full blur-2xl">
                        </div>

                        <h3
                            class="font-display text-xl md:text-2xl font-bold uppercase mb-6 md:mb-8 text-white flex items-center gap-3 relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-primary">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Il Metodo Ferri
                        </h3>
                        <ul class="space-y-6 md:space-y-8 relative z-10">
                            <li class="flex items-start gap-4">
                                <div class="bg-white/10 p-2 rounded-full shrink-0 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base md:text-lg mb-1">Prezzo Bloccato</h4>
                                    <p class="text-gray-300 text-sm leading-relaxed">Analisi precisa e preventivo
                                        dettagliato prima di iniziare. Quello che firmi è quello che paghi.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="bg-white/10 p-2 rounded-full shrink-0 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base md:text-lg mb-1">Tempi Garantiti</h4>
                                    <p class="text-gray-300 text-sm leading-relaxed">Cronoprogramma blindato. Se ritardiamo,
                                        paghiamo noi una penale per ogni giorno in più.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="bg-white/10 p-2 rounded-full shrink-0 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base md:text-lg mb-1">Unico Referente</h4>
                                    <p class="text-gray-300 text-sm leading-relaxed">Dal progetto alle chiavi in mano. Un
                                        solo numero da chiamare per qualsiasi esigenza.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action -->
                <div class="text-center mt-12 md:mt-16 scroll-reveal">
                    <a href="<?php echo esc_url(home_url('/servizi')); ?>"
                        class="inline-block group relative bg-primary text-white font-bold uppercase tracking-widest px-8 md:px-10 py-3 md:py-4 overflow-hidden hover:text-white transition-colors duration-300 shadow-lg shadow-sky-200 text-sm md:text-base">
                        <span
                            class="absolute inset-0 w-full h-full bg-secondary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                        <span class="relative z-10">Scopri i Nostri Servizi</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- About Section (Newspaper Style) -->
        <section id="chi-siamo" class="py-12 md:py-24 bg-white relative">
            <div class="container max-w-5xl mx-auto scroll-reveal px-6">
                <div class="mb-10 md:mb-12 text-center md:text-left">
                    <span class="block text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-4">Chi
                        Siamo</span>
                    <h2
                        class="font-display text-4xl md:text-6xl font-bold uppercase text-secondary tracking-tighter leading-none">
                        L'Eccellenza <br>Costruttiva
                    </h2>
                </div>
                <div
                    class="prose prose-lg mx-auto text-gray-600 leading-relaxed md:columns-2 gap-12 md:gap-16 text-left md:text-justify">
                    <!-- Se c'è contenuto inserito nell'editor classico della pagina WP, lo stampiamo -->
                    <?php
                    $content = get_the_content();
                    if (!empty($content)) {
                        the_content();
                    } else {
                        ?>
                        <p
                            class="mb-6 first-letter:text-4xl md:first-letter:text-5xl first-letter:font-bold first-letter:text-primary first-letter:float-left first-letter:mr-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                        </p>
                        <p class="mb-6">
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                            est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                            beatae vitae dicta sunt explicabo.
                        </p>
                        <p class="mb-6">
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                            magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
                            quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut
                            labore et dolore magnam aliquam quaerat voluptatem.
                        </p>
                        <p>
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
                            aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit
                            esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                        </p>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="servizi" class="py-24 bg-gray-50 border-t border-gray-100">
            <div class="container max-w-4xl mx-auto text-center scroll-reveal">
                <h2 class="font-display text-4xl font-bold uppercase mb-12 text-secondary tracking-widest">Servizi</h2>
                <div class="grid md:grid-cols-2 gap-8 text-left max-w-3xl mx-auto">
                    <div class="bg-white p-8 shadow-sm border border-gray-100 hover:border-primary transition-colors">
                        <h3 class="font-display text-xl font-bold uppercase mb-2 text-primary">Costruzione &
                            Ristrutturazione</h3>
                        <p class="text-secondary">Shell & Core, opere strutturali, modernizzazione edifici.</p>
                    </div>
                    <div class="bg-white p-8 shadow-sm border border-gray-100 hover:border-primary transition-colors">
                        <h3 class="font-display text-xl font-bold uppercase mb-2 text-primary">Fit Out & Interni</h3>
                        <p class="text-secondary">CAT A, CAT B, allestimenti chiavi in mano.</p>
                    </div>
                    <div class="bg-white p-8 shadow-sm border border-gray-100 hover:border-primary transition-colors">
                        <h3 class="font-display text-xl font-bold uppercase mb-2 text-primary">Riqualificazione</h3>
                        <p class="text-secondary">Efficientamento energetico e restauro facciate.</p>
                    </div>
                    <div class="bg-white p-8 shadow-sm border border-gray-100 hover:border-primary transition-colors">
                        <h3 class="font-display text-xl font-bold uppercase mb-2 text-primary">Progetti Speciali</h3>
                        <p class="text-secondary">Opere esterne, lavori propedeutici, manutenzioni.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section (Exact Card Design) -->
        <section id="progetti" class="py-24 bg-white">
            <div class="container mb-12 text-center scroll-reveal">
                <h2 class="font-display text-4xl font-bold uppercase text-secondary tracking-widest mb-2">Progetti</h2>
            </div>

            <div class="container">
                <div class="grid md:grid-cols-1 gap-12 max-w-5xl mx-auto">
                    <!-- Project Card 1 -->
                    <div class="group relative h-[500px] w-full overflow-hidden bg-gray-900 scroll-reveal cursor-pointer">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                            style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop');">
                        </div>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300">
                        </div>
                        <div
                            class="absolute inset-y-0 left-0 w-16 flex items-end justify-center pb-8 z-20 pointer-events-none">
                            <div
                                class="writing-vertical-rl transform rotate-180 text-white font-bold uppercase tracking-widest text-xs border-l-4 border-primary pl-2 h-max max-h-[80%]">
                                Residenziale
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-6 z-10">
                            <h3
                                class="font-display text-4xl font-bold uppercase mb-4 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Villa Moderna</h3>
                            <div
                                class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0 delay-100">
                                <p class="text-lg font-light mb-1">Milano</p>
                                <p class="text-sm text-gray-300 tracking-wide">350 mq</p>
                            </div>
                        </div>
                    </div>

                    <!-- Project Card 2 -->
                    <div class="group relative h-[500px] w-full overflow-hidden bg-gray-900 scroll-reveal cursor-pointer">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                            style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop');">
                        </div>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300">
                        </div>
                        <div
                            class="absolute inset-y-0 left-0 w-16 flex items-end justify-center pb-8 z-20 pointer-events-none">
                            <div
                                class="writing-vertical-rl transform rotate-180 text-white font-bold uppercase tracking-widest text-xs border-l-4 border-accent pl-2 h-max max-h-[80%]">
                                Commerciale
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-6 z-10">
                            <h3
                                class="font-display text-4xl font-bold uppercase mb-4 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Uffici Tech Hub</h3>
                            <div
                                class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-4 group-hover:translate-y-0 delay-100">
                                <p class="text-lg font-light mb-1">Torino</p>
                                <p class="text-sm text-gray-300 tracking-wide">1200 mq</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="<?php echo esc_url(home_url('/progetti')); ?>"
                        class="inline-block group relative border border-black px-8 py-3 text-sm font-bold uppercase tracking-widest overflow-hidden hover:text-white transition-colors">
                        <span
                            class="absolute inset-0 w-full h-full bg-secondary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                        <span class="relative z-10">Vedi Tutti i Progetti</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Difference Section -->
        <section id="differenza" class="py-24 bg-white relative">
            <div class="container max-w-5xl mx-auto scroll-reveal">
                <div class="mb-12 text-center md:text-left">
                    <span class="block text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4">Perché
                        Sceglierci</span>
                    <h2
                        class="font-display text-5xl md:text-6xl font-bold uppercase text-secondary tracking-tighter leading-none">
                        La Nostra <br>Differenza
                    </h2>
                </div>
                <div class="prose prose-lg mx-auto text-gray-600 leading-relaxed md:columns-2 gap-16 text-justify">
                    <p
                        class="mb-6 first-letter:text-5xl first-letter:font-bold first-letter:text-primary first-letter:float-left first-letter:mr-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.
                    </p>
                    <p class="mb-6">
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                        est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium.
                    </p>
                    <p class="mb-6">
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                        magni dolores eos qui ratione voluptatem sequi nesciunt.
                    </p>
                    <p>
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
                        aliquid ex ea commodi consequatur?
                    </p>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>