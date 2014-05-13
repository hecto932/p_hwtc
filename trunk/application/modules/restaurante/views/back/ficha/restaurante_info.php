<h3><?php echo lang('ficha_datos'); ?></h3>

<div class="ficha_restaurante">
	
	<?php $estado = json_decode(modules::run('services/relations/get_from_id','estado',$restaurante->id_estado,'true')); ?>
	<table style="border: 0px; padding: 3px 3px;">
		<tr>
			<td><i class="foundicon-website"></i> <?php echo lang('estado'); ?>:</td>
			<td><?php echo ucfirst($estado->estado); ?></td>
		</tr>
		<tr>
			<td><i class="foundicon-website"></i> <?php echo lang('restaurantes_crear_fecha'); ?>:</td>
			<td><?php echo date('d/m/Y',mysql_to_unix($restaurante->creado)); ?></td>
		</tr>
		<tr>
			<td><i class="foundicon-website"></i> <?php echo lang('listado_destacado'); ?>:</td>
			<td><?php echo ucfirst($restaurante->destacado); ?></td>
		</tr>
	</table>
	
</div>

<div class="row">
	<div class="twelve columns">
		<?php
		if($this->session->userdata('idioma') == 'es')
			echo anchor(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('editar_url').'_'.lang('restaurante_url').'/'.$restaurante->id_restaurante, lang('editar_tit_rest'), array('title'=>lang('editar_tit_not'), 'class' => 'button radius wtc'));
		else
			echo anchor(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('editar_url').'_'.lang('articulo_url').'/'.$restaurante->id_restaurante, lang('editar_tit_rest'), array('title'=>lang('editar_tit_not'), 'class' => 'button radius wtc'));
		?>
	</div>
</div>