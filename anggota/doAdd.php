<?php
	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_POST["nama"])){
		$nim = $_POST["nim"];
		$nama = $_POST["nama"];
		$tempat_lahir = $_POST["tempat_lahir"];
		$tanggal_lahir = $_POST["tanggal_lahir"];
		$jk = $_POST["jk"];
		$prodi = $_POST["prodi"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		$level=$_POST["level"];
		$simpan=$_POST["simpan"];


		$message="";
		if($nim == ""){
			$message = "NIM Tidak Boleh Kosong";
		}
		else if($nama == ""){
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
		else if(!is_numeric($nim)){
			$message = "NIM hanya berisi angka";
		}else{
			include "connect.php";
			$lihat = $connection->query("SELECT * FROM tb_anggota WHERE nim LIKE '".$nim."'");
			if($lihat->num_rows==0){
				$connection->query("INSERT INTO tb_anggota(nim,username,password,nama, tempat_lahir, tgl_lahir, jk, prodi,level)VALUES('".$nim."','".$username."','".$password."','".$nama."','".$tempat_lahir."','".$tanggal_lahir."','".$jk."','".$prodi."','".$level."')");
				?>
				<script type="text/javascript">
					alert("Data Berhasil Disimpan");
					window.location.href="?page=anggota";
				</script>
				<?php
					exit();
			}else{
				$message = "NIM sudah ada";
			}
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
		header("location:?page=anggota&aksi=tambah");
		exit();
		
	}
?>