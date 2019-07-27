<?php 
	session_start();

	if($_SESSION['usuario']=="")
	{
		header("Location:login.php");
	}


	include('PHP/conexionPDO.php');
	/*obtenemos la informacion o datos requeridos medinte $result->fetchColumn();*/
	$result = $conexion->query("SELECT * from usuarios where email = '".$_SESSION['usuario']."' ");
	$datosUser=$result->fetch(PDO::FETCH_ASSOC);
	$_SESSION['id_usuario'] = $datosUser['id_usuario'];
	$filas = $conexion->query("SELECT * from audio");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Silenece Sound</title>
	<!--uso de jQuery-->
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!--<link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css">-->
	<!--generar alertas visuales en la edicion y eliminacion-->
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  	<link rel="stylesheet" type="text/css" href="librerias/select2/css/select2.css">
	<link rel="stylesheet" type="text/css" href="CSS/estilosPagina.css">
	
	<!--uso de funciones y paqueteria jQuery-->
	<script src="JS/funciones.js"></script>
	<script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
  	<script src="librerias/select2/js/select2.js"></script>
	

</head>
<body>
	<header>
		<div id="cajaBanner">
			<img src="img/Logo.png" style="width: 250px; height: 60px;">
		</div>
		<div id="cajaInformacion">
			<div id="presentacion">
				<div id="todoAudio" onclick="lista_completa()" style="cursor:pointer;" >Bienvenido <?php echo $datosUser['alias']; ?></div>
			</div>
			<div id="listasUsuario">
				<div style="float: left; padding: 5px; color: #FFF;">Tus listas de reproducción:</div>
				<div style="width: 200px; float: left; margin-left: 10px; font-weight: bold;">
					<div id="listasdelusuario"></div>
				</div>
				<div style="float: left; margin-left: 10px;">
					<button type="button" class="btn btn-primary" onclick="mostrar_lista()">
					&nbsp;&nbsp;Mostrar&nbsp;&nbsp;
				</button>
				</div>
				<div style="float: left; padding: 5px; margin-left: 20px; color: #FFF;">Crear lista:
				</div>
				<div style="float: left; padding: 5px; margin-left: 10px;">
					<input type="text" id="nuevaListaCreada" placeholder="Nombra tu lista">
				</div>
				<div style="float: left; margin-left: 10px;">
					<button type="button" class="btn btn-danger" onclick="guardar_lista()">
					&nbsp;Guardar&nbsp;
					</button>
				</div>
			</div>
		</div>
		<div id="cajaSalir">
			<nav class="navegacion">
				<ul class="menu">
					<li><a href="#">
							<div style="padding: 2px;border: groove;border-radius: 10px;">
								Menú
							</div>
						</a>
						<ul class="submenu">
							<li><a href="paginaUsuario.php">Actualizar</a></li>
							<li><a href="cerrar.php">Cerrar sesión</a></li>
						</ul>
					</li><!--cierre deseccion-->
				</ul>
			</nav><!--cierre de la caja MENU-->
		</div>
	</header><!--cierre del header-->
	

	<div id="containerTabla">
		<div id="tabla"></div>
	</div>



		<!--***********Envio de archivos*************-->
		<form id="formuploadajax" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr style="background: #56504F;color: #FFF;">
					<td style="width: 100px;">&nbsp;</td>
					<td>Imagen</td>
					<td>Audio</td>
					<td>Lista</td>
					<th style="width: 100px;">&nbsp;</th>
				</tr>
				<tr style="background: #AFAFAE;color: #FFF;"><!--seleccion de archivos-->
					<td style="background: #56504F;color: #FFF;width: 100px;">&nbsp;</td>
					<td><input type="file" name="imagen" id="imagen" class="form-control"></td>
					<td><input type="file" name="audio" id="audio" class="form-control"></td>
					<td>
						<div id="listaGuardar"></div>
					</td>
					<td style="background: #56504F;color: #FFF;width: 100px;">&nbsp;</td>
				</tr>
				<tr style="background: #56504F;color: #FFF;"><!--seccion tabla nombre, genero y artista, guardar-->
					<td style="width: 100px;">&nbsp;</td>
					<td>Nombre</td>
					<td>Género</td>
					<td>Artista</td>
					<td style="width: 100px;">&nbsp;</td>
				</tr>
				<tr style="background: #AFAFAE;color: #FFF;"><!--seccion guardar nombre, genero y artista, guardar-->
					<td style="background: #56504F;color: #FFF;width: 100px;">&nbsp;</td>
					<td><input type="text" name="nombre" id="nombre" class="form-control" placeholder="Agrega el nombre del audio"></td>
					<td><input type="text" name="genero" id="genero" class="form-control" placeholder="Género musical o estilo de música"></td>
					<td><input type="text" name="artista" id="artista" class="form-control" style="width: 350px;" placeholder="Nombre del artista"></td>
					<td style="background: #56504F;color: #FFF;width: 100px;">&nbsp;</td>
				</tr>
				<tr style="background: #56504F;color: #FFF;"><!--seccion tabla nombre, genero y artista, guardar-->
					<td style="width: 100px;">&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" id="btnGuardarArchivos" class="btn btn-success btn-block " value="Guardar audio"></td>
					<td>&nbsp;</td>
					<td style="width: 100px;">&nbsp;</td>
				</tr>
			</table>
			<br>
			<br>
		</form>
	</section>


	<footer>
		&#169;All Reserved by SILENCE SOUND
	</footer>



