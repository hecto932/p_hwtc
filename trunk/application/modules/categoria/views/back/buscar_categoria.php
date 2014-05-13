<?php
	$estados = modules::run('services/relations/get_all','estado','true');
	$categoria = modules::run('services/relations/get_all','categoria','true','categoria.id_categoria');
?>


<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

		<!-- Formulario Buscar FAQ -->
		<?php if (isset($mensaje) && $mensaje!='') echo '<p class="error">'.lang('listado_error').'</p>';

		echo form_open('backend/categorias','id="gen_form" class="custom"');?>
			<fieldset>
				<div class="row">
					<div class="six columns centered">
<!----------	TEXTO	---------->
						<div class="row">	
							<div class="two columns">
								<label class="inline" for="texto">
									<span> <?php echo lang('listado_texto'); ?> </span>
								</label>
							</div>
		                    <div class="ten columns">
		                    	<input name="texto" type="text" />
		                    </div>
						</div>
<!----------	ESTADO	---------->
	                    <div class="row">
		                    <div class="two columns">
								<label class="inline" for="estado">
									<span> <?php echo lang('listado_estado'); ?> </span>
								</label>
							</div>					
							<div class="ten columns estado" >
								<select class="custom" id="estado" name="id_estado" >
									<option value=""> <?php echo lang('listado_estado'); ?> </option>
									<?php foreach(json_decode($estados) as $estado)
											echo '<option value="'.$estado->id_estado.'">'.$estado->estado.'</option>';
									?>
								</select>
							</div>
						</div>
<!----------	SUBMIT	---------->
						<div class="row">
							<div class="twelve columns alinear-derecha">
								<button class="button radius wtc" type="submit"> <?php echo lang('listado_buscar'); ?> </button>		
							</div>
						</div>						
					</div>
				</div>
			</fieldset>
		</form>
		<!-- Formulario Buscar Obra cierre -->
	</div>
</div>
		