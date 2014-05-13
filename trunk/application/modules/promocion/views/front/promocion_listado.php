<center>
	<div style="width: 800px; padding-top: 100px;">
		
		<h1 style="text-align: left; font-size: 30px; font-weight: bold;">Nuestras<span style="color: #DE6A21;">Promociones</span></h1><br /><br />
		
		<?php if(!isset($promocion_actual) || empty($promocion_actual)) : ?>
			
			<?php foreach($promociones as $promocion): ?>
			
				<h1 style="text-align: left; font-size: 20px; font-weight: bold;"><?php echo ucwords(strtolower($promocion->nombre)); ?></h1>
				<p style="text-align: justify;"><?php echo strtolower($promocion->descripcion_breve).' / '.$promocion->url; ?></p><br />
				
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
				<br /><br /><br />
				
			<?php endforeach; ?>
			
		<?php else : ?>
			<div class="promociones">
				<h1 style="text-align: left; font-size: 20px; font-weight: bold;"><?php echo ucwords(strtolower($promocion_actual->nombre)); ?></h1>
				<p style="text-align: justify;"><?php echo strtolower($promocion_actual->descripcion_breve); ?></p><br />
				
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
				<br /><br /><br />
			</div>
		<?php endif; ?>
	</div>
	
	<a type="application/rss+xml" href="<?php echo base_url(); ?>/rss_promociones">RSS</a><br /><br />
</center>