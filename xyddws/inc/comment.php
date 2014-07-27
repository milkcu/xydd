<?php
require_once 'db.php';
require_once 'user.php';
function show_comment($cid) {
	$comment_obj = new stdClass();
	$comment_obj->cid = $cid;
	$comment_obj->uid = get_comment_uid($cid);
	$comment_obj->cdetail = get_comment_cdetail($cid);
	$comment_obj->ccreated = get_comment_ccreated($cid);
	$comment_obj->uhead = get_uhead(get_comment_uid($cid));
	$comment_obj->uname = get_uname(get_comment_uid($cid));
	return $comment_obj;
}
function get_cid_array($pid) {
	$conn = db_connect_m ();
	$result = $conn->query ( "select cid from comment where pid = '" . $pid . "'" );
	$result2 = $conn->query ( "select phint from post where pid = '" . $pid . "'" );
	$row2 = $result2->fetch_row ();
	$new_phint = $row2 [0] + 1;
	$result2 = $conn->query ( "update post set phint = '" . $new_phint . "' where pid = '" . $pid . "'" );
	$cid_array = array ();
	if (! $result) {
		//echo "无信息！";
		//display_alert('暂时无评论!', 'info');
		return 3;
	} else {
		for($count = 1; $row = $result->fetch_row (); ++ $count) {
			$cid_array [$count] = $row [0];
		}
		return $cid_array;
	}
}

function add_comment($cid, $uid, $cdetail) {
	$conn = db_connect_m ();
	if (! $conn->query ( "insert into comment values(null,'" . $cid . "', '" . $uid . "', null, '" . $cdetail . "')" )) {
		//echo "插入数据库异常！";
		//display_alert('插入数据库异常！', 'danger');
		return 4;
	} else {
		//echo "评论成功";
		//display_alert('评论成功！', 'success');
		add_ugrade ( $uid, 5 );
		return 2;
	}
}

function get_comment_uid($cid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select uid from comment where cid = '" . $cid . "'" );
	if (! $result) {
		// echo "无内容！";
	} else {
		$row = $result->fetch_row ();
		$uid = $row [0];
		return $uid;
	}
}
function get_comment_cdetail($cid) {
	$conn = db_connect_s ();
	$result = $conn->query ( "select cdetail from comment where cid = '" . $cid . "'" );
	if (! $result) {
		// echo "无内容！";
	} else {
		$row = $result->fetch_row ();
		$cdetail = $row [0];
		return $cdetail;
	}
}
function get_comment_ccreated($cid) {
	//
	$conn = db_connect_s ();
	$result = $conn->query ( "select ccreated from comment where cid = '" . $cid . "'" );
	if (! $result) {
		// echo "无内容！";
	} else {
		$row = $result->fetch_row ();
		$ccreated = $row [0];
		return $ccreated;
	}
}
