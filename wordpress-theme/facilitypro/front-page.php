<?php
/**
 * FacilityPro Front Page Template
 *
 * Fully editable via WordPress Block Editor (Gutenberg) & Customizer
 *
 * @package FacilityPro
 */

get_header(); ?>

<main id="primary" class="site-main">

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        $content = get_the_content();
        if (!empty(trim($content))) :
            the_content();
        else :
            echo do_shortcode('[facilitypro_hero]');
            echo do_shortcode('[facilitypro_category_pills]');
            echo do_shortcode('[facilitypro_popular_questions]');
            echo do_shortcode('[facilitypro_how_it_works]');
            echo do_shortcode('[facilitypro_experts]');
            echo do_shortcode('[facilitypro_why_choose_us]');
            echo do_shortcode('[facilitypro_pricing]');
        endif;
    endwhile;
else :
    echo do_shortcode('[facilitypro_hero]');
    echo do_shortcode('[facilitypro_category_pills]');
    echo do_shortcode('[facilitypro_popular_questions]');
    echo do_shortcode('[facilitypro_how_it_works]');
    echo do_shortcode('[facilitypro_experts]');
    echo do_shortcode('[facilitypro_why_choose_us]');
    echo do_shortcode('[facilitypro_pricing]');
endif;
?>

</main>

<?php get_footer(); ?>
