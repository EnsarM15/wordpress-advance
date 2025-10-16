<?php
/*
Template Name: Car Comparison
*/

get_header();

// Get car IDs from URL parameter
$car_ids = isset($_GET['cars']) ? explode(',', $_GET['cars']) : array();
$car_ids = array_filter(array_map('intval', $car_ids));

if (empty($car_ids)) {
    wp_redirect(home_url());
    exit;
}
?>

<main id="primary" class="site-main">
    <div class="container" style="padding: 2rem 20px;">
        <h1 style="text-align: center; margin-bottom: 2rem;">Compare Vehicles</h1>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                <thead>
                    <tr style="background: #333; color: white;">
                        <th style="padding: 1rem; text-align: left;">Feature</th>
                        <?php
                        foreach ($car_ids as $car_id) :
                            $car = get_post($car_id);
                            if ($car && $car->post_type === 'car') :
                                // Get car details
                                $makes = get_the_terms($car_id, 'car_make');
                                $models = get_the_terms($car_id, 'car_model');
                                $years = get_the_terms($car_id, 'car_year');
                                
                                $make_name = ($makes && !is_wp_error($makes)) ? $makes[0]->name : '';
                                $model_name = ($models && !is_wp_error($models)) ? $models[0]->name : '';
                                $year = ($years && !is_wp_error($years)) ? $years[0]->name : '';
                                
                                $car_title = trim($year . ' ' . $make_name . ' ' . $model_name);
                                if (empty($car_title)) {
                                    $car_title = $car->post_title;
                                }
                        ?>
                            <th style="padding: 1rem; text-align: center; min-width: 200px;">
                                <?php echo esc_html($car_title); ?>
                            </th>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Images -->
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem; font-weight: bold; background: #f8f9fa;">Image</td>
                        <?php
                        foreach ($car_ids as $car_id) :
                            $car = get_post($car_id);
                            if ($car && $car->post_type === 'car') :
                        ?>
                            <td style="padding: 1rem; text-align: center;">
                                <?php if (has_post_thumbnail($car_id)) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url($car_id, 'medium'); ?>" 
                                         style="width: 100%; max-width: 200px; height: 120px; object-fit: cover; border-radius: 5px;" 
                                         alt="<?php echo get_the_title($car_id); ?>">
                                <?php else : ?>
                                    <div style="width: 200px; height: 120px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #999;">
                                        No Image
                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tr>
                    
                    <!-- Price -->
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem; font-weight: bold; background: #f8f9fa;">Price</td>
                        <?php
                        foreach ($car_ids as $car_id) :
                            $car = get_post($car_id);
                            if ($car && $car->post_type === 'car') :
                                $price = get_post_meta($car_id, 'car_price', true);
                        ?>
                            <td style="padding: 1rem; text-align: center; font-size: 1.2rem; font-weight: bold; color: #ff6b35;">
                                <?php echo format_car_price($price); ?>
                            </td>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tr>
                    
                    <?php
                    // Define comparison fields
                    $comparison_fields = array(
                        'car_mileage' => 'Mileage',
                        'car_engine' => 'Engine',
                        'car_transmission' => 'Transmission',
                        'car_fuel_type' => 'Fuel Type',
                        'car_exterior_color' => 'Exterior Color',
                        'car_interior_color' => 'Interior Color'
                    );
                    
                    foreach ($comparison_fields as $field_key => $field_label) :
                    ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 1rem; font-weight: bold; background: #f8f9fa;"><?php echo $field_label; ?></td>
                            <?php
                            foreach ($car_ids as $car_id) :
                                $car = get_post($car_id);
                                if ($car && $car->post_type === 'car') :
                                    $value = get_post_meta($car_id, $field_key, true);
                                    if ($field_key === 'car_mileage' && $value) {
                                        $value = format_car_mileage($value);
                                    }
                            ?>
                                <td style="padding: 1rem; text-align: center;">
                                    <?php echo $value ? esc_html($value) : 'N/A'; ?>
                                </td>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </tr>
                    <?php endforeach; ?>
                    
                    <!-- Action buttons -->
                    <tr>
                        <td style="padding: 1rem; font-weight: bold; background: #f8f9fa;">Actions</td>
                        <?php
                        foreach ($car_ids as $car_id) :
                            $car = get_post($car_id);
                            if ($car && $car->post_type === 'car') :
                        ?>
                            <td style="padding: 1rem; text-align: center;">
                                <a href="<?php echo get_permalink($car_id); ?>" 
                                   style="display: inline-block; background: #ff6b35; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px; margin-bottom: 0.5rem;">
                                    View Details
                                </a><br>
                                <button onclick="removeFromComparison(<?php echo $car_id; ?>)" 
                                        style="background: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">
                                    Remove
                                </button>
                            </td>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="<?php echo get_post_type_archive_link('car'); ?>" class="cta-button">
                Back to Car Listings
            </a>
        </div>
    </div>
</main>

<script>
function removeFromComparison(carId) {
    var comparison = JSON.parse(localStorage.getItem('car_comparison') || '[]');
    var index = comparison.indexOf(carId);
    if (index > -1) {
        comparison.splice(index, 1);
        localStorage.setItem('car_comparison', JSON.stringify(comparison));
        
        if (comparison.length === 0) {
            window.location.href = '<?php echo get_post_type_archive_link('car'); ?>';
        } else {
            window.location.href = '/compare?cars=' + comparison.join(',');
        }
    }
}
</script>

<?php get_footer(); ?>