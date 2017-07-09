<?php
get_header();
?>
<?php slowalk_before_content(); ?>
<?php
while ( have_posts() ) : the_post();
	slowalk_before_post();?>
	<div class="page-content">
		<section class="section">
			<div class="section-content">
				<?php the_content();?>
			</div>
			<?php slowalk_edit_post_link( true ); ?>
		</section>
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
		<li><a class="section-title-link scroll-animate" href="#overview">Overview</a></li>
		<li><a class="section-title-link scroll-animate" href="#design">Design</a></li>
		<li><a class="section-title-link scroll-animate" href="#code">Code</a></li>
	</ul>
</aside>
<?php
get_footer();
