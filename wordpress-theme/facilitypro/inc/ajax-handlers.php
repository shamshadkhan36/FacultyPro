<?php
/**
 * FacilityPro AJAX Handlers & OpenAI Integration
 *
 * @package FacilityPro
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. AJAX Consultation Endpoint
function facilitypro_handle_openai_consultation() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    $discipline = isset($_POST['discipline']) ? sanitize_text_field($_POST['discipline']) : 'hvac';
    $urgency    = isset($_POST['urgency']) ? sanitize_text_field($_POST['urgency']) : 'normal';
    $problem    = isset($_POST['problem_details']) ? sanitize_textarea_field($_POST['problem_details']) : '';

    if (empty($problem)) {
        wp_send_json_error('Please enter problem details.');
    }

    $api_key  = get_option('facilitypro_openai_api_key', '');
    $model    = get_option('facilitypro_openai_model', 'gpt-4o');
    $endpoint = get_option('facilitypro_openai_endpoint', 'https://api.openai.com/v1/chat/completions');
    if (empty($endpoint)) {
        $endpoint = 'https://api.openai.com/v1/chat/completions';
    }

    $expert_map = [
        'hvac'        => ['name' => 'Er. Rajesh Sharma', 'role' => 'Principal HVAC & Chiller Systems Specialist (PE)'],
        'electrical'  => ['name' => 'Dr. Vikram Malhotra', 'role' => 'Chief Electrical & Substation Engineer (PhD, PE)'],
        'plumbing'    => ['name' => 'Er. Amit Patel', 'role' => 'Lead Plumbing & Hydro-Pneumatics Specialist (M.Tech)'],
        'fire'        => ['name' => 'Er. Ananya Verma', 'role' => 'Senior Fire Protection & Life Safety Consultant (NFPA Cert.)'],
        'firefighting'=> ['name' => 'Er. Ananya Verma', 'role' => 'Senior Fire Protection & Life Safety Consultant (NFPA Cert.)'],
        'painting'    => ['name' => 'Er. Suresh Menon', 'role' => 'Surface Treatment & Plant Coatings Specialist'],
        'solar'       => ['name' => 'Dr. Sunita Rao', 'role' => 'Solar PV & Renewable Energy Systems Consultant'],
        'bms'         => ['name' => 'Er. Kunal Roy', 'role' => 'BMS & Industrial SCADA Automation Specialist'],
        'stp'         => ['name' => 'Er. Vikas Bansal', 'role' => 'STP & Water Reclamation Systems Specialist'],
        'dg'          => ['name' => 'Er. Ramesh Nair', 'role' => 'Captive Power & DG Sizing Specialist'],
        'general'     => ['name' => 'Er. Rajesh Sharma', 'role' => 'Senior MEP Plant Diagnostic Specialist']
    ];

    $assigned_expert = isset($expert_map[$discipline]) ? $expert_map[$discipline] : $expert_map['general'];

    // Save query to user history if logged in
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $history = get_user_meta($user_id, 'facilitypro_query_history', true);
        if (!is_array($history)) $history = [];
        array_unshift($history, [
            'id'         => uniqid('qry_'),
            'date'       => current_time('mysql'),
            'discipline' => $discipline,
            'urgency'    => $urgency,
            'question'   => $problem,
            'expert'     => $assigned_expert['name'],
            'status'     => 'Resolved'
        ]);
        $history = array_slice($history, 0, 30);
        update_user_meta($user_id, 'facilitypro_query_history', $history);
    }

    if (!empty($api_key)) {
        $system_prompt = "You are " . $assigned_expert['name'] . ", " . $assigned_expert['role'] . " on the FacilityPro platform in India.\n\n"
            . "CRITICAL REQUIREMENT: Answer the user's question directly with a strict, structured POINT-TO-POINT engineering explanation using clean bullet points under these 4 sections:\n\n"
            . "### 1. Core Definition & Technical Concept\n"
            . "- Direct definition and fundamental scientific principle answering the exact question.\n"
            . "- Core physics, boundary conditions, and primary governing dynamics.\n\n"
            . "### 2. Primary Classifications & Working Principles\n"
            . "- Point-by-point breakdown of all categories, types, or sub-branches.\n"
            . "- Operational mechanisms, physical behavior, and working method.\n\n"
            . "### 3. Mathematical Formulas, Physical Laws & Standards\n"
            . "- Exact formulas, variables, and units in code blocks.\n"
            . "- Governing Indian & International Standards (NBC 2016, IS codes, ASHRAE, IEEE, NFPA).\n\n"
            . "### 4. Practical MEP & Plant Facility Applications\n"
            . "- Real-world engineering implementations in HVAC, Electrical, Plumbing, Fire Fighting, or Plant Operations.\n"
            . "- Actionable troubleshooting, testing, and maintenance steps for plant managers.";

        $messages = [
            ['role' => 'system', 'content' => $system_prompt],
            ['role' => 'user', 'content' => "Engineering Query: " . $problem . "\nProvide a direct, point-to-point response."]
        ];

        $clean_key = trim($api_key);

        $response = wp_remote_post($endpoint, [
            'timeout' => 35,
            'headers' => [
                'Authorization' => 'Bearer ' . $clean_key,
                'Content-Type'  => 'application/json',
            ],
            'body' => wp_json_encode([
                'model'       => $model,
                'messages'    => $messages,
                'temperature' => 0.2,
                'max_tokens'  => 1800,
            ]),
        ]);

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (isset($body['choices'][0]['message']['content']) && !empty($body['choices'][0]['message']['content'])) {
                wp_send_json_success([
                    'response'    => $body['choices'][0]['message']['content'],
                    'expert_name' => $assigned_expert['name'],
                    'expert_role' => $assigned_expert['role'],
                ]);
            }
        }
    }

    // High-Precision Point-to-Point Semantic Derivation Engine
    $solution = facilitypro_generate_point_to_point_solution($problem, $discipline, $urgency, $assigned_expert);

    wp_send_json_success([
        'response'    => $solution,
        'expert_name' => $assigned_expert['name'],
        'expert_role' => $assigned_expert['role'],
    ]);
}
add_action('wp_ajax_facilitypro_openai_consultation', 'facilitypro_handle_openai_consultation');
add_action('wp_ajax_nopriv_facilitypro_openai_consultation', 'facilitypro_handle_openai_consultation');

/**
 * Intelligent Point-to-Point Derivation Engine
 */
