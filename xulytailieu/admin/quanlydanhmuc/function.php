<?php
	function insertData()
	{
		$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($connect,'utf8');
		
		for($i = 0 ; $i < 12; $i++)
		{
			$sql = 'insert into tailieu(thumbnail,title,category,downloads)
					values("hinhanh/java.jpg","Tài liệu java","CNPM","1")';	
			mysqli_query($connect,$sql);
		}
		
		mysqli_close($connect);
	}
	
	function executeResult($sql){
		$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($connect,'utf8');
		$data = [];// nơi chứa dữ liệu đầu ra, nó chứa 1 mảng các trường
		
		$result = mysqli_query($connect,$sql);
		while($row = mysqli_fetch_array($result))
		{
			$data[]= $row;
		}
		
		mysqli_close($connect);
		return $data;
		
	}
	
	
	function execute($sql)
	{
		$conn = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_set_charset($conn,'utf8');
		
		mysqli_query($conn,$sql);
		mysqli_close($conn);
		
		
	}
