export const knowledgeDisciplines = [
  { id: 'hvac', name: 'HVAC & Chilled Water', icon: 'Wind', color: 'text-sky-500 bg-sky-50 border-sky-200' },
  { id: 'electrical', name: 'Electrical & Power', icon: 'Zap', color: 'text-amber-500 bg-amber-50 border-amber-200' },
  { id: 'plumbing', name: 'Plumbing & Drainage', icon: 'Droplets', color: 'text-blue-500 bg-blue-50 border-blue-200' },
  { id: 'bms', name: 'BMS & Automation', icon: 'Cpu', color: 'text-emerald-500 bg-emerald-50 border-emerald-200' },
  { id: 'dg', name: 'DG Sets & Backup', icon: 'Gauge', color: 'text-orange-500 bg-orange-50 border-orange-200' },
  { id: 'pumps', name: 'Pumps & Hydro Systems', icon: 'RotateCw', color: 'text-teal-500 bg-teal-50 border-teal-200' },
  { id: 'fire', name: 'Fire & Life Safety', icon: 'Flame', color: 'text-rose-500 bg-rose-50 border-rose-200' },
  { id: 'hotel', name: 'Hotel & Commercial MEP', icon: 'Building2', color: 'text-purple-500 bg-purple-50 border-purple-200' },
];

