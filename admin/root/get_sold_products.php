<?php 
$max_date = $_GET['days'];
require '../connect.php';
$sql = "select
products.id as 'ma_san_pham', 
products.name as 'ten_san_pham',
date_format(created_at, '%e-%m') as 'ngay', 
sum(quantity) as 'so_san_pham_ban_duoc'
from orders
JOIN order_product on order_product.order_id = orders.id
JOIN products on products.id = order_product.product_id
where date(created_at) >= CURDATE() - INTERVAL $max_date DAY
group by 
products.id, date_format(created_at, '%e-%m')";
$result = mysqli_query($connect, $sql);

$arr = [];
$today = date('d');
$this_month = date('m');
if($today < $max_date){
	$get_day_last_month = $max_date - $today;
	$last_month = date('m', strtotime(" -1 month"));	
	$last_month_date = date('Y-m-d', strtotime(" -1 month"));
	$max_day_last_month = (new DateTime($last_month_date))->format('t');
	$start_day_last_month = $max_day_last_month - $get_day_last_month;
}else{
	$start_day_this_month = $today - $max_date + 1;
}
foreach ($result as $each) {
	$ma_san_pham = $each['ma_san_pham'];
	if(empty($arr[$ma_san_pham])){
		$arr[$ma_san_pham] = [
			'name' => $each['ten_san_pham'],
			'y' => (int)$each['so_san_pham_ban_duoc'],
			'drilldown' => (int)$each['ma_san_pham'],
		];
	}else{
		$arr[$ma_san_pham]['y'] += $each['so_san_pham_ban_duoc'];
	}
}

$arr2 = [];
foreach ($arr as $ma_san_pham => $each) {
	$arr2[$ma_san_pham] = [
		'name' => $each['name'],
		'id' => $ma_san_pham,
	];
	$arr2[$ma_san_pham]['data'] = [];
	if($today < $max_date){
		for($i = $start_day_last_month; $i <= $max_day_last_month; $i++){
			$key = $i . '-' . $last_month;
			$arr2[$ma_san_pham]['data'][$key] = [
				$key, 
				0
			];
		}
		for($i = 1; $i <= $today; $i++){
			$key = $i . '-' . $this_month;
			$arr2[$ma_san_pham]['data'][$key] = [
				$key, 
				0
			];
		}
	}else{
		for($i = $start_day_this_month; $i <= $today; $i++){
			$key = $i . '-' . $this_month;
			$arr2[$ma_san_pham]['data'][$key] = [
				$key, 
				0
			];
		}
	}
}

foreach ($result as $each) {
	$ma_san_pham = $each['ma_san_pham'];
	$key = $each['ngay'];
	$arr2[$ma_san_pham]['data'][$key] = [
		$key,
		(int)$each['so_san_pham_ban_duoc']
	];
}
// echo json_encode($arr2);
$object = json_encode([$arr, $arr2]);
echo $object;

