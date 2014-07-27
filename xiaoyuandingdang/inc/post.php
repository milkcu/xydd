<?php
require_once 'nusoapClient.php';

function display_list_intro($page) {
	echo '<div class="panel panel-default">';
	switch ($page) {
		case 'news' :
			echo '<div class="panel-heading">新鲜事</div>';
			echo '<div class="panel-body"><p>';
			echo '大千校园，无奇不有，每刻都有新鲜事发生。分享新鲜事，快乐你我他。想关心学校大事、想了解校园新鲜事……校园叮当作为一个信息平台横空出世。';
			echo '</p></div>';
			break;
		case 'know' :
			echo '<div class="panel-heading">校园知道</div>';
			echo '<div class="panel-body"><p>';
			echo '校园生活中，肯定会遇到千奇百怪的问题，不同学校情况不一样。选课系统怎么用、笔记本无法开机如何是好……校园叮当作为问问知道平台闪亮登场。';
			echo '</p></div>';
			break;
		case 'market' :
			echo '<div class="panel-heading">跳蚤市场</div>';
			echo '<div class="panel-body"><p>';
			echo '看完了的图书、用过的电子产品、不想穿的衣服……扔了可惜，留着用处不大，最好的方法就是让需要的人继续使用，校园叮当作为跳蚤市场应运而生。';
			echo '</p></div>';
			break;
		case 'lf' :
			echo '<div class="panel-heading">失物招领</div>';
			echo '<div class="panel-body"><p>';
			echo '我的课本丢了，肿么办？我捡到一串钥匙，是谁的呢？信息的不流通和零散性，让这两个难题更难解决。校园叮当的失物招领系统专为这种症状设计。';
			echo '</p></div>';
			break;
		case 'com' :
			echo '<div class="panel-heading">商家资讯</div>';
			echo '<div class="panel-body"><p>';
			echo '我要酒店餐饮，我要教育培训，我要休闲娱乐，我要产品返利，人多力量大，作为沟通商家与消费者的桥梁，校园叮当为您提供最优秀实惠的商家咨询。';
			echo '</p></div>';
			break;
		default :
			echo '<div class="panel-heading">' . get_uname ( $page ) . '的所有信息</div>';
			echo '<div class="panel-body">';
			echo '<p>打个招呼？消息将以邮件形式发送。</p>';
			if (isset ( $_SESSION ['uid'] )) {
				?>
	<form action="process.php?from=contact" method="post">
	
		<input type="text" name="send_uid" class="hide form-control"
			value="<?php echo $_SESSION['uid'] ?>"> <input type="text"
			name="receive_uid" class="hide form-control"
			value="<?php echo $page ?>">
		<textarea rows="2" name="send_detail" class="form-control"
			placeholder="说点什么。。。"></textarea>
		<button type="submit" class="btn btn-warning pull-right">发送</button>
	</form>
	<?php
				} else {
					echo '<p>可是你还没有<a href="user.php?page=login">登录</a>。。。</p>';
				}
				echo '</div>';
		}
}

function display_post_list($page, $lpage) {
	//
	display_list_intro($page);
	
	
	if ($page == 'news' || $page == 'know' || $page == 'market' || $page == 'lf' || $page == 'com') {
		$pid_array = get_pid_array($page, $lpage);
	} else {
		$pid_array = get_user_post($page, $lpage);
	}
	
	echo '<table class="table table-hover"><thead>';
	echo '<tr><th class="col-md-6">标题</th><th class="col-md-2">作者</th><th class="col-md-3">时间</th><th class="col-md-1">点击量</th></tr>';
	echo '</thead><tbody>';
	foreach ( $pid_array as $pid ) {
		$post_obj = show_post($pid);
		
		echo '<tr>';
		echo '<td><a href="post.php?pid=' . $post_obj->pid . '">' . $post_obj->ptitle . '</a><br>'.substr(strip_tags($post_obj->pdetail), 0, 65).'</td>';
		echo '<td><a href="list.php?page=' . $post_obj->uid . '">' . $post_obj->uname . '</td>';
		echo '<td>' . $post_obj->pcreated . '</td>';
		echo '<td>' . $post_obj->phint . '</td>';
		echo '</tr>';
		echo '<div></div>';
	}
	echo '</tbody></table>';
	echo '<div class="container"><ul class="pagination">';
	echo '<li><a href="list.php?page='.$page.'&lpage=1">&laquo;</a></li>';
	$page_num = (get_type_count($page) - get_type_count($page) % 15) / 15 + 1;
	for($i = 1; $i <= $page_num; $i++) {
		echo '<li><a href="list.php?page='.$page.'&lpage='.$i.'">'.$i.'</a></li>';
	}
	echo '<li><a href="list.php?page='.$page.'&lpage='.$page_num.'">&raquo;</a></li>';
	echo '</ul></div></div>';
}

function display_comment_list($cid_array) {
	// 输出评论列表
	if (count ( $cid_array ) == 0) {
		return false;
	}
	$cid_array = array_reverse ( $cid_array );
	echo '<div class="my-margin">';
	echo '<table class="table table-striped">';
	echo '<tbody>';
	foreach ( $cid_array as $cid ) {
		$comment_obj = show_comment($cid);
		//print_r($comment_obj);
		echo '<tr><td style="width:160px;"><img src="'.$comment_obj->uhead.'" class="img-thumbnail uhead-comment"></td><td>';
		echo '<h4><a href="list.php?page=' . $comment_obj->uid . '">' . $comment_obj->uname . '</a></h4>';
		echo '<p>' . $comment_obj->cdetail . '</p>';
		echo '<i>' . $comment_obj->ccreated . '</i>';
		echo '</td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
}

function display_jiathis() {
	?>
<div class="container row jiathis">
	<!-- JiaThis Button BEGIN -->
	<div class="jiathis_style_32x32">
		<a class="jiathis_button_qzone"></a> <a class="jiathis_button_tsina"></a>
		<a class="jiathis_button_tqq"></a> <a class="jiathis_button_renren"></a>
		<a class="jiathis_button_weixin"></a> <a
			class="jiathis_button_kaixin001"></a> <a
			href="http://www.jiathis.com/share?uid=1636645"
			class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
		<a class="jiathis_counter_style"></a>
	</div>
	<script type="text/javascript">
var jiathis_config = {data_track_clickback:'true'};
</script>
	<script type="text/javascript"
		src="http://v3.jiathis.com/code/jia.js?uid=1636645" charset="utf-8"></script>
	<!-- JiaThis Button END -->
</div>
<?php 
}
