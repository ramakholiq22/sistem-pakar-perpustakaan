<?php

	if(!isset($_SESSION)){
		session_start();
	}

?>
<div id="main-table">
	<div id="table-header">
		<p>Pendaftaran QRcode</p>
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
                <input class="form-control" name="jdbuku">
           
            </div>

            <div class="form-group">
                <label>Sandi</label>
                <input class="form-control" name="sandi">
           
            </div>

            <div class="form-group">
            	<label>
            		Upload Gambar<br />
            		<input name="qrcode" type="file">
            	</label>
            	
            </div>

            <div>
            	<input type="submit" name="simpan" value="Simpan" class="btn-simpan">
            </div>
        </form>
     </div>
</div>

<?php


	if(isset($_POST["jdbuku"])){
		$jdbuku = $_POST["jdbuku"];
		$sandi = $_POST["sandi"];
		$qrcode = $_FILES["qrcode"];
		$simpan = $_POST["simpan"];
	

		$message="";
		
		if($jdbuku == ""){
			$message = "judul harus diisi";
		}elseif ($sandi = "") {
			$message = "sandi harus diisi";	
		}else if(!isset($qrcode["tmp_name"]) || $qrcode["tmp_name"]==""){
			$message = "Gambar harus dipilih";
		}elseif($simpan){
			include "connect.php";
			$filepath = "upload/".basename($qrcode["name"]);
			$uploded = move_uploaded_file($qrcode["tmp_name"], $filepath);


			
			$insert=$connection->query("INSERT INTO tb_buku(jdbuku, qrcode, sandi)VALUES('".$jdbuku."','".$filepath."','".$sandi.")");
			if($insert){
			?>
				<script type="text/javascript">
					alert("Data Berhasil Disimpan");
					window.location.href="?page=dfqrcode";
				</script>

			<?php
			}else{
				?>
				<script type="text/javascript">
					alert("Proses Gagal");
					window.location.href="?page=dfqrcode";
				</script>
				<?php

			}
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		?>

		<script type="text/javascript">
			window.location.href="?page=dfqrcode&aksi=tambahqr";
		</script>

		<?php


	}

?>