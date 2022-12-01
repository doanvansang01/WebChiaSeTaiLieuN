<?php
	require_once('../code/function.php');
	// $sql = "select a.hoten,a.namsinh,a.gioitinh,a.email,a.role_id, a.id ,r.name
	// from account a
	// where a.role_id = r.id";
	// $data = executeResult($sql);
?>
<html>
	<head>
		<title>Tai lieu</title>
		<meta charset="utf-8">
		<link href="CSS/header.css" rel="stylesheet" type="text/css" />
		<link href="CSS/stylecss.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
		  <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="CSS/HienThiVanBan.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	
		
	</head>
	<body >
		<div id="wrapper">
			<div id="header">
				<div id="header-menutop">
					<div id="div-logo">
						
						<a href="trangchu.php">
							<img id="logo" src="hinhanh/logo.jpg"/>
						</a>
						
					</div>
					
					<form action="#" method="post">
						<div id="div-input-tim">
							<input class="input_find" type="text" name="txt_find" placeholder="Tìm kiếm">
						</div>
						<div id="div-button-tim">
							<button class="btn_find"  name="btn_find"><i class="fas fa-search"></i></button>
						</div>
					</form>	
					
					<div id="div-button-upload">
						<button class="btn_upload">
							<i class="fas fa-upload"></i>
							Upload
						</button>
					</div>
					<?php 
						if(!isset($_SESSION['login'])){
								
					?>
					
					<div id="div-button-login">
						<button class="btn_login"><a class="auth-form__text" href="../../xulytaikhoan/dangnhap.php">Đăng nhập</a></button> |
					</div>
					<div id="div-button-register">
						<button class="btn_register"><a href="../../xulytaikhoan/dangky.php">Đăng ký</a></button>
					</div>	
					<?php 
						}else{ 
					?>
					<div id="wamper-menu-User">
						<div id="div-menu-nguoi-dung">
							<ul>
								<li class="dropdown1">
								
									<a class=" dropbtn1"><?php 
									$id = $_SESSION['id'];
										echo "Hi! ".$_SESSION['login'];
									 ?></a>							
									<div class="dropdown-content1">
										<a href="thongtinuser.php?id=<?=$id?>">Thông tin</a>
										<a href="#">Tài liệu</a>
										<a href="#">Trợ giúp</a>
										<a href="thoat.php">Đăng xuất</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<?php }?>
				</div>
				
				<!-- Hiển thị list danh mục-->
				<div id="header-menudown" >
					<?php
						$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
						// tlap bang ma cho connect
						mysqli_query($connect,"set name 'utf8'");
						
						$sql = "select * from Category";
						$data = executeResult($sql);
					?>
					
					<ul>
						<li class="dropdown" >
						<?php
							foreach($data as $item)
							{
								echo '<a class="dropbtn" href="trangchu.php?category_id='.$item['id'].'"> '.$item['name'].'</a> ';
							}
							
						?>
						</li>
					</ul>
				</div>
			</div>
			
			
		<div>
	</body>
<html>