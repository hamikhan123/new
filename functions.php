<?php
/**
 * My Custom Theme - Complete Functions File
 * Includes: Theme setup, Custom Post Types, Assets, and Featured Image Fix
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// ==================== THEME SETUP ====================
function my_custom_theme_setup() {
    // Basic theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // Core thumbnail support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    
    // Navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'my-custom-theme'),
        'footer'  => __('Footer Menu', 'my-custom-theme')
    ));
    
    // Custom image sizes
    add_image_size('project-thumbnail', 400, 300, true);
    add_image_size('hero-bg', 1920, 1080, true);
    add_image_size('blog-thumbnail', 800, 500, true);
}
add_action('after_setup_theme', 'my_custom_theme_setup');

// ==================== FORCE FEATURED IMAGE SUPPORT ====================
function my_custom_theme_force_thumbnail_support() {
    // Standard post types
    add_post_type_support('post', 'thumbnail');
    add_post_type_support('page', 'thumbnail');
    
    // Custom post types
    $cpts = array('projects', 'hero');
    foreach ($cpts as $cpt) {
        add_post_type_support($cpt, 'thumbnail');
    }
    
    // Emergency flush (runs once)
    if (!get_option('my_theme_thumbnail_flushed')) {
        flush_rewrite_rules();
        update_option('my_theme_thumbnail_flushed', true);
    }
}
add_action('init', 'my_custom_theme_force_thumbnail_support', 20);

// ==================== CUSTOM POST TYPES ====================
function my_custom_theme_register_cpts() {
    // Projects CPT
    register_post_type('projects', array(
        'labels' => array(
            'name' => __('Projects', 'my-custom-theme'),
            'singular_name' => __('Project', 'my-custom-theme'),
            'menu_name' => __('Projects', 'my-custom-theme'),
            'name_admin_bar' => __('Project', 'my-custom-theme'),
            'add_new' => __('Add New', 'my-custom-theme'),
            'add_new_item' => __('Add New Project', 'my-custom-theme'),
            'new_item' => __('New Project', 'my-custom-theme'),
            'edit_item' => __('Edit Project', 'my-custom-theme'),
            'view_item' => __('View Project', 'my-custom-theme'),
            'all_items' => __('All Projects', 'my-custom-theme'),
            'search_items' => __('Search Projects', 'my-custom-theme'),
            'not_found' => __('No projects found.', 'my-custom-theme'),
            'not_found_in_trash' => __('No projects found in Trash.', 'my-custom-theme')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'),
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'taxonomies' => array('category', 'post_tag')
    ));

    // Hero CPT
    register_post_type('hero', array(
        'labels' => array(
            'name' => __('Hero Sections', 'my-custom-theme'),
            'singular_name' => __('Hero Section', 'my-custom-theme'),
            'menu_name' => __('Hero Sections', 'my-custom-theme'),
            'name_admin_bar' => __('Hero Section', 'my-custom-theme'),
            'add_new' => __('Add New', 'my-custom-theme'),
            'add_new_item' => __('Add New Hero Section', 'my-custom-theme'),
            'new_item' => __('New Hero Section', 'my-custom-theme'),
            'edit_item' => __('Edit Hero Section', 'my-custom-theme'),
            'view_item' => __('View Hero Section', 'my-custom-theme'),
            'all_items' => __('All Hero Sections', 'my-custom-theme'),
            'search_items' => __('Search Hero Sections', 'my-custom-theme'),
            'not_found' => __('No Hero sections found.', 'my-custom-theme'),
            'not_found_in_trash' => __('No Hero sections found in Trash.', 'my-custom-theme')
        ),
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => false,
        'menu_icon' => 'dashicons-slides',
        'supports' => array('title', 'custom-fields', 'thumbnail'),
        'show_in_rest' => true,
        'exclude_from_search' => true
    ));
}
add_action('init', 'my_custom_theme_register_cpts');

// ==================== ASSETS ====================
function my_custom_theme_scripts() {
    // CSS
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('tiny-slider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css');
    
    // Main stylesheet
    $theme_css = get_template_directory() . '/assets/css/style.css';
    $version = file_exists($theme_css) ? filemtime($theme_css) : '1.0';
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        $version
    );
    
    // JS
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    wp_enqueue_script('tiny-slider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js', array(), null, true);
    
    // Custom JS
    $custom_js = get_template_directory() . '/assets/js/custom.js';
    if (file_exists($custom_js)) {
        wp_enqueue_script(
            'theme-script',
            get_template_directory_uri() . '/assets/js/custom.js',
            array('jquery', 'bootstrap', 'tiny-slider'),
            filemtime($custom_js),
            true
        );
        
        wp_localize_script('theme-script', 'themeData', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wp_rest')
        ));
    }
}
add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

// ==================== REST API ENDPOINTS ====================
function my_custom_theme_projects_api($request) {
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    if ($start_date = $request->get_param('start_date')) {
        $args['meta_query'] = array(
            array(
                'key' => 'project_start_date',
                'value' => sanitize_text_field($start_date),
                'compare' => '>=',
                'type' => 'DATE'
            )
        );
    }

    $projects = get_posts($args);
    $data = array();

    foreach ($projects as $project) {
        $data[] = array(
            'id' => $project->ID,
            'title' => html_entity_decode(get_the_title($project->ID)),
            'url' => get_permalink($project->ID),
            'excerpt' => html_entity_decode(get_the_excerpt($project->ID)),
            'thumbnail' => get_the_post_thumbnail_url($project->ID, 'project-thumbnail'),
            'start_date' => get_field('project_start_date', $project->ID),
            'end_date' => get_field('project_end_date', $project->ID)
        );
    }

    return rest_ensure_response($data);
}

function my_custom_theme_single_project_api($request) {
    $id = $request->get_param('id');
    $project = get_post($id);

    if (empty($project) || $project->post_type != 'projects') {
        return new WP_Error('not_found', __('Project not found'), array('status' => 404));
    }

    return rest_ensure_response(array(
        'id' => $project->ID,
        'title' => html_entity_decode(get_the_title($project->ID)),
        'content' => apply_filters('the_content', $project->post_content),
        'thumbnail' => get_the_post_thumbnail_url($project->ID, 'full'),
        'gallery' => get_field('project_gallery', $project->ID)
    ));
}

function my_custom_theme_register_api_routes() {
    register_rest_route('my-custom-theme/v1', '/projects', array(
        'methods' => 'GET',
        'callback' => 'my_custom_theme_projects_api',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('my-custom-theme/v1', '/projects/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'my_custom_theme_single_project_api',
        'args' => array(
            'id' => array(
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            )
        ),
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'my_custom_theme_register_api_routes');

// ==================== WIDGETS & SIDEBARS ====================
function my_custom_theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer Column 1', 'my-custom-theme'),
        'id' => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => __('Footer Column 2', 'my-custom-theme'),
        'id' => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'my_custom_theme_widgets_init');

// ==================== ACF SETTINGS ====================
function my_custom_theme_acf_json_save_point($path) {
    return get_template_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'my_custom_theme_acf_json_save_point');

// ==================== QUERY MODIFICATIONS ====================
function my_custom_theme_project_archive_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('projects')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'my_custom_theme_project_archive_query');

// ==================== BODY CLASSES ====================
function my_custom_theme_body_classes($classes) {
    if (is_singular('projects')) {
        $classes[] = 'project-page';
    }
    return $classes;
}
add_filter('body_class', 'my_custom_theme_body_classes');

// ==================== THEME ACTIVATION ====================
function my_custom_theme_activation() {
    // Ensure all thumbnail support is enabled
    my_custom_theme_force_thumbnail_support();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'my_custom_theme_activation');

// ==================== NAV WALKER ====================
if (file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
    require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
/**
 * Calculate reading time for posts
 */
function reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    if ($readingtime == 1) {
        $timer = " min read";
    } else {
        $timer = " min read";
    }
    return $readingtime . $timer;
}