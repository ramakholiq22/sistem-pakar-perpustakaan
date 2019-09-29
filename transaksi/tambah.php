<?php
	if(!isset($_SESSION)){
		session_start();
	}
	$tgl_pinjam = date("d-m-Y");
	$tujuh_hari = mktime(0,0,0, date("n"), date("j")+3, date("Y"));
	$kembali = date("d-m-Y", $tujuh_hari);
	include "connect.php";
?>


<div id="main-table">
	<div id="table-header">
		<p>Tambah Anggota</p>
	</div>
	<div class="main-form">
		<?php
		if(isset($_SESSION["message"])){
	    		echo $_SESSION["message"];
	    		unset($_SESSION["message"]);
	    	}
	    	?>
		<form method="post">
            <div class="form-group">
                <label>Buku</label>
                <select class="form-control" name="buku">
                	<?php

                		$sql = $connection->query("SELECT * FROM tb_buku order by id");
                		while($data=$sql->fetch_assoc()){
                			echo "<option value='$data[id].$data[judul]'>$data[judul]</option>";
                		}
                	?>
                </select>
           
            </div>

            <div class="form-group">
                <label>Anggota</label>
                <select class="form-control" name="nim">
                	<?php

                		$sql = $connection->query("SELECT * FROM tb_anggota order by nim");
                		while($data=$sql->fetch_assoc()){
                			echo "<option value='$data[nim].$data[nama]'>$data[nim] $data[nama]</option>";
                		}
                	?>
                </select>
           
            </div>

            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input class="form-control" name="tgl_pinjam" type="text" id="tgl" value="<?php echo $tgl_pinjam; ?>" readonly />
           
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input class="form-control" name="tgl_kembali" type="text" id="tgl" value="<?php echo $kembali;?>" readonly />
           
            </div>

           
            <div>
            	<input type="submit" name="simpan" value="Simpan" class="btn-simpan">
            </div>
        
     </div>
 </form>
	</div>
</div>

<?php

	if(isset($_POST["simpan"])){
		$tgl_pinjam  = $_POST["tgl_pinjam"];
		$tgl_kembali  = $_POST["tgl_kembali"];

		$buku  = $_POST["buku"];
		$pecah_buku=explode(".", $buku);
		$id = $pecah_buku[0];
		$judul = $pecah_buku[1];

		$nim1 = $_POST["nim"];
		$pecah_nama = explode(".", $nim1);
		$nim = $pecah_nama[0];
		$nama = $pecah_nama[1];

		

		include "connect.php";
		$sql = $connection->query("SELECT * FROM tb_buku WHERE judul='$judul'");
		while($data=$sql->fetch_assoc()){
			$sisa=$data["jumlah_buku"];
			$idBuku = $data["id"];
			$isbn=$data["isbn"];

			if($sisa==0){
				?>

				<script type="text/javascript">
					alert("Stok Buku Habis, Transaksi Tidak Dapat Dilakukan, Silahkan Tambah Stok Buku Terlebih Dahulu");
					window.location.href="?page=transaksi&aksi=tambah";
				</script>

				<?php
				exit();

			}else{
				$stokBuku = $data["jumlah_buku"];
				$hasil = $stokBuku-1;


				$connection->query("UPDATE tb_buku SET jumlah_buku ='".$hasil."' WHERE id =".$idBuku);
				/*$lihat=$connection->query("SELECT * FROM tb_transaksi WHERE nim=".$nim);
				while($data1=)*/
					?>
				<?php
				$transaksi=$connection->query("INSERT INTO tb_transaksi(isbn,judul,nim,nama,tgl_pinjam,tgl_kembali,status)VALUES('".$isbn."','".$judul."','".$nim."','".$nama."','".$tgl_pinjam."','".$tgl_kembali."','pinjam')");
				if($transaksi){
					?>
						<script type="text/javascript">
							alert("transaksi Berhasil");
							window.location.href="?page=transaksi";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							alert("transaksi Gagal");
							window.location.href="?page=transaksi";
						</script>
					<?php
				}

				
				exit();

			}
		}

	}

?>
