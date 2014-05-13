<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contacto_front extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
		
		$this->load->model('contacto_model');
	}
	
	function index()
	{
		$this->contactanos();
	}
	
	function contactanos()
	{
		//Info head
		$data['head_title'] = lang('nombre_principal'). ' | '.lang('front.contacto_contactanos');
		$data['head_descripcion'] = lang('front.contacto_contactanos_desc');
		
		//Importante para que el mapa funcione!
		$data['quitar_iosslider'] = TRUE;
		
		//JS
		$data['contacto_js'] = $this->load->view('contacto_js', '', true);
		
		//Testimonios
		$data['testimonios'] = $this->contacto_model->get_testimonios();
		
		//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
		$data['contenido_principal'] = $this->load->view('contacto', $data, true);
		
		//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
		$this->load->view('front/template',$data);
	}
	
	function ajax_enviar_mensaje()
	{
		if(!$this->input->is_ajax_request())
		{
			redirect("404");
		}
		else
		{
			//Config
			$config['protocol'] 	= "smtp";
			$config['smtp_host'] 	= "ssl://smtp.googlemail.com";
			$config['smtp_port'] 	= 465;
			$config['smtp_user']	= lang('email_stp');
			$config['smtp_pass']	= lang('email_pass');
			$config['mailtype'] 	= "html";
			$config['charset']		= 'utf-8';
			$config['newline']		= "\r\n";
			$this->load->library('email', $config);
			
			//Data
			$form_data['nombre']		= $this->input->post('nombre');
			$form_data['email']	 		= $this->input->post('email');
			$form_data['organizacion']	= $this->input->post('asunto');
			$form_data['mensaje']		= $this->input->post('mensaje');
			
			$this->email->initialize($config);
			
			$this->email->from($form_data['email'], $form_data['nombre']);
			$this->email->to(lang('email_hesperia_contacto'), lang('nombre_principal'));
			//$this->email->to("asistentecomercial@hesperia-wtc.com", lang('nombre_principal'));
			//$this->email->bcc("gchemello@gmail.com","Gerardo Chemello");
			$this->email->subject('Contacto | '.$this->input->post('asunto'));

			$this->email->message($this->load->view('correo', $form_data, true));
			
			if ($this->email->send())
			{
				echo 'sent';
			}
			else
			{
				echo 'failed';
			}
		}
	}

	function ajax_guardar_testimonio()
	{
		if(!$this->input->is_ajax_request())
		{
			redirect("404");
		}
		else
		{
			//Data
			$form_data['nombre']		= $this->input->post('nombre');
			$form_data['email']	 		= $this->input->post('email');
			$form_data['comentario']	= $this->input->post('mensaje');
			
			$existe_comentario = $this->contacto_model->existe_testimonio($form_data['comentario']);
			
			if (!empty($form_data['nombre']) && !empty($form_data['email']) && !empty($form_data['comentario']))
			{
				if(!$existe_comentario)
				{
					$this->contacto_model->guardar_testimonio($form_data);
					echo 'sent';
				}
				else
				{
					echo 'failed_already_exists';
				}
			}
			else
			{
				echo 'failed';
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */