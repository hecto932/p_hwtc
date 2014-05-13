<?php

class Idioma_model extends CI_Model {

	function get_from_id($id)
	{
		$this->db->from('idioma')->where('id_idioma',$id);
		$q=$this->db->get();
		$r=$q->row();
		return $r;
	}
	function get_from_code($code)
	{
		$this->db->from('idioma')->where('idioma',$code);
		$q=$this->db->get();
		$r=$q->row();
		return $r;
	}
	function get_from_nombre($nombre)
	{
		$this->db->from('idioma')->where('nombre',$nombre);
		$q=$this->db->get();
		$r=$q->row();
		return $r;
	}
	function get_all()
	{
		$q=$this->db->get('idioma');
		$r=$q->result();
		return $r;
	}
	function delete($id){
		$q=$this->db->delete('idioma', array('id_idioma' => $id));
	}
}
