<h3><?php echo lang('ficha_datos'); ?></h3>

<div class="ficha_promocion">
	<table style="border: 0px; padding: 3px 3px;">
		<tr>
			<td><i class="foundicon-website"></i> <strong><?php echo lang('subscriptores.nombre'); ?>:</strong></td>
			<td><?php echo ucfirst(strtolower($subscriptor->nombre)); ?></td>
		</tr>
		<tr>
			<td><i class="foundicon-website"></i> <strong><?php echo lang('subscriptores.apellido'); ?>:</strong></td>
			<td><?php echo ucfirst(strtolower($subscriptor->apellido)); ?></td>
		</tr>
		<tr>
			<td><i class="foundicon-website"></i> <strong><?php echo lang('subscriptores.email'); ?>:</strong></td>
			<td><?php echo strtolower($subscriptor->email); ?></td>
		</tr>
	</table>
</div>
	
<div class="row">
	<div class="twelve columns">
		<?php
			echo anchor(lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('subscriptor_url').'/'.$subscriptor->id_subscriptor, lang('listado_editar').' '.lang('subscriptor_url'), array('title'=>lang('listado_editar').' '.lang('subscriptor_url'), 'class' => 'button radius wtc'));
		?>
	</div>
</div>