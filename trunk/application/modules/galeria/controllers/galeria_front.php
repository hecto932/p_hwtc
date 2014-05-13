<?php defined('BASEPATH') OR exit('No se permite el acceso directo.');

/**
 * 
 * Controlador de front/productos
 * 
 * @author Ale
 */
class Producto_front extends MX_Controller {

	/**
	 * 
	 * Constructor de la clase
	 * 
	 */
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('producto_model');
		
		if ($this->session->userdata('idioma') == '')
			$this->session->set_userdata('idioma','es');
		
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		
		$this->lang->load('front');
		
	}

	/**
	 * 
	 * Página principal de producto
	 * 
	 */
	public function index()
	{
		$arbol = modules::run('services/relations/get_arbol_categorias', 0);
		
		$data['arbol_cat']  	= array();
		$data['error']  		= 0;
		$data['placeholder'] 	= lang('productos_placeholder_categoria');
		
		if( isset($arbol) && ($arbol != NULL) )
		{
			foreach ($arbol as $valor)
				$data['arbol_cat'] = array_merge($data['arbol_cat'], $valor->child);
		}
		
		$data['arbol_cat'] = $arbol;
		
		if( isset($data['arbol_cat']) && ($data['arbol_cat'] != NULL) )
		{
			$data['title']				= $this->lang->line('productos.meta.title').' | '.$this->lang->line('inicio.meta.title');
			$data['meta_descripcion']	= $this->lang->line('productos.meta.description').' | '.$this->lang->line('inicio.meta.description');
			$data['meta_keywords']		= $this->lang->line('productos.meta.keywords').' | '.$this->lang->line('inicio.meta.keywords');
		}
		else
		{
			$data['error']				= 1;
			$data['title']				= $this->lang->line('productos.meta.title').' | '.$this->lang->line('inicio.meta.title');
			$data['meta_descripcion']	= $this->lang->line('productos.meta.description').' | '.$this->lang->line('inicio.meta.description');
			$data['meta_keywords']		= $this->lang->line('productos.meta.keywords').' | '.$this->lang->line('inicio.meta.keywords');
		}
		
        $data['breadcrumbs'] 		= $this->menus->create_breadcrumb(
																array(
																		'' => 'Inicio',
																		''.lang('productos_url') => lang('menu.productos.m')
														 			)
					 						  				);
		
		$data['contenido_principal'] = $this->load->view('front/listado_categorias', $data, TRUE);
		$this->load->view('front/template', $data);
		
	}

	public function listar_subcategorias($url = '')
	{
		//URL
		if(is_numeric($url))
		{
			$id_categorias = $url;
		}
		else
		{
			$id_categorias = modules::run('services/relations/get_id_categoria_url', $url);
		}
		
		if( isset($id_categorias) && ($id_categorias!='') ) 
		{
			//Datos de la categoria
			$this->load->model('categoria/categoria_model', 'categorias');
			$datos_categoria = $this->categorias->get_datos_categoria($id_categorias);
			
			//Para los metadatos
			$titulo_pagina 			= $datos_categoria[0]->titulo_pagina;
			$descripcion_pagina 	= $datos_categoria[0]->descripcion_pagina;
			$keywords 				= $datos_categoria[0]->keywords;
			
			$data['sub']			= TRUE;
			$data['id'] 			= $id_categorias;
			$data['error']  		= 0;
			$data['placeholder'] 	= lang('productos_placeholder_categoria');
			
			//$data['subcategorias'] = modules::run('services/relations/get_arbol_categorias', $id_categorias);
			$data['arbol_cat'] 		= modules::run('services/relations/get_arbol_categorias', $id_categorias);
			
			//Metadata
			$data['title']				= $titulo_pagina.' | '.$this->lang->line('productos.meta.title').' | '.$this->lang->line('meta.title');
			$data['meta_descripcion']	= $descripcion_pagina.' | '.$this->lang->line('productos.meta.description').' | '.$this->lang->line('meta.description');
			$data['meta_keywords']		= $keywords.' | '.$this->lang->line('productos.meta.keywords').' | '.$this->lang->line('meta.keywords');
			
			//if($data['subcategorias'] == NULL)
			if($data['arbol_cat'] == NULL)
			{
				$data['error'] = 1;
			}
			
	        $data['breadcrumbs'] 		= $this->menus->create_breadcrumb(
														array(
																'' => 'Inicio',
																''.lang('productos_url') => lang('menu.productos.m'),
																lang('titulo') => $datos_categoria[0]->nombre
												 			)
			 						  				);
			
			//$data['contenido_principal'] = $this->load->view('front/listado_subcategorias', $data, TRUE);
			$data['contenido_principal'] = $this->load->view('front/listado_categorias', $data, TRUE);
			$this->load->view('front/template', $data);	
		
		}
		else
		{
			redirect('productos');
		}
	}

	public function listar($url='')
	{
		if( is_numeric($url) )
		{
			$id_categorias=$url;
		}
		else
		{
			$id_categorias = modules::run('services/relations/get_id_categoria_url', $url);
		}

		if( isset($id_categorias) && ($id_categorias != '') ) 
		{
			//Datos de la categoria
			$this->load->model('categoria/categoria_model', 'categorias');
			$datos_categoria = $this->categorias->get_datos_categoria($id_categorias);
			
			//Datos de la categoria padre
			$datos_categoria_padre = $this->categorias->get_datos_categoria($datos_categoria[0]->id_categoria_padre);
			
			//Para los metadatos
			$titulo_pagina 			= $datos_categoria[0]->titulo_pagina;
			$descripcion_pagina 	= $datos_categoria[0]->descripcion_pagina;
			$keywords 				= $datos_categoria[0]->keywords;
			
			$data['id']		= $id_categorias;
			$data['error']	= 0;
			//$arbol_cat  	= array();
			//$arbol_cat_2  = array();
			
			$data['placeholder'] = lang('productos_placeholder_producto');
			//$arbol = modules::run('services/relations/get_arbol_categorias', 0);
			
			/*
			foreach ($arbol as $valor) 
			{
				$arbol_cat =array_merge($arbol_cat,$valor->child);
			}
			foreach ($arbol_cat as $valor) 
			{
				$arbol_cat_2 =array_merge($arbol_cat_2,$valor->child);
			}

			foreach($arbol_cat_2 as $categoria)
			 {
				if($categoria->id_categoria==$id_categorias)
			 	{
			 		$id_padre = $categoria->id_categoria_padre;
					$padre_1 = modules::run('services/relations/get_categoria_id', $id_padre);
					$data['padre_nombre_2'] = $categoria->nombre;
				}
			 }
			 */
			 
			 //echo '<pre>'.print_r($padre_1[0],TRUE).'</pre>';die('ooooo');
			
			//?????
			$data['padre_nombre_1'] = $datos_categoria_padre[0]->nombre;
			$data['padre_url_1']	= $datos_categoria_padre[0]->url;
			$padre_titulo	 		= $datos_categoria_padre[0]->titulo_pagina;
			$padre_descripcion		= $datos_categoria_padre[0]->descripcion_pagina;
			$padre_keywords		 	= $datos_categoria_padre[0]->keywords;
			
			//Productos de la categoria
			$data['arbol_productos'] = $this->producto_model->get_rel_productos_categoria($id_categorias);
			
			if(isset($data['arbol_productos']) && ($data['arbol_productos'] != NULL))
			{
				//Metadatos
				$data['title']				= $titulo_pagina.' | '.$padre_titulo.' | '.$this->lang->line('productos.meta.title').' | '.$this->lang->line('meta.title');
				$data['meta_descripcion']	= $descripcion_pagina.' | '.$padre_descripcion.' | '.$this->lang->line('productos.meta.description').' | '.$this->lang->line('meta.description');
				$data['meta_keywords']		= $keywords.' | '.$padre_keywords.' | '.$this->lang->line('productos.meta.keywords').' | '.$this->lang->line('meta.keywords');
			}
			else
			{
				//Metadatos
				$data['error']				= 1;
				$data['title']				= $this->lang->line('productos.meta.title').' | '.$this->lang->line('inicio.meta.title');
				$data['meta_descripcion']	= $this->lang->line('productos.meta.description').' | '.$this->lang->line('inicio.meta.description');
				$data['meta_keywords']		= $this->lang->line('productos.meta.keywords').' | '.$this->lang->line('inicio.meta.keywords');
			}

	        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
											array(
													'' => 'Inicio',
													''.lang('productos_url') => lang('menu.productos.m'),
													''.lang('listado_subcategorias_url').$datos_categoria_padre[0]->url => $datos_categoria_padre[0]->nombre,
													lang('titulo') => $datos_categoria[0]->nombre
									 			)
 						  				);
			
			//Cargar vista
			$data['contenido_principal'] = $this->load->view('front/listado_productos', $data, TRUE);
			$this->load->view('front/template', $data);	
			
		}
		else
		{
			redirect('productos');
		}

		
	}
	
	public function detalle($url='')
	{
		if( is_numeric($url) )
		{
			$id_producto = $url;
		}
		else
		{
			$id_producto = modules::run('services/relations/get_id_producto_url', $url);
		}
		
		if(isset($id_producto) && ($id_producto != ''))
		{
			//Datos del producto
			$datos_producto 	= $this->producto_model->get_datos_producto($id_producto);
			//die_pre($this->db->last_query());
			$titulo_pagina 		= $datos_producto[0]->titulo_pagina;
			$descripcion_pagina = $datos_producto[0]->descripcion_pagina;
			$keywords 			= $datos_producto[0]->keywords;
			
			//Datos de la categoria
			$id_categoria = $datos_producto[0]->id_categoria;
			$this->load->model('categoria/categoria_model', 'categorias');
			$datos_categoria = $this->categorias->get_datos_categoria($id_categoria);
			
			$titulo_pagina_padre 		= (!empty($datos_categoria)) ? $datos_categoria[0]->titulo_pagina : '';
			$descripcion_pagina_padre 	= (!empty($datos_categoria)) ? $datos_categoria[0]->descripcion_pagina : '';
			$keywords_padre 			= (!empty($datos_categoria)) ? $datos_categoria[0]->keywords : '';
			
			//Datos de la categoria padre
			$id_abuelo 					= (!empty($datos_categoria)) ? $datos_categoria[0]->id_categoria_padre : 0;
			$datos_categoria_abuelo 	= (!empty($datos_categoria_abuelo)) ? $this->categorias->get_datos_categoria($id_abuelo) : '';
			$titulo_pagina_abuelo 		= (!empty($datos_categoria_abuelo)) ? $datos_categoria_abuelo[0]->titulo_pagina : '';
			$descripcion_pagina_abuelo 	= (!empty($datos_categoria_abuelo)) ? $datos_categoria_abuelo[0]->descripcion_pagina : '';
			$keywords_abuelo 			= (!empty($datos_categoria_abuelo)) ? $datos_categoria_abuelo[0]->keywords : '';
			
			//Producto
			$data['producto']			= $datos_producto;
			
			//Productos relacionados
			$data['relacion']			= modules::run('services/relations/get_rel','producto','producto', $id_producto);
			$data['producto_min_1']		= $this->producto_model->read($id_producto+1);
			$data['producto_min_2']		= $this->producto_model->read($id_producto-1);
			
			$data['error']  			= 0;
			$data['placeholder'] 		= lang('productos_placeholder_producto');
    		$data['imagen'] 			= modules::run('services/relations/get_rel', 'producto', 'imagen', $id_producto,'',false);
			
			if(isset($data['producto']) && ($data['producto'] != NULL))
			{
				$data['title'] 				= $titulo_pagina.' | '.$titulo_pagina_padre.' | '.$titulo_pagina_abuelo.' | '.$this->lang->line('productos.meta.title').' | '.$this->lang->line('meta.title');
				$data['meta_descripcion'] 	= $descripcion_pagina.' | '.$descripcion_pagina_padre.' | '.$descripcion_pagina_abuelo.' | '.$this->lang->line('productos.meta.description').' | '.$this->lang->line('meta.description');
				$data['meta_keywords'] 		= $keywords.' | '.$keywords_padre.' | '.$keywords_abuelo.' | '.$this->lang->line('productos.meta.keywords').' | '.$this->lang->line('meta.keywords');
			}
			else
			{
				$data['error'] 				= 1;
				$data['title'] 				= $this->lang->line('productos.meta.title').' | '.$this->lang->line('inicio.meta.title');
				$data['meta_descripcion'] 	= $this->lang->line('productos.meta.description');
				$data['meta_keywords'] 		= $this->lang->line('productos.meta.keywords');
			}
			
			//die_pre($data);
			
			$data['contenido_principal'] = $this->load->view('front/productos_detalle', $data, TRUE);
			$this->load->view('front/template', $data);	
		}
		else
		{
			redirect('productos');
		}
		
	}

}

/* End of file exposicion_front.php */
