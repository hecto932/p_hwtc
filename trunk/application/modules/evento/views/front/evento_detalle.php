<style type="text/css">.ptcarousel:after{border-style: none !important;}</style>
<style type="text/css">.ptcarousel:before{border-style: none !important;}</style>

<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="/"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo mb_strtoupper(lang('front.eventos_reuniones')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo (!empty($evento)) ? $evento->nombre : mb_strtoupper(lang('front.eventos_reuniones')); ?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="content">
	<div class="container">
		<div id="mainbody">
			<div class="row">
				<div class="span12">
					
					<?php if(!empty($evento)): ?>
						
						<h1 class="page-title"><?php echo $evento->nombre; ?></h1>
						
						<div class="itemView clearfix eBlog">
							
							<!-- Lugar y Fecha -->
							<?php if(!empty($evento->lugar) && !empty($evento->fecha_evento)): ?>
								<div class="itemHeader">
									<div class="post_details">
										<?php
											list($fecha, $hora) = explode(' ', $evento->fecha_evento);
											list($anio, $mes, $dia) = explode('-', $fecha);
											$fecha_evento = implode('-', array($dia, $mes, $anio));
										?>
										<span class="itemCategory"><span class="icon-folder-close"></span><?php echo $evento->lugar; ?></span>
										<span class="infSep"> / </span>
										<span class="itemCommentsBlock"></span>
										<span class="itemDateCreated"><span class="icon-calendar"></span><?php echo $fecha_evento; ?></span>
									</div>
								</div>
							<?php endif; ?>
							
							<div class="itemBody">
								
								<!-- ptcarousel -->
								<div class="ptcarousel" style="border-style: none !important; border: none !important; box-shadow: 0 0 0 0 !important; max-width: 340px;">
									<div class="controls"><a href="/" class="prev"><span class="icon-chevron-left icon-white"></span></a><a href="/" class="next"><span class="icon-chevron-right icon-white"></span></a></div>
									<ul id="ptcarousel2">
										
										<?php if(isset($evento->fichero) && !empty($evento->fichero)): ?>
										
											<?php $imagenes = explode(',', $evento->fichero); ?>
											
											<?php foreach($imagenes as $imagen): ?>
												
											<?php
						                    $ruta_imagen = 'assets/front/img/med/';
											$ruta_imagen_large = 'assets/front/img/large/';
											$ruta_placeholder = 'assets/front/img/temporal/placeholder_evento_especial.jpg';
											$fichero = (isset($imagen) && !empty($imagen) && file_exists(FCPATH.$ruta_imagen.$imagen)) ? $ruta_imagen.$imagen : $ruta_placeholder;
											$fichero_large = (isset($imagen) && !empty($imagen) && file_exists(FCPATH.$ruta_imagen_large.$imagen)) ? $ruta_imagen_large.$imagen : $ruta_placeholder;
											?>
											
											<li>
												<a href="<?php echo $fichero_large; ?>" data-rel="prettyPhoto" >
													<img style="max-width: 340px !important; max-height: 226px !important;" src="<?php echo $fichero; ?>" alt="<?php echo $evento->nombre; ?>"/>
												</a>
											</li>
											
											<?php endforeach; ?>
										
										<?php else: ?>	
											
											<li>
												<a href="assets/front/img/temporal/placeholder_evento_especial.jpg" data-rel="prettyPhoto" >
													<img style="max-width: 340px !important; max-height: 226px !important;" src="assets/front/img/temporal/placeholder_evento_especial.jpg" alt="<?php echo $evento->nombre; ?>"/>
												</a>
											</li>
											
										<?php endif; ?>
										
									</ul>
								</div>
								<!-- end ptcarousel -->
								
								<br /><br />
								
								<p><?php echo $evento->descripcion_ampliada; ?></p>
								
							</div>
							<div class="clear"></div>

						</div>
						
					<?php else: ?>
						
						<span class="span8">
	                    	<div class="error404">
							<h2><span>404</span></h2>
							<h3><?php echo lang('front.evento_notfound'); ?></h3>
							<h4> <?php echo lang('front.evento_notfound2'); ?><a href="/<?php echo lang('front.eventos_reuniones_url'); ?>"><?php echo mb_strtoupper(lang('front.eventos_reuniones')); ?></a></h4>
							</div>
	                    </span>
	                    
	                    <span class="span3" style="margin-top: 60px;">
	                    	<h5>
								<strong><?php echo lang('front.evento_notfound3'); ?></strong>
							</h5>
							<ul class="list-style2 ">
							<li><a href="/<?php echo lang('front.nosotros_url'); ?>"><?php echo lang('front.menu_nosotros'); ?></a></li>
							<li><a href="/<?php echo lang('front.promociones_url'); ?>"><?php echo lang('front.menu_promociones'); ?></a></li>
							<li><a href="/<?php echo lang('front.eventos_reuniones_url'); ?>"><?php echo lang('front.menu_eventos'); ?></a></li>
							<li><a href="/<?php echo lang('front.servicios_url'); ?>"><?php echo lang('front.menu_servicios'); ?></a></li>
							<li><a href="/<?php echo lang('front.gastronomia_url'); ?>"><?php echo lang('front.menu_gastronomia'); ?></a></li>
							<li><a href="/<?php echo lang('front.habitaciones_url'); ?>"><?php echo lang('front.menu_habitaciones'); ?></a></li>
							<li><a href="http://www.hesperia.es/nh/es/hoteles/venezuela/valencia/hesperia-wtc-valencia.html#ad-image-0"><?php echo lang('front.menu_reservar'); ?></a></li>
							<li><a href="/<?php echo lang('front.contactanos_url'); ?>"><?php echo lang('front.menu_contacto'); ?></a></li>
							</ul>
	                    </span>
						
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	</div>
</section>