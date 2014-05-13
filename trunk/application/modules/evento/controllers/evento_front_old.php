<?php defined('BASEPATH') OR exit('No se permite el acceso directo.');

/**
 * 
 * Controlador de front/eventos
 * 
 * @author Steven
 */
class Evento_front extends MX_Controller {

	/**
	 * 
	 * Constructor de la clase
	 * 
	 */
	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->model('evento_model');
		
		if ($this->session->userdata('idioma') == '')
			$this->session->set_userdata('idioma','es');
		
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		
		$this->lang->load('front');
		
	}

	/**
	 * 
	 * Página principal
	 * 
	 */
	public function index()
	{
		$data['main_button'] = 'actividades';
		$data['error'] = 0;
		$data['placeholder'] = lang('placeholder_thumb');
		$data['placeholder2'] = lang('placeholder_med');
		$data['arbol_eventos']= modules::run('services/relations/get_all_orderby','evento',false,'',true,'detalle_evento.fecha');
		if(isset($data['arbol_eventos'])&&($data['arbol_eventos']!=NULL))
		$data['imagen'] = modules::run('services/relations/get_rel', 'evento', 'imagen', $data['arbol_eventos'][0]->id_evento,'',false);
		//echo '<pre>'.print_r($data['imagen'],TRUE).'</pre>';die();
	
		$data['title']=$this->lang->line('actividades.meta.title').' | '.$this->lang->line('inicio.meta.title');
		$data['meta_descripcion']=$this->lang->line('actividades.meta.description');
		$data['meta_keywords']=$this->lang->line('actividades.meta.keywords');
		
		$data['contenido_principal'] = $this->load->view('front/evento_view', $data, TRUE);
		$this->load->view('front/template', $data);
		
		
	}
	
	public function listar($url='')
	{
		if(is_numeric($url)&&($url!=''))
		{
			$id=$url;
			
		}else{
			
			$id=modules::run('services/relations/get_id_evento_url', $url);
			//echo $id;die('xx');
		}
		if(isset($id)&&($id!=''))
		{ 
		$data['id_evento'] = $id;
		$data['error'] = 1;
		$data['arbol_eventos']= modules::run('services/relations/get_all_orderby','evento',false,'',true,'detalle_evento.fecha');
		//echo '<pre>'.print_r($data['arbol_eventos'],TRUE).'</pre>';die();
			foreach ($data['arbol_eventos'] as $arbol) 
			{
				if($arbol->id_evento==$id)
				{
					$data['error']=0;
				}
			}
			if($data['error']==0)
			{
				$data['placeholder'] = lang('placeholder_thumb');
				$data['placeholder2'] = lang('placeholder_med');
				$data['imagen'] = modules::run('services/relations/get_rel', 'evento', 'imagen', $id,'',false);
				//echo '<pre>'.print_r($data['imagen'],TRUE).'</pre>';die();
			
				$data['title']=$this->lang->line('actividades.meta.title').' | '.$this->lang->line('inicio.meta.title');
				$data['meta_descripcion']=$this->lang->line('actividades.meta.description');
				$data['meta_keywords']=$this->lang->line('actividades.meta.keywords');
			}else{
					$data['title']=$this->lang->line('actividades.no.dispnible.meta.title').' | '.$this->lang->line('inicio.meta.title');
					$data['meta_descripcion']=$this->lang->line('actividades.meta.description');
					$data['meta_keywords']=$this->lang->line('actividades.meta.keywords');
				 }
		}else{
			
			redirect('actividades');
		}
	
		
		$data['contenido_principal'] = $this->load->view('front/evento_view', $data, TRUE);
		$this->load->view('front/template', $data);
		
	}

}

/* End of file exposicion_front.php */
