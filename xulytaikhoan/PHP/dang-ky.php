<?php
	function register(){
		if(!empty($_POST))
		{
			$fullname = $_POST['name'];
			$date = $_POST['date'];
			$email = $_POST['email'];
			$password = $_POST['pass'];
			
			// tạo kết nối tới database
			$connect = new mysqli("localhost","root","","up-tai-lieu");
			// cho phep luu tieng viet vao database
			mysql_set_charset($connect,"utf8");
			// kiemtra ket noi
			if($connect->connect_error){
				var_dump($connect->connect_error);
				//dung chuong trinh
				die();
			}
			// chèn data vào database
			$query = "INSERT INTO tai-khoan(ho-ten,nam-sinh, email, mat-khau)
						VALUES ('".$fullname."','".$date.",'".$email."','".$password."')";
			mysqli_query($connect, $query);
			//dong ket noi
			$connect->close();
		}
	}
?>