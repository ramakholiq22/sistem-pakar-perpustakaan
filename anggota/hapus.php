<?php
	include "connect.php";
	$NIM = $_GET["nim"];

	$hapus=$connection->query("DELETE FROM tb_anggota WHERE nim=".$NIM);
?>

<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=anggota";
</script>