<?php get_header(); ?>

<div id="about" class="container">

	<div class="col-md-12">

		<h1>Portfolio and Sandbox for Software Engineer <a href="http://joeydehnert.com" target="_blank">Joey Dehnert</a>.</h1>

	</div>

</div>

<div id="work" class="container">

	<?php
		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
			$args = array( 
			'post_type' => 'work',
			'posts_per_page' => -1,
			'order' => 'DESC'
		);
		// the query
		$wp_query -> query($args);
	?>

	<?php if($wp_query->have_posts()): ?>

		<?php $current_date = null; ?>

		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<?php 

				$post_date = get_the_date('Y');
				if($current_date != $post_date):
			
			?>

				<?php $current_date = get_the_date('Y'); ?>
				
				<h2 class="section-heading clear"><?php echo $current_date; ?></h2>

			<?php endif; ?>

			<div class="col-md-4">

				<div class="img-contain">

					<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
					<img class="lazy" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $featured_image[0]; ?>">

				</div>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			</div>

		<?php endwhile; ?>
		
		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

</div>

<?php get_footer(); ?>