<?php  defined('BASEPATH') or exit('No se permite el acceso directo.');

	include("includes/header.php");

	if (isset($contenido_principal) && ! empty($contenido_principal))
		echo $contenido_principal;
	else
		show_404();
	
	//SITEMAP
	$this->load->model('front/front_model');
	$servicios_foo = $this->front_model->get_list_tabla('servicio');
	$eventos_foo = $this->front_model->get_list_tabla('evento');
	$restaurantes_foo = $this->front_model->get_list_tabla('restaurante');
	
	include("includes/footer.php"); 

?>
