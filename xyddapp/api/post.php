<?php
require_once '../nusoapClient.php';
//require_once '../inc/post.php';
$pid = $_GET['pid'];
$post_obj = show_post($pid);

$obj = new stdClass();
$obj->response = new stdClass();
$obj->response->content = "<h1>".$post_obj->ptitle."</h1>"
                         ."<h4>作者：".$post_obj->uname." 发布时间：".$post_obj->pcreated." ".$post_obj->phint."次访问</h4>"
                         .$post_obj->pdetail;
$obj->response->share_url = 'http://xiaoyuandingdang.sinaapp.com/post.php?pid='.$pid;
$obj->response->comment_num = $pid;
//print_r($obj);
echo json_encode($obj);
