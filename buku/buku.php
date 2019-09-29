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
		<p>Data Buku</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
		<?php if($_SESSION["level"]=="Admin" || $_SESSION["level"] !="Pimpinan" && $_SESSION["level"] != "Anggota" ){ ?>
			<a href ="?page=buku&aksi=tambah" class="aksi1" style="margin-left:8px;margin-top:5px;"><i class="fa fa-plus" style="font-size:15px"></i> Tambah Data</a> <?php }?>
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=buku" method="post" >
			<input type="text" name="ValueToSearch" placeholder="Input Judul...">
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
	                        	<img style="width:100%;height:200px;" src="<?=$data["Gambar"]?>">
		                        <strong><?=$data["judul"]?></strong><br /><br />
		                        
		                       <span> <?=$data["pengarang"]?></span><br />
		                        <span><?=$data["penerbit"]?></span><br />
		                        <span><?=$data["isbn"]?></span><br />

		                    </td>
		                </tr>
		                        <tr>
		                        	<td><pre><strong>Stok</strong>   :<?=$data["jumlah_buku"]?></pre></td>
		                        </tr>
		                        <tr>
		                        <td><pre><strong>lokasi</strong> :<?php echo $data["lokasi"]?></pre>
	                        </td>
	                    </tr>
	                    <?php if($_SESSION["level"]=="Admin"||$_SESSION["level"]!="Pimpinan" && $_SESSION["level"] != "Anggota"){?>
	                     <tr>
	                        <td>
					            <a href="?page=buku&aksi=ubah&id=<?php echo $data["id"];?>" class="aksi">ubah</a>
					            <a onclick="return confirm('Anda yakin ingin menghapus data ini ... ?')" href ="?page=buku&aksi=hapus&id=<?php echo $data["id"];?>" class = "aksi1">hapus</a>
				        	</td>
	                    </tr>
					    <?php
					}
						} ?>
				</table>
		</form>
	</div>