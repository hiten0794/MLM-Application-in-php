<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseProductModel extends CI_Model {

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
	
	
	public function GetProductExcelData() 
	{  
 		$this->db->select('id,ProductName,Available_qty,SalePrice,Tax,description,company_name,company_email,company_phone,City,State,Pincode,company_address,create_date');
		$this->db->from($this->Product);
		//$this->db->where("type","Purchase");
   		$query = $this->db->get();
 		return $query->result_array();
   }

 
 }
