<?php
require_once 'inc/all.php';
//require_once 'nusoapService.php';
//print_r(show_post(46));
//print_r(json_encode(show_post(46)));
//print_r(get_cid_array_json(46));
//print_r(show_comment(1));
//print_r(get_comment_uid(2));
//print_r(show_user(1));
//print_r(register('ww12', 'hello', 'ww12'));
//send_html_mail('184324224@qq.com', 'test', 'hi');
//print_r(get_cid_array(63));
//$pid_array = get_pid_array('know', 1);
//print_r($pid_array);
$post_obj = show_post(37);
//print_r($post_obj->pcreated);
//echo '==========================================';
//echo strtotime($post_obj->pcreated);
$r = strip_tags($post_obj->pdetail);
print_r($r);