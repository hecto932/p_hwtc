<!-- jquery de caracteristicas de productos -->
<!--
<script type="text/javascript">

	/*
	$(document).ready(function()
	{
		//Agregar una caracteristica
		$('#plus').click(function()
		{
		    var i = $('#caracts .countInput').length;
		    
		    $('#caracts').append
		    (
		    	'<div id="caract_'+i+'" class="twelve columns" >'+
		    		'<div class="ten mobile-three columns">'+
						'<input name="caract[]" type="text" class="countInput" />'+
			  		'</div>'+
			  		'<div class="one mobile-one columns">'+
			  			'<a class="button expand postfix" onclick="agregarsub(this)"> + </a>'+
			  		'</div>'+
			  		'<div class="one mobile-one columns">'+
			  			'<a class="button expand postfix" onclick="eliminar(this)" > - </a>'+
			  		'</div>'+
			  	'</div>'
		    );
			
		});
		
	});
	
	//Eliminar una caracteristica o sub-carateristica
	function eliminar(removecat)
	{
		var idCarat = $(removecat).parent().parent().attr("id");
		$('#'+idCarat).remove();
	}
	
	//Agregar una sub-caracteristica
	function agregarsub(addsub)
	{
		var idCarat 	= $(addsub).parent().parent().attr("id");
		var split_id 	= idCarat.split("_");
		var i 			= split_id[1];
		
		//<input name="'+i+'_subcaract[]" type="text" class="countsubInput" />
		
		$('#'+idCarat).append
		(
			'<div id="subcaract_'+i+'" >'+
	    		'<div class="nine mobile-three columns">'+
					'<input name="caract[][]" type="text" class="countsubInput" />'+
		  		'</div>'+
		  		'<div class="one mobile-one columns pull-two">'+
		  			'<a class="button expand postfix" onclick="eliminar(this)" > - </a>'+
		  		'</div>'+
			'</div>'
		);
	}
	*/
</script>
-->

<!-- Formulario Nuevo Idioma galeria -->

