<?php 
// 푸터내용 제어

function setup_theme_admin_footer() {
  add_menu_page(
    'Footer 관리', 
    'Footer 관리', 
    'manage_options', 
    'theme_settings_footer', 
    'theme_settings_footer',
    'dashicons-admin-tools',
    '30'
  );
}

add_action("admin_menu", "setup_theme_admin_footer");

function theme_settings_footer() {  
  $footeraddr = get_option("footeraddr");
  $footertel  = get_option("footertel");
  $footermail = get_option("footermail"); 
  $footerinfo = get_option("footerinfo"); ?>

  <div class="wrap">

  <?php 
  // 설정 저장하기
  if (isset($_POST["update_settings_footer"])) :
    // 변수로 설정
    $footeraddr = esc_attr($_POST["footeraddr"]);
    $footertel = esc_attr($_POST["footertel"]);
    $footermail = esc_attr($_POST["footermail"]);
    $footerinfo = esc_attr($_POST["footerinfo"]);
      
    // 업데이트
    update_option("footeraddr", $footeraddr);
    update_option("footertel", $footertel);
    update_option("footermail", $footermail);
    update_option("footerinfo", $footerinfo); ?>
    
    <div id="message" class="updated below-h2"><p>설정이 완료되었습니다.</p></div><?php
  endif; ?>

    <h2>Footer 관리</h2>
    <p>사이트 하단에 표시할 정보를 입력하세요.</p>
  
    <form action="" method="post">
      <div class="box">
        <h3>주소</h3>
        <input type="text" class="input" name="footeraddr" id="footeraddr" value="<?php echo $footeraddr; ?>">
      </div>
      <div class="box">
        <h3>전화번호</h3>
        <input type="text" class="input" name="footertel" id="footertel" value="<?php echo $footertel; ?>">
      </div>      
      <div class="box">
        <h3>이메일</h3>
        <input type="text" class="input" name="footermail" id="footermail" value="<?php echo $footermail; ?>">
      </div>
      <div class="box">
        <h3>추가 정보</h3>
        <textarea rows="4" class="txtarea" name="footerinfo" id="footerinfo"><?php echo $footerinfo; ?></textarea>
      </div>
      <!-- submit -->
      <p class="submit">
          <input type="hidden" name="update_settings_footer" value="Y" />
          <input type="submit" value="설정 저장" class="button-primary"/>
      </p>
      <!-- //submit -->
    </form>
  </div>
  <style>
    .wrap p { margin-bottom: 20px; }
    .box { margin-bottom:20px; padding: 16px 20px; background-color: #fff; border-bottom: 1px solid #ccc; overflow: hidden;}
    .box h3 { font-size: 14px; }
    .box .input {width: 500px;height: 30px;margin-bottom: 20px;}
    .box .txtarea { width: 500px; margin-bottom: 20px;}
    .box .inputlong {width: 90%;}
    .box ul {width: 70%;height: 100px;background: #fff;overflow-y: scroll;padding: 15px;border:1px solid #ddd;}
  </style><?php
} ?>