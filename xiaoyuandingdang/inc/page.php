<?php
require_once 'nusoapClient.php';
function display_html_header($title) {
	// 输出包括页面上方导航栏在内的头部
	?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title ?> - 校园叮当</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/custom.css" rel="stylesheet" media="screen">
<link rel="shortcut icon" href="img/favicon.png">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<!-- qq connect -->
<meta property="qc:admins" content="140303525446316110063757" />
</head>
<body>
	<?php
	display_navi ();
	echo '<div class="container">';
	echo '<div class="col-xs-12 col-sm-9">';
}

function display_html_footer() {
	// 输出包括右侧菜单在内的底部
	echo '</div>';
	display_menu ();
	?>
	</div>
	<!-- end div.container -->
	<div id="footer">
		<div class="container">
		<p class="text-muted credit"></p>
		<!-- 
			<p class="text-muted credit"><a href="http://cscup.iscas.ac.cn/" target="_blank">第三届"中科杯"全国软件设计大赛</a>作品<a href="./" target="_blank">校园叮当</a></p>
		-->
			<p class="text-muted credit">来自校园叮当团队</p>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- <script src="js/jquery.min.js"></script>  -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}

function display_user_info($uid) {
	// 输出用户信息
	echo '<div class="well sidebar-nav">';
	$user_obj = show_user($uid);
	if (isset ( $uid )) {
		echo '<img alt="头像呢" src="' . $user_obj->uhead . '" class="img-circle" id="head-img">';
		echo '<h4><a href="list.php?page=' . $uid . '">' . $user_obj->uname . '</a></h4>';
		echo '<h5>积分：' . $user_obj->ugrade . '</h5>';
		echo '<p>' . $user_obj->udescription . '</p>';
	} else {
		echo '<img src="http://xydd-xydd.stor.sinaapp.com/head/default.jpg" class="img-circle" id="head-img">';
		echo '<h4>记得<a href="user.php?page=login">登录</a>哦</h4>';
	}
	echo '</div>';
}

function display_index_welcome() {
	// 输出首页欢迎页面
	?>
<p class="pull-right visible-xs">
	<button type="button" class="btn btn-primary btn-xs"
		data-toggle="offcanvas">Toggle nav</button>
</p>
<div class="jumbotron">
	<h1>
		欢迎来到<b>校园叮当</b>
	</h1>
	<p>校园叮当是一个校园互动平台，传递信息，方便你我他。只有想不到没有做不到，功能还需不断完善，校园团购、图书馆信息查询、空闲自习室查询、图书漂流等功能都可添加。总之，我们的应用的出发点就是为用户提供安全、方便、即时的信息服务。</p>
</div>
<div class="row">
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>新鲜事</h2>
		<p>大千校园，无奇不有，每刻都有新鲜事发生。分享新鲜事，快乐你我他。想关心学校大事、想了解校园新鲜事……校园叮当作为一个信息平台横空出世。</p>
		<p>
			<a class="btn btn-default" href="list.php?page=news">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>校园知道</h2>
		<p>校园生活中，肯定会遇到千奇百怪的问题，不同学校情况不一样。校园卡丢了肿么办、捡到了一本书如何是好……校园叮当作为问问知道平台闪亮登场。</p>
		<p>
			<a class="btn btn-default" href="list.php?page=know">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>跳蚤市场</h2>
		<p>看完了的图书、用过的电子产品、不想穿的衣服……扔了可惜，留着用处不大，最好的方法就是让需要的人继续使用，校园叮当作为跳蚤市场应运而生。</p>
		<p>
			<a class="btn btn-default" href="list.php?page=market">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
</div>
<!--/row-->
<div class="row">
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>失物招领</h2>
		<p>我的课本丢了，肿么办？我捡到一串钥匙，是谁的呢？信息的不流通和零散性，让这两个难题更难解决。校园叮当的失物招领系统专为这种症状设计。</p>
		<p>
			<a class="btn btn-default" href="list.php?page=lf">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>商家资讯</h2>
		<p>我要酒店餐饮，我要教育培训，我要休闲娱乐，我要产品返利，人多力量大，作为沟通商家与消费者的桥梁，校园叮当为您提供最优秀实惠的商家咨询。</p>
		<p>
			<a class="btn btn-default" href="list.php?page=com">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>还有什么</h2>
		<p>这是一个不断发展的网站，这是一次信息流通的实践，这是一群年轻人的梦想……我们吹毛求疵，我们持之以恒，如果你有想法，欢迎献计献策，谢谢！</p>
		<p>
			<a class="btn btn-default" href="view.php?pid=1">View details &raquo;</a>
		</p>
	</div>
	<!--/span-->
</div>
<!--/row-->
<?php
}