<?php echo form_open(lang('backend_url').'/'.lang('galerias_url').'/'.lang('guardar_url').'_'.lang('idioma_url'),'id="gen_form" class="custom"'); ?>
<br />
<?php /*--------------------------------- NOMBRE ---------------------------------*/ ?>
	<div class="six columns">
		<label for="nombre"  <?php echo (form_error('nombre') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_nombre'); ?> * </span> <?php echo (form_error('nombre') != '') ? '('.form_error('nombre', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($galeria->nombre)) ? $galeria->nombre : ''; ?>
		<input class='<?php echo (form_error("nombre") != "") ? "error" : "" ; ?>' name="nombre" type="text" value="<?php echo idioma_values(set_value('nombre'), $temp, $accion); ?>" />
	</div>
	
<?php /*--------------------------------- IDIOMA ---------------------------------*/ ?>
	<div class="six columns">
			<?php $idioma_select = json_decode(modules::run('services/relations/get_all','idioma','true')); ?>
			<label><span> <?php echo lang('listado_idioma'); ?> </span></label>
			<select class="custom lenguaje_productos"  name="id_idioma">
				<?php foreach($idioma_select as $im): ?>
					<option value="<?php echo $im->id_idioma; ?>"<?php

					if (set_select('id_idioma',$im->id_idioma)!='')
						echo set_select('id_idioma',$im->id_idioma);
					elseif ($accion != 'normal')
						echo ((isset($galeria->id_idioma) && $galeria->id_idioma==$im->id_idioma) ? ' selected="selected"' : '')?>><?php echo ucfirst($im->nombre); ?></option>
				<?php endforeach; ?>
			</select>
	</div>
	
<?php /*--------------------------------- TITULO_PAGINA ---------------------------------*/ ?>
	<div class="six columns">
		<label for="titulo_pagina" <?php echo (form_error('titulo_pagina') != '') ? 'class="error"' : '' ; ?>>
        	<span> <?php echo lang('listado_tit_page'); ?> *</span> <?php echo (form_error('titulo_pagina') != '') ? '('.form_error('titulo_pagina', '<span>', '</span>').')' : '' ; ?>
        </label>
        <?php $temp = (isset($galeria->titulo_pagina)) ? $galeria->titulo_pagina : ''; ?>
        <input class='<?php echo (form_error("titulo_pagina") != "") ? "error" : "" ; ?>' name="titulo_pagina" type="text" value="<?php echo idioma_values(set_value('titulo_pagina'), $temp, $accion); ?>" />
	</div>
	
<?php /*--------------------------------- KEYWORDS ---------------------------------*/ ?>
	<div class="six columns">
		<label for="keywords" <?php echo (form_error('keywords') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_keywords'); ?> *</span> <?php echo (form_error('keywords') != '') ? '('.form_error('keywords', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($galeria->keywords)) ? $galeria->keywords : ''; ?>
		<input class="<?php echo (form_error("keywords") != "") ? "error" : "" ; ?>" name="keywords" type="text" value="<?php echo idioma_values(set_value('keywords'), $temp, $accion); ?>"/>
	</div>
	
<?php /*--------------------------------- DESCRIPCION_PAGINA ---------------------------------*/ ?>
	<div class="twelve columns">
		<label for="descripcion_pagina" <?php echo (form_error('descripcion_pagina') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_desc_page'); ?> *</span> <?php echo (form_error('descripcion_pagina') != '') ? '('.form_error('descripcion_pagina', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($galeria->descripcion_pagina)) ? $galeria->descripcion_pagina : ''; ?>
		<input type="text" class='<?php echo (form_error("descripcion_pagina") != "") ? "error" : "" ; ?>' name="descripcion_pagina" rows="10" cols="50" value="<?php echo idioma_values(set_value('descripcion_pagina'), $temp, $accion); ?>" />
	</div>
	
<?php /*--------------------------------- PRESENTACION ---------------------------------*/ ?>
	<!--
	<div class="twelve columns">
		<label for="presentacion" <?php echo (form_error('presentacion') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo "Presentación"; ?></span> <?php echo (form_error('presentacion') != '') ? '('.form_error('presentacion', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($galeria->presentacion)) ? $galeria->presentacion : ''; ?>
		<input type="text" class='<?php echo (form_error("presentacion") != "") ? "error" : "" ; ?>' name="presentacion" rows="10" cols="50" value="<?php echo idioma_values(set_value('presentacion'), $temp, $accion); ?>" />
	</div>
	-->
	
<?php /*--------------------------------- URL ---------------------------------*/ ?>
	<div class="twelve columns">
		<label for="url" <?php echo (form_error('url') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_url_tit'); ?> *</span> <?php echo (form_error('url') != '') ? '('.form_error('url', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($galeria->url)) ? $galeria->url : ''; ?>
		<input class="<?php echo (form_error("url") != "") ? "error" : "" ; ?>" name="url" type="text" value="<?php echo idioma_values(set_value('url'), $temp, $accion) ;?>" />
	</div>
	
<?php /*--------------------------------- DESCRIPCION_BREVE ---------------------------------*/ ?>
	<div class="twelve columns">
		<label for="descripcion_breve" <?php echo (form_error('descripcion_breve') != '') ? 'class="error"' : '' ; ?>>
        		<span> <?php echo lang('listado_desc_breve'); ?> *</span> <?php echo (form_error('descripcion_breve') != '') ? '('.form_error('descripcion_breve', '<span>', '</span>').')' : '' ; ?>
        </label>
        <?php $temp = (isset($categoria->descripcion_breve)) ? $categoria->descripcion_breve : ''; ?><textarea class='<?php echo (form_error("descripcion_breve") != "") ? "error" : "" ; ?>' name="descripcion_breve" rows="3" cols="50"><?php echo idioma_values(set_value('descripcion_breve'), $temp, $accion); ?></textarea><p style="text-align: right;" id='contador_descbreve'><span class="" id="actual_breve">0</span> <?php echo lang('caracteres_de'); ?> <span>200 </span><?php echo lang('caracteres'); ?></p>
	</div>

<?php /*--------------------------------- TITULO1 ---------------------------------*/ ?>
	<!--
	<?php /*
	<div class="twelve columns">
		<label for="titulo"  <?php echo (form_error('titulo') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_titulo'); ?> * </span> <?php echo (form_error('titulo') != '') ? '('.form_error('titulo', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($producto->titulo)) ? $producto->titulo : ''; ?>
		<input class='<?php echo (form_error("titulo") != "") ? "error" : "" ; ?>' name="titulo" type="text" value="<?php echo idioma_values(set_value('titulo'), $temp, $accion); ?>" />
	</div>
	*/ ?>
	-->
<?php /*--------------------------------- DESCRIPCION_AMPLIADA1 ---------------------------------*/ ?>
	
	<div class="twelve columns">
		<label for="descripcion_ampliada">
			<span> <?php echo lang('listado_descripcion'); ?> *</span>
		</label>
		<?php if(form_error('descripcion_ampliada') != ''): ?>
			<div class="alert-box alert">
				<?php echo form_error('descripcion_ampliada'); ?>
				<a class="close" href="">×</a>
			</div>
		<?php endif; ?>
		<?php $temp = (isset($categoria->descripcion_ampliada)) ? $categoria->descripcion_ampliada : ''; ?>
		<textarea class="ckeditor" id="descripcion_ampliada" name="descripcion_ampliada"><?php echo idioma_values(set_value('descripcion_ampliada'), $temp, $accion); ?></textarea>
	</div>
	
<!--
<?php /*
<?php /*--------------------------------- TITULO2 ---------------------------------*/ ?>
	<div class="six columns">
		<label for="titulo2"  <?php echo (form_error('titulo2') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_titulo'); ?> 2 * </span> <?php echo (form_error('titulo2') != '') ? '('.form_error('titulo2', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($producto->titulo2)) ? $producto->titulo2 : ''; ?>
		<input class='<?php echo (form_error("titulo2") != "") ? "error" : "" ; ?>' name="titulo2" type="text" value="<?php echo idioma_values(set_value('titulo2'), $temp, $accion); ?>" />

<?php /*--------------------------------- DESCRIPCION_AMPLIADA2 ---------------------------------*/ ?>
		<label for="descripcion_ampliada2">
			<span> <?php echo lang('listado_descripcion'); ?> 2 *</span>
		</label>
		<?php if(form_error('descripcion_ampliada2') != ''): ?>
			<div class="alert-box alert">
				<?php echo form_error('descripcion_ampliada2'); ?>
				<a class="close" href="">×</a>
			</div>
		<?php endif; ?>
		<?php $temp = (isset($categoria->descripcion_ampliada2)) ? $categoria->descripcion_ampliada2 : ''; ?>
		<textarea class="ckeditor" id="descripcion_ampliada2" name="descripcion_ampliada2">
			<?php echo idioma_values(set_value('descripcion_ampliada2'), $temp, $accion); ?>
		</textarea>
	</div>
	
<?php /*--------------------------------- TITULO3 ---------------------------------*/ ?>
	<div class="six columns">

		<label for="titulo3"  <?php echo (form_error('titulo3') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_titulo'); ?> 3 * </span> <?php echo (form_error('titulo3') != '') ? '('.form_error('titulo3', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($producto->titulo3)) ? $producto->titulo3 : ''; ?>
		<input class='<?php echo (form_error("titulo3") != "") ? "error" : "" ; ?>' name="titulo3" type="text" value="<?php echo idioma_values(set_value('titulo3'), $temp, $accion); ?>" />

<?php /*--------------------------------- DESCRIPCION_AMPLIADA3 ---------------------------------*/ ?>
		<label for="descripcion_ampliada3">
			<span> <?php echo lang('listado_descripcion'); ?> 3 *</span>
		</label>
		<?php if(form_error('descripcion_ampliada3') != ''): ?>
			<div class="alert-box alert">
				<?php echo form_error('descripcion_ampliada3'); ?>
				<a class="close" href="">×</a>
			</div>
		<?php endif; ?>
		<?php $temp = (isset($categoria->descripcion_ampliada3)) ? $categoria->descripcion_ampliada3 : ''; ?>
		<textarea class="ckeditor" id="descripcion_ampliada3" name="descripcion_ampliada3">
			<?php echo idioma_values(set_value('descripcion_ampliada3'), $temp, $accion); ?>
		</textarea>
	</div>
	
<?php /*--------------------------------- TITULO4 ---------------------------------*/ ?>
	<div class="six columns">

		<label for="titulo4"  <?php echo (form_error('titulo4') != '') ? 'class="error"' : '' ; ?>>
			<span> <?php echo lang('listado_titulo'); ?> 4 * </span> <?php echo (form_error('titulo4') != '') ? '('.form_error('titulo4', '<span>', '</span>').')' : '' ; ?>
		</label>
		<?php $temp = (isset($producto->titulo4)) ? $producto->titulo4 : ''; ?>
		<input class='<?php echo (form_error("titulo4") != "") ? "error" : "" ; ?>' name="titulo4" type="text" value="<?php echo idioma_values(set_value('titulo'), $temp, $accion); ?>" />

<?php /*--------------------------------- DESCRIPCION_AMPLIADA4 ---------------------------------*/ ?>
		<label for="descripcion_ampliada4">
			<span> <?php echo lang('listado_descripcion'); ?> 4 *</span>
		</label>
		<?php if(form_error('descripcion_ampliada4') != ''): ?>
			<div class="alert-box alert">
				<?php echo form_error('descripcion_ampliada4'); ?>
				<a class="close" href="">×</a>
			</div>
		<?php endif; ?>
		<?php $temp = (isset($categoria->descripcion_ampliada4)) ? $categoria->descripcion_ampliada4 : ''; ?>
		<textarea class="ckeditor" id="descripcion_ampliada4" name="descripcion_ampliada4">
			<?php echo idioma_values(set_value('descripcion_ampliada4'), $temp, $accion); ?>
		</textarea>
	</div>
	*/ ?>
	-->
<?php /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>

<?php /*--------------------------------- CARACTERISTICAS ---------------------------------*/ ?>
	
	<?php /*
	<div class="twelve columns" style="padding-bottom: 20px; padding-top: 20px;">
		
		<label for="caracteristicas">
			<span><?php echo "Características"; ?>:</span>
		</label>

		<input type="button" class="one mobile-four column small button" id="plus" value="Agregar" />
		
	</div>
	
	<!-- Este div se llena con jquery al presionar el boton agregar.
		El respectivo script esta al principio de esta vista -->
	<div id="caracts">
		
		<!-- Llenar manualmente cuando haya algun error de formulario o se esté editando un producto con caracteristicas definidas -->
		<?php if(isset($caracteristicas)): ?>
		<?php foreach($caracteristicas as $key => $value): ?>

			<!-- $value es un vector que en la posicion 0 tiene la caracteristica -->
			<div id="caract_<?php echo $key?>" class="twelve columns">
			
				<!-- Caracteristica -->
				<div class="ten mobile-three columns">
					<input class="countInput" type="text" name="caract[]" value="<?php echo $value[0]; ?>">
				</div>
				
				<!-- Botones de caracteristica -->
				<div class="one mobile-one columns"><a class="button expand postfix" onclick="agregarsub(this)"> + </a></div>
				<div class="one mobile-one columns"><a class="button expand postfix" onclick="eliminar(this)"> - </a></div>
				
				<!-- Quitar la caracteristica, dejando solo las subcaracteristicas -->
				<?php $caracteristica = array_shift($value); ?>
				
				<!-- Por cada sub-caracteristica... -->
				<?php if(!empty($value)): ?>
				<?php foreach($value as $subkey => $subcaract): ?>
					
					<div id="subcaract_<?php echo $subkey; ?>" >
						
						<!-- Sub-caracteristica -->
						<div class="nine mobile-three columns">
							<input class="countsubInput" type="text" name="caract[][]" value="<?php echo $subcaract; ?>" >
						</div>
						
						<!-- Boton Sub-caracteristica -->
						<div class="one mobile-one columns pull-two"><a class="button expand postfix" onclick="eliminar(this)"> - </a></div>
						
					</div>
					
				<?php endforeach; ?>
				<?php endif; ?>
				
			</div>
			
		<?php endforeach; ?>
		<?php endif; ?>
		
	</div>
	*/ ?>
	
	<input type="hidden" name="id_galeria" value="<?php echo (isset($id_galeria)) ? $id_galeria : $galeria->id_galeria; ?>" />
	<?php if (isset($galeria->id_detalle_galeria) || $accion != 'normal'): ?>

		<input type="hidden" name="id_detalle_galeria" value="<?php echo $galeria->id_detalle_galeria ?>" />
       	<?php //echo '<input type="hidden" name="id_idioma" value="'.$galeria->id_idioma.'" />'; ?>

	<?php endif; ?>
	<div class="row">
		<div class="twelve columns area_botns">
			<button type="submit" class="button radius wtc"> <?php echo ($accion == 'editar') ? lang('listado_guardar').' '.lang('idioma_url') : lang('listado_crear').' '.lang('idioma_url'); ?> </button>
		</div>
	</div>

	<?php echo form_hidden('accion', $accion); ?>
</form>
<!-- Formulario Formulario Nuevo Idioma galeria cierre -->
