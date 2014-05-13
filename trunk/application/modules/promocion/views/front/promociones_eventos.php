<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="/"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo mb_strtoupper(lang('front.promociones') . ' & '.lang('front.eventos')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo mb_strtoupper(lang('front.promociones') . ' & '.lang('front.eventos')); ?></h2>
					<!-- <h4>This would be the blog category page</h4> -->
				</div>
			</div>
		</div>
	</div>
</div><!-- end page_header -->

<style type="text/css">
	.tabs_style2 > ul.nav > li.active > a, .tabs_style2 > ul.nav > li > a:hover
	{
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #1592CC !important;
	}
</style>

<section id="content">
	<div class="container">
		<div id="mainbody">
			
			<p><?php echo lang('front.promociones_p1'); ?></p><br />
		
			<div class="tabbable tabs_style2">
				<ul class="nav fixclear">
					<li class="active"><a href="#tabs2-pane1" data-toggle="tab"><?php echo mb_strtoupper(lang('front.promociones')); ?></a></li>
					<li><a href="#tabs2-pane2" data-toggle="tab"><?php echo mb_strtoupper(lang('front.eventos_reuniones')); ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tabs2-pane1">

						<!-- PROMOCIONES -->
						<div class="row">
							<div class="span9">
								 <div class="itemListView clearfix eBlog">
									<div class="itemList">
										<div class="row-fluid">
											<?php $i = 0; ?>
											<?php foreach($promociones as $promocion): ?>
												<?php
							                    $ruta_imagen = 'assets/front/img/med/';
												$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
												$imagen = (isset($promocion->fichero) && !empty($promocion->fichero) && file_exists(FCPATH.$ruta_imagen.$promocion->fichero)) ? $ruta_imagen.$promocion->fichero : $ruta_placeholder;
												?>
												<?php $margin_left = ($i%3 == 0) ? 'margin-left: 0px;' : ''; ?>
												<div class="itemContainer span4" style="min-height: 485px; <?php echo $margin_left; ?>">
													<!-- Titulo / Imagen -->
													<div class="itemHeader">
														<center>
														<img src="<?php echo $imagen; ?>" border="0" alt=""  />
														<h3 class="itemTitle" style="font-size: 17px; line-height: 30px !important; "><?php echo $promocion->nombre; ?></h3>
														</center>
													</div>
													
													<!-- Texto -->
													<div class="itemBody">
														<div class="itemIntroText">
															<p style="text-align: justify;"><?php echo $promocion->descripcion_ampliada; ?></p>
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
					</div><!-- end TAB -->
					
					<div class="tab-pane" id="tabs2-pane2">
						
						<!-- EVENTOS -->
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
					</div><!-- end TAB -->
					
				</div><!-- /.tab-content -->
			</div><!-- /.tabbable -->
			
			
		</div>
	</div>
</section>