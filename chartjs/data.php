<?php
//setting header to json
header('Content-Type: application/json');

//database

$connection = new mysqli("localhost","root","","db_perpustakaan");

if(!$connection){
	die("connection failed".$connection->error);
}

//excute query
$query = sprintf("SELECT id, tahun_terbit FROM tb_buku ORDER BY id");
//execute query   
$result = $connection->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row){
	$data[] = $row;
}

//free memory associated
$result->close();

//close conenction
$connection->close();

//now print the data
print json_encode($data);