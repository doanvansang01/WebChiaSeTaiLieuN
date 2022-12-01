
<?php 
	
	$baseUrl= '../';
	require_once('../header.php');
	require_once('function.php');
	
	// chon the loai
	$sql = "select * from category";
	$categoryitems = executeResult($sql);
	
	// chon tai khoan admin
	$command = "select * from account where role_id='0'  ";
	$accounts = executeResult($command);
	
	// chon loại cấp phép
	$query = "select * from license  ";
	$licenseitems = executeResult($query);
	
	// Thêm tài liệu
	if(isset($_POST['btnthem']))
	{
			$filename = $_POST['filename'];
			$category_id = $_POST['category_id'];
			$license_id = $_POST['license_id'];
			$title = $_POST['title'];
			$thumbnail = $_POST['thumbnail'];
			$user_id =$_POST['user_id'];
			$created_at = date("Y-m-d H:i:s");
			
			$conn = mysqli_connect("localhost","root","","library")or die("Connect faild");
			mysqli_set_charset($conn,'utf8');
			
			$sql = "insert into document(filename, category_id,license_id, title, thumbnail,user_id,downloads,status,deleted,created_at)
					values('".$filename."','".$category_id."','".$license_id."','".$title."','".$thumbnail."','".$user_id."','0','1','0','".$created_at."')";
		
			$check = "select * from document  ";
			$kq = mysqli_query($conn,$check)or die("Excecute failed!");
			
			if($row = mysqli_fetch_array($kq))
			{
				$results = mysqli_query($conn, $sql) or die("thực hiện thất bại!");	
				if($results)
				{
					header('location:quanlytailieu.php');
				}else{
		     		echo "Lỗi,không thêm được!";
				}
			}
			else
			{
				echo "Email không tồn tại!";
			}

			mysqli_close($conn);
			
	}
	else
	{
		echo "Không tồn tại!";
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
				<h3>Thêm/Sửa Tài Liệu</h3>
				<div class="panel panel-primary ">
					<div class="panel-heading">
						<h5 style="color: red;"></h5>
					</div>
					
					<div class="panel-body table-responsive">
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							
							<div class="form-group">
								Chọn tệp tin: <input type="file" name = "tenfile"> </input>
								<input type="submit" name="btnUpload" value="Upload data"/>
							</div>
							
							<?php
								if(isset($_POST['btnUpload']))
								{
									$th = "D:/".$_FILES['tenfile']['name'];
									move_uploaded_file($_FILES['tenfile']['tmp_name'],$th);		
									$st = $_FILES['tenfile']['name'];
							?>
							<div class="form-group">
								 <label>Tên Tài Liệu</label> 
								 <input  type="text" class="form-control" name="filename"  value="<?=$st?>" >	
							</div>
							<?php }	?>
							
							<div class="form-group">
							  <label for="usr">Thể loại</label>
							  <select class="form-control" name="category_id">
								<option value="">-- Chọn --</option>
								<?php
									foreach($categoryitems as $category) // duyệt bảng category
									{									
										echo '<option  value="'.$category['id'].'">'.$category['name'].'</option>';// Hiển thị list thể loại
										
									}
								?>
							  </select>
							</div>
							
							<div class="form-group">
							  <label for="usr">Cấp phép</label>
							  <select class="form-control" name="license_id">
								<option value="">-- Chọn --</option>
								<?php
									foreach($licenseitems as $license) // duyệt bảng category
									{									
										echo '<option  value="'.$license['id'].'">'.$license['name'].'</option>';// Hiển thị list thể loại
										
									}
								?>
							  </select>
							</div>
							
							<div class="form-group">
							  <label >Tiêu đề</label>
							  <input  type="text" class="form-control" name="title">
							</div>
							
							<div class="form-group">
								Chọn hình ảnh: <input type="file" name = "tenf"> </input>
							</div>
							
							<?php
								if(isset($_POST['btnUpload']))
								{
									$th = "D:/".$_FILES['tenf']['name'];
									move_uploaded_file($_FILES['tenf']['tmp_name'],$th);		
									$tf = $_FILES['tenf']['name'];
							?>
							<div class="form-group">
								 <label >Thumbnail</label> 
								 <input type="text" class="form-control"  name="thumbnail"  value="<?=$tf?>">
								
							</div>
							<?php }	?>
							
							
							<div class="form-group">
							  <label for="usr">Email</label>
							  <select class="form-control" name="user_id">
								<option value="">-- Chọn --</option>
								<?php
									foreach($accounts as $account) // duyệt bảng account
									{
										// Hiển thị list email admin
										echo '<option value="'.$account['id'].'">'.$account['email'].'</option>';
										
									}
								?>
							  </select>
							</div>
					
							 <button  type = "submit" class="btn btn-success bt" name="btnthem"> Thêm </button>
							
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
