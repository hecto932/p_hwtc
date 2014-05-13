		<div id="ficha">
		<?php echo validation_errors();


$id=(isset($categoria->id_categoria) ? $categoria->id_categoria : '');

?>
            
            <h2><?php echo ($id!='' ? 'Editar' : 'Crear')?> Categoria</h2>

			<!-- Formulario Editar Categoria -->



				<?php 
						echo form_open('categoria/create/'.$id ,'id="gen_form" class="editar_categoria"');
				?>


				<fieldset>
					<legend><?php echo (isset($editar) ? 'Editar' : 'Crear')?> categoria</legend>
					
                   <p>
						<label for="estado">
							<span>Estado</span>
							<select id="estado" name="id_estado">
							<?php
								foreach(json_decode($estados) as $estado){
									echo '<option value="'.$estado->id_estado.'" '.($estado->id_estado==$categoria->id_estado ? 'selected="selected"'  : set_select('id_estado', $estado->id_estado)).'>'.ucwords($estado->estado).'</option>';
								}
								?>
							</select>
						</label>
					</p>
					<p class="padre">Categoria Padre</p>
					<?php echo $arbol_categorias;?>
					
					<?php /*
					<p>
						<label for="categoria_padre">
							<span>Categoria padre</span>
							<?php //echo '<pre>'.print_r($categorias,true).'</pre>'; ?>
							<select id="categoria_padre" name="id_categoria_padre">
							<option value="0" <?php ($categoria->id_categoria_padre==0 ? 'selected="selected"'  : '')?>>Raíz</option>
							<?php
							
								foreach($categorias as $cat){
									//echo '<pre>'.print_r($cat,true).'</pre>';
									echo '<option value="'.$cat->id_categoria.'" '.($cat->id_categoria==$categoria->id_categoria_padre ? 'selected="selected"'  : set_select('id_categoria_padre', $categoria->id_categoria_padre)).'>'.($cat->nombre!='' ? ucwords($cat->nombre) : $cat->id_categoria).'</option>';
								}
								?>
							</select>
						</label>
					</p>
					*/ ?>
					
					<p class="inputCheckbox">
						<label for="destacado">
							<input id="destacado" name="destacado" type="checkbox" value="1" <?php echo ((isset($categoria->destacado) && $categoria->destacado==1)? 'checked="checked"' : set_checkbox('destacado', '1')); ?> />
							<span>Destacado</span>
						</label>
					</p>
									
					<p class="inputFile">
					<?php 
					if (isset($categoria)) $img=json_decode(modules::run('services/relations/get_rel','categoria','imagen',$categoria->id_categoria,'true','multimedia.id_multimedia'));
					if (isset($img) && is_array($img) && !empty($img)){
					//echo '<pre>'.print_r($img,true).'</pre>';
					foreach($img as $im){ ?>
					<input type="hidden" name="imagenActual" value="<?php echo $im->fichero?>" />
						<img src="/assets/front/img/med/<?php echo $im->fichero?>" alt="<?php echo (isset($categoria->nombre) ? 'Ficha de '.$categoria->nombre : 'categoria sin titulo')?>" />
						<?php }
						}
						?>
						<label for="imagen">
							 <span id="uploadImage">Subir imagen</span>
							 <span>Imagen (197x143)</span>
							<input id="imagen" name="imagen" type="file" class="categoria" />
							<input id="imagenName" name="imagenName" type="hidden" />
						</label>
					</p>

						
						
<!-- 					
					<p class="inputFile">
					<?php 
					if (isset($categoria)) $img=json_decode(modules::run('services/relations/get_rel','categoria','banner',$categoria->id_categoria,'true','multimedia.id_multimedia'));
					if (isset($img) && is_array($img) && !empty($img)){
					//echo '<pre>'.print_r($img,true).'</pre>';
					foreach($img as $im){ ?>
					<input type="hidden" name="bannerActual" value="<?php echo $im->fichero?>" />
						<img src="/assets/img/med/<?php echo $im->fichero?>" alt="<?php echo (isset($categoria->nombre) ? 'Banner de '.$categoria->nombre : 'categoria sin titulo')?>" />
						<?php }
						}
						?>
						<label for="banner">
							 <span id="uploadBanner">Subir banner</span>
							 <span>Banner</span>
							<input id="banner" name="banner" type="file" />
							<input id="bannerName" name="annerName" type="hidden" />
						</label>
					</p>
-->
					
						
					<?php echo (isset($categoria) ? '<input type="hidden" name="id_categoria" value="'.$categoria->id_categoria.'" />' : '')?>
					<strong class="boton"><button type="submit" class="guardar"><?php echo (isset($categoria) ? 'Guardar' : 'Crear')?> categoria</button></strong>
				</fieldset>
			</form>
            		     <?php echo form_close(); ?>
			<!-- Formulario Formulario Crear Artista cierre -->

		</div>
