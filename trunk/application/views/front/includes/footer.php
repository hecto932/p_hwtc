        
<footer id="footer">
	<div class="container">
		
		<div class="row">
			
			<!-- span4 -->
			<div class="span3">
				
				<!--
				<div class="newsletter-signup">
					<h3 class="m_title"><?php echo lang('front.footer_newsletter'); ?></h3>
					<p><?php echo lang('front.footer_newsletter_desc'); ?></p><br />
					<form method="post" id="newsletter_subscribe" name="newsletter_form">
						<input type="text" name="nl-email" id="nl-email" value="" placeholder="email.address@email.com" />
						<input type="submit" name="submit" id="nl-submit" value="Únete" />
					</form> -->
					<!-- <span id="result">* it really works! Mailchimp Integration.</span> -->
					<!-- <p><small>We never spam!</small></p> -->
				<!-- </div> -->
				
				<!-- Redes Sociales -->
				<!-- <li style="display: inline-block; margin: 5px;"><a><img src="assets/front/img/redes/fff.png" /></a></li> -->
				<!-- <li style="display: inline-block; margin: 5px;"><a><img src="assets/front/img/redes/iii.png" /></a></li> -->
				<ul style="list-style-type: none;">
					<h3 class="m_title"><?php echo lang('front.footer_redes'); ?></h3>
					<li style="display: inline-block; margin: 5px;" ><a target="_blank" href="<?php echo lang('twitter_url'); ?>" ><img src="assets/front/img/redes/ttt-big.png" /></a></li>
					<li style="display: inline-block; margin: 5px;"><a href="http://www.tripadvisor.com.ve/Hotel_Review-g316069-d2065193-Reviews-Hesperia_WTC_Valencia-Valencia_Central_Region.html"><img src="assets/front/img/redes/trip-big.png" /></a></li>
				</ul>
				
			</div>
			
			<!-- span5 -->
			<div class="span6">
				
				<!-- Redes Sociales -->
				<!-- <li style="display: inline-block; margin: 5px;"><a><img src="assets/front/img/redes/fff.png" /></a></li> -->
				<!-- <li style="display: inline-block; margin: 5px;"><a><img src="assets/front/img/redes/iii.png" /></a></li> -->
				<!--
				<ul style="list-style-type: none;">
					<h3 class="m_title"><?php echo lang('front.footer_redes'); ?></h3>
					<li style="display: inline-block; margin: 5px;" ><a target="_blank" href="<?php echo lang('twitter_url'); ?>" ><img src="assets/front/img/redes/ttt.png" /></a></li>
					<li style="display: inline-block; margin: 5px;"><a href="http://www.tripadvisor.com.ve/Hotel_Review-g316069-d2065193-Reviews-Hesperia_WTC_Valencia-Valencia_Central_Region.html"><img src="assets/front_old/img/redes/trip.png" /></a></li>
				</ul>
				-->
					
				<!-- Twitter feeds -->
				<div class="twitter-feed">
					<div class="tweets" id="twitterFeed">
						<small>Please wait whilst our latest tweets load</small>
					</div>
					<a target="_blank" href="<?php echo lang('twitter_url'); ?>" class="twitter-follow-button" data-show-count="false">@<?php echo lang('twitter_user'); ?></a><!-- follow button -->
				</div>
				
			</div>
			
			<!-- Contactanos + Visitanos --> 
			<div class="span3">
				<div class="contact-details">
					<h3 class="m_title"><?php echo lang('front.footer_contacto'); ?></h3>
					<p><?php echo lang('front.footer_reservas'); ?>: <strong><?php echo lang('front.footer_reservas_num'); ?></strong><br />
					<?php echo lang('front.footer_central'); ?>: &nbsp;&nbsp; <strong><?php echo lang('front.footer_central_num'); ?> </strong><br />
					<?php echo lang('front.footer_email'); ?>: <a href="mailto:<?php echo lang('front.footer_email_dir'); ?>"><?php echo lang('front.footer_email_dir'); ?></a></p>
					<!-- <h3 class="m_title"><?php echo lang('front.footer_visitanos'); ?></h3> -->
					<?php echo lang('front.footer_visitanos_dir'); ?></p>
					<p><a href="http://goo.gl/maps/Nv8ou" target="_blank" class="map-link"><span class="icon-map-marker icon-white"></span> Google Maps</a></p>
				</div>
			</div>
			
		</div>
		

		<?php /* ?>
		<div class="row">
			
			<div class="span6">
				<div class="twitter-feed">
					<!-- twitter feeds -->
					<div class="tweets" id="twitterFeed"><small>Please wait whilst our latest tweets load</small></div>
					<a href="https://twitter.com/hogash" class="twitter-follow-button" data-show-count="false">Follow @hogash</a><!-- follow button -->
				</div><!-- end twitter-feed -->
			</div>
			
			<div class="span6">
				<ul class="social-share fixclear">
					<li class="sc-facebook">
						<div class="fb-like" data-href="http://facebook.com/hogash.themeforest" data-send="false" data-layout="button_count" data-width="120" data-show-faces="false" data-font="lucida grande"></div>
					</li><!-- facebook like -->
					<li class="sc-twitter">
						<a href="https://twitter.com/share" class="twitter-share-button" data-text="Check out this awesome template KALLYAS" data-via="hogash" data-hashtags="template">Tweet</a>
					</li><!-- tweet button -->
					<li class="sc-gplus">
						<script type="text/javascript">
						(function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						})();
						</script>
						<div class="g-plusone" data-size="medium"></div>
					</li><!-- Gogle Plus Button -->
					<li class="sc-pinterest">
						<a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fhogash.com%2Fdemo%2Fkalypso_html%2F&amp;media=http%3A%2F%2Fhogash.com%2Fdemo%2Fkalypso_html%2Fimages%2Fsite_images%2Fscr-carousel%2Fimg2.jpg&amp;description=Kallyas%20Template" class="pin-it-button" count-layout="horizontal"><img src="http://assets/front.pinterest.com/images/PinExt.png" title="Pin It" alt="Pin It" /></a>
						<script type="text/javascript" src="//assets/front.pinterest.com/js/pinit.js"></script>
						<!-- generate yours at: http://pinterest.com/about/goodies/ -->
					</li><!-- Pin IT Button -->
				</ul>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><!-- twitter script -->
			</div>
			
		</div><!-- end row -->
		<?php */ ?>
		
		
		<!-- SIte map -->
		<div class="row">
			<div class="span3">
				<div class="sitemap">
					<ul>
						<li><a href="/"><?php echo lang('front.menu_home'); ?></a></li>
						<li><a href="/<?php echo lang('front.nosotros_url'); ?>"><?php echo lang('front.menu_nosotros'); ?></a></li>
						<li><a href="/<?php echo lang('front.habitaciones_url'); ?>"><?php echo lang('front.menu_habitaciones'); ?></a></li>
						<li><a href="http://www.hesperia.es/nh/es/hoteles/venezuela/valencia/hesperia-wtc-valencia.html"><?php echo lang('front.menu_reservar'); ?></a></li>
						<li><a href="/<?php echo lang('front.contactanos_url'); ?>"><?php echo lang('front.menu_contacto'); ?></a></li>
					</ul>
				</div>
			</div>
			<div class="span3">
				<div class="sitemap">
					<ul>
						<li><a href="/<?php echo lang('front.servicios_url'); ?>"><?php echo lang('front.menu_servicios'); ?></a>
							<ul>
								<?php foreach($servicios_foo as $servicio):?>
								<li><a href="/<?php echo lang('front.servicios_url'); ?>"><?php echo $servicio->nombre; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="span3">
				<div class="sitemap">
					<ul>
						<li><a href="/<?php echo lang('front.eventos_reuniones_url'); ?>"><?php echo lang('front.menu_eventos'); ?></a>
							<ul>
								<?php foreach($eventos_foo as $evento):?>
								<li><a href="/<?php echo lang('front.eventos_reuniones_url'); ?>"><?php echo $evento->nombre; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="span3">
				<div class="sitemap">
					<ul>
						<li><a href="/<?php echo lang('front.gastronomia_url'); ?>"><?php echo lang('front.menu_gastronomia'); ?></a>
							<ul>
								<?php foreach($restaurantes_foo as $restaurante):?>
								<li><a href="/<?php echo lang('front.gastronomia_url'); ?>"><?php echo $restaurante->nombre; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="span12" style="font-size: 10px;">
				<center>
				<p><?php echo lang('front.footer_rif_info'); ?></p>
				<p><?php echo lang('front.footer_gobierno'); ?></p>
				</center>
			</div>
		</div>
		
		<div class="row">
			<div class="span12">
				<div class="bottom fixclear">
					<div class="span1">
						<a href="" class="logo">
							<img alt="Wintech" src="assets/front/img/temporal/wintech.png">
						</a>
					</div>
					<div class="span7">
						<p><?php echo '2014. Todos los derechos reservados. Website desarrollado por WINTECH®'; ?></p>
					</div>
				</div>
			</div>
		</div><!-- end row -->
		
	</div>