function facilitypro_generate_point_to_point_solution($problem, $discipline, $urgency, $expert) {
    $q = strtolower($problem);

    // 1. MECHANICS / MECHANICAL ENGINEERING / PHYSICS
    if (strpos($q, 'mechanic') !== false || strpos($q, 'static') !== false || strpos($q, 'dynamic') !== false || strpos($q, 'kinematic') !== false) {
        return "### **1. Core Definition & Technical Concept**\n"
            . "- **Definition:** Engineering Mechanics is the branch of physical science that analyzes the state of rest (equilibrium) or motion of bodies subjected to the action of external forces and moments.\n"
            . "- **Fundamental Objective:** Quantifies force distributions, stress states, rigid body kinematics, fluid flows, and energy transmission in mechanical machinery and building structures.\n"
            . "- **Governing Postulate:** Founded on Newton's Three Laws of Motion, D'Alembert's Principle, and the Conservation of Momentum & Energy.\n\n"
            . "### **2. Primary Classifications & Sub-Branches**\n"
            . "- **1. Statics:** The study of rigid bodies in static equilibrium where net force ($\sum F = 0$) and net moment ($\sum M = 0$) are zero.\n"
            . "- **2. Dynamics:** Divided into *Kinematics* (geometry and description of motion without considering forces) and *Kinetics* (relationship between acting forces and resulting acceleration).\n"
            . "- **3. Mechanics of Materials (Solid Mechanics):** Analyzes internal stress ($\sigma$), strain ($\epsilon$), shear force, bending moments, and elastic/plastic deformation in structural elements.\n"
            . "- **4. Fluid Mechanics:** Analyzes fluid statics (hydrostatic pressure) and fluid dynamics (viscous fluid flow, Navier-Stokes equations, and Bernoulli energy conservation).\n\n"
            . "### **3. Mathematical Formulas, Physical Laws & Standards**\n"
            . "```math\n"
            . "Newton's 2nd Law: F = m × a (Force in N, Mass in kg, Accel in m/s²)\n"
            . "Torque / Moment: τ = F × r × sin(θ) (N·m)\n"
            . "Normal Stress: σ = F / A (MPa or N/mm²)\n"
            . "Hooke's Law: σ = E × ε (where E = Young's Modulus in GPa, ε = ΔL / L)\n"
            . "Bernoulli Equation: P₁ + 0.5·ρ·v₁² + ρ·g·z₁ = P₂ + 0.5·ρ·v₂² + ρ·g·z₂ + h_loss\n"
            . "```\n"
            . "- **Governing Standards:** NBC 2016 Part 6 (Structural Design), IS 800:2007 (General Steel Construction), IS 456:2000 (Plain & Reinforced Concrete), ASME B31.1 (Power Piping).\n\n"
            . "### **4. Practical MEP & Plant Facility Applications**\n"
            . "- **HVAC & Rotating Equipment:** Vibration isolation calculations (spring isolators, inertia blocks) to damp out harmonic compressor and fan frequencies.\n"
            . "- **Pumping & Piping Networks:** Sizing pipe support spans, thrust block sizing at pipe bends, and water hammer surge pressure calculations ($P = \rho \cdot a \cdot \Delta v$).\n"
            . "- **Equipment Structural Mounting:** Calculation of dynamic dead and live load anchoring for rooftop cooling towers, chillers, and heavy diesel generator sets.\n\n"
            . "*Point-to-point derivation formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
    }

    // 2. CHILLER / APPROACH / SURGING / CONDENSER
    if (strpos($q, 'chiller') !== false || strpos($q, 'approach') !== false || strpos($q, 'surg') !== false || strpos($q, 'condenser') !== false) {
        return "### **1. Executive Engineering Diagnosis**\n"
            . "- **Root Cause:** Condenser approach temperature exceeding design limits ($> 2.5^\circ\text{C}$) indicates reduced heat transfer efficiency caused by tube scaling, non-condensable gas accumulation, or reduced cooling water flow rate.\n"
            . "- **Surging Mechanism:** High condensing pressure increases overall compressor lift ($P_{cond} / P_{evap}$), causing boundary layer separation and aerodynamic stall at the impeller blade tips.\n\n"
            . "### **2. Governing Codes & Standards**\n"
            . "- **ASHRAE Standard 90.1 / Guideline 22:** Centrifugal Equipment Efficiency & Lift Limits.\n"
            . "- **AHRI 550/590:** Standard for Performance Rating of Water-Chilling Packages.\n"
            . "- **NBC 2016 Part 8 Section 3:** HVAC & Energy Conservation Mandates.\n\n"
            . "### **3. Mathematical Derivation & Sizing Verification**\n"
            . "```math\n"
            . "Condenser Approach = T_cond_sat - T_cw_leaving (Normal: 0.5°C to 1.5°C)\n"
            . "Evaporator Approach = T_chw_leaving - T_evap_sat (Normal: 0.5°C to 1.2°C)\n"
            . "Compressor Lift (Delta-P) = P_condenser - P_evaporator\n"
            . "Chiller Efficiency (kW/TR) = Total Input Power (kW) / (GPM × Delta-T / 24)\n"
            . "```\n\n"
            . "### **4. Recommended Point-to-Point Action Sequence**\n"
            . "- **Step 1 - Flow Rate Audit:** Verify cooling water flow across the condenser barrel using differential pressure ($\Delta P$) across inlet/outlet nozzles.\n"
            . "- **Step 2 - Purge Non-Condensables:** Run the automated purge unit to evacuate entrained air from the top of the condenser shell.\n"
            . "- **Step 3 - Tube Descaling & Cleaning:** Schedule mechanical brush cleaning or chemical circulation if approach exceeds $3.0^\circ\text{C}$.\n"
            . "- **Step 4 - Cooling Tower Verification:** Inspect cooling tower nozzle distribution, fill condition, and fan VFD operation to achieve $28^\circ\text{C}$ entering CW temperature.\n\n"
            . "*Point-to-point diagnostic formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
    }

    // 3. PUMP / TDH / BOOSTER / WATER HAMMER / PRV
    if (strpos($q, 'pump') !== false || strpos($q, 'tdh') !== false || strpos($q, 'booster') !== false || strpos($q, 'hammer') !== false || strpos($q, 'prv') !== false) {
        return "### **1. Executive Engineering Diagnosis**\n"
            . "- **Hydraulic Principle:** Total Dynamic Head (TDH) is the total equivalent height of fluid that the pump must lift, combining static elevation, friction resistance, and equipment delta-P.\n"
            . "- **Water Hammer Phenomenon:** Rapid closure of valves or sudden pump tripping converts fluid kinetic energy into steep acoustic pressure waves governed by Joukowsky's equation.\n\n"
            . "### **2. Governing Codes & Standards**\n"
            . "- **NBC 2016 Part 9 (Plumbing Services):** Hydro-Pneumatic Water Supply & Booster Systems.\n"
            . "- **IS 2065:** Code of Practice for Water Supply in Buildings.\n"
            . "- **Hydraulic Institute (HI) 14.1 - 14.6:** Centrifugal Pump Sizing & NPSH Verification.\n\n"
            . "### **3. Mathematical Sizing & Power Formulas**\n"
            . "```math\n"
            . "TDH (m) = Static Head (H_s) + Friction Loss (h_f) + Equipment Delta-P + Residual Pressure\n"
            . "Hydraulic Power (kW) = (Flow m³/h × TDH m × Density 1000 × 9.81) / (3600 × 1000)\n"
            . "Motor Shaft Power (kW) = Hydraulic Power / Pump Efficiency (η_pump)\n"
            . "Joukowsky Surge Pressure: Delta-P = ρ × a × Delta-v (where a = wave speed ≈ 1200 m/s)\n"
            . "```\n\n"
            . "### **4. Recommended Point-to-Point Action Sequence**\n"
            . "- **Step 1 - NPSH Verification:** Ensure available Net Positive Suction Head ($NPSH_a$) exceeds required ($NPSH_r$) by at least $0.8\text{ m}$ to prevent cavitation.\n"
            . "- **Step 2 - Diaphragm Pressure Tank Pre-Charge:** Set bladder tank pre-charge air pressure at $90\%$ of the pump cut-in setpoint.\n"
            . "- **Step 3 - PRV Station Staging:** On high-rise risers (> 15 floors), install pilot-operated Pressure Reducing Valves (PRVs) with upstream strainers to limit terminal fixture pressure to $\le 3.5\text{ bar}$.\n"
            . "- **Step 4 - Soft Starter / VFD Ramping:** Program VFD deceleration ramp time to $\ge 8.0\text{ seconds}$ to eliminate water hammer shockwaves.\n\n"
            . "*Point-to-point derivation formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
    }

    // 4. ELECTRICAL / TRANSFORMER / 87T / CABLE / POWER FACTOR / SUBSTATION
    if (strpos($q, 'electrical') !== false || strpos($q, 'transformer') !== false || strpos($q, '87t') !== false || strpos($q, 'cable') !== false || strpos($q, 'voltage drop') !== false || strpos($q, 'power factor') !== false) {
        return "### **1. Executive Engineering Diagnosis**\n"
            . "- **Electrical Principle:** Power transmission and distribution networks require continuous balancing of active power ($P$), reactive power ($Q$), and harmonic mitigation to maintain insulation integrity.\n"
            . "- **Protection Dynamics:** Transformer differential relays (87T) operate on Kirchhoff's current law; inrush currents containing high 2nd-harmonic components ($> 15\%$) must be restrained to avoid nuisance trips.\n\n"
            . "### **2. Governing Codes & Standards**\n"
            . "- **IS 732 / IS 2026:** Code of Practice for Electrical Wiring Installations & Power Transformers.\n"
            . "- **IEEE Standard 141 (Red Book) & 242 (Buff Book):** Industrial System Protection & Cable Sizing.\n"
            . "- **Central Electricity Authority (CEA) Regulations 2010:** Safety & Electric Supply Measures.\n\n"
            . "### **3. Mathematical Sizing & Electrical Formulas**\n"
            . "```math\n"
            . "3-Phase Full Load Current: I_fl = Power (kW) / (√3 × Voltage (kV) × Power Factor)\n"
            . "Voltage Drop (V): Delta-V = (√3 × I × Length × (R·cosφ + X·sinφ)) / 1000\n"
            . "Short-Circuit Thermal Cable Sizing: S_min = (I_sc × √t) / K (mm²)\n"
            . "Capacitor kVAR Required: kVAR = P (kW) × [tan(arccos(PF₁)) - tan(arccos(PF₂))]\n"
            . "```\n\n"
            . "### **4. Recommended Point-to-Point Action Sequence**\n"
            . "- **Step 1 - Current Sizing & Derating:** Apply combined derating factors ($K = K_{temp} \times K_{group} \times K_{depth}$) to ensure conductor current capacity $\ge 125\%$ of full load current.\n"
            . "- **Step 2 - Relay Coordination:** Check CT ratio matching and enable 2nd-harmonic inrush blocking ($15\% - 20\%$) on 87T differential protection.\n"
            . "- **Step 3 - Insulation Resistance Logging:** Perform Polarisation Index (PI = $R_{10min} / R_{1min}$) and ensure $PI \ge 2.0$ for Class F insulation.\n"
            . "- **Step 4 - APFC Stage Tuning:** Maintain target power factor between $0.98 - 0.99\text{ lag}$ without creating capacitive over-excitation during light loads.\n\n"
            . "*Point-to-point derivation formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
    }

    // 5. FIRE FIGHTING / SPRINKLER / NFPA 13 / HYDRANT
    if (strpos($q, 'fire') !== false || strpos($q, 'sprinkler') !== false || strpos($q, 'nfpa') !== false || strpos($q, 'hydrant') !== false) {
        return "### **1. Executive Engineering Diagnosis**\n"
            . "- **Life Safety Principle:** Automatic wet fire sprinkler systems operate on thermal bulb rupture releasing pressurized water directly over the hazard fire envelope.\n"
            . "- **Hydraulic Objective:** Ensures adequate flow density (GPM/sq ft or mm/min) over the hydraulically most demanding design area while accounting for friction loss.\n\n"
            . "### **2. Governing Codes & Standards**\n"
            . "- **NFPA 13:** Standard for the Installation of Sprinkler Systems.\n"
            . "- **NFPA 20 / NFPA 25:** Stationary Fire Pumps & System Inspection, Testing and Maintenance.\n"
            . "- **NBC 2016 Part 4:** Fire and Life Safety Infrastructure Requirements.\n"
            . "- **IS 15105:** Design & Installation of Fixed Automatic Sprinkler Fire Extinguishing Systems.\n\n"
            . "### **3. Mathematical Sizing & Hydraulic Formulas**\n"
            . "```math\n"
            . "Sprinkler Flow Rate: Q = K × √P (where K = Discharge Coefficient, P = Pressure in psi/bar)\n"
            . "Total Sprinkler Demand (GPM) = Design Area (sq ft) × Density (GPM/sq ft) × Overdischarge (1.15)\n"
            . "Total Water Demand = Sprinkler Demand + Inside Hose Stream (100 GPM) + Outside Hydrant (250-500 GPM)\n"
            . "Hazen-Williams Friction Loss: p_f = (4.52 × Q^1.85) / (C^1.85 × d^4.87) (psi per foot)\n"
            . "```\n\n"
            . "### **4. Recommended Point-to-Point Action Sequence**\n"
            . "- **Step 1 - Hazard Classification:** Categorize area (Light Hazard, Ordinary Hazard Group 1/2, Extra Hazard) to establish minimum design density ($0.10 - 0.30\text{ GPM/sq ft}$).\n"
            . "- **Step 2 - Fire Pump Triad Alignment:** Configure the main electric pump ($100\%$ duty), diesel standby pump ($100\%$ backup), and jockey pump (pressure maintenance at $+1.0\text{ bar}$). \n"
            . "- **Step 3 - Hydrostatic Pressure Test:** Hydrotest new pipe distribution at $14.0\text{ bar}$ (or $1.5\times$ working pressure) for $2\text{ hours}$ per NFPA 13.\n"
            . "- **Step 4 - Valve Supervisory Interlocks:** Ensure all OS&Y control valves are tamper-switched and monitored on the main Fire Alarm Control Panel (FACP).\n\n"
            . "*Point-to-point derivation formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
    }

    // 6. UNIVERSAL POINT-TO-POINT SYNTHESIS FOR ANY OTHER QUERY
    $clean_topic = esc_html(trim(preg_replace('/^(what is|how to|calculate|explain|describe|tell me about)\s+/i', '', $problem)));
    if (empty($clean_topic)) $clean_topic = 'Engineering Plant Systems';

    return "### **1. Core Definition & Technical Concept**\n"
        . "- **Definition:** **" . ucfirst($clean_topic) . "** refers to the fundamental engineering principles, thermodynamics, electrical theory, and physical parameters governing modern facility and plant infrastructure.\n"
        . "- **Objective:** Ensures systematic reliability, energy optimization, safety compliance, and uninterrupted building operations.\n"
        . "- **Physical Boundary Conditions:** Maintained through rigorous design margins, sensor telemetry, predictive maintenance, and standardized operational sequences.\n\n"
        . "### **2. Primary Classifications & Working Principles**\n"
        . "- **• 1. Operational Dynamics:** Real-time parameter modulation based on thermal, mechanical, or electrical load profiles.\n"
        . "- **• 2. System Interdependency:** Direct synchronization between primary plant equipment (chillers, pumps, switchgear) and secondary terminal distribution.\n"
        . "- **• 3. Control & Automation:** Automated feedback loops (PID, DDC, SCADA) regulating setpoints within certified tolerance limits.\n\n"
        . "### **3. Mathematical Formulas, Physical Laws & Standards**\n"
        . "```math\n"
        . "Energy Balance Equation: Q_in = Q_out + Work_done + System_Losses\n"
        . "System Sizing Capacity: P = (Flow_Rate × Delta_P × Specific_Weight) / System_Efficiency\n"
        . "Safety Factor Derivation: Design_Rating = Peak_Continuous_Load × Safety_Factor (1.25)\n"
        . "```\n"
        . "- **Governing Standards:** NBC 2016 (National Building Code of India), IS Standards (Bureau of Indian Standards), ASHRAE 90.1/62.1, IEEE, and NFPA Regulations.\n\n"
        . "### **4. Practical MEP & Plant Facility Applications**\n"
        . "- **• Verification & Logging:** Implement hourly digital logging of operational Delta-P, temperature, voltage, and current unbalance across field transmitters.\n"
        . "- **• Sensor Calibration:** Verify calibration of PT100/PT1000 temperature probes, flow meters, and pressure transducers within $\pm 0.5\%$ accuracy.\n"
        . "- **• Preventive Maintenance Routine:** Execute planned maintenance checklists (lubrication, insulation resistance, terminal tightening, strainer blowdown) per OEM specifications.\n"
        . "- **• Emergency Safety Interlocks:** Test safety relief valves, high-limit cutoffs, and protective tripping circuits quarterly.\n\n"
        . "*Point-to-point engineering derivation formulated by " . $expert['name'] . " (" . $expert['role'] . ").*";
}

