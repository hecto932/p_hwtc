<?php
	$idiomas = json_decode(modules::run('services/relations/get_all','idioma','true'));
	foreach($evento_idiomas as $evento_idioma):
		$idioma[$evento_idioma->id_idioma] = json_decode(modules::run('services/relations/get_from_id','idioma',$evento_idioma->id_idioma,'true'));
	endforeach;
?>


<?php foreach($evento_idiomas as $evento_idioma): ?>
	<?php
		$img = json_decode(modules::run('services/relations/get_rel','evento','imagen',$evento->id_evento,'true'));
		$ni = 0;
		foreach($img as $k => $i):
			if ($i->id_idioma == $evento_idioma->id_idioma):
				$ni=$k;
			endif;
		endforeach;
	?>

	<?php
	/*
	 *  Por cada lenguaje creado el código se encarga de crear
	 *  una nueva pestaña mostrando la informaciñon correspondiente
	 *  al idioma, el id de la ficha tiene que terminar en Tab
	 *  para ser tomada por el framework Foundation.
	 *
	 * */
	?>

	<li id="Lang<?php echo $evento_idioma->id_idioma; ?>Tab">

		<div class="idioma_info">
			<h3><?php echo lang('ficha_info'); ?></h3>

			<!-- Nombre -->
			<?php if (isset($evento_idioma->nombre) && $evento_idioma->nombre != ''): ?>
				<div>
					<i class="foundicon-page"></i>
					<span> <?php echo lang('eventos_ficha_nombre'); ?>: <?php echo $evento_idioma->nombre?> </span>

				</div>
			<?php endif; ?>
			
			<!-- Titulo -->
			<?php if (isset($evento_idioma->titulo) && $evento_idioma->titulo != ''): ?>
				<div>
					<i class="foundicon-add-doc"></i>
					<span> <?php echo lang('eventos_ficha_titulo'); ?>: <?php echo $evento_idioma->titulo?> </span>
				</div>
			<?php endif; ?>
			
			<!-- Patrocinante -->
			<?php if (isset($evento_idioma->patrocinante) && $evento_idioma->patrocinante != ''): ?>
				<div>
					<i class="foundicon-add-doc"></i>
					<span> <?php echo lang('eventos_ficha_patrocinante'); ?>: <?php echo $evento_idioma->patrocinante; ?></span>
				</div>
			<?php endif;  ?>
			
			<hr>
			
			<!-- Lugar -->
			<?php if (isset($evento_idioma->lugar) && $evento_idioma->lugar != ''): ?>
				<div>
					<i class="foundicon-website"></i>
					<span> <?php echo 'Lugar' ?>: <?php echo $evento_idioma->lugar; ?></span>
				</div>
			<?php endif;  ?>
			
			<!-- Fecha Evento -->
			<?php if (isset($evento_idioma->fecha_evento) && $evento_idioma->fecha_evento != ''): ?>
				<? list($fecha, $hora) = explode(' ', flip_timestamp($evento_idioma->fecha_evento)); ?>
				
				<div>
					<i class="foundicon-calendar"></i>
					<span> <?php echo lang('evento_crear_fecha'); ?>: <?php echo $fecha; ?></span>
				</div>
				<div>
					<i class="foundicon-clock"></i>
					<span> <?php echo 'Hora'; ?>: <?php echo date('g:i A', strtotime($hora)) ?></span>
				</div>
			<?php endif;  ?>
			
			<!-- Fecha -->
			<?php if (isset($evento_idioma->fecha) && $evento_idioma->fecha != ''): ?>
				<div>
					<i class="foundicon-calendar"></i>
					<span> <?php echo lang('evento_crear_fecha'); ?>: <?php echo $evento_idioma->fecha; ?></span>
				</div>
			<?php endif;  ?>
			
			<!-- Hora -->
			<?php if (isset($evento_idioma->hora) && $evento_idioma->hora != ''): ?>
				<div>
					<i class="foundicon-clock"></i>
					<span> <?php echo lang('eventos_crear_hora'); ?>: <?php echo $evento_idioma->hora; ?></span>
				</div>
			<?php endif;  ?>
			
			<hr>
			
			<!-- Descripcion Breve -->
			<?php if (isset($evento_idioma->descripcion_breve) && $evento_idioma->descripcion_breve != ''): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span> <?php echo lang('eventos_ficha_dscB'); ?>: <?php echo $evento_idioma->descripcion_breve?> </span>
				</div>
			<?php endif; ?>
			
			<!-- Descripcion Amplidada -->
			<?php if (isset($evento_idioma->descripcion_ampliada) && $evento_idioma->descripcion_ampliada != ''): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php

						//$temp =  str_replace('<p> </p>', ' ', str_replace('<br />', "\n", $evento_idioma->descripcion_ampliada));
						$temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($evento_idioma->descripcion_ampliada));
					?>
					<span style="word-wrap: break-word;"> <?php echo lang('eventos_ficha_dscA'); ?>: <?php echo $temp; ?> </span>
				</div>
			<?php endif; ?>

			<hr>
			
			<!-- Descripcion Pagina -->
			<?php if (isset($evento_idioma->descripcion_pagina) && $evento_idioma->descripcion_pagina != ''): ?>
				<div>
					<i class="foundicon-quote"></i>
					<span><?php echo lang('eventos_ficha_paginaD'); ?>: <?php echo $evento_idioma->descripcion_pagina; ?> </span>
				</div>
			<?php endif; ?>
			
			<!-- Titulo Pagina -->
			<?php if (isset($evento_idioma->titulo_pagina) && $evento_idioma->titulo_pagina != ''): ?>
				<div>
					<i class="foundicon-paper-clip"></i>
					<span> <?php echo lang('eventos_ficha_paginaT'); ?>: <?php echo $evento_idioma->titulo_pagina?> </span>
				</div>
			<?php endif; ?>

			<!-- Url -->
			<?php if (isset($evento_idioma->url) && $evento_idioma->url != ''): ?>
				<div>
					<i class="foundicon-website"></i>
					<span>URL: <?php echo $evento_idioma->url; ?></span>
				</div>
			<?php endif; ?>

			<!-- Palabras clave -->
			<?php if (isset($evento_idioma->keywords) && $evento_idioma->keywords != ''): ?>
				<div>
					<i class="foundicon-lock"></i>
					<span> <?php echo lang('eventos_ficha_pclave'); ?>: <?php echo $evento_idioma->keywords; ?></span>
				</div>
			<?php endif;  ?>

		</div>

		<dl>
            <?php if (isset($img[$ni]) && $img[$ni]->descripcion_multimedia != ''): ?>
				<dt> <?php echo lang('eventos_ficha_descI'); ?> </dt>
				<dd><?php echo $img[$ni]->descripcion_multimedia?></dd>
			<?php endif; ?>

		</dl>

		<div class="row">
			<div class="twelve columns">
				<?php
					echo anchor(lang('backend_url').'/'.lang('eventos_url').'/'.lang('eliminar_url').'_'.lang('idioma_url').'/'.$evento->id_evento.'/'.$evento_idioma->id_detalle_evento, lang('idioma_eliminar'), array('title'=> lang('idioma_eliminar'), 'class' => 'button radius alert'));
				?>

				<?php
					echo anchor(lang('backend_url').'/'.lang('eventos_url').'/'.lang('editar_url').'_'.lang('idioma_url').'/'.$evento->id_evento.'/'.$evento_idioma->id_detalle_evento, lang('idioma_editar'), array('title'=> lang('idioma_editar'), 'class' => 'button radius wtc'));
				?>
			</div>
		</div>

<?php endforeach; ?>