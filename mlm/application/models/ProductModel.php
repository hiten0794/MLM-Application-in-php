<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $Product = 'products';
	
 	
	public function AddProduct($data)
	{  
 		$res = $this->db->insert($this->Product, $data ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	
	public function UpdateProductByID($data,$product_id)
	{  
 
 		$res = $this->db->update($this->Product, $data ,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	public function TrashProductByID($product_id)
	{  
 
 		$res = $this->db->delete($this->Product,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
  	public function DropDownProducts()
	{  
 		$this->db->select('id,ProductName,SalePrice');
		$this->db->from($this->Product);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}
	
	public function PictureUrl()
	{  
 		$this->db->select('id,picture_url');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata('id'));
		$this->db->limit(1);
  		$query = $this->db->get();
		$res = $query->row_array();
		return $res['picture_url'];
   	}
	
	
	
	 public function GetProductById($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Product);
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
