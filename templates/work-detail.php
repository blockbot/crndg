<?php 
	$work_id = $_GET['id'];
	$work = get_post($work_id);
	$work_date = get_the_date("Y", $work_id);

	$project_details = get_field('project_details', $work_id);

?>

<div id="work-item-expanded" class="container">

	<div class="row">

		<div class="col-md-11">
			<h2><?php echo $work->post_title; ?></h2>
		</div>

		<div class="col-md-1">
			<a href="/#<?php echo $work_date; ?>" class="btn btn-default btn-back">Back</a>
		</div>

	</div>

	<div class="row">
		
		<div class="col-md-12">

			<p>
				<?php echo $work->post_content; ?>
			</p>

		</div>

		<div class="col-md-12">

			<p>

				<?php $project_tech = $project_details[0]["project_tech"]; ?>

				<?php 

					$tech_index = 1;

					foreach ($project_tech as $item){

						if($tech_index == count($project_tech)){

							echo $item["project_tech_item"];

						} else { 

							echo $item["project_tech_item"] . ", ";

						}
					
						$tech_index++;

					}

				?>

			</p>

		</div>

	</div>

	<div class="row">
		
		<div class="col-md-12">

			<?php $project_media = $project_details[0]["project_media"]; ?>

			<?php foreach ($project_media as $item): ?>

				<div class="panel panel-default">

				  	<div class="panel-body">
				   		
				   		<?php if(!empty($item["project_image"])): ?>

				   			<img src="<?php echo $item["project_image"]["sizes"]["large"]; ?>">

						<?php endif; ?>

						<?php if(!empty($item["project_video"])): ?>

							<div class="embed-responsive embed-responsive-16by9">
								<?php echo $item["project_video"]; ?>
							</div>

						<?php endif; ?>

				  	</div>

				 	<div class="panel-footer">

				 		<?php echo $item["project_media_copy"]; ?>

				 	</div>
				
				</div>

			<?php endforeach; ?>

		</div>
	
	</div>

</div>