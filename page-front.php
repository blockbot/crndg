<!-- 
	Template Name: Front 
-->

<?php get_header(); ?>

<?php
	$home_id = get_id_by_slug("home");
	$hero_bgs = get_field('hero_backgrounds', $home_id);
	$random_int = rand(0, count($hero_bgs) - 1);
?>

<div class="jumbotron ic-hero lazy" 
	 data-original="<?php echo $hero_bgs[$random_int]['hero_image']['url']; ?>" 
	 style="background-image: url('<?php bloginfo("template_url"); ?>/img/lazy.gif');">

	
	<div class="container">

		<?php 
			$hero_title = get_field('hero_title', $home_id);
			$hero_subtext = get_field('hero_subtext', $home_id);
		?>

		<h1 style="color: <?php echo $hero_bgs[$random_int]['hero_text_color']; ?>;"><?php echo $hero_title; ?></h1>
		<p style="color: <?php echo $hero_bgs[$random_int]['hero_text_color']; ?>;"><?php echo $hero_subtext; ?></p>

	</div>

</div>

<div id="us" class="container-fluid ic-section ic-section-gray">

	<div class="container">

		<div class="row">

			<?php 
				$three_columns_details = get_field('three_columns_details', $home_id);
			?>

			<?php foreach($three_columns_details as $column_details): ?>

				<div class="col-md-4">

					<h2><?php echo $column_details['three_column_title']; ?></h2>

					<p>
						<?php echo $column_details['three_column_body']; ?>
					</p>

				</div>

			<?php endforeach; ?>
		
		</div>

	</div>

</div>

<div id="team" class="container-fluid ic-section">

	<div class="container">

		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
				$args = array( 
				'post_type' => 'team',
				'posts_per_page' => 10,
				'order' => 'ASC'
			);
			// the query
			$wp_query -> query($args);
			$pos = false;
		?>

		<?php if($wp_query->have_posts()): ?>

			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<div class="row">

					<div class="col-md-5 <?php echo ($pos ? "pull-right": "") ?>">

						<div class="scrollme">

							<div class="image-contain animateme"
								 data-when="enter"
								 data-from="1"
								 data-to="0"
								 data-translatex="<?php echo (!$pos ? "-": "") ?>500">

								<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
								<img class="lazy" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $featured_image[0]; ?>">
				
							</div>

						</div>
					</div>

					<div class="col-md-7">

						<?php 
							$work_title = get_field('work_title', $post->ID);
							$social_accounts = get_field('social_accounts', $post->ID);
						?>
						
						<h2><?php the_title(); ?> <small><?php echo $work_title; ?></small></h2>
					
						<?php the_content(); ?>

						<?php if($social_accounts): ?>

							<?php foreach($social_accounts as $social_account => $account): ?>

								<a href="http://www.<?php echo key($account); ?>.com/<?php echo $account[key($account)]; ?>" class="btn-<?php echo key($account); ?>" target="_blank"></a>
						
							<?php endforeach; ?>

						<?php endif; ?>
					
					</div>
				
				</div>

				<?php 

					if($pos){
						$pos = false;
					} else {
						$pos = true;
					}

				?>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	</div>

</div>

<div id="what-we-do" class="container-fluid ic-section ic-section-border-top ic-section-no-padding">

	<div id="ic-carousel" class="carousel slide" data-ride="carousel">

		<ol class="carousel-indicators">

			<?php 
				$slider = get_field('slider', $home_id);
				$slider_i = 1;
			?>

			<?php foreach ($slider as $slide): ?>

				<li data-target="#ic-carousel" data-slide-to="<?php echo ($slider_i - 1); ?>" class="<?php echo ($slider_i == 1 ? "active" : ""); ?>"></li>

				<?php $slider_i++; ?>

			<?php endforeach; ?>

		</ol>

		<div class="carousel-inner" role="listbox">
			
			<?php 
				$slider_i = 1;
			?>

			<?php foreach ($slider as $slide): ?>
				
				<?php
					$slide_img = $slide["slider_image"]["url"]; 
				?>

				<div class="item <?php echo ($slider_i == 1 ? "active" : ""); ?>">

					<img class="lazier" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $slide_img; ?>">

					<div class="carousel-caption">
						<h2><?php echo $slide["slider_title"]; ?></h2>
						<p><?php echo $slide["slider_body"]; ?></p>
						<a href="#work-with-us" class="btn btn-primary ic-btn ic-btn-light ic-btn-big ic-scroll-btn">Work With Us</a>		
					</div>
				
				</div>

				<?php $slider_i++; ?>

			<?php endforeach; ?>
		
		</div>

		<a class="left carousel-control" href="#ic-carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		
		<a class="right carousel-control" href="#ic-carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	</div>

</div>

