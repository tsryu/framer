<?php
get_header();
slowalk_before_content(); ?>

<?php
  if ( have_posts() ) :
    slowalk_page_header();?>
		<ul class="archive-list"><?php
    while ( have_posts() ) : the_post(); ?>
      <li class="archive-item">

        <?php slowalk_before_post(); ?>

        <a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php
          if ( has_post_thumbnail() ) :
            the_post_thumbnail( 'large' );
          else :
            slowalk_the_post_thumbnail_placeholder( 'large' );
          endif; ?>
        </a><!-- .post-thumbnail -->
        <div class="post-content">
          <header class="entry-header">
            <h1 class="entry-title">
              <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php slowalk_the_title(); ?></a>
            </h1>
          </header>
          <div class="entry-summary">
            <?php the_excerpt(); ?>
          </div>
        </div><!-- .post-content: 제목과 요약 -->
        
        <?php slowalk_after_post(); ?>

      </li>
    <?php endwhile;?>
    </ul><?php
    slowalk_paginate_links();
  else :
    get_template_part( 'templates/content', 'none' );
  endif;
?>

<?php
slowalk_after_content();
get_footer();