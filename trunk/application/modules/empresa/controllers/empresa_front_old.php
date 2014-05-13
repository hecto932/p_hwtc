<?php 

class Empresa_front extends MX_Controller {


	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('idioma')=='') $this->session->set_userdata('idioma','en');
		modules::run('idioma/set_idioma', 'es');
		//modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code', 'es');
		//$this->id_idioma=modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front', 'es');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		//echo $this->session->userdata('idioma');
		//echo $this->config->item('language');
		//echo $this->uri->uri_string();
	}
	
	function index()
	{
		$this->nosotros();
	}
	
	function carreras($ajax=false){
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		$data['title'] = lang('carreras.meta.title').' - '.$this->lang->line('inicio.meta.title');
		$data['meta_descripcion'] = lang('carreras.meta.description').' | '.$this->lang->line('inicio.meta.description');
		$data['meta_keywords'] = lang('carreras.meta.keywords').' | '.$this->lang->line('inicio.meta.keywords');
		$data['contenido_principal'] =$this->load->view('carreras_view', $data, true);
		$this->load->view('front/template',$data);
	}

	function resume(){
		$data['main'] = lang('carreras');
		$data['sub'] = lang('carreras_url');
		$data['title'] = lang('carreras');
		$data['meta_descripcion'] = lang('carreras.meta.description').' | '.$this->lang->line('inicio.meta.description');
		$data['meta_keywords'] = lang('carreras.meta.keywords').' | '.$this->lang->line('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('resume_view', $data, true);
		$this->load->view('front/template',$data);
	}

	
	function historia($id='',$ajax=false)
	{
		//echo 'el id'.$id;
		$data['main']=$this->lang->line('empresa');
		$data['sub']=$this->lang->line('empresa_url');
		$data['title']=$this->lang->line('empresa');
		$data_content['year'] = (isset($id) && $id !='' ? $id : '2011');
		$data_content['activa']=$this->lang->line('empresa.historia_url');
		//$data_content['breadcrumbs']=array('/'=>$this->lang->line('inicio'),$this->lang->line('empresa_url')=>$this->lang->line('empresa'),$this->lang->line('empresa.historia_url')=>$this->lang->line('empresa.historia') );
		
		//$data_content['historia_subheader'] = $this->load->view('front/historia_subheader',$data_content,true);
		//$data_content['menu_izquierda']=$this->load->view('front/menu_izquierda',$data_content,true);
		
		//$data_content['historia_links']=$this->load->view('front/historia_links',$data_content,true);
		
		if( $id!='2011'&& $id!='2007'&& $id!='2001'&& $id!='1999' && $id!='1992'&& $id!='1985' && $id!='') redirect('/');
		else
		{
			//if(!empty($id)) $data['main_content']=$this->load->view('front/historia_'.$id,$data_content,true);
			//else $data['main_content']=$this->load->view('front/historia_2010',$data_content,true);
			$data['contenido_principal']=$this->load->view('historia',$data_content,true);
			
			$data['title']=$this->lang->line('empresa.historia.'.$data_content['year'].'.meta.title').' - '.$this->lang->line('empresa.historia.meta.title');
			$data['meta_descripcion']=$this->lang->line('empresa.historia.'.$data_content['year'].'.meta.description');
			$data['meta_keywords']=$this->lang->line('empresa.historia.'.$data_content['year'].'.meta.keywords');
			
			$this->load->view('front/template',$data);
		}
	}

	
	function directorio($opcion = '')
	{
		$data['main'] = lang($opcion);
		$data['sub'] = lang($opcion.'_url');
		$data['title'] = lang($opcion.'.meta.title').' - '.lang('inicio.meta.title');
		$data['meta_descripcion'] = lang($opcion.'.meta.description').' | '.lang('inicio.meta.description');
		$data['meta_keywords'] = lang($opcion.'.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view(lang($opcion.'_vista'), $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	
	function nosotros($ajax=false)
	{
		

		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		$data['id_body'] = 'id = "bird"';
		$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('nosotros', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function about_wtc(){
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('about_wtc', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function asociacion_wtc(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('asociaciones_url') => lang('breadcrumb_asociaciones')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('footer_asociaciones.meta.title').' - '.lang('menu.wtc-valencia');
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		
		//nuevo meta-descripcion
		$data['meta_descripcion'] = lang('footer_asociaciones.meta.description');
		
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		$data['contenido_principal'] = $this->load->view('asociacion_wtc', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function wtc_valencia(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('wtc_val_url') => lang('breadcrumb_wtc_val')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('footer_wtc.meta.title').' - '.lang('menu.wtc-valencia');
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		//nuevo title
		$data['meta_descripcion'] = lang('footer_wtc.meta.description');
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		
		$data['contenido_principal'] = $this->load->view('wtc_valencia', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function hotel(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('hotel_url') => lang('breadcrumb_hotel')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('complejo-wtc.meta.title').' - '.lang('menu.wtc-valencia');
		
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		//nuevo meta-descripcion
		$data['meta_descripcion'] = lang('complejo-wtc.meta.description');
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		
		$data['contenido_principal'] = $this->load->view('hotel_hesperia_nh', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function centro_convencion(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('convenciones_url') => lang('breadcrumb_convenciones')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('footer_convenciones.meta.title').' - '.lang('menu.wtc-valencia');
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		//nuevo meta-descripcion
		$data['meta_descripcion'] = lang('footer_convenciones.meta.description');
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('convenciones', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function membresia(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('membresias_url') => lang('breadcrumb_membresias')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('membresia', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	function torre_empresarial(){
		$this->load->model('noticia/noticia_model');
		$this->load->model('evento/evento_model');
		$data['breadcrumbs'] = array(
										'' => lang('breadcrumb_inicio'),
										lang('torre_empresarial_url') => lang('breadcrumb_torre_emp')
									);
		$data['noticias_footer'] = $this->noticia_model->get_posts(4, 'desc', array('noticia.id_estado' => 1));
		$data['eventos_footer'] = $this->evento_model->get_page(0,4,'evento.id_evento','','front',array('evento.id_estado' => 1));
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		
		//anterior title
		//$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		
		//nuevo title
		$data['title'] = lang('footer_torre.meta.title').' - '.lang('menu.wtc-valencia');
		
		//anterior meta-descripcion
		//$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		
		
		//nuevo meta-descripcion
		$data['meta_descripcion'] = lang('footer_torre.meta.description');
		
		//Google ya no toma en cuenta meta-keywords
		//$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('torre_empresarial', $data, TRUE);
		$this->load->view('front/template', $data);
	}
	
	public function trabajos(){
		$data['main'] = lang('empresa');
		$data['sub'] = lang('empresa_url');
		$data['title'] = lang('nosotros.meta.title').' - '.lang('inicio.meta.title');
		$data['id_body'] = 'id = "pinguino"';
		$data['meta_descripcion'] = lang('nosotros.meta.description').' | '.lang('inicio.meta.description');
		$data['meta_keywords'] = lang('nosotros.meta.keywords').' | '.lang('inicio.meta.keywords');
		$data['contenido_principal'] = $this->load->view('trabajos', $data, TRUE);
		$this->load->view('front/template', $data);	
	}
	
	public function enviar_cv(){
		$data['main'] = lang('carreras');
		$data['sub'] = lang('carreras_url');
		$data['title'] = lang('carreras');
		
		$this->form_validation->set_rules('nombre', lang('carreras_field_nombre'), 'trim|required|min_length[2]');
		$this->form_validation->set_rules('apellido', lang('carreras_field_apellido'), 'trim|required|min_length[2]');
		$this->form_validation->set_rules('numero', lang('carreras_field_numero'), 'trim');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required|valid_email|min_length[5]');
		$this->form_validation->set_rules('tipo', lang('carreras_field_tipo'), 'trim|required');
		$this->form_validation->set_rules('calle', lang('carreras_field_calle'), 'trim|required|min_length[5]');
		$this->form_validation->set_rules('ciudad', lang('carreras_field_ciudad'), 'trim|required|min_length[5]');
		$this->form_validation->set_rules('zip', lang('carreras_field_zip'), 'trim|required|min_length[2]');
		$this->form_validation->set_rules('telf', 'Teléfono', 'required|trim|min_length[11]');
		if ($this->form_validation->run($this) == FALSE){
			$this->carreras();
		}
		else
		{
			foreach(array_keys($_POST) as $k){
                    $form_data2[$k] = $this->input->post($k);
            }
			
			$temp_resumen = pathinfo($_FILES['resumen']['name']);
			$config['file_name']		= str_replace(' ', '_', $form_data2['nombre']).'_'.date('Y_d_m');
			$config['upload_path']  	= './uploads/resume';
			$config['allowed_types'] 	= 'pdf|doc|docx|gif|jpg|png';
			$config['max_size']			= '1500';
		
			$direccion_archivo = base_url().str_replace('./', '', $config['upload_path']).'/'.$config['file_name'].'.'.$temp_resumen['extension'];
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('resumen')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('resume_view', $error);
			}
			else
			{	
				$form_data['id_idioma'] = $this->id_idioma;
				$form_data['id_estado'] = '1';
				$form_data['creacion']  = date('Y-m-d');;
				$form_data['nombre'] = $form_data2['nombre'];
				$form_data['telf'] = $form_data2['extension'].$form_data2['numero'];
				$form_data['correo'] = $form_data2['email'];	
	
				//Proceso de ENVIO DE CORREO ELECTRONICO
				$this->load->library('email');
				$this->email->from($form_data['correo'], $form_data2['nombre']);
				$this->email->to(lang('email_cp'));
				$this->email->cc(lang('email_cp2'));
				$this->email->subject(lang('email_subject_carreras').' '.$form_data2['nombre']);
				$data_usuario['url'] = lang('url_principal');			
				$data_usuario['nombre'] = $form_data2['nombre'];
				$data_usuario['correo'] = $form_data2['email'];
				$data_usuario['telf'] = $form_data2['extension'].$form_data2['numero'];;	
				
				$att_data = $this->upload->data();
				$this->email->attach($att_data['full_path']);	
				$this->email->message($this->load->view('email_cv', $data_usuario, TRUE));
				$temp_data = $this->upload->data();
				if(!$this->email->send()){
					$this->enviar_cv_KO();
				}
				else{
					$this->enviar_cv_OK();
				}
			}
		}
	}
	
	
	function enviar_cv_KO(){
			$data_content['no_enviado'] = TRUE;
			$data['main'] = lang('carreras');
			$data['title'] = lang('no_enviado.meta.title').' | '.$this->lang->line('inicio.meta.title');
			$data['meta_descripcion'] = lang('carreras.meta.description');
			$data['meta_keywords'] = lang('carreras.meta.keywords');
			$data_content['id_idioma'] = $this->id_idioma;
			$data_content['error_news'] = lang('carreras_error');
			$data['contenido_principal'] = $this->load->view('resume_view', $data_content, TRUE);
			$this->load->view('front/template',$data);	
	}
		
	function enviar_cv_OK(){
			$data_content['enviado'] = TRUE;
			$data['main'] = lang('carreras');
			$data_content['id_idioma'] = $this->id_idioma;
			$data['title'] = lang('carreras.meta.title').' | '.lang('inicio.meta.title');
			$data['meta_descripcion'] = lang('carreras.meta.description');
			$data['meta_keywords'] = lang('carreras.meta.keywords');
			$data_content['success_envio'] = lang('carreras_ya_envio');
			$data['contenido_principal'] = $this->load->view('resume_view', $data_content, TRUE);
			$this->load->view('front/template',$data);
			
	}
	
	

}
/* End of file exposicion_front.php */