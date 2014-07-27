<?php
require_once ("lib/nusoap.php");
/*
 * 通过WSDL调用WebService 参数1 WSDL文件的地址(问号后的wsdl不能为大写) 参数2 指定是否使用WSDL $client = new soapclient('http://localhost/WebService/nusoapService.php?wsdl',true);
 */
/* exmaple
$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;
$client->xml_encoding = 'UTF-8';
// 参数转为数组形式传递
$paras = array (
		'name' => 'Bruce Lee',
		'last' => '088'
);
// 目标方法没有参数时，可省略后面的参数
$result = $client->call ( 'sayHello', $paras );
//$result = $client->call('show_post_json', array('pid'=>'4'));
// 检查错误，获取返回值
if (! $err = $client->getError ()) {
	echo "返回结果：", $result;
	echo print_r(json_decode($result));
} else {
	echo "调用出错：", $err;
}
*/


function show_user($uid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('show_user_json', array('uid'=>"$uid"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function show_post($pid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('show_post_json', array('pid'=>"$pid"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function show_comment($cid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('show_comment_json', array('cid'=>"$cid"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function get_uname($uid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_uname', array('uid'=>"$uid"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function get_pid_array($ptype, $lpage) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_pid_array_json', array('ptype'=>"$ptype", "lpage"=>"$lpage"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function get_cid_array($pid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_cid_array_json', array('pid'=>"$pid"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function get_user_post($uid, $lpage) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_user_post_json', array('uid'=>"$uid", "lpage"=>"$lpage"));
	if (! $err = $client->getError ()) {
		return json_decode($result);
	} else {
		echo "调用出错：", $err;
	}
}

function get_type_count($ptype) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_type_count', array('ptype'=>"$ptype"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function register($uname, $upassword, $uemail) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('register', array('uname'=>"$uname", 'upassword'=>"$upassword", 'uemail'=>"$uemail"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function login($uname, $upassword) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('login', array('uname'=>"$uname", 'upassword'=>"$upassword"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function add_post($ptype, $ptitle, $pdetail, $uid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('add_post', array('ptype'=>"$ptype", 'ptitle'=>"$ptitle", 'pdetail'=>"$pdetail", 'uid'=>"$uid"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function add_comment( $pid, $uid, $cdetail) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('add_comment', array('pid'=>"$pid", 'uid'=>"$uid", 'cdetail'=>"$cdetail"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function modify($uid, $upassword, $uemail, $uhead, $udescription) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('modify', array('uid'=>"$uid", 'upassword'=>"$upassword", 'uemail'=>"$uemail", 'uhead'=>"$uhead", 'udescription'=>"$udescription"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function forgot($uemail) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('forgot', array('uemail'=>"$uemail"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function send_html_mail($to, $object, $body) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('send_html_mail', array('to'=>"$to", 'object'=>"$object", 'body'=>"$body"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}


function confirm_email ( $uid, $md5pw ){
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('confirm_email', array('uid'=>"$uid", 'md5pw'=>"$md5pw"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function reset_goon ( $uid, $md5pw ) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('reset_goon', array('uid'=>"$uid", 'md5pw'=>"$md5pw"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function get_uid($uname) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_uid', array('uname'=>"$uname"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}

function get_uconfirm($uid) {
	$client = new soapclient ( 'http://xyddws.sinaapp.com/nusoapService.php' );
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->xml_encoding = 'UTF-8';
	$result = $client->call('get_uconfirm', array('uid'=>"$uid"));
	if (! $err = $client->getError ()) {
		return $result;
	} else {
		echo "调用出错：", $err;
	}
}
?>
