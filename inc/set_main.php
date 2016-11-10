<?php 
// 메인 슬라이더 제어

function setup_theme_admin_mainroll() {
  add_menu_page(
    '메인 배너관리', 
    '메인 배너관리', 
    'manage_options', 
    'theme_settings_mainroll', 
    'theme_settings_mainroll',
    'dashicons-search',
    '29'
  );
}

add_action("admin_menu", "setup_theme_admin_mainroll");

function theme_settings_mainroll() {  

  $mainroll01 = get_option("mainroll01");
  $mainroll02 = get_option("mainroll02");
  $mainroll03 = get_option("mainroll03");
  $serialize = get_option("serialize"); ?>
  
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <div class="wrap">

  <?php 
  // 설정 저장하기
  if (isset($_POST["update_settings_mainroll"])) :
    // 변수로 설정
    $mainroll01 = esc_attr($_POST["mainroll01"]);
    $mainroll02 = esc_attr($_POST["mainroll02"]);
    $mainroll03 = esc_attr($_POST["mainroll03"]);
    $serialize = esc_attr($_POST["serialize"]);

    // 업데이트
    update_option("mainroll01", $mainroll01);
    update_option("mainroll02", $mainroll02);
    update_option("mainroll03", $mainroll03); 
    update_option("serialize", $serialize); ?>

    <div id="message" class="updated below-h2"><p>설정이 완료되었습니다.</p></div><?php
  endif; ?>

  <h2>메인 배너관리</h2>
  <p>메인페이지 중앙의 슬라이드 패널에 등록할 게시물을 선택하세요.<br>
  좌측에서 원하는 게시물을 선택한 뒤, 우측 영역에서 게시물의 순서를 정할 수 있습니다.</p>

  <form action="" method="post">
    <div class="container">
      <div class="col col-left">
        <div class="box">
          <div>
          <h3>대예배설교</h3>
          <input type="text" class="input" name="mainroll01" id="mainroll01" value="<?php echo $mainroll01; ?>" readonly="readonly">
          <ul class="select_ban">

          <?php 
          $args = array (
            'post_type'              => 'mainroll',
            'posts_per_page'         => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'mainroll_type',
                'field' => 'slug',
                'terms' => 'w-main'
              )
            )
          );

          $query = new WP_Query( $args );

          if( $query->have_posts() ) {
            while( $query->have_posts() ) {
              $query->the_post();?>
              <li>            
                <input type="checkbox" name="mainroll01_array" id="mainroll01_array" value="<?php echo get_the_id(); ?>">
                <?php the_title(); ?><div id="<?php echo get_the_id(); ?>" style="display:none;"><?php echo get_the_title(); ?></div>
                
              </li>
              <?php
            }
          }
          else {
            echo '<li class="empty">게시물이 없습니다.</li>';
          } ?>
          </ul>
        
          </div>

        <hr class="hline">

          <div>
          <h3>일반설교</h3>
          <input type="text" class="input" name="mainroll02" id="mainroll02" value="<?php echo $mainroll02; ?>" readonly="readonly">
          <ul class="select_ban">

          <?php 
          $args2 = array (
            'post_type'              => 'mainroll',
            'posts_per_page'         => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'mainroll_type',
                'field' => 'slug',
                'terms' => 'w-general'
              )
            )
          );

          $query2 = new WP_Query( $args2 );

          if( $query2->have_posts() ) {
            while( $query2->have_posts() ) {
              $query2->the_post();?>
              <li>            
                <input type="checkbox" name="mainroll02_array" id="mainroll02_array" value="<?php echo get_the_id(); ?>">
                <?php the_title(); ?><div id="<?php echo get_the_id(); ?>" style="display:none;"><?php echo get_the_title(); ?></div>
              </li>
              <?php
            }
          }
          else {
            echo '<li class="empty">게시물이 없습니다.</li>';
          } ?>
          </ul>
          </div>
        
        <hr class="hline">
          
          <div>
          <h3>찬양영상</h3>
          <input type="text" class="input" name="mainroll03" id="mainroll03" value="<?php echo $mainroll03; ?>" readonly="readonly">
          <ul class="select_ban">

          <?php 
          $args3 = array (
            'post_type'              => 'mainroll',
            'posts_per_page'         => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'mainroll_type',
                'field' => 'slug',
                'terms' => 'w-praise'
              )
            )
          );

          $query3 = new WP_Query( $args3 );

          if( $query3->have_posts() ) {
            while( $query3->have_posts() ) {
              $query3->the_post();?>
              <li>            
                <input type="checkbox" name="mainroll03_array" id="mainroll03_array" value="<?php echo get_the_id(); ?>">
                <?php the_title(); ?><div id="<?php echo get_the_id(); ?>" style="display:none;"><?php echo get_the_title(); ?></div>
              </li>
              <?php
            }
          }
          else {
            echo '<li class="empty">게시물이 없습니다.</li>';
          } ?>
          </ul>
          </div>
        </div><!-- //box -->
      </div>
      <div class="col col-right">
        <div class="box-sort">
          <h3>게시물 순서</h3>
          <p>가장 상단의 글이 메인페이지에서 첫 슬라이드로 게시됩니다.</p>
          <ul id="sortable">
            <li class="ui-state-default" name="0"></li>
            <li class="ui-state-default" name="1"></li>
            <li class="ui-state-default" name="2"></li>
            <li class="ui-state-default" name="3"></li>
            <li class="ui-state-default" name="4"></li>
            <li class="ui-state-default" name="5"></li>
            <li class="ui-state-default" name="6"></li>
            <li class="ui-state-default" name="7"></li>
            <li class="ui-state-default" name="8"></li>
            <li class="ui-state-default" name="9"></li>
            <li class="ui-state-default" name="10"></li>
            <li class="ui-state-default" name="11"></li>
          </ul> 

          <!-- submit -->
          <p class="submit">
              <input type="hidden" name="update_settings_mainroll" value="Y" />
              <input type="hidden" name="serialize" value="<?php echo $serialize;?>" style="width:500px;">
              <input type="submit" value="설정 저장" class="button-primary"/>
          </p><!-- //submit -->
        </div>
      </div>

    </div>
  </form>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <style>
    .wrap { margin-bottom: 40px;}
    .wrap p { margin-bottom: 40px;}
    .container { margin-left: -15px; margin-right: -15px; }
    .container:before, .container:after { content: ""; display: table;}
    .container:after { clear: both;}
    .col { position: relative; float: left; padding-left: 15px; padding-right: 15px; }
    .col-left {  width: 60%; }
    .col-right { width: 40%; }
    .container, .col {
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }
    .container:before, .col:before,
    .container:after, .col:after {
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }

    @media screen and (max-width: 782px) {
      .col-left { width: 100%; }
      .col-right { width: 100%; }
    }
    .box, .box-sort { padding: 15px 20px; overflow: hidden; background-color: #fff; border-bottom: 1px solid #ccc; margin-top: 20px; }
    .box:first-child, .box-sort { margin-top: 0;}
    .box .inputlong {width: 90%;}
    .box h3 { float: left; }
    .box .input {float: right; margin: 12.5px 0;}
    .hline { margin:25px 0; border: none; height: 0; border-bottom: 1px solid #fff }
    .box ul { width: 95%; height: 100px;background: #fff; overflow-y: scroll; padding: 15px; border:1px solid #ddd;}
    .box-sort ul { margin-bottom: 40px;}
    .ui-state-default { display: none; position: relative; margin: 0 auto 10px; padding: 5px; cursor: move; border-radius: 2px; background: #fff;}
    /*.ui-state-default.fourth { margin-bottom: 20px; }
    .ui-state-default.fourth:after { content:""; width:105%; height: 2px; position: absolute; bottom: -11px; left: -2.5%; background-color: #0092e7;}*/
    .submit { padding: 0!important; margin: 20px 0!important; text-align: right!important;} 
  </style>
  

  <script>
  // 체크하면 모아서 배열화 및 드래그 영역에도 반영
    jQuery(document).ready(function () {
      jQuery('.select_ban input').change(function() {
        var nowchk = jQuery(this).parents('.select_ban').find('input:checked').map(function () {
          return this.value; return val;}).get();
        console.log(nowchk);
        jQuery(this).parents('.select_ban').siblings('input').val(nowchk);
        
        var serialize = jQuery('input[name=serialize]').val(); 
        var serialize_array = serialize.split(","); 
        var changed_id = jQuery(this).val(); 
        var position = serialize_array.indexOf(changed_id);
        if(position == -1){ // changed_id가 새로 체크한 것이라면
          var list = changed_id + "," + serialize;
          var list_array = list.split(","); 
          for(var i=0; i < 3; i++){
            if(list_array[i]) {
              var title = jQuery('#'+list_array[i]).text();
              var subject = jQuery('input[value='+list_array[i]+']').parent('li').parent('ul').siblings('h3').text();       
              jQuery('#sortable').find('li[name='+i+']').html('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'+subject+": "+title+'('+list_array[i]+')');
              //jQuery('#sortable').find('li[name='+i+']').html('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'+list_array[i]+": "+title);
              jQuery('#sortable').find('li[name='+i+']').attr('id', list_array[i]);
              jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:block;');
            }else{
              jQuery('#sortable').find('li[name='+i+']').attr('id', '');
              jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:none;');
            } 
          }
          jQuery('input[name=serialize]').val(list);
        }else{ // changed_id가 기존에 있는 것을 체크 해제 한 것이라면
          serialize_array.splice(position, 1);
          var list = serialize_array.join(',');
          for(var i=0; i < 3; i++){
            if(serialize_array[i]) {
              var title = jQuery('#'+serialize_array[i]).text();  
              var subject = jQuery('input[value='+serialize_array[i]+']').parent('li').parent('ul').siblings('h3').text();        
              jQuery('#sortable').find('li[name='+i+']').html('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + '[' + subject +'] '+ title + ' (' +serialize_array[i]+')');
              //jQuery('#sortable').find('li[name='+i+']').html('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'+serialize_array[i]+": "+title);
              jQuery('#sortable').find('li[name='+i+']').attr('id', serialize_array[i]);
              jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:block;');
            }else{
              jQuery('#sortable').find('li[name='+i+']').attr('id', '');
              jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:none;');
            } 
          }
          jQuery('input[name=serialize]').val(list);
        }
      });
    });
  // 현재 설정을 드래그 영역에 반영
    jQuery(document).ready(function () {
      var list = jQuery('input[name=serialize]').val();
      var list_array = list.split(","); 
      for(var i=0; i < 3; i++){
        if(list_array[i]) {
          var title = jQuery('#'+list_array[i]).text();
          var subject = jQuery('input[value='+list_array[i]+']').parent('li').parent('ul').siblings('h3').text();       
          jQuery('#sortable').find('li[name='+i+']').html('<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + '[' + subject +'] '+ title + ' ('+list_array[i]+')');
          jQuery('#sortable').find('li[name='+i+']').attr('id', list_array[i]);
          jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:block;');
        }else{
          jQuery('#sortable').find('li[name='+i+']').attr('id', '');
          jQuery('#sortable').find('li[name='+i+']').attr('style', 'display:none;');
        } 
      }
    });
  // 현재 설정을 체크에 반영
    jQuery(document).ready(function () {
      jQuery('.input').each(function() {
        var now = jQuery(this).val();
        var now = now.split(',');

        jQuery(this).siblings('.select_ban').find('input').each(function () {
          var tv = jQuery(this).val();
          var isin = jQuery.inArray(tv, now);
          if ( isin != '-1' ) {
            jQuery(this).attr('checked','1');
          }
        });
      });
    });
  // 드래그 가능하게하는...function
    jQuery(document).ready(function () {
        jQuery( "#sortable" ).sortable({
        update: function(event, ui) {
          jQuery('input[name=serialize]').val(jQuery(this).sortable('toArray'));
          var i = 0;
          jQuery('.ui-state-default').each(function() {
            jQuery(this).attr('name', i);
            i++;
          });
          // alert(ui.item.index());
        }
      });
        jQuery( "#sortable" ).disableSelection();
    });   
  </script>

  </div><!-- .wrap -->
<?php } ?>