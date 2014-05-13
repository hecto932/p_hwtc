<!DOCTYPE html>
<html lang="es">
	<head>
		<base href="http://<?php echo $_SERVER['SERVER_NAME']?>/">
		<meta charset="UTF-8" />
		<title>Correo - Contacto</title>
	</head>
	<body>
		<table>
			<tr>
				
				<td>
					<center>
						<img src="assets/front/images/sliderImages/banner-02.jpg" width="260" />
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2" >
					<h2>Datos de Contacto</h2>
				</td>
			</tr>
			<tr>
				<td colspan="2"> 
					<p><b>Nombre: </b><?php echo $nombre; ?></p>
					<p><b>Email: </b><?php echo $email; ?></p>
					<?php if(!empty($organizacion)): ?>
						<p><b>Organizacion: </b><?php echo $organizacion; ?></p>
					<?php endif; ?>
					<p><b>Mensaje: </b><?php echo $mensaje; ?></p>				
				</td>
			</tr>
			
		</table>
	</body>
</html>