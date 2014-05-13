<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function flip_timestamp($fecha)
{
	list($d, $m, $anio_hora) 	= explode('-', $fecha);
	list($a, $hora)				= explode(' ', $anio_hora);
	$fecha						= implode('-', array($a, $m, $d));
	$fecha						.= ' ' . $hora;
	
	return $fecha;
}


/**
 * 
 * Devuelve un array para ser pasado a form_dropdown de CI
 * 
 * @param unknown_type $result			Resultado de la consulta
 * @param unknown_type $campo_id		Id de la tabla, para el value del select
 * @param unknown_type $campo_valor		El texto del select que se muestra al usuario
 * @param unknown_type $separador		Si $campos_valor es un array, se puede utilizar separadores
 * @param unknown_type $dummy			True mostrar dummy
 * @param unknown_type $dummy_text		[-1] "Sin informacion"
 * @param unknown_type $dummy_ultimo	True el dummy sale de primero, False el dummy sale de ultimo
 */
function opt_dropdown($result, $campo_id, $campos_valor, $separador = '-', $dummy = FALSE, $dummy_text = '', $dummy_ultimo = FALSE)
{
	$dropdown = array();
	if ($dummy && ! $dummy_ultimo) $dropdown[-1] = $dummy_text;
	
	foreach ($result as $objeto)
	{
		$dropdown[$objeto->$campo_id] = '';
		
		if (is_array($campos_valor))
		{
			$size = count($campos_valor);
			for ($i = 0; $i < $size; $i++)
			{
				$dropdown[$objeto->$campo_id] .= ucwords(strtolower($objeto->$campos_valor[$i]));
				if ($i < $size-1) $dropdown[$objeto->$campo_id] .= $separador;
			}
		}
		else
		{
			$dropdown[$objeto->$campo_id] = ucwords(strtolower($objeto->$campos_valor));
		}
	}
    
    if ($dummy && $dummy_ultimo) $dropdown[-1] = $dummy_text;
		
	return $dropdown;
	
}

/**
 * 
 * Hace <pre>print_r de un array con die
 * 
 * @author Ale
 */
function die_pre($array = array())
{
    die("<pre>die_pre:<br />".print_r($array, TRUE)."<br />/die_pre</pre>");
}

function echo_pre($array = array())
{
    echo "<pre>echo_pre:<br />".print_r($array, TRUE)."<br />/echo_pre</pre>";
}
/*
 * La siguiente función se encarga de crear
 * dos arreglos desde @a hasta @b.
 *
 * */

function destacado_dropdown() {
	$array_destacado = array_combine(range(1, 100), range(1, 100));
	return $array_destacado;

}

/*	La función idioma_values se encarga
 *  de determinar el valor de un input
 * 	en el formulario de creación/edicción
 *	de detalles.
 *
 *  @set_value contiene el valor de la forma de error de CI
 * 	@accion contiene la acción que se realiza en dichos momentos
 *  @variable contiene el valor de la variable del evento
 * 	EJEMPLO:
 * 	$noticia->nombre.
 *
 * */

function idioma_values($set_value, $variable, $accion) {
	if($accion == 'normal' && $set_value == ''){
		return '';
	}
	elseif($accion == 'normal' && $set_value != ''){
		return $set_value;
	}
	elseif($accion == 'editar' && $set_value == '' && $variable != ''){
		return $variable;
	}
	else{
		return $set_value;
	}
}

/*
 *
 *
 *
 *
 * */


function get_tipo_eventos()
{
	$CI =& get_instance();
	$CI->load->model('evento/evento_model');
	$CI->config->set_item('language', 'es');
	$CI->lang->load('back');
	$tipo_eventos = array();
	$temp = $CI->evento_model->get_tipo_evento();
	foreach($temp as $value){
			$tipo_eventos[$value->id_tipo_evento] =  $CI->lang->line('eventos_tipo_'.$value->id_tipo_evento);
	}
	return $tipo_eventos;
}

function ordenar_servicios($servicios){
	
	
	
	$result = array();
	foreach($servicios as $servicio)
	{
		$result[$servicio->id_tipo_servicio][] = $servicio;
	}
	return $result;
}

function servicio_dropdown($tipo_servicio, $idioma = 'es'){
	$CI =& get_instance();
	$CI->config->set_item('language', $idioma);
	$CI->lang->load('back');
	$temp = array();
	foreach($tipo_servicio as $tipo){
			$temp[$tipo->id_tipo_servicio] = lang('servicio_'.$tipo->nombre_tipo);
	}
	return $temp;
}

/*
 *	La siguiente función obtiene la dirección
 *  de la primera imagen disponible de un objeto
 *
 *
 *
 * */

