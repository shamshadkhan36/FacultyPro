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

            <!-- Desktop Nav Items (Exact User Menus: 1. Home, 2. HVAC, 3. Electrical, 4. Plumbing, 5. Mechanical (Dropdown), 6. SOPs, 7. Pricing) -->
            <nav class="hidden lg:flex items-center gap-1">
                
                <!-- 1. Home -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_front_page() ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Home
                </a>

                <!-- 2. HVAC -->
                <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('hvac')" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all">
                    HVAC
                </a>

                <!-- 3. Electrical -->
                <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('electrical')" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all">
                    Electrical
                </a>

                <!-- 4. Plumbing -->
                <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('plumbing')" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all">
                    Plumbing
                </a>

                <!-- 5. Mechanical (Dropdown with Sub-menus: Fire fighting, Painting & polishing, BMS & automation, STP & water treatment, DG set, Calculation tools) -->
                <div class="relative group" id="navMechanicalDropdown">
                    <button type="button" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all flex items-center gap-1 cursor-pointer">
                        <span>Mechanical</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 group-hover:rotate-180 transition-transform duration-200"></i>
                    </button>
                    
                    <!-- Dropdown Sub-menu -->
                    <div class="absolute top-full left-0 mt-1 w-64 bg-white rounded-2xl shadow-2xl border border-slate-200 p-2 hidden group-hover:block transition-all duration-200 z-50 animate-in fade-in slide-in-from-top-2">
                        <div class="px-3 py-1.5 border-b border-slate-100 mb-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-[#0077c8]">Mechanical &amp; Plant Systems</span>
                        </div>
                        
                        <!-- Fire Fighting -->
                        <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('firefighting')" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                            <i data-lucide="flame" class="w-4 h-4 text-rose-500"></i>
                            <span>Fire fighting</span>
                        </a>

                        <!-- Painting & Polishing -->
                        <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('painting')" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-purple-600 hover:bg-purple-50 transition-colors">
                            <i data-lucide="paint-brush" class="w-4 h-4 text-purple-500"></i>
                            <span>Painting &amp; polishing</span>
                        </a>

                        <!-- BMS & Automation -->
                        <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('bms')" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-teal-600 hover:bg-teal-50 transition-colors">
                            <i data-lucide="cpu" class="w-4 h-4 text-teal-500"></i>
                            <span>BMS &amp; automation</span>
                        </a>

                        <!-- STP & Water Treatment -->
                        <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('stp')" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-cyan-600 hover:bg-cyan-50 transition-colors">
                            <i data-lucide="filter" class="w-4 h-4 text-cyan-600"></i>
                            <span>STP &amp; water treatment</span>
                        </a>

                        <!-- DG Set -->
                        <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProFilterCategory('dgset')" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-emerald-600 hover:bg-emerald-50 transition-colors">
                            <i data-lucide="battery-charging" class="w-4 h-4 text-emerald-600"></i>
                            <span>DG set</span>
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        <!-- Calculation Tools -->
                        <a href="<?php echo esc_url(home_url('/calculators')); ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-[#0077c8] hover:bg-sky-50 transition-colors">
                            <i data-lucide="calculator" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>Calculation tools</span>
                        </a>
                    </div>
                </div>

                <!-- 6. SOPs -->
                <a href="<?php echo esc_url(home_url('/sop-library')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('sop-library') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    SOPs
                </a>

                <!-- 7. Pricing -->
                <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="px-3 py-2 rounded-xl text-xs sm:text-sm font-bold text-slate-700 hover:text-[#0077c8] hover:bg-sky-50/70 transition-all <?php echo is_page('pricing') ? 'bg-sky-50 text-[#0077c8]' : ''; ?>">
                    Pricing
                </a>

                <!-- Ask AI Button -->
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

            <!-- Mobile Hamburger Menu Button -->
            <div class="flex lg:hidden items-center gap-2">
                <button type="button" onclick="facilityProOpenMobileMenu()" id="mobileMenuOpenBtn" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 transition-colors cursor-pointer border border-slate-200 shadow-xs" aria-label="Open Navigation Menu">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Navigation Sidebar Drawer (Slide-out from Left) -->
