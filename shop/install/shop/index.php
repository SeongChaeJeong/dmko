<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/index.php');
    return;
}

define("_INDEX_", TRUE);

include_once(G5_SHOP_PATH.'/shop.head.php');
?>

<!-- 메인이미지 시작 { --> 
<?php echo display_banner('메인', 'mainbanner.myfocus.skin.php'); ?> 
<!-- } 메인이미지 끝 --> 

<!--<div id="index_banner">

   <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=c_01"><img src="<?php echo G5_URL ?>/images/m_banner01.gif" /></a></li>
   <li><img src="<?php echo G5_URL ?>/images/m_banner02.gif" /></li>
   <li><a href="<?php echo G5_URL ?>/shop/itemuselist.php"><img src="<?php echo G5_URL ?>/images/m_banner03.gif" /></a></li>
   <li><a href="<?php echo G5_URL ?>/shop/event.php?ev_id=1401413312"><img src="<?php echo G5_URL ?>/images/m_banner04.gif" /></a></li>

</div> -->
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
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
include_once(G5_SHOP_PATH.'/shop.tail.php');
?>