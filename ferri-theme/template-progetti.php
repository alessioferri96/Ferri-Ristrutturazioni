<?php
/**
 * Template Name: Progetti (Slider)
 */
get_header(); ?>

<style>
    /* Slider Transitions */
    .slide {
        opacity: 0;
        transition: opacity 1s ease-in-out;
        pointer-events: none;
    }

    .slide.active {
        opacity: 1;
        pointer-events: auto;
    }

    .slide-content {
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.8s ease-out 0.3s;
    }

    .slide.active .slide-content {
        transform: translateY(0);
        opacity: 1;
    }
</style>

<main class="relative h-[100dvh] w-full bg-secondary overflow-hidden">

    <!-- Slider Container -->
    <div id="projects-slider" class="absolute inset-0 w-full h-full">

        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5, // Limite per lo slider
            // Se si usa un Custom Post Type 'progetti', decommentare la linea sotto e commentare la riga sopra
            // 'post_type'      => 'progetti',
        );
        $projects_query = new WP_Query($args);
        $slide_count = 0;
        $thumbnails = array();

        if ($projects_query->have_posts()):
            while ($projects_query->have_posts()):
                $projects_query->the_post();

                $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop';
                $thumbnails[] = $thumb_url; // Save for Quick Nav Thumbs
        
                $categories = get_the_category();
                $cat_name = !empty($categories) ? $categories[0]->name : 'Progetto';

                $active_class = ($slide_count === 0) ? 'active' : '';
                ?>

                <!-- Slide -->
                <div class="slide <?php echo esc_attr($active_class); ?> absolute inset-0 w-full h-full">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('<?php echo esc_url($thumb_url); ?>');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                    <div class="container relative h-full flex items-center px-6 z-10">
                        <div class="max-w-2xl slide-content">
                            <span
                                class="inline-block py-1 px-3 border border-primary text-primary text-xs font-bold tracking-widest uppercase mb-6">
                                <?php echo esc_html($cat_name); ?>
                            </span>
                            <h1
                                class="font-display font-bold text-5xl md:text-7xl lg:text-8xl text-white uppercase leading-none mb-6">
                                <?php the_title(); ?>
                            </h1>
                            <p class="text-gray-300 text-lg md:text-xl font-light mb-10 max-w-lg leading-relaxed">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>"
                                class="inline-flex items-center gap-4 text-white hover:text-primary transition-colors group">
                                <span
                                    class="font-bold uppercase tracking-widest text-sm border-b border-white group-hover:border-primary pb-1">Scopri
                                    il Progetto</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="transform group-hover:translate-x-2 transition-transform">
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <polyline points="12 5 19 12 12 19" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $slide_count++;
            endwhile;
        else:
            ?>
            <!-- Fallback Slide se non ci sono post -->
            <div class="slide active absolute inset-0 w-full h-full">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop');">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                <div class="container relative h-full flex items-center px-6 z-10">
                    <div class="max-w-2xl slide-content">
                        <span
                            class="inline-block py-1 px-3 border border-primary text-primary text-xs font-bold tracking-widest uppercase mb-6">Residenziale</span>
                        <h1
                            class="font-display font-bold text-5xl md:text-7xl lg:text-8xl text-white uppercase leading-none mb-6">
                            Villa<br>Belvedere
                        </h1>
                        <p class="text-gray-300 text-lg md:text-xl font-light mb-10 max-w-lg leading-relaxed">
                            Aggiungi il tuo primo progetto (post) da WordPress per visualizzarlo qui.
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $slide_count = 1; // fake one for JS
        endif;

        wp_reset_postdata();
        ?>

    </div>

    <!-- Slider Controls -->
    <?php if ($slide_count > 1): ?>
        <div class="absolute bottom-10 right-10 md:right-20 flex items-center gap-6 z-20">
            <button id="prev-slide"
                class="text-white hover:text-primary transition-colors p-2 border border-white/20 rounded-full hover:border-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>
            <div class="text-white font-display text-xl tracking-widest">
                <span id="current-slide">01</span><span class="text-white/40 mx-2">/</span><span id="total-slides">
                    <?php echo sprintf('%02d', $slide_count); ?>
                </span>
            </div>
            <button id="next-slide"
                class="text-white hover:text-primary transition-colors p-2 border border-white/20 rounded-full hover:border-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </div>

        <!-- Quick Nav Strip (Bottom Left Overlay) -->
        <div class="absolute bottom-10 left-6 md:left-20 z-20 hidden md:block">
            <div class="flex gap-4">
                <?php foreach ($thumbnails as $index => $thumb): ?>
                    <button
                        class="w-20 h-16 bg-cover bg-center border-2 cursor-pointer transition-transform hover:scale-110 shadow-lg <?php echo $index === 0 ? 'border-primary' : 'border-transparent opacity-70 hover:border-primary hover:opacity-100'; ?>"
                        style="background-image: url('<?php echo esc_url($thumb); ?>');"
                        onclick="if(window.slider) window.slider.goTo(<?php echo esc_attr($index); ?>)"></button>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</main>