<div id="mobileSidebarDrawer" class="fixed inset-0 z-50 hidden transition-all duration-300" style="display: none;">
    <!-- Backdrop Overlay -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" id="mobileDrawerBackdrop" onclick="facilityProCloseMobileMenu()"></div>
    
    <!-- Sliding Panel -->
    <div class="fixed inset-y-0 left-0 max-w-xs w-full bg-white shadow-2xl flex flex-col z-10 transform -translate-x-full transition-transform duration-300 ease-in-out" id="mobileDrawerContent">
        
        <!-- Drawer Header -->
        <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-900 text-white">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-[#0077c8] flex items-center justify-center text-white font-bold">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                </div>
                <div class="leading-none">
                    <span class="text-base font-black">Facility</span><span class="text-base font-black text-[#f05423]">Pro</span>
                </div>
            </div>
            <button type="button" onclick="facilityProCloseMobileMenu()" class="p-2 text-slate-300 hover:text-white rounded-lg hover:bg-white/10 transition-colors cursor-pointer">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Drawer Navigation List -->
        <div class="flex-1 overflow-y-auto p-4 space-y-1.5">
            
            <!-- 1. Home -->
            <a href="<?php echo esc_url(home_url('/')); ?>" onclick="facilityProCloseMobileMenu()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors">
                <i data-lucide="home" class="w-4 h-4 text-[#0077c8]"></i>
                <span>Home</span>
            </a>

            <!-- 2. HVAC -->
            <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('hvac');" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors">
                <i data-lucide="wind" class="w-4 h-4 text-sky-500"></i>
                <span>HVAC</span>
            </a>

            <!-- 3. Electrical -->
            <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('electrical');" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-amber-50 hover:text-amber-700 transition-colors">
                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                <span>Electrical</span>
            </a>

            <!-- 4. Plumbing -->
            <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('plumbing');" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                <i data-lucide="droplets" class="w-4 h-4 text-blue-500"></i>
                <span>Plumbing</span>
            </a>

            <!-- 5. Mechanical (Expandable Accordion) -->
            <div>
                <button type="button" onclick="facilityProToggleMobileMechanical()" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i data-lucide="cog" class="w-4 h-4 text-[#0077c8]"></i>
                        <span>Mechanical</span>
                    </div>
                    <i data-lucide="chevron-down" id="mobileMechChevron" class="w-4 h-4 text-slate-400 transition-transform"></i>
                </button>
                <div id="mobileMechanicalSubmenu" class="hidden pl-4 pr-2 py-2 space-y-1 border-l-2 border-slate-200 ml-5 my-1 bg-slate-50/70 rounded-r-xl">
                    <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('firefighting');" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-slate-700 hover:text-rose-600 rounded-lg hover:bg-white">
                        <span>🔥 Fire fighting</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('painting');" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-slate-700 hover:text-purple-600 rounded-lg hover:bg-white">
                        <span>🎨 Painting &amp; polishing</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('bms');" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-slate-700 hover:text-teal-600 rounded-lg hover:bg-white">
                        <span>🎛️ BMS &amp; automation</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('stp');" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-slate-700 hover:text-cyan-600 rounded-lg hover:bg-white">
                        <span>🧪 STP &amp; water treatment</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/#disciplines')); ?>" onclick="facilityProCloseMobileMenu(); facilityProFilterCategory('dgset');" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-slate-700 hover:text-emerald-600 rounded-lg hover:bg-white">
                        <span>🔋 DG set</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/calculators')); ?>" onclick="facilityProCloseMobileMenu()" class="flex items-center gap-2 py-1.5 px-2 text-xs font-bold text-[#0077c8] rounded-lg hover:bg-white">
                        <span>🔢 Calculation tools</span>
                    </a>
                </div>
            </div>

            <!-- 6. SOPs -->
            <a href="<?php echo esc_url(home_url('/sop-library')); ?>" onclick="facilityProCloseMobileMenu()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors">
                <i data-lucide="shield-check" class="w-4 h-4 text-amber-500"></i>
                <span>SOPs</span>
            </a>

            <!-- 7. Pricing -->
            <a href="<?php echo esc_url(home_url('/pricing')); ?>" onclick="facilityProCloseMobileMenu()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors">
                <i data-lucide="credit-card" class="w-4 h-4 text-indigo-500"></i>
                <span>Pricing</span>
            </a>

            <!-- Dashboard Link in Mobile Drawer -->
            <a href="<?php echo esc_url(home_url('/dashboard')); ?>" onclick="facilityProCloseMobileMenu()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-[#0077c8] transition-colors">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-purple-500"></i>
                <span>Dashboard</span>
            </a>

            <!-- Ask AI Action Button -->
            <div class="pt-3">
                <button type="button" onclick="facilityProCloseMobileMenu(); facilityProOpenConsultationModal();" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#f05423] to-[#d94416] text-white font-bold text-xs flex items-center justify-center gap-2 shadow-md cursor-pointer">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    <span>Ask AI Specialist</span>
                </button>
            </div>

        </div>

        <!-- Drawer Footer with Auth & Emergency -->
        <div class="p-4 border-t border-slate-200 bg-slate-50 space-y-3">
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="w-full py-2.5 px-3 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center justify-center gap-2">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>My Plant Account</span>
                </a>
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="block text-center text-xs font-semibold text-rose-600 hover:underline">
                    Log Out
                </a>
            <?php else : ?>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="facilityProCloseMobileMenu(); facilityProOpenAuthModal('login')" class="py-2.5 px-3 rounded-xl border border-slate-300 font-bold text-xs text-slate-700 hover:bg-slate-100 cursor-pointer">
                        Sign In
                    </button>
                    <button type="button" onclick="facilityProCloseMobileMenu(); facilityProOpenAuthModal('signup')" class="py-2.5 px-3 rounded-xl bg-[#0077c8] text-white font-bold text-xs shadow-sm cursor-pointer">
                        Register
                    </button>
                </div>
            <?php endif; ?>
            <a href="tel:+919876543210" class="block text-center text-[11px] font-bold text-slate-500 hover:text-slate-800">
                📞 Emergency: +91 98765 43210
            </a>
        </div>

    </div>
</div>
