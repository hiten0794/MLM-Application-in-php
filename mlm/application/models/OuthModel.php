<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OuthModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $User = 'users';
	

	public function xss_clean($data)
	{  
		return $this->security->xss_clean($data);
 	}
	public function CSRFVerify()
	{ 
		error_reporting(0);
		$headers = apache_request_headers();
 		$csrf_token = $headers['Authkey'];
		 
		if($this->security->get_csrf_hash() === $csrf_token){
			return;
		}else{
			echo json_encode([ 'code' => 400, 'error' => 'Bad request ,Unknown User!' ]);
			die;
		}
 	}
	public function Encrypt($string) {
		$cryptKey  = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
		$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $string, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return( $qEncoded );
	}

	public function Decrypt($string){
		$cryptKey  = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
		$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $string ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return( $qDecoded );
	}
	public function Encryptor($action, $string) {
		$output = false;
	
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'hitenVkuld%:bTXz,3r>6|FW#!7eSs>vM~n+48~{Mh$#A4p).)#wV3^_y-B.6WCar=b4.';
		$secret_iv = '3w8XD|r@n:nxp|oml]nw$-KEc|rT$H).(~ &`gnV!vD0vs|?r]#Zdr-qRlOV@&#6';

		// hash
		$key = hash('sha256', $secret_key);
	
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
	
		return $output;
	}

	public function RandomPassword( $pw_length = 8, $use_caps = true, $use_numeric = true, $use_specials = true ) {
		/*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;*/
		$caps = array();
		$numbers = array();
		$num_specials = 0;
		$reg_length = $pw_length;
		$pws = array();
		for ($ch = 97; $ch <= 122; $ch++) $chars[] = $ch; // create a-z
		if ($use_caps) for ($ca = 65; $ca <= 90; $ca++) $caps[] = $ca; // create A-Z
		if ($use_numeric) for ($nu = 48; $nu <= 57; $nu++) $numbers[] = $nu; // create 0-9
		$all = array_merge($chars, $caps, $numbers);
		if ($use_specials) {
			$reg_length =  ceil($pw_length*0.75);
			$num_specials = $pw_length - $reg_length;
			if ($num_specials > 5) $num_specials = 5;
			for ($si = 33; $si <= 47; $si++) $signs[] = $si;
			$rs_keys = array_rand($signs, $num_specials);	
			foreach ($rs_keys as $rs) {
				$pws[] = chr($signs[$rs]);
			}
		} 
		$rand_keys = array_rand($all, $reg_length);
		foreach ($rand_keys as $rand) {
			$pw[] = chr($all[$rand]);
		}	
		$compl = array_merge($pw, $pws);	
		shuffle($compl);
		return implode('', $compl);
	}
	
	public function HashPassword($password)
	{  
		$options = array("cost"=>12,'salt'=>'G#&eW*<K}_iIlx5>^RrY5{nAiR;8+JiFhSzoJZMB^W:vU2}`@8xb6%pU-5p_:MYp');
		$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
		return $hashPassword;
 	}
	public function VerifyPassword($password,$hash){
		return password_verify($password,$hash);
	}
 	

 }