function display_navi() {
	// 输出顶部导航栏
	?>
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./">校园叮当</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="./">首页</a></li>
				<li><a href="list.php?page=news&lpage=1">新鲜事</a></li>
				<li><a href="list.php?page=know&lpage=1">校园知道</a></li>
				<li><a href="list.php?page=market&lpage=1">跳蚤市场</a></li>
				<li><a href="list.php?page=lf&lpage=1">失物招领</a></li>
				<li><a href="list.php?page=com&lpage=1">商家资讯</a></li>
				<li><a href="post.php?pid=1">关于</a></li>
			</ul>
		</div>
		<!-- /.nav-collapse -->
	</div>
	<!-- /.container -->
</div>
<!-- /.navbar -->
<?php
}

function display_menu() {
	// 输出右侧菜单
	?>
<div class="col-xs-8 col-sm-3 sidebar-offcanvas" id="sidebar"
	role="navigation">
        <?php display_user_info($_SESSION['uid'])?>
          <div class="well sidebar-nav">
		<ul class="nav">
			<li>用户管理</li>
              <?php
	if (isset ( $_SESSION ['uid'] )) {
		echo '<li><a href="user.php?page=show">个人资料</a></li>';
		echo '<li><a href="user.php?page=modify">修改信息</a></li>';
		echo '<li><a href="process.php?from=logout">退出</a></li>';
	} else {
		echo '<li><a href="user.php?page=login">登录</a></li>';
		echo '<li><a href="user.php?page=register">注册</a></li>';
		echo '<li><a href="user.php?page=forgot">忘记密码</a></li>';
	}
	?>
              <li>欢迎关注</li>
			<li><a href="http://weibo.com/3750566220" target="_blank">新浪微博</a></li>
			<li><a href="http://www.renren.com/601796584" target="_blank">人人公共主页</a></li>
			
			<li>欢迎下载</li>
			<li><a href="http://xydd.sinaapp.com/xydd.apk">移动客户端</a></li>
		</ul>
	</div>
	<!--/.well -->
	<div class="well sidebar-nav">
		<img style="width:200px" src="/img/qrcode_for_gh_25fd5dcd637d_430.jpg" alt="微信二维码">
	</div>
	<div class="well sidebar-nav">
		<p>如果您在使用中遇到问题，请联系liuxintong@outlook.com，谢谢！</p>
	</div>
</div>
<!--/span-->
<?php
}

