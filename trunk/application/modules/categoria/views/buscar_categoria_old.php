		<div id="ficha">

			<h2>Buscar Categoria</h2>

			<!-- Formulario Buscar Obra -->

			<?php 
			if (isset($mensaje) && $mensaje!='') echo '<p class="error">No se ha encontrado ningún resultado con el criterio de búsqueda seleccionado.</p>';
			echo form_open('backend/categorias','id="gen_form"');?>
				<fieldset>
					<legend>Buscar Categoria</legend>
					<p>
						<label for="nombre">
							<span>Nombre</span>
							<input id="nombre" name="nombre" type="text" />
						</label>
					</p>
					<p>
						<label for="descripcion">
							<span>Descripcion</span>
							<input id="descripcion" name="descripcion" type="text" />
						</label>
					</p>					
					<strong class="boton"><button type="submit">Buscar</button></strong>
				</fieldset>
			</form>
            <?php form_close(); ?>
			<!-- Formulario Buscar Obra cierre -->
			
		</div>
