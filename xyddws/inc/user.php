<?php
require_once 'db.php';
require_once 'mail.php';
function register($uname, $upassword, $uemail) {
	$conn = db_connect_m ();
	$result = $conn->query ( "select * from user where uname='" . $uname . "'" );
	
	if ($result->num_rows > 0) {
		// echo "该用户名已注册！请返回重新选择。";
		// display_alert('该用户名已注册!', 'success');
		// return false;
		return 41;
	}
	$result2 = $conn->query ( "select * from user where uemail='" . $uemail . "'" );
	if ($result->num_rows > 0) {
		// echo '该邮箱地址已注册。';
		// display_alert('该邮箱已注册！', 'danger');
		// return false;
		return 42;
	}
	$upassword = md5 ( $upassword );
	$result = $conn->query ( "insert into user values
                         (null, '" . $uname . "', '" . $upassword . "', '" . $uemail . "', null, null, 'user', '1', 'Hello, world.', 0, 'http://xydd-xydd.stor.sinaapp.com/head/default.jpg')" );
	if (! $result) {
		// echo '暂时无法注册，请稍后再试！';
		// display_alert('暂时无法注册！', 'info');
		return 4;
	} else {
		// echo '用户注册成功';
		$_SESSION ['uid'] = get_uid ( $uname );
		$uid = $_SESSION ['uid'];
		$to = get_uemail ( $uid );
		$body = '<p>' . get_uname ( $uid ) . '，您好！</p><p>欢迎注册校园叮当账号，请打开下面网址，完成邮箱认证。</p><p>http://xiaoyuandingdang.sinaapp.com/process.php?from=confirm&user=' . $uid . '&value=' . get_upassword ( $uid ) . '</p><p>如果您在使用中遇到任何问题，请联系liuxintong@outlook.com。</p><p>校园叮当</p>';
		send_html_mail ( $to, '校园叮当账号注册成功', $body );
		//echo "send_html_mail ( $to, '校园叮当账号注册成功', $body )";
		$ptype = 'news';
		$ptitle = '欢迎' . $uname . '来到校园叮当';
		$pdetail = '我是新手，我来报道。';
		add_post ( $ptype, $ptitle, $pdetail, $uid );
		// display_alert('用户注册成功！', 'success');
		return 2;
	}
}
function login($uname, $upassword) {
	$conn = db_connect_s ();
	$upassword = md5 ( $upassword );
	$result = $conn->query ( "select * from user where uname='" . $uname . "' and upassword = '" . $upassword . "'" );
	
	if ($result->num_rows > 0) {
		$_SESSION ['uid'] = get_uid ( $uname );
		add_ugrade ( get_uid ( $uname ), 10 );
		return 2;
	} else {
		// echo '无法登录！';
		// display_alert('密码错误！', 'danger');
		return 4;
	}
}
function add_ugrade($uid, $ugrade) {
	$conn = db_connect_m ();
	$result = $conn->query ( "select ugrade from user where uid = '" . $uid . "'" );
	$row = $result->fetch_row ();
	$new_ugrade = $row [0] + $ugrade;
	$result = $conn->query ( "update user set ugrade = '" . $new_ugrade . "' where uid = '" . $uid . "'" );
	if (! $result) {
		return 4;
	} else {
		return 2;
	}
}

function show_user($uid) {
	$user_obj = new stdClass();
	$user_obj->uid = $uid;
	$user_obj->uname = get_uname($uid);
	$user_obj->uemail = get_uemail($uid);
	$user_obj->ugrade = get_ugrade($uid);
	$user_obj->udescription = get_udescription($uid);
	$user_obj->uhead = get_uhead($uid);
	return $user_obj;
}

function modify($uid, $upassword, $uemail, $uhead, $udescription) {
	// 修改密码功能后期完善
	if ($upassword != '') {
		$conn = db_connect_m ();
		$upassword = md5($upassword);
		$result = $conn->query ( "update user set upassword = '" . $upassword . "' where uid = '" . $uid . "'" );
		if (! $result) {
			//return 41;
		} else {
			//return 2;
		}
	}
	if ($uemail != '') {
		$conn = db_connect_m ();
		$result = $conn->query ( "update user set uemail = '" . $uemail . "' where uid = '" . $uid . "'" );
		if (! $result) {
			//return 42;
		} else {
			set_uconfirm ( $uid, 0 );
			//return 2;
		}
		
	}
	if ($uhead != '') {
		// upload image
		// print_r($uhead);
		//$stor = new SaeStorage ();
		//$stor->upload ( 'xydd', 'head/' . $_SESSION ['uid'] . '.jpg', $uhead ["tmp_name"] );
		$conn = db_connect_m();
		$result = $conn->query("update user set uhead='".$uhead."' where uid='".$uid."'");
		//echo '头像修改成功！';
		//display_alert('头像修改成功！', 'success');
		// move_uploaded_file ($uhead["tmp_name"], "upload/".$uhead["name"]);
		if (! $result) {
			//return 43;
		} else {
			//return 2;
		}
	}
	if (isset ( $udescription )) {
		$conn = db_connect_m ();
		$result = $conn->query ( "update user set udescription = '" . $udescription . "' where uid = '" . $uid . "'" );
		if (! $result) {
			return 44;
		} else {
			//return 2;
		}
	}
	//echo '修改成功';
	//display_alert('个人资料更新成功！', 'success');
	return 2;
}


function get_uconfirm($uid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select uconfirm from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$uconfirm = $row [0];
	return $uconfirm;
}
function set_uconfirm($uid, $uconfirm) {
	$conn = db_connect_m ();
	$result = $conn->query ( "update user set uconfirm='" . $uconfirm . "' where $uid='" . $uid . "'" );
}
function confirm_email($uid, $md5pw) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select upassword from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$dbpw = $row [0];
	if ($dbpw == $md5pw) {
		//echo '邮箱验证成功';
		//display_alert('邮箱验证成功！', 'success');
		set_uconfirm ( $uid, 1 );
		return 2;
	} else {
		//echo '参数无效。';
		//display_alert('参数无效！', 'danger');
		return 4;
	}
}
function reset_goon($uid, $md5pw) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select upassword from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$dbpw = $row [0];
	if ($dbpw == $md5pw) {
		return 2;
	} else {
		//echo '参数无效。';
		//display_alert('参数无效！', 'danger');
		return 4;
	}
}

