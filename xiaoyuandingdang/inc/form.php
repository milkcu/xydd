<?php
function display_login_form() {
	// 输出登录表单
	?>
<form class="form-signin" method="post" action="process.php?from=login">
	<h2 class="form-signin-heading">登录使用更多功能啦</h2>
	<input name="uname" type="text" class="form-control" placeholder="用户名"
		autofocus required> <input name="upassword" type="password"
		class="form-control" placeholder="密码" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
</form>
<?php
}

function display_register_form() {
	// 输出注册表单
	?>

<form class="form-signin form-register" method="post"
	action="process.php?from=register">
	<h2 class="form-signin-heading">欢迎注册</h2>
	<input name="uname" type="text" class="form-control" placeholder="用户名"
		autofocus> <input name="upassword" type="password"
		class="form-control" placeholder="密码" required> <input
		name="upassword2" type="password" class="form-control"
		placeholder="密码确认"> <input name="uemail" type="text"
		class="form-control" placeholder="Email" required> <label
		class="checkbox"> <input type="checkbox" value="agree">同意什么什么
	</label>
	<button class="btn btn-lg btn-primary btn-block" type="submit">我要注册</button>
</form>

<?php
}

function display_modify_form() {
	// 输出修改表单
	?>


<div class=container">
	<form class="form-signin form-register" method="post"
		action="process.php?from=modify" enctype="multipart/form-data">
		<h2 class="form-signin-heading">用户信息修改</h2>
		<p>只需填写需要修改的内容即可！</p>
		<input type="text" class="form-control"
			value="<?php echo get_uname($_SESSION['uid']) ?>" disabled> <input
			name="upassword" type="password" class="form-control"
			placeholder="密码"> <input name="upassword2" type="password"
			class="form-control" placeholder="密码确认"> <input name="uemail"
			type="text" class="form-control" placeholder="Email">
		<textarea rows="3" name="udescription" class="form-control"
			placeholder="一句话介绍自己"></textarea>
		<!-- <span>头像图片<input name="uhead" type="file" class="btn inline"
			value="头像"></span> -->
		<div class="upload">
			<input name="uhead" class="ke-input-text" type="text" id="url"
				value="" readonly="readonly" /> <input type="button"
				id="uploadButton" value="上传头像" />
		</div>
		<!-- ajax upload head begin -->
		<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
		<script src="kindeditor/kindeditor-min.js"></script>
		<script>
			KindEditor.ready(function(K) {
				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'imgFile',
					url : 'kindeditor/php/upload_head_json.php?dir=file',
					afterUpload : function(data) {
						if (data.error === 0) {
							var url = K.formatUrl(data.url, 'absolute');
							K('#url').val(url);
						} else {
							alert(data.message);
						}
					},
					afterError : function(str) {
						alert('自定义错误信息: ' + str);
					}
				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});
			});
		</script>
		<!-- ajax upload head end -->

		<button class="btn btn-lg btn-primary btn-block" type="submit">修改</button>
	</form>
</div>
<?php
}

function display_user_form() {
	// 输出用户表单
	$user_obj = show_user($_SESSION['uid']);
	?>

<form class="form-signin form-register">
	<h2 class="form-signin-heading">用户信息</h2>
	<input type="text" class="form-control"
		value="<?php echo $user_obj->uname ?>" disabled> <input
		type="text" class="form-control"
		value="<?php echo $user_obj->uemail ?>" disabled>
	<a class="btn btn-lg btn-primary btn-block" href="user.php?page=modify">修改</a>
</form>

<?php
}

function display_forgot_form() {
	// 输出忘记密码表单
	?>
<form class="form col-md-4 col-md-offset-4" method="post"
	action="process.php?from=forgot">
	<h2 class="form-heading">找回密码</h2>
	<div class="form-group">
		<input name="uemail" type="text" class="form-control"
			placeholder="Email adress..." autofocus required>
	</div>
	<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">发送邮件</button>
	</div>
</form>
<?php
}

function display_comment_form($pid) {
	// 输出评论表单
	if (isset ( $_SESSION ['uid'] )) {
		?>
<div class="comment-margin">
	<form method="post" action="process.php?from=comment"
		class="control-form">
		<textarea name="cdetail" class="form-control" rows="3"></textarea>
		<input type="text" name="pid" class="hide" value="<?php echo $pid ?>">
		<input type="submit" class="btn btn-default pull-right" value="提交评论">
	</form>
</div>
<?php
	} else {
		echo '<div class="alert alert-warning"><p>您还没<a href="user.php?page=register" class="alert-link">注册</a>或<a href="user.php?page=login" class="alert-link">登录</a>呢，登录后就可以评论啦！</p></div>';
	}
}

function display_post_form($ptype) {
	// 输出增加信息表单
	?>
<!-- kindeditor begin -->
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content1"]', {
				cssPath : 'kindeditor/plugins/code/prettify.css',
				uploadJson : 'kindeditor/php/upload_json.php',
				fileManagerJson : 'kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
<!-- kindeditor end -->
<form method="post" action="process.php?from=post"
	class="form-horizontal" role="form">
	<div class="form-group">
		<!-- 
<div class="col-md-2">
<select name="ptype" class="form-control">
  <option value="news">新鲜事</option>
  <option value="know">校园知道</option>
  <option value="market">跳蚤市场</option>
</select>
</div>
-->
		<div class="col-sm-11">
			<input name="ptype" value="<?php echo $ptype ?>" class="hide"> <input
				name="ptitle" type="text" class="form-control"
				placeholder="请输入题目" required>
		</div>
	</div>
	<!-- end div.form-group -->
	<div class="form-group col-md-12">
	<div class="hidden-xs"><textarea name="content1" class="form-control" rows="20"></textarea></div>
	<div class="visible-xs"><textarea name="content2" class="form-control" rows="10"></textarea></div>
	</div>
	<input type="submit" value="发布" class="btn btn-primary btn-lg">
</form>

<?php
}

function display_reset_form($uid) {
	?>
<div class=container">
	<form class="form-signin form-register" method="post"
		action="process.php?from=modify" enctype="multipart/form-data">
		<h2 class="form-signin-heading">用户密码重置</h2>
		<input type="text" class="form-control"
			value="<?php echo get_uname($_SESSION['uid']) ?>" disabled> <input
			name="upassword" type="password" class="form-control"
			placeholder="密码"> <input name="upassword2" type="password"
			class="form-control" placeholder="密码确认"> <input name="uemail"
			type="text" class="form-control"
			value="<?php echo get_uemail($uid)?>" disabled>
		<button class="btn btn-lg btn-primary btn-block" type="submit">重置密码</button>
	</form>
</div>
<?php
}
