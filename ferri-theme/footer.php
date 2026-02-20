</main>

<footer class="bg-white text-black border-t border-gray-200">
    <!-- Top Section: Contact Form & Info (Strict Scape Parallax Style) -->
    <section id="contact-form-section" class="relative py-24 bg-fixed bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/70"></div> <!-- Dark Overlay for Contrast -->
        <div class="container relative z-10">
            <div class="max-w-4xl mx-auto text-center mb-16 scroll-reveal">
                <h3 class="font-display text-5xl font-bold uppercase mb-8 tracking-widest text-white">Contatti</h3>
                <p class="text-gray-200 text-xl leading-relaxed font-light max-w-2xl mx-auto">
                    Mettiamo in campo vasta esperienza e competenza. Per noi è fondamentale che tu possa contare su
                    di noi in ogni fase del processo e oltre.
                </p>
            </div>

            <div class="max-w-3xl mx-auto scroll-reveal" style="transition-delay: 200ms;">
                <!-- Shortcode per modulo di contatto dinamico -->
                <?php
                echo do_shortcode('[contact-form-7 id="1" title="Modulo di contatto 1"]');
                ?>

                <!-- Fallback Struttura HTML originale (commentata per referenza nella creazione del form su WP) -->
                <!--
                    <form class="space-y-8">
                        <div class="grid md:grid-cols-2 gap-12">
                            <div class="relative group">
                                <label class="sr-only" for="name">Nome</label>
                                <input type="text" id="name" class="w-full bg-transparent border-b border-white/50 pt-4 pb-2 text-white placeholder-gray-300 focus:outline-none focus:border-white transition-colors text-lg" placeholder="Nome">
                            </div>
                            <div class="relative group">
                                <label class="sr-only" for="phone">Telefono</label>
                                <input type="text" id="phone" class="w-full bg-transparent border-b border-white/50 pt-4 pb-2 text-white placeholder-gray-300 focus:outline-none focus:border-white transition-colors text-lg" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="relative group">
                            <label class="sr-only" for="email">Email</label>
                            <input type="email" id="email" class="w-full bg-transparent border-b border-white/50 pt-4 pb-2 text-white placeholder-gray-300 focus:outline-none focus:border-white transition-colors text-lg" placeholder="Indirizzo Email">
                        </div>
                        <div class="relative group">
                            <label class="sr-only" for="message">Messaggio</label>
                            <textarea id="message" class="w-full bg-transparent border-b border-white/50 pt-4 pb-2 text-white placeholder-gray-300 focus:outline-none focus:border-white transition-colors resize-none text-lg" rows="2" placeholder="Come possiamo aiutarti?"></textarea>
                        </div>
                        <div class="relative group flex items-start gap-3 mt-4 text-left">
                            <input type="checkbox" id="privacy-footer" class="mt-1 w-4 h-4 appearance-none border border-white/50 checked:bg-white checked:border-white transition-colors cursor-pointer relative after:content-['✓'] after:absolute after:text-secondary after:text-xs after:top-1/2 after:left-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:opacity-0 checked:after:opacity-100">
                            <label for="privacy-footer" class="text-sm text-gray-300 font-light leading-tight cursor-pointer select-none">Ho letto e accetto la Privacy Policy e acconsento al trattamento dei dati personali.</label>
                        </div>
                        <div class="pt-8 text-center">
                            <button type="submit" class="group relative bg-transparent border border-white text-white font-bold uppercase px-12 py-5 overflow-hidden hover:text-secondary transition-colors duration-300 tracking-widest text-sm shadow-xl"><span class="absolute inset-0 w-full h-full bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span><span class="relative z-10">Invia</span></button>
                        </div>
                    </form>
                    -->
            </div>
        </div>
    </section>

    <!-- Middle Section: Navigation & CTA -->
    <section class="py-12 border-b border-gray-200">
        <div class="container flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Logo -->
            <div class="w-48 text-center md:text-left transform scale-125 origin-center md:origin-left">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="flex flex-col leading-none text-black transition-all duration-500">
                    <span class="text-2xl md:text-3xl font-display font-bold tracking-tighter uppercase">
                        <?php bloginfo('name'); ?>
                    </span>
                    <span class="text-xs md:text-sm tracking-[0.2em] uppercase font-light text-primary">
                        <?php bloginfo('description'); ?>
                    </span>
                </a>
            </div>
            <!-- Navigation -->
            <nav
                class="flex flex-wrap justify-center gap-8 font-bold uppercase text-sm tracking-widest text-gray-600 [&_ul]:flex [&_ul]:flex-wrap [&_ul]:gap-8 [&_li]:list-none [&_a]:text-gray-600 [&_a]:hover:text-primary [&_a]:transition-colors">
                <?php
                // Usiamo lo stesso menu principale anche qui.
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'fallback_cb' => false,
                ));
                ?>
            </nav>
            <!-- CTA -->
            <div>
                <a href="tel:+391234567890"
                    class="inline-block group relative border border-black px-6 py-3 font-bold uppercase text-xs tracking-widest overflow-hidden hover:text-white transition-colors bg-transparent text-black">
                    <span
                        class="absolute inset-0 w-full h-full bg-secondary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                    <span class="relative z-10">Chiama Ora</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Accreditations Section (from Index) -->
    <section class="py-12 bg-white">
        <div class="container flex flex-wrap justify-center items-center gap-12 opacity-80">
            <div
                class="flex items-center gap-2 border-2 border-gray-200 px-4 py-2 rounded grayscale hover:grayscale-0 transition-all">
                <div class="font-bold text-gray-400 text-xl">SSIP</div>
                <div class="text-[0.6rem] uppercase font-bold text-gray-500 leading-tight">Safety<br>Schemes</div>
            </div>
            <div
                class="flex items-center gap-2 border-2 border-gray-200 px-4 py-2 rounded grayscale hover:grayscale-0 transition-all">
                <div class="font-bold text-gray-400 text-xl">ISO</div>
                <div class="text-[0.6rem] uppercase font-bold text-gray-500 leading-tight">9001<br>14001</div>
            </div>
            <div
                class="flex items-center gap-2 border-2 border-gray-200 px-4 py-2 rounded grayscale hover:grayscale-0 transition-all">
                <div class="font-bold text-gray-400 text-xl">Safe</div>
                <div class="text-[0.6rem] uppercase font-bold text-gray-500 leading-tight">Contractor<br>Approved</div>
            </div>
        </div>
    </section>

    <!-- Copyright Section -->
    <section class="py-6 bg-white border-t border-gray-200">
        <div class="container flex flex-col md:flex-row justify-between items-center text-xs text-gray-600 gap-4">
            <p>&copy;
                <?php echo date('Y'); ?>
                <?php bloginfo('name'); ?>. P.IVA 12345678901. Tutti i diritti riservati.
            </p>
            <div class="flex gap-6">
                <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"
                    class="hover:text-primary transition-colors">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/cookie-policy')); ?>"
                    class="hover:text-primary transition-colors">Cookie Policy</a>
                <div class="flex gap-4 border-l border-gray-300 pl-6 ml-2">
                    <a href="#" class="hover:text-primary transition-colors" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                            </path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </a>
                    <a href="#" class="hover:text-primary transition-colors" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</footer>

<?php wp_footer(); ?>
</body>

</html>