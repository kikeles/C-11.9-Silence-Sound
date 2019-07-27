function guardar_registro(){
	var aceptar = document.getElementById("aceptar").checked;

	if(aceptar==true){
		var nombre = document.getElementById("nombre").value;
		var apellidos = document.getElementById("apellidos").value;
		var alias = document.getElementById("alias").value;
		var email = document.getElementById("email").value;
		var password1 = document.getElementById("password1").value;
		var password2 = document.getElementById("password2").value;

		if(nombre==="" || apellidos==="" || alias==="" || email==="" || password1==="" || password2===""){
			alert("No dejar campos vacios");
		}
		else{
			if(password1==password2){

				var parametros = {
					"nombre":nombre,
					"apellidos":apellidos,
					"alias":alias,
					"email":email,
					"password":password1
				};

		        $.ajax({
		        	type:"POST",
		        	url:"PHP/guardarRegistro.php",
		        	data:parametros,
		        	success:function(respuesta){
		        		/*limpiar campos*/
						$('input[type="text"]').val('');
						$('input[type="password"]').val('');
						$("#mensajeRegistro").html(respuesta);
					}
		        });

			}
			else{
				alert("No coincide tu contraseña \nvuelve a ingresarla")
				$('input[type="password"]').val('');
			}
		}

	}
	else{
		/*limpiar campos*/
		$('input[type="text"]').val('');
		$('input[type="password"]').val('');
		alert("No aceptado, para poder ingresar \nes necesario aceptar los terminos y condiciones de esta plataforma");
	}


}


function guardar_lista(){
	var lista = $('#nuevaListaCreada').val();

	$.ajax({
		type:"POST",
		url:"PHP/guardarLista.php",
		data:{"nuevaLista":lista},
		success:function(r){
				if(r==1){
					$('#nuevaListaCreada').val("");
					alert("Se guardo satisfactoriamente");
					$('#listasdelusuario').load('componentes/listasUsuario.php');
					$('#listaGuardar').load('componentes/listaGuardar.php');
					$('#listaActualizar').load('componentes/listaActualizar.php');
				}else{
					alert("Fallo el servidor :(");
				}
			}
	});


}


function preguntarSiNo(id){
  	alertify.confirm('Eliminar Audio', '¿Realmente deseas eliminarlo?',
  function(){
  	eliminarDatos(id); 
    alertify.success('Ok');
  },
  function(){
    alertify.error('Cancelado');
  });
}


function eliminarDatos(id){
	
	var cadena="id="+id;
	console.log(cadena)
		$.ajax({
			type:"POST",
			url:"PHP/eliminarArchivo.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').html("<center><h1 style=\"color:#FFF;\">Espera un momento...</h1></center>");
					$('#tabla').load('componentes/tablaCompleta.php');
				}else{
					alert("Fallo el servidor :(");
				}
			}
		});
}




function lista_completa(){
	
	$('#tabla').html("<center><h1 style=\"color:#FFF;\">Espera un momento...</h1></center>");
	$('#tabla').load('componentes/tablaCompleta.php');
	$('#listasdelusuario').load('componentes/listasUsuario.php');
	$('#listaGuardar').load('componentes/listaGuardar.php');
	$('#listaActualizar').load('componentes/listaActualizar.php');

}

