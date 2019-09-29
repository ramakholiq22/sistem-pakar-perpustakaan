 <?php
 if(!isset($_SESSION)){
        session_start();
    }
 	include "connect.php";
    $id = $_GET["id"];
    $sql= $connection->query("SELECT * FROM tb_buku WHERE id =".$id);
    $tampil = $sql->fetch_assoc();
    $tahun2 = $tampil["tahun_terbit"];
    $lokasi = $tampil["lokasi"];
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
		<form method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label>judul</label>
                <input class="form-control" name="judul" value="<?php echo $tampil["judul"];?>">
           
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input class="form-control" name="pengarang" value="<?php echo $tampil["pengarang"];?>">
           
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input class="form-control" name="penerbit" value="<?php echo $tampil["penerbit"];?>">
           
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <select class="form-control" name="tahun" value="<?php echo $tampil["tahun_terbit"];?>">
                   <?php
                   		$tahun = date("Y");
                   		for($i=$tahun-25;$i<=$tahun;$i++){
                            if($i == $tahun2){
                                    echo" <option value='".$i."' selected>".$i."</option>";
                                }else{
                                 echo"<option value='".$i."'>".$i."</option>";
                                }
                   		
                   		}

                   ?> 
                </select>
            </div>

            <div class="form-group">
                <label>ISBN</label>
                <input class="form-control" name="isbn" value="<?php echo $tampil["isbn"] ?>;">
           
            </div>

            <div class="form-group">
                <label>Jumlah Buku</label>
                <input class="form-control" type="number" name="jumlah_buku" value="<?=$tampil["jumlah_buku"] ?>">
           
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <select class="form-control" name="lokasi">
                    <option value="rak1"<?php if($lokasi=="rak1"){echo "selected";} ?>>Rak 1</option>
                    <option value="rak2"<?php if($lokasi=="rak2"){echo "selected";} ?>>Rak 2</option>
                    <option value="rak3"<?php if($lokasi=="rak3"){echo "selected";} ?>>Rak 3</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Input</label>
                <input class="form-control" name="tanggal" type ="date" value="<?php echo $tampil["tgl_input"]; ?>">
           
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
		}else{
            include "connect.php";
			if(isset($Gambar["tmp_name"]) && $Gambar["tmp_name"]!=""){
                $filepath = "upload/".basename($Gambar["name"]);
                move_uploaded_file($Gambar["tmp_name"], $filepath);

                $connection->query("UPDATE tb_buku SET Gambar='".$filepath."' WHERE id=".$id);

            }
            $connection->query("UPDATE tb_buku SET judul='".$judul."', pengarang='".$pengarang."', penerbit='".$penerbit."',tahun_terbit='".$tahun."',isbn='".$isbn."',jumlah_buku='".$jumlah_buku."',lokasi='".$lokasi."',tgl_input='".$tanggal."' WHERE id=".$id);

			?>
				<script type="text/javascript">
					alert("Data Berhasil Diubah");
					window.location.href="?page=buku";
				</script>
			<?php
			
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
        header("location:?page=buku&aksi=ubah&id=$id");
        exit();

	}

?>