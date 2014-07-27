<?php
function db_connect_m() {
	// connect to the main database
	$user = SAE_MYSQL_USER;
	$password = SAE_MYSQL_PASS;
	$host = SAE_MYSQL_HOST_M;
	$port = SAE_MYSQL_PORT;
	$database = SAE_MYSQL_DB;
	$result = new mysqli ( $host, $user, $password, $database, $port );
	if (! $result) {
		display_alert("主库连接异常！", 'danger');
	} else {
		return $result;
	}
}

function db_connect_s() {
	// connect to the servant database
	$user = SAE_MYSQL_USER;
	$password = SAE_MYSQL_PASS;
	$host = SAE_MYSQL_HOST_S;
	$port = SAE_MYSQL_PORT;
	$database = SAE_MYSQL_DB;
	$result = new mysqli ( $host, $user, $password, $database, $port );
	if (! $result) {
		display_alert("从库连接异常！", 'danger');
	} else {
		return $result;
	}
}