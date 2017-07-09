<aside class="site-sidebar">
	<ul class="anchor-link">
		<li ng-repeat="post in posts | reverse"><a class="section-title-link scroll-animate" href="#{{post.slug}}">{{post.title.rendered}}</a></li>
	</ul>
</aside>