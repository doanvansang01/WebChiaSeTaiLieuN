<?php
	require_once('sua.php');
	$baseUrl= '../';
	require_once('../header.php');
	require_once('function.php');
	
		$id = $filename = $category_id = $title = $thumbnail = $email='';
		
		
		$id=$_GET['id'] ;
		// ktra id và hiển thị thông tin cần sửa
		if($id != '' && $id > 0)
		{
			$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
			mysqli_set_charset($connect,'utf8');
			
			$sql = "select a.email,d.filename , d.category_id,d.title, d.thumbnail
					from document d , account a
					where d.user_id = a.id and d.id = '$id' ";
					
			$result = mysqli_query($connect,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$filename = $row['filename'];
				$category_id = $row['category_id'];
				$title = $row['title'];
				$thumbnail = $row['thumbnail'];
				$email = $row['email'];
			}
			mysqli_close($connect);
		}
		
		// chon the loai
		$sql = "select * from category";
		$categoryitems = executeResult($sql);
		
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
						<form method="post" enctype = "multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						
							<div class="form-group">
							  <label>Tên Tài Liệu</label> 
							  <input required="true" type="text" class="form-control" name="filename" value="<?php echo $filename ;?>"  > <!--required: buộc ng dùng phải nhập dlieu -->	
							  <input type="text" name="id" value="<?=$id?>" hidden="true">
							</div>
							
							<div class="form-group">
							  <label for="usr">Thể loại</label>
							  <select class="form-control" name="category_id"  required="true" value="<?php echo $category_id ;?>">
								<option value="">-- Chọn --</option>
								<?php
									foreach($categoryitems as $category) // duyệt bảng category
									{
										// ktra id trung thi hien thi len dau tien
										if($category['id'] == $category_id)
										{
											echo  	'<option selected value="'.$category['id'].'" >'.$category['name'].'</option>';
										}else{
											echo	'<option value="'.$category['id'].'" >'.$category['name'].'</option>';
										}
									}
								?>
							  </select>
							</div>
							
							<div class="form-group">
							  <label >Tiêu đề</label>
							  <input required="true" type="text" class="form-control" name="title" value="<?php echo $title ;?>">
							</div>
							
							<div class="form-group">
							  <label >Thumbnail</label>
							  <input type="text" class="form-control"  name="thumbnail" value="<?php echo $thumbnail ;?>">
							</div>
							
							<div class="form-group">
							  <label for="email">Email:</label>
							  <input required="true" type="email" class="form-control" name="email" value="<?php echo $email ;?> " disabled>
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

			