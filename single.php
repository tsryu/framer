<?php
get_header();
slowalk_before_content(); ?>

<?php
while ( have_posts() ) : the_post(); ?>
  
	<?php 
	slowalk_before_post();
	slowalk_page_header(); ?>

		<header class="entry-header">
			<h1 class="entry-title">
				<?php slowalk_the_title(); ?>
			</h1>
			<div class="entry-meta">
				<?php //slowalk_entry_meta( 'category' ); ?>
				<?php slowalk_entry_meta( 'date' ); ?>
				<?php //slowalk_entry_meta( 'author' ); ?>
				<?php //slowalk_edit_post_link( false ); ?>
			</div>
		</header>
		<?php //slowalk_post_thumbnail(); ?><!-- a.post-thumbnail -->
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php if ( has_tag() ) : ?>
			<div class="entry-meta">
				<span class="tag-links"><?php the_tags('', ' ', ''); ?></span>
			</div>
		<?php endif; ?>
	
	<?php slowalk_after_post();

  //slowalk_post_nav();
endwhile;
?>

<?php
slowalk_after_content();
get_footer();