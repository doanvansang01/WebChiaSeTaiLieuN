<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Đăng Ký</title>
    <link href="CSS/dangky1.css" rel="stylesheet">

</head>
<?php 
	if(isset($_POST['btnSignin'])){
		$error = array();
		if(empty($_POST['name'])){
			$error['name'] = "*Không được để trống";
		}
		if(empty($_POST['date'])){
			$error['date'] = "*Không được để trống";
		}
		if(empty($_POST['email'])){
			$error['email'] = "*Không được để trống";
		}
		if(empty($_POST['pass'])){
			$error['pass'] = "*Không được để trống";
		}
		if(empty($_POST['repass'])){
			$error['repass'] = "*Không được để trống";
		}
		
		if(empty($error))
		{
			require('code/codedangky.php');
		}
		
		$result = $_POST['gender'];
			$sex = ($result == "Nam")?1:0;
	}
	
?>
<body>
    <div class="form">
            <div class="auth-form" align="center">
                <div class="auth-form__noidung" align="left" style="height:85%">
                    <div class="auth-form__header">
                        <h3 class="auth-form__dk">Đăng Ký Tài Khoản</h3>
                    </div>
					<form class="user" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<div class="auth-form__form-input">
						
							<div class="auth-form__group">
								<input type="text" class="auth-form__input" 
										placeholder="Nhập họ tên" name="name" value="<?php if(isset($_POST['btnSignin'])) echo $_POST["name"]; ?>">
							</div>
							<span class="error"><?php if(isset($error['name'])) echo $error['name'];?></span>
							<div class="auth-form__group">
								<input type="date" class="auth-form__input" 
										placeholder="Chọn ngày sinh" name="date"
										value="<?php if(isset($_POST['btnSignin'])) echo $_POST["date"]; ?>" >
							</div>
							<span class="error"><?php if(isset($error['date'])) echo $error['date'];?></span>
							<div class="auth-form__group">
									<b>CHỌN GIỚI TÍNH:</b>
									<input class="rdb" type="radio" 
											name="gender" value="1" checked="checked"/><b>Nam</b>
									<input class="rdb" type="radio" 
											name="gender" value="0"/><b>Nữ<b>
							</div>
							<?php 
								if(isset($_POST['btnSignin'])){
									// lấy dữ liệu từ form gửi lên
									
									$fullName = $_POST['name'];
									$date = $_POST['date'];	
									$sex = $_POST['gender'];
									$email = $_POST['email'];
									$pass = $_POST['pass'];
									$repass = $_POST['repass'];
									
									//1. lệnh kết nối tới dữ liệu
									
									$connect = mysqli_connect("localhost","root","","library") 
												or die("không kết nối được với máy chủ, vui lòng kiểm tra lại");
									//2. thiết lập mã lệnh kết nối
									
									mysqli_query($connect,"set names 'utf8'");
									//3. xây dựng câu lệnh sql
									
									$command = "insert into account(role_id,hoten,namsinh,gioitinh,email,matkhau,downloads) 
												values ('1','".$fullName."','".$date."','".$sex."','".$email."','".md5($pass)."','0')";
										
									$query = "insert into account(role_id,hoten,namsinh,gioitinh,email,matkhau,downloads)
									values (1,'".$fullname."','".$date."','".$gender."','".$email."','".md5($password)."','0') ";
						
									
									if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)){
										$error['saimail'] = "Lỗi: Sai định đang email!";
									}
									// kiểm tra định dạng Mật khẩu
									if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$pass)){
										$error['saiPass'] = "Lỗi: Mật khẩu phải nhập ít nhất 8 kí tự gồm chữ và số!";
									}
									elseif($pass!=$repass){
										$error['saiPass'] = "Mật khẩu nhập lại không khớp";
									}
									else{
										
										// kiểm tra xem tài khoản đã tồn tại hay chưa
										$commandCheck="select * from account where email='".$email."' ";
										$result = mysqli_query($connect,$commandCheck) or die ("không có kết quả trả về!");   
											
										if($line = mysqli_fetch_array($result))
										{
											$error['saimail'] = "Email này đã được đăng ký, vui lòng chọn email khác";
										}
										else
										{
											// thực hiện đăng ký
											$results = mysqli_query($connect,$command) or die("Sai rồi bạn ơi");
											if($results)
												{header('location:dangnhap.php');}
											else
												{$error['saimail'] = "lỗi, không đăng ký được";}	
										}
									}
									//5. đóng kết nối            
									mysqli_close($connect);					
								}
							?>
							<div class="auth-form__group">
								<input type="text" class="auth-form__input" placeholder="Nhập email" name="email"
										value="<?php if(isset($_POST['btnSignin'])) echo $_POST["email"]; ?>">
							</div>
							<span class="error"><?php if(isset($error['email'])) echo $error['email'];?></span>
							<div class="auth-form__group">
								<input type="password" class="auth-form__input" placeholder="Nhập mật khẩu" name="pass" 
										value="<?php if(isset($_POST['btnSignin'])) echo $_POST["pass"]; ?>">
							</div>
							<span class="error"><?php if(isset($error['pass'])) echo $error['pass'];?></span>
							<div class="auth-form__group">
								<input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu" name="repass"
										value="<?php if(isset($_POST['btnSignin'])) echo $_POST["repass"]; ?>">
							</div>
							<span class="error"><?php if(isset($error['repass'])) echo $error['repass'];?></span>
						</div>
					
						<div class="auth-form_dieukhoan">
							<p class="auth-form__text">
								Bằng việc đăng ký, bạn đã đồng ý với Tailieu.vn về 
								<a href="" class="auth-form__link">Điều khoản dịch vụ</a> &
								<a href="" class="auth-form__link">Chính sách bảo mật</a>
							</p>
						</div>
						<div>
							<div><span class="error-all"><?php if(isset($error['saimail'])) echo $error['saimail'];?></span></div>
							<div><span class="error-all"><?php if(isset($error['saiPass'])) echo $error['saiPass'];?></span></div>
							
							
						</div>
						<div class="auth-form__controls">
							<button class="btn auth-form__controls-back">Trở Lại</button>
							<button class="btn btn-primary" name="btnSignin" type="submit">Đồng Ý</button>
						</div>
					</form>
					
                    <div class="auth-form_dieukhoan">
                        <p class="auth-form__text">
                            Bạn đã có tài khoản? 
                            <a href="http://localhost/baitapcuoiky/baitapcuoiky/projectcuoiky/xulytaikhoan/dangnhap.php" class="auth-form__link">Đăng nhập.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>