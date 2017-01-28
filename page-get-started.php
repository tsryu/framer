<?php
get_header();
?>
<div ng-controller="getStarted">
<?php slowalk_before_content(); ?>

<?php
while ( have_posts() ) : the_post();
  
	slowalk_before_post();

	slowalk_page_header(); ?>

	<div class="page-content">
		<section ng-repeat="post in posts | reverse" id="{{post.slug}}" class="section" ng-bind-html-unsafe="getContent(post)">
			<h1 class="section-title">{{post.title.rendered}}</h1>
			<div class="section-content" ng-bind-html="post.content.rendered | html"></div>
			<div class="edit-link text-right"><a class="post-edit-link" href="/wp-admin/post.php?post={{post.id}}&amp;action=edit">편집</a></div>
		</section>
		<?php
		$args_main = array (
			'post_type'             => 'get_started',
			'posts_per_page'        => '-1',
			'order'					=> 'DESC'
		);

		$query_main = new WP_Query( $args_main );

		if ( $query_main->have_posts() ) : 
			while ( $query_main->have_posts() ) : $query_main->the_post(); ?>
				<section id="<?php $post_slug=$post->post_name; echo $post_slug?>" class="section">
					<h1 class="section-title"><?php the_title();?></h1>
					<?php the_content();?>
					<?php slowalk_edit_post_link( true ); ?>
				</section>
				<?php
			endwhile;
		else :
			echo '<div class="empty">준비중입니다.</div>';
		endif; 
		wp_reset_query();?>
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
		<li ng-repeat="post in posts | reverse"><a class="section-title-link" href="#{{post.slug}}">{{post.title.rendered}}</a></li>
	</ul>
</aside>
</div>
<?php
get_footer();