function get_dir_imagen($principal, $secundarias, $terciarias){
 	if(isset($principal) && !empty($principal))
	{
		$fichero = $principal[0]->fichero;
		$direccion = base_url().'assets/front/img/large/'.$fichero;
	}
	elseif(isset($secundarias) && !empty($secundarias))
	{
		$fichero = $secundarias[0]->fichero;
		$direccion = base_url().'assets/front/img/large/'.$fichero;
	}
	elseif(isset($terciarias) && !empty($terciarias))
	{
		$fichero = $terciarias[0]->fichero;
		$direccion = base_url().'assets/front/img/large/'.$terciarias;
	}
	else
	{
		$direccion = base_url().'assets/back/img/template/placeholder_med.jpg';
	}
	return $direccion;
}


function get_info_imagen($principal, $secundarias, $terciarias, $idioma = 'es'){
	$imagen = new stdClass();
	$CI =& get_instance();
	$CI->config->set_item('language', $idioma);
	$CI->lang->load('back');
	if(isset($principal) && !empty($principal)){
		$imagen->fichero = substr($principal[0]->fichero, 0, strpos($principal[0]->fichero,'.'));
		$imagen->extension = strtolower(substr(strrchr($principal[0]->fichero,'.'), 1));
		$imagen->dia = date("d/m/Y", strtotime($principal[0]->actualizado));
		$imagen->hora = date("H:i:s", strtotime($principal[0]->actualizado));
		$imagen->destacado = lang('imagen_t'.$principal[0]->destacado);
	}
	elseif(isset($secundarias) && !empty($secundarias)){
		$imagen->fichero = substr($secundarias[0]->fichero, 0, strpos($secundarias[0]->fichero,'.'));
		$imagen->extension = strtolower(substr(strrchr($secundarias[0]->fichero,'.'), 1));
		$imagen->dia = date("d/m/Y", strtotime($secundarias[0]->actualizado));
		$imagen->hora = date("H:i:s", strtotime($secundarias[0]->actualizado));
		$imagen->timestamp = strtotime($secundarias[0]->actualizado);
		$imagen->destacado = lang('imagen_t'.$secundarias[0]->destacado);
	}
	elseif(isset($terciarias) && !empty($terciarias)){
		$imagen->fichero = substr($terciarias[0]->fichero, 0, strpos($terciarias[0]->fichero,'.'));
		$imagen->extension = strtolower(substr(strrchr($terciarias[0]->fichero,'.'), 1));
		$imagen->dia = date("d/m/Y", strtotime($terciarias[0]->actualizado));
		$imagen->hora = date("H:i:s", strtotime($terciarias[0]->actualizado));
		$imagen->timestamp = strtotime($terciarias[0]->actualizado);
		$imagen->destacado = lang('imagen_t'.$terciarias[0]->destacado);
	}
	else{
		$imagen->fichero = 'N/A';
		$imagen->extension = 'N/A';
		$imagen->dia = 'N/A';
		$imagen->hora = 'N/A';
		$imagen->timestamp = 'N/A';
		$imagen->destacado = 'N/A';
	}
	return $imagen;
}

/*
 *	La función se encarga de retornar el tamaño
 *	de un documento
 *
 * */


function get_documento_size($dir, $fichero, $decimal = 2){
	$bytes = filesize($dir.$fichero);
	$size = array('Bytes','KB','MB','GB','TB','PB','EB','ZB','YB');
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimal}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
}

if ( ! function_exists('die_pre'))
{
	function die_pre($data = array())
	{
		die("<pre>".print_r($data, TRUE)."</pre>");
	}
}

if (! function_exists('query_arrow'))
{
	function query_arrow($field, $field_value, $new_order)
	{
		if ($field == $field_value && $new_order == 'asc')
			return ' '.img('assets/back/img/template/arrow-down.png');
		else if ($field == $field_value && $new_order == 'desc')
			return ' '.img('assets/back/img/template/arrow-up.png');
		else
			return '';
	}
}

/**
 * 
 * Distintos valores en un array de objetos para una propiedad específica
 * 
 */
function distintos($array, $propiedad)
{
	$temp = array();
	
	foreach ($array as $objeto) {
		if ( ! in_array($objeto->$propiedad, $temp))
			$temp[] = $objeto->$propiedad;
	}
	
	return $temp;
}

function fecha_to_timestamp($fecha)
{
	list($fecha, $hora) = explode(' ', $fecha);
	
	list($d, $m, $a) =  explode('-', $fecha);
	
	$fecha_new = implode('-', array($a, $m, $d));
	
	$fecha_new .= (!empty($hora)) ? ' '.$hora : '00:00';
	
	return $fecha_new;
}
