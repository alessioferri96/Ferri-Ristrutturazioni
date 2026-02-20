<?php
/**
 * Template per la pagina 404
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Oswald:wght@400;500;700&display=swap"
        rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class("font-sans text-secondary antialiased bg-gray-50 h-screen overflow-hidden flex flex-col selection:bg-primary selection:text-white"); ?>>
    <?php wp_body_open(); ?>

    <!-- Header Minimal (Logo Only) -->
    <header class="absolute top-0 left-0 w-full p-6 md:p-10 z-10">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col leading-none text-black w-fit">
            <span class="text-2xl md:text-3xl font-display font-bold tracking-tighter uppercase">
                <?php bloginfo('name'); ?>
            </span>
            <span class="text-xs md:text-sm tracking-[0.2em] uppercase font-light text-primary">
                <?php bloginfo('description'); ?>
            </span>
        </a>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center relative">

        <!-- Background Decor (Blueprint/Construction lines) -->
        <div class="absolute inset-0 opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#6EC1E4 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        <div class="container relative z-10 px-6 text-center">

            <!-- Animated Icon (Helmet/Tool) -->
            <div class="mb-8 inline-block animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="text-primary">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
            </div>

            <h1 class="font-display font-bold text-9xl text-gray-200 leading-none select-none">404</h1>
            <h2 class="font-display font-bold text-3xl md:text-4xl uppercase text-secondary mb-6 -mt-8 relative z-20">
                Progetto Inesistente</h2>

            <p class="text-gray-500 text-lg md:text-xl font-light mb-10 max-w-lg mx-auto leading-relaxed">
                Sembra che tu abbia cercato un muro portante che non esiste. <br>
                Questa pagina non è mai stata costruita o è stata demolita.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="group relative bg-secondary text-white font-bold uppercase px-8 py-4 overflow-hidden shadow-lg hover:shadow-xl transition-all tracking-widest text-sm">
                    <span
                        class="absolute inset-0 w-full h-full bg-primary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                    <span class="relative z-10">Torna in Home</span>
                </a>

                <a href="<?php echo esc_url(home_url('/progetti')); ?>"
                    class="group relative border border-secondary text-secondary font-bold uppercase px-8 py-4 overflow-hidden hover:text-white transition-colors tracking-widest text-sm">
                    <span
                        class="absolute inset-0 w-full h-full bg-secondary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                    <span class="relative z-10 flex items-center gap-2">
                        Vedi i Progetti
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </main>

    <!-- Simple Footer Copyright -->
    <footer class="p-6 text-center text-xs text-gray-400">
        &copy;
        <?php echo date('Y'); ?>
        <?php bloginfo('name'); ?>.
    </footer>

    <?php wp_footer(); ?>
</body>

</html>