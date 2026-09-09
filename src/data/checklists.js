export const checklistTemplates = [
  {
    id: 'chk-chiller-daily',
    title: 'Daily Central Chiller Plant Room Log & Inspection',
    category: 'HVAC & Chilled Water',
    discipline: 'hvac',
    frequency: 'Daily (Every Shift)',
    estimatedTime: '20 mins',
    items: [
      { id: 'c1', text: 'Log Chilled Water Entering & Leaving Temperatures (Design: 54°F / 44°F)', priority: 'High', status: false },
      { id: 'c2', text: 'Log Condenser Water Entering & Leaving Temperatures (Design: 85°F / 95°F)', priority: 'High', status: false },
      { id: 'c3', text: 'Calculate Condenser Approach Temperature (Must be < 2.0°F / 1.1°C)', priority: 'Critical', status: false },
      { id: 'c4', text: 'Check Compressor Lube Oil Pressure (> 25 PSI differential over suction)', priority: 'Critical', status: false },
      { id: 'c5', text: 'Inspect Oil Sump Level in Sight Glass (Between 1/2 and 3/4 glass)', priority: 'High', status: false },
      { id: 'c6', text: 'Log Motor Running Current (Amps) and % RLA (Rated Load Amps)', priority: 'Medium', status: false },
      { id: 'c7', text: 'Check Cooling Tower Basin Water Level, Makeup Float & Bleed Valve', priority: 'High', status: false },
      { id: 'c8', text: 'Inspect Primary/Secondary Chilled Water Pump Glands & Vibration', priority: 'Medium', status: false },
      { id: 'c9', text: 'Verify Automatic Chemical Dosing Pump Operation & Biocide Tank Level', priority: 'High', status: false },
      { id: 'c10', text: 'Check Plant Room Floor for Refrigerant, Oil, or Water Leaks', priority: 'Medium', status: false }
    ]
  },
  {
    id: 'chk-dg-weekly',
    title: 'Weekly Diesel Generator (DG Set) & AMF Panel Audit',
    category: 'DG Sets & Backup',
    discipline: 'dg',
    frequency: 'Weekly',
    estimatedTime: '25 mins',
    items: [
      { id: 'd1', text: 'Inspect 24V Starter Battery Bank Voltage (Float: > 25.4V DC) & Specific Gravity', priority: 'Critical', status: false },
      { id: 'd2', text: 'Check Engine Lube Oil Level (Dipstick between MIN & MAX marks)', priority: 'Critical', status: false },
      { id: 'd3', text: 'Verify Radiator Coolant Level & Check Jacket Water Heater is Warm (> 40°C)', priority: 'High', status: false },
      { id: 'd4', text: 'Check Day Fuel Tank Level (> 80% capacity) & Drain Water Separator', priority: 'High', status: false },
      { id: 'd5', text: 'Perform 15-Minute Manual Run Test: Check Frequency (50/60 Hz) & Voltage (415V)', priority: 'Critical', status: false },
      { id: 'd6', text: 'Verify Lube Oil Pressure builds to 4.5 - 6.0 bar during operation', priority: 'Critical', status: false },
      { id: 'd7', text: 'Inspect Exhaust Smoke Color (Clear / Light Grey; No Heavy Black or Blue Smoke)', priority: 'Medium', status: false },
      { id: 'd8', text: 'Verify Motorized Fresh Air Intake Louvers open fully upon engine start', priority: 'High', status: false },
      { id: 'd9', text: 'Check AMF Controller Selector Switch is returned to "AUTO" Mode', priority: 'Critical', status: false }
    ]
  },
  {
    id: 'chk-elec-monthly',
    title: 'Monthly HT/LT Substation & Switchgear Inspection',
    category: 'Electrical & Power',
    discipline: 'electrical',
    frequency: 'Monthly',
    estimatedTime: '35 mins',
    items: [
      { id: 'e1', text: 'Inspect 11kV VCB / SF6 Pressure Gauge and Spring Charging Mechanism', priority: 'Critical', status: false },
      { id: 'e2', text: 'Check Transformer Oil Level, Winding Temp Indicator (WTI) & Oil Temp Indicator (OTI)', priority: 'Critical', status: false },
      { id: 'e3', text: 'Inspect Silica Gel Breather Color (Deep Blue; Replace if Pink / White)', priority: 'High', status: false },
      { id: 'e4', text: 'Check Main Incomer ACB Tripping Battery Charger & 110V DC Tripping Voltage', priority: 'Critical', status: false },
      { id: 'e5', text: 'Perform Infrared Thermography on Main Busbar Joints & Cable Terminations (< 70°C)', priority: 'High', status: false },
      { id: 'e6', text: 'Inspect Automatic Power Factor Correction (APFC) Panel (Maintain PF > 0.98)', priority: 'High', status: false },
      { id: 'e7', text: 'Test Substation Earth Pit Resistances (< 1.0 Ohm) & Earth Continuity', priority: 'Critical', status: false },
      { id: 'e8', text: 'Check Rubber Insulation Mats in front of all HT/LT Panels (IS 15652 / IEC 61111)', priority: 'Medium', status: false }
    ]
  },
  {
    id: 'chk-fire-weekly',
    title: 'Weekly Fire Sprinkler, Hydrant & Fire Pump Audit (NFPA 25)',
    category: 'Fire & Life Safety',
    discipline: 'fire',
    frequency: 'Weekly',
    estimatedTime: '30 mins',
    items: [
      { id: 'f1', text: 'Inspect Fire Water Reservoir Tank Water Level (100% Full)', priority: 'Critical', status: false },
      { id: 'f2', text: 'Confirm all Suction and Discharge OS&Y Gate Valves are OPEN and Padlocked/Chained', priority: 'Critical', status: false },
      { id: 'f3', text: 'Verify Jockey Pump Maintains Ring Main Static Pressure at 10.5 bar (150 PSI)', priority: 'High', status: false },
      { id: 'f4', text: 'Execute 10-Minute Weekly Churn Run Test on Main Electric Fire Pump', priority: 'Critical', status: false },
      { id: 'f5', text: 'Execute 30-Minute Weekly Run Test on Diesel Engine Fire Pump (NFPA 25 § 8.3.1)', priority: 'Critical', status: false },
      { id: 'f6', text: 'Inspect Fire Pump Casing Relief Valves (Discharging cooling water stream during churn)', priority: 'High', status: false },
      { id: 'f7', text: 'Check Gland Packing Drips (30-60 drops/min for packing lubrication & cooling)', priority: 'Medium', status: false },
      { id: 'f8', text: 'Confirm Central Fire Alarm Panel (FACP) shows Zero System Faults or Disabled Zones', priority: 'Critical', status: false }
    ]
  },
  {
    id: 'chk-plumb-monsoon',
    title: 'Pre-Monsoon Basement Sump Pump & Stormwater Drain Audit',
    category: 'Plumbing & Drainage',
    discipline: 'plumbing',
    frequency: 'Seasonal / Quarterly',
    estimatedTime: '30 mins',
    items: [
      { id: 'p1', text: 'Test Dual Submersible Dewatering Sump Pumps on Float Switch Auto-Alternation', priority: 'Critical', status: false },
      { id: 'p2', text: 'Clean Catch Basins, Sump Pits & Remove Silt, Gravel and Debris', priority: 'High', status: false },
      { id: 'p3', text: 'Inspect Sump Pump Non-Return (Check) Valves to prevent backflow into basement', priority: 'High', status: false },
      { id: 'p4', text: 'Verify High Water Level Alarm Floats trigger Audible/Visual alarm in BMS control room', priority: 'Critical', status: false },
      { id: 'p5', text: 'Confirm Submersible Pumps are connected to Emergency DG Backup Power Supply', priority: 'Critical', status: false },
      { id: 'p6', text: 'Inspect External Stormwater Perimeter French Drains and Clean Gratings', priority: 'Medium', status: false }
    ]
  },
  {
    id: 'chk-hotel-guestroom',
    title: 'Hotel Guestroom MEP 50-Point Room Preventive Maintenance (RPM)',
    category: 'Hotel & Commercial MEP',
    discipline: 'hotel',
    frequency: 'Bi-Monthly per Room',
    estimatedTime: '25 mins',
    items: [
      { id: 'hr1', text: 'Clean FCU Air Filter & Vacuum Evaporator Coil Fins', priority: 'High', status: false },
      { id: 'hr2', text: 'Pour 500ml Water with Biocide into FCU Drain Pan to verify zero overflow & deep P-trap', priority: 'Critical', status: false },
      { id: 'hr3', text: 'Measure Guestroom Thermostat Delta-T (Supply Air < 14°C / 57°F within 10 minutes)', priority: 'High', status: false },
      { id: 'hr4', text: 'Inspect Bathroom Shower Water Pressure & Hot Water Temperature (48°C - 52°C)', priority: 'High', status: false },
      { id: 'hr5', text: 'Check WC Flush Valve Cistern fill time (< 45s) & inspect for silent flapper valve leaks', priority: 'Medium', status: false },
      { id: 'hr6', text: 'Inspect Electrical Keycard Switch, Master Light Automation & RCD / GFCI Breaker', priority: 'Critical', status: false },
      { id: 'hr7', text: 'Test Room Smoke Detector Green LED & Verify Sprinkler Head Concealer Plate is Level', priority: 'Critical', status: false }
    ]
  }
];
