<?php

class Usuarios_front extends Controller {


	function Usuarios_front()
	{
		parent::Controller();
		$this->config->set_item('language','es');
		$this->load->model('usuarios_model');
		modules::run('idioma/set_idioma', 'es');
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code', 'es');
		$this->lang->load('front');
		$this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->helper(array('form', 'url'));
		
		
		// Gettext: http://codeigniter.com/wiki/Category:Internationalization::Gettext/
		// TODO: lo postpongo para más adelante, ahora mismo me lleva demasiado tiempo
		//$this->load->library('MY_Language');
		//$this->lang->load_gettext( $this->config->get_item('language') ); 
		//$this->gettextbis->line('messSingle', array('plural' => 'messPlur', 'count' => 2, 'd' => 18));
	}
	
	/* 
	 * Funcciones del admin, con control de aceso */
	function index()
	{
		//echo "aaa";
		$data['main']='coleccion';
		
		$data['no_sidebar']=true;

		$data['main']=$this->lang->line('inicio');
		$data['sub']='/';
		$data['title']=$this->lang->line('inicio');
		$data_content['breadcrumbs']=array('/',$this->lang->line('inicio'));
		$where = array("tipo_receta"=>"mes");
		$data_content['recetas_mes'] = modules::run('services/relations/get_all_orderby','receta',false,$where,'true','receta.creado');
		
		//$where = array("tipo_receta"=>"mes");
		$order = 'RAND()';
		$data_content['productos'] = modules::run('services/relations/get_all_orderby','producto',false,'','true',$order);
		//$data_content=1;
		//echo "entra aqui tambien";
		//echo "<pre>PRODUCTO Relacionado"; print_r($data_content['productos']); echo "</pre>";
		$data['main_content']=$this->load->view('front/home',$data_content,true);
		$this->load->view('front/template',$data);
	}

	function usuarioUnico(){
			return !$this->usuarios_model->findUsuario($this->input->post('nombre_usuario'));
	}

	function correoUnico(){
			return !$this->usuarios_model->findEmail($this->input->post('correo_usuario'));		
	}

	function correoLogin(){
			return !$this->usuarios_model->findEmail($this->input->post('email'));		
	}
	
	function login($categoria='')
	{
		//echo "aqui va el URL".$categoria;
		if ($categoria==$this->lang->line('recuperar_password_url')) {
			$this->recuperar_page();
		} else {
			//echo 'pagina login';
			$data['main'] = $this->lang->line('login');
			$data['title'] = "Login";
			$data_content['id_idioma'] = $this->id_idioma;
			$data_content['breadcrumbs']=array('/'=>$this->lang->line('inicio'),$this->lang->line('login_url')=>$this->lang->line('login'));
			$data['main_content']=$this->load->view('front/login',$data_content,true);
			$this->load->view('front/template',$data);
		}
	}

	function recuperar_page($categoria='')
	{
		//echo "aqui va el contacto";
			//echo 'pagina recuperar';
			$data['main']=$this->lang->line('login');
			$data_content['id_idioma']=$this->id_idioma;
			$data_content['breadcrumbs'] = array(
													'/' => lang('inicio'), 
													$this->lang->line('login_url') => $this->lang->line('login')
												);
			$data['main_content']=$this->load->view('front/recuperar',$data_content,true);
			$this->load->view('front/template',$data);
		
	}
	
