<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?><?php echo $breadcrumbs; ?><?php endif; ?>
		
		<table class="twelve" border="1" summary="Tabla de restaurantes.">
			<?php /*-----------------------------------------Inicio encabezado----------------------------------------------*/?>
			<thead>
				<?php
				/*
				 *  Encabezado del listado.
				 * 	Nombre:
				 * 	Destacado:
				 *  Fecha:
				 * 	Estado:
				 * 	Ver_restaurante:
				 * 	Eliminar:
				 * */
				?>

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

					<th id="ver_restaurante" class="col10">
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
				<?php foreach ($restaurantes as $restaurante): ?>
					<tr>

						<td class="col1" headers="nombre">
							<p>
								<?php echo ($restaurante->nombre != '') ? ucwords($restaurante->nombre) : lang('restaurantes_sintitulo');  ?>
							</p>
						</td>
						
						<td class="col3" headers="destacado">
							<p>
								<?php echo $restaurante->destacado; ?>
							</p>
						</td>

						<td class="col4" headers="fecha"><p><?php echo date('d/m/Y',mysql_to_unix($restaurante->creado))?></p></td>

						<td class="col6" headers="estado">
							<p>
								<?php
									$estado = json_decode(modules::run('services/relations/get_from_id','estado', $restaurante->id_estado,'true'));
									echo lang($estado->estado);
								?>
							</p>
						</td>

						<td class="col10 last" headers="ver_restaurante">
							<?php
								if($this->session->userdata('idioma') == 'es')
								{
									echo anchor(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$restaurante->id_restaurante, lang('restaurantes_list_ver'),array('title'=> lang('restaurantes_ficha_ver'), 'class' => 'button radius wtc'));

								}
								else
								{
									echo anchor(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/'.$restaurante->id_restaurante, lang('restaurantes_list_ver'),array('title'=> lang('restaurantes_ficha_ver') , 'class' => 'button radius wtc'));
								}
							?>
						</td>

						<td class="col9" headers="eliminar">
							<p class="centered">
								<?php echo anchor('backend/borrar_restaurante/'.$restaurante->id_restaurante,'Eliminar',array('title'=>"eliminar restaurante", 'class'=>"delete", 'id'=>"icon_eliminar"))?>
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



