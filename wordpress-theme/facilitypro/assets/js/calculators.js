/**
 * FacilityPro MEP Interactive Calculators
 * ASHRAE, SMACNA, Hydraulic Institute, IEC, AHRI, and NFPA calculations
 */

function switchCalcTab(tabId) {
    document.querySelectorAll('.calc-tab-btn').forEach(btn => {
        if (btn.dataset.tab === tabId) {
            btn.className = 'calc-tab-btn active flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-slate-900 text-white border-slate-900 shadow-md';
        } else {
            btn.className = 'calc-tab-btn flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100';
        }
    });

    document.querySelectorAll('.calc-panel').forEach(panel => {
        panel.classList.add('hidden');
    });

    const activePanel = document.getElementById('calc-' + tabId);
    if (activePanel) {
        activePanel.classList.remove('hidden');
    }

    if (window.lucide) {
        lucide.createIcons();
    }
}

// 1. Cooling Load & Chiller TR
function calculateCoolingLoad() {
    const area = parseFloat(document.getElementById('cooling_area')?.value) || 0;
    const space = document.getElementById('cooling_space')?.value || 'office';
    const occupants = parseFloat(document.getElementById('cooling_occupants')?.value) || 0;
    const watts = parseFloat(document.getElementById('cooling_watts')?.value) || 0;

    const baseHeatPerSqFt = space === 'data_center' ? 120 : space === 'restaurant' ? 65 : 35;
    const areaBtu = area * baseHeatPerSqFt;
    const occupantBtu = occupants * 450;
    const equipmentBtu = watts * 3.412;
    const totalBtu = areaBtu + occupantBtu + equipmentBtu;

    const calculatedTr = (totalBtu / 12000).toFixed(1);
    const calculatedKw = (calculatedTr * 3.51685).toFixed(1);
    const calculatedCfm = Math.round(calculatedTr * 400).toLocaleString();

    if (document.getElementById('res_cooling_tr')) document.getElementById('res_cooling_tr').textContent = calculatedTr + ' TR';
    if (document.getElementById('res_cooling_kw')) document.getElementById('res_cooling_kw').textContent = '(' + calculatedKw + ' kW Cooling)';
    if (document.getElementById('res_cooling_cfm')) document.getElementById('res_cooling_cfm').textContent = calculatedCfm + ' CFM';
    if (document.getElementById('res_cooling_btu')) document.getElementById('res_cooling_btu').textContent = Math.round(totalBtu).toLocaleString() + ' BTU/h';
}

// 2. Air Duct Sizing
function calculateDuctSize() {
    const cfm = parseFloat(document.getElementById('duct_cfm')?.value) || 0;
    const velocity = parseFloat(document.getElementById('duct_velocity')?.value) || 1200;
    const aspectRatio = parseFloat(document.getElementById('duct_aspect')?.value) || 1.5;

    const ductAreaSqFt = (cfm / velocity);
    const ductAreaSqIn = ductAreaSqFt * 144;
    const roundDiameterIn = (Math.sqrt((4 * ductAreaSqIn) / Math.PI)).toFixed(1);
    const ductHeightIn = Math.round(Math.sqrt(ductAreaSqIn / aspectRatio));
    const ductWidthIn = Math.round(ductHeightIn * aspectRatio);

    if (document.getElementById('res_duct_rect')) document.getElementById('res_duct_rect').textContent = ductWidthIn + '" × ' + ductHeightIn + '"';
    if (document.getElementById('res_duct_area')) document.getElementById('res_duct_area').textContent = '(' + Math.round(ductAreaSqIn) + ' sq. inches / ' + ductAreaSqFt.toFixed(2) + ' sq. ft)';
    if (document.getElementById('res_duct_round')) document.getElementById('res_duct_round').textContent = roundDiameterIn + '" Ø';
}

// 3. Pump TDH & Motor Power
function calculatePump() {
    const flow = parseFloat(document.getElementById('pump_flow')?.value) || 0;
    const staticHead = parseFloat(document.getElementById('pump_static')?.value) || 0;
    const length = parseFloat(document.getElementById('pump_length')?.value) || 0;
    const friction = parseFloat(document.getElementById('pump_friction')?.value) || 3.2;
    const residualPsi = parseFloat(document.getElementById('pump_residual')?.value) || 15;
    const eff = parseFloat(document.getElementById('pump_eff')?.value) || 78;

    const totalFrictionLossFt = (length / 100) * friction;
    const residualHeadFt = residualPsi * 2.31;
    const totalDynamicHeadFt = (staticHead + totalFrictionLossFt + residualHeadFt).toFixed(1);
    const totalHeadMeters = (totalDynamicHeadFt * 0.3048).toFixed(1);
    const totalHeadBar = (totalDynamicHeadFt * 0.02989).toFixed(2);
    const waterHp = (flow * totalDynamicHeadFt) / 3960;
    const brakeHp = (waterHp / (eff / 100)).toFixed(2);
    const motorKw = (brakeHp * 0.7457).toFixed(2);

    if (document.getElementById('res_pump_tdh')) document.getElementById('res_pump_tdh').textContent = totalDynamicHeadFt + ' Ft';
    if (document.getElementById('res_pump_meters')) document.getElementById('res_pump_meters').textContent = '(' + totalHeadMeters + ' meters / ' + totalHeadBar + ' bar)';
    if (document.getElementById('res_pump_bhp')) document.getElementById('res_pump_bhp').textContent = brakeHp + ' HP';
    if (document.getElementById('res_pump_kw')) document.getElementById('res_pump_kw').textContent = motorKw + ' kW';
}

