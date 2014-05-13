<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicio_front extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
		
		$this->load->model('servicio_model');
	}
	
	function index()
	{
		$this->servicios();
	}
	
	function servicios()
	{
		//Datos
		$data['servicios'] = $this->servicio_model->get_servicios();
		//die_pre($data['servicios']);
		
		//Info head
		$data['head_title'] = lang('nombre_principal') . ' | '. lang('front.servcios');
		$data['head_descripcion'] = lang('front.servcios_desc'); 
		
		//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
		$data['contenido_principal'] = $this->load->view('front/servicios', $data, true);
		
		//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
		$this->load->view('front/template',$data);
	}
	
	function enviar_mensaje()
	{
		
		if(!$this->input->is_ajax_request())
		{
			redirect("404");
		}
		else
		{
			//echo '<pre>'.print_r($_POST,true).'</pre>';
			$this->form_validation->set_rules('nombre','Nombre','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('mensaje','Mensaje','required');
			
			//ESTABLECEMOS LOS MENSAJES A LAS REGLAS
			$this->form_validation->set_message('required',"El campo %s es requerido.");
			
			if($this->form_validation->run($this) == TRUE)
			{
				//CONFIGURACION PARA EL ENVIO DEL CORREO ELECTRONICO
				$config['protocol'] 	= "smtp";
				$config['smtp_host'] 	= "ssl://smtp.googlemail.com";
				$config['smtp_port'] 	= 465;
				/*$config['smtp_user']	= "hf.nsce@gmail.com";
				$config['smtp_pass']	= "20162504h";*/
				$config['mailtype'] 	= "html";
				$config['charset']		= 'utf-8';
				$config['newline']		= "\r\n";
				$this->load->library('email', $config);
				
				//CONFIGURANDO LA DATA A ENVIAR POR CORREO
				$form_data['nombre']		= $this->input->post('nombre');
				$form_data['email']	 		= $this->input->post('email');
				$form_data['organizacion']	= $this->input->post('compania');
				$form_data['mensaje']		= $this->input->post('mensaje');
				
				$this->email->initialize($config);
				
				$this->email->from($form_data['email'], $form_data['nombre']);
				$this->email->to("hf.nsce@gmail.com","Hector Flores");
				//$this->email->to("asistentecomercial@hesperia-wtc.com","Hesperia WTC");
				$this->email->bcc("gchemello@gmail.com","Gerardo Chemello");
				$this->email->bcc("hf.nsce@gmail.com","Hector Flores");
				$this->email->subject('Contacto');
				
				$data_usuario['nombre'] 		= $form_data['nombre'];
				$data_usuario['email'] 			= $form_data['email'];
				$data_usuario['organizacion'] 	= $form_data['organizacion'];
				$data_usuario['mensaje'] 		= $form_data['mensaje'];
	
				$this->email->message($this->load->view('correo', $data_usuario, true));
				
				//SI EL CORREO SE ENVIA
				if ($this->email->send())
				{
					echo "Enviado";
				}
				else//SINO SE ENVIA
				{
					echo "No enviado";
				}
				 
			}
			else
			{
				$error = array(
					'nombre' 	=> form_error('nombre'),
					'email' 	=> form_error('email'),
					'mensaje'	=> form_error('mensaje')
				);
				
				$error = json_encode($error);
				echo $error;
			}
		}
		
		
		
	}

	function convenciones()
	{
		//$data['salones'] = $this->servicio_model->get_salones();
		
		//Info head
		$data['head_title'] = lang('nombre_principal') . ' | '. lang('front.convenciones_titulo');
		$data['head_descripcion'] = lang('front.convenciones_desc'); 
		
		//CARGO EL CONTENIDO PRINCIPAL EN LA PAGINA 
		$data['contenido_principal'] = $this->load->view('front/convenciones', $data, true);
		
		//CARGO EL CONTENIDO PRINCIPAL CON LA AYUDA DEL TEMPLATE
		$this->load->view('front/template',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */