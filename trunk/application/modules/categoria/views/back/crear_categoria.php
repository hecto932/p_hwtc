<script type="text/javascript">
	
	$(document).ready(function()
	{
		$('.togg').click(function(togg)
		{
			$(this).siblings('ul').toggle();
			$(this).siblings('ul').is(":hidden") ? $(this).html('+') : $(this).html('-');
		});
		
	});
	
</script>

<div class="row">
	<div class="twelve columns">
		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

	    <!-- Formulario Crear categoria -->
	    <?php
	    	echo validation_errors();
	    	if (isset($error))
	        echo $error;

	    	$id = (isset($categoria->id_categoria) ? $categoria->id_categoria : '');
	    ?>

	    <?php echo form_open_multipart('categoria/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		    <fieldset>
				<div class="row">
					<div class="seven columns centered">
						
						<!-- Estado -->
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
					                            echo '<option value="' . $estado->id_estado . '" ' . (isset($categoria->id_estado) && $categoria->id_estado == $key ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
					                        }
					                        ?>
					            </select>
				        	</div>
						</div>
						
						<div class="row">
							
							<div class="three columns">
					        	<label class="inline" for="categoria">
					        		<span> <?php echo "Categoría padre"; ?> </span>
					        	</label>
					        </div>
					        
					        <div class="nine columns">
								<!-- Arbol de categorias -->
								<?php echo $arbol_categorias;?>
							</div>
						</div>
						
						<!-- Fecha de creacion de la categoria -->
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
					                            $fecha = (isset($categoria->creado) && $categoria->creado != '' ? date('Y/m/d', mysql_to_unix($categoria->creado)) : date('Y/m/d'));
					                        }
					             ?>
	
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
			        	<?php echo (isset($categoria) ? '<input type="hidden" name="id_categoria" value="' . $categoria->id_categoria . '" />' : '') ?>
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($categoria) ? lang('listado_guardar') : lang('listado_crear')) ?></button>
				        	</div>
				        </div>
			       </div>
				</div>
	    	</fieldset>
		</form>
		<!-- Formulario Formulario Crear categoria cierre -->
	</div>
</div>
