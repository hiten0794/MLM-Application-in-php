<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $User = 'users';
	
	public function DirectoryUrlPartners(){
		return '';
	}
	
  	public function GetUserData()
	{  
 		$this->db->select('id,name,first_name,last_name,email,about,mobile_no,address,city,country,vat_number,picture_url,pincode');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata['Admin']['id']);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	public function IfExistEmail($email){
		 
		 $this->db->select('id, name,email'); 
		 $this->db->from($this->User);
		 $this->db->where('email', $email);
		 $query = $this->db->get();
		 if ($query->num_rows() != 0) {
			  return $query->row_array();
		 } else {
			 return false;
		 }
	}
	
	public function PictureUrl()
	{  
 		$this->db->select('id,picture_url');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata['Admin']['id']);
		$this->db->limit(1);
  		$query = $this->db->get();
		$res = $query->row_array();
		if(!empty($res['picture_url'])){
			return base_url('uploads/profiles/'.$res['picture_url']);
		}else{
			return base_url('public/images/user-icon.jpg');
		}
   	}
	
	public function MemberPictureUrl($id)
	{  
 		$this->db->select('id,picture_url');
		$this->db->from($this->User);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
		$res = $query->row_array();
		if(!empty($res['picture_url'])){
			return base_url('uploads/profiles/'.$res['picture_url']);
		}else{
			return base_url('public/images/rank/1.png');
		}
   	}
	
	public function UpdateProfileImageByID($data)
	{  
 		$res = $this->db->update($this->User, $data ,['id' => $this->session->userdata['Admin']['id'] ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	 public function GetUserDataById($id) 
	{  
 		$this->db->select('id,name,mobile_no,email,address,city,country,vat_number,picture_url,pincode,created');
		$this->db->from($this->User);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	
	public function GetMemberNameById($id) 
	{  
 		$this->db->select('id,name');
		$this->db->from($this->User);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		$u=$query->row_array();
		return $u['name'];
		  
   	}
	
	public function AddMember($data)
	{  
		$res = $this->db->insert($this->User,$data);
		if($res == 1)
			return $this->db->insert_id();
		else
			return false;	
  	}
	public function TrashByID($product_id)
	{  
 
 		$res = $this->db->delete($this->User,['id' => $product_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 
 }
