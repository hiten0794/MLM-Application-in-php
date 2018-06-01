<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeesionModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
  	
 	public function is_logged_in()
	{  
 		if(isset($this->session->userdata['Admin']['logged_in']) == 'TRUE' ){
			redirect(base_url('v3/dashboard'));
		} 
  	}
 	public function not_logged_in()
	{  
 		if($this->session->userdata['Admin']['logged_in'] != 'TRUE' ){
			redirect(base_url());
		} 
  	}
 	public function is_logged_Admin()
	{  
 		if($this->session->userdata['Admin']['role'] != 'Admin' ){
			redirect('v3/dashboard');
		} 
  	}
 	public function is_logged_in_Json()
	{  
 		if($this->session->userdata['seatseller']['logged_in'] != 'TRUE' ){
			echo json_encode([ 'status' =>0 ,'logged' => 'false', 'message' => 'Session expired ! Please Login Your Account !' ]);
			die;
		} 
  	}
 	public function is_logged_Seatseller_Json()
	{  
 		if($this->session->userdata['seatseller']['role'] != 'Seatseller' ){
			echo json_encode([ 'status' =>0 , 'message' => 'Permission Not Allowed !' ]);
			die;
		} 
  	}
	
	
	
 }
