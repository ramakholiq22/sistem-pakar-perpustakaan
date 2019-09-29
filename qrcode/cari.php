<?php
	if(isset($_POST["search"])){
	include "connect.php";
	$valueToSearch = $_POST['ValueToSearch'];
	$query = "SELECT * from  tb_buku where judul like '%$valueToSearch%'";
	$hasil = $connection->query($query) or die($connection->error);
}

else{

	include "connect.php";
	$query = "SELECT * FROM tb_buku";
	$hasil = $connection->query($query) or die($connection->error);
	
}
?>

<div id="main-table">
	<div id="table-header">
		<p>Cari Buku Berdasarkan QRcode</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
		<?php if($_SESSION["level"] != "Anggota" ){ ?>
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=buku" method="post" >
			<input type="text" name="ValueToSearch" placeholder="Input Judul...">
			<input type="submit" name="search" value="search">
		</div>
    </div>