<?php 
	include 'connection.php';
	$id=$_GET["id"];

	$sql_dlt=$connection->query("DELETE FROM tb_task WHERE id='$id' ");
	if ($sql_dlt) {
		header('location:index.php');
	}
?>