<?php
/**
 * Ferri Ristrutturazioni functions and definitions
 */

if ( ! function_exists( 'ferri_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function ferri_theme_setup() {
		// Aggiunge feed RSS automatici per post e commenti nella head.
		add_theme_support( 'automatic-feed-links' );

		// Lascia a WordPress la gestione del tag <title>.
		add_theme_support( 'title-tag' );

		// Abilita il supporto alle Immagini in Evidenza (Post Thumbnails).
		add_theme_support( 'post-thumbnails' );

		// Registra il menu di navigazione principale.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Principale', 'ferri-theme' ),
			)
		);

		// Supporto HTML5 per i moduli di ricerca, commenti, gallerie ecc.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'ferri_theme_setup' );

/**
 * Accoda gli Script e gli Stili necessari al tema.
 */
function ferri_theme_scripts() {
	// 1. Tailwind CSS via CDN (mantenuto per fedeltà al progetto statico)
	wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false );
    
    // 2. Aggiunge la configurazione JS inline di Tailwind
    $tailwind_config = "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6EC1E4',
                        secondary: 'rgb(40, 41, 43)',
                        accent: '#61CE70',
                        dark: '#000000',
                        highlight: '#FFBC7D',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Oswald', 'sans-serif'],
                    },
                    container: {
                        center: true,
                        padding: '1rem',
                        screens: {
                            '2xl': '1300px',
                        },
                    },
                }
            }
        }
    ";
    wp_add_inline_script('tailwindcss', $tailwind_config, 'after');

	// 3. Custom CSS
	wp_enqueue_style( 'ferri-theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), wp_get_theme()->get( 'Version' ) );

	// 4. Custom JS
	wp_enqueue_script( 'ferri-theme-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'ferri_theme_scripts' );
