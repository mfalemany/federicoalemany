<div id="post_view">
	<article class="post">
		<div id="post_titulo">

			<?php echo $post[0]['titulo']; ?>
		</div>
		<div id="post_subtitulo">
			Escrito por Federico Alemany - <?php echo fecha_actual(date("d", $post[0]['utc']),date("m", $post[0]['utc']),date("Y", $post[0]['utc']));  ?>
		</div>
		
		<div id="post_cuerpo">
			<div id="post_imagen">
				<img src="<?php echo base_url(); ?>assets/imagenes/posts/<?php echo $post[0]['imagen'] ?>">
			</div>
			<div id="post_contenido">
				<?php echo nl2br($post[0]['contenido']); ?>
			</div>
		</div>
		<input type="hidden" name="utc" id="utc" value=<?php echo $post[0]['utc'] ?>>
	</article>
	<br>
	<div style="background-color:#48708F; color: white; padding-left:30px;"><h3>Comentarios:</h3></div>
	<div class="post_comentarios">
		<div id="comentarios_anteriores">
			
		
		</div>
		<div class="cuadro_comentarios">
			<div class="comentario">
				
				<div id='bocadillo'></div>
				<div id="detalles_comentario">
					<div>Nombre: <span id="usuario_comentario"><input type="text" name="nombre" id="nombre" required></span></div>
				</div>
				<div class="limpiar"></div>	
				<div id="texto_comentario">
					Comentario: <br>	
					<textarea name="nuevo_comentario" id="nuevo_comentario" required></textarea><br> 
					<input type="button" value="Comentar" id="boton_comentario">
				</div>
			</div>	
		</div>


	</div>
	
</div>
<script type="text/javascript">
	$("#comentarios_anteriores").load("<?php echo base_url(); ?>blog/cargar_comentarios/<?php echo $post[0]['utc']; ?>");	

	function actualizar(){
		$("#comentarios_anteriores").load("<?php echo base_url(); ?>blog/cargar_comentarios/<?php echo $post[0]['utc']; ?>");	
	}
	setInterval(actualizar,2000);


	
</script>
