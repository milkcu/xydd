<?php
require_once 'comment.php';
require_once 'config.php';
require_once 'db.php';
require_once 'mail.php';
require_once 'post.php';
require_once 'user.php';
require_once 'util.php';

function display_alert($description, $type) {
	//$type = success, info, warning, danger;
	echo '<div class="alert alert-'.$type.'">';
	echo $description;
	echo '</div>';
}