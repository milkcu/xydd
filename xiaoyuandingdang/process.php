<?php
require_once 'inc/all.php';
require_once 'nusoapClient.php';
session_start ();

$from = $_GET ['from'];

if ($from == "register") {
	//
	$uname = $_POST ['uname'];
	$upassword = $_POST ['upassword'];
	$upassword2 = $_POST ['upassword2'];
	$uemail = $_POST ['uemail'];
	display_html_header ( '注册结果' );
	if(password_confirm($upassword, $upassword2) == 4) {
		display_alert('两次输入的密码不一致！', 'warning');
	} else {
		$r = register($uname, $upassword, $uemail);
		if($r == 2) {
			display_alert('注册成功！', 'success');
			$_SESSION['uid'] = get_uid($uname);
			/*
			$mmc=memcache_init();
			if($mmc == false) {
				echo "mc init failed\n";
			} else {
				memcache_set($mmc, "uid", get_uid($uname));
				//echo memcache_get($mmc,"key");
			}
			*/
		} else if($r == 41) {
			display_alert('该用户名已注册!', 'success');
		} else if($r == 42) {
			display_alert('该邮箱已注册！', 'danger');
		} else {
			display_alert('注册失败！', 'warning');
		}
	}
	display_html_footer ();
} else if ($from == "login") {
	//
	$uname = $_POST ['uname'];
	$upassword = $_POST ['upassword'];
	display_html_header ( '登录结果' );
	if (($r = login ( $uname, $upassword )) == 2) {
		//echo $_SESSION ['uid'];
		//echo '登录成功！';
		display_alert('登录成功！', 'success');
		$_SESSION['uid'] = get_uid($uname);
		/*
		$mmc=memcache_init();
		if($mmc == false) {
			echo "mc init failed\n";
		} else {
			memcache_set($mmc, "uid", get_uid($uname));
			//echo memcache_get($mmc,"key");
		}
		*/
	} else {
		//echo '登录失败！';
		display_alert('登录失败！', 'danger');
	}
	
	display_html_footer ();
} else if ($from == "post") {
	//
	$ptype = $_POST ['ptype'];
	$ptitle = $_POST ['ptitle'];
	// $pdetail = $_POST['pdetail'];
	$uid = $_SESSION ['uid'];
	if(isset($_POST['content1']) && $_POST['content1'] != '') {
		$content = $_POST['content1'];
	} else {
		$content = $_POST['content2'];
	}
	if (!get_magic_quotes_gpc ()) {
		$pdetail = addslashes ( $content );
	} else {
		$pdetail = $content;
	}
	
	display_html_header ( '信息发布成功' );
	if(add_post ( $ptype, $ptitle, $pdetail, $uid ) == 2) {
		display_html_header ( '信息发布成功！' );
		display_alert('发布成功！', 'success');
		display_html_footer ();
	} else {
		display_html_header ( '信息发布失败！' );
		display_alert('插入数据库异常！', 'danger');
		display_html_footer ();
	}
	
	//echo '发布成功！';
	
} else if ($from == "logout") {
	//
	session_destroy ();
	display_html_header ( '退出成功' );
	
	//echo '退出成功！';
	display_alert('退出成功！', 'success');
	session_destroy();
	// display_msg('成功', '退出成功！');
	
	display_html_footer ();
} else if ($from == "comment") {
	//
	$pid = $_POST ['pid'];
	$uid = $_SESSION ['uid'];
	$cdetail = $_POST ['cdetail'];
	if(add_comment ( $pid, $uid, $cdetail ) == 2) {
		display_html_header ( '评论成功' );
		display_alert('评论成功！', 'success');
		display_html_footer ();
	} else {
		display_html_header ( '评论失败' );
		display_alert('评论失败！', 'danger');
		display_html_footer ();
	}
	
} else if ($from == "modify") {
	//
	$upassword = $_POST ['upassword'];
	$upassword2 = $_POST ['upassword2'];
	$uemail = $_POST ['uemail'];
	//$uhead = $_FILES ["uhead"];
	$uhead = $_POST['uhead'];
	$udescription = $_POST ['udescription'];
	display_html_header ( '用户信息修改' );
	if(password_confirm($upassword, $upassword2) == 2) {
		modify ( $_SESSION['uid'], $upassword, $uemail, $uhead, $udescription );
		display_alert('用户信息修改成功！', 'success');
	} else {
		display_alert('两次输入密码不一致！', 'danger');
	}
	display_html_footer ();
} else if ($from == "forgot") {
	//
	$uemail = $_POST ['uemail'];
	display_html_header ( '发送邮件中' );
	if(forgot ( $uemail ) == 4) {
		display_alert('该用户不存在！', 'danger');
	} else {
		display_alert('密码找回邮件已发送', 'success');
	}
	display_html_footer ();
} else if ($from == "contact") {
	$send_uid = $_POST ['send_uid'];
	$receive_uid = $_POST ['receive_uid'];
	$send_detail = $_POST ['send_detail'];
	$to = show_user($receive_uid)->uemail;
	$subject = get_uname($send_uid).'在校园叮当向您发送消息啦'; 
	$body = '<p>' . get_uname ( $receive_uid ) . '，您好！</p>' . '<p>在校园叮当中，您的好友<a href="http://xydd.sinaapp.com/list.php?page=' . $send_uid . '">' . get_uname ( $send_uid ) . '</a>向您发送消息了。内容如下：</p>' . '<p>' . $send_detail . '</p>' . '请及时<a href="http://xydd.sinaapp.com/list.php?page=' . $send_uid . '">回复</a>哦。。。' . '<p>校园叮当</p>';
	display_html_header ( '消息发送结果' );
	// echo $to.$body;
	send_html_mail ( $to, $subject, $body );
	display_alert('消息发送成功', 'success');
	display_html_footer ();
} else if ($from == "confirm") {
	$uid = $_GET ['user'];
	$md5pw = $_GET ['value'];
	display_html_header ( '邮箱验证结果' );
	if(confirm_email ( $uid, $md5pw ) == 2) {
		display_alert('邮箱验证成功！', 'success');
	} else {
		display_alert('参数无效！', 'danger');
	}
	display_html_footer ();
} else if ($from == "reset") {
	$uid = $_GET ['user'];
	$md5pw = $_GET ['value'];
	$_SESSION ['uid'] = $uid;
	display_html_header ( '重置密码' );
	if (reset_goon ( $uid, $md5pw ) == 2) {
		display_reset_form ( $uid );
	} else {
		display_alert('参数无效！', 'danger');
	}
	display_html_footer ();
}
