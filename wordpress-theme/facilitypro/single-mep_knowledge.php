<?php
/**
 * Single Template for Knowledge Hub Articles (mep_knowledge)
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-4xl mx-auto space-y-8">
        
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $post_id    = get_the_ID();
                $discipline = get_post_meta($post_id, 'kb_discipline', true);
                if (empty($discipline)) {
                    $t = strtolower(get_the_title());
                    if (strpos($t, 'hvac') !== false || strpos($t, 'chiller') !== false || strpos($t, 'duct') !== false) $discipline = 'hvac';
                    elseif (strpos($t, 'elec') !== false || strpos($t, 'transformer') !== false || strpos($t, 'volt') !== false) $discipline = 'electrical';
                    elseif (strpos($t, 'fire') !== false || strpos($t, 'sprinkler') !== false) $discipline = 'firefighting';
                    elseif (strpos($t, 'plumb') !== false || strpos($t, 'water hammer') !== false || strpos($t, 'pump') !== false || strpos($t, 'drain') !== false) $discipline = 'plumbing';
                    elseif (strpos($t, 'paint') !== false || strpos($t, 'epoxy') !== false) $discipline = 'painting';
                    elseif (strpos($t, 'solar') !== false || strpos($t, 'pv') !== false) $discipline = 'solar';
                    elseif (strpos($t, 'bms') !== false || strpos($t, 'bacnet') !== false) $discipline = 'bms';
                    elseif (strpos($t, 'stp') !== false || strpos($t, 'mbr') !== false || strpos($t, 'sewage') !== false) $discipline = 'stp';
                    elseif (strpos($t, 'dg') !== false || strpos($t, 'generator') !== false) $discipline = 'dg';
                    else $discipline = 'hvac';
                }
                $code_ref   = get_post_meta($post_id, 'kb_code_ref', true);
                if (empty($code_ref)) $code_ref = 'ASHRAE / NBC 2016';
                
                $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
                if (empty($thumb_url)) {
                    $t_lower = strtolower(get_the_title());
                    if ($discipline === 'hvac') {
                        $thumb_url = (strpos($t_lower, 'duct') !== false || strpos($t_lower, 'air') !== false) 
                            ? FACILITYPRO_URI . '/assets/images/hvac_duct_sizing.jpg' 
                            : FACILITYPRO_URI . '/assets/images/hvac_chiller_plant.jpg';
                    } elseif ($discipline === 'electrical') {
                        $thumb_url = (strpos($t_lower, 'transformer') !== false || strpos($t_lower, 'power') !== false)
                            ? FACILITYPRO_URI . '/assets/images/electrical_transformer_yard.jpg'
                            : FACILITYPRO_URI . '/assets/images/electrical_substation_room.jpg';
                    } elseif ($discipline === 'firefighting') {
                        $thumb_url = (strpos($t_lower, 'hydrant') !== false || strpos($t_lower, 'valve') !== false)
                            ? FACILITYPRO_URI . '/assets/images/fire_hydrant_sprinkler_system.jpg'
                            : FACILITYPRO_URI . '/assets/images/fire_sprinkler_pumps.jpg';
                    } elseif ($discipline === 'plumbing') {
                        $thumb_url = (strpos($t_lower, 'drain') !== false || strpos($t_lower, 'grease') !== false || strpos($t_lower, 'pipe') !== false)
                            ? FACILITYPRO_URI . '/assets/images/plumbing_drainage_pipes.jpg'
                            : FACILITYPRO_URI . '/assets/images/plumbing_booster_pumps.jpg';
                    } elseif ($discipline === 'painting') {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/painting_epoxy_flooring.jpg';
                    } elseif ($discipline === 'solar') {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/solar_rooftop_photovoltaic.jpg';
                    } elseif ($discipline === 'bms') {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/bms_control_room.jpg';
                    } elseif ($discipline === 'stp') {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/stp_water_treatment_plant.jpg';
                    } elseif ($discipline === 'dg') {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/dg_diesel_generator_room.jpg';
                    } else {
                        $thumb_url = FACILITYPRO_URI . '/assets/images/hvac_chiller_plant.jpg';
                    }
                }
                ?>
                
                <!-- Top Breadcrumb -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-200">
                    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#0077c8] transition-colors">Home</a>
                        <span>/</span>
                        <a href="<?php echo esc_url(home_url('/knowledge-hub/')); ?>" class="hover:text-[#0077c8] transition-colors">MEP Knowledge</a>
                        <span>/</span>
                        <span class="text-slate-800 font-bold truncate max-w-xs"><?php the_title(); ?></span>
                    </nav>

                    <a href="<?php echo esc_url(home_url('/knowledge-hub/')); ?>" class="px-3.5 py-1.5 rounded-xl border border-slate-200 hover:border-slate-400 bg-white text-xs font-bold text-slate-700 transition-colors flex items-center gap-1.5 shadow-xs">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>All Articles</span>
                    </a>
                </div>

                <!-- Article Container -->
                <article id="post-<?php the_ID(); ?>" class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8 overflow-hidden">
                    
                    <div class="space-y-4 border-b border-slate-100 pb-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-blue-100 text-[#0077c8]">
                                <?php echo esc_html(strtoupper($discipline)); ?> ENGINEERING
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                Ref: <?php echo esc_html($code_ref); ?>
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                            <?php the_title(); ?>
                        </h1>

                        <div class="flex items-center justify-between text-xs text-slate-500 pt-2">
                            <span>Published: <?php echo get_the_date('F d, Y'); ?></span>
                            <button onclick="facilityProOpenConsultationModal('Calculate formula derivation for: <?php echo esc_js(get_the_title()); ?>')" class="px-3.5 py-1.5 bg-[#f05423] hover:bg-[#d94416] text-white font-bold rounded-xl flex items-center gap-1 cursor-pointer shadow-xs transition-colors">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                <span>Ask AI Specialist</span>
                            </button>
                        </div>
                    </div>

                    <!-- Featured Image Banner -->
                    <div class="rounded-2xl overflow-hidden shadow-md h-64 sm:h-96 w-full relative bg-slate-100">
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-800 leading-relaxed font-normal text-sm sm:text-base">
                        <?php the_content(); ?>
                    </div>

                </article>

                <?php
            endwhile;
        endif;
        ?>

    </div>
</div>

<?php
get_footer();
