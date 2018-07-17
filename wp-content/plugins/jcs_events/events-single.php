<?php get_header(); ?>
<section class="events_single_page">
  <div class="container">
    <div class="row">
      <div class="col l12">
        <?php if(have_posts()) : while(have_posts()) : the_post();?>
        <?php the_post_thumbnail('full', ['class' => 'responsive-img']); ?>
        <div><?php the_content(); ?></div>
        <?php endwhile;endif;?>
      </div>
    </div>
  </div>
</section>
<?php get_footer();?>
