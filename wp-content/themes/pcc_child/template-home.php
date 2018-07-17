<?php /* Template Name: Home Page*/get_header('home');?>
<div class="magazine_event">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
            <?php echo do_shortcode('[magazine]');?>
            <?php echo do_shortcode('[event]');?>
        </div>
      </div>
    </div>
  </div>
</div>
</html>
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12 main">
        <div class="what_about">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12"><img class="img-fluid about_img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/sunsetfield.jpg"></div>
            <div class="col-lg-7 col-md-6 col-sm-12">
              <h2>What is Progressive Crop Consultant</h2>
              <p>As the demand for efficient agriculture practices continues to become more important in our industry, the need for key resources and solutions becomes critical. Progressive Crop Consultant was designed to help today’s crop consultant become more aware and informed of information that will help move California specialty crops forward. Progressive Crop Consultant is a six time a year publication that prints every other month. Our goal at JCS Marketing is to produce the highest quality publications that promote note-worthy editorial with information on best practices, new research, and tools/innovations for the top specialty crops in California.</p>
            </div>
          </div>
        </div>
      </div>
      <?php include('sidebar-ads.php'); ?>
    </div>
</section>
<!-- <section class="teaching">
<div class="container">
  <div class="row">
    <div class="col-lg-7">
      <h2>Need PCA Credits?</h2>
      <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit, erat non convallis facilisis.</p><a href="#">Start Today</a>
    </div>
  </div>
</div>
</section> -->
<section class="blog">
<h2 class="text-center main_blog_header">Whats Happening Around The Farm</h2>
<?php
$args = [
  'post_type' => 'post',
  'posts_per_page' => 5,
  'post_status' => 'publish',
  'order' => 'DESC',
  'orderby' => 'date',
];
?>
<div class="container">
  <div class="row">
    <?php
    $news_query = new WP_Query($args);
    $i = 0;
    if($news_query->have_posts()) : while($news_query->have_posts()) : $news_query->the_post();
    if($i == 0){
    ?>
    <div class="col-lg-6 col-md-12 blog-no-padding">
      <div class="main_cover_image">
        <?php the_post_thumbnail('full', ['class'=> 'img-fluid']); ?>
        <div class="overlay"></div>
        <div class="main_blog_container">
          <p class="main_blog_title"><?php the_title(); ?></p>
          <a class="main_read_more" href="<?php the_permalink(); ?>">Read More</a>
        </div>
      </div>
    </div> <!-- end of big image col -->
    <?php
  }elseif($i == 1){
    ?>
    <div class="col-lg-6 col-md-12">
      <div class="row">
        <div class="col-lg-6 col-md-12 blog-no-padding">
          <div class="sub_cover_image">
            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
            <div class="overlay"></div><!-- overlay -->
            <div class="sub_blog_container">
              <p class="sub_blog_title"><?php the_title(); ?></p>
              <a class="sub_read_more" href="<?php the_permalink();?>">Read More</a>
            </div>
          </div><!-- sub cover image -->
        </div><!-- containt lg6 container -->
        <?php
      }elseif($i == 2){
        ?>
        <div class="col-lg-6 col-md-12 blog-no-padding">
          <div class="sub_cover_image">
            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
            <div class="overlay"></div>
            <div class="sub_blog_container">
              <p class="sub_blog_title"><?php the_title(); ?></p>
              <a class="sub_read_more" href="<?php the_permalink(); ?>">Read More</a>
            </div>
          </div>
        </div>
      </div><!-- row -->

  <?php
}elseif($i == 3){
  ?>
  <div class="row">
    <div class="col-lg-6 col-md-12 blog-no-padding">
      <div class="sub_cover_image">
        <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
        <div class="overlay"></div>
        <div class="sub_blog_container">
          <p class="sub_blog_title"><?php the_title(); ?></p>
          <a class="sub_read_more" href="<?php the_permalink(); ?>">Read More</a>
        </div>
      </div>
    </div>

  <?php
}else{
  ?>
  <div class="col-lg-6 col-md-12 blog-no-padding">
    <div class="sub_cover_image">
      <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
      <div class="overlay"></div>
      <div class="sub_blog_container">
        <p class="sub_blog_title"><?php the_title(); ?></p>
        <a class="sub_read_more" href="<?php the_permalink(); ?>">Read More</a>
      </div>
    </div>
  </div>
  </div>
</div>
  <?php
}$i++;
  endwhile;
  endif;
  wp_reset_postdata();
    ?>
  </div>
  <div class="text-center">
    <a class="blog_button" href="#">Click Me</a>
  </div>

</section>
<section class="advertise text-center">
  <h2 class="advertise_header">Want To Advertise With Us Find Out How</h2>
  <a href="/advertise/" class="advertise_more_info">More Info</a>
  <!-- Button Trigger Modal -->
  <button type="button" class="open-button" data-toggle="modal" data-target="#exampleModal">Request A Media Kit</button>

  <!-- modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.png" alt="" class="img-fluid"></h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body myModal-background">
          <h3 class="text-left modal-media-kit-subheader">Request Our Media Kit</h3>
          <p class="text-left">Please complete the form below to request our media kit. If you prefer to speak with someone regarding immediate marketing needs, please call 702-467-6394.</p>
          <?php echo do_shortcode('[gravityform id=1]');?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="sponsors">
  <h2>2017 Sponsors</h2>
  <?php echo do_shortcode('[carousel]');?>
</section>
<?php get_footer(); ?>