	/**
	 * Recibe el formulario de login
	 * 
	 *
	 */
	function check_login($ajax = false)
	{
		//echo 'entro aqui enviar';
		$data['main'] = lang('login');
		
		$this->form_validation->set_error_delimiters('<p class="errorbox">', '</p>');
		
		
		//$this->form_validation->set_rules('email','Email','required|min_length[3]|trim|valid_email|callback__esUsuarioActivoByEmail');
		//$this->form_validation->set_message('email', '%s no corresponde a ningun usuario registrado y activado');
		//$this->form_validation->set_rules('password','Contraseña','required|trim|callback__esUsuarioActivoByEmailPassword');
		
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_correoLogin');
		$this->form_validation->set_rules('password','Contraseña','required|trim|min_length[3]');
		//$this->form_validation->set_message('min_length', '%s los caracteres minimos son 3');
		$this->form_validation->set_message('correoLogin', 'El correo no esta registrado/activado.');
		
		if (!$this->form_validation->run()) {
			// Muestra la página de login, donde habrá que indicar que
			//	hubo un error en el login.
			$this->login();
		} else {
			$this->load->model('usuarios_model');
			
			$usuario = $this->usuarios_model->validate();
			//echo '<pre>'.print_r($id_usuario,true).'</pre>';
			if ($usuario !== false)  {
				// if the user's credentials validated...
				
				//echo "form validation true y el usuario existe".$this->input->post('url')."<-";
				//$this->user_data();
				$data=(array)$usuario;
				$data['is_logged_in'] = true;
				//echo '<pre>'.print_r($data,true).'</pre>';
				$this->session->set_userdata($data);
				
				if ($ajax!=false) {
					echo json_encode($this->user);
				} else {
					//echo 'true';
					if( $this->input->post('url') !=''  ) {
						$r = $this->input->post('url');
						$r=($this->input->post('url')=='/'.$this->lang->line('login_url_check')) ? '/' : $r;
						redirect($r);
					} else {
						$r=($this->session->userdata('return_url')=='') ? '/' : $this->session->userdata('return_url');
						$r=($this->session->userdata('return_url')=='/'.$this->lang->line('login_url_check')) ? '/' : $r;
						redirect($r);
					}
				}
			} else  {
				// incorrect username or password
				
				//echo "form validation true pero usuario no existe";
				
				if ($ajax!=false){
					echo "[{'result':false}]";
				} else {
					$data['login']=true;
					$data_content['error']= $this->lang->line('login_error');
					$data['main']=$this->lang->line('login');
					$data_content['id_idioma']=$this->id_idioma;
					$data_content['breadcrumbs']=array('/'=>$this->lang->line('inicio'),$this->lang->line('login_url')=>$this->lang->line('login'));
					$data['main_content']=$this->load->view('front/login',$data_content,true);
					$this->load->view('front/template',$data);
		
				}
			}
		}
	}

	
	
	function registro($categoria='') {
		if ($categoria == $this->lang->line('registro_crear_url')) {
			$this->registro_create(); 
		} else {
			//echo '<pre> POST'.print_r($_POST,true).'</pre>';
			$data['main'] = $this->lang->line('registro');
			$data_content['id_idioma'] = $this->id_idioma;
			$data_content['breadcrumbs'] = array(
													'/' => $this->lang->line('inicio'),
													'/'.$this->lang->line('registro_url') => $this->lang->line('registro'),
												);
			$data_content['post'] = $this->session->userdata('register');
			$this->session->unset_userdata('register');
			
			$data['main_content'] = $this->load->view('front/registro_1',$data_content,true);
			$this->load->view('front/template',$data);
		}
	}

	function registro_2($categoria='')
	{
		//echo '<pre> POST2'.print_r($_POST,true).'</pre>';
		
		$data['main'] = $this->lang->line('registro');
		$data_content['id_idioma'] = $this->id_idioma;
		$data_content['breadcrumbs'] = array(
			'/' => $this->lang->line('inicio'),
			'/'.$this->lang->line('registro_url') => $this->lang->line('registro'),
			//''	=> 'Paso 2/2'
		);
		
		$data_content['post'] = $this->session->userdata('register2');
		$this->session->unset_userdata('register2');
		
		
		$data['main_content'] = $this->load->view('front/registro_2',$data_content,true);
		$this->load->view('front/template',$data);
		
	}
	
	function registro_OK($categoria='')
	{
		
		$data['main']=$this->lang->line('registro');
		$data_content['id_idioma']=$this->id_idioma;
		$data_content['breadcrumbs']=array('/'=>$this->lang->line('inicio'),$this->lang->line('registro_url')=>$this->lang->line('registro'));
		$data['main_content']=$this->load->view('front/registro_OK',$data_content,true);
		$this->load->view('front/template',$data);
		
	}

	function registro_MOD($categoria='')
	{
		
		$data['main']=$this->lang->line('registro');
		$data_content['id_idioma']=$this->id_idioma;
		$data_content['breadcrumbs']=array('/'=>$this->lang->line('inicio'),$this->lang->line('registro_url')=>$this->lang->line('registro'));
		$data['main_content']=$this->load->view('front/registro_MOD_OK',$data_content,true);
		$this->load->view('front/template',$data);
		
	}
	
