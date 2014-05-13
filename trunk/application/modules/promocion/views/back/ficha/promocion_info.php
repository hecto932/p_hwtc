<h3><?php echo lang('ficha_datos'); ?></h3>

	<div class="ficha_promocion">
		<?php $estado = json_decode(modules::run('services/relations/get_from_id','estado',$promocion->id_estado,'true')); ?>
		<table style="border: 0px; padding: 3px 3px;">
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_estado'); ?>:</strong></td>
				<td><?php echo ucfirst($estado->estado); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_fecha'); ?>:</strong></td>
				<td><?php echo date('d/m/Y',mysql_to_unix($promocion->creado)); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_destacado'); ?>:</strong></td>
				<td><?php echo ucfirst($promocion->destacado); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang("listado_tipo"); ?>:</strong></td>
				<td><?php echo ucfirst(lang('promocion_tipo'.$promocion->id_tipo_promocion)); ?></td>
			</tr>
		</table>
	</div>
	
<div class="row">
	<div class="twelve columns">
		<?php
			if($this->session->userdata('idioma') == 'es')
				echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('promocion_url').'/'.$promocion->id_promocion, lang('listado_editar').' '.lang('promocion_url'), array('title'=>lang('listado_editar').' '.lang('promocion_url'), 'class' => 'button radius wtc'));
			else
				echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('articulo_url').'/'.$promocion->id_promocion, lang('listado_editar').' '.lang('promocion_url'), array('title'=>lang('listado_editar').' '.lang('promocion_url'), 'class' => 'button radius wtc'));
		?>
	</div>
</div>