<?php
/**
 * KindEditor PHP
 * 
 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
 * 
 */

require_once 'JSON.php';
session_start();
if(isset($_SERVER['HTTP_APPNAME']))
	$issae = true;	//是否新浪云平台
else
	$issae = false;
$domain = 'xydd';	//图片domain名称




//文件保存目录路径
$save_path = '../upload/';
//文件保存目录URL
$save_url = '../upload/';
//定义允许上传的文件扩展名
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
//最大文件大小
$max_size = 1000000;

//有上传文件时
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//文件类型
	$file_type = $_FILES['imgFile']['type'];
	//服务器上临时文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("请选择文件。");
	}
	//检查目录
	if(!$issae)
	{
		if (@is_dir($save_path) === false) {
			alert("上传目录不存在。");
		}
	//检查目录写权限
		if (@is_writable($save_path) === false) {
			alert("上传目录没有写权限。");
		}
	}
	//检查是否已上传
	if (@is_uploaded_file($tmp_name) === false) {
		alert("临时文件可能不是上传文件。");
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("上传文件大小超过限制。");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr) === false) {
		alert("上传文件扩展名是不允许的扩展名。");
	}
	//alert($file_type);
	if($file_type!='image/gif'&&$file_type!='image/pjpeg'&&$file_type!='image/jpeg'&&$file_type!='image/png'&&$file_type!='image/x-png'){
		alert("只允许上传gif | jpg | png 格式的图片。");
	}
	//新文件名
	$new_file_name = $_SESSION['uid'].'_'.date("YmdHis") . '.' . $file_ext;
	//移动文件
	$file_path = $save_path . $new_file_name;

	if(!$issae)
	{
		if (move_uploaded_file($tmp_name, $file_path) === false) {
			alert("上传文件失败。");
		}
		@chmod($file_path, 0644);
		$file_url = $save_url . $new_file_name;
	}
	else
	{
		$s = new SaeStorage();
		$r = $s->upload( $domain , 'head/'.$new_file_name , $tmp_name);
		if(!$r)
			alert("新浪云平台上传文件失败，请检查domain设置是否正确。");
		$file_url =  $s->getUrl( $domain , 'head/'.$new_file_name);
	}
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
?>