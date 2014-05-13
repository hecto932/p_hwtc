<script type="text/javascript">
	$(document).ready(function()
	{
		var fecha_evento = $('.fecha_evento');
		
		fecha_evento.datetimepicker(
		{
			timeFormat: 'HH:mm',
			dateFormat: "<?php echo lang('datapicker_formato_reserva');?>",
			dayNamesMin: ["<?php echo lang('datapicker_dia_domingo_abr');?>", "<?php echo lang('datapicker_dia_lunes_abr');?>", "<?php echo lang('datapicker_dia_martes_abr');?>", "<?php echo lang('datapicker_dia_miercoles_abr');?>",  "<?php echo lang('datapicker_dia_jueves_abr');?>", "<?php echo lang('datapicker_dia_viernes_abr');?>", "<?php echo lang('datapicker_dia_sabado_abr');?>"],
			monthNames: ["<?php echo lang('datapicker_mes_enero');?>","<?php echo lang('datapicker_mes_febrero');?>","<?php echo lang('datapicker_mes_marzo');?>","<?php echo lang('datapicker_mes_abril');?>","<?php echo lang('datapicker_mes_mayo');?>","<?php echo lang('datapicker_mes_junio');?>","<?php echo lang('datapicker_mes_julio');?>","<?php echo lang('datapicker_mes_agosto');?>","<?php echo lang('datapicker_mes_septiembre');?>","<?php echo lang('datapicker_mes_octubre');?>","<?php echo lang('datapicker_mes_noviembre');?>","<?php echo lang('datapicker_mes_diciembre');?>"],
		});
	});
</script>

