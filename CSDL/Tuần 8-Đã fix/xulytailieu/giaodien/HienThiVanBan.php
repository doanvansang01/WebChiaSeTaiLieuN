<?php
	require_once('../code/function.php');
	session_start();
	// Đặt trc header vì mở session thì header ms dùng đc
	require_once('headers.php');
	
	
?>
<head>
	<link rel="stylesheet" href="CSS/HienThiVanBan.css">
	<link rel="stylesheet" href="CSS/tailieuword.css">
	 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<?php


if(isset($_GET['path']))
{
	
	$fn = $_GET['path'];
	
	//Check the file exists or not
	if(file_exists($fn) && isset($_SESSION['login']) ) {
		
		$email = $_SESSION['login'];
		$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
		mysqli_query($connect,"set name 'utf8'");

		// xd câu lệnh sql
		$sql = " select * from account where email ='".$email."' ";
		$result = mysqli_query($connect,$sql);
		$index = 0;
			
		$row = mysqli_fetch_array($result);// lấy 1 bảng ghi nên k cần while
		$index = $row['downloads'] + 1 ;
			
		if($index > 5)// Nếu lượt downloads của user vượt quá 5, thì thông báo
		{	
			$message= 'Bạn cần upload tài liệu  để tiếp tục  download tài liệu!';	
			echo "<script type='text/javascript'>alert('$message');history.back();</script>";				
			
		}
		else{
			// Cập nhập lại số lần download của tkhoan đó
			$sqlcmd = "update account set downloads = '".$index."' where email ='".$email."'";
			$resultcmd = mysqli_query($connect,$sqlcmd);
			// Cập nhập số lần download tài liệu
			require_once('../code/documentdownloads.php');
				
			//và download
			//Define header information
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: 0");
			header('Content-Disposition: attachment; filename="'.basename($fn).'"');
			header('Content-Length: ' . filesize($fn));
			header('Pragma: public');
			
			//Clear system output buffer
			flush();
			//Read the size of the file
			readfile($fn);

			//Terminate from the script
			die();
			
			mysqli_close($connect);
			
				
		}
				
		
	}
	else
	{	
		header('location:../../xulytaikhoan/dangnhap.php');
		
	}
	

}


?>
<?php
	// chứa filename
	require_once('../code/codehienthivanban.php');
	// Cắt chuỗi, trước dấu chấm và sau dấu chấm
	$ten = explode(".", $filename);
	
	
?>
<html lang="en">

<head>
  <title><?=$title?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

</head>

<body>

	<?php
	if($ten[1] =='pdf')
	{
		echo'
		 
		  
		  <div className="row" style="background-color: #f7f7f7;">
			<div class="document-name" style="width:70%;margin-left:260px;margin-top:90px;height:150px;background:#FFF;padding:10px;">
			   <div class="name">
				  <h1 class="name-purple">'.$title.'</h1>
			   </div>
			   <div style="width:130px;float:right;text-align:center;margin-right:10px;">
				  <span class="dowloads__">
					<span class="dowloads-number" style="color: red;">'.$downloads.'</span>
					<br>
					<span class="dowloads-text">Lượt tải</span>
				  </span>
			   </div>
			</div>
			<div className="col-sm-6">
			  <iframe height="700px" width=70% style="margin: 10px 0px 10px 260px;" src="../tailieucntt/'.$filename.'"></iframe>
			</div>
			<div className="col-sm-6">
			  <div className="panel panel-info">
				<div className="panel-heading" style="width: 70%;margin-left:260px;height:100px;background:#FFF;padding:10px;">
				  <div class="download" >
					<h2 class="name-purple">
					  <div>'.$title.'</div>
					</h2>
				  </div>
				  <div id="btn_download" style="display: inline-block; margin-left: 600px">
					<a class="btn-dow" href="HienThiVanBan.php?path=../tailieucntt/'.$filename.'">Tải về</a>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  ';
	}
	else
	{
		echo ' <div class="scroll">
            <div class="container">
                <h1 class="text">
                    <div class="tieude1">
                        <p style="text-align: center">
                            <span style="color: #fff">
                                <span style="font-family: tahoma,geneva,sans-serif">
                                    <span style="font-size:36px">
                                        <strong>BỘ TÀI LIỆU</strong>
                                    </span>
                                </span>
                            </span>
                        </p>
                    </div>
                    <div class="tieude2">
                        <p style="text-align: center">
                            <span style="color: #FF8C00">
                                <span style="font-family: tahoma,geneva,sans-serif">
                                    <span style="font-size:72px">
                                        <strong>'.$title.'</strong>
                                    </span>
                                </span>
                            </span>
                        </p>
                    </div>
                </h1>
                <div class="view">
                    <span>
                        <i class="far fa-file-alt"></i> Tài liệu
                    </span>
                    <span>
                        <i class="fas fa-file-download"></i> '.$downloads.' lượt tải
                    </span>
                </div>
                <div class="taingay">
                    <button class="btn-taingay">
                        <i class="fas fa-download"></i>
						<a href="HienThiVanBan.php?path=../tailieucntt/'.$filename.'">Download</a>
                    </button>
                </div>
            </div>
        </div>';
	}
		
		
?>
  

</body>

</html>
<?php
	
	require_once('footer.php');
?>
<!--  <div className="row">
			<div className="col-sm-6">
			  <iframe height="640px" width=70% style="margin: 170px 0px 0 250px;" src="../tailieucntt/'.$filename.'"></iframe>
			</div>
			
			<div className="col-sm-6">
			  <div className="panel panel-info">
				<div className="panel-heading">	  
				  <div class="download">
					<a class="btn-dow" href="HienThiVanBan.php?path=../tailieucntt/'.$filename.'">Tải về</a>
					
				 </div>
				</div>
				
			  </div>
			</div>
			
		  </div>