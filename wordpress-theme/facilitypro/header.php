<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col selection:bg-[#0077c8]/20 selection:text-[#0077c8]'); ?>>
<?php wp_body_open(); ?>

<!-- Top Announcement Ribbon -->
<div class="bg-gradient-to-r from-[#0b2545] via-[#134074] to-[#0b2545] text-white text-xs py-2 px-4 shadow-sm border-b border-blue-900/40 relative z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2 overflow-hidden text-ellipsis whitespace-nowrap">
            <span class="inline-flex items-center justify-center bg-[#f05423] text-white text-[10px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider animate-pulse">Live</span>
            <span class="font-medium text-slate-200 text-xs truncate">
                🔥 <strong>15,000+ Verified Facility Managers Connected:</strong> Point-to-Point MEP AI Diagnostics with licensed Indian PEs &amp; ASHRAE/NFPA code derivations.
            </span>
        </div>
        <div class="hidden md:flex items-center gap-4 shrink-0 text-slate-300 text-xs">
            <div class="flex items-center gap-1 text-emerald-400 font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>AI Consultants Online (&lt; 5s reply)</span>
            </div>
            <a href="tel:<?php echo esc_attr(get_option('facilitypro_emergency_phone', '+919876543210')); ?>" class="hover:text-white font-semibold transition-colors">
                📞 Emergency Plant Line
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0077c8] to-[#005a96] flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="wrench" class="w-5 h-5 stroke-[2.2]"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 leading-none">
                            <span class="text-xl sm:text-2xl font-black tracking-tight text-[#0b2545]">Facility</span>
                            <span class="text-xl sm:text-2xl font-black tracking-tight text-[#f05423]">Pro</span>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-widest text-[#0077c8] block mt-0.5">
                            MEP &bull; IS / NBC &bull; AI Diagnostics
                        </span>
                    </div>
                </a>
            </div>

            <!-- Desktop Nav Items -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_front_page() ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Home
                </a>
                <a href="<?php echo esc_url(home_url('/calculators')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('calculators') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Calculators
                </a>
                <a href="<?php echo esc_url(home_url('/knowledge-hub')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('knowledge-hub') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Knowledge Hub
                </a>
                <a href="<?php echo esc_url(home_url('/sop-library')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('sop-library') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    SOPs
                </a>
                <a href="<?php echo esc_url(home_url('/checklists')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('checklists') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Checklists
                </a>
                <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('pricing') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Pricing
                </a>
                <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('dashboard') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Dashboard
                </a>

                <!-- Quick Ask AI button -->
                <button type="button" onclick="facilityProOpenConsultationModal('Calculate NFPA 13 sprinkler water demand for warehouse.')" class="ml-2 flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-orange-50 hover:bg-orange-100 text-[#f05423] font-bold text-xs border border-orange-200 transition-colors shadow-xs cursor-pointer">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#f05423]"></i>
                    <span>Ask AI</span>
                </button>
            </nav>

            <!-- Right Actions: Dynamic Logged In vs Logged Out State -->
            <div class="hidden md:flex items-center gap-3">
                <?php if (is_user_logged_in()) : 
                    $curr_u = wp_get_current_user();
                    $u_name = !empty($curr_u->display_name) ? $curr_u->display_name : $curr_u->user_login;
                    $u_init = strtoupper(substr($u_name, 0, 2));
                ?>
                    <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 hover:border-[#0077c8] bg-slate-50 transition-all group">
                        <div class="w-7 h-7 rounded-lg bg-slate-900 text-white flex items-center justify-center text-xs font-black group-hover:bg-[#0077c8] transition-colors">
                            <?php echo esc_html($u_init); ?>
                        </div>
                        <span class="text-xs font-bold text-slate-800 group-hover:text-[#0077c8]">
                            <?php echo esc_html(substr($u_name, 0, 15)); ?>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="px-3 py-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors" title="Log Out">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </a>
                <?php else : ?>
                    <button type="button" onclick="facilityProOpenAuthModal('login')" class="px-4 py-2 text-xs font-bold text-slate-700 hover:text-[#0077c8] border border-slate-300 hover:border-[#0077c8] rounded-xl transition-all cursor-pointer shadow-xs">
                        Sign In
                    </button>
                    <button type="button" onclick="facilityProOpenAuthModal('signup')" class="px-4 py-2 text-xs font-bold text-white bg-[#0077c8] hover:bg-[#0062a4] rounded-xl transition-all shadow-md shadow-blue-500/20 cursor-pointer">
                        Register
                    </button>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="flex lg:hidden items-center gap-2">
                <button type="button" onclick="facilityProToggleMobileMenu()" class="p-2 rounded-xl text-slate-700 hover:bg-slate-100 transition-colors" aria-label="Toggle Navigation Menu">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>

        </div>
    </div>
</header>
