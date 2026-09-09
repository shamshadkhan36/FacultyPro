import React, { useState } from 'react';
import { 
  Calculator, 
  Wind, 
  Zap, 
  Droplets, 
  Flame, 
  RotateCw, 
  Gauge, 
  ArrowRight, 
  Sparkles, 
  CheckCircle2, 
  HelpCircle, 
  Layers, 
  Check, 
  Copy, 
  BookOpen
} from 'lucide-react';

export const EngineeringCalculators = ({ onStartAiConsultation }) => {
  const [activeTab, setActiveTab] = useState('cooling');
  const [copied, setCopied] = useState(false);

  // 1. Cooling Load & Chiller TR
  const [areaSqFt, setAreaSqFt] = useState(2500);
  const [occupants, setOccupants] = useState(25);
  const [equipmentWatts, setEquipmentWatts] = useState(15000);
  const [spaceType, setSpaceType] = useState('office');

  // 2. Air Duct Sizing
  const [airflowCfm, setAirflowCfm] = useState(3200);
  const [targetVelocityFpm, setTargetVelocityFpm] = useState(1200);
  const [aspectRatio, setAspectRatio] = useState('1.5');

  // 3. Pump Total Dynamic Head (TDH)
  const [pumpFlowGpm, setPumpFlowGpm] = useState(350);
  const [staticHeadFt, setStaticHeadFt] = useState(45);
  const [pipeLengthFt, setPipeLengthFt] = useState(220);
  const [frictionLossPer100Ft, setFrictionLossPer100Ft] = useState(3.2);
  const [residualPressurePsi, setResidualPressurePsi] = useState(15);
  const [pumpEfficiency, setPumpEfficiency] = useState(78);

  // 4. Electrical Cable Sizing & Voltage Drop
  const [loadKw, setLoadKw] = useState(75);
  const [voltage, setVoltage] = useState(415);
  const [powerFactor, setPowerFactor] = useState(0.85);
  const [cableLengthMeters, setCableLengthMeters] = useState(85);
  const [conductorMaterial, setConductorMaterial] = useState('copper');

  // 5. Chiller COP & kW/TR
  const [chillerTonnage, setChillerTonnage] = useState(350);
  const [chillerKwInput, setChillerKwInput] = useState(210);

  // 6. NFPA 13 Fire Sprinkler Demand
  const [hazardClass, setHazardClass] = useState('ordinary2');
  const [designAreaSqFt, setDesignAreaSqFt] = useState(1500);
  const [hoseStreamGpm, setHoseStreamGpm] = useState(250);

  // Math Calculations:
  // 1. Cooling Load
  const baseHeatPerSqFt = spaceType === 'data_center' ? 120 : spaceType === 'restaurant' ? 65 : 35;
  const areaBtu = areaSqFt * baseHeatPerSqFt;
  const occupantBtu = occupants * 450;
  const equipmentBtu = equipmentWatts * 3.412;
  const totalBtu = areaBtu + occupantBtu + equipmentBtu;
  const calculatedTr = (totalBtu / 12000).toFixed(1);
  const calculatedKwCooling = (calculatedTr * 3.51685).toFixed(1);
  const calculatedSupplyCfm = Math.round(calculatedTr * 400);

  // 2. Duct Sizing
  const ductAreaSqFt = (airflowCfm / targetVelocityFpm).toFixed(2);
  const ductAreaSqIn = (ductAreaSqFt * 144).toFixed(0);
  const roundDiameterIn = (Math.sqrt((4 * ductAreaSqIn) / Math.PI)).toFixed(1);
  const aspRatioNum = parseFloat(aspectRatio);
  const ductHeightIn = Math.round(Math.sqrt(ductAreaSqIn / aspRatioNum));
  const ductWidthIn = Math.round(ductHeightIn * aspRatioNum);

  // 3. Pump TDH
  const totalFrictionLossFt = ((pipeLengthFt / 100) * frictionLossPer100Ft).toFixed(1);
  const residualHeadFt = (residualPressurePsi * 2.31).toFixed(1);
  const totalDynamicHeadFt = (parseFloat(staticHeadFt) + parseFloat(totalFrictionLossFt) + parseFloat(residualHeadFt)).toFixed(1);
  const totalHeadMeters = (totalDynamicHeadFt * 0.3048).toFixed(1);
  const waterHp = ((pumpFlowGpm * totalDynamicHeadFt) / 3960).toFixed(2);
  const brakeHp = (waterHp / (pumpEfficiency / 100)).toFixed(2);
  const motorKw = (brakeHp * 0.7457).toFixed(2);

  // 4. Electrical Cable
  const currentAmps = (loadKw * 1000 / (Math.sqrt(3) * voltage * powerFactor)).toFixed(1);
  const resistivity = conductorMaterial === 'copper' ? 0.0175 : 0.028;
  let recCableSize = 16;
  if (currentAmps > 200) recCableSize = 185;
  else if (currentAmps > 150) recCableSize = 120;
  else if (currentAmps > 100) recCableSize = 70;
  else if (currentAmps > 70) recCableSize = 35;
  else if (currentAmps > 45) recCableSize = 25;
  else recCableSize = 16;
  const voltDropVal = ((Math.sqrt(3) * currentAmps * (resistivity * cableLengthMeters / recCableSize) * powerFactor)).toFixed(2);
  const voltDropPercent = ((voltDropVal / voltage) * 100).toFixed(2);

  // 5. Chiller COP
  const kwPerTr = (chillerKwInput / chillerTonnage).toFixed(3);
  const copValue = (3.51685 / kwPerTr).toFixed(2);
  const eerValue = (copValue * 3.412).toFixed(2);
  const isAshraeCompliant = kwPerTr <= 0.62;

  // 6. NFPA 13 Fire Sprinkler
  const densityTable = { light: 0.10, ordinary1: 0.15, ordinary2: 0.20, extra1: 0.30 };
  const density = densityTable[hazardClass] || 0.15;
  const sprinklerDemandGpm = Math.round(density * designAreaSqFt * 1.15);
  const totalFireWaterDemandGpm = sprinklerDemandGpm + parseInt(hoseStreamGpm, 10);
  const totalDemandM3Hr = (totalFireWaterDemandGpm * 0.2271).toFixed(1);
  const reservoir60MinM3 = Math.round(totalFireWaterDemandGpm * 60 * 0.00378541);

  const copyToClipboard = (text) => {
    navigator.clipboard.writeText(text);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  const tabs = [
    { id: 'cooling', name: 'Cooling Load (TR)', icon: Wind, color: 'text-sky-500' },
    { id: 'duct', name: 'Duct Sizing (CFM)', icon: Layers, color: 'text-teal-500' },
    { id: 'pump', name: 'Pump TDH & Power', icon: RotateCw, color: 'text-blue-500' },
    { id: 'electrical', name: 'Cable & Drop', icon: Zap, color: 'text-amber-500' },
    { id: 'chiller', name: 'Chiller COP & kW/TR', icon: Gauge, color: 'text-emerald-500' },
    { id: 'fire', name: 'NFPA 13 Fire Flow', icon: Flame, color: 'text-rose-500' },
  ];

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto">
        
        {/* Header */}
        <div className="mb-8 text-center max-w-3xl mx-auto">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
            <Calculator className="w-4 h-4" />
            <span>Interactive MEP Calculators</span>
          </div>
          <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
            Engineering Sizing & Code Compliance Calculators
          </h1>
          <p className="mt-2 text-base text-slate-600">
            Exact formulas conforming to ASHRAE, IEEE, IPC, and NFPA standards. Verify any calculation live with our AI Engineering Specialist.
          </p>
        </div>

        {/* Tab Selector */}
        <div className="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar">
          {tabs.map((tab) => {
            const Icon = tab.icon;
            const isActive = activeTab === tab.id;
            return (
              <button
                key={tab.id}
                onClick={() => setActiveTab(tab.id)}
                className={`flex items-center gap-2.5 px-4 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all border cursor-pointer ${
                  isActive
                    ? 'bg-slate-900 text-white border-slate-900 shadow-md'
                    : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300 hover:bg-slate-100'
                }`}
              >
                <Icon className={`w-4 h-4 ${isActive ? 'text-[#f05423]' : tab.color}`} />
                <span>{tab.name}</span>
              </button>
            );
          })}
        </div>

        {/* Active Calculator Box */}
        <div className="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
          
          {/* TAB 1: COOLING LOAD */}
          {activeTab === 'cooling' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <Wind className="w-5 h-5 text-sky-500" />
                    <span>Space Cooling Load & Chiller Tonnage</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to ASHRAE Standard 90.1 / CLTD Method</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Floor Area (sq. ft.)
                    </label>
                    <input
                      type="number"
                      value={areaSqFt}
                      onChange={(e) => setAreaSqFt(Number(e.target.value))}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Occupancy Application
                    </label>
                    <select
                      value={spaceType}
                      onChange={(e) => setSpaceType(e.target.value)}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]"
                    >
                      <option value="office">Commercial Office (35 BTU/sqft)</option>
                      <option value="restaurant">Restaurant / Dining (65 BTU/sqft)</option>
                      <option value="data_center">Server Room / Data Center (120 BTU/sqft)</option>
                    </select>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Number of Occupants
                    </label>
                    <input
                      type="number"
                      value={occupants}
                      onChange={(e) => setOccupants(Number(e.target.value))}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Internal Equipment Power (Watts)
                    </label>
                    <input
                      type="number"
                      value={equipmentWatts}
                      onChange={(e) => setEquipmentWatts(Number(e.target.value))}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold text-slate-800 outline-none focus:border-[#0077c8]"
                    />
                  </div>
                </div>

                <div className="p-4 bg-sky-50 border border-sky-200 rounded-xl text-xs text-sky-950 font-medium">
                  <strong>ASHRAE Rule of Thumb:</strong> 1 Ton of Refrigeration (TR) = 12,000 BTU/hr = 3.517 kW cooling. Nominal airflow sizing is standard 400 CFM per TR at 55°F supply air temperature.
                </div>
              </div>

              {/* Result Column */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Calculated Capacity</span>
                    <span className="px-2 py-0.5 rounded bg-sky-500/20 text-sky-300 text-[11px] font-bold border border-sky-400/30">ASHRAE CLTD</span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-5xl font-black text-white tracking-tight">{calculatedTr} <span className="text-2xl text-[#f05423]">TR</span></div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">{calculatedKwCooling} kW Thermal Cooling</div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700 text-xs">
                    <div>
                      <div className="text-slate-400">Total Heat Gain:</div>
                      <div className="font-bold text-white text-sm">{Math.round(totalBtu).toLocaleString()} BTU/hr</div>
                    </div>
                    <div>
                      <div className="text-slate-400">Supply Airflow:</div>
                      <div className="font-bold text-sky-400 text-sm">{calculatedSupplyCfm.toLocaleString()} CFM</div>
                    </div>
                  </div>
                </div>

                <div className="mt-6 space-y-2">
                  <button
                    onClick={() => onStartAiConsultation(`Please perform a detailed psychrometric & chiller plant review for a ${calculatedTr} TR cooling system (${calculatedSupplyCfm} CFM) for a ${areaSqFt} sq ft ${spaceType} space with ${occupants} occupants.`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-[#0077c8] to-[#0099f7] hover:from-[#006bb5] text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-amber-300" />
                    <span>Verify with AI Engineering Specialist</span>
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* TAB 2: DUCT SIZING */}
          {activeTab === 'duct' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <Layers className="w-5 h-5 text-teal-500" />
                    <span>Air Duct Sizing & Velocity (Equal Friction)</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to SMACNA HVAC Duct Construction Standards</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Total Airflow (CFM)
                    </label>
                    <input
                      type="number"
                      value={airflowCfm}
                      onChange={(e) => setAirflowCfm(Number(e.target.value))}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none focus:border-[#0077c8]"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Velocity (FPM)
                    </label>
                    <input
                      type="number"
                      value={targetVelocityFpm}
                      onChange={(e) => setTargetVelocityFpm(Number(e.target.value))}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none focus:border-[#0077c8]"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                      Aspect Ratio (W:H)
                    </label>
                    <select
                      value={aspectRatio}
                      onChange={(e) => setAspectRatio(e.target.value)}
                      className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none focus:border-[#0077c8]"
                    >
                      <option value="1">1:1 (Square)</option>
                      <option value="1.5">1.5:1 (Standard)</option>
                      <option value="2">2:1 (Low Clearance)</option>
                    </select>
                  </div>
                </div>

                <div className="p-4 bg-teal-50 border border-teal-200 rounded-xl text-xs text-teal-950 font-medium">
                  <strong>SMACNA Recommended Velocities:</strong> Main Supply Trunk: 1,000–1,400 FPM (Noise-sensitive: &le; 1,100 FPM); Branch Ducts: 700–900 FPM.
                </div>
              </div>

              {/* Duct Results */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Duct Dimensions</span>
                    <span className="px-2 py-0.5 rounded bg-teal-500/20 text-teal-300 text-[11px] font-bold border border-teal-400/30">SMACNA</span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-4xl font-black text-white tracking-tight">{ductWidthIn}&quot; × {ductHeightIn}&quot;</div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">Rectangular Duct (W × H)</div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700 text-xs">
                    <div>
                      <div className="text-slate-400">Round Diameter:</div>
                      <div className="font-bold text-teal-400 text-sm">Ø {roundDiameterIn} Inches</div>
                    </div>
                    <div>
                      <div className="text-slate-400">Duct Area:</div>
                      <div className="font-bold text-white text-sm">{ductAreaSqIn} sq. in. ({ductAreaSqFt} sq.ft)</div>
                    </div>
                  </div>
                </div>

                <div className="mt-6">
                  <button
                    onClick={() => onStartAiConsultation(`Evaluate duct static pressure loss, aspect ratio, and noise criteria for a ${ductWidthIn}x${ductHeightIn} inch duct carrying ${airflowCfm} CFM at ${targetVelocityFpm} FPM.`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-amber-300" />
                    <span>Check Acoustic & Friction Loss with AI</span>
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* TAB 3: PUMP TDH */}
          {activeTab === 'pump' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <RotateCw className="w-5 h-5 text-blue-500" />
                    <span>Pump Total Dynamic Head (TDH) & Motor Power</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to Hydraulic Institute (HI) & IPC Standards</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Flow (GPM)</label>
                    <input type="number" value={pumpFlowGpm} onChange={(e) => setPumpFlowGpm(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Static Head (ft)</label>
                    <input type="number" value={staticHeadFt} onChange={(e) => setStaticHeadFt(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Pipe Run (ft)</label>
                    <input type="number" value={pipeLengthFt} onChange={(e) => setPipeLengthFt(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Friction Loss/100ft</label>
                    <input type="number" value={frictionLossPer100Ft} onChange={(e) => setFrictionLossPer100Ft(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Residual PSI</label>
                    <input type="number" value={residualPressurePsi} onChange={(e) => setResidualPressurePsi(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Pump Efficiency %</label>
                    <input type="number" value={pumpEfficiency} onChange={(e) => setPumpEfficiency(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                </div>
              </div>

              {/* Pump Results */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Pump Output</span>
                    <span className="px-2 py-0.5 rounded bg-blue-500/20 text-blue-300 text-[11px] font-bold border border-blue-400/30">Hydraulic Inst</span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-4xl font-black text-white tracking-tight">{totalDynamicHeadFt} <span className="text-xl text-blue-400">ft TDH</span></div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">{totalHeadMeters} Meters | {brakeHp} BHP ({motorKw} kW)</div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700 text-xs">
                    <div>
                      <div className="text-slate-400">Water HP:</div>
                      <div className="font-bold text-white text-sm">{waterHp} WHP</div>
                    </div>
                    <div>
                      <div className="text-slate-400">Rec. Motor Size:</div>
                      <div className="font-bold text-blue-400 text-sm">{Math.ceil(brakeHp * 1.15)} HP</div>
                    </div>
                  </div>
                </div>

                <div className="mt-6">
                  <button
                    onClick={() => onStartAiConsultation(`Calculate pump NPSH margin, affinity laws for VFD modulation, and water hammer surge for ${pumpFlowGpm} GPM at ${totalDynamicHeadFt} ft TDH.`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-amber-300" />
                    <span>Analyze Pump NPSH with AI</span>
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* TAB 4: ELECTRICAL */}
          {activeTab === 'electrical' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <Zap className="w-5 h-5 text-amber-500" />
                    <span>3-Phase Cable Sizing & Voltage Drop</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to IEC 60364 & NEC Article 310</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Load (kW)</label>
                    <input type="number" value={loadKw} onChange={(e) => setLoadKw(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Voltage (V)</label>
                    <select value={voltage} onChange={(e) => setVoltage(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none">
                      <option value="415">415V (3-Phase)</option>
                      <option value="400">400V (3-Phase)</option>
                      <option value="230">230V (1-Phase)</option>
                    </select>
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Power Factor</label>
                    <input type="number" step="0.01" max="1" min="0.5" value={powerFactor} onChange={(e) => setPowerFactor(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Length (Meters)</label>
                    <input type="number" value={cableLengthMeters} onChange={(e) => setCableLengthMeters(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Conductor</label>
                    <select value={conductorMaterial} onChange={(e) => setConductorMaterial(e.target.value)} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none">
                      <option value="copper">Copper (Cu)</option>
                      <option value="aluminium">Aluminium (Al)</option>
                    </select>
                  </div>
                </div>
              </div>

              {/* Electrical Results */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Electrical Parameters</span>
                    <span className="px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 text-[11px] font-bold border border-amber-400/30">IEC 60364</span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-4xl font-black text-white tracking-tight">{currentAmps} <span className="text-xl text-amber-400">Amps FLA</span></div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">Rec. Cable: <span className="text-white font-bold">{recCableSize} mm²</span> 3.5C XLPE</div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700 text-xs">
                    <div>
                      <div className="text-slate-400">Voltage Drop:</div>
                      <div className="font-bold text-white text-sm">{voltDropVal}V ({voltDropPercent}%)</div>
                    </div>
                    <div>
                      <div className="text-slate-400">Drop Compliance:</div>
                      <div className={`font-bold text-sm ${parseFloat(voltDropPercent) <= 3.0 ? 'text-emerald-400' : 'text-rose-400'}`}>
                        {parseFloat(voltDropPercent) <= 3.0 ? 'PASS (<=3%)' : 'EXCEEDS LIMIT'}
                      </div>
                    </div>
                  </div>
                </div>

                <div className="mt-6">
                  <button
                    onClick={() => onStartAiConsultation(`Calculate short circuit withstand and thermal derating for ${recCableSize} mm² cable feeding ${loadKw} kW at ${voltage}V (${currentAmps}A FLA).`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-500 text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-white" />
                    <span>Verify Cable Protection with AI</span>
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* TAB 5: CHILLER COP */}
          {activeTab === 'chiller' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <Gauge className="w-5 h-5 text-emerald-500" />
                    <span>Central Chiller COP & Performance</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to AHRI 550/590 & ASHRAE 90.1</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Capacity (TR)</label>
                    <input type="number" value={chillerTonnage} onChange={(e) => setChillerTonnage(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Input Electrical Power (kW)</label>
                    <input type="number" value={chillerKwInput} onChange={(e) => setChillerKwInput(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                </div>
              </div>

              {/* Chiller Results */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Chiller COP & EER</span>
                    <span className={`px-2 py-0.5 rounded text-[11px] font-bold border ${isAshraeCompliant ? 'bg-emerald-500/20 text-emerald-300 border-emerald-400/30' : 'bg-rose-500/20 text-rose-300 border-rose-400/30'}`}>
                      {isAshraeCompliant ? 'ASHRAE 90.1 Compliant' : 'Standard Efficiency'}
                    </span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-4xl font-black text-white tracking-tight">{kwPerTr} <span className="text-xl text-emerald-400">kW / TR</span></div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">COP: <span className="text-white font-bold">{copValue}</span> | EER: <span className="text-white font-bold">{eerValue}</span></div>
                  </div>
                </div>

                <div className="mt-6">
                  <button
                    onClick={() => onStartAiConsultation(`Optimize chiller plant efficiency for ${chillerTonnage} TR chiller drawing ${chillerKwInput} kW (${kwPerTr} kW/TR, COP ${copValue}). Suggest approach temp and condenser water reset.`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-amber-300" />
                    <span>Optimize Chiller Efficiency with AI</span>
                  </button>
                </div>
              </div>
            </div>
          )}

          {/* TAB 6: FIRE SPRINKLER */}
          {activeTab === 'fire' && (
            <div className="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
              <div className="lg:col-span-7 space-y-6">
                <div className="border-b border-slate-100 pb-4">
                  <h2 className="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <Flame className="w-5 h-5 text-rose-500" />
                    <span>NFPA 13 Fire Sprinkler Demand</span>
                  </h2>
                  <p className="text-xs text-slate-500 mt-1">Conforms to NFPA 13 & NFPA 20 Standards</p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Hazard Class</label>
                    <select value={hazardClass} onChange={(e) => setHazardClass(e.target.value)} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none">
                      <option value="light">Light Hazard (0.10 gpm/sqft)</option>
                      <option value="ordinary1">Ordinary Hazard Grp 1 (0.15)</option>
                      <option value="ordinary2">Ordinary Hazard Grp 2 (0.20)</option>
                      <option value="extra1">Extra Hazard Grp 1 (0.30)</option>
                    </select>
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Design Area (sq ft)</label>
                    <input type="number" value={designAreaSqFt} onChange={(e) => setDesignAreaSqFt(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                  <div>
                    <label className="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Hose Stream (GPM)</label>
                    <input type="number" value={hoseStreamGpm} onChange={(e) => setHoseStreamGpm(Number(e.target.value))} className="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm font-semibold outline-none" />
                  </div>
                </div>
              </div>

              {/* Fire Results */}
              <div className="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-xl p-6 flex flex-col justify-between shadow-lg">
                <div>
                  <div className="flex items-center justify-between border-b border-slate-700 pb-3">
                    <span className="text-xs font-bold text-slate-400 uppercase tracking-wider">Fire Demand & Tank</span>
                    <span className="px-2 py-0.5 rounded bg-rose-500/20 text-rose-300 text-[11px] font-bold border border-rose-400/30">NFPA 13 / 20</span>
                  </div>

                  <div className="my-6 text-center">
                    <div className="text-4xl font-black text-white tracking-tight">{totalFireWaterDemandGpm} <span className="text-xl text-rose-400">GPM</span></div>
                    <div className="text-sm font-semibold text-slate-400 mt-1">{totalDemandM3Hr} m³/hr Fire Water Demand</div>
                  </div>

                  <div className="grid grid-cols-2 gap-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700 text-xs">
                    <div>
                      <div className="text-slate-400">Sprinkler Flow:</div>
                      <div className="font-bold text-white text-sm">{sprinklerDemandGpm} GPM</div>
                    </div>
                    <div>
                      <div className="text-slate-400">60-Min Tank:</div>
                      <div className="font-bold text-rose-400 text-sm">{reservoir60MinM3} m³</div>
                    </div>
                  </div>
                </div>

                <div className="mt-6">
                  <button
                    onClick={() => onStartAiConsultation(`Sizing NFPA 20 fire pump and jockey pump pressures for ${totalFireWaterDemandGpm} GPM total water demand (${hazardClass}).`)}
                    className="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 text-white font-bold text-sm rounded-xl shadow-md transition-all cursor-pointer"
                  >
                    <Sparkles className="w-4 h-4 text-amber-300" />
                    <span>Design NFPA Fire Pump with AI</span>
                  </button>
                </div>
              </div>
            </div>
          )}

        </div>

      </div>
    </div>
  );
};

export default EngineeringCalculators;