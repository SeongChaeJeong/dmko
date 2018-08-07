<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/index.php');
    return;
}

define("_INDEX_", TRUE);

include_once(G5_SHOP_PATH.'/index.head2.php');
?>

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
       <?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<!-- } 메인이미지 끝 -->
    </div>

    </div>
    


<div id="index_banner">

   <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_01"><img src="<?php echo G5_URL ?>/images/m_banner01.gif" /></a></li>
   <li><img src="<?php echo G5_URL ?>/images/m_banner02.gif" /></li>
   <li><a href="<?php echo G5_URL ?>/shop/itemuselist.php"><img src="<?php echo G5_URL ?>/images/m_banner03.gif" /></a></li>
   <li><a href="<?php echo G5_URL ?>/shop/event.php?ev_id=1401413312"><img src="<?php echo G5_URL ?>/images/m_banner04.gif" /></a></li>

</div>
<div id="index_box">

<div id="index_ti"><img src="<?php echo G5_URL ?>/images/m_best.gif" /></div>
<?php if($default['de_type1_list_use']) { ?>
<!-- 히트상품 시작 { -->
<section class="sct_wrap">
    <header>       
        <p class="sct_wrap_hdesc"></p>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(1);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</section>
<!-- } 히트상품 끝 -->
<?php } ?>

<div id="index_ti"><img src="<?php echo G5_URL ?>/images/m_new.gif" /></div>
<?php if($default['de_type2_list_use']) { ?>
<!-- 추천상품 시작 { -->
<section class="sct_wrap">
    <header>        
      <p class="sct_wrap_hdesc"></p>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(2);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</section>
<!-- } 추천상품 끝 -->
<?php } ?>


<div id="index_box2"> 
  <div class="index_left"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice"><img src="<?php echo G5_URL ?>/images/m_ti_notice.gif" /></a><br />
  <?php echo latest('shop_basic', 'notice', 6, 30); ?></div>
   <div class="index_center"><img src="<?php echo G5_URL ?>/images/m_footer01.gif" usemap="#Map" border="0"/>
     <map name="Map" id="Map">
       <area shape="rect" coords="4,6,89,110" href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qa" alt="고객게시판" />
       <area shape="rect" coords="96,5,193,109" href="<?php echo G5_URL ?>/bbs/content.php?co_id=provision" alt="쇼핑몰이용안내" />
       <area shape="rect" coords="199,5,297,111" href="<?php echo G5_URL ?>/shop/itemuselist.php" alt="상품후기" />
       <area shape="rect" coords="303,3,399,112" href="<?php echo G5_URL ?>/shop/orderinquiry.php" alt="주문/배송" />
       <area shape="rect" coords="403,4,491,108" href="<?php echo G5_URL ?>/bbs/qalist.php" alt="1:1친절상담" />
     </map>
   </div>
  <div class="index_right"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qa"><img src="<?php echo G5_URL ?>/images/m_ti_faq.gif" /></a><br />
  <?php echo latest('shop_basic', 'qa', 6, 20); ?></div>

</div>





<?php
include_once(G5_SHOP_PATH.'/shop.tail.php');
?>