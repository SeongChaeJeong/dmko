<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<style type="text/css">
.sct_10 .sct_li {position:relative;float:left;margin:0 15px 15px 0;}
.sct_10 .sct_last {margin:0 0 15px !important}
.sct_10 .sct_img {margin:0 0 3px;}
.sct_10 .sct_basic {position:absolute; left:0; top:20px;}

.item_info_wrap {position:relative; height:40px;}
.item_name {position:absolute; left:0px; top:0px; width:175px; height:14px; font-size:13px; font-weight:bold; text-align:left; overflow:hidden;}
.item_name a {color:#5b3e15;}

.item_discount_wrap {position:absolute; left:140px; top:0px; text-align:center; width:38px; height:38px; background:url('<?php echo G5_SHOP_SKIN_URL; ?>/img/latest_icon_sale.jpg') no-repeat; padding-top:10px;}
.item_percent { font-size:13px; color:#fff; font-weight:bold;}
.item_cust_amount {position:absolute; right:3px; top:3px; text-align:right; color:#666;}
.item_amount {position:absolute; right:3px; top:20px; text-align:right; font-size:13px; font-weight:bold; color:#e61f18;}
</style>

<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = 'sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_10\">\n";
        }
    }

    echo "<li class=\"sct_li {$sct_last}\" style=\"width:{$this->img_width}px; padding:10px;border:1px solid #cccccc;\">\n";

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a sct_img\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".item_icon($row)."</div>\n";
    }

    if ($this->view_it_id) {
        echo "<span class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</span>\n";
    }

echo "<div class=\"item_info_wrap\">";
    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a sct_txt item_name\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    /*if ($this->view_it_basic && $row['it_basic']) {
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }*/

    if ($this->view_it_cust_price || $this->view_it_price) {

if($row['it_soldout'] == '1' && $row['it_tel_inq'] !== '1') {
	$discount_percent = "품절";
} else if($row['it_tel_inq'] == '1') {
	$discount_percent = "문의";
} else {
	$cost_value = $row['it_cust_price']; //원가
	$discount_value = get_price($row); //할인가 = 판매가격
	$discount_percent = (($cost_value - $discount_value) / $cost_value) * 100;
	$discount_percent = round($discount_percent, 0)."%";
}
        //echo "<div class=\"sct_cost\">\n";
echo "<div class=\"item_discount_wrap\"><span class=\"item_percent\">".$discount_percent."</span></div>";
        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<strike class=\"item_cust_amount\">".display_price($row['it_cust_price'])."</strike>\n";
        }

        if ($this->view_it_price) {
            echo "<p class=\"item_amount\">".display_price(get_price($row), $row['it_tel_inq'])."</p>";
        }

        //echo "</div>\n";

    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_fb_s.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_twt_s.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/sns_goo_s.png');
        echo "</div>\n";
    }
echo "</div>";
    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->