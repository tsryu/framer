<?php 
/**
 * Template Name: Document
 */
global $post;
$page_slug=$post->post_name;
if($page_slug == 'docs'):
	$order = 'DESC';
else:
	$order = 'ASC';
endif;
get_header();
slowalk_before_content();
while ( have_posts() ) : the_post();
	slowalk_before_post();
	slowalk_page_header(); ?>
	<div class="page-content">
	<?php 
		$args_main = array (
		'post_type'             => $page_slug,
		'posts_per_page'        => '-1',
		'order'                    => $order
		);

		$query_main = new WP_Query( $args_main );

		if ( $query_main->have_posts() ) : 
			while ( $query_main->have_posts() ) : $query_main->the_post(); 
				$post_slug=$post->post_name; ?>
				<section id="<?php echo $post_slug; ?>" class="section">
				<h1 class="section-title"><?php the_title();?></h1>
					<div class="section-content">
						<?php the_content();?>
					</div>
					<?php slowalk_edit_post_link( true ); ?>
				</section>
			<?php
			endwhile;
		endif;
		wp_reset_query(); ?>
	</div>
	<?php 
	slowalk_after_post();
endwhile;
slowalk_after_content();?>
	<aside class="site-sidebar">
		<ul class="anchor-link">
			<?php
			if(!is_page('docs')): 
				if ( $query_main->have_posts() ) : 
					while ( $query_main->have_posts() ) : $query_main->the_post();
						$post_slug=$post->post_name; ?>
						<li><a href="#<?php echo $post_slug; ?>" class="section-title-link scroll-animate"><?php the_title();?></a></li>
					<?php 
					endwhile;
				endif;
			endif;
			?>
		</ul>
	</aside>
<?php
get_footer();
