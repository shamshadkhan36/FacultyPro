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
        
        <!-- Header -->
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

        <!-- Pricing Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            <!-- Plan 1: Single Emergency Case -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col justify-between hover:shadow-xl transition-all">
                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 mb-4">
                        Quick Solver
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Single Emergency Case</h2>
                    <p class="text-xs text-slate-500 mt-2">Essential MEP point-to-point Q&A and urgent diagnostic troubleshooting for plant engineers.</p>
                    
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-4xl font-black text-slate-900">₹199</span>
                        <span class="text-xs font-semibold text-slate-500">/ one-time</span>
                    </div>

                    <ul class="mt-8 space-y-3.5 text-xs text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>1 Complete Point-to-Point MEP Solution</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>Assigned Licensed Professional Engineer</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>Exact Sizing Formulas & Code Clauses</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>24h Follow-up Chat with Specialist</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#0077c8]"></i>
                            <span>Export to Calculation Notes & PDF</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8">
                    <button onclick="facilityProOpenConsultationModal('Single Emergency Case (₹199): ')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-slate-900 hover:bg-[#0077c8] text-white transition-colors shadow-md flex items-center justify-center gap-2">
                        <span>Solve for ₹199</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Plan 2: Facility Pro Monthly (Featured) -->
            <div class="bg-gradient-to-b from-slate-900 to-slate-800 rounded-2xl shadow-2xl border-2 border-[#f05423] p-8 flex flex-col justify-between relative transform md:-translate-y-2 text-white">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#f05423] text-white text-[11px] font-black uppercase tracking-wider px-4 py-1 rounded-full shadow-md">
                    Most Popular for Plants
                </div>

                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-white/10 text-white mb-4 mt-2">
                        Unlimited Access
                    </div>
                    <h2 class="text-2xl font-black text-white">Facility Pro Monthly</h2>
                    <p class="text-xs text-slate-300 mt-2">Unlimited point-to-point Q&A for Facility Managers, MEP Contractors & Plant Engineers.</p>
                    
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-5xl font-black text-white">₹399</span>
                        <span class="text-xs font-semibold text-slate-300">/ per month</span>
                    </div>

                    <ul class="mt-8 space-y-3.5 text-xs text-slate-200">
                        <li class="flex items-center gap-2.5 font-medium">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Unlimited OpenAI GPT-4o Point-to-Point Q&A</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>All 6 Interactive Engineering Calculators</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Full Access to 50+ MEP SOPs</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Interactive Maintenance Checklists</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Export Calculations to Markdown & PDF</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-[#f05423]"></i>
                            <span>Direct Question Routing to Licensed PEs</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8">
                    <button onclick="facilityProOpenAuthModal('signup')" class="w-full py-4 px-4 rounded-xl font-black text-sm bg-[#f05423] hover:bg-[#d94416] text-white transition-all shadow-lg flex items-center justify-center gap-2">
                        <span>Upgrade for ₹399/mo</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                    <p class="text-[11px] text-center text-slate-400 mt-2">Cancel anytime • 100% Satisfaction Guarantee</p>
                </div>
            </div>

            <!-- Plan 3: Enterprise MEP Lab -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col justify-between hover:shadow-xl transition-all">
                <div>
                    <div class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 mb-4">
                        Enterprise Plant Lab
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Enterprise MEP Lab</h2>
                    <p class="text-xs text-slate-500 mt-2">For MEP Consultancy firms, Hospital facilities, and Data Center operations teams.</p>
                    
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-3xl font-black text-slate-900">Custom</span>
                        <span class="text-xs font-semibold text-slate-500">/ Plant SLA</span>
                    </div>

                    <ul class="mt-8 space-y-3.5 text-xs text-slate-700">
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                            <span>Everything in Facility Pro</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                            <span>Up to 10 Site Engineer Seats</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                            <span>Customized Plant SOPs & LOTO Standards</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                            <span>Single Line Diagram (SLD) & Hydraulic Review</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                            <span>Dedicated Senior MEP Account Manager</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8">
                    <button onclick="facilityProOpenConsultationModal('Enterprise Custom Plan Inquiry: ')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-slate-100 hover:bg-slate-200 text-slate-800 transition-colors flex items-center justify-center gap-2">
                        <span>Contact Plant Solutions</span>
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
get_footer();
