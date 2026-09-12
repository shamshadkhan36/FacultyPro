<?php
/**
 * Template Name: Checklists
 * Template Post Type: page
 *
 * @package FacilityPro
 */

get_header();

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

<div class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
                <i data-lucide="check-square" class="w-4 h-4"></i>
                <span>Preventive Maintenance</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                MEP Plant Inspection & Audit Checklists
            </h1>
            <p class="mt-2 text-base text-slate-600">
                Execute daily, weekly, and monthly statutory audit logs. Live progress tracking with immediate AI troubleshooting for failed check items.
            </p>
        </div>

        <!-- Checklist Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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

    </div>
</div>

<script>
function updateChecklistProgress(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const checkboxes = container.querySelectorAll('.chk-item-input');
    const total = checkboxes.length;
    let checked = 0;
    checkboxes.forEach(c => { if (c.checked) checked++; });
    
    const pct = (checked / total) * 100;
    const bar = container.querySelector('.chk-progress');
    if (bar) bar.style.width = pct + '%';

    const label = container.querySelector('.chk-status-label');
    if (label) label.textContent = checked + ' / ' + total + ' Completed';
}
</script>

<?php
get_footer();
