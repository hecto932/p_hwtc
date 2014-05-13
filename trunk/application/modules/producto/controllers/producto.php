<?php

class Producto extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$this->load->model('producto_model');
		$this->lang->load('back');
		$this->load->helper('multimedia');
	}
	
	/* 
	 * Funcciones del admin, con control de aceso */
	function index()
	{
		$this->listado();
	}
	
	function ajax_productos_categoria()
	{
		$productos = $this->producto_model->get_productos_categoria($this->input->post('id_categoria'), TRUE);
		echo json_encode($productos);
	}
	
	function listado($order_field='producto.id_producto',$order_dir='desc',$start=0,$ajax=false)
	{
		
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		if ($start==0 && empty($_POST) && $order_field=='producto.id_producto') $this->session->unset_userdata('terminos_busqueda');
		$terminos_busqueda=array();
		$terminos_busqueda=$this->session->userdata('terminos_busqueda');
		if (isset($_POST['ean']))
			$terminos_busqueda['producto.ean']=$_POST['ean'];
		
		if (isset($_POST['codigo_coloplas']))
			$terminos_busqueda['codigo_coloplas']=$this->input->post('codigo_coloplas');
		
		if (isset($_POST['texto']))
			$terminos_busqueda['texto']=$_POST['texto'];

		if (isset($_POST['id_categoria']))
			$terminos_busqueda['producto.id_categoria']=$_POST['id_categoria'];

		if (isset($_POST['id_estado']))
			$terminos_busqueda['producto.id_estado']=$_POST['id_estado'];

		if (isset($_POST['destacado']))
			$terminos_busqueda['destacado']=$this->input->post('destacado');

		

		if (isset($_POST) && !empty($_POST))
		{
			$terminos_busqueda=array_filter($terminos_busqueda);
			$this->session->set_userdata('terminos_busqueda',$terminos_busqueda);
		}

		$limit=5;
		$order_string='';
		$order_string.= ($order_field == "") ? '' : $order_field;
		$order_string.= ($order_dir == "") ? '' : ' '.$order_dir;	

        $od = ($order_dir == 'asc') ? 'desc' : 'asc';
        $data['order_field'] = $order_field;
        $data['order_dir'] = $order_dir;
        $data['order_by_new'] = (($order_field == '') ? 'id_producto' : $order_field) . "/" . $od;
        $data['url'] = lang('backend_url').'/'.lang('productos_url').'/'.lang('listado_url');
        $config['base_url'] = '/'.lang('backend_url').'/'.lang('productos_url').'/'.lang('listado_url').'/'.$order_field.'/'.$order_dir;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = "&rsaquo;";
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = "&lsaquo;";
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = "&raquo;";
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close']= '</li>';
		$config['first_link'] = "&laquo;";
		$config['fist_tag_open'] = '<li>';
		$config['fist_tag_close']= '</li>';
		$data['num_productos'] = $this->producto_model->count_all($terminos_busqueda);
        $config['total_rows'] = $data['num_productos'];
		
        if ($config['total_rows'] == 0)
            redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('buscar_url').'/'.lang('ningun_resultado'));
			
        $data['productos'] = $this->producto_model->get_page($start, $limit, $order_field, $order_dir, 'back', $terminos_busqueda);
		
        if ($ajax)
            echo json_encode($data['productos']);
        else
        {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['offset'] = $start;
            $data['order_field'] = $order_field;
            $data['order_direction'] = $order_dir;
            $data['active'] = 'productos';
			
            if (!empty($terminos_busqueda))
            	$data['sub'] = 'buscar';
            else
				$data['sub'] = 'listado';
				
            $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('listado');
            if (!empty($terminos_busqueda))
            {
                $lbc = reset($terminos_busqueda);
                $lbt = key($terminos_busqueda);
                if ($lbt == 'producto.id_estado')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'estado', $lbc);
                    $lbc = ucwords($bcc->estado);
                }
                if ($lbt == 'producto.id_producto')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'producto', $lbc);
                    $lbc = ucwords($bcc->nombre);
                }
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('productos_url') => lang('productos'),
                							 										lang('backend_url').'/'.lang('productos_url').'/'.lang('buscar_url') => lang('listado_busqueda'),
                							 										lang('titulo') => $lbc
																				 )
											 						  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('productos_url') => lang('productos'),
                							 										lang('backend_url').'/'.lang('productos_url').'/'.lang('listado_url') => lang('listado')
																				 )
											 						  );
            }
			$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
			$data['usuario'] = array(
										'nombre' => $this->session->userdata('nombre'),
										'apellidos' => $this->session->userdata('apellidos')
									);
			$data['contenido_principal'] = $this->load->view('back/listado_producto', $data, true);
            $this->load->view('back/template_new', $data);
        }
	}

	function buscar($mensaje = '')
	{
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $data['active'] = 'productos';
        $data['sub'] = 'buscar';
        $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('buscar_tit_not');
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('buscar_url') => lang('listado_buscar').' '.lang('producto')));
        $data['mensaje'] = $mensaje;
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
        $data['contenido_principal'] = $this->load->view('back/buscar_producto', $data, true);
        $this->load->view('back/template_new', $data);
    }

    function crear()
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		$this->load->helper('misc');
        
        $data['active'] 	= 'productos';
        $data['sub'] 		= 'crear';
		$data['title'] 		= lang('meta.titulo').' - '.lang('productos').' - '.lang('listado_crear');
        
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('productos_url') => lang('productos'),
										    							 	lang('backend_url').'/'.lang('productos_url').'/'.lang('crear_url') => lang('listado_crear')
																		 )
															  );
        $data['estados'] 		= modules::run('services/relations/get_all', 'estado', 'true');
        $data['categorias'] 	= modules::run('services/relations/get_all', 'detalle_categoria');
		
		//Opciones de productos relacionados
		$data['opt_producto']	= opt_dropdown($this->producto_model->get_all_products(), 'id_producto', 'nombre');
		
		//Arbol de categorias
		//$data['arbol_categorias'] = modules::run('services/relations/arbol_categorias', 1, '0', '0', 'producto');
		$data['arbol_categorias'] = modules::run('services/relations/arbol_categorias', 1, '0', '0', 'producto');
		
		//Destacado
		$data['array_destacado'] = destacado_dropdown();
		
		//Chosen
		$data['cargar_chosen'] 	= TRUE;
		
		//Producto css
		//$switch_css = array('after' => 'Buscar', 'before' => 'Elegir', 'switch_size' => '110px', 'switch_size_button' => '50px', 'switch_button_position_right' => '56px');
		//$data['productos_css'] = $this->load->view('back/css/producto_css', $switch_css, true);
		
		$data['productos_js'] 	= $this->load->view('back/js/producto_js', $data, true);
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['usuario'] 		= array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
								
		$data['crear'] 					= TRUE;
        $data['contenido_principal'] 	= $this->load->view('back/crear_producto', $data, true);
		
        $this->load->view('back/template_new', $data);
    }


    function fecha_pasada($fecha) {
        return mysql_to_unix($fecha) <= time();
    }

    function create($id = '')
    {
    	modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
    	$this->load->library('form_validation');
		$this->load->library('upload');
        $img_folder = 'assets/front/img/';

        if ($id != '')
        	modules::run('services/monitor/add', 'producto', $id, $this->session->userdata('id_usuario'), 'editar');
        else
        	modules::run('services/monitor/add', 'producto', '', $this->session->userdata('id_usuario'), 'crear');
        
		
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->form_validation->set_rules('id_estado', lang('listado_estado'), 'required');
		//$this->form_validation->set_rules('ean', lang('listado_ean'), 'required');
		$this->form_validation->set_rules('codigo_coloplas', lang('listado_codigo'), 'required');
		$this->form_validation->set_rules('id_categoria', 'Categoría', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('listado_crear');
            if ($id != '')
            {
                $data['producto'] = $this->producto_model->read($id);
                $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('listado_editar');
            }
            $data['active'] = 'producto';

            if ($id != '')
            {
            	$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('productos_url') => lang('productos'),
										    							 	lang('backend_url').'/'.lang('productos_url').'/'.lang('editar_url').'_'.lang('producto') => lang('listado_editar').' '.lang('producto_url'),
										    							 	lang('backend_url').'/'.lang('productos_url').'/'.lang('editar_url').'_'.lang('producto').'/'.$id =>
										    							 		(isset($data['producto']->nombre) && !empty($data['producto']->nombre))
										    							 			? $data['producto']->nombre : lang('producto').' '.lang('sin_nombre') 
																		 )
															  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                														array(
                																lang('backend_url') => lang('backend'),
											    								lang('backend_url').'/'.lang('productos_url') => lang('productos'),
											    							 	lang('backend_url').'/'.lang('productos_url').'/'.lang('crear_url').'_'.lang('producto') => lang('listado_crear').' '.lang('producto_url')
																			 )
																	  );
            }

			//Arbol de categorias
			$data['arbol_categorias'] = modules::run('services/relations/arbol_categorias', 1, '0', '0', 'producto');
			
			//Opciones de productos relacionados
			$data['opt_producto'] = opt_dropdown($this->producto_model->get_all_products(), 'id_producto', 'nombre');
			
			//Productos seleccionados
			$data['seleted_relacionados'] = $this->input->post('productos_relacionados');
			
			//Chosen
			$data['cargar_chosen'] 	= TRUE;
			
			//Destacado
			$data['array_destacado'] = destacado_dropdown();
			
            $data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
            
            $data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
			
            $data['contenido_principal'] = $this->load->view('back/crear_producto', $data, true);
            $this->load->view('back/template_new', $data);
        }
		else
		{
			//Datos del post
			$form_data = $_POST;
			
			//Productos relacionados
			if (isset($form_data['productos_relacionados'])) $producto_relacion['producto'] = array_unique($form_data['productos_relacionados']);
			unset($form_data['productos_relacionados']);
			
			$id = $this->producto_model->update($form_data);
			
			//Productos relacionados
			modules::run('services/relations/delete','producto','producto',$id);
			if (isset($producto_relacion) && !empty($producto_relacion) && is_array($producto_relacion))
			{
				foreach($producto_relacion as $t => $r)
				{
					modules::run('services/relations/insert_rel','producto',$t,$r,$id);
				}
			}
			
			if($this->session->userdata('idioma') == 'es')
				redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/' . $id, 'location');
			else
				redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/' . $id, 'location');
        }
    }

    function edit($id = '', $ajax = false)
    {
        if ($id == '')
            redirect('backend');
		
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $data['active'] = 'producto';
        $data['sub'] = 'editar';

        $data['producto'] = $datos_producto = $this->producto_model->read($id);
		
		//Arbol de categorias
		$data['arbol_categorias'] = modules::run('services/relations/arbol_categorias', $datos_producto->id_tipo_cat, $id, $datos_producto->id_categoria, 'producto');
		
		//Destacado
		$data['array_destacado'] = destacado_dropdown();
		
		//Opciones de productos relacionados
		$data['opt_producto'] = opt_dropdown($this->producto_model->get_all_products(), 'id_producto', 'nombre');
		if(array_key_exists($id, $data['opt_producto'])) unset($data['opt_producto'][$id]);
		
		//Productos seleccionados
		$data['seleted_relacionados'] = ($this->input->post('productos_relacionados')) ? $this->input->post('productos_relacionados') : distintos(modules::run('services/relations/get_all_rel','producto','producto',$id,false,'producto.id_producto'), 'id_producto_relacionado');
		
		//Chosen
		$data['cargar_chosen'] 	= TRUE;
		
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
									        					   array(
									        					   			lang('backend_url') => lang('backend'),
									        								lang('backend_url').'/'.lang('productos_url') => lang('productos'),
									        								lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$id => lang('listado_editar').' '.lang('producto_url'),
									        								'#' => (isset($data['producto']->nombre) && !empty($data['producto']->nombre))
										    							 			? $data['producto']->nombre : lang('producto').' '.lang('sin_titulo')
																		)
															  );
		$data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('editar').' '.$data['producto']->nombre;
		$data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['categorias'] = modules::run('services/relations/get_all', 'detalle_categoria');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['productos_js'] = $this->load->view('back/js/producto_js', $data, true);
        $data['contenido_principal'] = $this->load->view('back/crear_producto', $data, true);
        if ($ajax)
            echo $data['contenido_principal'];
        else
            $this->load->view('back/template_new', $data);
    }

    function ficha($id = '')
    {
    	$this->load->model('multimedia/multimedia_model');
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        if ($id == '') redirect('backend/productos');
		
        $data['active'] 	= 'producto';
        $data['sub'] 		= 'editar';
        $data['producto'] 	= $datos_productos = $this->producto_model->read($id);
		
		$categ_path = modules::run('services/relations/get_categoria_bc',$datos_productos->id_categoria);
		if( isset($categ_path) && !empty($categ_path) )
		{
			$cat_index = 0;
			foreach($categ_path as $k => $cat)
			{
				$cat_index++;
				$cat_path[] = anchor('backend/categorias/ficha_categoria/'.$k,$cat);
			}
		}
		$cat_path[$cat_index-1] = '<strong>'.$cat_path[$cat_index-1].'</strong>';
		$cat_raiz = array_shift($cat_path);
		$data['categoria_path'] = implode(' / ', $cat_path);
		
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$id => 
        																	(isset($data['producto']->nombre) ? lang('listado_registro').' '.$data['producto']->nombre : lang('producto').' '.lang('sin_nombre'))
																	 )
															  );
		/*--- Zona de url ----*/

		//Imagen Principal
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');


        $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.(isset($data['producto']->nombre) ? lang('listado_registro').' '.$data['producto']->nombre : lang('producto').' '.lang('sin_nombre'));
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['accion'] = 'normal';
		$data['sub_activo'] = 'Ficha';
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id, 'producto', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id, 'producto', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id, 'producto', 3);
        $data['producto_idiomas'] = $this->producto_model->detalles($id);

		/*--- Cargas de vistas ---*/
		$data['producto_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		$data['producto_info'] = $this->load->view('back/ficha/producto_info', $data, true); //Información básica de la producto
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true); //Información de los idiomas
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_producto', $data, true); //Vista para la creación de nuevos idiomas
		$data['idioma_nuevo'] = $this->load->view('back/ficha/idioma_nuevo', $data, true); //Vista para la creación de nuevos idiomas
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_producto', $data, true); //Carga de contenido principal
        $this->load->view('back/template_new', $data);
    }

    function editar_idioma($id_producto, $id_detalle_producto = '')
    {
    	$this->load->model('multimedia/multimedia_model');
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        if ($id_detalle_producto == '')
		{
			redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$id_producto);
		}
		//$data['producto'] = $this->producto_model->read($id_producto);
		$data['producto'] = $this->producto_model->read($id_producto,$id_detalle_producto);
		$data['active'] = 'productos';
		$data['sub'] = 'ficha';
		$data['accion'] = 'editar';
		$data['sub_activo'] = 'EditLangTab';
		$data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('listado_editar').' '.lang('listado_idioma');
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																	array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'/'.$id_producto => lang('listado_editar').' '.lang('idioma_url'),
        																$id_producto => (isset($data['producto']->nombre) && $data['producto']->nombre != '') ? $data['producto']->nombre : lang('producto').' '.lang('sin_nombre')
																	 )
															);
		/*
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('secundarias');	//Imagenes secundarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('terciarias');	//Imagenes terciarias
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
		$data['producto_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		*/
		
		//AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$id_producto.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id_producto, 'producto', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id_producto, 'producto', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id_producto, 'producto', 3);
		$data['producto_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		//FIN - AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		
		
		$data['producto_idiomas'] = $this->producto_model->detalles($id_producto, $id_detalle_producto);
		$data['producto_info'] = $this->load->view('back/ficha/producto_info', $data, true);
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true);
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_producto', $data, true);
        $data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['usuario'] = array(
								'nombre' => $this->session->userdata('nombre'),
								'apellidos' => $this->session->userdata('apellidos')
							);
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_producto', $data, true);
        $this->load->view('back/template_new', $data);

    }
	
	function validar_url($url)
	{
		$this->form_validation->set_message('validar_url', 'La url indicada ya existe.');
		
		$id_producto = $this->producto_model->get_id_producto_url($url);
		
		if(!empty($id_producto) && is_numeric($id_producto) && $id_producto > 0 && $this->input->post('accion') != 'editar')
			$return = FALSE;
		else $return = TRUE;
		
		return $return;
	}
	
    function guardar_idioma()
    {
    	//die_pre($_POST);
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $data = $_POST;
		
		//Caracteristicas de productos
		if(isset($data['caract']))
		{
			$caracteristicas = $data['caract'];
			unset($data['caract']);
			$conjunto = -1;
				
			/* Se crea un arreglo con la siguiente forma:
			 * 
			Array(	[0] => Array 	( 	[0] => Caracteristica 1
			            				[1] => Sub-Caracteristica a
			            				[2] => Sub-Caracteristica b
			        				)
					[1] => Array	(	[0] => Caracteristica 2
			            				[1] => Sub-Caracteristica c
			        				)
					[2] => Array	(	[0] => Caracteristica 3		)
			)*/
				
			foreach($caracteristicas as $caracteristica)
			{
				//Si es una cadena no vacia
				if(is_string($caracteristica) && strlen($caracteristica) > 0)
				{
					//Es una nueva caractetistica
					$conjunto++;
					$caracts = array();
					$caracts[] = $caracteristica;
				}
				//Si es una subcaracteristica no vacia, que pertenece a una caracteristica no vacia
				elseif(is_array($caracteristica) && count($caracts) > 0 && strlen($caracteristica[0]) > 0)
					$caracts[] = $caracteristica[0];
				
				$insetar_caracteristicas[$conjunto] = $caracts;
			}
			$insetar_caracteristicas = json_encode($insetar_caracteristicas);
		}
		
		//die_pre($data);
		$this->load->model('multimedia/multimedia_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('id_idioma', 'Idioma', 'required');
        $this->form_validation->set_rules('nombre', 'Titulo', 'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_breve', 'Descripcion Breve', 'min_length[10]|required');
        $this->form_validation->set_rules('descripcion_ampliada', 'Descripcion Ampliada 1', 'min_length[20]|required');
        $this->form_validation->set_rules('url', 'URL', 'required|callback_validar_url');
        $this->form_validation->set_rules('titulo_pagina', 'Titulo pagina', 'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_pagina', 'Descripcion pagina', 'required|min_length[10]');
        $this->form_validation->set_rules('keywords', 'Palabras clave', 'required');

        if ($this->form_validation->run($this) == FALSE)
        {
            $data['active'] = 'producto';
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('listado_editar').' - '.lang('listado_idioma');
            if ($data['id_producto'] != '')
			{
                $data['producto'] = modules::run('producto/read', $data['id_producto']);
				$temp_bread = ($this->session->userdata('idioma') == 'es') ? lang('ficha_url').'_'.lang('producto_url').'/'.$data['id_producto']: lang('producto_url').'_'.lang('ficha_url').'/'.$data['id_producto'];
				$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																		array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
	        																lang('backend_url').'/'.lang('productos_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
																			$data['id_producto'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('producto').' '.lang('sin_nombre')
																		 )
																	  );
            }
			else
			{
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
               															array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
	        																lang('backend_url').'/'.lang('productos_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
	        																lang('backend_url').'/'.lang('productos_url').'/'.lang('crear_url') => lang('listado_crear'),
																			$data['id_producto'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('producto').' '.lang('sin_nombre')
																		 )
																	  );
            }


			/*	En esta zona se vuelve a construir la vista de la ficha,
			 * 	es importante cargar todas las vistas necesarias y variables.
			 * 	Para que las imagenes cargen es necesario cargar las vistas y las
			 *  urls de imagen_principal, imagenes_secundarias e inclusive imagenes_terciarias.
			 *
			 * */
			
			if(isset($insetar_caracteristicas) && !empty($insetar_caracteristicas))
			$data['caracteristicas'] 	= json_decode($insetar_caracteristicas);
			
			$data['url_add_p'] 			= base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$data['id_producto'].'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
			$data['url_add_s'] 			= base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$data['id_producto'].'/'.lang('adicionar_url').'/'.lang('secundarias'); //Imagenes secundarias
			$data['url_add_t'] 			= base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.$data['id_producto'].'/'.lang('adicionar_url').'/'.lang('terciarias'); //Imagenes terciarias
			$data['url_delete'] 		= base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
			$data['imagen_principal'] 	= $this->multimedia_model->get_relation($data['id_producto'], 'producto', 1);
			$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($data['id_producto'], 'producto', 2);
			$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($data['id_producto'], 'producto', 3);
			$data['accion'] 			= $accion = ($this->input->post('accion') == 'normal') ? 'normal' : 'editar' ;
			$data['sub_activo'] 		= ($this->input->post('accion') == 'normal') ? 'NewLangTab' : 'EditLangTab' ;
			$data['producto_idiomas'] 	= $this->producto_model->detalles($data['id_producto']);
			$data['producto_info'] 		= $this->load->view('back/ficha/producto_info', $data, true);
			$data['idioma_info'] 		= $this->load->view('back/ficha/idioma_info', $data, true);
			$data['idioma_form'] 		= $this->load->view('back/ficha/idioma_producto', $data, true);
			
			if(strtolower($accion) == 'normal')
			$data['idioma_nuevo'] 		= $this->load->view('back/ficha/idioma_nuevo', $data, true);
			
			$data['producto_imagenes'] 	= $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
			$data['ficha_js'] 			= $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
            $data['menu_principal'] 	= $this->menus->create_mainmenu(lang('productos_url'), 'listado');
			
			$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
            $data['contenido_principal'] = $this->load->view('back/ficha/ficha_producto', $data, true);
            $this->load->view('back/template_new', $data);
        }
        else
        {
			unset($data['accion']);
			
			if(isset($insetar_caracteristicas) && !empty($insetar_caracteristicas))
			$data['caracteristicas'] 	= $insetar_caracteristicas;
			
            //Convertir saltos de linea en <br />
            //$data['descripcion_ampliada'] = nl2br($data['descripcion_ampliada']);
			//echo $data['descripcion_ampliada'];
			$data['descripcion_ampliada'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada']);
			//$data['descripcion_ampliada2'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada2']);
			//$data['descripcion_ampliada3'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada3']);
			//$data['descripcion_ampliada4'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada4']);
			//die($data['descripcion_ampliada']);
			
            $id = $this->producto_model->update_idioma($data);

            modules::run('services/monitor/add', 'detalle_producto', $id, $this->session->userdata('id_usuario'), 'editar_idioma');
			if($this->session->userdata('idioma') == 'es')
				redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$data['id_producto']);
			else
				redirect(lang('backend_url').'/'.lang('productos_url').'/'.lang('producto_url').'_'.lang('ficha_url').'/'.$data['id_producto']);
        }
    }

	function imagen($id, $destacado = 1)
	{
		$this->lang->load('back', 'es');
        if ($id == '')
		{
			redirect(lang('backend_url').'/'.lang('productos_url'));
		}
		if ($_FILES)
		{
			require FCPATH.'server/index.php';
			return;
		}

		$data['producto'] = $this->producto_model->read($id);
		$data['tipo'] = "producto";
		$data['id'] = $id;
		$data['destacado'] = $destacado;
		$data['url'] = base_url().lang('backend_url').'/'.lang('productos_url').'/'.lang('imagenes_url').'/'.lang('procesar_url').'_'.lang('imagenes_url');
		$data['imagen'] = TRUE;
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => 	lang('backend'),
        																lang('backend_url').'/'.lang('productos_url') => lang('productos'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$id => (isset($data['producto']->nombre) ? lang('listado_registro').' ' . $data['producto']->nombre : lang('producto').' '.lang('sin_nombre')),
        																lang('backend_url').'/'.lang('productos_url').'/'.lang('ficha_url').'_'.lang('producto_url').'/'.$id.'/'.lang('adicionar_url') => lang('subir_imagen')
																	 )
															  );
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('productos_url'), 'listado');
		$data['active'] = 'productos';
		$data['sub'] = 'ficha';
		$data['title'] = lang('meta.titulo').' - '.lang('productos').' - '.lang('subir_imagen');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['file_upload_js'] = $this->load->view('template/file_upload_js', $data, true); //Widget de subida de imagenes
		//die_pre($data['file_upload_js']);
		$data['file_upload_widget'] = $this->load->view('template/file_upload_widget', $data, true); //Widget de subida de imagenes
		$data['contenido_principal'] = $this->load->view('back/ficha/subida_imagen', $data, true);
		$this->load->view('back/template_new', $data);
	}


	function imagen_procesar()
	{
		$this->load->model('multimedia/multimedia_model');
		$imagenes = $this->input->post('valores');
		foreach($imagenes as $imagen){
			$data_img = array(
								'fichero' => $imagen['fichero'],
								'destacado' => $imagen['destacado'],
								'id_tipo' => 1,
								'id_estado' => 1,
								'id_usuario' => $this->session->userdata('id_usuario')
						 );
			$id_imagen = $this->multimedia_model->guardar_imagen($data_img, 800, 600, 400, 300, 130, 115);
			$data_rel = array(
								'id_producto' => $imagen['id'],
								'id_multimedia' => $id_imagen
						   );
			$this->multimedia_model->crear_rel_multimedia($data_rel, 'producto');
		}
	}

	function imagen_eliminar(){
		$this->load->model('multimedia/multimedia_model');
		$this->multimedia_model->delete_image($this->input->post('id_multimedia'), 'producto', $this->input->post('fichero'));
	}

    function eliminar_idioma($id_producto, $id_detalle_producto = '', $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        modules::run('services/monitor/add', 'detalle_producto', $id_detalle_producto, $this->session->userdata('id_usuario'), 'eliminar_idioma');
       // $detalle = $this->detalle($id);
		//echo '<pre>'.print_r($detalle, true).'</pre>'; die();
        $ret = $this->producto_model->eliminar_idioma($id_detalle_producto);
        $str = ($ret == true) ? 'true' : 'false';
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            redirect('backend/ficha_producto/' . $id_producto);
    }

    function delete($id, $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $ret = $this->producto_model->delete($id);
        $str = ($ret == true) ? 'true' : 'false';
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            return $ret;
    }

    /*
     * Fin funcciones del admin */


    /*
     * Funciones generales, accesibles sin autentificacion */

    function read($id, $ajax = false, $detalle_id = '') {
        $ret = $this->producto_model->read($id, $detalle_id);
        if ($ajax)
            echo json_encode($ret);
        else
            return $ret;
    }

    function get_producto($output = 'json', $id = '')
    {
        $producto = $this->producto_model->read($id);
        if ($output == 'xml')
        {
            $domDoc = new DOMDocument;
            $rootElt = $domDoc->createElement('producto');
            $rootNode = $domDoc->appendChild($rootElt);
            foreach ($producto as $field => $value)
            {
                $subElt = $domDoc->createElement($field);
                $textNode = $domDoc->createTextNode($value);
                $subElt->appendChild($textNode);
                $rootNode->appendChild($subElt);
            }
            header('Content-Type: text/xml');
            echo $domDoc->saveXML();
        }
        elseif ($output == 'json')
        {
            echo json_encode($producto);
        }
    }

    function get_producto_list($output = 'json', $f = 'producto.id_producto', $v = 1, $group = false)
    {
        $Noticias = $this->producto_model->get_list($f, $v, $group);
        if ($output == 'xml') {
            $domDoc = new DOMDocument;
            foreach ($Noticias as $producto)
            {
                $rootElt = $domDoc->createElement('producto');
                $rootNode = $domDoc->appendChild($rootElt);
                foreach ($producto as $field => $value)
                {
                    $subElt = $domDoc->createElement($field);
                    $textNode = $domDoc->createTextNode($value);
                    $subElt->appendChild($textNode);
                    $rootNode->appendChild($subElt);
                }
            }
            header('Content-Type: text/xml');
            echo $domDoc->saveXML();
        }
        elseif ($output == 'json')
        {
            echo json_encode($Noticias);
        }
    }

    function detalle($id, $ajax = false)
    {
        //$ret = $this->producto_model->get('detalle_producto', $id);
        $ret = $this->producto_model->get($id);
		//echo 'ret: id:'.$id.'<pre>'.print_r($ret, true).'</pre>';die();

        if ($ajax)
		{
			echo json_encode($ret);
		}
        else
		{
			return $ret;
		}
    }

    function Productos_categoria($id_categoria, $ajax = 1)
    {
        if ($ajax == 1)
		{
			echo modules::run('services/relations/get_from_categoria', $id_categoria, 'producto', $ajax);
		}
        else
		{
			return modules::run('services/relations/get_from_categoria', $id_categoria, 'producto', $ajax);
		}
    }

    /*
     * Fin funciones libres */

    /* funciones de callback
     * */

    function dia_check($str) {
        if ((int) $str > 31) {
            $this->form_validation->set_message('dia_check', lang('dia_check'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function mes_check($str) {
        if ((int) $str > 12) {
            $this->form_validation->set_message('mes_check', lang('mes_check'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function ano_check($str) {
        if ((int) $str > date('Y')) {
            $this->form_validation->set_message('ano_check', lang('ano_check').date('Y'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * Fin funciones callback
     *
     * */


}



/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
