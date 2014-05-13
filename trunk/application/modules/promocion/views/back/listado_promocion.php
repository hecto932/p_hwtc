<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>
		
		
		<table class="twelve" border="1" summary="Tabla de promociones.">
			<?php /*-----------------------------------------Inicio encabezado----------------------------------------------*/?>
			<thead>
				<tr>
					<th id="nombre" class="col1 dark <?php echo ((strpos(uri_string(),'nombre')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'nombre')!=false) ? $url.'/'.$order_by_new : $url.'/'.'nombre/asc',lang('listado_nombre')) ?>
					</th>

					<th id="destacado" class="col3 <?php echo ((strpos(uri_string(),'destacado')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'destacado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'destacado/asc', lang('listado_destacado')) ?>
					</th>

                    <th id="fecha" class="col4 dark <?php echo ((strpos(uri_string(),'creado')!=false) ? strtolower($order_dir) : 'desc')?>">
                    	<?php echo anchor((strpos(uri_string(),'creado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'creado/asc', lang("listado_fecha")) ?>
                    </th>

					<th id="estado" class="col6<?php echo ((strpos(uri_string(),'id_estado')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'id_estado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'id_estado/asc',lang("listado_estado"))?>
					</th>
					
					<th id="id_tipo_promocion" class="col7<?php echo ((strpos(uri_string(),'id_tipo_promocion')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'id_tipo_promocion')!=false) ? $url.'/'.$order_by_new : $url.'/'.'id_tipo_promocion/asc',lang("listado_tipo"))?>
					</th>
					
					<th id="ver_promocion" class="col10">
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
				<?php foreach ($promociones as $promocion): ?>
					<tr>
						<td class="col1" headers="nombre">
							<p>
								<?php echo ($promocion->nombre != '') ? ucfirst($promocion->nombre) : ucfirst(lang('promociones.titulo_sing').' '.lang('sin_titulo'));  ?>
							</p>
						</td>
						<td class="col3" headers="destacado">
							<p>
								<?php echo ((isset($promocion->destacado) && !empty($promocion->destacado)) ? $promocion->destacado : lang('listado_no')); ?>
							</p>
						</td>

						<td class="col4" headers="fecha"><p><?php echo date('d/m/Y',mysql_to_unix($promocion->creado))?></p></td>

						<td class="col6" headers="estado">
							<p>
								<?php
									$estado = json_decode(modules::run('services/relations/get_from_id','estado', $promocion->id_estado,'true'));
									echo lang($estado->estado);
								?>
							</p>
						</td>
						
						<td class="col7" headers="id_tipo_promocion">
							<p>
								<?php echo ($promocion->id_tipo_promocion == 1) ?  lang('promocion_tipo1') :  lang('promocion_tipo2'); ?>
							</p>
						</td>
						
						<td class="col10 last" headers="ver_promocion">
							<?php
								if($this->session->userdata('idioma') == 'es')
									echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$promocion->id_promocion, lang('listado_ver'),array('title'=> lang('listado_ver'), 'class' => 'button radius wtc'));
								else
									echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/'.$promocion->id_promocion, lang('listado_ver'),array('title'=> lang('listado_ver') , 'class' => 'button radius wtc'));
							?>
						</td>

						<td class="col9" headers="eliminar">
							<p class="centered">
								<?php echo anchor('backend/borrar_promocion/'.$promocion->id_promocion,'Eliminar',array('title'=>"eliminar promocion", 'class'=>"delete", 'id'=>"icon_eliminar"))?>
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