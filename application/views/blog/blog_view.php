<section id="blog_articulos">
	<div id="blog_cabecera">
		
		<div id="blog_cabecera_titulo">< articulos <?php if(isset($clase)){echo "class='".$clase."'";} ?>/></div>
	</div>

	<?php 
		$datos['categorias'] = $categorias;
		$datos['topcinco'] = $topcinco;
		$this->load->view("includes/menu_lateral", $datos); 
	?>

	<div id="blog_lista_articulos">
		<?php if(count($posts)==0): ?> 
			<span style="font-size: 1.4em; color:#333; margin: 20px 0px 0px 20px; display:block">No hay articulos para mostrar</span>
		<?php endif; ?>
		<?php foreach ($posts as $key => $value): ?>
			<article class="articulo">
				<div class="articulo_titulo"><?php echo $value['titulo']; ?></div>
				<?php $fecha_publicacion = fecha_actual(date("d", $value['utc']),date("m", $value['utc']),date("Y", $value['utc'])); ?>
				<div class="articulo_subtitulo">Escrito por Federico Alemany - <?php echo $fecha_publicacion; ?></div>
				<div class="articulos_cuerpo">
					<div class="articulo_imagen"><img src="<?php echo base_url(); ?>assets/imagenes/posts/<?php echo $value['imagen']; ?>"></div>
					<div class="articulo_contenido">
						<?php 
							if(strlen($value['contenido']) < 1581){
								echo nl2br($value['contenido'])."<br><br><a href='".base_url()."blog/ver_post/".$value["utc"]."'>Comentarios...</a>";
							}else{
								echo nl2br(substr($value['contenido'],0,1580))."... <a class='boton_continuar' href='".base_url()."blog/ver_post/".$value["utc"]."'>Continuar leyendo...</a>";	
							}
						?> 
					</div>
					
				</div>
				
				<div class="categoria" title="Ver todos los post en esta categoria">Categoria: <a href="<?php echo base_url(); ?>blog/ver_categoria/<?php echo $value['categoria']; ?>"><?php echo $this->admin_model->obtener_categoria($value['categoria']); ?></a></div>

			</article>

		<?php endforeach; ?>
		<?php if($this->mostrar_paginas){ echo $this->paginacion->obtener_enlaces(); } ?>
	</div>

</section>
