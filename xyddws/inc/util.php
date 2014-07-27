<?php
function password_confirm($upassword, $upassword2) {
	if ($upassword != $upassword2) {
		// echo '两次输入的密码不一致！';
		// display_alert('两次输入的密码不一致！', 'danger');
		// return false;
		return 4;
	} else {
		return 2;
	}
}
function removeSpacialCharacters($string = "") {
	/*
	if (preg_match ( '/[^\w\d_ -]/si', $string )) {
		return preg_replace ( '/[^a-zA-Z0-9_ -]/s', '', $string );
	} else {
		return preg_replace ( '/\s/', ' ', $string );
	}
	*/
	/*
	$pregstr = "/[\x{4e00}-\x{9fa5}]+/u";
	if(preg_match($pregstr,$string,$matchArray)){
		return $matchArray[0];
	} else {
		return $string;
	}
	*/
	addslashes($string);
}