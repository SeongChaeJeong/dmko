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
                     <div class="global_left"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_SHOP_URL; ?>/img/bookmark.gif" alt="즐겨찾기"></a></div>
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
                              <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
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
                 <div class="global_banner"><?php echo display_banner('상단', 'banner.30.skin.php', '1'); //  출력위치, 출력스킨, 갯수 ?></div>
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
             <!-- 메뉴 시작 -->
             <div id="global_menu">
            
             <div class="dcjq-mega-menu">
<ul id="mega-menu-tut" class="menu">      
      <li><img src="<?php echo G5_URL ?>/images/top_menu.gif"></li>	
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_01">회사소개</a>
      <ul>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_01">CEO 인사말</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_02">회사현황</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_03">조직도</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_04">오시는 길</a></li>
      </ul>
      </li>
      
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10">제품소개</a>
      <ul>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10">거실등</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=20">방등</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=30">주방등</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=40">산업용등</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=0">현관등/베란다등</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10">디자인조명</a></li>
      <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10">아이방조명</a></li>
      </ul>
      </li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_01">LED장점</a>
      <ul>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_01">서브메뉴01</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_02">서브메뉴02</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_03">서브메뉴03</a></li>
      </ul>
      </li>
      <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=photo">시공사례</a>
      <ul></ul></li>
      <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=e_01">설치서비스</a>
      <ul></ul></li>
      <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice">고객센터</a>
      <ul>
      <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice">공지사항</a></li>
      <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qa">질문답변</a></li>
      </ul>
      </li>
      <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">제품후기</a>
      </li>      
      </ul>
</div>
                       
             
             
             </div>
      </div>
      <!-- 헤더 끝 -->
      
         

</div>
 
<div id="wrapper">

   

    <div id="aside">
           <div  id="submenu">
              <ul id="submenu">		
                <li><img src="<?php echo G5_URL ?>/images/b_menu_ti.gif"/></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10"><img src="<?php echo G5_URL ?>/images/b_menu1_off.gif" class="rollover" alt="소개"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=20"><img src="<?php echo G5_URL ?>/images/b_menu2_off.gif" class="rollover" alt="인사말"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=30"><img src="<?php echo G5_URL ?>/images/b_menu3_off.gif" class="rollover" alt="연혁"/></a></li>	
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=40"><img src="<?php echo G5_URL ?>/images/b_menu4_off.gif" class="rollover" alt="조직도"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=50"><img src="<?php echo G5_URL ?>/images/b_menu5_off.gif" class="rollover" alt="사업안내 및 목적"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=60"><img src="<?php echo G5_URL ?>/images/b_menu6_off.gif" class="rollover" alt="사업안내 및 목적"/></a></li>
                <li><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=70"><img src="<?php echo G5_URL ?>/images/b_menu7_off.gif" class="rollover" alt="사업안내 및 목적"/></a></li>
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
              <ul id="subevent">		
                <li><img src="<?php echo G5_URL ?>/images/sub_banner_ti.gif"/></li>
                <?php echo display_banner('왼쪽', 'banner.20.skin.php', '4'); //  출력위치, 출력스킨, 갯수 ?>               
                <li><a href="#"><img src="<?php echo G5_URL ?>/images/sub_banner_do.gif"/></a></li>
              </ul>    
              
               <ul id="submenu">		
                <li><img src="<?php echo G5_URL ?>/images/sub_customer.gif"/></li>               
              </ul>            
           </div>
            <!-- } 쇼핑몰 배너 끝 -->
       
       
       
       
    </div>
<!-- } 상단 끝 -->

    <!-- 콘텐츠 시작 { -->
    <div id="container">
        <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><?php } ?>
        <!-- 글자크기 조정 display:none 되어 있음 시작 { -->
        <div id="text_size">
            <button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
            <button class="no_text_resize" onclick="font_default('container');">기본</button>
            <button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
        </div>
        <!-- } 글자크기 조정 display:none 되어 있음 끝 -->
       