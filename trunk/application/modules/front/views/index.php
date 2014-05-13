		<div id="slideshow" class="gradient">
        	
			<div class = "iosSlider">
			
				<div class="slider">
					
					
					<?php $i = 1; ?>
					<?php foreach($banners as $banner):?>
						
						<?php 
							$lang_item = lang('front.banner_item'.$i);
							$item = (!empty($lang_item)) ? $lang_item : lang('front.banner_item1')
						?>
						
						 <div class = "<?php echo $item; ?>">
							
							<img src="assets/front/img/large/<?php echo $banner->fichero; ?>" alt="" /><!-- slide image -->
							
							<?php 
							$lang_efecto = lang('front.banner_efecto'.$i);
							$class = (!empty($lang_efecto)) ? $lang_efecto : lang('front.banner_efecto1')
							?>
							
	                        <div class="<?php echo $class; ?>">
	                        	<h2 class="main_title"><?php echo lang('front.banner_main_text'); ?></h2>
	                        	
	                        	<?php if($i < 4):?>
									<h3 class="title_big"><?php echo lang('front.banner'.$i.'_text1'); ?></h3>
									<a href="#" class="more"><img src="assets/front/sliders/iosslider/arr01.png" alt=""></a>
								<?php endif; ?>
								
								<?php if(strlen(lang('front.banner'.$i.'_text2')) > 0):?>
									<h4 class="title_small"><?php echo lang('front.banner'.$i.'_text2'); ?></h4>
								<?php endif; ?>
	                        </div>
						</div><!-- end item -->
						
						<?php $i++; ?>
					<?php endforeach; ?>
					
					
					<!--
                    <div class = "item">
						<img src="assets/front/img/temporal/ban1.jpg" alt="" />
                        <div class="caption style1">
                        	<h2 class="main_title"><?php echo lang('front.banner_main_text'); ?></h2>
							<h3 class="title_big"><?php echo lang('front.banner1_text1'); ?></h3>
							<a href="#" class="more"><img src="assets/front/sliders/iosslider/arr01.png" alt=""></a>
							<h4 class="title_small"><?php echo lang('front.banner1_text2'); ?></h4>
                        </div>
					</div>
					<div class = "item">
                        <img src="assets/front/img/temporal/ban2.jpg" alt="" />
                        <div class="caption style2 fromright " >
                        	<h2 class="main_title"><?php echo lang('front.banner_main_text'); ?></h2>
							<h3 class="title_big"><?php echo lang('front.banner2_text1'); ?></h3>
							<a href="#" class="more"><img src="assets/front/sliders/iosslider/arr01.png" alt=""></a>
							<h4 class="title_small"><?php echo lang('front.banner2_text2'); ?></h4>
                        </div>
					</div>
					<div class = "item">
						<img src="assets/front/img/temporal/ban3.jpg" alt="" />
                        <div class="caption style1">
                        	<h2 class="main_title"><?php echo lang('front.banner_main_text'); ?></h2>
							<h3 class="title_big"><?php echo lang('front.banner3_text1'); ?></h3>
							<a href="#" class="more"><img src="assets/front/sliders/iosslider/arr01.png" alt=""></a>
							<h4 class="title_small"><?php echo lang('front.banner3_text2'); ?></h4>
                        </div>
					</div>
                    <div class = "item itemPngBackground">
						<img src="assets/front/img/temporal/ban4.jpg" alt="" />
                        <div class="caption style3 fromright">
                        	<h2 class="main_title"><?php echo lang('front.banner_main_text'); ?></h2>
							
                            <h4 class="title_small"><?php echo lang('front.banner4_text1'); ?></h4>
                           
                        </div>
					</div>
					-->
					
				</div>
				
				<div class="prev"><div class="btn-label">PREV</div></div>
				<div class="next"><div class="btn-label">NEXT</div></div>
				<div class="selectorsBlock bullets">
					<div class="selectors">
						<div class="item first selected"></div>
						<div class="item"></div>
                        <div class="item"></div>
                        <div class="item"></div>
					</div>
				</div>
                
			</div>
			<!-- end iosSlider -->
			
            <!-- <div class="scrollbarContainer"></div> -->
            
        </div>
        <!-- end slideshow -->
        
        <!--
		<div id="action_box" data-arrowpos="center">
			<div class="container">
				<div class="row">
					<div class="span8">
						<h4 class="text">Want to be updated with our latest offers?</h4>
					</div>
					<div class="span4 align-center">
						<a href="#" class="btn">JOIN OUR NEWSLETTER</a>
					</div>
				</div>
			</div>
		</div>
		-->
		<!-- end action box -->
        
		<section id="content">
			<div class="container">
			
				<div class="row image-boxes imgboxes_style1">
                    
                    <?php foreach($restaurantes as $restaurante):?>
                    
                    <?php
                    $ruta_imagen = 'assets/front/img/med/';
					$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
					$imagen = (isset($restaurante->fichero) && !empty($restaurante->fichero) && file_exists(FCPATH.$ruta_imagen.$restaurante->fichero)) ? $ruta_imagen.$restaurante->fichero : $ruta_placeholder;
					?>
                    
                     <div class="span4 box">
						<a href="/<?php echo lang('front.gastronomia_url').'/'.$restaurante->url; ?>" class="hoverBorder">
							<img  style="width: 100%" src="<?php echo $imagen; ?>" alt="">
							<h6><?php echo lang('front.home_ver_mas'); ?></h6>
						</a>
                        <h3 class="m_title"><?php echo mb_strtoupper($restaurante->nombre); ?></h3>
                        <p><?php echo $restaurante->descripcion_breve; ?></p>
                    </div>
                    <!-- end span -->
                    
                    <?php endforeach; ?>
					
                </div>
                <!-- end row // imgboxes_style1 -->
				
                <div class="row services_box">
                	
                	<!-- Propuesta 1 -->
					
					<div class="span4">
						<div class="box fixclear">
							<div class="icon"><img src="assets/front/added_icons/hesperia-01.png" alt=""></div>
							<a href="<?php echo lang('front.nosotros_url'); ?>"><h4 class="title"><?php echo mb_strtoupper(lang('nombre_principal3')); ?></h4></a>
							<ul class="list-style1">

								<li><?php echo lang('nombre_principal4'); ?></li>
								<li><?php echo lang('front.home_nosotros_tip1'); ?></li>
								<li><?php echo lang('front.home_nosotros_tip2'); ?></li>
								
							</ul>
						</div>
					</div>

					<div class="span4">
						<div class="box fixclear">
							<div class="icon"><img src="assets/front/added_icons/home_icon3.png" alt=""></div>
							<a href="<?php echo lang('front.servicios_url'); ?>"><h4 class="title"><?php echo mb_strtoupper(lang('front.home_servicios')); ?></h4></h4></a>
							<ul class="list-style1">
								<?php foreach($servicios_front as $servicio):?>
								<li><?php echo $servicio->nombre; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					
					<div class="span4">
						<div class="box fixclear">
							<div class="icon"><img src="assets/front/added_icons/home_icon2.png" alt=""></div>
							<a href="<?php echo lang('front.eventos_reuniones_url'); ?>"><h4 class="title"><?php echo mb_strtoupper(lang('front.home_eventos')); ?></h4></a>
							<ul class="list-style1">
								<?php foreach($eventos_front as $evento):?>
								<li><?php echo $evento->nombre; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
										
				</div>
				
				<!-- Propuesta 2 -->
				<!--
				<div class="row">
					<div class="span6">
						<h3><?php echo mb_strtoupper(lang('front.home_eventos')); ?></h3>

						<?php foreach($eventos_front as $evento):?>
							<div class="acc-group style3">
								<button data-toggle="collapse" data-target="#evento<?php echo $evento->id_evento; ?>" class="collapsed"><?php echo $evento->nombre; ?></button>
								<div id="evento<?php echo $evento->id_evento; ?>" class="collapse in">
									<div class="content">
										<p><?php echo $evento->descripcion_breve; ?></p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					
					<div class="span6">
						<h3><?php echo mb_strtoupper(lang('front.home_servicios')); ?></h3>

						<?php foreach($servicios_front as $servicio):?>
							<div class="acc-group style3">
								<button data-toggle="collapse" data-target="#servicio<?php echo $servicio->id_servicio; ?>" class="collapsed"><?php echo $servicio->nombre; ?></button>
								<div id="servicio<?php echo $servicio->id_servicio; ?>" class="collapse in">
									<div class="content">
										<p><?php echo $servicio->descripcion_breve; ?></p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				-->
				
				<!-- Propuesta 3 -->
				<!--
				<br />
				<div class="row">
					<div class="span6">
						<a href="<?php echo lang('front.eventos_reuniones_url'); ?>" class="hover-box fixclear" style="min-height: 100px;">
							<img src="assets/front/images/icons/hover-boxes/ico-getquote.png" alt="">
							<h3><?php echo mb_strtoupper(lang('front.home_eventos')); ?></h3>
							<?php foreach($eventos_front as $evento):?>
							<h5 style="line-height: 10px;"><?php echo $evento->nombre; ?></h5>
							<?php endforeach; ?>							
						</a>
					</div>
					<div class="span6">
						<a href="<?php echo lang('front.servicios_url'); ?>" class="hover-box fixclear" style="min-height: 100px;">
							<img src="assets/front/images/icons/hover-boxes/ico-getquote.png" alt="" style="width: 60px; height: 60px;">
							<h3><?php echo mb_strtoupper(lang('front.home_servicios')); ?></h3>
							<?php foreach($servicios_front as $servicio):?>
							<h5 style="line-height: 10px;"><?php echo $servicio->nombre; ?></h5>
							<?php endforeach; ?>
						</a>
					</div>
				</div>
				<br /><br />
				-->
				
				<div class="row recentwork_carousel default-style">
					
					<div class="span3">
						<h3 class="m_title"><?php echo mb_strtoupper(lang('front.home_alojamiento')); ?></h3>
						<p><?php echo lang('front.home_alojamiento_desc'); ?></p>
						<div class="controls">
							<a href="#" class="prev"><span class="icon-chevron-left"></span></a>
							<a href="#" class="complete"><span class="icon-th"></span></a>
							<a href="#" class="next"><span class="icon-chevron-right"></span></a>
						</div>
					</div>
					
					<div class="span9">
						<ul id="recent_works1" class="fixclear">
							
							<?php foreach($habitaciones as $habitacion): ?>
							
							<?php
		                    $ruta_imagen = 'assets/front/img/med/';
							$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
							$imagen = (isset($habitacion->fichero) && !empty($habitacion->fichero) && file_exists(FCPATH.$ruta_imagen.$habitacion->fichero)) ? $ruta_imagen.$habitacion->fichero : $ruta_placeholder;
							?>

							<li>
								<a href="/<?php echo lang('front.habitaciones_url'); ?>">
									<span class="hover">
										<img src="<?php echo $imagen; ?>" alt="" />
										<span class="hov"></span>
									</span>
									<div class="details">
										<span class="bg"></span>
										<h4><?php echo $habitacion->nombre; ?></h4>
									</div>
								</a>
							</li>
							
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<!-- end row // recentworks_carousel default-style -->
				
				<div class="row image-boxes imgboxes_style1">
					<div class="span9">
						<div class="box">
							<a href="<?php echo lang('front.convenciones_url'); ?>">
							<h3 class="m_title"><?php echo lang('front.home_centro_convenciones'); ?></h3>
							<img style="width: 100%" src="assets/front/img/temporal/h_convenciones2.jpg" alt="">
	                    	</a>
	                    </div>
					</div>
					<div class="span3">
						<br /><br />
						<p style="text-align: justify;"><?php echo lang('front.home_centro_conven_desc'); ?></p>
					</div>
				</div>

			</div>
			
			<div class="container">
				<div class="row">
					<div class="span12">
						<div class="process_steps fixclear">
							<div class="step intro">
								<center><h4><?php echo lang('front.home_step_hotel'); ?></h4></center><br />
								<p><?php echo lang('front.home_step_hotel_desc'); ?></p>
							</div><!-- end step -->
							<div class="step step1">
								<div class="icon" data-animation="tada">
									<img src="assets/front/added_icons/paso1.png" alt="">
								</div>
								<h4><?php echo lang('front.home_step_eventos'); ?></h4>
								<p><?php echo lang('front.home_step_eventos_desc'); ?></p>
							</div><!-- end step -->
							<div class="step step2">
								<div class="icon" data-animation="tada">
									<img src="assets/front/added_icons/paso2.png" alt="">
								</div>
								<h4><?php echo lang('front.home_step_bares'); ?></h4>
								<p><?php echo lang('front.home_step_bares_desc'); ?></p>
							</div><!-- end step -->
							<div class="step step3">
								<div class="icon" data-animation="tada">
									<img src="assets/front/added_icons/paso3.png" alt="">
								</div>
								<h4><?php echo lang('front.home_step_promo'); ?></h4>
								<p><?php echo lang('front.home_step_promo_desc'); ?></p>
							</div><!-- end step -->
						</div>
					</div>
				</div><!-- end row // process_steps -->
				
				<?php if(!empty($testimonios)):?>
				<div class="row testimonials_fader">
					<div class="span3">
						<h3 class="m_title"><?php echo lang('front.contacto_testimonios'); ?></h3>
						<p><?php echo lang('front.contacto_testimonios_desc'); ?></p>
					</div>
					<div class="span9">
						<ul id="testimonials_fader" class="fixclear">
							<?php foreach($testimonios as $dato):?>
							<li>
								<blockquote><?php echo $dato->comentario?></blockquote>
								<h6><?php echo $dato->nombre; ?></h6>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div><!-- end row // testimonials_fader -->
				<br /><br /><br />
				<?php endif; ?>
				
				<!--
				<div class="row partners_carousel">
					<div class="span2">
						<h5 class="title"><span>OUR PARTNERS // TEHNOLOGIES USED</span></h5>
						<div class="controls">
							<a href="#" class="prev"><span class="icon-chevron-left"></span></a>
							<a href="#" class="next"><span class="icon-chevron-right"></span></a>
						</div>
					</div>
					<div class="span10">
						<ul id="partners_carousel" class="fixclear">
							<li><a href="#"><img src="assets/front/images/partners/css3.png" alt="" /></a></li>
							<li><a href="#"><img src="assets/front/images/partners/html5.png" alt="" /></a></li>
							<li><a href="#"><img src="assets/front/images/partners/joomla.png" alt="" /></a></li>
							<li><a href="#"><img src="assets/front/images/partners/wordpress.png" alt="" /></a></li>
							<li><a href="#"><img src="assets/front/images/partners/themeforest.png" alt="" /></a></li>
							<li><a href="#"><img src="assets/front/images/partners/jquery.png" alt="" /></a></li>
						</ul>
					</div>
				</div>
				-->
				<!-- end row // partners carousel -->
				
				<!--
				<div class="row">
					<div class="span12">
						<div class="keywordbox">just some keywords here, services or what any text you want</div>
					</div>
				</div>
				<!-- end row // keywords-->
				
			</div><!-- end container -->
		</section><!-- end #content -->