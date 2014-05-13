<?php

include(APPPATH.'libraries/Google/Google_Client.php');
include(APPPATH.'libraries/Google/Google_PlusService.php');
include(APPPATH.'libraries/Google/Google_Oauth2Service.php');
	
class GoogleConnect 
{
	 public $user_api = NULL;
	 public $user_gplus = NULL;
	 public $informacion = NULL;
	
	function __construct()
	{
		$ci =& get_instance();
		$ci->load->helper('url'); 
		
		session_start();
		
		$client = new Google_Client();
		$client->setApplicationName('Login_google+');
		
		$client->setClientId('982223314814.apps.googleusercontent.com');
		$client->setClientSecret('8OINqhV72LP9bgJ8mKJoyr6i');
		$client->setRedirectUri(base_url()."evento/google_control/login");
		$client->setDeveloperKey('AIzaSyBqCuXKOy3l_OVsimXfDIPR46h08aLlVBk');
		$client->setScopes(array('https://www.googleapis.com/auth/plus.login',
		'https://www.googleapis.com/auth/userinfo.email',
        'https://www.googleapis.com/auth/plus.me'));
		
		$plus = new Google_PlusService($client);
		
		$this->informacion = new Google_Oauth2Service($client);
	
		$this->user_api=$client;
		$this->user_gplus= $plus;
		if (isset($_GET['code']))
		{
 			$client->authenticate($_GET['code']);
  			$_SESSION['access_token'] = $client->getAccessToken();
 
		}
		
  		if (isset($_SESSION['access_token']))
		{
  			$client->setAccessToken($_SESSION['access_token']);
		}
		
		if ($client->getAccessToken())
		{
  			$_SESSION['token'] = $client->getAccessToken();
		} 
		
	}
}

?>