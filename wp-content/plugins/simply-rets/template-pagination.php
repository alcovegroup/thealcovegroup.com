<?php
#####
# PAGINATION START
#####
$thecount = count($response);
$perpage = $GLOBALS['perpage'];
$current_page = (!empty($_GET['pageNumber'])) ? $_GET['pageNumber'] : '';
$clean_URI = preg_replace('~(.*)((&|\?)pageNumber=(\d+)?)~', '$1', $_SERVER[REQUEST_URI]);
$pagiantion_link = "http://$_SERVER[HTTP_HOST]$clean_URI";
$pagination = SimplyRetsApiHelper::pagination($thecount, $pagiantion_link, 5, $current_page);
$cont .= $pagination;
?>