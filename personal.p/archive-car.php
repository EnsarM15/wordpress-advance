<?php
/**
 * The template for displaying car archive pages
 *
 * @package AutoDealer_Pro
 */

get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Page Header -->
    <section style="background: linear-gradient(135deg, #333 0%, #555 100%); color: white; padding: 3rem 0; text-align: center;">
        <div class="container">
            <h1 style="font-size: 3rem; margin-bottom: 1rem;">Our Vehicle Inventory</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">Browse our extensive collection of quality vehicles</p>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-section">
        <div class="container">
            <form class="search-form" method="GET">
                <select name="car_make">
                    <option value="">All Makes</option>
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
                    <option value="">All Models</option>
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
                
                <select name="car_year">
                    <option value="">All Years</option>
                    <?php
                    $years = get_terms(array(
                        'taxonomy' => 'car_year',
                        'hide_empty' => false,
                        'orderby' => 'name',
                        'order' => 'DESC'
                    ));
                    foreach ($years as $year) {
                        $selected = (isset($_GET['car_year']) && $_GET['car_year'] == $year->slug) ? 'selected' : '';
                        echo '<option value="' . $year->slug . '" ' . $selected . '>' . $year->name . '</option>';
                    }
                    ?>
                </select>
                
                <select name="car_condition">
                    <option value="">All Conditions</option>
                    <?php
                    $conditions = get_terms(array(
                        'taxonomy' => 'car_condition',
                        'hide_empty' => false,
                    ));
                    foreach ($conditions as $condition) {
                        $selected = (isset($_GET['car_condition']) && $_GET['car_condition'] == $condition->slug) ? 'selected' : '';
                        echo '<option value="' . $condition->slug . '" ' . $selected . '>' . $condition->name . '</option>';
                    }
                    ?>
                </select>
                
                <input type="number" name="min_price" placeholder="Min Price" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
                <input type="number" name="max_price" placeholder="Max Price" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
                
                <select name="orderby">
                    <option value="date">Newest First</option>
                    <option value="price_low" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price_low') ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="price_high" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price_high') ? 'selected' : ''; ?>>Price: High to Low</option>
                    <option value="mileage_low" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'mileage_low') ? 'selected' : ''; ?>>Mileage: Low to High</option>
                    <option value="year_new" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'year_new') ? 'selected' : ''; ?>>Year: Newest First</option>
                </select>
                
                <button type="submit" class="search-button">Filter Results</button>
            </form>
        </div>
    </section>

    <!-- Results Section -->
    <section class="cars-section">
        <div class="container">
            <?php
            // Build query args
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            $args = array(
                'post_type' => 'car',
                'posts_per_page' => 12,
                'paged' => $paged,
                'post_status' => 'publish',
                'meta_query' => array(),
                'tax_query' => array(),
            );
            
            // Add price filters
            if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                $args['meta_query'][] = array(
                    'key' => 'car_price',
                    'value' => $_GET['min_price'],
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                );
            }
            
            if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                $args['meta_query'][] = array(
                    'key' => 'car_price',
                    'value' => $_GET['max_price'],
                    'compare' => '<=',
                    'type' => 'NUMERIC'
                );
            }
            
            // Add taxonomy filters
            $taxonomies = array('car_make', 'car_model', 'car_year', 'car_condition');
            foreach ($taxonomies as $taxonomy) {
                if (isset($_GET[$taxonomy]) && !empty($_GET[$taxonomy])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $_GET[$taxonomy]
                    );
                }
            }
            
            // Add sorting
            if (isset($_GET['orderby'])) {
                switch ($_GET['orderby']) {
                    case 'price_low':
                        $args['meta_key'] = 'car_price';
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'ASC';
                        break;
                    case 'price_high':
                        $args['meta_key'] = 'car_price';
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'DESC';
                        break;
                    case 'mileage_low':
                        $args['meta_key'] = 'car_mileage';
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'ASC';
                        break;
                    case 'year_new':
                        $args['orderby'] = 'meta_value_num';
                        $args['meta_key'] = 'car_year';
                        $args['order'] = 'DESC';
                        break;
                    default:
                        $args['orderby'] = 'date';
                        $args['order'] = 'DESC';
                }
            }
            
            $cars_query = new WP_Query($args);
            
            // Results summary
            if ($cars_query->have_posts()) :
                $total_cars = $cars_query->found_posts;
                $showing_start = (($paged - 1) * 12) + 1;
                $showing_end = min($total_cars, $paged * 12);
            ?>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <p style="margin: 0; color: #666;">
                        Showing <?php echo $showing_start; ?>-<?php echo $showing_end; ?> of <?php echo $total_cars; ?> vehicles
                    </p>
                    <?php if (isset($_GET['car_make']) || isset($_GET['min_price']) || isset($_GET['max_price'])) : ?>
                        <a href="<?php echo get_post_type_archive_link('car'); ?>" style="color: #ff6b35; text-decoration: none;">
                            Clear Filters
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="cars-grid">
                    <?php
                    while ($cars_query->have_posts()) : $cars_query->the_post();
                        get_template_part('template-parts/car', 'card');
                    endwhile;
                    ?>
                </div>
                
                <!-- Pagination -->
                <div style="text-align: center; margin-top: 3rem;">
                    <?php
                    echo paginate_links(array(
                        'total' => $cars_query->max_num_pages,
                        'current' => $paged,
                        'format' => '?paged=%#%',
                        'show_all' => false,
                        'type' => 'plain',
                        'end_size' => 2,
                        'mid_size' => 1,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                        'add_args' => $_GET,
                        'add_fragment' => '',
                    ));
                    ?>
                </div>
                
            <?php
                wp_reset_postdata();
            else :
            ?>
                <div style="text-align: center; padding: 4rem 0;">
                    <h2 style="color: #666; margin-bottom: 1rem;">No vehicles found</h2>
                    <p style="color: #999; margin-bottom: 2rem;">Try adjusting your search criteria</p>
                    <a href="<?php echo get_post_type_archive_link('car'); ?>" class="cta-button">View All Cars</a>
                </div>
            <?php
            endif;
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>