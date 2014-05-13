<div class="row">
	<div class="twelve columns">
		<?php if(isset($breadcrumbs)): ?><?php echo $breadcrumbs; ?><?php endif; ?>

	    <!-- Formulario Crear restaurante -->
	    <?php
	    	echo validation_errors();
	    	if(isset($error)) echo $error;
	    	$id = (isset($restaurante->id_restaurante) ? $restaurante->id_restaurante : '');
	    ?>
		 <?php echo form_open_multipart('restaurante/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		 
		    <fieldset>
				<div class="row">
					<div class="six columns centered">
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="estado">
					        		<span> <?php echo lang('estado'); ?> </span>
					        	</label>
					        </div>
	
				        	<div class="ten columns">
					        	<select class="custom" id="estado" name="id_estado">
					                        <?php
					                        foreach ($estados as $key => $estado)
					                        {
					                        	$key++;
					                            echo '<option value="' . $estado->id_estado . '" ' . (isset($restaurante->id_estado) && $restaurante->id_estado == $key ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
					                        }
					                        ?>
					            </select>
				        	</div>
						</div>
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('restaurantes_crear_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="ten columns">
					        	<?php
					                        if (set_value('creado')) {
					                            $fecha = set_value('creado');
					                        }
					                        else
					                        {
					                            $fecha = (isset($restaurante->creado) && $restaurante->creado != '' ? date('Y/m/d', mysql_to_unix($restaurante->creado)) : date('Y/m/d'));
					                        }
					             ?>
	
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
						
						<!-- Destacado -->
						<div class="row">
							<div class="two columns">
								<label class="inline" for="destacado">
										<span> <?php echo lang('destacada'); ?> </span>
					            </label>
							</div>
	
					        <div class="ten columns">
					        	<?php if(isset($restaurante)): ?>
					        		<?php echo form_dropdown('destacado', $array_destacado, $restaurante->destacado, 'class="custom select_back" '); ?>
					        	<?php else: ?>
					        		<?php $temp = (isset($restaurante) && !empty($restaurante->destacado)) ? $restaurante->destacado : '' ?>
					        		<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp), 'class="custom select_back" '); ?>
					        	<?php endif; ?>
	
					        </div>
						</div>
						
						<!---------		TIPO	--------->
			        	<div class="row">
							<div class="two columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_tipo'); ?> </span>
								</label>
							</div>
							<div class="ten columns">
								<input type="radio" name="id_tipo_restaurante" value="1" <?php echo (isset($restaurante->id_tipo_restaurante) && $restaurante->id_tipo_restaurante == 1) ? 'checked' : '' ?> > <?php echo lang('restaurantes_tipo1'); ?>
								<input type="radio" name="id_tipo_restaurante" value="2" <?php echo (isset($restaurante->id_tipo_restaurante) && $restaurante->id_tipo_restaurante == 2) ? 'checked' : '' ?> > <?php echo lang('restaurantes_tipo2'); ?>
					        </div>	
						</div>
						
						<!--
						<div class="row">
							<div class="two columns">
								<label class="inline" for="destacado">
										<span> Sección </span>
					            </label>
							</div>
							<div class="ten columns">
					        	<select name="seccion">
					        		<option <?php echo (isset($restaurante->seccion) && ($restaurante->seccion=='regulares')) ? 'selected' : ''; ?> value="regulares">restaurantes regulares</option>
					        		<option <?php echo (isset($restaurante->seccion) && ($restaurante->seccion=='economia')) ? 'selected' : ''; ?> value="economia">restaurantes económicas</option>
					        		<option <?php echo (isset($restaurante->seccion) && ($restaurante->seccion=='ambas')) ? 'selected' : ''; ?> value="ambas">Ambas categorías</option>
					        	</select>
					        </div>
						</div>
						-->
						
			        	<?php echo (isset($restaurante) ? '<input type="hidden" name="id_restaurante" value="' . $restaurante->id_restaurante . '" />' : '') ?>
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($restaurante) ? lang('guardar') : lang('crear')) ?></button>
				        	</div>
				        </div>
				        
		       		</div>
				</div>
		    </fieldset>
		</form>
	</div>
</div>
