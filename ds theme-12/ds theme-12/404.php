<?php

get_header();?>

<main id="main" class="site-main" role="main">
    <section class="error-404 not-found">
     <h1><?php _e("oops that page cant be found","your-textdomain");?>
     </h1>

     <p><?php _e('it looks like nothing was found. try a  search?'.'your-textdomain');?>
     </p>
    <?php get_search_form();?>
    </section>
</main>

<?php get_footer()?>