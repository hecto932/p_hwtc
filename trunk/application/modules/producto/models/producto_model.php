<?php

class Producto_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}

	function create($data)
	{
		$this->db->insert('producto',$data);
		return $this->db->insert_id();
	}

	function get($id, $idioma=''){
		$this->db->select('producto.*, detalle_producto.*, producto.id_producto as id_producto');
		$this->db->join('detalle_producto', 'detalle_producto.id_detalle_producto = producto.id_producto');
		if($idioma != ''){
			$this->db->join('idioma', 'detalle_producto.id_idioma = idioma.id_idioma');
			$this->db->where('idioma.idioma', $idioma);
		}
		$this->db->where('producto.id_producto', $id);
		$query = $this->db->get('producto');
		return $query->row();
	}
	
	function read_producto($id)
	{
		$this->db->select('producto.ean, detalle_producto.nombre, producto.id_producto as id_producto');
		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
		$this->db->where('producto.id_producto', $id);
		$q=$this->db->get('producto');
		return $q->row();
	}

	function read($id, $id_detalle_producto='', $idioma='')
	{
		$this->db->select('	producto.*,detalle_producto.*, producto.id_producto as id_producto, 
							group_concat(m1.fichero) as ficheros1, group_concat(m2.fichero) as ficheros2,
							detalle_categoria.nombre as categoria, categoria.id_tipo_cat');
							
		if ($id_detalle_producto!='') $this->db->where('detalle_producto.id_detalle_producto',$id_detalle_producto);
		
		//OJO
		$this->db->join('detalle_categoria', 'detalle_categoria.id_categoria = producto.id_categoria', 'LEFT');
		
		//OJO
		$this->db->join('categoria', 'categoria.id_categoria = producto.id_categoria', 'LEFT');
		
		$this->db->join('rel_producto_multimedia', 'producto.id_producto = rel_producto_multimedia.id_producto', 'left');
		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto','left');
		$this->db->join('multimedia m1', 'm1.id_multimedia = rel_producto_multimedia.id_multimedia AND m1.destacado = 1', 'left');
		$this->db->join('multimedia m2', 'm2.id_multimedia = rel_producto_multimedia.id_multimedia AND m2.destacado = 2', 'left');
		$this->db->where('producto.id_producto', $id);
		$q=$this->db->get('producto');
		$result = $q->result();
		foreach ($result as $k => $producto)
		{
			if (strlen($producto->ficheros1))
				$result[$k]->ficheros1 = explode(",",$producto->ficheros1);
			if (strlen($producto->ficheros2))
				$result[$k]->ficheros2 = explode(",",$producto->ficheros2);
		}
		$result = $result[0];
		return $result;
	}

	function get_posts($num_posts, $orden = 'desc', $donde = array()){
		$this->db->select('producto.id_producto as id, detalle_producto.id_idioma, producto.creado as fecha_creacion, detalle_producto.nombre as nombre, detalle_producto.url as url, detalle_producto.titulo_pagina as titulo_pagina, detalle_producto.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_producto', 'producto.id_producto = detalle_producto.id_producto');
		$this->db->join('rel_producto_multimedia', 'rel_producto_multimedia.id_producto = producto.id_producto', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_producto_multimedia.id_multimedia', 'left');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('producto.creado', $orden);
		$query = $this->db->get('producto', $num_posts);
		return $query->result();
	}
	
	function get_posts_economicas($num_posts, $orden = 'desc', $donde = array())
	{
		$this->db->select('producto.id_producto as id, producto.creado as fecha_creacion, producto.seccion as seccion, detalle_producto.nombre as nombre, detalle_producto.url as url, detalle_producto.titulo_pagina as titulo_pagina, detalle_producto.descripcion_breve as descripcion_breve, multimedia.fichero');
		$this->db->join('detalle_producto', 'producto.id_producto = detalle_producto.id_producto');
		$this->db->join('rel_producto_multimedia', 'rel_producto_multimedia.id_producto = producto.id_producto', 'left');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_producto_multimedia.id_multimedia', 'left');
		$this->db->where('seccion','economia');
		$this->db->or_where('seccion','ambas');
		if(!empty($donde)){
			foreach($donde as $condicion => $valor){
				$this->db->where($condicion, $valor);
			}
		}
		$this->db->order_by('producto.creado', $orden);
		$query = $this->db->get('producto', $num_posts);
		return $query->result();
	}

	function get_last_five_post(){
		$this->db->select('producto.id_producto as id, detalle_producto.nombre as nombre, detalle_producto.url as url, detalle_producto.titulo_pagina as titulo_pagina');
		$this->db->join('detalle_producto', 'producto.id_producto = detalle_producto.id_producto');
		$this->db->order_by('producto.creado','desc');
		$query = $this->db->get('producto', 5);
		return $query->result();
	}

	function get_image($id_producto)
	{
		$this->db->select('multimedia.*');
		//$this->db->join('rel_producto_multimedia', 'rel_producto_multimedia.id_producto = producto.id_producto');
		$this->db->join('multimedia', 'multimedia.id_multimedia = rel_producto_multimedia.id_multimedia');
		//$this->db->where('producto.id_producto', $id_producto);
		$q=$this->db->get('rel_producto_multimedia');

	}

	function detalles($id_producto, $id_detalle = '', $idioma = ''){
		$this->db->join('detalle_producto','producto.id_producto = detalle_producto.id_producto');
		if($id_detalle != '')
		{
			$this->db->where('detalle_producto.id_idioma', $id_detalle);
		}
		if($idioma != '')
		{
			$this->db->where('detalle_producto.id_idioma', $idioma);
		}
		$this->db->where('producto.id_producto',$id_producto);
		$q=$this->db->get('producto');
		return $q->result();
	}

	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
		$this->db->where('detalle_producto.id_idioma',$idioma);
		$q=$this->db->get('producto');
		return $q->result();
	}

	function get_all_years($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
		$this->db->where('detalle_producto.id_idioma',$idioma);
		$this->db->distinct();
		$this->db->select('YEAR(`creado`) as year');
		$this->db->order_by('creado','desc');
		$q=$this->db->get('producto');
		return $q->result_array();
	}

	function get_list($f='producto.id_producto',$v=1,$group=false){

		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('producto.id_producto');
		$q=$this->db->get('producto');
		return $q->result();
	}

	function get_page($start = 0, $count = 10, $order_field='producto.id_producto', $order_dir = 'desc', $call = 'back', $terminos_busqueda = array())
	{
		
		switch ($order_field)
		{
			case 'id_producto';
				$order_field='producto.id_producto';
			break;
			default :
				$order_field=$order_field;
			break;
		}
		
		$this->db->select('producto.*,detalle_producto.*, producto.id_producto as id_producto, detalle_categoria.nombre as nombre_categoria, group_concat(m1.fichero) as ficheros1, group_concat(m2.fichero) as ficheros2');
		
		if($call == 'back')
			$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto','left');
		else
			$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');

		$this->db->join('rel_producto_multimedia', 'producto.id_producto = rel_producto_multimedia.id_producto', 'left');
		$this->db->join('detalle_categoria', 'producto.id_categoria = detalle_categoria.id_categoria');
		$this->db->join('multimedia m1', 'm1.id_multimedia = rel_producto_multimedia.id_multimedia AND m1.destacado = 1', 'left');
		$this->db->join('multimedia m2', 'm2.id_multimedia = rel_producto_multimedia.id_multimedia AND m2.destacado = 2', 'left');
		
		if (!empty($terminos_busqueda))
		{
			foreach($terminos_busqueda as $field=>$value)
			{
				if (($field=='producto.id_producto' || $field=='detalle_producto.id_idioma') && $value!='')
				{
					$this->db->where($field,$value);
                }elseif ($field=='texto' && $value!='')
                {
                    $this->db->where("(detalle_producto.descripcion_breve LIKE '%$value%' OR detalle_producto.nombre LIKE '%$value%' OR detalle_producto.descripcion_ampliada LIKE '%$value%')");
				}else
				{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('producto.id_producto');
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('producto',$count,$start);

		$result = $q->result();
		
		foreach ($result as $k => $producto)
		{
			if (strlen($producto->ficheros1))
				$result[$k]->ficheros1 = explode(",",$producto->ficheros1);
			if (strlen($producto->ficheros2))
				$result[$k]->ficheros2 = explode(",",$producto->ficheros2);
		}
		
		return $result;
	}

	function get_categorias_productos($order_field='producto.id_producto', $order_dir = 'desc')
	{
		switch ($order_field)
		{
			case 'id_producto';
				$order_field='producto.id_producto';
			break;
			default :
				$order_field=$order_field;
			break;
		}
		
		$this->db->select('detalle_categoria.id_categoria as id_categoria, detalle_categoria.nombre as categoria, group_concat(detalle_producto.nombre) as productos,
						group_concat(detalle_producto.id_detalle_producto) as id_detalle_producto, group_concat(producto.id_producto) as id_producto',FALSE);
		
		$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
		$this->db->join('detalle_categoria', 'producto.id_categoria = detalle_categoria.id_categoria');
		
		$this->db->where('producto.id_estado','1');
		$this->db->group_by($order_field);
		$this->db->order_by($order_field,$order_dir);
		$q=$this->db->get('producto');
		
		$result = $q->result();
		
		foreach ($result as $k => $producto)
		{
			if (strlen($producto->productos))
				$result[$k]->productos = explode(",",$producto->productos);
			if (strlen($producto->id_detalle_producto))
				$result[$k]->id_detalle_producto = explode(",",$producto->id_detalle_producto);
			if (strlen($producto->id_producto))
				$result[$k]->id_producto = explode(",",$producto->id_producto);
		}
		//die_pre($result);
		return $result;
	}

	function count_all($terminos_busqueda=array(), $call = 'back'){
		$this->db->select('count(*) as num_productos');
		if($call != 'back'){
			$this->db->join('detalle_producto', 'detalle_producto.id_producto = producto.id_producto');
		}
		else{
			if (!empty($terminos_busqueda)){
				foreach($terminos_busqueda as $field=>$value){
					if ($field=='producto.id_producto' && $value!=''){
						$this->db->where($field,$value);

	                }elseif ($field=='texto' && $value!=''){
	                    $this->db->join('detalle_producto','detalle_producto.id_producto=producto.id_producto');
						$this->db->where("(detalle_producto.descripcion_breve LIKE '%$value%' OR detalle_producto.nombre LIKE '%$value%' OR detalle_producto.descripcion_ampliada LIKE '%$value%')");
					}else{
						if ($value!='' && !is_array($value))
							$this->db->like($field,$value);
					}
				}
			}
		}

		//$this->db->group_by('producto.id_producto');
		$q=$this->db->get('producto');
		//echo $this->db->last_query();
		$ret=$q->row();
		return $ret->num_productos;
	}

	function update($data)
	{
		if (isset($data['id_producto']))
			$producto=$this->read($data['id_producto']);
			
		if (!empty($producto))
		{
			$this->db->where('id_producto',$data['id_producto']);
			$this->db->update('producto',$data);
			$id=$data['id_producto'];
		}else
		{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('producto',$data);
			$id=$this->db->insert_id();
		}

		return $id;
	}

	function update_idioma($data)
	{
		$d=array('id_idioma'=>$data['id_idioma'],'id_producto'=>$data['id_producto']);
		
		if (isset($data['id_detalle_producto']) && $ob=$this->exists('detalle_producto',$d)){
			if (isset($data['id_detalle_producto'])){
				$this->db->where('id_detalle_producto',$data['id_detalle_producto']);
				$id=$data['id_detalle_producto'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_producto;
			}
			$this->db->update('detalle_producto',$data);

		}else{
			unset($data['id_detalle_producto']);
			$this->db->insert('detalle_producto',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}

	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','producto','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('producto', array('id_producto' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado'] = 3;
		$this->db->where('id_producto',$id);
		return $this->db->update('producto',$data);
	}

	function eliminar_idioma($id){
		if ($this->db->delete('detalle_producto', array('id_detalle_producto' => $id)))
			return true;
		else return false;
	}

	function exists($table,$key=array()){

		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}

	function get_producto_titulos_urls(){
		$this->db->select('producto.id_producto as id, detalle_producto.nombre as nombre, detalle_producto.url as url');
		$this->db->join('detalle_producto', 'producto.id_producto = detalle_producto.id_producto');
		$query = $this->db->get('producto');
		return $query->result();
	}

	function guardar_rel_imagen($data){
		$this->db->insert('rel_producto_multimedia', $data);
	}

	function guardar_imagen($data){
		$this->db->insert('multimedia', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	function get_id_from_url($url){
		$this->db->select('detalle_producto.id_producto');
		$this->db->where('detalle_producto.url', $url);
		$query = $this->db->get('detalle_producto');
		return $query->row()->id_producto;
	}

	function get_productos_fecha($fecha1='', $fecha2='', $id_idioma=1)
	{
		$producto_total = array();
		$i=1;
		while(($fecha1<=$fecha2)&&($i<=5))
		{
			$this->db->select('producto.*, detalle_producto.id_detalle_producto, detalle_producto.nombre, detalle_producto.id_idioma, detalle_producto.subtitulo, detalle_producto.url,
			detalle_producto.descripcion_breve, detalle_producto.descripcion_ampliada, detalle_producto.id_idioma, detalle_producto.descripcion_breve,
			detalle_producto.descripcion_pagina, detalle_producto.keywords, detalle_producto.titulo_pagina, multimedia.fichero');
			$this->db->join('detalle_producto','producto.id_producto=detalle_producto.id_producto');
			$this->db->join('rel_producto_multimedia', 'producto.id_producto = rel_producto_multimedia.id_producto', 'left');
			$this->db->join('multimedia', 'multimedia.id_multimedia = rel_producto_multimedia.id_multimedia', 'left');
		    $this->db->where('producto.id_estado', '1');	
			$this->db->like('producto.creado', $fecha1);
			$this->db->like('detalle_producto.id_idioma', $id_idioma);
			$this->db->group_by('producto.id_producto');
			$this->db->order_by('producto.creado','DESC');
			$producto = $this->db->get('producto')->result();
			
			$producto_total = array_merge($producto_total,$producto);
			$fecha1= $this->operacion_fecha($fecha1, '1');
			if(count($producto)==1)
			$i=$i+1;
		}
	
		//die("<pre>".print_r($producto_total, TRUE). $this->db->last_query() ."</pre>");
		return $producto_total;
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
		FROM producto p
		JOIN detalle_producto dp ON dp.id_producto = p.id_producto
		WHERE dp.id_idioma = 1
		ORDER BY p.id_categoria, dp.nombre
		*/
		$this->db->join('detalle_producto dp', 'dp.id_producto = p.id_producto');
		$this->db->where('dp.id_idioma', 1);
		$this->db->order_by('dp.nombre');
		return $this->db->get('producto p')->result();
	}
	
	function get_productos_categoria($id_categoria, $select = FALSE)
	{
		if($select) $this->db->select('p.id_producto, dp.nombre');
		
		$this->db->where('p.id_categoria', $id_categoria);
		$this->db->join('detalle_producto dp', 'dp.id_producto = p.id_producto');
		return $this->db->get('producto p')->result();
	}
	
	/*
	 * Obtener productos destacados
	 *  
	 * */
	function get_productos_destacados($limit = 2, $destacado = 1)
	{
		$this->db->join('detalle_producto dp', 'dp.id_producto = p.id_producto');
		$this->db->join('rel_producto_multimedia r_mult', 'r_mult.id_producto = p.id_producto', 'LEFT');
		$this->db->join('multimedia mult', 'mult.id_multimedia = r_mult.id_multimedia AND mult.destacado = 1', 'LEFT');
		
		$this->db->where('p.destacado >=', $destacado);
		
		$this->db->limit($limit);
		$this->db->order_by('p.destacado, dp.nombre');
		return $this->db->get('producto p')->result();
	}
	
	/*
	 * Obtener productos de una categoria, y sus imagen principal
	 * 
	 * */
	function get_rel_productos_categoria($id_categoria)
	{
		$this->db->join('detalle_producto dp', 'dp.id_producto = p.id_producto');
		$this->db->join('rel_producto_multimedia mp', 'mp.id_producto = p.id_producto', 'LEFT');
		$this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia AND m.destacado = 1', 'LEFT');
		$this->db->where('p.id_categoria', $id_categoria);
		return $this->db->get('producto p')->result();
	}
	
	/*
	 * Obtener los datos de un producto
	 * 
	 * */
	function get_datos_producto($id_producto)
	{
		$this->db->join('detalle_producto dp', 'dp.id_producto = p.id_producto');
		$this->db->join('rel_producto_multimedia mp', 'mp.id_producto = p.id_producto', 'LEFT');
		$this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia AND m.destacado = 1', 'LEFT');
		$this->db->where('p.id_producto', $id_producto);
		return $this->db->get('producto p')->result();
	}

	function get_id_producto_url($url)
	{
		$this->db->where('dp.url', $url);
		
		$query 		= $this->db->get('detalle_producto dp');
		$resultado 	= $query->result();
		
		if($query->num_rows() > 0)
		{
			return $resultado[0]->id_producto;
		}
		else
		{
			return FALSE;
		}
	}
}
