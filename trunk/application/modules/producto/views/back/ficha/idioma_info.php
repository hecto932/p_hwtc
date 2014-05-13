<?php
	$idiomas = json_decode(modules::run('services/relations/get_all','idioma','true'));
	foreach($producto_idiomas as $producto_idioma):
						$idioma[$producto_idioma->id_idioma] = json_decode(modules::run('services/relations/get_from_id','idioma',$producto_idioma->id_idioma,'true'));
	endforeach;
?>


<?php foreach($producto_idiomas as $producto_idioma): ?>
	<?php
		$img = json_decode(modules::run('services/relations/get_rel','producto','imagen',$producto->id_producto,'true'));
		$ni = 0;
		foreach($img as $k => $i):
			if ($i->id_idioma == $producto_idioma->id_idioma):
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

	<li id="Lang<?php echo $producto_idioma->id_idioma; ?>Tab">

		<div class="idioma_info">
			<h3><?php echo lang('listado_info'); ?></h3>

			<?php if (isset($producto_idioma->nombre) && !empty($producto_idioma->nombre)): ?>
				<div>
					<i class="foundicon-page"></i>
					<span><strong><?php echo lang('listado_nombre'); ?>:</strong> <?php echo $producto_idioma->nombre?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->url) && !empty($producto_idioma->url)): ?>
				<div>
					<i class="foundicon-website"></i>
					<span><strong><?php echo lang('listado_url_tit'); ?>:</strong> <?php echo $producto_idioma->url; ?></span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->keywords) && !empty($producto_idioma->keywords)): ?>
				<div>
					<i class="foundicon-lock"></i>
					<span><strong><?php echo lang('listado_keywords'); ?>:</strong> <?php echo $producto_idioma->keywords; ?></span>
				</div>
			<?php endif;  ?>
			
			<?php if (isset($producto_idioma->presentacion) && !empty($producto_idioma->presentacion)): ?>
				<div>
					<i class="foundicon-lock"></i>
					<span><strong><?php echo 'Presentación'; ?>:</strong> <?php echo $producto_idioma->presentacion; ?></span>
				</div>
			<?php endif;  ?>
			
			<hr>

			<?php if (isset($producto_idioma->titulo_pagina) && !empty($producto_idioma->titulo_pagina)): ?>
				<div>
					<i class="foundicon-paper-clip"></i>
					<span><strong><?php echo lang('listado_tit_page'); ?>:</strong> <?php echo $producto_idioma->titulo_pagina?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_pagina) && !empty($producto_idioma->descripcion_pagina)): ?>
				<div>
					<i class="foundicon-quote"></i>
					<span><strong><?php echo lang('listado_desc_page'); ?>:</strong> <?php echo $producto_idioma->descripcion_pagina; ?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_breve) && !empty($producto_idioma->descripcion_breve)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_desc_breve'); ?>:</strong> <?php echo $producto_idioma->descripcion_breve?> </span>
				</div>
			<?php endif; ?>
			
			<?php if (isset($producto_idioma->caracteristicas) && !empty($producto_idioma->caracteristicas)): ?>
				
				<hr>
				<div>
					<i class="foundicon-paper-clip"> </i>
					<span><strong><?php echo "Caracteristicas"; ?>:</strong><br /><br />
						
						<?php $catacteristicas = json_decode($producto_idioma->caracteristicas); ?>
						
						<?php foreach($catacteristicas as $key => $value): ?>
						<dl>
							<dt><span class="round label"><?php echo $key+1; ?></span> <?php echo $value[0]; ?></dt>
							<?php $caracteristica = array_shift($value); ?>
							<?php foreach($value as $sub): ?>
								<dd style="padding-left: 25px;"><span class="secondary round label"> </span>&nbsp;<?php echo $sub; ?></dd>
							<?php endforeach; ?>
						</dl>
						<?php endforeach; ?>
						
					</span>
				</div>
			<?php endif; ?>
			
			<hr>
			
			<?php if (isset($producto_idioma->titulo) && !empty($producto_idioma->titulo)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_titulo'); ?>:</strong> <?php echo $producto_idioma->titulo?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_ampliada) && !empty($producto_idioma->descripcion_ampliada)): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php $temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($producto_idioma->descripcion_ampliada)); ?>
					<span style="word-wrap: break-word;"><strong><?php echo lang('listado_descripcion').' Ampliada'; ?>:</strong> <?php echo $temp; ?> </span>
				</div>
			<?php endif; ?>
			
			<?php if (isset($producto_idioma->titulo2) && !empty($producto_idioma->titulo2)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_titulo'); ?>: 2</strong> <?php echo $producto_idioma->titulo2?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_ampliada2) && !empty($producto_idioma->descripcion_ampliada2)): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php $temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($producto_idioma->descripcion_ampliada2)); ?>
					<span style="word-wrap: break-word;"><strong><?php echo lang('listado_descripcion').' 2'; ?>:</strong> <?php echo $temp; ?> </span>
				</div>
			<?php endif; ?>
			
			<?php if (isset($producto_idioma->titulo3) && !empty($producto_idioma->titulo3)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_titulo'); ?> 3:</strong> <?php echo $producto_idioma->titulo3?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_ampliada3) && !empty($producto_idioma->descripcion_ampliada3)): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php $temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($producto_idioma->descripcion_ampliada3)); ?>
					<span style="word-wrap: break-word;"><strong><?php echo lang('listado_descripcion').' 3'; ?>:</strong> <?php echo $temp; ?> </span>
				</div>
			<?php endif; ?>
			
			<?php if (isset($producto_idioma->titulo4) && !empty($producto_idioma->titulo4)): ?>
				<div>
					<i class="foundicon-quote"> </i>
					<span><strong><?php echo lang('listado_titulo'); ?> 4:</strong> <?php echo $producto_idioma->titulo4?> </span>
				</div>
			<?php endif; ?>
			<?php if (isset($producto_idioma->descripcion_ampliada4) && !empty($producto_idioma->descripcion_ampliada4)): ?>
				<div class="desc_larga">
					<i class="foundicon-quote"></i>
					<?php $temp = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', strip_tags($producto_idioma->descripcion_ampliada4)); ?>
					<span style="word-wrap: break-word;"><strong><?php echo lang('listado_descripcion').' 4'; ?>:</strong> <?php echo $temp; ?> </span>
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
					echo anchor(lang('backend_url').'/'.lang('productos_url').'/'.lang('eliminar_url').'_'.lang('idioma_url').'/'.$producto->id_producto.'/'.$producto_idioma->id_detalle_producto, lang('listado_eliminar').' '.lang('listado_idioma'), array('title'=> lang('listado_eliminar').' '.lang('listado_idioma'), 'class' => 'button radius alert'));
				?>

				<?php
					echo anchor(lang('backend_url').'/'.lang('productos_url').'/'.lang('editar_url').'_'.lang('idioma_url').'/'.$producto->id_producto.'/'.$producto_idioma->id_detalle_producto, lang('listado_editar').' '.lang('listado_idioma'), array('title'=> lang('listado_editar').' '.lang('listado_idioma'), 'class' => 'button radius wtc'));
				?>
			</div>
		</div>


<?php endforeach; ?>