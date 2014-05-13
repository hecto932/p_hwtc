<h3><?php echo lang('ficha_datos'); ?></h3>

	<div class="ficha_categoria">
		<?php $estado = json_decode(modules::run('services/relations/get_from_id','estado',$categoria->id_estado,'true')); ?>
		<table style="border: 0px; padding: 3px 3px;">
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_estado'); ?>:</strong></td>
				<td><?php echo ucfirst($estado->estado); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo lang('listado_fecha'); ?>:</strong></td>
				<td><?php echo date('d/m/Y',mysql_to_unix($categoria->creado)); ?></td>
			</tr>
			<tr>
				<td><i class="foundicon-website"></i> <strong><?php echo 'Categoría padre'; ?>:</strong></td>
				<td><?php echo (isset($categoria_path)) ? $categoria_path : 'Raíz'; ?></td>
			</tr>
		</table>
	</div>
	
<div class="row">
	<div class="twelve columns">
		<?php
			if($this->session->userdata('idioma') == 'es')
				echo anchor(lang('backend_url').'/'.lang('categorias_url').'/'.lang('editar_url').'_'.lang('categoria_url').'/'.$categoria->id_categoria, lang('listado_editar').' '.lang('categoria_url'), array('title'=>lang('listado_editar').' '.lang('categoria_url'), 'class' => 'button radius wtc pbutton'));
			else
				echo anchor(lang('backend_url').'/'.lang('categorias_url').'/'.lang('editar_url').'_'.lang('articulo_url').'/'.$categoria->id_categoria, lang('listado_editar').' '.lang('categoria_url'), array('title'=>lang('listado_editar').' '.lang('categoria_url'), 'class' => 'button radius wtc pbutton'));
		?>
	</div>
</div>