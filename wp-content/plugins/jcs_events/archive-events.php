<?php get_header();?>
<section class="event_archive">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          <?php if(have_posts()):while(have_posts()):the_post();?>
          <div class="row">
            <a href="<?php the_permalink(); ?>">
              <div class="col l6 archive_event_image">
                <?php the_post_thumbnail('full', ['class' => 'responsive-img']);?>
              </div>
              <div class="col l6 event_archive_content">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
              </div>
            </a>
          </div>
          <hr>
          <?php endwhile;endif; ?>
      </div>
    </div>
  </div>
</section>
<?php get_footer();?>
