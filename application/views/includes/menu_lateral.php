<div id="blog_menu_lateral">
	<div id="blog_busqueda">
		<form action="<?php echo base_url(); ?>blog/buscar_posts" method="POST">
			<input type="text" id="criterio" name="criterio" placeholder="Busqueda..." required>
			<input type="submit" value="Buscar">
		</form>
	</div>
	<div class="destacados">
		<h2>Top 5 mas vistos</h2>
		<?php 
			foreach ($topcinco as $value): ?>
				<div><a href="<?php echo base_url(); ?>blog/ver_post/<?php echo $value['utc']; ?>"><?php echo $value['titulo']; ?></a></div>
			<?php endforeach; ?>
	</div>
	<div class="destacados">
		<h2>Categorias</h2>
		<div><a href="<?php echo base_url(); ?>blog">Todas</a></div>
		<?php //var_dump($categorias); die; ?>
		<?php foreach ($categorias as $value): ?>
			<div><a href="<?php echo base_url()."blog/ver_categoria/".$value['id_categoria']; ?>"><?php echo $value['categoria']; ?></a></div>
		<?php endforeach; ?>
			
	</div>

</div>