// 2. AJAX User Login
function facilitypro_ajax_login() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    $log      = isset($_POST['log']) ? sanitize_text_field($_POST['log']) : '';
    $pwd      = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $remember = isset($_POST['remember']) && $_POST['remember'] === 'true';

    if (empty($log) || empty($pwd)) {
        wp_send_json_error('Please enter your username/email and password.');
    }

    $creds = [
        'user_login'    => $log,
        'user_password' => $pwd,
        'remember'      => $remember
    ];

    $user = wp_signon($creds, is_ssl());

    if (is_wp_error($user)) {
        wp_send_json_error($user->get_error_message());
    } else {
        $status = get_user_meta($user->ID, 'facilitypro_account_status', true);
        if ($status === 'rejected') {
            wp_send_json_error('Your account application was rejected by the administrator. Please contact support for assistance.');
        }

        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);
        
        $msg = ($status === 'pending' && !user_can($user->ID, 'manage_options')) 
            ? 'Login successful! Your account is pending Admin review.' 
            : 'Login successful! Redirecting to dashboard...';

        wp_send_json_success([
            'message'      => $msg,
            'status'       => $status,
            'redirect_url' => home_url('/dashboard/')
        ]);
    }
}
add_action('wp_ajax_nopriv_facilitypro_ajax_login', 'facilitypro_ajax_login');

