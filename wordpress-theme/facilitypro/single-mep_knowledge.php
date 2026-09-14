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
                if (empty($discipline)) $discipline = 'Plant Engineering';
                $code_ref   = get_post_meta($post_id, 'kb_code_ref', true);
                if (empty($code_ref)) $code_ref = 'ASHRAE / NBC 2016';
                ?>
                
                <!-- Top Breadcrumb -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-200">
                    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#0077c8] transition-colors">Home</a>
                        <span>/</span>
                        <a href="<?php echo esc_url(home_url('/knowledge-hub/')); ?>" class="hover:text-[#0077c8] transition-colors">Knowledge Hub</a>
                        <span>/</span>
                        <span class="text-slate-800 font-bold truncate max-w-xs"><?php the_title(); ?></span>
                    </nav>

                    <a href="<?php echo esc_url(home_url('/knowledge-hub/')); ?>" class="px-3.5 py-1.5 rounded-xl border border-slate-200 hover:border-slate-400 bg-white text-xs font-bold text-slate-700 transition-colors flex items-center gap-1.5 shadow-xs">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>All Articles</span>
                    </a>
                </div>

                <!-- Article Container -->
                <article id="post-<?php the_ID(); ?>" class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
                    
                    <div class="space-y-4 border-b border-slate-100 pb-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-blue-100 text-[#0077c8]">
                                <?php echo esc_html($discipline); ?>
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
                            <button onclick="facilityProOpenConsultationModal('Calculate formula derivation for: <?php echo esc_js(get_the_title()); ?>')" class="px-3.5 py-1.5 bg-[#f05423] text-white font-bold rounded-xl flex items-center gap-1 cursor-pointer">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                <span>Ask AI</span>
                            </button>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="rounded-2xl overflow-hidden shadow-sm">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto object-cover')); ?>
                        </div>
                    <?php endif; ?>

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
