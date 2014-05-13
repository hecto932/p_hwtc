<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


/*
 *
 * Formato de rutas:
 *
 * $route['ruta_en_español'] = 'controlador/función/parametro'
 * $route['ruta_en_ingles'] = 'controlador/función/parametro'
 *
 * */

//Información básica
$route['default_controller'] = "front";
$route['404_override'] = 'front/error';

$route['backend']					= "evento/evento/listado";
$route['backend/access_denied']		= "template/access_denied";

//Consulta
$route['consulta/?(.*)'] 		= 'usuarios/datos/index/$1';
$route['consult/?(.*)'] 		= 'usuarios/datos/index/$1';

//Solo para prueba ////////////////////////////////////////////////////////
$route['rss_promociones'] 			= "promocion/promocion_front/rss_promociones";
//////////////////////////////////////////////////////////////////////////////////

$routes['inicio/?(.*)']		= "front/modulo/inicio/$1";

//Nosotros
$route['nosotros'] 			= "empresa/empresa_front/nosotros";
$route['aboutus']			= "empresa/empresa_front/nosotros";
$route['work']				= "empresa/empresa_front/trabajos";
$route['careers']			= "carreras/carreras_front/carreras";

//Promociones
$route['promociones/?(.*)'] 		= "front/modulo/promociones/$1";
$route['promotions/?(.*)'] 			= "front/modulo/promociones/$1";

/*
$route['promociones'] 				= "promocion/promocion_front/listado_promociones";
$route['promociones/?(.*)'] 		= "promocion/promocion_front/listado_promociones/$1";
*/

$route['promociones'] 				= "promocion/promocion_front/promociones";
$route['promociones/?(.*)'] 		= "promocion/promocion_front/promociones/$1";
$route['promociones_eventos'] 		= "promocion/promocion_front/promociones_eventos";

//Eventos y Reuniones
$route['eventos_reuniones'] 		= "evento/evento_front/eventos_reuniones";
$route['eventos_reuniones/(.*)']	= "evento/evento_front/detalle_evento/$1";

//Habitaciones
$route['habitaciones'] 				= "habitacion/habitacion_front/habitaciones";

//Restaurantes
$route['gastronomia']				= "restaurante/restaurante_front/restaurantes";
$route['gastronomia/(.*)']			= "restaurante/restaurante_front/restaurante_detalle/$1";

//Servicios
$route['servicios']					= "servicio/servicio_front/servicios";
$route['convenciones']				= "servicio/servicio_front/convenciones";

//Contacto
$route['contactanos']				= "contacto/contacto_front/contactanos";

//*************************** Rutas de WTC ***************************

					/* Rutas Frontend [Español] */

$route['wtc']						= "front/front/wtc";
$route['complejo_wtc']				= "front/front/wtc_complejo";
$route['hmr']						= "front/front/hmr";


$route['que_es_un_wtc']				= "empresa/empresa_front/about_wtc";
$route['asociaciones']				= "empresa/empresa_front/asociacion_wtc";
$route['wtc_valencia']				= "empresa/empresa_front/wtc_valencia";
$route['hotel_hesperia']			= "empresa/empresa_front/hotel";
$route['centro_de_convenciones']	= "empresa/empresa_front/centro_convencion";
$route['membresia']					= "empresa/empresa_front/membresia";
$route['torre_empresarial']			= "empresa/empresa_front/torre_empresarial";

//*************************** RUTAS DE SERVICIOS ***************************

					/* Rutas Frontend [Español] */

$route['servicios_wtc']												= "servicio/servicio_front/servicios";
$route['servicios_wtc/hospedaje']									= "servicio/servicio_front/hospedaje";

					/* Rutas Backend [Español] */

$route['backend/servicios/?']										= "servicio/servicio/listado";
$route['backend/servicios/listado']									= "servicio/servicio/listado";
$route['backend/servicios/listado/(.*)/(.*)'] 						= "servicio/servicio/listado/$1/$2";
$route['backend/servicios/listado/(.*)/(.*)/(.*)'] 					= "servicio/servicio/listado/$1/$2/$3";
$route['backend/servicios/guardar_idioma']							= "servicio/servicio/guardar_idioma";
$route['backend/servicios/crear']									= "servicio/servicio/crear";
$route['backend/servicios/eliminar_servicio/(.*)']					= "servicio/servicio/delete/$1";
$route['backend/servicios/eliminar_idioma/(.*)']					= "servicio/servicio/eliminar_idioma/$1";
$route['backend/servicios/ficha_servicio/(.*)']						= "servicio/servicio/ficha/$1";
$route['backend/servicios/editar_servicio/(.*)']					= "servicio/servicio/edit/$1";
$route['backend/servicios/editar_idioma/(:num)/(:num)']				= "servicio/servicio/editar_idioma/$1/$2";
$route['backend/servicios/buscar']									= "servicio/servicio/buscar";
$route['backend/servicios/buscar/(.*)']								= "servicio/servicio/buscar/$1";
$route['backend/servicios/imagenes/(:num)/adicionar/principal']		= "servicio/servicio/imagen/$1/1";
$route['backend/servicios/imagenes/(:num)/adicionar/secundarias']	= "servicio/servicio/imagen/$1/2";
$route['backend/servicios/imagenes/(:num)/eliminar']				= "servicio/servicio/imagen/$1";
$route['backend/servicios/imagenes/procesar_imagenes']				= "servicio/servicio/imagen_procesar";
$route['backend/servicios/imagenes/revision']						= "servicio/servicio/get_files";
$route['backend/servicios/imagenes/eliminar']						= "servicio/servicio/imagen_eliminar";


//*************************** Rutas de Carreras ***************************

					/* Rutas Frontend [Español] */

$route['carreras']										= "trabajo/trabajo_front/trabajo";
$route['carreras/trabajos/detalles_trabajo/(.*)']		= "trabajo/trabajo_front/detalle/$1";
$route['carreras/resumen/(.*)']							= "trabajo/trabajo_front/resume/$1";
$route['carreras/resumen/(.*)/(.*)']					= "trabajo/trabajo_front/resume/$1/$2";

					/* Rutas Frontend [Ingles] */


$route['careers/jobs/job_details/(.*)']		= "trabajo/trabajo_front/detalle/$1";
$route['careers/jobs/job_content']			= "trabajo/trabajo_front/contenido";
$route['careers/resume']					= "trabajo/trabajo_front/resume";
$route['careers/resume/(.*)']				= "trabajo/trabajo_front/resume/$1";
$route['careers/resume/(.*)/(.*)']			= "trabajo/trabajo_front/resume/$1/$2";
$route['careers/resume/send_resume']		= "trabajo/trabajo_front/procesar_resumen";
$route['careers/resume/get_regions']		= "trabajo/trabajo_front/get_regiones";
$route['careers/resume/get_cities']			= "trabajo/trabajo_front/get_ciudades";


//*************************** Rutas de Noticias ***************************

$route['noticias']								= "noticia/noticia_front/blog/noticia.id_noticia/desc/0";
$route['noticias/(.*)']							= "noticia/noticia_front/detalle_noticias/$1";
$route['noticias/articulo/(.*)']				= "noticia/noticia_front/detalle_noticias/$1";
$route['ultimas-noticias-wtc']					= $route['noticias'];
$route['ultimas-noticias-wtc/(:num)']			= "noticia/noticia_front/blog/noticia.id_noticia/desc/$1";
$route['ultimas-noticias-wtc/article/(.*)']		= "noticia/noticia_front/detalle_noticias/$1";

