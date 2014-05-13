
	
	<!--Gama de Productos-->
	
	<div class="row">
		<div class="large-12 columns">
			<br />
			<h6 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.5em; margin-top: 0;"></h6>
			<?php echo (isset($breadcrumbs)) ? $breadcrumbs : ''; ?>
		</div>
	</div>
	
	
	<!--Fila 1 de Productos-->
	
	<?php if($error == 1): ?>
		
		<div class="row hide-for-small">
			<div class="large-12 columns">
				<?php echo lang('productos_error'); ?>
			</div>
		</div>
		
	<?php else: ?>
	
		<div class="row hide-for-small">
			
			<div class="large-12 columns">
	        	
	         	<div class="large-6 columns panel_producto_item" style="padding:1.48em;">
	         		
	               	<?php
	               		//Imagen del producto
	               		
	               		$fuente_imagen = "assets/front/img/large/";
	               		$fichero = (isset($producto[0]->fichero) && !empty($producto[0]->fichero) && file_exists(FCPATH.$fuente_imagen.$producto[0]->fichero) ? $fuente_imagen.$producto[0]->fichero : $placeholder);
	               	?>
	               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
					
	         	</div>
	         	
	         	<div class="large-6 columns panel_producto_item" style="padding:1.48em;">
	         		
	        		<?php $nombre_producto = (isset($producto[0]->nombre) && !empty($producto[0]->nombre)) ? $producto[0]->nombre : lang('home.sin_nombre'); ?>
	         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"> <?php echo ucfirst(mb_convert_case($nombre_producto,  MB_CASE_LOWER)); ?></h5>  
	               	
	         		<p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left;">
	                	<?php 
	                		//Descripcion
	                		if(isset($producto[0]->descripcion_ampliada) && !empty($producto[0]->descripcion_ampliada))
	                		{
	                			echo ucfirst(mb_convert_case(trim($producto[0]->descripcion_ampliada), MB_CASE_LOWER));
	                		}
							elseif(isset($producto[0]->descripcion_breve) && !empty($producto[0]->descripcion_breve))
							{
								echo ucfirst(mb_convert_case(trim($producto[0]->descripcion_breve, MB_CASE_LOWER)));
							}
							else echo lang('home.sin_descripcion');
	                	?>
	                </p>
	         		
	         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"> <?php echo ucfirst(mb_convert_case('Código',  MB_CASE_LOWER)); ?>:</h5>  
	               	
	         		<span style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left;">
	                	<?php 
	                		//Descripcion
	                		if(isset($producto[0]->codigo_coloplas) && !empty($producto[0]->codigo_coloplas))
	                		{
	                			echo ucfirst(mb_convert_case(trim($producto[0]->codigo_coloplas), MB_CASE_LOWER));
	                		}
							else echo 'Sin Código';
	                	?>
	                </span>
	                
	                <br /><br />
                	<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style rating">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f2061da4202e5cb"></script>
					<!-- AddThis Button END -->
	         		
	         	</div>
	         	
	        </div>
	        <?php if(isset($relacion) && !empty($relacion)): ?>
	        	<div class="large-12 columns">
		       		<div class="large-6 columns panel_producto_item"></div>
		        	<div class="large-6 columns panel_producto_item">
		        		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;">
		        			<?php echo ucfirst(mb_convert_case('Productos Relacionados',  MB_CASE_LOWER)); ?>:
		        		</h5>
						<ul class="block-grid">
							<?php foreach($relacion as $relacionado):?>
								
								<?php 
									$fuente_imagen = "assets/front/img/thumb/";
			               			$fichero = (isset($relacionado->fichero) && !empty($relacionado->fichero) && file_exists(FCPATH.$fuente_imagen.$relacionado->fichero) ? $fuente_imagen.$relacionado->fichero : $fuente_imagen.'placeholder_thumb.jpg');
								?>
								<li class="clearing-feature" style="list-style: none outside none; display: inline-block; border: solid 1px; border-color: #a6a6a6;">
									<span data-tooltip class="has-tip" title="<?php echo $relacionado->nombre; ?>">
										<a href="<?php echo site_url('producto/producto_front/detalle/'.$relacionado->url); ?>"><img src="<?php echo $fichero; ?>"></a>
									</span>
								</li>
							
							<?php endforeach; ?>
						</ul>
		        	</div>
	    		</div>
	    	<?php endif; ?>
		</div>
	
	<?php endif; ?>
	
	<!--Fila 1 de Productos RESPONSIVA -->
	
	<?php $i = 1; ?>
	
	<?php if($error == 1): ?>
		
		<div class="row show-for-small">
			<div class="large-12 columns">
				<?php echo lang('productos_error'); ?>
			</div>
		</div>
		
	<?php else: ?>
	
		<div class="row show-for-small">
			
			<div class="small-12 columns column_responsive" style="min-width: 220px;">
	        	
	         	<div class="small-12 columns panel_producto_item">
	         		
	         		<?php
	               		//Imagen del producto
	               		$fuente_imagen = "assets/front/img/med/";
	               		$fichero = (isset($producto[0]->fichero) && !empty($producto[0]->fichero) && file_exists(FCPATH.$fuente_imagen.$producto[0]->fichero) ? $fuente_imagen.$producto[0]->fichero : $placeholder);
	               	?>
	               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
					
	         	</div>
				
				<div class="small-12 columns panel_producto_item">
	         		
	         		<?php $nombre_producto = (isset($producto[0]->nombre) && !empty($producto[0]->nombre)) ? $producto[0]->nombre : lang('home.sin_nombre'); ?>
	         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"> <?php echo ucfirst(mb_convert_case($nombre_producto,  MB_CASE_LOWER)); ?></h5>  
	               	
	         		<p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left;">
	                	<?php 
	                		//Descripcion
	                		if(isset($producto[0]->descripcion_ampliada) && !empty($producto[0]->descripcion_ampliada))
	                		{
	                			echo ucfirst(mb_convert_case(trim($producto[0]->descripcion_ampliada), MB_CASE_LOWER));
	                		}
							elseif(isset($producto[0]->descripcion_breve) && !empty($producto[0]->descripcion_breve))
							{
								echo ucfirst(mb_convert_case(trim($producto[0]->descripcion_breve, MB_CASE_LOWER)));
							}
							else echo lang('home.sin_descripcion');
	                	?>
	                </p>
	         		
	         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"> <?php echo ucfirst(mb_convert_case('Código',  MB_CASE_LOWER)); ?>:</h5>  
	               	
	         		<span style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left;">
	                	<?php 
	                		//Descripcion
	                		if(isset($producto[0]->codigo_coloplas) && !empty($producto[0]->codigo_coloplas))
	                		{
	                			echo ucfirst(mb_convert_case(trim($producto[0]->codigo_coloplas), MB_CASE_LOWER));
	                		}
							else echo 'Sin Código';
	                	?>
	                </span>
					
	         	</div>
				
	        </div> 
			
			<?php if(isset($relacion) && !empty($relacion)): ?>
	        	<div class="large-12 columns">
		       		<div class="large-6 columns panel_producto_item"></div>
		        	<div class="large-6 columns panel_producto_item">
		        		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;">
		        			<?php echo ucfirst(mb_convert_case('Productos Relacionados',  MB_CASE_LOWER)); ?>:
		        		</h5>
						<ul class="block-grid">
							<?php foreach($relacion as $relacionado):?>
								
								<?php 
									$fuente_imagen = "assets/front/img/thumb/";
			               			$fichero = (isset($relacionado->fichero) && !empty($relacionado->fichero) && file_exists(FCPATH.$fuente_imagen.$relacionado->fichero) ? $fuente_imagen.$relacionado->fichero : $fuente_imagen.'placeholder_thumb.jpg');
								?>
								<li class="clearing-feature" style="list-style: none outside none; display: inline-block; border: solid 1px; border-color: #a6a6a6;">
									<!-- <span data-tooltip class="has-tip" title="<?php echo $relacionado->nombre; ?>"> -->
										<a href="<?php echo site_url('producto/producto_front/detalle/'.$relacionado->url); ?>"><img src="<?php echo $fichero; ?>"></a>
									<!-- </span> -->
								</li>
							
							<?php endforeach; ?>
						</ul>
		        	</div>
	    		</div>
	    	<?php endif; ?>
		</div>
	
	<?php endif; ?>

	<div class="row hide-for-small-440">		
		<div class="large-12 small-12 columns">
			<hr/>
		</div>
	</div>
