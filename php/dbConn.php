<?php
	require_once "login_detail.php";
	$conn = new mysqli($server, $username, $password, $database);
	if($conn -> connect_error){
		die($conn -> connect_error);
	}
?>