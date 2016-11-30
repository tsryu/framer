<?php
get_header();
slowalk_before_content(); ?>

<?php
while ( have_posts() ) : the_post();
  
	slowalk_before_post();

	slowalk_page_header(); ?>

	<div class="page-content" ng-controller="getStarted">
	  <?php 
			// $args_main = array (
			// 	'post_type'             => 'get_started',
			// 	'posts_per_page'        => '-1',
			// 	'order'					=> 'DESC'
			// );

			// $query_main = new WP_Query( $args_main );

			// if ( $query_main->have_posts() ) : 
			// 	while ( $query_main->have_posts() ) : $query_main->the_post(); ?>
			 		<!--section id="<?php $post_slug=$post->post_name; echo $post_slug?>" class="section">
			 			<h1 class="section-title"><?php the_title();?></h1>
			 			<?php the_content();?>
			 			<?php slowalk_edit_post_link( true ); ?>
			 		</section-->
			 		<?php
			// 	endwhile;
			// else :
			// 	echo '<div class="empty">준비중입니다.</div>';
			// endif; 
			// wp_reset_query();
		?>
		<section ng-repeat="post in posts" id="" class="section">
			<h1 class="section-title">{{post.title.rendered}}</h1>
			{{post.content}}
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
  <?php 
	$args_sub = array (
		'post_type'             => 'get_started',
		'posts_per_page'        => '-1',
		'order'					=> 'DESC',
		// 'tax_query' => array(
		// 	array(
		// 		'taxonomy' => 'mainbanner_area',
		// 		'field' => 'slug',
		// 		'terms' => 'main'
		// 	)
		// )
	);

	$query_sub = new WP_Query( $args_sub );

	if ( $query_sub->have_posts() ) : 
		while ( $query_sub->have_posts() ) : $query_sub->the_post(); ?>
				<li><a class="section-title-link" href="#<?php $post_slug=$post->post_name; echo $post_slug?>"><?php the_title();?></a></li>
			<?php
		endwhile;
	else :
		echo '<div class="empty">준비중입니다.</div>';
	endif; 
	wp_reset_query();?>
	</ul>
</aside>
<?php
get_footer();
