   
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
							<h2><?php echo mb_strtoupper(lang('front.eventos_reuniones')); ?></h2>
						</div>
					</div>
				</div>
			</div>
			
        </div>
        
		<section id="content">
			<div class="container">
				<div id="mainbody">
					
					<div class="row">
						<div class="span9">
							 <div class="itemListView clearfix eBlog">
								<div class="itemList">
									
									<?php foreach($eventos as $evento):?>
										
										<?php
					                    $ruta_imagen = 'assets/front/img/large/';
										$ruta_placeholder = 'assets/front/img/temporal/placeholder_evento.jpg';
										$imagen = (isset($evento->fichero) && !empty($evento->fichero) && file_exists(FCPATH.$ruta_imagen.$evento->fichero)) ? $ruta_imagen.$evento->fichero : $ruta_placeholder;
										?>
										
										<div class="itemContainer">
										
											<div class="itemHeader">
												<h3 class="itemTitle">
													<?php echo $evento->nombre; ?>
												</h3>
											</div>
										
											<div class="itemBody">
												<div class="itemIntroText">
													<span style="margin-right: 20px; max-width: 100%;" ><img src="<?php echo $imagen; ?>" border="0" alt=""  /></span><br /><br />
													<p><?php echo $evento->descripcion_ampliada; ?></p>
													
												</div>
												<div class="clear"></div>
												<div class="itemReadMore">
													<a class="readMore" href="#"><!--Read more...--></a>
												</div>
												<div class="clear"></div>
											</div>
										
											<ul class="itemLinks clearfix">
												<li class="itemCategory">
													<span class="icon-folder-close"></span> 
													<span><?php echo lang('front.eventos_hotel'); ?></span>
												</li>
											</ul>
											<div class="clear"></div>
											
										</div>
										<div class="clear"></div>
									
									<?php endforeach; ?>
								
								</div><!-- end .itemList -->
							
							</div><!-- end blog items list (.itemListView) -->

						</div>
						
						<div class="span3">
							<div id="sidebar" class="sidebar-right">
								
								<div id="recent-posts-2" class="widget widget_recent_entries">
									<div class="latest_posts style3">
										<h3 class="widgettitle title"><?php echo mb_strtoupper(lang('front.eventos_promos_especiales')); ?></h3>
										<ul class="posts">
											
											<?php foreach($especiales as $especial): ?>
											
											<?php
						                    $ruta_imagen = 'assets/front/img/med/';
											$ruta_placeholder = 'assets/front/img/temporal/placeholder_promo.jpg';
											$imagen_thumb = (isset($especial->fichero1) && !empty($especial->fichero1) && file_exists(FCPATH.$ruta_imagen.$especial->fichero1)) ? $ruta_imagen.$especial->fichero1 : $ruta_placeholder;
											
											$ruta_imagen = 'assets/front/img/large/';
											$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
											$imagen_promo = (isset($especial->fichero2) && !empty($especial->fichero2) && file_exists(FCPATH.$ruta_imagen.$especial->fichero2)) ? $ruta_imagen.$especial->fichero2 : $ruta_placeholder;
											?>
											
											<li class="post">
												<a class="hoverBorder pull-left" rel="prettyPhoto" data-type="image" href="<?php echo $imagen_promo; ?>" >
													<img style="max-width: 54px; max-height: 54px;" src="<?php echo $imagen_thumb?>" alt="PROMO"/>
													<span class="icon_wrap" style="opacity: 0;"><span class="icon image"></span></span>
												</a>
												<h5><?php echo $especial->nombre; ?></h5>
												<div class="text"><?php echo character_limiter($especial->descripcion_breve, 50); ?></div>
												<br />
											</li>
											<?php endforeach; ?>
											
										</ul>
									</div>
								</div>
								
							</div>
						</div>
						
					</div><!-- end row -->
					
				</div><!-- end mainbody -->
				
			</div><!-- end container -->
		</section><!-- end #content -->