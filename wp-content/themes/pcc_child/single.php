
<?php get_header('blog'); ?>
<section class="blog_content">
	<div class="container">
    <div class="row">
      <div class="col-lg-9">
				<div class="row">
					<div class="col-lg-11">
						<?php while(have_posts()) : the_post(); ?>
						<?php the_post_thumbnail('full', ['class' => 'img-fluid']);?>
						<h1 class="blog-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<?php if(comments_open() || get_comments_number()) : comments_template();
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
      <?php include('sidebar-ad2.php'); ?>
    </div>
	</div>
	<div class="container">
		<h2>Other Topics You Might Like</h2>
		<div class="row">
			<?php
			$tags = wp_get_post_terms( get_queried_object_id(), 'category', ['fields' => 'ids'] );
			$args = [
					'post__not_in'        => array( get_queried_object_id() ),
					'posts_per_page'      => 4,
					'orderby'             => 'rand',
					'tax_query' => [
							[
									'taxonomy' => 'category',
									'terms'    => $tags
							]
					]
			];
			$my_query = new WP_Query( $args );
			if( $my_query->have_posts()) : while( $my_query->have_posts()) : $my_query->the_post(); ?>
				<div class="col-lg-3">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('full', ['class' => 'img-fluid other-topics-featured']); ?>
						<p class="headline_topics"><?php the_title(); ?></p>

					</a>
				</div>
			 <?php
				wp_reset_postdata();
				endwhile;
				else:
				endif;
			?>
		</div>
		<?php endwhile; ?>
	</div>
</section>


<?php get_footer(); ?>
