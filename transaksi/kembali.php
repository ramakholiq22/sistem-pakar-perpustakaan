<?php

	include "connect.php";
	$id = $_GET["id"];
	$judul = $_GET["judul"];
	//kembali
	$sql = $connection->query("UPDATE tb_transaksi SET status ='kembali' WHERE id=".$id);
	//jumlah buku
	$sql= $connection->query("UPDATE tb_buku SET jumlah_buku =(jumlah_buku+1) WHERE id=".$id);

	?>

	<script type="text/javascript">
		alert("Proses Pengembalian Berhasil");
		window.location.href="?page=transaksi";
	</script>
?>