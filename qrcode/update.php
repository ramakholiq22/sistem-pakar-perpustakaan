 <?php
 if(!isset($_SESSION)){
        session_start();
    }
 	include "connect.php";
    $id = $_GET["id"];
    $sql= $connection->query("SELECT * FROM tb_qrcode WHERE id =".$id);
    $tampil = $sql->fetch_assoc();
    $judul = $judul["jdbuku"];
     ?>

<div id="main-table">
	<div id="table-header">
		<p>Update QRcode</p>
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
                <label>Judul Buku</label>
                <input class="form-control" name="judul" value="<?php echo $judul["jdbuku"];?>">
           
            </div>

            <div>
            	<input type="submit" name="simpan" value="Simpan" class="btn-simpan">
            </div>
        </form>
	</div>
</div>
<?php
	    if(isset($_POST["judul"])){
		$judul = $_POST["jdbuku"];
		
		$message="";
		
		if($judul == ""){
			$message = "judul harus diisi";	
        }
            $connection->query("UPDATE tb_qrcode SET judul='".$judul."");

			?>
				<script type="text/javascript">
					alert("Data Berhasil Diubah");
					window.location.href="?page=dfqrcode";
				</script>
			<?php
			
		}
		$_SESSION["message"] ="<span style='color:red'> $message</span>";
        header("location:?page=dfqrcode&aksi=udate&id=$id");
        exit();

	}

?>