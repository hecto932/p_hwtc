<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>
		
		
		<table class="twelve" border="1" summary="Tabla de productos.">
			<?php /*-----------------------------------------Inicio encabezado----------------------------------------------*/?>
			<thead>
				<tr>
					<!--
					<th id="ean" class="col1 dark <?php echo ((strpos(uri_string(),'ean')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'ean')!=false) ? $url.'/'.$order_by_new : $url.'/'.'ean/asc',lang('listado_ean')) ?>
					</th>
					-->
					<th id="codigo" class="col1 <?php echo ((strpos(uri_string(),'codigo')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'codigo')!=false) ? $url.'/'.$order_by_new : $url.'/'.'codigo_coloplas/asc',lang('listado_codigo')) ?>
					</th>
					<th id="nombre" class="col1 dark <?php echo ((strpos(uri_string(),'nombre')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'nombre')!=false) ? $url.'/'.$order_by_new : $url.'/'.'nombre/asc',lang('listado_nombre')) ?>
					</th>

					<th id="destacado" class="col3 <?php echo ((strpos(uri_string(),'destacado')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'destacado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'destacado/asc', lang('listado_destacado')) ?>
					</th>
					
					<th id="categoria" class="col3 <?php echo ((strpos(uri_string(),'categoria')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'categoria')!=false) ? $url.'/'.$order_by_new : $url.'/'.'id_categoria/asc', lang('listado_categoria')) ?>
					</th>

                    <th id="fecha" class="col4 dark <?php echo ((strpos(uri_string(),'creado')!=false) ? strtolower($order_dir) : 'desc')?>">
                    	<?php echo anchor((strpos(uri_string(),'creado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'creado/asc', lang("listado_fecha")) ?>
                    </th>

					<th id="estado" class="col6<?php echo ((strpos(uri_string(),'id_estado')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'id_estado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'id_estado/asc',lang("listado_estado"))?>
					</th>

					<th id="ver_producto" class="col10">
						<span>  <?php echo lang('listado_ver'); ?> </span>
					</th>

					<th id="eliminar" class="col9 last">
						<span> <?php echo lang('listado_eliminar'); ?> </span>
					</th>
				</tr>
				<?php /*-----------------------------------------Inicio encabezado----------------------------------------------*/?>
			</thead>
				<?php /*-----------------------------------------Inicio Cuerpo----------------------------------------------*/?>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($productos as $producto): ?>
					<tr>
						<!--
						<td class="col1" headers="ean">
							<p>
								<?php echo ($producto->ean != '') ? ucfirst($producto->ean) : ucfirst(lang('productos.titulo_sing').' '.lang('sin_titulo'));  ?>
							</p>
						</td>
						-->
						<td class="col1" headers="codigo_coloplas">
							<p>
								<?php echo ($producto->codigo_coloplas != '') ? ucfirst($producto->codigo_coloplas) : ucfirst(lang('productos.titulo_sing').' '.lang('sin_titulo'));  ?>
							</p>
						</td>
						<td class="col1" headers="nombre">
							<p>
								<?php echo ($producto->nombre != '') ? ucfirst($producto->nombre) : ucfirst(lang('productos.titulo_sing').' '.lang('sin_titulo'));  ?>
							</p>
						</td>
						<td class="col3" headers="destacado">
							<p>
								<?php echo ((!empty($producto->destacado)) ? $producto->destacado : lang('listado_no')); ?>
								<?php //echo (($producto->destacado == '1') ? lang('listado_si') : lang('listado_no')); ?>
							</p>
						</td>
						
						<td class="col3" headers="categoria">
							<p>
								<?php echo ucfirst($producto->nombre_categoria); ?>
							</p>
						</td>

						<td class="col4" headers="fecha"><p><?php echo date('d/m/Y',mysql_to_unix($producto->creado))?></p></td>

						<td class="col6" headers="estado">
							<p>
								<?php
									$estado = json_decode(modules::run('services/relations/get_from_id','estado', $producto->id_estado,'true'));
									echo lang($estado->estado);
								?>
							</p>
						</td>
						
						<td class="col10 last" headers="ver_producto">
							<?php
								if($this->session->userdata('idioma') == 'es')
									echo anchor(lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$producto->id_producto, lang('listado_ver'),array('title'=> lang('listado_ver'), 'class' => 'button radius wtc'));
								else
									echo anchor(lang('backend_url').'/'.lang('productos_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/'.$producto->id_producto, lang('listado_ver'),array('title'=> lang('listado_ver') , 'class' => 'button radius wtc'));
							?>
						</td>

						<td class="col9" headers="eliminar">
							<p class="centered">
								<?php echo anchor('backend/borrar_producto/'.$producto->id_producto,'Eliminar',array('title'=>"eliminar producto", 'class'=>"delete", 'id'=>"icon_eliminar"))?>
							</p>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
				<?php /*-----------------------------------------Fin Cuerpo----------------------------------------------*/?>
		</table>
	</div>
</div>

<div class="row">
	<div class="twelve columns pagination-centered">
		<?php echo $pagination?>
	</div>
</div>