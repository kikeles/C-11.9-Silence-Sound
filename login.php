<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!--link para la libreria bootstrap-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="CSS/estilosLogin.css">

	<!--paqueteria de jQuery-->
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="librerias/bootstrap/js/bootstrap.js"></script>
	<script src="JS/funciones.js"></script>
	
</head>
<body>
	<div id="wrapperLogin">
		<div id="headerLogin">
			<div id="informacion">
				Lleva tu música a todos lados
			</div>
			<div id="banner">
				<img src="img/Logo.png" style="width: 500px; height: 120px;">
			</div>
		</div><!--cierre del header-->
		
		<div id="containerLogin" >
			<img src="img/Iniciar_sesion.png" style="padding: 15px; padding-left: 60px;">
			<div id="mostrar_login"></div>
		</div>
		

		<div id="footerLogin">
			&#169;All Reserved by SILENCE SOUND
		</div><!--cierre del footer-->

	</div><!--cierre del wrapper-->



	<!-- Modal de registro de usuario -->
	<form>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title" id="exampleModalLabel">Registro</h4>
		        <div id="mensajeRegistro"></div>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <!--llenado de formulario registro-->
		        <label style="color: #DF470A;">*</label><label>Nombre:</label><br>
				<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre: Ricardo Alberto" autocomplete="name" required><br>
				<label style="color: #DF470A;">*</label><label>Apellidos:</label><br>
				<input type="text" name="apellidos" id="apellidos" class="form-control input-sm" placeholder="Apellidos: Ruelas Guzmán" autocomplete="last-name" required><br>
		        <label style="color: #DF470A;">*</label><label>Alias de usuario:</label><br>
				<input type="text" name="alias" id="alias" class="form-control input-sm" placeholder='Alias: "RokerJuan"' autocomplete="nickname" required><br>
				<label style="color: #DF470A;">*</label><label>Email:</label><br>
				<input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo electrónico" autocomplete="email" required><br>
				<label style="color: #DF470A;">*</label><label>Contraseña:</label><br>
				<input type="password" name="password1" id="password1" class="form-control input-sm" placeholder="Ingresa una contraseña fuerte" autocomplete="password" required><br>
				<label style="color: #DF470A;">*</label><label>Ingresa de nuevo tu contraseña:</label><br>
				<input type="password" name="password2" id="password2" class="form-control input-sm" placeholder="Ingresa la contraseña anterior" autocomplete="password" required>
		      </div>
		      <div class="modal-footer">
				<label class="form-check-label" for="exampleCheck1">
				<a href="HTML/infoCondiciones.html" target="_blanck">Terminos y condiciones</a></label>
				<br>
				<input type="checkbox" class="form-check-input" id="aceptar"><label>acepto</label>
				<br>
		        <button type="button" class="btn btn-primary" onclick="guardar_registro()">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#mostrar_login').load('PHP/iniciarSesion.php');
		
	});
</script>
