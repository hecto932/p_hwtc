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
	
	<?php $i = 1; $count_productos = count($arbol_productos); $num_producto = 1; ?>
	
	<?php if($error == 1): ?>
		
		<div class="row hide-for-small">
			<div class="large-12 columns">
				<?php echo lang('productos_error'); ?>
			</div>
		</div>
		
	<?php else: ?>
	
		<div class="row hide-for-small">
			
			<?php foreach ($arbol_productos as $producto): ?>
			
				<?php if($i == 4): ?>
					
					<hr />
					
					</div>
								
					<div class="row hide-for-small">
					
					<?php $i = 1; ?>
					
				<?php endif; ?>
				
				
				<div class="large-4 columns <?php echo ($num_producto == $count_productos && $i == 2) ? 'pull-4' : ''; ?>">
		        	
		         	<div class="large-12 columns panel_producto_item" style="padding:1.48em;">
		         		
		         		<?php $nombre_producto = (isset($producto->nombre) && !empty($producto->nombre)) ? character_limiter($producto->nombre, 14) : lang('home.sin_nombre'); ?>
		         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.3em; padding-bottom: 0.3em;"><i class="foundicon-plus enclosed"></i> <?php echo ucfirst(mb_convert_case($nombre_producto,  MB_CASE_LOWER)); ?></h5>  
		               	
		               	<?php
		               		//Imagen del producto
		               		$fuente_imagen = "assets/front/img/med/";
		               		$fichero = (isset($producto->fichero) && !empty($producto->fichero) && file_exists(FCPATH.$fuente_imagen.$producto->fichero) ? $fuente_imagen.$producto->fichero : $placeholder);
		               	?>
		               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
		            	<hr/>
		            	
		            	 <!-- OJO! height -->
		                <p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left; height: 70px;">
		                	<?php echo (isset($producto->descripcion_breve) && !empty($producto->descripcion_breve)) ? character_limiter(ucfirst(mb_convert_case($producto->descripcion_breve, MB_CASE_LOWER)), 100) : lang('home.sin_descripcion'); ?>
		                </p>
		                
		                <?php
		                	//Url del producto
		                	$url = (isset($producto->url) && ($producto->url!='')) ? $producto->url : $producto->id_producto;
		                ?>
		                
		                <center>
		                <a class="ver_articulo button" href="<?php echo site_url().lang('detalle_productos_url').$url; ?>">
							<?php echo lang('productos_articulo'); ?>
						</a>
						</center>
						
						<!-- AddThis Button BEGIN -->
						<!--
						<div class="addthis_toolbox addthis_default_style rating">
							<a class="addthis_button_preferred_1"></a>
							<a class="addthis_button_preferred_2"></a>
							<a class="addthis_button_preferred_3"></a>
							<a class="addthis_button_preferred_4"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f2061da4202e5cb"></script>
						-->
						<!-- AddThis Button END -->
						
		         	</div>
		
		        </div>
				
				<?php $i++; $num_producto++; ?>
			
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
			
			<?php foreach ($arbol_productos as $producto): ?>
			
				<div class="small-6 columns column_responsive <?php echo ($num_producto == $count_productos && $count_productos == 3) ? 'pull-4' : ''; ?>" style="min-width: 220px;">
		        	
		         	<div class="small-12 columns panel_producto_item">
		         		
		         		<?php $nombre_producto = (isset($producto->nombre) && !empty($producto->nombre)) ?  character_limiter($producto->nombre, 14) : lang('home.sin_nombre'); ?>
		         		<h5 style="color: #6F6F6F; font-family: 'Open Sans', sans-serif; font-size:1.1em; padding-bottom: 0.3em;"><i class="foundicon-plus enclosed"></i> <?php echo ucfirst(mb_convert_case($nombre_producto, MB_CASE_LOWER)); ?></h5>  
		               	
		               	<?php
		               		//Imagen del producto
		               		$fuente_imagen = "assets/front/img/med/"; 
		               		$fichero = (isset($producto->fichero) && !empty($producto->fichero) && file_exists(FCPATH.$fuente_imagen.$producto->fichero) ? $fuente_imagen.$producto->fichero : $placeholder);
		               	?>
		               	<img style="margin-left:auto; margin-right:auto; display: block;" src="<?php echo $fichero; ?>">
		            	<hr/>
		                
		                <!-- OJO! height -->
		                <p style="font-family: 'PT Sans',sans-serif; font-size: 0.9em; text-align: left; height: 70px;">
		                	<?php echo (isset($producto->descripcion_breve) && !empty($producto->descripcion_breve)) ? character_limiter(ucfirst(mb_convert_case($producto->descripcion_breve, MB_CASE_LOWER)), 100) : lang('home.sin_descripcion'); ?>
		                </p>
		                
						<?php
		                	//Url del producto
		                	$url = (isset($producto->url) && ($producto->url!='')) ? $producto->url : $producto->id_producto;
		                ?>
		                
		                <a class="ver_articulo button" href="<?php echo site_url().lang('detalle_productos_url').$url; ?>">
							<?php echo lang('productos_articulo'); ?>
						</a>
						
		         	</div>
		
		        </div>
		        
		        <?php $num_producto++; $i++; ?>
		        
			<?php endforeach; ?>    
			
		</div>
	
	<?php endif; ?>

	<div class="row hide-for-small-440">		
		<div class="large-12 small-12 columns">
			<hr/>
		</div>
	</div>