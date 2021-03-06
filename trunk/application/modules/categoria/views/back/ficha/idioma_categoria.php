<!-- Formulario Nuevo Idioma categoria -->

<?php echo form_open(lang('backend_url').'/'.lang('categorias_url').'/'.lang('guardar_url').'_'.lang('idioma_url'),'id="gen_form" class="custom"'); ?>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<div class="six columns">
		<label for="nombre"  <?php echo (form_error('nombre') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_nombre'); ?> * </span> <?php echo (form_error('nombre') != '') ? '('.form_error('nombre', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($categoria->nombre)) ? $categoria->nombre : ''; ?>
		<input class='<?php echo (form_error("nombre") != "") ? "error" : "" ; ?>' name="nombre" type="text" value="<?php echo idioma_values(set_value('nombre'), $temp, $accion); ?>" />
	</div>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<div class="six columns">
		<?php $idioma_select = json_decode(modules::run('services/relations/get_all','idioma','true')); ?>
		<label>
			<span> <?php echo lang('listado_idioma'); ?> </span>
		</label>

		<select class="custom lenguaje_categorias"  name="id_idioma">
			<?php foreach($idioma_select as $im): ?>
				<option value="<?php echo $im->id_idioma; ?>"<?php

				if (set_select('id_idioma',$im->id_idioma)!='')
					echo set_select('id_idioma',$im->id_idioma);
				elseif ($accion != 'normal')
					echo ((isset($categoria->id_idioma) && $categoria->id_idioma==$im->id_idioma) ? ' selected="selected"' : '')?>><?php echo ucfirst($im->nombre); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="six columns">
		<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

		<label for="keywords" <?php echo (form_error('keywords') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_keywords'); ?> *</span> <?php echo (form_error('keywords') != '') ? '('.form_error('keywords', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($categoria->keywords)) ? $categoria->keywords : ''; ?>
		<input class="<?php echo (form_error("keywords") != "") ? "error" : "" ; ?>" name="keywords" type="text" value="<?php echo idioma_values(set_value('keywords'), $temp, $accion); ?>"/>

	</div>
	<div class="six columns">
		<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>


		<label for="url" <?php echo (form_error('url') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_url_tit'); ?> *</span> <?php echo (form_error('url') != '') ? '('.form_error('url', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($categoria->url)) ? $categoria->url : ''; ?>
		<input class="<?php echo (form_error("url") != "") ? "error" : "" ; ?>" name="url" type="text" value="<?php echo idioma_values(set_value('url'), $temp, $accion) ;?>" />

	</div>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<div class="twelve columns">
		<label for="titulo_pagina" <?php echo (form_error('titulo_pagina') != '') ? 'class="error"' : '' ; ?>>
        		<span> <?php echo lang('listado_tit_page'); ?> *</span> <?php echo (form_error('titulo_pagina') != '') ? '('.form_error('titulo_pagina', '<span>', '</span>').')' : '' ; ?>
        </label>
        <?php $temp = (isset($categoria->titulo_pagina)) ? $categoria->titulo_pagina : ''; ?>
        <input class='<?php echo (form_error("titulo_pagina") != "") ? "error" : "" ; ?>' name="titulo_pagina" type="text" value="<?php echo idioma_values(set_value('titulo_pagina'), $temp, $accion); ?>" />
	</div>
	<div class="twelve columns">
		<label for="descripcion_pagina" <?php echo (form_error('descripcion_pagina') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_desc_page'); ?> *</span> <?php echo (form_error('descripcion_pagina') != '') ? '('.form_error('descripcion_pagina', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($categoria->descripcion_pagina)) ? $categoria->descripcion_pagina : ''; ?>
		<input type="text" class='<?php echo (form_error("descripcion_pagina") != "") ? "error" : "" ; ?>' name="descripcion_pagina" rows="10" cols="50" value="<?php echo idioma_values(set_value('descripcion_pagina'), $temp, $accion); ?>" />
	</div>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<div class="twelve columns">
		<label for="descripcion_breve" <?php echo (form_error('descripcion_breve') != '') ? 'class="error"' : '' ; ?>>
        		<span> <?php echo lang('listado_desc_breve'); ?> *</span> <?php echo (form_error('descripcion_breve') != '') ? '('.form_error('descripcion_breve', '<span>', '</span>').')' : '' ; ?>
        </label>
        <?php $temp = (isset($categoria->descripcion_breve)) ? $categoria->descripcion_breve : ''; ?>
		<textarea class='<?php echo (form_error("descripcion_breve") != "") ? "error" : "" ; ?>' name="descripcion_breve" rows="3" cols="50">
			<?php echo idioma_values(set_value('descripcion_breve'), $temp, $accion); ?>
		</textarea>
		<p style="text-align: right;" id='contador_descbreve'><span class="" id="actual_breve">0</span> <?php echo lang('caracteres_de'); ?> <span>200 </span><?php echo lang('caracteres'); ?></p>
	</div>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<div class="twelve columns">

		<label for="descripcion_ampliada">
			<span> <?php echo lang('listado_desc_amp'); ?> </span>
		</label>
		<?php if(form_error('descripcion_ampliada') != ''): ?>
			<div class="alert-box alert">
				<?php echo form_error('descripcion_ampliada'); ?>
				<a class="close" href="">×</a>

			</div>
		<?php endif; ?>
		<?php $temp = (isset($categoria->descripcion_ampliada)) ? $categoria->descripcion_ampliada : ''; ?>
		<textarea class="ckeditor" id="descripcion_ampliada" name="descripcion_ampliada" rows="10" cols="50">
			<?php echo idioma_values(set_value('descripcion_ampliada'), $temp, $accion); ?>
		</textarea>

	</div>

	<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

	<input type="hidden" name="id_categoria" value="<?php echo (isset($id_categoria)) ? $id_categoria : $categoria->id_categoria; ?>" />
	<?php if (isset($categoria->id_detalle_categoria) || $accion != 'normal'): ?>

		<input type="hidden" name="id_detalle_categoria" value="<?php echo $categoria->id_detalle_categoria ?>" />
       	<?php //echo '<input type="hidden" name="id_idioma" value="'.$categoria->id_idioma.'" />'; ?>

	<?php endif; ?>
	<div class="row">
		<div class="twelve columns area_botns">
			<button type="submit" class="button radius wtc"> <?php echo ($accion == 'editar') ? lang('listado_guardar').' '.lang('idioma_url') : lang('listado_crear').' '.lang('idioma_url'); ?> </button>
		</div>
	</div>

	<?php echo form_hidden('accion', $accion); ?>
</form>
<!-- Formulario Formulario Nuevo Idioma categoria cierre -->
