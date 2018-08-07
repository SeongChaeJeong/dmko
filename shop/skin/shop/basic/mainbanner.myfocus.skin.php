<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_SHOP_SKIN_URL ?>/myfocus/myfocus-2.0.4.min.js"></script>
<script>
myFocus.set({
	id:'myFocus',
    width:1200,
    height:490,
    time:3,
//  auto: false,
//	pattern:'mF_51xflash'
//	pattern:'mF_classicHB'
//	pattern:'mF_classicHC'
//	pattern:'mF_dleung'
	pattern:'mF_expo2010'
//	pattern:'mF_fancy'
//	pattern:'mF_fscreen_tb'
//	pattern:'mF_games_tb'
//	pattern:'mF_kdui'
//	pattern:'mF_kiki'
//	pattern:'mF_ladyQ'
//	pattern:'mF_liquid'
//	pattern:'mF_liuzg'
//	pattern:'mF_luluJQ'
//	pattern:'mF_pconline'
//	pattern:'mF_peijianmall'
//	pattern:'mF_pithy_tb'
//	pattern:'mF_qiyi'
//	pattern:'mF_quwan'
//	pattern:'mF_rapoo'
//	pattern:'mF_shutters'
//	pattern:'mF_slide3D'
//	pattern:'mF_sohusports'
//	pattern:'mF_taobao2010'
//	pattern:'mF_taobaomall'
//	pattern:'mF_tbhuabao'
//	pattern:'mF_YSlider'
});
</script>

<div id="myFocus">
<div class="loading"></div>
<div class="pic">
<ul>
<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? 'border:1px solid #d5d5d5' : '';
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        echo '<li>'.PHP_EOL;
        if (!$row['bn_url'] || $row['bn_url']=='http://')
            echo '<a href="#">';
        else {
            echo '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row['bn_url']).'"'.$bn_new_win.'>';
        }
        echo '<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" alt="'.$row['bn_alt'].'" text="" style="'.$bn_border.'">';
        echo '</a>'.PHP_EOL;
        echo '</li>'.PHP_EOL;
    }
}
?>
</ul>
</div>
</div>
<div style="clear:both; margin-bottom:10px;"></div>