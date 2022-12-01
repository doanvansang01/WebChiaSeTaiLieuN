
<?php
	require_once('../code/function.php');
	session_start();
	
?>
<?php require_once('headers.php');?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
    </head>
	
    <body >
	
		<div class="container" style="margin-top:100px">
			
			<div class="row">
			<?php
				
				$dong = 8; // so dong tren 1 trang
		
				if(isset($_GET['page'])) // neu ngta chon thi trang se la noi ngta chon, neu chwa thif laf 0
				{
					$trang = $_GET['page']; 
				}else{
					$trang = 0 ;
				}
				
				$connect = mysqli_connect("localhost","root","","library")or die("Connect faild");
				// tlap bang ma cho connect
				mysqli_query($connect,"set name 'utf8'");
				
				$sqlcommand="select * from document";
				$rs = mysqli_query($connect,$sqlcommand);
				$sodongdl = mysqli_num_rows($rs);
				
				// tính số trang
				$sotrangdl = $sodongdl/$dong;
				//tính vị trí đầu tiên của mỗi trang
				$vtbd = $trang * $dong;
				
				// Nếu Không có 2 TH bên dưới thì sẽ execute câu lệnh này.
				$sql = "select * from document limit  $vtbd , $dong";
				
				// // Tifm Kiem theo the loai
				if(isset($_GET['category_id']))
				{
					$id = $_GET['category_id'];
					$sql = "select *
							from document 
							where category_id = $id limit  $vtbd , $dong";
				}

				
				
				// Tìm Kiếm
				if(isset($_POST['txt_find']) )
				{
					$keyword = $_POST['txt_find'];
					$sql = "select *
							from document 
							where title like '%$keyword%' limit  $vtbd , $dong";
							
				}
				
				
				$kqphantrang = mysqli_query($connect,$sql);
				
				while($item = mysqli_fetch_array($kqphantrang))
				{
					// $filename = '"../tailieucntt/'.$item['filename'].'"';
  
					// // Header content type
					// header("Content-type: application/pdf");
					  
					// header("Content-Length: " . filesize($filename));
					
					echo '<div class="col-md-3 col-6 product-item" style="padding-top:20px">
							<a href="HienThiVanBan.php?id='.$item['id'].'"><img src="hinhanh/'.$item['thumbnail'].'" style="width: 100%; height: 180px;"></a>
							<a href="HienThiVanBan.php?id='.$item['id'].'"> <p style="font-weight: bold; color:black;">'.$item['title'].'</p></a>
							<a ><p style="font-weight: bold;">Lượt tải: '.$item['downloads'].'</p></a>
							<button class="btn btn-success"  ><a class="a_download" href="HienThiVanBan.php?id='.$item['id'].'" >Download</a></button>
						  </div>';
	  
				}
					
			?>
			
			</div>
			
		
			
			
		</div>
		
        <div class="row">
				<div style="margin:0 0 0 90%">
					<?php
						for($i = 0 ; $i <= $sotrangdl  ; $i++)
						{
							echo "<button ><a style='color:black;'  href ='trangchu.php?page=$i'>Trang $i</a></button>";
							if($trang % 8 == 0)
							{
								echo "<br>"; // 8 trang xuoosng dong
							}
						}
					?>
				</div>
		</div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
	</body>
</html>
<?php
	require_once('footer.php');
?>

<!-- <img src="hinhanh/'.$item['thumbnail'].'" style="width: 100%; height: 180px;">
				
