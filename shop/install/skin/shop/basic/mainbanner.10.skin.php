<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<?php
$max_width = $max_height = 0;
$bn_first_class = ' class="slide_first"';

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($i==0) echo '<section id="slide_visual" class="slide_visual">'.PHP_EOL.'<h2 class="sound_only">쇼핑몰 배너</h2>'.PHP_EOL.'<ul>'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);

        if($size[2] < 1 || $size[2] > 16)
            continue;

        if($max_width < $size[0])
            $max_width = $size[0];

        if($max_height < $size[1])
            $max_height = $size[1];

        echo '<li'.$bn_first_class.'>'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row['bn_url']).'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" width="'.$size[0].'" alt="'.$row['bn_alt'].'"'.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</li>'.PHP_EOL;

        $bn_first_class = '';
    }
}
if ($i>0) echo '</ul>'.PHP_EOL.'</section>'.PHP_EOL;
?>

<script>
(function($) {
    var intervals = {};

    var methods = {
        init: function(option)
        {
            if(this.length < 1)
                return false;

            var $bnnr = this.find("li:has(img)");
            var count = $bnnr.size();
            var $bnnr_a = $bnnr.find("a");
            var width = <?php echo $max_width; ?>;
            var height = <?php echo $max_height; ?>;
            var wrap_width = this.parent().width();
            var c_idx = o_idx = 0;
            var el_id = this[0].id;
            var $this = this;

            if(width > wrap_width) {
                height = parseInt(height * (wrap_width / width));
            }
            width = wrap_width;

            this.width(wrap_width).height(height)
                .find("ul").width(width).height(height)
                .find("li").width(width).height(height);

            $bnnr.not(".slide_first").css("left", width+"px");

            $bnnr.each(function() {
                var $img = $(this).find("img");
                var img_width = parseInt($img.attr("width"));
                if(img_width > width)
                    img_width = width;

                $img.removeAttr("width");
                $img.width(img_width);
            });

            // 기본 설정값
            var settings = $.extend({
                interval: 4000,
                duration: 500
            }, option);

            if(count > 1) {
                var slide_button = "<ul class=\"slide_bt\" id=\"main_bn_bt\">\n";
                var act_class = " class=\"active_bt\"";
                for(i=1; i<=count; i++) {
                    slide_button += "<li"+act_class+"><button type=\"button\">"+i+"</button></li>\n";
                    act_class = "";
                }
                slide_button += "</ul>\n";

                slide_button += "<ul class=\"control_bt\">\n";
                slide_button += "<li class=\"play\"><button type=\"button\">play</button></li>\n";
                slide_button += "<li class=\"pause\"><button type=\"button\">stop</button></li>\n";
                slide_button += "</ul>\n";

                this.find("ul").before(slide_button);

                var $bnnr_btn = this.find(".slide_bt button");

                $bnnr_btn.on("focusin", function() {
                    clear_interval();
                });

                $bnnr_btn.on("focusout", function() {
                    set_interval();
                });
            }

            set_interval();

            $(".play button").on("click", function() {
                $(".pause button").removeClass("paused");
                set_interval();
            });

            $(".pause button").on("click", function() {
                $(this).addClass("paused");
                clear_interval();
            });

            $bnnr.hover(
                function() {
                    clear_interval();
                },
                function() {
                    set_interval();
                }
            );

            $bnnr_btn.hover(
                function() {
                    clear_interval();
                },
                function() {
                    set_interval();
                }
            );

            $bnnr_btn.on("click", function() {
                if(count > 1) {
                    var idx = String($bnnr_btn.index($(this)));
                    clear_interval();
                    left_rolling(idx);
                }
            });

            $bnnr_a.on("focusin", function() {
                clear_interval();
            });

            $bnnr_a.on("focusout", function() {
                set_interval();
            });

            function left_rolling(idx) {
                $bnnr.each(function(index) {
                    if($(this).is(":visible")) {
                        o_idx = index;
                        return false;
                    }
                });

                $bnnr.not(":visible").css({
                    display: "none",
                    left: "+"+width+"px"
                });

                if(idx) {
                    idx = parseInt(idx);
                    if(idx == o_idx) {
                        return false;
                    }

                    c_idx = idx;
                } else {
                    c_idx = (o_idx + 1) % count;
                }

                $bnnr.eq(o_idx).animate(
                    { left: "-="+width+"px" }, settings.duration,
                    function() {
                        $(this).css("display", "none").css("left", width+"px");
                    }
                );

                $bnnr.eq(c_idx).css("display", "block").animate(
                    { left: "-="+width+"px" }, settings.duration,
                    function() {
                        $bnnr_btn.eq(o_idx).parent().removeClass("active_bt");
                        $bnnr_btn.eq(c_idx).parent().addClass("active_bt");
                        o_idx = c_idx;
                    }
                );
            }

            function set_interval() {
                if(count > 1) {
                    clear_interval();

                    if($(".pause button").hasClass("paused"))
                        return false;

                    intervals[el_id] = setInterval(left_rolling, settings.interval);
                }
            }

            function clear_interval() {
                if(intervals[el_id]) {
                    clearInterval(intervals[el_id]);
                }
            }
        },
        stop: function()
        {
            var el_id = this[0].id;
            if(intervals[el_id])
                clearInterval(intervals[el_id]);
        }
    };

    $.fn.bannerRolling = function(option) {
        if (methods[option])
            return methods[option].apply(this, Array.prototype.slice.call(arguments, 1));
        else
            return methods.init.apply(this, arguments);
    }
}(jQuery));

$(function() {
    $("#slide_visual").bannerRolling();
    // 기본 설정값을 변경하려면 아래처럼 사용
    //$("#sbn_idx").leftRolling({ interval: 6000, duration: 2000 });
});
</script>