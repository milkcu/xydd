<?php
require_once 'inc/all.php';
require_once 'nusoapClient.php';
session_start ();
$pid = $_GET ['pid'];
$ptype = $_GET['ptype'];
if($pid == 0) {
	// 发布信息
	display_html_header ( "发布信息" );
	display_post_form ( $ptype );
	display_html_footer ();
} else {
	// 浏览信息
	$post_obj = show_post($pid);
	display_html_header ( $post_obj->ptitle );
	
	display_user_state ();
	echo "<h2>$post_obj->ptitle</h2>";
	echo '<div class="well well-sm">';
	echo '<b><a href="/index.php">校园叮当</a> / ';
	switch ($post_obj->ptype) {
		case news:
			echo '<a href="/list.php?page=news&lpage=1">新鲜事</a>';
			break;
		case know:
			echo '<a href="/list.php?page=know&lpage=1">校园知道</a>';
			break;
		case market:
			echo '<a href="/list.php?page=market&lpage=1">跳蚤市场</a>';
			break;
		case lf:
			echo '<a href="/list.php?page=lf&lpage=1">失物招领</a>';
			break;
		case com:
			echo '<a href="/list.php?page=com&lpage=1">商家资讯</a>';
			break;
	}
	echo ' / <a href="/post.php?pid='.$pid.'">' . $post_obj->ptitle . '</a></b>';
	echo '</div>';
	echo '<div class="well well-lg container post-detail" id="post-detail-img">';
	
	echo $post_obj->pdetail;
	echo '</div>';
	display_jiathis ();
	display_comment_form ( $pid );
	//display_comment_list ( $post_obj->cid_array );
	$cid_array = (array)get_cid_array($pid);
	display_comment_list($cid_array);
	
	display_html_footer ();
}