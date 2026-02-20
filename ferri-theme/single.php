<?php
/**
 * L'articolo singolo / Dettaglio Progetto
 *
 * Utilizzato per i post singoli standard (es. progetti o news)
 */
get_header(); ?>

<main id="primary" class="site-main">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section -->
        <section
            class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-secondary text-white pt-32 pb-20">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop'; ?>');">
            </div>
            <div class="absolute inset-0 bg-black/60 z-10"></div>

            <div class="container relative z-20 text-center px-6">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<span class="inline-block py-1 px-3 border border-primary text-primary text-xs font-bold tracking-widest uppercase mb-6">' . esc_html($categories[0]->name) . '</span>';
                }
                ?>
                <h1
                    class="font-display font-bold text-4xl md:text-6xl text-white uppercase leading-none mb-6 animate-fade-in-up">
                    <?php the_title(); ?>
                </h1>
                <div class="w-16 h-1.5 bg-primary mx-auto mb-6"></div>
                <?php if (has_excerpt()): ?>
                    <p
                        class="text-gray-300 text-lg md:text-xl font-light tracking-wide max-w-2xl mx-auto animate-fade-in-up delay-200">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Content -->
        <section class="py-24 bg-white">
            <div
                class="container px-6 max-w-4xl mx-auto text-content-area prose prose-lg prose-headings:font-display prose-headings:uppercase prose-headings:text-secondary prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
                <?php the_content(); ?>
            </div>
        </section>

        <!-- Navigation tra post -->
        <section class="bg-gray-50 border-t border-gray-200 py-12">
            <div
                class="container px-6 max-w-4xl mx-auto flex justify-between items-center text-sm font-bold uppercase tracking-widest">
                <div class="nav-previous w-1/2 overflow-hidden text-ellipsis whitespace-nowrap pr-4">
                    <?php previous_post_link('%link', '← Costruzione Precedente'); ?>
                </div>
                <div class="nav-next w-1/2 text-right overflow-hidden text-ellipsis whitespace-nowrap pl-4">
                    <?php next_post_link('%link', 'Prossimo Progetto →'); ?>
                </div>
            </div>
        </section>

    <?php endwhile; // End of the loop. ?>

</main>

<?php get_footer(); ?>