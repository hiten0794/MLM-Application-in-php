<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OveModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $User = 'users';
 	
 	
	public function IfExistUsername($username){
	
		 $this->db->select('id, email'); 
		 $this->db->from($this->User);
		 $this->db->where('email', $username);
		 $query = $this->db->get();
		 if ($query->num_rows() == 1) {
			 return true;
		 } else {
			 return false;
		 }
	}

 	
 	public function SMTP_Config(){
		
		$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.yourhost.com',
					'smtp_port' => 587,
					'smtp_user' => 'user@domain.com',
					'smtp_pass' => 'password',
					'mailtype' => 'text/html',
					'newline' => '\r\n',
					'charset' => 'utf-8'
			);
		$this->load->library('email', $config);		
	}

 	public function Authentication_Check($data)
	{  
		//$condition = "role =" . "'Admin' AND " . "username =" . "'" . $data['username'] . "'";
		$condition = "username =" . "'" . $data['username'] . "'";
		$this->db->select('id');
		$this->db->from($this->User);
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
		
	}
	// Read data from database to show data in admin page
	public function Read_User_Information($id) {
 		$condition = "id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from($this->User);
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
 	}
	public function SeatsellersSignup($data)
	{  
		$res = $this->db->insert($this->User,$data);
		if($res == 1)
			return true;
		else
			return false;	
  	}
	public function LastLogged($user_id)
	{  
 		$this->db->update($this->User,['lastlogged' => date('d-m-Y H:i A') ] ,['id' => $user_id] ); 
 	}
	
	public function UpdateData($data)
	{  
 		$res = $this->db->update($this->User, $data ,['id' => $this->session->userdata['Admin']['id'] ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	
	
  	public function checkOldPasswordInDB() {
		$where = ['id' => $this->session->userdata['Admin']['id']];
 		$this->db->select('id,password');
		$this->db->from($this->User);
		$this->db->where($where);
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
 	}
	public function UpdatePassword($user_id,$newpassword)
	{  
 		$res = $this->db->update($this->User, ['password' => $newpassword ] ,['id' => $user_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
////////////////////////////Post///////////////////////////

 	public function TotalMembers()
	{  
		$condition = "role =" . "'Customer' ";
		$this->db->select('id');
		$this->db->from($this->User);
		$this->db->where($condition);
 		$query = $this->db->get();
 		return $query->num_rows();
 
		
	}

	 

 }
