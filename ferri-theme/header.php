<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

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

<body <?php body_class("font-sans text-secondary antialiased bg-gray-50 selection:bg-primary selection:text-white"); ?>>
    <?php wp_body_open(); ?>

    <!-- Header -->
    <header id="site-header"
        class="fixed w-full top-0 z-50 transition-all duration-500 ease-in-out bg-transparent <?php echo is_page_template('template-contatti.php') ? 'text-black' : 'text-white'; ?> [&.scrolled]:bg-white [&.scrolled]:text-black [&.scrolled]:shadow-md group [&.menu-active]:z-[70] [&.menu-active]:!bg-transparent [&.menu-active]:!shadow-none [&.menu-active]:!transition-none">
        <div
            class="container flex justify-between items-center h-20 md:h-[120px] transition-all duration-500 ease-in-out group-[.scrolled]:h-20">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>"
                class="flex flex-col leading-none group-[.scrolled]:text-black <?php echo is_page_template('template-contatti.php') ? 'text-black' : 'text-white'; ?> transition-all duration-500 origin-left group-[.scrolled]:scale-[0.9] relative z-10 group-[.menu-active]:!text-white scale-110 md:scale-125">
                <span class="text-2xl md:text-3xl font-display font-bold tracking-tighter uppercase">
                    <?php bloginfo('name'); ?>
                </span>
                <span class="text-xs md:text-sm tracking-[0.2em] uppercase font-light text-primary">
                    <?php bloginfo('description'); ?>
                </span>
            </a>

            <!-- Scrolled Center Icons (Phone & Mail) -->
            <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex gap-6 md:gap-8 opacity-0 group-[.scrolled]:opacity-100 transition-opacity duration-500 pointer-events-none group-[.scrolled]:pointer-events-auto group-[.menu-active]:!opacity-0 group-[.menu-active]:pointer-events-none group-[.menu-active]:!transition-none">
                <a href="tel:+391234567890"
                    class="text-black hover:text-primary transition-colors hover:scale-110 transform duration-300"
                    aria-label="Chiama Ora">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                </a>
                <a href="mailto:info@ferriristrutturazioni.it"
                    class="text-black hover:text-primary transition-colors hover:scale-110 transform duration-300"
                    aria-label="Invia Email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Fullscreen Menu Toggle -->
            <button id="mobile-menu-toggle"
                class="p-2 hover:text-primary transition-colors group relative z-[70] [&.menu-open]:text-white <?php echo is_page_template('template-contatti.php') ? 'text-black' : ''; ?>"
                aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="transition-transform duration-300 group-hover:scale-110 md:w-9 md:h-9">
                    <line x1="4" y1="6" x2="20" y2="6"
                        class="origin-center transition-transform duration-300 ease-in-out [.menu-open_&]:rotate-45 [.menu-open_&]:translate-y-[6px]">
                    </line>
                    <line x1="10" y1="12" x2="20" y2="12"
                        class="transition-opacity duration-300 ease-in-out [.menu-open_&]:opacity-0"></line>
                    <line x1="4" y1="18" x2="20" y2="18"
                        class="origin-center transition-transform duration-300 ease-in-out [.menu-open_&]:-rotate-45 [.menu-open_&]:-translate-y-[6px]">
                    </line>
                </svg>
            </button>
        </div>
    </header>

    <!-- Navigation Menu (Fullscreen Overlay) -->
    <div id="fullscreen-menu"
        class="fixed inset-0 bg-secondary z-[60] pt-24 px-6 transform translate-x-full flex flex-col items-center justify-center text-center text-white transition-transform duration-300">
        <nav
            class="flex flex-col gap-6 font-display text-4xl font-bold uppercase text-white mb-12 [&_ul]:flex [&_ul]:flex-col [&_ul]:gap-6 [&_li]:list-none [&_a]:text-white [&_a]:hover:text-primary [&_a]:transition-colors">
            <?php
            // Se esiste un menu assegnato a 'menu-1' lo mostra, in caso contrario 
            // crea un elenco fallback usando l'output standard di `wp_list_pages` o link HTML
            if (has_nav_menu('menu-1')) {
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'fallback_cb' => false,
                ));
            } else {
                // Fallback statico per visibilità immediata prima del setup su WP
                ?>
                <ul class="flex flex-col gap-6">
                    <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Chi Siamo</a></li>
                    <li><a href="<?php echo esc_url(home_url('/servizi')); ?>">Servizi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/progetti')); ?>">Progetti</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contatti')); ?>">Contatti</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>

        <!-- Contatti rapidi nel menu -->
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 text-white/70 font-light text-lg">
            <a href="tel:+391234567890" class="hover:text-primary transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-white">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg>
                <span>+39 123 456 7890</span>
            </a>
            <a href="mailto:info@ferriristrutturazioni.it"
                class="hover:text-primary transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-white">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <span>info@ferriristrutturazioni.it</span>
            </a>
        </div>
    </div>

    <!-- Main Content wrapper starts here -->
    <main>