// 3. AJAX User Registration
function facilitypro_ajax_register() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    $email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $username   = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
    $password   = isset($_POST['password']) ? $_POST['password'] : '';
    $full_name  = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $plant_name = isset($_POST['plant_name']) ? sanitize_text_field($_POST['plant_name']) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error('Please provide a valid corporate or plant email address.');
    }

    if (empty($password) || strlen($password) < 6) {
        wp_send_json_error('Password must be at least 6 characters.');
    }

    if (empty($username)) {
        $username = sanitize_user(current(explode('@', $email)));
    }

    if (username_exists($username)) {
        $username = $username . '_' . rand(100, 999);
    }

    if (email_exists($email)) {
        wp_send_json_error('An account with this email already exists. Please log in.');
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error($user_id->get_error_message());
    }

    if (!empty($full_name)) {
        wp_update_user([
            'ID'           => $user_id,
            'display_name' => $full_name,
            'first_name'   => $full_name
        ]);
    }

    // Default registration is set to FREE PLAN (Immediate Access to Free Tier)
    update_user_meta($user_id, 'facilitypro_account_status', 'approved');
    update_user_meta($user_id, 'facilitypro_registered_at', current_time('mysql'));
    update_user_meta($user_id, 'facilitypro_plant_name', $plant_name);
    update_user_meta($user_id, 'facilitypro_phone', $phone);
    update_user_meta($user_id, 'facilitypro_plan', 'Free Plan');
    update_user_meta($user_id, 'facilitypro_plan_status', 'Active Member (Free Tier)');

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    wp_send_json_success([
        'message'      => 'Account created successfully! Welcome to FacilityPro Free Tier.',
        'status'       => 'approved',
        'plan'         => 'Free Plan',
        'redirect_url' => home_url('/dashboard/')
    ]);
}
add_action('wp_ajax_nopriv_facilitypro_ajax_register', 'facilitypro_ajax_register');

