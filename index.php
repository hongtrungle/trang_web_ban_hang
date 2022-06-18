<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
	<title></title>
	<style type="text/css">
		#tong{
			width: 100%;
			height: 900px;
			background: black;
		}
		#tren{
			width: 100%;
			height: 20%;
			background: pink;
		}
		#giua{
			width: 100%;
			height: 70%;
			background: red;
		}
		#duoi{
			width: 100%;
			height: 10%;
			background: purple;
		}
	</style>
</head>
<body>
<div id="tong">
	<?php include'menu.php'; ?>
	<?php include 'products.php' ?>
	<?php include 'footer.php' ?>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="notify.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".btn-add-to-cart").click(function() {
			let id = $(this).data('id');
			let name = $(this).data('name');
			$.ajax({
				url: 'add_to_cart.php',
				type: 'GET',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {id, name},
			})
			.done(function(response) {
				if(response == 1){
					// alert('Thanh cong');
					$.notify("Bạn đã thêm sản phẩm " + name + " vào giỏ hàng", "success");
				}else{
					// alert(response);
					$.notify("Hãy truyền mã của sản phẩm để thêm vào giỏ hàng", "error");
				}
				
			});			
		});
		
	});
	$(document).ready(function() {
		$( "#project" ).autocomplete({
			minLength: 0,
			source: 'search.php',
			focus: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				$( "#project-id" ).val( ui.item.value );
				// $( "#project-icon" ).attr( "src", "admin/products/photos/" + ui.item.photo );
				return false;
			}
		})

			.autocomplete( "instance" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.append( `<div>
					<a href="product.php?id=${item.value}">${item.label}</a>
					<br>
					<img src='admin/products/photos/${item.photo}' height='50'>
					`)
				.appendTo( ul );
			};

		});
</script>
</body>
</html>

