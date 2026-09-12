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
        <p style="color: #64748b; font-size: 14px;">Configure OpenAI GPT-4o integration, engineering models, and customer support channels.</p>
        
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
