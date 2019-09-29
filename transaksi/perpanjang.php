<?php
	include "connect.php";
	$id = $_GET["id"];
	$judul = $_GET["judul"];
	$tgl_kembali=$_GET["tgl_kembali"];
	$lambat = $_GET["lambat"];

	if($lambat >3){
		?>

		<script type="text/javascript">
			alert("Pinjam Buku Tidak Dapat Di Perpanjang , Karena Lebih Dari 7 Hari.... Kembalikan Dahulu Kemudian Perpanjang");
			window.location.href="?page=transaksi";
		</script>
		<?php
	}
	else{
		$pecah_tgl_kembali = explode("-", $tgl_kembali);
		$next_3_hari = mktime(0,0,0, $pecah_tgl_kembali[1], $pecah_tgl_kembali[0]+3, $pecah_tgl_kembali[2]);
		$hari_next = date("d-m-Y", $next_3_hari);

		$sql=$connection->query("UPDATE tb_transaksi SET tgl_kembali = '".$hari_next."' WHERE id=".$id);

		if($sql){ 
			?>

				<script type="text/javascript">
					alert("Buku Berhasil Di Perpanjang");
					window.location.href="?page=transaksi";
				</script>

			<?php
		}else{


			?>
			<script type="text/javascript">
					alert("Buku Gagal Diperpanjang");
					window.location.href="?page=transaksi";
				</script>

			<?php
		}
	}

?>