<?php
/**
 * Main Template File
 *
 * @package FacilityPro
 */

get_header(); ?>

<main id="primary" class="site-main max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-4 mb-8'); ?>>
                <h1 class="text-3xl font-black text-slate-900"><?php the_title(); ?></h1>
                <div class="prose max-w-none text-slate-700 text-sm leading-relaxed">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-200">
            <h2 class="text-2xl font-bold text-slate-800">No Content Found</h2>
            <p class="text-slate-500 text-sm mt-2">The requested page or post does not exist.</p>
        </div>
        <?php
    endif;
    ?>
</main>

<?php get_footer(); ?>
