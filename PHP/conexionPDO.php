<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
	    $conexion = new PDO("mysql:host=$servername;dbname=silencesound", $username, $password);
	    // set the PDO error mode to exception
	    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conexion->exec("set names utf8");
	    return $conexion;
    }
catch(PDOException $e)
    {
    	echo "La conección fallo: " . $e->getMessage();
    }
?>