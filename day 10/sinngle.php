<?php get_heaader(); ?>

<?php if (have posts()) :while (have_posts());
the_post(); ?>
<div class="post">
   <div row="">
    <div class="col-md-8">
    <article><?php post_class('single')?>
    id='posts'-<?php the ID();?>
    
    <header class="mb-3">
        <h1 class="mb-1"><?php the_title(); ?></h1>
        <small class="text-nyted d-block mb-2">

        Posted on: <?php the_time('F j, Y');?>  at 
        <?php the_time('g:i a'); ?>,
        in <?php the_category(',')?>
        <?php 
        $tags_list - get_the_tag_list('<span class-"ms-2> Tags:', ',',' </span');
        if($tags_list){
            echo $tags_list;


        } 
        ?>    
     </small>


    </header>
    </div>
   </div>
</div>
