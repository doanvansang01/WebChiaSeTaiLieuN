<?php
	require_once('function.php');
	
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		if($id > 0)
		{
			$sql = "update category set name ='$name' where id =$id";
			execute($sql);
		}
		else
		{
			$sql = "insert into Category(name) values('$name')";
			execute($sql);
		}
	}
	else
	{
		echo "Không tồn tại!";
	}
