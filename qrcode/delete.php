<?php
	include "connect.php";
	$id = $_GET["id"];

	$connection->query("DELETE FROM tb_qrcode WHERE id=".$id);




?>

<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=dfqrcode";
</script>