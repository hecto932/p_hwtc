

	<div class="row">
		<div class="twelve columns">
				<?php if(isset($breadcrumbs)): ?>
					<?php echo $breadcrumbs; ?>
				<?php endif; ?>

			    <!-- Formulario Crear servicio -->
			    <?php
			    	echo validation_errors();
			    	if (isset($error))
			        echo $error;

			    	$id = (isset($servicio->id_servicio) ? $servicio->id_servicio : '');
			    ?>

			    <?php echo form_open_multipart('servicio/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
			    <fieldset>
					<div class="row">
						<div class="six columns centered">
							<div class="row">
								<div class="three columns">
						        	<label class="inline" for="estado">
						        		<span> <?php echo lang('estado'); ?> </span>
						        	</label>
						        </div>
					        	<div class="nine columns">
						        	<select class="custom" id="estado" name="id_estado">
						                        <?php
						                        foreach (json_decode($estados) as $key => $estado)
						                        {
						                        	$key++;
						                            echo '<option value="' . $estado->id_estado . '" ' . (isset($servicio->id_estado) && $servicio->id_estado == $key ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
						                        }
						                        ?>
						            </select>
					        	</div>
							</div>
							
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
									<?php $temp_destacado = (isset($servicio->destacado) && !empty($servicio->destacado)) ? $servicio->destacado : ''?>
									<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
						        </div>	
							</div>
							
							<!--
							<div class="row">
								<div class="three columns">
									<label class="inline" for="estado">
						        		<span> <?php echo lang('tipo_servicio'); ?> </span>
						        	</label>
								</div>
								<div class="nine columns">
									<?php if(isset($tipo_servicio)): ?>
										<?php if(isset($servicio)): ?>
											<?php echo form_dropdown('id_tipo_servicio', $tipo_servicio, $servicio->id_tipo_servicio, 'class="select_back"'); ?>
										<?php else: ?>
											<?php echo form_dropdown('id_tipo_servicio', $tipo_servicio, '', 'class="select_back"'); ?>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							-->
							
					        <?php echo (isset($servicio) ? '<input type="hidden" name="id_servicio" value="' . $servicio->id_servicio . '" />' : '') ?>
		
					        <div class="row">
					        	<div class="twelve columns alinear-derecha">
					        		<button type="submit" class="button radius wtc"><?php echo (isset($servicio) ? lang('guardar') : lang('crear')) ?></button>
					        	</div>
					        </div>
						</div>
					</div>
			   	</fieldset>
			</form>
			<!-- Formulario Formulario Crear servicio cierre -->
		</div>
	</div>
