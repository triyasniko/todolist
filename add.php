<?php 
	include 'connection.php';

	if (isset($_POST["save"])) {
		$name=$_POST["task"];
		$sql=$connection->query("INSERT INTO tb_task (name) VALUES('$name')");

		if ($sql) {
			header('location:index.php');
		}
	}
?>