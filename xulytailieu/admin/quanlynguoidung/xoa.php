<?php
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$conn = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($conn,'utf8');
		 
		
		$sql = "select count(*) as total from comment where user_id = $id ";
		$result = mysqli_query($conn,$sql) or die ("không có kết quả trả về!"); 
			
		while($row = mysqli_fetch_array($result))
			{
				$total = $row['total'];	
			}
			
				
			if($total > 0) {
				
				$message= 'Tài khoản có bình luận không được xoá!!!';
				echo "<script type='text/javascript'>alert('$message');window.location='http://localhost/baitapcuoiky/projectcuoiky/xulytailieu/admin/quanlynguoidung/quanlyuser.php';</script>";
				die();
			}
			else
			{
				$sql="delete from account where id = '$id'";
				execute($sql);
				header('location:quanlyuser.php');
			}		
			
			
		mysqli_close($conn);
		header("location:quanlyuser.php");
		echo "Đã xóa!";
	}
	else
	{
		echo "Không tồn tại id!";
	}

?>