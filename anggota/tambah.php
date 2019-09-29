<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
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
	            <label>NIM</label>
	            <input class="form-control" name="nim">
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
		                <input type="radio" value="Laki-laki" name="jk"><label>Laki-laki</label>  
		                <input type="radio" value="Perempuan" name="jk"><label>Perempuan</label>
	       			</div>
	        </div>

	        <div class="form-group">
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
	    <?php
	    	include "doAdd.php";
	    ?>
	</div>
</div>
