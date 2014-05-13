<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<style type="text/css">.ptcarousel:after{border-style: none !important;}</style>
<style type="text/css">.ptcarousel:before{border-style: none !important;}</style>

<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="/"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo mb_strtoupper(lang('front.habitaciones')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo mb_strtoupper(lang('front.habitaciones')); ?></h2>
					<!-- <h4>This would be the blog category page</h4> -->
				</div>
			</div>
		</div>
	</div>
	
</div><!-- end page_header -->

<section id="content">
	<div class="container">
		
		<div id="mainbody">
			
			<div class="row">
				<div class="span12">
					 
					 <div class="itemListView clearfix eBlog">
						<div class="itemList">
							<div class="row-fluid">
								
								<?php $i = 1; ?>
								
								<?php foreach($habitaciones as $habitacion): ?>
									
									<?php $margin_left = ($i%2==0) ? '' : 'margin-left: 0px;'; ?>
									
									<div class="itemContainer span6" style="min-height: 550px; <?php echo $margin_left; ?>">
										<!-- Titulo / Imagen -->
										<div class="itemHeader">
											<center>
											<div class="ptcarousel" style="border-style: none !important; border: none !important; box-shadow: 0 0 0 0 !important;">
												<div class="controls">
													<a href="/" class="prev"><span class="icon-chevron-left icon-white"></span></a>
													<a href="/" class="next"><span class="icon-chevron-right icon-white"></span></a>
												</div>
												<ul id="ptcarousel2">
													
													<?php if(isset($habitacion->fichero) && !empty($habitacion->fichero)): ?>
													
														<?php $imagenes = explode(', ', $habitacion->fichero)?>
														
														<?php foreach($imagenes as $imagen): ?>
															
														<?php
									                    $ruta_imagen = 'assets/front/img/large/';
														$ruta_placeholder = 'assets/front/img/temporal/placeholder_habitacion.jpg';
														$fichero = (isset($imagen) && !empty($imagen) && file_exists(FCPATH.$ruta_imagen.$imagen)) ? $ruta_imagen.$imagen : $ruta_placeholder;
														?>
														
														<li>
															<a href="<?php echo $fichero; ?>" data-rel="prettyPhoto" >
																<img style="max-width: 540px !important; max-height: 250px !important;" src="<?php echo $fichero; ?>" alt="<?php echo $habitacion->nombre; ?>"/>
															</a>
														</li>
														
														<?php endforeach; ?>
													
													<?php else: ?>	
														
														<li>
															<a href="assets/front/img/temporal/placeholder_habitacion.jpg" data-rel="prettyPhoto" >
																<img src="assets/front/img/temporal/placeholder_habitacion.jpg" alt="<?php echo $habitacion->nombre; ?>"/>
															</a>
														</li>
														
													<?php endif; ?>
													
												</ul>
											</div><!-- end ptcarousel -->
											<h3 class="itemTitle"><a href="#"><?php echo $habitacion->nombre; ?></a></h3>
											</center>
										</div>
										
										<!-- Texto -->
										<div class="itemBody">
											<div class="itemIntroText">
												<p style="text-align: justify;"><?php echo $habitacion->descripcion_ampliada; ?></p>
											</div>
											<div class="clear"></div>
										</div>
										<div class="clear"></div>
									</div>
									
									<?php $i++; ?>
								<?php endforeach; ?>
								
							</div>
						</div>
						
					</div><!-- end blog items list (.itemListView) -->

				</div>
				
			</div><!-- end row -->
			
			<div class="row feature_box style2">
				<div class="span12">
					<h4 class="smallm_title centered bigger"><span><?php echo lang('front.habitaciones_servicios'); ?></span></h4>
				</div>
				
				<div class="span12">
					<p><?php echo lang('front.habitaciones_servicios_desc'); ?></p>
				</div>
				
				<div class="span4">
					<div class="box">
						<span class="icon"><img src="assets/front/added_icons/serv-elect.png" alt=""></span>
						<h4 class="title"><?php echo lang('front.habitaciones_electricidad'); ?></h4>
						<p><?php echo lang('front.habitaciones_electricidad_desc'); ?></p>
					</div>
					<div class="box">
						<span class="icon"><img src="assets/front/added_icons/serv_inter.png" alt=""></span>
						<h4 class="title"><?php echo lang('front.habitaciones_internet'); ?></h4>
						<p><?php echo lang('front.habitaciones_internet_desc'); ?></p>
					</div>
				</div>
				<div class="span4">
					<div class="box">
						<span class="icon"><img src="assets/front/added_icons/serv-misc-2.png" alt=""></span>
						<h4 class="title"><?php echo lang('front.habitaciones_miscelaneo'); ?></h4>
						<p><?php echo lang('front.habitaciones_miscelaneo_desc'); ?></p>
					</div>
					<div class="box">
						<span class="icon"><img src="assets/front/added_icons/serv-entret.png" alt=""></span>
						<h4 class="title"><?php echo lang('front.habitaciones_entretenimiento'); ?></h4>
						<p><?php echo lang('front.habitaciones_entretenimiento_desc'); ?></p>
					</div>
				</div>
				<div class="span4">
					<div class="box">
						<span class="icon"><img src="assets/front/added_icons/serv-bano.png" alt=""></span>
						<h4 class="title"><?php echo lang('front.habitaciones_bano'); ?></h4>
						<p><?php echo lang('front.habitaciones_bano_desc'); ?></p>
					</div>
				</div>
			</div><!-- end row // feature_box style2 -->
			
		</div><!-- end mainbody -->
		
	</div><!-- end container -->
</section><!-- end #content -->