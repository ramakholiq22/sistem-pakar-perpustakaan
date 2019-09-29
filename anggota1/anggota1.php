<?php
	include "connect.php";
    include "function1.php";

    $getnim=$_SESSION["Anggota"];

?>

<?php
	if(isset($_POST["search"])){
	include "connect.php";
	$valueToSearch = $_POST['ValueToSearch'];
	$query = "SELECT tb_transaksi.judul,tb_buku.pengarang,tb_buku.penerbit,tb_buku.isbn,tb_transaksi.tgl_pinjam,tb_transaksi.tgl_kembali,tb_transaksi.status from tb_buku iNNER JOIN tb_transaksi ON tb_buku.isbn = tb_transaksi.isbn INNER JOIN tb_anggota ON tb_anggota.nim = tb_transaksi.nim WHERE tb_anggota.nim='".$getnim."' && tb_transaksi.judul LIKE '%$valueToSearch%'";
	$hasil = $connection->query($query) or die($connection->error);
}

else{

	include "connect.php";
	$query = "SELECT tb_buku.judul,tb_buku.pengarang,tb_buku.penerbit,tb_buku.isbn,tb_transaksi.tgl_pinjam,tb_transaksi.tgl_kembali,tb_transaksi.status from tb_buku iNNER JOIN tb_transaksi ON tb_buku.isbn = tb_transaksi.isbn INNER JOIN tb_anggota ON tb_anggota.nim = tb_transaksi.nim WHERE tb_anggota.nim='".$getnim."'";
	$hasil = $connection->query($query) or die($connection->error);
	
}
?>
<div id="main-table">
	<div id="table-header">
		<p>Data Peminjaman</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=anggota1" method="post">
			<input type="text" name="ValueToSearch" placeholder="Input Judul...">
			<input type="submit" name="search" value="search">
		</div>
    </div>
		
				<table id="table">
					<tr>
						<th>No</th>
					    <th>Judul</th>
					    <th>Pengarang</th>
					    <th>Penerbit</th>
					    <th>ISBN</th>
					    <th>Tanggal Pinjam</th>
					    <th>Tanggal Kembali</th>
					    <th>Terlambat</th>
					    <th>Status</th>	
					</tr>
						<?php
					        $no=1;
					        while($data=$hasil->fetch_assoc()){
					    	//$jk = ($data["jk"]==l)?"laki-laki":"wanita";
					    ?>     
				    <tr>
				        <td><?=$no++?></td>
				        <td><?=$data["judul"]?></td>
				        <td><?=$data["pengarang"]?></td>
				        <td><?=$data["penerbit"]?></td>
				        <td><?=$data["isbn"]?></td>
				        <td><?=$data["tgl_pinjam"]?></td>
				        <td><?=$data["tgl_kembali"]?></td>
				        <td>
                        <?php 
                        
                        
                        $denda = 500;

                        $tgl_dateline2 = $data["tgl_kembali"];
                        $tgl_kembali = date("Y-m-d");


                        $lambat = terlambat($tgl_dateline2, $tgl_kembali);
                        $denda1 =  $lambat*$denda;
                            
                        if($lambat>0){
                            echo "<font color='red'>$lambat hari <br> (Rp $denda1)</font>";
                        }else{
                            echo "-";
                        }                     
                        ?>
                        
                    </td>
				        <td><?=$data["status"]?></td>
				    </tr>
					    <?php
						} ?>
				</table>
		</form>
</div>