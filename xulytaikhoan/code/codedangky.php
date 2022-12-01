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
												values('1','".$fullName."','".$date."',true,'".$email."','".md5($pass)."','0')";
										
									
									
									if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)){
										$error['saimail'] = "Lỗi: Sai định đang email!";
									}
									// kiểm tra định dạng Mật khẩu
									if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$pass)){
										$error['saiPass'] = "Lỗi: Mật khẩu phải nhập ít nhất 8 kí tự gồm chữ và số!";
									}
									
									if($pass!=$repass){
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