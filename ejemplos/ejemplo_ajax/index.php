<!DOCTYPE html>
<html>
<head>
	<title>Ejemplo AJAX con jQuery</title>
	<!-- incluyo jQuery -->
	<script src="jquery.js"></script>
	<!-- cuando se cargue un registro, se llama al script en php -->
	<script type="text/javascript">
		$(window).ready(function(){
			var i = 1;
			$("#guardar").on("click", function(){
				$("#lista_personas").append("<tr><td>"+i+"</td><td>"+$("#nombre").prop("value")+"</td></tr>");
				$("#nombre").prop("value","");	
				i++;
			})
		});

	</script>

</head>
<body>
	<table border=1>
		<th>Clave</th><th>Nombre</th>
		<tbody id="lista_personas">
			<!-- aca se van a ir cargando todos los registros -->	
		</tbody>
		
	</table>
	<br><hr><br>
	Ingrese un nuevo nombre: <br>
	<input type="text" id="nombre" name="nombre"><input type="button" value="Guardar" id="guardar">	
</body>
</html>