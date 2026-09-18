<?php
/**
 * FacilityPro Admin Settings Page
 *
 * @package FacilityPro
 */

if (!defined('ABSPATH')) {
    exit;
}

function facilitypro_add_admin_menu() {
    add_menu_page(
        __('FacilityPro Settings', 'facilitypro'),
        __('FacilityPro AI', 'facilitypro'),
        'manage_options',
        'facilitypro-settings',
        'facilitypro_render_admin_settings_page',
        'dashicons-superhero',
        30
    );
}
add_action('admin_menu', 'facilitypro_add_admin_menu');

function facilitypro_register_settings() {
    register_setting('facilitypro_settings_group', 'facilitypro_openai_api_key');
    register_setting('facilitypro_settings_group', 'facilitypro_openai_model');
    register_setting('facilitypro_settings_group', 'facilitypro_openai_endpoint');
    register_setting('facilitypro_settings_group', 'facilitypro_emergency_phone');
    register_setting('facilitypro_settings_group', 'facilitypro_contact_email');
}
add_action('admin_init', 'facilitypro_register_settings');

function facilitypro_render_admin_settings_page() {
    ?>
    <div class="wrap" style="max-width: 900px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <h1 style="display: flex; items-center; gap: 10px; font-weight: 800; color: #0b2545;">
            <span style="background: #f05423; color: white; padding: 4px 10px; border-radius: 8px; font-size: 16px;">FP</span>
            FacilityPro AI & Engineering Settings
        </h1>
        <p style="color: #64748b; font-size: 14px;">Configure OpenAI GPT-4o integration, engineering models, custom API endpoints, and customer support channels.</p>
        
        <div style="background: #ffffff; padding: 24px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 20px;">
            <form method="post" action="options.php">
                <?php
                settings_fields('facilitypro_settings_group');
                do_settings_sections('facilitypro_settings_group');
                ?>

                <table class="form-table" style="margin-top: 0;">
                    <tr valign="top">
                        <th scope="row" style="font-weight: 700; color: #1e293b;">OpenAI API Key</th>
                        <td>
                            <input type="password" name="facilitypro_openai_api_key" value="<?php echo esc_attr(get_option('facilitypro_openai_api_key')); ?>" class="regular-text" style="width: 100%; max-width: 450px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1;" placeholder="sk-..." />
                            <p class="description" style="color: #64748b; margin-top: 6px;">Enter your OpenAI API secret key. If left blank, FacilityPro will automatically use its built-in mathematical reasoning engine.</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" style="font-weight: 700; color: #1e293b;">API Endpoint (Chat URL)</th>
                        <td>
                            <input type="text" name="facilitypro_openai_endpoint" value="<?php echo esc_attr(get_option('facilitypro_openai_endpoint', 'https://api.openai.com/v1/chat/completions')); ?>" class="regular-text" style="width: 100%; max-width: 450px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1;" placeholder="https://api.openai.com/v1/chat/completions" />
                            <p class="description" style="color: #64748b; margin-top: 6px;">Default: <code>https://api.openai.com/v1/chat/completions</code>. Supports any OpenAI-compatible proxy gateway.</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" style="font-weight: 700; color: #1e293b;">AI Model</th>
                        <td>
                            <?php $selected_model = get_option('facilitypro_openai_model', 'gpt-4o'); ?>
                            <select name="facilitypro_openai_model" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1;">
                                <option value="gpt-4o" <?php selected($selected_model, 'gpt-4o'); ?>>OpenAI GPT-4o (Recommended - Best Reasoning)</option>
                                <option value="gpt-4o-mini" <?php selected($selected_model, 'gpt-4o-mini'); ?>>OpenAI GPT-4o-mini (Faster / Low Cost)</option>
                                <option value="gpt-3.5-turbo" <?php selected($selected_model, 'gpt-3.5-turbo'); ?>>GPT-3.5 Turbo</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" style="font-weight: 700; color: #1e293b;">Support Phone / WhatsApp</th>
                        <td>
                            <input type="text" name="facilitypro_emergency_phone" value="<?php echo esc_attr(get_option('facilitypro_emergency_phone', '+91 98765 43210')); ?>" class="regular-text" style="width: 100%; max-width: 450px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1;" />
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" style="font-weight: 700; color: #1e293b;">Support Email</th>
                        <td>
                            <input type="email" name="facilitypro_contact_email" value="<?php echo esc_attr(get_option('facilitypro_contact_email', 'consult@facilitypro.ai')); ?>" class="regular-text" style="width: 100%; max-width: 450px; padding: 8px 12px; border-radius: 8px; border: 1px solid #cbd5e1;" />
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                    <?php submit_button(__('Save FacilityPro Settings', 'facilitypro'), 'primary', 'submit', false, array('style' => 'background: #0077c8; border-color: #0077c8; padding: 8px 24px; border-radius: 8px; font-weight: 700;')); ?>
                </div>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Custom User Profile Fields in WP-Admin for Subscription & Account Status Management
 */
function facilitypro_show_custom_user_profile_fields($user) {
    $account_status = get_user_meta($user->ID, 'facilitypro_account_status', true);
    if (empty($account_status)) $account_status = 'approved';
    $plan = get_user_meta($user->ID, 'facilitypro_plan', true);
    if (empty($plan)) $plan = 'Free Plan';
    $plant_name = get_user_meta($user->ID, 'facilitypro_plant_name', true);
    $phone = get_user_meta($user->ID, 'facilitypro_phone', true);
    $plan_status = get_user_meta($user->ID, 'facilitypro_plan_status', true);
    ?>
    <h3 style="margin-top: 30px; font-weight: 800; color: #0b2545;">FacilityPro Subscription &amp; Account Management</h3>
    <table class="form-table">
        <tr>
            <th><label for="facilitypro_account_status">Account &amp; Session Status</label></th>
            <td>
                <select name="facilitypro_account_status" id="facilitypro_account_status" style="padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                    <option value="approved" <?php selected($account_status, 'approved'); ?>>✓ Approved / Active (Has Portal Access)</option>
                    <option value="expired" <?php selected($account_status, 'expired'); ?>>⛔ Expired (Force Logout &amp; Block Access)</option>
                    <option value="pending" <?php selected($account_status, 'pending'); ?>>⏳ Pending Verification</option>
                    <option value="rejected" <?php selected($account_status, 'rejected'); ?>>✗ Rejected / Banned (Force Logout)</option>
                </select>
                <p class="description" style="color: #64748b;">Setting to <strong>Expired</strong> or <strong>Rejected</strong> instantly terminates all active login sessions across all devices for this user.</p>
            </td>
        </tr>
        <tr>
            <th><label for="facilitypro_plan">Subscription Plan</label></th>
            <td>
                <select name="facilitypro_plan" id="facilitypro_plan" style="padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                    <option value="Free Plan" <?php selected($plan, 'Free Plan'); ?>>Free Plan (Standard Tier)</option>
                    <option value="Facility Pro Monthly (₹399/mo)" <?php selected($plan, 'Facility Pro Monthly (₹399/mo)'); ?>>Facility Pro Monthly (₹399/mo - Full Access)</option>
                    <option value="Enterprise Tier" <?php selected($plan, 'Enterprise Tier'); ?>>Enterprise Tier (Multi-Plant / Custom)</option>
                </select>
                <p class="description" style="color: #64748b;">Controls access to premium download vault files, advanced diagnostic tools, and SOPs.</p>
            </td>
        </tr>
        <tr>
            <th><label for="facilitypro_plant_name">Facility / Plant Name</label></th>
            <td>
                <input type="text" name="facilitypro_plant_name" id="facilitypro_plant_name" value="<?php echo esc_attr($plant_name); ?>" class="regular-text" placeholder="e.g. Acme Pharma Unit 2" />
            </td>
        </tr>
        <tr>
            <th><label for="facilitypro_phone">Contact Phone / WhatsApp</label></th>
            <td>
                <input type="text" name="facilitypro_phone" id="facilitypro_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" placeholder="+91 98765 43210" />
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'facilitypro_show_custom_user_profile_fields');
add_action('edit_user_profile', 'facilitypro_show_custom_user_profile_fields');

/**
 * Save Custom User Profile Fields in WP-Admin
 */
function facilitypro_save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_POST['facilitypro_account_status'])) {
        $new_status = sanitize_key($_POST['facilitypro_account_status']);
        update_user_meta($user_id, 'facilitypro_account_status', $new_status);

        if ($new_status === 'expired') {
            update_user_meta($user_id, 'facilitypro_plan_status', 'Expired (Session Ended by Admin)');
            // Instantly destroy all active sessions
            $sessions = WP_Session_Tokens::get_instance($user_id);
            if ($sessions) {
                $sessions->destroy_all();
            }
        } elseif ($new_status === 'rejected') {
            update_user_meta($user_id, 'facilitypro_plan_status', 'Application Declined');
            $sessions = WP_Session_Tokens::get_instance($user_id);
            if ($sessions) {
                $sessions->destroy_all();
            }
        } elseif ($new_status === 'approved') {
            $plan = isset($_POST['facilitypro_plan']) ? sanitize_text_field($_POST['facilitypro_plan']) : 'Free Plan';
            update_user_meta($user_id, 'facilitypro_plan_status', $plan === 'Free Plan' ? 'Active Member (Free Tier)' : 'Active Member (Pro Tier)');
        }
    }

    if (isset($_POST['facilitypro_plan'])) {
        update_user_meta($user_id, 'facilitypro_plan', sanitize_text_field($_POST['facilitypro_plan']));
    }
    if (isset($_POST['facilitypro_plant_name'])) {
        update_user_meta($user_id, 'facilitypro_plant_name', sanitize_text_field($_POST['facilitypro_plant_name']));
    }
    if (isset($_POST['facilitypro_phone'])) {
        update_user_meta($user_id, 'facilitypro_phone', sanitize_text_field($_POST['facilitypro_phone']));
    }
}
add_action('personal_options_update', 'facilitypro_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'facilitypro_save_custom_user_profile_fields');

/**
 * Add Custom Columns to WP-Admin Users List
 */
function facilitypro_add_user_columns($columns) {
    $columns['facilitypro_plant'] = __('Plant / Facility', 'facilitypro');
    $columns['facilitypro_plan'] = __('Subscription Plan', 'facilitypro');
    $columns['facilitypro_status'] = __('Account Status', 'facilitypro');
    return $columns;
}
add_filter('manage_users_columns', 'facilitypro_add_user_columns');

function facilitypro_render_user_columns($value, $column_name, $user_id) {
    if ($column_name === 'facilitypro_plant') {
        $plant = get_user_meta($user_id, 'facilitypro_plant_name', true);
        return $plant ? esc_html($plant) : '<span style="color:#94a3b8;">—</span>';
    }
    if ($column_name === 'facilitypro_plan') {
        $plan = get_user_meta($user_id, 'facilitypro_plan', true);
        if (empty($plan) || stripos($plan, 'free') !== false) {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#f1f5f9; color:#475569; border:1px solid #cbd5e1;">Free Plan</span>';
        } elseif (stripos($plan, 'pro') !== false) {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0;">Pro (₹399/mo)</span>';
        } else {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#faf5ff; color:#6b21a8; border:1px solid #e9d5ff;">' . esc_html($plan) . '</span>';
        }
    }
    if ($column_name === 'facilitypro_status') {
        $status = get_user_meta($user_id, 'facilitypro_account_status', true);
        if (user_can($user_id, 'manage_options')) {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#ede9fe; color:#5b21b6;">Admin</span>';
        }
        if ($status === 'approved') {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#dcfce7; color:#15803d;">✓ Approved</span>';
        } elseif ($status === 'expired') {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#fee2e2; color:#b91c1c;">⛔ Expired</span>';
        } elseif ($status === 'rejected') {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#fef2f2; color:#991b1b;">✗ Rejected</span>';
        } else {
            return '<span style="display:inline-block; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:700; background:#fef3c7; color:#92400e;">⏳ Pending</span>';
        }
    }
    return $value;
}
add_filter('manage_users_custom_column', 'facilitypro_render_user_columns', 10, 3);
