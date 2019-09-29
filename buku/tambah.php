[j<?php

	if(!isset($_SESSION)){
		session_start();
	}

?>
<div id="main-table">
	<div id="table-header">
		<p>ini halaman buku</p>
	</div>
	<div class="main-form">
		<?php
		if(isset($_SESSION["message"])){
	    		echo $_SESSION["message"];
	    		unset($_SESSION["message"]);
	    	}
	    	?>
		<form method="post" enctype="multipart/form-data"	>
            <div class="form-group">
                <label>judul</label>
                <input class="form-control" name="judul">
           
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input class="form-control" name="pengarang">
           
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input class="form-control" name="penerbit">
           
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <select class="form-control" name="tahun">
                   <?php
                   		$tahun = date("Y");
                   		for($i=$tahun-25;$i<=$tahun;$i++){
                   			echo "<option value='".$i."'>".$i."</option>";
                   		}

                   ?> 
                </select>
            </div>

            <div class="form-group">
                <label>ISBN</label>
                <input class="form-control" name="isbn">
           
            </div>

            <div class="form-group">
                <label>Jumlah Buku</label>
                <input class="form-control" type="number" name="jumlah_buku">
           
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <select class="form-control" name="lokasi">
                    <option value="rak1">Rak 1</option>
                    <option value="rak2">Rak 2</option>
                    <option value="rak3">Rak 3</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Input</label>
                <input class="form-control" name="tanggal" type ="date">
           
            </div>

            <div class="form-group">
            	<label>
            		Upload Gambar<br />
            		<input name="image" type="file">
            	</label>
            	
            </div>

            <div>
            	<input type="submit" name="simpan" value="Simpan" class="btn-simpan">
            </div>
        </form>
     </div>
</div>

<?php


	if(isset($_POST["judul"])){
		$judul = $_POST["judul"];
		$pengarang = $_POST["pengarang"];
		$penerbit = $_POST["penerbit"];
		$tahun = $_POST["tahun"];
		$isbn = $_POST["isbn"];
		$jumlah_buku = $_POST["jumlah_buku"];
		$lokasi = $_POST["lokasi"];
		$tanggal = $_POST["tanggal"];
		$Gambar = $_FILES["image"];
		$simpan = $_POST["simpan"];
	

		$message="";
		
		if($judul == ""){
			$message = "judul harus diisi";
		}else if($pengarang == ""){
			$message = "pengarang harus diisi";
		}else if($penerbit == ""){
			$message = "penerbit harus diisi";	
		}else if($tahun == ""){
			$message = "tahun harus diisi";	
		}else if($isbn == ""){
			$message = "isbn harus diisi";	
		}else if($jumlah_buku == ""){
			$message = "jumlah buku harus diisi";	
		}else if($lokasi == ""){
			$message = "lokasi harus diisi";	
		}else if($tanggal == ""){
			$message = "tanggal harus diisi";	
		}else if(!isset($Gambar["tmp_name"]) || $Gambar["tmp_name"]==""){
			$message = "Gambar harus dipilih";
		}elseif($simpan){
			include "connect.php";
			$filepath = "upload/".basename($Gambar["name"]);
			$uploded = move_uploaded_file($Gambar["tmp_name"], $filepath);

			
			$insert=$connection->query("INSERT INTO tb_buku(judul,Gambar, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, lokasi, tgl_input)VALUES('".$judul."','".$filepath."','".$pengarang."','".$penerbit."','".$tahun."','".$isbn."','".$jumlah_buku."','".$lokasi."','".$tanggal."')");
			if($insert){
			?>
				<script type="text/javascript">
					alert("Data Berhasil Disimpan");
					window.location.href="?page=buku";
				</script>

			<?php
			}else{
				?>
				<script type="text/javascript">
					alert("Proses Gagal");
					window.location.href="?page=buku";
				</script>
				<?php

			}
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		?>

		<script type="text/javascript">
			window.location.href="?page=buku&aksi=tambah";
		</script>

		<?php


	}

?>