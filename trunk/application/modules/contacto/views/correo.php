<!DOCTYPE html>
<html lang="es">
	<head>
		<base href="http://<?php echo $_SERVER['SERVER_NAME']?>/">
		<meta charset="UTF-8" />
		<title>Correo - Contacto</title>
		
	</head>
	<body>
		
		<div class="row testimonials_fader">
			<div class="span3">
				<img src="assets/front/img/temporal/logow.png" width="150px" /><h1 class="m_title">Hesperia WTC Valencia</h1>
				<p>¡Ha recibido un mensaje!</p>
			</div>
			<div class="span9">
				<ul id="testimonials_fader" class="fixclear" style="list-style-type:none;">
					<li>
						<blockquote><?php echo $mensaje; ?></blockquote>
						<h4><?php echo $nombre; ?> // <?php echo $email; ?></h4>
					</li>
				</ul>
			</div>
		</div>
		<!-- end row // testimonials_fader -->
		
		<!--
		<table>
			<tr>
				<td>
					<center><img src="assets/front/img/temporal/logo_black.jpg" width="200px" /></center>
				</td>
				<td>
					<h1>Hesperia WTC Valencia</h1>
				</td>
			</tr>
			<tr>
				<td colspan="2"><br /></td>
			</tr>
			<tr>
				<td>
					<h1><?php echo $nombre; ?></h1>
					<br /><center><h5><?php echo $email; ?></h5></center>
				</td>
				<td>
					¡Ha enviado un mensaje!
				</td>
			</tr>
			<tr>
				<td colspan="2"> 
					<p><?php echo $mensaje; ?></p>				
				</td>
			</tr>
			
		</table>
		-->
		
	</body>
</html>