export const knowledgeArticles = [
  {
    id: 'kb-hvac-1',
    discipline: 'hvac',
    title: 'Centrifugal Chiller Surge Identification & Aerodynamic Lift Control',
    category: 'HVAC & Chilled Water',
    readTime: '6 min read',
    codeRef: 'ASHRAE Guideline 22 / Standard 90.1',
    summary: 'Comprehensive analysis of compressor surge dynamics under low evaporator load or excessive condenser water entering temperatures.',
    keyPoints: [
      'Surge Mechanism: Occurs when the refrigerant pressure ratio (Condenser Pressure / Evaporator Pressure) exceeds the aerodynamic pressure-lift capacity of the compressor impeller, creating transient flow reversal and violent thrust bearing oscillation.',
      'Condenser Approach Monitoring: Maintain approach temperature (Condenser Saturation Temp - Leaving Condenser Water Temp) < 2.0°F (1.1°C). Any approach > 3.5°F proves condenser tube fouling or air trapping.',
      'Variable Speed Drive (VSD) Anti-Surge Tuning: Ensure VFD low-speed frequency limit is set above the calculated surge envelope frequency at current lift conditions.'
    ],
    faultMatrix: [
      { symptom: 'Loud barking / cyclic groaning at 70-90% load', cause: 'High condenser head pressure due to cooling tower scaling', remedy: 'Clean cooling tower nozzles, check fan VFD, and punch condenser tubes' },
      { symptom: 'High oil temperature & foaming', cause: 'Refrigerant migration into oil sump during shutdown', remedy: 'Verify crankcase oil heater operation (> 120°F / 49°C before start)' },
      { symptom: 'Low evaporator suction pressure trip', cause: 'Low chilled water flow or TXV / electronic expansion valve hunting', remedy: 'Check chilled water delta-P across cooler barrel and clean strainer' }
    ]
  },
  {
    id: 'kb-elec-1',
    discipline: 'electrical',
    title: 'Transformer 87T Differential Relay Harmonic Restraint & Inrush Protection',
    category: 'Electrical & Power',
    readTime: '7 min read',
    codeRef: 'IEEE C37.91 / IEC 60255 / NFPA 70',
    summary: 'Preventing nuisance trips during transformer grid energization while preserving high sensitivity for internal turn-to-turn faults.',
    keyPoints: [
      'Inrush Magnetizing Current: Upon breaker closure, core residual flux causes saturation, drawing peak inrush currents up to 8-12x Full Load Amps (FLA) with strong unipolar DC offset and 2nd harmonic content.',
      '2nd Harmonic Blocking (15% Threshold): Modern numerical differential relays must be parameterized with 15% 2nd harmonic restraint to differentiate magnetizing inrush from high-current internal short circuits.',
      'Vector Group Compensation: Software CT phase shift matrix must match transformer winding configuration (e.g. Dyn11 requires 30° phase angle compensation).'
    ],
    faultMatrix: [
      { symptom: 'Trip on 87T during cold energization', cause: '2nd harmonic blocking disabled or threshold set too high (> 25%)', remedy: 'Set 2nd harmonic restraint to 15% on numerical protection relay' },
      { symptom: 'Buchholz relay gas alarm', cause: 'Minor internal arcing or dielectric oil breakdown generating combustible gas', remedy: 'Perform Dissolved Gas Analysis (DGA) for acetylene (C2H2) and ethylene' },
      { symptom: 'Low Power Factor penalty (< 0.90)', cause: 'Heavy inductive motor loads without automatic capacitor bank switching', remedy: 'Check APFC controller relay steps and detuned harmonic reactor condition' }
    ]
  },
  {
    id: 'kb-plumb-1',
    discipline: 'plumbing',
    title: 'High-Rise Hydro-Pneumatic Water Supply & Water Hammer Arrestor Design',
    category: 'Plumbing & Drainage',
    readTime: '5 min read',
    codeRef: 'IPC § 604 / ASPE Data Book / PDI-WH 201',
    summary: 'Hydraulic principles for vertical pressure zoning, booster pump staging, and water hammer mitigation in multi-story towers.',
    keyPoints: [
      'Vertical Pressure Zoning: Fixture static pressure must not exceed 80 PSI (5.5 bar). Buildings over 15 floors require zoning into Low, Mid, and High pressure zones with redundant parallel PRV stations.',
      'Joukowsky Shock Waves: Fast closing solenoid flush valves create shock pressures: Delta P = rho * c * Delta v exceeding 300+ PSI. Install PDI-WH 201 certified stainless steel bellows arrestors.',
      'Hydro-pneumatic Expansion Tank Pre-charge: Maintain nitrogen pre-charge at 0.2 bar (3 PSI) below pump cut-in pressure to prevent bladder rupture.'
    ],
    faultMatrix: [
      { symptom: 'Loud pipe shuddering on flush valve closure', cause: 'Water hammer arrestor bladder ruptured or undersized', remedy: 'Replace with PDI-WH 201 certified Size C/D arrestor within 6ft of valve' },
      { symptom: 'Booster pump rapid cycling (hunting)', cause: 'Expansion tank waterlogged or pre-charge lost', remedy: 'Isolate tank, drain water, and recharge nitrogen to 0.2 bar below cut-in' },
      { symptom: 'Low water pressure at upper penthouse', cause: 'VFD pressure transducer drift or clogged suction strainer', remedy: 'Recalibrate 4-20mA sensor and clean suction dual-basket strainer' }
    ]
  },
  {
    id: 'kb-bms-1',
    discipline: 'bms',
    title: 'BMS DDC Architecture, BACnet MS/TP vs IP & Chiller Plant Optimization',
    category: 'BMS & Automation',
    readTime: '6 min read',
    codeRef: 'ASHRAE Standard 135 (BACnet) / Guideline 36',
    summary: 'Building Management System direct digital controller (DDC) networking, sensor calibration, and high-efficiency chilled water sequence optimization.',
    keyPoints: [
      'BACnet Topology: Use BACnet/IP for supervisory tier and BACnet MS/TP (RS-485 at 38400/76800 baud) for field DDC controllers with 120-ohm end-of-line termination resistors.',
      'Chilled Water Delta-T Optimization: Prevent "Low Delta-T Syndrome" by sequencing secondary pumps on differential pressure and variable flow valves rather than constant flow bypass.',
      'Sensor Calibration Tolerance: Chilled water temperature sensors must be 4-wire PT1000 RTDs calibrated within ±0.1°F (±0.05°C) to prevent false chiller staging.'
    ],
    faultMatrix: [
      { symptom: 'Intermittent token loss on BACnet MS/TP trunk', cause: 'Missing 120-ohm EOL resistor or unshielded cable noise', remedy: 'Verify daisy-chain wiring and install 120-ohm terminating resistor at physical ends' },
      { symptom: 'Chiller plant low delta-T syndrome (Delta T < 6°F)', cause: '3-way bypass valves open or oversized AHU cooling coils', remedy: 'Switch AHU valves to 2-way modulating pressure-independent (PICV)' },
      { symptom: 'VAV box hunting and airflow oscillation', cause: 'Dirty pitot tube airflow sensor or PID loop integral gain too high', remedy: 'Clean differential pressure pickup and re-tune PID loop (reduce Ki)' }
    ]
  },
  {
    id: 'kb-dg-1',
    discipline: 'dg',
    title: 'Diesel Generator (DG Set) Synchronizing, AMF Logic & Wet Stacking',
    category: 'DG Sets & Backup',
    readTime: '6 min read',
    codeRef: 'NFPA 110 (Level 1 Emergency Systems) / ISO 8528',
    summary: 'Emergency power infrastructure, Auto Mains Failure (AMF) changeover sequences, load sharing, and engine unburned fuel mitigation.',
    keyPoints: [
      'Wet Stacking Prevention: Operating diesel generators below 30-40% rated load causes unburned fuel accumulation in turbocharger and exhaust manifold. Schedule annual 2-hour 100% resistive load bank tests.',
      'AMF Changeover Time (NFPA 110 Type 10): Emergency life-safety generators must start, reach 1500/1800 RPM rated speed, stabilize voltage within ±1%, and transfer load via ATS within 10 seconds.',
      'Auto-Synchronizing & Isochronous Load Sharing: Digital engine governors (DEIF / ComAp / Woodward) equalize kW and kVAR distribution across multiple paralleled DG sets.'
    ],
    faultMatrix: [
      { symptom: 'DG engine cranks but fails to fire during power outage', cause: 'Air in fuel line or fuel shutoff solenoid stuck', remedy: 'Prime fuel system using hand pump and inspect 24V DC fuel solenoid' },
      { symptom: 'Oily black residue leaking from exhaust manifold', cause: 'Wet stacking caused by prolonged low-load (< 30%) operation', remedy: 'Connect portable load bank and run at 80-100% capacity for 2 hours' },
      { symptom: 'Voltage hunting during paralleling', cause: 'AVR droop potentiometer misaligned or cross-current CT reversed', remedy: 'Check AVR quadrature droop setting and ensure CT polarity (S1-S2) matches' }
    ]
  },
  {
    id: 'kb-pumps-1',
    discipline: 'pumps',
    title: 'Centrifugal Pump Affinity Laws, NPSHa vs NPSHr & Cavitation',
    category: 'Pumps & Hydro Systems',
    readTime: '5 min read',
    codeRef: 'Hydraulic Institute (HI) Standards / ISO 9906',
    summary: 'Pump curve interpretation, Net Positive Suction Head calculations to prevent destructive impeller cavitation and mechanical seal burnout.',
    keyPoints: [
      'Cavitation Mechanics: Occurs when liquid static pressure at the impeller eye drops below vapor pressure (P_vap), causing vapor bubbles to form and violently collapse (creating localized micro-jets > 100,000 PSI).',
      'NPSH Margin Rule: NPSH Available (NPSHa) must exceed NPSH Required (NPSHr) by at least 1.5 meters (5 feet) or a 1.2 safety ratio across all operating flow points.',
      'Affinity Laws: Flow Q proportional to Speed N (Q2/Q1 = N2/N1), Head H proportional to N^2, Power P proportional to N^3 (VFD speed reduction of 20% yields 50% electrical power savings).'
    ],
    faultMatrix: [
      { symptom: 'Rattling sound like pumping gravel / marble stones', cause: 'Classical suction cavitation (NPSHa < NPSHr)', remedy: 'Clean suction strainer, open suction valve fully, or raise water level in suction sump' },
      { symptom: 'Mechanical seal leaking continuously', cause: 'Dry run, misalignment, or thermal shock', remedy: 'Replace mechanical seal faces (Silicon Carbide) and align pump-motor shafts within 0.05mm' },
      { symptom: 'Motor drawing excessive current (overload trip)', cause: 'Pump operating too far to the right of its design curve (low head, excess flow)', remedy: 'Throttle discharge balancing valve slightly or trim impeller diameter' }
    ]
  },
  {
    id: 'kb-fire-1',
    discipline: 'fire',
    title: 'NFPA 13 Hydraulic Calculations, Fire Pump Testing & Standpipes',
    category: 'Fire & Life Safety',
    readTime: '7 min read',
    codeRef: 'NFPA 13 (Sprinklers) / NFPA 20 (Pumps) / NFPA 25 (ITM)',
    summary: 'Life-safety hydraulic design, density-area curves, fire pump annual churn/flow testing, and wet/dry standpipe systems.',
    keyPoints: [
      'Sprinkler Water Demand: Q_total = (Design Density * Remote Area) + Inside/Outside Hose Stream Allowance (e.g. Ordinary Hazard Group 2 = 0.20 GPM/sq.ft * 1500 sq.ft = 300 GPM + 250 GPM hose = 550 GPM).',
      'Annual Fire Pump Testing (NFPA 25): Pump must deliver 100% rated flow at >= 100% rated pressure, and 150% rated flow at >= 65% rated pressure. Churn (zero flow) pressure must not exceed 140% of rated head.',
      'Hazen-Williams Friction Sizing: Friction loss p = 4.52 * Q^1.85 / (C^1.85 * d^4.87) with C=120 for black steel and C=150 for CPVC.'
    ],
    faultMatrix: [
      { symptom: 'Jockey pump starting every 15 minutes', cause: 'Underground hydrant line leak or leaking check valve', remedy: 'Perform hydrostatic pressure test to isolate leaking pipe section or replace check valve seat' },
      { symptom: 'Main fire pump fails to produce 150% rated flow during test', cause: 'Suction vortex plate missing or clogged suction OS&Y valve', remedy: 'Inspect suction sump vortex breaker and verify OS&Y valve is 100% open and locked' },
      { symptom: 'Water flow switch false alarm on pressure surge', cause: 'Air trapped in wet pipe sprinkler branch lines', remedy: 'Install automatic air release vent at highest point of sprinkler riser' }
    ]
  },
  {
    id: 'kb-hotel-1',
    discipline: 'hotel',
    title: 'Hotel Guestroom MEP, Commercial Kitchen Ecology Units & Steam Boilers',
    category: 'Hotel & Commercial MEP',
    readTime: '6 min read',
    codeRef: 'ASHRAE Hospitality Applications / NFPA 96 / CIBSE Guide B',
    summary: 'Specialized MEP engineering for 5-star hotels, kitchen exhaust ecology units, grease traps, laundry steam boilers, and guest acoustic comfort.',
    keyPoints: [
      'Guestroom Acoustic NC Criteria: Fan Coil Unit (FCU) noise must not exceed NC-30 in bedrooms. Use low-static backward curved plug fans with acoustic flexible ducting and ducted return.',
      'Commercial Kitchen Exhaust (NFPA 96): Maintain duct capture velocity between 1,500 - 2,200 FPM (7.6 - 11.2 m/s) with ecology units combining ESP (Electrostatic Precipitator), UV-C ozone, and activated carbon filters.',
      'Domestic Hot Water (DHW) Legionella Control: Maintain central calorifier storage at >= 140°F (60°C) and circulation loop return at >= 122°F (50°C) to prevent Legionella pneumophila growth.'
    ],
    faultMatrix: [
      { symptom: 'Guest complaints of cold water during 7 AM peak shower demand', cause: 'DHW circulation balancing valves out of tune or calorifier coil scaled', remedy: 'Rebalance thermostatic return valves and descale heat exchanger bundle' },
      { symptom: 'Kitchen exhaust smoke leaking into adjacent restaurant lobby', cause: 'Kitchen negative pressure lost or ecology unit ESP filters saturated', remedy: 'Wash ESP collector plates and adjust make-up air unit (MAU) to maintain -15 Pa negative pressure' },
      { symptom: 'FCU condensation overflow damaging ceiling plaster', cause: 'Condensate drain trap lost water seal or algae blockage in 32mm drain', remedy: 'Flush drain line with nitrogen, treat with biocide tablet, and check P-trap depth (> 50mm)' }
    ]
  }
];
