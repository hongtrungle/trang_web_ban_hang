<?php 
function current_url(){
    $url      = "http://" . $_SERVER['HTTP_HOST'] . "/php_learning/trang_web_ban_hang";
    return $url;
}
// echo (current_url());
// die();

$email = $_POST['email'];
require 'admin/connect.php';
$sql = "select id, name from customers
where email = '$email'";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) === 1){
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$name = $each['name'];
	$sql = "delete from forgot_password
	where customer_id = '$id'";
	mysqli_query($connect, $sql);
	$token = uniqid();
	$sql = "insert into forgot_password(customer_id, token)
	values('$id', '$token')";
	mysqli_query($connect, $sql);
	$link = current_url().'/change_new_password.php?token='.$token;
	// die($link);
	require 'mail.php';
	$title = 'Change_new_password';
	$content = "Bấm vào đây <a href='$link'>Hiệu lực trong 24h</a>";
	sendmail_1($email, $name, $title, $content);
	// header('location:forgot_password.php');
}