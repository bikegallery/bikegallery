<?php


define('IGP_CLIENT_ID', 'dd8e651e01a44589a3af3d8e30fdccf5');
define('IGP_CLIENT_SECRET', '3ea786361d8844f18a1f71c6a9f99c7c');
define('IGP_REDIRECT_URI', 'http://plugins.polevaultweb.com/oauth_pro.php');

class igp_Instagram {
    private $apiBase = 'https://api.instagram.com/';
    private $apiUrl = 'https://api.instagram.com/v1/';
    
    protected $client_id;
    protected $client_secret;
    protected $access_token;
    
    public function accessTokenUrl()  { return $this->apiBase.'oauth/access_token/'; }
    public function authorizeUrl($redirect_uri, $scope = array('basic'), $response_type = 'code'){
        return $this->apiBase.'oauth/authorize/?client_id='.$this->client_id.'&redirect_uri='.$redirect_uri.'&response_type='.$response_type.'&scope='.implode('+', $scope);
    }
    
    public function __construct($client_id='', $client_secret='', $access_token = '')
    {
        if(empty($client_id) || empty($client_secret)){
            throw new Exception('You need to configure your Client ID and/or Client Secret keys.');
        }
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->access_token = $access_token;
    }
    
    
    private function urlEncodeParams($params)
    {
        $postdata = '';
        if(!empty($params)){
            foreach($params as $key => $value)
            {
                $postdata .= '&'.$key.'='.urlencode($value);
            }
        }
        
        return $postdata;
    }
    
       
    public function http($url, $params, $method)
    {
        $c = curl_init();
		
		       
        // If they are authenticated and there is a access token passed, send it along with the request
        // If the access token is invalid, an error will be raised upon the request
        if($this->access_token){
            $url = $url.'?access_token='.$this->access_token;
        }
        

        // If the request is a GET and we need to pass along more params, "URL Encode" them.
        if($method == 'GET'){
            $url = $url.$this->urlEncodeParams($params);
           
	    }
		
		//print $url;
        
        curl_setopt($c, CURLOPT_URL, $url);
        
        if($method == 'POST'){
		
			//var_dump( $params);
            curl_setopt($c, CURLOPT_POST, true);
            curl_setopt($c, CURLOPT_POSTFIELDS, $params);
        }
        
        if($method == 'DELETE'){
            curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
		
		// Withtout the next line I get cURL errors
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 2);    // 2 is the default so this is not required
        
        curl_setopt($c, CURLOPT_RETURNTRANSFER, True);
		
        $r = json_decode(curl_exec($c));
        
        //check for NULL response
        if (curl_exec($c) == null) {
	        
	         throw new igp_InstagramApiError('Error: Instagram API Servers Down');

        }
        		
        // Throw an error if maybe an access token expired or wasn't right
        // or if an ID doesn't exist or something
        if(isset($r->meta->error_type)){
            throw new igp_InstagramApiError('Error: '.$r->meta->error_message);
        }
        return $r;
		
		// close cURL resource, and free up system resources
		curl_close($c);
    }
    
    // Giving you some easy functions (get, post, delete)
    public function get($endpoint, $params=array(), $method='GET'){
        return $this->http($this->apiUrl.$endpoint, $params, $method);
    }
    
    public function post($endpoint, $params=array(), $method='POST'){
        return $this->http($this->apiUrl.$endpoint, $params, $method);
    }
    
    public function delete($endpoint, $params=array(), $method='DELETE'){
        return $this->http($this->apiUrl.$endpoint, $params, $method);
    }
    
    public function getAccessToken($code, $redirect_uri, $grant_type = 'authorization_code'){
			
        $rsp = $this->http($this->accessTokenUrl(), array('client_id' => $this->client_id, 'client_secret' => $this->client_secret, 'grant_type' => $grant_type, 'redirect_uri' => $redirect_uri, 'code' => $code), 'POST');
        		
        return $rsp;
    }
    
   
	
	
}

class igp_InstagramApiError extends Exception {}


 

?>