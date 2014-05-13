<div class="row">
	<div class="twelve columns">
		
		<?php if(isset($breadcrumbs)): ?><?php echo $breadcrumbs; ?><?php endif; ?>

	    <?php
	    	if(validation_errors()) echo validation_errors(); 
	    	if (isset($error)) echo $error;
	    	$id = (isset($subscriptor->id_subscriptor) ? $subscriptor->id_subscriptor : '');
	    ?>

	    <?php echo form_open_multipart('backend/promociones/editar_subscriptor/' . $id, array('id' => "gen_form", 'class' => 'custom')) ?>
		    <fieldset>
				<div class="row">
					<div class="six columns centered">
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline">
					        		<span> <?php echo lang('subscriptores.nombre'); ?> </span>
					        	</label>
					        </div>
				        	<div class="ten columns">
				        		<?php $temp = (isset($subscriptor) && !empty($subscriptor)) ? $subscriptor->nombre : '' ?>
					        	<input type="text" name="nombre" value="<?php echo set_value('nombre', $temp)?>" />
				        	</div>
						</div>
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline">
					        		<span> <?php echo lang('subscriptores.apellido'); ?> </span>
					        	</label>
					        </div>
				        	<div class="ten columns">
				        		<?php $temp = (isset($subscriptor) && !empty($subscriptor)) ? $subscriptor->apellido : '' ?>
					        	<input type="text" name="apellido" value="<?php echo set_value('apellido', $temp); ?>" />
				        	</div>
						</div>
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline">
					        		<span> <?php echo lang('subscriptores.email'); ?> </span>
					        	</label>
					        </div>
				        	<div class="ten columns">
				        		<?php $temp = (isset($subscriptor) && !empty($subscriptor)) ? $subscriptor->email : '' ?>
					        	<input type="text" name="email" value="<?php echo set_value('email', $temp); ?>" />
				        	</div>
						</div>
						
						<div class="row">
							<div class="two columns">
					        	<label class="inline">
					        		<span> <?php echo 'Estado'; ?> </span>
					        	</label>
					        </div>
				        	<div class="ten columns">
				        		<?php $temp = (isset($subscriptor) && !empty($subscriptor)) ? $subscriptor->id_estado : '' ?>
					        	<?php echo form_dropdown('id_estado', $opt_estados, set_value('id_estado', $temp), ''); ?>
				        	</div>
						</div>
						
			        	<?php echo (isset($subscriptor) ? '<input type="hidden" name="id_subscriptor" value="' . $subscriptor->id_subscriptor . '" />' : '') ?>
				        <div class="row">
				        	<div class="twelve columns alinear-derecha">
				        		<button type="submit" class="button radius wtc"><?php echo (isset($subscriptor) ? lang('listado_guardar') : lang('listado_crear')) ?></button>
				        	</div>
				        </div>
				        
			       </div>
				</div>
	    	</fieldset>
		</form>
	</div>
</div>