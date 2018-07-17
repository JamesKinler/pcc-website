<?php get_header('magazine'); ?>
<section class="magazine_archive">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9">
        <div class="row">
          <?php if(have_posts()) : while(have_posts()) : the_post();?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 margin-class">
              <?php the_content(); ?>
            </div>

          <?php endwhile; ?>
        </div>
      </div>
      <div class="col-lg-3">
        <?php include 'sidebar-archive.php'?>
      </div>
          <?php jk_numeric_posts_nav(); ?>
          <?php else : ?>
        <div class="row">
          <div class="col-lg-12 number_magazine_archive">
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          </div>
        </div>
          <?php endif;?>
      </div>
    </div>
</section>
<?php get_footer(); ?>
