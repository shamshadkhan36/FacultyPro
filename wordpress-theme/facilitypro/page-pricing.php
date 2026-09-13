<?php
/**
 * Template Name: Pricing Plans
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-16 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $content = get_the_content();
                if (!empty(trim($content))) {
                    the_content();
                } else {
                    ?>
                    <div class="mb-12 text-center max-w-3xl mx-auto">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                            <i data-lucide="zap" class="w-4 h-4"></i>
                            <span>Transparent Engineering Pricing</span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
                            Point-to-Point MEP Solutions at Plant Speed
                        </h1>
                        <p class="mt-4 text-base sm:text-lg text-slate-600">
                            Solve urgent breakdowns for ₹199 or empower your engineering team with unlimited AI consultations for ₹399/month.
                        </p>
                    </div>
                    <?php
                    echo do_shortcode('[facilitypro_pricing]');
                }
            endwhile;
        endif;
        ?>

    </div>
</div>

<?php
get_footer();
