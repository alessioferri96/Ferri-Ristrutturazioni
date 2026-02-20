<?php
/**
 * Il file template principale
 *
 * Questo è il file generico più importante in un tema WordPress
 * ed è uno dei due file richiesti per un tema (l'altro è style.css).
 * Viene usato per visualizzare una pagina quando nulla di più specifico corrisponde.
 */

get_header(); ?>

<main id="primary" class="site-main pt-24 pb-12 bg-gray-50 min-h-screen">
    <div class="container px-6 max-w-4xl mx-auto">
        <?php
        if (have_posts()):

            /* Start the Loop */
            while (have_posts()):
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12 bg-white shadow-xl p-8 md:p-12'); ?>>
                    <header class="entry-header mb-6">
                        <?php
                        if (is_singular()):
                            the_title('<h1 class="font-display text-3xl md:text-5xl font-bold uppercase text-secondary mb-4">', '</h1>');
                        else:
                            the_title('<h2 class="font-display text-2xl md:text-4xl font-bold uppercase text-secondary mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark" class="hover:text-primary transition-colors">', '</a></h2>');
                        endif;

                        if ('post' === get_post_type()):
                            ?>
                            <div class="entry-meta text-sm text-gray-500 font-bold tracking-widest uppercase">
                                <?php
                                echo get_the_date();
                                ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <?php if (has_post_thumbnail() && !is_singular()): ?>
                        <div class="mb-6 aspect-video overflow-hidden">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                            </a>
                        </div>
                    <?php endif; ?>

                    <div
                        class="entry-content prose prose-lg prose-headings:font-display prose-headings:text-secondary max-w-none text-gray-600">
                        <?php
                        if (is_singular()) {
                            the_content();
                        } else {
                            the_excerpt();
                            echo '<a href="' . esc_url(get_permalink()) . '" class="inline-block mt-4 text-primary font-bold uppercase tracking-widest text-sm hover:underline">Leggi di più</a>';
                        }
                        ?>
                    </div>
                </article>
                <?php
            endwhile;

            // Paginazione
            the_posts_navigation(array(
                'prev_text' => '← Precedenti',
                'next_text' => 'Successivi →',
            ));

        else:
            ?>
            <section class="no-results not-found bg-white shadow-xl p-8 md:p-12 text-center">
                <header class="page-header mb-6">
                    <h1 class="font-display text-3xl md:text-5xl font-bold uppercase text-secondary">Nessun Risultato</h1>
                </header>
                <div class="page-content text-gray-600">
                    <p class="mb-6">Sembra che non siamo riusciti a trovare ciò che stai cercando. Forse la ricerca può
                        aiutare.</p>
                    <?php get_search_form(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>