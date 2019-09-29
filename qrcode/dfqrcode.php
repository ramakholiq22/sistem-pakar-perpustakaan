<?php
	if(isset($_POST["search"])){
	include "connect.php";
	$valueToSearch = $_POST['ValueToSearch'];
	$query = "SELECT * from  tb_qrcode where jdbuku like '%$valueToSearch%'";
	$hasil = $connection->query($query) or die($connection->error);
}

else{

	include "connect.php";
	$query = "SELECT * FROM tb_qrcode";
	$hasil = $connection->query($query) or die($connection->error);
	
}
?>

<div id="main-table">
	<div id="table-header">
		<p>Data QRcode</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
		<?php if($_SESSION["level"] != "Anggota" ){ ?>
			<a href ="?page=tdfqrcode&aksi=tambahqr" class="aksi1" style="margin-left:8px;margin-top:5px;"><i class="fa fa-plus" style="font-size:15px"></i> Tambah QRcode</a> <?php }?>
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=qrcode" method="post" >
			<input type="text" name="ValueToSearch" placeholder="Masukan Sandi QRcode">
			<input type="submit" name="search" value="search">
		</div>
    </div>
	
	<div id="clear">
	<!--Clear Float-->
	</div>
		
			<?php
	            while($data=$hasil->fetch_assoc()){
	        ?>          
				<table id="table" style="display:inline-table;width:150px; ">
	                    <tr>
	                        <td>
	                        	<img style="width:100%;height:200px;" src="<?=$data["qrcode"]?>">
		                        <strong><?=$data["jdbuku"]?></strong><br /><br />
		                        
		                    
		                    </td>
	                    <?php if($_SESSION["level"]=="Admin"||$_SESSION["level"]!="Pimpinan" && $_SESSION["level"] != "Anggota"){?>
	                     <tr>
	                        <td>
					            <a href="?page=dfqrcode&aksi=update&id=<?php echo $data["id"];?>" class="aksi">Ubah</a>
					            <a onclick="return confirm('Anda yakin ingin menghapus data ini ... ?')" href ="?page=dfqrcode&aksi=delete&id=<?php echo $data["id"];?>" class = "aksi1">Hapus</a>
				        	</td>
	                    </tr>
					    <?php
					}
						} ?>
				</table>
		</form>
	</div>