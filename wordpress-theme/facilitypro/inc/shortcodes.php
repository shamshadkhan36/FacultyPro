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

// 2. Knowledge Hub Shortcode [facilitypro_knowledge_hub]
function facilitypro_knowledge_hub_shortcode($atts) {
    ob_start();
    $articles = [
        [
            'id' => 'kb-hvac-1',
            'discipline' => 'hvac',
            'title' => 'Centrifugal Chiller Surge Identification & Aerodynamic Lift Control',
            'category' => 'HVAC & Chilled Water',
            'readTime' => '6 min read',
            'codeRef' => 'ASHRAE Guideline 22 / Standard 90.1',
            'summary' => 'Comprehensive analysis of compressor surge dynamics under low evaporator load or excessive condenser water entering temperatures.',
            'keyPoints' => [
                'Surge Mechanism: Occurs when refrigerant pressure ratio exceeds aerodynamic lift capacity.',
                'Condenser Approach: Maintain approach temp < 2.0°F (1.1°C) to prevent condenser fouling.',
                'VSD Anti-Surge Tuning: Set VFD low-speed frequency above calculated surge envelope.'
            ]
        ],
        [
            'id' => 'kb-elec-1',
            'discipline' => 'electrical',
            'title' => 'Transformer 87T Differential Relay Harmonic Restraint & Inrush Protection',
            'category' => 'Electrical & Power',
            'readTime' => '7 min read',
            'codeRef' => 'IEEE C37.91 / IEC 60255 / NFPA 70',
            'summary' => 'Preventing nuisance trips during transformer grid energization while preserving high sensitivity for internal faults.',
            'keyPoints' => [
                'Inrush Magnetizing Current: Draws peak inrush currents up to 8-12x Full Load Amps.',
                '2nd Harmonic Blocking (15%): Restrains magnetizing inrush from true internal short circuits.',
                'Vector Group Compensation: Software CT phase shift matrix matching Dyn11 30° phase angle.'
            ]
        ],
        [
            'id' => 'kb-plumb-1',
            'discipline' => 'plumbing',
            'title' => 'High-Rise Hydro-Pneumatic Water Supply & Water Hammer Arrestor Design',
            'category' => 'Plumbing & Drainage',
            'readTime' => '5 min read',
            'codeRef' => 'IPC § 604 / ASPE Data Book / PDI-WH 201',
            'summary' => 'Hydraulic principles for vertical pressure zoning, booster pump staging, and water hammer mitigation.',
            'keyPoints' => [
                'Vertical Pressure Zoning: Fixture static pressure restricted to <= 80 PSI (5.5 bar).',
                'Joukowsky Shock Waves: Install PDI-WH 201 certified stainless steel bellows arrestors.',
                'Tank Pre-charge: Nitrogen pre-charge at 0.2 bar (3 PSI) below pump cut-in pressure.'
            ]
        ],
        [
            'id' => 'kb-bms-1',
            'discipline' => 'bms',
            'title' => 'BMS DDC Architecture, BACnet MS/TP vs IP & Chiller Plant Optimization',
            'category' => 'BMS & Automation',
            'readTime' => '6 min read',
            'codeRef' => 'ASHRAE Standard 135 (BACnet) / Guideline 36',
            'summary' => 'Building Management System DDC controller networking, sensor calibration, and high-efficiency sequences.',
            'keyPoints' => [
                'BACnet Topology: BACnet/IP for supervisory tier and BACnet MS/TP for field DDCs.',
                'Delta-T Optimization: Prevent Low Delta-T Syndrome by variable flow sequencing.',
                'Sensor Calibration: 4-wire PT1000 RTDs calibrated within ±0.1°F (±0.05°C).'
            ]
        ],
        [
            'id' => 'kb-dg-1',
            'discipline' => 'dg',
            'title' => 'Diesel Generator (DG Set) Synchronizing, AMF Logic & Wet Stacking',
            'category' => 'DG Sets & Backup',
            'readTime' => '6 min read',
            'codeRef' => 'NFPA 110 (Level 1 Emergency Systems) / ISO 8528',
            'summary' => 'Emergency power infrastructure, Auto Mains Failure (AMF) changeover sequences, and unburned fuel mitigation.',
            'keyPoints' => [
                'Wet Stacking Prevention: Schedule annual 2-hour 100% resistive load bank tests.',
                'AMF Changeover Time: Emergency life-safety generators must start and transfer load in <= 10s.',
                'Auto-Synchronizing: Digital engine governors equalize kW and kVAR distribution.'
            ]
        ],
        [
            'id' => 'kb-fire-1',
            'discipline' => 'fire',
            'title' => 'NFPA 25 Weekly Fire Pump Churn Testing & Hydraulic Characteristic Curves',
            'category' => 'Fire & Life Safety',
            'readTime' => '8 min read',
            'codeRef' => 'NFPA 20 / NFPA 25 / NBC Part 4',
            'summary' => 'Weekly electric & diesel fire pump inspection protocol and casing relief valve settings.',
            'keyPoints' => [
                'Weekly Churn Duration: Electric pump 10 mins; Diesel pump 30 mins (NFPA 25 § 8.3.1).',
                'Casing Relief Valve: Must discharge continuous stream of cold water during churn.',
                'Characteristic Curves: Head at 150% flow must not degrade below 65% rated head.'
            ]
        ]
    ];
    ?>
    <div class="facilitypro-knowledgehub-wrapper my-6">
        <!-- Search and Filter Bar -->
        <div class="mb-8 bg-white p-4 rounded-2xl shadow-sm border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-96">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input 
                    type="text" 
                    id="kbSearchInput" 
                    placeholder="Search articles by code, fault, or standard..." 
                    class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 outline-none focus:border-[#0077c8]"
                    oninput="filterKbArticles()"
                />
            </div>

            <!-- Filter Pills -->
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 no-scrollbar" id="kbFilterTabs">
                <button onclick="filterKbDiscipline('all')" class="kb-tab-btn active px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-900 text-white transition-all cursor-pointer">
                    All Disciplines
                </button>
                <button onclick="filterKbDiscipline('hvac')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    HVAC
                </button>
                <button onclick="filterKbDiscipline('electrical')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    Electrical
                </button>
                <button onclick="filterKbDiscipline('plumbing')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    Plumbing
                </button>
                <button onclick="filterKbDiscipline('bms')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    BMS
                </button>
                <button onclick="filterKbDiscipline('dg')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    DG Sets
                </button>
                <button onclick="filterKbDiscipline('fire')" class="kb-tab-btn px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all cursor-pointer">
                    Fire Safety
                </button>
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="kbArticlesGrid">
            <?php foreach ($articles as $art) : ?>
                <div class="kb-card bg-white rounded-2xl p-6 border border-slate-200 hover:border-blue-400 hover:shadow-xl transition-all flex flex-col justify-between" data-discipline="<?php echo esc_attr($art['discipline']); ?>" data-search="<?php echo esc_attr(strtolower($art['title'] . ' ' . $art['summary'] . ' ' . $art['codeRef'])); ?>">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-3">
                            <span class="px-2.5 py-1 rounded-full font-bold bg-blue-50 text-[#0077c8]">
                                <?php echo esc_html($art['category']); ?>
                            </span>
                            <span class="text-slate-400 font-medium flex items-center gap-1">
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                <?php echo esc_html($art['readTime']); ?>
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 leading-snug hover:text-[#0077c8] transition-colors cursor-pointer" onclick="facilityProOpenConsultationModal('Need engineering deep-dive on: <?php echo esc_js($art['title']); ?> (Ref: <?php echo esc_js($art['codeRef']); ?>)')">
                            <?php echo esc_html($art['title']); ?>
                        </h3>
                        <div class="mt-2 text-xs font-mono font-semibold text-slate-500 bg-slate-100 inline-block px-2 py-0.5 rounded">
                            <?php echo esc_html($art['codeRef']); ?>
                        </div>
                        <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                            <?php echo esc_html($art['summary']); ?>
                        </p>

                        <div class="mt-4 pt-3 border-t border-slate-100 space-y-2">
                            <div class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Key Engineering Principles:</div>
                            <ul class="text-xs text-slate-600 space-y-1.5 list-disc pl-4">
                                <?php foreach ($art['keyPoints'] as $pt) : ?>
                                    <li><?php echo esc_html(substr($pt, 0, 110) . '...'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <button onclick="facilityProOpenConsultationModal('Consultation on <?php echo esc_js($art['title']); ?> - Ref: <?php echo esc_js($art['codeRef']); ?>')" class="text-xs font-bold text-[#0077c8] hover:text-[#005a96] flex items-center gap-1">
                            <span>Ask AI Expert</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Explain step-by-step resolution for <?php echo esc_js($art['title']); ?>')" class="px-3 py-1.5 bg-slate-900 hover:bg-[#f05423] text-white text-xs font-bold rounded-lg transition-colors">
                            Deep Dive
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_knowledge_hub', 'facilitypro_knowledge_hub_shortcode');

// 3. SOP Library Shortcode [facilitypro_sop_library]
function facilitypro_sop_library_shortcode($atts) {
    ob_start();
    $sops = [
        [
            'id' => 'sop-hvac-01',
            'code' => 'SOP-HVAC-01',
            'title' => 'Centrifugal Chiller Plant Normal Start & Stop Procedure',
            'category' => 'HVAC & Chilled Water',
            'discipline' => 'hvac',
            'version' => 'v2.4',
            'author' => 'Er. Rajesh Sharma (AI HVAC Expert)',
            'purpose' => 'Standard operating procedure for the safe sequential start-up, operational monitoring, and shutdown of water-cooled centrifugal chiller plants.',
            'ppe' => ['Safety Shoes', 'Safety Glasses / Face Shield', 'Hearing Protection (Ear Muffs)', 'Nitrile Gloves'],
            'hazards' => ['High pressure refrigerant R-134a / R-1234ze', 'Rotating compressor impellers & fan blades', '415V/3.3kV High voltage starter panels', 'Water hammer risk'],
            'steps' => [
                ['stepNumber' => 1, 'title' => 'Energize Cooling Tower & Condenser Water Circuit', 'description' => 'Start the cooling tower fan on VFD low speed (20 Hz). Start the designated condenser water pump (CWP). Verify condenser water flow switch proves on BMS within 15 seconds.'],
                ['stepNumber' => 2, 'title' => 'Energize Primary / Secondary Chilled Water Pumps', 'description' => 'Start primary chilled water pump (PCHWP). Open motorized isolation valve on the active chiller evaporator barrel. Confirm differential pressure across evaporator barrel is between 0.3 - 0.6 bar (4.5 - 9 PSI).'],
                ['stepNumber' => 3, 'title' => 'Initiate Chiller Microprocessor Start Command', 'description' => 'Switch chiller control panel from LOCAL OFF to AUTO / REMOTE START. The unit will initiate lubrication pre-lube cycle for 60 seconds (Oil pressure >= 25 PSI above suction).'],
                ['stepNumber' => 4, 'title' => 'Monitor Compressor Acceleration & Soft-Start', 'description' => 'Observe motor starter ramp up (Star-Delta or VFD). Verify running current stabilizes below Full Load Amps (FLA). Confirm guide vanes modulate slowly from minimum position.'],
                ['stepNumber' => 5, 'title' => 'Verify Steady-State Operating Parameters', 'description' => 'After 15 minutes of operation, log parameters: Chilled Water Leaving (44°F / 6.7°C), Condenser Entering (85°F / 29.4°C), Approach Temperature (< 2.0°F), Oil Temp (130-145°F), Motor Amps.'],
                ['stepNumber' => 6, 'title' => 'Chiller Normal Shutdown Sequence', 'description' => 'Select NORMAL STOP on panel. Microprocessor unloads guide vanes to 0%, opens recycle bypass, trips main compressor motor, runs post-lube oil pump for 180 seconds, and shuts down chilled/condenser water pumps after 5 minutes.']
            ]
        ],
        [
            'id' => 'sop-elec-01',
            'code' => 'SOP-ELEC-01',
            'title' => '11kV / 415V Substation Transformer Cold Energization Procedure',
            'category' => 'Electrical & Power',
            'discipline' => 'electrical',
            'version' => 'v3.1',
            'author' => 'Dr. Vikram Malhotra (AI Electrical Expert)',
            'purpose' => 'Step-by-step safety standard for switching, cold energization, and phase synchronization of 11kV oil-immersed & dry-type power transformers.',
            'ppe' => ['Arc Flash Suit Category 4 (40 cal/cm²)', '11kV Insulated Rubber Gloves (Class 2)', 'Full Face Shield', 'Safety Helmet with Flash Protection'],
            'hazards' => ['11,000V Lethal Electric Shock & Arc Flash Hazard', 'Transformer inrush explosion risk', 'Residual capacitive charge in HT cables'],
            'steps' => [
                ['stepNumber' => 1, 'title' => 'Clear Work Area & Remove Safety Earthing', 'description' => 'Ensure all personnel have exited the HT switchgear room. Remove portable discharge grounding leads from 11kV bus terminals. Close and lock transformer bay mesh doors.'],
                ['stepNumber' => 2, 'title' => 'Verify LV Air Circuit Breaker (ACB) is Racked Out / Open', 'description' => 'Ensure the secondary 415V Main Incomer ACB is in the OPEN / ISOLATED position. Transformer must NEVER be energized with secondary load connected.'],
                ['stepNumber' => 3, 'title' => 'Charge Vacuum Circuit Breaker (VCB) Spring Mechanism', 'description' => 'On the 11kV HT switchgear panel, charge the VCB closing spring (either via motor or manual charging handle). Confirm "SPRING CHARGED" optical indicator is GREEN.'],
                ['stepNumber' => 4, 'title' => 'Close 11kV VCB Breaker (Cold Energization)', 'description' => 'Stand clear outside the arc flash boundary zone. Press the VCB CLOSE pushbutton. Listen for smooth transformer core hum without metallic rattling or arcing sounds.'],
                ['stepNumber' => 5, 'title' => 'Check Secondary Voltage & Phase Sequence', 'description' => 'At the LV incomer voltmeter, check 3-phase line-to-line voltages (415V ± 2%) and line-to-neutral (240V ± 2%). Confirm phase rotation indicator is clockwise (R-Y-B).'],
                ['stepNumber' => 6, 'title' => 'Close LV Incomer & Synchronize Load', 'description' => 'Close the 415V Main Incomer ACB. Sequentially energize downstream motor control centers (MCC) and sub-distribution boards while monitoring phase load balance.']
            ]
        ],
        [
            'id' => 'sop-dg-01',
            'code' => 'SOP-DG-01',
            'title' => 'Diesel Generator (DG Set) Weekly Auto Mains Failure (AMF) Run Test',
            'category' => 'DG Sets & Backup',
            'discipline' => 'dg',
            'version' => 'v2.0',
            'author' => 'Dr. Vikram Malhotra (AI Electrical Expert)',
            'purpose' => 'Standard weekly inspection and on-load testing of emergency diesel generators to guarantee compliance with NFPA 110 Level 1 emergency power standards.',
            'ppe' => ['Hearing Protection (Ear Plugs / Muffs)', 'Safety Glasses', 'High-Grip Oil-Resistant Gloves', 'Safety Shoes'],
            'hazards' => ['Hot exhaust manifold (> 500°C)', 'High pressure diesel fuel injection leaks (2000+ bar)', 'Automatic remote starting without warning'],
            'steps' => [
                ['stepNumber' => 1, 'title' => 'Perform Pre-Start Physical Walkaround', 'description' => 'Check for any oil, water, or diesel fuel leaks beneath engine bed. Ensure intake louvers are unobstructed and exhaust flap is free to open.'],
                ['stepNumber' => 2, 'title' => 'Initiate Manual Test Run (No-Load Mode)', 'description' => 'Turn selector switch on Deep Sea / ComAp controller to MANUAL and press START. Engine must crank, fire, and reach 1500 RPM (50 Hz) or 1800 RPM (60 Hz) within 6 seconds.'],
                ['stepNumber' => 3, 'title' => 'Verify Alternator Voltage & Lube Oil Pressure', 'description' => 'Confirm generated voltage stabilizes at 415V ± 1%. Confirm lube oil pressure builds rapidly to 4.5 - 6.0 bar (65 - 85 PSI).'],
                ['stepNumber' => 4, 'title' => 'Simulate Grid Power Failure (On-Load AMF Test)', 'description' => 'During scheduled maintenance window: Open mains incomer breaker. Confirm ATS transfers essential emergency load to DG within 10 seconds. Run under load for minimum 30 minutes.'],
                ['stepNumber' => 5, 'title' => 'Restore Grid & Cool-Down Sequence', 'description' => 'Re-close mains utility power. Confirm ATS transfers load back to grid seamlessly. Allow DG engine to idle at no-load for 5 minutes cool-down before automatic shutdown.'],
                ['stepNumber' => 6, 'title' => 'Return Controller to AUTO Ready Mode', 'description' => 'Set mode selector switch back to "AUTO". Log run hours, fuel consumption, battery voltage, and oil pressure in DG Plant Log Book.']
            ]
        ],
        [
            'id' => 'sop-fire-01',
            'code' => 'SOP-FIRE-01',
            'title' => 'Weekly Fire Pump Churn & Automatic Pressure Switch Cut-In Test',
            'category' => 'Fire & Life Safety',
            'discipline' => 'fire',
            'version' => 'v3.0',
            'author' => 'Er. Ananya Verma (AI Fire Safety Expert)',
            'purpose' => 'Executing NFPA 25 weekly inspection, testing, and maintenance (ITM) protocol for main electric, diesel backup, and jockey fire pumps.',
            'ppe' => ['Safety Shoes', 'Safety Glasses', 'Protective Gloves', 'Reflective High-Vis Vest'],
            'hazards' => ['High pressure water spray (> 150 PSI)', 'Automatic starting of heavy 150kW electric motors and diesel engines'],
            'steps' => [
                ['stepNumber' => 1, 'title' => 'Notify Security & BMS Control Room', 'description' => 'Place fire alarm monitoring station in TEST mode to prevent false municipal fire brigade dispatch during hydro-pressure drops.'],
                ['stepNumber' => 2, 'title' => 'Inspect Suction OS&Y Valves', 'description' => 'Confirm all suction and discharge gate valves are OPEN and padlocked. Check reservoir level is 100% full.'],
                ['stepNumber' => 3, 'title' => 'Execute Jockey Pump Pressure Restoration Test', 'description' => 'Crack open test drain valve on sensing line. Jockey pump must cut in at 9.5 bar and cut out automatically at 10.5 bar.'],
                ['stepNumber' => 4, 'title' => 'Initiate Electric Main Fire Pump Churn Run', 'description' => 'Bleed sensing line further. Main electric fire pump must auto-start at 8.0 bar. Run for 10 minutes continuously under churn (zero flow). Check casing relief valve flows cold water.'],
                ['stepNumber' => 5, 'title' => 'Initiate Diesel Fire Pump Auto Cut-In', 'description' => 'Isolate electric pump power. Drop pressure to 7.0 bar. Diesel engine pump must crank and fire within 15 seconds. Run for 30 minutes minimum (NFPA 25 § 8.3.1).'],
                ['stepNumber' => 6, 'title' => 'Restore Systems & Log Parameters', 'description' => 'Close test drain valves, reset controllers to AUTO, confirm static pressure returns to 10.5 bar, and log run times in NFPA 25 Fire Register.']
            ]
        ]
    ];
    ?>
    <div class="facilitypro-sop-wrapper my-6 space-y-6">
        <?php foreach ($sops as $idx => $sop) : ?>
            <div class="sop-card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
                
                <!-- Header Bar -->
                <div class="p-6 bg-slate-900 text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2.5 py-0.5 rounded bg-[#f05423] text-white text-[11px] font-extrabold uppercase tracking-wider">
                                <?php echo esc_html($sop['code']); ?>
                            </span>
                            <span class="text-xs text-slate-300 font-medium">
                                <?php echo esc_html($sop['category']); ?> • <?php echo esc_html($sop['version']); ?>
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-white tracking-tight">
                            <?php echo esc_html($sop['title']); ?>
                        </h2>
                        <p class="text-xs text-slate-400 mt-1">
                            Author: <?php echo esc_html($sop['author']); ?>
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="window.print()" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-colors">
                            <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                            <span>Print SOP</span>
                        </button>
                        <button onclick="facilityProOpenConsultationModal('Need urgent advice during execution of <?php echo esc_js($sop['code']); ?>: <?php echo esc_js($sop['title']); ?>')" class="px-4 py-2 bg-[#f05423] hover:bg-[#d94416] text-white rounded-lg text-xs font-bold flex items-center gap-1.5 transition-colors shadow-md">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Ask AI on this SOP</span>
                        </button>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Purpose -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Purpose & Scope</h3>
                        <p class="text-sm font-medium text-slate-700 leading-relaxed"><?php echo esc_html($sop['purpose']); ?></p>
                    </div>

                    <!-- Hazards & PPE Badges -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-rose-50 border border-rose-200 rounded-xl p-4">
                            <h4 class="text-xs font-bold text-rose-800 uppercase tracking-wider flex items-center gap-1.5 mb-2">
                                <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
                                <span>Identified Critical Hazards</span>
                            </h4>
                            <ul class="text-xs text-rose-900 space-y-1 list-disc pl-4">
                                <?php foreach ($sop['hazards'] as $h) : ?>
                                    <li><?php echo esc_html($h); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider flex items-center gap-1.5 mb-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-[#0077c8]"></i>
                                <span>Mandatory PPE Required</span>
                            </h4>
                            <div class="flex flex-wrap gap-1.5 mt-2">
                                <?php foreach ($sop['ppe'] as $p) : ?>
                                    <span class="px-2.5 py-1 bg-white text-blue-900 border border-blue-200 rounded-lg text-xs font-semibold">
                                        <?php echo esc_html($p); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Step Checklist -->
                    <div>
                        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Interactive Execution Steps</h3>
                            <span class="text-xs text-slate-400 font-medium">Tick as you verify on site</span>
                        </div>
                        <div class="space-y-3">
                            <?php foreach ($sop['steps'] as $st) : ?>
                                <label class="flex items-start gap-3 p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors cursor-pointer group">
                                    <input type="checkbox" class="sop-step-chk mt-1 w-4 h-4 text-[#0077c8] rounded border-slate-300 focus:ring-[#0077c8]">
                                    <div class="flex-1">
                                        <div class="text-sm font-bold text-slate-900 group-hover:text-[#0077c8] transition-colors">
                                            Step <?php echo esc_html($st['stepNumber']); ?>: <?php echo esc_html($st['title']); ?>
                                        </div>
                                        <div class="text-xs text-slate-600 mt-1 leading-relaxed">
                                            <?php echo esc_html($st['description']); ?>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
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

// 6. Dashboard Shortcode [facilitypro_dashboard]
function facilitypro_dashboard_shortcode($atts) {
    ob_start();
    ?>
    <div class="facilitypro-dashboard-wrapper my-6 space-y-8">
        <!-- Top Engineer Bar -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-2xl font-black shadow-md">
                    FP
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-2xl font-black text-slate-900">Plant Engineer Portal</h2>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('facilitypro_dashboard', 'facilitypro_dashboard_shortcode');