function display_user_state() {
	//
	if (isset ( $_SESSION ['uid'] )) {
		$uid = $_SESSION ['uid'];
		$user_obj = show_user($uid);
		echo '<div class="alert alert-success">';
		echo '<p>您正在以<a href="list.php?page=' . $uid . '" class="alert-link">' . $user_obj->uname . '</a>的身份登录！您可以使用以下功能：</p>';
		echo '<p>发布    [<a href="post.php?pid=0&ptype=news" class="alert-link">新鲜事</a>]    [<a href="post.php?pid=0&ptype=know" class="alert-link">校园知道</a>]    [<a href="post.php?pid=0&ptype=market" class="alert-link">跳蚤市场</a>]    [<a href="post.php?pid=0&ptype=lf" class="alert-link">失物招领</a>]    [<a href="post.php?pid=0&ptype=com" class="alert-link">商家资讯</a>]</p>';
		if (get_uconfirm ( $_SESSION ['uid'] ) != 1) {
			echo '<p>还未进行邮箱验证呢，影响部分功能使用！请前往';
			$mail_array = explode('@', $user_obj->uemail);
			$mail_domain = $mail_array[1];
			echo '<a class="alert-link" target="_blank" href="http://mail.'.$mail_domain.'">'.$user_obj->uemail.'</a>';
			echo '验证。</p>';
		}
		if ($user_obj->uhead == 'http://xydd-xydd.stor.sinaapp.com/head/default.jpg') {
			echo '<p>系统检测到您还未上传个性头像图片，请前往<a href="user.php?page=modify" class="alert-link">修改信息</a>。</p>';
		}
		echo '</div>';
	} else {
		echo '<div class="alert alert-warning">';
		echo '<p>尚未登录，请<a href="user.php?page=register" class="alert-link">注册</a>或<a href="user.php?page=login" class="alert-link">登录</a>，体验更多功能！</p>';
		echo '</div>';
	}
}
function display_list_welcome($page) {
	//
	echo '<div class="alert alert-info">';
	echo '欢迎来到';
	switch ($page) {
		case 'news' :
			echo '新鲜事';
			break;
		case 'know' :
			echo '校园知道';
			break;
		case 'market' :
			echo '跳蚤市场';
			break;
		default :
			echo get_uname ( $_SESSION ['uid'] ) . '的信息中心';
			break;
	}
	echo '</div>';
}
function display_carousel() {
	?>
<!-- Carousel
    ================================================== -->
<div id="myCarousel" class="carousel slide">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<img src="http://xydd-xydd.stor.sinaapp.com/index/carousel1.jpg"
				alt="First slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>欢迎来到校园叮当</h1>
					<p>校园叮当是一个校园互动平台，传递信息，方便你我他。希望功能还在不断完善的校园叮当，能够为用户提供安全、方便、即时的信息服务。</p>
					<p>
						<a class="btn btn-large btn-primary" href="user.php?page=register">现在注册</a>
					</p>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="http://xydd-xydd.stor.sinaapp.com/index/carousel4.jpg"
				alt="Second slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>又是一年军训时</h1>
					<p>军训是每一届学子的必修课。9月9日至18日，山东师大的校园又现整齐的队列、响亮的号子、高亢的军歌……这是2013级新生在军训。整齐的军训队列，将山东师大装点得绿意盎然；一张张充满活力的青春面孔，给沉静的校园增添了希望和魅力。</p>
					<p>
						<a class="btn btn-large btn-primary" href="post.php?pid=84">看一下</a>
					</p>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="http://xydd-xydd.stor.sinaapp.com/index/carousel3.jpg"
				alt="Third slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>分享新鲜事</h1>
					<p>大千校园，无奇不有，每刻都有新鲜事发生。分享新鲜事，快乐你我他。想关心学校大事、想了解校园新鲜事……</p>
					<p>
						<a class="btn btn-large btn-primary" href="list.php?page=news">刷刷更健康</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
		class="glyphicon glyphicon-chevron-left"></span></a> <a
		class="right carousel-control" href="#myCarousel" data-slide="next"><span
		class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- /.carousel -->
<?php
}

function display_simple_introduction() {
	?>
<div class="row">
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>新鲜事</h2>
		<p>大千校园，无奇不有，每刻都有新鲜事发生。分享新鲜事，快乐你我他。想关心学校大事、想了解校园新鲜事……校园叮当作为一个信息平台横空出世。</p>
		<p>
			<a class="btn btn-primary" href="list.php?page=news">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>校园知道</h2>
		<p>校园生活中，肯定会遇到千奇百怪的问题，不同学校情况不一样。校园卡丢了肿么办、捡到了一本书如何是好……校园叮当作为问问知道平台闪亮登场。</p>
		<p>
			<a class="btn btn-primary" href="list.php?page=know">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>跳蚤市场</h2>
		<p>看完了的图书、用过的电子产品、不想穿的衣服……扔了可惜，留着用处不大，最好的方法就是让需要的人继续使用，校园叮当作为跳蚤市场应运而生。</p>
		<p>
			<a class="btn btn-primary" href="list.php?page=market">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
</div>
<!--/row-->
<div class="row">
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>失物招领</h2>
		<p>我的课本丢了，肿么办？我捡到一串钥匙，是谁的呢？信息的不流通和零散性，让这两个难题更难解决。校园叮当的失物招领系统专为这种症状设计。</p>
		<p>
			<a class="btn btn-primary" href="list.php?page=lf">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>商家咨询</h2>
		<p>我要酒店餐饮，我要教育培训，我要休闲娱乐，我要产品返利，人多力量大，作为沟通商家与消费者的桥梁，校园叮当为您提供最优秀实惠的商家咨询。</p>
		<p>
			<a class="btn btn-primary" href="list.php?page=com">View details
				&raquo;</a>
		</p>
	</div>
	<!--/span-->
	<div class="col-6 col-sm-6 col-lg-4">
		<h2>还有什么</h2>
		<p>这是一个不断发展的网站，这是一次信息流通的实践，这是一群年轻人的梦想……我们吹毛求疵，我们持之以恒，如果你有想法，欢迎献计献策，谢谢！</p>
		<p>
			<a class="btn btn-primary" href="post.php?pid=1">View details &raquo;</a>
		</p>
	</div>
	<!--/span-->
</div>
<!--/row-->
<?php
}

function display_alert($description, $type) {
	//$type = success, info, warning, danger;
	echo '<div class="alert alert-'.$type.'">';
	echo $description;
	echo '</div>';
}

