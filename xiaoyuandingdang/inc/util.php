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
