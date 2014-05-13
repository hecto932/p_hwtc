<div class="row">
	
	<div class="six columns">
		
		<form method="POST" name="buscar_subscriptor">
			<div class="row collapse">
				<div class="ten columns">
					<input type="text" name="texto" />
				</div>
				<div class="two columns"><button class="button expand postfix wtc">Buscar</button></div>
			</div>
		</form>
		
	</div>
	
	<div class="six columns">
		<form name="form_listado" method="post" action="/backend/promocion/generar_listado">
			<div style="float: right;"><button class="button expand postfix wtc three columns generar_listado"> Generar Archivo </button></div>
		</form>
	</div>
	
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?><?php echo $breadcrumbs; ?><?php endif; ?>
		
		<?php if(isset($subscriptores) && !empty($subscriptores)): ?>
		
		<table class="twelve" border="1">
			<?php /*-----------------------------------------Inicio encabezado----------------------------------------------*/?>
			<thead>
				<tr>
					<th id="nombre" class="col1 dark <?php echo ((strpos(uri_string(),'nombre')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'nombre')!=false) ? $url.'/'.$order_by_new : $url.'/'.'nombre/asc', lang('subscriptores.nombre')) ?>
					</th>

					<th id="apellido" class="col2 <?php echo ((strpos(uri_string(),'apellido')!=false) ? strtolower($order_dir) : 'desc')?>">
						<?php echo anchor((strpos(uri_string(),'apellido')!=false) ? $url.'/'.$order_by_new : $url.'/'.'apellido/asc', lang('subscriptores.apellido')) ?>
					</th>

                    <th id="email" class="col3 dark <?php echo ((strpos(uri_string(),'email')!=false) ? strtolower($order_dir) : 'desc')?>">
                    	<?php echo anchor((strpos(uri_string(),'email')!=false) ? $url.'/'.$order_by_new : $url.'/'.'email/asc', lang("subscriptores.email")) ?>
                    </th>
                    
                    <th id="estado" class="col4 dark <?php echo ((strpos(uri_string(),'estado')!=false) ? strtolower($order_dir) : 'desc')?>">
                    	<?php echo anchor((strpos(uri_string(),'estado')!=false) ? $url.'/'.$order_by_new : $url.'/'.'estado/asc', 'Estado') ?>
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
				<?php foreach ($subscriptores as $subscriptor): ?>
					<tr>
						<td class="col1" headers="nombre">
							<p>
								<?php echo ($subscriptor->nombre != '') ? ucfirst($subscriptor->nombre) : ucfirst(lang('subscriptores.no_data'));  ?>
							</p>
						</td>
						<td class="col2" headers="apellido">
							<p>
								<?php echo ((isset($subscriptor->apellido) && !empty($subscriptor->apellido)) ? $subscriptor->apellido : lang('subscriptores.no_data')); ?>
							</p>
						</td>
						<td class="col3" headers="email">
							<p>
								<?php echo ((isset($subscriptor->email) && !empty($subscriptor->email)) ? $subscriptor->email : lang('subscriptores.no_data')); ?>
							</p>
						</td>
						<td class="col4" headers="estado">
							<p>
								<?php echo ((isset($subscriptor->estado) && !empty($subscriptor->estado)) ? $subscriptor->estado : lang('subscriptores.no_data')); ?>
							</p>
						</td>

						<td class="col10 last" headers="ver_promocion">
							<?php
								echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('subscriptor_url').'/'.$subscriptor->id_subscriptor, lang('listado_ver'),array('title'=> lang('listado_ver'), 'class' => 'button radius wtc'));
							?>
						</td>

						<td class="col9" headers="eliminar">
							<p class="centered">
								<?php echo anchor('backend/borrar_subscriptor/'.$subscriptor->id_subscriptor,'Eliminar',array('title'=>"eliminar promocion", 'class'=>"delete", 'id'=>"icon_eliminar"))?>
							</p>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
				<?php /*-----------------------------------------Fin Cuerpo----------------------------------------------*/?>
		</table>
		
		<?php else: ?>
		
			<div class="alert-box secondary">
			  No hay subscriptores por el momento.
			  <a href="" class="close">&times;</a>
			</div>
		
		<?php endif; ?>
		
	</div>
</div>

<div class="row">
	<div class="twelve columns pagination-centered">
		<?php echo $pagination?>
	</div>
</div>