// 4. 3-Phase Cable Sizing & Voltage Drop
function calculateElectrical() {
    const kw = parseFloat(document.getElementById('elec_kw')?.value) || 0;
    const voltage = parseFloat(document.getElementById('elec_voltage')?.value) || 415;
    const pf = parseFloat(document.getElementById('elec_pf')?.value) || 0.85;
    const length = parseFloat(document.getElementById('elec_length')?.value) || 0;
    const material = document.getElementById('elec_material')?.value || 'copper';

    const currentAmps = (kw * 1000 / (Math.sqrt(3) * voltage * pf)).toFixed(1);
    const resistivity = material === 'copper' ? 0.0175 : 0.028;

    let recCableSize = 16;
    if (currentAmps > 200) recCableSize = 185;
    else if (currentAmps > 150) recCableSize = 120;
    else if (currentAmps > 100) recCableSize = 70;
    else if (currentAmps > 70) recCableSize = 35;
    else if (currentAmps > 45) recCableSize = 25;
    else recCableSize = 16;

    const voltDropVal = (Math.sqrt(3) * currentAmps * (resistivity * length / recCableSize) * pf).toFixed(2);
    const voltDropPercent = ((voltDropVal / voltage) * 100).toFixed(2);
    const isPass = voltDropPercent <= 3.0;

    if (document.getElementById('res_elec_cable')) document.getElementById('res_elec_cable').textContent = recCableSize + ' sq.mm';
    if (document.getElementById('res_elec_current')) document.getElementById('res_elec_current').textContent = 'Full Load Current: ' + currentAmps + ' Amps (' + material.toUpperCase() + ')';
    if (document.getElementById('res_elec_vdrop')) document.getElementById('res_elec_vdrop').textContent = voltDropVal + ' Volts';
    if (document.getElementById('res_elec_vdroppct')) {
        document.getElementById('res_elec_vdroppct').textContent = voltDropPercent + '% (' + (isPass ? 'Pass <= 3%' : 'Exceeds 3%') + ')';
        document.getElementById('res_elec_vdroppct').className = isPass ? 'text-lg font-bold text-emerald-400 mt-0.5' : 'text-lg font-bold text-rose-400 mt-0.5';
    }
}

// 5. Chiller COP & kW/TR
function calculateChillerEfficiency() {
    const tr = parseFloat(document.getElementById('chiller_tr')?.value) || 1;
    const kw = parseFloat(document.getElementById('chiller_kw')?.value) || 0;

    const kwPerTr = (kw / tr).toFixed(3);
    const cop = (3.51685 / (kw / tr)).toFixed(2);
    const eer = (cop * 3.412).toFixed(2);
    const isAshrae = (kw / tr) <= 0.62;

    if (document.getElementById('res_chiller_kwtr')) document.getElementById('res_chiller_kwtr').textContent = kwPerTr + ' kW/TR';
    if (document.getElementById('res_chiller_ashrae')) {
        document.getElementById('res_chiller_ashrae').textContent = isAshrae ? '✓ Compliant with ASHRAE 90.1 Path B' : '⚠ High Power Consumption (> 0.62 kW/TR)';
        document.getElementById('res_chiller_ashrae').className = isAshrae ? 'text-xs text-emerald-400 font-bold mt-1' : 'text-xs text-amber-400 font-bold mt-1';
    }
    if (document.getElementById('res_chiller_cop')) document.getElementById('res_chiller_cop').textContent = cop;
    if (document.getElementById('res_chiller_eer')) document.getElementById('res_chiller_eer').textContent = eer + ' EER';
}

