<?php get_search_form(); ?>

<p>Blog Categories: </p>

<?php if(is_home()): ?>

	<span class="active"><a href="<?php bloginfo("url") ?>/blog/" class="active">All</a></span>

<?php else: ?>

	<a href="<?php bloginfo("url") ?>/blog/" class="active">All</a>

<?php endif; ?>

<?php 

$args = array(
	'type' => 'post',
	'style' => '',
	'title_li' => '',
	'hide_empty' => 1,
	'echo' => 0
); 
$categories = wp_list_categories($args);
$categories_array = explode ("<br />", $categories);
$categories_labels = getTextBetweenTags('a', $categories);

?>

<?php for($i = 0; $i < (count($categories_array) - 1); $i++): ?>

	<?php if($categories_labels[$i] == single_cat_title('', false)): ?>

		<span class="active">

			<?php echo $categories_array[$i]; ?>

		</span>

	<?php else: ?>
	
		<?php echo $categories_array[$i]; ?>

	<?php endif; ?>

<?php endfor; ?>