</footer>
        
    </div><!-- end page_wrapper -->
	
    <a href="#" id="totop">TOP</a>

<!--////////////////// Load JS Files -->

<script src = "assets/front/sliders/iosslider/jquery.iosslider.min.js"></script>
<script src = "assets/front/sliders/iosslider/jquery.iosslider.kalypso.js"></script><!-- some extended functionalities -->
<script type="text/javascript">
;(function($){
	$(document).ready(function() {

		$('.iosSlider').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			keyboardControls: true,
			navNextSelector: $('.next'),
			navPrevSelector: $('.prev'),
			navSlideSelector: $('.selectors .item'),
			scrollbar: true,
			scrollbarContainer: '#slideshow .scrollbarContainer',
			scrollbarMargin: '0',
			scrollbarBorderRadius: '4px',
			onSlideComplete: slideComplete,
			onSliderLoaded: function(args){
				var otherSettings = {
					hideControls : true, // Bool, if true, the NAVIGATION ARROWS will be hidden and shown only on mouseover the slider
					hideCaptions : false  // Bool, if true, the CAPTIONS will be hidden and shown only on mouseover the slider
				}
				sliderLoaded(args, otherSettings);
			},
			onSlideChange: slideChange,
			infiniteSlider: true,
			autoSlide: true
		});
	
	}); // end doc ready
})(jQuery);
</script>