// 6. NFPA 13 Fire Sprinkler Demand
function calculateFireDemand() {
    const hazard = document.getElementById('fire_hazard')?.value || 'ordinary2';
    const area = parseFloat(document.getElementById('fire_area')?.value) || 1500;
    const hose = parseFloat(document.getElementById('fire_hose')?.value) || 250;

    const densityMap = { light: 0.10, ordinary1: 0.15, ordinary2: 0.20, extra1: 0.30 };
    const density = densityMap[hazard] || 0.20;

    const sprinklerDemandGpm = Math.round(density * area * 1.15);
    const totalGpm = sprinklerDemandGpm + hose;
    const m3hr = (totalGpm * 0.2271).toFixed(1);
    const lpm = Math.round(totalGpm * 3.78541).toLocaleString();
    const tankM3 = Math.round(totalGpm * 60 * 0.00378541);

    if (document.getElementById('res_fire_flow')) document.getElementById('res_fire_flow').textContent = totalGpm + ' GPM';
    if (document.getElementById('res_fire_m3hr')) document.getElementById('res_fire_m3hr').textContent = '(' + m3hr + ' m³/hr / ' + lpm + ' LPM)';
    if (document.getElementById('res_fire_sprinkler')) document.getElementById('res_fire_sprinkler').textContent = sprinklerDemandGpm + ' GPM';
    if (document.getElementById('res_fire_tank')) document.getElementById('res_fire_tank').textContent = tankM3 + ' m³';
}

// Copy to clipboard helper
function copyCalcResult(type) {
    let summary = '';
    if (type === 'cooling') {
        summary = 'MEP COOLING LOAD CALCULATION (ASHRAE 90.1)\n' +
            'Cooling Capacity: ' + document.getElementById('res_cooling_tr')?.textContent + ' ' + document.getElementById('res_cooling_kw')?.textContent + '\n' +
            'Supply Airflow: ' + document.getElementById('res_cooling_cfm')?.textContent + '\n' +
            'Total Heat Gain: ' + document.getElementById('res_cooling_btu')?.textContent + '\n' +
            'Calculated via FacilityPro Engineering Engine';
    } else if (type === 'duct') {
        summary = 'SMACNA DUCT SIZING CALCULATION\n' +
            'Rectangular Duct: ' + document.getElementById('res_duct_rect')?.textContent + '\n' +
            'Round Equivalent: ' + document.getElementById('res_duct_round')?.textContent + '\n' +
            'Calculated via FacilityPro Engineering Engine';
    } else if (type === 'pump') {
        summary = 'PUMP HYDRAULIC SIZING (HI Standards)\n' +
            'Total Dynamic Head (TDH): ' + document.getElementById('res_pump_tdh')?.textContent + ' ' + document.getElementById('res_pump_meters')?.textContent + '\n' +
            'BHP: ' + document.getElementById('res_pump_bhp')?.textContent + ' | Motor Power: ' + document.getElementById('res_pump_kw')?.textContent + '\n' +
            'Calculated via FacilityPro Engineering Engine';
    } else if (type === 'electrical') {
        summary = 'IEC 60364 3-PHASE CABLE & VOLTAGE DROP\n' +
            'Recommended Cable: ' + document.getElementById('res_elec_cable')?.textContent + '\n' +
            'Voltage Drop: ' + document.getElementById('res_elec_vdrop')?.textContent + ' (' + document.getElementById('res_elec_vdroppct')?.textContent + ')\n' +
            'Calculated via FacilityPro Engineering Engine';
    } else if (type === 'chiller') {
        summary = 'CHILLER PLANT EFFICIENCY (AHRI 550/590)\n' +
            'Specific Power: ' + document.getElementById('res_chiller_kwtr')?.textContent + '\n' +
            'COP: ' + document.getElementById('res_chiller_cop')?.textContent + ' | EER: ' + document.getElementById('res_chiller_eer')?.textContent + '\n' +
            'Calculated via FacilityPro Engineering Engine';
    } else if (type === 'fire') {
        summary = 'NFPA 13 FIRE SPRINKLER & WATER DEMAND\n' +
            'Total Demand: ' + document.getElementById('res_fire_flow')?.textContent + ' ' + document.getElementById('res_fire_m3hr')?.textContent + '\n' +
            'Sprinkler Flow: ' + document.getElementById('res_fire_sprinkler')?.textContent + '\n' +
            '60-Min Reservoir: ' + document.getElementById('res_fire_tank')?.textContent + '\n' +
            'Calculated via FacilityPro Engineering Engine';
    }

    if (navigator.clipboard && summary) {
        navigator.clipboard.writeText(summary).then(() => {
            const btn = document.getElementById('copy_btn_' + type);
            if (btn) {
                const orig = btn.textContent;
                btn.textContent = 'Copied to Clipboard!';
                setTimeout(() => { btn.textContent = orig; }, 2000);
            }
        });
    }
}

// Auto initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('cooling_area')) calculateCoolingLoad();
    if (document.getElementById('duct_cfm')) calculateDuctSize();
    if (document.getElementById('pump_flow')) calculatePump();
    if (document.getElementById('elec_kw')) calculateElectrical();
    if (document.getElementById('chiller_tr')) calculateChillerEfficiency();
    if (document.getElementById('fire_area')) calculateFireDemand();
});
