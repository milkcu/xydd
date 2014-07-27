<?php
require_once 'db.php';
require_once 'user.php';
function show_post($pid) {
	$post_obj = new stdClass();
	$post_obj->pid = $pid;
	$post_obj->uid = get_post_uid($pid);
	$post_obj->uname = get_uname(get_post_uid($pid));
	$post_obj->ptitle = get_post_title($pid);
	$post_obj->pdetail = get_post_detail($pid);
	$post_obj->pcreated = get_post_pcreated($pid);
	$post_obj->phint = get_post_phint($pid);
	$post_obj->cid_array = get_post_comment($pid);
	$post_obj->ptype = get_post_ptype($pid);
	return $post_obj;
}

function get_pid_array($ptype, $lpage) {
	//
	$conn = db_connect_s ();
	$item_begin = 15*($lpage-1);
	$result = $conn->query ( "select pid from post where ptype = '" . $ptype . "'order by pcreated desc limit ".$item_begin.", 15" );
	if (! $result) {
		//display_alert('无该类型信息！', 'info');
	} else {
		for($count = 1; $row = $result->fetch_row (); ++ $count) {
			$pid_array [$count] = $row [0];
		}
		return $pid_array;
	}
}

function get_user_post($uid, $lpage) {
	$conn = db_connect_s ();
	$item_begin = 15*($lpage-1);
	$result = $conn->query ( "select pid from post where uid = '" . $uid . "'order by pcreated desc limit ".$item_begin.", 15" );
	if (! $result) {
		//echo "无信息！";
		//display_alert('无该类型信息！', 'info');
	} else {
		for($count = 1; $row = $result->fetch_row (); ++ $count) {
			$pid_array [$count] = $row [0];
		}
		return $pid_array;
	}
}

function get_type_count($ptype) {
	$conn = db_connect_s();
	$result = $conn->query("select count(*) from post where ptype='".$ptype."'");
	if(!$result) {
		return 0;
	} else {
		$row = $result->fetch_row();
		return $row[0];
	}
}

function add_post($ptype, $ptitle, $pdetail, $uid) {
	$conn = db_connect_m ();
	if (! $conn->query ( "insert into post values(null,'" . $uid . "', '" . $ptitle . "', '" . $pdetail . "', null, '" . $ptype . "', null, 0)" )) {
		//display_alert('插入数据库异常！', 'danger');
		return 4;
	}
	add_ugrade ( $uid, 20 );
	return 2;
}

function get_post_title($pid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select ptitle from post where pid = '" . $pid . "'" );
	if (! $result) {
		return "无标题！";
	} else {
		$ptitle = array ();
		$row = $result->fetch_row ();
		$ptitle = $row [0];
		return $ptitle;
	}
}

function get_post_ptype($pid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select ptype from post where pid = '" . $pid . "'" );
	if (! $result) {
		return "无类型！";
	} else {
		$ptype = array ();
		$row = $result->fetch_row ();
		$ptype = $row [0];
		return $ptype;
	}
}

function get_post_detail($pid) {
	$conn = db_connect_m ();
	$result = $conn->query ( "select pdetail from post where pid = '" . $pid . "'" );
	
	if (! $result) {
		// echo "无内容！";
	} else {
		$pdetail = array ();
		$row = $result->fetch_row ();
		$pdetail = $row [0];
		$pdetail = stripslashes ( $pdetail );
		return $pdetail;
	}
}
function get_post_phint($pid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select phint from post where pid = '" . $pid . "'" );
	$row = $result->fetch_row ();
	$phint = $row [0];
	return $phint;
}
function get_post_uid($pid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uid from post where pid = '" . $pid . "'" );
	if (! $result) {
		// echo "无内容！";
	} else {
		$uname = array ();
		$row = $result->fetch_row ();
		$uid = $row [0];
		return $uid;
	}
}
function get_post_pcreated($pid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select pcreated from post where pid = '" . $pid . "'" );
	if (! $result) {
		// echo "无内容！";
	} else {
		$pcreated = array ();
		$row = $result->fetch_row ();
		$pcreated = $row [0];
		return $pcreated;
	}
}

function get_post_comment($pid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select cid from comment where pid = '" . $pid . "'" );
	$cid_array = array ();
	if (! $result) {
		//echo "无信息！";
		//display_alert('暂时无评论!', 'info');
	} else {
		for($count = 1; $row = $result->fetch_row (); ++ $count) {
			$cid_array [$count] = $row [0];
		}
		return $cid_array;
	}
}