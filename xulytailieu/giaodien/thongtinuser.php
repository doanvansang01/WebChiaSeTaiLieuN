<?php 
session_start();
require_once('../code/codethongtinuser.php');
$name = $id = $sex = $date = $email = $downloads = '';

$id = $_SESSION['id'];
if ($id != '' && $id > 0) {
    $connect = mysqli_connect("localhost", "root", "", "library") or die("Connect faild");
    mysqli_set_charset($connect, 'utf8');

    $sql = "select a.hoten,a.namsinh,a.gioitinh,a.email, a.id, a.downloads
            from account a
            where a.id = '$id'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['hoten'];
        $sex = $row['gioitinh'];
        $date = $row['namsinh'];
        $email = $row['email'];
        $downloads = $row['downloads'];
    }
    mysqli_close($connect);
}
?>
<html>

<head>
    <meta charset="utf8">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="">
</head>

<body>
    <?php require_once('headers.php'); ?>
    <div id="wrapper" style="margin: 100 0 0 0;">
        <div class="tabs">
            <ul class="nav-tabs">
                <li class="active"><button class="btnDKLN" style="width: 200px"><a href="thongtinuser.php" style="color:black">Thông tin</a></button></li>
                <li><button class="btnDKLN" style="width: 200px"><a href="doimatkhau.php" style="color:black">Đổi mật khẩu<a></button></li>
            </ul>
        </div>
		<div><p ><h4 style="margin-left: 300px"> Thông tin của bạn</h4></p></div>
        <div class="panel-body table-responsive" style="margin-left: 300px">
	
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							

							<div class="form-group" style="width:50%">
								 <label>Họ và Tên</label> 
								 <input  type="text" class="form-control" name="hoten" required="true"   value="<?php echo $name; ?>" >
								<input type="text" name="id" value="<?= $id ?>" hidden="true">

							</div>
							
							
							<div class="form-group" style="width:50%">
							  <label for="usr">Ngày sinh:</label>
							  <input required="true" class="form-control" type="date" name="namsinh" value="<?php echo $date; ?>">
							</div>
							
							
							<div class="form-group" style="width:50%">
								<label for="usr">Giới tính:</label>
								<input checked="true" type="radio" name="gioitinh" value="Nam">Nam
								<input  type="radio" name="gioitinh" value="Nữ">Nữ
                        
							</div>
							
							<div class="form-group" style="width:50%">
							  <label >Email</label>
							  <input  type="text" class="form-control" name="email" value="<?php echo $email; ?>" disabled>               
							</div>
							
							<div class="form-group" style="width:50%">
								<label >Lượt tải</label>
                            
								<input required="true"class="form-control"  type="text" name="downloads" value="<?php echo $downloads; ?>" disabled></div>
							</div>

							 <button class="btn btn-success bt"  name="dk" style="margin-left: 300px">Cập nhật
						</form>
					</div>
    </div>
   
</body>

</html>
<?php require_once('footer.php'); ?>

				