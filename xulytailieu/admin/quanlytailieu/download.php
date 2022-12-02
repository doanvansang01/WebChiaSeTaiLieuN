<?php
// download to check

if(isset($_GET['path']))
	{
		
		
		$filename = $_GET['path'];
		$fp = fopen($filename, "r") ; // mở file
		//Check the file exists or not
		if(file_exists($filename)) {

			//Define header information
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');// dữ liệu nhị phân tùy ý, muốn file kiểu gì cũng đc
			header("Cache-Control: no-cache, must-revalidate");
			header('Content-Disposition: attachment; filename="'.basename($filename).'"'); // bố trí ,attachment cho biết  nó nên đc tải xuống, chỉ lấy tên file 
			header('Content-Length: ' . filesize($filename));
			header('Pragma: public');
			ob_clean(); // loại bỏ nội dung của bộ đệm đầu ra
			//Clear system output buffer
			flush();

			while (!feof($fp)) { //kiểm tra xem con trỏ tập tin đã ở vị trí cuối cùng của file chưa.
			   $buff = fread($fp, 1024); //  sẽ đọc nội dung của file truyền vào.
			   print $buff;
			}
			exit;
			//Terminate from the script
			
		}
		else{
			echo "File does not exist.";
		}
	}
	else
	{
		echo "Filename is not defined.";
	}
