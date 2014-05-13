
<?php


include(APPPATH.'libraries/Facebook/Facebook.php');

	
class Fbconnect extends Facebook
{
	
	public $user = NULL;
	public $user_id = NULL;
	
	function __construct()
	{
	 	//consultas de facebook actualiza
	
	 	$ci =& get_instance();
		$ci->config->load('Facebook',TRUE);
		$config = $ci->config->item('Facebook');
		parent::__construct($config);
		parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
		
		
		$this->user_id = $this->getUser();
		
		if ($this->user_id) 
        {	
            try 
            {
				//die("<pre>die_pre:<br />".print_r($user, TRUE)."<br />/die_pre</pre>");
            	//campos para los permisos
				
             
				//session_destroy();	
				//$ci->session->set_userdata($form_data); //crea la sesion con lo datos de facebook
				//$this->bdtec_model->guardar_msj(json_encode($data['user_profile']['inbox']));	
				//die("<pre>die_pre:<br />".print_r($_SESSION,TRUE)."<br />/die_pre</pre>");
				//redirect('/');
            } 
            catch (FacebookApiException $e)
			{
				$result = $e->getResult(); 
				die("<pre>die_pre:<br />".print_r($result,TRUE)."<br />/die_pre</pre>");
                $user = null;
            }
        }
		
	}
	
	
} 

?>