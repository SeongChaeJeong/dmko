<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div>
    <!-- } 콘텐츠 끝 -->

<div id="footer">
    <div id="footer_box">
          <div id="footer_left">
              <ul>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=a_01"><img src="<?php echo G5_URL ?>/images/footer_btn1.gif" /></a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=provision"><img src="<?php echo G5_URL ?>/images/footer_btn2.gif" /></a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=privacy"><img src="<?php echo G5_URL ?>/images/footer_btn3.gif" /></a></li>               
                <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qa"><img src="<?php echo G5_URL ?>/images/footer_btn5.gif" /></a></li>
              </ul>
          </div>
          <div id="footer_right"><a href="#"><img src="<?php echo G5_URL ?>/images/btn_top.gif" /></a></div>
    </div>    
</div>
<div id="footer2">
    <div id="footer2_box">
           <div id="footer2_logo"><a href="<?php echo $default['de_root_index_use'] ? G5_URL : G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img2" alt="처음으로"></a></div>
          <div id="footer2_left"><img src="<?php echo G5_URL ?>/images/footer1.gif" /></div>
          <div id="footer2_right"><script language="JavaScript">
		function go_check()
		{
			var status  = "width=500 height=450 menubar=no,scrollbars=no,resizable=no,status=no";
			var obj     = window.open('', 'kcp_pop', status);

			document.shop_check.method = "post";
			document.shop_check.target = "kcp_pop";
			document.shop_check.action = "http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp";

			document.shop_check.submit();
		}
	</script>
         	<form name="shop_check" method="post" action="http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp">
		<input type="hidden" name="site_cd" value="SR13V">
        <a href="javascript:go_check()"><img src="<?php echo G5_URL ?>/images/footer2.gif" /></a>
            </form>
          </div>
    </div>    
</div>
<div id="footer3">
    <div id="footer3_box">
          <ul> 
                <li><a href="http://www.ftc.go.kr/" target="_blank"><img src="<?php echo G5_URL ?>/images/footer_banner1.gif" /></a></li>
                <li><a href="http://www.taxsave.go.kr/servlets/AAServlet?tc=tss.web.aa.ntc.cmd.RetrieveMainPageCmd" target="_blank"><img src="<?php echo G5_URL ?>/images/footer_banner2.gif" /></a></li>
                
                <li><a href="http://www.kca.go.kr/index.do" target="_blank"><img src="<?php echo G5_URL ?>/images/footer_banner4.gif" /></a></li>
                <li><a href="https://www.sgic.co.kr" target="_blank"><img src="<?php echo G5_URL ?>/images/footer_banner5.gif" /></a></li>
                <li><a href="http://www.kcp.co.kr" target="_blank"><img src="<?php echo G5_URL ?>/images/footer_banner6.gif" /></a></li>
              </ul>
    </div>    
</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['PHP_SELF'];
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_PATH.'/tail.sub.php');
?>