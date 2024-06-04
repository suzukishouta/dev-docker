<?php
$mysqli = new mysqli('mysql57', 'root', 'root', 'mysql', 3307);
if ($mysqli->connect_error) {
	echo '接続失敗' . PHP_EOL;
	exit();
} else {
	echo '接続成功' . PHP_EOL;
}