# Ferri Ristrutturazioni - WordPress Migration Guide

Questa guida fornisce le istruzioni per convertire il codice statico HTML/Tailwind generato in un tema WordPress funzionale.

## Struttura Tema (Starter)

Crea una cartella `ferri-ristrutturazioni` in `wp-content/themes/` con i seguenti file minimi:
- `style.css` (Meta informazioni tema)
- `index.php` (Template principale)
- `header.php` (Testata)
- `footer.php` (Piè di pagina)
- `functions.php` (Logica setup)
- `front-page.php` (Template Homepage - copia di `index.html`)
- `home.php` (Template Blog/Progetti - copia di `progetti.html`)

## Configurazione Iniziale WordPress
1. Crea due pagine vuote in WP Admin:
   - **Home** (che userà `front-page.php`)
   - **Progetti** (che userà `home.php`)
2. Vai su **Impostazioni > Lettura**:
   - Seleziona "La tua homepage mostra: Una pagina statica"
   - **Homepage**: Seleziona "Home"
   - **Pagina articoli**: Seleziona "Progetti"

## Mappatura Componenti

### Header (`header.php`)
Copia il contenuto del tag `<header>` dal file `index.html`.
- **Sostituisci** i percorsi immagine (`src="assets/..."`) con `<?php echo get_template_directory_uri(); ?>/assets/...`.
- **Inserisci** `<?php wp_head(); ?>` prima di `</head>`.
- **Sostituisci** il menu statico con `wp_nav_menu()`.

### Footer (`footer.php`)
Copia il contenuto del tag `<footer>` dal file `index.html`.
- **Inserisci** `<?php wp_footer(); ?>` prima di `</body>`.
- **Dinamizza** l'anno di copyright: `<?php echo date('Y'); ?>`.

### Homepage (`front-page.php`)
Copia il contenuto di `<main>` dal file `index.html`. Questo sarà il template per la tua Homepage statica.
- Usa [ACF](https://www.advancedcustomfields.com/) per rendere modificabili i testi (Headline, PSA, Servizi).
- Esempio: `<h1><?php the_field('hero_headline'); ?></h1>`.

### Pagina Progetti (`home.php`)
Il contenuto di `progetti.html` diventa il template `home.php` (che WP usa automaticamente per la pagina assegnata come "Pagina articoli").

**Struttura del Loop:**
```php
<!-- Slider Container -->
<div id="projects-slider" class="absolute inset-0 w-full h-full">
    <?php 
    $i = 0; 
    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $active_class = ($i === 0) ? 'active' : ''; 
        $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $category = get_the_category(); 
        $cat_name = !empty($category) ? $category[0]->name : 'Progetto';
    ?>
    
    <!-- Single Slide (Post) -->
    <div class="slide <?php echo $active_class; ?> absolute inset-0 w-full h-full">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image: url('<?php echo $bg_image; ?>');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>

        <!-- Content -->
        <div class="container relative h-full flex items-center px-6 z-10">
            <div class="max-w-2xl slide-content">
                <span class="inline-block py-1 px-3 border border-primary text-primary text-xs font-bold tracking-widest uppercase mb-6">
                    <?php echo $cat_name; ?>
                </span>
                <h1 class="font-display font-bold text-5xl md:text-7xl lg:text-8xl text-white uppercase leading-none mb-6">
                    <?php the_title(); ?>
                </h1>
                <div class="text-gray-300 text-lg md:text-xl font-light mb-10 max-w-lg leading-relaxed">
                    <?php the_excerpt(); ?>
                </div>
                <!-- Link al singolo progetto (single.php) -->
                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-4 text-white hover:text-primary transition-colors group">
                    <span class="font-bold uppercase tracking-widest text-sm border-b border-white group-hover:border-primary pb-1">
                        Scopri il Progetto
                    </span>
                    <!-- Icona Freccia... -->
                </a>
            </div>
        </div>
    </div>
    
    <?php $i++; endwhile; endif; ?>
</div>

<!-- Slider Controls & Logic -->
<!-- Mantieni i controlli HTML e il JS. Per il JS, dovrai passare il numero totale di slide via PHP se necessario, o lasciarlo calcolare al DOM. -->
```

## Asset Management (`functions.php`)

```php
function ferri_scripts() {
    // Tailwind CSS (presunto compilato in style.css o main.css)
    wp_enqueue_style('ferri-style', get_stylesheet_uri());
    
    // Main JS
    wp_enqueue_script('ferri-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'ferri_scripts');
```

## Tips per l'Integrazione
- **Tailwind**: Assicurati che le classi Tailwind siano mantenute. Se usi un builder (es. WPCode), copia l'HTML grezzo in blocchi HTML personalizzati.
- **Menu**: Registra i menu in `functions.php` (`register_nav_menus`).
- **Immagini**: Usa `the_post_thumbnail()` per le immagini dinamiche.
- **Permalink**: Usa `the_permalink()` per collegare le card/slide alla pagina di dettaglio (`single.php`).
