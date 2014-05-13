<script>
	$(document).ready(function() {
		
		/*RESPONSIVE*/
		if(($(window).width()<440) && !($(".column_responsive").hasClass("small-12")))
		{
			$(".column_responsive").removeClass("small-6");
			$(".column_responsive").addClass("small-12");
			$('<hr class="hr_responsive" style="margin-top:2em;"/>').appendTo(".column_responsive");
		}
				
		if($(window).width()<440)
		{
			$(".hide-for-small-440").css({"display":"none"});
		}
		
		$(window).resize(function(){
			
			if(($(window).width()<440) && !($(".column_responsive").hasClass("small-12")))
			{
				$(".column_responsive").removeClass("small-6");
				$(".column_responsive").addClass("small-12");
				$('<hr class="hr_responsive"/>').appendTo(".column_responsive");
			}
			else if(($(window).width()>=440) && !($(".column_responsive").hasClass("small-6")))
			{
				$(".column_responsive").removeClass("small-12");
				$(".column_responsive").addClass("small-6");
				$(".column_responsive .hr_responsive").remove();
			}
			
			//Hide-for-small-440
			
			if(($(window).width()<440) && ($(".hide-for-small-440").css("display")!="none"))
			{
				$(".hide-for-small-440").css({"display":"none"});
			}
			else if(($(window).width()>=440) && ($(".hide-for-small-440").css("display")=="none"))
			{
				$(".hide-for-small-440").css({"display":""});
			}
			
		});
		/*END RESPONSIVE*/
		
		$("#footer_nav_bar dd").removeClass("active");
		$("#footer_nav_bar #footer_nav_bar_productos").addClass("active");

		$(".panel_producto_item").hover(
		 	function(){
				$(this).addClass("panel_producto_hover");
				$(this).addClass("panel_producto_radius");
		    },
		    function(){
		    	$(this).removeClass("panel_producto_hover");
		    	$(this).addClass("panel_producto_radius");
		    }
		);
		
		$("#top_bar_options a").hover(
		 	function(){
				$(this).css("background-color","#fba43d");
		    },
		    function(){
		    	$(this).css("background-color","#00a1d0");
		    }
		);
		
		$("#top_bar_right a").hover(
		 	function(){
				$(this).css("background-color","#fba43d");
		    },
		    function(){
		    	$(this).css("background-color","#00a1d0");
		    }
		);
		
		
	});
