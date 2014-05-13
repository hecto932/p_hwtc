<?php

class Categoria extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('categoria_model');
        modules::run('categorias/is_logged_in', 'admin', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $this->lang->load('back');
        $this->load->helper('multimedia');
    }

    function index()
	{
		$this->listado();
	}
	
	function listado($order_field='categoria.id_categoria',$order_dir='desc',$start=0,$ajax=false)
	{
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		if ($start==0 && empty($_POST) && $order_field=='categoria.id_categoria') $this->session->unset_userdata('terminos_busqueda');
		$terminos_busqueda=array();
		$terminos_busqueda=$this->session->userdata('terminos_busqueda');
		
		if (isset($_POST['texto']))
			$terminos_busqueda['texto']=$_POST['texto'];
		
		if (isset($_POST['id_estado']))
			$terminos_busqueda['categoria.id_estado']=$_POST['id_estado'];
		
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
        $data['order_by_new'] = (($order_field == '') ? 'id_categoria' : $order_field) . "/" . $od;
        $data['url'] = lang('backend_url').'/'.lang('categorias_url').'/'.lang('listado_url');
        $config['base_url'] = '/'.lang('backend_url').'/'.lang('categorias_url').'/'.lang('listado_url').'/'.$order_field.'/'.$order_dir;
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
		$data['num_categorias'] = $this->categoria_model->count_all($terminos_busqueda);
        $config['total_rows'] = $data['num_categorias'];
		
        if ($config['total_rows'] == 0)
            redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('buscar_url').'/'.lang('ningun_resultado'));
			
        $data['categorias'] = $this->categoria_model->get_page($start, $limit, $order_field, $order_dir, 'back', $terminos_busqueda);
		
        if ($ajax)
            echo json_encode($data['categorias']);
        else
        {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['offset'] = $start;
            $data['order_field'] = $order_field;
            $data['order_direction'] = $order_dir;
            $data['active'] = 'categorias';
			
            if (!empty($terminos_busqueda))
            	$data['sub'] = 'buscar';
            else
				$data['sub'] = 'listado';
				
            $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('listado');
            if (!empty($terminos_busqueda))
            {
                $lbc = reset($terminos_busqueda);
                $lbt = key($terminos_busqueda);
                if ($lbt == 'categoria.id_estado')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'estado', $lbc);
                    $lbc = ucwords($bcc->estado);
                }
                if ($lbt == 'categoria.id_categoria')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'categoria', $lbc);
                    $lbc = ucwords($bcc->nombre);
                }
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
                							 										lang('backend_url').'/'.lang('categorias_url').'/'.lang('buscar_url') => lang('listado_busqueda'),
                							 										lang('titulo') => !empty($lbc) ? $lbc : lang('categoria').' '.lang('sin_nombre')
																				 )
											 						  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
                							 										lang('backend_url').'/'.lang('categorias_url').'/'.lang('listado_url') => lang('listado')
																				 )
											 						  );
            }
			$data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
			$data['usuario'] = array(
										'nombre' => $this->session->userdata('nombre'),
										'apellidos' => $this->session->userdata('apellidos')
									);
			$data['contenido_principal'] = $this->load->view('back/listado_categoria', $data, true);
            $this->load->view('back/template_new', $data);
        }
	}

	function buscar($mensaje = '')
	{
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $data['active'] = 'categorias';
        $data['sub'] = 'buscar';
        $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('buscar_tit_not');
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('buscar_url') => lang('listado_buscar').' '.lang('categoria')));
        $data['mensaje'] = $mensaje;
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
        $data['contenido_principal'] = $this->load->view('back/buscar_categoria', $data, true);
        $this->load->view('back/template_new', $data);
    }

    function crear()
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
		$this->load->helper('misc');
        
        $data['active'] 	= 'categorias';
        $data['sub'] 		= 'crear';
		$data['title'] 		= lang('meta.titulo').' - '.lang('categorias').' - '.lang('listado_crear');
        $data['breadcrumbs']= $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
										    							 	lang('backend_url').'/'.lang('categorias_url').'/'.lang('crear_url') => lang('listado_crear').' '.lang('categoria')
																		 )
															  );
        
		$data['arbol_categorias']	= modules::run('services/relations/arbol_categorias','','0');
        $data['estados'] 			= modules::run('services/relations/get_all', 'estado', 'true');
        //$data['categoria'] 		= modules::run('services/relations/get_all', 'categoria', 'true');
		$data['categorias_js'] 		= $this->load->view('back/js/categoria_js.php', $data, true);
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		
		$data['crear'] = TRUE;
        $data['contenido_principal'] = $this->load->view('back/crear_categoria', $data, true);
        $this->load->view('back/template_new', $data);
    }


    function fecha_pasada($fecha)
    {
        return mysql_to_unix($fecha) <= time();
    }

    function create($id = '')
    {
    	//die_pre($_POST);
    	modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
    	$this->load->library('form_validation');
		$this->load->library('upload');
        $img_folder = 'assets/front/img/';

        if ($id != '')
        	modules::run('services/monitor/add', 'categoria', $id, $this->session->userdata('id_usuario'), 'editar');
        else
        	modules::run('services/monitor/add', 'categoria', '', $this->session->userdata('id_usuario'), 'crear');
        
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->form_validation->set_rules('id_estado', 'Estado', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('listado_crear');
            if ($id != '')
            {
                $data['categoria'] = $this->categoria_model->read($id);
                $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('listado_editar');
            }
            $data['active'] = 'categoria';

            if ($id != '')
            {
            	$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
										    							 	lang('backend_url').'/'.lang('categorias_url').'/'.lang('editar_url').'_'.lang('categoria') => lang('listado_editar'),
										    							 	lang('backend_url').'/'.lang('categorias_url').'/'.lang('editar_url').'_'.lang('categoria').'/'.$id =>
										    							 		(isset($data['categoria']->nombre) && !empty($data['categoria']->nombre))
										    							 			? $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre') 
																		 )
															  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                														array(
                																lang('backend_url') => lang('backend'),
											    								lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
											    							 	lang('backend_url').'/'.lang('categorias_url').'/'.lang('crear_url').'_'.lang('categoria') => lang('listado_crear')
																			 )
																	  );
            }
            $data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
            $data['contenido_principal'] = $this->load->view('back/crear_categoria', $data, true);
            $this->load->view('back/template_new', $data);
        }


         else
         {

            $form_data = $_POST;
			$form_data['id_usuario'] = $this->session->userdata('id_usuario');
            $id = $this->categoria_model->update($form_data);

			if($this->session->userdata('idioma') == 'es')
            	redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id, 'location');
			else
				redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/' .$id, 'location');
        }
    }

    function edit($id = '', $ajax = false)
    {
        if ($id == '')
		{
            redirect('backend');
		}
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		$this->load->helper('misc');
        $data['active'] = 'categoria';
        $data['sub'] = 'editar';

        $data['categoria'] = $datos_categoria = $this->categoria_model->read($id);

		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
									        					   array(
									        					   			lang('backend_url') => lang('backend'),
									        								lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
									        								lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id => lang('listado_editar'),
									        								'#' => (isset($data['categoria']->nombre) && $data['categoria']->nombre != '') ? $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre')
																		)
															  );
		$data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('editar').' '.$data['categoria']->nombre;
		$data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
		$data['arbol_categorias']	= modules::run('services/relations/arbol_categorias', '', $datos_categoria->id_categoria, $datos_categoria->id_categoria_padre);
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		$data['array_destacado'] = destacado_dropdown();
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
	$data['categorias_js'] = $this->load->view('back/js/categoria_js', $data, true);
        $data['contenido_principal'] = $this->load->view('back/crear_categoria', $data, true);
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
        if ($id == '')
		{
			redirect('backend/categorias');
		}
        $data['active'] = 'categoria';
        $data['sub'] = 'editar';
        $data['categoria'] = $datos_categoria = $this->categoria_model->read($id);
		
		$categ_path = modules::run('services/relations/get_categoria_bc', $datos_categoria->id_categoria);
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
        																lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id => (isset($data['categoria']->nombre) ? lang('ficha_inicio').' ' . $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre'))
																	 )
															  );
		/*--- Zona de url ----*/

		//Imagen Principal
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');


        $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.(isset($data['categoria']->nombre) ? lang('ficha_inicio').' ' . $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre'));
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['accion'] = 'normal';
		$data['sub_activo'] = 'Ficha';
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id, 'categoria', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id, 'categoria', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id, 'categoria', 3);
        $data['categoria_idiomas'] = $this->categoria_model->detalles($id);

		/*--- Cargas de vistas ---*/
		$data['tiene_img_secundarias'] = FALSE;
		$data['categoria_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		$data['categoria_info'] = $this->load->view('back/ficha/categoria_info', $data, true); //Información básica de la categoria
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true); //Información de los idiomas
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_categoria', $data, true); //Vista para la creación de nuevos idiomas
		$data['idioma_nuevo'] = $this->load->view('back/ficha/idioma_categoria', $data, true); //Vista para la creación de nuevos idiomas
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_categoria', $data, true); //Carga de contenido principal
        $this->load->view('back/template_new', $data);
    }

    function editar_idioma($id_categoria, $id_detalle_categoria = '')
    {
    	$this->load->model('multimedia/multimedia_model');
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        if ($id_detalle_categoria == '')
		{
			redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id_categoria);
		}
		//$data['categoria'] = $this->categoria_model->read($id_categoria);
		$data['categoria'] = $this->categoria_model->read($id_categoria,$id_detalle_categoria);
		$data['active'] = 'categorias';
		$data['sub'] = 'ficha';
		$data['accion'] = 'editar';
		$data['sub_activo'] = 'EditLangTab';
		$data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('editar_idioma');
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																		array(
																			base_url().lang('backend_url') => lang('backend'),
																			'categoria' => lang('categorias'),
																			lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'/'.$id_categoria => lang('idioma_edt_not'),
																			$id_categoria => (isset($data['categoria']->nombre) && $data['categoria']->nombre != '') ? $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre')
																		)
																	  );
		/*
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('secundarias');	//Imagenes secundarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('terciarias');	//Imagenes terciarias
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
		$data['categoria_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		*/
		
		//AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$id_categoria.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id_categoria, 'categoria', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id_categoria, 'categoria', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id_categoria, 'categoria', 3);
		$data['tiene_img_secundarias'] = FALSE;
		$data['categoria_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		//FIN - AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		
		
		$data['categoria_idiomas'] = $this->categoria_model->detalles($id_categoria, $id_detalle_categoria);
		$data['categoria_info'] = $this->load->view('back/ficha/categoria_info', $data, true);
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true);
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_categoria', $data, true);
        $data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		$data['usuario'] = array(
								'nombre' => $this->session->userdata('nombre'),
								'apellidos' => $this->session->userdata('apellidos')
							);
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_categoria', $data, true);
        $this->load->view('back/template_new', $data);

    }
	
	function validar_url($url)
	{
		$this->form_validation->set_message('validar_url', 'La url indicada ya existe.');
		
		$id_categoria = $this->categoria_model->get_id_categoria_url($url);
		
		if(!empty($id_categoria) && is_numeric($id_categoria) && $id_categoria > 0 && $this->input->post('accion') != 'editar')
			$return = FALSE;
		else $return = TRUE;
		
		return $return;
	}
	
    function guardar_idioma()
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $data = $_POST;
		//die_pre($data);
		$this->load->model('multimedia/multimedia_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('id_idioma', 'Idioma', 'required');
        $this->form_validation->set_rules('nombre', 'Titulo', 'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_breve', 'Descripcion Breve', 'min_length[10]|required');
        $this->form_validation->set_rules('descripcion_ampliada', 'Descripcion Ampliada', 'min_length[20]|required');
        $this->form_validation->set_rules('url', 'URL', 'required|callback_validar_url');
        $this->form_validation->set_rules('titulo_pagina', 'Titulo pagina', 'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_pagina', 'Descripcion pagina', 'required|min_length[10]');
        $this->form_validation->set_rules('keywords', 'Palabras clave', 'required');

        if ($this->form_validation->run($this) == FALSE)
        {
            $data['active'] = 'categoria';
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('listado_editar').' '.lang('idioma_url');
            if ($data['id_categoria'] != '')
			{
                $data['categoria'] = modules::run('categoria/read', $data['id_categoria']);
				$temp_bread = ($this->session->userdata('idioma') == 'es') ? lang('ficha_url').'_'.lang('categoria_url').'/'.$data['id_categoria']: lang('categoria_url').'_'.lang('ficha_url').'/'.$data['id_categoria'];
				$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																		array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
	        																lang('backend_url').'/'.lang('categorias_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
																			$data['id_categoria'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('categoria').' '.lang('sin_nombre')
																		 )
																	 );
            }
			else
			{
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                														array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
	        																lang('backend_url').'/'.lang('categorias_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
	        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('crear_url') => lang('listado_crear'),
																			$data['id_categoria'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('categoria').' '.lang('sin_nombre')
																		 )
																	  );
       	}


			/*	En esta zona se vuelve a construir la vista de la ficha,
			 * 	es importante cargar todas las vistas necesarias y variables.
			 * 	Para que las imagenes cargen es necesario cargar las vistas y las
			 *  urls de imagen_principal, imagenes_secundarias e inclusive imagenes_terciarias.
			 *
			 * */


			$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$data['id_categoria'].'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
			$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$data['id_categoria'].'/'.lang('adicionar_url').'/'.lang('secundarias'); //Imagenes secundarias
			$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.$data['id_categoria'].'/'.lang('adicionar_url').'/'.lang('terciarias'); //Imagenes terciarias
			$data['url_delete'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
			$data['imagen_principal'] = $this->multimedia_model->get_relation($data['id_categoria'], 'categoria', 1);
			$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($data['id_categoria'], 'categoria', 2);
			$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($data['id_categoria'], 'categoria', 3);
			$data['accion'] = ($this->input->post('accion') == 'normal') ? 'normal' : 'editar' ;
			$data['sub_activo'] = ($this->input->post('accion') == 'normal') ? 'NewLangTab' : 'EditLangTab' ;
			$data['categoria_idiomas'] = $this->categoria_model->detalles($data['id_categoria']);
			$data['categoria_info'] = $this->load->view('back/ficha/categoria_info', $data, true);
			$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true);
			$data['idioma_form'] = $this->load->view('back/ficha/idioma_categoria', $data, true);
			$data['idioma_nuevo'] = $this->load->view('back/ficha/idioma_categoria', $data, true);
			$data['tiene_img_secundarias'] = FALSE;
			$data['categoria_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
			$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
            $data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
			$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
            $data['contenido_principal'] = $this->load->view('back/ficha/ficha_categoria', $data, true);
            $this->load->view('back/template_new', $data);
        }
        else
        {
			unset($data['accion']);
            //Convertir saltos de linea en <br />
            //$data['descripcion_ampliada'] = nl2br($data['descripcion_ampliada']);
			//echo $data['descripcion_ampliada'];
			$data['descripcion_ampliada'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada']);
			//die($data['descripcion_ampliada']);

            $id = $this->categoria_model->update_idioma($data);

            modules::run('services/monitor/add', 'detalle_categoria', $id, $this->session->userdata('id_usuario'), 'editar_idioma');
			if($this->session->userdata('idioma') == 'es')
				redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$data['id_categoria']);
			else
				redirect(lang('backend_url').'/'.lang('categorias_url').'/'.lang('categoria_url').'_'.lang('ficha_url').'/'.$data['id_categoria']);
        }
    }

	function imagen($id, $destacado = 1)
	{
		$this->lang->load('back', 'es');
        if ($id == '')
		{
			redirect(lang('backend_url').'/'.lang('categorias_url'));
		}
		if ($_FILES)
		{
			require FCPATH.'server/index.php';
			return;
		}

		$data['categoria'] = $this->categoria_model->read($id);
		$data['tipo'] = "categoria";
		$data['id'] = $id;
		$data['destacado'] = $destacado;
		$data['url'] = base_url().lang('backend_url').'/'.lang('categorias_url').'/'.lang('imagenes_url').'/'.lang('procesar_url').'_'.lang('imagenes_url');
		$data['imagen'] = TRUE;
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => 	lang('backend'),
        																lang('backend_url').'/'.lang('categorias_url') => lang('categorias'),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id => (isset($data['categoria']->nombre) ? lang('ficha_inicio').' ' . $data['categoria']->nombre : lang('categoria').' '.lang('sin_nombre')),
        																lang('backend_url').'/'.lang('categorias_url').'/'.lang('ficha_url').'_'.lang('categoria_url').'/'.$id.'/'.lang('adicionar_url') => lang('subir_imagen')
																	 )
															  );
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('categorias_url'), 'listado');
		$data['active'] = 'categorias';
		$data['sub'] = 'ficha';
		$data['title'] = lang('meta.titulo').' - '.lang('categorias').' - '.lang('subir_imagen');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['file_upload_js'] = $this->load->view('template/file_upload_js', $data, true); //Widget de subida de imagenes
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
								'id_categoria' => $imagen['id'],
								'id_multimedia' => $id_imagen
						   );
			$this->multimedia_model->crear_rel_multimedia($data_rel, 'categoria');
		}
	}

	function imagen_eliminar(){
		$this->load->model('multimedia/multimedia_model');
		$this->multimedia_model->delete_image($this->input->post('id_multimedia'), 'categoria', $this->input->post('fichero'));
	}

    function eliminar_idioma($id_categoria, $id_detalle_categoria = '', $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        modules::run('services/monitor/add', 'detalle_categoria', $id_detalle_categoria, $this->session->userdata('id_usuario'), 'eliminar_idioma');
       // $detalle = $this->detalle($id);
		//echo '<pre>'.print_r($detalle, true).'</pre>'; die();
        $ret = $this->categoria_model->eliminar_idioma($id_detalle_categoria);
        $str = ($ret == true) ? 'true' : 'false';
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            redirect('backend/ficha_categoria/' . $id_categoria);
    }

    function delete($id, $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $ret = $this->categoria_model->delete($id);
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
        $ret = $this->categoria_model->read($id, $detalle_id);
        if ($ajax)
            echo json_encode($ret);
        else
            return $ret;
    }

    function get_categoria($output = 'json', $id = '')
    {
        $categoria = $this->categoria_model->read($id);
        if ($output == 'xml')
        {
            $domDoc = new DOMDocument;
            $rootElt = $domDoc->createElement('categoria');
            $rootNode = $domDoc->appendChild($rootElt);
            foreach ($categoria as $field => $value)
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
            echo json_encode($categoria);
        }
    }

    function get_categoria_list($output = 'json', $f = 'categoria.id_categoria', $v = 1, $group = false)
    {
        $Noticias = $this->categoria_model->get_list($f, $v, $group);
        if ($output == 'xml') {
            $domDoc = new DOMDocument;
            foreach ($Noticias as $categoria)
            {
                $rootElt = $domDoc->createElement('categoria');
                $rootNode = $domDoc->appendChild($rootElt);
                foreach ($categoria as $field => $value)
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
        //$ret = $this->categoria_model->get('detalle_categoria', $id);
        $ret = $this->categoria_model->get($id);
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

    function Categorias_categoria($id_categoria, $ajax = 1)
    {
        if ($ajax == 1)
		{
			echo modules::run('services/relations/get_from_categoria', $id_categoria, 'categoria', $ajax);
		}
        else
		{
			return modules::run('services/relations/get_from_categoria', $id_categoria, 'categoria', $ajax);
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

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
