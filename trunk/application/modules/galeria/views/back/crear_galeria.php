
<script type="text/javascript">
	
	$(document).ready(function()
	{
		//Toggle categorias
		$('.togg').click(function(togg)
		{
			$(this).siblings('ul').toggle();
			$(this).siblings('ul').is(":hidden") ? $(this).html('+') : $(this).html('-');
		});
		
		//Chosen
		$('#galerias_relacionados').chosen({placeholder_text_multiple: "Seleccionar galerias", width: "100%"});
		
		//Height inicial del input para buscar galerias
		$('#div_galerias_relacionados').find('.search-field').children('input').css('height', '25px');
	});
	
</script>
<?php //die_pre($galeria); ?>
<div class="row">
	<div class="twelve columns">
		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

	    <!-- Formulario Crear galeria -->
	    <?php
	    	echo validation_errors();
	    	if (isset($error))
	        echo $error;

	    	$id = (isset($galeria->id_galeria) ? $galeria->id_galeria : '');
	    ?>
	    
		<?php //echo form_open_multipart('galeria/create/' . $id, array('id' => "gen_form")) ?>
	    <?php echo form_open_multipart('galeria/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		    <fieldset>
				<div class="row">
					<div class="ten columns centered">
<!---------		EAN		--------->
						<!--
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_ean'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					             <input id="ean" name="ean" type="text" value="<?php echo (isset($galeria->ean) && !empty($producto->ean)) ? $producto->ean : ''; ?>" required /></td>
					        </div>
						</div>
						-->
<!---------		CODIGO		--------->
						<!--
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_codigo'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					             <input id="codigo_coloplas" name="codigo_coloplas" type="text" value="<?php echo (isset($producto->codigo_coloplas) && !empty($producto->codigo_coloplas)) ? $producto->codigo_coloplas : ''; ?>" required /></td>
					        </div>
						</div>
						-->
<!---------		CATEGORIA		
						
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="categoria">
					        		<span> <?php echo lang('listado_categoria'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
								<?php echo $arbol_categorias;?>
					        </div>
						</div> --------->
						
<!---------		ESTADO		--------->
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="estado">
					        		<span> <?php echo lang('listado_estado'); ?> </span>
					        	</label>
					        </div>
				        	<div class="nine columns">
					        	<select class="custom" id="estado" name="id_estado">
					                        <?php
					                        foreach (json_decode($estados) as $key => $estado)
					                        {
					                        	$key++;
					                            echo '<option value="' . $estado->id_estado . '" ' . ((isset($galeria->id_estado) && $galeria->id_estado == $key) ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucfirst($estado->estado) . '</option>';
					                        }
					                        ?>
					            </select>
				        	</div>
						</div>
<!---------		FECHA		--------->
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					        	<?php
					                        if (set_value('creado')) {
					                            $fecha = set_value('creado');
					                        }
					                        else
					                        {
					                            $fecha = (isset($galeria->creado) && $galeria->creado != '' ? date('Y/m/d', mysql_to_unix($galeria->creado)) : date('Y/m/d'));
					                        }
					             ?>
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
			        	<?php echo (isset($galeria) ? '<input type="hidden" name="id_galeria" value="' . $galeria->id_galeria . '" />' : '') ?>
<!---------		DESTACADO		--------->
			        	<div class="row">
							<div class="three mobile-one columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_destacado'); ?> </span>
								</label>
							</div>
							<!--
							<div class="ten mobile-three columns">
								<input id="destacado" name="destacado" type="checkbox" value="" /><span class="custom checkbox"></span>
							</div>
							-->
							<div class="nine mobile-three columns">
								<?php $temp_destacado = (isset($galeria->destacado) && !empty($galeria->destacado)) ? $galeria->destacado : ''?>
								<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
					        </div>	
						</div>
<!---------		PRODUCTOS RELACIONADOS		--------->

						<!-- Productos Relacionados 
						<div class="row" id="div_productos_relacionados">
							<div class="three columns">
								<label class="inline" for="destacado">
									<span> <?php echo "Productos Relacionados"; ?> </span>
								</label>
							</div>
							<div class="nine columns">
								<?php echo form_dropdown('productos_relacionados[]', $opt_producto, set_value('productos_relacionados[]', ( isset($seleted_relacionados) ? $seleted_relacionados : 0) ), 'data-customforms="disabled" multiple="multiple" id="productos_relacionados" style="width:300px; height:100px;" '); ?>
							</div>
						</div>
						-->
<!---------		SUBMIT		--------->
						<br />
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($galeria) ? lang('listado_guardar') : lang('listado_crear')) ?></button>
				        	</div>
				        </div>
			       </div>
				</div>
	    	</fieldset>
		</form>
		<!-- Formulario Formulario Crear galeria cierre -->
	</div>
</div>
