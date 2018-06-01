<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $Document = 'fleets_documents';

 	
	public function checkIfExistsDocumentType($document_type){
		
		$condition = ['fleet_id' => $this->session->userdata('id'), 'document_type' => $document_type ];
		 $this->db->select('id, fleet_id, document_type'); 
		 $this->db->from($this->Document);
		 $this->db->where($condition);
 		 $query = $this->db->get();
		 if ($query->num_rows() == 1) {
			 return $query->row_array();
		 } else {
			 return 'Insert';
		 }
	}
	public function UploadedDocumentsList($condition){
		
 		 $this->db->select('id,fleet_id,document_type,status,document_url'); 
		 $this->db->from($this->Document);
		 $this->db->where($condition);
 		 $query = $this->db->get();
 		 if ($query->num_rows() == 1) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
 	}
	
	public function UploadedDocumentByID($condition){
		 
 		 $this->db->select('id,fleet_id,document_type,mime_type,document_url'); 
		 $this->db->from($this->Document);
		 $this->db->where($condition);
 		 $query = $this->db->get();
 		 if ($query->num_rows() == 1) { 
			 return $query->row_array();
		 } else {
			 return false;
		 }
 	}	
 	
	public function InsertDocumentByID($data)
	{  
 		$res = $this->db->insert($this->Document, $data ); 
		if($res == 1)
			return true;
		else
			return false;
 	}
  	public function UpdateDocumentByID($data,$condition_array)
	{  
 		$res = $this->db->update($this->Document, $data , $condition_array  ); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 
 }
