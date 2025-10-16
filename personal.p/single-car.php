<?php
/**
 * The template for displaying single car posts
 *
 * @package AutoDealer_Pro
 */

get_header();

while (have_posts()) :
    the_post();
    
    $car_id = get_the_ID();
    $price = get_post_meta($car_id, 'car_price', true);
    $mileage = get_post_meta($car_id, 'car_mileage', true);
    $engine = get_post_meta($car_id, 'car_engine', true);
    $transmission = get_post_meta($car_id, 'car_transmission', true);
    $fuel_type = get_post_meta($car_id, 'car_fuel_type', true);
    $exterior_color = get_post_meta($car_id, 'car_exterior_color', true);
    $interior_color = get_post_meta($car_id, 'car_interior_color', true);
    $vin = get_post_meta($car_id, 'car_vin', true);
    $features = get_post_meta($car_id, 'car_features', true);
    
    // Get taxonomies
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

<main id="primary" class="site-main">
    <div class="container" style="padding: 2rem 20px;">
        
        <!-- Breadcrumb -->
        <nav class="breadcrumb" style="margin-bottom: 2rem; font-size: 0.9rem; color: #666;">
            <a href="<?php echo home_url(); ?>">Home</a> > 
            <a href="<?php echo get_post_type_archive_link('car'); ?>">Cars</a> > 
            <span><?php echo esc_html($car_title); ?></span>
        </nav>
        
        <article class="car-single">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 3rem;">
                
                <!-- Car Images -->
                <div class="car-images">
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: 1rem;">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: 400px; object-fit: cover; border-radius: 10px;')); ?>
                        </div>
                    <?php else : ?>
                        <div style="width: 100%; height: 400px; background: linear-gradient(45deg, #ddd, #eee); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #666; font-size: 1.2rem;">
                            No Image Available
                        </div>
                    <?php endif; ?>
                    
                    <!-- Additional images placeholder -->
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;">
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <div style="height: 80px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #999;">
                                View <?php echo $i; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <!-- Car Details -->
                <div class="car-details-main">
                    <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;"><?php echo esc_html($car_title); ?></h1>
                    
                    <?php if ($condition) : ?>
                        <div style="display: inline-block; background: #28a745; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; margin-bottom: 1rem;">
                            <?php echo esc_html($condition); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div style="font-size: 3rem; font-weight: bold; color: #ff6b35; margin-bottom: 2rem;">
                        <?php echo format_car_price($price); ?>
                    </div>
                    
                    <!-- Key Specifications -->
                    <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1rem; color: #333;">Key Specifications</h3>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            <?php if ($mileage) : ?>
                                <div><strong>Mileage:</strong> <?php echo format_car_mileage($mileage); ?></div>
                            <?php endif; ?>
                            <?php if ($engine) : ?>
                                <div><strong>Engine:</strong> <?php echo esc_html($engine); ?></div>
                            <?php endif; ?>
                            <?php if ($transmission) : ?>
                                <div><strong>Transmission:</strong> <?php echo esc_html($transmission); ?></div>
                            <?php endif; ?>
                            <?php if ($fuel_type) : ?>
                                <div><strong>Fuel Type:</strong> <?php echo esc_html($fuel_type); ?></div>
                            <?php endif; ?>
                            <?php if ($exterior_color) : ?>
                                <div><strong>Exterior Color:</strong> <?php echo esc_html($exterior_color); ?></div>
                            <?php endif; ?>
                            <?php if ($interior_color) : ?>
                                <div><strong>Interior Color:</strong> <?php echo esc_html($interior_color); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Contact Buttons -->
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                        <button style="background: #ff6b35; color: white; border: none; padding: 15px 25px; border-radius: 5px; font-size: 1.1rem; font-weight: bold; cursor: pointer; flex: 1;">
                            📞 Call Now
                        </button>
                        <button style="background: #28a745; color: white; border: none; padding: 15px 25px; border-radius: 5px; font-size: 1.1rem; font-weight: bold; cursor: pointer; flex: 1;">
                            ✉️ Email Dealer
                        </button>
                        <button style="background: #007bff; color: white; border: none; padding: 15px 25px; border-radius: 5px; font-size: 1.1rem; font-weight: bold; cursor: pointer; flex: 1;">
                            📅 Schedule Test Drive
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Car Description and Features -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
                <div>
                    <?php if (get_the_content()) : ?>
                        <section style="margin-bottom: 3rem;">
                            <h2 style="color: #333; margin-bottom: 1rem;">Description</h2>
                            <div style="line-height: 1.8; color: #555;">
                                <?php the_content(); ?>
                            </div>
                        </section>
                    <?php endif; ?>
                    
                    <?php if ($features) : ?>
                        <section>
                            <h2 style="color: #333; margin-bottom: 1rem;">Features & Options</h2>
                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem;">
                                <?php
                                $features_array = get_car_features_array($features);
                                foreach ($features_array as $feature) :
                                ?>
                                    <div style="background: #f8f9fa; padding: 0.5rem 1rem; border-radius: 5px; display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="color: #28a745;">✓</span>
                                        <span><?php echo esc_html($feature); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                
                <!-- Sidebar -->
                <div>
                    <!-- Contact Form -->
                    <div style="background: #333; color: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                        <h3 style="color: #ff6b35; margin-bottom: 1rem;">Interested in this car?</h3>
                        <form style="display: flex; flex-direction: column; gap: 1rem;">
                            <input type="text" placeholder="Your Name" style="padding: 0.75rem; border: none; border-radius: 5px;" required>
                            <input type="email" placeholder="Your Email" style="padding: 0.75rem; border: none; border-radius: 5px;" required>
                            <input type="tel" placeholder="Your Phone" style="padding: 0.75rem; border: none; border-radius: 5px;">
                            <textarea placeholder="Message" rows="4" style="padding: 0.75rem; border: none; border-radius: 5px; resize: vertical;"></textarea>
                            <button type="submit" style="background: #ff6b35; color: white; border: none; padding: 0.75rem; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                Send Inquiry
                            </button>
                        </form>
                    </div>
                    
                    <!-- Vehicle Information -->
                    <?php if ($vin) : ?>
                        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px;">
                            <h4 style="margin-bottom: 1rem; color: #333;">Vehicle Information</h4>
                            <div style="font-size: 0.9rem; color: #666;">
                                <div style="margin-bottom: 0.5rem;"><strong>VIN:</strong> <?php echo esc_html($vin); ?></div>
                                <div style="margin-bottom: 0.5rem;"><strong>Stock #:</strong> #<?php echo str_pad($car_id, 6, '0', STR_PAD_LEFT); ?></div>
                                <div><strong>Listed:</strong> <?php echo get_the_date(); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        
        <!-- Related Cars -->
        <section style="margin-top: 4rem;">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">Similar Vehicles</h2>
            <div class="cars-grid">
                <?php
                $related_args = array(
                    'post_type' => 'car',
                    'posts_per_page' => 3,
                    'post__not_in' => array($car_id),
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'car_price',
                            'value' => array($price - 10000, $price + 10000),
                            'compare' => 'BETWEEN',
                            'type' => 'NUMERIC'
                        )
                    )
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                        get_template_part('template-parts/car', 'card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p style="text-align: center; color: #666;">No similar vehicles found.</p>';
                endif;
                ?>
            </div>
        </section>
    </div>
</main>

<?php
endwhile;
get_footer();
?>