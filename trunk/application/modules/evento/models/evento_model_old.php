<?php

class Evento_model extends CI_Model {
	
	function __construct(){
		parent::__construct();	
		$this->load->model('idioma/idioma_model','idioma_model');
		$this->idioma=idioma_model::get_from_code($this->session->userdata('idioma'));
	}
	function create($data)
	{
		$this->db->insert('evento',$data);
		return $this->db->insert_id();
	}
	function read($id,$id_detalle_evento='',$idioma='')
	{
		$this->db->select('categoria.id_tipo_cat, evento.*,detalle_evento.*,evento.id_evento as id_evento');
		//$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		if ($id_detalle_evento!='') $this->db->where('detalle_evento.id_detalle_evento',$id_detalle_evento);
		$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento','left');
		$this->db->join('categoria','evento.id_categoria=categoria.id_categoria');
		//$this->db->where('detalle_evento.id_idioma',$idioma);
		$this->db->where('evento.id_evento',$id);
		$this->db->group_by('evento.id_evento');
		$q=$this->db->get('evento');
		//echo $this->db->last_query();
		if ($q->num_rows()==1)
			return $q->row();
		else
			return $q->result();
	}
	function get($tabla,$id=''){
		if ($id!='') $this->db->where('id_'.$tabla,$id);
		$q=$this->db->get($tabla);
		if ($q->num_rows()==1)
			return $q->row();
		else
			return $q->result();
	}
	function detalles($id_evento){
		$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento');
		//$this->db->where('detalle_evento.id_idioma',$idioma);
		$this->db->where('evento.id_evento',$id_evento);
		//$this->db->group_by('evento.id_evento');
		$q=$this->db->get('evento');
		return $q->result();
	}
	function get_all($idioma=''){
		$idioma=(isset($idioma) && $idioma!='') ? $idioma : $this->idioma->id_idioma;
		$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento');
		$this->db->where('detalle_evento.id_idioma',$idioma);
		$q=$this->db->get('evento');
		return $q->result();
	}
	function get_list($f='evento.id_evento',$v=1,$group=false){
		
		$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento');
		$this->db->where($f,$v);
		if ($group) $this->db->group_by('evento.id_evento');
		$q=$this->db->get('evento');
		return $q->result();
	}
	function get_page($start=0,$count=10,$order_field='evento.id_evento',$order_dir='desc',$terminos_busqueda=array()){
		switch ($order_field) {
			case 'id_evento':
				$order_field='evento.id_evento';
			break;
			case 'codigo_coloplas':
				$order_field='evento.id_evento';
			break;
			case 'nombre':
				$order_field='detalle_evento.nombre';
			break;
			default :
				//$order_field='evento.id_evento';
				$order_field=$order_field;
			break;
		}
		
		
		$this->db->select('evento.*,detalle_evento.*,detalle_categoria.nombre as nombre_categoria,detalle_categoria.descripcion_breve as descripcion_categoria,evento.id_evento as id_evento');
		$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento','left');
		$this->db->join('categoria','evento.id_categoria=categoria.id_categoria');
		$this->db->join('detalle_categoria','evento.id_categoria=detalle_categoria.id_categoria','left');
		if (!empty($terminos_busqueda)){
			foreach($terminos_busqueda as $field=>$value){
				if ($field=='fecha_desde' && $value!=''){
					$this->db->where("concat(ano,'-',mes,'-',dia) >=",$value);
				}elseif ($field=='fecha_hasta' && $value!=''){
					$this->db->where("concat(ano,'-',mes,'-',dia) <=",$value);
				}elseif ($field=='evento.id_categoria' && $value!=''){
					$this->db->where($field,$value);
				}elseif ($field=='evento.id_estado' && $value!=''){
					$this->db->where($field,$value);
				}elseif ($field=='tag' && $value!=''){
					$this->db->join('rel_detalle_evento_tag','rel_detalle_evento_tag.id_detalle_evento=detalle_evento.id_detalle_evento');
					$this->db->join('tag','tag.id_tag=rel_detalle_evento_tag.id_tag');
					$this->db->like($field,$value);
				}else{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		$this->db->group_by('evento.id_evento');
		$this->db->order_by($order_field,$order_dir);
		//var_dump($order_field);
		$q=$this->db->get('evento',$count,$start);
		
		return $q->result();
	}
	function count_all($terminos_busqueda=array()){
		$this->db->select('count(*) as num_eventos');
		
		//TO-DO : Anadir where para terminos de busqueda
		if (!empty($terminos_busqueda)){
			$this->db->join('detalle_evento','evento.id_evento=detalle_evento.id_evento','left');
			$this->db->join('categoria','evento.id_categoria=categoria.id_categoria');
			$this->db->join('detalle_categoria','evento.id_categoria=detalle_categoria.id_categoria','left');

			foreach($terminos_busqueda as $field=>$value){
				if ($field=='fecha_desde'){
					$this->db->where("concat(ano,'-',mes,'-',dia) >=",$value);
				}elseif ($field=='fecha_hasta'){
					$this->db->where("concat(ano,'-',mes,'-',dia) <=",$value);
				}elseif ($field=='evento.id_categoria' && $value!=''){
					$this->db->where($field,$value);
				}elseif ($field=='evento.id_estado' && $value!=''){
					$this->db->where($field,$value);
				}elseif ($field=='tag' && $value!=''){
					$this->db->join('rel_detalle_evento_tag','rel_detalle_evento_tag.id_detalle_evento=detalle_evento.id_detalle_evento');
					$this->db->join('tag','tag.id_tag=rel_detalle_evento_tag.id_tag');
					$this->db->like($field,$value);
				}else{
					if ($value!='' && !is_array($value))
						$this->db->like($field,$value);
				}
			}
		}
		//$this->db->group_by('evento.id_evento');
		$q=$this->db->get('evento');
		//echo $this->db->last_query();
		//die();
		$ret=$q->row();
		return $ret->num_eventos;
	}
	function update($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';
		if (isset($data['id_evento'])){
			$evento=$this->read($data['id_evento']);
		}
		//echo '<pre>'.print_r($evento,true).'</pre>';
		if (!empty($evento)){
			$this->db->where('id_evento',$data['id_evento']);
			$this->db->update('evento',$data);
			$id=$data['id_evento'];
		}else{
			$data['creado']=date('Y-m-d H:i:s');
			$this->db->insert('evento',$data);
			$id=$this->db->insert_id();
		}
		
		return $id;
	}
	function update_idioma($data)
	{
		//echo '<pre>'.print_r($data,true).'</pre>';die();
		$d=array('id_idioma'=>$data['id_idioma'],'id_evento'=>$data['id_evento']);
		if (isset($data['id_detalle_evento']) || $ob=$this->exists('detalle_evento',$d)){
			if (isset($data['id_detalle_evento'])){
				$this->db->where('id_detalle_evento',$data['id_detalle_evento']);
				$id=$data['id_detalle_evento'];
			}else{
				$this->db->where($d);
				$id=$ob->id_detalle_evento;
			}
			$data['fecha'] = $data['fecha'] . " " . $data['hora'];
			//unset($data['hora']);
			$this->db->update('detalle_evento',$data);
			
		}else{
			$data['fecha'] = $data['fecha'] . " " . $data['hora'];
			//unset($data['hora']);
			$this->db->insert('detalle_evento',$data);
			$id=$this->db->insert_id();
		}
		return $id;
	}
	function delete($id){
		/*
		$imagenes=modules::run('services/relations/get_rel','evento','imagen',$id,'true');
		foreach(json_decode($imagenes) as $img){
			if (is_file(FCPATH.'assets/img/temp/'.$img->fichero)) unlink( FCPATH.'assets/img/temp/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/med/'.$img->fichero)) unlink( FCPATH.'assets/img/med/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/thumb/'.$img->fichero)) unlink( FCPATH.'assets/img/thumb/'.$img->fichero);
			if (is_file(FCPATH.'assets/img/large/'.$img->fichero)) unlink( FCPATH.'assets/img/large/'.$img->fichero);
		}
		if ($this->db->delete('evento', array('id_evento' => $id)))
			return true;
		else return false;
		*/
		$data['id_estado']=3;
		$this->db->where('id_evento',$id);
		return $this->db->update('evento',$data);
	}
	function eliminar_idioma($id){
		if ($this->db->delete('detalle_evento', array('id_detalle_evento' => $id)))
			return true;
		else return false;
	}
	function exists($table,$key=array()){
		
		$this->db->where($key);
		$q=$this->db->get($table);
		if ($q->num_rows()>=1) return $q->row();
		else return false;
	}
}