$route['noticias/actuales_semana']				= "noticia/noticia_front/blog/noticia.id_noticia/desc/0/2";
$route['noticias/actuales_mes']					= "noticia/noticia_front/blog/noticia.id_noticia/desc/0/1";

//*************************** Rutas de Noticias ***************************

$route['membresias_wtc']							= "membresias/membresias_front/membresias";
$route['membresias_wtc/registro']					= "membresias/membresias_front/registro";
$route['membresias_wtc/guardar_registro']			= "membresias/membresias_front/guardar_registro";
$route['membresias_wtc/miembros']					= "membresias/membresias_front/acciones";
$route['miembros']									= $route['membresias_wtc/miembros'];
$route['membresias_wtc/servicios']					= "membresias/membresias_front/servicios";
$route['membresias_wtc/repositorio']				= "membresias/membresias_front/repositorio";
$route['membresias_wtc/login']						= "membresias/membresias_front/login_member";
$route['membresias_wtc/logout']						= "membresias/membresias_front/logout_member";
$route['membresias_wtc/profile']					= "membresias/membresias_front/profile_member";
$route['membresias_wtc/edit_member']				= "membresias/membresias_front/edit_member";
$route['membresias_wtc/forgot_password']			= "membresias/membresias_front/forgot_password";
$route['membresias_wtc/verify_password']			= "membresias/membresias_front/check_pass";
$route['membresias_wtc/user/passwords/reset_password'] = "membresias/membresias_front/reset_pass";

					/* Rutas Backend [Español] */

$route['backend/membresias/?']										= "membresias/membresias/listado";
$route['backend/membresias/listado'] 								= "membresias/membresias/listado";
$route['backend/membresias/listado/(.*)/(.*)'] 						= "membresias/membresias/listado/$1/$2";
$route['backend/membresias/listado/(.*)/(.*)/(.*)']					= "membresias/membresias/listado/$1/$2/$3";
$route['backend/membresias/guardar_idioma']							= "membresias/membresias/guardar_idioma";
$route['backend/membresias/crear']									= "membresias/membresias/crear";
$route['backend/membresias/eliminar_membresia/(.*)']				= "membresias/membresias/delete/$1";
$route['backend/membresias/eliminar_idioma/(.*)']					= "membresias/membresias/eliminar_idioma/$1";
$route['backend/membresias/ficha_membresia/(.*)']					= "membresias/membresias/ficha/$1";
$route['backend/membresias/editar_miembro/(.*)']					= "membresias/membresias/edit/$1";
$route['backend/membresias/editar_idioma/(:num)/(:num)']			= "membresias/membresias/editar_idioma/$1/$2";
$route['backend/membresias/buscar']									= "membresias/membresias/buscar";
$route['backend/membresias/buscar/(.*)']							= "membresias/membresias/buscar/$1";
$route['backend/membresias/imagenes/(:num)/adicionar/principal']	= "membresias/membresias/imagen/$1/1";
$route['backend/membresias/imagenes/(:num)/adicionar/secundarias']	= "membresias/membresias/imagen/$1/2";
$route['backend/membresias/imagenes/(:num)/eliminar']				= "membresias/membresias/imagen/$1";
$route['backend/membresias/imagenes/procesar_imagenes']				= "membresias/membresias/imagen_procesar";
$route['backend/membresias/imagenes/revision']						= "membresias/membresias/get_files";
$route['backend/membresias/imagenes/eliminar']						= "membresias/membresias/imagen_eliminar";


$route['backend/hoteles/?']											= "hotel/hotel/listado";
$route['backend/hoteles/listado'] 									= "hotel/hotel/listado";
$route['backend/hoteles/listado/(.*)/(.*)'] 						= "hotel/hotel/listado/$1/$2";
$route['backend/hoteles/listado/(.*)/(.*)/(.*)']					= "hotel/hotel/listado/$1/$2/$3";
$route['backend/hoteles/guardar_idioma']							= "hotel/hotel/guardar_idioma";
$route['backend/hoteles/crear']										= "hotel/hotel/crear";
$route['backend/hoteles/eliminar_membresia/(.*)']					= "hotel/hotel/delete/$1";
$route['backend/hoteles/eliminar_idioma/(.*)']						= "hotel/hotel/eliminar_idioma/$1";
$route['backend/hoteles/ficha_membresia/(.*)']						= "hotel/hotel/ficha/$1";
$route['backend/hoteles/editar_miembro/(.*)']						= "hotel/hotel/edit/$1";
$route['backend/hoteles/editar_idioma/(:num)/(:num)']				= "hotel/hotel/editar_idioma/$1/$2";
$route['backend/hoteles/buscar']									= "hotel/hotel/buscar";
$route['backend/hoteles/buscar/(.*)']								= "hotel/hotel/buscar/$1";
$route['backend/hoteles/imagenes/(:num)/adicionar/principal']		= "hotel/hotel/imagen/$1/1";
$route['backend/hoteles/imagenes/(:num)/adicionar/secundarias']		= "hotel/hotel/imagen/$1/2";
$route['backend/hoteles/imagenes/(:num)/eliminar']					= "hotel/hotel/imagen/$1";
$route['backend/hoteles/imagenes/procesar_imagenes']				= "hotel/hotel/imagen_procesar";
$route['backend/hoteles/imagenes/revision']							= "hotel/hotel/get_files";
$route['backend/hoteles/imagenes/eliminar']							= "hotel/hotel/imagen_eliminar";




					/* Rutas Backend [Español] */

$route['backend/noticias/?']										= "noticia/noticia/listado";
$route['backend/noticias/listado/(.*)/(.*)'] 						= "noticia/noticia/listado/$1/$2";
$route['backend/noticias/listado/(.*)/(.*)/(.*)'] 					= "noticia/noticia/listado/$1/$2/$3";
$route['backend/noticias/guardar_idioma']							= "noticia/noticia/guardar_idioma";
$route['backend/noticias/crear']									= "noticia/noticia/crear";
$route['backend/noticias/eliminar_noticia/(.*)']					= "noticia/noticia/delete/$1";
$route['backend/noticias/eliminar_idioma/(.*)']						= "noticia/noticia/eliminar_idioma/$1";
$route['backend/noticias/ficha_noticia/(.*)']						= "noticia/noticia/ficha/$1";
$route['backend/noticias/editar_noticia/(.*)']						= "noticia/noticia/edit/$1";
$route['backend/noticias/editar_idioma/(:num)/(:num)']				= "noticia/noticia/editar_idioma/$1/$2";
$route['backend/noticias/buscar']									= "noticia/noticia/buscar";
$route['backend/noticias/buscar/(.*)']								= "noticia/noticia/buscar/$1";
$route['backend/noticias/imagenes/(:num)/adicionar/principal']		= "noticia/noticia/imagen/$1/1";
$route['backend/noticias/imagenes/(:num)/adicionar/secundarias']	= "noticia/noticia/imagen/$1/2";
$route['backend/noticias/imagenes/(:num)/eliminar']					= "noticia/noticia/imagen/$1";
$route['backend/noticias/imagenes/procesar_imagenes']				= "noticia/noticia/imagen_procesar";
$route['backend/noticias/imagenes/revision']						= "noticia/noticia/get_files";
$route['backend/noticias/imagenes/eliminar']						= "noticia/noticia/imagen_eliminar";


					/* Rutas Backend [Ingles] */

