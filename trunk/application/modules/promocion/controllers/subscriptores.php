<?php

class Subscriptores extends MX_Controller
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
	
	function listado($order_field = 'subscriptor.id_subscriptor', $order_dir = 'desc', $start = 0, $ajax = false)
	{
		//die_pre($order_field);
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		
		if($start == 0 && empty($_POST) && $order_field == 'subscriptor.id_subscriptor')
			$this->session->unset_userdata('terminos_busqueda');
		
		$terminos_busqueda = array();
		$terminos_busqueda = $this->session->userdata('terminos_busqueda');
		
		if (isset($_POST['texto']))
			$terminos_busqueda['texto'] = $_POST['texto'];

		if (isset($_POST) && !empty($_POST))
		{
			$terminos_busqueda = array_filter($terminos_busqueda);
			$this->session->set_userdata('terminos_busqueda',$terminos_busqueda);
		}

		$limit=5;
		$order_string = '';
		$order_string.= ($order_field == "") ? '' : $order_field;
		$order_string.= ($order_dir == "") ? '' : ' '.$order_dir;

        $od = ($order_dir == 'asc') ? 'desc' : 'asc';
        $data['order_field'] 		= $order_field;
        $data['order_dir'] 			= $order_dir;
        $data['order_by_new'] 		= ( ($order_field == '') ? 'id_subscriptor' : $order_field) . "/" . $od;
        $data['url'] 				= '/'.lang('backend_url').'/'.lang('promociones_url').'/'.lang('subscriptores_url');
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
		
		//die_pre($order_field);
		//die_pre($this->db->last_query());
		
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
			
			$data['menu_principal'] 		= $this->menus->create_mainmenu(lang('promociones_url'), 'subscriptores');
			$data['usuario'] 				= array('nombre' => $this->session->userdata('nombre'), 'apellidos' => $this->session->userdata('apellidos'));
			$data['contenido_principal'] 	= $this->load->view('back/subscriptores/listado_subscriptor', $data, true);
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

		/*--- Cargas de vistas ---*/
		$data['subscriptor_info'] 		= $this->load->view('back/subscriptores/subscriptor_info', $data, true); //Información básica de la promocion
        $data['contenido_principal'] 	= $this->load->view('back/subscriptores/ficha_subscriptor', $data, true); //Carga de contenido principal
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
		
        $data['contenido_principal'] = $this->load->view('back/subscriptores/editar_subscriptor', $data, true);
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
}
?>