<div id="current-projects" class="container-fluid ic-section ic-section-gray">

	<div class="container">

		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
				$args = array( 
				'post_type' => 'work',
				'category_name' => "Current",
				'posts_per_page' => 10,
				'order' => 'ASC'
			);
			// the query
			$wp_query -> query($args);

		?>

		<nav class="navbar navbar-default navbar-static-top">

			<ul class="nav navbar-nav">

				<?php if($wp_query->have_posts()): ?>

					<?php $work_i = 1; ?>

					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<?php $concat_title = str_replace(array(" ", "."), '-', get_the_title()); ?>
					
						<li class="ic-pill <?php echo ($work_i == 1 ? "active" : ""); ?>" data-project="project-<?php echo $concat_title; ?>"><a href="#"><?php the_title(); ?></a></li>
			
						<?php $work_i++; ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</ul>

		</nav>

		<div class="row">

			<div class="col-md-12">

				<?php if($wp_query->have_posts()): ?>

					<?php $work_i = 1; ?>

					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<?php 
							$concat_title = str_replace(array(" ", "."), '-', get_the_title());
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
						?>
						
						<div class="ic-current-image">

							<img class="lazier project-<?php echo $concat_title; ?> <?php echo ($work_i == 1 ? "active-project" : "hide"); ?>" 
								 src="<?php bloginfo("template_url"); ?>/img/lazy.gif" 
								 data-original="<?php echo $featured_image[0]; ?>">

						</div>

						<div class="overlap ic-project-wfmu project-<?php echo $concat_title; ?> <?php echo ($work_i == 1 ? "active-project" : "hide"); ?>">

							<?php 
								$sub_title = get_field('sub_title', $post->ID);
							?>

							<h2><?php the_title(); ?> <small><?php echo $sub_title; ?></small></h2>

							<?php the_content(); ?>
							
							<p>

								<strong>Tech Highlights:</strong>

								<?php 
									$tech_highlights = get_field('tech_highlights', $post->ID);
									$tech_highlights_count = count($tech_highlights);
									$tech_highlights_i = 1;
								?>
								
								<?php foreach($tech_highlights as $tech_highlight): ?>

									<?php 

										echo $tech_highlight["tech_highlight"]; 
									
										if($tech_highlights_i != $tech_highlights_count){ 
											echo ", "; 
										}

										$tech_highlights_i++; 
									
									?>

								<?php endforeach; ?>

							</p>	

						</div>
				
						<?php $work_i++; ?>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php endif; ?>

			</div>

		</div>

	</div>

</div>

<div id="work-with-us" class="container ic-section">
		
	<header class="center-block">

		<h2 class="section-heading">Want to work with us?</h2>
		<p>First step, say hello.</p>

	</header>

	<!-- <form role="form" data-toggle="validator" class="center-block">

		<div class="form-group has-feedback">
			<label class="control-label" for="ic_first">Name</label>  
			<input id="ic_first" name="ic_first" type="text" placeholder="" class="form-control input-md" required>
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>

		<div class="form-group has-feedback">
			<label class="control-label" for="ic_first">company</label>  
			<input id="ic_first" name="ic_first" type="text" placeholder="" class="form-control input-md" required>
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>


		<div class="form-group has-feedback">
			<label class="control-label" for="ic_email">Email</label>  
			<input id="ic_email" name="ic_email" type="email" placeholder="" class="form-control input-md" required>
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>			  	
		</div>

		<div class="form-group">
		  	<label class="control-label" for="textarea">Message</label>
				<textarea class="form-control" id="textarea" name="textarea" required></textarea>
		</div>

		<button type="submit" class="btn btn-primary btn-lg btn-register ic-btn ic-btn-dark">Submit</button>

	</form>
 -->
	<?php echo do_shortcode('[contact-form-7 id="348" html_id="ic-contact" html_class="center-block"]'); ?>

</div>

<div id="blog" class="container ic-section ic-section-border-top">

	<h2 class="section-heading">From The Blog <a href="/blog" class="btn btn-primary ic-btn ic-btn-dark">See All Posts</a></h2>

	<div class="featured-post">
			
		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
				$args = array( 
				'post_type' => 'post',
				'posts_per_page' => 1
			);
			// the query
			$wp_query -> query($args);
		?>

		<?php if($wp_query->have_posts()): ?>
			
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<div class="img-container">
					<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
					<img class="lazier" src="<?php bloginfo("template_url"); ?>/img/lazy.gif" data-original="<?php echo $featured_image[0]; ?>">
				</div>

				<div class="post-content">

					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php the_excerpt(); ?>

					<a href="<?php the_permalink(); ?>" class="btn btn-primary ic-btn ic-btn-dark">Read More</a>				

				</div>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	</div>
			
</div>

<?php get_footer(); ?>	