$route['backend/news']												= "noticia/noticia/listado";
$route['backend/news/directory']									= "noticia/noticia/listado";
$route['backend/news/save_details'] 								= "noticia/noticia/guardar_idioma";
$route['backend/news/create']										= "noticia/noticia/crear";
$route['backend/news/remove_article/(.*)']							= "noticia/noticia/delete/$1";
$route['backend/news/remove_details/(.*)']							= "noticia/noticia/eliminar_idioma/$1";
$route['backend/news/directory/noticia.id_noticia/desc/(:num)'] 	= "noticia/noticia/listado/noticia.id_noticia/desc/$1";
$route['backend/news/article_record/(.*)']							= "noticia/noticia/ficha/$1";
$route['backend/news/edit_article/(.*)']							= "noticia/noticia/edit/$1";
$route['backend/news/edit_details/(:num)/(:num)']					= "noticia/noticia/editar_idioma/$1/$2";
$route['backend/news/search']										= "noticia/noticia/buscar";
$route['backend/news/search/(.*)']									= "noticia/noticia/buscar/$1";

//******************************** Rutas de Restaurantes ****************************//

$route['backend/restaurantes/?']										= "restaurante/restaurante/listado";
$route['backend/restaurantes/listado']									= "restaurante/restaurante/listado";
$route['backend/restaurantes/listado/(.*)/(.*)'] 						= "restaurante/restaurante/listado/$1/$2";
$route['backend/restaurantes/listado/(.*)/(.*)/(.*)'] 					= "restaurante/restaurante/listado/$1/$2/$3";
$route['backend/restaurantes/guardar_idioma']							= "restaurante/restaurante/guardar_idioma";
$route['backend/restaurantes/crear']									= "restaurante/restaurante/crear";
$route['backend/restaurantes/eliminar_restaurante/(.*)']				= "restaurante/restaurante/delete/$1";
$route['backend/restaurantes/eliminar_idioma/(.*)']						= "restaurante/restaurante/eliminar_idioma/$1";
$route['backend/restaurantes/ficha_restaurante/(.*)']					= "restaurante/restaurante/ficha/$1";
$route['backend/restaurantes/editar_restaurante/(.*)']					= "restaurante/restaurante/edit/$1";
$route['backend/restaurantes/editar_idioma/(:num)/(:num)']				= "restaurante/restaurante/editar_idioma/$1/$2";
$route['backend/restaurantes/buscar']									= "restaurante/restaurante/buscar";
$route['backend/restaurantes/buscar/(.*)']								= "restaurante/restaurante/buscar/$1";
$route['backend/restaurantes/imagenes/(:num)/adicionar/principal']		= "restaurante/restaurante/imagen/$1/1";
$route['backend/restaurantes/imagenes/(:num)/adicionar/secundarias']	= "restaurante/restaurante/imagen/$1/2";
$route['backend/restaurantes/imagenes/(:num)/eliminar']					= "restaurante/restaurante/imagen/$1";
$route['backend/restaurantes/imagenes/procesar_imagenes']				= "restaurante/restaurante/imagen_procesar";
$route['backend/restaurantes/imagenes/revision']						= "restaurante/restaurante/get_files";
$route['backend/restaurantes/imagenes/eliminar']						= "restaurante/restaurante/imagen_eliminar";

//*************************** RUTAS DE HABITACIONES ***************************

$route['backend/habitaciones/?']										= "habitacion/habitacion/listado";
$route['backend/habitaciones/listado']									= "habitacion/habitacion/listado";
$route['backend/habitaciones/listado/(.*)/(.*)'] 						= "habitacion/habitacion/listado/$1/$2";
$route['backend/habitaciones/listado/(.*)/(.*)/(.*)'] 					= "habitacion/habitacion/listado/$1/$2/$3";
$route['backend/habitaciones/guardar_idioma']							= "habitacion/habitacion/guardar_idioma";
$route['backend/habitaciones/crear']									= "habitacion/habitacion/crear";
$route['backend/habitaciones/eliminar_habitacion/(.*)']					= "habitacion/habitacion/delete/$1";
$route['backend/habitaciones/eliminar_idioma/(.*)']						= "habitacion/habitacion/eliminar_idioma/$1";
$route['backend/habitaciones/ficha_habitacion/(.*)']					= "habitacion/habitacion/ficha/$1";
$route['backend/habitaciones/editar_habitacion/(.*)']					= "habitacion/habitacion/edit/$1";
$route['backend/habitaciones/editar_idioma/(:num)/(:num)']				= "habitacion/habitacion/editar_idioma/$1/$2";
$route['backend/habitaciones/buscar']									= "habitacion/habitacion/buscar";
$route['backend/habitaciones/buscar/(.*)']								= "habitacion/habitacion/buscar/$1";
$route['backend/habitaciones/imagenes/(:num)/adicionar/principal']		= "habitacion/habitacion/imagen/$1/1";
$route['backend/habitaciones/imagenes/(:num)/adicionar/secundarias']	= "habitacion/habitacion/imagen/$1/2";
$route['backend/habitaciones/imagenes/(:num)/eliminar']					= "habitacion/habitacion/imagen/$1";
$route['backend/habitaciones/imagenes/procesar_imagenes']				= "habitacion/habitacion/imagen_procesar";
$route['backend/habitaciones/imagenes/revision']						= "habitacion/habitacion/get_files";
$route['backend/habitaciones/imagenes/eliminar']						= "habitacion/habitacion/imagen_eliminar";

//******************************** Rutas de categorias *****************************//

$route['backend/categorias/?']											= "categoria/categoria/listado";
$route['backend/categorias/listado/(.*)/(.*)']							= "categoria/categoria/listado/$1/$2";
$route['backend/categorias/listado/(.*)/(.*)/(.*)']						= "categoria/categoria/listado/$1/$2/$3";
$route['backend/categorias/guardar_idioma']								= "categoria/categoria/guardar_idioma";
$route['backend/categorias/crear']										= "categoria/categoria/crear";
$route['backend/categorias/eliminar_categoria/(.*)']					= "categoria/categoria/delete/$1";
$route['backend/categorias/eliminar_idioma/(.*)']						= "categoria/categoria/eliminar_idioma/$1";
$route['backend/categorias/ficha_categoria/(.*)']						= "categoria/categoria/ficha/$1";
$route['backend/categorias/editar_categoria/(.*)']						= "categoria/categoria/edit/$1";
$route['backend/categorias/editar_idioma/(:num)/(:num)']				= "categoria/categoria/editar_idioma/$1/$2";
$route['backend/categorias/buscar']										= "categoria/categoria/buscar";
$route['backend/categorias/buscar/(.*)']								= "categoria/categoria/buscar/$1";
$route['backend/categorias/imagenes/(:num)/adicionar/principal']		= "categoria/categoria/imagen/$1/1";
$route['backend/categorias/imagenes/(:num)/adicionar/secundarias']		= "categoria/categoria/imagen/$1/2";
$route['backend/categorias/imagenes/(:num)/eliminar']					= "categoria/categoria/imagen/$1";
$route['backend/categorias/imagenes/procesar_imagenes']					= "categoria/categoria/imagen_procesar";
$route['backend/categorias/imagenes/revision']							= "categoria/categoria/get_files";
$route['backend/categorias/imagenes/eliminar']							= "categoria/categoria/imagen_eliminar";

