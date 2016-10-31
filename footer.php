  <?php //if ( ! is_home() && ! is_front_page() ) echo '</div><!-- .container -->'; ?>
  </div>
</main><!-- .site-main -->

<?php
// $footeraddr = get_option("footeraddr");
// $footertel = get_option("footertel");
// $footermail = get_option("footermail"); 
// $footerinfo = get_option("footerinfo"); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="container">
    <div class="site-info">
    	<p class="copyright">&copy; <a href="http://tsryu.com" target="_blank">tsryu</a> <?php echo date( 'Y', current_time( 'timestamp' ) ); ?> All right Reserved.</p>
    </div><!-- .site-info -->
  </div><!-- .container -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
