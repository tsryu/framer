<?php
get_header();
?>
<?php slowalk_before_content(); ?>
<?php
while ( have_posts() ) : the_post();
	slowalk_before_post();?>
	<div class="page-content">
		<?php the_content();?>
		<?php if(is_user_logged_in()):?><div class="edit-link text-right"><a class="post-edit-link" href="/wp-admin/post.php?post=<?php echo get_the_ID();?>&amp;action=edit">편집</a></div><?php endif; ?>
	</div>
	<?php 
	slowalk_after_post();
endwhile;
?>
<?php
slowalk_after_content();
?>
<aside class="site-sidebar">
	<ul class="anchor-link">
		<li><a class="section-title-link" href="#overview">Overview</a></li>
		<li><a class="section-title-link" href="#design">Design</a></li>
		<li><a class="section-title-link" href="#code">Code</a></li>
	</ul>
</aside>
<?php
get_footer();
