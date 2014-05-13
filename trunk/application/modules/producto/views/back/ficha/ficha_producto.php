<div class="row">
	<div class="twelve columns">

		<?php if(isset($breadcrumbs)): ?>
				<?php echo $breadcrumbs; ?>
		<?php endif; ?>

		<dl class="tabs contained four-up">
			<dd <?php echo ($sub_activo == 'Ficha') ? 'class="active"' : '' ; ?>>
				<a href="#Ficha">
					<i class="foundicon-idea"></i>
					<span><?php echo lang('listado_ficha_del').' '.lang('producto_url'); ?></span>
				</a>
			</dd>
			<dd>
				<a href="#Imagenes">
					<i class="gen-enclosed foundicon-photo"></i>
					<span><?php echo lang('listado_imagenes'); ?></span>
				</a>
			</dd>
			<?php
				$idiomas = json_decode(modules::run('services/relations/get_all','idioma','true'));
				foreach($producto_idiomas as $producto_idioma):
					$idioma[$producto_idioma->id_idioma] = json_decode(modules::run('services/relations/get_from_id','idioma',$producto_idioma->id_idioma,'true'));
			?>
			<dd>
				<a href="#Lang<?php echo $producto_idioma->id_idioma ?>" title="">
					<i class="foundicon-globe"></i>
					<span> <?php echo ucfirst($idioma[$producto_idioma->id_idioma]->nombre); ?> </span>


				</a>
			</dd>
			<?php endforeach; ?>
			<?php if (count($idiomas) > count($producto_idiomas) && ($accion != 'editar')): ?>
				<dd <?php echo ($sub_activo == 'NewLangTab') ? 'class="active"' : '' ; ?>>
					<a href="#NewLang">
						<i class="foundicon-add-doc"></i>
						<span><?php echo lang('listado_crear').' '.lang('listado_idioma'); ?></span>
					</a>
				</dd>
			<?php endif; ?>

			<?php if(isset($accion) && $accion == 'editar'): ?>
				<dd <?php echo ($sub_activo == 'EditLangTab') ? 'class="active"' : '' ; ?>>
					<a href="#EditLang">
						<i class="foundicon-edit"></i> 
						<?php echo lang('listado_editar'); ?>
					</a>
				</dd>
			<?php endif; ?>
		</dl>

		<ul class="tabs-content contained">
			<li id="FichaTab"  <?php echo ($sub_activo == 'Ficha') ? 'class="active"' : '' ; ?>>
				<?php echo $producto_info; ?>
			</li>

			<li id="ImagenesTab"  <?php echo ($sub_activo == 'Imagenes') ? 'class="active"' : '' ; ?>>
				<?php echo $producto_imagenes; ?>
			</li>

			<?php echo $idioma_info; ?>

			<li id="NewLangTab" <?php echo ($sub_activo == 'NewLangTab') ? 'class="active"' : '' ; ?>>
				<?php echo $idioma_nuevo; ?>
			</li>

			<li id="EditLangTab" <?php echo ($sub_activo == 'EditLangTab') ? 'class="active"' : '' ; ?>>
				<?php echo $idioma_form; ?>
			</li>
		</ul>
	</div>
</div>
