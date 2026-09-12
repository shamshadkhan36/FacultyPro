<?php
/**
 * Template Name: Knowledge Hub
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();

$disciplines = [
    'all' => 'All Engineering Disciplines',
    'hvac' => 'HVAC & Chilled Water',
    'electrical' => 'Electrical & Power',
    'plumbing' => 'Plumbing & Drainage',
    'bms' => 'BMS & Automation',
    'dg' => 'DG Sets & Backup',
    'pumps' => 'Pumps & Hydro Systems',
    'fire' => 'Fire & Life Safety',
    'hotel' => 'Hotel & Commercial MEP'
];

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
            'Surge Mechanism: Occurs when the refrigerant pressure ratio (Condenser Pressure / Evaporator Pressure) exceeds the aerodynamic pressure-lift capacity of the compressor impeller, creating transient flow reversal and violent thrust bearing oscillation.',
            'Condenser Approach Monitoring: Maintain approach temperature (Condenser Saturation Temp - Leaving Condenser Water Temp) < 2.0°F (1.1°C). Any approach > 3.5°F proves condenser tube fouling or air trapping.',
            'Variable Speed Drive (VSD) Anti-Surge Tuning: Ensure VFD low-speed frequency limit is set above the calculated surge envelope frequency at current lift conditions.'
        ]
    ],
    [
        'id' => 'kb-elec-1',
        'discipline' => 'electrical',
        'title' => 'Transformer 87T Differential Relay Harmonic Restraint & Inrush Protection',
        'category' => 'Electrical & Power',
        'readTime' => '7 min read',
        'codeRef' => 'IEEE C37.91 / IEC 60255 / NFPA 70',
        'summary' => 'Preventing nuisance trips during transformer grid energization while preserving high sensitivity for internal turn-to-turn faults.',
        'keyPoints' => [
            'Inrush Magnetizing Current: Upon breaker closure, core residual flux causes saturation, drawing peak inrush currents up to 8-12x Full Load Amps (FLA) with strong unipolar DC offset and 2nd harmonic content.',
            '2nd Harmonic Blocking (15% Threshold): Modern numerical differential relays must be parameterized with 15% 2nd harmonic restraint to differentiate magnetizing inrush from high-current internal short circuits.',
            'Vector Group Compensation: Software CT phase shift matrix must match transformer winding configuration (e.g. Dyn11 requires 30° phase angle compensation).'
        ]
    ],
    [
        'id' => 'kb-plumb-1',
        'discipline' => 'plumbing',
        'title' => 'High-Rise Hydro-Pneumatic Water Supply & Water Hammer Arrestor Design',
        'category' => 'Plumbing & Drainage',
        'readTime' => '5 min read',
        'codeRef' => 'IPC § 604 / ASPE Data Book / PDI-WH 201',
        'summary' => 'Hydraulic principles for vertical pressure zoning, booster pump staging, and water hammer mitigation in multi-story towers.',
        'keyPoints' => [
            'Vertical Pressure Zoning: Fixture static pressure must not exceed 80 PSI (5.5 bar). Buildings over 15 floors require zoning into Low, Mid, and High pressure zones with redundant parallel PRV stations.',
            'Joukowsky Shock Waves: Fast closing solenoid flush valves create shock pressures: Delta P = rho * c * Delta v exceeding 300+ PSI. Install PDI-WH 201 certified stainless steel bellows arrestors.',
            'Hydro-pneumatic Expansion Tank Pre-charge: Maintain nitrogen pre-charge at 0.2 bar (3 PSI) below pump cut-in pressure to prevent bladder rupture.'
        ]
    ],
    [
        'id' => 'kb-bms-1',
        'discipline' => 'bms',
        'title' => 'BMS DDC Architecture, BACnet MS/TP vs IP & Chiller Plant Optimization',
        'category' => 'BMS & Automation',
        'readTime' => '6 min read',
        'codeRef' => 'ASHRAE Standard 135 (BACnet) / Guideline 36',
        'summary' => 'Building Management System direct digital controller (DDC) networking, sensor calibration, and high-efficiency chilled water sequence optimization.',
        'keyPoints' => [
            'BACnet Topology: Use BACnet/IP for supervisory tier and BACnet MS/TP (RS-485 at 38400/76800 baud) for field DDC controllers with 120-ohm end-of-line termination resistors.',
            'Chilled Water Delta-T Optimization: Prevent "Low Delta-T Syndrome" by sequencing secondary pumps on differential pressure and variable flow valves rather than constant flow bypass.',
            'Sensor Calibration Tolerance: Chilled water temperature sensors must be 4-wire PT1000 RTDs calibrated within ±0.1°F (±0.05°C) to prevent false chiller staging.'
        ]
    ],
    [
        'id' => 'kb-dg-1',
        'discipline' => 'dg',
        'title' => 'Diesel Generator (DG Set) Synchronizing, AMF Logic & Wet Stacking',
        'category' => 'DG Sets & Backup',
        'readTime' => '6 min read',
        'codeRef' => 'NFPA 110 (Level 1 Emergency Systems) / ISO 8528',
        'summary' => 'Emergency power infrastructure, Auto Mains Failure (AMF) changeover sequences, load sharing, and engine unburned fuel mitigation.',
        'keyPoints' => [
            'Wet Stacking Prevention: Operating diesel generators below 30-40% rated load causes unburned fuel accumulation in turbocharger and exhaust manifold. Schedule annual 2-hour 100% resistive load bank tests.',
            'AMF Changeover Time (NFPA 110 Type 10): Emergency life-safety generators must start, reach 1500/1800 RPM rated speed, stabilize voltage within ±1%, and transfer load via ATS within 10 seconds.',
            'Auto-Synchronizing & Isochronous Load Sharing: Digital engine governors equalize kW and kVAR distribution across multiple paralleled DG sets.'
        ]
    ],
    [
        'id' => 'kb-fire-1',
        'discipline' => 'fire',
        'title' => 'NFPA 25 Weekly Fire Pump Churn Testing & Hydraulic Characteristic Curves',
        'category' => 'Fire & Life Safety',
        'readTime' => '8 min read',
        'codeRef' => 'NFPA 20 / NFPA 25 / NBC Part 4',
        'summary' => 'Weekly electric & diesel fire pump inspection protocol, casing relief valve settings, and annual flow test curve analysis.',
        'keyPoints' => [
            'Weekly Churn Run Duration: Run electric motor fire pump for 10 minutes; run diesel engine fire pump for 30 minutes minimum (NFPA 25 § 8.3.1).',
            'Casing Relief Valve Discharge: Verify casing relief valve discharges continuous stream of cold water to prevent impeller water boiling and seal breakdown during churn.',
            'Pump Characteristic Curve Limits: At 150% rated flow capacity, pump total head must not degrade below 65% of rated head. Shutoff churn head must not exceed 140% of rated head.'
        ]
    ]
];
?>

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                <i data-lucide="book-open" class="w-4 h-4"></i>
                <span>Engineering Knowledge Hub</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                MEP Plant Engineering Guidelines & Troubleshooting
            </h1>
            <p class="mt-2 text-base text-slate-600">
                In-depth technical guides, fault diagnosis matrices, and code-compliant operating procedures created by AI Licensed Professional Engineers.
            </p>
        </div>

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
</div>

<script>
function filterKbDiscipline(disc) {
    document.querySelectorAll('.kb-tab-btn').forEach(b => {
        b.classList.remove('active', 'bg-slate-900', 'text-white');
        b.classList.add('bg-slate-100', 'text-slate-600');
    });
    event.currentTarget.classList.add('active', 'bg-slate-900', 'text-white');
    event.currentTarget.classList.remove('bg-slate-100', 'text-slate-600');

    const cards = document.querySelectorAll('.kb-card');
    cards.forEach(card => {
        if (disc === 'all' || card.dataset.discipline === disc) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterKbArticles() {
    const q = document.getElementById('kbSearchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.kb-card');
    cards.forEach(card => {
        const text = card.dataset.search || '';
        if (!q || text.includes(q)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php
get_footer();