<div class="row">
	<div class="twelve columns">

			<?php if(isset($breadcrumbs)): ?>
				<?php echo $breadcrumbs; ?>
			<?php endif; ?>

		    <!-- Formulario Crear evento -->
		    <?php
		    	echo validation_errors();
		    	
		    	if(isset($error)) echo $error;

		    	$id = (isset($evento->id_evento) ? $evento->id_evento : '');
		    ?>

		    <?php echo form_open_multipart('evento/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
			
			<fieldset>
				<div class="row">
					<div class="six columns centered">
						
						<!-- Estado -->
						<div class="row">
							
							<div class="three columns">
					        	<label class="inline" for="estado">
					        		<span> <?php echo lang('estado'); ?> </span>
					        	</label>
					        </div>
					        
				        	<div class="nine columns">
					        	<select class="estado_crear custom select_back" id="estado" name="id_estado">
			                        <?php
			                        foreach (json_decode($estados) as $key => $estado)
			                        {
			                        	$key++;
			                            echo '<option value="' . $estado->id_estado . '" ' . (isset($evento->id_estado) && $evento->id_estado == $key ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
			                        }
			                        ?>
					            </select>
				        	</div>
				        	
						</div>
						
						<!-- Fecha y hora del evento -->
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="fecha">
					        		<span> <?php echo 'Fecha/Hora'; ?> </span>
					        	</label>
					        </div>
				        	<div class="nine columns">
				        		<?php $temp = (isset($evento->fecha) && !empty($evento->fecha)) ? flip_timestamp($evento->fecha) : date('d-m-Y H:i'); ?>
					        	<input type="text" name="fecha_evento" class="fecha_evento" readonly="readonly" value="<?php echo set_value('fecha', $temp); ?>" />
				        	</div>
						</div>
						
						<!-- Fecha -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('evento_crear_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					        	<?php
					                        if (set_value('fecha')) {
					                            $fecha = set_value('fecha');
					                        }
					                        else
					                        {
					                            $fecha = (isset($evento->fecha) && $evento->fecha != '' ? date('Y-m-d', mysql_to_unix($evento->fecha)) : date('Y-m-d'));
					                        }
					             ?>
								<input class="" id="fecha" name="fecha" type="text" value="<?php echo $fecha ?>" readonly="" />
					        </div>
						</div>
						-->
						*/ ?>
						
						<!-- Hora -->
						<?php /*
						<!--
						<div class="row">
							
							<div class="three columns">
								<label class="inline" for="creado">
					        		<span> <?php echo lang('eventos_crear_hora'); ?></span>
					        	</label>
							</div>
							
							<div class="nine columns">
								<input class="" id="hora" name="hora" type="text" value="<?php echo (isset($evento->hora)) ? date('G:i',strtotime($evento->hora)) : set_value('hora'); ?>" readonly="" />
							</div>
							
						</div>
						-->
						*/ ?>
						
						<!--
						<?php if(isset($evento)): ?>
							<input type="hidden" name="creado" value="<?php echo $evento->creado; ?>" >
						<?php else: ?>
							<input type="hidden" name="creado" value="<?php echo date('Y-m-d H:i:s'); ?>" >
						<?php endif; ?>
						-->
						
						<!-- WTC Tipo evento -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
								<label class="inline">
									<span><?php echo lang('eventos_tipo_evento_tit'); ?></span>
								</label>
							</div>
							<div class="nine columns">
								<?php if(isset($evento)): ?>
									<?php echo form_dropdown('id_tipo_evento', $tipo_eventos, $evento->id_tipo_evento, 'class="twelve custom select_back"'); ?>
								<?php else: ?>
									<?php echo form_dropdown('id_tipo_evento', $tipo_eventos, '', 'class="twelve custom select_back"'); ?>
								<?php endif; ?>	
							</div>
						</div>
						-->
						*/ ?>
						
						<?php //die_pre(($evento)); ?>
						<?php /*
						<!--<div class="row">
							<div class="three columns">
					        	<label class="inline" for="seccion">
					        		<span> Sección </span>
					        	</label>
					        </div>
				        	<div class="nine columns">
					        	<select class="estado_crear custom select_back" name="section">
			                        <option <?php echo (isset($evento->section) && ($evento->section=="2")) ? 'selected' : ''; ?> value="2">Agregar evento al Home</option>
			                        <option <?php echo (isset($evento->section) && ($evento->section=="3")) ? 'selected' : ''; ?> value="3">Quitar evento del Home</option>
					            </select>
				        	</div>
						</div>-->
						*/ ?>
							
						<!-- WTC Precio Evento -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
								<label class="inline" for="creado">
					        		<span> <?php echo lang('eventos_crear_precio'); ?>  </span>
					        	</label>
							</div>
							<div class="nine columns">
								<div class="row collapse">
									<div class="nine mobile-three columns">
										<input id="precio" class="" name="precio_evento" type="text" value="<?php echo (isset($evento->precio_evento)) ? $evento->precio_evento : set_value('precio_evento') ; ?>" />
									</div>
									<div class="three mobile-one columns">
										<span class="postfix">Bs.F</span>
									</div>
								</div>
							</div>
						</div>
						-->
						*/ ?>
						
						<!-- WTC Inscripcion eventos -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
								<label class="inline">
									<?php echo lang('eventos_permitir_inscripciones') ?>
								</label>
							</div>
							<div class="nine columns">
								<div class="debito" style="float:left;">
									<?php if(isset($evento) && $evento->inscripcion): ?>
										<label for="inscripcion"><?php echo form_checkbox(array("name" => 'inscripcion', "value" => "1", "id" => 'inscripcion', 'checked' => TRUE)); ?> <div class="etiqueta"></div></label>
									<?php else: ?>
										<label for="inscripcion"><?php echo form_checkbox(array("name" => 'inscripcion', "value" => "1", "id" => 'inscripcion', 'checked' => FALSE)); ?> <div class="etiqueta"></div></label>
									<?php endif; ?>
								</div>
							</div>
						</div>
						-->
						*/ ?>
						
						<!-- WTC Duracion eventos -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
								<label class="inline"><?php echo lang('eventos_duracion') ?></label>
							</div>
							<div class="nine columns">
								<input type="text" name="dias" value="<?php echo isset($evento) ? $evento->dias : set_value('dias') ?>" style="width:60px;">
							</div>
						</div>
						-->
						*/ ?>
						
						<!-- WTC Forma de pago -->
						<?php /*
						<!--
						<div class="row">
							<div class="three columns">
								<p><?php echo lang('forma_pago'); ?></p>
							</div>
							<div class="nine columns">								
								<fieldset style="padding-top:0px;margin-top:3px;padding-bottom:0px;">	
									<div class="row">			
										<div class="twelve columns" id="forma_pago" style="padding:20px 20px 10px 20px;">
											<?php if(isset($tipo_pagos)): ?>
												<?php foreach($tipo_pagos as $pago): ?>
					
													<div class="row collapse pago_item">
														<div class="six mobile-one columns" style="height:32px; padding-top:4px">
															<span><?php echo lang('eventos_pago_'.$pago->id_tipo_pago); ?></span>
														</div>
														<div class="six mobile-three columns">
															<div class="<?php echo $pago->nombre_pago; ?>">
																<?php if(isset($rel_evento_pago[$pago->id_tipo_pago])): ?>
																	<label for="<?php echo $pago->nombre_pago; ?>"><?php echo form_checkbox(array("name" => $pago->nombre_pago, "value" => $pago->id_tipo_pago, "id" => $pago->nombre_pago, 'checked' => TRUE)); ?> <div class="etiqueta"></div></label>
																<?php else: ?>
																	<label for="<?php echo $pago->nombre_pago; ?>"><?php echo form_checkbox(array("name" => $pago->nombre_pago, "value" => $pago->id_tipo_pago, "id" => $pago->nombre_pago, 'checked' => FALSE)); ?> <div class="etiqueta"></div></label>
																<?php endif; ?>
																
															</div>
														</div>
													</div>
					
												<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
						-->
						*/ ?>
						
						<!-- Lugar del evento -->
						<?php /*
						<!--
						<div class="row">
							
							<div class="three columns">
								<label class="inline"><?php echo lang('eventos_ficha_lugar') ?></label>
							</div>
							
							<div class="nine columns">
								<input type="text" name="lugar" value="<?php echo isset($evento) ? $evento->lugar : set_value('lugar') ?>">
							</div>
							
						</div>
						-->
						*/ ?>
						
						<!--
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('noticias_crear_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					        	<?php
					                        if (set_value('creado')) {
					                            $fecha = set_value('creado');
					                        }
					                        else
					                        {
					                            $fecha = (isset($noticia->creado) && $noticia->creado != '' ? date('Y/m/d', mysql_to_unix($noticia->creado)) : date('Y/m/d'));
					                        }
					             ?>
	
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" /></td>
					        </div>
						</div>
						-->
						
						<!-- Destacado -->
						<div class="row">
							<div class="three columns">
								<label class="inline" for="destacado">
										<span> <?php echo lang('destacada'); ?> </span>
					            </label>
							</div>
	
					        <div class="nine columns">
					        	<?php if(isset($evento)): ?>
					        		<?php echo form_dropdown('destacado', $array_destacado, $evento->destacado, 'class="custom select_back" '); ?>
					        	<?php else: ?>
					        		<?php echo form_dropdown('destacado', $array_destacado, '', 'class="custom select_back" '); ?>
					        	<?php endif; ?>
	
					        </div>
						</div>
						
						<!-- Categorias 
						<div class="row">
							
							<div class="three columns">
					        	<label class="inline" for="categoria">
					        		<span> <?php echo lang('categoria_evento'); ?> </span>
					        	</label>
					        </div>
					        
				        	<div class="nine columns">
					        	<select class="estado_crear custom select_back" id="categoria" name="id_categoria">
			                        <?php
			                        foreach (json_decode($categorias) as $key => $categoria)
			                        {
			                        	$key++;
			                            echo '<option value="' . $categoria->id_categoria . '" ' . (isset($evento->id_categoria) && $evento->id_categoria == $categoria->id_categoria ? 'selected="selected"' : set_select('id_categoria', $evento->id_categoria)) . '>' . ucwords($categoria->nombre) . '</option>';
			                        }
			                        ?>
					            </select>
				        	</div>
				        	
						</div>
						-->
						
				        <?php echo (isset($evento) ? '<input type="hidden" name="id_evento" value="' . $evento->id_evento . '" />' : '') ?>
	
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($evento) ? lang('guardar') : lang('crear')) ?></button>
				        	</div>
				        </div>					
					</div>
				</div>
		    </fieldset>
		</form>	
		<!-- Formulario Formulario Crear evento cierre -->
	</div>
</div>
