<?php
get_header();
slowalk_before_content(); ?>

<?php get_template_part( 'templates/content', 'none' ); ?>

<?php
slowalk_after_content();
get_footer();
