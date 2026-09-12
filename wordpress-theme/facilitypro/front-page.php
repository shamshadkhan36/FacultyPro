<?php
/**
 * FacilityPro Front Page Template
 *
 * @package FacilityPro
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- HERO SECTION -->
    <section class="relative min-h-[580px] sm:min-h-[640px] flex items-center justify-center overflow-hidden bg-slate-900 text-white">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img 
                src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/bms_control_room.jpg'); ?>" 
                alt="MEP Facility Plant Room" 
                class="w-full h-full object-cover object-center opacity-30 filter contrast-125 brightness-90 transform scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-slate-900/60"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-900/20 via-transparent to-black/60"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 text-center sm:text-left">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-8 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white shadow-lg">
                        <div class="w-5 h-5 rounded-full bg-[#f05423] flex items-center justify-center text-white text-[10px] font-black">
                            FP
                        </div>
                        <span class="text-xs sm:text-sm font-semibold tracking-wide text-slate-100">
                            Facility<span class="text-[#ff7849]">Pro</span> MEP Point-to-Point AI Diagnostics
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-[1.1]">
                        Plant problems solved with <br class="hidden sm:inline" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-[#ff7849] to-amber-300">
                            step-by-step mathematical clarity.
                        </span>
                    </h1>

                    <p class="text-sm sm:text-lg text-slate-200 font-normal leading-relaxed max-w-2xl">
                        Ask any complex HVAC, Plumbing, Electrical, or Fire Fighting question. Get verified formulas, exact sizing derivation, and Indian IS/NBC code clauses from domain-specialized AI Consultants in under 5 seconds.
                    </p>

                    <!-- Interactive Search Bar -->
                    <div class="pt-2">
                        <form onsubmit="facilityProHandleHeroSearch(event)" class="relative flex flex-col sm:flex-row gap-2 max-w-2xl bg-white/95 p-2 rounded-2xl sm:rounded-full shadow-2xl backdrop-blur-md border border-white/40">
                            <div class="flex items-center pl-3 flex-1">
                                <i data-lucide="search" class="w-5 h-5 text-slate-400 shrink-0"></i>
                                <input 
                                    type="text" 
                                    id="hero-search-input"
                                    placeholder="e.g., Chiller condenser surging at 85% load, or PRV sizing for 28-story riser..." 
                                    class="w-full text-xs sm:text-sm py-2.5 px-3 bg-transparent text-slate-800 placeholder:text-slate-400 focus:outline-none font-medium"
                                />
                            </div>
                            <button 
                                type="submit" 
                                class="bg-[#f05423] hover:bg-[#d84315] text-white font-extrabold text-xs sm:text-sm px-6 py-3 rounded-xl sm:rounded-full transition-all shadow-md shadow-orange-600/30 flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <span>Get Solution</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                        </form>

                        <!-- Quick Prompts Pills -->
                        <div class="mt-3.5 flex flex-wrap items-center gap-2 text-xs text-slate-300">
                            <span class="font-bold text-slate-400">Popular:</span>
                            <button onclick="facilityProOpenConsultationModal('Centrifugal chiller condenser high approach temperature & surging under 85% load.', 'Er. Rajesh Sharma', 'HVAC & Chilled Water')" class="bg-white/10 hover:bg-white/20 px-2.5 py-1 rounded-full text-slate-200 transition-colors border border-white/10 cursor-pointer">
                                Chiller Surging &amp; Approach
                            </button>
                            <button onclick="facilityProOpenConsultationModal('High-rise riser water hammer and PRV station sizing for 28 stories.', 'Er. Amit Patel', 'Plumbing & Drainage')" class="bg-white/10 hover:bg-white/20 px-2.5 py-1 rounded-full text-slate-200 transition-colors border border-white/10 cursor-pointer">
                                Water Hammer &amp; PRVs
                            </button>
                            <button onclick="facilityProOpenConsultationModal('Transformer 87T differential protection tripping on inrush current.', 'Dr. Vikram Malhotra', 'Electrical & Power')" class="bg-white/10 hover:bg-white/20 px-2.5 py-1 rounded-full text-slate-200 transition-colors border border-white/10 cursor-pointer">
                                Transformer 87T Trip
                            </button>
                            <button onclick="facilityProOpenConsultationModal('NFPA 13 sprinkler hydraulic flow and fire pump head calculation.', 'Er. Ananya Verma', 'Fire & Life Safety')" class="bg-white/10 hover:bg-white/20 px-2.5 py-1 rounded-full text-slate-200 transition-colors border border-white/10 cursor-pointer">
                                NFPA 13 Sprinklers
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Right Quick Card Preview -->
                <div class="hidden lg:block lg:col-span-4">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/20 shadow-2xl space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-xs font-bold text-emerald-400 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                AI Engine Active
                            </span>
                            <span class="text-[10px] text-slate-300">OpenAI GPT-4o</span>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-slate-300 font-bold uppercase tracking-wider">Governing Standards</div>
                            <div class="text-sm font-bold text-white leading-tight">National Building Code (NBC), ISHRAE, ASHRAE, NFPA &amp; IEEE</div>
                        </div>
                        <div class="p-3 bg-white/5 rounded-2xl border border-white/10 text-xs text-slate-200 leading-relaxed">
                            "Instant derivations for pipe friction loss, transformer inrush harmonics, Joukowsky water hammer, and chiller kW/TR."
                        </div>
                        <button onclick="facilityProOpenConsultationModal()" class="w-full py-2.5 rounded-xl bg-white text-[#0b2545] font-bold text-xs hover:bg-slate-100 transition-colors flex items-center justify-center gap-1.5 shadow-md">
                            <span>Open Diagnostic Studio</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DISCIPLINE FILTER PILLS RIBBON -->
    <div class="bg-white border-b border-slate-200 shadow-xs sticky top-16 sm:top-20 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 overflow-x-auto scrollbar-none flex items-center gap-2 sm:gap-3">
            <button onclick="facilityProFilterCategory('all')" id="pill-all" class="category-pill active flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold border transition-all cursor-pointer bg-[#0077c8] text-white border-[#0077c8] shadow-sm">
                <i data-lucide="layers" class="w-4 h-4"></i>
                <span>All MEP Disciplines</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-white/20 text-white">15,000+</span>
            </button>
            <button onclick="facilityProFilterCategory('hvac')" id="pill-hvac" class="category-pill flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold border transition-all cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300">
                <i data-lucide="wind" class="w-4 h-4 text-sky-500"></i>
                <span>HVAC &amp; Chilled Water</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 text-slate-600">4,820+</span>
            </button>
            <button onclick="facilityProFilterCategory('plumbing')" id="pill-plumbing" class="category-pill flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold border transition-all cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300">
                <i data-lucide="droplets" class="w-4 h-4 text-blue-500"></i>
                <span>Plumbing &amp; Piping</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 text-slate-600">3,790+</span>
            </button>
            <button onclick="facilityProFilterCategory('electrical')" id="pill-electrical" class="category-pill flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold border transition-all cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300">
                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                <span>Electrical &amp; Substations</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 text-slate-600">4,150+</span>
            </button>
            <button onclick="facilityProFilterCategory('firefighting')" id="pill-firefighting" class="category-pill flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold border transition-all cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300">
                <i data-lucide="flame" class="w-4 h-4 text-rose-500"></i>
                <span>Fire Fighting &amp; Safety</span>
                <span class="px-1.5 py-0.2 rounded-full text-[10px] bg-slate-100 text-slate-600">2,640+</span>
            </button>
        </div>
    </div>

    <!-- POPULAR QUESTIONS 4-CARD GRID -->
    <section id="popular" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Popular questions at Facility<span class="text-[#f05423]">Pro</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-2.5 font-normal">
                    Real plant challenges solved with point-to-point step-by-step clarity by verified Indian AI Engineering Consultants.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="popular-cards-grid">
                
                <!-- Card 1: HVAC -->
                <div data-category="hvac" onclick="facilityProOpenConsultationModal('Centrifugal chiller condenser high approach temperature & surging under 85% load.', 'Er. Rajesh Sharma', 'HVAC & Chilled Water')" class="question-card group bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-[#0077c8] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between cursor-pointer transform hover:-translate-y-1">
                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-black text-slate-900 tracking-tight group-hover:text-[#0077c8] transition-colors">HVAC</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0077c8] border border-blue-100">Verified</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-4 leading-relaxed font-medium">
                            Our 500 TR centrifugal chiller has a condenser approach temperature exceeding 6.5°F (normal &lt; 2.0°F) and begins surging under 85% load. What is the root cause and diagnostic step?
                        </p>
                        <div class="pt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                            <span class="truncate">Answered by Er. Rajesh Sharma (AI)</span>
                        </div>
                    </div>
                    <div class="relative h-44 sm:h-48 overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/hvac_chiller_plant.jpg'); ?>" alt="HVAC Chiller Plant" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-4">
                            <div class="w-full flex items-center justify-between text-white font-bold text-xs bg-[#f05423] py-2 px-3.5 rounded-xl shadow-lg">
                                <span>View Point-to-Point Answer</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Plumbing -->
                <div data-category="plumbing" onclick="facilityProOpenConsultationModal('High-Rise Riser Water Hammer & Pressure Reducing Valve (PRV) Sizing for 28 stories.', 'Er. Amit Patel', 'Plumbing & Drainage')" class="question-card group bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-[#0077c8] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between cursor-pointer transform hover:-translate-y-1">
                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-black text-slate-900 tracking-tight group-hover:text-[#0077c8] transition-colors">Plumbing</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0077c8] border border-blue-100">Verified</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-4 leading-relaxed font-medium">
                            In a 28-story residential tower, violent water hammer and pipe rattling occur whenever solenoid flush valves shut. How do we size water hammer arrestors and staging PRV stations?
                        </p>
                        <div class="pt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                            <span class="truncate">Answered by Er. Amit Patel (AI)</span>
                        </div>
                    </div>
                    <div class="relative h-44 sm:h-48 overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/plumbing_booster_pumps.jpg'); ?>" alt="Plumbing Booster Pumps" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-4">
                            <div class="w-full flex items-center justify-between text-white font-bold text-xs bg-[#f05423] py-2 px-3.5 rounded-xl shadow-lg">
                                <span>View Point-to-Point Answer</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Electrical -->
                <div data-category="electrical" onclick="facilityProOpenConsultationModal('Transformer Differential Protection (87T) Tripping on Inrush Current on cold energization.', 'Dr. Vikram Malhotra', 'Electrical & Power')" class="question-card group bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-[#0077c8] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between cursor-pointer transform hover:-translate-y-1">
                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-black text-slate-900 tracking-tight group-hover:text-[#0077c8] transition-colors">Electrical</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0077c8] border border-blue-100">Verified</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-4 leading-relaxed font-medium">
                            A 2000 kVA 11kV/415V dry-type transformer trips on 87T differential protection during no-load energization from the grid. How do we configure harmonic restraint?
                        </p>
                        <div class="pt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                            <span class="truncate">Answered by Dr. Vikram Malhotra (AI)</span>
                        </div>
                    </div>
                    <div class="relative h-44 sm:h-48 overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/electrical_substation_room.jpg'); ?>" alt="Electrical Substation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-4">
                            <div class="w-full flex items-center justify-between text-white font-bold text-xs bg-[#f05423] py-2 px-3.5 rounded-xl shadow-lg">
                                <span>View Point-to-Point Answer</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Fire Fighting -->
                <div data-category="firefighting" onclick="facilityProOpenConsultationModal('NFPA 13 Wet Sprinkler Hydraulic Sizing & Fire Pump Head Calculation for Extra Hazard Group 1.', 'Er. Ananya Verma', 'Fire & Life Safety')" class="question-card group bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-[#0077c8] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between cursor-pointer transform hover:-translate-y-1">
                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-black text-slate-900 tracking-tight group-hover:text-[#0077c8] transition-colors">Fire Fighting</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0077c8] border border-blue-100">Verified</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-4 leading-relaxed font-medium">
                            For an industrial warehouse classified under Extra Hazard Group 1, what is the design density, remote area calculation, and required fire pump flow &amp; head?
                        </p>
                        <div class="pt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                            <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                            <span class="truncate">Answered by Er. Ananya Verma (AI)</span>
                        </div>
                    </div>
                    <div class="relative h-44 sm:h-48 overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/fire_sprinkler_pumps.jpg'); ?>" alt="Fire Sprinkler Pumps" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-4">
                            <div class="w-full flex items-center justify-between text-white font-bold text-xs bg-[#f05423] py-2 px-3.5 rounded-xl shadow-lg">
                                <span>View Point-to-Point Answer</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom helper text -->
            <div class="mt-10 text-center">
                <span class="inline-flex items-center gap-2 text-xs sm:text-sm text-slate-500 font-medium bg-white px-4 py-2 rounded-full border border-slate-200 shadow-xs">
                    <i data-lucide="sparkles" class="w-4 h-4 text-[#f05423]"></i>
                    Have a different question? Type it directly in the search bar above or open the AI chat helper.
                </span>
            </div>

        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section id="how-it-works" class="py-16 sm:py-24 bg-white border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0077c8] bg-sky-50 px-3 py-1 rounded-full border border-sky-100">
                    Point-to-Point Process
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-[#0b2545] tracking-tight mt-3">
                    How FacilityPro Solves Your Problem
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    Zero wait times, zero hourly retainers. Instant code-verified derivations with exact formulas.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200/80 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#0077c8] text-white flex items-center justify-center font-black text-lg shadow-md">1</div>
                    <h3 class="text-xl font-bold text-slate-900">Type Your Plant Problem</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Input your chiller parameters, pump trip symptoms, transformer single-line diagram details, or sprinkler sizing criteria.
                    </p>
                </div>
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200/80 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#f05423] text-white flex items-center justify-center font-black text-lg shadow-md">2</div>
                    <h3 class="text-xl font-bold text-slate-900">AI Code &amp; Math Derivation</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Our specialized AI models cross-reference IS/NBC, ASHRAE, NFPA, and IEEE standards to calculate exact friction losses, inrush harmonic blocking, and sizing formulas.
                    </p>
                </div>
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200/80 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-lg shadow-md">3</div>
                    <h3 class="text-xl font-bold text-slate-900">Point-to-Point Resolution</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Receive a crisp 4-point solution: Direct Summary, Step-by-Step Actions, Mathematical Formulas, and Official Code References. Export to PDF in 1-click.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MEET THE AI MEP EXPERTS -->
    <section id="experts" class="py-16 sm:py-24 bg-slate-50 border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <div class="lg:col-span-4 space-y-6">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-[#f05423] bg-orange-50 px-3 py-1 rounded-full border border-orange-100 inline-block mb-2">
                            AI Engineering Intelligence
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0b2545] tracking-tight">
                            Meet the AI MEP Experts
                        </h2>
                    </div>

                    <p class="text-sm text-slate-600 leading-relaxed">
                        Our domain-specialized AI Engineering Consultants are modeled after premier Indian &amp; international MEP consultants, trained on verified standards including:
                    </p>

                    <ul class="space-y-3 pt-2">
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-800">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>ISHRAE &amp; ASHRAE AI Chilled Water Models</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-800">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>Indian Plumbing Association (IPA) &amp; ASPE AI</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-800">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>IEEE &amp; CPRI High-Voltage Electrical Models</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-800">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <span>NFPA &amp; FSAI Certified Fire Safety AI</span>
                        </li>
                    </ul>

                    <div class="p-4 rounded-2xl bg-white border border-slate-200 text-xs text-slate-600 space-y-1 shadow-xs">
                        <div class="font-bold text-slate-800 flex items-center gap-1.5">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>24/7 Instant AI Calculation Guarantee</span>
                        </div>
                        <p class="text-[11px] text-slate-500">
                            Every AI consultant delivers verified equations, Indian NBC / IS standards, and international code calculations in under 5 seconds.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- Expert 1: Rajesh Sharma -->
                        <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-[#0077c8] p-6 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative shrink-0">
                                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_rajesh_sharma.jpg'); ?>" alt="Er. Rajesh Sharma" class="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 group-hover:ring-[#0077c8] transition-all">
                                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">Er. Rajesh Sharma</h4>
                                        <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold">AI HVAC Specialist</span>
                                        <div class="flex items-center gap-0.5 text-amber-500 text-xs mt-1">★★★★★</div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-bold text-slate-800 uppercase tracking-wide">SENIOR HVAC &amp; CHILLED WATER</h5>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                        B.Tech &amp; M.Tech Mechanical (IIT Roorkee), Licensed PE. Trained on 58,000+ Chiller Plants, VRV/VRF, ISHRAE &amp; ASHRAE cases.
                                    </p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <button onclick="facilityProOpenConsultationModal('I would like to consult with Er. Rajesh Sharma regarding HVAC Chiller Plant Diagnostics.', 'Er. Rajesh Sharma', 'HVAC & Chilled Water')" class="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-[#0077c8] text-[#0077c8] hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <span>Consult Rajesh (AI)</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Expert 2: Amit Patel -->
                        <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-[#0077c8] p-6 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative shrink-0">
                                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_amit_patel.jpg'); ?>" alt="Er. Amit Patel" class="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 group-hover:ring-[#0077c8] transition-all">
                                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">Er. Amit Patel</h4>
                                        <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold">AI Plumbing Specialist</span>
                                        <div class="flex items-center gap-0.5 text-amber-500 text-xs mt-1">★★★★★</div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-bold text-slate-800 uppercase tracking-wide">CHIEF PLUMBING &amp; HYDRO-MECHANICAL</h5>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                        B.Tech Civil &amp; Hydro-Mechanical (IIT Bombay), Licensed CPD, PE. Trained on 46,000+ High-Rise Booster Pumps, Water Hammer, NBC &amp; IPC.
                                    </p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <button onclick="facilityProOpenConsultationModal('I would like to consult with Er. Amit Patel regarding High-Rise Plumbing and PRV Sizing.', 'Er. Amit Patel', 'Plumbing & Drainage')" class="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-[#0077c8] text-[#0077c8] hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <span>Consult Amit (AI)</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Expert 3: Vikram Malhotra -->
                        <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-[#0077c8] p-6 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative shrink-0">
                                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_vikram_malhotra.jpg'); ?>" alt="Dr. Vikram Malhotra" class="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 group-hover:ring-[#0077c8] transition-all">
                                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">Dr. Vikram Malhotra</h4>
                                        <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold">AI Electrical Specialist</span>
                                        <div class="flex items-center gap-0.5 text-amber-500 text-xs mt-1">★★★★★</div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-bold text-slate-800 uppercase tracking-wide">PRINCIPAL HIGH-VOLTAGE &amp; SUBSTATION</h5>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                        Ph.D. in Electrical Power Systems (IIT Delhi), Licensed PE, IEEE. Trained on 52,000+ MV/LV Substations, Transformers &amp; 87T Relays.
                                    </p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <button onclick="facilityProOpenConsultationModal('I would like to consult with Dr. Vikram Malhotra regarding Transformer Inrush and Switchgears.', 'Dr. Vikram Malhotra', 'Electrical & Power')" class="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-[#0077c8] text-[#0077c8] hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <span>Consult Vikram (AI)</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Expert 4: Ananya Verma -->
                        <div class="bg-white rounded-2xl border border-slate-200/90 hover:border-[#0077c8] p-6 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative shrink-0">
                                        <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_ananya_verma.jpg'); ?>" alt="Er. Ananya Verma" class="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 group-hover:ring-[#0077c8] transition-all">
                                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">Er. Ananya Verma</h4>
                                        <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold">AI Fire Safety Specialist</span>
                                        <div class="flex items-center gap-0.5 text-amber-500 text-xs mt-1">★★★★★</div>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-bold text-slate-800 uppercase tracking-wide">CHIEF FIRE PROTECTION &amp; LIFE SAFETY</h5>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                        M.Tech Fire Protection &amp; Safety (IIT Kharagpur), Licensed FPE. Trained on 39,000+ Sprinklers, Fire Pumps, NBC Part 4 &amp; NFPA 13/20.
                                    </p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <button onclick="facilityProOpenConsultationModal('I would like to consult with Er. Ananya Verma regarding NFPA 13 Sprinkler Demand and Fire Pumps.', 'Er. Ananya Verma', 'Fire & Life Safety')" class="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-[#0077c8] text-[#0077c8] hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                                    <span>Consult Ananya (AI)</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- WHY FACILITY MANAGERS LOVE US -->
    <section id="why-us" class="py-16 sm:py-24 bg-white border-b border-slate-200/70 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-5xl font-extrabold text-[#0b2545] tracking-tight">
                    Why facility managers trust Facility<span class="text-[#f05423]">Pro</span>
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    The mathematical precision of OpenAI reasoning paired with the real-world authority of licensed MEP consulting engineers.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="text-center space-y-4 px-2 group">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-[#0084d6] group-hover:bg-[#0084d6] group-hover:text-white transition-colors shadow-xs">
                        <i data-lucide="badge-check" class="w-8 h-8 stroke-[1.8]"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">15,000+ Verified Plants</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Multi-step verification including Indian PE board standards, ISHRAE/ASHRAE credentials, and past project audits.
                    </p>
                </div>
                <div class="text-center space-y-4 px-2 group">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-[#0084d6] group-hover:bg-[#0084d6] group-hover:text-white transition-colors shadow-xs">
                        <i data-lucide="piggy-bank" class="w-8 h-8 stroke-[1.8]"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Prevent Costly Plant Downtime</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Avoid thousands of dollars in emergency breakdown costs, consultant site visit fees, and regulatory penalties.
                    </p>
                </div>
                <div class="text-center space-y-4 px-2 group">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-[#0084d6] group-hover:bg-[#0084d6] group-hover:text-white transition-colors shadow-xs">
                        <i data-lucide="heart-handshake" class="w-8 h-8 stroke-[1.8]"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Tailored to Your Plant</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Discuss your specific chiller model, pump curve, substation single line diagram (SLD), or sprinkler hydraulic calculation directly.
                    </p>
                </div>
                <div class="text-center space-y-4 px-2 group">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-[#0084d6] group-hover:bg-[#0084d6] group-hover:text-white transition-colors shadow-xs">
                        <i data-lucide="hourglass" class="w-8 h-8 stroke-[1.8]"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 tracking-tight">Save Critical On-Site Time</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Connect directly from equipment plant rooms, electrical substations, or site offices in under 5 seconds.
                    </p>
                </div>
            </div>

            <!-- Plant Collage 5 Images -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 pt-6">
                <div class="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
                    <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/hvac_chiller_plant.jpg'); ?>" alt="Chiller Plant Room" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
                    <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/plumbing_booster_pumps.jpg'); ?>" alt="Plumbing Booster Pumps" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
                    <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/electrical_substation_room.jpg'); ?>" alt="Electrical Substation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
                    <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/fire_sprinkler_pumps.jpg'); ?>" alt="Fire Pump Room" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
                    <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/bms_control_room.jpg'); ?>" alt="BMS Facility Control" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
                </div>
            </div>

        </div>
    </section>

    <!-- TRANSPARENT PRICING SECTION -->
    <section id="pricing" class="py-16 sm:py-24 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0077c8] bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                    Transparent Facility Pricing
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mt-3">
                    Affordable On-Demand MEP Engineering
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    Save 90% compared to traditional third-party MEP consultant callout fees. Instant point-to-point solutions.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                
                <!-- Plan 1: ₹199 Single Emergency Case -->
                <div class="bg-white rounded-3xl p-8 border border-slate-200/90 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Single Emergency Case</h3>
                            <p class="text-xs text-slate-500 mt-1">Ideal for an urgent site breakdown, pump trip, or authority code clarification.</p>
                        </div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-black text-slate-900">₹199</span>
                            <span class="text-xs font-semibold text-slate-500">/ one-time</span>
                        </div>
                        <ul class="space-y-3 pt-2">
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>1 Complete Point-to-Point MEP Solution</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Assigned Licensed Professional Engineer</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Exact Sizing Formulas &amp; Code Clauses</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>24h Follow-up Chat with MEP Specialist</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Export to Calculation Notes &amp; PDF</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <button onclick="facilityProOpenConsultationModal('I would like to activate the Single Emergency Case plan (₹199).')" class="w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm bg-[#0077c8] hover:bg-[#0066ad] text-white transition-all cursor-pointer shadow-md">
                            Solve Issue for ₹199
                        </button>
                        <div class="text-center mt-2">
                            <span class="text-[10px] text-slate-400 font-medium flex items-center justify-center gap-1">
                                <i data-lucide="shield-check" class="w-3 h-3 text-emerald-500"></i> 100% Code-Compliance Guarantee
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Plan 2: ₹399 Facility Pro Monthly (Most Popular) -->
                <div class="bg-white rounded-3xl p-8 border border-[#f05423] shadow-2xl ring-2 ring-[#f05423]/20 scale-105 z-10 transition-all duration-300 flex flex-col justify-between relative">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#f05423] text-white text-xs font-black uppercase px-4 py-1 rounded-full shadow-md tracking-wider flex items-center gap-1">
                        <i data-lucide="sparkles" class="w-3 h-3 fill-white"></i>
                        <span>Most Popular for Plants</span>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Facility Pro Monthly</h3>
                            <p class="text-xs text-slate-500 mt-1">Unlimited point-to-point Q&amp;A for Facility Managers, MEP Contractors &amp; Plant Engineers.</p>
                        </div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-black text-slate-900">₹399</span>
                            <span class="text-xs font-semibold text-slate-500">/ per month</span>
                        </div>
                        <ul class="space-y-3 pt-2">
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Unlimited HVAC, Plumbing, Electrical &amp; Fire Q&amp;A</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Direct OpenAI GPT-4o MEP Reasoning</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Priority Response (&lt; 5s) from AI Models</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>ASHRAE, NFPA, NEC, IS &amp; IPC Standards Engine</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Full Engineering Equations &amp; Math Steps</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-emerald-100 text-emerald-600"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Cancel Anytime With 1-Click</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <button onclick="facilityProOpenConsultationModal('I would like to activate the Facility Pro Monthly plan (₹399).')" class="w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm bg-[#f05423] hover:bg-[#ff6f3c] text-white shadow-orange-500/30 transition-all cursor-pointer shadow-md">
                            Get Pro Access for ₹399
                        </button>
                        <div class="text-center mt-2">
                            <span class="text-[10px] text-slate-400 font-medium flex items-center justify-center gap-1">
                                <i data-lucide="shield-check" class="w-3 h-3 text-emerald-500"></i> 100% Code-Compliance Guarantee
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Plan 3: Enterprise (Coming Soon) -->
                <div class="bg-slate-50/50 rounded-3xl p-8 border border-slate-200 shadow-sm opacity-90 flex flex-col justify-between relative">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-slate-800 text-amber-300 text-xs font-black uppercase px-4 py-1 rounded-full shadow-md tracking-wider flex items-center gap-1 border border-amber-300/30">
                        <i data-lucide="clock" class="w-3 h-3 text-amber-400"></i>
                        <span>Coming Soon</span>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Enterprise MEP &amp; Plant Lab</h3>
                            <p class="text-xs text-slate-500 mt-1">For MEP Consultancy firms, Hospital facilities, and Data Center operations teams.</p>
                        </div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-slate-700">Coming Soon</span>
                        </div>
                        <ul class="space-y-3 pt-2">
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-slate-200 text-slate-500"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Everything in Facility Pro</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-slate-200 text-slate-500"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Up to 10 Site Engineer Seats</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-slate-200 text-slate-500"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Custom OpenAI API Key Bring-Your-Own</span>
                            </li>
                            <li class="flex items-center gap-3 text-xs font-semibold text-slate-700">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 bg-slate-200 text-slate-500"><i data-lucide="check" class="w-3 h-3 stroke-[3]"></i></div>
                                <span>Single Line Diagram (SLD) &amp; Hydraulic Review</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <button disabled class="w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm bg-slate-200 text-slate-500 cursor-not-allowed flex items-center justify-center gap-2 border border-slate-300">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                            <span>Coming Soon</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
