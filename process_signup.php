<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

require 'admin/connect.php';
$sql = "select * from customers
where email = '$email'";
$result = mysqli_query($connect, $sql);
$number_rows = mysqli_num_rows($result);
if($number_rows == 1){
	echo 'Trùng email';
	// header('location: signup.php');
	exit;
}
$sql = "insert into customers(name, email, password, phone_number, address)
values('$name','$email', '$password', '$phone_number', '$address')";
mysqli_query($connect, $sql);

// require 'mail.php';
// $title = "Đăng ký thành công";
// $content = "Chúc mừng bạn đã đăng ký thành công";
// sendmail_1($email, $name, $title, $content);

$sql = "select id from customers
where email = '$email'";
$result = mysqli_query($connect, $sql);
$id = mysqli_fetch_array($result)['id'];
session_start();
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;

// header('location: user.php');
// exit;
mysqli_close($connect);
echo 1;