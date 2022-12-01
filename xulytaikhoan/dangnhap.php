<?php
	session_start();
?>
<html>
    <head>
        <meta charset="utf8">
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="CSS/dangnhap.css">
		<link rel="stylesheet" href="CSS/dangky1.css">
		
    </head>
    <body style = ";">
        <!-- auth-form là khung chứa toàn bộ đăng ký đăng nhập -->
        <div class="auth-form" align="center" >
            <div class="auth-form__noidung" align="left" style="height:60%">
                <div class="auth-form__header">
                    <h3 class="auth-form__dk">Đăng nhập</h3>
					<a class="auth-form__link" href="dangky.php">
						<span class="auth-form__swtich-btn">Đăng ký</span>
					</a>
                </div>
                <div>
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
					<?php
						$email ="";		
						$pass ="";	
						$check = false;
						if(isset($_COOKIE["email"]) && isset($_COOKIE["pass"])){
							$email = $_COOKIE["email"];
							$pass = $_COOKIE["pass"];
							$check = true;
						}
					?>				   
                    <div class="auth-form__form-input">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input"  name="email"  placeholder="Nhập email" value="<?php if (isset($_COOKIE["email"])) echo $email; 
																				elseif(isset($_POST['btnlogin'])){ 
																					echo $_POST["email"];
																				}?>"> 

                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input"  name="pass"   placeholder="Nhập mật khẩu" value="<?php if (isset($_COOKIE["pass"])) echo $pass; 
																									elseif(isset($_POST['btnlogin'])){ 
																											echo $_POST["pass"];
																										}?>">
						</div>
						<?php
							$error = array();
							if(isset($_POST['email']) && isset($_POST['pass']))
							{
								if(empty($_POST['email']) && empty($_POST['email'])){
									$error['tb'] = "*Vui lòng nhập tài khoản và mật khẩu";
								}else{
									// lấy dữ liệu từ form gửi lên
									$email = $_POST['email'];
									$pass = $_POST['pass'];
									//1. lệnh kết nối tới dữ liệu
									$connect = mysqli_connect("localhost","root","","library") or die("không kết nối được với máy chủ, vui lòng kiểm tra lại");
									//2. thiết lập mã lệnh kết nối
									mysqli_query($connect,"set names 'utf8'");
									//3. xây dựng câu lệnh sql email
									$sql="select * from account where email = '".$email."'";
									$result = mysqli_query($connect,$sql) or die ("không có kết quả trả về!"); 
									//5. đóng kết nối    
									mysqli_close($connect);
									if($row=mysqli_fetch_array($result))
									{
										
										if($row['matkhau'] == md5($pass))
										{
											$_SESSION['login'] = $email;
											$_SESSION['role'] = $row['role_id'];
											$_SESSION['id'] = $row['id'];
											
								
											header('location:../xulytailieu/giaodien/trangchu.php');
										}
										else
										{
											$error['tb'] = "*Tài khoản hoặc mật khẩu không đúng";
										}     
									}
									else{
										$error['tb'] = "*Tài khoản hoặc mật khẩu không đúng";
									}
									        
									if(isset($_POST["remember"])){
										setcookie('e',$email,time() + 600, "/",'',0);
										setcookie('p',$pass,time() + 600, "/",'',0);
									}
								}
							}
						?>
						<div class="auth-form__group">
							<h3><span class="error"><?php if(isset($error['tb'])) echo $error['tb'];?></span></h3>
						</div>
                        <div class="auth-form_dieukhoan">
                        <a href="" class="auth-form__link">Quên Mật Khẩu</a>
                        </div>					
						<div>
							<input <?php echo ($check)?"checked":"" ?> type="checkbox" class="custom-control-input" id="customCheck" name="remember" value="1">
                            <label class="custom-control-label" for="customCheck">Nhớ mật khẩu</label>
						</div>
                    </div>
                    <div class="auth-form__controls">
                        <button class="btn auth-form__controls-back">Trở Lại</button>
                        <button class="btn btn-primary" type="submit" name="btnlogin" >Đăng Nhập</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>



