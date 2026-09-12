<?php
/**
 * Template Name: User Dashboard
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Top Engineer Bar -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-2xl font-black shadow-md">
                    FP
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-black text-slate-900">Plant Engineer Portal</h1>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-700">Active Member</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Plan: <strong class="text-slate-800">Facility Pro Monthly (₹399/mo)</strong> • Unlimited OpenAI GPT-4o Consultations</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="facilityProOpenConsultationModal()" class="px-4 py-2.5 bg-[#f05423] hover:bg-[#d94416] text-white rounded-xl text-xs font-bold flex items-center gap-2 transition-all shadow-md">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    <span>New AI Consultation</span>
                </button>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Queries</span>
                    <i data-lucide="message-square" class="w-4 h-4 text-blue-500"></i>
                </div>
                <div class="text-2xl font-black text-slate-900 mt-2">18</div>
                <div class="text-[11px] text-emerald-600 font-semibold mt-1">100% Solved Point-to-Point</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Calculations Run</span>
                    <i data-lucide="calculator" class="w-4 h-4 text-teal-500"></i>
                </div>
                <div class="text-2xl font-black text-slate-900 mt-2">42</div>
                <div class="text-[11px] text-slate-500 font-semibold mt-1">Across 6 MEP Tools</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">SOPs Executed</span>
                    <i data-lucide="shield-check" class="w-4 h-4 text-amber-500"></i>
                </div>
                <div class="text-2xl font-black text-slate-900 mt-2">9</div>
                <div class="text-[11px] text-slate-500 font-semibold mt-1">Audits verified</div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Assigned Experts</span>
                    <i data-lucide="users" class="w-4 h-4 text-purple-500"></i>
                </div>
                <div class="text-2xl font-black text-slate-900 mt-2">4</div>
                <div class="text-[11px] text-slate-500 font-semibold mt-1">All 4 Disciplines Online</div>
            </div>
        </div>

        <!-- Recent Activity & Shortcuts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <i data-lucide="clock" class="w-5 h-5 text-slate-500"></i>
                    <span>Recent Diagnostic Sessions</span>
                </h2>
                <div class="space-y-3">
                    <div class="p-4 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors flex items-center justify-between cursor-pointer" onclick="facilityProOpenConsultationModal('Centrifugal chiller low delta-T syndrome review')">
                        <div>
                            <div class="text-sm font-bold text-slate-900">Centrifugal chiller low delta-T syndrome & approach > 3.5°F</div>
                            <div class="text-xs text-slate-500 mt-1">Solved by Er. Rajesh Sharma (HVAC) • 2 days ago</div>
                        </div>
                        <span class="px-2.5 py-1 rounded bg-emerald-50 text-emerald-700 text-xs font-bold">Resolved</span>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors flex items-center justify-between cursor-pointer" onclick="facilityProOpenConsultationModal('Transformer 87T differential relay harmonic restraint calculation')">
                        <div>
                            <div class="text-sm font-bold text-slate-900">11kV Transformer 87T Inrush Relay 2nd Harmonic Restraint</div>
                            <div class="text-xs text-slate-500 mt-1">Solved by Dr. Vikram Malhotra (Electrical) • 4 days ago</div>
                        </div>
                        <span class="px-2.5 py-1 rounded bg-emerald-50 text-emerald-700 text-xs font-bold">Resolved</span>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors flex items-center justify-between cursor-pointer" onclick="facilityProOpenConsultationModal('NFPA 13 Fire pump churn pressure relief setup')">
                        <div>
                            <div class="text-sm font-bold text-slate-900">NFPA 13 Fire pump churn test casing relief calibration</div>
                            <div class="text-xs text-slate-500 mt-1">Solved by Er. Ananya Verma (Fire Safety) • 1 week ago</div>
                        </div>
                        <span class="px-2.5 py-1 rounded bg-emerald-50 text-emerald-700 text-xs font-bold">Resolved</span>
                    </div>
                </div>
            </div>

            <!-- Quick Engineering Tools -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                <h2 class="text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <i data-lucide="tool" class="w-5 h-5 text-slate-500"></i>
                    <span>Quick Tool Access</span>
                </h2>

                <a href="<?php echo esc_url(home_url('/calculators')); ?>" class="block p-3.5 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/40 transition-all">
                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                        <span>Chiller TR & Duct Sizer</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">ASHRAE 90.1 & SMACNA formulas</div>
                </a>

                <a href="<?php echo esc_url(home_url('/sop-library')); ?>" class="block p-3.5 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/40 transition-all">
                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                        <span>Plant SOP Library</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Standard operating sequences & LOTO</div>
                </a>

                <a href="<?php echo esc_url(home_url('/checklists')); ?>" class="block p-3.5 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/40 transition-all">
                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                        <span>Preventive Maintenance Audits</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Daily, weekly & monthly inspection logs</div>
                </a>
            </div>
        </div>

    </div>
</div>

<?php
get_footer();
