<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class CustomerController extends CI_Controller {

 	public function __construct()

        {

                parent::__construct();

				$this->load->model(['MemberModel']);

                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();

        }

	

	public function index() 

	{

		$this->parser->parse('customer/customer_list_template',[]);

	}

	



 	public function customer_grid_data()

	{

		$this->OuthModel->CSRFVerify();

 		// storing  request (ie, get/post) global array to a variable  

		$requestData = $_REQUEST;

 		//print_r($requestData);

 

  		$table = "users";

		$fields = "id,name,email, mobile_no, created ";

 		$id = '';

		$where = " WHERE `role` = 'Customer' ";

 		$sql = "SELECT ".$fields;

		$sql.=" FROM ".$table. $where;

 		//echo $sql;

 		$query = $this->db->query($sql);

		$queryqResults = $query->result();

 		$totalData = $query->num_rows(); // rules datatable

		$totalFiltered = $totalData; // rules datatable

  		

		$where = " WHERE `role` = 'Customer' ";

 		$sql = "SELECT ".$fields;

 		$sql.=" FROM ".$table . $where ;

 		

  		

		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

			

			$searchValue = $requestData['search']['value'];

 				

			$sql.=" AND `name` LIKE '%".$searchValue."%' ";   

 			$sql.=" OR `email` LIKE '%".$searchValue."%' ";

 			$sql.=" OR `mobile_no` LIKE '%".$searchValue."%' ";

		}

 		

		

 		$query = $this->db->query($sql);

 		$totalFiltered = $query->num_rows(); // rules datatable

 		//ORDER BY id DESC	

 		$sql.=" ORDER BY  created  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

 		$query = $this->db->query($sql);

 		//echo $sql;

 		$SearchResults = $query->result();

		

  		$data = array();

		foreach($SearchResults as $row){

			$nestedData=array(); 

			

			$id = $row->id;

			

			$url_id=$this->OuthModel->Encryptor('encrypt',$row->id);

			

			$tableCheckTD = "<label class='pos-rel'><input type='checkbox' class='ace' /><span class='lbl'></span></label>";

 			$action =  '<div class="action-buttons"><a target="_blank" href="'.base_url('v3/member-net-sale-view?id='.$url_id).'#!/country/india" class="green" href="javascript:void(0);">

																	<i class="ace-icon fa fa-eye bigger-130"></i>

																</a>&nbsp;&nbsp;&nbsp;

 																<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">

																	<i class="ace-icon fa fa-trash-o bigger-130"></i>

																</a>

 															</div>';

 			

 			$nestedData[] = '<span class="nameID_'.$id.'">'.$row->id.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->name.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->email.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->mobile_no.'</span>';

			//$nestedData[] = '<span class="contactID_'.$id.'">0.00</span>';

 			$nestedData[] = $row->created;

			$nestedData[] =  $action; 

  			$data[] = $nestedData;

		}

 		$json_data = array(

					"draw"            => intval( $requestData['draw'] ),  

					"recordsTotal"    => intval( $totalData ),  // total number of records

					"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching,  

					"data"            => $data   // total data array

					);

 		echo json_encode($json_data);  // send data as json format					

 	}

	

	public function trash(){ 

	//sleep(1); 

		$this->OuthModel->CSRFVerify();

		$id=$this->input->get('id');

		

 		$product = $this->UserModel->TrashByID($id);

		if($product != false){

			$this->MemberModel->TrashByID($id); /// delete member log 

			$json_data = [ "status"            => 1,  

					"message"    => 'One Member Deleted !',   

 					];

		}else{

			$json_data = [ "status" =>0,  

					"message"    => 'false',   

 					];

		}

		echo json_encode($json_data); 

		

 	}

	

 

	

}

