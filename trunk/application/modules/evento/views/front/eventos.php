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
						<div class="span12">
							 <div class="itemListView clearfix eBlog">
								<div class="itemList">
									<div class="row-fluid">
										<?php $i = 0; ?>
										<?php foreach($eventos as $evento): ?>
											
											<?php
											/*
						                    $ruta_imagen = 'assets/front/img/med/';
											$ruta_imagen_large = 'assets/front/img/large/';
											$ruta_placeholder = 'assets/front/img/temporal/placeholder_evento_especial.jpg';
											$imagen = (isset($evento->fichero) && !empty($evento->fichero) && file_exists(FCPATH.$ruta_imagen.$evento->fichero)) ? $ruta_imagen.$evento->fichero : $ruta_placeholder;
											$imagen_large = (isset($evento->fichero) && !empty($evento->fichero) && file_exists(FCPATH.$ruta_imagen_large.$evento->fichero)) ? $ruta_imagen_large.$evento->fichero : $ruta_placeholder;*/
											?>
											
											<?php $margin_left = ($i%3 == 0) ? 'margin-left: 0px;' : ''; ?>
											<div class="itemContainer span4" style="min-height: 420px; <?php echo $margin_left; ?>">
												<!-- Titulo / Imagen -->
												<div class="itemHeader">
													<center>
													<div class="ptcarousel" style="border-style: none !important; border: none !important; box-shadow: 0 0 0 0 !important;">
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
													</div><!-- end ptcarousel -->
													<h3 class="itemTitle" style="font-size: 17px; line-height: 30px !important; "><a href="<?php echo '/'.lang('front.eventos_reuniones_url').'/'.$evento->url; ?>"><?php echo $evento->nombre; ?></a></h3>
													</center>
												</div>
												
												<!-- Texto -->
												<div class="itemBody">
													<div class="itemIntroText">
														<p style="text-align: justify;"><?php echo $evento->descripcion_breve; ?></p>
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
					
				</div><!-- end mainbody -->
				
			</div><!-- end container -->
		</section><!-- end #content -->