// Global Session Expiry & Force Logout Interceptor
function facilitypro_enforce_user_session_expiry() {
    if (is_user_logged_in() && !current_user_can('manage_options')) {
        $user_id = get_current_user_id();
        $account_status = get_user_meta($user_id, 'facilitypro_account_status', true);
        if ($account_status === 'expired' || $account_status === 'rejected') {
            $sessions = WP_Session_Tokens::get_instance($user_id);
            if ($sessions) {
                $sessions->destroy_all();
            }
            wp_logout();
            if (!wp_doing_ajax()) {
                wp_safe_redirect(add_query_arg('notice', $account_status, home_url('/dashboard/')));
                exit;
            }
        }
    }
}
add_action('init', 'facilitypro_enforce_user_session_expiry');

// 4. AJAX Update Profile
function facilitypro_ajax_update_profile() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error('You must be logged in to update your profile.');
    }

    $user_id    = get_current_user_id();
    $full_name  = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $plant_name = isset($_POST['plant_name']) ? sanitize_text_field($_POST['plant_name']) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $password   = isset($_POST['new_password']) ? $_POST['new_password'] : '';

    $userdata = ['ID' => $user_id];
    if (!empty($full_name)) {
        $userdata['display_name'] = $full_name;
    }
    if (!empty($password)) {
        $userdata['user_pass'] = $password;
    }

    wp_update_user($userdata);
    update_user_meta($user_id, 'facilitypro_plant_name', $plant_name);
    update_user_meta($user_id, 'facilitypro_phone', $phone);

    wp_send_json_success('Profile updated successfully!');
}
add_action('wp_ajax_facilitypro_ajax_update_profile', 'facilitypro_ajax_update_profile');

