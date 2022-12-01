<?php
	require_once('suauser.php');
	$baseUrl= '../';
	require_once('../header.php');
	
	
		$name = $id = $hoten = $sex = $role_id = $date = $email='';
		
		
		$id=$_GET['id'] ;
		// ktra id và hiển thị thông tin cần sửa
		if($id != '' && $id > 0)
		{
			$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
			mysqli_set_charset($connect,'utf8');
			
			$sql = "select a.hoten,a.namsinh,a.gioitinh,a.email,a.role_id, r.name, a.id
            from account a, role r
            where a.role_id = r.id and a.id = '$id'";
            
            
					
			$result = mysqli_query($connect,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$name = $row['name'];
				$hoten = $row['hoten'];
				$date = $row['namsinh'];
				$email = $row['email'];
			}
			mysqli_close($connect);
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
				<h3>Thêm/Sửa người dùng</h3>
				<div class="panel panel-primary ">
					<div class="panel-heading">
						<h5 style="color: red;"></h5>
					</div>
					
					<div class="panel-body table-responsive">
						<form method="post" enctype = "multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						
							<div class="form-group">
							  <label for="hoten">Tên người dùng</label> 
							  <input required="true" type="text" class="form-control" name="hoten" value="<?php echo $hoten ;?>"  > <!--required: buộc ng dùng phải nhập dlieu -->	
							  <input type="text" name="id" value="<?=$id?>" hidden="true">
							</div>

							<div class="form-group">
							  <label for="namsinh">Năm sinh</label>
							  <input required="true" type="date" class="form-control" name="date" value="<?php echo $date ;?>">
							</div>		
							
							<div class="form-group">
							  <label for="email">Email:</label>
							  <input required="true" type="email" class="form-control" name="email" value="<?php echo $email ;?> ">
							</div>

							<div class="form-group">
							  <label for="name">Quyền truy cập:</label>
							  <input required="true" type="text" class="form-control" name="name" value="<?php echo $name ;?> " disabled>
							</div>
														
							 <button class="btn btn-success bt" name="btnsua"> Sửa </button>
							
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