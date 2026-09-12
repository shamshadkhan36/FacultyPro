<?php
/**
 * Template Name: MEP Calculators
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                <i data-lucide="calculator" class="w-4 h-4"></i>
                <span>Interactive MEP Calculators</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Engineering Sizing & Code Compliance Calculators
            </h1>
            <p class="mt-2 text-base text-slate-600">
                Exact formulas conforming to ASHRAE, IEEE, IPC, and NFPA standards. Verify any calculation live with our AI Engineering Specialist.
            </p>
        </div>

        <!-- Calculator Tab Buttons -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar" id="calcTabsNav">
            <button onclick="switchCalcTab('cooling')" data-tab="cooling" class="calc-tab-btn active flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-slate-900 text-white border-slate-900 shadow-md">
                <i data-lucide="wind" class="w-4 h-4 text-[#f05423]"></i>
                <span>Cooling Load (TR)</span>
            </button>
            <button onclick="switchCalcTab('duct')" data-tab="duct" class="calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100">
                <i data-lucide="layers" class="w-4 h-4 text-teal-500"></i>
                <span>Duct Sizing (CFM)</span>
            </button>
            <button onclick="switchCalcTab('pump')" data-tab="pump" class="calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100">
                <i data-lucide="rotate-cw" class="w-4 h-4 text-blue-500"></i>
                <span>Pump TDH & Power</span>
            </button>
            <button onclick="switchCalcTab('electrical')" data-tab="electrical" class="calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100">
                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                <span>Cable & Voltage Drop</span>
            </button>
            <button onclick="switchCalcTab('chiller')" data-tab="chiller" class="calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100">
                <i data-lucide="gauge" class="w-4 h-4 text-emerald-500"></i>
                <span>Chiller COP & kW/TR</span>
            </button>
            <button onclick="switchCalcTab('fire')" data-tab="fire" class="calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100">
                <i data-lucide="flame" class="w-4 h-4 text-rose-500"></i>
                <span>NFPA 13 Fire Flow</span>
            </button>
        </div>

        <!-- Calculator Panels -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            
            <!-- 1. COOLING LOAD -->
            <div id="calc-cooling" class="calc-panel p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="wind" class="w-5 h-5 text-sky-500"></i>
                            <span>Space Cooling Load & Chiller Tonnage</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Conforms to ASHRAE Standard 90.1 / CLTD Method</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Floor Area (sq. ft.)</label>
                            <input type="number" id="cooling_area" value="2500" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateCoolingLoad()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Occupancy Application</label>
                            <select id="cooling_space" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" onchange="calculateCoolingLoad()">
                                <option value="office">Commercial Office (35 BTU/sq.ft)</option>
                                <option value="restaurant">Restaurant / Dining (65 BTU/sq.ft)</option>
                                <option value="data_center">Data Center / Server Room (120 BTU/sq.ft)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Peak Occupant Count</label>
                            <input type="number" id="cooling_occupants" value="25" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateCoolingLoad()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Equipment / Plug Load (Watts)</label>
                            <input type="number" id="cooling_watts" value="15000" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateCoolingLoad()">
                        </div>
                    </div>

                    <div class="bg-blue-50/70 rounded-xl p-4 border border-blue-100 flex items-start gap-3">
                        <i data-lucide="sparkles" class="w-5 h-5 text-[#0077c8] flex-shrink-0 mt-0.5"></i>
                        <div class="text-xs text-slate-700 leading-relaxed">
                            <span class="font-bold text-slate-900">Engineering Rule:</span> Sensible + Latent loads computed with safety factor. Formula assumes 400 CFM per TR of cooling capacity conforming to ASHRAE 62.1 fresh air ventilation.
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Calculation Results</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-[#0077c8] text-white">ASHRAE 90.1</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Estimated Cooling Capacity</div>
                                <div class="text-3xl font-black text-[#f05423] mt-1" id="res_cooling_tr">12.5 TR</div>
                                <div class="text-xs text-slate-400 mt-1" id="res_cooling_kw">(43.9 kW Cooling)</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Supply Airflow</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_cooling_cfm">5,000 CFM</div>
                                </div>
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Total Heat Gain</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_cooling_btu">149,930 BTU/h</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('cooling')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_cooling">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on Cooling Load Sizing calculation of ' + document.getElementById('res_cooling_tr').textContent + ' for ' + document.getElementById('cooling_area').value + ' sq ft space')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. DUCT SIZING -->
            <div id="calc-duct" class="calc-panel hidden p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="layers" class="w-5 h-5 text-teal-500"></i>
                            <span>Equal Velocity Air Duct Sizing (Rectangular & Round)</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Conforms to SMACNA HVAC Duct Construction Standards</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Airflow Volume (CFM)</label>
                            <input type="number" id="duct_cfm" value="3200" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateDuctSize()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Target Velocity (FPM)</label>
                            <input type="number" id="duct_velocity" value="1200" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateDuctSize()">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Aspect Ratio (Width : Height)</label>
                            <select id="duct_aspect" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" onchange="calculateDuctSize()">
                                <option value="1.0">1 : 1 (Square Duct - Maximum Aerodynamic Efficiency)</option>
                                <option value="1.5" selected>1.5 : 1 (Recommended Commercial Branch)</option>
                                <option value="2.0">2 : 1 (Low Plenum Clearance)</option>
                                <option value="3.0">3 : 1 (Tight Ceiling Restricted Space)</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-teal-50/70 rounded-xl p-4 border border-teal-100 flex items-start gap-3">
                        <i data-lucide="sparkles" class="w-5 h-5 text-teal-600 flex-shrink-0 mt-0.5"></i>
                        <div class="text-xs text-slate-700 leading-relaxed">
                            <span class="font-bold text-slate-900">SMACNA Guideline:</span> Main supply ducts typically operate between 1,000–1,500 FPM. Branch runouts should be restricted to 600–900 FPM for NC < 35 acoustic criteria.
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Duct Dimensions</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-teal-500 text-white">SMACNA</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Rectangular Duct Size (W × H)</div>
                                <div class="text-3xl font-black text-teal-400 mt-1" id="res_duct_rect">24" × 16"</div>
                                <div class="text-xs text-slate-400 mt-1" id="res_duct_area">(384 sq. inches / 2.67 sq. ft)</div>
                            </div>
                            <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                <div class="text-[11px] text-slate-400 font-medium">Equivalent Round Duct Diameter</div>
                                <div class="text-xl font-bold text-white mt-0.5" id="res_duct_round">22.1" Ø</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('duct')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_duct">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on Air Duct Sizing calculation of ' + document.getElementById('res_duct_rect').textContent + ' for ' + document.getElementById('duct_cfm').value + ' CFM airflow')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3. PUMP TDH -->
            <div id="calc-pump" class="calc-panel hidden p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="rotate-cw" class="w-5 h-5 text-blue-500"></i>
                            <span>Pump Total Dynamic Head (TDH) & Motor Power</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Hydraulic Institute (HI) & Darcy-Weisbach Standard</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Flow Rate (GPM)</label>
                            <input type="number" id="pump_flow" value="350" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Static Elevation Head (Feet)</label>
                            <input type="number" id="pump_static" value="45" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Total Pipe Run (Feet)</label>
                            <input type="number" id="pump_length" value="220" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Friction Loss (Ft / 100ft)</label>
                            <input type="number" step="0.1" id="pump_friction" value="3.2" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Residual Terminal Pressure (PSI)</label>
                            <input type="number" id="pump_residual" value="15" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Pump Hydraulic Efficiency (%)</label>
                            <input type="number" id="pump_eff" value="78" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculatePump()">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Hydraulic Sizing</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-500 text-white">Hydraulic Inst</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Total Dynamic Head (TDH)</div>
                                <div class="text-3xl font-black text-sky-400 mt-1" id="res_pump_tdh">86.7 Ft</div>
                                <div class="text-xs text-slate-400 mt-1" id="res_pump_meters">(26.4 meters / 2.59 bar)</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Brake Horsepower (BHP)</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_pump_bhp">9.83 HP</div>
                                </div>
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Motor Power (kW)</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_pump_kw">7.33 kW</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('pump')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_pump">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on Pump TDH calculation of ' + document.getElementById('res_pump_tdh').textContent + ' and Motor Power ' + document.getElementById('res_pump_kw').textContent + ' for ' + document.getElementById('pump_flow').value + ' GPM flow')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. ELECTRICAL CABLE -->
            <div id="calc-electrical" class="calc-panel hidden p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="zap" class="w-5 h-5 text-amber-500"></i>
                            <span>3-Phase Cable Sizing & Voltage Drop Calculator</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Conforms to IEC 60364-5-52 / IEEE / NFPA 70 (NEC)</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Connected Load (kW)</label>
                            <input type="number" id="elec_kw" value="75" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateElectrical()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">System Line Voltage (V)</label>
                            <input type="number" id="elec_voltage" value="415" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateElectrical()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Power Factor (cos φ)</label>
                            <input type="number" step="0.01" id="elec_pf" value="0.85" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateElectrical()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Cable Run Length (Meters)</label>
                            <input type="number" id="elec_length" value="85" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateElectrical()">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Conductor Material</label>
                            <select id="elec_material" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" onchange="calculateElectrical()">
                                <option value="copper">Electrolytic Copper (0.0175 Ω·mm²/m)</option>
                                <option value="aluminum">Electrical Grade Aluminum (0.028 Ω·mm²/m)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Electrical Compliance</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-amber-500 text-white">IEC 60364</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Recommended Cable Cross-Section</div>
                                <div class="text-3xl font-black text-amber-400 mt-1" id="res_elec_cable">70 sq.mm</div>
                                <div class="text-xs text-slate-400 mt-1" id="res_elec_current">Full Load Current: 122.8 Amps</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Voltage Drop</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_elec_vdrop">3.83 Volts</div>
                                </div>
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">% Voltage Drop</div>
                                    <div class="text-lg font-bold text-emerald-400 mt-0.5" id="res_elec_vdroppct">0.92% (Pass)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('electrical')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_electrical">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on 3-Phase Cable Sizing of ' + document.getElementById('res_elec_cable').textContent + ' for ' + document.getElementById('elec_kw').value + ' kW load at ' + document.getElementById('elec_length').value + 'm distance')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 5. CHILLER COP -->
            <div id="calc-chiller" class="calc-panel hidden p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="gauge" class="w-5 h-5 text-emerald-500"></i>
                            <span>Chiller Efficiency, COP & kW/TR Benchmarking</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Conforms to AHRI Standard 550/590 & ASHRAE 90.1</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Chiller Rated Tonnage (TR)</label>
                            <input type="number" id="chiller_tr" value="350" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateChillerEfficiency()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Measured Electrical Power (kW)</label>
                            <input type="number" id="chiller_kw" value="210" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateChillerEfficiency()">
                        </div>
                    </div>

                    <div class="bg-emerald-50/70 rounded-xl p-4 border border-emerald-100 flex items-start gap-3">
                        <i data-lucide="sparkles" class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5"></i>
                        <div class="text-xs text-slate-700 leading-relaxed">
                            <span class="font-bold text-slate-900">ASHRAE 90.1 Benchmark:</span> High-efficiency water-cooled centrifugal chillers achieve <= 0.58 kW/TR (COP >= 6.0). Values exceeding 0.75 kW/TR indicate tube fouling or low delta-T syndrome.
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Chiller Performance</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-500 text-white">AHRI 550/590</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Specific Power Consumption</div>
                                <div class="text-3xl font-black text-emerald-400 mt-1" id="res_chiller_kwtr">0.600 kW/TR</div>
                                <div class="text-xs text-emerald-400 font-bold mt-1" id="res_chiller_ashrae">✓ Compliant with ASHRAE 90.1 Path B</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Coefficient of Perf. (COP)</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_chiller_cop">5.86</div>
                                </div>
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Energy Efficiency Ratio</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_chiller_eer">20.00 EER</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('chiller')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_chiller">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on Chiller Plant Efficiency calculation of ' + document.getElementById('res_chiller_kwtr').textContent + ' for ' + document.getElementById('chiller_tr').value + ' TR capacity')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 6. FIRE SPRINKLER FLOW -->
            <div id="calc-fire" class="calc-panel hidden p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="flame" class="w-5 h-5 text-rose-500"></i>
                            <span>NFPA 13 Fire Sprinkler & Hose Stream Demand</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Conforms to NFPA 13 Density/Area Curves & NFPA 20/22</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Occupancy Hazard Classification</label>
                            <select id="fire_hazard" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" onchange="calculateFireDemand()">
                                <option value="light">Light Hazard (0.10 GPM/sq.ft - Offices, Hotels, Schools)</option>
                                <option value="ordinary1">Ordinary Hazard Group 1 (0.15 GPM/sq.ft - Car Parks, Bakeries)</option>
                                <option value="ordinary2" selected>Ordinary Hazard Group 2 (0.20 GPM/sq.ft - Commercial, Retail)</option>
                                <option value="extra1">Extra Hazard Group 1 (0.30 GPM/sq.ft - Heavy Industrial, Printing)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Hydraulic Remote Area (sq. ft.)</label>
                            <input type="number" id="fire_area" value="1500" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateFireDemand()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Inside/Outside Hose Stream (GPM)</label>
                            <input type="number" id="fire_hose" value="250" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" oninput="calculateFireDemand()">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-xl p-6 flex flex-col justify-between shadow-inner">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Fire Water Demand</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-rose-500 text-white">NFPA 13</span>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-slate-800/80 p-4 rounded-lg border border-slate-700/60">
                                <div class="text-xs text-slate-400 font-medium">Total Fire Pump Flow Demand</div>
                                <div class="text-3xl font-black text-rose-400 mt-1" id="res_fire_flow">595 GPM</div>
                                <div class="text-xs text-slate-400 mt-1" id="res_fire_m3hr">(135.1 m³/hr / 2,252 LPM)</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">Sprinkler Demand</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_fire_sprinkler">345 GPM</div>
                                </div>
                                <div class="bg-slate-800/50 p-3 rounded-lg border border-slate-700/40">
                                    <div class="text-[11px] text-slate-400 font-medium">60-Min Tank Volume</div>
                                    <div class="text-lg font-bold text-white mt-0.5" id="res_fire_tank">135 m³</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-700 flex flex-col sm:flex-row gap-2">
                        <button onclick="copyCalcResult('fire')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold text-slate-200 transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                            <span id="copy_btn_fire">Copy Results</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need verification on NFPA 13 Fire Sprinkler Flow calculation of ' + document.getElementById('res_fire_flow').textContent + ' for ' + document.getElementById('fire_area').value + ' sq ft hydraulic area')" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 bg-[#f05423] hover:bg-[#d94416] rounded-lg text-xs font-bold text-white transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI Expert</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
get_footer();
