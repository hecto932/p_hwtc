<!-- PROMOCIONES DESKTOP -->
<script type="text/javascript">
	$(document).ready(function()
	{
		//SCRIPT FOR SMALL
		$('#customDropdown2').change(function()
		{
			var option_val = $('#customDropdown2').find('option:selected').val();
			$('#mobile_form').attr('action','promociones/'+option_val);
			$('#mobile_form').submit();
		});
	});
</script>

<?php //die_pre($promociones); ?>
<div class="100width fondo_madera_banner hide-for-small">
	<div class="row">
		<div class="large-6 columns hide-for-small hide-for-small">
			<?php if(isset($breadcrumbs)): ?>
				<?php echo $breadcrumbs; ?>
			<?php endif; ?>
		</div>
		<div class="large-6 columns">
			<div class="tits_sections">
				<h1><?php echo lang('promociones'); ?></h1>
				<h2><?php echo lang('mare'); ?></h2>
			</div>
		</div>
	</div>
</div>


<div class="row content_noticia hide-for-small">
	<div class="large-8 columns ">
		<?php if(!isset($promocion_actual) || empty($promocion_actual)) : ?>
			<div class="promociones">
				<?php
					if (isset($promociones[0]->fichero) && !empty($promociones[0]->fichero) && file_exists(FCPATH.'assets/front/img/large/'.$promociones[0]->fichero))
						$img = 'assets/front/img/large/'.$promociones[0]->fichero;
					else
						$img = 'assets/back/assets/img/template/placeholder/placeholder_wide.jpg';
				?>
				<img class="th" src="<?php echo $img; ?>">
				<h1><?php echo $promociones[0]->nombre; ?></h1>
				<p style="text-align: justify;"><?php echo $promociones[0]->descripcion_breve; ?></p>
				<div class="redes_sociales_promo">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516c0d300dfb6f05"></script>
					<!-- AddThis Button END -->
				</div>
			</div>
		<?php else : ?>
			<div class="promociones">
				
				<?php
					if (isset($promocion_actual->fichero) && !empty($promocion_actual->fichero) && file_exists(FCPATH.'assets/front/img/large/'.$promocion_actual->fichero))
						$img = 'assets/front/img/large/'.$promocion_actual->fichero;
					else
						$img = 'assets/back/assets/img/template/placeholder/placeholder_wide.jpg';
				?>
				<img class="th" src="<?php echo $img; ?>">
				<h1><?php echo $promocion_actual->nombre; ?></h1>
				<p style="text-align: justify;"><?php echo $promocion_actual->descripcion_breve; ?></p>
				<div class="redes_sociales_promo">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516c0d300dfb6f05"></script>
					<!-- AddThis Button END -->
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="large-4 columns hide-for-small">
		<div class="listado_noticias">
			<h1><?php echo lang('promo.indice'); ?></h1>
			<ul>
				<?php foreach($promociones as $key => $promocion) : ?>
					<?php
						if(isset($promocion->url) && !empty($promocion->url))
							$promo = $promocion->url;
						else
							$promo = $promocion->id_promocion;
					?>
					<li><a href="<?php echo lang('promociones_url').'/'.$promo; ?>"><?php echo ucfirst($promocion->nombre).' - ['.date('d/m/Y',strtotime($promocion->modificado)).']'; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<br /><br />
		<div class="comentarios_noticias hide-for-small">
			<h1><?php echo lang('dejar_fb_comment'); ?></h1>
			<div style="width: 100%">
				<div class="fb-comments" data-href="http://carpasmare.com" data-width="333" data-num-posts="4"></div>
			</div>
		</div>
	</div>
</div>

<!-- PROMOCIONES MOBILE -->
<div class="100width fondo_madera_movil show-for-small">
	<div class="row">
		<div class="large-12 columns centered">
			<h3><?php echo lang('promo.titulo_plural'); ?></h3>
			<form id="mobile_form" method="post" class="custom producto_select_mobile">
				<select id="customDropdown2">
					<?php foreach($promociones as $key => $promocion) : ?>
						<?php
							if(isset($promocion->url) && !empty($promocion->url))
								$promo = $promocion->url;
							else
								$promo = $promocion->id_promocion;
						?>
						<option value="<?php echo $promo; ?>"><?php echo ucfirst($promocion->nombre); ?></option>
					<?php endforeach; ?>
				</select>				
			</form>
		</div>
	</div>
</div>

<div class="row show-for-small">
	<div class="large-12 columns ">
		<div class="promociones_mobile">
			<?php if(!isset($promocion_actual) || empty($promocion_actual)) : ?>
				<?php
					if (isset($promociones[0]->fichero) && !empty($promociones[0]->fichero) && file_exists(FCPATH.'assets/front/img/large/'.$promociones[0]->fichero))
						$img = 'assets/front/img/large/'.$promociones[0]->fichero;
					else
						$img = 'assets/back/assets/img/template/placeholder/placeholder_wide.jpg';
				?>
				<img src="<?php echo $img; ?>">
				<h1><?php echo $promociones[0]->nombre; ?></h1>
				<p style="text-align: justify;"><?php echo $promociones[0]->descripcion_breve; ?></p>
				<div class="redes_sociales_promo">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516c0d300dfb6f05"></script>
					<!-- AddThis Button END -->
				</div>
			<?php else : ?>
				<?php
					if (isset($promocion_actual->fichero) && !empty($promocion_actual->fichero) && file_exists(FCPATH.'assets/front/img/large/'.$promocion_actual->fichero))
						$img = 'assets/front/img/large/'.$promocion_actual->fichero;
					else
						$img = 'assets/back/assets/img/template/placeholder/placeholder_wide.jpg';
				?>
				<img src="<?php echo $img; ?>">
				<h1><?php echo $promocion_actual->nombre; ?></h1>
				<p style="text-align: justify;"><?php echo $promocion_actual->descripcion_breve; ?></p>
				<div class="redes_sociales_promo">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_preferred_1"></a>
						<a class="addthis_button_preferred_2"></a>
						<a class="addthis_button_preferred_3"></a>
						<a class="addthis_button_preferred_4"></a>
						<a class="addthis_button_compact"></a>
						<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516c0d300dfb6f05"></script>
					<!-- AddThis Button END -->
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>