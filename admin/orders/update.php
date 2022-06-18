<?php 
$id = $_GET['id'];
$status = $_GET['status'];
$name = $_GET['name'];
$email = $_GET['email'];
require '../connect.php';

$sql = "update orders
set  
status = $status 
where id = '$id'";
mysqli_query($connect, $sql);

require '../../mail.php';
$title = "Đặt hàng thành công";
$content = "Đây là đơn hàng của bạn";
$file_to_attach = 'đơn hàng.pdf';
sendmail_2($email, $name, $title, $content, $file_to_attach);

echo "<script type='text/javascript'>window.location.href='http://localhost/php_learning/trang_web_ban_hang/admin/orders/'</script>";
// header('location: index.php');
