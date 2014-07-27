<?php
function send_html_mail($to, $subject, $body) {
	$mail = new SaeMail ();
	$options = array (
			'from' => 'xiaoyuandingdang@sina.com',
			'to' => $to,
			'cc' => 'xiaoyuandingdang@sina.com',
			'content_type' => "HTML",
			'smtp_host' => 'smtp.sina.com',
			'smtp_username' => 'xiaoyuandingdang@sina.com',
			'smtp_password' => 'milkcushare',
			'subject' => $subject,
			'content' => $body,
			'content_type' => "HTML" 
	);
	$mail->setOpt ( $options );
	$ret = $mail->send ();
	if ($ret === false){
		var_dump ( $mail->errno (), $mail->errmsg () );
		//return 4;
	}
		
	else
		// echo '消息发送成功！';
		// display_alert('邮件发送成功！', 'success');
		return;
}

function send_simple_mail($to, $obj, $body) {
	$mail = new SaeMail ();
	$ret = $mail->quickSend ( $to, $obj, $body, 'xiaoyuandingdang@sina.com', 'milkcushare' );
	
	// 发送失败时输出错误码和错误信息
	if ($ret === false) {
		var_dump ( $mail->errno (), $mail->errmsg () );
		//return 4;
	}
	//return 2;
}
