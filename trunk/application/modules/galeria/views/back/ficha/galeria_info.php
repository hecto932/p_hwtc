<?php //die_pre($galeria); ?>
<h3><?php echo lang('ficha_datos'); ?></h3>

	<div class="ficha_galeria">
		<?php $estado = json_decode(modules::run('services/relations/get_from_id','estado',$galeria->id_estado,'true')); ?>
		<table style="border: 0px; padding: 3px 3px;">
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_estado'); ?>:</strong></td>
				<td><?php echo (!empty($estado->estado)) ? ucfirst($estado->estado) : lang('sin_definir'); ?></td>
			</tr>
			<!--
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_ean'); ?>:</strong></td>
				<td><?php echo (!empty($galeria->ean)) ? ucfirst($galeria->ean) : lang('sin_definir'); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_codigo'); ?>:</strong></td>
				<td><?php echo (!empty($galeria->codigo_coloplas)) ? ucfirst($galeria->codigo_coloplas) : lang('sin_definir'); ?></td>
			</tr>
			
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo "Categoría"; ?>:</strong></td>
				<td><?php echo (isset($categoria_path) && !empty($categoria_path)) ? $categoria_path : lang('sin_definir'); ?></td>
			</tr>
			-->
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_fecha'); ?>:</strong></td>
				<td><?php echo date('d/m/Y',mysql_to_unix($galeria->creado)); ?></td>
			</tr>
		</table>
	</div>
	
<div class="row">
	<div class="twelve columns">
		<?php
			if($this->session->userdata('idioma') == 'es')
				echo anchor(lang('backend_url').'/'.lang('galerias_url').'/'.lang('editar_url').'_'.lang('galeria_url').'/'.$galeria->id_galeria, lang('listado_editar').' '.lang('galeria_url'), array('title'=>lang('listado_editar').' '.lang('galeria_url'), 'class' => 'button radius wtc'));
			else
				echo anchor(lang('backend_url').'/'.lang('galerias_url').'/'.lang('editar_url').'_'.lang('articulo_url').'/'.$galeria->id_galeria, lang('listado_editar').' '.lang('galeria_url'), array('title'=>lang('listado_editar').' '.lang('galeria_url'), 'class' => 'button radius wtc'));
		?>
	</div>
</div>