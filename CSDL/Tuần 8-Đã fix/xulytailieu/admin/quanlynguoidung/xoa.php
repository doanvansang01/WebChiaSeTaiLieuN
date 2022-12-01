<?php
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$conn = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($conn,'utf8');
		 
		
		$sql="delete from account where id = '$id'";
		$result = mysqli_query($conn,$sql) or die ("không có kết quả trả về!"); 
			
		mysqli_close($conn);
		header("location:quanlyuser.php");
		echo "Đã xóa!";
	}
	else
	{
		echo "Không tồn tại id!";
	}

?>