	function activar_usuario($clave='')
	{
		if ($clave=='') {
			redirect('/');
		} else {
			$usuario = $this->usuarios_model->get_key($clave);
			
			//if($usuario['id_rol']!='4') redirect('/');
			//echo '<pre> Usuario['.$usuario.']'.print_r($usuario,true).'</pre>';
			$form_data['id_rol']='3'; // Activa el Rol de Receta al usuario 
			$form_data['id_usuario'] = $usuario['id_usuario'];
			//$form_data['verificacion'] =
			//$this->load->model('usuario/usuario_model');
			//$id=$this->usuario_model->update($form_data);
            
            $this->load->model('usuario/usuario_model');
			$id=$this->usuario_model->update($form_data);
			            
			$data['main'] = $this->lang->line('registro');
			$data_content['id_idioma']=$this->id_idioma;
			$data_content['breadcrumbs']=array(
				'/' => $this->lang->line('inicio'),
				'/'.$this->lang->line('registro_url') => $this->lang->line('registro'),
				''	=> 'Activar');
			//$data['main_content']=$this->load->view('front/activar_OK',$data_content,true);
			$data['main_content']=$this->load->view('front/registro_OK',$data_content,true);
			$this->load->view('front/template',$data);
		}
	}
	
	function registro_create($id='') {

		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li class="errorbox">', '</li>');
		$this->form_validation->set_message('required', $this->lang->line('form.error.registro.requerido'));
		$this->form_validation->set_message('min_length', $this->lang->line('form.error.registro.min_lenght'));
		
		$prueba = date("Y-m-d");
		
		switch ($this->input->post('paso')) {
			case '2': $this->registro_create_2(); return;
			default: $this->registro_create_1();
		}
			
	}
	
