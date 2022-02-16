<?php

	session_start();

	$id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $activo = $_POST['activo'];

	include_once("db.php");
	include_once("api.php");

	$Api = new Api();
    $ToReturn = $Api->storeCategoria($id, $codigo, $nombre, $descripcion, $activo );


    header('location: ../categoria.php')
	
 ?>