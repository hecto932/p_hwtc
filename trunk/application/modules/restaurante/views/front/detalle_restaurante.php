
<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="/"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo mb_strtoupper(lang('front.gastronomia')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo (!empty($restaurante)) ? $restaurante->nombre : mb_strtoupper(lang('front.gastronomia')); ?></h2>
				</div>
			</div>
		</div><!-- end row -->
	</div>
</div><!-- end page_header -->

<section id="content">
	<div class="container">
		<div id="mainbody">
			
			<div class="row">
				<div class="span12">
					<?php if(!empty($restaurante)): ?>
					<div class="hg-portfolio-item">
						
						<?php if(isset($restaurante->fichero) && !empty($restaurante->fichero)): ?>
						
						<?php
						$imagenes = explode(', ', $restaurante->fichero);
						$primera = array_shift($imagenes);
						
						$ruta_imagen = 'assets/front/img/med/';
						$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
						$fichero = (isset($primera) && !empty($primera) && file_exists(FCPATH.$ruta_imagen.$primera)) ? $ruta_imagen.$primera : $ruta_placeholder;
						?>
						
                        <div class="img-full pull-right" style=" margin-left:25px;">
                            
                            <a href="<?php echo $fichero; ?>" rel="prettyPhoto" class="hoverBorder">
                                <img style="max-width: 277px !important; max-height: 174px !important;" src="<?php echo $fichero; ?>" alt="" />
                            </a>
                            <div class="clear"></div><br />
                        
                        	<!-- SOCIAL -->
                            <div class="itemSocialSharing fixclear">
                                <div class="itemTwitterButton">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
                                    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="itemFacebookButton">
                                    <div id="fb-root"></div>
                                    <script type="text/javascript">
                                        (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) {return;}
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/en_US/all.js#appId=177111755694317&xfbml=1";
                                        fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                    </script>
                                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        	<!-- SOCIAL -->
                        	
                        </div>
                        
                        <?php else: ?>
                        	
	                        <div class="img-full pull-right" style=" margin-left:25px;">
	                            <a href="assets/front/img/temporal/placeholder_restaurante.jpg" rel="prettyPhoto" class="hoverBorder">
	                                <img style="max-width: 277px !important; max-height: 174px !important;" src="assets/front/img/temporal/placeholder_restaurante.jpg" alt="" />
	                            </a>
	                            <div class="clear"></div><br />
	                        </div>
                        	
						<?php endif; ?>
						
						<h1><?php echo $restaurante->nombre; ?></h1><br />
                        <div class="text">
                        	<p style="font-size: 14px;"><?php echo $restaurante->descripcion_ampliada; ?></p>
                        </div>
                        
                        <!-- IMAGENES -->
                        <?php if(!empty($imagenes)):?>
                        <div class="clear"></div>
						<center>
                            <ul class="other-images clearfix">
                                <?php foreach($imagenes as $imagen): ?>
	                                <?php
									$ruta_imagen = 'assets/front/img/med/';
									$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
									$fichero = (isset($imagen) && !empty($imagen) && file_exists(FCPATH.$ruta_imagen.$imagen)) ? $ruta_imagen.$imagen : $ruta_placeholder;
									?>
	                                <li>
	                                    <a href="<?php echo $fichero; ?>" rel="prettyPhoto" class="hoverBorder" >
	                                        <img style="max-width: 277px !important; max-height: 174px !important;" src="<?php echo $fichero; ?>" alt="" class="shadow" />
	                                    </a>
	                                </li>
                                <?php endforeach; ?>
                            </ul><!-- other images/videos -->
                    	</center>
                    	<?php endif; ?>
                    	
                    </div><!-- end Portfolio page -->
                    
                    <?php else: ?>
                    
                    <span class="span8">
                    	<div class="error404">
						<h2><span>404</span></h2>
						<h3><?php echo lang('front.gastronomia_notfound'); ?></h3>
						<h4> <?php echo lang('front.gastronomia_notfound2'); ?><a href="/<?php echo lang('front.gastronomia_url'); ?>"><?php echo lang('front.gastronomia'); ?></a></h4>
						</div>
                    </span>
                    
                    <span class="span3" style="margin-top: 60px;">
                    	<h5>
							<strong><?php echo lang('front.gastronomia_notfound3'); ?></strong>
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
			</div><!-- end row -->
		</div><!-- end mainbody -->
	</div><!-- end container -->
</section><!-- end #content -->