	function registro_create_2() {
		echo '<pre>';
		echo '<h1>registro_create_2</h1>';
		print_r($_POST);
		echo '<h1>registro_create_1</h1>';
		print_r($this->session->userdata('register'));
		echo '</pre>';
		
		// Guardamos datos de paso 1 en sesión
		$this->session->set_userdata('register2', $_POST);
		
		$this->form_validation->set_rules('name', 'Nombre', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('surname1', 'Apellido 1', 'trim|required||min_length[2]');
		$this->form_validation->set_rules('surname2', 'Apellido 2', 'trim|required|min_length[2]');
		//$this->form_validation->set_rules('select_track', 'Vía', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('phone', 'Teléfono', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('address_name', 'Nombre de la vía', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('address_number', 'Numero', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('address_place', 'Localidad', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('address_cp', 'CP', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('select_province', 'Provincia', 'trim|required|min_length[1]');
		
		if (!modules::run('usuarios/is_logged_in_rol','usuario',$this->uri->uri_string()) ) {
			$this->form_validation->set_rules('accept_conditions', 'Acepto Condiciones', 'trim|required|min_length[2]');
		}
		//date_default_timezone_set ('Europe/Berlin');
		
		
		if (!$this->form_validation->run($this)) {
			$this->registro_2();
		} else {
			//foreach (array_keys($_POST) as $k) {
			//	$form_data_temp[$k]=$this->input->post($k);
			//}
			$form_data_temp = array_merge($this->session->userdata('register'), $_POST);
			//Data principal
			
            if ($this->session->userdata('id_usuario')!='') {
				$form_data['id_usuario'] = $this->session->userdata('id_usuario');
				$usuario = $this->usuarios_model->read($this->session->userdata('id_usuario'));
				$form_data2['id_detalle_usuario'] = $usuario->id_detalle_usuario;
            }
	
          	$form_data['nombre_usuario'] = $form_data_temp['nombre_usuario'];
			$form_data['nombre'] = $form_data_temp['name'];
			$form_data['apellidos'] = $form_data_temp['surname1'];
			$form_data['email'] = $form_data_temp['correo_usuario'];
			$form_data['fecha'] = date('Y-m-d');
			$form_data['password'] = sha1($form_data_temp['clave']);
			
			if ($this->session->userdata('id_usuario')=='') {
				// ID ROL de tipo USUARIO = 3
				$form_data['id_rol'] = 4; //Rol Inactividad 
				$form_data['verificacion'] = sha1($form_data['email'].$form_data['fecha'].$form_data['nombre']);

			}
			
			//echo '<pre> POST'.print_r($_POST,true).'</pre>';   
            $this->load->model('usuario/usuario_model');
            $id = $this->usuario_model->update($form_data);
            //echo 'SI SE REGISTRO EL USUARIO ['.$id.']<br>';
			//$this->registro_2();
			
			//Data Usuario Detalles
			$form_data2['id_usuario'] = $id;
			$form_data2['apellido_1'] = $form_data_temp['surname1'];
			$form_data2['apellido_2'] = $form_data_temp['surname2'];
			$form_data2['telefono'] = $form_data_temp['phone'];
			$form_data2['direccion_via'] = $form_data_temp['via'];
			$form_data2['direccion_via_nombre'] = $form_data_temp['address_name'];
			$form_data2['direccion_numero'] = $form_data_temp['address_number'];
			$form_data2['localidad'] = $form_data_temp['address_place'];; 
			$form_data2['cp'] = $form_data_temp['address_cp'];
			$form_data2['provincia'] = $form_data_temp['select_province'];
			$form_data2['mayor_edad'] = isset($form_data_temp['age']) ? '1' : '0';
			$form_data2['recibir_promos'] = isset($form_data_temp['promotions']) ? '1' : '0';
			
			
			$id = $this->usuario_model->update_idioma($form_data2);
			
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if (!isset($is_logged_in) || $is_logged_in != true) {
		 		//Proceso de ENVIO DE CORREO ELECTRONICO
				$email = $form_data_temp['correo_usuario'];
				//$email = 'gchemello@gmail.com';
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from($this->lang->line('email_albo_registro'), $this->lang->line('nombre_emisor_registro'));
				$this->email->to($email);
				//if($this->input->post('email_copia')!='') $this->email->cc($form_data['email']);
				//$this->email->bcc('inaki.garcia@tecknosfera.com','Iñaki García');		
				//$this->email->subject($this->lang->line('contacto.form.tema.'.$form_data['tipo_mensaje']));
				$this->email->subject($this->lang->line('email_subject_registro'));		
				$data_usuario['url'] = $this->lang->line('url_albo');		
				$data_usuario['verificacion'] = $this->lang->line('url_albo').$this->lang->line('activar_url').'/'.$form_data['verificacion'];			
				$this->email->message($this->load->view('front/emailing_registro',$data_usuario,true));			
				
				if ( !$this->email->send()) { //echo "Error envio el Email"; 
											}
				else { //echo "Success envio el Email"; 
				}
			}
			if ($this->session->userdata('id_usuario')=='') {
				// Registrando
				$this->registro_OK();
			} else {
				// Modificando
				$this->registro_MOD();
			} 
		}
		
	}
	
	function registro_create_1() {
		// echo '<pre>'; print_r($_POST); echo '</pre>';
		
		// Guardamos datos de paso 1 en sesión
		$this->session->set_userdata('register', $_POST);
		
		
		if (!modules::run('usuarios/is_logged_in_rol','usuario',$this->uri->uri_string()) ) {
			$this->form_validation->set_rules('nombre_usuario', $this->lang->line('form.error.nombre'), 'trim|required|min_length[3]|callback_usuarioUnico');
			$this->form_validation->set_rules('correo_usuario', $this->lang->line('form.error.correo'), 'trim|required|valid_email|min_length[5]|callback_correoUnico');
			$this->form_validation->set_rules('repeat_correo_usuario', $this->lang->line('form.error.correo.repetir'), 'trim|required|valid_email|min_length[5]|matches[correo_usuario]');
			//$this->form_validation->set_rules('be_of_age', $this->lang->line('form.error.mayor'), 'trim|required|min_length[1]');
			$this->form_validation->set_rules('age', $this->lang->line('form.error.mayor'), 'trim|required|min_length[2]');
		} else  {
			$this->form_validation->set_rules('correo_usuario', $this->lang->line('form.error.correo'), 'trim|required|valid_email|min_length[5]');
			$this->form_validation->set_rules('repeat_correo_usuario', $this->lang->line('form.error.correo.repetir'), 'trim|required|valid_email|min_length[5]|matches[correo_usuario]');
		}
		
		$this->form_validation->set_rules('clave', $this->lang->line('form.error.password'), 'trim|required|min_length[6]');
		$this->form_validation->set_rules('repeat_password_usuario', $this->lang->line('form.error.password.repetir'), 'trim|required|min_length[6]|matches[clave]');
		
		
		$this->form_validation->set_message('valid_email', $this->lang->line('form.error.registro.email'));
		$this->form_validation->set_message('matches', $this->lang->line('form.error.registro.igual'));
		
		$this->form_validation->set_message('usuarioUnico', 'El %s ya existe, intenta con otro nombre.');
		$this->form_validation->set_message('correoUnico', 'El %s ya esta registrado.');
		
		//$this->load->model('usuarios_model');
		//$usuario_login=$this->usuarios_model->get_user($this->session->userdata('id_usuario'));
		//echo '<pre>Usuario:'.$this->session->userdata('id_usuario'); echo print_r($usuario_login,true); echo '</pre>';
			
		if (!$this->form_validation->run($this)) {
			$this->registro();
		} else {
			//echo '<pre> POST'.print_r($_POST,true).'</pre>';   	
			$this->registro_2(); 
		}
	}
	
}

/* End of file home_front.php */
