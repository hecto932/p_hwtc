<?php

class Categoria_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}

	function create($data)
	{
		$this->db->insert('categoria',$data);
		return $this->db->insert_id();
	}

	function get($id, $idioma=''){
		$this->db->select('categoria.*, detalle_categoria.*, categoria.id_categoria as id_categoria');
		$this->db->join('detalle_categoria', 'detalle_categoria.id_detalle_categoria = categoria.id_categoria');
		if($idioma != ''){
			$this->db->join('idioma', 'detalle_categoria.id_idioma = idioma.id_idioma');
			$this->db->where('idioma.idioma', $idioma);
		}
		$this->db->where('categoria.id_categoria', $id);
		$query = $this->db->get('categoria');
		return $query->row();
	}

	function read($id, $id_detalle_categoria='', $idioma='')
	{
		$this->db->select('categoria.*,detalle_categoria.*,categoria.id_categoria as id_categoria');
		//$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		if ($id_detalle_categoria!='') $this->db->where('detalle_categoria.id_detalle_categoria',$id_detalle_categoria);
		$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria','left');
		//$this->db->where('detalle_categoria.id_idioma', $idioma);
		$this->db->where('categoria.id_categoria', $id);
		$q=$this->db->get('categoria');
		return $q->row();
	}

	function get_posts($num_posts, $orden = 'desc', $donde = array()){
		$this->db->select('categoria.id_categoria as id, detalle_categoria.id_idioma, categoria.creado as fecha_creacion, detalle_categoria.nombre as nombre, detalle_categoria.url as url, detalle_categoria.titulo_pagina as titulo_pagina, detalle_categoria.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_categoria', 'categoria.id_categoria = detalle_categoria.id_categoria');
		$this->db->join('rel_categoria_multimedia', 'rel_categoria_multimedia.id_categoria = categoria.id_categoria', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_categoria_multimedia.id_multimedia', 'left');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('categoria.creado', $orden);
		$query = $this->db->get('categoria', $num_posts);
		return $query->result();
	}
	
	function get_posts_economicas($num_posts, $orden = 'desc', $donde = array())
	{
		$this->db->select('categoria.id_categoria as id, categoria.creado as fecha_creacion, categoria.seccion as seccion, detalle_categoria.nombre as nombre, detalle_categoria.url as url, detalle_categoria.titulo_pagina as titulo_pagina, detalle_categoria.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_categoria', 'categoria.id_categoria = detalle_categoria.id_categoria');
		$this->db->join('rel_categoria_multimedia', 'rel_categoria_multimedia.id_categoria = categoria.id_categoria', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_categoria_multimedia.id_multimedia', 'left');
		$this->db->where('seccion','economia');
		$this->db->or_where('seccion','ambas');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('categoria.creado', $orden);
		$query = $this->db->get('categoria', $num_posts);
		return $query->result();
	}

	function get_last_five_post(){
		$this->db->select('categoria.id_categoria as id, detalle_categoria.nombre as nombre, detalle_categoria.url as url, detalle_categoria.titulo_pagina as titulo_pagina');
		$this->db->join('detalle_categoria', 'categoria.id_categoria = detalle_categoria.id_categoria');
		$this->db->order_by('categoria.creado','desc');
		$query = $this->db->get('categoria', 5);
		return $query->result();
	}

	function get_image($id_categoria)
	{
		$this->db->select('multimedia.*');
		//$this->db->join('rel_categoria_multimedia', 'rel_categoria_multimedia.id_categoria = categoria.id_categoria');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_categoria_multimedia.id_multimedia');
		//$this->db->where('categoria.id_categoria', $id_categoria);
		$q=$this->db->get('rel_categoria_multimedia');

	}

	function detalles($id_categoria, $id_detalle = '', $idioma = ''){
		$this->db->join('detalle_categoria','categoria.id_categoria = detalle_categoria.id_categoria');
		if($id_detalle != '')
		{
			$this->db->where('detalle_categoria.id_idioma', $id_detalle);
		}
		if($idioma != '')
		{
			$this->db->where('detalle_categoria.id_idioma', $idioma);
		}
		$this->db->where('categoria.id_categoria',$id_categoria);
		$q=$this->db->get('categoria');
		return $q->result();
	}

	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria');
		$this->db->where('detalle_categoria.id_idioma',$idioma);
		$q=$this->db->get('categoria');
		return $q->result();
	}

	function get_all_years($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria');
		$this->db->where('detalle_categoria.id_idioma',$idioma);
		$this->db->distinct();
		$this->db->select('YEAR(`creado`) as year');
		$this->db->order_by('creado','desc');
		$q=$this->db->get('categoria');
		return $q->result_array();
	}

	function get_list($f='categoria.id_categoria',$v=1,$group=false){

		$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('categoria.id_categoria');
		$q=$this->db->get('categoria');
		return $q->result();
	}

	function get_page($start = 0, $count = 10, $order_field='categoria.id_categoria', $order_dir = 'desc', $call = 'back', $terminos_busqueda = array())
	{
		switch ($order_field)
		{
			case 'id_categoria';
				$order_field='categoria.id_categoria';
			break;
			default :
				$order_field=$order_field;
			break;
		}

		$this->db->select('categoria.*,detalle_categoria.*, categoria.id_categoria as id_categoria, multimedia.fichero');
		
		if($call == 'back')
			$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria','left');
		else
			$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria');

		$this->db->join('rel_categoria_multimedia', 'categoria.id_categoria = rel_categoria_multimedia.id_categoria', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_categoria_multimedia.id_multimedia', 'left');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='categoria.id_categoria' || $field=='detalle_categoria.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
                }elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_categoria.descripcion_breve LIKE '%$value%' OR detalle_categoria.nombre LIKE '%$value%' OR detalle_categoria.descripcion_ampliada LIKE '%$value%')");
				}else
				{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('categoria.id_categoria');
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('categoria',$count,$start);

		return $q->result();
	}



	function count_all($terminos_busqueda=array(), $call = 'back')
	{
		$this->db->select('count(*) as num_categorias');
		if($call != 'back')
		{
			$this->db->join('detalle_categoria', 'detalle_categoria.id_categoria = categoria.id_categoria');
		}
		else
		{
			if (!empty($terminos_busqueda))
			{
				foreach($terminos_busqueda as $field=>$value)
				{
					if ($field=='categoria.id_categoria' && $value!='')
					{
						$this->db->where($field,$value);

	                }
	                elseif ($field=='texto' && $value!='')
	                {
	                    $this->db->join('detalle_categoria','detalle_categoria.id_categoria=categoria.id_categoria');
						$this->db->where("(detalle_categoria.descripcion_breve LIKE '%$value%' OR detalle_categoria.nombre LIKE '%$value%' OR detalle_categoria.descripcion_ampliada LIKE '%$value%')");
					}
					else
					{
						if ($value!='' && !is_array($value))
							$this->db->like($field,$value);
					}
				}
			}
		}

		//$this->db->group_by('categoria.id_categoria');
		$q=$this->db->get('categoria');
		//echo $this->db->last_query();
		$ret=$q->row();
		return $ret->num_categorias;
	}

	function update($data)
	{
		if (isset($data['id_categoria']))
			$categoria=$this->read($data['id_categoria']);
			
		if (!empty($categoria))
		{
			$this->db->where('id_categoria',$data['id_categoria']);
			$this->db->update('categoria',$data);
			$id=$data['id_categoria'];
		}else
		{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('categoria',$data);
			$id=$this->db->insert_id();
		}

		return $id;
	}

	function update_idioma($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';
		$d=array('id_idioma'=>$data['id_idioma'],'id_categoria'=>$data['id_categoria']);
		
		if (isset($data['id_detalle_categoria']) && $ob=$this->exists('detalle_categoria',$d)){
			if (isset($data['id_detalle_categoria'])){
				$this->db->where('id_detalle_categoria',$data['id_detalle_categoria']);
				$id=$data['id_detalle_categoria'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_categoria;
			}
			$this->db->update('detalle_categoria',$data);

		}else{
			unset($data['id_detalle_categoria']);
			$this->db->insert('detalle_categoria',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}

	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','categoria','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('categoria', array('id_categoria' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado'] = 3;
		$this->db->where('id_categoria',$id);
		return $this->db->update('categoria',$data);
	}

	function eliminar_idioma($id){
		if ($this->db->delete('detalle_categoria', array('id_detalle_categoria' => $id)))
			return true;
		else return false;
	}

	function exists($table,$key=array()){

		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}

	function get_categoria_titulos_urls(){
		$this->db->select('categoria.id_categoria as id, detalle_categoria.nombre as nombre, detalle_categoria.url as url');
		$this->db->join('detalle_categoria', 'categoria.id_categoria = detalle_categoria.id_categoria');
		$query = $this->db->get('categoria');
		return $query->result();
	}

	function guardar_rel_imagen($data){
		$this->db->insert('rel_categoria_multimedia', $data);
	}

	function guardar_imagen($data){
		$this->db->insert('multimedia', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function get_id_from_url($url){
		$this->db->select('detalle_categoria.id_categoria');
		$this->db->where('detalle_categoria.url', $url);
		$query = $this->db->get('detalle_categoria');
		return $query->row()->id_categoria;
	}

	function get_categorias_fecha($fecha1='', $fecha2='', $id_idioma=1)
	{
		$categoria_total = array();
		$i=1;
		while(($fecha1<=$fecha2)&&($i<=5))
		{
			$this->db->select('categoria.*, detalle_categoria.id_detalle_categoria, detalle_categoria.nombre, detalle_categoria.id_idioma, detalle_categoria.subtitulo, detalle_categoria.url,
			detalle_categoria.descripcion_breve, detalle_categoria.descripcion_ampliada, detalle_categoria.id_idioma, detalle_categoria.descripcion_breve,
			detalle_categoria.descripcion_pagina, detalle_categoria.keywords, detalle_categoria.titulo_pagina, multimedia.fichero');
			$this->db->join('detalle_categoria','categoria.id_categoria=detalle_categoria.id_categoria');
			$this->db->join('rel_categoria_multimedia', 'categoria.id_categoria = rel_categoria_multimedia.id_categoria', 'left');
			$this->db->join('multimedia', 'multimedia.id_multimedia = rel_categoria_multimedia.id_multimedia', 'left');
		    $this->db->where('categoria.id_estado', '1');	
			$this->db->like('categoria.creado', $fecha1);
			$this->db->like('detalle_categoria.id_idioma', $id_idioma);
			$this->db->group_by('categoria.id_categoria');
			$this->db->order_by('categoria.creado','DESC');
			$categoria = $this->db->get('categoria')->result();
			
			$categoria_total = array_merge($categoria_total,$categoria);
			$fecha1= $this->operacion_fecha($fecha1, '1');
			if(count($categoria)==1)
			$i=$i+1;
		}
	
		//die("<pre>".print_r($categoria_total, TRUE). $this->db->last_query() ."</pre>");
		return $categoria_total;
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

	function get_id_categoria_url($url)
	{
		$this->db->where('dp.url', $url);
		
		$query 		= $this->db->get('detalle_categoria dp');
		$resultado 	= $query->result();
		
		if($query->num_rows() > 0)
		{
			return $resultado[0]->id_categoria;
		}
		else
		{
			return FALSE;
		}
	}
}

