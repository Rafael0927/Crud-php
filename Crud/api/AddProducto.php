<?php

	session_start();

	$id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

	include_once("db.php");
	include_once("api.php");

	$Api = new Api();
    $ToReturn = $Api->storeProduct($id, $codigo, $nombre, $categoria,  $descripcion, $marca, $precio);


    header('location: ../index.php')
	
 ?>