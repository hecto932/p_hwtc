<?php

class Promocion extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$this->load->model('promocion_model');
		$this->lang->load('back');
		$this->load->helper('multimedia');
	}
	
	/* 
	 * Funcciones del admin, con control de aceso */
	function index()
	{
		$this->listado();
	}
	
	/*------------------------------------------ INICIO SUBSCRIPTORES-----------------------------------------------*/
	/*
	function subscriptores($order_field = 'subscriptor.id_subscriptor', $order_dir = 'desc', $start = 0, $ajax = false)
	{
		
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		
		if($start == 0 && empty($_POST) && $order_field == 'subscriptor.id_subscriptor') $this->session->unset_userdata('terminos_busqueda');
		$terminos_busqueda=array();
		$terminos_busqueda=$this->session->userdata('terminos_busqueda');
		
		if (isset($_POST['texto']))
			$terminos_busqueda['texto'] = $_POST['texto'];

		if (isset($_POST) && !empty($_POST))
		{
			$terminos_busqueda=array_filter($terminos_busqueda);
			$this->session->set_userdata('terminos_busqueda',$terminos_busqueda);
		}

		$limit=5;
		$order_string = '';
		$order_string.= ($order_field == "") ? '' : $order_field;
		$order_string.= ($order_dir == "") ? '' : ' '.$order_dir;	

        $od = ($order_dir == 'asc') ? 'desc' : 'asc';
        $data['order_field'] 		= $order_field;
        $data['order_dir'] 			= $order_dir;
        $data['order_by_new'] 		= (($order_field == '') ? 'id_subscriptor' : $order_field) . "/" . $od;
        $data['url'] 				= lang('backend_url').'/'.lang('promociones_url').'/'.lang('subscriptores_url');
        $config['base_url'] 		= '/'.lang('backend_url').'/'.lang('promociones_url').'/'.lang('subscriptores_url').'/'.$order_field.'/'.$order_dir;
        $config['per_page'] 		= $limit;
        $config['uri_segment'] 		= 6;
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['full_tag_open'] 	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';
		$config['next_link'] 		= "&rsaquo;";
		$config['next_tag_open'] 	= '<li class="arrow">';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_link'] 		= "&lsaquo;";
		$config['prev_tag_open'] 	= '<li class="arrow">';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="current"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['last_link'] 		= "&raquo;";
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close']	= '</li>';
		$config['first_link'] 		= "&laquo;";
		$config['fist_tag_open'] 	= '<li>';
		$config['fist_tag_close']	= '</li>';
		$data['num_subscriptores'] 	= $this->promocion_model->count_all_subscriptores($terminos_busqueda);
		
        $config['total_rows'] 		= $data['num_subscriptores'];
		
        $data['subscriptores'] 		= $this->promocion_model->get_page_subscriptores($start, $limit, $order_field, $order_dir, $terminos_busqueda);
		
        if ($ajax) echo json_encode($data['subscriptores']);
        else
        {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
			
            $data['pagination'] 		= $this->pagination->create_links();
            $data['offset'] 			= $start;
            $data['order_field'] 		= $order_field;
            $data['order_direction'] 	= $order_dir;
            $data['active'] 			= 'subscriptores';
			
			$data['sub'] 				= 'subscriptores';
            $data['title'] 				= lang('meta.titulo').' - '.lang('subscriptores').' - '.lang('listado');
			
            $data['breadcrumbs'] = $this->menus->create_breadcrumb(
            															array(
            																	lang('backend_url') => lang('backend'),
            																	lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
            							 										lang('backend_url').'/'.lang('promociones_url').'/'.lang('subscriptores_url') => lang('subscriptores')
																			 )
										 						  );
			
			$data['menu_principal'] 		= $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
			$data['usuario'] 				= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos'));
			$data['contenido_principal'] 	= $this->load->view('back/listado_subscriptor', $data, true);
            $this->load->view('back/template_new', $data);
        }
	}
	
	function ficha_subscriptor($id = '')
	{
		$this->load->model('multimedia/multimedia_model');
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        if ($id == '') redirect('backend/promociones/subscriptores');
			
        $data['active'] 		= 'subcriptores';
        $data['sub'] 			= 'editar';
		
        $data['subscriptor'] 	= $this->promocion_model->get_subscriptor($id);
		
        $data['breadcrumbs'] 	= $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('subscriptores_url') => lang('subscriptores'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('subscriptor_url').'/'.$id => 
        																	(isset($data['subscriptor']->nombre) ? lang('listado_registro').' '.$data['subscriptor']->nombre : lang('subscriptor').' '.lang('sin_titulo'))
																	 )
															  );

        $data['title'] 			= lang('meta.titulo').' - '.lang('subscriptores').' - '.(isset($data['subscriptor']->nombre) ? lang('listado_registro').' '.$data['subscriptor']->nombre : lang('subscriptor').' '.lang('sin_titulo'));
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('subscriptores_url'), 'subscriptores');
		$data['usuario'] 		= array('nombre' => $this->session->userdata('nombre'),'apellidos' => $this->session->userdata('apellidos'));
		$data['accion'] 		= 'normal';
		$data['sub_activo'] 	= 'Ficha';

		$data['promocion_info'] 		= $this->load->view('back/ficha/subscriptor_info', $data, true); //Información básica de la promocion
        $data['contenido_principal'] 	= $this->load->view('back/ficha/ficha_subscriptor', $data, true); //Carga de contenido principal
        $this->load->view('back/template_new', $data);
	}
	
	function _email_unico($email)
	{
		$this->form_validation->set_message('_email_unico', 'El email indicado ya está registrado.');
		$datos = $this->promocion_model->get_subscriptor_email($email);
		
		if(!empty($datos))
		{
				if($datos->id_subscriptor == $this->input->post('id_subscriptor'))
					return TRUE;
				else return FALSE;
		}
		else return TRUE;
	}
	
	function editar_subscriptor($id = '')
    {
    	$id = ($this->input->post('id_subscriptor')) ? $this->input->post('id_subscriptor') : $id;
		
        if ($id == '') redirect('backend/promociones/subscriptores');
		
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $data['active'] = 'subcriptores';
        $data['sub'] 	= 'editar';

        $data['subscriptor'] = $this->promocion_model->get_subscriptor($id);
		$estados = modules::run('services/relations/get_all', 'estado');
		foreach($estados as $estado)
		{
			$opciones_estados[$estado->id_estado] = $estado->estado;
		}
		$data['opt_estados'] =  $opciones_estados;
		
		//POST
		if($_POST)
		{
			$this->load->library('form_validation');
	        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	        $this->load->helper(array('form', 'url'));
			
	        $this->form_validation->set_rules('nombre', 	lang('subscriptores.nombre'), 'required');
			$this->form_validation->set_rules('apellido', 	lang('subscriptores.apellido'), 'required');
			$this->form_validation->set_rules('email', 		lang('subscriptores.email'), 'required|valid_email|callback__email_unico');
	
	        if ($this->form_validation->run($this) == TRUE)
			{
				$data_update = array(	'nombre' 	=> $this->input->post('nombre'),
										'apellido' 	=> $this->input->post('apellido'),
										'email' 	=> $this->input->post('email'),
										'id_estado'	=> $this->input->post('id_estado'));
				
				$this->promocion_model->update_subscriptor($this->input->post('id_subscriptor'), $data_update);
				
				redirect('backend/promociones/ficha_subscriptor/'.$this->input->post('id_subscriptor'));
			}
		}

		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
						        					   array(
						        					   			lang('backend_url') => lang('backend'),
						        								lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
						        								lang('backend_url').'/'.lang('subscriptores_url').'/'.lang('ficha_url').'_'.lang('subscriptor_url').'/'.$id => lang('listado_editar').' '.lang('subscriptor_url'),
						        								'#' => (isset($data['subscriptor']->nombre) && !empty($data['subscriptor']->nombre))
							    							 			? $data['subscriptor']->nombre : lang('subscriptor').' '.lang('sin_titulo')
															)
												  );
														  
		$data['title'] 				= lang('meta.titulo').' - '.lang('subscriptores').' - '.lang('editar').' '.$data['subscriptor']->nombre;
		$data['menu_principal'] 	= $this->menus->create_mainmenu(lang('subscriptores_url'), 'subscriptores');
		$data['usuario'] 			= array('nombre' => $this->session->userdata('nombre'),'apellidos' => $this->session->userdata('apellidos'));
		
        $data['contenido_principal'] = $this->load->view('back/editar_subscriptor', $data, true);
        $this->load->view('back/template_new', $data);

    }
	
	function delete_subscriptor($id, $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $ret = $this->promocion_model->delete_subscriptor($id);
        $str = ($ret == true) ? 'true' : 'false';
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            return $ret;
    }
	
	function generar_listado_subscriptores()
	{
		$this->load->library("pxl");
		
		//Arrays de Estilos
		$styleArray 	= array('font' => array('bold' => true,'size' => 14,));
		$styleArrayfill = array('fill' => array('type'  => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'F0F0F0'),),);

		//Crear variable de excel, titulo y descricion del documento.
		$objPHPExcel = new PHPExcel();
		
		//Activar la hoja de excel 0
		$objPHPExcel->setActiveSheetIndex(0);
		$sheet = $objPHPExcel->setActiveSheetIndex(0);
		
		//Consulta de datos
		$consulta = $this->promocion_model->get_listado_subscriptores();
		
		//Si hay datos
		if(count($consulta) > 0)
		{
			//Valores iniciales.
			$cell 	= 'A';
			$row 	= '1';

			//Establecer columnas.
			$sheet->setCellValue(('A') . ($row), 'EMAIL');
		  	$sheet->setCellValue(('B') . ($row), 'FIRST NAME');
		  	$sheet->setCellValue(('C') . ($row), 'LAST NAME');
			$sheet->getStyle(('A') . ($row).":".('C') . ($row))->applyFromArray($styleArray);
			
			//Llenar celdas con datos.
			foreach($consulta as $fila)
			{
				$sheet->setCellValue(('A') . (++$row), $fila->email);
				$sheet->setCellValue(('B') . ($row), $fila->nombre);
				$sheet->setCellValue(('C') . ($row), $fila->apellido);
	
				//Si la fila es impar, pintar en fondo de color.
				if($row%2==0) $sheet->getStyle(('A') . ($row).":".('C') . ($row))->applyFromArray($styleArrayfill);
			}
			
			//Establcer tamano fijo de columna.
			$sheet->getColumnDimension("A")->setAutoSize(true);
			$sheet->getColumnDimension("B")->setAutoSize(true);
			$sheet->getColumnDimension("C")->setAutoSize(true);
			
			//Establecer nombre de archivo
			$nombre_archivo = "listado_de_subscriptores";
		}
		else
		{
			//Establecer Mensaje
			$sheet->setCellValue(('A3'), 'NO HAY SUBSCRIPTORES');
			$sheet->getStyle('A3:C3')->applyFromArray($styleArray);
			$sheet->mergeCells('A3:J3');
			
			//Establecer nombre de archivo
			$nombre_archivo = "listado_de_subscriptores";
		}

	    header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"{$nombre_archivo}.csv\"");
		header("Cache-Control: max-age=0");
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "CSV");
		$objWriter->save("php://output");
		exit;
	}
	*/
	
	/*------------------------------------------ INICIO PROMOCIONES-----------------------------------------------*/
	
	function listado($order_field='promocion.id_promocion',$order_dir='desc',$start=0,$ajax=false)
	{
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		if ($start==0 && empty($_POST) && $order_field=='promocion.id_promocion') $this->session->unset_userdata('terminos_busqueda');
		$terminos_busqueda=array();
		$terminos_busqueda=$this->session->userdata('terminos_busqueda');
		
		if (isset($_POST['texto']))
			$terminos_busqueda['texto']=$_POST['texto'];

		if (isset($_POST['id_estado']))
			$terminos_busqueda['promocion.id_estado']=$_POST['id_estado'];

		if (isset($_POST['destacado']))
			$terminos_busqueda['promocion.destacado']=$this->input->post('destacado');

		

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
        $data['order_by_new'] = (($order_field == '') ? 'id_promocion' : $order_field) . "/" . $od;
        $data['url'] = lang('backend_url').'/'.lang('promociones_url').'/'.lang('listado_url');
        $config['base_url'] = '/'.lang('backend_url').'/'.lang('promociones_url').'/'.lang('listado_url').'/'.$order_field.'/'.$order_dir;
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
		$data['num_promociones'] = $this->promocion_model->count_all($terminos_busqueda);
        $config['total_rows'] = $data['num_promociones'];
		
        if ($config['total_rows'] == 0)
            redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('buscar_url').'/'.lang('ningun_resultado'));
			
        $data['promociones'] = $this->promocion_model->get_page($start, $limit, $order_field, $order_dir, 'back', $terminos_busqueda);
		
        if ($ajax)
            echo json_encode($data['promociones']);
        else
        {
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['offset'] = $start;
            $data['order_field'] = $order_field;
            $data['order_direction'] = $order_dir;
            $data['active'] = 'promociones';
			
            if (!empty($terminos_busqueda))
            	$data['sub'] = 'buscar';
            else
				$data['sub'] = 'listado';
				
            $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('listado');
            if (!empty($terminos_busqueda))
            {
                $lbc = reset($terminos_busqueda);
                $lbt = key($terminos_busqueda);
                if ($lbt == 'promocion.id_estado')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'estado', $lbc);
                    $lbc = ucwords($bcc->estado);
                }
                if ($lbt == 'promocion.id_promocion')
                {
                    $bcc = modules::run('services/relations/get_from_id', 'promocion', $lbc);
                    $lbc = ucwords($bcc->nombre);
                }
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
                							 										lang('backend_url').'/'.lang('promociones_url').'/'.lang('buscar_url') => lang('listado_busqueda'),
                							 										lang('titulo') => $lbc
																				 )
											 						  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                															array(
                																	lang('backend_url') => lang('backend'),
                																	lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
                							 										lang('backend_url').'/'.lang('promociones_url').'/'.lang('listado_url') => lang('listado')
																				 )
											 						  );
            }
			$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
			$data['usuario'] = array(
										'nombre' => $this->session->userdata('nombre'),
										'apellidos' => $this->session->userdata('apellidos')
									);
			$data['contenido_principal'] = $this->load->view('back/listado_promocion', $data, true);
            $this->load->view('back/template_new', $data);
        }
	}

	function buscar($mensaje = '')
	{
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $data['active'] = 'promociones';
        $data['sub'] = 'buscar';
        $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('buscar_tit_not');
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('buscar_url') => lang('listado_buscar').' '.lang('promocion')));
		
		$data['array_destacado'] = destacado_dropdown();
		array_unshift($data['array_destacado'], '');
		$data['mensaje'] = $mensaje;
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
        $data['contenido_principal'] = $this->load->view('back/buscar_promocion', $data, true);
        $this->load->view('back/template_new', $data);
    }

    function crear()
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		$this->load->helper('misc');
        $data['active'] = 'promociones';
        $data['sub'] = 'crear';
		$data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('listado_crear');
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
										    							 	lang('backend_url').'/'.lang('promociones_url').'/'.lang('crear_url') => lang('listado_crear')
																		 )
															  );
        $data['array_destacado'] = destacado_dropdown();
        $data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
        $data['categorias'] = modules::run('services/relations/get_all', 'detalle_categoria');
		$data['promociones_js'] = $this->load->view('back/js/promocion_js', $data, true);
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['crear'] = TRUE;
        $data['contenido_principal'] = $this->load->view('back/crear_promocion', $data, true);
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
        	modules::run('services/monitor/add', 'promocion', $id, $this->session->userdata('id_usuario'), 'editar');
        else
        	modules::run('services/monitor/add', 'promocion', '', $this->session->userdata('id_usuario'), 'crear');
        
		
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->form_validation->set_rules('id_estado', lang('listado_estado'), 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('listado_crear');
            if ($id != '')
            {
                $data['promocion'] = $this->promocion_model->read($id);
                $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('listado_editar');
            }
            $data['active'] = 'promocion';

            if ($id != '')
            {
            	$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        															array(
        																	lang('backend_url') => lang('backend'),
										    								lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
										    							 	lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('promocion') => lang('listado_editar').' '.lang('promocion_url'),
										    							 	lang('backend_url').'/'.lang('promociones_url').'/'.lang('editar_url').'_'.lang('promocion').'/'.$id =>
										    							 		(isset($data['promocion']->nombre) && !empty($data['promocion']->nombre))
										    							 			? $data['promocion']->nombre : lang('promocion').' '.lang('sin_titulo') 
																		 )
															  );
            }
            else
            {
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                														array(
                																lang('backend_url') => lang('backend'),
											    								lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
											    							 	lang('backend_url').'/'.lang('promociones_url').'/'.lang('crear_url').'_'.lang('promocion') => lang('listado_crear').' '.lang('promocion_url')
																			 )
																	  );
            }
			$data['array_destacado'] = destacado_dropdown();
            $data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
            $data['contenido_principal'] = $this->load->view('back/crear_promocion', $data, true);
            $this->load->view('back/template_new', $data);
        }
		else
		{
			$form_data = $_POST;
			$id = $this->promocion_model->update($form_data);
			
			if($this->session->userdata('idioma') == 'es')
				redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/' . $id, 'location');
			else
				redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('articulo_url').'_'.lang('ficha_url').'/' . $id, 'location');
        }
    }

    function edit($id = '', $ajax = false)
    {
        if ($id == '')
            redirect('backend');
		
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
		
        $data['active'] = 'promocion';
        $data['sub'] = 'editar';

        $data['promocion'] = $this->promocion_model->read($id);

		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
									        					   array(
									        					   			lang('backend_url') => lang('backend'),
									        								lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
									        								lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$id => lang('listado_editar').' '.lang('promocion_url'),
									        								'#' => (isset($data['promocion']->nombre) && !empty($data['promocion']->nombre))
										    							 			? $data['promocion']->nombre : lang('promocion').' '.lang('sin_titulo')
																		)
															  );
		$data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('editar').' '.$data['promocion']->nombre;
		$data['estados'] = modules::run('services/relations/get_all', 'estado', 'true');
		$data['array_destacado'] = destacado_dropdown();
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['categorias'] = modules::run('services/relations/get_all', 'detalle_categoria');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		$data['promociones_js'] = $this->load->view('back/js/promocion_js', $data, true);
        $data['contenido_principal'] = $this->load->view('back/crear_promocion', $data, true);
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
			redirect('backend/promociones');
			
        $data['active'] = 'promocion';
        $data['sub'] = 'editar';
        $data['promocion'] = $this->promocion_model->read($id);
        $data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => lang('backend'),
        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$id => 
        																	(isset($data['promocion']->nombre) ? lang('listado_registro').' '.$data['promocion']->nombre : lang('promocion').' '.lang('sin_titulo'))
																	 )
															  );
		/*--- Zona de url ----*/

		//Imagen Principal
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');


        $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.(isset($data['promocion']->nombre) ? lang('listado_registro').' '.$data['promocion']->nombre : lang('promocion').' '.lang('sin_titulo'));
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
		
		$data['permite_secundarias'] = ($data['promocion']->id_tipo_promocion == 2 ) ? TRUE : FALSE;
		$data['accion'] = 'normal';
		$data['sub_activo'] = 'Ficha';
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id, 'promocion', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id, 'promocion', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id, 'promocion', 3);
        $data['promocion_idiomas'] = $this->promocion_model->detalles($id);

		/*--- Cargas de vistas ---*/
		$data['promocion_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		$data['promocion_info'] = $this->load->view('back/ficha/promocion_info', $data, true); //Información básica de la promocion
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true); //Información de los idiomas
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_promocion', $data, true); //Vista para la creación de nuevos idiomas
		$data['idioma_nuevo'] = $this->load->view('back/ficha/idioma_promocion', $data, true); //Vista para la creación de nuevos idiomas
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_promocion', $data, true); //Carga de contenido principal
        $this->load->view('back/template_new', $data);
    }

    function editar_idioma($id_promocion, $id_detalle_promocion = '')
    {
    	$this->load->model('multimedia/multimedia_model');
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        if ($id_detalle_promocion == '')
		{
			redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$id_promocion);
		}
		//$data['promocion'] = $this->promocion_model->read($id_promocion);
		$data['promocion'] = $this->promocion_model->read($id_promocion,$id_detalle_promocion);
		
		$data['permite_secundarias'] = ($data['promocion']->id_tipo_promocion == 2 ) ? TRUE : FALSE;
		$data['active'] = 'promociones';
		$data['sub'] = 'ficha';
		$data['accion'] = 'editar';
		$data['sub_activo'] = 'EditLangTab';
		$data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('listado_editar').' '.lang('listado_idioma');
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																		array(
																			base_url().lang('backend_url') => lang('backend'),
																			'promocion' => lang('promociones'),
																			lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'/'.$id_promocion => lang('idioma_edt_not'),
																			$id_promocion => (isset($data['promocion']->nombre) && $data['promocion']->nombre != '') ? $data['promocion']->nombre : lang('promociones_sinnombre')
																		)
																	  );
		/*
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('secundarias');	//Imagenes secundarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('terciarias');	//Imagenes terciarias
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
		$data['promocion_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		*/
		
		//AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('principal');
		//Imagenes secundarias
		$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('secundarias');
		//Imagenes terciarias
		$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$id_promocion.'/'.lang('adicionar_url').'/'.lang('terciarias');
		//Eliminar Imagen
		$data['url_delete'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url');
		$data['imagen_principal'] = $this->multimedia_model->get_relation($id_promocion, 'promocion', 1);
		$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($id_promocion, 'promocion', 2);
		$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($id_promocion, 'promocion', 3);
		$data['promocion_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
		$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
		//FIN - AGREGE DE ESTO PARA SOLUCIONAR QUE CUANDO SE EDITABA UN IDIOMA EN SERVICIO, DABA ERROR PHP EN LA FICHA DE IMAGENES
		
		
		$data['promocion_idiomas'] = $this->promocion_model->detalles($id_promocion, $id_detalle_promocion);
		$data['promocion_info'] = $this->load->view('back/ficha/promocion_info', $data, true);
		$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true);
		$data['idioma_form'] = $this->load->view('back/ficha/idioma_promocion', $data, true);
        $data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['usuario'] = array(
								'nombre' => $this->session->userdata('nombre'),
								'apellidos' => $this->session->userdata('apellidos')
							);
        $data['contenido_principal'] = $this->load->view('back/ficha/ficha_promocion', $data, true);
        $this->load->view('back/template_new', $data);

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
        $this->form_validation->set_rules('subtitulo', 'Subtitulo', 'min_length[5]');
        $this->form_validation->set_rules('descripcion_breve', 'Descripcion Breve', 'min_length[10]|required');
        $this->form_validation->set_rules('descripcion_ampliada', 'Descripcion Ampliada', 'min_length[50]|required');
        $this->form_validation->set_rules('url', 'URL', 'required|callback__validar_url');
        $this->form_validation->set_rules('titulo_pagina', 'Titulo pagina', 'required|min_length[5]');
        $this->form_validation->set_rules('descripcion_pagina', 'Descripcion pagina', 'required|min_length[10]');
        $this->form_validation->set_rules('keywords', 'Palabras clave', 'required');

        if ($this->form_validation->run($this) == FALSE)
        {
            $data['active'] = 'promocion';
            $data['sub'] = 'crear';
            $data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('idioma_edt_not');
            if ($data['id_promocion'] != '')
			{
                $data['promocion'] = modules::run('promocion/read', $data['id_promocion']);
				$temp_bread = ($this->session->userdata('idioma') == 'es') ? lang('ficha_url').'_'.lang('promocion_url').'/'.$data['id_promocion']: lang('promocion_url').'_'.lang('ficha_url').'/'.$data['id_promocion'];
				$data['breadcrumbs'] = $this->menus->create_breadcrumb(
																		array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
	        																lang('backend_url').'/'.lang('promociones_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
																			$data['id_promocion'] => (isset($data['nombre']) && $data['nombre'] != '') ? $data['nombre'] : lang('promocion').' - '.lang('sin_nombre')
																		 )
																	  );
            }
			else
			{
                $data['breadcrumbs'] = $this->menus->create_breadcrumb(
                														array(
	        																lang('backend_url') => lang('backend'),
	        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
	        																lang('backend_url').'/'.lang('promociones_url').'/'.$temp_bread => lang('listado_editar').' '.lang('idioma_url'),
	        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('crear_url') => lang('listado_crear')
																		 )
																	  );
            }


			/*	En esta zona se vuelve a construir la vista de la ficha,
			 * 	es importante cargar todas las vistas necesarias y variables.
			 * 	Para que las imagenes cargen es necesario cargar las vistas y las
			 *  urls de imagen_principal, imagenes_secundarias e inclusive imagenes_terciarias.
			 *
			 * */


			$data['url_add_p'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$data['id_promocion'].'/'.lang('adicionar_url').'/'.lang('principal'); //Imagen Principal
			$data['url_add_s'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$data['id_promocion'].'/'.lang('adicionar_url').'/'.lang('secundarias'); //Imagenes secundarias
			$data['url_add_t'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.$data['id_promocion'].'/'.lang('adicionar_url').'/'.lang('terciarias'); //Imagenes terciarias
			$data['url_delete'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.lang('eliminar_url'); //Eliminar Imagen
			$data['imagen_principal'] = $this->multimedia_model->get_relation($data['id_promocion'], 'promocion', 1);
			$data['imagenes_secundarias'] = $this->multimedia_model->get_relation($data['id_promocion'], 'promocion', 2);
			$data['imagenes_terciarias'] = $this->multimedia_model->get_relation($data['id_promocion'], 'promocion', 3);
			$data['accion'] = ($this->input->post('accion') == 'normal') ? 'normal' : 'editar' ;
			$data['sub_activo'] = ($this->input->post('accion') == 'normal') ? 'NewLangTab' : 'EditLangTab' ;
			$data['promocion_idiomas'] = $this->promocion_model->detalles($data['id_promocion']);
			$data['promocion_info'] = $this->load->view('back/ficha/promocion_info', $data, true);
			$data['idioma_info'] = $this->load->view('back/ficha/idioma_info', $data, true);
			$data['idioma_form'] = $this->load->view('back/ficha/idioma_promocion', $data, true);
			$data['idioma_nuevo'] = $this->load->view('back/ficha/idioma_promocion', $data, true);
			$data['promocion_imagenes'] = $this->load->view('template/ficha_imagen', $data, true); //Ficha de la sección de imagenes
			$data['ficha_js'] = $this->load->view('template/ficha_imagen_js', $data, true); //Contenido js de la seccion ficha imagenes
            $data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
			$data['usuario'] = array(
									'nombre' => $this->session->userdata('nombre'),
									'apellidos' => $this->session->userdata('apellidos')
								);
			
			$data['permite_secundarias'] = ($data['promocion']->id_tipo_promocion == 2 ) ? TRUE : FALSE;
            $data['contenido_principal'] = $this->load->view('back/ficha/ficha_promocion', $data, true);
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

            $id = $this->promocion_model->update_idioma($data);

            modules::run('services/monitor/add', 'detalle_promocion', $id, $this->session->userdata('id_usuario'), 'editar_idioma');
			if($this->session->userdata('idioma') == 'es')
			{
				redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$data['id_promocion']);
			}
			else
			{
				redirect(lang('backend_url').'/'.lang('promociones_url').'/'.lang('promocion_url').'_'.lang('ficha_url').'/'.$data['id_promocion']);
			}
        }
    }

	function imagen($id, $destacado = 1)
	{
		$this->lang->load('back', 'es');
        if ($id == '')
		{
			redirect(lang('backend_url').'/'.lang('promociones_url'));
		}
		if ($_FILES)
		{
			require FCPATH.'server/index.php';
			return;
		}

		$data['promocion'] = $this->promocion_model->read($id);
		$data['tipo'] = "promocion";
		$data['id'] = $id;
		$data['destacado'] = $destacado;
		$data['url'] = base_url().lang('backend_url').'/'.lang('promociones_url').'/'.lang('imagenes_url').'/'.lang('procesar_url').'_'.lang('imagenes_url');
		$data['imagen'] = TRUE;
		$data['breadcrumbs'] = $this->menus->create_breadcrumb(
        														array(
        																lang('backend_url') => 	lang('backend'),
        																lang('backend_url').'/'.lang('promociones_url') => lang('promociones'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('listado_url') => lang('listado'),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$id => (isset($data['promocion']->nombre) ? lang('listado_registro').' ' . $data['promocion']->nombre : lang('sin_titulo')),
        																lang('backend_url').'/'.lang('promociones_url').'/'.lang('ficha_url').'_'.lang('promocion_url').'/'.$id.'/'.lang('adicionar_url') => lang('subir_imagen')
																	 )
															  );
		$data['menu_principal'] = $this->menus->create_mainmenu(lang('promociones_url'), 'listado');
		$data['active'] = 'promociones';
		$data['sub'] = 'ficha';
		$data['title'] = lang('meta.titulo').' - '.lang('promociones').' - '.lang('subir_imagen');
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
			$id_imagen = $this->multimedia_model->guardar_imagen($data_img, 800, 452, 600, 339, 130, 115);
			$data_rel = array(
								'id_promocion' => $imagen['id'],
								'id_multimedia' => $id_imagen
						   );
			$this->multimedia_model->crear_rel_multimedia($data_rel, 'promocion');
		}
	}

	function imagen_eliminar(){
		$this->load->model('multimedia/multimedia_model');
		$this->multimedia_model->delete_image($this->input->post('id_multimedia'), 'promocion', $this->input->post('fichero'));
	}

    function eliminar_idioma($id_promocion, $id_detalle_promocion = '', $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        modules::run('services/monitor/add', 'detalle_promocion', $id_detalle_promocion, $this->session->userdata('id_usuario'), 'eliminar_idioma');
       // $detalle = $this->detalle($id);
		//echo '<pre>'.print_r($detalle, true).'</pre>'; die();
        $ret = $this->promocion_model->eliminar_idioma($id_detalle_promocion);
        $str = ($ret == true) ? 'true' : 'false';
        if ($ajax)
            echo '[{result:' . $str . '}]';
        else
            redirect('backend/ficha_promocion/' . $id_promocion);
    }

    function delete($id, $ajax = false)
    {
        modules::run('usuarios/is_logged_in', 'editor', $this->uri->uri_string());
        modules::run('idioma/set_idioma', $this->session->userdata('idioma'));
        $ret = $this->promocion_model->delete($id);
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
        $ret = $this->promocion_model->read($id, $detalle_id);
        if ($ajax)
            echo json_encode($ret);
        else
            return $ret;
    }

    function get_promocion($output = 'json', $id = '')
    {
        $promocion = $this->promocion_model->read($id);
        if ($output == 'xml')
        {
            $domDoc = new DOMDocument;
            $rootElt = $domDoc->createElement('promocion');
            $rootNode = $domDoc->appendChild($rootElt);
            foreach ($promocion as $field => $value)
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
            echo json_encode($promocion);
        }
    }

    function get_promocion_list($output = 'json', $f = 'promocion.id_promocion', $v = 1, $group = false)
    {
        $Noticias = $this->promocion_model->get_list($f, $v, $group);
        if ($output == 'xml') {
            $domDoc = new DOMDocument;
            foreach ($Noticias as $promocion)
            {
                $rootElt = $domDoc->createElement('promocion');
                $rootNode = $domDoc->appendChild($rootElt);
                foreach ($promocion as $field => $value)
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
        //$ret = $this->promocion_model->get('detalle_promocion', $id);
        $ret = $this->promocion_model->get($id);
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
			echo modules::run('services/relations/get_from_categoria', $id_categoria, 'promocion', $ajax);
		}
        else
		{
			return modules::run('services/relations/get_from_categoria', $id_categoria, 'promocion', $ajax);
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
		$datos = modules::run('services/relations/tabla_url', 'promocion', $url);
		$id_detalle_promocion = ($this->input->post('id_detalle_promocion')) ? $this->input->post('id_detalle_promocion') : '';
		
		if(!empty($datos))
		{
			if(!empty($id_detalle_promocion) && $id_detalle_promocion == $datos[0]->id_detalle_promocion && $datos[0]->id_idioma == $this->input->post('id_idioma'))
			{
				return TRUE;
			}
			else return FALSE;
		}
		else return TRUE;
		
		return $return;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
