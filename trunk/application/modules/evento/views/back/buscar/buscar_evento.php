<?php
	$estados = modules::run('services/relations/get_all','estado','true');
	$noticia = modules::run('services/relations/get_all','noticia','true','noticia.id_noticia');
?>


		<div class="row">
			<div class="twelve columns">

				<?php if(isset($breadcrumbs)): ?>
					<?php echo $breadcrumbs; ?>
				<?php endif; ?>
		
				<!-- Formulario Buscar FAQ -->
				<?php if (isset($mensaje) && $mensaje!='') echo '<p class="error">'.lang('listado_error').'</p>';
	
				echo form_open('backend/eventos','id="gen_form" class="custom"');?>
					<fieldset>
						<div class="row">
							<div class="six columns centered">
								<!--
								<div class="row">
									<div class="two columns">
										<label class="inline" for="id_noticia">
											<span> <?php echo lang('eventos_ficha_id'); ?> </span>
										</label>
									</div>
									
									<div class="ten columns">
										<input name="id_noticia" type="text" />
									</div>
								</div>
								-->
								<div class="row">
									<div class="two columns">
										<label class="inline" for="texto">
											<span> <?php echo lang('eventos_ficha_texto'); ?> </span>
										</label>
									</div>	
				                    <div class="ten columns">
				                    	<input name="texto" type="text" />
				                    </div>
								</div>
								<div class="row">		                    
				                    <div class="two columns">
										<label class="inline" for="estado">
											<span> <?php echo lang('estado'); ?> </span>
										</label>
									</div>
									<div class="ten columns estado">
										<select class="custom six" id="estado" name="id_estado">
											<option value=""> <?php echo lang('eventos_ficha_estado'); ?> </option>
											<?php foreach(json_decode($estados) as $estado){
													echo '<option value="'.$estado->id_estado.'">'.$estado->estado.'</option>';
												}
											?>
										</select>
									</div>
								</div>
								
								<div class="row">
									<div class="two columns">
										<label class="inline" for="destacado">
												<span> <?php echo lang('destacada'); ?> </span>
							            </label>
									</div>
			
							        <div class="ten columns">
							        	<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado'), 'class="custom select_back" '); ?>
							        </div>
								</div>
		
								<div class="row">
									<div class="twelve columns alinear-derecha">
										<button class="button radius wtc" type="submit"> <?php echo lang('buscar'); ?> </button>		
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</form>		

				
					<!-- Formulario Buscar Obra cierre -->
			</div>
		</div>
		