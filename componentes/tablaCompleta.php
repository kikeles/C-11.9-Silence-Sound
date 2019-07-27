<?php  
	session_start();
	/*$id_usuario = $_SESSION['id_usuario'];*/
	require_once('../PHP/conexionPDO.php');
	$audiosUsuario = $_SESSION['id_usuario'];
	$filas = $conexion->query("SELECT * from audio where id_usuario = ".$audiosUsuario);

?>



<div class="row">
	<div class="col-sm-12">
		<!--separacion de la seccion tabla de audios-->
		<table class="table">
			<tr class="bg-primary" style="font-weight: bold;">
				<td>Número</td>
				<td>Imagen</td>
				<td>Reproducción</td>
				<td>Nombre</td>
				<td>Género</td>
				<td>Artista</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
			
			<!--codigo php para las tablas dinamicas-->
		<?php  
			$num = 1;
			while($archivos=$filas->fetch(PDO::FETCH_ASSOC))
			{
				$datos=$archivos['id_audio']."||".$archivos['nombre']."||".$archivos['genero']."||".$archivos['artista'];


			echo '  <tr>
						<td><p style="padding-top:18px; font-size:16px;">'.$num.'</p></td>
						<td><img src="data:image/png;base64,'.base64_encode($archivos['file_imagen']).'" style="width: 60px;height: 60px;"></td>
						<td>
						<audio controls style="padding-top:10px;">
							<source src="data:audio/mp3;base64,'.base64_encode($archivos['file_audio']).'">
						</audio controls>
					</td>
					<td><p style="padding-top:18px; font-size:16px;">'.$archivos['nombre'].'</p></td>
					<td><p style="padding-top:18px; font-size:16px;">'.$archivos['genero'].'</p></td>
					<td><p style="padding-top:18px; font-size:16px;">'.$archivos['artista'].'</p></td>';
					$num+=1;
		?>
					<td style="padding: 18px;">
						<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos  ?>')">
						</button>
					</td>
					<td style="padding: 18px;">
						<button class="btn btn-danger glyphicon glyphicon-remove" 
						onclick="preguntarSiNo('<?php echo $archivos['id_audio'] ?>')">
					</button>
					</td>
					</tr>

		<?php 

			}/*cierre de la tabla*/

		?>
		</table>
	
	<!--divs del las tablas bootstrap-->
	</div>
</div>
<?php sleep(2); ?>

<script type="text/javascript">
	
    /*funcion para actualizar el audio*/
	$(function(){
        $("#actualizarAudio").on("submit", function(e){
            e.preventDefault();
          
            var f = $(this);
            var formData = new FormData(document.getElementById("actualizarAudio"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "../PHP/actualizarArchivo.php",
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
						$('#tabla').html("<center><h2>Espera un momento...</h2></center>");
						$('#tabla').load('componentes/tabla.php');

					}
					else{
						/*limpiar campos*/
						$('input[type="text"]').val('');
						$('input[type="file"]').val('');
						alert("Algo Fallo al guardar el examen :(")
					}
				}
            });
            
        });
    });


</script>