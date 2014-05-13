<?php

class Restaurante_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}

	function create($data)
	{
		$this->db->insert('restaurante',$data);
		return $this->db->insert_id();
	}

	function get($id, $idioma=''){
		$this->db->select('restaurante.*, detalle_restaurante.*, restaurante.id_restaurante as id_restaurante');
		$this->db->join('detalle_restaurante', 'detalle_restaurante.id_detalle_restaurante = restaurante.id_restaurante');
		if($idioma != ''){
			$this->db->join('idioma', 'detalle_restaurante.id_idioma = idioma.id_idioma');
			$this->db->where('idioma.idioma', $idioma);
		}
		$this->db->where('restaurante.id_restaurante', $id);
		$query = $this->db->get('restaurante');
		return $query->row();
	}

	function read($id, $id_detalle_restaurante='', $idioma='')
	{
		$this->db->select('restaurante.*,detalle_restaurante.*,restaurante.id_restaurante as id_restaurante');
		//$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		if ($id_detalle_restaurante!='') $this->db->where('detalle_restaurante.id_detalle_restaurante',$id_detalle_restaurante);
		$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante','left');
		//$this->db->where('detalle_restaurante.id_idioma', $idioma);
		$this->db->where('restaurante.id_restaurante', $id);
		$q=$this->db->get('restaurante');
		return $q->row();
	}

	function get_posts($num_posts, $orden = 'desc', $donde = array()){
		$this->db->select('restaurante.id_restaurante as id, detalle_restaurante.id_idioma, restaurante.creado as fecha_creacion, detalle_restaurante.nombre as nombre, detalle_restaurante.url as url, detalle_restaurante.titulo_pagina as titulo_pagina, detalle_restaurante.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_restaurante', 'restaurante.id_restaurante = detalle_restaurante.id_restaurante');
		$this->db->join('rel_restaurante_multimedia', 'rel_restaurante_multimedia.id_restaurante = restaurante.id_restaurante', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_restaurante_multimedia.id_multimedia', 'left');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('restaurante.creado', $orden);
		$query = $this->db->get('restaurante', $num_posts);
		return $query->result();
	}
	
	function get_posts_economicas($num_posts, $orden = 'desc', $donde = array())
	{
		$this->db->select('restaurante.id_restaurante as id, restaurante.creado as fecha_creacion, restaurante.seccion as seccion, detalle_restaurante.nombre as nombre, detalle_restaurante.url as url, detalle_restaurante.titulo_pagina as titulo_pagina, detalle_restaurante.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_restaurante', 'restaurante.id_restaurante = detalle_restaurante.id_restaurante');
		$this->db->join('rel_restaurante_multimedia', 'rel_restaurante_multimedia.id_restaurante = restaurante.id_restaurante', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_restaurante_multimedia.id_multimedia', 'left');
		$this->db->where('seccion','economia');
		$this->db->or_where('seccion','ambas');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('restaurante.creado', $orden);
		$query = $this->db->get('restaurante', $num_posts);
		return $query->result();
	}

	function get_last_five_post(){
		$this->db->select('restaurante.id_restaurante as id, detalle_restaurante.nombre as nombre, detalle_restaurante.url as url, detalle_restaurante.titulo_pagina as titulo_pagina');
		$this->db->join('detalle_restaurante', 'restaurante.id_restaurante = detalle_restaurante.id_restaurante');
		$this->db->order_by('restaurante.creado','desc');
		$query = $this->db->get('restaurante', 5);
		return $query->result();
	}

	function get_image($id_restaurante)
	{
		$this->db->select('multimedia.*');
		//$this->db->join('rel_restaurante_multimedia', 'rel_restaurante_multimedia.id_restaurante = restaurante.id_restaurante');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_restaurante_multimedia.id_multimedia');
		//$this->db->where('restaurante.id_restaurante', $id_restaurante);
		$q=$this->db->get('rel_restaurante_multimedia');

	}

	function detalles($id_restaurante, $id_detalle = '', $idioma = ''){
		$this->db->join('detalle_restaurante','restaurante.id_restaurante = detalle_restaurante.id_restaurante');
		if($id_detalle != '')
		{
			$this->db->where('detalle_restaurante.id_idioma', $id_detalle);
		}
		if($idioma != '')
		{
			$this->db->where('detalle_restaurante.id_idioma', $idioma);
		}
		$this->db->where('restaurante.id_restaurante',$id_restaurante);
		$q=$this->db->get('restaurante');
		return $q->result();
	}

	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante');
		$this->db->where('detalle_restaurante.id_idioma',$idioma);
		$q=$this->db->get('restaurante');
		return $q->result();
	}

	function get_all_years($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante');
		$this->db->where('detalle_restaurante.id_idioma',$idioma);
		$this->db->distinct();
		$this->db->select('YEAR(`creado`) as year');
		$this->db->order_by('creado','desc');
		$q=$this->db->get('restaurante');
		return $q->result_array();
	}

	function get_list($f='restaurante.id_restaurante',$v=1,$group=false){

		$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('restaurante.id_restaurante');
		$q=$this->db->get('restaurante');
		return $q->result();
	}

	function get_page($start = 0, $count = 10, $order_field='restaurante.id_restaurante', $order_dir = 'desc', $call = 'back', $terminos_busqueda = array())
	{
		switch ($order_field)
		{
			case 'id_restaurante';
				$order_field='restaurante.id_restaurante';
			break;
			
			default :
				$order_field=$order_field;
			break;
		}

		$this->db->select('restaurante.*,detalle_restaurante.*, restaurante.id_restaurante as id_restaurante, multimedia.fichero');
		
		if($call == 'back')
		{
			$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante','left');
		}
		else
		{
			$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante');
		}

		$this->db->join('rel_restaurante_multimedia', 'restaurante.id_restaurante = rel_restaurante_multimedia.id_restaurante', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_restaurante_multimedia.id_multimedia', 'left');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='restaurante.id_estado' || $field=='restaurante.id_restaurante' || $field == 'detalle_restaurante.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
                }
				elseif ($field=='restaurante.destacado' && $value!='')
                {
                    $this->db->where($field,$value);
				}
                elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_restaurante.descripcion_breve LIKE '%$value%' OR detalle_restaurante.nombre LIKE '%$value%' OR detalle_restaurante.descripcion_ampliada LIKE '%$value%')");
				}
				else
				{
					if ($value!='' && !is_array($value)) $this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('restaurante.id_restaurante');
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('restaurante',$count,$start);

		return $q->result();
	}

	function count_all($terminos_busqueda=array())
	{
		$this->db->select('count(*) as num_restaurantes');
		$this->db->join('detalle_restaurante', 'detalle_restaurante.id_restaurante = restaurante.id_restaurante', 'LEFT');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='restaurante.id_restaurante' || $field == 'detalle_restaurante.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
                }
				elseif ($field=='restaurante.destacado' && $value!='')
                {
                    $this->db->where($field,$value);
				}
                elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_restaurante.descripcion_breve LIKE '%$value%' OR detalle_restaurante.nombre LIKE '%$value%' OR detalle_restaurante.descripcion_ampliada LIKE '%$value%')");
				}
				else
				{
					if ($value!='' && !is_array($value)) $this->db->like($field,$value);
				}
			}
		}

		//$this->db->group_by('restaurante.id_restaurante');
		$q=$this->db->get('restaurante');
		//echo $this->db->last_query(); die();
		$ret=$q->row();
		return $ret->num_restaurantes;
	}

	function update($data)
	{
		if(!isset($data['id_usuario'])) $data['id_usuario'] = $this->session->userdata('id_usuario');
		
		//echo '<pre>'.print_r($data,true).'</pre>';
		if (isset($data['id_restaurante'])){
			$restaurante=$this->read($data['id_restaurante']);
		}
		//echo '<pre>'.print_r($restaurante,true).'</pre>';
		if (!empty($restaurante)){
			$this->db->where('id_restaurante',$data['id_restaurante']);
			$this->db->update('restaurante',$data);
			$id=$data['id_restaurante'];
		}else{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('restaurante',$data);
			$id=$this->db->insert_id();
		}

		return $id;
	}

	function update_idioma($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';
		$d=array('id_idioma'=>$data['id_idioma'],'id_restaurante'=>$data['id_restaurante']);
		
		if (isset($data['id_detalle_restaurante']) && $ob=$this->exists('detalle_restaurante',$d)){
			if (isset($data['id_detalle_restaurante'])){
				$this->db->where('id_detalle_restaurante',$data['id_detalle_restaurante']);
				$id=$data['id_detalle_restaurante'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_restaurante;
			}
			$this->db->update('detalle_restaurante',$data);

		}else{
			unset($data['id_detalle_restaurante']);
			$this->db->insert('detalle_restaurante',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}

	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','restaurante','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('restaurante', array('id_restaurante' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado'] = 3;
		$this->db->where('id_restaurante',$id);
		return $this->db->update('restaurante',$data);
	}

	function eliminar_idioma($id){
		if ($this->db->delete('detalle_restaurante', array('id_detalle_restaurante' => $id)))
			return true;
		else return false;
	}

	function exists($table,$key=array()){

		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}

	function get_restaurante_titulos_urls(){
		$this->db->select('restaurante.id_restaurante as id, detalle_restaurante.nombre as nombre, detalle_restaurante.url as url');
		$this->db->join('detalle_restaurante', 'restaurante.id_restaurante = detalle_restaurante.id_restaurante');
		$query = $this->db->get('restaurante');
		return $query->result();
	}

	function guardar_rel_imagen($data){
		$this->db->insert('rel_restaurante_multimedia', $data);
	}

	function guardar_imagen($data){
		$this->db->insert('multimedia', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function get_id_from_url($url){
		$this->db->select('detalle_restaurante.id_restaurante');
		$this->db->where('detalle_restaurante.url', $url);
		$query = $this->db->get('detalle_restaurante');
		return $query->row()->id_restaurante;
	}

	function get_restaurantes_fecha($fecha1='', $fecha2='', $id_idioma=1)
	{
		$restaurante_total = array();
		$i=1;
		while(($fecha1<=$fecha2)&&($i<=5))
		{
			$this->db->select('restaurante.*, detalle_restaurante.id_detalle_restaurante, detalle_restaurante.nombre, detalle_restaurante.id_idioma, detalle_restaurante.subtitulo, detalle_restaurante.url,
			detalle_restaurante.descripcion_breve, detalle_restaurante.descripcion_ampliada, detalle_restaurante.id_idioma, detalle_restaurante.descripcion_breve,
			detalle_restaurante.descripcion_pagina, detalle_restaurante.keywords, detalle_restaurante.titulo_pagina, multimedia.fichero');
			$this->db->join('detalle_restaurante','restaurante.id_restaurante=detalle_restaurante.id_restaurante');
			$this->db->join('rel_restaurante_multimedia', 'restaurante.id_restaurante = rel_restaurante_multimedia.id_restaurante', 'left');
			$this->db->join('multimedia', 'multimedia.id_multimedia = rel_restaurante_multimedia.id_multimedia', 'left');
		    $this->db->where('restaurante.id_estado', '1');	
			$this->db->like('restaurante.creado', $fecha1);
			$this->db->like('detalle_restaurante.id_idioma', $id_idioma);
			$this->db->group_by('restaurante.id_restaurante');
			$this->db->order_by('restaurante.creado','DESC');
			$restaurante = $this->db->get('restaurante')->result();
			
			$restaurante_total = array_merge($restaurante_total,$restaurante);
			$fecha1= $this->operacion_fecha($fecha1, '1');
			if(count($restaurante)==1)
			$i=$i+1;
		}
	
		//die("<pre>".print_r($restaurante_total, TRUE). $this->db->last_query() ."</pre>");
		return $restaurante_total;
	}

	function operacion_fecha($fecha,$dias) 
	{
		$fecha_sin_horas=explode(" ",$fecha); 	
		list ($ano,$mes,$dia)=explode("-",$fecha_sin_horas[0]);
		if (!checkdate($mes,$dia,$ano)){return false;} 
		$dia=$dia+$dias; 
		$fecha=date( "Y-m-d", mktime(0,0,0,$mes,$dia,$ano) );
		$fecha_2=$fecha.' 00:00:00';
		return $fecha; 
	}
	
	function get_restaurantes()
	{
		$query =
		"
			SELECT rr.*, r.*, muu.fichero as fichero
			FROM restaurante r
			JOIN detalle_restaurante rr ON rr.id_restaurante = r.id_restaurante
			
			LEFT JOIN (	SELECT mm.*, rr.id_restaurante
						FROM rel_restaurante_multimedia rr
						JOIN multimedia mm ON mm.id_multimedia = rr.id_multimedia
						WHERE mm.destacado = 2 AND mm.fichero IS NOT NULL) muu ON muu.id_restaurante = r.id_restaurante
			
			WHERE r.id_estado = 1
			GROUP BY r.id_restaurante
			ORDER BY r.destacado ASC, r.creado DESC
		";
		return $this->db->query($query)->result();
	}
	
	function get_restaurante_url($url)
	{
		$query =
		"
			SELECT rr.*, r.*, group_concat(muu.fichero SEPARATOR ', ') as fichero
			FROM restaurante r
			JOIN detalle_restaurante rr ON rr.id_restaurante = r.id_restaurante
			
			LEFT JOIN (	SELECT mm.*, rr.id_restaurante
						FROM rel_restaurante_multimedia rr
						JOIN multimedia mm ON mm.id_multimedia = rr.id_multimedia
						WHERE mm.destacado = 2 AND mm.fichero IS NOT NULL) muu ON muu.id_restaurante = r.id_restaurante
			
			WHERE r.id_estado = 1 AND rr.url = ".$this->db->escape($url)."
			GROUP BY r.id_restaurante
			ORDER BY r.creado DESC
		";
		return $this->db->query($query)->first_row();
	}
	
}