//*************************** Rutas de Galeria ***************************

$route['backend/galerias/?']										= "galeria/galeria/listado";
$route['backend/galerias/listado']									= "galeria/galeria/listado";
$route['backend/galerias/listado/(.*)/(.*)']						= "galeria/galeria/listado/$1/$2";
$route['backend/galerias/listado/(.*)/(.*)/(.*)']					= "galeria/galeria/listado/$1/$2/$3";
$route['backend/galerias/guardar_idioma']							= "galeria/galeria/guardar_idioma";
$route['backend/galerias/crear']									= "galeria/galeria/crear";
$route['backend/galerias/eliminar_galeria/(.*)']					= "galeria/galeria/delete/$1";
$route['backend/galerias/eliminar_idioma/(.*)']						= "galeria/galeria/eliminar_idioma/$1";
$route['backend/galerias/ficha_galeria/(.*)']						= "galeria/galeria/ficha/$1";
$route['backend/galerias/editar_galeria/(.*)']						= "galeria/galeria/edit/$1";
$route['backend/galerias/editar_idioma/(:num)/(:num)']				= "galeria/galeria/editar_idioma/$1/$2";
$route['backend/galerias/buscar']									= "galeria/galeria/buscar";
$route['backend/galerias/buscar/(.*)']								= "galeria/galeria/buscar/$1";
$route['backend/galerias/imagenes/(:num)/adicionar/principal']		= "galeria/galeria/imagen/$1/1";
$route['backend/galerias/imagenes/(:num)/adicionar/secundarias']	= "galeria/galeria/imagen/$1/2";
$route['backend/galerias/imagenes/(:num)/eliminar']					= "galeria/galeria/imagen/$1";
$route['backend/galerias/imagenes/procesar_imagenes']				= "galeria/galeria/imagen_procesar";
$route['backend/galerias/imagenes/revision']						= "galeria/galeria/get_files";
$route['backend/galerias/imagenes/eliminar']						= "galeria/galeria/imagen_eliminar";


$route['cotizar/?(.*)'] 	= "front/modulo/contacto/$1";
$route['cotizacion/?(.*)'] 	= "front/modulo/contacto/$1";


//*************************** Rutas de testimonios ***************************

					/* Rutas Backend [Español] */

$route['backend/testimonios']									= "testimonios/testimonio";
$route['backend/testimonios/crear']								= "testimonios/testimonio/crear";
$route['backend/testimonios/listado']							= "testimonios/testimonio/listado";
$route['backend/testimonios/listado/(.*)']						= "testimonios/testimonio/listado/$1";
$route['backend/testimonios/listado/(.*)/(.*)']					= "testimonios/testimonio/listado/$1/$2";
$route['backend/testimonios/ficha_testimonio/(.*)']				= "testimonios/testimonio/ficha/$1";
$route['backend/testimonios/editar_lenguaje/(:num)/(:num)']		= "testimonios/testimonio/editar_idioma/$1/$2";
$route['backend/testimonios/editar_testimonio/(:num)']			= "testimonios/testimonio/edit/$1";
$route['backend/testimonios/eliminar_detalles/(:num)']			= "testimonios/testimonio/eliminar_idioma/$1";
$route['backend/testimonios/eliminar_testimonio/(:num)']		= "testimonios/testimonio/delete/$1";
$route['backend/testimonios/guardar_idioma']					= "testimonios/testimonio/guardar_idioma";
$route['backend/testimonios/buscar']							= "testimonios/testimonio/buscar";
$route['backend/testimonios/buscar/(.*)']						= "testimonios/testimonio/buscar/$1";
$route['backend/testimonios/ficha_testimonio/(:num)']			= "testimonios/testimonio/ficha/$1";
$route['backend/borrar_testimonio/(.*)']						= "testimonios/testimonio/borrar_testimonio/$1";
$route['backend/publicar_testimonio/(.*)']						= "testimonios/testimonio/publicar_testimonio/$1";
$route['backend/guardar_testimonio/(.*)']						= "testimonios/testimonio/guardar_testimonio/$1";

//*************************** RUTAS DE INTEGRANTES ***************************

$route['backend/integrantes/?']											= "integrante/integrante/listado";
$route['backend/integrantes/listado']									= "integrante/integrante/listado";
$route['backend/integrantes/listado/(.*)/(.*)'] 						= "integrante/integrante/listado/$1/$2";
$route['backend/integrantes/listado/(.*)/(.*)/(.*)'] 					= "integrante/integrante/listado/$1/$2/$3";
$route['backend/integrantes/guardar_idioma']							= "integrante/integrante/guardar_idioma";
$route['backend/integrantes/crear']										= "integrante/integrante/crear";
$route['backend/integrantes/eliminar_integrante/(.*)']					= "integrante/integrante/delete/$1";
$route['backend/integrantes/eliminar_idioma/(.*)']						= "integrante/integrante/eliminar_idioma/$1";
$route['backend/integrantes/ficha_integrante/(.*)']						= "integrante/integrante/ficha/$1";
$route['backend/integrantes/editar_integrante/(.*)']					= "integrante/integrante/edit/$1";
$route['backend/integrantes/editar_idioma/(:num)/(:num)']				= "integrante/integrante/editar_idioma/$1/$2";
$route['backend/integrantes/buscar']									= "integrante/integrante/buscar";
$route['backend/integrantes/buscar/(.*)']								= "integrante/integrante/buscar/$1";
$route['backend/integrantes/imagenes/(:num)/adicionar/principal']		= "integrante/integrante/imagen/$1/1";
$route['backend/integrantes/imagenes/(:num)/adicionar/secundarias']		= "integrante/integrante/imagen/$1/2";
$route['backend/integrantes/imagenes/(:num)/eliminar']					= "integrante/integrante/imagen/$1";
$route['backend/integrantes/imagenes/procesar_imagenes']				= "integrante/integrante/imagen_procesar";
$route['backend/integrantes/imagenes/revision']							= "integrante/integrante/get_files";
$route['backend/integrantes/imagenes/eliminar']							= "integrante/integrante/imagen_eliminar";


//*************************** Rutas de Eventos ***************************

$route['eventos']													= "evento/evento_front/blog/evento.id_evento/desc/0";

$route['eventos-wtc']												= $route['eventos'];
$route['eventos-wtc/(:num)']										= "evento/evento_front/blog/evento.id_evento/desc/$1";
$route['eventos-wtc/article/(.*)']									= "evento/evento_front/detalle_eventos/$1";

$route['eventos/actuales_semana']									= "evento/evento_front/blog/evento.id_evento/desc/0/2";
$route['eventos/actuales_mes']										= "evento/evento_front/blog/evento.id_evento/desc/0/1";

