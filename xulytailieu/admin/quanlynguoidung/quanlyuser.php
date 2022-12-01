<?php
	require_once('function.php');
	$sql = "select a.hoten,a.namsinh,a.gioitinh,a.email,a.role_id, a.id ,r.name
	from account a, role r
	where a.role_id = r.id";
	$data = executeResult($sql);
	$baseUrl= '../';
	require_once('../header.php');
 ?>
	
<div class= "row ">
	<div class="col-md-12 ">
		<h1>Quản Lý Người Dùng</h1>
		<button class="btn btn-success btt"><a style="color:white;" href="form_them.php">Thêm tài khoản</a></button>
		<table class="table table-bordered table-hover table-responsive ">
			<thread>
			  <tr>
				<th>STT</th>
				<th>Họ Tên</th>
				<th>Năm sinh</th>
				<th>Giới tính</th>
				<th>Email</th>
				<th>Quyền truy cập</th>
				<th style="width: 50px"></th>
				<th style="width: 50px"></th>
			  </tr>
			</thread>
			<tbody>
				<?php
					$index = 0;
					foreach($data as $item)
					{
						echo'
						<tr>
							<td>'.(++$index).'</td>
							<td>'.$item['hoten'].'</td>
							<td>'.$item['namsinh'].'</td>

							<td>'.$item['gioitinh'].'</td>
							<td>'.$item['email'].'</td>
							<td>'.$item['name'].'</td>
							<td style="width: 50px">
							<button class="btn btn-warning"><a style="color:white;" href="form_sua.php?id='.$item['id'].' "> Sửa</a></button>
							</td>
							<td style="width: 50px">
								<button class="btn btn-danger" ><a onclick="return confirmDelete(this);" style="color:white;" href="xoa.php?id='.$item['id'].' "> Xóa </a></button>
							</td>
						 </tr>';
					}
				?>
			
			</tbody>
		
		</table>
	</div>
</div>
<script>
	// Tạo thông báo xóa
    function confirmDelete(link) {
        if (confirm("Bạn chắc chắn muốn xóa?")) {
            doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
        }
        return false;
    }
	</script>
<?php
	require_once('../menu.php');
?>

