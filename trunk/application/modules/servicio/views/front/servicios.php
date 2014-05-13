<style type="text/css">.ptcarousel:after{border-style: none !important;}</style>
<style type="text/css">.ptcarousel:before{border-style: none !important;}</style>
<style type="text/css">.caroufredsel_wrapper{height: 312px !important;}</style>
<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="pages-process.php#"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo mb_strtoupper(lang('front.servicios')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo mb_strtoupper(lang('front.servicios')); ?></h2>
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
					
					<?php foreach($servicios as $servicio): ?>
						
						<div class="process_box" data-align="left">
							
							<span class="span6">
								<div class="ptcontent" style="margin-left: 30px;">
									<br /><h3 class="title"><?php echo $servicio->nombre; ?></h3><br />
									<div class="pt-cat-desc" style="margin: 0px 10px 0px 10px;">
										<p><?php echo $servicio->descripcion_ampliada; ?></p>
									</div>
								</div>
							</span>
							
							<span class="span5">
								<center>
								<br />
								<div class="ptcarousel" style="border-style: none !important; border: none !important; box-shadow: 0 0 0 0 !important;">
									<div class="controls">
										<a href="/" class="prev"><span class="icon-chevron-left icon-white"></span></a>
										<a href="/" class="next"><span class="icon-chevron-right icon-white"></span></a>
									</div>
									<ul id="ptcarousel2">
										
										<?php if(isset($servicio->fichero) && !empty($servicio->fichero)): ?>
										
											<?php $imagenes = explode(', ', $servicio->fichero)?>
											
											<?php foreach($imagenes as $imagen): ?>
												
											<?php
						                    $ruta_imagen = 'assets/front/img/large/';
											$ruta_placeholder = 'assets/front/img/temporal/placeholder_servicio.jpg';
											$fichero = (isset($imagen) && !empty($imagen) && file_exists(FCPATH.$ruta_imagen.$imagen)) ? $ruta_imagen.$imagen : $ruta_placeholder;
											?>
											
											<li>
												<a href="<?php echo $fichero; ?>" data-rel="prettyPhoto" >
													<img style="max-width: 100% !important; max-height: 100% !important;" src="<?php echo $fichero; ?>" alt="<?php echo $servicio->nombre; ?>"/>
													<br /><br /><br /><br />
													
												</a>
											</li>
											
											<?php endforeach; ?>
										
										<?php else: ?>	
											
											<li>
												<a href="assets/front/img/temporal/placeholder_servicio.jpg" data-rel="prettyPhoto" >
													<img src="assets/front/img/temporal/placeholder_servicio.jpg" alt="<?php echo $servicio->nombre; ?>"/>
												</a>
											</li>
											
										<?php endif; ?>
										
									</ul>
								</div><!-- end ptcarousel -->
								</center>
							</span>
							
							<div class="clear"></div>
						</div>
						
					<?php endforeach; ?>
				</div>
			</div><!-- end row -->
			
		</div><!-- end mainbody -->
		
	</div><!-- end container -->
</section><!-- end #content -->