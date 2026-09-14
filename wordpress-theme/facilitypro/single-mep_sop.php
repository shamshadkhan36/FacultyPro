<?php
/**
 * Single Template for SOP Library Items (mep_sop)
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-5xl mx-auto space-y-8">
        
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $post_id   = get_the_ID();
                $sop_code  = get_post_meta($post_id, 'sop_code', true);
                if (empty($sop_code)) $sop_code = 'SOP-' . str_pad($post_id, 3, '0', STR_PAD_LEFT);
                $discipline = get_post_meta($post_id, 'sop_discipline', true);
                if (empty($discipline)) $discipline = 'General Engineering';
                $version   = get_post_meta($post_id, 'sop_version', true);
                if (empty($version)) $version = 'v1.0';
                $author_name = get_the_author();
                if (empty($author_name)) $author_name = 'FacilityPro Engineering Committee';
                ?>
                
                <!-- Top Breadcrumb & Actions Navigation -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-200">
                    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#0077c8] transition-colors">Home</a>
                        <span>/</span>
                        <a href="<?php echo esc_url(home_url('/sop-library/')); ?>" class="hover:text-[#0077c8] transition-colors">SOP Library</a>
                        <span>/</span>
                        <span class="text-slate-800 font-bold truncate max-w-xs"><?php the_title(); ?></span>
                    </nav>

                    <div class="flex items-center gap-2">
                        <a href="<?php echo esc_url(home_url('/sop-library/')); ?>" class="px-3.5 py-1.5 rounded-xl border border-slate-200 hover:border-slate-400 bg-white text-xs font-bold text-slate-700 transition-colors flex items-center gap-1.5 shadow-xs">
                            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                            <span>All SOPs</span>
                        </a>
                        <button onclick="window.print()" class="px-3.5 py-1.5 rounded-xl border border-slate-200 hover:border-slate-400 bg-white text-xs font-bold text-slate-700 transition-colors flex items-center gap-1.5 shadow-xs cursor-pointer">
                            <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                            <span>Print / PDF</span>
                        </button>
                    </div>
                </div>

                <!-- Main SOP Article Container -->
                <article id="post-<?php the_ID(); ?>" class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
                    
                    <!-- Header Banner -->
                    <div class="space-y-4 border-b border-slate-100 pb-8">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-blue-100 text-[#0077c8] border border-blue-200">
                                <?php echo esc_html($sop_code); ?>
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                <?php echo esc_html($discipline); ?>
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Standard Approved (<?php echo esc_html($version); ?>)
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                            <?php the_title(); ?>
                        </h1>

                        <div class="flex flex-wrap items-center justify-between gap-4 pt-2 text-xs text-slate-500">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-black text-xs">
                                    FP
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800"><?php echo esc_html($author_name); ?></div>
                                    <div class="text-[11px] text-slate-400">Published on <?php echo get_the_date('M d, Y'); ?></div>
                                </div>
                            </div>

                            <button onclick="facilityProOpenConsultationModal('Clarify standard operating procedure for: <?php echo esc_js(get_the_title()); ?>')" class="px-4 py-2 bg-gradient-to-r from-[#f05423] to-[#d94416] text-white text-xs font-bold rounded-xl flex items-center gap-1.5 shadow-sm shadow-orange-500/20 cursor-pointer hover:from-[#d94416] hover:to-[#f05423] transition-all">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                                <span>Ask AI to Clarify Sizing</span>
                            </button>
                        </div>
                    </div>

                    <!-- SOP Content Body -->
                    <div class="prose prose-slate max-w-none text-slate-800 leading-relaxed font-normal text-sm sm:text-base">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post Footer Compliance Box -->
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Engineering Compliance Note</h4>
                            <p class="text-xs text-slate-500">This SOP complies with NBC 2016 Part 8 (Building Services), IS 732, and OSHA Lockout/Tagout regulations.</p>
                        </div>
                        <button onclick="facilityProOpenConsultationModal('Calculate root cause derivation for: <?php echo esc_js(get_the_title()); ?>')" class="px-4 py-2.5 bg-slate-900 hover:bg-[#0077c8] text-white rounded-xl text-xs font-bold shrink-0 transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                            <i data-lucide="message-square" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Consult Indian AI PE</span>
                        </button>
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
