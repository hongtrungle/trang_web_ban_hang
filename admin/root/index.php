<?php 
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		.highcharts-figure,
		.highcharts-data-table table {
			min-width: 800px;
			max-width: 800px;
			margin: 1em auto;
			float: left;
		}

		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #ebebeb;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}

		.highcharts-data-table caption {
			padding: 1em 0;
			font-size: 1.2em;
			color: #555;
		}

		.highcharts-data-table th {
			font-weight: 600;
			padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
			padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
			background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
			background: #f1f7ff;
		}
	</style>
</head>
<body>
	Đây là giao diện admin
	<?php 
	include '../menu.php'; 
	?>
	<figure class="highcharts-figure">
		<div id="container"></div>
	</figure>

	<figure class="highcharts-figure">
		<div id="container-2"></div>
	</figure>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/series-label.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			const days = 30;
			$.ajax({
				url: 'get_doanh_thu.php',
				dataType: 'json',
				data: {days},
			})
			.done(function(response) {
				const arrX = Object.keys(response);
				const arrY = Object.values(response);
				Highcharts.chart('container', {

					title: {
						text: 'Doanh thu trong 30 ngày gần nhất'
					},

					yAxis: {
						title: {
							text: 'Doanh thu'
						}
					},

					xAxis: {
						categories: arrX
					},

					plotOptions: {
						series: {
							label: {
								connectorAllowed: false
							},
						}
					},

					series: [{
						name: 'Doanh thu',
						data: arrY
					}],

					responsive: {
						rules: [{
							condition: {
								maxWidth: 500
							},
							chartOptions: {
								legend: {
									layout: 'horizontal',
									align: 'center',
									verticalAlign: 'bottom'
								}
							}
						}]
					}

				});
			})

			$.ajax({
				url: 'get_sold_products.php',
				dataType: 'json',
				data: {days},
			})
			.done(function(response) {
				const arrX = Object.values(response[0]);
				const arrDetail = [];
				Object.values(response[1]).forEach((each) => {
					each.data = Object.values(each.data);
					arrDetail.push(each);
				})

					// Create the chart
					Highcharts.chart('container-2', {
						chart: {
							type: 'column'
						},
						title: {
							align: 'left',
							text: 'Số sản phẩm bán được trong ' + days + ' ngày'
						},
						accessibility: {
							announceNewData: {
								enabled: true
							}
						},
						xAxis: {
							type: 'category'
						},
						yAxis: {
							title: {
								text: 'Số lượng bán được'
							}

						},
						legend: {
							enabled: false
						},
						plotOptions: {
							series: {
								borderWidth: 0,
								dataLabels: {
									enabled: true,
									format: '{point.y:.1f}%'
								}
							}
						},

						tooltip: {
							headerFormat: '<span style="font-size:11px">{category}</span><br>',
							pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
						},

						series: [
						{
							name: "Sản phẩm",
							colorByPoint: true,
							data: arrX
						}
						],
						drilldown: {
							series: arrDetail,

						}

					});
				});

				});


	</script>
</body>
</html>