</script>
	
	<!--Gama de Productos-->
	
	<div class="row">
		<div class="large-12 columns">
			<br />
			<h6 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.5em; margin-top: 0;">Gama de Productos</h6>
			<?php echo $breadcrumbs; ?>
		</div>
	</div>
	
	
	<!--Fila 1 de Productos-->
	
	<?php $i = 1; $count_categorias = count($arbol_cat); $num_categoria = 1; ?>
	
	<?php if($error == 1): ?>
		
		<div class="row hide-for-small">
			<div class="large-12 columns">
				<?php echo lang('productos_error'); ?>
			</div>
		</div>
		
	<?php else: ?>
	
		<div class="row hide-for-small">
			
			<?php foreach ($arbol_cat as $categoria): ?>
			
				<?php if($i == 4): ?>
					
					<hr />
					
					</div>
								
					<div class="row hide-for-small">
					
					<?php $i = 1; ?>
					
				<?php endif; ?>
				
				<div class="large-4 columns <?php echo ($num_categoria == $count_categorias && $i == 2) ? 'pull-4' : ''; ?>">
		        	
		         	<div class="large-12 columns panel_producto_item" style="padding:1.48em;">
		         		
		         		<?php $nombre_categoria = (isset($categoria->nombre) && !empty($categoria->nombre)) ? character_limiter($categoria->nombre, 14) : lang('home.sin_nombre'); ?>
		         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"><i class="foundicon-plus enclosed"></i> <?php echo ucfirst(mb_convert_case($nombre_categoria,  MB_CASE_LOWER)); ?></h5>  
		               	
		               	<?php
		               		//Imagen de la categoria
		               		$fuente_imagen = "assets/front/img/med/"; 
		               		$fichero = (isset($categoria->fichero) && !empty($categoria->fichero) && file_exists(FCPATH.$fuente_imagen.$categoria->fichero) ? $fuente_imagen.$categoria->fichero : $placeholder);
		               	?>
		               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
		            	<hr/>
		                
		                 <!-- OJO! height -->
		                <p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left; height: 70px;">
		                	<?php echo (isset($categoria->descripcion_breve) && !empty($categoria->descripcion_breve)) ? ucfirst(mb_convert_case($categoria->descripcion_breve, MB_CASE_LOWER)) : lang('home.sin_descripcion'); ?>
		                </p>
		                
		                <?php
		                	//Url del producto
		                	$url = (isset($categoria->url) && ($categoria->url!='')) ? $categoria->url : $categoria->id_categoria;;
		                ?>
		                
		                <?php if(isset($sub) && $sub): ?>
		                	<p class="resaltar_link style_link_right" > <i class="foundicon-right-arrow enclosed"></i><a href="<?php echo site_url().lang('listado_productos_url').$url; ?>"> <?php echo 'Ver Detalles'; ?></a></p>
		                <?php else: ?>
		                	<p class="resaltar_link style_link_right" > <i class="foundicon-right-arrow enclosed"></i><a href="<?php echo site_url().lang('listado_subcategorias_url').$url; ?>"> <?php echo 'Ver Detalles'; ?></a></p>
						<?php endif; ?>
						
		         	</div>
		
		        </div>
				
				<?php $i++; $num_categoria++; ?>
			
			<?php endforeach; ?>
			
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
			
			<?php foreach ($arbol_cat as $categoria): ?>
			
				<?php if($i == 4): ?>
					
					<?php $i = 1; ?>
				
				<?php endif; ?>
				
				<div class="small-6 columns column_responsive <?php echo ($num_categoria == $count_categorias && $i == 2) ? 'pull-4' : ''; ?>" style="min-width: 220px;">
		        	
		         	<div class="small-12 columns panel_producto_item">
		         		
		         		<?php $nombre_categoria = (isset($categoria->nombre) && !empty($categoria->nombre)) ? character_limiter($categoria->nombre, 14) : lang('home.sin_nombre'); ?>
		         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.1em; padding-bottom: 0.3em;"><i class="foundicon-plus enclosed"></i> <?php echo ucfirst(mb_convert_case($nombre_categoria, MB_CASE_LOWER)); ?></h5>  
		               	
		               	<?php
		               		//Imagen de la categoria
		               		$fuente_imagen = "assets/front/img/med/"; 
		               		$fichero = (isset($categoria->fichero) && !empty($categoria->fichero) && file_exists(FCPATH.$fuente_imagen.$categoria->fichero) ? $fuente_imagen.$categoria->fichero : $placeholder);
		               	?>
		               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
		            	<hr/>
		                
		                <!-- OJO! height -->
		                <p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left; height: 70px;">
		                	<?php echo (isset($categoria->descripcion_breve) && !empty($categoria->descripcion_breve)) ? ucfirst(mb_convert_case($categoria->descripcion_breve, MB_CASE_LOWER)) : lang('home.sin_descripcion'); ?>
		                </p>
						
						<?php
		                	//Url del producto
		                	$url = (isset($categoria->url) && ($categoria->url!='')) ? $categoria->url : $categoria->id_categoria;;
		                ?>
		                
		                <?php if(isset($sub) && $sub): ?>
		                	<p class="resaltar_link style_link_right" > <i class="foundicon-right-arrow enclosed"></i><a href="<?php echo site_url().lang('listado_productos_url').$url; ?>"> <?php echo 'Ver Detalles'; ?></a></p>
		                <?php else: ?>
		                	<p class="resaltar_link style_link_right" > <i class="foundicon-right-arrow enclosed"></i><a href="<?php echo site_url().lang('listado_subcategorias_url').$url; ?>"> <?php echo 'Ver Detalles'; ?></a></p>
						<?php endif; ?>
						
		         	</div>
		
		        </div>
		        
		        <?php $num_categoria++; $i++; ?>
		        
			<?php endforeach; ?>    
			
		</div>
	
	<?php endif; ?>

	<div class="row hide-for-small-440">		
		<div class="large-12 small-12 columns">
			<hr/>
		</div>
	</div>