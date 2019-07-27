<?php  
		include('conexionPDO.php');
		
		if(isset($_FILES['audioUpdate']['tmp_name'])){
			$cargar_audio = $_FILES['audioUpdate']['tmp_name'];
			$file_audio = fopen($cargar_audio, 'rb');

			$nombre = $_POST['nombreUpdate'];
			$genero = $_POST['generoUpdate'];
			$artista =$_POST['artistaUpdate'];
			$lista = $_POST['listaUpdate'];
			$id_a = $_POST['id_audioUpdate'];

			$actualizarAudio = $conexion->prepare("UPDATE audio set id_lista = :listaUpdate ,file_audio =:audioUpdate, nombre = :nombreUpdate, genero = :generoUpdate, artista = :artistaUpdate where id_audio = $id_a");

			$actualizarAudio->bindParam(':listaUpdate',$lista,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':audioUpdate',$file_audio,PDO::PARAM_LOB);
			$actualizarAudio->bindParam(':nombreUpdate',$nombre,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':generoUpdate',$genero,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':artistaUpdate',$artista,PDO::PARAM_STR);
			echo $actualizarAudio->execute();

		}
		

		if(isset($_FILES['imagenUpdate']['tmp_name'])){
			$cargar_imagen = $_FILES['imagenUpdate']['tmp_name'];
			$file_imagen = fopen($cargar_imagen, 'rb');

			$nombre = $_POST['nombreUpdate'];
			$genero = $_POST['generoUpdate'];
			$artista =$_POST['artistaUpdate'];
			$lista = $_POST['listaUpdate'];
			$id_a = $_POST['id_audioUpdate'];
			/*$id_a = 19;*/
			$actualizarAudio = $conexion->prepare("UPDATE audio set id_lista=:listaUpdate ,file_imagen =:imagenUpdate, nombre =:nombreUpdate, genero = :generoUpdate, artista = :artistaUpdate where id_audio = $id_a");

			$actualizarAudio->bindParam(':listaUpdate',$lista,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':imagenUpdate',$file_imagen,PDO::PARAM_LOB);
			$actualizarAudio->bindParam(':nombreUpdate',$nombre,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':generoUpdate',$genero,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':artistaUpdate',$artista,PDO::PARAM_STR);
			echo $actualizarAudio->execute();

		}


		if(isset($_FILES['imagenUpdate']['tmp_name']) && isset($_FILES['audioUpdate']['tmp_name'])){
			$cargar_imagen = $_FILES['imagenUpdate']['tmp_name'];
			$file_imagen = fopen($cargar_imagen, 'rb');
			$cargar_audio = $_FILES['audioUpdate']['tmp_name'];
			$file_audio = fopen($cargar_audio, 'rb');

			$nombre = $_POST['nombreUpdate'];
			$genero = $_POST['generoUpdate'];
			$artista =$_POST['artistaUpdate'];
			$lista = $_POST['listaUpdate'];
			$id_a = $_POST['id_audioUpdate'];
			/*$id_a = 19;*/
			$actualizarAudio = $conexion->prepare("UPDATE audio set id_lista=:listaUpdate ,file_audio =:audioUpdate, file_imagen =:imagenUpdate, nombre =:nombreUpdate, genero = :generoUpdate, artista = :artistaUpdate where id_audio = $id_a");

			$actualizarAudio->bindParam(':listaUpdate',$lista,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':audioUpdate',$file_audio,PDO::PARAM_LOB);
			$actualizarAudio->bindParam(':imagenUpdate',$file_imagen,PDO::PARAM_LOB);
			$actualizarAudio->bindParam(':nombreUpdate',$nombre,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':generoUpdate',$genero,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':artistaUpdate',$artista,PDO::PARAM_STR);
			echo $actualizarAudio->execute();

		}


		if(!isset($_FILES['imagenUpdate']['tmp_name']) && !isset($_FILES['audioUpdate']['tmp_name'])){

			$nombre = $_POST['nombreUpdate'];
			$genero = $_POST['generoUpdate'];
			$artista =$_POST['artistaUpdate'];
			$lista = $_POST['listaUpdate'];
			$id_a = $_POST['id_audioUpdate'];
			/*$id_a = 19;*/
			$actualizarAudio = $conexion->prepare("UPDATE audio set id_lista = :listaUpdate,nombre =:nombreUpdate, genero = :generoUpdate, artista = :artistaUpdate where id_audio = $id_a");

			$actualizarAudio->bindParam(':listaUpdate',$lista,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':nombreUpdate',$nombre,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':generoUpdate',$genero,PDO::PARAM_STR);
			$actualizarAudio->bindParam(':artistaUpdate',$artista,PDO::PARAM_STR);
			echo $actualizarAudio->execute();

		}


?>