<?php 
	$connection=new mysqli("localhost","root","","db_todolist");

	if (!$connection) {
		echo "connection failed";
	}
?>