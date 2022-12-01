<?php
$id = $filename  = $title = $downloads='';
	if(isset($_GET['id']))
	{
		$id=$_GET['id'] ;
		// ktra id và hiển thị thông tin cần sửa
		if($id != '' && $id > 0)
		{
			$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
			mysqli_set_charset($connect,'utf8');
			
			$sql = " select  * from document where id = '$id' ";
					
			$result = mysqli_query($connect,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$filename = $row['filename'];
				$title = $row['title'];
				$downloads = $row['downloads'];
			}
			mysqli_close($connect);
		}
	}
	
?>