
<!-- <div id="page_header" class="gradient light-gray bottom-shadow"> -->
<!--
<div id="page_header" class="gradient bottom-shadow">
	<div class="bgback bg3"></div>
	
	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="breadcrumbs fixclear">
					<li><a href="pages-process.php#"><?php echo strtoupper(lang('front.home')); ?></a></li>
					<li><?php echo strtoupper(lang('front.servicios')); ?></li>
				</ul>
			</div>
			<div class="span6">
				<div class="header-titles">
					<h2><?php echo strtoupper(lang('front.servicios')); ?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<div id="slideshow">
    
    <div class="static-content maps-style">
		<div id="google_map" style="width:100%; height:550px;"></div><!-- map container -->
		<ul id="map_controls">
			<li><a id="zoom_in"><span class="icon-plus icon-white"></span></a></li>
			<li><a id="zoom_out"><span class="icon-minus icon-white"></span></a></li>
			<li><a id="reset"><span class="icon-refresh icon-white"></span></a></li>
        </ul>
	</div>
	<div id="bottom_mask" class="mask2"></div>         
</div><!-- end slideshow -->

<section id="content">
	<div class="container">
		<div id="mainbody">
			<div class="row">
				<div class="span12">
					<h1 class="page-title"><?php echo lang('front.contacto_contactanos'); ?></h1>
						
					<div class="row">
						<div class="span6">
							<p>
								<?php echo lang('front.contacto_contactanos_desc'); ?>
							</p>
							<div id="contact_form" class="rapid_contact ">
								<form action="#" method="post" class="form-horizontal">
									<div id="success"></div>

									<div class="control-group">
										<label class="control-label" for="rp_name"><?php echo lang('front.contacto_nombre'); ?></label>
										<div class="controls">
											<input class=" inputbox input-xlarge" type="text" id="rp_name" name="rp_name" placeholder="<?php echo lang('front.contacto_nombre'); ?>" value="" />
										</div>
									</div><!-- end control group -->
									<div class="control-group">
										<label class="control-label" for="rp_email"><?php echo lang('front.contacto_email'); ?></label>
										<div class="controls">
											<input class=" inputbox input-xlarge" type="text" placeholder="<?php echo lang('front.contacto_email'); ?>" name="rp_email" id="rp_email" value="" />
										</div>
									</div><!-- end control group -->
									<div class="control-group">
										<label class="control-label" for="rp_subject"><?php echo lang('front.contacto_asunto'); ?></label>
										<div class="controls">
											<input class=" inputbox input-xlarge" type="text" name="rp_subject" placeholder="<?php echo lang('front.contacto_asunto'); ?>" id="rp_subject" value="" />
										</div>
									</div><!-- end control group -->
									<div class="control-group">
										<label class="control-label" for="rp_message"><?php echo lang('front.contacto_mensaje'); ?></label>
										<div class="controls">
											<textarea class=" textarea span4" placeholder="<?php echo lang('front.contacto_mensaje'); ?>" name="rp_message" id="rp_message"></textarea>
										</div>
									</div><!-- end control group -->
									<div class="control-group">
										<div class="controls">
											<input class=" btn " id="submit-myform" type="submit" name="submit" value="Enviar Mensaje" />
										</div>
									</div><!-- end control group -->
								</form>
							</div><!-- end contact form -->
						</div><!-- end left side -->

						<div class="span6">
							<p style="text-align: justify;"><?php echo lang('front.contacto_p1'); ?></p>
							<p style="text-align: justify;"><?php echo lang('front.contacto_p2'); ?></p>
                            <p style="text-align: justify;"><?php echo lang('front.contacto_p3'); ?></p>
                            
                            <br />
                            
							<?php echo lang('front.contacto_t1'); ?>
							<?php echo lang('front.contacto_t2'); ?>
							
						</div><!-- end right side -->

					</div><!-- end row -->
					
				</div>
			</div><!-- end row -->
			
			<div class="row">
				<div class="span12">
					<h1 class="page-title"><?php echo lang('front.contacto_experiencia') ?></h1>
					<div id="success2"></div>
					<div class="row">
						<div class="span6">
							<div id="contact_form" class="rapid_contact ">
								<form action="#" method="post" class="form-horizontal">
									<div class="control-group" style="margin-bottom: 40px;">
										<label class="control-label" for="test_name"><?php echo lang('front.contacto_nombre'); ?></label>
										<div class="controls">
											<input class=" inputbox input-xlarge" type="text" id="test_name" name="test_name" placeholder="<?php echo lang('front.contacto_nombre'); ?>" value="" />
										</div>
									</div><!-- end control group -->
									<div class="control-group" style="margin-bottom: 40px;">
										<label class="control-label" for="test_email"><?php echo lang('front.contacto_email'); ?></label>
										<div class="controls">
											<input class=" inputbox input-xlarge" type="text" placeholder="<?php echo lang('front.contacto_email'); ?>" name="test_email" id="test_email" value="" />
										</div>
									</div><!-- end control group -->
								</form>
							</div><!-- end contact form -->
						</div><!-- end left side -->

						<div class="span6">
							<div class="control-group">
								<div class="controls">
									<textarea class=" textarea span4" placeholder="<?php echo lang('front.contacto_mensaje'); ?>" name="test_message" id="test_message" maxlength="300"></textarea>
								</div>
							</div><!-- end control group -->
							<div class="control-group">
								<div class="controls">
									<input class=" btn " id="submit-testimonio" type="submit" name="submit" value="Enviar Testimonio" />
								</div>
							</div><!-- end control group -->
						</div><!-- end right side -->

					</div><!-- end row -->
					
				</div>
			</div><!-- end row -->
			
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
			
		</div><!-- end mainbody -->
		
	</div><!-- end container -->
</section><!-- end #content -->