$route['eventos/guardar_inscripcion/(.*)']							= "evento/evento_front/guardar_inscripcion/$1";
$route['eventos/guardar_insc_juridica/(.*)']						= "evento/evento_front/guardar_insc_juridica/$1";
$route['eventos/inscripciones_juridicas/(.*)']						= "evento/evento_front/inscripcion_juridica/$1";
// $route['eventos/inscripciones/(.*)']								= "evento/insc_hospedaje/inscripcion_evento/$1";
$route['eventos/inscripciones/(.*)']								= "evento/evento_front/inscripcion_evento/$1";
$route['eventos/inscripcion_hospedaje/procesar_inscripcion']		= "evento/insc_hospedaje/set_inscripcion";
$route['eventos/iniciar_sesion']									= "evento/evento_front/iniciar_sesion";
$route['eventos/error_iniciosesion']								= "evento/evento_front/blog/error_iniciosesion";
$route['eventos/iniciar_sesion/facebook_app']						= "evento/facebook_control/login";
$route['eventos/iniciar_sesion/google_app']							= "evento/google_control/login";
$route['eventos/registro']											= "evento/evento_front/registro";
$route['eventos/editar']											= "evento/insc_hospedaje/editar_datos";
$route['eventos/editar_datos']										= "evento/insc_hospedaje/modificar";
$route['eventos/registro/procesar_registro']						= "evento/evento_front/registro";
$route['eventos/registro/modificar_registro']						= "evento/insc_hospedaje/modificar";
$route['eventos/guardar_registro']									= "evento/evento_front/blog/guardar_registro";

// $route['eventos/(.*)/inscripcion_hospedaje']						= "evento/insc_hospedaje/inscripciones/$1";
$route['eventos/inscripcion_hospedaje/recuperar_contrasena/?(.*)']	= "evento/insc_hospedaje/forgot_password/$1";
$route['eventos/inscripcion_hospedaje/reestablecer_contrasena']		= "evento/insc_hospedaje/renew_password";
$route['eventos/inscripcion_hospedaje/descargar_reporte/(:num)/(:num)']		= "evento/insc_hospedaje/descargar_reporte/$1/$2";
$route['eventos/inscripcion_hospedaje/cerrar_sesion']				= "evento/insc_hospedaje/cerrar_sesion";
$route['eventos/iniciar_facebook']									= "evento/insc_hospedaje/facebook_app";
$route['eventos/iniciar_google']									= "evento/insc_hospedaje/google_app";
$route['eventos/inscripcion_hospedaje/editar_participante/(:num)']	= "evento/insc_hospedaje/editar_participante/$1";
$route['eventos/inscripcion_hospedaje/eliminar_participante/(:num)/(:num)/?(:num)']		= "evento/insc_hospedaje/eliminar_participante/$1/$2/$3";
$route['eventos/inscripcion_hospedaje/editar_participante/guardar_registro']	= "evento/insc_hospedaje/editar_participante";
$route['eventos/inscripcion_hospedaje/enviar_pago']					= "evento/insc_hospedaje/guardar_pago";

$route['eventos/inscripcion_hospedaje/?(.*)']						= "evento/insc_hospedaje/inscripciones/$1";
$route['eventos/(.*)']												= "evento/evento_front/blog/evento.id_evento/desc/$1";
$route['eventos/(.*)']												= "evento/evento_front/detalle_eventos/$1";




					/* Rutas Backend [Español] */

$route['backend/eventos/?']											= "evento/evento/listado";
$route['backend/eventos/listado']									= "evento/evento/listado";
$route['backend/eventos/listado/(.*)/(.*)'] 						= "evento/evento/listado/$1/$2";
$route['backend/eventos/listado/(.*)/(.*)/(.*)'] 					= "evento/evento/listado/$1/$2/$3";
$route['backend/eventos/guardar_idioma']							= "evento/evento/guardar_idioma";
$route['backend/eventos/crear']										= "evento/evento/crear";
$route['backend/eventos/eliminar_evento/(.*)']						= "evento/evento/delete/$1";
$route['backend/eventos/eliminar_idioma/(:num)/(:num)']				= "evento/evento/eliminar_idioma/$1/$2";
$route['backend/eventos/ficha_evento/(.*)']							= "evento/evento/ficha/$1";
$route['backend/eventos/editar_evento/(.*)']						= "evento/evento/edit/$1";
$route['backend/eventos/editar_idioma/(:num)/(:num)']				= "evento/evento/editar_idioma/$1/$2";
$route['backend/eventos/buscar']									= "evento/evento/buscar";
$route['backend/eventos/buscar/(.*)']								= "evento/evento/buscar/$1";
$route['backend/eventos/imagenes/(:num)/adicionar/principal']		= "evento/evento/imagen/$1/1";
$route['backend/eventos/imagenes/(:num)/adicionar/secundarias']		= "evento/evento/imagen/$1/2";
$route['backend/eventos/imagenes/(:num)/eliminar']					= "evento/evento/imagen/$1";
$route['backend/eventos/imagenes/procesar_imagenes']				= "evento/evento/imagen_procesar";
$route['backend/eventos/imagenes/revision']							= "evento/evento/get_files";
$route['backend/eventos/imagenes/eliminar']							= "evento/evento/imagen_eliminar";
$route['backend/eventos/subir/pdf']									= "evento/evento/subir_pdf";
$route['backend/eventos/eliminar/pdf/(:num)/(.*)']					= "evento/evento/eliminar_pdf/$1/$2";

$route['backend/eventos/inscripciones/(:num)']						= "evento/inscripcion/listado/$1";
$route['backend/eventos/inscripciones/(:num)/(:num)']				= "evento/inscripcion/listado/$1/$2";
$route['backend/eventos/inscripciones/(:num)/([a-z_]+)']			= "evento/inscripcion/listado/$1/$2";
$route['backend/eventos/inscripciones/(:num)/([a-z_]+)/(asc|desc)'] = "evento/inscripcion/listado/$1/$2/$3";
$route['backend/eventos/inscripciones/(:num)/([a-z_]+)/(asc|desc)/(:num)'] = "evento/inscripcion/listado/$1/$2/$3/$4";

$route['backend/eventos/reporte_inscripciones/(:num)']				= "evento/inscripcion/reporte_inscripciones/$1";

$route['backend/eventos/facturas']									= "evento/factura/listado";
$route['backend/eventos/facturas/([a-z_]+)']						= "evento/factura/listado/$1";
$route['backend/eventos/facturas/([a-z_]+)/(asc|desc)'] 			= "evento/factura/listado/$1/$2";
$route['backend/eventos/facturas/([a-z_]+)/(asc|desc)/(:num)'] 		= "evento/factura/listado/$1/$2/$3";
$route['backend/eventos/facturas/consultar/(:num)']					= "evento/factura/consulta/$1";

$route['backend/eventos/hospedaje/(:num)']							= "evento/hospedaje/listado/$1";
$route['backend/eventos/hospedaje/(:num)/([a-z_]+)']				= "evento/hospedaje/listado/$1/$2";
$route['backend/eventos/hospedaje/(:num)/([a-z_]+)/(asc|desc)'] 	= "evento/hospedaje/listado/$1/$2/$3";
$route['backend/eventos/hospedaje/(:num)/([a-z_]+)/(asc|desc)/(:num)'] = "evento/hospedaje/listado/$1/$2/$3/$4";

