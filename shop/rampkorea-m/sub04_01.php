<?
$mNum="0401";
?>	
	<?php include "./include/sub_head.php";?>
	
	<div id="contents">
		<!-- contents -->
        <div class="contents">
          <img src="images/ti_04.png" width="100%">
          <div class="map">
<!-- * Daum 지도 - 지도퍼가기 -->
<!-- 1. 지도 노드 -->
<div id="daumRoughmapContainer1465541083328" class="root_daum_roughmap root_daum_roughmap_landing"></div>

<!--
	2. 설치 스크립트
	* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
-->
<script charset="UTF-8" class="daum_roughmap_loader_script" src="http://dmaps.daum.net/map_js_init/roughmapLoader.js"></script>

<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1465541083328",
		"key" : "b9v6",
		"mapWidth" : "310",
		"mapHeight" : "350"
	}).render();
</script>
    		</div>
            
		</div>
        <!-- contents //--> 
	</div>
	<?php include "./include/footer.php";?>