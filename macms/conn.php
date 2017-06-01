<?php
$db = array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'database' => 'macms',
);
//define('__ROOT', '');
$conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_query($conn, "set names utf8");
/*if($conn) echo "成功连接到MySQL服务器";	
else echo "连接失！";*/