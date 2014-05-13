<?php include("header.php"); ?>        
        <div id="slideshow">
	        
            <div class="static-content maps-style">
				<div id="google_map" style="width:100%; height:550px;"></div><!-- map container -->
				<ul id="map_controls">
					<li><a id="zoom_in"><span class="icon-plus icon-white"></span></a></li>
					<li><a id="zoom_out"><span class="icon-minus icon-white"></span></a></li>
					<li><a id="reset"><span class="icon-refresh icon-white"></span></a></li>
	            </ul>
			</div>
			<!-- <div id="bottom_mask" class="mask2"></div>          -->
        </div><!-- end slideshow -->
        
		<section id="content">
			<div class="container">
				
				<div id="mainbody">
					
					<div class="row">
						<div class="span12">
							<h1 class="page-title">Contáctanos</h1>
							
							<div class="row">
								<div class="span6">
									<p>Para nuestra mejora y control de calidad, es necesario saber la opinión  de nuestros huéspedes, no dude en plasmar su experiencia en el Hotel Hesperia WTC Valencia: </p>
									<div id="contact_form" class="rapid_contact ">
										<form action="pages-contact.php#" method="post" class="form-horizontal">
											<div id="success"></div>

											<div class="control-group">
												<label class="control-label" for="rp_name">Nombre</label>
												<div class="controls">
													<input class=" inputbox input-xlarge" type="text" id="rp_name" name="rp_name" placeholder="Name" value="" />
												</div>
											</div><!-- end control group -->
											<div class="control-group">
												<label class="control-label" for="rp_email">Email</label>
												<div class="controls">
													<input class=" inputbox input-xlarge" type="text" placeholder="Email" name="rp_email" id="rp_email" value="" />
												</div>
											</div><!-- end control group -->
											<div class="control-group">
												<label class="control-label" for="rp_subject">Asunto</label>
												<div class="controls">
													<input class=" inputbox input-xlarge" type="text" name="rp_subject" placeholder="Subject" id="rp_subject" value="" />
												</div>
											</div><!-- end control group -->
											<div class="control-group">
												<label class="control-label" for="rp_message">Mensaje</label>
												<div class="controls">
													<textarea class=" textarea span4" placeholder="Mensaje" name="rp_message" id="rp_message"></textarea>
												</div>
											</div><!-- end control group -->
											<div class="control-group">
												<div class="controls">
													<input class=" btn " id="submit-form" type="submit" name="submit" value="Enviar Mensaje" />
												</div>
											</div><!-- end control group -->
										</form>
									</div><!-- end contact form -->
								</div><!-- end left side -->

								<div class="span6">
									
									<p style="text-align: justify;">Estratégicamente ubicado en la Av. Salvador Feo la Cruz, a tan solo 15 minutos de Aeropuerto Internacional Arturo Michelena y a 30 min de la ciudad de Puerto Cabello.</p>
									<p style="text-align: justify;">El Hesperia WTC Valencia cuenta con exclusivas habitaciones repartidas en 15 plantas y distribuidas en diferentes categorías en la que destacan sus habitaciones Executive Suites, Junior Suites y habitaciones Deluxe con impresionantes y espectaculares vistas.</p>
                                    <p style="text-align: justify;">Su Centro de Congresos y Convenciones con más de 12.000 m2 es perfectamente adaptable a cualquier tipo de eventos de negocios como sociales contando con el equipo técnico y humano adecuado.</p>
                                    
                                    <br />
                                    
									<p><strong>Reservas: </strong> + 58 241 515 30 05 <br>
									<p><strong>Central: </strong> + 58 241 515 30 00 <br>
									
								</div><!-- end right side -->

							</div><!-- end row -->

						</div>
					</div><!-- end row -->
					
				</div><!-- end mainbody -->
				
			</div><!-- end container -->
		</section><!-- end #content -->
<?php include("footer.php"); ?>