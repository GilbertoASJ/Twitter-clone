<?php

	require_once "../vendor/autoload.php";

	$route = new \App\Route();
	
	echo "Hello World";
 
	echo "<pre>";  
		print_r($route->getUrl());
	echo "</pre>";
?>

