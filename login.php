<?php
	
	ob_start();
  	session_start();
  	if(!isset($_SESSION["level"])){

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<style>



</style>
<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<div id="container">
  <form method="POST">
  	<label>Username</label>
    <input type="text" name="username">
    <label>Password</label>
    <input type="password" name="password">
  
    <input type="submit" value="Login" name="login">
  </form>

  	<div id="mainBtn">
  		Belum Punya Akun? <span id="modalBtn" class="button">Registrasi</span>
	</div>

	<div id="simpleModal" class="modal">
		<div class = "modal-content">
			<span class="closeBtn">&times;</span>
			<!--   Registrasi Form -->
			<div class="header-modal">
				<span>Registrasi</span>
			</div>
			<form method="POST" action="addregister.php">
				<div class="form-group">
		            <label>NIM</label>
		            <input class="form-control" name="nim">
		            <label>Username</label>
		            <input class="form-control" name="username">
		        </div>

		        <div class="form-group">
		            <label>Username</label>
		            <input class="form-control" name="username">
	       		 </div>

		        <div class="form-group">
		            <label>Password</label>
		            <input class="form-control" name="password">
		        </div>
		        <div class="form-group">
	            <label>Nama</label>
	            <input class="form-control" name="nama">

	        </div>
	        <div class="form-group">
	            <label>Tempat Lahir</label>
	            <input class="form-control" name="tempat_lahir">
	       
	        </div>

	        <div class="form-group">
	            <label>Tanggal Lahir</label>
	            <input class="form-control" type="date" name="tanggal_lahir">
	       
	        </div>
	        <div class="checkbox"><br />
	            <label style="font-weight:bold;font-size:15px;color:#333333;">Jenis Kelamin</label><br />
	            	<div class="checkbox1">
		                <input type="radio" value="Laki-laki" name="jk"><label>Laki-laki&nbsp;&nbsp;&nbsp;&nbsp;</label>
		                <input type="radio" value="Perempuan" name="jk"><label>Perempuan</label>
	       			</div>
	        </div>

	        <div class="form-group" style="margin-top:-55px;">
	            <label>Tahun Terbit</label>
	            <select class="form-control" style="margin-left:-1px;" name="prodi">
	               <option value="Teknik Informatika">Teknik Informatika</option>
	               <option value="Sistem Informasi">Sistem Informasi</option>
	            </select>
	        </div>

	        <div class="form-group">
	            <label>Hak Akses</label>
	            <select class="form-control" style="margin-left:-1px;" name="level">
	               <option value="Admin">Admin</option>
	               <option value="Pimpinan">Pimpinan</option>
	               <option value="Operator">Operator</option>
	               <option value="Anggota">Anggota</option>
	            </select>
	        </div>

	        <div class="simpan">
	        	<input type="submit" name="simpan" value="Simpan" class="btn-simpan">
	        </div>
	        	
			</form>		
	</div>


<script src="main.js">

</script>
</div>
</body>
</html>

<?php

	if(isset($_POST["login"])){
    $username = $_POST["username"];
    $pass = $_POST["password"];
    include "connect.php";

    $query = $connection->query("SELECT * FROM tb_anggota WHERE username='".$username."' and password = '".$pass."'");
    $data = $query->fetch_assoc();
    $hasil = $query->num_rows;
    $setuju = $data["persetujuan"];

    if($hasil > 0){
      if($setuju=="belum"){
      	?>
      		<script type="text/javascript">
      			alert("akun anda belum disetujui oleh Admin");
      		</script>
      	<?php
      }
      else{
      	 if($data["level"] == "Admin"){
	        $_SESSION["Admin"] = $data["nim"];
	        $_SESSION["level"] = $data["level"];
	        $_SESSION["nama"] = $data["nama"];
	      }elseif($data["level"] == "Pimpinan"){
	        $_SESSION["Pimpinan"] = $data["nim"];
	        $_SESSION["level"] = $data["level"];
	        $_SESSION["nama"] = $data["nama"];
	      }elseif($data["level"] == "Operator"){
	        $_SESSION["Operator"] = $data["nim"];
	        $_SESSION["level"] = $data["level"];
	        $_SESSION["nama"] = $data["nama"];
	      }elseif($data["level"] == "Anggota"){
	        $_SESSION["Anggota"] = $data["nim"];
	        $_SESSION["level"] = $data["level"];
	        $_SESSION["nama"] = $data["nama"];
	      }
      		header("location:index.php");
      }
     
    }else{
      ?>

        <script type="text/javascript">
          alert("Login Gagal, silahkan ulangi lagi");

        </script>

      <?php
    }

  }
}else{
	header("location:index.php");
}
	
?>