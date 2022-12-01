<?php
	if(isset($_GET['cmt']))
	{
		$id=$_GET['cmt'] ;
		$dcm = $_GET['dcm'];
		$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($connect,'utf8');
		
		$sql = " delete from comment where id = '$id' ";
		$result = mysqli_query($connect,$sql) or die("Sai rồi");
		mysqli_close($connect);
		header('location: ../giaodien/HienThiVanBan.php?id='.$dcm.'');
	}
?>