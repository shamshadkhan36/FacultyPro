<?php
/**
 * FacilityPro Theme Functions & Definitions
 *
 * @package FacilityPro
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FACILITYPRO_VERSION', '1.0.0');
define('FACILITYPRO_DIR', get_template_directory());
define('FACILITYPRO_URI', get_template_directory_uri());

// 1. Theme Setup
function facilitypro_setup() {
    load_theme_textdomain('facilitypro', FACILITYPRO_DIR . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Primary Header Menu', 'facilitypro'),
        'footer'  => __('Footer Navigation', 'facilitypro'),
    ));
}
add_action('after_setup_theme', 'facilitypro_setup');

// 2. Enqueue Styles and Scripts
function facilitypro_enqueue_scripts() {
    // Google Fonts: Plus Jakarta Sans & Inter
    wp_enqueue_style(
        'facilitypro-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap',
        array(),
        null
    );

    // Tailwind Play CDN for immediate zero-config responsive rendering
    wp_enqueue_script(
        'tailwindcss-cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );

    // Lucide Icons Web Script
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        array(),
        null,
        true
    );

    // Theme Stylesheet
    wp_enqueue_style(
        'facilitypro-custom-css',
        FACILITYPRO_URI . '/assets/css/facilitypro.css',
        array(),
        FACILITYPRO_VERSION
    );

    // Calculators Engine
    wp_enqueue_script(
        'facilitypro-calculators',
        FACILITYPRO_URI . '/assets/js/calculators.js',
        array('jquery'),
        FACILITYPRO_VERSION,
        true
    );

    // OpenAI Point-to-Point Reasoning Engine
    wp_enqueue_script(
        'facilitypro-openai',
        FACILITYPRO_URI . '/assets/js/openai-chat.js',
        array('jquery'),
        FACILITYPRO_VERSION,
        true
    );

    // Main Interactive UI Engine
    wp_enqueue_script(
        'facilitypro-main',
        FACILITYPRO_URI . '/assets/js/main.js',
        array('jquery', 'facilitypro-calculators', 'facilitypro-openai', 'lucide-icons'),
        FACILITYPRO_VERSION,
        true
    );

    // Localize Script for Ajax & Configuration
    wp_localize_script('facilitypro-main', 'facilityProData', array(
        'ajaxUrl'    => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('facilitypro_nonce'),
        'themeUri'   => FACILITYPRO_URI,
        'homeUrl'    => home_url('/'),
        'apiKey'     => get_option('facilitypro_openai_api_key', ''),
        'aiModel'    => get_option('facilitypro_openai_model', 'gpt-4o'),
    ));
}
add_action('wp_enqueue_scripts', 'facilitypro_enqueue_scripts');


// 3. Enqueue Block Editor Assets (Gutenberg styling support)
function facilitypro_block_editor_assets() {
    wp_enqueue_style(
        'facilitypro-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap',
        array(),
        null
    );
    wp_enqueue_script(
        'tailwindcss-cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        array(),
        null,
        true
    );
    wp_enqueue_style(
        'facilitypro-custom-css',
        FACILITYPRO_URI . '/assets/css/facilitypro.css',
        array(),
        FACILITYPRO_VERSION
    );
}
add_action('enqueue_block_editor_assets', 'facilitypro_block_editor_assets');
add_theme_support('editor-styles');

// Include Custom Post Types, AJAX Handlers, Admin Settings, and Component Shortcodes
require_once FACILITYPRO_DIR . '/inc/custom-post-types.php';
require_once FACILITYPRO_DIR . '/inc/ajax-handlers.php';
require_once FACILITYPRO_DIR . '/inc/admin-settings.php';
require_once FACILITYPRO_DIR . '/inc/shortcodes.php';
