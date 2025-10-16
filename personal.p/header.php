<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
    <div class="container">
        <div class="header-content">
            <?php
            // Display custom logo or site title
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<a href="' . home_url() . '" class="logo">' . get_bloginfo('name') . '</a>';
            }
            ?>
            
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'autodealer_fallback_menu',
                ));
                ?>
            </nav>
            
            <!-- Mobile menu toggle (for future enhancement) -->
            <button class="mobile-menu-toggle" style="display: none;">☰</button>
        </div>
    </div>
</header>

<?php
/**
 * Fallback menu if no menu is assigned
 */
function autodealer_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url() . '">Home</a></li>';
    echo '<li><a href="' . get_post_type_archive_link('car') . '">Cars</a></li>';
    echo '<li><a href="' . home_url('/about') . '">About</a></li>';
    echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
    echo '</ul>';
}
?>