<?php
	
	require_once('codethem_sua.php');
	require_once('function.php');
	$baseUrl='../';
	require_once('../header.php');
	$name = $id='';
	 
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($connect,'utf8');
		
		$sql = "select *from category where id='$id'";
					
		$result = mysqli_query($connect,$sql);
		while($row = mysqli_fetch_array($result))
		{
			$name = $row['name'];	
		}
		mysqli_close($connect);
	}
	
	
	$sql = "select * from category";
	$data = executeResult($sql);
?>

<body>
	
	 
		<div class= "row ">
			<div class="col-md-12 ">
				<h1>Quản Lý Danh Mục</h1>
				
				<div class="col-md-6">
					<form method="post" action="quanlydanhmuc.php" >
						<div class="form-group">
						  <label for="usr" style="font-weight: bold;">Tên Danh Mục:</label>
						  <input required="true" type="text" class="form-control" name="name" value="<?=$name?>"/>
						  <input type="text" name="id" value="<?=$id?>" hidden="true"/>
						</div>
						<button class="btn btn-success">Lưu</button>
					</form>
				</div>
				
				
				<div class="col-md-6 table-responsive">
					<table class="table table-bordered table-hover" style="margin-top: 20px;">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên Danh Mục</th>
								<th style="width: 50px"></th>
								<th style="width: 50px"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$index = 0;
								foreach($data as $item) {
									echo '<tr>
											<th>'.(++$index).'</th>
											<td>'.$item['name'].'</td>
											<td style="width: 50px">
												<a href="?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
											</td>
											<td style="width: 50px">
												<button class="btn btn-danger"><a onclick="return confirmDelete(this);" style="color:white;" href="code_xoa.php?id='.$item['id'].' ">Xoá</a></button>
											</td>
									</tr>';
								}
							?>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
		<script>
			function confirmDelete(link) {
				if (confirm("Are you sure?")) {
					doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
				}
				return false;
			}
		</script>
	
	
</body>


<?php
	require_once('../menu.php');
?>