<!-- Contact Strip Footer Like Layout (from progetti.html) -->
<footer class="bg-white text-black relative z-30">
    <section id="contact-form-section" class="relative py-24 bg-fixed bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="container relative z-10">
            <div class="max-w-4xl mx-auto text-center mb-16 scroll-reveal">
                <h3 class="font-display text-5xl font-bold uppercase mb-8 tracking-widest text-white">Contatti</h3>
                <p class="text-gray-200 text-xl leading-relaxed font-light max-w-2xl mx-auto">
                    Mettiamo in campo vasta esperienza e competenza. Per noi è fondamentale che tu possa contare su
                    di noi in ogni fase del processo e oltre.
                </p>
                <a href="<?php echo esc_url(home_url('/contatti')); ?>"
                    class="mt-8 inline-block group relative bg-transparent border border-white text-white font-bold uppercase px-12 py-5 overflow-hidden hover:text-secondary transition-colors duration-300 tracking-widest text-sm shadow-xl">
                    <span
                        class="absolute inset-0 w-full h-full bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                    <span class="relative z-10">Vai ai contatti</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Get Standard Footer Content manually or just call a secondary get_footer that overrides header logic? -->
    <!-- Well, the normal WP footer has standard blocks, but this one hides standard elements in static site? -->
    <!-- No, in static site standard footer navigation is used. Let's just output the standard wp_footer block. -->
    <?php
    // Instead of hardcoding standard footer, I will just call get_footer() but pass a specific partial if needed.
// For now, I'll close the main footer wrapper and call get_footer.
// But we actually created footer.php. To inject this stripe BEFORE footer.php content, I put it here.
    ?>

    <script>
        // Inline script for Projects page specific logic (Slider)
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slide');
            const thumbs = document.querySelectorAll('.absolute.bottom-10.left-6 button'); // Quick Nav Thumbs
            const prevBtn = document.getElementById('prev-slide');
            const nextBtn = document.getElementById('next-slide');
            const currentCounter = document.getElementById('current-slide');
            const totalCounter = document.getElementById('total-slides');

            if (slides.length <= 1) return;

            let currentIndex = 0;
            const totalSlides = slides.length;

            function updateSlider(index) {
                // Bounds check
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;

                currentIndex = index;

                // Update Active Slide
                slides.forEach((slide, i) => {
                    if (i === currentIndex) {
                        slide.classList.add('active');
                    } else {
                        slide.classList.remove('active');
                    }
                });

                // Update Thumbs active state
                if (thumbs) {
                    thumbs.forEach((thumb, i) => {
                        if (i === currentIndex) {
                            thumb.classList.add('border-primary');
                            thumb.classList.remove('border-transparent', 'opacity-70');
                        } else {
                            thumb.classList.remove('border-primary');
                            thumb.classList.add('border-transparent', 'opacity-70');
                        }
                    });
                }

                // Update Counter
                if (currentCounter) {
                    currentCounter.textContent = String(currentIndex + 1).padStart(2, '0');
                }
            }

            // Public method for onclick
            window.slider = {
                goTo: (index) => updateSlider(index)
            };

            // Events
            if (nextBtn) nextBtn.addEventListener('click', () => updateSlider(currentIndex + 1));
            if (prevBtn) prevBtn.addEventListener('click', () => updateSlider(currentIndex - 1));

            // Optional Autoplay
            let autoplayInterval = setInterval(() => updateSlider(currentIndex + 1), 8000);

            // Pause on interaction
            const stopAutoplay = () => clearInterval(autoplayInterval);
            if (nextBtn) nextBtn.addEventListener('click', stopAutoplay);
            if (prevBtn) prevBtn.addEventListener('click', stopAutoplay);
            if (thumbs) thumbs.forEach(btn => btn.addEventListener('click', stopAutoplay));
        });
    </script>

    <?php get_footer(); ?>