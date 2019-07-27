<?php 
	session_start();
	$id_usuario = $_SESSION['id_usuario']; 
	require_once("conexion.php");
	$conexion=conexion();

	$nuevaLista = $_POST['nuevaLista'];

	$sql = "INSERT into lista (nombre,id_usuario) values('$nuevaLista',$id_usuario)";
	echo $result=mysqli_query($conexion,$sql);

?>