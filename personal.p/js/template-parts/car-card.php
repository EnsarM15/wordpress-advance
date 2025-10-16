<?php
/**
 * Template part for displaying car cards
 *
 * @package AutoDealer_Pro
 */

$car_id = get_the_ID();
$price = get_post_meta($car_id, 'car_price', true);
$mileage = get_post_meta($car_id, 'car_mileage', true);
$engine = get_post_meta($car_id, 'car_engine', true);
$transmission = get_post_meta($car_id, 'car_transmission', true);
$fuel_type = get_post_meta($car_id, 'car_fuel_type', true);
$exterior_color = get_post_meta($car_id, 'car_exterior_color', true);

// Get car make and model
$makes = get_the_terms($car_id, 'car_make');
$models = get_the_terms($car_id, 'car_model');
$years = get_the_terms($car_id, 'car_year');
$conditions = get_the_terms($car_id, 'car_condition');

$make_name = ($makes && !is_wp_error($makes)) ? $makes[0]->name : '';
$model_name = ($models && !is_wp_error($models)) ? $models[0]->name : '';
$year = ($years && !is_wp_error($years)) ? $years[0]->name : '';
$condition = ($conditions && !is_wp_error($conditions)) ? $conditions[0]->name : '';

$car_title = trim($year . ' ' . $make_name . ' ' . $model_name);
if (empty($car_title)) {
    $car_title = get_the_title();
}
?>

<article class="car-card">
    <div class="car-image">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
        <?php else : ?>
            <span>No Image Available</span>
        <?php endif; ?>
        
        <div class="price-badge">
            <?php echo format_car_price($price); ?>
        </div>
        
        <?php if ($condition) : ?>
            <div class="condition-badge" style="position: absolute; top: 15px; left: 15px; background: #28a745; color: white; padding: 5px 10px; border-radius: 15px; font-size: 0.8rem;">
                <?php echo esc_html($condition); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="car-info">
        <h3 class="car-title">
            <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                <?php echo esc_html($car_title); ?>
            </a>
        </h3>
        
        <div class="car-details">
            <?php if ($mileage) : ?>
                <div class="car-feature">
                    <span>🏃</span>
                    <span><?php echo format_car_mileage($mileage); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if ($engine) : ?>
                <div class="car-feature">
                    <span>⚙️</span>
                    <span><?php echo esc_html($engine); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if ($transmission) : ?>
                <div class="car-feature">
                    <span>🔧</span>
                    <span><?php echo esc_html($transmission); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if ($fuel_type) : ?>
                <div class="car-feature">
                    <span>⛽</span>
                    <span><?php echo esc_html($fuel_type); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if ($exterior_color) : ?>
                <div class="car-feature">
                    <span>🎨</span>
                    <span><?php echo esc_html($exterior_color); ?></span>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (has_excerpt()) : ?>
            <p style="margin: 1rem 0; color: #666; font-size: 0.9rem;">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </p>
        <?php endif; ?>
        
        <a href="<?php the_permalink(); ?>" class="view-details">View Details</a>
    </div>
</article>