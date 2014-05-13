<?php defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Restaurante extends MX_Controller
{
    function __construct()
    {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		modules::run('idioma/set_idioma', 'es');
        $this->load->model('restaurante_model');
        $this->load->helper('multimedia');
    }
	
    function index()
    {
        $this->listado();
    }

    function listado($order_field = 'restaurante.id_restaurante', $order_dir = 'desc', $start = 0, $ajax = false, $permisologia = '')
    {
    	//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        if ($start == 0 && empty($_POST) && $order_field == 'restaurante.id_restaurante')
        {
        	$this->session->unset_userdata('terminos_busqueda');
        }
		
		//Buscador
        $terminos_busqueda = array();
        $terminos_busqueda = $this->session->userdata('terminos_busqueda');
		
        if (isset($_POST['texto']))
        {
            $terminos_busqueda['texto'] = $_POST['texto'];
        }
        if (isset($_POST['id_restaurante']))
        {
            $terminos_busqueda['restaurante.id_restaurante'] = $_POST['id_restaurante'];
        }
		if (isset($_POST['destacado']))
		{
            $terminos_busqueda['restaurante.destacado'] = $_POST['destacado'];
        }
        if (isset($_POST['id_estado']))
        {
            $terminos_busqueda['restaurante.id_estado'] = $_POST['id_estado'];
        }
        if (isset($_POST) && !empty($_POST))
        {
            $terminos_busqueda = array_filter($terminos_busqueda);
            $this->session->set_userdata('terminos_busqueda', $terminos_busqueda);
        }

		//Paginacion / Orden
        $limit 			= 5;
        $order_string 	= '';
        $order_string	.= ($order_field == "") ? '' : $order_field;
        $order_string	.= ($order_dir == "") ? '' : ' ' . $order_dir;

        $od = ($order_dir == 'asc') ? 'desc' : 'asc';
		
        $data['order_field'] 			= $order_field;
        $data['order_dir'] 				= $order_dir;
        $data['order_by_new'] 			= (($order_field == '') ? 'id_restaurante' : $order_field) . "/" . $od;
        $data['url'] 					= lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('listado_url');
        $config['base_url'] 			= '/'.lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('listado_url').'/'.$order_field.'/'.$order_dir;
        $config['per_page'] 			= $limit;
        $config['uri_segment'] 			= 6;
		$config['first_tag_open'] 		= '<li>';
		$config['first_tag_close'] 		= '</li>';
		$config['full_tag_open'] 		= '<ul class="pagination">';
		$config['full_tag_close'] 		= '</ul>';
		$config['next_link'] 			= "&rsaquo;";
		$config['next_tag_open'] 		= '<li class="arrow">';
		$config['next_tag_close'] 		= '</li>';
		$config['prev_link'] 			= "&lsaquo;";
		$config['prev_tag_open'] 		= '<li class="arrow">';
		$config['prev_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '<li class="current"><a href="#">';
		$config['cur_tag_close'] 		= '</a></li>';
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['last_link'] 			= "&raquo;";
		$config['last_tag_open'] 		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['first_link'] 			= "&laquo;";
		$config['fist_tag_open'] 		= '<li>';
		$config['fist_tag_close']		= '</li>';
        $data['num_restaurantes'] 		= $this->restaurante_model->count_all($terminos_busqueda);
		
        $config['total_rows'] 			= $data['num_restaurantes'];
		
        if ($config['total_rows'] == 0)
        {
        	redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('buscar_url').'/'.lang('ningun_resultado'));
        }
        $data['restaurantes'] = $this->restaurante_model->get_page($start, $limit, $order_field, $order_dir, 'back', $terminos_busqueda);
		
        if($ajax)
        {
            echo json_encode($data['restaurantes']);
        }
        else
        {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
			
            $data['pagination'] 		= $this->pagination->create_links();
            $data['offset'] 			= $start;
            $data['order_field'] 		= $order_field;
            $data['order_direction'] 	= $order_dir;
            $data['active'] 			= 'restaurantes';
			
            if (!empty($terminos_busqueda))
            {
            	$data['sub'] = 'buscar';
            }
            else
			{
				$data['sub'] = 'listado';
			}
			
			//Title Pagina
            $data['title'] = lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('listado');
            
			//Breadcrumbs
            if (!empty($terminos_busqueda))
            {
                $lbc = reset($terminos_busqueda);
                $lbt = key($terminos_busqueda);

                if ($lbt == 'restaurante.id_estado')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'estado', $lbc);
                    $lbc = ucwords($bcc->estado);
                }
                if ($lbt == 'restaurante.id_producto')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'producto', $lbc);
                    $lbc = ucwords($bcc->nombre);
                }
            	$data['breadcrumbs'] = $this->menus->create_breadcrumb(		array(
            																	lang('backend_url') => lang('backend'),
            																	lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
            							 										lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('buscar_url') => lang('busqueda'),
            							 										lang('titulo') => $lbc
																			 )
											 						  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
                							 										lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('listado_url') => lang('listado')
																				 )
											 						  );
            }
			
			//Cargar Pagina
			$data['menu_principal'] = $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
			$data['usuario'] = array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
			$data['contenido_principal'] = $this->load->view('back/listar/listado_restaurante', $data, true);
            $this->load->view('back/template_new', $data);
        }
    }

    function buscar($mensaje = '')
	{
		//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $data['active'] 	= 'restaurantes';
        $data['sub'] 		= 'buscar';
        $data['title'] 		= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('buscar_tit_not');
		
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(array(lang('backend_url') => lang('backend'),
        															 lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
        															 lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('buscar_url') => lang('buscar_tit_not')));
        
        $data['mensaje'] 			= $mensaje;
		$data['array_destacado'] 	= destacado_dropdown();
		array_unshift($data['array_destacado'], '');
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		
		$data['usuario'] = array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
        $data['contenido_principal'] = $this->load->view('back/buscar/buscar_restaurante', $data, true);
        $this->load->view('back/template_new', $data);
    }

    function crear()
    {
    	//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
		$this->load->helper('misc');
        $data['active'] 		= 'restaurantes';
        $data['sub'] 			= 'crear';
		$data['title'] 			= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('crear_tit_not');
		
        $data['breadcrumbs'] 	= $this->menus->create_breadcrumb(array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
										    							 	lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('crear_url') => lang('crear_tit_not')
																		 )
															  );
															  
		$data['array_destacado'] 	= destacado_dropdown();
        $data['estados'] 			= modules::run('services/relations/get_all', 'estado');
        //$data['restaurante'] 		= modules::run('services/relations/get_all', 'restaurante', 'true');
		$data['restaurantes_js'] 	= $this->load->view('back/js/restaurante_js.php', $data, true);
		
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		$data['usuario'] 			= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
		$data['crear'] 				= TRUE;
        $data['contenido_principal']= $this->load->view('back/crear/crear_restaurante', $data, true);
        $this->load->view('back/template_new', $data);
    }


    function fecha_pasada($fecha)
    {
        return mysql_to_unix($fecha) <= time();
    }

    function create($id = '')
    {
    	//Login / Idioma
    	modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $img_folder = 'assets/front/img/';

        if ($id != '')
        {
        	modules::run('services/monitor/add', 'restaurante', $id, $this->session->userdata('id_usuario'), 'editar');
        }
        else
        {
        	modules::run('services/monitor/add', 'restaurante', '', $this->session->userdata('id_usuario'), 'crear');
        }
		
		//Rules
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->form_validation->set_rules('id_estado', 'Estado', 'required');
      	//$this->load->library('upload', $config);
        $this->load->library('upload');

        if ($this->form_validation->run() == FALSE)
        {
            $data['sub'] 	= 'crear';
            $data['title'] 	= lang('crear_tit_not');
			$data['active'] = 'restaurante';
			
            if ($id != '')
            {
                $data['restaurante'] 	= $this->restaurante_model->read($id);
                $data['title'] 			= lang('editar_tit_not');
            }
			
            if ($id != '')
            {
            	$data['breadcrumbs'] = $this->menus->create_breadcrumb(array(
            																	'restaurante' => lang('restaurantes'),
            																	'edit'	=>	lang('editar_tit_not'),
            																	$id	=>	$data['restaurante']->nombre
																			 )
																	  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(array(
                																'restaurante' => lang('restaurantes'),
                																'crear' => lang('crear_tit_not')
																			 )
																	  );
            }
			
			$data['array_destacado'] 		= destacado_dropdown();
            $data['estados'] 				= modules::run('services/relations/get_all', 'estado');
            $data['contenido_principal'] 	= $this->load->view('back/crear/crear_restaurante', $data, true);
            $this->load->view('back/template_new', $data);
        }
		else
		{
			//POST
            $form_data = $_POST;
			//$form_data['descripcion_ampliada'] = preg_replace("#(<p>&nbsp;</p><br?/>)+#i", '', $form_data['descripcion_ampliada']);
			//echo '<pre>'.print_r($form_data).'</pre>';
			
			//UPDATE
            $id = $this->restaurante_model->update($form_data);
			
			//REDIRECT
			if($this->session->userdata('idioma') == 'es')
			{
            	redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/' . $id, 'location');
            }
			else
			{
				redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/' . $id, 'location');
			}
        }
    }

    function edit($id = '', $ajax = false)
    {
    	//REDIRECT
        if ($id == '')
		{
            redirect('backend');
		}
		
		//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
		$this->load->helper('misc');
        $data['active'] 	= 'restaurante';
        $data['sub'] 		= 'editar';

        $data['restaurante'] = $this->restaurante_model->read($id);

		$data['breadcrumbs'] = $this->menus->create_breadcrumb(array(
									        					   		lang('backend_url') => lang('backend'),
									        							lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
									        							lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$id => lang('editar_tit_not'),
									        							'#' => (isset($data['restaurante']->nombre) && $data['restaurante']->nombre != '') ? $data['restaurante']->nombre : lang('restaurantes_sintitulo')
																	)
															  );
															  
		$data['title'] 				= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('editar').' '.$data['restaurante']->nombre;
		$data['estados'] 			= modules::run('services/relations/get_all', 'estado');
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		$data['array_destacado'] 	= destacado_dropdown();
		$data['usuario'] 			= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
		
		$data['restaurantes_js'] = $this->load->view('back/js/restaurante_js', $data, true);
        $data['contenido_principal'] = $this->load->view('back/crear/crear_restaurante', $data, true);
        
        if($ajax)
		{
            echo $data['contenido_principal'];
		}
        else
		{
            $this->load->view('back/template_new', $data);
		}
    }

    function ficha($id = '')
    {
    	$this->load->model('multimedia/multimedia_model');
		
		//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
		//REDIRECT
        if ($id == '')
		{
			redirect('backend/restaurantes');
		}

        $data['active'] 		= 'restaurante';
        $data['sub'] 			= 'editar';
        $data['restaurante'] 	= $this->restaurante_model->read($id);
        $data['breadcrumbs'] 	= $this->menus->create_breadcrumb(array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
        																lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$id => (isset($data['restaurante']->nombre) ? lang('ficha_inicio').' ' . $data['restaurante']->nombre : lang('restaurantes_sintitulo'))
																	 )
															  );
		/*--- Zona de url ----*/

		//Imagen Principal
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('principal');
		
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('secundarias');
		
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('terciarias');
		
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');


        $data['title'] 					= lang('meta.titulo').' - '.lang('restaurantes').' - '.(isset($data['restaurante']->nombre) ? lang('ficha_inicio').' ' . $data['restaurante']->nombre : lang('restaurantes_sintitulo'));
		$data['menu_principal'] 		= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		$data['usuario'] 				= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
		$data['accion'] 				= 'normal';
		$data['sub_activo'] 			= 'Ficha';
		
		$data['permite_secundarias'] = TRUE;
		$data['imagen_principal'] 		= $this->multimedia_model->get_relation($id, 'restaurante', 1);
		$data['imagenes_secundarias'] 	= $this->multimedia_model->get_relation($id, 'restaurante', 2);
		$data['imagenes_terciarias'] 	= $this->multimedia_model->get_relation($id, 'restaurante', 3);
        $data['restaurante_idiomas'] 	= $this->restaurante_model->detalles($id);

		/*--- Cargas de vistas ---*/
		$data['restaurante_imagenes'] 	= $this->load->view('template/ficha_imagen', $data, true); 			//Ficha de la sección de imagenes
		$data['ficha_js'] 				= $this->load->view('template/ficha_imagen_js', $data, true); 		//Contenido js de la seccion ficha imagenes
		$data['restaurante_info'] 		= $this->load->view('back/ficha/restaurante_info', $data, true); 	//Información básica de la restaurante
		$data['idioma_info'] 			= $this->load->view('back/ficha/idioma_info', $data, true); 		//Información de los idiomas
		$data['idioma_form'] 			= $this->load->view('back/ficha/idioma_restaurante', $data, true); 	//Vista para la creación de nuevos idiomas
		$data['idioma_nuevo'] 			= $this->load->view('back/ficha/idioma_restaurante', $data, true); 	//Vista para la creación de nuevos idiomas
        $data['contenido_principal'] 	= $this->load->view('back/ficha/ficha_restaurante', $data, true); 	//Carga de contenido principal
        
        $this->load->view('back/template_new', $data);
    }

    function editar_idioma($id_restaurante, $id_detalle_restaurante = '')
    {
    	$this->load->model('multimedia/multimedia_model');
		
		//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        if ($id_detalle_restaurante == '')
		{
			redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$id_restaurante);
		}
		
		//$data['restaurante'] 	= $this->restaurante_model->read($id_restaurante);
		$data['restaurante'] 	= $this->restaurante_model->read($id_restaurante,$id_detalle_restaurante);
		$data['active'] 		= 'restaurantes';
		$data['sub'] 			= 'ficha';
		$data['accion'] 		= 'editar';
		$data['sub_activo'] 	= 'EditLangTab';
		$data['title'] 			= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('editar_idioma');
		
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(array(
																		base_url().lang('backend_url') => lang('backend'),
																		'restaurante' => lang('restaurantes'),
																		lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'/'.$id_restaurante => lang('idioma_edt_not'),
																		$id_restaurante => (isset($data['restaurante']->nombre) && $data['restaurante']->nombre != '') ? $data['restaurante']->nombre : lang('restaurantes_sinnombre')
																	)
																);
		/*
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('secundarias');	//Imagenes secundarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('terciarias');	//Imagenes terciarias
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
		$data['restaurante_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		*/
		
		//AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('principal');
		
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('secundarias');
		
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$id_restaurante.'/'.lang('adicionar_url').'/'.lang('terciarias');
		
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');
		
		$data['permite_secundarias'] = TRUE;
		$data['imagen_principal'] 		= $this->multimedia_model->get_relation($id_restaurante, 'restaurante', 1);
		$data['imagenes_secundarias'] 	= $this->multimedia_model->get_relation($id_restaurante, 'restaurante', 2);
		$data['imagenes_terciarias'] 	= $this->multimedia_model->get_relation($id_restaurante, 'restaurante', 3);
		$data['restaurante_imagenes'] 	= $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] 				= $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		
		//FIN - AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		
		
		$data['restaurante_idiomas'] 	= $this->restaurante_model->detalles($id_restaurante, $id_detalle_restaurante);
		$data['restaurante_info'] 		= $this->load->view('back/ficha/restaurante_info', $data, true);
		$data['idioma_info'] 			= $this->load->view('back/ficha/idioma_info', $data, true);
		$data['idioma_form'] 			= $this->load->view('back/ficha/idioma_restaurante', $data, true);
        $data['menu_principal'] 		= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		
		$data['usuario'] = array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_restaurante', $data, true);
        $this->load->view('back/template_new', $data);
    }


    function guardar_idioma()
    {
    	//Login / Idioma
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
		//POST
        $data = $_POST;
		$data['url'] = modules::run('services/cleanup_url',$data['url']);
		
		//RULES
		$this->load->model('multimedia/multimedia_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('id_idioma', 				'Idioma', 				'required');
        $this->form_validation->set_rules('nombre', 				'Titulo', 				'required|min_length[5]');
        $this->form_validation->set_rules('subtitulo', 				'Subtitulo', 			'min_length[5]');
        $this->form_validation->set_rules('descripcion_breve', 		'Descripcion Breve',	'min_length[10]|required');
        $this->form_validation->set_rules('descripcion_ampliada', 	'Descripcion Ampliada', 'min_length[50]|required');
        $this->form_validation->set_rules('url', 					'URL', 					'required|callback__validar_url');
        $this->form_validation->set_rules('titulo_pagina', 			'Titulo pagina', 		'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_pagina', 	'Descripcion pagina', 	'required|min_length[10]');
        $this->form_validation->set_rules('keywords', 				'Palabras clave', 		'required');

        if ($this->form_validation->run($this) == FALSE)
        {
            $data['active'] 	= 'restaurante';
            $data['sub'] 		= 'crear';
            $data['title'] 		= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('idioma_edt_not');
			
            if ($data['id_restaurante'] != '')
			{
                $data['restaurante'] 	= modules::run('restaurante/read', $data['id_restaurante']);
				$temp_bread 			= ($this->session->userdata('idioma') == 'es') ? lang('ficha_url').'_'.lang('restaurante_url').'/'.$data['id_restaurante']: lang('restaurante_url').'_'.lang('ficha_url').'/'.$data['id_restaurante'];
				$data['breadcrumbs'] 	= $this->menus->create_breadcrumb(array( base_url().lang('backend_url') => lang('backend'), 'restaurante' => lang('restaurantes'), lang('backend_url').'/'.lang('restaurantes_url').'/'.$temp_bread => lang('idioma_edt_not'), $data['id_restaurante'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('restaurantes_sinnombre')));
            }
			else
			{
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(array(base_url().lang('backend_url') => lang('backend'), 'restaurante' => lang('restaurantes'), 'crear' => lang('crear_tit_not')));
            }


			/*	
			 *  En esta zona se vuelve a construir la vista de la ficha,
			 * 	es importante cargar todas las vistas necesarias y variables.
			 * 	Para que las imagenes cargen es necesario cargar las vistas y las
			 *  urls de imagen_principal, imagenes_secundarias e inclusive imagenes_terciarias.
			 * 
			 * */

			$data['url_add_p'] 	= base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$data['id_restaurante'].'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
			$data['url_add_s'] 	= base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$data['id_restaurante'].'/'.lang('adicionar_url').'/'.lang('secundarias'); //Imagenes secundarias
			$data['url_add_t'] 	= base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.$data['id_restaurante'].'/'.lang('adicionar_url').'/'.lang('terciarias'); //Imagenes terciarias
			$data['url_delete'] = base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
			
			$data['permite_secundarias'] = TRUE;
			$data['imagen_principal'] 		= $this->multimedia_model->get_relation($data['id_restaurante'], 'restaurante', 1);
			$data['imagenes_secundarias'] 	= $this->multimedia_model->get_relation($data['id_restaurante'], 'restaurante', 2);
			$data['imagenes_terciarias'] 	= $this->multimedia_model->get_relation($data['id_restaurante'], 'restaurante', 3);
			
			$data['accion'] 	= ($this->input->post('accion') == 'normal') ? 'normal' : 'editar' ;
			$data['sub_activo'] = ($this->input->post('accion') == 'normal') ? 'NewLangTab' : 'EditLangTab' ;
			
			$data['restaurante_idiomas'] 	= $this->restaurante_model->detalles($data['id_restaurante']);
			$data['restaurante_info'] 		= $this->load->view('back/ficha/restaurante_info', $data, true);
			$data['idioma_info'] 			= $this->load->view('back/ficha/idioma_info', $data, true);
			$data['idioma_form'] 			= $this->load->view('back/ficha/idioma_restaurante', $data, true);
			$data['idioma_nuevo'] 			= $this->load->view('back/ficha/idioma_restaurante', $data, true);
			$data['restaurante_imagenes'] 	= $this->load->view('template/ficha_imagen', $data, true); 			//Ficha de la sección de imagenes
			$data['ficha_js'] 				= $this->load->view('template/ficha_imagen_js', $data, true); 		//Contenido js de la seccion ficha imagenes
           
			$data['menu_principal'] 		= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
			$data['usuario'] 				= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
            $data['contenido_principal'] 	= $this->load->view('back/ficha/ficha_restaurante', $data, true);
            $this->load->view('back/template_new', $data);
        }
        else
        {
			unset($data['accion']);
            //Convertir saltos de linea en <br />
            //$data['descripcion_ampliada'] = nl2br($data['descripcion_ampliada']);
			//echo $data['descripcion_ampliada'];
			$data['descripcion_ampliada'] = preg_replace(array("#<p>&nbsp;</p>#i", "#(<br ?/>)+$#i"), array("", ""), $data['descripcion_ampliada']);

            $id = $this->restaurante_model->update_idioma($data);
            modules::run('services/monitor/add', 'detalle_restaurante', $id, $this->session->userdata('id_usuario'), 'editar_idioma');
			
			if($this->session->userdata('idioma') == 'es')
			{
				redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$data['id_restaurante']);
			}
			else
			{
				redirect(lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('restaurante_url').'_'.lang('ficha_url').'/'.$data['id_restaurante']);
			}
        }
    }

	function imagen($id, $destacado = 1)
	{
		$this->lang->load('back', 'es');
		
        if ($id == '')
		{
			redirect(lang('backend_url').'/'.lang('restaurantes_url'));
		}
		if ($_FILES)
		{
			require FCPATH.'server/index.php';
			return;
		}

		$data['restaurante'] 	= $this->restaurante_model->read($id);
		$data['tipo'] 			= "restaurante";
		$data['id'] 			= $id;
		$data['destacado'] 		= $destacado;
		$data['url'] 			= base_url().lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('imagenes_url').'/'.lang('procesar_url').'_'.lang('imagenes_url');
		$data['imagen'] 		= TRUE;
		$data['breadcrumbs'] 	= $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => 	lang('backend'),
        																lang('backend_url').'/'.lang('restaurantes_url') => lang('restaurantes'),
        																lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$id => (isset($data['restaurante']->nombre) ? lang('ficha_inicio').' ' . $data['restaurante']->nombre : lang('restaurantes_sintitulo')),
        																lang('backend_url').'/'.lang('restaurantes_url').'/'.lang('ficha_url').'_'.lang('restaurante_url').'/'.$id.'/'.lang('adicionar_url') => lang('subir_imagen')
																	 )
															  );
															  
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('restaurantes_url'), 'listado');
		$data['active'] 			= 'restaurantes';
		$data['sub'] 				= 'ficha';
		$data['title'] 				= lang('meta.titulo').' - '.lang('restaurantes').' - '.lang('subir_imagen');
		$data['usuario'] 			= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos') );
		
		$data['file_upload_js'] 		= $this->load->view('template/file_upload_js', $data, true); 		//Widget de subida de imagenes
		$data['file_upload_widget'] 	= $this->load->view('template/file_upload_widget', $data, true); 	//Widget de subida de imagenes
		$data['contenido_principal'] 	= $this->load->view('back/ficha/subida_imagen', $data, true);
		
		$this->load->view('back/template_new', $data);
	}


	function imagen_procesar()
	{
		$this->load->model('multimedia/multimedia_model');
		$imagenes = $this->input->post('valores');
		
		foreach($imagenes as $imagen)
		{
			$data_img = array(
								'fichero' 		=> $imagen['fichero'],
								'destacado' 	=> $imagen['destacado'],
								'id_tipo' 		=> 1,
								'id_estado' 	=> 1,
								'id_usuario' 	=> $this->session->userdata('id_usuario')
						 );
						 
			$id_imagen 	= $this->multimedia_model->guardar_imagen($data_img, 800, 600, 400, 300, 130, 115);
			$data_rel 	= array('id_restaurante' => $imagen['id'], 'id_multimedia' => $id_imagen );
			
			$this->multimedia_model->crear_rel_multimedia($data_rel, 'restaurante');
		}
	}

	function imagen_eliminar()
	{
		$this->load->model('multimedia/multimedia_model');
		$this->multimedia_model->delete_image($this->input->post('id_multimedia'), 'restaurante', $this->input->post('fichero'));
	}

    function eliminar_idioma($id_restaurante, $id_detalle_restaurante = '', $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        modules::run('services/monitor/add', 'detalle_restaurante', $id_detalle_restaurante, $this->session->userdata('id_usuario'), 'eliminar_idioma');
    	//$detalle = $this->detalle($id);
		//echo '<pre>'.print_r($detalle, true).'</pre>'; die();
		
        $ret = $this->restaurante_model->eliminar_idioma($id_detalle_restaurante);
        $str = ($ret == true) ? 'true' : 'false';
		
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            redirect('backend/restaurantes/ficha_restaurante/' . $id_restaurante);
    }

    function delete($id, $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $ret = $this->restaurante_model->delete($id);
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
        $ret = $this->restaurante_model->read($id, $detalle_id);
        if ($ajax)
            echo json_encode($ret);
        else
            return $ret;
    }

    function get_restaurante($output = 'json', $id = '')
    {
        $restaurante = $this->restaurante_model->read($id);
        if ($output == 'xml')
        {
            $domDoc = new DOMDocument;
            $rootElt = $domDoc->createElement('restaurante');
            $rootNode = $domDoc->appendChild($rootElt);
            foreach ($restaurante as $field => $value)
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
            echo json_encode($restaurante);
        }
    }

    function get_restaurante_list($output = 'json', $f = 'restaurante.id_restaurante', $v = 1, $group = false)
    {
        $restaurantes = $this->restaurante_model->get_list($f, $v, $group);
        if ($output == 'xml') {
            $domDoc = new DOMDocument;
            foreach ($restaurantes as $restaurante)
            {
                $rootElt = $domDoc->createElement('restaurante');
                $rootNode = $domDoc->appendChild($rootElt);
                foreach ($restaurante as $field => $value)
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
            echo json_encode($restaurantes);
        }
    }

    function detalle($id, $ajax = false)
    {
        //$ret = $this->restaurante_model->get('detalle_restaurante', $id);
        $ret = $this->restaurante_model->get($id);
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

    function restaurantes_categoria($id_categoria, $ajax = 1)
    {
        if ($ajax == 1)
		{
			echo modules::run('services/relations/get_from_categoria', $id_categoria, 'restaurante', $ajax);
		}
        else
		{
			return modules::run('services/relations/get_from_categoria', $id_categoria, 'restaurante', $ajax);
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
	
	function _validar_url($url)
	{
		$this->form_validation->set_message('_validar_url', 'La url indicada ya existe.');
		$datos = modules::run('services/relations/tabla_url', 'restaurante', $url);
		$id_detalle_restaurante = ($this->input->post('id_detalle_restaurante')) ? $this->input->post('id_detalle_restaurante') : '';
		
		if(!empty($datos))
		{
			if(!empty($id_detalle_restaurante) && $id_detalle_restaurante == $datos[0]->id_detalle_restaurante && $datos[0]->id_idioma == $this->input->post('id_idioma'))
			{
				return TRUE;
			}
			else return FALSE;
		}
		else return TRUE;
		
		return $return;
	}

    /*
     * Fin funciones callback
     *
     * */


}

/* End of file restaurante.php */
