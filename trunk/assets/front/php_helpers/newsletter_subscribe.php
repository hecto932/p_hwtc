<?php

// Get your Mailchimp API KEY - http://kb.mailchimp.com/article/where-can-i-find-my-api-key
//$apiKey = 'your-api-key';
$apiKey = '4d228d8e696ee17523a8b156117163d9-us5';

// Get your Mailchimp LIST ID - http://kb.mailchimp.com/article/how-can-i-find-my-list-id
//$listId = 'your-list-id';
$listId = '5241548f43';

$double_optin=false;
$send_welcome=false;
$email_type = 'html';
$email = $_POST['email'];
$merge_vars = array( 'YNAME' => $_POST['yname'] );

//replace us5 with your actual datacenter
$submit_url = "http://us5.api.mailchimp.com/1.3/?method=listSubscribe";
$data = array(
    'email_address'=>$email,
    'apikey'=>$apiKey,
    'id' => $listId,
    'double_optin' => $double_optin,
    'send_welcome' => $send_welcome,
	'merge_vars' => $merge_vars,
    'email_type' => $email_type
);
$payload = json_encode($data);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $submit_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
 
$result = curl_exec($ch);
curl_close ($ch);
$data = json_decode($result);
if ($data->error){
    echo $data->error;
} else {
    echo "Got it, you've been added to our email list.";
}