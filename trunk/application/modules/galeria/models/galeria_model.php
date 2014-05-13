<?php

class galeria_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}

	function create($data)
	{
		$this->db->insert('galeria',$data);
		return $this->db->insert_id();
	}

	function get($id, $idioma=''){
		$this->db->select('galeria.*, detalle_galeria.*, galeria.id_galeria as id_galeria');
		$this->db->join('detalle_galeria', 'detalle_galeria.id_detalle_galeria = galeria.id_galeria');
		if($idioma != ''){
			$this->db->join('idioma', 'detalle_galeria.id_idioma = idioma.id_idioma');
			$this->db->where('idioma.idioma', $idioma);
		}
		$this->db->where('galeria.id_galeria', $id);
		$query = $this->db->get('galeria');
		return $query->row();
	}
	
	function read_galeria($id)
	{
		$this->db->select('detalle_galeria.nombre, galeria.id_galeria as id_galeria');
		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
		$this->db->where('galeria.id_galeria', $id);
		$q=$this->db->get('galeria');
		return $q->row();
	}

	function read($id, $id_detalle_galeria='', $idioma='')
	{
		$this->db->select('	galeria.*,detalle_galeria.*, galeria.id_galeria as id_galeria, 
							group_concat(m1.fichero) as ficheros1, group_concat(m2.fichero) as ficheros2,
							detalle_categoria.nombre as categoria, categoria.id_tipo_cat');
							
		if ($id_detalle_galeria!='') $this->db->where('detalle_galeria.id_detalle_galeria',$id_detalle_galeria);
		
		//OJO
		$this->db->join('detalle_categoria', 'detalle_categoria.id_categoria = galeria.id_categoria', 'LEFT');
		
		//OJO
		$this->db->join('categoria', 'categoria.id_categoria = galeria.id_categoria', 'LEFT');
		
		$this->db->join('rel_galeria_multimedia', 'galeria.id_galeria = rel_galeria_multimedia.id_galeria', 'left');
		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria','left');
		$this->db->join('multimedia m1', 'm1.id_multimedia = rel_galeria_multimedia.id_multimedia AND m1.destacado = 1', 'left');
		$this->db->join('multimedia m2', 'm2.id_multimedia = rel_galeria_multimedia.id_multimedia AND m2.destacado = 2', 'left');
		$this->db->where('galeria.id_galeria', $id);
		$q=$this->db->get('galeria');
		$result = $q->result();
		foreach ($result as $k => $galeria)
		{
			if (strlen($galeria->ficheros1))
				$result[$k]->ficheros1 = explode(",",$galeria->ficheros1);
			if (strlen($galeria->ficheros2))
				$result[$k]->ficheros2 = explode(",",$galeria->ficheros2);
		}
		$result = $result[0];
		return $result;
	}

	function get_posts($num_posts, $orden = 'desc', $donde = array()){
		$this->db->select('galeria.id_galeria as id, detalle_galeria.id_idioma, galeria.creado as fecha_creacion, detalle_galeria.nombre as nombre, detalle_galeria.url as url, detalle_galeria.titulo_pagina as titulo_pagina, detalle_galeria.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_galeria', 'galeria.id_galeria = detalle_galeria.id_galeria');
		$this->db->join('rel_galeria_multimedia', 'rel_galeria_multimedia.id_galeria = galeria.id_galeria', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_galeria_multimedia.id_multimedia', 'left');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('galeria.creado', $orden);
		$query = $this->db->get('galeria', $num_posts);
		return $query->result();
	}
	
	function get_posts_economicas($num_posts, $orden = 'desc', $donde = array())
	{
		$this->db->select('galeria.id_galeria as id, galeria.creado as fecha_creacion, galeria.seccion as seccion, detalle_galeria.nombre as nombre, detalle_galeria.url as url, detalle_galeria.titulo_pagina as titulo_pagina, detalle_galeria.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_galeria', 'galeria.id_galeria = detalle_galeria.id_galeria');
		$this->db->join('rel_galeria_multimedia', 'rel_galeria_multimedia.id_galeria = galeria.id_galeria', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_galeria_multimedia.id_multimedia', 'left');
		$this->db->where('seccion','economia');
		$this->db->or_where('seccion','ambas');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('galeria.creado', $orden);
		$query = $this->db->get('galeria', $num_posts);
		return $query->result();
	}

	function get_last_five_post(){
		$this->db->select('galeria.id_galeria as id, detalle_galeria.nombre as nombre, detalle_galeria.url as url, detalle_galeria.titulo_pagina as titulo_pagina');
		$this->db->join('detalle_galeria', 'galeria.id_galeria = detalle_galeria.id_galeria');
		$this->db->order_by('galeria.creado','desc');
		$query = $this->db->get('galeria', 5);
		return $query->result();
	}

	function get_image($id_galeria)
	{
		$this->db->select('multimedia.*');
		//$this->db->join('rel_galeria_multimedia', 'rel_galeria_multimedia.id_galeria = galeria.id_galeria');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_galeria_multimedia.id_multimedia');
		//$this->db->where('galeria.id_galeria', $id_galeria);
		$q=$this->db->get('rel_galeria_multimedia');

	}

	function detalles($id_galeria, $id_detalle = '', $idioma = ''){
		$this->db->join('detalle_galeria','galeria.id_galeria = detalle_galeria.id_galeria');
		if($id_detalle != '')
		{
			$this->db->where('detalle_galeria.id_idioma', $id_detalle);
		}
		if($idioma != '')
		{
			$this->db->where('detalle_galeria.id_idioma', $idioma);
		}
		$this->db->where('galeria.id_galeria',$id_galeria);
		$q=$this->db->get('galeria');
		return $q->result();
	}

	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
		$this->db->where('detalle_galeria.id_idioma',$idioma);
		$q=$this->db->get('galeria');
		return $q->result();
	}

	function get_all_years($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
		$this->db->where('detalle_galeria.id_idioma',$idioma);
		$this->db->distinct();
		$this->db->select('YEAR(`creado`) as year');
		$this->db->order_by('creado','desc');
		$q=$this->db->get('galeria');
		return $q->result_array();
	}

	function get_list($f='galeria.id_galeria',$v=1,$group=false){

		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('galeria.id_galeria');
		$q=$this->db->get('galeria');
		return $q->result();
	}

	function get_page($start = 0, $count = 10, $order_field='galeria.id_galeria', $order_dir = 'desc', $call = 'back', $terminos_busqueda = array())
	{
		switch ($order_field)
		{
			case 'id_galeria';
				$order_field='galeria.id_galeria';
			break;
			default :
				$order_field=$order_field;
			break;
		}
		
		$this->db->select('galeria.*,detalle_galeria.*, galeria.id_galeria as id_galeria, detalle_categoria.nombre as nombre_categoria, group_concat(m1.fichero) as ficheros1, group_concat(m2.fichero) as ficheros2');
		
		if($call == 'back')
			$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria','left');
		else
			$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');

		$this->db->join('rel_galeria_multimedia', 'galeria.id_galeria = rel_galeria_multimedia.id_galeria', 'left');
		$this->db->join('detalle_categoria', 'galeria.id_categoria = detalle_categoria.id_categoria', 'left');
		$this->db->join('multimedia m1', 'm1.id_multimedia = rel_galeria_multimedia.id_multimedia AND m1.destacado = 1', 'left');
		$this->db->join('multimedia m2', 'm2.id_multimedia = rel_galeria_multimedia.id_multimedia AND m2.destacado = 2', 'left');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='galeria.destacado' || $field=='galeria.id_estado' || $field=='galeria.id_galeria' || $field=='detalle_galeria.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
					
                }elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_galeria.descripcion_breve LIKE '%$value%' OR detalle_galeria.nombre LIKE '%$value%' OR detalle_galeria.descripcion_ampliada LIKE '%$value%')");
				}else
				{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('galeria.id_galeria');
		$this->db->order_by($order_field,$order_dir);
		$q = $this->db->get('galeria',$count,$start);
		$result = $q->result();
		
		foreach ($result as $k => $galeria)
		{
			if (strlen($galeria->ficheros1))
				$result[$k]->ficheros1 = explode(",",$galeria->ficheros1);
			if (strlen($galeria->ficheros2))
				$result[$k]->ficheros2 = explode(",",$galeria->ficheros2);
		}
		
		return $result;
	}

	function get_categorias_galerias($order_field='galeria.id_galeria', $order_dir = 'desc')
	{
		switch ($order_field)
		{
			case 'id_galeria';
				$order_field='galeria.id_galeria';
			break;
			default :
				$order_field=$order_field;
			break;
		}
		
		$this->db->select('detalle_categoria.id_categoria as id_categoria, detalle_categoria.nombre as categoria, group_concat(detalle_galeria.nombre) as galerias,
						group_concat(detalle_galeria.id_detalle_galeria) as id_detalle_galeria, group_concat(galeria.id_galeria) as id_galeria',FALSE);
		
		$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
		$this->db->join('detalle_categoria', 'galeria.id_categoria = detalle_categoria.id_categoria');
		
		$this->db->where('galeria.id_estado','1');
		$this->db->group_by($order_field);
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('galeria');
		
		$result = $q->result();
		
		foreach ($result as $k => $galeria)
		{
			if (strlen($galeria->galerias))
				$result[$k]->galerias = explode(",",$galeria->galerias);
			if (strlen($galeria->id_detalle_galeria))
				$result[$k]->id_detalle_galeria = explode(",",$galeria->id_detalle_galeria);
			if (strlen($galeria->id_galeria))
				$result[$k]->id_galeria = explode(",",$galeria->id_galeria);
		}
		//die_pre($result);
		return $result;
	}

	function count_all($terminos_busqueda=array(), $call = 'back')
	{
		$this->db->select('count(*) as num_galerias');
		$this->db->join('detalle_galeria', 'detalle_galeria.id_galeria = galeria.id_galeria');

		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='galeria.destacado' || $field=='galeria.id_estado' || $field=='galeria.id_galeria' || $field=='detalle_galeria.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
					
                }elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_galeria.descripcion_breve LIKE '%$value%' OR detalle_galeria.nombre LIKE '%$value%' OR detalle_galeria.descripcion_ampliada LIKE '%$value%')");
				}else
				{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}

		//$this->db->group_by('galeria.id_galeria');
		$q=$this->db->get('galeria');
		//echo $this->db->last_query();
		//die_pre($this->db->last_query());
		$ret=$q->row();
		return $ret->num_galerias;
	}

	function update($data)
	{
		if (isset($data['id_galeria']))
			$galeria=$this->read($data['id_galeria']);
			
		if (!empty($galeria))
		{
			$this->db->where('id_galeria',$data['id_galeria']);
			$this->db->update('galeria',$data);
			$id=$data['id_galeria'];
		}else
		{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('galeria',$data);
			$id=$this->db->insert_id();
		}

		return $id;
	}

	function update_idioma($data)
	{
		$d=array('id_idioma'=>$data['id_idioma'],'id_galeria'=>$data['id_galeria']);
		
		if (isset($data['id_detalle_galeria']) && $ob=$this->exists('detalle_galeria',$d)){
			if (isset($data['id_detalle_galeria'])){
				$this->db->where('id_detalle_galeria',$data['id_detalle_galeria']);
				$id=$data['id_detalle_galeria'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_galeria;
			}
			$this->db->update('detalle_galeria',$data);

		}else{
			unset($data['id_detalle_galeria']);
			$this->db->insert('detalle_galeria',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}

	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','galeria','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('galeria', array('id_galeria' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado'] = 3;
		$this->db->where('id_galeria',$id);
		return $this->db->update('galeria',$data);
	}

	function eliminar_idioma($id){
		if ($this->db->delete('detalle_galeria', array('id_detalle_galeria' => $id)))
			return true;
		else return false;
	}

	function exists($table,$key=array()){

		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}

	function get_galeria_titulos_urls(){
		$this->db->select('galeria.id_galeria as id, detalle_galeria.nombre as nombre, detalle_galeria.url as url');
		$this->db->join('detalle_galeria', 'galeria.id_galeria = detalle_galeria.id_galeria');
		$query = $this->db->get('galeria');
		return $query->result();
	}

	function guardar_rel_imagen($data){
		$this->db->insert('rel_galeria_multimedia', $data);
	}

	function guardar_imagen($data){
		$this->db->insert('multimedia', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function get_id_from_url($url){
		$this->db->select('detalle_galeria.id_galeria');
		$this->db->where('detalle_galeria.url', $url);
		$query = $this->db->get('detalle_galeria');
		return $query->row()->id_galeria;
	}

	function get_galerias_fecha($fecha1='', $fecha2='', $id_idioma=1)
	{
		$galeria_total = array();
		$i=1;
		while(($fecha1<=$fecha2)&&($i<=5))
		{
			$this->db->select('galeria.*, detalle_galeria.id_detalle_galeria, detalle_galeria.nombre, detalle_galeria.id_idioma, detalle_galeria.subtitulo, detalle_galeria.url,
			detalle_galeria.descripcion_breve, detalle_galeria.descripcion_ampliada, detalle_galeria.id_idioma, detalle_galeria.descripcion_breve,
			detalle_galeria.descripcion_pagina, detalle_galeria.keywords, detalle_galeria.titulo_pagina, multimedia.fichero');
			$this->db->join('detalle_galeria','galeria.id_galeria=detalle_galeria.id_galeria');
			$this->db->join('rel_galeria_multimedia', 'galeria.id_galeria = rel_galeria_multimedia.id_galeria', 'left');
			$this->db->join('multimedia', 'multimedia.id_multimedia = rel_galeria_multimedia.id_multimedia', 'left');
		    $this->db->where('galeria.id_estado', '1');	
			$this->db->like('galeria.creado', $fecha1);
			$this->db->like('detalle_galeria.id_idioma', $id_idioma);
			$this->db->group_by('galeria.id_galeria');
			$this->db->order_by('galeria.creado','DESC');
			$galeria = $this->db->get('galeria')->result();
			
			$galeria_total = array_merge($galeria_total,$galeria);
			$fecha1= $this->operacion_fecha($fecha1, '1');
			if(count($galeria)==1)
			$i=$i+1;
		}
	
		//die("<pre>".print_r($galeria_total, TRUE). $this->db->last_query() ."</pre>");
		return $galeria_total;
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
	
	function get_all_products()
	{
		/*
		SELECT *
		FROM galeria p
		JOIN detalle_galeria dp ON dp.id_galeria = p.id_galeria
		WHERE dp.id_idioma = 1
		ORDER BY p.id_categoria, dp.nombre
		*/
		$this->db->join('detalle_galeria dp', 'dp.id_galeria = p.id_galeria');
		$this->db->where('dp.id_idioma', 1);
		$this->db->order_by('dp.nombre');
		return $this->db->get('galeria p')->result();
	}
	
	function get_galerias_categoria($id_categoria, $select = FALSE)
	{
		if($select) $this->db->select('p.id_galeria, dp.nombre');
		
		$this->db->where('p.id_categoria', $id_categoria);
		$this->db->join('detalle_galeria dp', 'dp.id_galeria = p.id_galeria');
		return $this->db->get('galeria p')->result();
	}
	
	/*
	 * Obtener galerias destacados
	 *  
	 * */
	function get_galerias_destacados($limit = 2, $destacado = 1)
	{
		$this->db->join('detalle_galeria dp', 'dp.id_galeria = p.id_galeria');
		$this->db->join('rel_galeria_multimedia r_mult', 'r_mult.id_galeria = p.id_galeria', 'LEFT');
		$this->db->join('multimedia mult', 'mult.id_multimedia = r_mult.id_multimedia AND mult.destacado = 1', 'LEFT');
		
		$this->db->where('p.destacado >=', $destacado);
		
		$this->db->limit($limit);
		$this->db->order_by('p.destacado, dp.nombre');
		return $this->db->get('galeria p')->result();
	}
	
	/*
	 * Obtener galerias de una categoria, y sus imagen principal
	 * 
	 * */
	function get_rel_galerias_categoria($id_categoria)
	{
		$this->db->join('detalle_galeria dp', 'dp.id_galeria = p.id_galeria');
		$this->db->join('rel_galeria_multimedia mp', 'mp.id_galeria = p.id_galeria', 'LEFT');
		$this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia AND m.destacado = 1', 'LEFT');
		$this->db->where('p.id_categoria', $id_categoria);
		return $this->db->get('galeria p')->result();
	}
	
	/*
	 * Obtener los datos de un galeria
	 * 
	 * */
	function get_datos_galeria($id_galeria)
	{
		$this->db->join('detalle_galeria dp', 'dp.id_galeria = p.id_galeria');
		$this->db->join('rel_galeria_multimedia mp', 'mp.id_galeria = p.id_galeria', 'LEFT');
		$this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia AND m.destacado = 1', 'LEFT');
		$this->db->where('p.id_galeria', $id_galeria);
		return $this->db->get('galeria p')->result();
	}
}
