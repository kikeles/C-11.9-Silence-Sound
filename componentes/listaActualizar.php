<?php  
	session_start();

	require_once("../PHP/conexion.php");
	$conexion=conexion();

	$id = $_SESSION['id_usuario'];

	$sql="SELECT id_lista, nombre from lista where id_usuario = $id";
	if($result=mysqli_query($conexion,$sql)){
		echo "<select class=\"form-control input-sm\" name=\"listaUpdate\" id=\"listaUpdate\">";
		while($ver=mysqli_fetch_row($result)){
			echo "<option value=\"$ver[0]\">".utf8_decode($ver[1])."</option>";
		}
		echo "</select>";
	}
	else{
		echo "<select class=\"form-control input-sm\" name=\"listaUpdate\" id=\"listaUpdate\">";
		echo "<option value=\"0\">Ninguna</option>";
		echo "</select>";
	}
	
?>