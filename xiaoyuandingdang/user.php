<?php
require_once 'inc/all.php';
require_once 'nusoapClient.php';
session_start ();

$page = $_GET ['page'];

if ($page == "login") {
	// 用户登录
	display_html_header ( "用户登录" );
	display_login_form ();
	
	display_html_footer ();
} else if ($page == "register") {
	// 用户注册
	display_html_header ( "用户注册" );
	display_register_form ();
	
	display_html_footer ();
} else if ($page == "show") {
	// 用户展示
	display_html_header ( "用户信息" );
	display_user_form ();
	
	display_html_footer ();
} else if ($page == "modify") {
	// 用户信息修改
	display_html_header ( "用户信息修改" );
	display_modify_form ();
	
	display_html_footer ();
} else if ($page == "forgot") {
	// 用户忘记密码
	display_html_header ( "忘记密码" );
	display_forgot_form ();
	
	display_html_footer ();
}