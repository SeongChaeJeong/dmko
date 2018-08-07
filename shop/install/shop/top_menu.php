<div id="top_menu">
<ul class="topmenu">
  <li><img src="<?php echo G5_URL ?>/images/menu0.gif" /></li>
  <li class="s1"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=70"><img src="<?php echo G5_URL ?>/images/menu1_off.gif" class="rollover" /></a></li>
  <li class="s2"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=10"><img src="<?php echo G5_URL ?>/images/menu2_off.gif" class="rollover" alt="" /></a></li>
  <li class="s2"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=20"><img src="<?php echo G5_URL ?>/images/menu3_off.gif" class="rollover" alt="" /></a></li>
  <li class="s2"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=30"><img src="<?php echo G5_URL ?>/images/menu4_off.gif" class="rollover" alt="" /></a></li>
  <li class="s2"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=40"><img src="<?php echo G5_URL ?>/images/menu5_off.gif" class="rollover" alt="" /></a></li>
  <li class="s3"><a href="<?php echo G5_URL ?>/shop/list.php?ca_id=50"><img src="<?php echo G5_URL ?>/images/menu6_off.gif" class="rollover" alt="" /></a></li>
  <li class="s4"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=photo"><img src="<?php echo G5_URL ?>/images/menu7_off.gif" class="rollover" alt="" /></a></li>
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
</div>