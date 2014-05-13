<?php
	$estados = modules::run('services/relations/get_all','estado','true');
	$galeria = modules::run('services/relations/get_all','galeria','true','galeria.id_galeria');
	$categorias = modules::run('services/relations/get_all','detalle_categoria');
?>


<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
			<?php echo $breadcrumbs; ?>
		<?php endif; ?>

		<!-- Formulario Buscar FAQ -->
		<?php if (isset($mensaje) && $mensaje!='') echo '<p class="error">'.lang('listado_error').'</p>';

		echo form_open('backend/galerias','id="gen_form" class="custom"');?>
			<fieldset>
				<div class="row">
					<div class="six columns centered">
						
						<!--
						<div class="row">
							<div class="two columns">
								<label class="inline" for="ean">
									<span> <?php echo lang('listado_ean'); ?> </span>
								</label>
							</div>
							<div class="ten columns">
								<input name="ean" type="text" />
							</div>
						</div>
						<div class="row">
							<div class="two columns">
								<label class="inline" for="codigo_coloplas">
									<span> <?php echo lang('listado_codigo'); ?> </span>
								</label>
							</div>
							<div class="ten columns">
								<input name="codigo_coloplas" type="text" />
							</div>
						</div>
						-->
						
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

	                    <div class="row">
		                    <div class="two columns">
								<label class="inline" for="estado">
									<span> <?php echo lang('listado_estado'); ?> </span>
								</label>
							</div>					
							<div class="ten columns estado" >
								<select class="custom" id="estado" name="id_estado" >
									<option value="0"><?php echo lang('listado_todos'); ?></option>
									<?php foreach(json_decode($estados) as $estado)
											echo '<option value="'.$estado->id_estado.'">'.ucfirst($estado->estado).'</option>';
									?>
								</select>
							</div>
						</div>
						<!--
						<div class="row">
		                    <div class="two columns">
								<label class="inline" for="estado">
									<span> <?php echo lang('listado_categoria'); ?> </span>
								</label>
							</div>					
							<div class="ten columns estado" >
								<select class="custom" id="estado" name="id_categoria" >
									<option value="0"><?php echo lang('listado_todos'); ?></option>
									<?php foreach($categorias as $categoria)
											echo '<option value="'.$categoria->id_categoria.'">'.ucfirst($categoria->nombre).'</option>';
									?>
								</select>
							</div>
						</div>
						-->
						<!--
						<div class="row">
							<div class="two mobile-one columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_destacado'); ?> </span>
								</label>
							</div>
							<div class="ten mobile-three columns">
								<input id="destacado" name="destacado" type="checkbox" value="" /><span class="custom checkbox"></span>
							</div>	
						</div>
						-->
						
						<div class="row">
							<div class="two mobile-one columns">
								<label class="inline" for="destacado">
									<span> <?php echo lang('listado_destacado'); ?> </span>
								</label>
							</div>
							<div class="ten mobile-three columns">
								<?php $temp_destacado = (isset($galeria->destacado) && !empty($galeria->destacado)) ? $galeria->destacado : ''?>
								<?php echo form_dropdown('destacado', $array_destacado, set_value('destacado', $temp_destacado), 'class="select_back" '); ?>
					        </div>	
						</div>
						
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
		