<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="text" placeholder="Search Blog" name="s" id="search" value="<?php the_search_query(); ?>">
	<input type="hidden" name="post_type" value="post" />
</form>