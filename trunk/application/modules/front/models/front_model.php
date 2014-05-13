<?php

class Front_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('idioma') =='') $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
		$this->id_idioma = modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
	}
	
	function get_restaurantes()
	{
		$this->db->select('m.*, rr.*, r.*, m.fichero as fichero');
		$this->db->join('detalle_restaurante rr', 'rr.id_restaurante = r.id_restaurante');
		$this->db->join('rel_restaurante_multimedia re', 're.id_restaurante = r.id_restaurante', 'LEFT');
		$this->db->join('multimedia m', 'm.id_multimedia = re.id_multimedia', 'LEFT');
		$this->db->where('r.destacado', 1);
		$this->db->where('r.id_estado', 1);
		$this->db->group_by('r.id_restaurante');
		$this->db->limit('3');
		return $this->db->get('restaurante r')->result();
	}
	
	function get_list_tabla($tabla, $destacado = 0)
	{
		$this->db->join('detalle_'.$tabla.' ee', 'ee.id_'.$tabla.' = e.id_'.$tabla);
		if($destacado > 0)
			$this->db->where('e.destacado', $destacado);
		$this->db->where('e.id_estado', 1);
		$this->db->group_by('e.id_'.$tabla);
		return $this->db->get($tabla.' e')->result();
	}
	
	function get_eventos()
	{
		$this->db->join('detalle_evento ee', 'ee.id_evento = e.id_evento');
		$this->db->where('e.id_estado', 1);
		$this->db->order_by('e.destacado ASC, e.creado DESC');
		$this->db->group_by('e.id_evento');
		$this->db->limit(3);
		return $this->db->get('evento e')->result();
	}
	
	function get_servicios()
	{
		$this->db->join('detalle_servicio ee', 'ee.id_servicio = e.id_servicio');
		$this->db->where('e.id_estado', 1);
		$this->db->order_by('e.destacado ASC');
		$this->db->group_by('e.id_servicio');
		$this->db->limit(3);
		return $this->db->get('servicio e')->result();
	}
	
	function get_habitaciones()
	{
		$query =
		"
			SELECT hh.*, h.*, mu.*
			FROM habitacion h
			JOIN detalle_habitacion hh ON hh.id_habitacion = h.id_habitacion
			
			LEFT JOIN (	SELECT m.fichero, r.id_habitacion
						FROM rel_habitacion_multimedia r
						JOIN multimedia m ON m.id_multimedia = r.id_multimedia
						WHERE m.destacado = 1) mu ON mu.id_habitacion = h.id_habitacion
			
			WHERE h.id_estado = 1
			GROUP BY h.id_habitacion
		
		";
		
		return $this->db->query($query)->result();
	}

}