<!-- Modal para editar datos del audio -->

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Item</h4>
      </div>
      <div class="modal-body">

      	
	      	<input type="text" hidden="" name="id_audioUpdate" id="id_audioUpdate">
	      	<label>Imagen</label>
	      	<input type="file" name="imagenUpdate" id="imagenUpdate" class="form-control input-sm">
	        <label>Audio</label>
	        <input type="file" name="audioUpdate" id="audioUpdate" class="form-control input-sm">
	        <label>Lista</label>
			<div id="listaActualizar"></div>
	        <label>Nombre</label>
	        <input type="text" name="nombreUpdate" id="nombreUpdate" class="form-control input-sm">
	        <label>Género</label>
	        <input type="text" name="generoUpdate" id="generoUpdate" class="form-control input-sm">
	        <label>Artista</label>
	        <input type="text" name="artistaUpdate" id="artistaUpdate" class="form-control input-sm">


      </div>
      <div class="modal-footer">
      	<input type="submit" class="btn btn-warning" id="actualizarArchivo" data-dismiss="modal" value="Actualizar">
      </div>
    </div>
  </div>
</div>



</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#listasdelusuario').load('componentes/listasUsuario.php');
		$('#listaGuardar').load('componentes/listaGuardar.php');
		$('#listaActualizar').load('componentes/listaActualizar.php');

	});

	function agregaform(datos){

	d=datos.split('||');

	$('#id_audioUpdate').val(d[0]);
	$('#nombreUpdate').val(d[1]);
	$('#generoUpdate').val(d[2]);
	$('#artistaUpdate').val(d[3]);

	}

</script>
<script type="text/javascript">

	/*funcion para guardar audio en la base de datos*/
	$(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
          
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "PHP/guardarArchivo.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     		processData: false,
	     		success:function(r){
					if(r==1){
						/*limpiar campos*/
						$('input[type="text"]').val('');
						$('input[type="file"]').val('');
						alert("Se a guardo con exito :)")
						$('#tabla').html("<center><h1 style=\"color:#FFF;\">Espera un momento...</h1></center>");
						$('#tabla').load('componentes/tablaCompleta.php');

					}
					else{
						/*limpiar campos*/
						$('input[type="text"]').val('');
						$('input[type="file"]').val('');
						alert("Algo Fallo al guardar el archivo :(")
					}
				}
            });
            
        });
    });



function mostrar_lista(){

	var ar = $('#listas').val();
	console.log("  funcion "+ar)
	if(lista = 0){
		alert("Aún no tienes ninguna lista");
	}
	else{

		var url = "http://localhost/proyecto_5_semestre/proyecto_2019_A/componentes/setLista.php";

	    $.post(url,{"LISTA":ar},function(respuesta){
			/*alert(respuesta);*/
			$('#tabla').html("<center><h1 style=\"color:#FFF;\">Espera un momento...</h1></center>");
			$('#tabla').load('componentes/lista.php');
			$('#listasdelusuario').load('componentes/listasUsuario.php');
			$('#listaGuardar').load('componentes/listaGuardar.php');
			$('#listaActualizar').load('componentes/listaActualizar.php');
		});
		
	}

}


</script>