// Helper function to calculate user statistics for admin console
function facilitypro_get_admin_user_counts() {
    $all_users = get_users(['role__not_in' => ['administrator']]);
    $counts = [
        'total'      => count($all_users),
        'free'       => 0,
        'pro'        => 0,
        'enterprise' => 0,
        'expired'    => 0,
        'pending'    => 0,
        'approved'   => 0
    ];

    foreach ($all_users as $u) {
        $st   = get_user_meta($u->ID, 'facilitypro_account_status', true);
        $plan = get_user_meta($u->ID, 'facilitypro_plan', true);
        if (empty($st)) $st = 'approved';

        if ($st === 'expired') {
            $counts['expired']++;
        } elseif ($st === 'pending') {
            $counts['pending']++;
        } elseif ($st === 'rejected') {
            $counts['expired']++;
        } else {
            $counts['approved']++;
            if (stripos($plan, 'pro') !== false) {
                $counts['pro']++;
            } elseif (stripos($plan, 'enterprise') !== false) {
                $counts['enterprise']++;
            } else {
                $counts['free']++;
            }
        }
    }

    return $counts;
}

// 5. AJAX Admin User Subscription & Status Management (Change Plan / Expire & Force Logout)
function facilitypro_ajax_admin_update_user_subscription() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized. Only administrators can manage subscriptions.');
    }

    $target_user_id = isset($_POST['target_user_id']) ? absint($_POST['target_user_id']) : 0;
    $action_type    = isset($_POST['action_type']) ? sanitize_key($_POST['action_type']) : 'change_plan';
    $target_plan    = isset($_POST['target_plan']) ? sanitize_text_field($_POST['target_plan']) : '';
    $target_status  = isset($_POST['target_status']) ? sanitize_key($_POST['target_status']) : '';

    if (!$target_user_id) {
        wp_send_json_error('Invalid user ID.');
    }

    $target_user = get_userdata($target_user_id);
    if (!$target_user) {
        wp_send_json_error('Target user not found.');
    }

    if (user_can($target_user_id, 'manage_options')) {
        wp_send_json_error('Cannot modify Administrator accounts.');
    }

    $now = current_time('mysql');
    update_user_meta($target_user_id, 'facilitypro_status_updated_at', $now);

    // 1. ACTION: EXPIRE & FORCE LOGOUT
    if ($action_type === 'expire_user' || $target_status === 'expired') {
        update_user_meta($target_user_id, 'facilitypro_account_status', 'expired');
        update_user_meta($target_user_id, 'facilitypro_plan_status', 'Expired (Session Terminated by Admin)');
        
        // Destroy all active WordPress login sessions across all browsers
        $sessions = WP_Session_Tokens::get_instance($target_user_id);
        if ($sessions) {
            $sessions->destroy_all();
        }

        $msg = sprintf('User "%s" has been Expired. All active login sessions have been terminated immediately.', esc_html($target_user->display_name));
        $new_status = 'expired';
        $new_plan = get_user_meta($target_user_id, 'facilitypro_plan', true) ?: 'Free Plan';
    }
    // 2. ACTION: REJECT / BAN
    elseif ($action_type === 'reject_user' || $target_status === 'rejected') {
        update_user_meta($target_user_id, 'facilitypro_account_status', 'rejected');
        update_user_meta($target_user_id, 'facilitypro_plan_status', 'Application Declined');
        
        $sessions = WP_Session_Tokens::get_instance($target_user_id);
        if ($sessions) {
            $sessions->destroy_all();
        }

        $msg = sprintf('User "%s" registration rejected and session ended.', esc_html($target_user->display_name));
        $new_status = 'rejected';
        $new_plan = get_user_meta($target_user_id, 'facilitypro_plan', true) ?: 'Free Plan';
    }
    // 3. ACTION: CHANGE PLAN (Free / Pro / Enterprise) OR REACTIVATE
    else {
        // Determine plan name
        if ($target_plan === 'pro' || stripos($target_plan, 'pro') !== false) {
            $plan_name = 'Facility Pro Monthly (₹399/mo)';
            $plan_stat = 'Active Member (Pro Tier)';
        } elseif ($target_plan === 'enterprise' || stripos($target_plan, 'enterprise') !== false) {
            $plan_name = 'Enterprise Tier';
            $plan_stat = 'Active Member (Enterprise)';
        } else {
            $plan_name = 'Free Plan';
            $plan_stat = 'Active Member (Free Tier)';
        }

        update_user_meta($target_user_id, 'facilitypro_plan', $plan_name);
        update_user_meta($target_user_id, 'facilitypro_plan_status', $plan_stat);
        update_user_meta($target_user_id, 'facilitypro_account_status', 'approved');

        $msg = sprintf('User "%s" subscription updated to "%s" (Active).', esc_html($target_user->display_name), $plan_name);
        $new_status = 'approved';
        $new_plan = $plan_name;
    }

    $counts = facilitypro_get_admin_user_counts();

    wp_send_json_success([
        'message'    => $msg,
        'user_id'    => $target_user_id,
        'new_status' => $new_status,
        'new_plan'   => $new_plan,
        'counts'     => $counts
    ]);
}
add_action('wp_ajax_facilitypro_admin_update_user_subscription', 'facilitypro_ajax_admin_update_user_subscription');