<!-- IMPORTANTE PARA TODOS LOS TIPOS DE CARUSEL -->
<script src="assets/front/js/jquery.carouFredSel.js" type="text/javascript"></script>
<!-- -------------------------------------------- -->

<script type="text/javascript" language="javascript">
;(function($) {
	$(window).load(function(){
		// ** Testimonials carousel
		$('#testimonials_carousel').carouFredSel({
			responsive: true,
			items: {
				width: 300
			},
			auto: true,
			prev	: {	
				button	: ".testimonials-carousel .prev",
				key		: "left"
			},
			next	: { 
				button	: ".testimonials-carousel .next",
				key		: "right"
			}
		});
		// *** end testimonials carousel
		
		// ** Testimonials fader
		$('#testimonials_fader').carouFredSel({
			responsive:true,
			auto: {timeoutDuration: 5000},
			scroll: { fx: "fade", duration: "1500" }
		});
		// *** end testimonials fader
	});
})(jQuery);
</script>

<!-- Contact Form code -->
<!-- <script src="assets/front/js/contact_form.js" type="text/javascript"></script> -->

<!-- Start Google Maps code -->
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script src="assets/front/js/mapmarker.jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
	(function($){
		$(document).ready(function() {
			var myMarkers = {
				"markers": [
					{
						"latitude": "10.234434",		// latitude
						"longitude":"-68.005598",		// longitude
						"icon": "assets/front/images/map_pin_2.png"	// Pin icon
					}
					/* 

					Add as plenty as you want:
					, {
						"latitude": "40.712785",
						"longitude":"-73.962708",
						"icon": "images/map_pin_1.png"
					}
					
					*/
				]
			};
			$("#google_map").mapmarker({
				zoom : 17,							// Zoom
				center: "10.234434, -68.005598",		// Center of map
				type: "ROADMAP",					// Map Type
				controls: "HORIZONTAL_BAR",			// Controls style
				dragging:1,							// Allow dragging?
				mousewheel:0,						// Allow zooming with mousewheel
				markers: myMarkers,
				styling: 0,							// Bool - do you want to style the map?
				featureType:"all",
				visibility: "on",
				elementType:"geometry",
				hue:"#00AAFF",
				saturation:-100,
				lightness:0,
				gamma:1,
				navigation_control:0
				/*
				To play with the map colors and styles you can try this tool right here http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
				*/
			});
			
		});
	})(jQuery);
	</script>