$route['backend/eventos/asistencia/(:num)']							= "evento/asistencia/listado/$1";
$route['backend/eventos/asistencia/(:num)/([a-z_]+)']				= "evento/asistencia/listado/$1/$2";
$route['backend/eventos/asistencia/(:num)/([a-z_]+)/(asc|desc)'] 	= "evento/asistencia/listado/$1/$2/$3";
$route['backend/eventos/asistencia/(:num)/([a-z_]+)/(asc|desc)/(:num)'] = "evento/asistencia/listado/$1/$2/$3/$4";

$route['backend/eventos/usuarios/?']							= "evento/usuario/listado";
$route['backend/eventos/usuarios/([a-z0-9_]+)']					= "evento/usuario/listado/$1";
$route['backend/eventos/usuarios/([a-z0-9_]+)/(asc|desc)'] 		= "evento/usuario/listado/$1/$2";
$route['backend/eventos/usuarios/([a-z0-9_]+)/(asc|desc)/(:num)'] 	= "evento/usuario/listado/$1/$2/$3";
$route['backend/eventos/usuarios/editar/(:num)']				= "evento/usuario/editar/$1";

$route['backend/eventos/empresas/?']							= "evento/empresa/listado";
$route['backend/eventos/empresas/([a-z0-9_]+)']					= "evento/empresa/listado/$1";
$route['backend/eventos/empresas/([a-z0-9_]+)/(asc|desc)'] 		= "evento/empresa/listado/$1/$2";
$route['backend/eventos/empresas/([a-z0-9_]+)/(asc|desc)/(:num)'] 	= "evento/empresa/listado/$1/$2/$3";
$route['backend/eventos/empresas/editar/(:num)']				= "evento/empresa/editar/$1";

//*************************** Rutas de Monitor ***************************
					
$route['backend/usuarios/monitorizar']			="usuario/usuario/monitorizar";
$route['backend/usuarios/buscar_actividad']		="usuario/usuario/buscar_actividad";
					 
					 	//* Rutas Backend [Español] */

$route['backend/monitor/?']											= "monitor/monitor/listado";
$route['backend/monitor/listado']									= "monitor/monitor/listado";
$route['backend/monitor/listado/(.*)/(.*)'] 						= "monitor/monitor/listado/$1/$2";
$route['backend/monitor/listado/(.*)/(.*)/(.*)'] 					= "monitor/monitor/listado/$1/$2/$3";
$route['backend/monitor/ficha_monitor/(.*)']						= "monitor/monitor/ficha/$1";
$route['backend/monitor/buscar']									= "monitor/monitor/buscar";
$route['backend/monitor/buscar/(.*)']								= "monitor/monitor/buscar/$1";


					/* Rutas Backend [Ingles] */

$route['backend/news']												= "noticia/noticia/listado";
$route['backend/news/directory']									= "noticia/noticia/listado";
$route['backend/news/save_details'] 								= "noticia/noticia/guardar_idioma";
$route['backend/news/create']										= "noticia/noticia/crear";
$route['backend/news/remove_article/(.*)']							= "noticia/noticia/delete/$1";
$route['backend/news/remove_details/(.*)']							= "noticia/noticia/eliminar_idioma/$1";
$route['backend/news/directory/noticia.id_noticia/desc/(:num)'] 	= "noticia/noticia/listado/noticia.id_noticia/desc/$1";
$route['backend/news/article_record/(.*)']							= "noticia/noticia/ficha/$1";
$route['backend/news/edit_article/(.*)']							= "noticia/noticia/edit/$1";
$route['backend/news/edit_details/(:num)/(:num)']					= "noticia/noticia/editar_idioma/$1/$2";
$route['backend/news/search']										= "noticia/noticia/buscar";
$route['backend/news/search/(.*)']									= "noticia/noticia/buscar/$1";


//*************************** RUTAS DE Camiones ***************************

$route['backend/camiones']											= "camion/camiones/listado";
$route['backend/camiones/directory']								= "camion/camiones/listado";
$route['backend/camiones/search']									= "camion/camiones/buscar";

//*************************** RUTAS DE Contacto ***************************


							/* Rutas Front [Español] */

//$route['contacto/boletin']		= "contacto/contacto_front/boletin_informativo";
//$route['contacto/boletin_email']	= "contacto/contacto_front/boletin_email";

$route['contacto']			= "contacto/contacto_front/contacto_wtc";
$route['contacto/procesar']	= "contacto/contacto_front/procesar_contacto";

							/* Rutas Front [Ingles] */

$route['contactus']			= "contacto/contacto_front/contacto_wtc";
$route['emailing_test']		= "contacto/contacto_front/emailing_test";

							/* Rutas Backend [Ingles] */

$route['contact']					= "contacto/contacto_front/contacto_wtc";
$route['contact/send_message']		= "contacto/contacto_front/emailing";
$route['contact/newsletter']	= "contacto/contacto_front/newsletter";

//*************************** Rutas de operadoras ***************************

$route['backend/operadoras']				= "operadora/operadora";
$route['backend/operadoras/buscar']			= "operadora/operadora/buscar";
$route['backend/operadoras/buscar/(.*)']	= "operadora/operadora/buscar/$1";
$route['backend/operadoras/crear']			= "operadora/operadora/crear";

$route['backend/networks']												= "operadora/operadora";
$route['backend/networks/directory/operadora.id_operadora/desc']		= "operadora/operadora/listado";
$route['backend/networks/directory/operadora.id_operadora/desc/(:num)']	= "operadora/operadora/listado/operadora.id_operadora/desc/$1";
$route['backend/networks/edit_network/(.*)']							= "operadora/operadora/edit/$1";
$route['backend/networks/network_record/(.*)']							= "operadora/ficha/$1";
$route['backend/networks/search']										= "operadora/operadora/buscar";
$route['backend/networks/search/(.*)']									= "operadora/operadora/buscar/$1";
$route['backend/networks/create']										= "operadora/operadora/crear";

//*************************** Rutas de participante ***************************

						/* Rutas de backend [Español]*/


						/* Rutas de backend [Ingles]*/

$route['backend/participants']								= "participante/participante";
$route['backend/participants/directory']					= "participante/participante/listado";
$route['backend/participants/search']						= "participante/participante/buscar";
$route['backend/participants/search/(.*)']					= "participante/participante/buscar/$1";
$route['backend/participants/participant_record/(:num)']	= "participante/participante/ficha/$1";
$route['backend/participants/edit_participant/(:num)']		= "participante/participante/edit/$1";
$route['backend/participants/save_participant/(:num)']		= "participante/participante/create/$1";



//*************************** Rutas de productos ***************************

$route['productos/(.*)']	= "producto/producto_front/$1";
$route['products/(.*)']		= "producto/producto_front/$1";


$route['productos']			= "producto/producto_front";
$route['products']			= "producto/producto_front";

$route['backend/productos']			= "producto/producto";
$route['backend/products']			= "producto/producto";

$route['backend/productos/?']											= "producto/producto/listado";
$route['backend/productos/listado/(.*)/(.*)']							= "producto/producto/listado/$1/$2";
$route['backend/productos/listado/(.*)/(.*)/(.*)']						= "producto/producto/listado/$1/$2/$3";
$route['backend/productos/guardar_idioma']								= "producto/producto/guardar_idioma";
$route['backend/productos/crear']										= "producto/producto/crear";
$route['backend/productos/eliminar_producto/(.*)']						= "producto/producto/delete/$1";
$route['backend/productos/eliminar_idioma/(.*)']						= "producto/producto/eliminar_idioma/$1";
$route['backend/productos/ficha_producto/(.*)']							= "producto/producto/ficha/$1";
$route['backend/productos/editar_producto/(.*)']						= "producto/producto/edit/$1";
$route['backend/productos/editar_idioma/(:num)/(:num)']					= "producto/producto/editar_idioma/$1/$2";
$route['backend/productos/buscar']										= "producto/producto/buscar";
$route['backend/productos/buscar/(.*)']									= "producto/producto/buscar/$1";
$route['backend/productos/imagenes/(:num)/adicionar/principal']			= "producto/producto/imagen/$1/1";
$route['backend/productos/imagenes/(:num)/adicionar/secundarias']		= "producto/producto/imagen/$1/2";
$route['backend/productos/imagenes/(:num)/eliminar']					= "producto/producto/imagen/$1";
$route['backend/productos/imagenes/procesar_imagenes']					= "producto/producto/imagen_procesar";
$route['backend/productos/imagenes/revision']							= "producto/producto/get_files";
$route['backend/productos/imagenes/eliminar']							= "producto/producto/imagen_eliminar";

//*************************** Rutas de productos ***************************


$route['portafolio/(.*)']		= "proyecto/proyecto_front/proyecto/$1";
$route['portfolio/(.*)']		= "proyecto/proyecto_front/proyecto/$1";

//$route['portafolio/proyecto/(.*)']		= "proyecto/proyecto_front/proyecto/$2";
//$route['portfolio/project/(.*)']		= "proyecto/proyecto_front/proyecto/$2";

$route['portafolio']			= "proyecto/proyecto_front";
$route['portfolio']				= "proyecto/proyecto_front";

$route['backend/proyecto']		= "proyecto/proyecto";
$route['backend/proyecto']		= "proyecto/proyecto";

//*************************** Rutas de participante ***************************

$route['profile']				= "participante/participante_front/perfil";


//*************************** Rutas de contacto ***************************

/*$route['contacto/?(.*)'] 	= "contacto/contacto_front/contacto/$1";
$route['contact/?(.*)'] 	= "front/modulo/contacto/$1";

$route['contactos/?(.*)'] 	= "front/modulo/contacto/$1";
$route['contacts/?(.*)'] 	= "front/modulo/contacto/$1";*/

$route['backend/contacts'] 								= "contacto/contacto";
$route['backend/contacts/directory']					= "contacto/contacto";
$route['backend/contacts/contact_record/(:num)']		= "contacto/contacto/ficha/$1";
$route['backend/contacts/download']						= "contacto/contacto/descarga";
$route['backend/contacts/download/email_list']			= "contacto/contacto/descargar_xls";

//*************************** Rutas de contacto ***************************


$route['cotizar/?(.*)'] 	= "front/modulo/contacto/$1";
$route['cotizacion/?(.*)'] 	= "front/modulo/contacto/$1";

//*************************** Rutas de trabajos ***************************

$route['backend/trabajos']			= "trabajo/trabajo";


				/* Rutas Backend [Ingles] */

$route['backend/jobs']								= "trabajo/trabajo";
$route['backend/jobs/job_record/(:num)']			= "trabajo/trabajo/ficha/$1";
$route['backend/jobs/remove_job/(:num)']			= "trabajo/trabajo/delete/$1";
$route['backend/jobs/edit_language/(:num)/(:num)']	= "trabajo/trabajo/editar_idioma/$1/$2";
$route['backend/jobs/edit_job/(:num)']				= "trabajo/trabajo/edit/$1";
$route['backend/jobs/remove_language/(:num)']		= "trabajo/trabajo/eliminar_idioma/$1";
$route['backend/jobs/save_language']				= "trabajo/trabajo/guardar_idioma";
$route['backend/jobs/search']						= "trabajo/trabajo/buscar";
$route['backend/jobs/search/(.*)']					= "trabajo/trabajo/buscar/$1";
$route['backend/jobs/create']						= "trabajo/trabajo/crear";


//*************************** Rutas de promocion ***************************

$route['backend/promociones/subscriptores/?']							= "promocion/subscriptores/listado";
$route['backend/promociones/subscriptores/(.*)/(.*)']					= "promocion/subscriptores/listado/$1/$2";
$route['backend/promociones/subscriptores/(.*)/(.*)/(.*)']				= "promocion/subscriptores/listado/$1/$2/$3";
$route['backend/promociones/ficha_subscriptor/(.*)']					= "promocion/subscriptores/ficha_subscriptor/$1";
$route['backend/promociones/editar_subscriptor/(.*)']					= "promocion/subscriptores/editar_subscriptor/$1";
$route['backend/promocion/generar_listado']								= "promocion/subscriptores/generar_listado_subscriptores";

$route['backend/promociones/?']											= "promocion/promocion/listado";
$route['backend/promociones/listado/(.*)/(.*)']							= "promocion/promocion/listado/$1/$2";
$route['backend/promociones/listado/(.*)/(.*)/(.*)']					= "promocion/promocion/listado/$1/$2/$3";
$route['backend/promociones/guardar_idioma']							= "promocion/promocion/guardar_idioma";
$route['backend/promociones/crear']										= "promocion/promocion/crear";
$route['backend/promociones/eliminar_promocion/(.*)']					= "promocion/promocion/delete/$1";
$route['backend/promociones/eliminar_idioma/(.*)']						= "promocion/promocion/eliminar_idioma/$1";
$route['backend/promociones/ficha_promocion/(.*)']						= "promocion/promocion/ficha/$1";
$route['backend/promociones/editar_promocion/(.*)']						= "promocion/promocion/edit/$1";
$route['backend/promociones/editar_idioma/(:num)/(:num)']				= "promocion/promocion/editar_idioma/$1/$2";
$route['backend/promociones/buscar']									= "promocion/promocion/buscar";
$route['backend/promociones/buscar/(.*)']								= "promocion/promocion/buscar/$1";
$route['backend/promociones/imagenes/(:num)/adicionar/principal']		= "promocion/promocion/imagen/$1/1";
$route['backend/promociones/imagenes/(:num)/adicionar/secundarias']		= "promocion/promocion/imagen/$1/2";
$route['backend/promociones/imagenes/(:num)/eliminar']					= "promocion/promocion/imagen/$1";
$route['backend/promociones/imagenes/procesar_imagenes']				= "promocion/promocion/imagen_procesar";
$route['backend/promociones/imagenes/revision']							= "promocion/promocion/get_files";
$route['backend/promociones/imagenes/eliminar']							= "promocion/promocion/imagen_eliminar";

//*************************** Rutas de premios ***************************

$route['backend/prizes']							= "premio/premios/listado";
$route['backend/prizes/directory']					= "premios/premios/listado";
$route['backend/prizes/directory/(.*)/(.*)']		= "premio/premios/listado/$1/$2";
$route['backend/prizes/directory/(.*)']				= "premio/premios/listado/$1";
$route['backend/prizes/prize_record/(:num)']		= "premio/premios/ficha/$1";
$route['backend/prizes/remove_prize/(:num)']		= "premio/premios/delete/$1";
$route['backend/prizes/edit_details/(:num)/(:num)']	= "premio/premios/editar_idioma/$1/$2";
$route['backend/prizes/edit_prize/(:num)']			= "premio/premios/edit/$1";
$route['backend/prizes/remove_details/(:num)']		= "premio/premios/eliminar_idioma/$1";
$route['backend/prizes/save_details']				= "premio/premios/guardar_idioma";
$route['backend/prizes/search']						= "premio/premios/buscar";
$route['backend/prizes/search/(.*)']				= "premio/premios/buscar/$1";
$route['backend/prizes/create']						= "premio/premios/crear";
$route['backend/prizes/create/(:num)']				= "premio/premios/create/$1";

