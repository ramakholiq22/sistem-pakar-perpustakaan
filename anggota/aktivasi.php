<?php

if(!isset($_SESSION)){
	session_start();
}

include "connect.php";
$getNIM = $_GET["nim"];
$connection->query("UPDATE tb_anggota SET persetujuan='sudah' WHERE nim=".$getNIM);

?>
	<script type="text/javascript">
		alert("Data Berhasil Diaktivasi");
		window.location.href="?page=anggota";
	</script>
<?php


?>