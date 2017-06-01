<?php
require 'conn.php';
foreach ($_POST as $key => $val) {
	$post[$key] = addslashes($val);
}
		if($_FILES['upfile']['file'] == ''){
			echo "<script>alert('上传内容为空');</script>";
		}else{
			$info = $_FILES['upfile'];
			if($info['size'] > 0 && $info['size'] < 1024 * 8000){
				$dir = 'upfiles/';
				$name = $info['name'];
				$rand = rand(0,10000000);
				$name = $rand.date('YmdHis').$name;
				$path = 'upfiles/'.$name;
				if(!is_dir($dir)){
					mkdir($dir);
				}
				$move = move_uploaded_file($info['tmp_name'],$path);
				if($move == true){
					echo "<script>alert('上传文件成功');</script>";
				}
			}else{
				echo "<script>alert('上传文件过大');</script>";	
			}
		}
		
$sql = "INSERT INTO `article` (title,pic,description) values ('{$post['title']}','{$post['pic']}','{$post['description']}')";

if (mysqli_query($conn, $sql)) {
	$lastid = mysqli_fetch_array(mysqli_query($conn, "select LAST_INSERT_ID()"));
	$data = array('status' => 1, 'info' => '提交成功', 'id' => $lastid[0]);
	echo json_encode($data);
} else {
	$data = array('status' => 0, 'info' => '提交失败，请检查输入内容');
	echo json_encode($data);
}