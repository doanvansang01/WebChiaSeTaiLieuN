<?php
	$baseUrl= '../';
	require_once('../header.php');
	require_once('../quanlytailieu/function.php');
?>

	<?php
			
			
			$sql = "select * from role";
			$role = executeResult($sql);
			
			$fullname =$date=$email =$pass = $repass =$role_id="" ;	
			
			if(isset($_POST['name'])&& isset($_POST['date']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['repass']))
			{
		      $error = array();
			  
			 // ktra  các ô rống
				
				
				if(empty($_POST['email']))
				{
					$error['email'] = "Email is required";
				}
				else
				{
					$email = $_POST['email'];
					if(!filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$error['email'] ="Invalid email format";
					}
				}
				
				if(empty($_POST['pass']))
				{
					$error['pass'] = "Password is required";
				}
				else
				{
					$pass = $_POST['pass'];
					if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$pass))
					{
						$error['pass'] ="Mật khẩu phải nhập ít nhất 8 kí tự gồm chữ và số!";
					}
						 
				}
					
				
				if(empty($error))
				{
					
					$fullname = $_POST['name'];
					$date = $_POST['date'];
					$email = $_POST['email'];
					$password = $_POST['pass'];
					$repass = $_POST['repass'];
					$role_id = $_POST['role_id'];
					
					
					// tạo kết nối tới database
					$connect = mysqli_connect("localhost","root","","library")or die("Không kết nối được database");
					
					// cho phep luu tieng viet vao database	
					mysqli_set_charset($connect,'utf8');
					
				
					// chèn data vào database
					$query = "insert into account(role_id,hoten,namsinh,gioitinh,email,matkhau,downloads)
							values ('".$role_id."','".$fullname."','".$date."',true,'".$email."','".md5($password)."','0') ";
								
					
					if($password != $repass)
					{
						$tb = "Nhập lại mật khẩu không đúng";
					}
					else
					{
						$check = "select * from account where email='".$email."' ";
						$kq = mysqli_query($connect,$check)or die("Excecute failed!") ;
						
						if($row = mysqli_fetch_array($kq))
						{
							$tb ="Tên đăng nhập đã sử dụng";
							
						}
						else
						{
							$results = mysqli_query($connect, $query) or die("thực hiện thất bại!");
							
							if($results)
							{
								header("location:quanlyuser.php");
							}else{
								$tb="Lỗi,không đăng ký được!";
							}
						}	
						
					}
					
					
					//dong ket noi
					mysqli_close($connect);
					echo "<script type='text/javascript'>alert('$tb');</script>";
					
				}
				

			}
			
				
		?>
<html>
	<head>
		<meta charset = 'utf8'>
		<title>Thêm/Sửa</title>
		 <link rel="stylesheet"/>
	</head>
	
	<body >
		
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-12 ">
				<h3>Thêm người dùng</h3>
				<div class="panel panel-primary ">
					<div class="panel-heading">
						<h5 style="color: red;"></h5>
					</div>
					
					<div class="panel-body table-responsive">
						<form method="post" enctype = "multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						
							<div class="form-group">
							  <label for="hoten">Tên người dùng</label> 
							  <input required="true" type="text" class="form-control" name="name" value=""  > <!--required: buộc ng dùng phải nhập dlieu -->	
							 
							</div>

							<div class="form-group">
							  <label for="namsinh">Năm sinh</label>
							  <input required="true" type="date" class="form-control" name="date" value="">
							</div>		
							
							<div class="form-group">
							  <label for="email">Email:</label>
							  <input required="true" type="email" class="form-control" name="email" value=" ">
							</div>
							
							<div class="form-group">
							  <label for="password">Mật khẩu:</label>
							  <input required="true" type="password" class="form-control" name="pass" ">
							</div>
							
							<div class="form-group">
							  <label for="repass">Nhập lại mật khẩu:</label>
							  <input required="true" type="password" class="form-control" name="repass"  ">
							</div>

							<div class="form-group">
							  <label for="usr">Quyền truy cập</label>
							  <select class="form-control" name="role_id">
								<option value="">-- Chọn --</option>
								<?php
									foreach($role as $roleitem) // duyệt bảng category
									{									
										echo '<option  value="'.$roleitem['id'].'">'.$roleitem['name'].'</option>';// Hiển thị list thể loại
										
									}
								?>
							  </select>
							</div>
														
							 <button class="btn btn-success bt" name="btnthem" type="submit"> Thêm </button>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	
	</body>
	
</html>

<?php
	 require_once('../menu.php');

?>