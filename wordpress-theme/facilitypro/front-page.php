<?php
/**
 * FacilityPro Front Page Template
 *
 * @package FacilityPro
 */

get_header(); ?>

<main id="primary" class="site-main">

<?php
echo do_shortcode('[facilitypro_hero]');
echo do_shortcode('[facilitypro_category_pills]');
echo do_shortcode('[facilitypro_popular_questions]');
echo do_shortcode('[facilitypro_how_it_works]');
echo do_shortcode('[facilitypro_experts]');
echo do_shortcode('[facilitypro_why_choose_us]');
echo do_shortcode('[facilitypro_pricing]');
?>

</main>

<?php get_footer(); ?>
