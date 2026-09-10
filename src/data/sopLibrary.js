export const sopLibrary = [
  {
    id: 'sop-hvac-01',
    code: 'SOP-HVAC-01',
    title: 'Centrifugal Chiller Plant Normal Start & Stop Procedure',
    category: 'HVAC & Chilled Water',
    discipline: 'hvac',
    version: 'v2.4',
    effectiveDate: 'Jan 2026',
    author: 'Er. Rajesh Sharma (AI HVAC Expert)',
    purpose: 'Standard operating procedure for the safe sequential start-up, operational monitoring, and shutdown of water-cooled centrifugal chiller plants.',
    ppe: ['Safety Shoes', 'Safety Glasses / Face Shield', 'Hearing Protection (Ear Muffs)', 'Nitride Gloves'],
    hazards: ['High pressure refrigerant R-134a / R-1234ze', 'Rotating compressor impellers & fan blades', '415V/3.3kV High voltage starter panels', 'Water hammer risk'],
    prerequisites: [
      'Confirm chiller oil sump heater has been energized for >= 8 hours (Oil temp > 120°F / 49°C)',
      'Inspect cooling tower basin water level and ensure makeup float valve is operational',
      'Verify all manual butterfly isolation valves on condenser and chilled water headers are open',
      'Inspect BMS communication and ensure delta-P sensors read baseline 0.0 bar'
    ],
    steps: [
      { stepNumber: 1, title: 'Energize Cooling Tower & Condenser Water Circuit', description: 'Start the cooling tower fan on VFD low speed (20 Hz). Start the designated condenser water pump (CWP). Verify condenser water flow switch proves on BMS within 15 seconds.' },
      { stepNumber: 2, title: 'Energize Primary / Secondary Chilled Water Pumps', description: 'Start primary chilled water pump (PCHWP). Open motorized isolation valve on the active chiller evaporator barrel. Confirm differential pressure across evaporator barrel is between 0.3 - 0.6 bar (4.5 - 9 PSI).' },
      { stepNumber: 3, title: 'Initiate Chiller Microprocessor Start Command', description: 'Switch chiller control panel from LOCAL OFF to AUTO / REMOTE START. The unit will initiate lubrication pre-lube cycle for 60 seconds (Oil pressure >= 25 PSI above suction).' },
      { stepNumber: 4, title: 'Monitor Compressor Acceleration & Soft-Start', description: 'Observe motor starter ramp up (Star-Delta or VFD). Verify running current stabilizes below Full Load Amps (FLA). Confirm guide vanes modulate slowly from minimum position.' },
      { stepNumber: 5, title: 'Verify Steady-State Operating Parameters', description: 'After 15 minutes of operation, log parameters: Chilled Water Leaving (44°F / 6.7°C), Condenser Entering (85°F / 29.4°C), Approach Temperature (< 2.0°F), Oil Temp (130-145°F), Motor Amps.' },
      { stepNumber: 6, title: 'Chiller Normal Shutdown Sequence', description: 'Select NORMAL STOP on panel. Microprocessor unloads guide vanes to 0%, opens recycle bypass, trips main compressor motor, runs post-lube oil pump for 180 seconds, and shuts down chilled/condenser water pumps after 5 minutes.' }
    ]
  },
  {
    id: 'sop-elec-01',
    code: 'SOP-ELEC-01',
    title: '11kV / 415V Substation Transformer Cold Energization Procedure',
    category: 'Electrical & Power',
    discipline: 'electrical',
    version: 'v3.1',
    effectiveDate: 'Jan 2026',
    author: 'Dr. Vikram Malhotra (AI Electrical Expert)',
    purpose: 'Step-by-step safety standard for switching, cold energization, and phase synchronization of 11kV oil-immersed & dry-type power transformers.',
    ppe: ['Arc Flash Suit Category 4 (40 cal/cm²)', '11kV Insulated Rubber Gloves (Class 2)', 'Full Face Shield', 'Safety Helmet with Flash Protection'],
    hazards: ['11,000V Lethal Electric Shock & Arc Flash Hazard', 'Transformer inrush explosion risk', 'Residual capacitive charge in HT cables'],
    prerequisites: [
      'Ensure Work Permit & LOTO Certificate is signed by Chief Electrical Engineer',
      'Test transformer insulation resistance (IR) using 2.5kV Megger: HV-LV > 1000 MΩ, HV-Earth > 1000 MΩ, LV-Earth > 100 MΩ',
      'Verify oil level in conservator tank and check silica gel is deep blue (pink indicates moisture saturation)',
      'Confirm 87T differential, 50/51 overcurrent, and 51N earth fault relay settings are calibrated and enabled'
    ],
    steps: [
      { stepNumber: 1, title: 'Clear Work Area & Remove Safety Earthing', description: 'Ensure all personnel have exited the HT switchgear room. Remove portable discharge grounding leads from 11kV bus terminals. Close and lock transformer bay mesh doors.' },
      { stepNumber: 2, title: 'Verify LV Air Circuit Breaker (ACB) is Racked Out / Open', description: 'Ensure the secondary 415V Main Incomer ACB is in the OPEN / ISOLATED position. Transformer must NEVER be energized with secondary load connected.' },
      { stepNumber: 3, title: 'Charge Vacuum Circuit Breaker (VCB) Spring Mechanism', description: 'On the 11kV HT switchgear panel, charge the VCB closing spring (either via motor or manual charging handle). Confirm "SPRING CHARGED" optical indicator is GREEN.' },
      { stepNumber: 4, title: 'Close 11kV VCB Breaker (Cold Energization)', description: 'Stand clear outside the arc flash boundary zone. Press the VCB CLOSE pushbutton. Listen for smooth transformer core hum without metallic rattling or arcing sounds.' },
      { stepNumber: 5, title: 'Check Secondary Voltage & Phase Sequence', description: 'At the LV incomer voltmeter, check 3-phase line-to-line voltages (415V ± 2%) and line-to-neutral (240V ± 2%). Confirm phase rotation indicator is clockwise (R-Y-B).' },
      { stepNumber: 6, title: 'Close LV Incomer & Synchronize Load', description: 'Close the 415V Main Incomer ACB. Sequentially energize downstream motor control centers (MCC) and sub-distribution boards while monitoring phase load balance.' }
    ]
  },
  {
    id: 'sop-dg-01',
    code: 'SOP-DG-01',
    title: 'Diesel Generator (DG Set) Weekly Auto Mains Failure (AMF) Run Test',
    category: 'DG Sets & Backup',
    discipline: 'dg',
    version: 'v2.0',
    effectiveDate: 'Jan 2026',
    author: 'Dr. Vikram Malhotra (AI Electrical Expert)',
    purpose: 'Standard weekly inspection and on-load testing of emergency diesel generators to guarantee compliance with NFPA 110 Level 1 emergency power standards.',
    ppe: ['Hearing Protection (Ear Plugs / Muffs)', 'Safety Glasses', 'High-Grip Oil-Resistant Gloves', 'Safety Shoes'],
    hazards: ['Hot exhaust manifold (> 500°C)', 'High pressure diesel fuel injection leaks (2000+ bar)', 'Automatic remote starting without warning'],
    prerequisites: [
      'Check engine oil dipstick level (between MIN and MAX marks)',
      'Inspect day tank diesel fuel level (minimum 80% full, >= 8 hours runtime)',
      'Measure 24V starter battery bank terminal voltage (> 25.4V DC float charge)',
      'Verify engine coolant level in expansion radiator tank and check jacket water heater is hot to touch (> 40°C)'
    ],
    steps: [
      { stepNumber: 1, title: 'Perform Pre-Start Physical Walkaround', description: 'Check for any oil, water, or diesel fuel leaks beneath engine bed. Ensure intake louvers are unobstructed and exhaust flap is free to open.' },
      { stepNumber: 2, title: 'Initiate Manual Test Run (No-Load Mode)', description: 'Turn selector switch on Deep Sea / ComAp controller to MANUAL and press START. Engine must crank, fire, and reach 1500 RPM (50 Hz) or 1800 RPM (60 Hz) within 6 seconds.' },
      { stepNumber: 3, title: 'Verify Alternator Voltage & Lube Oil Pressure', description: 'Confirm generated voltage stabilizes at 415V ± 1%. Confirm lube oil pressure builds rapidly to 4.5 - 6.0 bar (65 - 85 PSI).' },
      { stepNumber: 4, title: 'Simulate Grid Power Failure (On-Load AMF Test)', description: 'During scheduled maintenance window: Open mains incomer breaker. Confirm ATS transfers essential emergency load to DG within 10 seconds. Run under load for minimum 30 minutes.' },
      { stepNumber: 5, title: 'Restore Grid & Cool-Down Sequence', description: 'Re-close mains utility power. Confirm ATS transfers load back to grid seamlessly. Allow DG engine to idle at no-load for 5 minutes cool-down before automatic shutdown.' },
      { stepNumber: 6, title: 'Return Controller to AUTO Ready Mode', description: 'Set mode selector switch back to "AUTO". Log run hours, fuel consumption, battery voltage, and oil pressure in DG Plant Log Book.' }
    ]
  },
  {
    id: 'sop-fire-01',
    code: 'SOP-FIRE-01',
    title: 'Weekly Fire Pump Churn & Automatic Pressure Switch Cut-In Test',
    category: 'Fire & Life Safety',
    discipline: 'fire',
    version: 'v3.0',
    effectiveDate: 'Jan 2026',
    author: 'Er. Ananya Verma (AI Fire Safety Expert)',
    purpose: 'Executing NFPA 25 weekly inspection, testing, and maintenance (ITM) protocol for main electric, diesel backup, and jockey fire pumps.',
    ppe: ['Safety Shoes', 'Safety Glasses', 'Protective Gloves', 'Reflective High-Vis Vest'],
    hazards: ['High pressure water spray (> 150 PSI)', 'Automatic starting of heavy 150kW electric motors and diesel engines'],
    prerequisites: [
      'Notify central building security and BMS monitoring room of fire test in progress',
      'Inspect fire water storage tank level and confirm suction OS&Y gate valves are locked in fully OPEN position',
      'Verify jockey pump system maintains ring main static pressure at 10.5 bar (150 PSI)'
    ],
    steps: [
      { stepNumber: 1, title: 'Inspect Fire Pump Controller Alarm Lights', description: 'Confirm controller has Green "Power On" indicator illuminated, no Phase Failure / Reverse Phase alarms, and selector switch is in "AUTO".' },
      { stepNumber: 2, title: 'Test Jockey Pump Automatic Cut-In & Cut-Out', description: 'Slowly open test drain valve on sensing line. Jockey pump must start automatically when pressure drops to 9.5 bar (138 PSI) and stop when pressure reaches 10.5 bar (152 PSI).' },
      { stepNumber: 3, title: 'Test Main Electric Fire Pump Cut-In (Weekly Churn)', description: 'Simulate severe pressure drop below 8.0 bar (116 PSI). Main electric pump must start instantly. Run pump at churn (zero flow) for 10 minutes. Check casing relief valve is discharging small stream of cooling water.' },
      { stepNumber: 4, title: 'Inspect Packing Glands & Motor Bearing Temperatures', description: 'Verify gland packing drips 30-60 drops per minute for seal lubrication. Measure motor bearing temperature (< 75°C).' },
      { stepNumber: 5, title: 'Test Standby Diesel Engine Fire Pump Automatic Start', description: 'Isolate electric pump and drop pressure to 7.0 bar (101 PSI). Diesel fire pump controller must crank, start engine, and reach 1750/2100 RPM within 10 seconds. Run for 30 minutes per NFPA 25.' },
      { stepNumber: 6, title: 'System Reset & Log Entry', description: 'Close all test valves, restore system pressure to 10.5 bar, verify all controllers return to AUTO, and sign NFPA 25 Inspection Log Sheet.' }
    ]
  },
  {
    id: 'sop-plumb-01',
    code: 'SOP-PLUMB-01',
    title: 'Hydro-Pneumatic Booster Pump Pressure Vessel Bladder Servicing',
    category: 'Plumbing & Drainage',
    discipline: 'plumbing',
    version: 'v2.1',
    effectiveDate: 'Jan 2026',
    author: 'Er. Amit Patel (AI Plumbing Expert)',
    purpose: 'Standard procedure for isolating, draining, and recharging the nitrogen/air pre-charge in hydro-pneumatic pressure vessels.',
    ppe: ['Safety Glasses', 'Leather Work Gloves', 'Safety Shoes'],
    hazards: ['Pressurized pneumatic gas vessel', 'Flooding hazard during drainage'],
    prerequisites: [
      'Digital tire/vessel pressure gauge (0 - 150 PSI)',
      'Portable oil-free nitrogen / air compressor cylinder with regulator hose',
      'Confirm duty booster pumps are placed in temporary manual mode'
    ],
    steps: [
      { stepNumber: 1, title: 'Isolate Vessel from Water Header', description: 'Close the 2-inch isolation ball valve between the hydro-pneumatic tank and the main domestic water booster discharge header.' },
      { stepNumber: 2, title: 'Drain Water Completely from Vessel', description: 'Open the tank bottom drain valve into plant drain channel until water flow ceases completely. (Note: Pre-charge MUST be measured with ZERO water pressure in vessel).' },
      { stepNumber: 3, title: 'Measure Nitrogen Pre-Charge Pressure', description: 'Remove top protective cap from Schrader charging valve. Connect digital pressure gauge. Normal pre-charge must equal: System Cut-In Pressure minus 0.2 bar (3 PSI).' },
      { stepNumber: 4, title: 'Recharge / Adjust Vessel Pre-Charge', description: 'If reading is low, connect nitrogen cylinder and pressurize bladder to calculated setpoint. If water ejects from air valve, the rubber bladder is ruptured and must be replaced.' },
      { stepNumber: 5, title: 'Soap Bubble Leak Test', description: 'Apply soapy water solution over the Schrader valve core to verify zero gas leakage. Re-install brass sealing cap tightly.' },
      { stepNumber: 6, title: 'Re-commission Vessel to Service', description: 'Close drain valve. Slowly open water header isolation valve. Switch booster pumps back to VFD Auto mode and verify smooth pressure stabilization.' }
    ]
  },
  {
    id: 'sop-hotel-01',
    code: 'SOP-HOTEL-01',
    title: 'Commercial Kitchen Exhaust Hood & Wet Chemical (UL 300) Inspection',
    category: 'Hotel & Commercial MEP',
    discipline: 'hotel',
    version: 'v2.0',
    effectiveDate: 'Jan 2026',
    author: 'Er. Ananya Verma (AI Fire Safety Expert)',
    purpose: 'Monthly inspection of hotel/commercial kitchen grease filters, exhaust ducts, and automatic Ansul R-102 wet chemical fire suppression systems per NFPA 96 & NFPA 17A.',
    ppe: ['Safety Glasses', 'Cut-Resistant Gloves', 'Safety Shoes', 'Non-Slip Kitchen Overshoes'],
    hazards: ['Grease accumulation fire hazard', 'Accidental discharge of wet chemical agent onto cooking appliances'],
    prerequisites: [
      'Notify Executive Chef and Kitchen Stewarding team of maintenance window',
      'Inspect kitchen exhaust fan VFD operation and ensure ecology unit ESP power pack is energized',
      'Verify manual pull station glass cover is intact and pull pin is wire-sealed'
    ],
    steps: [
      { stepNumber: 1, title: 'Inspect Stainless Steel Baffle Grease Filters', description: 'Ensure all baffle grease filters are seated tightly at 45-degree angle without gaps. Confirm filters are clean and free of hardened grease encrustation.' },
      { stepNumber: 2, title: 'Inspect Wet Chemical Agent Cylinder Pressure', description: 'Check pressure gauge on Ansul/Amerex R-102 chemical cylinder. Pointer must be within the GREEN operating zone (100-110 PSI).' },
      { stepNumber: 3, title: 'Inspect Fusible Link Detection Line', description: 'Inspect stainless steel cable detection line running inside exhaust canopy. Ensure fusible links (360°F / 450°F) are clean and free of grease binding.' },
      { stepNumber: 4, title: 'Check Discharge Nozzle Foil Caps & Alignment', description: 'Verify all nozzle rubber/foil blow-off caps are in place over fryers, ranges, and griddles. Ensure nozzles aim directly at cooking surfaces.' },
      { stepNumber: 5, title: 'Verify Gas Shut-Off Valve Mechanical Interlock', description: 'Confirm that mechanical microswitch interlock between fire suppression system and main kitchen gas solenoid valve is armed and operational.' },
      { stepNumber: 6, title: 'Sign Off Monthly Kitchen Life Safety Certificate', description: 'Record inspection in Hotel Engineering Compliance binder and attach signed sticker to kitchen hood panel.' }
    ]
  }
];
