<?php /* Template Name: Subscriptions */get_header('subscribe');?>
<section class="subscriptions">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <?php echo do_shortcode('[gravityform id=3]');?>
      </div>
      <?php include('sidebar-ad2.php'); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
