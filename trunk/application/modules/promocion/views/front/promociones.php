		<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
        <div id="page_header" class="gradient bottom-shadow">
			<div class="bgback bg3"></div>
			
			<div class="container">
				<div class="row">
					<div class="span6">
						<ul class="breadcrumbs fixclear">
							<li><a href="/"><?php echo mb_strtoupper(lang('front.home')); ?></a></li>
							<li><?php echo mb_strtoupper(lang('front.promociones')); ?></li>
						</ul>
					</div>
					<div class="span6">
						<div class="header-titles">
							<h2><?php echo mb_strtoupper(lang('front.promociones')); ?></h2>
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
							 <p><?php echo lang('front.promociones_p1'); ?></p><br />
							 
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
						
					</div><!-- end row -->
					
				</div><!-- end mainbody -->
				
			</div><!-- end container -->
		</section><!-- end #content -->