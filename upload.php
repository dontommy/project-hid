<?php
session_start();
if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
  exit;
}

$folder = 'uploads/';
$filename = md5($_SERVER['REMOTE_ADDR'].rand()).'.jpg';

$original = $folder.$filename;

$input = file_get_contents('php://input');

if(md5($input) == '7d4df9cc423720b7f1f3d672b89362be'){
	exit;
}

$result = file_put_contents($original, $input);
if (!$result) {
	echo '{
		"error"		: 1,
		"message"	: "Failed save the image. Make sure you chmod the uploads folder and its subfolders to 777."
	}';
	exit;
}

$info = getimagesize($original);
if($info['mime'] != 'image/jpeg'){
	unlink($original);
	exit;
}

rename($original,'uploads/original/'.$filename);
$original = 'uploads/original/'.$filename;

$origImage	= imagecreatefromjpeg($original);
$newImage	= imagecreatetruecolor(154,110);
imagecopyresampled($newImage,$origImage,0,0,0,0,154,110,520,370); 

imagejpeg($newImage,'uploads/thumbs/'.$filename);


include('connec.php');

$thetime = time();
$sql = "INSERT INTO pics (picturename,thetime) VALUES ('$filename','$thetime')";
$result = $objconn->query($sql);

$theid = $objconn->insert_id;


$_SESSION['theid'] = $theid;
$connection = ssh2_connect($host, 22);
if (ssh2_auth_password($connection, "$dtuser", "$dtpass")) {
    $stream = ssh2_exec($connection, "echo '$dtip/photobooth/accept.php' | gammu sendsms TEXT 31901337");
    stream_set_blocking($stream, true);
    $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
    echo stream_get_contents($stream_out);
} else {
  die('Authentication Failed...');
}
echo '{"status":1,"message":"Success!","theid":"'.$theid.'","filename":"'.$filename.'"}';
?>
