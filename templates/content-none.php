<?php
slowalk_before_post( false ); 

slowalk_page_header( '찾을 수 없습니다.' ); ?>

<div class="page-content">
  <p><?php
    if ( is_404() ) :
      echo '검색을 해보시겠습니까?';
      get_search_form();
    elseif ( is_search() ) :
      echo '검색어와 일치하는 것이 없습니다. 다른 검색어로 다시 시도해보세요.';
      get_search_form();
    else :
      echo '준비중입니다.';
    endif; ?>
  </p>
</div>

<?php 
slowalk_after_post(); ?>
