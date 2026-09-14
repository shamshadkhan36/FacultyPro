<?php
/**
 * FacilityPro Component Shortcodes for Gutenberg & Page Builders
 *
 * @package FacilityPro
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Calculators Shortcode [facilitypro_calculators]
function facilitypro_calculators_shortcode($atts) {
    ob_start();
    ?>
    <div class="facilitypro-calculators-wrapper my-6">
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_calculators', 'facilitypro_calculators_shortcode');

// 2. Knowledge Hub Shortcode [facilitypro_knowledge_hub] (Dynamic WP_Query with 9 Disciplines & Server Pre-filter)
function facilitypro_knowledge_hub_shortcode($atts) {
    ob_start();
    
    // Read ?discipline= query parameter from URL
    $selected_disc = isset($_GET['discipline']) ? sanitize_text_field(strtolower(trim($_GET['discipline']))) : 'all';
    if ($selected_disc === 'fire') $selected_disc = 'firefighting';
    if ($selected_disc === 'dgset') $selected_disc = 'dg';

    // Query Custom Post Type 'mep_knowledge' and standard 'post' from WordPress Database
    $query_args = array(
        'post_type'      => array('mep_knowledge', 'post'),
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    $kb_query = new WP_Query($query_args);
    
    $all_articles = array();
    if ($kb_query->have_posts()) {
        while ($kb_query->have_posts()) {
            $kb_query->the_post();
            $pid = get_the_ID();
            $disc = get_post_meta($pid, 'kb_discipline', true);
            if (empty($disc)) {
                $t = strtolower(get_the_title());
                if (strpos($t, 'hvac') !== false || strpos($t, 'chiller') !== false || strpos($t, 'duct') !== false) $disc = 'hvac';
                elseif (strpos($t, 'elec') !== false || strpos($t, 'transformer') !== false || strpos($t, 'volt') !== false) $disc = 'electrical';
                elseif (strpos($t, 'fire') !== false || strpos($t, 'sprinkler') !== false) $disc = 'firefighting';
                elseif (strpos($t, 'plumb') !== false || strpos($t, 'water hammer') !== false || strpos($t, 'pump') !== false || strpos($t, 'drain') !== false) $disc = 'plumbing';
                elseif (strpos($t, 'paint') !== false || strpos($t, 'epoxy') !== false) $disc = 'painting';
                elseif (strpos($t, 'solar') !== false || strpos($t, 'pv') !== false) $disc = 'solar';
                elseif (strpos($t, 'bms') !== false || strpos($t, 'bacnet') !== false) $disc = 'bms';
                elseif (strpos($t, 'stp') !== false || strpos($t, 'mbr') !== false || strpos($t, 'sewage') !== false) $disc = 'stp';
                elseif (strpos($t, 'dg') !== false || strpos($t, 'generator') !== false) $disc = 'dg';
                else $disc = 'hvac';
            }
            $code_ref = get_post_meta($pid, 'kb_code_ref', true);
            if (empty($code_ref)) $code_ref = 'ASHRAE / NBC 2016';
            
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
                $excerpt = wp_trim_words(strip_tags(get_the_content()), 28, '...');
            }

            $all_articles[] = array(
                'id'         => 'db-kb-' . $pid,
                'discipline' => $disc,
                'title'      => get_the_title(),
                'category'   => ucfirst($disc) . ' Engineering',
                'readTime'   => get_post_meta($pid, 'kb_read_time', true) ?: '6 min read',
                'codeRef'    => $code_ref,
                'summary'    => $excerpt,
                'permalink'  => get_permalink(),
                'date'       => get_the_date('M d, Y')
            );
        }
        wp_reset_postdata();
    }

    $tabs = array(
        'all'          => 'All Blogs (' . count($all_articles) . ')',
        'hvac'         => 'HVAC',
        'electrical'   => 'Electrical',
        'firefighting' => 'Fire fighting',
        'plumbing'     => 'Plumbing',
        'painting'     => 'Painting & polishing',
        'solar'        => 'Solar system',
        'bms'          => 'BMS & Automation',
        'stp'          => 'STP Treatment',
        'dg'           => 'DG Set'
    );
    ?>
    <div class="facilitypro-kb-wrapper my-6 space-y-8" id="knowledgeHubRoot">
        
        <!-- Filter Tabs for ALL 9 Disciplines -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar" id="kbFilterNav">
            <?php foreach ($tabs as $key => $label) : 
                $is_active = ($selected_disc === $key);
            ?>
                <a href="<?php echo $key === 'all' ? esc_url(home_url('/knowledge-hub/')) : esc_url(home_url('/knowledge-hub/?discipline=' . $key)); ?>" class="kb-filter-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all shadow-xs <?php echo $is_active ? 'bg-slate-900 text-white border border-slate-900' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'; ?>" data-kbfilter="<?php echo esc_attr($key); ?>">
                    <?php echo esc_html($label); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="kbCardsGrid">
            <?php foreach ($all_articles as $art) : 
                $link = (!empty($art['permalink']) && $art['permalink'] !== '#') ? esc_url($art['permalink']) : 'javascript:void(0)';
                $art_disc = $art['discipline'];
                $is_visible = ($selected_disc === 'all' || $selected_disc === $art_disc);
            ?>
                <div class="kb-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-[#0077c8] transition-all flex flex-col justify-between group cursor-pointer" style="<?php echo $is_visible ? 'display: flex;' : 'display: none;'; ?>" data-discipline="<?php echo esc_attr($art_disc); ?>" onclick="window.location.href='<?php echo $link; ?>'">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="px-2.5 py-1 rounded-lg bg-sky-50 text-[#0077c8] text-[11px] font-bold uppercase tracking-wider">
                                <?php echo esc_html($art['category']); ?>
                            </span>
                            <span class="text-[11px] font-medium text-slate-400">
                                <?php echo esc_html($art['readTime']); ?>
                            </span>
                        </div>

                        <h3 class="text-base font-black text-slate-900 group-hover:text-[#0077c8] transition-colors line-clamp-2 leading-snug">
                            <a href="<?php echo $link; ?>" class="hover:underline">
                                <?php echo esc_html($art['title']); ?>
                            </a>
                        </h3>

                        <p class="text-xs text-slate-600 mt-2.5 line-clamp-3 leading-relaxed">
                            <?php echo esc_html($art['summary']); ?>
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="text-[10px] font-semibold text-slate-400 truncate">
                            📖 <?php echo esc_html($art['codeRef']); ?>
                        </span>

                        <div class="flex items-center gap-1.5 shrink-0">
                            <a href="<?php echo $link; ?>" class="px-3.5 py-1.5 bg-slate-900 hover:bg-[#0077c8] text-white text-xs font-bold rounded-xl transition-colors flex items-center gap-1 shadow-xs">
                                <span>Read Full Blog</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                            <button type="button" onclick="event.stopPropagation(); facilityProOpenConsultationModal('Technical query regarding: <?php echo esc_js($art['title']); ?>')" class="p-2 text-slate-500 hover:text-[#f05423] hover:bg-orange-50 rounded-xl transition-colors cursor-pointer" title="Ask AI Specialist">
                                <i data-lucide="sparkles" class="w-4 h-4 text-[#f05423]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <?php
    return ob_get_clean();
}

// 3. SOP Library Shortcode [facilitypro_sop_library] (Dynamic WP_Query)
function facilitypro_sop_library_shortcode($atts) {
    ob_start();
    
    // 1. Query Custom Post Type 'mep_sop' from WordPress Database
    $query_args = array(
        'post_type'      => 'mep_sop',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    $sop_query = new WP_Query($query_args);
    
    $db_sops = array();
    if ($sop_query->have_posts()) {
        while ($sop_query->have_posts()) {
            $sop_query->the_post();
            $pid = get_the_ID();
            $disc = get_post_meta($pid, 'sop_discipline', true);
            if (empty($disc)) {
                $t = strtolower(get_the_title());
                if (strpos($t, 'hvac') !== false || strpos($t, 'chiller') !== false) $disc = 'hvac';
                elseif (strpos($t, 'elec') !== false || strpos($t, 'transformer') !== false || strpos($t, 'vcb') !== false) $disc = 'electrical';
                elseif (strpos($t, 'plumb') !== false || strpos($t, 'pump') !== false || strpos($t, 'drain') !== false) $disc = 'plumbing';
                elseif (strpos($t, 'fire') !== false || strpos($t, 'sprinkler') !== false) $disc = 'fire';
                elseif (strpos($t, 'dg') !== false || strpos($t, 'generator') !== false) $disc = 'dg';
                elseif (strpos($t, 'bms') !== false || strpos($t, 'automation') !== false) $disc = 'bms';
                elseif (strpos($t, 'stp') !== false || strpos($t, 'water') !== false) $disc = 'stp';
                else $disc = 'general';
            }
            $code = get_post_meta($pid, 'sop_code', true);
            if (empty($code)) $code = 'SOP-' . str_pad($pid, 3, '0', STR_PAD_LEFT);
            $ver = get_post_meta($pid, 'sop_version', true);
            if (empty($ver)) $ver = 'v1.0';
            
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
                $excerpt = wp_trim_words(strip_tags(get_the_content()), 28, '...');
            }

            $db_sops[] = array(
                'id'         => 'db-sop-' . $pid,
                'code'       => $code,
                'title'      => get_the_title(),
                'discipline' => $disc,
                'category'   => ucfirst($disc) . ' Engineering',
                'version'    => $ver,
                'author'     => get_the_author() ? get_the_author() : 'FacilityPro PE Board',
                'purpose'    => $excerpt,
                'permalink'  => get_permalink(),
                'date'       => get_the_date('M d, Y'),
                'is_db'      => true
            );
        }
        wp_reset_postdata();
    }

    // Default Seed SOPs
    $seed_sops = array(
        array(
            'id'         => 'sop-hvac-01',
            'code'       => 'SOP-HVAC-01',
            'title'      => 'Centrifugal Chiller Plant Normal Start & Stop Procedure',
            'category'   => 'HVAC & Chilled Water',
            'discipline' => 'hvac',
            'version'    => 'v2.4',
            'author'     => 'Er. Rajesh Sharma (AI HVAC Expert)',
            'purpose'    => 'Standard operating procedure for the safe sequential start-up, operational monitoring, and shutdown of water-cooled centrifugal chiller plants.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        ),
        array(
            'id'         => 'sop-elec-01',
            'code'       => 'SOP-ELEC-01',
            'title'      => '11kV / 415V Substation Transformer Cold Energization Procedure',
            'category'   => 'Electrical & Power',
            'discipline' => 'electrical',
            'version'    => 'v3.1',
            'author'     => 'Dr. Vikram Malhotra (AI Electrical Expert)',
            'purpose'    => 'Step-by-step safety standard for switching, cold energization, and phase synchronization of 11kV oil-immersed & dry-type power transformers.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        ),
        array(
            'id'         => 'sop-dg-01',
            'code'       => 'SOP-DG-01',
            'title'      => 'Diesel Generator (DG Set) Weekly Auto Mains Failure (AMF) Run Test',
            'category'   => 'DG Sets & Backup',
            'discipline' => 'dg',
            'version'    => 'v2.0',
            'author'     => 'Dr. Vikram Malhotra (AI Electrical Expert)',
            'purpose'    => 'Standard weekly inspection and on-load testing of emergency diesel generators to guarantee compliance with NFPA 110 Level 1 emergency power standards.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        ),
        array(
            'id'         => 'sop-fire-01',
            'code'       => 'SOP-FIRE-01',
            'title'      => 'Weekly Fire Pump Churn & Automatic Pressure Switch Cut-In Test',
            'category'   => 'Fire & Life Safety',
            'discipline' => 'fire',
            'version'    => 'v3.0',
            'author'     => 'Er. Ananya Verma (AI Fire Safety Expert)',
            'purpose'    => 'Executing NFPA 25 weekly inspection, testing, and maintenance (ITM) protocol for main electric, diesel backup, and jockey fire pumps.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        ),
        array(
            'id'         => 'sop-plumb-01',
            'code'       => 'SOP-PLUMB-01',
            'title'      => 'Hydro-Pneumatic Booster Pump Staging & Bladder Tank Pre-Charge Audit',
            'category'   => 'Plumbing & Drainage',
            'discipline' => 'plumbing',
            'version'    => 'v1.8',
            'author'     => 'Er. Amit Patel (AI Plumbing Expert)',
            'purpose'    => 'Comprehensive procedure for adjusting variable frequency drives, pressure transmitters, and nitrogen pre-charge.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        ),
        array(
            'id'         => 'sop-stp-01',
            'code'       => 'SOP-STP-01',
            'title'      => 'Sewage Treatment Plant (STP) MBBR Aeration & Sludge Return Protocol',
            'category'   => 'STP & Water Treatment',
            'discipline' => 'stp',
            'version'    => 'v2.1',
            'author'     => 'Er. Amit Patel (AI Plumbing Expert)',
            'purpose'    => 'Dissolved oxygen (DO) monitoring, MLSS concentration balancing, and chlorine dosing for secondary treated effluent compliance.',
            'date'       => 'Verified Standard',
            'permalink'  => '#'
        )
    );

    $all_sops = array_merge($db_sops, $seed_sops);
    ?>
    <div class="facilitypro-sop-wrapper my-6 space-y-8" id="sopLibraryRoot">
        
        <!-- Filter Pills Bar -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar" id="sopFilterNav">
            <button onclick="facilityProFilterSop('all')" data-sopfilter="all" class="sop-filter-btn active px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap bg-slate-900 text-white shadow-sm border border-slate-900 cursor-pointer">
                All Disciplines (<?php echo count($all_sops); ?>)
            </button>
            <button onclick="facilityProFilterSop('hvac')" data-sopfilter="hvac" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                HVAC &amp; Chillers
            </button>
            <button onclick="facilityProFilterSop('electrical')" data-sopfilter="electrical" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                Electrical &amp; HT
            </button>
            <button onclick="facilityProFilterSop('fire')" data-sopfilter="fire" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                Fire Fighting
            </button>
            <button onclick="facilityProFilterSop('plumbing')" data-sopfilter="plumbing" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                Plumbing &amp; Booster
            </button>
            <button onclick="facilityProFilterSop('dg')" data-sopfilter="dg" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                DG Sets
            </button>
            <button onclick="facilityProFilterSop('stp')" data-sopfilter="stp" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                STP &amp; Water
            </button>
            <button onclick="facilityProFilterSop('general')" data-sopfilter="general" class="sop-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer">
                Facility &amp; Hotel SOPs
            </button>
        </div>

        <!-- SOP Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="sopCardsGrid">
            <?php foreach ($all_sops as $sop) : 
                $link = (!empty($sop['permalink']) && $sop['permalink'] !== '#') ? esc_url($sop['permalink']) : 'javascript:void(0)';
                $has_link = (!empty($sop['permalink']) && $sop['permalink'] !== '#');
            ?>
                <div class="sop-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-400 transition-all flex flex-col justify-between group" data-discipline="<?php echo esc_attr($sop['discipline']); ?>">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="px-2.5 py-1 rounded-lg bg-blue-50 text-[#0077c8] text-[11px] font-black uppercase tracking-wider">
                                <?php echo esc_html($sop['code']); ?>
                            </span>
                            <span class="text-[11px] font-bold text-slate-400">
                                <?php echo esc_html($sop['version']); ?>
                            </span>
                        </div>

                        <h3 class="text-base font-black text-slate-900 group-hover:text-[#0077c8] transition-colors line-clamp-2 leading-snug">
                            <?php if ($has_link) : ?>
                                <a href="<?php echo $link; ?>" class="hover:underline">
                                    <?php echo esc_html($sop['title']); ?>
                                </a>
                            <?php else : ?>
                                <?php echo esc_html($sop['title']); ?>
                            <?php endif; ?>
                        </h3>

                        <p class="text-xs text-slate-600 mt-2.5 line-clamp-3 leading-relaxed">
                            <?php echo esc_html($sop['purpose']); ?>
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="text-[11px] text-slate-500 font-medium truncate">
                            👤 <?php echo esc_html($sop['author']); ?>
                        </span>

                        <div class="flex items-center gap-1.5 shrink-0">
                            <?php if ($has_link) : ?>
                                <a href="<?php echo $link; ?>" class="px-3 py-1.5 bg-slate-900 hover:bg-[#0077c8] text-white text-xs font-bold rounded-xl transition-colors flex items-center gap-1">
                                    <span>Read SOP</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            <?php endif; ?>
                            <button onclick="facilityProOpenConsultationModal('Clarify standard operating procedure for: <?php echo esc_js($sop['title']); ?>')" class="p-2 text-slate-500 hover:text-[#f05423] hover:bg-orange-50 rounded-xl transition-colors cursor-pointer" title="Ask AI Specialist">
                                <i data-lucide="sparkles" class="w-4 h-4 text-[#f05423]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_sop_library', 'facilitypro_sop_library_shortcode');


// 4. Checklists Shortcode [facilitypro_checklists]
function facilitypro_checklists_shortcode($atts) {
    ob_start();
    $checklists = [
        [
            'id' => 'chk-chiller-daily',
            'title' => 'Daily Central Chiller Plant Room Log & Inspection',
            'category' => 'HVAC & Chilled Water',
            'frequency' => 'Daily (Every Shift)',
            'estimatedTime' => '20 mins',
            'items' => [
                ['id' => 'c1', 'text' => 'Log Chilled Water Entering & Leaving Temperatures (Design: 54°F / 44°F)', 'priority' => 'High'],
                ['id' => 'c2', 'text' => 'Log Condenser Water Entering & Leaving Temperatures (Design: 85°F / 95°F)', 'priority' => 'High'],
                ['id' => 'c3', 'text' => 'Calculate Condenser Approach Temperature (Must be < 2.0°F / 1.1°C)', 'priority' => 'Critical'],
                ['id' => 'c4', 'text' => 'Check Compressor Lube Oil Pressure (> 25 PSI differential over suction)', 'priority' => 'Critical'],
                ['id' => 'c5', 'text' => 'Inspect Oil Sump Level in Sight Glass (Between 1/2 and 3/4 glass)', 'priority' => 'High'],
                ['id' => 'c6', 'text' => 'Log Motor Running Current (Amps) and % RLA (Rated Load Amps)', 'priority' => 'Medium'],
                ['id' => 'c7', 'text' => 'Check Cooling Tower Basin Water Level, Makeup Float & Bleed Valve', 'priority' => 'High'],
                ['id' => 'c8', 'text' => 'Inspect Primary/Secondary Chilled Water Pump Glands & Vibration', 'priority' => 'Medium'],
                ['id' => 'c9', 'text' => 'Verify Automatic Chemical Dosing Pump Operation & Biocide Tank Level', 'priority' => 'High'],
                ['id' => 'c10', 'text' => 'Check Plant Room Floor for Refrigerant, Oil, or Water Leaks', 'priority' => 'Medium']
            ]
        ],
        [
            'id' => 'chk-dg-weekly',
            'title' => 'Weekly Diesel Generator (DG Set) & AMF Panel Audit',
            'category' => 'DG Sets & Backup',
            'frequency' => 'Weekly',
            'estimatedTime' => '25 mins',
            'items' => [
                ['id' => 'd1', 'text' => 'Inspect 24V Starter Battery Bank Voltage (Float: > 25.4V DC) & Specific Gravity', 'priority' => 'Critical'],
                ['id' => 'd2', 'text' => 'Check Engine Lube Oil Level (Dipstick between MIN & MAX marks)', 'priority' => 'Critical'],
                ['id' => 'd3', 'text' => 'Verify Radiator Coolant Level & Check Jacket Water Heater is Warm (> 40°C)', 'priority' => 'High'],
                ['id' => 'd4', 'text' => 'Check Day Fuel Tank Level (> 80% capacity) & Drain Water Separator', 'priority' => 'High'],
                ['id' => 'd5', 'text' => 'Perform 15-Minute Manual Run Test: Check Frequency (50/60 Hz) & Voltage (415V)', 'priority' => 'Critical'],
                ['id' => 'd6', 'text' => 'Verify Lube Oil Pressure builds to 4.5 - 6.0 bar during operation', 'priority' => 'Critical'],
                ['id' => 'd7', 'text' => 'Inspect Exhaust Smoke Color (Clear / Light Grey; No Heavy Black or Blue Smoke)', 'priority' => 'Medium'],
                ['id' => 'd8', 'text' => 'Verify Motorized Fresh Air Intake Louvers open fully upon engine start', 'priority' => 'High'],
                ['id' => 'd9', 'text' => 'Check AMF Controller Selector Switch is returned to "AUTO" Mode', 'priority' => 'Critical']
            ]
        ],
        [
            'id' => 'chk-elec-monthly',
            'title' => 'Monthly HT/LT Substation & Switchgear Inspection',
            'category' => 'Electrical & Power',
            'frequency' => 'Monthly',
            'estimatedTime' => '35 mins',
            'items' => [
                ['id' => 'e1', 'text' => 'Inspect 11kV VCB / SF6 Pressure Gauge and Spring Charging Mechanism', 'priority' => 'Critical'],
                ['id' => 'e2', 'text' => 'Check Transformer Oil Level, WTI & OTI Temperature Indicators', 'priority' => 'Critical'],
                ['id' => 'e3', 'text' => 'Inspect Silica Gel Breather Color (Deep Blue; Replace if Pink / White)', 'priority' => 'High'],
                ['id' => 'e4', 'text' => 'Check Main Incomer ACB Tripping Battery Charger & 110V DC Tripping Voltage', 'priority' => 'Critical'],
                ['id' => 'e5', 'text' => 'Perform Infrared Thermography on Main Busbar Joints & Cable Terminations (< 70°C)', 'priority' => 'High'],
                ['id' => 'e6', 'text' => 'Inspect Automatic Power Factor Correction (APFC) Panel (Maintain PF > 0.98)', 'priority' => 'High'],
                ['id' => 'e7', 'text' => 'Test Substation Earth Pit Resistances (< 1.0 Ohm) & Earth Continuity', 'priority' => 'Critical'],
                ['id' => 'e8', 'text' => 'Check Rubber Insulation Mats in front of all HT/LT Panels (IS 15652 / IEC 61111)', 'priority' => 'Medium']
            ]
        ],
        [
            'id' => 'chk-fire-weekly',
            'title' => 'Weekly Fire Sprinkler, Hydrant & Fire Pump Audit (NFPA 25)',
            'category' => 'Fire & Life Safety',
            'frequency' => 'Weekly',
            'estimatedTime' => '30 mins',
            'items' => [
                ['id' => 'f1', 'text' => 'Inspect Fire Water Reservoir Tank Water Level (100% Full)', 'priority' => 'Critical'],
                ['id' => 'f2', 'text' => 'Confirm all Suction and Discharge OS&Y Gate Valves are OPEN and Padlocked', 'priority' => 'Critical'],
                ['id' => 'f3', 'text' => 'Verify Jockey Pump Maintains Ring Main Static Pressure at 10.5 bar (150 PSI)', 'priority' => 'High'],
                ['id' => 'f4', 'text' => 'Execute 10-Minute Weekly Churn Run Test on Main Electric Fire Pump', 'priority' => 'Critical'],
                ['id' => 'f5', 'text' => 'Execute 30-Minute Weekly Run Test on Diesel Engine Fire Pump (NFPA 25 § 8.3.1)', 'priority' => 'Critical'],
                ['id' => 'f6', 'text' => 'Inspect Fire Pump Casing Relief Valves (Discharging cooling water stream during churn)', 'priority' => 'High'],
                ['id' => 'f7', 'text' => 'Check Gland Packing Drips (30-60 drops/min for packing lubrication & cooling)', 'priority' => 'Medium'],
                ['id' => 'f8', 'text' => 'Confirm Central Fire Alarm Panel (FACP) shows Zero System Faults or Disabled Zones', 'priority' => 'Critical']
            ]
        ]
    ];
    ?>
    <div class="facilitypro-checklists-wrapper my-6 grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php foreach ($checklists as $chk) : ?>
            <div class="chk-container bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between" id="<?php echo esc_attr($chk['id']); ?>">
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                        <div>
                            <span class="px-2.5 py-0.5 rounded text-[11px] font-extrabold uppercase bg-blue-50 text-[#0077c8]">
                                <?php echo esc_html($chk['frequency']); ?>
                            </span>
                            <h2 class="text-lg font-bold text-slate-900 mt-2">
                                <?php echo esc_html($chk['title']); ?>
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">Est. Time: <?php echo esc_html($chk['estimatedTime']); ?> • <?php echo esc_html($chk['category']); ?></p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4 bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="chk-progress bg-emerald-500 h-full w-0 transition-all duration-300"></div>
                    </div>

                    <!-- Items -->
                    <div class="space-y-2.5">
                        <?php foreach ($chk['items'] as $item) : ?>
                            <label class="flex items-start gap-3 p-2.5 rounded-lg border border-slate-100 hover:bg-slate-50 transition-colors cursor-pointer group">
                                <input type="checkbox" onchange="updateChecklistProgress('<?php echo esc_attr($chk['id']); ?>')" class="chk-item-input mt-1 w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                                <div class="flex-1">
                                    <div class="text-xs font-semibold text-slate-800 group-hover:text-slate-900 leading-snug">
                                        <?php echo esc_html($item['text']); ?>
                                    </div>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="text-[10px] font-bold px-1.5 py-0.2 rounded <?php echo $item['priority'] === 'Critical' ? 'bg-rose-100 text-rose-700' : ($item['priority'] === 'High' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600'); ?>">
                                            <?php echo esc_html($item['priority']); ?>
                                        </span>
                                    </div>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 chk-status-label">0 / <?php echo count($chk['items']); ?> Completed</span>
                    <button onclick="facilityProOpenConsultationModal('Need assistance with checklist item failure during <?php echo esc_js($chk['title']); ?>')" class="px-3 py-1.5 bg-[#f05423] hover:bg-[#d94416] text-white text-xs font-bold rounded-lg transition-colors flex items-center gap-1">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        <span>Report Issue to AI</span>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_checklists', 'facilitypro_checklists_shortcode');

// 5. Pricing Shortcode [facilitypro_pricing]
function facilitypro_pricing_shortcode($atts) {
    ob_start();
    ?>
    <div class="facilitypro-pricing-wrapper my-6 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
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

        <!-- Plan 2: Facility Pro Monthly -->
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

        <!-- Plan 3: Enterprise -->
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_pricing', 'facilitypro_pricing_shortcode');


// 6. User Dashboard Shortcode [facilitypro_dashboard] (With Left Navigation Sidebar)
function facilitypro_dashboard_shortcode($atts) {
    ob_start();
    
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_id      = $current_user->ID;
        $display_name = !empty($current_user->display_name) ? $current_user->display_name : $current_user->user_login;
        $plant_name   = get_user_meta($user_id, 'facilitypro_plant_name', true);
        if (empty($plant_name)) $plant_name = 'Main Facility Plant';
        $phone        = get_user_meta($user_id, 'facilitypro_phone', true);
        $plan         = get_user_meta($user_id, 'facilitypro_plan', true);
        if (empty($plan)) $plan = 'Facility Pro Monthly (₹399/mo)';
        $plan_status  = get_user_meta($user_id, 'facilitypro_plan_status', true);
        if (empty($plan_status)) $plan_status = 'Active Member';
        
        $queries = get_user_meta($user_id, 'facilitypro_query_history', true);
        if (!is_array($queries) || empty($queries)) {
            $queries = [
                [
                    'id'         => 'qry_default_1',
                    'date'       => 'Today, 02:45 PM',
                    'discipline' => 'HVAC & Chilled Water',
                    'question'   => 'Centrifugal chiller low delta-T syndrome & approach temperature exceeding 3.5°F',
                    'expert'     => 'Er. Rajesh Sharma (HVAC)',
                    'status'     => 'Resolved'
                ],
                [
                    'id'         => 'qry_default_2',
                    'date'       => 'Yesterday, 11:20 AM',
                    'discipline' => 'Electrical & Power',
                    'question'   => '11kV Transformer 87T Inrush Relay 2nd Harmonic 15% Restraint Calculation',
                    'expert'     => 'Dr. Vikram Malhotra (Electrical)',
                    'status'     => 'Resolved'
                ],
                [
                    'id'         => 'qry_default_3',
                    'date'       => '3 days ago',
                    'discipline' => 'Fire & Life Safety',
                    'question'   => 'NFPA 13 Fire pump churn test casing relief calibration & cut-in sequencing',
                    'expert'     => 'Er. Ananya Verma (Fire Safety)',
                    'status'     => 'Resolved'
                ],
                [
                    'id'         => 'qry_default_4',
                    'date'       => '5 days ago',
                    'discipline' => 'Plumbing & Drainage',
                    'question'   => 'Water hammer surge analysis on multi-stage high-rise booster pump trip',
                    'expert'     => 'Er. Amit Patel (Plumbing)',
                    'status'     => 'Resolved'
                ]
            ];
        }
        
        $initials = strtoupper(substr($display_name, 0, 2));
        ?>
        <div class="facilitypro-dashboard-root max-w-7xl mx-auto space-y-6">
            
            <!-- Mobile Tabs Bar (< lg screens) -->
            <div class="lg:hidden flex items-center gap-2 overflow-x-auto pb-2 no-scrollbar" id="dashMobileTabsNav">
                <button onclick="switchDashboardTab('overview')" data-dashtab="overview" class="dash-mobile-tab active px-3.5 py-2 rounded-xl font-bold text-xs whitespace-nowrap transition-all bg-slate-900 text-white shadow-sm cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                    <span>Overview</span>
                </button>
                <button onclick="switchDashboardTab('queries')" data-dashtab="queries" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="messages-square" class="w-3.5 h-3.5"></i>
                    <span>Consultations (<?php echo count($queries); ?>)</span>
                </button>
                <button onclick="switchDashboardTab('calculations')" data-dashtab="calculations" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="calculator" class="w-3.5 h-3.5"></i>
                    <span>Calculators</span>
                </button>
                <button onclick="switchDashboardTab('sops')" data-dashtab="sops" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    <span>SOPs</span>
                </button>
                <button onclick="switchDashboardTab('checklists')" data-dashtab="checklists" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="clipboard-check" class="w-3.5 h-3.5"></i>
                    <span>Checklists</span>
                </button>
                <button onclick="switchDashboardTab('subscription')" data-dashtab="subscription" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="credit-card" class="w-3.5 h-3.5"></i>
                    <span>Billing</span>
                </button>
                <button onclick="switchDashboardTab('settings')" data-dashtab="settings" class="dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5">
                    <i data-lucide="settings" class="w-3.5 h-3.5"></i>
                    <span>Settings</span>
                </button>
            </div>

            <!-- Main 2-Column Dashboard Layout (Left Sidebar + Right Content) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- ================= LEFT SIDEBAR (lg:col-span-3) ================= -->
                <aside class="hidden lg:block lg:col-span-3 sticky top-24 space-y-5">
                    
                    <!-- 1. Engineer Profile Card -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-[#0077c8] via-sky-600 to-[#0b2545] text-white flex items-center justify-center text-lg font-black shadow-md shadow-blue-500/20 shrink-0">
                                <?php echo esc_html($initials); ?>
                            </div>
                            <div class="min-w-0">
                                <h2 class="text-sm font-black text-slate-900 truncate"><?php echo esc_html($display_name); ?></h2>
                                <p class="text-[11px] text-slate-500 truncate"><?php echo esc_html($plant_name); ?></p>
                                <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span><?php echo esc_html($plan_status); ?></span>
                                </span>
                            </div>
                        </div>

                        <!-- Fast CTA -->
                        <button onclick="facilityProOpenConsultationModal()" class="w-full py-2.5 px-3 bg-gradient-to-r from-[#f05423] to-[#d94416] hover:from-[#d94416] hover:to-[#f05423] text-white text-xs font-bold rounded-xl flex items-center justify-center gap-2 shadow-sm shadow-orange-500/20 transition-all cursor-pointer">
                            <i data-lucide="sparkles" class="w-4 h-4"></i>
                            <span>Ask AI Specialist</span>
                        </button>
                    </div>

                    <!-- 2. Sidebar Navigation Menu -->
                    <nav class="bg-white rounded-2xl p-3 border border-slate-200 shadow-sm space-y-1" id="dashSidebarNav">
                        <div class="px-3 py-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Command Center
                        </div>
                        
                        <!-- Tab 1: Overview -->
                        <button onclick="switchDashboardTab('overview')" data-dashtab="overview" class="dash-tab-btn active w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-md border border-slate-900 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#0077c8] group-hover:text-white"></i>
                                <span>Overview</span>
                            </div>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 opacity-60"></i>
                        </button>

                        <!-- Tab 2: AI Consultations -->
                        <button onclick="switchDashboardTab('queries')" data-dashtab="queries" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="messages-square" class="w-4 h-4 text-sky-500"></i>
                                <span>AI Consultations</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-blue-100 text-[#0077c8]">
                                <?php echo count($queries); ?>
                            </span>
                        </button>

                        <!-- Tab 3: Calculations & Tools -->
                        <button onclick="switchDashboardTab('calculations')" data-dashtab="calculations" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="calculator" class="w-4 h-4 text-teal-500"></i>
                                <span>Engineering Calculators</span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400">6 Tools</span>
                        </button>

                        <!-- Tab 4: SOP Library -->
                        <button onclick="switchDashboardTab('sops')" data-dashtab="sops" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="shield-check" class="w-4 h-4 text-amber-500"></i>
                                <span>Plant SOPs &amp; Audits</span>
                            </div>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>

                        <!-- Tab 5: Maintenance Checklists -->
                        <button onclick="switchDashboardTab('checklists')" data-dashtab="checklists" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-emerald-500"></i>
                                <span>PM Checklists</span>
                            </div>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>

                        <div class="pt-3 pb-1 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-t border-slate-100 mt-2">
                            Account &amp; Support
                        </div>

                        <!-- Tab 6: Plan & Billing -->
                        <button onclick="switchDashboardTab('subscription')" data-dashtab="subscription" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="credit-card" class="w-4 h-4 text-indigo-500"></i>
                                <span>Plan &amp; Billing</span>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-600 font-mono">₹399/m</span>
                        </button>

                        <!-- Tab 7: Settings -->
                        <button onclick="switchDashboardTab('settings')" data-dashtab="settings" class="dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="settings" class="w-4 h-4 text-slate-500"></i>
                                <span>Plant Settings</span>
                            </div>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>
                    </nav>

                    <!-- 3. Sidebar Helpline & Quick Info -->
                    <div class="bg-gradient-to-br from-[#0b2545] to-[#134074] text-white rounded-2xl p-4 border border-blue-900/40 shadow-sm space-y-2.5">
                        <div class="flex items-center gap-2 text-xs font-black text-sky-300">
                            <i data-lucide="phone-call" class="w-3.5 h-3.5"></i>
                            <span>24/7 Plant Helpline</span>
                        </div>
                        <p class="text-[11px] text-slate-300 leading-snug">
                            Instant escalation to licensed Indian PEs for critical plant breakdown emergencies.
                        </p>
                        <a href="tel:+919876543210" class="block w-full text-center py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold text-white transition-colors">
                            📞 +91 98765 43210
                        </a>
                    </div>

                    <!-- 4. Log Out button -->
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="w-full flex items-center justify-center gap-2 py-2.5 px-3 bg-slate-100 hover:bg-rose-50 hover:text-rose-700 text-slate-600 rounded-xl text-xs font-bold transition-colors border border-slate-200">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        <span>Log Out from Plant Session</span>
                    </a>
                </aside>

                <!-- ================= RIGHT MAIN WORKSPACE (lg:col-span-9) ================= -->
                <main class="lg:col-span-9 space-y-6 min-w-0">
                    
                    <!-- TAB 1: OVERVIEW -->
                    <div id="dashtab-overview" class="dash-panel space-y-6">
                        
                        <!-- Top Welcome Banner -->
                        <div class="bg-gradient-to-r from-slate-900 via-[#0b2545] to-slate-900 text-white rounded-2xl p-6 sm:p-7 shadow-md border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[11px] font-bold text-sky-400 uppercase tracking-wider">Engineering Command Center</span>
                                <h1 class="text-xl sm:text-2xl font-black tracking-tight mt-0.5">Welcome, <?php echo esc_html($display_name); ?></h1>
                                <p class="text-xs text-slate-300 mt-1">Plant: <strong><?php echo esc_html($plant_name); ?></strong> &bull; All 4 AI Faculty Specialists are live &amp; calibrated to IS/NBC 2016 standards.</p>
                            </div>
                            <div class="shrink-0 flex items-center gap-2">
                                <button onclick="facilityProOpenConsultationModal()" class="px-4 py-2.5 bg-[#f05423] hover:bg-[#d94416] text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all cursor-pointer">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                    <span>New AI Query</span>
                                </button>
                            </div>
                        </div>

                        <!-- 4 Stats Cards -->
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
                            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">AI Queries</span>
                                    <div class="p-1.5 rounded-lg bg-blue-50 text-[#0077c8]"><i data-lucide="message-square" class="w-4 h-4"></i></div>
                                </div>
                                <div class="text-2xl font-black text-slate-900 mt-2"><?php echo count($queries); ?></div>
                                <div class="text-[10px] text-emerald-600 font-semibold mt-1">✓ 100% Code Verified</div>
                            </div>

                            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Calculators</span>
                                    <div class="p-1.5 rounded-lg bg-teal-50 text-teal-600"><i data-lucide="calculator" class="w-4 h-4"></i></div>
                                </div>
                                <div class="text-2xl font-black text-slate-900 mt-2">6 Active</div>
                                <div class="text-[10px] text-slate-500 font-semibold mt-1">ASHRAE, IS &amp; NFPA</div>
                            </div>

                            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">SOPs &amp; Audits</span>
                                    <div class="p-1.5 rounded-lg bg-amber-50 text-amber-600"><i data-lucide="shield-check" class="w-4 h-4"></i></div>
                                </div>
                                <div class="text-2xl font-black text-slate-900 mt-2">12 SOPs</div>
                                <div class="text-[10px] text-slate-500 font-semibold mt-1">LOTO &amp; Plant Start-Up</div>
                            </div>

                            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Plan Status</span>
                                    <div class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600"><i data-lucide="zap" class="w-4 h-4"></i></div>
                                </div>
                                <div class="text-2xl font-black text-slate-900 mt-2">Pro</div>
                                <div class="text-[10px] text-emerald-600 font-semibold mt-1">Unlimited GPT-4o Access</div>
                            </div>
                        </div>

                        <!-- Recent Activity & Quick Tools Grid -->
                        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                            
                            <!-- Recent Consultations (2 cols) -->
                            <div class="xl:col-span-2 bg-white rounded-2xl p-5 sm:p-6 border border-slate-200 shadow-sm">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2">
                                        <i data-lucide="clock" class="w-4 h-4 text-[#0077c8]"></i>
                                        <span>Recent AI Diagnostic Sessions</span>
                                    </h2>
                                    <button onclick="switchDashboardTab('queries')" class="text-xs font-bold text-[#0077c8] hover:underline cursor-pointer">
                                        View All (<?php echo count($queries); ?>)
                                    </button>
                                </div>
                                <div class="space-y-3">
                                    <?php foreach (array_slice($queries, 0, 3) as $q) : ?>
                                        <div class="p-3.5 rounded-xl border border-slate-200 hover:border-blue-400 hover:bg-slate-50/80 transition-all cursor-pointer" onclick="facilityProOpenConsultationModal('<?php echo esc_js($q['question']); ?>')">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <span class="inline-block text-[10px] font-extrabold uppercase px-2 py-0.5 rounded bg-blue-50 text-[#0077c8] mb-1">
                                                        <?php echo esc_html($q['discipline']); ?>
                                                    </span>
                                                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 hover:text-[#0077c8] transition-colors line-clamp-2">
                                                        <?php echo esc_html($q['question']); ?>
                                                    </h3>
                                                    <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-2">
                                                        <span>👨‍💼 <?php echo esc_html($q['expert']); ?></span>
                                                        <span>&bull;</span>
                                                        <span><?php echo esc_html($q['date']); ?></span>
                                                    </div>
                                                </div>
                                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold shrink-0">
                                                    <?php echo esc_html($q['status']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Quick Shortcuts (1 col) -->
                            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200 shadow-sm space-y-3">
                                <h2 class="text-sm sm:text-base font-bold text-slate-900 mb-2 flex items-center gap-2">
                                    <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                                    <span>Quick Sizing Tools</span>
                                </h2>

                                <button onclick="switchDashboardTab('calculations')" class="w-full text-left p-3 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/30 transition-all cursor-pointer">
                                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                                        <span>Cooling Load &amp; TR</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5">ASHRAE 90.1 CLTD Method</div>
                                </button>

                                <button onclick="switchDashboardTab('calculations')" class="w-full text-left p-3 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/30 transition-all cursor-pointer">
                                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                                        <span>Duct Sizing (CFM &amp; FPM)</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5">Equal Friction 0.08-0.1 in.wg</div>
                                </button>

                                <button onclick="switchDashboardTab('sops')" class="w-full text-left p-3 rounded-xl border border-slate-200 hover:border-[#0077c8] hover:bg-blue-50/30 transition-all cursor-pointer">
                                    <div class="text-xs font-bold text-slate-900 flex items-center justify-between">
                                        <span>Chiller Annual Overhaul SOP</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#0077c8]"></i>
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5">14-point pre-season checklist</div>
                                </button>
                            </div>

                        </div>

                    </div>

                    <!-- TAB 2: CONSULTATIONS -->
                    <div id="dashtab-queries" class="dash-panel hidden space-y-4">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-slate-100">
                                <div>
                                    <h2 class="text-lg sm:text-xl font-black text-slate-900">Your AI Consultation History</h2>
                                    <p class="text-xs text-slate-500 mt-0.5">Complete archive of MEP calculations and licensed engineer responses.</p>
                                </div>
                                <button onclick="facilityProOpenConsultationModal()" class="px-4 py-2 bg-[#f05423] text-white text-xs font-bold rounded-xl hover:bg-[#d94416] transition-colors flex items-center gap-1.5 cursor-pointer">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                    <span>+ New Consultation</span>
                                </button>
                            </div>
                            
                            <div class="space-y-3.5">
                                <?php foreach ($queries as $q) : ?>
                                    <div class="p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-blue-400 bg-slate-50/60 transition-all">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200/80 pb-3 mb-3">
                                            <span class="text-xs font-extrabold uppercase px-2.5 py-1 rounded-lg bg-blue-100 text-[#0077c8] w-fit">
                                                <?php echo esc_html($q['discipline']); ?>
                                            </span>
                                            <span class="text-[11px] text-slate-400 font-medium">Session Logged: <?php echo esc_html($q['date']); ?></span>
                                        </div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900"><?php echo esc_html($q['question']); ?></h3>
                                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
                                            <span class="text-xs text-slate-600 font-medium">Assigned AI Specialist: <strong><?php echo esc_html($q['expert']); ?></strong></span>
                                            <button onclick="facilityProOpenConsultationModal('<?php echo esc_js($q['question']); ?>')" class="text-xs font-bold text-[#0077c8] hover:underline flex items-center gap-1 cursor-pointer">
                                                <span>Reopen Consultation Session</span>
                                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: CALCULATORS EMBEDDED -->
                    <div id="dashtab-calculations" class="dash-panel hidden space-y-6">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-lg sm:text-xl font-black text-slate-900">Embedded Plant Engineering Calculators</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Run instant formulas conforming to ASHRAE 90.1, IS 732, and NFPA 13.</p>
                            </div>
                            <?php echo do_shortcode('[facilitypro_calculators]'); ?>
                        </div>
                    </div>

                    <!-- TAB 4: SOPS EMBEDDED -->
                    <div id="dashtab-sops" class="dash-panel hidden space-y-6">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-lg sm:text-xl font-black text-slate-900">Standard Operating Procedures &amp; LOTO Audits</h2>
                                <p class="text-xs text-slate-500 mt-0.5">OSHA &amp; NBC 2016 compliant procedures for plant equipment commissioning.</p>
                            </div>
                            <?php echo do_shortcode('[facilitypro_sop_library]'); ?>
                        </div>
                    </div>

                    <!-- TAB 5: CHECKLISTS EMBEDDED -->
                    <div id="dashtab-checklists" class="dash-panel hidden space-y-6">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm">
                            <div class="mb-6">
                                <h2 class="text-lg sm:text-xl font-black text-slate-900">Preventive Maintenance Checklists</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Daily, weekly, and monthly logs for MEP engineering equipment.</p>
                            </div>
                            <?php echo do_shortcode('[facilitypro_checklists]'); ?>
                        </div>
                    </div>

                    <!-- TAB 6: PLAN & BILLING -->
                    <div id="dashtab-subscription" class="dash-panel hidden space-y-6">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm">
                            <div class="max-w-4xl mx-auto space-y-6">
                                <h2 class="text-xl sm:text-2xl font-black text-slate-900">Subscription &amp; Plant Access</h2>
                                <p class="text-xs text-slate-500">Manage your FacilityPro membership, billing frequency, and seats.</p>

                                <div class="p-6 rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-[#0b2545] text-white shadow-md">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Current Membership</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-black bg-emerald-500 text-white">Active</span>
                                    </div>
                                    <div class="text-2xl sm:text-3xl font-black text-white"><?php echo esc_html($plan); ?></div>
                                    <p class="text-xs text-slate-300 mt-2">Unlimited Point-to-Point AI Q&amp;A &bull; All 6 MEP Calculators &bull; Full SOP &amp; Checklist Library &bull; 24/7 Priority Support</p>
                                </div>

                                <div class="pt-4 border-t border-slate-100">
                                    <h3 class="text-base font-bold text-slate-900 mb-4">Upgrade or Change Plan</h3>
                                    <?php echo do_shortcode('[facilitypro_pricing]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 7: SETTINGS -->
                    <div id="dashtab-settings" class="dash-panel hidden space-y-6">
                        <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm max-w-2xl mx-auto">
                            <h2 class="text-xl font-black text-slate-900 mb-1">Plant &amp; Profile Settings</h2>
                            <p class="text-xs text-slate-500 mb-6">Update your engineer name, plant facility details, and credentials.</p>

                            <form id="facilitypro-profile-form" onsubmit="facilityProHandleProfileUpdate(event)" class="space-y-4">
                                <div id="profile-update-msg" class="hidden p-3 rounded-xl text-xs font-semibold"></div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name / Engineer Name</label>
                                    <input type="text" name="full_name" value="<?php echo esc_attr($display_name); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Facility / Plant Name</label>
                                    <input type="text" name="plant_name" value="<?php echo esc_attr($plant_name); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Emergency Phone Number</label>
                                    <input type="text" name="phone" value="<?php echo esc_attr($phone); ?>" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">New Password (leave blank to keep current)</label>
                                    <input type="password" name="new_password" placeholder="••••••••" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]">
                                </div>

                                <div class="pt-2">
                                    <button type="submit" id="profileSaveBtn" class="px-6 py-3 bg-slate-900 hover:bg-[#0077c8] text-white rounded-xl text-xs font-bold transition-colors shadow-md cursor-pointer">
                                        Save Profile Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </main>

            </div>

        </div>
        <?php
    } else {
        // Logged-out state: Professional Engineering Login & Register Portal
        ?>
        <div class="facilitypro-auth-portal max-w-md mx-auto my-8 bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200">
            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xl font-black mx-auto mb-3 shadow-md">
                    FP
                </div>
                <h1 class="text-2xl font-black text-slate-900">Plant Engineer Portal</h1>
                <p class="text-xs text-slate-500 mt-1">Sign in or register to access saved calculations and assigned Indian AI PEs.</p>
            </div>

            <!-- Portal Tabs -->
            <div class="flex border-b border-slate-200 mb-6">
                <button type="button" onclick="switchAuthTab('login')" id="authPortalTabLogin" class="flex-1 pb-3 text-xs font-bold text-center border-b-2 border-[#0077c8] text-[#0077c8] transition-colors cursor-pointer">
                    Sign In
                </button>
                <button type="button" onclick="switchAuthTab('register')" id="authPortalTabRegister" class="flex-1 pb-3 text-xs font-bold text-center border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition-colors cursor-pointer">
                    Register New Plant
                </button>
            </div>

            <!-- Login Form -->
            <form id="facilitypro-portal-login-form" onsubmit="facilityProHandleLogin(event, 'portal')" class="space-y-4">
                <div id="portal-login-msg" class="hidden p-3 rounded-xl text-xs font-semibold"></div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Username or Corporate Email</label>
                    <input type="text" name="log" placeholder="engineer@facility.com" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Password</label>
                    <input type="password" name="pwd" placeholder="••••••••" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" value="true" class="rounded border-slate-300 text-[#0077c8]">
                        <span>Remember me</span>
                    </label>
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-[#0077c8] hover:underline font-bold">Forgot password?</a>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-slate-900 hover:bg-[#0077c8] text-white rounded-xl text-xs font-bold transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                    <span>Sign In to Dashboard</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <!-- Register Form -->
            <form id="facilitypro-portal-register-form" onsubmit="facilityProHandleRegister(event, 'portal')" class="space-y-4 hidden">
                <div id="portal-register-msg" class="hidden p-3 rounded-xl text-xs font-semibold"></div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name / Engineer Name</label>
                    <input type="text" name="full_name" placeholder="e.g. Rahul Verma" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Corporate / Plant Email</label>
                    <input type="email" name="email" placeholder="rahul@plantoperations.com" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Facility / Plant / Hotel Name</label>
                    <input type="text" name="plant_name" placeholder="e.g. Apex Central Utilities" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Create Password (min 6 chars)</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 outline-none focus:border-[#0077c8]" required minlength="6">
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-[#f05423] hover:bg-[#d94416] text-white rounded-xl text-xs font-black transition-all shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                    <span>Create Account &amp; Access (₹399/mo)</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
        <?php
    }
    
    return ob_get_clean();
}
add_shortcode('facilitypro_dashboard', 'facilitypro_dashboard_shortcode');


// 7. Hero Section Shortcode [facilitypro_hero]
function facilitypro_hero_shortcode($atts) {
    $a = shortcode_atts(array(
        'title'    => 'Real help for real',
        'subtitle' => 'Ask any complex HVAC, Electrical, Fire Fighting, Plumbing, Painting & Polishing, Solar, BMS, STP, or DG Set question. Get verified formulas, exact sizing derivation, and Indian IS/NBC code clauses in under 5 seconds.',
        'badge'    => 'FacilityPro MEP Point-to-Point AI Diagnostics',
    ), $atts);

    ob_start();
    ?>
    <!-- HERO SECTION (Exact User Layout) -->
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

        <!-- Main Content Container -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 text-center sm:text-left">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- Logo Badge in Hero -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white shadow-lg animate-in fade-in duration-300">
                        <div class="w-5 h-5 rounded-full bg-[#f05423] flex items-center justify-center text-white text-[10px] font-black">
                            FP
                        </div>
                        <span class="text-xs sm:text-sm font-semibold tracking-wide text-slate-100">
                            Facility<span class="text-[#ff7849]">Pro</span> MEP Point-to-Point AI Diagnostics
                        </span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    </div>

                    <!-- Main Headline with Exact Cycling Options and Orange 24/7 -->
                    <div class="space-y-2">
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight sm:leading-none">
                            Real help for real <br class="hidden sm:inline" />
                            <span id="cyclingDiscipline" class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-[#ff7849] to-amber-300 transition-all duration-300 inline-block font-black">
                                HVAC specialists
                            </span>
                            <span class="text-[#ff5722] ml-1 sm:ml-2 font-black">, 24/7</span>
                        </h1>
                        <p class="text-sm sm:text-base md:text-lg text-slate-200 font-normal leading-relaxed max-w-2xl pt-1">
                            <?php echo esc_html($a['subtitle']); ?>
                        </p>
                    </div>

                    <!-- Quick Prompt Pills with search magnifying glass icon -->
                    <div class="flex items-center gap-2 flex-wrap pt-1">
                        <button onclick="facilityProOpenConsultationModal('Chiller approach temperature high &amp; surging', 'Er. Rajesh Sharma', 'HVAC &amp; Chilled Water')" class="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer shadow-xs hover:scale-105 active:scale-95">
                            <i data-lucide="search" class="w-3 h-3 text-slate-400 group-hover:text-white transition-colors"></i>
                            <span>Chiller surging &amp; approach</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Booster pump head &amp; flow calculation', 'Er. Amit Patel', 'Plumbing &amp; Drainage')" class="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer shadow-xs hover:scale-105 active:scale-95">
                            <i data-lucide="search" class="w-3 h-3 text-slate-400 group-hover:text-white transition-colors"></i>
                            <span>Booster pump head &amp; water hammer</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Transformer fault level &amp; relay coordination', 'Dr. Vikram Malhotra', 'Electrical &amp; Power')" class="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer shadow-xs hover:scale-105 active:scale-95">
                            <i data-lucide="search" class="w-3 h-3 text-slate-400 group-hover:text-white transition-colors"></i>
                            <span>Transformer 87T trip</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('NFPA 13 sprinkler hydraulic calculation', 'Er. Ananya Verma', 'Fire &amp; Life Safety')" class="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer shadow-xs hover:scale-105 active:scale-95">
                            <i data-lucide="search" class="w-3 h-3 text-slate-400 group-hover:text-white transition-colors"></i>
                            <span>NFPA 13 sprinklers</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Ask any MEP question...')" class="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer">
                            <i data-lucide="search" class="w-3 h-3 text-slate-400"></i>
                            <span>Ask anything...</span>
                        </button>
                    </div>

                    <!-- Central Question Input Bar -->
                    <form onsubmit="facilityProHandleHeroSearch(event)" class="pt-2">
                        <div class="relative flex flex-col sm:flex-row items-center bg-white rounded-2xl sm:rounded-full p-1.5 sm:p-2 shadow-2xl shadow-black/50 border-2 border-white/20 focus-within:border-[#ff5722] transition-all duration-200">
                            
                            <div class="flex items-center w-full pl-3 sm:pl-4 pr-2 py-2 sm:py-0">
                                <i data-lucide="search" class="w-5 h-5 text-slate-400 mr-2.5 shrink-0 hidden sm:block"></i>
                                <input 
                                    type="text" 
                                    id="hero-search-input" 
                                    placeholder="e.g., Chiller condenser surging, transformer 87T trip, DG reverse power..." 
                                    class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 text-xs sm:text-sm md:text-base font-medium focus:outline-none"
                                />
                            </div>

                            <!-- Orange Get Solution Button -->
                            <button 
                                type="submit" 
                                class="w-full sm:w-auto mt-2 sm:mt-0 flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl sm:rounded-full bg-gradient-to-r from-[#ff5722] to-[#f05423] hover:from-[#ff6f3c] hover:to-[#ff5722] text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-150 cursor-pointer shrink-0"
                            >
                                <span>Get Solution</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 text-white"></i>
                            </button>
                        </div>

                        <!-- Disclaimer text -->
                        <p class="text-[11px] text-slate-400 mt-2.5 text-center sm:text-left">
                            By querying, you agree to our <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="text-sky-400 hover:underline">Terms of Service</a> &amp; verified engineering calculation standards.
                        </p>
                    </form>

                </div>

                <!-- Right Trust Column / Award Seal -->
                <div class="hidden lg:flex lg:col-span-4 flex-col items-center justify-center space-y-4">
                    <div class="relative p-6 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 text-center max-w-xs shadow-2xl">
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-tr from-amber-400 to-amber-200 flex items-center justify-center text-slate-950 font-black shadow-lg shadow-amber-500/20 mb-3">
                            <i data-lucide="award" class="w-9 h-9 stroke-[2] text-amber-900"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white tracking-tight">100% Verified MEP Engineers</h3>
                        <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                            Licensed Professional Engineers (PE), ASHRAE Fellows, NFPA CFPS &amp; IEEE Senior Members.
                        </p>
                        
                        <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-center gap-3 text-xs text-amber-300 font-semibold">
                            <span class="flex items-center gap-1"><i data-lucide="check-circle" class="w-3.5 h-3.5"></i> 24/7 Active</span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Verified Credentials</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_hero', 'facilitypro_hero_shortcode');



// 8. Category Grid Shortcode (9 Disciplines with Direct Blog Links) [facilitypro_category_pills] and [facilitypro_category_grid]
function facilitypro_category_grid_shortcode($atts) {
    ob_start();
    
    // Query published articles from database
    $articles_query = new WP_Query(array(
        'post_type'      => array('mep_knowledge', 'post'),
        'post_status'    => 'publish',
        'posts_per_page' => 24,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ));
    ?>
    <!-- MEP ENGINEERING DISCIPLINES 4-IN-A-ROW GRID -->
    <section id="disciplines" class="py-10 sm:py-16 bg-slate-50/70 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 space-y-10">
            
            <div class="text-center max-w-3xl mx-auto mb-6">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-[#0077c8] bg-sky-50 px-3 py-1 rounded-full border border-sky-100">
                    Plant Engineering Categories
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0b2545] tracking-tight mt-2">
                    Select Your Service Category
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-1.5">
                    Click any discipline below to open its technical blogs, verified formulas, and engineering solutions.
                </p>
            </div>

            <!-- 4-in-a-row Grid on BOTH Mobile & Desktop (Direct Navigation on Click) -->
            <div class="grid grid-cols-4 gap-2.5 sm:gap-4 lg:gap-5" id="category-cards-grid">
                
                <!-- 1. HVAC -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=hvac')); ?>" data-category="hvac" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="wind" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        HVAC
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Chillers &amp; AHUs</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 2. Electrical -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=electrical')); ?>" data-category="electrical" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="zap" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        Electrical
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Substations &amp; LT</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 3. Fire Fighting -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=firefighting')); ?>" data-category="firefighting" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="flame" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        Fire fighting
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">NFPA 13 &amp; Pumps</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 4. Plumbing -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=plumbing')); ?>" data-category="plumbing" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="droplets" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        Plumbing
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Pumps &amp; Risers</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 5. Painting & Polishing -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=painting')); ?>" data-category="painting" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="paint-roller" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        Painting &amp; polishing
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Epoxy &amp; PU Coating</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 6. Solar System -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=solar')); ?>" data-category="solar" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="sun" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        Solar system
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Rooftop PV &amp; On-Grid</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 7. BMS & Automation -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=bms')); ?>" data-category="bms" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="sliders" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        BMS &amp; Automation
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">DDC &amp; SCADA</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 8. STP & Water Treatment -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=stp')); ?>" data-category="stp" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="filter" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        STP &amp; water treatment
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">MBBR, MBR &amp; RO</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

                <!-- 9. DG Set -->
                <a href="<?php echo esc_url(home_url('/knowledge-hub/?discipline=dg')); ?>" data-category="dg" class="category-card group bg-white hover:bg-gradient-to-b hover:from-sky-50/60 hover:to-white rounded-xl sm:rounded-2xl border-2 border-slate-200/90 hover:border-[#0077c8] p-2.5 sm:p-4 lg:p-5 flex flex-col items-center justify-center text-center cursor-pointer shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block">
                    <div class="category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white">
                        <i data-lucide="battery-charging" class="w-5 h-5 sm:w-8 sm:h-8 lg:w-10 lg:h-10 stroke-[1.7]"></i>
                    </div>
                    <h3 class="text-[11px] sm:text-xs md:text-sm lg:text-base font-extrabold text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                        DG set
                    </h3>
                    <span class="text-[9px] sm:text-[11px] font-semibold text-slate-500 mt-0.5 sm:mt-1 hidden sm:block">Sync &amp; AMF Panels</span>
                    <span class="mt-1.5 text-[10px] font-bold text-[#0077c8] flex items-center gap-1 group-hover:underline">
                        <span>View Blogs</span>
                        <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </span>
                </a>

            </div>

            <!-- DYNAMIC FEATURED BLOGS & SOLUTIONS GRID -->
            <div class="mt-12 pt-8 border-t border-slate-200" id="featured-blogs-section">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#0077c8] bg-sky-50 px-2.5 py-1 rounded-md border border-sky-100" id="currentFilterLabel">
                            Showing All Engineering Articles
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">
                            Technical Blogs &amp; Plant Diagnostic Guides
                        </h3>
                    </div>
                    <a href="<?php echo esc_url(home_url('/knowledge-hub/')); ?>" class="text-xs font-bold text-[#0077c8] hover:underline flex items-center gap-1">
                        <span>Browse Full Knowledge Hub (All 9 Disciplines)</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="homeBlogCardsGrid">
                    <?php
                    if ($articles_query->have_posts()) :
                        while ($articles_query->have_posts()) : $articles_query->the_post();
                            $p_id = get_the_ID();
                            $disc = get_post_meta($p_id, 'kb_discipline', true);
                            if (empty($disc)) {
                                $t = strtolower(get_the_title());
                                if (strpos($t, 'hvac') !== false || strpos($t, 'chiller') !== false || strpos($t, 'duct') !== false) $disc = 'hvac';
                                elseif (strpos($t, 'elec') !== false || strpos($t, 'transformer') !== false || strpos($t, 'volt') !== false) $disc = 'electrical';
                                elseif (strpos($t, 'fire') !== false || strpos($t, 'sprinkler') !== false) $disc = 'firefighting';
                                elseif (strpos($t, 'plumb') !== false || strpos($t, 'water hammer') !== false || strpos($t, 'pump') !== false || strpos($t, 'drain') !== false) $disc = 'plumbing';
                                elseif (strpos($t, 'paint') !== false || strpos($t, 'epoxy') !== false) $disc = 'painting';
                                elseif (strpos($t, 'solar') !== false || strpos($t, 'pv') !== false) $disc = 'solar';
                                elseif (strpos($t, 'bms') !== false || strpos($t, 'bacnet') !== false) $disc = 'bms';
                                elseif (strpos($t, 'stp') !== false || strpos($t, 'mbr') !== false || strpos($t, 'sewage') !== false) $disc = 'stp';
                                elseif (strpos($t, 'dg') !== false || strpos($t, 'generator') !== false) $disc = 'dg';
                                else $disc = 'hvac';
                            }
                            $code_ref = get_post_meta($p_id, 'kb_code_ref', true);
                            if (empty($code_ref)) $code_ref = 'ASHRAE / NBC 2016';
                            ?>
                            <div class="blog-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-[#0077c8] transition-all flex flex-col justify-between group transform hover:-translate-y-1 cursor-pointer" data-discipline="<?php echo esc_attr($disc); ?>" onclick="window.location.href='<?php the_permalink(); ?>'">
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-3">
                                        <span class="px-2.5 py-1 rounded-lg bg-sky-50 text-[#0077c8] text-[11px] font-bold uppercase tracking-wider">
                                            <?php echo esc_html(strtoupper($disc)); ?>
                                        </span>
                                        <span class="text-[11px] font-medium text-slate-400">
                                            <?php echo get_the_date('M d, Y'); ?>
                                        </span>
                                    </div>

                                    <h4 class="text-base font-black text-slate-900 group-hover:text-[#0077c8] transition-colors line-clamp-2 leading-snug">
                                        <a href="<?php the_permalink(); ?>" class="hover:underline">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>

                                    <p class="text-xs text-slate-600 mt-2.5 line-clamp-3 leading-relaxed">
                                        <?php echo wp_trim_words(get_the_excerpt(), 24, '...'); ?>
                                    </p>
                                </div>

                                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-semibold text-slate-400 truncate">
                                        📖 <?php echo esc_html($code_ref); ?>
                                    </span>

                                    <a href="<?php the_permalink(); ?>" class="px-3.5 py-1.5 bg-slate-900 hover:bg-[#0077c8] text-white text-xs font-bold rounded-xl transition-colors flex items-center gap-1.5 shadow-xs">
                                        <span>Read Full Blog</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean();
}

// 9. Popular Questions Shortcode [facilitypro_popular_questions]
function facilitypro_popular_questions_shortcode($atts) {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_popular_questions', 'facilitypro_popular_questions_shortcode');


// 10. How It Works Shortcode [facilitypro_how_it_works]
function facilitypro_how_it_works_shortcode($atts) {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_how_it_works', 'facilitypro_how_it_works_shortcode');


// 11. Meet the Experts Shortcode [facilitypro_experts]
function facilitypro_experts_shortcode($atts) {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_experts', 'facilitypro_experts_shortcode');


// 12. Why Choose Us Shortcode [facilitypro_why_choose_us]
function facilitypro_why_choose_us_shortcode($atts) {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_why_choose_us', 'facilitypro_why_choose_us_shortcode');

add_shortcode('facilitypro_knowledge_hub', 'facilitypro_knowledge_hub_shortcode');
add_shortcode('facilitypro_category_grid', 'facilitypro_category_grid_shortcode');
add_shortcode('facilitypro_category_pills', 'facilitypro_category_grid_shortcode');