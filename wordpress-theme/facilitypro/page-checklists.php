<?php
/**
 * Template Name: Checklists
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
                    ?>
                    <div class="mb-8 text-center max-w-3xl mx-auto">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                            <i data-lucide="check-square" class="w-4 h-4"></i>
                            <span>Preventive Maintenance</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                            MEP Plant Inspection & Audit Checklists
                        </h1>
                        <p class="mt-2 text-base text-slate-600">
                            Execute daily, weekly, and monthly statutory audit logs. Live progress tracking with immediate AI troubleshooting for failed check items.
                        </p>
                    </div>
                    <?php
                    echo do_shortcode('[facilitypro_checklists]');
                }
            endwhile;
        endif;
        ?>

    </div>
</div>

<?php
get_footer();
