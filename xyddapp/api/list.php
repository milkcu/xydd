<?php
//require_once '../inc/all.php';
require_once '../nusoapClient.php';
//require_once '../inc/post.php';
//require_once '../inc/util.php';
$lpage = $_GET['lpage'];
$next_lpage = $lpage + 1;
$obj = new stdClass();
$obj->response = new stdClass();
$obj->response->date = time();
$obj->response->categorys = array();
//begin categorys
$obj->response->categorys[0] = new stdClass();
$obj->response->categorys[0]->name = '新鲜事';
$obj->response->categorys[0]->url = 'http://xiaoyuandingdang.sinaapp.com/list.php?page=news&lpage=1';
$obj->response->categorys[1] = new stdClass();
$obj->response->categorys[1]->name = '校园知道';
$obj->response->categorys[1]->url = 'http://xiaoyuandingdang.sinaapp.com/list.php?page=news&lpage=1';
$obj->response->categorys[2] = new stdClass();
$obj->response->categorys[2]->name = '跳蚤市场';
$obj->response->categorys[2]->url = 'http://xiaoyuandingdang.sinaapp.com/list.php?page=news&lpage=1';
$obj->response->categorys[3] = new stdClass();
$obj->response->categorys[3]->name = '失物招领';
$obj->response->categorys[3]->url = 'http://xiaoyuandingdang.sinaapp.com/list.php?page=news&lpage=1';
$obj->response->categorys[4] = new stdClass();
$obj->response->categorys[4]->name = '商家资讯';
$obj->response->categorys[4]->url = 'http://xiaoyuandingdang.sinaapp.com/list.php?page=news&lpage=1';
//end categorys
$obj->response->list = array();
//begin news
$obj->response->list[0] = new stdClass();
$obj->response->list[0]->name = '新鲜事';
$obj->response->list[0]->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype=news&lpage='.$next_lpage;
$obj->response->list[0]->items = array();
$pid_array = get_pid_array('news', $lpage);
//$pid_array = array_reverse ( $pid_array );
$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->list[0]->items[$i] = new stdClass();
	$obj->response->list[0]->items[$i]->id = $post_obj->pid;
	$obj->response->list[0]->items[$i]->thumbnail_url = '';
	$obj->response->list[0]->items[$i]->title = $post_obj->ptitle;
	$obj->response->list[0]->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->list[0]->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 30);
	$obj->response->list[0]->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}
//end news

//begin know
$obj->response->list[1] = new stdClass();
$obj->response->list[1]->name = '校园知道';
$obj->response->list[1]->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype=know&lpage='.$next_lpage;
$obj->response->list[1]->items = array();
$pid_array = get_pid_array('know', $lpage);
//$pid_array = array_reverse ( $pid_array );
$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->list[1]->items[$i] = new stdClass();
	$obj->response->list[1]->items[$i]->id = $post_obj->pid;
	$obj->response->list[1]->items[$i]->thumbnail_url = '';
	$obj->response->list[1]->items[$i]->title = $post_obj->ptitle;
	$obj->response->list[1]->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->list[1]->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 100);
	$obj->response->list[1]->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}
//end know

//begin market
$obj->response->list[2] = new stdClass();
$obj->response->list[2]->name = '跳蚤市场';
$obj->response->list[2]->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype=market&lpage='.$next_lpage;
$obj->response->list[2]->items = array();
$pid_array = get_pid_array('market', $lpage);
//$pid_array = array_reverse ( $pid_array );
$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->list[2]->items[$i] = new stdClass();
	$obj->response->list[2]->items[$i]->id = $post_obj->pid;
	$obj->response->list[2]->items[$i]->thumbnail_url = '';
	$obj->response->list[2]->items[$i]->title = $post_obj->ptitle;
	$obj->response->list[2]->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->list[2]->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 100);
	$obj->response->list[2]->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}
//end market

//begin lf
$obj->response->list[3] = new stdClass();
$obj->response->list[3]->name = '失物招领';
$obj->response->list[3]->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype=lf&lpage='.$next_lpage;
$obj->response->list[3]->items = array();
$pid_array = get_pid_array('lf', $lpage);
//$pid_array = array_reverse ( $pid_array );
$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->list[3]->items[$i] = new stdClass();
	$obj->response->list[3]->items[$i]->id = $post_obj->pid;
	$obj->response->list[3]->items[$i]->thumbnail_url = '';
	$obj->response->list[3]->items[$i]->title = $post_obj->ptitle;
	$obj->response->list[3]->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->list[3]->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 100);
	$obj->response->list[3]->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}
//end lf

//begin com
$obj->response->list[4] = new stdClass();
$obj->response->list[4]->name = '商业资讯';
$obj->response->list[4]->more_url = 'http://xyddapp.sinaapp.com/api/more.php?ptype=com&lpage='.$next_lpage;
$obj->response->list[4]->items = array();
$pid_array = get_pid_array('com', $lpage);

$i = 0;
foreach ( $pid_array as $pid ) {
	$post_obj = show_post($pid);
	$obj->response->list[4]->items[$i] = new stdClass();
	$obj->response->list[4]->items[$i]->id = $post_obj->pid;
	$obj->response->list[4]->items[$i]->thumbnail_url = '';
	$obj->response->list[4]->items[$i]->title = $post_obj->ptitle;
	$obj->response->list[4]->items[$i]->time = strtotime($post_obj->pcreated);
	$obj->response->list[4]->items[$i]->short_content = substr(strip_tags($post_obj->pdetail), 0, 100);
	$obj->response->list[4]->items[$i]->detail_url = 'http://xyddapp.sinaapp.com/api/post.php?pid='.$pid;
	$i++;
}
//end com
//print_r($obj);
echo json_encode ( $obj );