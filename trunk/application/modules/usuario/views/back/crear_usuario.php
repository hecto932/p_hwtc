<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
					<?php echo $breadcrumbs; ?>
		<?php endif; ?>





		<?php
			if(isset($usuarios->nombre)){
				if($usuarios->nombre != ''){
					$editar = '1';
				}
			  }
		?>



			<?php
				echo validation_errors();
				$id = (isset($usuarios->id_usuario) ? $usuarios->id_usuario : '');
			?>


			<!-- Formulario Editar Usuario -->




			<?php echo form_open('usuario/create/'.$id ,'id="gen_form" class="custom"'); ?>
				<fieldset>
					<div class="row">
						<div class="six columns centered">

							<?php /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>
		
							<div class="row">						
								<div class="three columns">
									<label class="inline" for="nombre">
										<span> <?php echo lang('usuarios_nom'); ?> </span>
									</label>
								</div>
								<div class="nine columns">
									<input class='<?php echo (form_error("nombre") != "") ? "error" : "" ; ?>' name="nombre" type="text" value="<?php echo ((set_value('nombre')!='' || !isset($usuarios->nombre)) ? set_value('nombre') : $usuarios->nombre);?>" />
								</div>
							</div>
							
							<?php /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>					
		
							<div class="row">						
								<div class="three columns">
									<label class="inline" for="apellidos">
										<span> <?php echo lang('usuarios_ape'); ?> </span>
									</label>
								</div>					
								<div class="nine columns">
									<input class='<?php echo (form_error("apellidos") != "") ? "error" : "" ; ?>' name="apellidos" type="text" value="<?php echo ((set_value('apellidos')!='' || !isset($usuarios->apellidos)) ? set_value('apellidos') : $usuarios->apellidos);?>" />
								</div>
							</div>
		
							<?php /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>
		
		                    <div class="row">
		                    	<div class="three columns">
		                    		<label class="inline" for="password">
		                    			<span> <?php echo lang('usuarios_pas'); ?> </span>
		                    		</label>
		                    	</div>             	
		                    	<div class="nine columns">
		                    		<?php  if(isset($editar)): ?>
		                    			<input class='<?php echo (form_error("password") != "") ? "error" : "" ; ?>' name="password" type="password" value="<?php echo !isset($usuarios->password) ? sha1(set_value('password')) : '';?>" />
		                    		<?php else: ?>
		                    			<input class='<?php echo (form_error("password") != "") ? "error" : "" ; ?>' name="password" type="password" value="" />
		                    		<?php endif; ?>
		                    	</div>
							</div>
		
							<?php /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>
		
							<div class="row">
								<div class="three columns">
									<label class="inline" for="email">
										<span> <?php echo lang('usuarios_ema'); ?> </span>
									</label>
								</div>
								<div class="nine columns">
									<input class='<?php echo (form_error("email") != "") ? "error" : "" ; ?>' name="email" type="text" value="<?php echo ((set_value('email')!='' || !isset($usuarios->email)) ? set_value('email') : $usuarios->email);?>" />
								</div>
							</div>
		
		
							<?php /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>
							
							<div class="row">
								<div class="three columns">
									<label class="inline" for="id_rol">
										<span> <?php echo lang('usuarios_rol'); ?> </span>
									</label>
								</div>
								<div class="nine columns">
									<select id='id_rol' name="id_rol">
		                            <option id="id_rol" value='1' <?php if(isset($usuarios->id_rol)){
									                                      if($usuarios->id_rol=='1'){
																		      echo 'selected';
																			  }
																			  }?>>Administrador</option>
		                            <option id="id_rol" value='2' <?php if(isset($usuarios->id_rol)){
									                                      if($usuarios->id_rol=='2'){
																		      echo 'selected';
																			  }
																			  }?>>Editor</option>
		                            </select>
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
						                            echo '<option value="' . $estado->id_estado . '" ' . ((isset($usuarios->id_estado) && $usuarios->id_estado == $key) ? 'selected="selected"' : set_select('id_estado', $estado->id_estado)) . '>' . ucfirst($estado->estado) . '</option>';
						                        }
						                        ?>
						            </select>
					        	</div>
							</div>
						
							
							<?php /*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/ ?>
		
		 					<?php if(isset($usuarios->nombre)): ?>
								<input type="hidden" name="id_usuario" value='<?php echo $usuarios->id_usuario ?>' />
							<? endif; ?>
		
								<div class="row">
									<div class="twelve columns alinear-derecha">
										<button type="submit" class="button radius wtc"><?php echo (isset($usuarios->nombre) ? lang('guardar') : lang('crear'))?> </button>		
									</div>
								</div>
		            		<?php echo form_close(); ?>
						</div>
					</div>
				</fieldset>
			<!-- Formulario Formulario Crear Artista cierre -->

	</div>
</div>