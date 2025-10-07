<?php
// Enqueue theme styles
function personal_project_enqueue_styles() {
    wp_enqueue_style('personal-project-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'personal_project_enqueue_styles');
