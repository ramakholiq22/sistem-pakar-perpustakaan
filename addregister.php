<?php

	if(isset($_POST["simpan"])){
		$nim = $_POST["nim"];
		$nama = $_POST["nama"];
		$tempat_lahir = $_POST["tempat_lahir"];
		$tanggal_lahir = $_POST["tanggal_lahir"];
		$jenis_kelamin = $_POST["jk"];
		$prodi = $_POST["prodi"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		$level=$_POST["level"];


		$message="";
		if($nim == ""){
			?>
			<script type="text/javascript">
				alert("Nim Tidak Boleh kosong");
				window.location.href="login.php";
			</script>
		<?php
		}
		else if($nama == ""){
			?>
			<script type="text/javascript">
				alert("nama Tidak Boleh kosong");
			</script>
		<?php
		}
		else if($tempat_lahir == ""){
			?>
			<script type="text/javascript">
				alert("tempat lahir Tidak Boleh kosong");
			</script>
		<?php
		}
		else if($tanggal_lahir == ""){
			?>
			<script type="text/javascript">
				alert("tanggal lahir Tidak Boleh kosong");
			</script>
		<?php
		}
		else if($jenis_kelamin == ""){
			?>
			<script type="text/javascript">
				alert("jenis kelamin Tidak Boleh kosong");
			</script>
		<?php
		}
		else if($prodi == ""){
			?>
			<script type="text/javascript">
				alert("prodi Tidak Boleh kosong");
			</script>
		<?php
		}
		else if(!is_numeric($nim)){
			?>
			<script type="text/javascript">
				alert("Nim hanya berisi angka");
			</script>
		<?php
		}else{
			include "connect.php";
			$lihat = $connection->query("SELECT * FROM tb_anggota WHERE nim LIKE '".$nim."'");
			if($lihat->num_rows==0){
				$connection->query("INSERT INTO tb_anggota(nim,username,password,nama, tempat_lahir, tgl_lahir, jk, prodi,level,persetujuan)VALUES('".$nim."','".$username."','".$password."','".$nama."','".$tempat_lahir."','".$tanggal_lahir."','".$jenis_kelamin."','".$prodi."','".$level."','belum')");
				?>
				<script type="text/javascript">
					alert("Data Berhasil Disimpan, tunggu persetujuan Admin");
					window.location.href="login.php";
				</script>
				<?php
					exit();
			}else{
				$message = "NIM sudah ada";
			}
		}
		
	}

?>