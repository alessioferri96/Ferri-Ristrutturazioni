<?php
/**
 * Template Name: Servizi
 */
get_header(); ?>

<!-- Aggiunta stili inline per FAQ (da servizi2.html) -->
<style>
    /* FAQ Animation */
    details>summary::-webkit-details-marker {
        display: none;
    }

    details[open] summary~* {
        animation: slideDown 0.3s ease-in-out;
    }

    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<main id="primary" class="site-main">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section (Strict Config from Index) -->
        <section class="relative min-h-[100dvh] flex items-center justify-center overflow-hidden bg-secondary text-white">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=2072&auto=format&fit=crop'; ?>');">
            </div>
            <div class="absolute inset-0 bg-black/40 z-10"></div>

            <div class="container relative z-20 text-center pt-20 px-6">
                <h2
                    class="text-xs md:text-base font-bold tracking-[0.3em] uppercase mb-4 text-primary animate-fade-in-down">
                    <?php echo esc_html(get_post_meta(get_the_ID(), 'hero_subtitle', true) ?: 'Eccellenza Costruttiva'); ?>
                </h2>
                <h1
                    class="font-display font-bold text-4xl md:text-8xl uppercase tracking-tighter mb-8 animate-fade-in-up leading-none">
                    <?php the_title(); ?>
                </h1>
                <div class="w-16 md:w-24 h-1.5 bg-primary mx-auto mb-8 md:mb-10"></div>

                <p
                    class="text-gray-300 text-lg md:text-xl font-light tracking-wide max-w-2xl mx-auto animate-fade-in-up delay-200">
                    <?php echo esc_html(get_post_meta(get_the_ID(), 'hero_description', true) ?: 'Soluzioni integrate, dal concept alla consegna chiavi in mano.'); ?>
                </p>
            </div>
        </section>

        <!-- The Content rendering if admin fills something in block editor instead of static layout below -->
        <?php
        $content = get_the_content();
        if (!empty($content)) {
            echo '<div class="container py-12 prose prose-lg max-w-4xl mx-auto text-content-area">';
            the_content();
            echo '</div>';
        } else {
            ?>

            <!-- Service 1: Ristrutturazioni Complete -->
            <section class="relative min-h-0 md:min-h-[80vh] flex items-center py-16 md:py-0 bg-white border-b border-gray-100">
                <div class="container relative z-10 grid md:grid-cols-2 gap-12 md:gap-12 lg:gap-24 items-center">
                    <!-- Image Column -->
                    <div class="relative h-80 md:h-[600px] overflow-hidden scroll-reveal group shadow-2xl order-2 md:order-1">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110"
                            style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop');">
                        </div>
                    </div>

                    <!-- Text Column -->
                    <div class="text-left scroll-reveal px-6 md:px-0 order-1 md:order-2">
                        <span class="block text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-4">01 —
                            Servizio Core</span>
                        <h2
                            class="font-display text-3xl md:text-5xl lg:text-6xl font-bold uppercase text-secondary tracking-tighter leading-none mb-8">
                            Ristrutturazioni<br>Chiavi in Mano
                        </h2>
                        <p
                            class="text-gray-600 text-lg md:text-xl font-light leading-relaxed mb-8 border-l-4 border-primary pl-6">
                            Gestiamo il cantiere dalla demolizione alle finiture di pregio. Un unico referente per tutto il
                            processo costruttivo.
                        </p>
                        <ul class="space-y-4 mb-10 text-gray-600 font-medium list-disc list-inside marker:text-primary">
                            <li>Opere murarie e consolidamenti strutturali</li>
                            <li>Pavimentazioni, rivestimenti e resine</li>
                            <li>Cartongesso decorativo e controsoffitti</li>
                            <li>Assistenza post-consegna garantita</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contatti')); ?>"
                            class="inline-block group relative border border-black px-8 md:px-10 py-3 md:py-4 font-bold uppercase tracking-widest overflow-hidden hover:text-white transition-colors bg-transparent text-black text-sm md:text-base">
                            <span
                                class="absolute inset-0 w-full h-full bg-secondary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                            <span class="relative z-10">Richiedi Sopralluogo</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Service 2: Impiantistica -->
            <section
                class="relative min-h-0 md:min-h-[80vh] flex items-center py-16 md:py-0 bg-gray-50 border-b border-gray-100">
                <div class="container relative z-10 grid md:grid-cols-2 gap-12 md:gap-12 lg:gap-24 items-center">
                    <!-- Text Column (Left on Desktop) -->
                    <div class="text-left md:text-right scroll-reveal px-6 md:px-0">
                        <span class="block text-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-4">02 —
                            Tecnologia</span>
                        <h2
                            class="font-display text-3xl md:text-5xl lg:text-6xl font-bold uppercase text-secondary tracking-tighter leading-none mb-8">
                            Impiantistica &<br><span class="text-primary">Domotica</span>
                        </h2>
                        <p
                            class="text-gray-600 text-lg md:text-xl font-light leading-relaxed mb-8 border-l-4 md:border-l-0 md:border-r-4 border-primary pl-6 md:pl-0 md:pr-6">
                            Efficienza energetica e controllo intelligente. Progettiamo impianti certificati che rendono la tua
                            casa moderna, sicura e connessa.
                        </p>
                        <ul class="space-y-4 mb-10 text-gray-600 font-medium inline-block text-left md:text-right w-full">
                            <li class="flex items-center gap-2 justify-start md:justify-end">
                                <span class="hidden md:inline">Impianti Elettrici e Idraulici Certificati</span>
                                <div class="w-2 h-2 bg-primary rounded-full shrink-0"></div><span class="md:hidden">Impianti
                                    Elettrici e Idraulici Certificati</span>
                            </li>
                            <li class="flex items-center gap-2 justify-start md:justify-end">
                                <span class="hidden md:inline">Climatizzazione e Riscaldamento Radiante</span>
                                <div class="w-2 h-2 bg-primary rounded-full shrink-0"></div><span
                                    class="md:hidden">Climatizzazione e Riscaldamento Radiante</span>
                            </li>
                            <li class="flex items-center gap-2 justify-start md:justify-end">
                                <span class="hidden md:inline">Automazione Home Automation (IoT)</span>
                                <div class="w-2 h-2 bg-primary rounded-full shrink-0"></div><span class="md:hidden">Automazione
                                    Home Automation (IoT)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Image Column -->
                    <div class="relative h-80 md:h-[600px] overflow-hidden scroll-reveal group shadow-2xl">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110"
                            style="background-image: url('https://images.unsplash.com/photo-1558402529-d2638a7023e9?q=80&w=2070&auto=format&fit=crop');">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Expanded FAQ Section (from Servizi) -->
            <section class="py-16 md:py-24 bg-white">
                <div class="container max-w-4xl mx-auto px-6">
                    <h2
                        class="font-display text-3xl md:text-4xl font-bold uppercase mb-16 text-center text-secondary tracking-widest scroll-reveal">
                        Domande Frequenti
                    </h2>

                    <div class="space-y-4">
                        <details class="group bg-gray-50 rounded-lg overflow-hidden border border-gray-100 scroll-reveal">
                            <summary
                                class="flex justify-between items-center p-6 cursor-pointer font-bold text-lg text-secondary select-none group-hover:bg-gray-100 transition-colors">
                                <span>È previsto un sopralluogo gratuito?</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-180 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </span>
                            </summary>
                            <div class="p-6 pt-0 text-gray-600 leading-relaxed border-t border-gray-200 mt-2">
                                Sì, il primo sopralluogo è sempre gratuito e senza impegno.
                            </div>
                        </details>

                        <details class="group bg-gray-50 rounded-lg overflow-hidden border border-gray-100 scroll-reveal">
                            <summary
                                class="flex justify-between items-center p-6 cursor-pointer font-bold text-lg text-secondary select-none group-hover:bg-gray-100 transition-colors">
                                <span>Quali sono i tempi medi di una ristrutturazione?</span>
                                <span class="transform transition-transform duration-300 group-open:rotate-180 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </span>
                            </summary>
                            <div class="p-6 pt-0 text-gray-600 leading-relaxed border-t border-gray-200 mt-2">
                                Dipende dall'intervento. Una ristrutturazione completa di un appartamento di 100mq richiede
                                mediamente 90 giorni lavorativi.
                            </div>
                        </details>
                    </div>
                </div>
            </section>

        <?php } // End Fallback HTML ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>