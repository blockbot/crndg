<?php get_header(); ?>

<div class="generic-content container">

	<?php while (have_posts()) : the_post(); ?>

		<div class="ic-post clearfix">

			<div class="ic-post-content">

				<h2><?php the_title(); ?></h2>

				<?php the_content(); ?>

			</div>

		</div>	

	<?php endwhile; ?>

</div>

<?php get_footer(); ?>