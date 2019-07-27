<?php 
	function conexion(){
		$servidor="localhost";
		$usuario="root";
		$password="";
		$bd="silencesound";

		$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
	
		/* verificar la conexión */
	   if (mysqli_connect_errno()) {
	      	printf("Conexión fallida: %s\n", mysqli_connect_error());
	      	exit();
	   }
	   else{
	   		return $conexion;
	   }

	}

?>