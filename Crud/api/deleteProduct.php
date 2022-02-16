<?php

	session_start();

	$id = $_POST['id'];

	include_once("db.php");
	include_once("api.php");
	
	$Api = new Api();
    $ToReturn = $Api->deleteProduct($id);

    header('location: ../index.php')
	
 ?>