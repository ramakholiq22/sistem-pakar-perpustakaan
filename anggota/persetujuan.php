<?php
	if(isset($_POST["search"])){
	include "connect.php";
	$valueToSearch = $_POST['ValueToSearch'];
	$query = "SELECT * from  tb_anggota where nama like '%$valueToSearch%'";
	$hasil = $connection->query($query) or die($connection->error);
}

else{

	include "connect.php";
	$query = "SELECT * FROM tb_anggota WHERE persetujuan ='belum'";
	$hasil = $connection->query($query) or die($connection->error);
	
}
?>
<div id="top-info">
	<a href="?page=anggota" class="persetujuan">Data Anggota</a>
</div>
<div id="main-table">
	<div id="table-header">
		<p>Persetujuan Anggota</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
			<a href ="?page=anggota&aksi=tambah" class="aksi1" style="margin-left:8px;margin-top:5px;"><i class="fa fa-plus" style="font-size:15px"></i> Tambah Data</a>
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=anggota" method="post">
			<input type="text" name="ValueToSearch" placeholder="Input Judul...">
			<input type="submit" name="search" value="search">
		</div>
    </div>
		
				<table id="table">
					<tr>
					    <th>No</th>
					    <th>NIM</th>
					    <th>Nama</th>
					    <th>Tempat Lahir</th>
					    <th>Tanggal Lahir</th>
					    <th>Jenis Kelamin</th>
					    <th>Program Studi</th>
					    <th>Hak Akses</th>
					    <th>Persetujuan</th>
					    <th>Aksi</th>	
					</tr>
						<?php
					        $no=1;
					        while($data=$hasil->fetch_assoc()){
					    	//$jk = ($data["jk"]==l)?"laki-laki":"wanita";
					    ?>     
				    <tr>
				        <td><?=$no++?></td>
				        <td><?=$data["nim"]?></td>
				        <td><?=$data["nama"]?></td>
				        <td><?=$data["tempat_lahir"]?></td>
				        <td><?=$data["tgl_lahir"]?></td>
				        <td><?=$data["jk"]?></td>
				        <td><?=$data["prodi"]?></td>
				        <td><?php echo $data["level"];?></td>
				        <td>
				        	<a onclick="return confirm('Setujui Data Ini ... ?')" href="?page=anggota&aksi=aktivasi&nim=<?php echo $data["nim"]?>" class="aktivasi">Aktivasi</a>
				        </td>
				        <td>
				            <a href="?page=anggota&aksi=ubah&nim=<?php echo $data["nim"]?>" class="aksi">ubah</a>
				            <a onclick="return confirm('Anda yakin ingin menghapus data ini ... ?')" href ="?page=anggota&aksi=hapus&nim=<?php echo $data["nim"];?>" class = "aksi1">hapus</a>
				        </td>
				    </tr>
					    <?php
						} ?>
				</table>
		</form>
	</div>
</div>