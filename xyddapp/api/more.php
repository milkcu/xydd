<?php
require_once '../nusoapClient.php';
//require_once '../inc/post.php';
//require_once '../inc/util.php';
$ptype = $_GET['ptype'];
$lpage = $_GET['lpage'];
$next_lpage = $lpage + 1;
$obj = new stdClass();
$obj->response = new stdClass();
$obj->response->name = '';
$obj->response->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype='.$ptype.'&lpage='.$next_lpage;
$obj->response->items = array();

$pid_array = get_pid_array($ptype, $lpage);

$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->items[$i] = new stdClass();
	$obj->response->items[$i]->id = $post_obj->pid;
	$obj->response->items[$i]->thumbnail_url = '';
	$obj->response->items[$i]->title = $post_obj->ptitle;
	$obj->response->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 30);
	$obj->response->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}

echo json_encode($obj);
