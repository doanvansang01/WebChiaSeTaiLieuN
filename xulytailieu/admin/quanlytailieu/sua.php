<?php
	
	 // code sửa
	if( isset($_POST['id']) && isset($_POST['filename']) && isset($_POST['category_id']) 
		&& isset($_POST['title']) && isset($_POST['thumbnail']) )	
	{
		
		$id = $_POST['id'];
		$filename =$_POST['filename'];
		$category_id = $_POST['category_id'];
		$license_id = $_POST['license_id'];
		$title = $_POST['title'];
		$thumbnail = $_POST['thumbnail'];
		$update_at = date("Y-m-d H:i:s");

		$conn = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($conn,'utf8');

		$sql= "UPDATE document SET filename ='".$filename."', category_id = '".$category_id."', license_id = '".$license_id."', title = '".$title."', 
			  thumbnail = '".$thumbnail."' ,update_at= '".$update_at."'
			  WHERE id ='".$id."' ";
 
		$result = mysqli_query($conn,$sql) or  die("Execute Failed!");
			
		mysqli_close($conn);
		header("location:quanlytailieu.php");
	}
	else
	{
		echo "Không tồn tại!";
	}
	
	
?>
<!--&& 
		