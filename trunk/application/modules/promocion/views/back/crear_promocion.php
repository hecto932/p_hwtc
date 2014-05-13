<div class="row">
	<div class="twelve columns">
		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

	    <!-- Formulario Crear promocion -->
	    <?php
	    	echo validation_errors();
	    	if (isset($error))
	        echo $error;

	    	$id = (isset($promocion->id_promocion) ? $promocion->id_promocion : '');
	    ?>

	    <?php echo form_open_multipart('promocion/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		    <fieldset>
				<div class="row">
					<div class="six columns centered">
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="estado">
					        		<span> <?php echo lang('listado_estado'); ?> </span>
					        	</label>
					        </div>
	
				        	<div class="ten columns">
					        	<select class="custom" id="estado" name="id_estado">
					                        <?php
					                        foreach (json_decode($estados) as $estado)
					                        {
					                        	$key++;
					                            echo '<option value="' . $estado->id_estado . '" ' . (isset($promocion->id_estado) && $promocion->id_estado == $key ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
					                        }
					                        ?>
					            </select>
				        	</div>
						</div>
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('listado_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="ten columns">
					        	<?php
					                        if (set_value('creado')) {
					                            $fecha = set_value('creado');
					                        }
					                        else
					                        {
					                            $fecha = (isset($promocion->creado) && $promocion->creado != '' ? date('Y/m/d', mysql_to_unix($promocion->creado)) : date('Y/m/d'));
					                        }
					             ?>
	
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
						
						<!---------		DESTACADO	--------->
			        	<div class="row">
							<div class="two mobile-one columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_destacado'); ?> </span>
								</label>
							</div>
							<div class="ten mobile-three columns">
								<?php $temp_destacado = (isset($promocion->destacado) && !empty($promocion->destacado)) ? $promocion->destacado : ''?>
								<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
					        </div>	
						</div>
						
						<!---------		TIPO	--------->
			        	<div class="row">
							<div class="two mobile-one columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_tipo'); ?> </span>
								</label>
							</div>
							<div class="ten mobile-three columns">
								<input type="radio" name="id_tipo_promocion" value="1" <?php echo (isset($promocion->id_tipo_promocion) && $promocion->id_tipo_promocion == 1) ? 'checked' : '' ?> > <?php echo lang('promocion_tipo1'); ?>
								<input type="radio" name="id_tipo_promocion" value="2" <?php echo (isset($promocion->id_tipo_promocion) && $promocion->id_tipo_promocion == 2) ? 'checked' : '' ?> > <?php echo lang('promocion_tipo2'); ?>
					        </div>	
						</div>
						
			        	<?php echo (isset($promocion) ? '<input type="hidden" name="id_promocion" value="' . $promocion->id_promocion . '" />' : '') ?>
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($promocion) ? lang('listado_guardar') : lang('listado_crear')) ?></button>
				        	</div>
				        </div>
			       </div>
				</div>
	    	</fieldset>
		</form>
		<!-- Formulario Formulario Crear promocion cierre -->
	</div>
</div>