<?php

require_once __DIR__ . '/vendor/autoload.php';

$id = $_GET['id'];
$status = $_GET['status'];
$name = $_GET['name'];
$email = $_GET['email'];
 


$mpdf = new \Mpdf\Mpdf();
$a = file_get_contents("http://localhost/php_learning/trang_web_ban_hang/admin/orders/detail.php?id=$id");

$mpdf->WriteHTML($a);
$mpdf->Output('đơn hàng.pdf');

header("location: update.php?id=$id&status=$status&name=$name&email=$email");

