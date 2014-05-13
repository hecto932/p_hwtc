<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-gb" class="no-js"> <!--<![endif]-->

<head>
	<base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
	<meta charset="utf-8" />
	<meta name="description" content="Pagina principal de HesperiaWTC" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HesperiaWTC</title>
	
	<link rel="stylesheet" href="assets/front_old/css/template.css" type="text/css" />
	<link rel="stylesheet" href="assets/front_old/css/responsive-devices.css" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900&amp;v1&mp;subset=latin,latin-ext" type="text/css" media="screen" id="google_font" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700&amp;v1&mp;subset=latin,latin-ext" type="text/css" media="screen" id="google_font_body" />
	
	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="assets/front_old/js/jquery-1.8.2.min.js">\x3C/script>')</script>
	<script src="assets/front_old/js/jquery.noconflict.js" type="text/javascript"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.1/modernizr.min.js" type="text/javascript"></script>
	
	<link rel="shortcut icon" href="assets/front_old/added_icons/favicon.png">
	<link rel="apple-touch-icon" href="assets/front_old/images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/front_old/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/front_old/images/favicons/apple-touch-icon-114x114.png">
	
	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="css/fixes.css" />
	<![endif]-->

	<!--[if lte IE 8]>
		<script src="js/respond.js"></script>
		<script type="text/javascript"> 
		var $buoop = {vs:{i:8,f:6,o:10.6,s:4,n:9}} 
		$buoop.ol = window.onload; 
		window.onload=function(){ 
		 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
		 var e = document.createElement("script"); 
		 e.setAttribute("type", "text/javascript"); 
		 e.setAttribute("src", "http://browser-update.org/update.js"); 
		 document.body.appendChild(e); 
		} 
		</script> 
	<![endif]-->
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Facebook OpenGraph Tags - Replace with your own -->
	<meta property="og:title" 		content="KALLYAS Template HTML"/>
	<meta property="og:type" 		content="website"/>
	<meta property="og:url" 		content="http://www.hogash-demos.com/kalypso_html/"/>
	<meta property="og:image" 		content="http://www.hogash-demos.com/kalypso_html/images/logo.png"/>
	<meta property="og:site_name" 	content="Kallyas"/>
	<meta property="fb:app_id" 		content=""/> <!-- PUT HERE YOUR OWN APP ID - you could get errors if you don't use this one -->
	<meta property="og:description" content="Welcome to KALLYAS Template, a wonderful and premium product for multipurpose websites"/>
	<!-- END Facebook OpenGraph Tags -->
	
	<!-- THIS IS THE DARK THEME STYLESEET // REMOVE COMMENTS TO ENABLE -->
	<!-- <link rel="stylesheet" href="css/dark-theme.css" type="text/css" /> -->
	<!-- END DARK THEME -->
	
	<script type="text/javascript">
		var _gaq = _gaq || [];
	  	_gaq.push(['_setAccount', 'UA-4777573-29']);
	  	_gaq.push(['_trackPageview']);
	  	
	  	(function()
	  	{
	    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	
	<!-- Custom page stylesheets -->
	<link rel="stylesheet" href="assets/front_old/sliders/iosslider/style.css" type="text/css" />
	<!-- end custom page stylesheets -->
    
</head>

<body class="">
    <!-- ADD AN APPLICATION ID !!
	If you want to know how to find out your app id, either search on google for: facebook appid, either go to http://rieglerova.net/how-to-get-a-facebook-app-id/ -->
	
	<div id="fb-root"></div>
	<script>
		(function(d, s, id)
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "assets/front_old/js/all.js#xfbml=1&appId=227862407254187"; // addyour appId here
			fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
	</script> 
	   
    <div class="support_panel" id="sliding_panel">
		<div class="container">
			<div class="row">
				<div class="span9">
					<h4 class="m_title">HOW TO SHOP</h4>
					<div class="m_content how_to_shop">
						<div class="row">
							<div class="span3">
								<span class="number">1</span> Login or create new account.
							</div>
							<div class="span3">
								<span class="number">2</span> Review your order.
							</div>
							<div class="span3">
								<span class="number">3</span> Payment &amp; <strong>FREE</strong> shipment
							</div>
						</div>
						<p>If you still have problems, please let us know, by sending an email to support@website.com . Thank you!</p>
					</div><!-- end how to shop steps -->
				</div>
				<div class="span3">
					<h4 class="m_title">SHOWROOM HOURS</h4>
					<div class="m_content">
						Mon-Fri 9:00AM - 6:00AM<br>
						Sat - 9:00AM-5:00PM<br>
						Sundays by appointment only!
					</div>
				</div>
			</div>
		</div>
	</div><!-- end support panel -->
    
	<div class="login_register_stuff hide"><!-- Login/Register Modal forms - hidded by default to be opened through modal -->
		<div id="login_panel">
			<div class="inner-container login-panel">
				<h3 class="m_title">SIGN IN YOUR ACCOUNT TO HAVE ACCESS TO DIFFERENT FEATURES</h3>
				<form id="login_form" name="login_form" method="post">
					<a href="index.html#" class="create_account" onClick="ppOpen('#register_panel', '280');">CREATE ACCOUNT</a>
					<input type="text" id="username" name="username" class="inputbox" placeholder="Username">
					<input type="password" id="password" name="password" class="inputbox" placeholder="Password">
					<input type="submit" id="login" name="submit" value="LOG IN">
					<a href="index.html#" class="login_facebook">login with facebook</a>
				</form>
				<div class="links"><a href="index.html#" onClick="ppOpen('#forgot_panel', '350');">FORGOT YOUR USERNAME?</a> / <a href="index.html#" onClick="ppOpen('#forgot_panel', '350');">FORGOT YOUR PASSWORD?</a></div>
			</div>
		</div><!-- end login panel -->

		<div id="register_panel">
			<div class="inner-container register-panel">
				<h3 class="m_title">CREATE ACCOUNT</h3>
				<form id="register_form" name="register_form" method="post">
					<p>
						<input type="text" id="reg-username" name="username" class="inputbox" placeholder="Username">
					</p>
					<p>
						<input type="text" id="fullname" name="fullname" class="inputbox" placeholder="Your full name">
					</p>
					<p>
						<input type="text" id="reg-email" name="email" class="inputbox" placeholder="Your email">
					</p>
                    <p>
						<input type="password" id="reg-password" name="password" class="inputbox" placeholder="Desired password">
					</p>
					<p>
						<input type="password" id="confirm_password" name="confirm_password" class="inputbox" placeholder="Confirm password">
					</p>
					<p>
						<input type="submit" id="signup" name="submit" value="CREATE MY ACCOUNT">
					</p>
				</form>
				<div class="links"><a href="index.html#" onClick="ppOpen('#login_panel', '800');">ALREADY HAVE AN ACCOUNT?</a></div>
			</div>
		</div><!-- end register panel -->

		<div id="forgot_panel">
			<div class="inner-container forgot-panel">
				<h3 class="m_title">FORGOT YOUR DETAILS?</h3>
				<form id="forgot_form" name="forgot_form" method="post">
					<p>
						<input type="text" id="forgot-email" name="email" class="inputbox" placeholder="Email Address">
					</p>
					<p>
						<input type="submit" id="recover" name="submit" value="SEND MY DETAILS!">
					</p>
				</form>
				<div class="links"><a href="index.html#" onClick="ppOpen('#login_panel', '800');">AAH, WAIT, I REMEMBER NOW!</a></div>
			</div>
		</div><!-- end register panel -->
	</div><!-- end login register stuff -->
    
	<div id="page_wrapper">

		<header id="header" class="style2">
			<div class="container">

				<!-- logo -->
				<h1 id="logo"><a href="maquetacion/index.php"><img src="assets/front_old/images/logo.png" alt="Kallyas HTML Template"></a></h1>
				
				<div style="height: 50px;"></div>
				
				<!--
				<ul class="topnav navRight">
					<li>
						<a href="#" id="open_sliding_panel"><span class="icon-remove-circle icon-white"></span> SUPPORT</a>
					</li>
					<li>
						<a href="index.html#login_panel" data-rel="prettyPhoto[login_panel]">LOGIN</a>
					</li>
				</ul>
				
				<ul class="topnav navLeft">
					<li class="drop">
						<a href="index.html#">MY CART</a>
						<div class="pPanel">
							<div class="inner">
								<span class="cart_details">3 items, Total of <strong>$599 USD</strong> <a href="index.html#" class="checkout">Checkout <span class="icon-chevron-right"></span></a></span>
							</div>
						</div>
					</li>
					<li class="languages drop">
						<a href="index.html#"><span class="icon-globe icon-white"></span> LANGUAGES</a>
						<div class="pPanel">
							<ul class="inner">
								<li class="active"><a href="index.html#">English <span class="icon-ok"></span></a></li>
								<li><a href="index.html#">French</a></li>
								<li><a href="index.html#">German</a></li>
							</ul>
						</div>
					</li>
				</ul>
				-->
				
				<!-- search 
				<div id="search">
					<a href="index.html#" class="searchBtn"><span class="icon-search icon-white"></span></a>
					<div class="search">
						<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)" target="_blank">
							<input name="q" type="hidden" />
							<input name="qfront" maxlength="20" class="inputbox" type="text" size="20" value="SEARCH ..." onblur="if (this.value=='') this.value='SEARCH ...';" onfocus="if (this.value=='SEARCH ...') this.value='';" />
							<input type="submit" value="go" class=" icon-search"/>
						</form>
					</div>
				</div><!-- end search -->
                
				<script type="text/javascript">
				// THIS SCRIPT DETECTS THE ACTIVE ELEMENT AND ADDS ACTIVE CLASS
				(function($){ 
					$(document).ready(function(){
						var pathname = window.location.pathname,
							page = pathname.split(/[/ ]+/).pop(),
							menuItems = $('#main_menu a');
						menuItems.each(function(){
							var mi = $(this),
								miHrefs = mi.attr("href"),
								miParents = mi.parents('li');
							if(page == miHrefs) {
								miParents.addClass("active").siblings().removeClass('active');
							}
						});
					});
				})(jQuery);
				</script>
				
				<nav id="main_menu">
					<ul class="sf-menu clearfix">
						<!-- <li><a href="maquetacion/">INICIO</a></li> -->
						<li><a href="maquetacion/nosotros.php">NOSOTROS</a></li>
						<li><a href="maquetacion/promociones.php">PROMOCIONES</a></li>
						<li><a href="maquetacion/eventos.php">EVENTOS</a></li>
						<li><a href="maquetacion/servicios.php">SERVICIOS</a></li>
						<li><a href="maquetacion/gastronomia.php">GASTRONOMÍA</a></li>
						<li><a href="maquetacion/habitaciones.php">HABITACIONES</a></li>
						<li><a href="http://www.hesperia.es/nh/es/hoteles/venezuela/valencia/hesperia-wtc-valencia.html" target="_blank">RESERVAR</a></li>
						<li><a href="maquetacion/contacto.php">CONTÁCTO</a></li>
					</ul>
				</nav><!-- end main_menu -->
				
				<!--
				<nav id="main_menu">
					<ul class="sf-menu clearfix">
						<li class="active"><a href="index.php">HOME</a>
							<ul>
								<li><a href="homepage2.php">Homepage 2</a></li>
								<li><a href="homepage3.php">Homepage 3</a></li>
								<li><a href="homepage4.php">Homepage 4</a></li>
								<li><a href="homepage5.php">Homepage 5</a></li>
								<li><a href="homepage6.php">Homepage 6</a></li>
								<li><a href="homepage-all.php">Homepage All</a></li>
							</ul>
						</li>
						<li><a href="index.html#">SLIDERS</a>
							<ul>
								<li><a href="index.html#">Main Slider</a>
									<ul>
										<li><a href="index.php">Default Style</a></li>
										<li><a href="slider-main-with-thumbs.php">With Thumbs</a></li>
										<li><a href="slider-main-faded.php">Faded</a></li>
										<li><a href="slider-main-fixed.php">Fixed Width Slider</a></li>
										<li><a href="slider-main-fixed-position.php">Fixed Position (Scroll)</a></li>
									</ul>
								</li>
								<li><a href="slider-creative.php">Creative Slider</a></li>
								<li><a href="slider-fixed-flexslider.php">Fixed Slider</a>
									<ul>
										<li><a href="slider-fixed-flexslider.php">Style 1 (Flex Slider)</a>
											<ul>
												<li><a href="slider-fixed-flexslider.php">Default</a></li>
												<li><a href="slider-fixed-flexslider-thumbnails.php">With thumbnails</a></li>
											</ul>
										</li>
										<li><a href="slider-fixed-nivoslider.php">Style 2 (Nivo Slider)</a></li>
										<li><a href="slider-fixed-wowslider-blast.php">Style 3 (Wow Slider)</a>
											<ul>
												<li><a href="slider-fixed-wowslider-blast.php">Blast Effect</a></li>
												<li><a href="slider-fixed-wowslider-blinds.php">Blinds Effect</a></li>
												<li><a href="slider-fixed-wowslider-fly.php">Fly Effect</a></li>
												<li><a href="slider-fixed-wowslider-blur.php">Blur Effect</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a href="slider-3dslider.php">3D Cute Slider</a></li>
								<li><a href="slider-fancy.php">Fancy Slider</a></li>
								<li><a href="slider-circularcontent-alternative.php">Circular Content</a>
									<ul>
										<li><a href="slider-circularcontent-alternative.php">Alternative Style</a></li>
										<li><a href="slider-circularcontent-default.php">Default Style</a></li>
									</ul>
								</li>
								<li><a href="slider-static-content-default.php">Static Content</a>
									<ul>
										<li><a href="slider-static-content-default.php">Style 1</a></li>
										<li><a href="slider-static-content-boxes.php">Style 2 / Boxes</a></li>
										<li><a href="slider-static-content-video.php">Style 3 / Video</a></li>
										<li><a href="slider-static-content-maps.php">Style 4 / Maps</a></li>
										<li><a href="slider-static-content-textpop.php">Style 5 / Text pop</a></li>
										<li><a href="slider-static-content-zoom.php">Style 6 / Product Loupe</a></li>
										<li><a href="slider-static-content-event-countdown.php">Style 7 / Event countdown</a></li>
										<li><a href="slider-static-content-videobg.php">Style 8 / Video background</a></li>
										<li><a href="slider-static-content-text-login.php">Style 9 / Text &amp; Login</a></li>
										<li><a href="slider-static-content-simple.php">Style 10 / Simple text</a></li>
									</ul>
								</li>
								<li><a href="slider-portfolio-devices.php">Portfolio Slider Devices</a></li>
								<li><a href="slider-portfolio-frames.php">Portfolio Slider Frames</a>
									<ul>
										<li><a href="slider-portfolio-frames.php">Sliding Vertically</a></li>
										<li><a href="slider-portfolio-frames-horizontal.php">Sliding Horizontally</a></li>
									</ul>
								</li>
								<li><a href="slider-laptop.php">Laptop Slider</a></li>
								<li><a href="slider-icarousel.php">iCarousel</a></li>
								<li><a href="slider-css3panels.php">CSS3 Panels</a></li>
							</ul>
						</li>
						<li><a href="about-us.php">ABOUT US</a></li>
						<li><a href="index.html#">FEATURES</a>
							<ul>
								<li><a href="features-blog.php">Blog</a></li>
								<li><a href="index.html#">Portfolio</a>
									<ul>
										<li><a href="features-portfolio-cat-onecol.php">Category Layout</a>
											<ul>
												<li><a href="features-portfolio-cat-onecol.php">One Column</a></li>
												<li><a href="features-portfolio-cat-twocol.php">Two Columns</a></li>
												<li><a href="features-portfolio-cat-threecol.php">Three Columns</a></li>
												<li><a href="features-portfolio-cat-fourcol.php">Four Columns</a></li>
											</ul>
										</li>
										<li><a href="features-portfolio-sortable.php">Sortable Layout</a></li>
										<li><a href="features-portfolio-carousels.php">Carousels Layout</a></li>
									</ul>
								</li>
								<li><a href="features-photo-gallery.php">Photo Gallery</a></li>
								<li><a href="index.html#">Lightbox (Prettyphoto)</a>
									<ul>
										<li><a href="http://themeforest.net/user/hogash/?iframe=true&amp;width=800&amp;height=450" data-rel="prettyPhoto">PrettyPhoto (iFrame)</a></li>
										<li><a href="images/super_cool_ad.jpg" data-rel="prettyPhoto">PrettyPhoto (Image)</a></li>
										<li><a href="http://www.youtube.com/watch?v=G-1HNnxb0WE" data-rel="prettyPhoto">PrettyPhoto (Youtube)</a></li>
										<li><a href="features-lightbox-autopop.php">Auto Pop-up</a></li>
										<li><a href="index.html#transparent_panel" class="prettyPhoto_transparent">Transparent modal</a></li>
									</ul>
								</li>
								<li><a href="features-grid-positions.php">Grid Positions</a></li>
								<li><a href="features-sitemap.php">Sitemap</a></li>
								<li><a href="index.html#">Holiday Slides</a>
									<ul>
										<li><a href="features-holiday-christmas.php">Christmas</a></li>
										<li><a href="features-holiday-easter.php">Easter</a></li>
									</ul>
								</li>
								<li><a href="features-page-preloader.php">Page Preloader</a></li>
								<li><a href="features-animated-header.php">Animated Header</a></li>
							</ul>
						</li>
						<li><a href="shop.php">SHOP</a></li>
						<li><a href="index.html#">PAGES</a>
							<ul>
								<li><a href="pages-faq.php">FAQ</a></li>
								<li><a href="pages-process.php">Process</a></li>
								<li><a href="pages-contact.php">Contact us</a>
									<ul>
										<li><a href="pages-contact.php">Normal page</a></li>
										<li><a href="pages-contact-modal.php?iframe=true&amp;height=430" class="prettyPhoto_transparent">Via modal</a></li>
									</ul>
								</li>
								<li><a href="pages-fullwidth.php">Full width</a></li>
								<li><a href="pages-leftsidebar.php">Left sidebar</a></li>
								<li><a href="pages-rightsidebar.php">Right sidebar</a></li>
								<li><a href="pages-offline.php">Offline / Coming soon</a></li>
								<li><a href="pages-historic.php">Historic / Timeline</a></li>
								<li><a href="pages-testimonials.php">Testimonials</a></li>
								<li><a href="pages-404.php">404 Error</a></li>
								<li><a href="pages-team.php">Team</a></li>
								<li><a href="pages-portfolioitem.php">Portfolio Item</a></li>
								<li><a href="pages-blogitem.php">Blog Item</a></li> 
								<li><a href="pages-productitem.php">Product page</a></li>
								<li><a href="pages-product-list.php">Products List/Category</a></li>
								<li><a href="pages-services.php">Services</a></li>
								<li><a href="pages-careers.php">Careers</a></li>
								<li><a href="http://hogash-demos.com/kalypso_html_responsive/pages-passprotected.php">Password Protected</a></li>
							</ul>
						</li>
						<li><a href="index.html#">STYLES</a>
							<ul>
								<li><a href="styles-typography.php">Typography</a></li>
								<li><a href="styles-tables.php">Table designs</a></li>
								<li><a href="styles-buttons.php">Button designs</a></li>
								<li><a href="styles-pricingtables.php">Pricing tables</a></li>
								<li><a href="styles-forms.php">Form styles</a></li>
								<li><a href="styles-tabs.php">Tabs designs</a></li>
								<li><a href="styles-accordion.php">Accordion Toogles</a></li>
							</ul>
						</li>
					</ul>
				</nav><!-- end main_menu -->

			</div>
		</header>