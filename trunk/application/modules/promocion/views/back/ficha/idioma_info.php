<?php
	$idiomas = json_decode(modules::run('services/relations/get_all','idioma','true'));
	foreach($promocion_idiomas as $promocion_idioma):
						$idioma[$promocion_idioma->id_idioma] = json_decode(modules::run('services/relations/get_from_id','idioma',$promocion_idioma->id_idioma,'true'));
	endforeach;
?>


<?php foreach($promocion_idiomas as $promocion_idioma): ?>
	<?php
		$img = json_decode(modules::run('services/relations/get_rel','promocion','imagen',$promocion->id_promocion,'true'));
		$ni = 0;
		foreach($img as $k => $i):
			if ($i->id_idioma == $promocion_idioma->id_idioma):
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

	<li id="Lang<?php echo $promocion_idioma->id_idioma; ?>Tab">

		<div class="idioma_info">
			<h3><?php echo lang('listado_info'); ?></h3>

			<?php if (isset($promocion_idioma->nombre) && !empty($promocion_idioma->nombre)): ?>
				<div>
					<i class="foundicon-page"></i>
					<span><strong><?php echo lang('listado_titulo'); ?>:</strong> <?php echo $promocion_idioma->nombre?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($promocion_idioma->subtitulo) && !empty($promocion_idioma->subtitulo)): ?>
				<div>
					<i class="foundicon-page"></i>
					<span><strong><?php echo lang('listado_subtitulo'); ?>:</strong> <?php echo $promocion_idioma->subtitulo; ?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($promocion_idioma->url) && !empty($promocion_idioma->url)): ?>
				<div>
					<i class="foundicon-website"></i>
					<span><strong><?php echo lang('listado_url_tit'); ?>:</strong> <?php echo $promocion_idioma->url; ?></span>
				</div>
			<?php endif; ?>
			<?php if (isset($promocion_idioma->keywords) && !empty($promocion_idioma->keywords)): ?>
				<div>
					<i class="foundicon-lock"></i>
					<span><strong><?php echo lang('listado_keywords'); ?>:</strong> <?php echo $promocion_idioma->keywords; ?></span>
				</div>
			<?php endif;  ?>

			<hr>

			<?php if (isset($promocion_idioma->titulo_pagina) && !empty($promocion_idioma->titulo_pagina)): ?>
				<div>
					<i class="foundicon-paper-clip"></i>
					<span><strong><?php echo lang('listado_tit_page'); ?>:</strong> <?php echo $promocion_idioma->titulo_pagina?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($promocion_idioma->descripcion_pagina) && !empty($promocion_idioma->descripcion_pagina)): ?>
				<div>
					<i class="foundicon-quote"></i>
					<span><strong><?php echo lang('listado_desc_page'); ?>:</strong> <?php echo $promocion_idioma->descripcion_pagina; ?> </span>
				</div>
			<?php endif; ?>
			
			<hr>

			<?php if (isset($promocion_idioma->descripcion_breve) && !empty($promocion_idioma->descripcion_breve)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_desc_breve'); ?>:</strong> <?php echo $promocion_idioma->descripcion_breve?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($promocion_idioma->descripcion_ampliada) && !empty($promocion_idioma->descripcion_ampliada)): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php $temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($promocion_idioma->descripcion_ampliada)); ?>
					<span style="word-wrap: break-word;"><strong><?php echo lang('listado_desc_amp'); ?>:</strong> <?php echo $temp; ?> </span>
				</div>
			<?php endif; ?>

		</div>

		<dl>
            <?php if (isset($img[$ni]) && $img[$ni]->descripcion_multimedia != ''): ?>
				<dt> <?php echo lang('listado_multimedia'); ?> </dt>
				<dd><?php echo $img[$ni]->descripcion_multimedia?></dd>
			<?php endif; ?>

		</dl>

		<div class="row">
			<div class="twelve columns">
				<?php
					echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('eliminar_url').'_'.lang('idioma_url').'/'.$promocion->id_promocion.'/'.$promocion_idioma->id_detalle_promocion, lang('listado_eliminar').' '.lang('listado_idioma'), array('title'=> lang('listado_eliminar').' '.lang('listado_idioma'), 'class' => 'button radius alert'));
				?>

				<?php
					echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('idioma_url').'/'.$promocion->id_promocion.'/'.$promocion_idioma->id_detalle_promocion, lang('listado_editar').' '.lang('listado_idioma'), array('title'=> lang('listado_editar').' '.lang('listado_idioma'), 'class' => 'button radius wtc'));
				?>
			</div>
		</div>


<?php endforeach; ?>