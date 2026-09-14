<?php
/**
 * Register Custom Post Types for MEP Platform
 *
 * @package FacilityPro
 */

if (!defined('ABSPATH')) {
    exit;
}

function facilitypro_register_cpts() {
    // 1. MEP AI Experts
    register_post_type('mep_expert', array(
        'labels' => array(
            'name'          => __('MEP AI Experts', 'facilitypro'),
            'singular_name' => __('MEP Expert', 'facilitypro'),
            'add_new_item'  => __('Add New AI Expert', 'facilitypro'),
            'edit_item'     => __('Edit AI Expert', 'facilitypro'),
        ),
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => array('slug' => 'expert', 'with_front' => false),
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'   => 'dashicons-businessperson',
        'show_in_rest'=> true,
    ));

    // 2. Popular Questions & Solutions
    register_post_type('mep_question', array(
        'labels' => array(
            'name'          => __('Popular Questions', 'facilitypro'),
            'singular_name' => __('Popular Question', 'facilitypro'),
            'add_new_item'  => __('Add New Question', 'facilitypro'),
            'edit_item'     => __('Edit Question', 'facilitypro'),
        ),
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => array('slug' => 'question', 'with_front' => false),
        'supports'    => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'menu_icon'   => 'dashicons-format-chat',
        'show_in_rest'=> true,
    ));

    // 3. SOP Library (Standard Operating Procedures)
    register_post_type('mep_sop', array(
        'labels' => array(
            'name'          => __('SOP Library', 'facilitypro'),
            'singular_name' => __('SOP', 'facilitypro'),
            'add_new_item'  => __('Add New SOP', 'facilitypro'),
            'edit_item'     => __('Edit SOP', 'facilitypro'),
            'all_items'     => __('All SOPs', 'facilitypro'),
        ),
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => array('slug' => 'sop', 'with_front' => false),
        'supports'    => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'author'),
        'menu_icon'   => 'dashicons-clipboard',
        'show_in_rest'=> true,
    ));

    // 4. Knowledge Hub Articles
    register_post_type('mep_knowledge', array(
        'labels' => array(
            'name'          => __('Knowledge Hub', 'facilitypro'),
            'singular_name' => __('Knowledge Article', 'facilitypro'),
            'add_new_item'  => __('Add New Knowledge Article', 'facilitypro'),
            'edit_item'     => __('Edit Knowledge Article', 'facilitypro'),
            'all_items'     => __('All Articles', 'facilitypro'),
        ),
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => array('slug' => 'knowledge', 'with_front' => false),
        'supports'    => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'author'),
        'menu_icon'   => 'dashicons-book-alt',
        'show_in_rest'=> true,
    ));

    // Discipline Taxonomy for filtering
    register_taxonomy('mep_discipline', array('mep_expert', 'mep_question', 'mep_sop', 'mep_knowledge'), array(
        'labels' => array(
            'name'          => __('MEP Disciplines', 'facilitypro'),
            'singular_name' => __('Discipline', 'facilitypro'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'discipline', 'with_front' => false),
    ));
}
add_action('init', 'facilitypro_register_cpts');
