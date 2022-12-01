<?php 
session_start();
ob_start();

?>
<html>

<head>
    <meta charset="utf8">
    <title>Đổi mật khẩu</title>
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
		<div><p ><h4 style="margin-left: 300px"> Đổi mật khẩu</h4></p></div>
        <div class="panel-body table-responsive" style="margin-left: 300px">
						<form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>">

							<div class="form-group" style="width:50%">
							  <label >Mật khẩu cũ</label>
							  <input  type="password" class="form-control" name="oldpass" placeholder="Nhập mật khẩu cũ" >               
							</div>
							
							<div class="form-group" style="width:50%">
							  <label >Mật khẩu mới</label>
							  <input  type="password" class="form-control" name="newpass" placeholder="Nhập mật khẩu mới">               
							</div>
							
							<div class="form-group" style="width:50%">
							  <label >Nhập lại mật khẩu </label>
							  <input  type="password" class="form-control" name="repass" placeholder="Nhập lại mật khẩu " >               
							</div>
							
							<div class="auth-form__group">
							<h3><span class="error"><?php if(isset($error['tb'])) echo $error['tb'];?></span></h3>
							</div>

							 <button class="btn btn-success bt"  type="submit" style="margin-left:-10px">Đồng ý
						</form>
		</div>
    </div>
   
</body>

</html>
<?php

	$error = array();
	
	if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['repass']))
	{
		$id = $_SESSION['id'];
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$repass = $_POST['repass'];


		$connect = mysqli_connect("localhost", "root", "", "library") or die("Connect faild");
		mysqli_set_charset($connect, 'utf8');

		$sql = "select *
				from account 
				where id = '$id'";
		$result = mysqli_query($connect, $sql);
		
		if($row=mysqli_fetch_array($result))
		{
											
			
			if($newpass != $repass )
			{
				$error['tb'] = "Nhập lại mật khẩu không đúng !";
			}
			else
			{	
				if($row['matkhau'] == md5($oldpass))
				{
					$sql = "update account set matkhau = '".md5($newpass)."' where id = '$id'";
					$result = mysqli_query($connect, $sql) or die("Không được");	
					header('location: trangchu.php');
				}
				else
				{
					$error['tb'] = "Mật khẩu không chính xác !";
				}
			}     
			
			
			
			mysqli_close($connect);
		}
	}
	
	


require_once('footer.php'); 
ob_end_flush();
?>