<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

/* ****************************************
* 지운아빠
* 2014-08-28
* 모바일 배너 이미지 추가
* http://minsup.kr - 영카트5 테마 전문
**************************************** */

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($i==0) echo '<div id="sbn_idx" class="swipe slider">'.PHP_EOL.'<div id="sbn_idx_slide" class="swipe-wrap">'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' sbn_border' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'].'_m';

    $bn_exp = explode('|', $row['bn_alt']);

    if (file_exists($bimg))
    {
        echo '<div>'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            echo '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            echo '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row['bn_url']).'"'.$bn_new_win.'>';
        }
        echo '<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'_m" alt="" class="'.$bn_border.'">';
        if($row['bn_url'])
            echo '</a>'.PHP_EOL;
        echo '</div>'.PHP_EOL;

        $bn_first_class = '';
    }
}
if ($i>0) { echo '</div>'.PHP_EOL;
    echo '<span id="slide-bullet">'.PHP_EOL;
    for ($j=0;$j<$i;$j++) {
        echo '<button type="button" class="slide-bullet"><span class="sound_only">'.$j.'</span></button>'.PHP_EOL;
    }
    echo '</span></div>'.PHP_EOL;
}
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script>
$(function(){
    window.mySwipe2 = Swipe(document.getElementById('sbn_idx'), {
        callback: function(index, elem) {
            index++;
            $(".slide-bullet").removeClass("slide-bullet-on");
            $(".slide-bullet:nth-child("+index+")").addClass("slide-bullet-on");
        }
    });

    $(".slide-bullet:nth-child(1)").addClass("slide-bullet-on");
    $('.slide-bullet').on ('click', function () {
        window.mySwipe2.slide($(this).index(), 300);
        $(".slide-bullet").removeClass("slide-bullet-on");
        $(this).addClass("slide-bullet-on");
    });

});
</script>