<?php
get_header();
slowalk_before_content(); ?>

<?php
while ( have_posts() ) : the_post();
  
	slowalk_before_post();

	slowalk_page_header(); ?>

	<div class="page-content">
		<h1>준비중입니다</h1>
	  <?php //the_content(); ?>
	  <?php slowalk_edit_post_link( true ); ?>
	</div>

	<?php 
	slowalk_after_post();

endwhile;
?>

<?php
slowalk_after_content();
get_footer();
