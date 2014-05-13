<?php //die_pre($banner); ?>
<div class="row">
	<div class="twelve columns">

			<?php if(isset($breadcrumbs)): ?>
				<?php echo $breadcrumbs; ?>
			<?php endif; ?>

		    <!-- Formulario Crear banner -->
		    <?php
		    	echo validation_errors();
		    	if (isset($error))
		        echo $error;

		    	$id = (isset($banner->id_banner) ? $banner->id_banner : '');
		    ?>

		    <?php echo form_open_multipart('banner/create/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
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
					                        foreach (json_decode($estados) as $estado) {
					                            echo '<option value="' . $estado->id_estado . '" ' . (isset($banner->estado) && $estado->id_estado == $banner->id_estado ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucwords($estado->estado) . '</option>';
					                        }
					                        ?>
					            </select>
				        	</div>
						</div>
						<div class="row">
							<div class="three columns">
					        	<label class="inline" for="creado">
					        		<span> <?php echo lang('banners_crear_fecha'); ?>  </span>
					        	</label>
				        	</div>
					        <div class="nine columns">
					        	<?php
					                        if (set_value('creado')) {
					                            $fecha = set_value('creado');
					                        }
					                        else
					                        {
					                            $fecha = (isset($banner->creado) && $banner->creado != '' ? date('Y/m/d', mysql_to_unix($banner->creado)) : date('Y/m/d'));
					                        }
					             ?>
	
					             <input id="fecha" name="creado" type="text" value="<?php echo $fecha ?>" readonly /></td>
					        </div>
						</div>
						
						<!--
						<div class="row">
							<div class="two columns">
					        	<label class="inline" for="position">
					        		<span> <?php echo lang('banner_position'); ?> </span>
					        	</label>
					        </div>
	
				        	<div class="ten columns">
					        	<select class="custom" name="enlace">
									<?php for($i=1;$i<=5;$i++) : ?>
										<option value="<?php echo $i; ?>"><?php echo '#'.$i; ?></option>
									<?php endfor; ?>
					            </select>
				        	</div>
						</div>
						-->
						
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
								<?php $temp_destacado = (isset($banner->destacado) && !empty($banner->destacado)) ? $banner->destacado : ''?>
								<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
					        </div>	
						</div>
						
			        	<?php echo (isset($banner) ? '<input type="hidden" name="id_banner" value="' . $banner->id_banner . '" />' : '') ?>
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($banner) ? lang('guardar') : lang('crear')) ?></button>
				        	</div>
				        </div>
		       </div>
			</div>
		    	</fieldset>
		    	
			</form>
		<!-- Formulario Formulario Crear banner cierre -->
	</div>
</div>