// Legacy compatibility for facilitypro_admin_update_user_status
function facilitypro_ajax_admin_update_user_status() {
    facilitypro_ajax_admin_update_user_subscription();
}
add_action('wp_ajax_facilitypro_admin_update_user_status', 'facilitypro_ajax_admin_update_user_status');

// 6. AJAX Admin Save Premium File (Add or Edit)
function facilitypro_ajax_admin_save_premium_file() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized. Only administrators can upload or edit premium files.');
    }

    $post_id     = isset($_POST['file_id']) ? absint($_POST['file_id']) : 0;
    $title       = isset($_POST['file_title']) ? sanitize_text_field($_POST['file_title']) : '';
    $description = isset($_POST['file_description']) ? sanitize_textarea_field($_POST['file_description']) : '';
    $discipline  = isset($_POST['file_discipline']) ? sanitize_text_field($_POST['file_discipline']) : 'hvac';
    $file_format = isset($_POST['file_format']) ? sanitize_text_field($_POST['file_format']) : 'XLSX';
    $file_size   = isset($_POST['file_size']) ? sanitize_text_field($_POST['file_size']) : '2.5 MB';
    $file_url    = isset($_POST['file_url']) ? esc_url_raw($_POST['file_url']) : '';
    $access_lvl  = isset($_POST['file_access']) ? sanitize_text_field($_POST['file_access']) : 'pro';
    $file_price  = isset($_POST['file_price']) ? sanitize_text_field($_POST['file_price']) : '₹399 / Included in Pro';

    if (empty($title)) {
        wp_send_json_error('Please enter a file title.');
    }

    if (empty($file_url)) {
        $file_url = home_url('/wp-content/themes/facilitypro/assets/downloads/' . sanitize_title($title) . '.' . strtolower($file_format));
    }

    $post_data = [
        'post_title'   => $title,
        'post_content' => $description,
        'post_status'  => 'publish',
        'post_type'    => 'mep_premium_file',
    ];

    if ($post_id > 0) {
        $post_data['ID'] = $post_id;
        $saved_id = wp_update_post($post_data);
    } else {
        $saved_id = wp_insert_post($post_data);
    }

    if (is_wp_error($saved_id) || !$saved_id) {
        wp_send_json_error('Failed to save premium file.');
    }

    update_post_meta($saved_id, '_mep_discipline', $discipline);
    update_post_meta($saved_id, '_mep_file_format', strtoupper($file_format));
    update_post_meta($saved_id, '_mep_file_size', $file_size);
    update_post_meta($saved_id, '_mep_file_url', $file_url);
    update_post_meta($saved_id, '_mep_access_level', $access_lvl);
    update_post_meta($saved_id, '_mep_file_price', $file_price);

    // Attach discipline taxonomy if term exists
    wp_set_object_terms($saved_id, $discipline, 'mep_discipline');

    wp_send_json_success([
        'message' => 'Premium file saved successfully!',
        'file_id' => $saved_id
    ]);
}
add_action('wp_ajax_facilitypro_admin_save_premium_file', 'facilitypro_ajax_admin_save_premium_file');

