	<div class="row">
		<form method="post" action="PHP/validarUsuario.php">
			<div class="form-group">
			<label for="exampleInputEmail1">Correo</label>
			<input type="email" name="txt_email" class="form-control" id="txt_email" aria-describedby="emailHelp" placeholder="Escribe tu email">
			<small id="emailHelp" class="form-text text-muted"></small>
			</div>
			<div class="form-group">
			<label for="exampleInputPassword1">Contraseña</label>
			<input type="password" name="txt_password" class="form-control" id="txt_password" placeholder="Contraseña">
			</div>
			<div class="form-group form-check">
			<input type="hidden" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1"></label>
			</div>
				<center>
					<button type="submit" class="btn btn-primary btn-lg" name="btnLogin">Ingresar</button>
				</center>
			<br>
			<!-- Button trigger modal -->
			<center>
				<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">
				Registrate
				</button>
			</center>
			
		</form>
	</div>
