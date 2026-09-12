<!-- Main Footer -->
<footer class="bg-[#07172b] text-white border-t border-slate-800 mt-auto pt-16 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800/80">
            
            <!-- Col 1: Brand & Bio -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-[#0077c8] flex items-center justify-center text-white shadow-md">
                        <i data-lucide="wrench" class="w-5 h-5 stroke-[2.2]"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white">Facility<span class="text-[#f05423]">Pro</span></span>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm leading-relaxed max-w-sm">
                    The mathematical precision of OpenAI GPT-4o combined with the real-world authority of licensed Indian Professional Engineers (PE, ISHRAE, NFPA, IEEE).
                </p>
                <div class="pt-2 flex items-center gap-3 text-xs text-slate-400">
                    <span class="inline-flex items-center gap-1 text-emerald-400 font-bold bg-emerald-950/60 px-2.5 py-1 rounded-full border border-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span> 99.9% Code Compliance
                    </span>
                    <span>&bull; IS / NBC 2016 Verified</span>
                </div>
            </div>

            <!-- Col 2: Engineering Disciplines -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-300">MEP Disciplines</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="<?php echo esc_url(home_url('/#popular')); ?>" onclick="facilityProFilterCategory('hvac')" class="hover:text-white transition-colors">Central HVAC & Chillers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#popular')); ?>" onclick="facilityProFilterCategory('plumbing')" class="hover:text-white transition-colors">Plumbing & Booster Pumps</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#popular')); ?>" onclick="facilityProFilterCategory('electrical')" class="hover:text-white transition-colors">HT/LT Substations & Power</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#popular')); ?>" onclick="facilityProFilterCategory('firefighting')" class="hover:text-white transition-colors">NFPA 13 Fire Sprinklers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/calculators')); ?>" class="hover:text-white transition-colors">6 Engineering Calculators</a></li>
                </ul>
            </div>

            <!-- Col 3: Operations & SOPs -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-300">Plant Operations</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="<?php echo esc_url(home_url('/sop-library')); ?>" class="hover:text-white transition-colors">Plant SOP Library (50+)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/checklists')); ?>" class="hover:text-white transition-colors">Daily Equipment Checklists</a></li>
                    <li><a href="<?php echo esc_url(home_url('/knowledge-hub')); ?>" class="hover:text-white transition-colors">Technical Knowledge Hub</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pricing')); ?>" class="hover:text-white transition-colors">Facility Pricing (₹199 / ₹399)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="hover:text-white transition-colors">Client Engineer Portal</a></li>
                </ul>
            </div>

            <!-- Col 4: Governing Standards -->
            <div class="space-y-3">
                <h4 class="text-xs font-black uppercase tracking-wider text-slate-300">Codes & Standards</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><span>&bull; NBC 2016 (National Building Code)</span></li>
                    <li><span>&bull; ISHRAE / ASHRAE 90.1 & 62.1</span></li>
                    <li><span>&bull; NFPA 13, 14, 20 & 72 Safety</span></li>
                    <li><span>&bull; IS 2026 & IEC 60364 Power</span></li>
                    <li><span>&bull; LEED AP Building Standard</span></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <div>
                &copy; <?php echo esc_html(date('Y')); ?> FacilityPro Engineering. All rights reserved. IS/NBC & ASHRAE compliant.
            </div>
            <div class="flex items-center gap-6">
                <a href="<?php echo esc_url(home_url('/#pricing')); ?>" class="hover:text-white transition-colors">Pricing</a>
                <a href="<?php echo esc_url(home_url('/#experts')); ?>" class="hover:text-white transition-colors">AI Experts</a>
                <a href="<?php echo esc_url(home_url('/knowledge-hub')); ?>" class="hover:text-white transition-colors">Knowledge Base</a>
                <a href="mailto:<?php echo esc_attr(get_option('facilitypro_contact_email', 'consult@facilitypro.ai')); ?>" class="hover:text-white transition-colors">Contact Support</a>
            </div>
        </div>

    </div>
</footer>

<!-- ======================================================== -->
<!-- MODAL 1: Point-to-Point AI Consultation Modal            -->
<!-- ======================================================== -->
<div id="facilitypro-consultation-modal" class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 overflow-y-auto animate-in fade-in duration-200">
    <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[92vh] flex flex-col overflow-hidden border border-slate-200 my-auto">
        
        <!-- Modal Header -->
        <div class="p-4 sm:p-6 bg-gradient-to-r from-[#0b2545] to-[#134074] text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative shrink-0">
                    <img id="modal-expert-avatar" src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_rajesh_sharma.jpg'); ?>" alt="AI Expert" class="w-12 h-12 rounded-full object-cover ring-2 ring-white/40">
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 border-2 border-slate-900 rounded-full"></span>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 id="modal-expert-name" class="text-base sm:text-lg font-black text-white">Er. Rajesh Sharma</h3>
                        <span class="px-2 py-0.5 rounded-full bg-purple-500/30 text-purple-200 text-[10px] font-bold border border-purple-300/30">AI Consultant</span>
                    </div>
                    <p id="modal-expert-title" class="text-xs text-slate-300">Senior HVAC & Central Chilled Water AI Specialist</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <button type="button" onclick="facilityProExportModalAnswer()" class="p-2 text-slate-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors cursor-pointer" title="Export as PDF / Print">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                </button>
                <button type="button" onclick="facilityProCloseConsultationModal()" class="p-2 text-slate-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors cursor-pointer" title="Close Modal">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body (Chat / Reasoning Screen) -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 bg-slate-50 min-h-[320px] max-h-[58vh]" id="modal-chat-scroll">
            
            <!-- User Question Bubble -->
            <div class="flex justify-end">
                <div class="bg-[#0077c8] text-white rounded-2xl rounded-tr-none p-4 max-w-[85%] text-xs sm:text-sm font-medium shadow-sm">
                    <div class="text-[10px] font-bold opacity-80 mb-1 flex items-center gap-1">
                        <i data-lucide="user" class="w-3 h-3"></i> Your Engineering Query:
                    </div>
                    <div id="modal-user-query-text">Calculating Chiller Approach Temperature & Surging...</div>
                </div>
            </div>

            <!-- AI Point-to-Point Solution Card -->
            <div class="flex justify-start">
                <div class="bg-white border border-slate-200/90 rounded-2xl rounded-tl-none p-5 sm:p-6 max-w-[95%] sm:max-w-[90%] shadow-md space-y-3">
                    
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2 text-xs font-black text-slate-900">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Verified Point-to-Point Diagnostic Solution</span>
                        </div>
                        <span class="text-[10px] text-slate-400 font-semibold">National Building Code (NBC) & ASHRAE</span>
                    </div>

                    <!-- AI Reasoning Content -->
                    <div id="modal-ai-answer-content" class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3 font-normal prose prose-sm max-w-none">
                        <div class="flex items-center gap-3 py-6 justify-center text-slate-500 text-xs">
                            <i data-lucide="loader-2" class="w-5 h-5 animate-spin text-[#0077c8]"></i>
                            <span>Formulating thermodynamic derivations and code clauses...</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal Footer Query Input Box -->
        <div class="p-3 sm:p-4 bg-white border-t border-slate-200">
            <form onsubmit="facilityProHandleModalSubmit(event)" class="flex items-center gap-2">
                <input type="text" id="modal-query-input" placeholder="Ask follow-up calculation or code clarification..." class="flex-1 text-xs sm:text-sm p-3 rounded-xl border border-slate-300 focus:outline-none focus:border-[#0077c8] bg-slate-50 text-slate-900">
                <button type="submit" class="px-5 py-3 rounded-xl bg-[#f05423] hover:bg-[#d84315] text-white font-bold text-xs sm:text-sm flex items-center gap-1.5 shadow-md shadow-orange-500/20 cursor-pointer">
                    <span>Ask AI</span>
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL 2: Client Auth Modal                               -->
<!-- ======================================================== -->
<div id="facilitypro-auth-modal" class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 sm:p-8 border border-slate-200 space-y-5">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-black text-slate-900">FacilityPro Client Portal</h3>
            <button onclick="facilityProCloseAuthModal()" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
        </div>
        <p class="text-xs text-slate-500">Access saved plant sizing calculations, calculation sheets, and assigned Indian AI specialists.</p>
        <div class="space-y-3">
            <div>
                <label class="text-xs font-bold text-slate-700 block mb-1">Corporate / Plant Email</label>
                <input type="email" placeholder="engineer@facility.com" class="w-full text-xs p-3 rounded-xl border border-slate-300">
            </div>
            <div>
                <label class="text-xs font-bold text-slate-700 block mb-1">Password</label>
                <input type="password" placeholder="••••••••" class="w-full text-xs p-3 rounded-xl border border-slate-300">
            </div>
            <button type="button" onclick="facilityProCloseAuthModal(); alert('Welcome back to FacilityPro!');" class="w-full py-3 rounded-xl bg-[#0077c8] hover:bg-[#0062a4] text-white font-bold text-xs shadow-md">
                Log In
            </button>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- FLOATING 24/7 AI CHAT WIDGET                             -->
<!-- ======================================================== -->
<div class="fixed bottom-5 right-5 z-40 flex flex-col items-end space-y-3">
    
    <!-- Collapsible Chat Box -->
    <div id="floating-chat-drawer" class="hidden bg-white rounded-3xl shadow-2xl border border-slate-200 w-80 sm:w-96 p-4 space-y-3 animate-in fade-in slide-in-from-bottom duration-200">
        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[#0077c8]">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-slate-900">AI MEP Live Helper</h4>
                    <span class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online &bull; &lt; 5s derivation
                    </span>
                </div>
            </div>
            <button onclick="facilityProToggleFloatingChat()" class="text-slate-400 hover:text-slate-600 p-1"><i data-lucide="x" class="w-4 h-4"></i></button>
        </div>

        <div class="p-3 rounded-xl bg-blue-50 text-xs text-slate-700 leading-relaxed font-medium">
            <strong>Er. Rajesh Sharma (AI HVAC):</strong> "Hello! What HVAC, Plumbing, Electrical, or Fire Fighting issue can our AI Engineers troubleshoot for you today?"
        </div>

        <form onsubmit="facilityProHandleFloatingSubmit(event)" class="space-y-2">
            <textarea id="floating-chat-input" placeholder="Ask about chiller surging, water hammer, transformer inrush..." rows="2" class="w-full text-xs p-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#0077c8] resize-none text-slate-800"></textarea>
            <div class="flex items-center justify-between">
                <span class="text-[10px] text-slate-400">Point-to-Point Solution</span>
                <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-[#f05423] hover:bg-[#d84315] text-white text-xs font-bold flex items-center gap-1 shadow-xs cursor-pointer">
                    <span>Ask AI</span>
                    <i data-lucide="send" class="w-3 h-3"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Floating Trigger Avatar & Badge -->
    <div class="flex items-center gap-3">
        <div onclick="facilityProToggleFloatingChat()" class="hidden sm:flex items-center gap-2 bg-white/95 backdrop-blur-md px-3.5 py-2 rounded-2xl shadow-xl border border-slate-200 text-xs font-bold text-slate-800 cursor-pointer hover:border-[#0077c8] hover:shadow-2xl transition-all">
            <i data-lucide="sparkles" class="w-4 h-4 text-[#f05423]"></i>
            <span>Ask our AI MEP Consultants</span>
        </div>
        <div onclick="facilityProToggleFloatingChat()" class="relative cursor-pointer group">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden border-2 border-white shadow-2xl ring-4 ring-blue-500/30 group-hover:ring-[#f05423] transition-all group-hover:scale-105">
                <img src="<?php echo esc_url(FACILITYPRO_URI . '/assets/images/avatar_rajesh_sharma.jpg'); ?>" alt="AI MEP Consultant" class="w-full h-full object-cover">
            </div>
            <span class="absolute top-0 right-0 w-5 h-5 bg-[#e11d48] text-white font-extrabold text-[11px] rounded-full flex items-center justify-center border-2 border-white shadow-md animate-pulse">1</span>
        </div>
    </div>

</div>

<?php wp_footer(); ?>
</body>
</html>
