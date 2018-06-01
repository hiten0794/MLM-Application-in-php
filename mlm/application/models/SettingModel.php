<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
				 
        } 
	
	private $Settings = 'settings';
	
 	
	public function AddProduct($data)
	{  
 		$res = $this->db->insert($this->Settings, $data ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	
	public function UpdateSettingsByID($data,$product_id)
	{  
 
 		$res = $this->db->update($this->Settings, $data ,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	
	 public function SettingsByID($type) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Settings);
		$this->db->where("type",$type);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
 
 
 }