//*************************** Rutas de usuarios ***************************

					/* Rutas Backend [Español] */

$route['backend/usuarios']									= "usuario/usuario";
$route['backend/usuarios/crear']							= "usuario/usuario/crear";
$route['backend/usuarios/listado']							= "usuario/usuario/listado";
$route['backend/usuarios/listado/(.*)']						= "usuario/usuario/listado/$1";
$route['backend/usuarios/listado/(.*)/(.*)']				= "usuario/usuario/listado/$1/$2";
$route['backend/usuarios/editar_lenguaje/(:num)/(:num)']	= "usuario/usuario/editar_idioma/$1/$2";
$route['backend/usuarios/editar_usuario/(:num)']			= "usuario/usuario/edit/$1";
$route['backend/usuarios/eliminar_detalles/(:num)']			= "usuario/usuario/eliminar_idioma/$1";
$route['backend/usuarios/eliminar_usuario/(:num)']			= "usuario/usuario/delete/$1";
$route['backend/usuarios/guardar_idioma']					= "usuario/usuario/guardar_idioma";
$route['backend/usuarios/buscar']							= "usuario/usuario/buscar";
$route['backend/usuarios/buscar/(.*)']						= "usuario/usuario/buscar/$1";
$route['backend/usuarios/ficha_usuario/(:num)']				= "usuario/usuario/ficha/$1";
$route['backend/usuarios/login']							= "usuarios/usuarios/login";
$route['backend/usuarios/logout']							= "usuarios/usuarios/logout";

/*$route['usuarios/signup']								= "participante/participante_front/registro";
$route['usuarios/check_signup']						= "participante/participante_front/check_registro";
$route['usuarios/signup/get_cities']					= "participante/participante_front/get_ciudades";
$route['profile/(.*)']								= "participante/participante_front/perfil";
$route['prizes']									= "premio/premio_front/premios";

$route['users/login']								= "participante/participante_front/login";
$route['users/mod_caps']							= "participante/participante_front/mod_caps";
$route['users/logout']								= "participante/participante_front/logout";
$route['users/graphic_data']						= "participante/participante_front/get_caps_datos";*/

					/* Rutas Backend [Ingles] */

$route['backend/users']								= "usuario/usuario";
$route['backend/users/create']						= "usuario/usuario/crear";
$route['backend/users/directory']					= "usuario/usuario/listado";
$route['backend/users/directory/(.*)']				= "usuario/usuario/listado/$1";
$route['backend/users/directory/(.*)/(.*)']			= "usuario/usuario/listado/$1/$2";
$route['backend/users/edit_details/(:num)/(:num)']	= "usuario/usuario/editar_idioma/$1/$2";
$route['backend/users/edit_user/(:num)']			= "usuario/usuario/edit";
$route['backend/users/remove_details/(:num)']		= "usuario/usuario/eliminar_idioma/$1";
$route['backend/users/remove_user/(:num)']			= "usuario/usuario/delete/$1";
$route['backend/users/save_details']				= "usuario/usuario/guardar_idioma";
$route['backend/users/search']						= "usuario/usuario/buscar";
$route['backend/users/search(.*)']					= "usuario/usuario/buscar/$1";
$route['backend/users/user_record/(:num)']			= "usuario/usuario/ficha/$1";
$route['backend/users/login']						= "usuarios/usuarios/login_form";
$route['backend/users/logout']						= "usuarios/usuarios/logout";

$route['users/signup']								= "participante/participante_front/registro";
$route['users/check_signup']						= "participante/participante_front/check_registro";
$route['users/signup/get_cities']					= "participante/participante_front/get_ciudades";
$route['profile/(.*)']								= "participante/participante_front/perfil";
$route['prizes']									= "premio/premio_front/premios";

$route['users/login']								= "participante/participante_front/login";
$route['users/mod_caps']							= "participante/participante_front/mod_caps";
$route['users/logout']								= "participante/participante_front/logout";
$route['users/graphic_data']						= "participante/participante_front/get_caps_datos";

						/* Rutas Backend [Ingles] */


//*************************** Rutas de usuarios ***************************

					/* Rutas Backend [Español] */

$route['backend/banners']									= "banner/banner/listado";
$route['backend/banners/crear']								= "banner/banner/crear";
$route['backend/banners/listado']							= "banner/banner/listado";
$route['backend/banners/listado/(.*)']						= "banner/banner/listado/$1";
$route['backend/banners/listado/(.*)/(.*)']					= "banner/banner/listado/$1/$2";
$route['backend/banners/editar_lenguaje/(:num)/(:num)']		= "banner/banner/editar_idioma/$1/$2";
$route['backend/banners/eliminar_detalles/(:num)']			= "banner/banner/eliminar_idioma/$1";
$route['backend/banners/eliminar_banner/(:num)']			= "banner/banner/delete/$1";
$route['backend/banners/guardar_idioma']					= "banner/banner/guardar_idioma";
$route['backend/banners/buscar']							= "banner/banner/buscar";
$route['backend/banners/buscar/(.*)']						= "banner/banner/buscar/$1";
$route['backend/banners/ficha_banner/(:num)']				= "banner/banner/ficha/$1";

$route['backend/banners/?']										= "banner/banner/listado";
$route['backend/banners/listado/(.*)/(.*)'] 					= "banner/banner/listado/$1/$2";
$route['backend/banners/listado/(.*)/(.*)/(.*)'] 				= "banner/banner/listado/$1/$2/$3";
//$route['backend/banners/guardar_idioma']						= "banner/banner/guardar_idioma";
$route['backend/banners/crear']									= "banner/banner/crear";
$route['backend/banners/eliminar_banner/(.*)']					= "banner/banner/delete/$1";
//$route['backend/banners/eliminar_idioma/(.*)']				= "banner/banner/eliminar_idioma/$1";
$route['backend/banners/ficha_banner/(.*)']						= "banner/banner/ficha/$1";
$route['backend/banners/editar_banner/(:num)']					= "banner/banner/edit/$1";
//$route['backend/banners/editar_idioma/(:num)/(:num)']			= "banner/banner/editar_idioma/$1/$2";
$route['backend/banners/buscar']								= "banner/banner/buscar";
$route['backend/banners/buscar/(.*)']							= "banner/banner/buscar/$1";
$route['backend/banners/imagenes/(:num)/adicionar/principal']	= "banner/banner/imagen/$1/1";
//$route['backend/banners/imagenes/(:num)/adicionar/secundarias']	= "banner/banner/imagen/$1/2";
$route['backend/banners/imagenes/(:num)/eliminar']				= "banner/banner/imagen/$1";
$route['backend/banners/imagenes/procesar_imagenes']			= "banner/banner/imagen_procesar";
$route['backend/banners/imagenes/revision']						= "banner/banner/get_files";
$route['backend/banners/imagenes/eliminar']						= "banner/banner/imagen_eliminar";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
