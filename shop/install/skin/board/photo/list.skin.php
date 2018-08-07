<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<style>

/* 리스트 효과 */

a{color:#666; text-decoration:none; outline:none;}
img,.searchtxt,.searchbtn,.pinglun input.submit{border:0;}
ol,ul,li{list-style:none;}
dl,dt,dd,ul,li{margin:0;padding:0;}
input,textarea{outline:none;}
html,body,form,p,div,h1,h2,h3,h4,h5,h6{-webkit-text-size-adjust:none; font-weight:normal;}
.common{margin:0 auto; width:1200px; position:relative;}
.common ul li{margin-left:20px;}
.clear{clear:both;}
.summary{background:#333;}
.listbox{float:left; margin-bottom:20px; padding:10px; _padding:10px 10px 8px 10px ;background:#f6f6f6; width:260px; height:240px; position:relative;}
.listimg{float:left; width:260px; height:165px; position:relative; overflow:hidden;}
.listimg img{background:#333; width:260px; height:165px; top:0; left:0; position:absolute;}
.summary{width:260px;height:165px;top:165px;left:0;position:absolute;}
.summarytxt{margin:5px 10px;width:250px;height:auto;line-height:22px;font-size:12px;color:#cfcfcf;}
.listinfo{_margin-bottom:3px; padding-left:10px; width:250px; line-height:22px; font-size:12px;}
.listinfo a{font-size:12px;}
.listtitle{float:left; margin-top:8px; _margin-top:-2px; width:250px; font-size:14px;}
.listtitle a{font-size:14px;}
.listtitle a:hover{color:#f55555;}
.listtag{float:left;padding-left:18px;background:url(<?=$board_skin_url?>/img/taglist.gif) 0 5px no-repeat;width:232px;color:#999;}
.listtag a{margin:0 8px 0 0;margin:2px 8px -2px 0\9;_margin:0 8px 0 0;color:#999;}
.listtag a:hover{color:#2ad2bb;}
.listdate{float:left;margin-right:13px;padding-left:18px;background:url(<?=$board_skin_url?>/img/time.gif) 0 5px no-repeat;color:#999;}
.listview{float:left;margin-right:13px;padding-left:24px;background:url(<?=$board_skin_url?>/img/view.gif) 0 5px no-repeat;color:#999;}
.listcomment{float:left;margin-right:13px;padding-left:20px;background:url(<?=$board_skin_url?>/img/comment.gif) 0 5px no-repeat;color:#999;}
.listdemo a{float:left;margin-top:0;margin-top:2px\9;_margin-top:0;color:#999;white-space:nowrap;}
.listdemo a:hover{color:#2ad2bb;}
</style>
<script>
$(document).ready(function(){$('.listimg').hover(function(){$(".summary",this).stop().animate({top:'110px'},{queue:false,duration:180});},function(){$(".summary",this).stop().animate({top:'165px'},{queue:false,duration:180});});});
</script>
<!-- 게시판 목록 시작 { -->
    <div class="common">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

<div id="bo_gall" style="width:<?php echo $width; ?>">
    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
    <div class="common">
      <ul>
<?php for ($i=0; $i<count($list); $i++) {
	if($i>0 && ($i % $bo_gallery_cols == 0))
		$style = 'clear:both;';
	else
		$style = '';
	if ($i == 0) $k = 0;
	$k += 1;
	if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
 ?>      
        <li class="listbox mr20">
          <div class="listimg">
            <a href="<?php echo $list[$i]['href'] ?>">
            <?php
            if ($list[$i]['is_notice']) { // 공지사항  ?>
                <strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
            <?php } else {
                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
            
                if($thumb['src']) {
                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
                } else {
                    $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
                }
            
                echo $img_content;
            }
             ?>
            </a>
            <div class="summary">
              <div class="summarytxt">
                <p><?php echo cut_str($list[$i]['wr_content'], 40, "..") ?></p>
              </div>
            </div>
          </div>
          <div class="listinfo">
            <div class="listtitle"><a href="<?php echo $list[$i]['href'] ?>"><?php echo $list[$i]['subject'] ?></a></div>
            <div class="listtag">
                    <?php if ($is_category && $list[$i]['ca_name']) {?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <?php echo $list[$i]['name'] ?>
            </div>
            <div class="listdate"><?php echo $list[$i]['datetime'] ?></div>
            <div class="listview"><?php echo $list[$i]['wr_hit']; ?></div>
            <div class="listcomment"><?php echo $list[$i]['comment_cnt']; ?></div>
            <div class="listdemo">
					<?php if ($is_checkbox) { ?>
                    <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                    <?php } ?>
            </div>
          </div>
        </li>
<?php } ?>
<?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
      </ul>
    </div>
    </form>
    
    
    





    <ul id="gall_ul">
   
    </ul>
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="common">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시물 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시물 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
