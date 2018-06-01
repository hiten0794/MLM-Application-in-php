<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
				 
        } 
	
	private $Category = 'category';
	
 	
	public function AddProduct($data)
	{  
 		$res = $this->db->insert($this->Category, $data ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	
	public function UpdateProductByID($data,$product_id)
	{  
 
 		$res = $this->db->update($this->Category, $data ,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	public function TrashProductByID($product_id)
	{  
 
 		$res = $this->db->delete($this->Category,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	 public function DropDownCategory()
	{  
 		$this->db->select('id,name');
		$this->db->from($this->Category);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}
  	
	
	 public function GetProductById($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Category);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
 
 
 }
