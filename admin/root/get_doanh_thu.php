<?php 
$max_date = $_GET['days'];
require '../connect.php';
$sql = "select 
date_format(created_at, '%e-%m') as 'ngay', 
sum(total_price) as 'doanh_thu' 
from orders
where date(created_at) >= CURDATE() - INTERVAL $max_date DAY
group by 
date_format(created_at, '%e-%m')";
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
	for($i = $start_day_last_month; $i <= $max_day_last_month; $i++){
		$key = $i . '-' . $last_month;
			$arr[$key] = 0;
	}
	for($i = 1; $i <= $today; $i++){
		$key = $i . '-' . $this_month;
		$arr[$key] = 0;
	}
}else{
	$start_day_this_month = $today - $max_date + 1;
	for($i = $start_day_this_month; $i <= $today; $i++){
		$key = $i . '-' . $this_month;
		$arr[$key] = 0;
	}
}
foreach ($result as $each) {
	$arr[$each['ngay']] = (float)$each['doanh_thu'];
}

echo json_encode($arr);