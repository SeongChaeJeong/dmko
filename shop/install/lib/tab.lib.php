<?
if (!defined('_GNUBOARD_')) exit;

// 식별형표(TAB) 시작
function latest_tab($tab_dir,$titles,$skin_dirs,$bo_tables,$first_table,$rows, $subject_lens){
	
	global $g5;

	$title=explode("|",$titles);
	$skin_dir=explode("|",$skin_dirs);
	$bo_table=explode("|",$bo_tables);

	$row=explode("|",$rows);
	$subject_len=explode("|",$subject_lens);


    if (!$tab_dir) $tab_dir = 'basic';

    if(G5_IS_MOBILE) {
        $tab_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/tab/'.$tab_dir;
        $tab_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/tab/'.$tab_dir;
    } else {
        $tab_skin_path = G5_SKIN_PATH.'/tab/'.$tab_dir;
        $tab_skin_url  = G5_SKIN_URL.'/tab/'.$tab_dir;
    }
		
	//$tab_skin_path = G5_PATH."/skin/tab/".$tab_skin;
	include "$tab_skin_path/tab.skin.php";
	//echo "<br>".$bo_tables;
}
?>