function get_upassword($uid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select upassword from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$upassword = $row [0];
	return $upassword;
}
function forgot($uemail) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uid from user where uemail='" . $uemail . "'" );
	$row = $result->fetch_row ();
	if ($result->num_rows > 0) {
		$uid = $row [0];
		$email_body = '<p>尊敬的' . get_uname ( $uid ) . '，</p><p>您在校园叮当申请重置密码，请打开下面链接继续。</p><p>http://xiaoyuandingdang.sinaapp.com/process.php?from=reset&user=' . $uid . '&value=' . get_upassword ( $uid ) . '</p><p>校园叮当</p>';
		send_html_mail ( $uemail, '校园叮当密码邮件找回', $email_body );
		return 2;
	} else {
		//echo '该用户不存在';
		//display_alert('该用户不存在！', 'danger');
		return 4;
	}
}


function get_uid($uname) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uid from user where uname='" . $uname . "'" );
	$row = $result->fetch_row ();
	$uid = $row [0];
	return $uid;
}
function get_uname($uid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uname from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$uname = $row [0];
	return $uname;
}
function get_uemail($uid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uemail from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$uemail = $row [0];
	return $uemail;
}
function get_uinfo($uid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uemail from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$uinfo = $row [0];
	return $uinfo;
}
function get_uhead($uid) {
	$conn = db_connect_s();
	$result = $conn->query("select uhead from user where uid='".$uid."'");
	$row = $result->fetch_row();
	$uhead = $row[0];
	return $uhead;
}
function get_ugrade($uid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select ugrade from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$grade = $row [0];
	return $grade;
}
function get_udescription($uid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select udescription from user where uid='" . $uid . "'" );
	$row = $result->fetch_row ();
	$udescription = $row [0];
	return $udescription;
}

