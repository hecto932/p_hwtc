<!doctype html>
<html class="js no-touch svg inlinesvg svgclippaths no-ie8compat">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php echo $title; ?></title>
		<meta name="description" content="Overlay Studios Website">
		<meta name="author" content="Overlay">
		
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/front/img/temp/todoindigo.ico" />
		<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/front/img/temp/todoindigo.ico" />

		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Magra:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Gudea:400,700' rel='stylesheet' type='text/css'>

		<!-- STANDARD CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/reset.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/foundation.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/app.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/responsive-tables.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/styles.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/general_foundicons_ie7.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/general_foundicons.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/general_enclosed_foundicons_ie7.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/general_enclosed_foundicons.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/foundation-datepicker.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/jquery.fileupload-ui.css">
		<noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/jquery.fileupload-ui-noscript.css"></noscript>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/prettify.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/jquery-ui-timepicker-addon.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/dropdowns-size.css">
		<style>
			.ui-datepicker {
				width: <?php echo lang('datapicker_width')?>;
				z-index:3 important!;
			}
		</style>
		<?php if(isset($eventos_css)): ?>
			<?php echo $eventos_css; ?>
		<?php endif; ?>

		<script src="<?php echo base_url(); ?>assets/back/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/raty/lib/jquery.raty.min.js"></script>
		
		<!-- Chosen CSS -->
		<?php if(isset($cargar_chosen) && $cargar_chosen): ?>
			<link href="<?php echo base_url(); ?>assets/back/chosen/chosen.css" rel="stylesheet" type="text/css" />
		<?php endif; ?>
	</head>

	<body>
		<!--
		El breackpoint del menu se estable en assets/back/css/foundation.css
		
		Buscar: .top-bar-js-breakpoint
		
		y
		
		Buscar:
		Topbar Specific Breakpoint that you can customize
		@media only screen and (max-width: 1200px)
		
		para configurar el breakpoint
		-->
		<nav class ="nav_backend top-bar">
			<ul>
				<li class = "name">
					<img src="<?php echo base_url(); ?>assets/back/img/template/logo.png" style="max-width: 70px;"/>
				</li>
				<li class="toggle-topbar alinear-derecha">
					<span class="etiqueta-menu-principal"><?php echo lang('menu_etiqueta'); ?></span><a href="#"></a>
				</li>
			</ul>
			<section>
				<?php if(isset($menu_principal)): ?>
					<?php echo $menu_principal; ?>
				<?php endif; ?>

				<?php if(isset($usuario)): ?>
					<ul class="right">
						<li class="has-dropdown">
							<a href="#"><?php echo ucwords($usuario['nombre'].' '.$usuario['apellidos']); ?></a>
							<ul class="dropdown">
								<li>
									<?php echo anchor(lang('backend_url').'/'.lang('usuarios_url').'/logout', lang('salir_sistema'), array('title'=> lang('salir_sistema'))); ?>
								</li>
							</ul>
						</li>
					</ul>
				<?php endif; ?>
			</section>
		</nav>

		<header class="info">
			<div class ="row">
				<div class = "twelve columns">
					<h1><?php echo lang($sub.'_'.$active.'_titulo'); ?></h1>
					<h4><?php echo lang($sub.'_'.$active.'_info'); ?></h4>
				</div>
			</div>
		</header>
		
		