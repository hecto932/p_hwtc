
<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
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
					<h2><?php echo (!empty($habitacion)) ? $habitacion->nombre : mb_strtoupper(lang('front.habitaciones')); ?></h2>
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
					<?php if(!empty($habitacion)): ?>
					<div class="hg-portfolio-item">
						
						<?php if(isset($habitacion->fichero) && !empty($habitacion->fichero)): ?>
						
						<?php
						$imagenes = explode(', ', $habitacion->fichero);
						$primera = array_shift($imagenes);
						
						$ruta_imagen = 'assets/front/img/med/';
						$ruta_placeholder = 'assets/front/img/temporal/placeholder_habitacion.jpg';
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
	                            <a href="assets/front/img/temporal/placeholder_habitacion.jpg" rel="prettyPhoto" class="hoverBorder">
	                                <img style="max-width: 277px !important; max-height: 174px !important;" src="assets/front/img/temporal/placeholder_habitacion.jpg" alt="" />
	                            </a>
	                            <div class="clear"></div><br />
	                        </div>
                        	
						<?php endif; ?>
						
						<h1><?php echo $habitacion->nombre; ?></h1><br />
                        <div class="text">
                        	<p style="font-size: 14px;"><?php echo $habitacion->descripcion_ampliada; ?></p>
                        </div>
                        
                        <!-- IMAGENES -->
                        <?php if(!empty($imagenes)):?>
                        <div class="clear"></div>
						<center>
                            <ul class="other-images clearfix">
                                <?php foreach($imagenes as $imagen): ?>
	                                <?php
									$ruta_imagen = 'assets/front/img/med/';
									$ruta_placeholder = 'assets/front/img/temporal/placeholder_habitacion.jpg';
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
					<?php endif; ?>
				</div>
			</div><!-- end row -->
		</div><!-- end mainbody -->
	</div><!-- end container -->
</section><!-- end #content -->