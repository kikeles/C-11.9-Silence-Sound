<?php
   session_start();
   $_SESSION['usuario'] = "";
   $_SESSION['id_user'] = 3;
   require_once "conexion.php";
   $conexion = conexion();


   if(isset($_POST['btnLogin']))
   {
      $correo = htmlentities(addslashes($_POST['txt_email']));
      $pass = htmlentities(addslashes($_POST['txt_password']));
      $validar = comprobar_email($correo);

      if($validar==1){/*entra si esta bien escrito el correo*/

         $sql = "select * from usuarios where email = '$correo' ";
         $result = mysqli_query($conexion, $sql);
         /* obtiene un array con elementos si no tiene se manda como NULL*/
         $fila = mysqli_fetch_row($result);
         
         /*comprobamos si existe el usuario*/
         if(empty($fila)){/*vacio*/
            /*var_dump($fila);*/
            header("Location:../login.php");
         }
         else{
            /*verificar contraseña encriptada*/
            if(password_verify($pass, $fila[3])){
              /* $_SESSION['id_user'] = "$fila[0]";*/
               $_SESSION['usuario'] = $_POST['txt_email'];
               header("Location:../paginaUsuario.php");
            }
            else{
               echo "no se encontro";
            }
            
         }


         /* close connection */
         mysqli_close($conexion);

      }
      else{
         mysqli_close($conexion);
         echo "Correo NO valido";
      }


   }






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