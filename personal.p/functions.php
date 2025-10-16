<?php
/**
 * AutoDealer Pro theme functions and definitions
 *
 * @package AutoDealer_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function autodealer_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'autodealer'),
        'footer' => esc_html__('Footer Menu', 'autodealer'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'autodealer_setup');

/**
 * Enqueue scripts and styles
 */
function autodealer_scripts() {
    wp_enqueue_style('autodealer-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('autodealer-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'autodealer_scripts');

/**
 * Register Custom Post Type for Cars
 */
function register_car_post_type() {
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car',
        'menu_name' => 'Cars',
        'add_new' => 'Add New Car',
        'add_new_item' => 'Add New Car',
        'edit_item' => 'Edit Car',
        'new_item' => 'New Car',
        'view_item' => 'View Car',
        'search_items' => 'Search Cars',
        'not_found' => 'No cars found',
        'not_found_in_trash' => 'No cars found in trash',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'cars'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-car',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    );
    
    register_post_type('car', $args);
}
add_action('init', 'register_car_post_type');

/**
 * Register Car Taxonomies
 */
function register_car_taxonomies() {
    // Car Make taxonomy
    register_taxonomy('car_make', 'car', array(
        'labels' => array(
            'name' => 'Car Makes',
            'singular_name' => 'Car Make',
            'menu_name' => 'Makes',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'make'),
        'show_in_rest' => true,
    ));
    
    // Car Model taxonomy
    register_taxonomy('car_model', 'car', array(
        'labels' => array(
            'name' => 'Car Models',
            'singular_name' => 'Car Model',
            'menu_name' => 'Models',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'model'),
        'show_in_rest' => true,
    ));
    
    // Car Year taxonomy
    register_taxonomy('car_year', 'car', array(
        'labels' => array(
            'name' => 'Car Years',
            'singular_name' => 'Car Year',
            'menu_name' => 'Years',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'year'),
        'show_in_rest' => true,
    ));
    
    // Car Condition taxonomy
    register_taxonomy('car_condition', 'car', array(
        'labels' => array(
            'name' => 'Car Conditions',
            'singular_name' => 'Car Condition',
            'menu_name' => 'Conditions',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'condition'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_car_taxonomies');

/**
 * Add Car Meta Boxes
 */
function add_car_meta_boxes() {
    add_meta_box(
        'car_details',
        'Car Details',
        'car_details_callback',
        'car',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_car_meta_boxes');

/**
 * Car Details Meta Box Callback
 */
function car_details_callback($post) {
    wp_nonce_field('car_details_nonce', 'car_details_nonce_field');
    
    $price = get_post_meta($post->ID, 'car_price', true);
    $mileage = get_post_meta($post->ID, 'car_mileage', true);
    $engine = get_post_meta($post->ID, 'car_engine', true);
    $transmission = get_post_meta($post->ID, 'car_transmission', true);
    $fuel_type = get_post_meta($post->ID, 'car_fuel_type', true);
    $exterior_color = get_post_meta($post->ID, 'car_exterior_color', true);
    $interior_color = get_post_meta($post->ID, 'car_interior_color', true);
    $vin = get_post_meta($post->ID, 'car_vin', true);
    $features = get_post_meta($post->ID, 'car_features', true);
    
    echo '<table class="form-table">';
    
    echo '<tr><th><label for="car_price">Price ($)</label></th>';
    echo '<td><input type="number" id="car_price" name="car_price" value="' . esc_attr($price) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_mileage">Mileage</label></th>';
    echo '<td><input type="number" id="car_mileage" name="car_mileage" value="' . esc_attr($mileage) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_engine">Engine</label></th>';
    echo '<td><input type="text" id="car_engine" name="car_engine" value="' . esc_attr($engine) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_transmission">Transmission</label></th>';
    echo '<td><select id="car_transmission" name="car_transmission">';
    echo '<option value="">Select Transmission</option>';
    echo '<option value="Manual"' . selected($transmission, 'Manual', false) . '>Manual</option>';
    echo '<option value="Automatic"' . selected($transmission, 'Automatic', false) . '>Automatic</option>';
    echo '<option value="CVT"' . selected($transmission, 'CVT', false) . '>CVT</option>';
    echo '</select></td></tr>';
    
    echo '<tr><th><label for="car_fuel_type">Fuel Type</label></th>';
    echo '<td><select id="car_fuel_type" name="car_fuel_type">';
    echo '<option value="">Select Fuel Type</option>';
    echo '<option value="Gasoline"' . selected($fuel_type, 'Gasoline', false) . '>Gasoline</option>';
    echo '<option value="Diesel"' . selected($fuel_type, 'Diesel', false) . '>Diesel</option>';
    echo '<option value="Hybrid"' . selected($fuel_type, 'Hybrid', false) . '>Hybrid</option>';
    echo '<option value="Electric"' . selected($fuel_type, 'Electric', false) . '>Electric</option>';
    echo '</select></td></tr>';
    
    echo '<tr><th><label for="car_exterior_color">Exterior Color</label></th>';
    echo '<td><input type="text" id="car_exterior_color" name="car_exterior_color" value="' . esc_attr($exterior_color) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_interior_color">Interior Color</label></th>';
    echo '<td><input type="text" id="car_interior_color" name="car_interior_color" value="' . esc_attr($interior_color) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_vin">VIN</label></th>';
    echo '<td><input type="text" id="car_vin" name="car_vin" value="' . esc_attr($vin) . '" /></td></tr>';
    
    echo '<tr><th><label for="car_features">Features</label></th>';
    echo '<td><textarea id="car_features" name="car_features" rows="4" cols="50">' . esc_textarea($features) . '</textarea>';
    echo '<br><small>Enter each feature on a new line</small></td></tr>';
    
    echo '</table>';
}

/**
 * Save Car Meta Data
 */
function save_car_meta($post_id) {
    if (!isset($_POST['car_details_nonce_field']) || !wp_verify_nonce($_POST['car_details_nonce_field'], 'car_details_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'car_price', 'car_mileage', 'car_engine', 'car_transmission',
        'car_fuel_type', 'car_exterior_color', 'car_interior_color',
        'car_vin', 'car_features'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_car_meta');

/**
 * Theme Customizer
 */
function autodealer_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => 'Hero Section',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Find Your Perfect Car',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => 'Hero Title',
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Browse our extensive collection of quality vehicles at unbeatable prices',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Hero Subtitle',
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'autodealer_customize_register');

/**
 * Format car price
 */
function format_car_price($price) {
    if (empty($price)) {
        return 'Contact for Price';
    }
    return '$' . number_format($price);
}

/**
 * Format car mileage
 */
function format_car_mileage($mileage) {
    if (empty($mileage)) {
        return 'N/A';
    }
    return number_format($mileage) . ' miles';
}

/**
 * Get car features as array
 */
function get_car_features_array($features_string) {
    if (empty($features_string)) {
        return array();
    }
    return array_filter(array_map('trim', explode("\n", $features_string)));
}

/**
 * Add sample car data on theme activation
 */
function autodealer_add_sample_data() {
    // Add sample car makes
    $makes = array('Toyota', 'Honda', 'Ford', 'Chevrolet', 'BMW', 'Mercedes-Benz', 'Audi', 'Nissan');
    foreach ($makes as $make) {
        if (!term_exists($make, 'car_make')) {
            wp_insert_term($make, 'car_make');
        }
    }
    
    // Add sample car conditions
    $conditions = array('New', 'Used', 'Certified Pre-Owned');
    foreach ($conditions as $condition) {
        if (!term_exists($condition, 'car_condition')) {
            wp_insert_term($condition, 'car_condition');
        }
    }
    
    // Add sample years
    for ($year = 2015; $year <= 2025; $year++) {
        if (!term_exists($year, 'car_year')) {
            wp_insert_term($year, 'car_year');
        }
    }
}
add_action('after_switch_theme', 'autodealer_add_sample_data');
?>