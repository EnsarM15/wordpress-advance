<?php





get_header();?>

<main id="main" class="site-main" role="main">
<h1><?php thr_archive_title()?></h1>

  <ul>
    <?php wp_list_categories(
        array('title_li' => '',));?>
    
  </ul>
  <?php if(have_posts()):while (have_posts()): the_posts():?>

    <?php endwhile;?>

    <div class="pagination">
        <?php
        the_posts_pagination(
            array(
                'mid_size'=>2,
                'prev_text'=>_('<<prev', 'textdomain'),
                'next_text'=>_('next >>','textdomain'),

            )
        )
        ?>


    </div>

    <?php else :?>
        <p><?php _e('no posts found.')?></p>
        <?php endif :?>
</main>



<?php get_footer()?>