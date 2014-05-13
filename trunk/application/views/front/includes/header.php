<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="es-ES" class="no-js"> <!--<![endif]-->

<head>
	<base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">
	<title><?php echo (isset($head_title) && !empty($head_title)) ? $head_title : ''; ?></title>
	
	<meta charset="utf-8">
	<meta name="description" content="<?php echo (isset($head_descripcion) && !empty($head_descripcion)) ? $head_descripcion : ''; ?>" />

	<link rel="stylesheet" href="assets/front/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/front/addons/superfish_responsive/superfish.css" type="text/css" />
	<link rel="stylesheet" href="assets/front/css/template.css" type="text/css" />
	<link rel="stylesheet" href="assets/front/css/updates.css" type="text/css" />
	<link rel="stylesheet" href="assets/front/css/custom.css" type="text/css" />
	
	<!-- This stylesheet only adds some repairs on idevices  -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="assets/front/css/responsive-devices.css" type="text/css" />
	
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900&amp;v1&mp;subset=latin,latin-ext" type="text/css" media="screen" id="google_font" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700&amp;v1&mp;subset=latin,latin-ext" type="text/css" media="screen" id="google_font_body" />
	
	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="assets/front/js/jquery-1.8.2.min.js">\x3C/script>')</script>
	<script src="assets/front/js/jquery.noconflict.js" type="text/javascript"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.1/modernizr.min.js" type="text/javascript"></script>
	
	<link rel="shortcut icon" href="assets/front/added_icons/favicon.png">
	<link rel="apple-touch-icon" href="assets/front/images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/front/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/front/images/favicons/apple-touch-icon-114x114.png">
	
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
	<!--
	<meta property="og:title" 		content="KALLYAS Template HTML"/>
	<meta property="og:type" 		content="website"/>
	<meta property="og:url" 		content="http://www.hogash.com/demo/kalypso_html/"/>
	<meta property="og:image" 		content="http://www.hogash.com/demo/kalypso_html/images/logo.png"/>
	<meta property="og:site_name" 	content="Kallyas"/>
	<meta property="fb:app_id" 		content=""/> --> <!-- PUT HERE YOUR OWN APP ID - you could get errors if you don't use this one -->
	<!-- <meta property="og:description" content="Welcome to KALLYAS Template, a wonderful and premium product for multipurpose websites"/> -->
	<!-- END Facebook OpenGraph Tags -->
	
	<!-- THIS IS THE DARK THEME STYLESEET // REMOVE COMMENTS TO ENABLE -->
	<!-- <link rel="stylesheet" href="css/dark-theme.css" type="text/css" /> -->
	<!-- END DARK THEME -->
    
	<!-- Custom page stylesheets -->
	<?php if(isset($quitar_iosslider) && $quitar_iosslider): ?>
	<span></span>
	<?php else: ?>
	<link rel="stylesheet" href="assets/front/sliders/iosslider/style.css" type="text/css" />
	<?php endif; ?>
	<!-- end custom page stylesheets -->
    
</head>

