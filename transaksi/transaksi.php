<?php

	include "connect.php";
    include "function1.php";

    if(!isset($_SESSION["Anggota"])){

?>
<div id="main-table">
	<div id="table-header">
		<p>Data Transaksi</p>
	</div>
	<div style="position:relative;">
		<div class="bottom-info">
            <?php if($_SESSION["level"] == "Admin" || $_SESSION["level"] != "Pimpinan"){ ?>
			<a href ="?page=transaksi&aksi=tambah" class="aksi1" style="margin-left:8px;margin-top:5px;"><i class="fa fa-plus" style="font-size:15px"></i> Tambah Data</a> <?php } ?>
	        <a href ="#" target="blank" class="export" style="margin-left:8px;margin-bottom:5px;color:green;"><i class="fa fa-print"></i> Export to Excel</a>
	    </div>
	    <div class="farm-group">
	    	<form class="search1" action="?page=anggota" method="post">
			<input type="text" name="ValueToSearch" placeholder="Input Judul...">
			<input type="submit" name="search" value="search">
		</div>
    </div>
	<table id="table">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Terlambat</th>
                <th>Status</th>
                <?php if($_SESSION["level"]=="Admin" || $_SESSION["level"] !="Pimpinan" ){?>
                <th>Aksi</th>
                <?php } ?>
            </tr>
        	<?php

                $no=1;
                $sql = $connection->query("SELECT * FROM tb_transaksi WHERE status ='pinjam'");

                while($data=$sql->fetch_assoc()){
                	//$jk = ($data["jk"]==l)?"laki-laki":"wanita";
            ?>
               
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data["judul"]?></td>
                    <td><?=$data["nim"]?></td>
                    <td><?=$data["nama"]?></td>
                    <td><?=$data["tgl_pinjam"]?></td>
                    <td><?=$data["tgl_kembali"]?></td>
                    <td>
                        <?php 
                        
                        
                        $denda = 500;

                        $tgl_dateline2 = $data["tgl_kembali"];
                        $tgl_kembali = date("Y-m-d");


                        $lambat = terlambat($tgl_dateline2, $tgl_kembali);
                        $denda1 =  $lambat*$denda;
                            
                        if($lambat>0){
                            echo "<font color='red'>$lambat hari <br> (Rp $denda1)</font>";
                        }else{
                            echo "-";
                        }                     
                        ?>
                        
                    </td>
                    <td><?=$data["status"]?></td>
                    <?php if($_SESSION["level"]=="Admin" || $_SESSION["level"] !="Pimpinan" ){?>
                    <td>
                        <a href="?page=transaksi&aksi=kembali&id=<?php echo $data["id"];?>&judul=<?php echo $data["judul"]; ?>" class="aksi">Kembali</a>
                        <a href = "?page=transaksi&aksi=perpanjang&id=<?php echo $data["id"]; ?>&judul=<?php echo $data["judul"]; ?>&lambat=<?php echo $lambat ?>&tgl_kembali=<?php echo $data["tgl_kembali"]?>" class = "aksi1">Perpanjang</a>
                    </td>
                    <?php } ?>
                </tr>
            <?php   

                }

            ?>
    </table>
</div>

<?php

}else{
    header("location:index.php");
}

?>