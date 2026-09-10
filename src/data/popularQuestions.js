export const popularQuestions = [
  {
    id: 'hvac-1',
    category: 'HVAC',
    badgeColor: 'bg-sky-50 text-sky-700 border-sky-200',
    title: 'Centrifugal Chiller Condenser High Approach Temperature & Surging',
    excerpt: 'Our 500 TR centrifugal chiller has a condenser approach temperature exceeding 6.5°F (normal < 2.0°F) and begins surging under 85% load. What is the root cause and diagnostic step?',
    image: '/images/hvac_chiller_plant.jpg',
    fallbackIcon: 'Wind',
    facultyName: 'Eng. David Sterling, PE, LEED AP',
    assignedFacultyId: 'eng-david-sterling',
    answerPoints: [
      'Diagnostic Indicator: Condenser Approach Temp = Condenser Refrigerant Saturation Temp - Condenser Water Leaving Temp. A 6.5°F approach indicates significant tube fouling/scaling or non-condensable gas trapping.',
      'Root Cause of Surging: High condenser pressure forces the compressor operating point above the surge line on the aerodynamic pressure-lift curve, causing refrigerant backflow and aerodynamic stall.',
      'Governing Heat Transfer Formula: Q = U * A * LMTD. Calcium carbonate scale reduces overall heat transfer coefficient (U) by 40-60%.',
      'Point-to-Point Remediation: (1) Run automatic purge unit to evacuate air/non-condensables, (2) Inspect cooling tower water TDS and biocide dosing, (3) Perform mechanical nylon-brush tube punching during planned shutdown.'
    ]
  },
  {
    id: 'plumbing-1',
    category: 'Plumbing',
    badgeColor: 'bg-blue-50 text-blue-700 border-blue-200',
    title: 'High-Rise Riser Water Hammer & Pressure Reducing Valve (PRV) Sizing',
    excerpt: 'In a 28-story residential tower, violent water hammer and pipe rattling occur whenever solenoid flush valves shut. How do we size water hammer arrestors and staging PRV stations?',
    image: '/images/plumbing_booster_pumps.jpg',
    fallbackIcon: 'Droplets',
    facultyName: 'Eng. Robert Vance, CPD, PE',
    assignedFacultyId: 'eng-robert-vance',
    answerPoints: [
      'Joukowsky Shock Pressure Equation: Delta P = rho * c * Delta v. Sudden valve closure converts fluid kinetic energy into acoustic pressure wave spikes exceeding 300+ PSI.',
      'PRV Staging Requirement (IPC § 604.8): Static pressure on fixtures must not exceed 80 PSI. Divide the 28-story building into 3 vertical pressure zones (Low: L1-L10, Mid: L11-L20, High: L21-L28) with redundant dual-PRV bypass stations.',
      'Water Hammer Arrestor Sizing (PDI-WH 201): Install PDI certified Size C/D stainless steel bellows arrestors within 6 feet of the solenoid valve headers.',
      'Maintenance Action: Check PRV pilot diaphragm condition and inspect expansion vessel nitrogen pre-charge pressure (must be 0.2 bar below cut-in pressure).',
    ]
  },
  {
    id: 'elec-1',
    category: 'Electrical',
    badgeColor: 'bg-amber-50 text-amber-700 border-amber-200',
    title: 'Transformer Differential Protection (87T) Tripping on Inrush Current',
    excerpt: 'A 2000 kVA 11kV/415V dry-type transformer trips on 87T differential protection during no-load energization from the grid. How do we configure harmonic restraint?',
    image: '/images/electrical_substation_room.jpg',
    fallbackIcon: 'Zap',
    facultyName: 'Eng. Marcus Lin, PE, IEEE',
    assignedFacultyId: 'eng-marcus-lin',
    answerPoints: [
      'Magnetizing Inrush Phenomenon: High residual core flux causes core saturation upon energization, generating unipolar inrush currents up to 8-12x Full Load Amps (FLA) on the primary side without secondary current.',
      '2nd Harmonic Restraint Protocol (IEEE C37.91): Magnetizing inrush current contains high 2nd harmonic content (typically > 15-20% of fundamental). Differential relay must be set to 15% 2nd harmonic blocking.',
      'CT Ratio & Vector Group Phase Shift: Verify numerical relay CT compensation matches transformer vector group Dyn11 (30° phase shift compensation).',
      'Verification Steps: (1) Review relay waveform event oscillography to confirm 2nd harmonic ratio, (2) Confirm differential slope setting (Slope 1 = 20%, Slope 2 = 50-80%).'
    ]
  },
  {
    id: 'fire-1',
    category: 'Fire Fighting',
    badgeColor: 'bg-rose-50 text-rose-700 border-rose-200',
    title: 'NFPA 13 Wet Sprinkler Hydraulic Sizing & Fire Pump Head Calculation',
    excerpt: 'For an industrial warehouse classified under Extra Hazard Group 1, what is the design density, remote area calculation, and required fire pump flow & head?',
    image: '/images/fire_sprinkler_pumps.jpg',
    fallbackIcon: 'Flame',
    facultyName: 'Eng. Sarah Chen, FPE, NFPA',
    assignedFacultyId: 'eng-sarah-chen',
    answerPoints: [
      'NFPA 13 Classification & Density: Extra Hazard Group 1 requires a minimum design density of 0.30 GPM/sq.ft over a hydraulically most demanding remote area of 2,500 sq.ft.',
      'Primary Water Demand Calculation: Q_sprinkler = Density * Area = 0.30 * 2500 = 750 GPM + 500 GPM hose stream allowance (NFPA 13 Table 19.3.3.1.2) = Total 1,250 GPM.',
      'Fire Pump Sizing (NFPA 20): Select a UL/FM certified 1,250 GPM @ 140 PSI main electric fire pump + 100% redundant diesel pump + 10 GPM @ 150 PSI jockey pump.',
      'Hazen-Williams Friction Loss: p = (4.52 * Q^1.85) / (C^1.85 * d^4.87). Verify C=120 for black steel pipe to avoid undersizing remote riser friction heads.'
    ]
  }
];

export default popularQuestions;