<!-- END Google Maps code -->

<script type="text/javascript" language="javascript">
;(function($) {
	$(window).load(function(){
		// ** Portfolio Carousel
		var carousels = $('#ptcarousel1, #ptcarousel2');
		carousels.each(function(index, element) {
			$(this).carouFredSel({
				responsive: true,
				items: { width: 570 },
				prev	: {	button : $(this).parent().find('a.prev'), key : "left" },
				next	: { button : $(this).parent().find('a.next'), key : "right" },
				auto: {timeoutDuration: 5000},
				scroll: { fx: "crossfade", duration: "1500" }
			});	
		});
		// *** end Portfolio Carousel
	});
})(jQuery);
</script>


<!-- Carousels (by CarouFredSel) -->
<script type="text/javascript">
;(function($) {
	// ** partners carousel
	$('#partners_carousel').carouFredSel({
		responsive: true,
		scroll: 1,
		auto: false,
		items: {
			width: 250,
			visible: {
				min: 3,
				max: 10
			}
		},
		prev	: {	
			button	: ".partners_carousel .prev",
			key		: "left"
		},
		next	: { 
			button	: ".partners_carousel .next",
			key		: "right"
		}
	});
	// *** end partners carousel
	$(window).load(function(){
		// ** recent works
		$('#recent_works1').carouFredSel({
			responsive: true,
			scroll: 1,
			auto: false,
			items: {
				width: 300,
				visible: {
					min: 3,
					max: 10
				}
			},
			prev	: {	
				button	: ".recentwork_carousel .prev",
				key		: "left"
			},
			next	: { 
				button	: ".recentwork_carousel .next",
				key		: "right"
			}
		});
		// *** end recent works carousel
	});
})(jQuery);
</script>
<!-- end Carousels (by CarouFredSel) -->

<!-- jQuery Isotope Plugin // loaded for sortable portfolio -->
	<script src="assets/front/js/jquery.isotope.min.js" type="text/javascript"></script>
    <script type="text/javascript">
	(function($){ 
		$(window).load(function(){
			
			// settings
			var sortBy = 'date', 			// SORTING: date / name
				sortAscending = true, 		// SORTING ORDER: true = Ascending / false = Descending
				theFilter = '';	// DEFAULT FILTERING CATEGORY 
				
			$('#sortBy li a').each(function(index, element) {
				var $t = $(this);
				if($t.attr('data-option-value') == sortBy)
					$t.addClass('selected');
			});
			$('#sort-direction li a').each(function(index, element) {
				var $t = $(this);
				if($t.attr('data-option-value') == sortAscending.toString())
					$t.addClass('selected');
			});
			$('#portfolio-nav li a').each(function(index, element) {
				var $t = $(this),
					tpar = $t.parent();
				if($t.attr('data-filter') == theFilter) {
					$('#portfolio-nav li a').parent().removeClass('current');
					tpar.addClass('current');
				}
			});
					
			// don't edit below unless you know what you're doing
			if ($("ul#thumbs").length > 0){
				var $container = $("ul#thumbs");
				$container.isotope({
				  itemSelector : ".item",
				  animationEngine : "jquery",
				  animationOptions: {
					  duration: 250,
					  easing: "easeOutExpo",
					  queue: false
				  },
				  filter: theFilter,
				  sortAscending : sortAscending,
				  getSortData : {
					  name : function ( $elem ) {
						  return $elem.find("span.name").text();
					  },
					  date : function ( $elem ) {
						  return $elem.attr("data-date");
					  }
				  },
				  sortBy: sortBy
				});
				
			}
		});
	})(jQuery);
	</script>
