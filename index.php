<?php
	
		session_start();
	
	if(isset($_SESSION["level"])){
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<div id="container">
		<div id="header">
		<img style="margin-left: 270px;" src="image/buku-magic.gif">
		<img style="margin-left:50px; height: 60px" src="image/perpustakaan-fun-color.gif">	
			<div id="logo">
				<p class="akun"><?php echo $_SESSION["nama"];?></p><br />	
				<p class="akun">(<?php echo $_SESSION["level"]; ?>)</p>
			</div>
		</div>

		<div id="navigasi">
			<ul>
				<li style="text-align:center;"><img src="image/user.png" style="height:auto;width:150px;cursor:default;color:#fff;margin-top:-30px;"></li>
				<?php if($_SESSION["level"] == "Admin"){?>
				<li><a href="?page=anggota"><i class="fa fa-user"></i><span>Data Anggota</span></a></li>
				<li><a href="?page=buku"><i class="fa fa-book"></i><span>Data Buku</span></a></li>
				<li><a href="?page=transaksi"><i class="fa fa-credit-card"></i><span>Data Transaksi</span></a></li>
				<li><a href="?page=dfqrcode"><i class="fa fa-qrcode"></i><span>Data QRcode</span></a></li>
				<li><a href="?page=grafik"><i class="fa fa-bar-chart"></i><span>Grafik</span></a></li>
				<li><a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
				<?php 
			}elseif($_SESSION["level"] == "Pimpinan" || $_SESSION["level"] == "Operator"){ ?>
				<li><a href="?page=buku"><i class="fa fa-book"></i><span>Data Buku</span></a></li>
				<li><a href="?page=transaksi"><i class="fa fa-credit-card"></i><span>Data Transaksi</span></a></li>
				<li><a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
				<?php 
			}else{ ?>
				<li><a href="?page=anggota1"><i class="fa fa-user"></i><span>Data Peminjaman</span></a></li>
				<li><a href="?page=buku"><i class="fa fa-book"></i><span>Data Buku</span></a></li>
				<li><a href="?page=dfqrcode"><i class="fa fa-qrcode"></i><span>Daftar QRcode</span></a></li>
				<li><a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
				<?php }?>
			</ul>
		</div>

		<div id="main">
		
			
				<?php
					if(isset($_SESSION["Admin"])){
						$page=(isset($_GET["page"]))?$_GET["page"]:include"anggota/anggota.php";
					}else{
						$page=(isset($_GET["page"]))?$_GET["page"]:include"buku/buku.php";
					}
					
					/*function getaksi(){
						if(isset($_GET["aksi"])){
							$aksi = $_GET["aksi"];
						}
						
					}*/
					$aksi = (isset($_GET["aksi"]))?$_GET["aksi"]:"";
					

					if($page=="anggota"){
						if($aksi==""){
							include "anggota/anggota.php";
						}elseif($aksi=="tambah"){
							include "anggota/tambah.php";
						}elseif($aksi=="ubah"){
							include "anggota/ubah.php";
						}elseif($aksi=="hapus"){
							include "anggota/hapus.php";
						}elseif($aksi=="persetujuan"){
							include "anggota/persetujuan.php";
						}elseif($aksi=="aktivasi"){
							include "anggota/aktivasi.php";
						}
					}elseif($page=="buku"){
						if($aksi==""){
							include "buku/buku.php";
						}elseif($aksi=="tambah"){
							include "buku/tambah.php";
						}elseif($aksi=="ubah"){
							include "buku/ubah.php";
						}elseif($aksi=="hapus"){
							include "buku/hapus.php";
						}
					}elseif($page =="transaksi"){
						if($aksi==""){
							include "transaksi/transaksi.php";
						}elseif($aksi=="tambah"){
							include "transaksi/tambah.php";
						}elseif($aksi=="perpanjang"){
							include "transaksi/perpanjang.php";
						}elseif($aksi=="kembali"){
							include "transaksi/kembali.php";
						}
					}elseif($page=="anggota1"){
							include "anggota1/anggota1.php";
						}elseif($page=="grafik"){
							include "chartjs/bargraph.php";
					}elseif ($page=="dfqrcode") {
							include "qrcode/dfqrcode.php";
						}elseif ($aksi=="tambahqr") {
							include "qrcode/tambahqr.php";
						}
				?>
			
		</div>
	</div>

	<script type="text/javascript" src="chartjs/js/jquery.min.js"></script>
	<script type="text/javascript" src="chartjs/js/Chart.min.js"></script>
	<script type="text/javascript" src="chartjs/js/app.js"></script>
	
</body>
</html>

<?php
}else{header("location:login.php");}

?>