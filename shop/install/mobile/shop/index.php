<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_MSHOP_PATH.'/_head.php');
include_once(G5_LIB_PATH.'/tab.lib.php'); 
?>


<script language="JavaScript">

//모바일 페이지로 이동. 

//http://en.wikipedia.org/wiki/List_of_user_agents_for_mobile_phones

var uAgent = navigator.userAgent.toLowerCase();

var mobilePhones = new Array('iphone','ipod','android','blackberry','windows ce',

        'nokia','webos','opera mini','sonyericsson','opera mobi','iemobile');

for(var i=0;i<mobilePhones.length;i++)

    if(uAgent.indexOf(mobilePhones[i]) != -1)

        document.location = "http://m.dmko.net";

</script>