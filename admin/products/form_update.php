<?php 
require '../check_admin_login.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php 
		if(empty($_GET['id'])){
			header('location:index.php?error=Phải truyền mã để sửa');
		}
		$id = $_GET['id'];
		require '../menu.php';
		require '../connect.php';
		$sql = "select * from products
		where id = '$id'";
		$result = mysqli_query($connect, $sql);
		$number_rows = mysqli_num_rows($result);
		if($number_rows ===1){
			$each = mysqli_fetch_array($result);
		$sql = "select * from manufacturers";
		$manufacturers = mysqli_query($connect, $sql);
	?>
<form action="process_update.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
	Tên
	<input type="text" name="name" value="<?php echo $each['name'] ?>">
	<br>
	Đổi ảnh mới
	<input type="file" name="photo_new">
	<br>
	Hoặc giữ ảnh cũ
	<img src="photos/<?php echo $each['photo'] ?>" height= '100'>
	<input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
	<br>
	Giá
	<input type="number" name="price" value="<?php echo $each['price'] ?>">
	<br>
	Mô tả
	<textarea name="description"><?php echo $each['description'] ?></textarea>
	<br>
	Nhà sản xuất
	<select name="manufacturer_id">
		<?php foreach ($manufacturers as $manufacturer) { ?>
			<option value="<?php echo $manufacturer['id'] ?>"
				<?php if($each['manufacturer_id'] == $manufacturer['id']){ ?>
					selected
				<?php } ?>
			>
				<?php echo $manufacturer['name']  ?>
			</option>
		<?php } ?>
	</select>
	<br>
	<button>Sửa</button>
</form>
<?php }else{  ?>
	<h1>Không tìm thấy theo mã này</h1>
<?php } ?>
</body>
</html>