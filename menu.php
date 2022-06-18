<div id="tren">
	<ol style="list-style: none;">
		<li>
			<a href="index.php">
				Trang chủ
			</a>
		</li>		
		<li class="menu-guest" style="<?php if(!empty($_SESSION['id'])){ ?>display: none; <?php } ?>">
			<a href="signin.php">
				Đăng nhập
			</a>
		</li>
		<li class="menu-guest" style="<?php if(!empty($_SESSION['id'])){ ?>display: none; <?php } ?>">
			<button type="button" data-toggle="modal" data-target="#modal-signup">
				Đăng ký
			</button>
		</li>
		<li class="menu-user" style="<?php if(empty($_SESSION['id'])){ ?>display: none; <?php } ?>">
			<a href="view_cart.php">
				Xem giỏ hàng
			</a>
		</li>
		<li class="menu-user" style="<?php if(empty($_SESSION['id'])){ ?>display: none; <?php } ?>">
			Chào 
			<span id="span-name">
				<?php echo $_SESSION['name'] ?? "" ?>;
			</span>
			<a href="signout.php">
				Đăng xuất
			</a>
		</li>
		<li class="menu-user" style="<?php if(empty($_SESSION['id'])){ ?>display: none; <?php } ?>">
			<div class="ui-widget">
				<img id="project-icon" height="200" src="images/transparent_1x1.png" class="ui-state-default" alt>
				Tìm kiếm sản phẩm
				<input id="project">
				<input type="hidden" id="project-id">
				<p id="project-description"></p>
			</div>
		</li>
	</ol>
</div>
<?php 
if(empty($_SESSION['id'])){ 
	include 'signup.php'; 
	// include 'signin.php'; 
}
?>