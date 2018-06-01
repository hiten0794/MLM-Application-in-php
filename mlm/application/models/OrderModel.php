<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $Order = 'orders';
	
 	
	public function AddOrder($data)
	{  
 		$res = $this->db->insert($this->Order, $data ); 
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
	
  	public function SearchOrderByID($order_id)
	{  
 		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where("order_id",$order_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	
	
	public function MonthWiseSale()
	{  
 		$this->db->select('unit_price,create_date');
		$this->db->from($this->Order);
   		$query = $this->db->get();
 		return $query->result_array();
		 
   	}

	
  	public function GetUserData()
	{  
 		$this->db->select('id,mobile_no,address,city,country,vat_number,picture_url,pincode');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata('id'));
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
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
