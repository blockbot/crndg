<?php get_header(); ?>

<div class="container">

	<?php while (have_posts()) : the_post(); ?>  	

		<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<img class="lazy" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $featured_image[0]; ?>">

		<div id="single-post" data-post-id="<?php echo $post->ID; ?>">

			<div class="post-content">

				<h2><?php the_title();?></h2>
				<p class="author-date"><?php the_author() ?> | <?php the_date(); ?>

				<?php the_content(); ?>	
			
			</div>

		</div>

	<?php endwhile;?>

</div>

<?php get_footer(); ?>	