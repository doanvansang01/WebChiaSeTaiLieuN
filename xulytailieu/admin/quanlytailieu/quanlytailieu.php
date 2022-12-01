<?php
require_once('function.php');
$dong = 12; // so tài liệu tren 1 trang

if (isset($_GET['page'])) // neu ngta chon thi trang se la noi ngta chon, neu chwa thif laf 0
{
	$trang = $_GET['page'];
} else {
	$trang = 0;
}

$connect = mysqli_connect("localhost", "root", "", "library") or die("Connect faild");
// tlap bang ma cho connect
//mysqli_query($connect, 'utf8');
mysqli_set_charset($connect, 'utf8');

$sqlcommand = "select * from document where deleted = 0 and status = 1";
$rs = mysqli_query($connect, $sqlcommand);
$sodongdl = mysqli_num_rows($rs);

// tính số trang
$sotrangdl = $sodongdl / $dong;
//tính vị trí đầu tiên của mỗi trang
$vtbd = $trang * $dong;

if (isset($_POST['txt_find'])) {
	$keyword = $_POST['txt_find'];
	$sql = "select a.email,d.filename,d.title,c.name,d.status,d.id
				from document d, category c, account a, role r 
				where  d.role_id = r.id and d.user_id = a.id and d.category_id = c.id and d.status ='1' and d.deleted= '0' and  title like '%$keyword%'  ";
} else {
	$sql = "select a.email,d.filename,d.title,c.name,d.status,d.id
			from  document d, category c, account a, role r
			where d.role_id = r.id and d.user_id = a.id and d.category_id = c.id and d.status ='1' and d.deleted= '0'  limit  $vtbd , $dong
			 ";
}

$data = executeResult($sql); // hàm thực thi câu lệnh sql function.php
$baseUrl = '../';
require_once('../header.php');
require_once('download.php');

?>

<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="row ">
			<div class="col-md-12 ">
				<h1>Quản Lý Tài Liệu</h1>
				<div>
					<button class="btn btn-success btt"><a style="color:white;" href="form_them.php">Thêm Tài Liệu</a></button>

					<form action="#" method="post">
						<div id="div-input-tim" style="margin-top:40px">
							<input class="input_find" type="text" name="txt_find" placeholder="Tìm kiếm">

							<button class="btn_find" name="btn_find">Tìm Kiếm</button>
						</div>
					</form>
					<h3 style=" width:30%;margin-top: -30px ;margin-left : 950px"><a href="duyettailieu.php" style="color:black;">Trang kiểm duyệt</a></h3>


				</div>

				<div style="margin-top: -30px">
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
										<button class="btn btn-warning"><a style="color:white;" href="form_sua.php?id=' . $item['id'] . ' "> Sửa</a></button>
									</td>
									<td style="width: 50px">
										<button class="btn btn-danger" ><a onclick="return confirmDelete(this);" style="color:white;" href="xoa.php?id=' . $item['id'] . ' "> Xóa </a></button>
									</td>
								 </tr>';
							}
							?>


						</tbody>

					</table>

					<div class="row">
						<div style="margin-left:10px">
							<?php
							for ($i = 0; $i < $sotrangdl; $i++) {
								echo "<button style='margin:5px'><a style='color:black;'  href ='quanlytailieu.php?page=$i'>Trang $i</a></button>";
							}
							?>
						</div>
					</div>

				</div>
			</div>
		</div>

	</form>


	<script>
		// Tạo thông báo xóa
		function confirmDelete(link) {
			if (confirm("Bạn chắc chắn muốn xóa?")) {
				doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
			}
			return false;
		}
	</script>
</body>

<?php
require_once('../menu.php');
?>