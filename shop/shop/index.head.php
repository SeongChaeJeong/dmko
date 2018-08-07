<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-menu-tut').dcMegaMenu({
		rowItems: '3',
		speed: 'fast'
	});
});
</script>
<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>
     
     <!-- 헤더 시작 -->
      <div id="head_wrap">
            <!-- 글로벌 시작  -->
             <div id="global_box">
                 <div id="global">
                     <div class="global_left"><a href="javascript:window.external.AddFavorite('http://dmko.net' , '뎀코라이트');"><img src="<?php echo G5_SHOP_URL; ?>/img/bookmark.gif" alt="즐겨찾기"></a></div>
                     <div class="global_right">
                       <div id="tnb">
                          <!--<h3>회원메뉴</h3>-->
                          <ul>
                              <?php if ($is_member) { ?>
                              <?php if ($is_admin) {  ?>
                              <li><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>관리자</b></a></li>
                              <?php }  ?>
                              <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                              <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
                              <?php } else { ?>
                              <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
                              <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
                              <?php } ?>
                              <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                              <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=faq">FAQ</a></li>
                              <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                              <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></li>                
                              <?php if(!$default['de_root_index_use']) { ?>
                              <li><a href="<?php echo G5_URL; ?>/">커뮤니티</a></li>
                              <?php } ?>
                          </ul>
                        </div>
                      </div>
                 </div>
             </div>
             <!-- 로고 -->
             <div id="global_header">
                 <div class="global_banner"><?php echo display_banner('상단', 'banner.30.skin.php', '2'); //  출력위치, 출력스킨, 갯수 ?></div>
                 <div class="logo"><a href="<?php echo $default['de_root_index_use'] ? G5_URL : G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></div>
                 <div class="search ">
                        <div id="hd_sch">
                            <h3>쇼핑몰 검색</h3>
                            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
                            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="q" value="<?php echo stripslashes(get_text($q)); ?>" id="sch_str" required>            
                            <input type="image" value="검색" id="sch_submit" src="<?php echo G5_SHOP_URL; ?>/img/btn_search.gif">
                
                            </form>
                            <script>
                            function search_submit(f) {
                                if (f.q.value.length < 2) {
                                    alert("검색어는 두글자 이상 입력하십시오.");
                                    f.q.select();
                                    f.q.focus();
                                    return false;
                                }
                
                                return true;
                            }
                            </script>
                        </div>
                 </div>
             </div>
             <div id="global_menu">            
              <?php include_once(G5_SHOP_PATH.'/top_menu.php'); // 메뉴 ?>  
             </div>
      </div><?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
      <!-- 헤더 끝 -->
      
         

</div>
 
<div id="wrapper">

    <div id="box1">

       <div id="aside">
           <div  id="submenu">
              <ul id="submenu">		
                <li><img src="<?php echo G5_URL ?>/images/b_menu_ti.gif"/></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=70"><img src="<?php echo G5_URL ?>/images/b_menu1_off.gif" class="rollover" alt="원스톱페키지"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10"><img src="<?php echo G5_URL ?>/images/b_menu2_off.gif" class="rollover" alt="거실등"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=20"><img src="<?php echo G5_URL ?>/images/b_menu3_off.gif" class="rollover" alt="방등"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=30"><img src="<?php echo G5_URL ?>/images/b_menu4_off.gif" class="rollover" alt="주방등"/></a></li>	
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=40"><img src="<?php echo G5_URL ?>/images/b_menu5_off.gif" class="rollover" alt="현관/센서"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=50"><img src="<?php echo G5_URL ?>/images/b_menu6_off.gif" class="rollover" alt="발코니/직부"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=60"><img src="<?php echo G5_URL ?>/images/b_menu7_off.gif" class="rollover" alt="산업용"/></a></li>  
                <li><img src="<?php echo G5_URL ?>/images/b_menu_do.gif"/></li>
              </ul>
              <script type="text/javascript">
                if ( $('img').hasClass('active') ){
                $('img.active').attr('src', $('img.active').attr('src').split('_off.')[0] + '_on.' + $('img.active').attr('src').split('_off.')[1]);
                }
                $('img.rollover').mouseover(function(){
                if ( !$(this).hasClass('active') ){
                var image_name = $(this).attr('src').split('_off.')[0];
                var image_type = $(this).attr('src').split('off.')[1];
                $(this).attr('src', image_name + '_on.' + image_type);
                }
                }).mouseout(function(){
                if ( !$(this).hasClass('active') ){
                var image_name = $(this).attr('src').split('_on.')[0];
                var image_type = $(this).attr('src').split('_on.')[1];
                $(this).attr('src', image_name + '_off.' + image_type);
                }
                });
              </script>
          
             <!-- 쇼핑몰 배너 시작 { -->
           <a href="<?php echo G5_URL ?>/bbs/content.php?co_id=e_01"><img src="<?php echo G5_URL ?>/images/m_btn1.gif" /></a> 
             <!-- } 쇼핑몰 배너 끝 -->
          </div>            
       </div>
    <!-- } 상단 끝 -->

    <!-- 콘텐츠 시작 { -->
    <div id="index_container">
        
       <!-- 메인이미지 시작 { -->
       <?php echo display_banner('메인', 'banner.10.skin.php', '4'); //  출력위치, 출력스킨, 갯수 ?> 
<!-- } 메인이미지 끝 -->
    </div>

    </div>
    
