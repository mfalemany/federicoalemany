$(document).ready(function(){
	$("#boton_comentario").on("click",function(){
		if( $("#nombre").prop("value").toLowerCase() == "administrador" || $("#nombre").prop("value").toLowerCase() == "federico alemany"){
			alert("Por favor, elige otro nombre. No puedes comentar como Administrador")
		}else{
			if($('#nombre').prop('value').length > 0 && $('#nuevo_comentario').prop('value').length > 0){
				$.ajax({
					url: '../../blog/guardo_comentario',
					type: 'POST',
					async: true,
					data: { nombre: $('#nombre').prop('value'),
						    comentario: $('#nuevo_comentario').prop('value'),
						    post: $('#utc').prop('value')
						},
					success: respuestaComentarioOK,
					error: respuestaFAIL,
					
				});
			}else{
				alert('Por favor, no deje ningun campo incompleto.');
			}	
		}
	})

	$("#enviar_mensaje").on("click",function(){
		if(validar_mail()){
			$.ajax({
				url: 'envio_mail',
				type: 'POST',
				async: true,
				data: { nombre: $('#nombre').prop('value'),
					    mensaje: $('#mensaje').prop('value'),
					    email: $('#email').prop('value'),
					    ciudad: $('#ciudad').prop('value')
					},
				success: function(respuesta){
					console.log(respuesta);
					respuestaMailOK()
				},
				error: respuestaFAIL,
				
			});
			
		}
			
	})

	$("#imagensubir").on("change",function(){
		var imagensubir = document.getElementById("imagensubir");//Damos el valor del input tipo file
		var archivo = imagensubir.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
		
		//El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo, este tipo de objeto ya tiene la propiedad multipart/form-data para poder subir archivos
		var data = new FormData();
		
		data.append('imagen',archivo[0]);
		

		$.ajax({
			url:'admin/subir_imagen', //metodo que controla la subida
			type:'POST', //Metodo que usaremos
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:data, //Le pasamos el objeto que creamos con los archivos
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false //Para que el formulario no guarde cache
		}).done(function(msg){
		resultado = JSON.parse(msg);
		console.log(msg);	


		$("#cargados").append(resultado.nombre+"<span style='color:red; margin:20px;'> SUBIDO! </span>"); 
		$("#contenido_post").prop("value",$("#contenido_post").prop('value')+"<img src='"+resultado.ruta+resultado.nombre+"'>");
		})
	})


})

function marcar_respondido(id_comentario){
	$.ajax({
		url:'admin/marcar_respondido', //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
		async: true,
		data:{id_comentario: id_comentario},
		success: function(){
					alert("Marcado como respondido!");
					$("#conversacion"+id_comentario).slideUp();
				},
		error: respuestaFAIL,
	})		
}

function responder(id_comentario,id_post){
	if( $("#"+id_comentario).prop('value').length > 0 ){
		alert('respuesta: '+$("#"+id_comentario).prop('value')+' utc: '+id_post);
		$.ajax({
			url:'admin/responder', //Url a donde la enviaremos
			type:'POST', //Metodo que usaremos
			async: true,
			data:{
				respuesta: $("#"+id_comentario).prop('value'), 
				utc: id_post,
				comentario: id_comentario,
			},
			success: function(){
						alert("Respondido!");
						$("#conversacion"+id_comentario).slideUp();
					},
			error: respuestaFAIL,
		})		
	}else{
		alert("Por favor, escriba un comentario.");
	}
}

function respuestaComentarioOK(){
	alert("Gracias por comentar!");
	$("#comentarios_anteriores" ).load("<?php echo base_url(); ?>index.php/blog/cargar_comentarios/"+$('#utc').prop('value'));	
	$('#nombre').prop('value',"");
	$('#nuevo_comentario').prop('value',"");
}

function respuestaFAIL(){
	alert("Ha ocurrido un error");
}


function respuestaMailOK(){
	alert("Tu mensaje ha sido enviado. Te respondere a la brevedad. Muchas gracias!");
	$('#nombre').prop('value',"");
	$('#email').prop('value',"");
	$('#ciudad').prop('value',"");
	$('#mensaje').prop('value',"");
}
function respuestaImagenOK(){
	alert("Imagen subida con exito!");
	$('#insertar_imagen').prop('value',"");
}

function validar_mail(){
	if( $("#nombre").prop("value").length > 0 ){
		if( $("#email").prop("value").length > 0 ){
			if( $("#ciudad").prop("value").length > 0 ){
				if( $("#mensaje").prop("value").length > 0 ){
					return true;
				}else{
					alert("Por favor, complete el campo 'Mensaje'");
					return false
				}
			}else{
				alert("Por favor, complete el campo 'Ciudad'");
				return false
			}
		}else{
			alert("Por favor, complete el campo 'E-mail'");
			return false
		}
	}else{
		alert("Por favor, complete el campo 'Nombre'");
		return false
	}
}

