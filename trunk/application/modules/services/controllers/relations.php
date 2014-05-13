<?php

class Relations extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('services_model');
        if ($this->session->userdata('idioma')=='')  $this->session->set_userdata('idioma','es');
		modules::run('idioma/set_idioma',$this->session->userdata('idioma'));
        //echo 'session idioma '.$this->session->userdata('idioma');
        //echo modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'),'true');
		$this->id_idioma=modules::run('idioma/get_idioma_id_from_code',$this->session->userdata('idioma'));
		$this->lang->load('front');
		
	}
	
	function index()
	{
		
	}
	
	function tabla_url($tabla, $url)
	{
		$this->db->where('url', $url);
		return $this->db->get('detalle_'.$tabla)->result();
	}
	
	
function str_month_to_num($mes,$ajax=false){
	//$this->load->lang('calendar');
	if (is_numeric($mes)) return $mes;
	$meses=array(	strtolower(lang('cal_january'))=>1,
					strtolower(lang('cal_february'))=>2,
					strtolower(lang('cal_march'))=>3,
					strtolower(lang('cal_april'))=>4,
					strtolower(lang('cal_mayl'))=>5,
					strtolower(lang('cal_june'))=>6,
					strtolower(lang('cal_july'))=>7,
					strtolower(lang('cal_august'))=>8,
					strtolower(lang('cal_september'))=>9,
					strtolower(lang('cal_october'))=>10,
					strtolower(lang('cal_november'))=>11,
					strtolower(lang('cal_december'))=>12
					);
					//echo '<pre>'.print_r($meses,true).'</pre>';
	if ($ajax) echo str_pad($meses[$mes],2,'0',STR_PAD_LEFT);
	else return str_pad($meses[$mes],2,'0',STR_PAD_LEFT);
}
	function get_from_categoria($id_categoria,$type,$ajax=false,$front=false,$where=''){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$ret=$this->services_model->get_all($type,$id_categoria,$where,$front);
		
		if ($ajax) echo json_encode($ret);
		else return $ret;
	}
	function get_from($type='producto',$campo,$valor,$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		$w=array($campo=>$valor);
		$ret=$this->services_model->get_all($type,'',$w);
		if ($ajax) echo json_encode($ret);
		else return $ret;
	}
	
	function get_from_id($type,$id,$ajax=false,$front=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
        $ret=$this->services_model->get_from_id($type,$id,$front);
		if ($ajax){
			echo json_encode($ret);
        }else{

           // $ret->biografia=str_replace("\0","",$ret->biografia);
            //echo '<pre>'.print_r($ret,true).'</pre>';
			return $ret;
        }
	}

    function get_categorias_raiz($ajax=false){
    	$id_parent='0';
		//$cats=$this->services_model->get_categorias($id_parent);
		$cats=$this->services_model->get_categorias_one_level(0,$ajax);
        //echo '<pre>'.print_r($cats,true).'</pre>';
		if ($ajax=='pre') echo '<pre>'.print_r($cats,true).'</pre>';
		elseif ($ajax) echo json_encode($cats);

		else return $cats;

	}

	/**
	 * Obtiene categorías hijas de $id_parent
	 *
	 * @param	integer	$id_parent
	 * @param	boolean	$ajax
	 * 
	 * @return	mixed
	 */
    function get_categorias_deprecado($id_parent=0, $ajax=false,$destacado='') {
    	
    	//if($id_parent=='0') $cats=$this->services_model->get_categorias(0);
		if(isset($destacado)&&$destacado!='') { $cats = $this->services_model->get_categorias($id_parent,$ajax,$destacado); }
		else { $cats = $this->services_model->get_categorias($id_parent); }

		//echo '<pre>'.print_r($cats,true).'</pre>';
		
		return $ajax ? json_encode($cats) : $cats;
		
		//if ($ajax=='pre') echo '<pre>'.print_r($cats,true).'</pre>';
		//elseif ($ajax) echo json_encode($cats);
		//else return $cats;

	}
	
	function get_categorias($tipo_cat = '', $id_parent = 0, $ajax = false, $destacado = '')
	{

        if (isset($destacado) && $destacado != '') {
            $cats = $this->services_model->get_categorias($tipo_cat, $id_parent, $ajax, $destacado);
        } else {
            $cats = $this->services_model->get_categorias($tipo_cat, $id_parent);
        }

        return $ajax ? json_encode($cats) : $cats;
    }
	
    function get_carrusel($id_parent = 0, $ajax = false) {
    	//if($id_parent=='0') $cats=$this->services_model->get_categorias(0);
		
    	$cats = $this->services_model->get_carrusel($id_parent);
        
		//echo '<pre>'.print_r($cats,true).'</pre>';
		
		if ($ajax=='pre') {
			echo '<pre>'.print_r($cats,true).'</pre>';
		} else if ($ajax) {
			echo json_encode($cats);
		}
		
		return $cats;
	}
	
	function get_categoria_path($id_categoria=0,$ajax=false){
		$cats=$this->services_model->get_categoria_path($id_categoria);
		if ($ajax=='pre') echo '<pre>'.print_r($cats,true).'</pre>';
		elseif ($ajax) echo json_encode($cats);
		else return $cats;
	}
	function concat_cat_names($cat){
		//echo '<pre>'.print_r($cat,true).'</pre>';
		if (empty($cat)) return false;
		$tmp[$cat['id_categoria']]=($cat['nombre']!='' ? $cat['nombre'] : $cat['id_categoria']);
		if (isset($cat['parent'])){

			$tmp[$cat['parent']['id_categoria']]=$this->concat_cat_names($cat['parent']);
			//return array_merge($tmp,$tmp2);
		}
        //echo '<pre>'.print_r($tmp,true).'</pre>';
		return $tmp;
	}

    function flatten($a,$f=array()){
      if(!$a||!is_array($a))return '';
      foreach($a as $k=>$v){
        if(is_array($v))$f=$this->flatten($v,$f);
        else $f[$k]=$v;
      }
      return $f;
    }

   /*
	function flatten(array $array) {
		//$objTmp = (object) array('aFlat' => array());

        function essai($v, $k){
            $t[$k] = $v[$k];
            return $t;

        }
        array_walk_recursive($array, 'essai');
	    //array_walk_recursive($array, create_function('&$v, $k, &$t', '$t->aFlat[$k] = $v;'), $objTmp);


		//function re($a,$k){ $return[$k] = $a;return $return;}
		//$return = array();
		//array_walk_recursive($array, 're');

		///return $array;



		echo '<pre>'.print_r($array,true).'</pre>';
		return $array;
	}
    * */
    
    /*
	 * Usando tipos de categorias
	 * 
	 * */
	function arbol_categorias($tipo_cat = '', $current_cat_id = 0, $current_padre_id = 0, $type = 'categoria', $ajax = true, $cats = array(), $niveles = 99999999999)
    {
    	
        $ret 		= '';
        $first_run 	= false;
		
        if (empty($cats))
        {
            $cats 		= modules::run('services/relations/get_categorias', $tipo_cat, '0');
            $first_run 	= true;
        }
		
        if ($type == 'categoria' && empty($cats)) $ret.='id_categoria';
        
        if (is_array($cats) && !empty($cats))
        {
            $niveles = $niveles - 1;
			
            foreach ($cats as $cat)
            {
                $data = array(	'name' 		=> 'id_categoria_padre',
			                    'id' 		=> 'categoria' . $cat['id_categoria'],
			                    'value' 	=> $cat['id_categoria'],
			                    'checked' 	=> false,
			                    'class' 	=> 'radio'
                );

                if ($type == 'producto')
                {
                    $data['name'] = 'id_categoria';
                    if ($first_run && $current_cat_id == 0) $data['disabled'] = 'disabled';
                }

				/*
                if ($current_cat_id == $cat['id_categoria'] || ($niveles==0 && $type == 'categoria'))
                {
					$data['name'] = "disabled";
					$data['disabled'] = "disabled";
				}
				*/
				
                if ($current_padre_id == $cat['id_categoria']) $data['checked'] = true;

                $data['checked'] = (set_radio($data['name'], $data['value']) ? set_radio($data['name'], $data['value']) : $data['checked']);
				
				//if(strtolower($cat['nombre']) == strtolower('Sub-Categoria A')) die_pre($data['checked']);
				
                if($type == 'producto' && $niveles == 2)
				
				$first_run = true;
				
                if ($first_run == true && $type == 'producto')
                {
                    //CAMBIA ESTO COMO QUIERAS
                    $toggle = (isset($cat['child']) && !empty($cat['child']) ) ? '<span class="round label togg" style="font-size: 12px; font-family: monospace; text-aling: middle; cursor: pointer; background-color: #0077BF;">-</span>' : '';
					$ret.= '<li>'.$toggle.' <strong>' . ($cat['nombre'] != '' ? ucwords($cat['nombre']) : 'Sin Nombre' /*$cat['id_categoria']*/).'</strong>';
                    //$ret.='<li id="0" ><a href"#">' . ($cat['nombre'] != '' ? ucwords($cat['nombre']) : $cat['id_categoria']) . '</a>';
                }
                else
                {
                	//$data['class'] = "jsTree_radio";
                    //$ret .= '<li id="' . $cat['id_categoria'] . '">' . form_radio($data) . '<a href="#">' . $cat['nombre'] . '</a>';
                    $toggle = (isset($cat['child']) && !empty($cat['child']) ) ? '<span class="round label togg" style="font-size: 12px; font-family: monospace; text-aling: middle; cursor: pointer;">-</span>' : '';
				    $ret.='<li style="padding-left:20px; margin-top: 6px;" >'.$toggle.' '.form_radio($data).' <span>'.($cat['nombre']!='' ? ucwords($cat['nombre']) : 'Sin Nombre' /*$cat['id_categoria']*/).'</span>';
                }
				
                if (isset($cat['child']) && $niveles > 0)
				{
                    $ret.=$this->arbol_categorias($tipo_cat, $current_cat_id, $current_padre_id, $type, false, $cat['child'], $niveles);
				}
                $ret.='</li>';
            }

            if ($type == 'categoria' && $first_run)
            {
				//$raiz = modules::run('services/relations/get_nombre_tipo_cat', $tipo_cat);
                //$ret = '<li id="0"><input id="categoria0" name="id_categoria_padre" value="0" type="radio" class="jsTree_radio" ' . ($current_padre_id == 0 ? ' checked="checked"' : '') . ' /><a href="#">' . $raiz . '</a><ul>' . $ret . '</ul></li>';
				$ret = '<li><label for="categoria0" class="inputRadio"><input id="categoria0" name="id_categoria_padre" value="0" type="radio"'.($current_padre_id==0 ? ' checked="checked"' : '').' /> <span>Agregar como categoría en primer nivel</span></label><ul style="list-style: none;">'.$ret.'</ul></li>';
			}
			if ($ajax)
                echo '<ul style="list-style: none;" >' . $ret . '</ul>';
				//echo '<ul' . ($first_run == true ? ' class="' . $class . '"' : '') . '>' . $ret . '</ul>';
            else
                return '<ul style="list-style: none;" >' . $ret . '</ul>';
				//return '<ul' . ($first_run == true ? ' class="' . $class . '"' : '') . '>' . $ret . '</ul>';
        }
        else
        {
            if ($ajax)
                echo "false";
            else
                return false;
        }
    }
    
    function arbol_categorias_deprecado($current_cat_id = 0 , $current_padre_id = 0, $type = 'categoria', $ajax = false, $cats = array(), $niveles = 9999999)
    {
		$ret = '';
        $first_run = false;
		
		if(empty($cats))
		{
			$cats = modules::run('services/relations/get_categorias','0');
			$first_run = true;
		}
		
		if($type == 'categoria' && empty($cats)) $ret.='id_categoria';
		
		if(is_array($cats) && !empty($cats))
		{
            $niveles = $niveles - 1;
			foreach($cats as $cat)
			{
				//echo '<pre>'.print_r($cat,true).'</pre>';
				
				$data = array(	'name'		=> 'id_categoria_padre',
								'id'		=> 'categoria'.$cat['id_categoria'],
								'value'		=> $cat['id_categoria'],
								'checked'	=> false,
                    			'class'		=>'radio' );

				if ($type == 'producto')
				{
                    $data['name'] = 'id_categoria';
					
                    if ($first_run && $current_cat_id == 0)
                        $data['disabled']='disabled';
                }

				if ($current_cat_id == $cat['id_categoria']) $data['disabled'] = "disabled";
				if ($current_padre_id == $cat['id_categoria']) $data['checked'] = true;

                //$ret.= $current_padre_id.'=='.$cat['id_categoria'].'<br>';
				
                $data['checked'] = (set_radio($data['name'],$data['value']) ? set_radio($data['name'],$data['value']) : $data['checked']);
               
			    //echo $data['name'].(string)$data['checked'];
				//echo '<pre>'.print_r($data,true).'</pre>';
				//echo $current_cat_id;
				
				//Imprimir Arbol en html
                if ($first_run == true && $type == 'producto')
                {
                    //CAMBIA ESTO COMO QUIERAS
                    $ret.= '<li><strong>' . ($cat['nombre'] != '' ? ucwords($cat['nombre']) : $cat['id_categoria']).'</strong>';
                }
                else
                {
                	$toggle = (isset($cat['child'])) ? '<span class="round label togg" style="font-size: 12px; font-family: monospace; text-aling: middle; cursor: pointer;">-</span>' : '';
				    $ret.='<li style="padding-left:20px; margin-top: 6px;" >'.$toggle.' '.form_radio($data).' <span>'.($cat['nombre']!='' ? ucwords($cat['nombre']) : $cat['id_categoria']).'</span>';
                }
				//die_pre($niveles);
				//Caso recursivo
                if (isset($cat['child']) && $niveles > 0)
				{
					//pre($current_cat_id); pre($current_padre_id); pre($type); pre($cat['child']); pre($niveles); die();
                	$ret.= $this->arbol_categorias($current_cat_id, $current_padre_id, $type, false, $cat['child'], $niveles);
				}
				
				$ret.='</li>';
				
			}
			
			if ($type == 'categoria' && $first_run)
				$ret = '<li><label for="categoria0" class="inputRadio"><input id="categoria0" name="id_categoria_padre" value="0" type="radio"'.($current_padre_id==0 ? ' checked="checked"' : '').' /> <span>Agregar como categoría en primer nivel</span></label><ul style="list-style: none;">'.$ret.'</ul></li>';
			
			$class = ($type=='producto' ? 'cats cats_js' : 'cats');
			
            if ($ajax)
            	echo '<ul style="list-style: none;" '.($first_run == true ? ' class="'.$class.'"' : '').'>'.$ret.'</ul>';
			else
				return '<ul style="list-style: none;" '.($first_run == true ? ' class="'.$class.'"' : '').'>'.$ret.'</ul>';
		}
		else
		{
			if ($ajax)
				echo "false";
			else
				return false;

		}

	}


    function get_categorias_optgroup($parent=0,$ajax=false){

        $familias=$this->services_model->get_categorias_one_level($parent,false);
        

        foreach($familias as $familia){
            //echo '<pre>'.print_r($familia,true).'</pre>';
            $key=($familia['nombre']!='' ? $familia['nombre'] : 'Familia '.$familia['id_categoria']);
            $categorias= $this->services_model->get_categorias_one_level($familia['id_categoria'],false);
            foreach($categorias as $categoria){
                $cats[$key][$categoria['id_categoria']]=($categoria['nombre']!='' ? $categoria['nombre'] : 'Categoria '.$categoria['id_categoria']);
            }
            //$cats[$key]=$this->services_model->get_categorias_one_level($familia['id_categoria'],false);
        }
        if ($ajax) echo '<pre>'.print_r($cats,true).'</pre>';
        return $cats;
        //echo '<pre>'.print_r($cats,true).'</pre>';

    }

    
    function get_productos_optgroup($parent=0,$ajax=false){

    	
        $familias=$this->services_model->get_categorias_one_level($parent,false);
    	    
			
        foreach($familias as $familia){
           // echo '<pre>'.print_r($familia,true).'</pre>';
            $key=($familia['nombre']!='' ? $familia['nombre'] : 'Familia '.$familia['id_categoria']);
            
            //$categorias= $this->services_model->get_categorias_one_level($familia['id_categoria'],false);
            
            $productos = $this->get_from_categoria($familia['id_categoria'], 'producto');
            //echo '<pre>PRODUCTO '.$key.' '.print_r($productos,true).'</pre>';
            foreach($productos as $producto){
            	$nombre = ($producto->nombre!='' ? $producto->nombre : 'Producto '.$producto->id_producto);
            	$value_producto = '['.$producto->codigo_coloplas.'] - '.$nombre;
                $cats[$key][$value_producto]=$nombre;
            }
            //$cats[$key]=$this->services_model->get_categorias_one_level($familia['id_categoria'],false);
        }
        
        
        if ($ajax) echo '<pre>'.print_r($cats,true).'</pre>';
        return $cats;
        //echo '<pre>'.print_r($cats,true).'</pre>';

    }
       
	function create_url($title='',$ajax='true'){
		if ($ajax) echo url_title(urldecode($title));
		else return url_title(urldecode($title));
		
		// if ($ajax) echo url_title(urldecode($title),'underscore',true);
		//else return url_title(urldecode($title),'underscore',true);
		/*
		 if ($ajax) echo $this->cleanURL($title);
		else return $this->cleanURL($title);
		*/
	}
	
	function cleanURL($toClean) {
	$var['normalizeChars'] = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
	);
	$toClean     =     str_replace('&', '-and-', $toClean);
    //$toClean     =    trim(preg_replace('/[^\w\d_ -]/si', '', $toClean));//remove all illegal chars
    $toClean     =     str_replace(' ', '_', $toClean);
    $toClean     =     str_replace('--', '-', $toClean);
   
    return strtolower (strtr($toClean, $var['normalizeChars']));
	}


	function get_categoria_bc($id_categoria=0,$ajax=false){
        //if ($id_categoria==0) return 0;
        $ret=array();
		$cats=$this->services_model->get_categoria_path($id_categoria);
        //echo '<pre>'.print_r($cats,true).'</pre>';
        //die();
		$a=$this->concat_cat_names($cats);
        //echo '<pre>'.print_r($a,true).'</pre>';
        //die();
		if ($a){
			$ret=$this->flatten($a);
			$ret[0]='Raíz';
		}
		$ret=array_reverse($ret,true);
		if ($ajax=='pre') echo '<pre>'.print_r($ret,true).'</pre>';
		elseif ($ajax) echo json_encode($ret);
		else return $ret;
	}

	function get_id_from_url($type,$url,$ajax=false){
		//if ($type=='usuarios' || $type=='monitor')
			//modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		if ($ajax)
			echo $this->services_model->get_id_from_url($type,$url);
		else
			return $this->services_model->get_id_from_url($type,$url);
	}
	function get_all($type,$ajax=false,$where='',$front=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//if ($type=='categoria' && $where=='') $where=array('canal'=>'');
		
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,false,$where,$front));
		else
			return $this->services_model->get_all($type,false,$where,$front);
	}

	function get_last($type,$ajax=false,$where='',$front=false){
//		if ($type=='usuarios' || $type=='monitor')
//			modules::run('usuarios/is_logged_in','admin');
		//if ($type=='categoria' && $where=='') $where=array('canal'=>'');
		$order = $type.'.id_'.$type;
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,false,$where,$front,$order));
		else
			return $this->services_model->get_all($type,false,$where,$front,$order);
	}
		
	function get_all_orderby($type,$ajax=false,$where='',$front=false,$order=''){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//if ($type=='categoria' && $where=='') $where=array('canal'=>'');
		
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,false,$where,$front,$order));
		else
			return $this->services_model->get_all($type,false,$where,$front,$order);
	}	
	
	function get_all_from_categoria($type,$ajax=false,$categoria='',$front=false){
		//if ($type=='usuarios' || $type=='monitor')
		//	modules::run('usuarios/is_logged_in','admin');
		//if ($type=='categoria' && $where=='') $where=array('canal'=>'');
		
			$where = array("id_categoria"=>$categoria);
		
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,false,$where,$front));
		else
			return $this->services_model->get_all($type,false,$where,$front);
	}	
	function get_all_from_categoria_array($type,$ajax=false,$categoria='',$front=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//if ($type=='categoria' && $where=='') $where=array('canal'=>'');
		
			$where = array("id_categoria"=>$categoria);
		
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,false,$where,$front,'',true));
		else
			return $this->services_model->get_all($type,false,$where,$front,'',true);
	}	
	
	function get_where($type,$where,$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//echo $where;
		if (!is_array($where) && !empty($where) && json_decode($where,true))
			$w=json_decode($where,true);
		else
			$w=$where;
		//echo '<pre>'.print_r($w,true).'</pre>';
		if ($ajax)
			echo json_encode($this->services_model->get_all($type,'',$w));
		else
			return $this->services_model->get_all($type,'',$w);
			
	}
	//modules::run('services/relations/get_rel','detalle_obra','tag',$obra->id_detalle_obra,'true')
	function get_rel($type,$rel_type,$id_type,$ajax=false,$group=false,$where=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$tipo='';
		if ($rel_type=='imagen'){
			$rel_type='multimedia';
			$tipo=1;
		}
		if ($rel_type=='catalogo'){
			$rel_type='multimedia';
			$tipo=3;
		}
		if ($rel_type=='video'){
			$rel_type='multimedia';
			$tipo=2;
		}
        if ($rel_type=='pdf'){
			$rel_type='multimedia';
			$tipo=4;
		}
		if ($ajax)
			echo json_encode($this->services_model->get_rel($type,$rel_type,$id_type,$tipo,$group,$where));
		else
			return $this->services_model->get_rel($type,$rel_type,$id_type,$tipo,$group,$where);
	}
	//modules::run('services/relations/get_rel','detalle_obra','tag',$obra->id_detalle_obra,'true')
	function search_rel($type,$idioma,$str,$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin',$this->uri->uri_string());
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		if ($ajax)
			echo json_encode($this->services_model->search_rel($type,$idioma,$str));
		else
			return $this->services_model->search_rel($type,$idioma,$str);
	}
	function insert_rel($type,$rel_type,$data,$id_type,$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		if ($rel_type=='imagen'){
			$rel_type='multimedia';
			$tipo=1;
		}
		if ($rel_type=='catalogo'){
			$rel_type='multimedia';
			$tipo=3;
		}
		if ($rel_type=='video'){
			$rel_type='multimedia';
			$tipo=2;
		}
        if ($rel_type=='enlace'){
			$rel_type='multimedia';
			$tipo=4;
		}
		
		
		if($type==$rel_type) $rt=$rel_type.'_relacionado';
		else $rt=$rel_type;
		$ok=true;
		if ($this->db->table_exists('rel_'.$type.'_'.$rel_type)){
			$link_table='rel_'.$type.'_'.$rel_type;
		}else{
			$link_table='rel_'.$rel_type.'_'.$type;
		}
		foreach($data as $d){
            if($type!=$rel_type || $id_type!=$d){
                $ins=array('id_'.$type=>$id_type,'id_'.$rt=>$d);
                //if (isset($tipo)) $ins['id_tipo']=$tipo;
                //echo '<pre>'.print_r($ins,true).'</pre>';
                $ok=$this->services_model->insert($link_table,$ins);
                //echo '<pre>'.print_r($ok,true).'</pre>';
                if($type==$rel_type) {
                    $ins2=array('id_'.$rt=>$id_type,'id_'.$type=>$d);
                    //echo '<pre>'.print_r($ins,true).'</pre>';
                    $ok=$this->services_model->insert($link_table,$ins2);
                }
            }
		}
		//echo 'aaaa';

		return ($ajax ? '[{result:'.($ok==true ? 'true' : $this->db->last_query(). '<pre>'.print_r($ins,true).'</pre>'.$ok).'}]' : $ok);
	}

	function rol_insert_rel($rol,$type,$rel_type,$data,$id_type,$ajax=false){
		if ($type=='usuarios' || $type=='monitor') modules::run('usuarios/is_logged_in','editor');
		elseif ($type=='receta') modules::run('usuarios/is_logged_in_rol',$rol);
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		if ($rel_type=='imagen'){$rel_type='multimedia';$tipo=1;}
		if ($rel_type=='catalogo'){$rel_type='multimedia';$tipo=3;}
		if ($rel_type=='video'){$rel_type='multimedia';$tipo=2;}
        if ($rel_type=='enlace'){$rel_type='multimedia';$tipo=4;}
		
		if($type==$rel_type) $rt=$rel_type.'_relacionado';
		else $rt=$rel_type;
		$ok=true;
		if ($this->db->table_exists('rel_'.$type.'_'.$rel_type)){$link_table='rel_'.$type.'_'.$rel_type;}
		else{$link_table='rel_'.$rel_type.'_'.$type;}
		foreach($data as $d){
            if($type!=$rel_type || $id_type!=$d){$ins=array('id_'.$type=>$id_type,'id_'.$rt=>$d);$ok=$this->services_model->insert($link_table,$ins);
				 if($type==$rel_type) {$ins2=array('id_'.$rt=>$id_type,'id_'.$type=>$d); $ok=$this->services_model->insert($link_table,$ins2);}
            }
		}
		return ($ajax ? '[{result:'.($ok==true ? 'true' : $this->db->last_query(). '<pre>'.print_r($ins,true).'</pre>'.$ok).'}]' : $ok);
	}
	
	function tag_exists($tag,$id_idioma,$ajax=false){
		$tags=$this->services_model->search_rel('tag',$id_idioma,$tag,2);
		if ($ajax) echo json_encode($tags);
		else return $tags;
		
	}
	function insert_tag($tag_name,$type,$id_detalle,$id_idioma){
		modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		if ($tag=$this->tag_exists($tag_name,$id_idioma)){
			$data['rel'][0]=array('id_tag'=>$tag[0]->id_tag,'id_'.$type=>$id_detalle);
			$this->services_model->insert_rel($data,$type,'tag');
			//echo '<pre>'.print_r($data,true).'</pre>';
		}
		else{
			$tag_data=array('tag'=>$tag_name,'id_idioma'=>$id_idioma,'id_estado'=>'1');
			$id=$this->services_model->insert('tag',$tag_data);
			$data['rel'][0]=array('id_tag'=>$id,'id_'.$type=>$id_detalle);
			$this->services_model->insert_rel($data,$type,'tag');
		}
		//check if tag exist
		//if it does, insert in rel_detalle_obra_tag
		//if not insert_new tag($tag_data);
		//and then insert into rel_detalle_obra_tag
	}
	function rol_insert_tag($rol,$tag_name,$type,$id_detalle,$id_idioma){
		if ($type=='usuarios' || $type=='monitor') modules::run('usuarios/is_logged_in','editor');
		elseif ($type=='receta') modules::run('usuarios/is_logged_in_rol',$rol);
		
		if ($tag=$this->tag_exists($tag_name,$id_idioma)){
			$data['rel'][0]=array('id_tag'=>$tag[0]->id_tag,'id_'.$type=>$id_detalle);
			$this->services_model->insert_rel($data,$type,'tag');
		}
		else{
			$tag_data=array('tag'=>$tag_name,'id_idioma'=>$id_idioma,'id_estado'=>'1');
			$id=$this->services_model->insert('tag',$tag_data);
			$data['rel'][0]=array('id_tag'=>$id,'id_'.$type=>$id_detalle);
			$this->services_model->insert_rel($data,$type,'tag');
		}
	}
	function insert_image($name,$id_type,$type='producto',$tipo_img=''){
		
		modules::run('usuarios/is_logged_in','editor');
		$id= $this->services_model->insert_multimedia($name,1,$tipo_img);
		$data['rel'][0]['id_'.$type]=$id_type;
		$data['rel'][0]['id_multimedia']=$id;
		//$data['rel'][0]['type']=$tipo_img;
		$this->services_model->insert_rel($data,$type,'multimedia');
		$detalle['id_multimedia']=$id;
		$detalle['id_idioma']=1;
		$this->services_model->insert('detalle_multimedia',$detalle);
		return $id;
	}
	function insert_detalle_multimedia($data){
		modules::run('usuarios/is_logged_in','editor');
		$res=$this->services_model->insert_detalle_multimedia($data);
		
		echo $res;
	}
	function convert_to_url($str='',$ajax=true){
		if ($str=='') return;
		if ($ajax)
			echo url_title($str, 'underscore', TRUE);
		else
			return url_title($str, 'underscore', TRUE);
	}
	function get_all_rel($type,$rel_type,$id_type,$ajax=false,$group=false,$where=''){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$tipo='';
		if ($rel_type=='video'){
			$rel_type='multimedia';
			$tipo=2;
		}
		if ($rel_type=='imagen'){
			$rel_type='multimedia';
			$tipo=1;
		}
		if ($rel_type=='catalogo'){
			$rel_type='multimedia';
			$tipo=3;
		}
        if ($rel_type=='enlace'){
			$rel_type='multimedia';
			$tipo=4;
		}
		
		$ret=$this->services_model->get_rel($type,$rel_type,$id_type,$tipo,$group,$where);
		if($ajax) echo json_encode($ret);
		else return $ret;
	}
	
	
	function get_all_rel_front($type,$rel_type,$id_type,$ajax=false,$w=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		//modules::run('usuarios/is_logged_in','editor',$this->uri->uri_string());
		$tipo='';
		if ($rel_type=='video'){
			$rel_type='multimedia';
			$tipo=2;
		}
		if ($rel_type=='imagen'){
			$rel_type='multimedia';
			$tipo=1;
		}
		if ($rel_type=='catalogo'){
			$rel_type='multimedia';
			$tipo=3;
		}
        if ($rel_type=='enlace'){
			$rel_type='multimedia';
			$tipo=4;
		}
		$where="(detalle_$rel_type.id_idioma ='".$this->id_idioma."' OR $rel_type.id_$rel_type NOT IN (SELECT id_$rel_type FROM detalle_$rel_type WHERE id_idioma='".$this->id_idioma."')) AND $rel_type.id_estado= '1'";
		if($w) $where .=" AND ".$w;
		
		$ret=$this->services_model->get_rel($type,$rel_type,$id_type,$tipo,false,$where);
		if($ajax) echo json_encode($ret);
		else return $ret;
	}
	
	function relacionados($type,$id_type,$ajax=true){
		if ($ajax)
			echo json_encode($this->destacados($type,$id_type));
		else
			return $this->destacados($type,$id_type);
	}
	
	
	function destacados($type,$id_type,$tipos_relacionados=array('imagen','video','coleccion','obra','artista','microsite','catalogo','serie','exposicion','publicacion','enlace')){
		
		if ($type=='coleccion' || $type==='exposicion') unset($tipos_relacionados[array_search('obra',$tipos_relacionados)]);
		foreach($tipos_relacionados as $tipo_rel){
            $dest_tipo=array();
			$rel_type=$tipo_rel;
			if ($tipo_rel=='video'){
				$rel_type='multimedia';
				$tipo=2;
			}
			if ($tipo_rel=='imagen'){
				$rel_type='multimedia';
				$tipo=1;
			}
			if ($tipo_rel=='catalogo'){
				$rel_type='multimedia';
				$tipo=3;
			}
            if ($rel_type=='enlace'){
                $rel_type='multimedia';
                $tipo=4;
            }

			$where="(detalle_$rel_type.id_idioma ='".$this->id_idioma."' OR $rel_type.id_$rel_type NOT IN (SELECT id_$rel_type FROM detalle_$rel_type WHERE id_idioma='".$this->id_idioma."')) AND $rel_type.id_estado= '1'";
			$dest_tipo=$this->services_model->get_rel($type,$rel_type,$id_type,$tipo,false,$where);
            if (count($dest_tipo)>10){
                shuffle($dest_tipo);
                $data['dest_'.$tipo_rel]=array_slice( $dest_tipo, 0, 10);
            }else{
                $data['dest_'.$tipo_rel]= $dest_tipo;
            }
			//$data[$tipo_rel]=$this->get_all_rel($type,$tipo_rel,$id_type,false,false,array($tipo.'.id_estado'=>1));
			
		}
		//echo '<pre>'.print_r($data,true).'</pre>';
		return $data;
	}
	function update($table,$campo,$valor,$id){
		if ($table=='usuarios' || $table=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		else modules::run('usuarios/is_logged_in','editor');
		
		return $this->services_model->update($table,$campo,$valor,$id);
	}
	function delete($type,$rel_type,$id_type='',$id_rel_type='',$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		else modules::run('usuarios/is_logged_in','editor');
		$r=$this->services_model->delete($type,$rel_type,$id_type,$id_rel_type);
		if ($ajax) echo '[{result:'.($r==true ? 'true' : 'false').'}]';
		else return $r;
		
	}
	function rol_delete($rol, $type,$rel_type,$id_type='',$id_rel_type='',$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		elseif($type =='receta' || $type =='detalle_receta') modules::run('usuarios/is_logged_in_rol',$rol);
		else modules::run('usuarios/is_logged_in','editor');
		
		$r=$this->services_model->delete($type,$rel_type,$id_type,$id_rel_type);
		if ($ajax) echo '[{result:'.($r==true ? 'true' : 'false').'}]';
		else return $r;
		
	}
	function delete_one_rel($type,$rel_type,$id_type,$id_rel_type,$ajax=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		else modules::run('usuarios/is_logged_in','editor');
		$r=$this->services_model->delete($type,$rel_type,$id_type,$id_rel_type);
		if ($ajax) echo '[{result:'.($r==true ? 'true' : 'false').'}]';
		else return $r;
		
	}

	function format_fecha($dia='',$mes='',$ano='',$aprox=false,$ajax=false){
		$sep=(is_numeric($mes) ? '/' : ' ');
		$dia=($dia==0) ? '' : $dia.$sep;
		$mes=(($mes==0 && is_numeric($mes)) || $mes=='') ? '' : str_pad($mes,2,'0',STR_PAD_LEFT).$sep;
		$fecha=$dia.$mes.$ano;
		if ($aprox==true) $fecha='Ca. '.$fecha;
		if ($ajax)
			echo $fecha;
		else
			return $fecha;
	}
	function random($ajax=true){
		if ($ajax==true)
			echo 4;
		else return 4;
		//chosen by fair dice roll, guaranteed to be random
	}

	function get_all_like($type,$ajax=false,$like='',$front=false){
		if ($type=='usuarios' || $type=='monitor')
			modules::run('usuarios/is_logged_in','admin');
		
		
		if ($ajax)
			echo json_encode($this->services_model->get_all_like($type,false,$like,$front));
		else
			return $this->services_model->get_all_like($type,false,$like,$front);
	}
	
	function votar($tipo_contenido='',$id_contenido='',$value=''){
		if ($this->input->post('valoracion')!=''){
			$value=$this->input->post('valoracion');
			$id_contenido=$this->input->post('id_contenido');
			$tipo_contenido=$this->input->post('tipo_contenido');
			$return_url=$this->input->post('return_url');
		}
		
		$data['id_usuario']=$this->session->userdata('id_usuario');
		$data['tipo_contenido']=$tipo_contenido;
		$data['id_contenido']=$id_contenido;
		$data['puntos']=$value;
		$data['ip']=$_SERVER['REMOTE_ADDR'];
		$return_url = $this->session->userdata('return_url_voto');
		
		//echo 'signo las variables';
		/*
		echo("<br><b>session->userdata -></b><pre>"); 
			print_r($this->session->userdata); 
		echo("</font></pre><br>");
		die();*/
		$votados=(is_array($this->session->userdata('votados')) ? $this->session->userdata('votados') : array());
		
		$votados=array_merge($votados,array($tipo_contenido=>$id_contenido));
		$this->session->set_userdata('votados',$votados);
		if ($this->services_model->ha_votado($data['ip'],$tipo_contenido,$id_contenido,$data['id_usuario']) == false && $data['puntos'] <= 5){
			$this->services_model->insert_vote($data);
			//echo 'inserto el voto';
			if(isset($return_url)) redirect($return_url); 
			else echo $this->votacion($tipo_contenido,$id_contenido,true);
			
		}else{
			if(isset($return_url)) redirect($return_url);
			else echo 'false';
		}
		
		
		
		//redirect($return_url);
		
	}
	
	function votacion($tipo_contenido='',$id_contenido='',$ajax=false){
		if ($ajax)
			echo $this->services_model->votacion($tipo_contenido,$id_contenido);
		else
			return $this->services_model->votacion($tipo_contenido,$id_contenido);
	}
	
	function numero_votacion($tipo_contenido='',$id_contenido='',$ajax=false){
		if ($ajax)
			echo $this->services_model->numero_votos($tipo_contenido,$id_contenido);
		else
			return $this->services_model->numero_votos($tipo_contenido,$id_contenido);
	}

	
	function crear_multimedia($img='',$id='',$tipo='',$destacado='',$img_folder='',$width='120',$height='120',$med_w='400',$med_h='400', $large_w='800',$large_h='800')
	{
				$img_folder = ($img_folder!='' ? $img_folder : 'assets/front/img/');
				$img_new = $id.rand(5,99999999).'_'.$img;
				
				//insert image into multimedia
				$this->insert_image($img_new,$id,$tipo,$destacado);
				
				if (is_file(FCPATH.$img_folder.'temp/'.$img)){
					if (!is_dir(FCPATH.$img_folder.'thumb/')) mkdir(FCPATH.$img_folder.'thumb/');
					if (!is_dir(FCPATH.$img_folder.'med/')) mkdir(FCPATH.$img_folder.'med/');
					if (!is_dir(FCPATH.$img_folder.'large/')) mkdir(FCPATH.$img_folder.'large/');
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image']	= FCPATH.$img_folder.'temp/'.$img;
					
					
					// Imagen Thumbnail
					
					$config['new_image']	= FCPATH.$img_folder.'thumb/'.$img_new;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = $width;
					$config['height']	= $height;
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					
					// Imagen Medium
					
					$config['new_image']	= FCPATH.$img_folder.'med/'.$img_new;
					$config['width']	 = $med_w;
					$config['height']	= $med_h;
					
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					
					// Imagen Large
					$config['new_image']	= FCPATH.$img_folder.'large/'.$img_new;
					$config['width']	 = $large_w;
					$config['height']	= $large_h;
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					if (is_file(FCPATH.$img_folder.'temp/'.$img)) unlink( FCPATH.$img_folder.'temp/'.$img);
				}
	}
	
	/**
	 * 
	 * Convierte una fecha del tipo aaaa-mm-dd escrita en letras
	 * @param unknown_type $fecha
	 */
	public function fecha_to_letras($fecha, $short_version = FALSE) 
	{
		
		$meses = array(		'01'	=>	'Enero', 
							'02'	=>	'Febrero', 
							'03'	=>	'Marzo',
							'04'	=>	'Abril', 
							'05'	=>	'Mayo', 
							'06'	=>	'Junio', 
							'07'	=>	'Julio',
							'08'	=>	'Agosto', 
							'09'	=>	'Septiembre',
							'10'	=>	'Octubre', 
							'11'	=>	'Noviembre', 
							'12'	=>	'Diciembre'	);
							
		$fecha = explode(" ", $fecha);
		
		if (count($fecha) > 1) {
			$resto = $fecha[1];
			$fecha = $fecha[0];
		}
		else
			$resto = '';
							
		$fecha = explode("-", $fecha);
		
		if ($short_version)
			return (count($fecha) == 3) ? $fecha[2] . ' ' . substr($meses[$fecha[1]], 0, 3) . ' ' . $fecha[0] . ' ' . $resto : FALSE;
		
		else
			return (count($fecha) == 3) ? $fecha[2] . ' de ' . $meses[$fecha[1]] . ' del ' . $fecha[0] . ' a las ' . $resto : FALSE;
		
	}
}

/* End of file relations.php */
/* Location: ./system/application/modules/services/controllers/relations.php */
