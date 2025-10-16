<?php
/**
 * The main template file for AutoDealer Pro theme
 * 
 * This is the most generic template file in a WordPress theme
 * and is used as the fallback for all dynamic content.
 */

get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1><?php echo get_theme_mod('hero_title', 'Find Your Perfect Car'); ?></h1>
            <p><?php echo get_theme_mod('hero_subtitle', 'Browse our extensive collection of quality vehicles at unbeatable prices'); ?></p>
            <a href="#cars" class="cta-button">Browse Cars</a>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <form class="search-form" method="GET" action="<?php echo home_url('/'); ?>">
                <select name="car_make">
                    <option value="">Select Make</option>
                    <?php
                    $makes = get_terms(array(
                        'taxonomy' => 'car_make',
                        'hide_empty' => false,
                    ));
                    foreach ($makes as $make) {
                        $selected = (isset($_GET['car_make']) && $_GET['car_make'] == $make->slug) ? 'selected' : '';
                        echo '<option value="' . $make->slug . '" ' . $selected . '>' . $make->name . '</option>';
                    }
                    ?>
                </select>
                
                <select name="car_model">
                    <option value="">Select Model</option>
                    <?php
                    $models = get_terms(array(
                        'taxonomy' => 'car_model',
                        'hide_empty' => false,
                    ));
                    foreach ($models as $model) {
                        $selected = (isset($_GET['car_model']) && $_GET['car_model'] == $model->slug) ? 'selected' : '';
                        echo '<option value="' . $model->slug . '" ' . $selected . '>' . $model->name . '</option>';
                    }
                    ?>
                </select>
                
                <input type="number" name="min_price" placeholder="Min Price" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
                <input type="number" name="max_price" placeholder="Max Price" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
                <input type="number" name="max_mileage" placeholder="Max Mileage" value="<?php echo isset($_GET['max_mileage']) ? $_GET['max_mileage'] : ''; ?>">
                
                <button type="submit" class="search-button">Search Cars</button>
            </form>
        </div>
    </section>

    <!-- Cars Listing Section -->
    <section id="cars" class="cars-section">
        <div class="container">
            <h2 class="section-title">Featured Vehicles</h2>
            
            <div class="cars-grid">
                <?php
                // Query for cars
                $car_args = array(
                    'post_type' => 'car',
                    'posts_per_page' => 12,
                    'post_status' => 'publish',
                    'meta_query' => array(),
                );
                
                // Add search filters
                if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                    $car_args['meta_query'][] = array(
                        'key' => 'car_price',
                        'value' => $_GET['min_price'],
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    );
                }
                
                if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                    $car_args['meta_query'][] = array(
                        'key' => 'car_price',
                        'value' => $_GET['max_price'],
                        'compare' => '<=',
                        'type' => 'NUMERIC'
                    );
                }
                
                if (isset($_GET['max_mileage']) && !empty($_GET['max_mileage'])) {
                    $car_args['meta_query'][] = array(
                        'key' => 'car_mileage',
                        'value' => $_GET['max_mileage'],
                        'compare' => '<=',
                        'type' => 'NUMERIC'
                    );
                }
                
                // Add taxonomy filters
                $tax_query = array();
                
                if (isset($_GET['car_make']) && !empty($_GET['car_make'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'car_make',
                        'field' => 'slug',
                        'terms' => $_GET['car_make']
                    );
                }
                
                if (isset($_GET['car_model']) && !empty($_GET['car_model'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'car_model',
                        'field' => 'slug',
                        'terms' => $_GET['car_model']
                    );
                }
                
                if (!empty($tax_query)) {
                    $car_args['tax_query'] = $tax_query;
                }
                
                $cars_query = new WP_Query($car_args);
                
                if ($cars_query->have_posts()) :
                    while ($cars_query->have_posts()) : $cars_query->the_post();
                        get_template_part('template-parts/car', 'card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No cars found matching your criteria.</p>';
                endif;
                ?>
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="<?php echo get_post_type_archive_link('car'); ?>" class="cta-button">View All Cars</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🚗</div>
                    <h3 class="feature-title">Quality Vehicles</h3>
                    <p>All our cars undergo thorough inspection to ensure quality and reliability.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💰</div>
                    <h3 class="feature-title">Best Prices</h3>
                    <p>Competitive pricing with transparent costs and no hidden fees.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🔧</div>
                    <h3 class="feature-title">Expert Service</h3>
                    <p>Professional service from experienced automotive specialists.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🛡️</div>
                    <h3 class="feature-title">Warranty</h3>
                    <p>Comprehensive warranty coverage for peace of mind.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>