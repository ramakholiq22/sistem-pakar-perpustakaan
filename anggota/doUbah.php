<?php
if(!isset($_SESSION)){
		session_start();
	}


	if(isset($_POST["nama"])){

		$nama = $_POST["nama"];
		$tempat_lahir = $_POST["tempat_lahir"];
		$tanggal_lahir = $_POST["tanggal_lahir"];
		$jk = $_POST["jk"];
		$prodi = $_POST["prodi"];

		$message="";
		if($nama == ""){
			$message = "Nama Tidak Boleh Kosong";
		}
		else if($tempat_lahir == ""){
			$message = "Tempat Lahir Tidak Boleh Kosong";
		}
		else if($tanggal_lahir == ""){
			$message = "Tanggal Lahir Tidak Boleh Kosong";
		}
		else if($jk == ""){
			$message = "Jenis Kelamin Tidak Boleh Kosong";
		}
		else if($prodi == ""){
			$message = "Prodi Tidak Boleh Kosong";
		}
		else{
			include "connect.php";
		
				$connection->query("UPDATE tb_anggota SET nama='".$nama."', tempat_lahir='".$tempat_lahir."', tgl_lahir='".$tanggal_lahir."',jk='".$jk."',prodi='".$prodi."' WHERE nim=".$nim);
				?>
				<script type="text/javascript">
					alert("Data Berhasil Diubah");
					window.location.href="?page=anggota";
				</script>
				<?php
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		header("location:?page=anggota&aksi=ubah");
		exit();
	}else{
		?>
		<script type="text/javascript">
			alert("eror");
			window.location.href="?page=anggota&aksi=ubah";
		</script>
		<?php
	}
	?>