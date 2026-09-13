<?php
/**
 * Template Name: User Dashboard
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $content = get_the_content();
                if (!empty(trim($content))) {
                    the_content();
                } else {
                    echo do_shortcode('[facilitypro_dashboard]');
                }
            endwhile;
        endif;
        ?>

    </div>
</div>

<?php
get_footer();
