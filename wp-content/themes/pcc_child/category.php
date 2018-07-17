<?php get_header('category'); ?>
<div class="container-fluid no-padding">
	<div class="row">
		<div class="col-lg-9">
			<div class="row no-gutters">
				<?php
				// the start of the loop
				if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="col-lg-6">
					<div class="image_wrap">
						<?php the_post_thumbnail('full', ['class' => 'img-fluid']);?>
						<div class="overlay"></div>
						<div class="archive_container">
							<p class="archive_blog_title">
								<?php the_title(); ?>
							</p>
							<div class="archive_blog_content">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="archive_read_more">Read More</a>
						</div>
					</div>
				</div>
				<?php
				// end of the loop
					endwhile;
				else:
					endif;
				?>
			</div>
		</div>
		<?php include('sidebar-archive.php'); ?>
	</div>
</div>


<?php get_footer();?>
