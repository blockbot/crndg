<?php

get_header(); 

?>

	<nav id="ic-blog-categories" class="clearfix">

		<?php include("partials/blog-nav.php"); ?>

	</nav>	

	<div id="ic-blog-posts">

		<h2 id="heading-search-results">Search Results: </h2>

		<?php
		global $wp_query;
		$total_results = $wp_query;
		?>

		<?php if ( $total_results->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $total_results->have_posts() ) : $total_results->the_post(); ?>	

			<div class="ic-post clearfix">

				<?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'blog_feed'); ?>
				<img class="lazy" data-original="<?php echo $featured_image[0]; ?>" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" width="250" height="250">

				<div class="ic-post-content">

					<h2><?php the_title(); ?></h2>

					<?php the_excerpt(); ?>

					<a href="<?php the_permalink(); ?>" class="clear btn-read-more">Read More</a>

				</div>


			</div>	

			<?php endwhile; ?>
			<!-- end of the loop -->

			<?php wp_reset_postdata(); ?>

		<?php else: ?>

			<div class="ic-post clearfix">

				<div class="ic-post-content">

					<h2>Sorry, no results.</h2>

				</div>

			</div>	

		<?php endif; ?>

		<div class="next-posts">	
    		<?php next_posts_link('') ?>
		</div>

	</div>	

<?php get_footer(); ?>	