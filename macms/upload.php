<?php

error_reporting(0);
$mime = array(
	'image/png' => '.png',
	'image/jpg' => '.jpg',
	'image/jpeg' => '.jpg',
	'image/pjpeg' => '.jpg',
	'image/gif' => '.gif',
	'image/bmp' => '.bmp',
	'image/x-png' => '.png',
);

$base64 = $_POST['base64'];
$type = $_POST['type'];
$imgtype = $mime[$type];
if ($imgtype) {
	preg_match('/(.*)base64,(.*)/', $base64, $matches);
	$base64 = $matches['2'];
	$base64 = base64_decode($base64);
	$data = date("Y-m-d");
	$imgname = date("YmdHis") . md5(time() . rand(10000, 99999));
//   $imgurl = 'saestor://upload/'.$data.'/'.$imgname.$imgtype;
	$imgurl = 'upload/' . $imgname . $imgtype;

	$imgurlname = $data . '/' . $imgname . $imgtype;
	$ress = file_put_contents($imgurl, $base64);
	if ($ress) {
//        $st = new SaeStorage();
		$res['status'] = '0';
//        $res['imgurl'] = $st->geturl('upload',$imgurlname);
		$res['imgurl'] = $imgurl;
		$img_info = getimagesize($imgurl);
		$size = $img_info[1] / $img_info[0];
	} else {
		$res['status'] = '1';
		$res['msg'] = '上传图片错误，请检查文件夹权限';
	}
} else {
	$res['status'] = '1';
	$res['msg'] = '格式错误';
}
//echo json_encode($res);
$arr = array(
	/*'name' => $res['imgurl'],
	'pic' => $res['imgurl'],*/
	'img' => 'http://h5.dashenw.cn/2017/denglong/' . $res['imgurl'],
	'size' => $size,
);
echo json_encode($arr);