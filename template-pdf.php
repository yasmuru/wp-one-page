<?php
/**
 * Template Name: PDF
 */
get_header();?>

<div class="document-page">
<?php
while( have_posts() ) : the_post();
	echo the_content();
endwhile;
?>
</div>
<?php
get_footer();