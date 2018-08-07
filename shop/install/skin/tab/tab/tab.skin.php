<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$title_num=sizeof($title);		//타이틀 갯수
$table_num=sizeof($bo_table);	//게시판 갯수

add_stylesheet('<link rel="stylesheet" href="'.$tab_skin_url.'/style.css">', 0);
?>
	<div class="tabs">
		<ul class="tab-menu">
		<?php
		for($i=0;$i<$table_num;$i++){
			$tabNum = $i+1;
					echo "<li><a href='#tab-$tabNum'>".$title[$i]."</a></li>";
		}
		?>
		</ul>
	<?php
		for($i=0;$i<$table_num;$i++){
			$tabNum = $i+1;
			echo "<div class='tab-content' id='tab-$tabNum'>".latest($skin_dir[$i],$bo_table[$i],$row[$i],$subject_len[$i])."</div>";
	}?>
	</div>

<script type="text/javascript">

$(function() { $(".tabs").fwd_tabs(); });

(function ( $ ) {
	$.fn.fwd_tabs = function() {
		return this.each(function() {
			var tabs = $(this);
			var tabMenuList = $(".tab-menu", tabs).children();

			for (i = $(".tab-content", tabs).length, j = tabMenuList.length; i < j; i++ ) {
				tabs.append('<div class="tab-content"></div>');
	    		}

			var tabContent = $(".tab-content", tabs);

			tabContent.slice(1).hide();

			tabMenuList.eq(0).addClass("active");

			tabMenuList.find("a").click(function(e) {
				var theParent = $(this).parent().index();

				tabMenuList.removeClass('active').eq(theParent).addClass('active');

				tabContent.hide().eq(theParent).show();

				/* AJAX */
				if (tabContent.eq(theParent).html().length == 0 && $(this).attr("href").substr(0, 1) != "#") {
					var fragment = ($(this).data("fragment") ? " " + $(this).data("fragment") : "");
					tabContent.eq(theParent).append('<div class="tab-loading"></div>').load($(this).attr("href") + fragment, function(response, status, xhr) {
						if (status == "error") {
							tabContent.eq(theParent).html("죄송합니다 내용을로드 할 수 없습니다.");
						}
					});
				}
				e.preventDefault();
			});
		});
	}
}(jQuery));
</script>