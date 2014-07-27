<?php
    require_once("lib/nusoap.php");
    require_once 'inc/all.php';
    //require_once 'inc/post.php';
    $server = new soap_server;
    //避免乱码
    $server->soap_defencoding = 'UTF-8';
    $server->decode_utf8 = false;
    $server->xml_encoding = 'UTF-8';
    $server->configureWSDL('sayHello');//打开wsdl支持
    $server->configureWSDL('show_user_json');//打开wsdl支持
    $server->configureWSDL('show_post_json');
    $server->configureWSDL('show_comment_json');
    $server->configureWSDL('get_uname');
    $server->configureWSDL('get_pid_array_json');
    $server->configureWSDL('get_cid_array_json');
    $server->configureWSDL('get_user_post_json');
    $server->configureWSDL('get_type_count');
    $server->configureWSDL('regist');
    $server->configureWSDL('login');
    $server->configureWSDL('add_post');
    $server->configureWSDL('add_comment');
    $server->configureWSDL('modify');
    $server->configureWSDL('forgot');
    $server->configureWSDL('send_html_mail');
    $server->configureWSDL('send_simple_mail');
    $server->configureWSDL('confirm_email');
    $server->configureWSDL('reset_goon');
    $server->configureWSDL('get_uid');
    $server->configureWSDL('get_uconfirm');
    /*
       注册需要被客户端访问的程序
       类型对应值：bool->"xsd:boolean"   string->"xsd:string" 
                int->"xsd:int"    float->"xsd:float"
    */
    // register nusoap function sayHello begin
    $server->register( 'sayHello',    //方法名
    array("name"=>"xsd:string", "last"=>"xsd:int"),    //参数，默认为"xsd:string"
    array("return"=>"xsd:string") );//返回值，默认为"xsd:string"
	$server->register('show_user_json',
                      array("uid"=>"xsd:string"),
	                  array("return"=>"xsd:string"));
	$server->register('show_post_json',
			array("pid"=>"xsd:string"),
			array("return"=>"xsd:string"));

	$server->register('show_comment_json',
			array("cid"=>"xsd:string"),
			array("return"=>"xsd:string"));

	$server->register('get_uname',
			array("uid"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('get_pid_array_json',
			array("ptype"=>"xsd:string", "lpage"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('get_cid_array_json',
			array("pid"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('get_user_post_json',
			array("uid"=>"xsd:string", "lpage"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('get_type_count',
			array("ptype"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('register',
			array("uname"=>"xsd:string", "upassword"=>"xsd:string", "uemail"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('login',
	        array("uname"=>"xsd:string", "upassword"=>"xsd:string"),
	        array("return"=>"xsd:string"));
	$server->register('add_post',
			array("ptype"=>"xsd:string", "ptitle"=>"xsd:string", "pdetail"=>"xsd:string", "uid"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('add_comment',
			array("pid"=>"xsd:string", "uid"=>"xsd:string", "cdetail"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('modify',
			array("uid"=>"xsd:string", "upassword"=>"xsd:string", "uemail"=>"xsd:string", "uhead"=>"xsd:string", "udescription"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('forgot',array("uemail"=>"xsd:string"), array("return"=>"xsd:string"));
	$server->register('send_html_mail',
			array("to"=>"xsd:string", "subject"=>"xsd:string", "body"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('send_simple_mail',
			array("to"=>"xsd:string", "subject"=>"xsd:string", "body"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('confirm_email',
			array("uid"=>"xsd:string", "md5pw"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('reset_goon',
			array("uid"=>"xsd:string", "md5pw"=>"xsd:string"),
			array("return"=>"xsd:string"));
	$server->register('get_uid',array("uname"=>"std:string"), array("return"=>"xsd:string"));
	$server->register('get_uconfirm',array("uid"=>"std:string"), array("return"=>"xsd:string"));
    //isset 检测变量是否设置
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    //service 处理客户端输入的数据
    $server->service($HTTP_RAW_POST_DATA);
    /**
     * 供调用的方法
     * @param $name
     */
    function sayHello($name, $last) {
       return "Hello, $name!$last";
    }
    function show_user_json($uid) {
    	return json_encode(show_user($uid));
    }
    function show_post_json($pid) {
    	return json_encode(show_post($pid));
    }
    function show_comment_json($cid) {
    	return json_encode(show_comment($cid));
    }
    function get_pid_array_json($ptype, $lpage) {
    	return json_encode(get_pid_array($ptype, $lpage));
    }
    function get_user_post_json($uid, $lpage) {
    	return json_encode(get_user_post($uid, $lpage));
    }
    function get_cid_array_json($pid) {
    	return json_encode(get_cid_array($pid));
    }
?>
