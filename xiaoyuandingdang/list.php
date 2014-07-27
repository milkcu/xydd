<?php
require_once 'inc/all.php';
require_once 'nusoapClient.php';
session_start ();
$page = $_GET ['page'];
$lpage = $_GET['lpage'];

switch ($page){
	case 'news':
		display_html_header('新鲜事');
		break;
	case 'know':
		display_html_header('校园知道');
		break;
	case 'market':
		display_html_header('跳蚤市场');
		break;
	case 'lf':
		display_html_header('失物招领');
		break;
	case 'com':
		display_html_header('商业资讯');
		break;
	default:
		display_html_header(get_uname($page).'的消息');
		break;
}
display_user_state ();
// display_list_welcome($page);

display_post_list ( $page, $lpage = 1 );

display_html_footer ();
