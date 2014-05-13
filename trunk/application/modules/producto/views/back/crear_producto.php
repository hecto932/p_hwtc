
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
		$('#productos_relacionados').chosen({placeholder_text_multiple: "Seleccionar productos", width: "100%"});
		
		//Height inicial del input para buscar productos
		$('#div_productos_relacionados').find('.search-field').children('input').css('height', '25px');
	});
	
</script>

<div class="row">
	<div class="twelve columns">
		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

	    <!-- Formulario Crear producto -->
	    <?php
	    	echo validation_errors();
	    	if (isset($error))
	        echo $error;

	    	$id = (isset($producto->id_producto) ? $producto->id_producto : '');
	    ?>
	    
		<?php //echo form_open_multipart('producto/create/' . $id, array('id' => "gen_form")) ?>
	    <?php echo form_open_multipart('producto/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		    <fieldset>
				<div class="row">
					<div class="ten columns centered">
<!---------		EAN		
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_ean'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					             <input id="ean" name="ean" type="text" value="<?php echo (isset($producto->ean) && !empty($producto->ean)) ? $producto->ean : ''; ?>" required /></td>
					        </div>
						</div>
--------->

<!---------		CODIGO		--------->
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
<!---------		CATEGORIA		--------->

						<!-- 
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_categoria'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="ten columns">
					             <select name="id_categoria">
					             	<?php foreach($categorias as $key => $categoria) : ?>
					             		<?php $key++; ?>
					             		<option <?php echo ($categoria->id_categoria==$key)? 'selected' : ''; ?> value="<?php echo $categoria->id_categoria; ?>"><?php echo ucfirst($categoria->nombre); ?></option>
					             	<?php endforeach; ?>
					             </select>
					        </div>
						</div>
						-->
						
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="categoria">
					        		<span> <?php echo lang('listado_categoria'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					             <!-- Arbol de categorias -->
								<?php echo $arbol_categorias;?>
					        </div>
						</div>
						
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
					                            echo '<option value="' . $estado->id_estado . '" ' . ((isset($producto->id_estado) && $producto->id_estado == $key) ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucfirst($estado->estado) . '</option>';
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
					                            $fecha = (isset($producto->creado) && $producto->creado != '' ? date('Y/m/d', mysql_to_unix($producto->creado)) : date('Y/m/d'));
					                        }
					             ?>
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
			        	<?php echo (isset($producto) ? '<input type="hidden" name="id_producto" value="' . $producto->id_producto . '" />' : '') ?>
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
								<?php $temp_destacado = (isset($producto->destacado) && !empty($producto->destacado)) ? $producto->destacado : ''?>
								<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
					        </div>	
						</div>
<!---------		PRODUCTOS RELACIONADOS		--------->

						<!-- Productos Relacionados -->
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

<!---------		SUBMIT		--------->
						<br />
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($producto) ? lang('listado_guardar') : lang('listado_crear')) ?></button>
				        	</div>
				        </div>
			       </div>
				</div>
	    	</fieldset>
		</form>
		<!-- Formulario Formulario Crear producto cierre -->
	</div>
</div>