<body class="">
    	<!-- ADD AN APPLICATION ID !!
	If you want to know how to find out your app id, either search on google for: facebook appid, either go to http://rieglerova.net/how-to-get-a-facebook-app-id/ -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1&appId="; // addyour appId here
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    
    <!--
    <div class="support_panel" id="sliding_panel">
		<div class="container">
			<div class="row">
				<div class="span9">
					<h4 class="m_title">HOW TO SHOP</h4>
	
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
	</div>
	<!-- end support panel -->
    
    <!--
	<div class="login_register_stuff hide">
		
		<div id="login_panel">
			<div class="inner-container login-panel">
				<h3 class="m_title">SIGN IN YOUR ACCOUNT TO HAVE ACCESS TO DIFFERENT FEATURES</h3>
				<form id="login_form" name="login_form" method="post">
					<a href="#" class="create_account" onClick="ppOpen('#register_panel', '280');">CREATE ACCOUNT</a>
					<input type="text" id="username" name="username" class="inputbox" placeholder="Username">
					<input type="password" id="password" name="password" class="inputbox" placeholder="Password">
					<input type="submit" id="login" name="submit" value="LOG IN">
					<a href="#" class="login_facebook">login with facebook</a>
				</form>
				<div class="links"><a href="#" onClick="ppOpen('#forgot_panel', '350');">FORGOT YOUR USERNAME?</a> / <a href="#" onClick="ppOpen('#forgot_panel', '350');">FORGOT YOUR PASSWORD?</a></div>
			</div>
		</div>

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
				<div class="links"><a href="#" onClick="ppOpen('#login_panel', '800');">ALREADY HAVE AN ACCOUNT?</a></div>
			</div>
		</div>

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
				<div class="links"><a href="#" onClick="ppOpen('#login_panel', '800');">AAH, WAIT, I REMEMBER NOW!</a></div>
			</div>
		</div>
	</div>
	-->
    
	<div id="page_wrapper">

		<header id="header" class="style2">
			<div class="container">

				<!-- logo -->
				<center>
				<h1 id="logo"><a href="/"><img src="assets/front/img/temporal/logo.png" alt="Hesperia WTC Valencia"></a></h1>
				</center>
				
				<div class="menu_espacio" style="min-height: 50px;"></div>
				
				<!--
				<ul class="topnav navRight">
					<li><a href="#" id="open_sliding_panel">
							<span class="icon-remove-circle icon-white"></span> SUPPORT
						</a>
					</li>
					<li><a href="#login_panel" data-rel="prettyPhoto[login_panel]">LOGIN</a></li>
				</ul>
				-->
				<!-- end topnav // right aligned -->

				<!--
				<ul class="topnav navLeft">
					<li class="drop"><a href="#">MY CART</a>
						<div class="pPanel">
							<div class="inner">
								<span class="cart_details">3 items, Total of <strong>$599 USD</strong> <a href="#" class="checkout">Checkout <span class="icon-chevron-right"></span></a></span>
							</div>
						</div>
					</li>
					<li class="languages drop"><a href="#"><span class="icon-globe icon-white"></span> LANGUAGES</a>
						<div class="pPanel">
							<ul class="inner">
								<li class="active"><a href="#">English <span class="icon-ok"></span></a></li>
								<li><a href="#">French</a></li>
								<li><a href="#">German</a></li>
							</ul>
						</div>
					</li>
				</ul>
				-->
				<!-- end topnav // left aligned -->

				<!-- search -->
				<!--
				<div id="search">
					<a href="#" class="searchBtn"><span class="icon-search icon-white"></span></a>
					<div class="search">
						<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)" target="_blank">
							<input name="q" type="hidden" />
							<input name="qfront" maxlength="20" class="inputbox" type="text" size="20" value="SEARCH ..." onBlur="if (this.value=='') this.value='SEARCH ...';" onFocus="if (this.value=='SEARCH ...') this.value='';" />
							<input type="submit" value="go" class="button icon-search"/>
						</form>
					</div>
				</div>
				-->
				<!-- end search -->
                
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
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.nosotros_url'); ?>"><?php echo lang('front.menu_nosotros'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.eventos_reuniones_url'); ?>"><?php echo lang('front.menu_eventos'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.servicios_url'); ?>"><?php echo lang('front.menu_servicios'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.gastronomia_url'); ?>"><?php echo lang('front.menu_gastronomia'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.habitaciones_url'); ?>"><?php echo lang('front.menu_habitaciones'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" TARGET='_blank' href="http://www.hesperia.es/nh/es/hoteles/venezuela/valencia/hesperia-wtc-valencia.html"><?php echo lang('front.menu_reservar'); ?></a></li>
						<li class=""><a style="font-size: 12px; !important;" href="/<?php echo lang('front.contactanos_url'); ?>"><?php echo lang('front.menu_contacto'); ?></a></li>
					</ul>
				</nav><!-- end main_menu -->

			</div>
		</header>