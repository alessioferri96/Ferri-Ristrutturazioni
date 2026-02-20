<?php
/**
 * Template Name: Chi Siamo
 */
get_header(); ?>

<main id="primary" class="site-main">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section -->
        <section class="relative min-h-[100dvh] flex items-center justify-center overflow-hidden bg-secondary text-white">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop'; ?>');">
            </div>
            <div class="absolute inset-0 bg-black/50 z-10"></div>

            <div class="container relative z-20 text-center pt-20 px-6">
                <h2
                    class="text-xs md:text-base font-bold tracking-[0.3em] uppercase mb-4 text-primary animate-fade-in-down">
                    La Nostra Visione
                </h2>
                <h1
                    class="font-display font-bold text-5xl md:text-8xl uppercase tracking-tighter mb-8 animate-fade-in-up leading-none">
                    Costruttori di <br /><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">Futuro</span>
                </h1>
                <div class="w-16 md:w-24 h-1.5 bg-primary mx-auto mb-8 md:mb-10"></div>

                <p
                    class="text-gray-200 text-lg md:text-xl font-light tracking-wide max-w-2xl mx-auto animate-fade-in-up delay-200">
                    Da oltre 15 anni trasformiamo spazi e diamo forma ai sogni dei nostri clienti con passione e rigore.
                </p>

                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white/50">
                        <path d="M12 5v14M19 12l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Editorial Grid: La Visione -->
        <section class="py-24 bg-white relative overflow-hidden">
            <!-- Abstract Background Shape -->
            <div class="absolute top-0 right-0 w-1/3 h-full bg-gray-50 -z-10 transform skew-x-12 translate-x-32"></div>

            <div class="container px-6">

                <!-- Block 1: Intro (Image Left, Text Right) -->
                <div class="grid md:grid-cols-12 gap-12 items-center mb-32">
                    <div class="md:col-span-5 relative scroll-reveal">
                        <div class="aspect-[3/4] overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1531835551805-16d864c8d311?q=80&w=2070&auto=format&fit=crop"
                                alt="Team Ferri pianificazione in cantiere"
                                class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        </div>
                        <!-- Floating Badge -->
                        <div
                            class="absolute -bottom-6 -right-6 bg-primary text-white p-6 md:p-8 shadow-xl max-w-xs hidden md:block">
                            <p class="font-display font-bold uppercase text-2xl leading-none mb-1">Passione</p>
                            <p class="font-light text-sm italic">"Il dettaglio fa la differenza."</p>
                        </div>
                    </div>
                    <div class="md:col-span-7 md:pl-12 scroll-reveal text-content-area prose prose-lg">
                        <?php
                        $content = get_the_content();
                        if (!empty($content)) {
                            the_content();
                        } else { ?>
                            <span class="text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4 block">L'evoluzione
                                dell’edilizia nei Castelli Romani</span>
                            <h2
                                class="font-display text-4xl md:text-6xl font-bold uppercase text-secondary tracking-tighter leading-none mb-8">
                                Tre Generazioni, <br>un’unica solidità: <span class="text-primary">la nostra storia.</span>
                            </h2>
                            <p
                                class="text-gray-600 text-lg leading-relaxed mb-6 text-justify first-letter:text-4xl md:first-letter:text-5xl first-letter:font-bold first-letter:text-primary first-letter:float-left first-letter:mr-3">
                                Tutto è iniziato a Frascati intorno al 1980, quando Nonno Ferri ha posato la prima pietra con
                                un’idea semplice ma incrollabile: costruire per durare. Quello che era un piccolo sogno
                                artigiano si è trasformato, decennio dopo decennio, in un punto di riferimento per le
                                ristrutturazioni nei Castelli Romani.
                            </p>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6 text-justify">
                                Il testimone è passato poi ai figli, che hanno saputo traghettare l’azienda verso le sfide della
                                modernità, mantenendo intatto quel cognome che per tutti, qui, è sinonimo di serietà. Oggi,
                                guidiamo la Ferri Ristrutturazioni con lo stesso spirito dei nostri padri, ma con una marcia in
                                più: l'efficienza tecnologica.
                            </p>
                            <p class="text-gray-600 text-lg leading-relaxed mb-8 border-l-4 border-primary pl-6 text-justify">
                                <span class="block font-bold uppercase text-secondary mb-2">Perché sceglierci?</span>
                                Perché sappiamo che ristrutturare casa non è solo un lavoro di muratura, è un atto di fiducia. E
                                noi della famiglia Ferri firmiamo ogni progetto con l’orgoglio di chi, da tre generazioni, non
                                ha mai smesso di metterci la faccia.
                            </p>
                        <?php } ?>
                    </div>
                </div>

                <!-- Block 2: The Quote (Center Focus) -->
                <div class="text-center max-w-4xl mx-auto py-16 mb-32 relative scroll-reveal">
                    <svg class="w-16 h-16 text-primary/20 absolute -top-4 left-0 md:-left-12" fill="currentColor"
                        viewBox="0 0 32 32" aria-hidden="true">
                        <path
                            d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                    </svg>
                    <blockquote
                        class="font-display text-4xl md:text-6xl font-bold uppercase text-secondary leading-tight relative z-10">
                        "Costruiamo fiducia, <br>non solo spazi."
                    </blockquote>
                    <div class="mt-8 flex items-center justify-center gap-4">
                        <div class="h-px w-12 bg-gray-300"></div>
                        <span class="uppercase tracking-widest text-sm font-bold text-gray-500">Fulvio Ferri &bull;
                            Founder</span>
                        <div class="h-px w-12 bg-gray-300"></div>
                    </div>
                </div>

                <!-- Block 3: Philosophy (Text Left, Image Right) -->
                <div class="grid md:grid-cols-12 gap-12 items-center">
                    <div class="md:col-span-6 order-2 md:order-1 scroll-reveal">
                        <span class="text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4 block">Il Metodo</span>
                        <h2
                            class="font-display text-4xl md:text-5xl font-bold uppercase text-secondary tracking-tighter leading-none mb-8">
                            Precisione <br>e Controllo
                        </h2>
                        <ul class="space-y-8">
                            <li class="flex gap-4">
                                <span class="font-display text-primary text-3xl font-bold opacity-50">01</span>
                                <div>
                                    <h4 class="font-bold text-lg uppercase mb-2">Pianificazione Totale</h4>
                                    <p class="text-gray-600 font-light text-sm">Nulla è lasciato al caso. Cronoprogramma e
                                        budget sono definiti prima di posare il primo mattone.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span class="font-display text-primary text-3xl font-bold opacity-50">02</span>
                                <div>
                                    <h4 class="font-bold text-lg uppercase mb-2">Tecnologia e Design</h4>
                                    <p class="text-gray-600 font-light text-sm">Usiamo i materiali più innovativi e
                                        collaboriamo con i migliori designer di interni.</p>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span class="font-display text-primary text-3xl font-bold opacity-50">03</span>
                                <div>
                                    <h4 class="font-bold text-lg uppercase mb-2">Trasparenza Assoluta</h4>
                                    <p class="text-gray-600 font-light text-sm">Report settimanali sull'avanzamento lavori.
                                        Nessuna sorpresa, mai.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="md:col-span-6 md:col-start-8 order-1 md:order-2 scroll-reveal">
                        <div class="aspect-square relative overflow-hidden shadow-2xl">
                            <div class="absolute inset-4 border border-white/50 z-10"></div>
                            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop"
                                alt="Architectural Plan"
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Numbers Transition Strap -->
        <section class="py-16 bg-secondary text-white relative">
            <div class="container px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
                <div class="scroll-reveal">
                    <span class="block text-4xl md:text-6xl font-display font-bold text-primary mb-2 counter-animate"
                        data-target="15" data-suffix="+">1</span>
                    <span class="text-xs uppercase tracking-widest text-gray-400">Anni di Esperienza</span>
                </div>
                <div class="scroll-reveal delay-100">
                    <span class="block text-4xl md:text-6xl font-display font-bold text-primary mb-2 counter-animate"
                        data-target="450" data-suffix="+">1</span>
                    <span class="text-xs uppercase tracking-widest text-gray-400">Progetti Consegnati</span>
                </div>
                <div class="scroll-reveal delay-200">
                    <span class="block text-4xl md:text-6xl font-display font-bold text-primary mb-2 counter-animate"
                        data-target="100" data-suffix="%">1</span>
                    <span class="text-xs uppercase tracking-widest text-gray-400">Clienti Soddisfatti</span>
                </div>
                <div class="scroll-reveal delay-300">
                    <span class="block text-4xl md:text-6xl font-display font-bold text-primary mb-2 counter-animate"
                        data-target="25" data-suffix="">1</span>
                    <span class="text-xs uppercase tracking-widest text-gray-400">Partner Esclusivi</span>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="py-24 bg-gray-50 relative overflow-hidden">
            <div class="container px-6 max-w-5xl mx-auto">
                <h2
                    class="font-display text-4xl md:text-5xl font-bold uppercase text-secondary tracking-tighter text-center mb-20 scroll-reveal">
                    La Nostra <span class="text-primary">Storia</span>
                </h2>

                <div class="relative items-center">
                    <!-- Vertical Line with Scroll Progress -->
                    <div id="timeline-line-container"
                        class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gray-300 transform md:-translate-x-1/2 overflow-hidden">
                        <div id="timeline-progress-bar"
                            class="absolute top-0 left-0 w-full bg-primary h-0 transition-all duration-100 ease-linear">
                        </div>
                    </div>

                    <!-- Timeline Items -->
                    <div class="relative mb-20 md:mb-32 group">
                        <div class="flex flex-col md:flex-row items-center justify-between w-full relative">
                            <div
                                class="timeline-content opacity-0 translate-y-8 transition-all duration-700 ease-out order-1 w-[calc(100%-3rem)] ml-12 md:ml-0 md:w-[45%] mb-8 md:mb-0 md:text-right p-6 bg-white shadow-lg border-l-4 border-primary rounded-sm md:border-l-0 md:border-r-4 relative z-20">
                                <span class="block text-4xl font-display font-bold text-gray-200 mb-2">2010</span>
                                <h3 class="font-bold uppercase text-lg mb-2 text-secondary">La Fondazione</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">Fulvio Ferri fonda l'azienda con una
                                    piccola squadra di artigiani scelti e una visione chiara: puntare sull'eccellenza.</p>
                            </div>
                            <div
                                class="timeline-point absolute top-8 md:top-1/2 left-4 md:left-1/2 w-4 h-4 rounded-full bg-primary border-4 border-white transform -translate-x-2 md:-translate-x-2 md:-translate-y-1/2 z-30 shadow transition-all duration-500">
                            </div>
                            <div class="order-1 w-full md:w-[45%] pl-12 md:pl-0 relative z-0">
                                <div
                                    class="absolute -top-12 -right-6 md:top-1/2 md:left-12 md:right-auto transform md:-translate-y-1/2 -rotate-[10deg] md:rotate-0 w-40 md:w-[21rem] hover:z-30 hover:scale-105 transition-transform duration-300">
                                    <div
                                        class="timeline-content opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200 grayscale hover:grayscale-0">
                                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop"
                                            alt="Old Blueprints"
                                            class="shadow-xl rounded-sm border-4 border-white w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-20 md:mb-32 group">
                        <div class="flex flex-col md:flex-row items-center justify-between w-full relative">
                            <div class="order-2 w-full md:w-[45%] relative z-0 md:order-1">
                                <div
                                    class="absolute -top-12 left-0 md:top-1/2 md:right-12 md:left-auto transform md:-translate-y-1/2 rotate-[10deg] md:rotate-0 w-40 md:w-[21rem] hover:z-30 hover:scale-105 transition-transform duration-300">
                                    <div
                                        class="timeline-content opacity-0 translate-y-8 transition-all duration-700 ease-out delay-200 grayscale hover:grayscale-0">
                                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop"
                                            alt="Office Building"
                                            class="shadow-xl rounded-sm border-4 border-white w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="timeline-point absolute top-8 md:top-1/2 left-4 md:left-1/2 w-4 h-4 rounded-full bg-primary border-4 border-white transform -translate-x-2 md:-translate-x-2 md:-translate-y-1/2 z-30 shadow transition-all duration-500">
                            </div>
                            <div class="order-1 w-full md:w-[45%] mb-8 md:mb-0 md:pl-12 relative z-20 md:order-2">
                                <div
                                    class="timeline-content opacity-0 translate-y-8 transition-all duration-700 ease-out w-[calc(100%-3rem)] ml-12 md:ml-0 md:w-full p-6 bg-white shadow-lg border-l-4 border-primary rounded-sm text-left">
                                    <span class="block text-4xl font-display font-bold text-gray-200 mb-2">2015</span>
                                    <h3 class="font-bold uppercase text-lg mb-2 text-secondary">Espansione Commerciale</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">L'azienda si struttura per gestire
                                        grandi appalti e ristrutturazioni di locali commerciali e uffici di prestigio.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>