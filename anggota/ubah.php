<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include "connect.php";

	$NIM = $_GET["nim"];
    $sql= $connection->query("SELECT * FROM tb_anggota WHERE nim =".$NIM);
    $tampil = $sql->fetch_assoc();
    $jkl = $tampil["jk"];
    $prodil=$tampil["prodi"];
    $akses=$tampil["level"];
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
			<input type="hidden" name="id" value ="<?=$getdata["nim"]?>">
	        <div class="form-group">
	            <label>NIM</label>
	            <input class="form-control" name="nim" value="<?=$tampil["nim"]?>" readonly>
	        </div>

	         <div class="form-group">
	            <label>Username</label>
	            <input class="form-control" name="username" value="<?php echo $tampil["username"]?>">
	        </div>

	        <div class="form-group">
	            <label>Password</label>
	            <input class="form-control" name="password" value="<?php echo $tampil["password"];?>">
	        </div>

	        <div class="form-group">
	            <label>Nama</label>
	            <input class="form-control" name="nama" value="<?=$tampil["nama"]?>">

	        </div>

	        <div class="form-group">
	            <label>Tempat Lahir</label>
	            <input class="form-control" name="tempat_lahir" value="<?=$tampil["tempat_lahir"]?>">
	       
	        </div>

	        <div class="form-group">
	            <label>Tanggal Lahir</label>
	            <input class="form-control" type="date" name="tanggal_lahir" value="<?=$tampil["tgl_lahir"]?>">
	       
	        </div>
	        <div class="checkbox"><br />
	            <label style="font-weight:bold;font-size:15px;color:#333333;">Jenis Kelamin</label><br />
	            	<div class="checkbox1">
		                <input type="radio" value="Laki-laki" name="jk"<?php echo($jkl=="Laki-laki")?"checked":"";?>><label>Laki-laki</label>  
		                <input type="radio" value="Perempuan" name="jk"<?php echo($jkl=="Perempuan")?"checked":"";?>><label>Perempuan</label>
	       			</div>
	        </div>

	        <div class="form-group">
	            <label>Tahun Terbit</label>
	            <select class="form-control" style="margin-left:-1px;" name="prodi">
	               <option value="Teknik Informatika"<?php if($prodil=='Teknik Informatika'){echo "selected";}?>>Teknik Informatika</option>
	               <option value="Sistem Informasi"<?php if($prodil=='Sistem Informasi'){echo "selected";}?>>Sistem Informasi</option>
	            </select>
	        </div>
	        <div class="simpan">

	        <div class="form-group">
	            <label>Hak Akses</label>
	            <select class="form-control" style="margin-left:-1px;" name="level">
	               <option value="Admin" <?php if($akses=='Admin'){echo "selected";}?>>Admin</option>
	               <option value="Pimpinan" <?php if($akses=='Pimpinan'){echo "selected";}?>>Pimpinan</option>
	               <option value="Operator" <?php if($akses=='Operator'){echo "selected";}?>>Operator</option>
	               <option value="Anggota" <?php if($akses=='Anggota'){echo "selected";}?>>Anggota</option>
	            </select>
	        </div>	
	        	
	        	<input type="submit" name="ubah" value="Simpan" class="btn-simpan">
	        </div>
	    </form>
	</div>
</div>
<?php
	if(isset($_POST["nama"])){
		$nim = $_POST["nim"];
		$nama = $_POST["nama"];
	    $tempat_lahir = $_POST["tempat_lahir"];
	    $tanggal_lahir = $_POST["tanggal_lahir"];
	    $jk = $_POST["jk"];
	    $prodi = $_POST["prodi"];
	    $ubah =$_POST["ubah"];
	    $username=$_POST["username"];
		$password=$_POST["password"];
		$level=$_POST["level"];

	    $message="";
		if($nama == ""){
			$message = "Nama Tidak Boleh Kosong";
		}
		elseif($tempat_lahir == ""){
			$message = "Tempat Lahir Tidak Boleh Kosong";
		}
		elseif($tanggal_lahir == ""){
			$message = "Tanggal Lahir Tidak Boleh Kosong";
		}
		elseif($jk == ""){
			$message = "Jenis Kelamin Tidak Boleh Kosong";
		}
		elseif($prodi == ""){
			$message = "Prodi Tidak Boleh Kosong";
		}else{
			include "connect.php";
			$query=$connection->query("UPDATE tb_anggota SET nama='".$nama."',username='".$username."',password='".$password."', tempat_lahir='".$tempat_lahir."', tgl_lahir='".$tanggal_lahir."',jk='".$jk."',prodi='".$prodi."',level='".$level."'WHERE nim=".$nim);
			?>
				<script type="text/javascript">
					alert("Data Berhasil Diubah");
					window.location.href="?page=anggota";
				</script>
			<?php
			exit();
		}

		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		header("location:?page=anggota&aksi=ubah&nim=$NIM");
		exit();
	}
?>




<?php
/*

	if(isset($_POST["nama"])){
		$nim = $_POST["nim"];
		$nama = $_POST["nama"];
	    $tempat_lahir = $_POST["tempat_lahir"];
	    $tanggal_lahir = $_POST["tanggal_lahir"];
	    $jk = $_POST["jk"];
	    $prodi = $_POST["prodi"];
	    $ubah =$_POST["ubah"];

	    $message="";
		if($nama == ""){
			$message = "Nama Tidak Boleh Kosong";
		}
		elseif($tempat_lahir == ""){
			$message = "Tempat Lahir Tidak Boleh Kosong";
		}
		elseif($tanggal_lahir == ""){
			$message = "Tanggal Lahir Tidak Boleh Kosong";
		}
		elseif($jk == ""){
			$message = "Jenis Kelamin Tidak Boleh Kosong";
		}
		elseif($prodi == ""){
			$message = "Prodi Tidak Boleh Kosong";
		}elseif($ubah){
			include "connect.php";
				$query=$connection->query("UPDATE tb_anggota SET nama='".$nama."', tempat_lahir='".$tempat_lahir."', tgl_lahir='".$tanggal_lahir."',jk='".$jk."',prodi='".$prodi."'WHERE nim=".$nim);
				if($query){
					?>
					<script type="text/javascript">
						alert("Data Berhasil Diubah");
						window.location.href="?page=anggota";
					</script>
				<?php

				}else{
					?>
					<script type="text/javascript">
						alert("error");
					</script>
					<?php
				}
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		header("location:?page=anggota&aksi=ubah&nim=$NIM");
		exit();
			
	}*/

?>
		

