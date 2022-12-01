<?php
	require_once('function.php');
		if(isset($_GET['id']))
		{	$total = '';
			$id = $_GET['id'];
			
			$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
			mysqli_set_charset($connect,'utf8');
			
			$sql = "select count(*) as total from document where category_id = $id and deleted = 0";// đếm số lượng t/lieu co thể loại = id đó
			$result = mysqli_query($connect,$sql);
			
			while($row = mysqli_fetch_array($result))
			{
				$total = $row['total'];	
			}
			
				
			if($total > 0) {
				
				$message= 'Danh mục đang chứa sản phẩm, không được xoá!!!';
				echo "<script type='text/javascript'>alert('$message');</script>";
				die();
			}
			else
			{
				$sql = "delete from category where id = $id";
				execute($sql);
				header('location:quanlydanhmuc.php');
			}	
				
			mysqli_close($connect);	
		}
		else
		{
			echo "Không tồn tại!";
		}
		
		
?>