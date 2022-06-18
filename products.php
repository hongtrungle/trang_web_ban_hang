<?php 
require 'admin/connect.php';
$sql = "select * from products";
$result = mysqli_query($connect,$sql); 
?>
<style type="text/css">
	.tung_san_pham{
		width: 33%;
		border: 1px solid black;
		height: 312px;
		float: left;
	}
</style>
<div id="giua">
	<?php foreach ($result as $each) { ?>
		<div class="tung_san_pham">
			<h1>
				<?php echo $each['name'] ?>
			</h1>
			<img height="100" src="admin/products/photos/<?php echo $each['photo'] ?>">
			<p><?php echo $each['price'] ?>$</p>
			<a href="product.php?id=<?php echo $each['id'] ?>">
				Xem chi tiết
			</a>
			<br>
			<?php if(!empty($_SESSION['id'])){ ?>
				<button 
					data-id='<?php echo $each['id'] ?>'
					data-name='<?php echo $each['name'] ?>'
					class='btn-add-to-cart' 
				>
					Thêm vào giỏ hàng
				</button>
			<?php } ?>
		</div>
	<?php } ?>
</div>