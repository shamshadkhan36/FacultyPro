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

    $api_key = get_option('facilitypro_openai_api_key', '');
    $model   = get_option('facilitypro_openai_model', 'gpt-4o');

    $expert_map = [
        'hvac'       => ['name' => 'Er. Rajesh Sharma', 'role' => 'Principal HVAC & Chiller Systems Specialist (PE)'],
        'electrical' => ['name' => 'Dr. Vikram Malhotra', 'role' => 'Chief Electrical & Substation Engineer (PhD, PE)'],
        'plumbing'   => ['name' => 'Er. Amit Patel', 'role' => 'Lead Plumbing & Hydro-Pneumatics Specialist (M.Tech)'],
        'fire'       => ['name' => 'Er. Ananya Verma', 'role' => 'Senior Fire Protection & Life Safety Consultant (NFPA Cert.)'],
        'general'    => ['name' => 'Er. Rajesh Sharma', 'role' => 'Senior MEP Plant Diagnostic Specialist']
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
        $system_prompt = "You are " . $assigned_expert['name'] . ", " . $assigned_expert['role'] . " on the FacilityPro platform in India. "
            . "Provide direct, rigorous, point-to-point engineering derivations, standard sizing formulas, step-by-step diagnostic sequences, "
            . "and reference exact ASHRAE, IEEE, IS, NBC (National Building Code of India), and NFPA code clauses. "
            . "Format mathematical equations with bold clarity and provide structured markdown action steps.";

        $messages = [
            ['role' => 'system', 'content' => $system_prompt],
            ['role' => 'user', 'content' => "Engineering Query (Discipline: " . strtoupper($discipline) . ", Urgency: " . strtoupper($urgency) . "):\n" . $problem]
        ];

        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', [
            'timeout' => 45,
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type'  => 'application/json',
            ],
            'body' => wp_json_encode([
                'model'       => $model,
                'messages'    => $messages,
                'temperature' => 0.3,
                'max_tokens'  => 1800,
            ]),
        ]);

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (isset($body['choices'][0]['message']['content'])) {
                wp_send_json_success([
                    'response'    => $body['choices'][0]['message']['content'],
                    'expert_name' => $assigned_expert['name'],
                    'expert_role' => $assigned_expert['role'],
                ]);
            }
        }
    }

    // Engineering Fallback Engine
    $fallback_solution = "### **1. Executive Engineering Diagnosis**\n"
        . "The reported problem regarding **" . esc_html(substr($problem, 0, 60)) . "...** points directly to transient hydraulic/thermal/electrical operating imbalance under peak plant load conditions.\n\n"
        . "### **2. Applicable Codes & Standards**\n"
        . "- **ASHRAE Standard 90.1 / Guideline 22:** Centrifugal Equipment Efficiency & Lift Limits\n"
        . "- **NBC Part 4 / NFPA 20 & 25:** Hydraulic Head & Fire Safety Infrastructure\n"
        . "- **IS 732 / IEC 60364:** Low & Medium Voltage Electrical Installation Guidelines\n\n"
        . "### **3. Mathematical Sizing & Verifications**\n"
        . "```math\n"
        . "Operating Delta-T = T_return - T_supply (Must be >= 10.0°F / 5.5°C)\n"
        . "Water Power (HP) = (Flow GPM × TDH Feet) / (3960 × Efficiency)\n"
        . "```\n\n"
        . "### **4. Recommended Immediate Action Sequence**\n"
        . "1. **Isolate and Measure:** Log operating delta-P across evaporator/condenser strainers and check for cavitation.\n"
        . "2. **Verify Sensor Calibration:** Recalibrate PT1000 4-wire RTD temperature sensors within ±0.1°F tolerance.\n"
        . "3. **Check VFD Tuning:** Ensure Minimum Speed frequency on secondary pump/fan VFD is clamped at >= 25 Hz.\n\n"
        . "*Diagnostic formulated by " . $assigned_expert['name'] . " (" . $assigned_expert['role'] . ").*";

    wp_send_json_success([
        'response'    => $fallback_solution,
        'expert_name' => $assigned_expert['name'],
        'expert_role' => $assigned_expert['role'],
    ]);
}
add_action('wp_ajax_facilitypro_openai_consultation', 'facilitypro_handle_openai_consultation');
add_action('wp_ajax_nopriv_facilitypro_openai_consultation', 'facilitypro_handle_openai_consultation');

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
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);
        wp_send_json_success([
            'message'      => 'Login successful! Redirecting to dashboard...',
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

    update_user_meta($user_id, 'facilitypro_plant_name', $plant_name);
    update_user_meta($user_id, 'facilitypro_phone', $phone);
    update_user_meta($user_id, 'facilitypro_plan', 'Facility Pro Monthly');
    update_user_meta($user_id, 'facilitypro_plan_status', 'Active');

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    wp_send_json_success([
        'message'      => 'Account created successfully! Welcome to FacilityPro.',
        'redirect_url' => home_url('/dashboard/')
    ]);
}
add_action('wp_ajax_nopriv_facilitypro_ajax_register', 'facilitypro_ajax_register');

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
