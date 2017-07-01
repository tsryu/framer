<?php
get_header();
?>
<div ng-controller="design">
<?php slowalk_before_content(); ?>

<?php
while ( have_posts() ) : the_post();
  
	slowalk_before_post();

	slowalk_page_header(); ?>

	<div class="page-content">
		<section ng-repeat="post in posts | reverse" id="{{post.slug}}" class="section" ng-bind-html-unsafe="getContent(post)">
			<h1 class="section-title">{{post.title.rendered}}</h1>
			<div class="section-content" nag-prism ng-bind-html="post.content.rendered | html"></div>
			<?php if(is_user_logged_in()):?><div class="edit-link text-right"><a class="post-edit-link" href="/wp-admin/post.php?post={{post.id}}&amp;action=edit">편집</a></div><?php endif; ?>
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
		<li ng-repeat="post in posts | reverse"><a class="section-title-link" href="#{{post.slug}}">{{post.title.rendered}}</a></li>
	</ul>
</aside>
</div>
<?php
get_footer();
