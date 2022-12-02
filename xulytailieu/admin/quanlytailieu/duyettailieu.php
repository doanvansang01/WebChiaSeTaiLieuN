<?php
require_once('function.php');
$sql = "select a.email,d.filename,d.title,c.name,d.status,d.id
			from  document d, category c, account a, role r
			where d.role_id = r.id and d.user_id = a.id and d.category_id = c.id and d.status ='0' and d.deleted= '0'
			 ";
$data = executeResult($sql); // hàm thực thi câu lệnh sql function.php
$baseUrl = '../';
require_once('../header.php');
require_once('download.php');

?>

<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="row ">
			<div class="col-md-12 ">
				<h1>Kiểm Duyệt Tài Liệu</h1>

				<table class="table table-bordered table-hover table-responsive ">



					<thread>
						<tr>
							<th>STT</th>
							<th>Email</th>
							<th>Tên file</th>
							<th>Tiêu đề</th>
							<th>Thể loại</th>
							<th>Trạng thái</th>

							<th style="width: 50px"></th>
							<th style="width: 50px"></th>
						</tr>
					</thread>
					<tbody>


						<?php
						$index = 0;
						foreach ($data as $item) {

							echo '
								<tr>
									<td>' . (++$index) . '</td>
									<td>' . $item['email'] . '</td>
									<td><a href="quanlytailieu.php?path=../../tailieucntt/' . $item['filename'] . ' "> ' . $item['filename'] . ' </a></td>
									<td>' . $item['title'] . '</td>
									<td>' . $item['name'] . '</td>
									<td>' . $item['status'] . '</td>
									
									<td style="width: 50px">
										<button  class="btn btn-success" ><a style="color:white;" href="duyet.php?id=' . $item['id'] . ' "> Duyệt</a></button>
									</td>
									
									<td style="width: 50px">
										<button  class="btn btn-danger" ><a style="color:white;" href="xoa.php?id=' . $item['id'] . ' ">Xóa</a></button>
									</td>
									
								 </tr>';
						}
						?>


					</tbody>

				</table>

			</div>
		</div>

	</form>


</body>

<?php
require_once('../menu.php');
?>