<?php
//$cat_path=modules::run('services/relations/get_categoria_path/',$categoria->id_categoria)

?>
	<ul id="tabs">
			<li><a href="#tabFicha" title="">Ficha de la categoria</a></li>
	<?php
			$idiomas=json_decode(modules::run('services/relations/get_all','idioma','true'));
			foreach($categoria_idiomas as $categoria_idioma){ 
				$idioma[$categoria_idioma->id_idioma]=json_decode(modules::run('services/relations/get_from_id','idioma',$categoria_idioma->id_idioma,'true'));
				?>
			<li><a href="#tabLang<?php echo $categoria_idioma->id_idioma ?>" title=""><?php echo $idioma[$categoria_idioma->id_idioma]->nombre?></a></li>
			<?php } 
			if (count($idiomas) > count($categoria_idiomas)) { ?>
			<li class="toNewLang"><a href="#tabNewLang" title="">Crear nuevo idioma</a></li>	
			<?php } ?>		
		</ul>
		<div id="ficha">
			<div class="tab" id="tabFicha">	
			<!-- Ficha Obra -->
				<h2>Ficha Categoria</h2>
	<?php 
	//echo '<pre>'.print_r($categoria,true).'</pre>';
	?>
				<dl class="ficha_obra">
					<dt>Estado</dt>
					<dd><?php 
					$estado=json_decode(modules::run('services/relations/get_from_id','estado',$categoria->id_estado,'true'));
					echo $estado->estado?></dd>
					
					<?php 
					//echo '<pre>'.print_r($cat_path,true).'</pre>';
					if (isset($cat_path) && !empty($cat_path)){ 
						foreach($cat_path as $k=>$cat){
							$c[]=anchor('backend/ficha_categoria/'.$k,$cat);
						}
						?>
					<dt>Categoria padre</dt>
					<dd><?php echo implode(' &raquo; ',$c)?></dd>
					<?php }else{ ?>
					<dt>Categoria padre</dt>
					<dd>Raíz</dd>
					<?php
					}
					?>
					<dt>Destacado</dt>
					<dd><?php echo ($categoria->destacado==1 ? 'Sí' : 'No')?></dd>
					<?php 
					
					$img=json_decode(modules::run('services/relations/get_rel','categoria','imagen',$categoria->id_categoria,'true','multimedia.id_multimedia'));
					if (is_array($img) && !empty($img)){ ?>
					
					<dt>Imagen</dt>
					<?php 
					//echo '<pre>'.print_r(json_decode($img),true).'</pre>'; 
					foreach($img as $k=>$im){
						
					?>
					
					<dd><p class="img"><img src="/assets/front/img/med/<?php echo $im->fichero?>" title="miniatura de <?php echo (isset($categoria->nombre) ? $categoria->nombre : 'Categoria sin titulo')?>" /></p></dd>
					<?php }
					
					} ?>
                    </dl>
                    
                   <strong class="boton"><?php echo anchor('backend/editar_categoria/'.$categoria->id_categoria,'Editar Categoria',array('title'=>"Editar Categoria"))?></strong>   
                    
	

				<!-- Inglés cierre-->
			</div>
            <?php
			//echo '<pre>'.print_r($categoria_idiomas,true).'</pre>';
			foreach($categoria_idiomas as $categoria_idioma){ ?>
			<?php 
			//
			$img=json_decode(modules::run('services/relations/get_rel','categoria','imagen',$categoria->id_categoria,'true'));
			$ni=0;
			foreach($img as $k=>$i){
				if ($i->id_idioma==$categoria_idioma->id_idioma)
					$ni=$k;
			}
			
			?>
			<!-- <?php echo $idioma[$categoria_idioma->id_idioma]->nombre?> -->
			
			<div id="tabLang<?php echo $categoria_idioma->id_idioma?>" class="tab">
				<h2><?php echo $idioma[$categoria_idioma->id_idioma]->nombre?></h2>
				
				<dl class="ficha_obra">
				<?php if ($categoria_idioma->nombre!=''){ ?>
					<dt>Nombre</dt>
					<dd><?php echo $categoria_idioma->nombre?></dd>
					
					<?php }
					if ($categoria_idioma->descripcion_breve!=''){ ?>
					<dt>Descripción Breve</dt>
					<dd><?php echo $categoria_idioma->descripcion_breve?></dd>
					<?php }
					if ($categoria_idioma->descripcion_ampliada!=''){ ?>
					<dt>Descripción Ampliada</dt>
					<dd><?php echo $categoria_idioma->descripcion_ampliada?></dd>
					<?php }
					if (isset($img[$ni]) && $img[$ni]->descripcion_multimedia!=''){ ?>
					<dt>Descripción Imagen</dt>
					<dd><?php echo $img[$ni]->descripcion_multimedia?></dd>
					<?php }
					if ($categoria_idioma->url!=''){ ?>
					<dt>URL</dt>
					<dd><?php echo $categoria_idioma->url?></dd>
					<?php }
					if ($categoria_idioma->titulo_pagina!=''){ ?>
					<dt>Titulo Pagina</dt>
					<dd><?php echo $categoria_idioma->titulo_pagina?></dd>
					<?php }
					if ($categoria_idioma->descripcion_pagina!=''){ ?>
					<dt>Descripción Pagina</dt>
					<dd><?php echo $categoria_idioma->descripcion_pagina?></dd>
					<?php } ?>
					
					
				</dl>
	
				<strong class="boton"><?php echo anchor('categoria/eliminar_idioma/'.$categoria_idioma->id_detalle_categoria,'Eliminar Idioma',array('title'=>"Eliminar Idioma",'class'=>'delete'))?></strong>
				<strong class="boton"><?php echo anchor('categoria/editar_idioma/'.$categoria->id_categoria.'/'.$categoria_idioma->id_detalle_categoria,'Editar Idioma',array('title'=>"Editar Idioma"))?></strong>
				<!-- Inglés cierre-->
			</div>
			<?php } ?>
			<div class="tab" id="tabNewLang">
				<h2>Crear nuevo idioma para la categoria <?php echo (isset($categoria->nombre) ? $categoria->nombre : 'Sin Nombre')?></h2>
				
				<?php
				
				echo modules::run('template/crear_idioma_form2',$categoria->id_categoria,'categoria');?>
				
			</div>
			
			
		</div>

