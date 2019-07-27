<?php  
	require_once "conexion.php";
	$conexion = conexion();

	/*comprobar caracteres de escape para no infiltrar injeccion sql o caracteres extraños*/
	$nombre = htmlentities(addslashes($_POST['nombre']));
	$apellidos = htmlentities(addslashes($_POST['apellidos']));
	$alias = htmlentities(addslashes($_POST['alias']));
	$email = htmlentities(addslashes($_POST['email']));
	$password = htmlentities(addslashes($_POST['password']));

	$validar = comprobar_email($email);
	if($validar==1){
		/*verificar si existe este correo en la base de datos*/
		$sqlEmail = "select email from usuarios where email = '$email' ";
		$result=mysqli_query($conexion,$sqlEmail);
		$comprobar=mysqli_num_rows($result);

		if($comprobar==0){
			$passwd_cifrado = password_hash($password, PASSWORD_DEFAULT);

			$sql="INSERT into usuarios (alias,email,passwd,nombre,apellidos)
			values ('$alias','$email','$passwd_cifrado','$nombre','$apellidos')";
			if($result=mysqli_query($conexion,$sql))
			{
				echo "<script>alert('Se a guardado con exito :)')</script>";
			}
			else{
				echo "<script>alert('Algo Fallo :(')</script>";	
			}

		}
		else{
			echo '<script>alert("El correo "'.$email.'" ya existe, ingresa uno diferente")</script>';
		}


	}
	else{
		echo "<script>alert(\"El correo NO es valido\")</script>";
	}

	mysqli_close($conexion);

	function comprobar_email($email){ 
      $mail_correcto = 0; 
      //compruebo unas cosas primeras 
      if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
         if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
            //miro si tiene caracter . 
            if (substr_count($email,".")>= 1){ 
               //obtengo la terminacion del dominio 
               $term_dom = substr(strrchr ($email, '.'),1); 
               //compruebo que la terminación del dominio sea correcta 
               if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                  //compruebo que lo de antes del dominio sea correcto 
                  $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                  $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                  if ($caracter_ult != "@" && $caracter_ult != "."){ 
                     $mail_correcto = 1; 
                  } 
               } 
            } 
         } 
      } 
      if ($mail_correcto){
        return 1;  
      } 
      else{
        return 0; 
      } 
    
   }


?>