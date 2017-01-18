<?php get_header(); ?>

<div id="content">

	<button id="btn-show-more-info">Details</button>

	<div id="more-info">

		<div class="container-fluid">

			<div class="col-md-8">

				<h2><small></small></h2>

				<div class="project-description"></div>

			</div>

			<div class="col-md-4">

				<h3>Tech</h3>

				<ul></ul>

				<a href="" target="_blank"></a>

			</div>

		</div>

	</div>

	<?php
		$work_index = 1;
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

	<ul id="timeline">

		<li class="work-highlights timeline-date">
			Work Highlights
		</li>

		<?php if($wp_query->have_posts()): ?>

			<?php $current_date = null; ?>

			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php $post_date = get_the_date('Y'); ?>

				<?php if($current_date != $post_date): ?>

					<?php $current_date = get_the_date('Y'); ?>

					<li class="timeline-date">
						<?php echo ($current_date == "2015" ? "2012 - 2015" : $current_date); ?>
					</li>

					<?php endif; ?>

				<li>

					<?php
						$title_string = get_the_title($post->ID);
						$clean_title = strtolower(str_replace(" ", "-", $title_string));
					?>

					<a href="#<?php echo $clean_title; ?>" data-slide-id="<?php echo $clean_title; ?>" data-timeline-id="<?php echo $post->ID; ?>"><?php the_title(); ?></a>

				</li>

			<?php endwhile; ?>

		<?php endif; ?>

	</ul>

	<div id="about" class="container-fliud">

		<div class="about-content">

			<h2>Hi, my name is Joey Dehnert.<br> I am a Senior Software Engineer, based in NYC.</h2>

		</div>

	</div>

	<div id="work" class="container-fluid">

		<?php if($wp_query->have_posts()): ?>

			<?php $current_date = null; ?>

			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php
					$title_string = get_the_title($post->ID);
					$clean_title = strtolower(str_replace(" ", "-", $title_string));
				?>

				<div id="<?php echo $clean_title; ?>" class="work-item" data-index="<?php echo $work_index; ?>" data-work-id="<?php echo $post->ID; ?>">

					<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
					<div class="col-md-12 img-contain lazy" data-original="<?php echo $featured_image[0]; ?>" style="background-image: url('<?php bloginfo("template_url"); ?>/img/lazy.gif');">

<!-- 						<div class="row">
							<img class="lazy" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $featured_image[0]; ?>">
						</div> -->

					</div>

					<div class="col-md-12 not-desktop-content">

						<?php
							$project_short_description = get_field("project_short_description", $project_id);
							$project_details = get_field("project_details", $project_id);
							$project_link = get_field("project_link", $project_id);
						?>

						<h2><?php the_title(); ?> <small><?php echo $project_short_description; ?></small></h2>

						<?php the_content(); ?>

						<h3>Tech</h3>

						<ul>

							<?php foreach($project_details as $detail): ?>

								<li><?php echo $detail["project_tech"]; ?></li>

							<?php endforeach; ?>

						</ul>

						<a href="<?php echo $project_link ?>"><?php echo $project_link ?></a>

					</div>

				</div>

				<?php $work_index++; ?>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

		<div id="advance-contain">
            <button class="btn-advance-arrow"></button>
        </div>
	</div>

</div>

<?php get_footer(); ?>
