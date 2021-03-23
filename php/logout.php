<?php
	session_start();
	session_unset();
	
	session_destroy();
	
	echo "Your successfully loged out <br>";

	header('Location: ../')
?>