<!-- end jQuery Isotope Plugin -->


<!-- JavaScript at the bottom for fast page loading -->

<script type="text/javascript" src="assets/front/js/bootstrap.min.js"></script><!-- Bootstrap Framework -->
<script type="text/javascript" src="assets/front/js/plugins.js"></script><!-- jQuery Plugins -->
<script type="text/javascript" src="assets/front/addons/superfish_responsive/superfish_menu.js"></script><!-- Superfish Menu -->


<script type="text/javascript" src="assets/front/js/kalypso_script.js"></script><!-- custom scripts file -->

<!-- prettyphoto scripts & styles -->
<link rel="stylesheet" href="assets/front/addons/prettyphoto/prettyPhoto.css" type="text/css" />
<script type="text/javascript" src="assets/front/addons/prettyphoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript">

	function ppOpen(panel, width){
		jQuery.prettyPhoto.close();
		setTimeout(function() {
			jQuery.fn.prettyPhoto({social_tools: false, deeplinking: false, show_title: false, default_width: width, theme:'pp_kalypso'});
			jQuery.prettyPhoto.open(panel);
		}, 300);
	} // function to open different panel within the panel
	
	jQuery(document).ready(function($) {
		jQuery("a[data-rel^='prettyPhoto'], .prettyphoto_link").prettyPhoto({theme:'pp_kalypso',social_tools:false, deeplinking:false});
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({theme:'pp_kalypso'});
		jQuery("a[data-rel^='prettyPhoto[login_panel]']").prettyPhoto({theme:'pp_kalypso', default_width:800, social_tools:false, deeplinking:false});
		
		jQuery(".prettyPhoto_transparent").click(function(e){
			e.preventDefault();
			jQuery.fn.prettyPhoto({social_tools: false, deeplinking: false, show_title: false, default_width: 980, theme:'pp_kalypso transparent', opacity: 0.95});
			jQuery.prettyPhoto.open($(this).attr('href'),'','');
		});
		
	});

</script>
<!--end prettyphoto -->

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
	s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<!--
<div class="hide">
	<div id="transparent_panel" class="transparent_content">
		<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
		<p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
		<p>When, while the lovely valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my trees, and but a few stray gleams steal into the inner sanctuary, I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image.</p>
		<p>Duis dictum tristique lacus, id placerat dolor lobortis sed. In nulla lorem, accumsan sed mollis eu, dapibus non sapien. Curabitur eu adipiscing ipsum. Mauris ut dui turpis, vel iaculis est. Morbi molestie fermentum sem quis ultricies. Mauris ac lacinia sapien. Fusce ut enim libero, vitae venenatis arcu. Cras viverra, libero a fringilla gravida, dolor enim cursus turpis, id sodales sem justo sit amet lectus. Fusce ut arcu eu metus lacinia commodo. Proin cursus ornare turpis, et faucibus ipsum egestas ut. Maecenas aliquam suscipit ante non consectetur. Etiam quis metus a dolor vehicula scelerisque.</p>
		<p>Nam elementum consequat bibendum. Suspendisse id semper odio. Sed nec leo vel ligula cursus aliquet a nec nulla. Sed eu nulla quam. Etiam quis est ut sapien volutpat vulputate. Cras in purus quis sapien aliquam viverra et volutpat ligula. Vestibulum condimentum ultricies pharetra. Etiam dapibus cursus ligula quis iaculis. Mauris pellentesque dui quis mi fermentum elementum sodales libero consequat. Duis eu elit et dui varius bibendum. Sed interdum nisl in ante sollicitudin id facilisis tortor ullamcorper. Etiam scelerisque leo vel elit venenatis nec condimentum ipsum molestie. In hac habitasse platea dictumst. Sed quis nulla et nibh aliquam cursus vitae quis enim. Maecenas eget risus turpis.</p>
	</div>
</div><!-- end transparent panel -->

<?php if(isset($contacto_js) && !empty($contacto_js)) echo $contacto_js; ?>

</body>
</html>