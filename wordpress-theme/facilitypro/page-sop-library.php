<?php
/**
 * Template Name: SOP Library
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();

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

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                <span>Standard Operating Procedures</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                MEP Plant Operational & Safety SOPs
            </h1>
            <p class="mt-2 text-base text-slate-600">
                Interactive step-by-step procedures with mandatory PPE checklists, hazard warnings, and real-time AI guidance for facility engineering teams.
            </p>
        </div>

        <!-- SOP Accordion List -->
        <div class="space-y-6">
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

    </div>
</div>

<?php
get_footer();