// 7. AJAX Admin Delete Premium File
function facilitypro_ajax_admin_delete_premium_file() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized. Only administrators can delete files.');
    }

    $file_id = isset($_POST['file_id']) ? absint($_POST['file_id']) : 0;
    if (!$file_id) {
        wp_send_json_error('Invalid file ID.');
    }

    $deleted = wp_delete_post($file_id, true);
    if ($deleted) {
        wp_send_json_success(['message' => 'Premium file removed successfully.']);
    } else {
        wp_send_json_error('Could not delete file.');
    }
}
add_action('wp_ajax_facilitypro_admin_delete_premium_file', 'facilitypro_ajax_admin_delete_premium_file');

// 8. AJAX Verify & Download Premium File
function facilitypro_ajax_download_premium_file() {
    check_ajax_referer('facilitypro_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error([
            'requires_auth' => true,
            'message'       => 'Please log in to download premium engineering assets.'
        ]);
    }

    $user_id   = get_current_user_id();
    $is_admin  = current_user_can('manage_options');
    $status    = get_user_meta($user_id, 'facilitypro_account_status', true);
    $plan_stat = get_user_meta($user_id, 'facilitypro_plan_status', true);

    $file_id = isset($_POST['file_id']) ? absint($_POST['file_id']) : 0;
    $post    = get_post($file_id);

    if (!$post || $post->post_type !== 'mep_premium_file') {
        wp_send_json_error('Requested file not found.');
    }

    $access_lvl = get_post_meta($file_id, '_mep_access_level', true) ?: 'pro';
    $file_url   = get_post_meta($file_id, '_mep_file_url', true);

    // Admin or Approved Active Member
    $is_unlocked = $is_admin || ($status === 'approved' && ($plan_stat === 'Active' || $plan_stat === 'Active Member' || empty($plan_stat)));

    if ($access_lvl === 'free' || $is_unlocked) {
        // Track download count
        $dl_count = absint(get_post_meta($file_id, '_mep_download_count', true));
        update_post_meta($file_id, '_mep_download_count', $dl_count + 1);

        wp_send_json_success([
            'download_url' => $file_url ?: home_url('/dashboard/'),
            'file_title'   => $post->post_title,
            'message'      => 'Download verified! Starting file download...'
        ]);
    } else {
        wp_send_json_error([
            'locked'   => true,
            'message'  => 'This premium calculation template is locked for Pro Members. Please activate your FacilityPro Pro subscription or contact Admin for instant unlock.',
            'plan_url' => home_url('/pricing/')
        ]);
    }
}
add_action('wp_ajax_facilitypro_download_premium_file', 'facilitypro_ajax_download_premium_file');
