<div id="admin_view">
	<div id="nuevo_post">
		<h1>Nuevo Post!</h1>
		<?php echo form_open_multipart('admin/guardar_post'); //var_dump($categorias); die;?>
			<table>
				<tr>
					<td style="width:80px;">Titulo: </td>
					<td><?php echo form_input(array('id'=>'titulo_post', 'name'=>'titulo_post', 'required'=>'TRUE')); ?></td>
				</tr>
				<tr>
					<td>Imagen:</td>
					<td><?php echo form_upload(array('name'=>'userfile','id'=>'userfile', 'required'=>'TRUE')); ?></td>
				</tr>
				<tr>
					<td colspan="2">Contenido:</td>
				</tr>
				<tr>
					<td colspan="2"><textarea name="contenido_post" id="contenido_post" required></textarea></td>
				</tr>
				<tr>
					<td>Categoria:</td>
					<td>
						<select name="categoria" id="categoria">
							<?php foreach($categorias as $value): ?>
								<option value="<?php echo $value['id_categoria']; ?>"><?php echo $value['categoria']; ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
				
					<td colspan=2 class="derecha"><input type="submit" value="Guardar" class="boton"></td>

				</tr>
			</table>
			
			

		<?php echo form_close(); ?>
		
		
			Insertar una imagen:  <input id="imagensubir" type="file" name="imagensubir"/>
			<input type="hidden" name="nombre_imagen" id='nombre_imagen' value='<?php echo time(); ?>'>
			<div id="cargados">
			  <!-- Aqui van los archivos cargados -->
			</div>
		
	</div>
	<br>
	<hr>
	<br>
	<div id="nueva_categoria">
		<?php echo form_open("admin/guardo_categoria"); ?>
			<fieldset>
				<legend>Nueva Categoria</legend>
				Categoria: <input type="text" name="categoria" id="categoria" required><input type="submit" value="Guardar" class="boton">
			</fieldset>
		<?php echo form_close(); ?>
	</div>

	<br>
	<hr>
	

	<div id="respuesta_comentarios">
		<h2>Comentarios sin responder</h2>
	<?php $hay_comentarios = FALSE; ?>	
	<?php foreach ($comentarios as $key => $value): ?>
		<?php $hay_comentarios = TRUE; ?>
		<div class="conversacion" id="conversacion<?php echo $value['id_comentario']; ?>">
			<div class="pregunta">
				<p><span class='pregunta_nombre'><?php echo $value['nombre']; ?></span> comento en <span class="pregunta_post">"<?php echo $this->admin_model->nombre_post($value['utc']); ?>"</span>:</p>
				<blockquote><?php echo $value['comentario']; ?></blockquote>
			</div>
			<div class="respuesta">
				<textarea id="<?php echo $value['id_comentario']; ?>" class='conversacion_respuesta'></textarea>
				<input type="button" id='responder_comentario' value="Responder" onclick='responder(<?php echo $value['id_comentario']; ?>,<?php echo $value['utc']; ?>)'>
				<input type="button" id='marcar_respondido' value="Marcar como respondido" onclick='marcar_respondido(<?php echo $value['id_comentario']; ?>)'>
			</div>
		</div>

	<?php endforeach; ?>
	<?php if(!$hay_comentarios){echo "No existen comentarios sin responder...";} ?>
	</div>

</div>
