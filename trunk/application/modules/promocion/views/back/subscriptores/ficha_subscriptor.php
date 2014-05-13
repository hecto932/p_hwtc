<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?><?php echo $breadcrumbs; ?><?php endif; ?>

		<dl class="tabs contained four-up">
			<dd <?php echo ($sub_activo == 'Ficha') ? 'class="active"' : '' ; ?>>
				<a href="#Ficha">
					<i class="foundicon-idea"></i>
					<span><?php echo lang('listado_ficha_del').' '.lang('subscriptor_url'); ?></span>
				</a>
			</dd>
		</dl>

		<ul class="tabs-content contained">
			<li id="FichaTab"  <?php echo ($sub_activo == 'Ficha') ? 'class="active"' : '' ; ?>>
				<?php echo $subscriptor_info; ?>
			</li>
		</ul>
		
	</div>
</div>
