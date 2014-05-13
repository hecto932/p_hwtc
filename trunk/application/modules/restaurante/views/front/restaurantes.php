
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
					<h2><?php echo mb_strtoupper(lang('front.gastronomia')); ?></h2>
				</div>
			</div>
		</div><!-- end row -->
	</div>
	
	<div class="shadowUP"></div>
</div><!-- end page_header -->

<section id="content">
	<div class="container">
		
		<div id="mainbody">
			
			<div class="row hg-portfolio ">
				<div class="span12">
					
					<center>
					<h3><?php echo lang('front.gastronomia_desc'); ?></h3>
					</center>
					<br /><br />
					
					<div class="hg-portfolio-sortable">

						<ul id="portfolio-nav" class="fixclear">
							<li class="current"><a href="/" data-filter="*"><?php echo lang('front.gastronomia_todo'); ?></a></li>
							<li><a href="/" data-filter=".tipo1"><?php echo lang('front.gastronomia_restaurantes'); ?></a></li>
							<li><a href="/" data-filter=".tipo2"><?php echo lang('front.gastronomia_bares'); ?></a></li>
						</ul>
						
						<div class="clear"></div>
					
						<ul id="thumbs" class="fixclear">
							
							<?php foreach($restaurantes as $restaurante): ?>
							
							 <?php
			                    $ruta_imagen = 'assets/front/img/med/';
								$ruta_imagen_large = 'assets/front/img/large/';
								$ruta_placeholder = 'assets/front/img/temporal/placeholder_restaurante.jpg';
								$imagen = (isset($restaurante->fichero) && !empty($restaurante->fichero) && file_exists(FCPATH.$ruta_imagen.$restaurante->fichero)) ? $ruta_imagen.$restaurante->fichero : $ruta_placeholder;
								$imagen_large = (isset($restaurante->fichero) && !empty($restaurante->fichero) && file_exists(FCPATH.$ruta_imagen_large.$restaurante->fichero)) ? $ruta_imagen_large.$restaurante->fichero : $ruta_placeholder;
							?>	
							
							<li class="item tipo<?php echo $restaurante->id_tipo_restaurante; ?>" style="left: 0; !important; width: 370px !important;">
								<div class="inner-item" style="min-height: 420px;">
									
									<a class="hoverLink" rel="prettyPhoto" data-type="image" href="<?php echo $imagen_large; ?>" >
										<img src="<?php echo $imagen; ?>" alt="<?php echo $restaurante->nombre; ?>"/>
										<span class="icon_wrap" style="opacity: 0;"><span class="icon image"></span></span>
									</a>
									<h4 class="title">
										<a href="/gastronomia/<?php echo $restaurante->url; ?>"><span class="name"><?php echo $restaurante->nombre; ?></span></a>
									</h4>
									<span class="moduleDesc">
										<p style="text-align: justify;"><?php echo $restaurante->descripcion_breve; ?></p>
									</span>
									<div class="clear"></div>
									
								</div>
							</li>
							<?php endforeach; ?>
							
						</ul><!-- end items list -->
					
					</div><!-- end Portfolio page -->
				</div>
			</div><!-- end row -->
			
		</div><!-- end mainbody -->
		
	</div><!-- end container -->
</section><!-- end #content -->
