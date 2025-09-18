<?php 

$unique_id = esc_attr( uniqid( 'search-form-' ) );

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/'));?>">
    <label class="screen-reader-text" for="<?php echo $unique_id; ?>"><?php _e('Search for:', 'textdomain'); ?></label>
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'textdomain'); ?>" 
             value="<?php echo get_search_query(); ?>" name="s" />
             <input type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'your-textdomain'); ?>" />
             

    
</form>