<?php

class Promocion_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}

	function create($data)
	{
		$this->db->insert('promocion',$data);
		return $this->db->insert_id();
	}

	function get($id, $idioma=''){
		$this->db->select('promocion.*, detalle_promocion.*, promocion.id_promocion as id_promocion');
		$this->db->join('detalle_promocion', 'detalle_promocion.id_detalle_promocion = promocion.id_promocion');
		if($idioma != ''){
			$this->db->join('idioma', 'detalle_promocion.id_idioma = idioma.id_idioma');
			$this->db->where('idioma.idioma', $idioma);
		}
		$this->db->where('promocion.id_promocion', $id);
		$query = $this->db->get('promocion');
		return $query->row();
	}

	function read($id, $id_detalle_promocion='', $idioma='')
	{
		$this->db->select('promocion.*,detalle_promocion.*,promocion.id_promocion as id_promocion, multimedia.fichero');
		if ($id_detalle_promocion!='') $this->db->where('detalle_promocion.id_detalle_promocion',$id_detalle_promocion);
		$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion','left');
		$this->db->join('rel_promocion_multimedia', 'rel_promocion_multimedia.id_promocion = promocion.id_promocion', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia', 'left');
		$this->db->where('promocion.id_promocion', $id);
		$q=$this->db->get('promocion');
		return $q->row();
	}

	function get_posts($num_posts, $orden = 'desc', $donde = array()){
		$this->db->select('promocion.id_promocion as id, detalle_promocion.id_idioma, promocion.creado as fecha_creacion, detalle_promocion.nombre as nombre, detalle_promocion.url as url, detalle_promocion.titulo_pagina as titulo_pagina, detalle_promocion.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_promocion', 'promocion.id_promocion = detalle_promocion.id_promocion');
		$this->db->join('rel_promocion_multimedia', 'rel_promocion_multimedia.id_promocion = promocion.id_promocion', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia', 'left');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('promocion.creado', $orden);
		$query = $this->db->get('promocion', $num_posts);
		return $query->result();
	}
	
	function get_posts_economicas($num_posts, $orden = 'desc', $donde = array())
	{
		$this->db->select('promocion.id_promocion as id, promocion.creado as fecha_creacion, promocion.seccion as seccion, detalle_promocion.nombre as nombre, detalle_promocion.url as url, detalle_promocion.titulo_pagina as titulo_pagina, detalle_promocion.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_promocion', 'promocion.id_promocion = detalle_promocion.id_promocion');
		$this->db->join('rel_promocion_multimedia', 'rel_promocion_multimedia.id_promocion = promocion.id_promocion', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia', 'left');
		$this->db->where('seccion','economia');
		$this->db->or_where('seccion','ambas');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('promocion.creado', $orden);
		$query = $this->db->get('promocion', $num_posts);
		return $query->result();
	}

	function get_last_five_post(){
		$this->db->select('promocion.id_promocion as id, detalle_promocion.nombre as nombre, detalle_promocion.url as url, detalle_promocion.titulo_pagina as titulo_pagina');
		$this->db->join('detalle_promocion', 'promocion.id_promocion = detalle_promocion.id_promocion');
		$this->db->order_by('promocion.creado','desc');
		$query = $this->db->get('promocion', 5);
		return $query->result();
	}

	function get_image($id_promocion)
	{
		$this->db->select('multimedia.*');
		//$this->db->join('rel_promocion_multimedia', 'rel_promocion_multimedia.id_promocion = promocion.id_promocion');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia');
		//$this->db->where('promocion.id_promocion', $id_promocion);
		$q=$this->db->get('rel_promocion_multimedia');

	}

	function detalles($id_promocion, $id_detalle = '', $idioma = ''){
		$this->db->join('detalle_promocion','promocion.id_promocion = detalle_promocion.id_promocion');
		if($id_detalle != '')
		{
			$this->db->where('detalle_promocion.id_idioma', $id_detalle);
		}
		if($idioma != '')
		{
			$this->db->where('detalle_promocion.id_idioma', $idioma);
		}
		$this->db->where('promocion.id_promocion',$id_promocion);
		$q=$this->db->get('promocion');
		return $q->result();
	}

	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion');
		$this->db->where('detalle_promocion.id_idioma',$idioma);
		$q=$this->db->get('promocion');
		return $q->result();
	}

	function get_all_years($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion');
		$this->db->where('detalle_promocion.id_idioma',$idioma);
		$this->db->distinct();
		$this->db->select('YEAR(`creado`) as year');
		$this->db->order_by('creado','desc');
		$q=$this->db->get('promocion');
		return $q->result_array();
	}

	function get_list($f='promocion.id_promocion',$v=1,$group=false){

		$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('promocion.id_promocion');
		$q=$this->db->get('promocion');
		return $q->result();
	}

	function get_page($start = 0, $count = 10, $order_field='promocion.id_promocion', $order_dir = 'desc', $call = 'back', $terminos_busqueda = array())
	{
		switch ($order_field)
		{
			case 'id_promocion';
				$order_field='promocion.id_promocion';
			break;
			default :
				$order_field=$order_field;
			break;
		}


		$this->db->select('promocion.*,detalle_promocion.*, promocion.id_promocion as id_promocion, multimedia.fichero');
		
		if($call == 'back')
			$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion','left');
		else
			$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion');

		$this->db->join('rel_promocion_multimedia', 'promocion.id_promocion = rel_promocion_multimedia.id_promocion', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia', 'left');
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='promocion.id_promocion' || $field=='detalle_promocion.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
                }elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_promocion.descripcion_breve LIKE '%$value%' OR detalle_promocion.nombre LIKE '%$value%' OR detalle_promocion.descripcion_ampliada LIKE '%$value%')");
				}else
				{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('promocion.id_promocion');
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('promocion',$count,$start);

		return $q->result();
	}
	
	function count_all($terminos_busqueda=array(), $call = 'back'){
		$this->db->select('count(*) as num_promocions');
		if($call != 'back'){
			$this->db->join('detalle_promocion', 'detalle_promocion.id_promocion = promocion.id_promocion');
		}
		else{
			if (!empty($terminos_busqueda)){
				foreach($terminos_busqueda as $field=>$value){
					if ($field=='promocion.id_promocion' && $value!=''){
						$this->db->where($field,$value);

	                }elseif ($field=='texto' && $value!=''){
	                    $this->db->join('detalle_promocion','detalle_promocion.id_promocion=promocion.id_promocion');
						$this->db->where("(detalle_promocion.descripcion_breve LIKE '%$value%' OR detalle_promocion.nombre LIKE '%$value%' OR detalle_promocion.descripcion_ampliada LIKE '%$value%')");
					}else{
						if ($value!='' && !is_array($value))
							$this->db->like($field,$value);
					}
				}
			}
		}

		//$this->db->group_by('promocion.id_promocion');
		$q=$this->db->get('promocion');
		//echo $this->db->last_query();
		$ret=$q->row();
		return $ret->num_promocions;
	}
	
	function get_page_subscriptores($start = 0, $count = 10, $order_field='subscriptor.id_subscriptor', $order_dir = 'desc', $terminos_busqueda = array())
	{
		switch ($order_field)
		{
			case 'id_subscriptor';
				$order_field='subscriptor.id_subscriptor';
			break;
			
			default :
				$order_field = $order_field;
			break;
		}

		$this->db->select('subscriptor.*, estado.estado');
		$this->db->join('estado', 'estado.id_estado = subscriptor.id_estado');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if ($field == 'texto' && $value != '')
				{
					$this->db->where("(subscriptor.nombre LIKE '%$value%' OR subscriptor.apellido LIKE '%$value%' OR subscriptor.email LIKE '%$value%')");
				}
				else
				{
					if ($value!='' && !is_array($value)) $this->db->like($field,$value);
				}
			}
		}
		
		$this->db->group_by('subscriptor.id_subscriptor');
		$this->db->order_by($order_field, $order_dir);
		$q = $this->db->get('subscriptor', $count, $start);

		return $q->result();
	}

	
	function count_all_subscriptores($terminos_busqueda = array())
	{
		$this->db->select('count(*) as num_subscriptores');

		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if ($field == 'texto' && $value != '')
				{
					$this->db->where("(subscriptor.nombre LIKE '%$value%' OR subscriptor.apellido LIKE '%$value%' OR subscriptor.email LIKE '%$value%')");
				}
				else
				{
					if ($value!='' && !is_array($value)) $this->db->like($field,$value);
				}
			}
		}

		$q = $this->db->get('subscriptor');
		$ret = $q->row();
		return $ret->num_subscriptores;
	}
	
	function get_subscriptor($id_subscriptor)
	{
		$this->db->where('id_subscriptor', $id_subscriptor);
		return $this->db->get('subscriptor')->first_row();
	}
	
	function get_subscriptor_email($email)
	{
		$this->db->where('email', $email);
		return $this->db->get('subscriptor')->first_row();
	}
	
	function get_listado_subscriptores()
	{
		$this->db->where('s.id_estado', 1);
		return $this->db->get('subscriptor s')->result();
	}
	
	function update_subscriptor($id_subscriptor, $data_update)
	{
		$this->db->where('id_subscriptor', $id_subscriptor);
		$this->db->update('subscriptor', $data_update);
	}
	
	function delete_subscriptor($id)
	{
		$data['id_estado'] = 3;
		$this->db->where('id_subscriptor',$id);
		return $this->db->update('subscriptor',$data);
	}
	
	function update($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';
		if (isset($data['id_promocion'])){
			$promocion=$this->read($data['id_promocion']);
		}
		//echo '<pre>'.print_r($promocion,true).'</pre>';
		if (!empty($promocion)){
			$this->db->where('id_promocion',$data['id_promocion']);
			$this->db->update('promocion',$data);
			$id=$data['id_promocion'];
		}else{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('promocion',$data);
			$id=$this->db->insert_id();
		}

		return $id;
	}

	function update_idioma($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';
		$d=array('id_idioma'=>$data['id_idioma'],'id_promocion'=>$data['id_promocion']);
		
		if (isset($data['id_detalle_promocion']) && $ob=$this->exists('detalle_promocion',$d)){
			if (isset($data['id_detalle_promocion'])){
				$this->db->where('id_detalle_promocion',$data['id_detalle_promocion']);
				$id=$data['id_detalle_promocion'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_promocion;
			}
			$this->db->update('detalle_promocion',$data);

		}else{
			unset($data['id_detalle_promocion']);
			$this->db->insert('detalle_promocion',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}

	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','promocion','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('promocion', array('id_promocion' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado'] = 3;
		$this->db->where('id_promocion',$id);
		return $this->db->update('promocion',$data);
	}

	function eliminar_idioma($id){
		if ($this->db->delete('detalle_promocion', array('id_detalle_promocion' => $id)))
			return true;
		else return false;
	}

	function exists($table,$key=array()){

		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}

	function get_promocion_titulos_urls(){
		$this->db->select('promocion.id_promocion as id, detalle_promocion.nombre as nombre, detalle_promocion.url as url');
		$this->db->join('detalle_promocion', 'promocion.id_promocion = detalle_promocion.id_promocion');
		$query = $this->db->get('promocion');
		return $query->result();
	}

	function guardar_rel_imagen($data){
		$this->db->insert('rel_promocion_multimedia', $data);
	}

	function guardar_imagen($data){
		$this->db->insert('multimedia', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function get_id_from_url($url){
		$this->db->select('detalle_promocion.id_promocion');
		$this->db->where('detalle_promocion.url', $url);
		$query = $this->db->get('detalle_promocion');
		return $query->row()->id_promocion;
	}

	function get_promocions_fecha($fecha1='', $fecha2='', $id_idioma=1)
	{
		$promocion_total = array();
		$i=1;
		while(($fecha1<=$fecha2)&&($i<=5))
		{
			$this->db->select('promocion.*, detalle_promocion.id_detalle_promocion, detalle_promocion.nombre, detalle_promocion.id_idioma, detalle_promocion.subtitulo, detalle_promocion.url,
			detalle_promocion.descripcion_breve, detalle_promocion.descripcion_ampliada, detalle_promocion.id_idioma, detalle_promocion.descripcion_breve,
			detalle_promocion.descripcion_pagina, detalle_promocion.keywords, detalle_promocion.titulo_pagina, multimedia.fichero');
			$this->db->join('detalle_promocion','promocion.id_promocion=detalle_promocion.id_promocion');
			$this->db->join('rel_promocion_multimedia', 'promocion.id_promocion = rel_promocion_multimedia.id_promocion', 'left');
			$this->db->join('multimedia', 'multimedia.id_multimedia = rel_promocion_multimedia.id_multimedia', 'left');
		    $this->db->where('promocion.id_estado', '1');	
			$this->db->like('promocion.creado', $fecha1);
			$this->db->like('detalle_promocion.id_idioma', $id_idioma);
			$this->db->group_by('promocion.id_promocion');
			$this->db->order_by('promocion.creado','DESC');
			$promocion = $this->db->get('promocion')->result();
			
			$promocion_total = array_merge($promocion_total,$promocion);
			$fecha1= $this->operacion_fecha($fecha1, '1');
			if(count($promocion)==1)
			$i=$i+1;
		}
	
		//die("<pre>".print_r($promocion_total, TRUE). $this->db->last_query() ."</pre>");
		return $promocion_total;
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
	
    function ultimas_promociones()
    {
        $this->db->order_by('p.creado DESC');
        $this->db->limit(10);
        $this->db->where('p.id_estado', 1);
        $this->db->join('detalle_promocion pp', 'p.id_promocion = pp.id_promocion');
        return $this->db->get('promocion p')->result();
    }
	
	function get_promociones()
	{
		/*
		$this->db->order_by('p.creado DESC');
		$this->db->where('p.destacado', 1);
        $this->db->where('p.id_estado', 1);
        $this->db->join('detalle_promocion pp', 'p.id_promocion = pp.id_promocion');
        return $this->db->get('promocion p')->result();
		*/
		
		$query =
		"
			SELECT pp.*, p.*, mu.fichero as fichero
			FROM promocion p
			JOIN detalle_promocion pp ON pp.id_promocion = p.id_promocion
			
			LEFT JOIN (	SELECT m.*, r.id_promocion
						FROM rel_promocion_multimedia r
						JOIN multimedia m ON m.id_multimedia = r.id_multimedia
						WHERE m.destacado = 1) mu ON mu.id_promocion = p.id_promocion
			
			WHERE p.id_estado = 1 AND p.id_tipo_promocion = 1
			GROUP BY p.id_promocion
			ORDER BY p.destacado ASC, p.creado DESC
		";
		return $this->db->query($query)->result();
	}
	
	function get_promociones_especiales()
	{
		$query =
		"
			SELECT pp.*, p.*, mu.fichero as fichero1, muu.fichero as fichero2
			FROM promocion p
			JOIN detalle_promocion pp ON pp.id_promocion = p.id_promocion
			
			LEFT JOIN (	SELECT m.*, r.id_promocion
						FROM rel_promocion_multimedia r
						JOIN multimedia m ON m.id_multimedia = r.id_multimedia
						WHERE m.destacado = 1) mu ON mu.id_promocion = p.id_promocion
			
			LEFT JOIN (	SELECT mm.*, rr.id_promocion
						FROM rel_promocion_multimedia rr
						JOIN multimedia mm ON mm.id_multimedia = rr.id_multimedia
						WHERE mm.destacado = 2 AND mm.fichero IS NOT NULL
						ORDER BY mm.id_multimedia DESC) muu ON muu.id_promocion = p.id_promocion
			
			WHERE p.id_estado = 1 AND p.id_tipo_promocion = 2
			GROUP BY p.id_promocion
			ORDER BY p.destacado ASC, p.creado DESC			
		";
		return $this->db->query($query)->result();
	}
}
