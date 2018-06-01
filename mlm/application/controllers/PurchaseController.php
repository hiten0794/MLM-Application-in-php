<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseController extends CI_Controller {
 	public function __construct()
        {
                parent::__construct();
				$this->load->model(['PurchaseProductModel']);
                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();
        }
 	public function index()
	{
  		$this->parser->parse('purchase/purchase_listing_template',[]);
	}
 
 	public function add_product(){
		$this->OuthModel->CSRFVerify();
		$this->form_validation->set_rules('ProductName', 'Product Name', 'required');
		$this->form_validation->set_rules('Quantity', 'Quantity', 'required');
		$this->form_validation->set_rules('UnitPrice', 'Unit Price', 'required');
 
 		 if ($this->form_validation->run() == FALSE)
         {
 			 $response = ['status' => 0 ,'message' => '<span style="color:#900;">'.validation_errors().'</span>' ];
			  
         }else{
			 
				$req = $this->input->post();
				 $post['type'] = 'Purchase';
				 $post['ProductName'] = $req['ProductName'];
				 $post['Available_qty'] = $req['Quantity'];
 				 $post['Price'] = $req['UnitPrice'];
				 $post['SalePrice'] = $req['UnitPrice'];
				 $post['Tax'] = $req['TaxAmount'];
 				 $post['description'] = $req['ProductDescription'];
				 $post['company_name'] = $req['CompanyName'];
				 $post['company_email'] = $req['Email'];
				 $post['company_phone'] = $req['PhoneNo'];
				 $post['City'] = $req['City'];
				 $post['State'] = $req['State'];
				 $post['Pincode'] = $req['Pincode'];
				 
				 $post['company_address'] = $req['Address'];
  				 $post['ip_address'] = $this->input->ip_address();
				 $post['create_date'] = date('Y-m-d H:i:s');
				 
							
  				$query = $this->PurchaseProductModel->AddProduct($this->OuthModel->xss_clean($post));
				 
				$response='';
				if($query == true){
					$response = ['status' => 1 ,'message' => '<span style="color:#090;">Product added Successfully !</span>' ];
				}else{
					$response = ['status' => 0 ,'message' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
				}
           }
 		   echo json_encode($response);
  	}
	
	public function edit_product(){
		//sleep(5);
		$this->OuthModel->CSRFVerify();
		$this->form_validation->set_rules('ProductName', 'Product Name', 'required');
		$this->form_validation->set_rules('Quantity', 'Quantity', 'required');
		$this->form_validation->set_rules('UnitPrice', 'Unit Price', 'required');
 
 		 if ($this->form_validation->run() == FALSE)
         {
 			 $response = ['status' => 0 ,'message' => '<span style="color:#900;">'.validation_errors().'</span>' ];
			  
         }else{
			 
				$req = $this->input->post();

				 $post['ProductName'] = $req['ProductName'];
				 $post['Available_qty'] = $req['Quantity'];
 				 $post['Price'] = $req['UnitPrice'];
				 $post['SalePrice'] = $req['UnitPrice'];
				 $post['Tax'] = $req['TaxAmount'];
 				 $post['description'] = $req['ProductDescription'];
				 $post['company_name'] = $req['CompanyName'];
				 $post['company_email'] = $req['Email'];
				 $post['company_phone'] = $req['PhoneNo'];
				 $post['City'] = $req['City'];
				 $post['State'] = $req['State'];
				 $post['Pincode'] = $req['Pincode'];
				 
				 $post['company_address'] = $req['Address'];
  				 $post['ip_address'] = $this->input->ip_address();
				 
				 
   				$query = $this->PurchaseProductModel->UpdateProductByID($this->OuthModel->xss_clean($post),$req['ProductId']);
				 
				$response='';
				if($query == true){
					$response = ['status' => 1 ,'message' => '<span style="color:#090;">Product Update Successfully !</span>' ];
				}else{
					$response = ['status' => 0 ,'message' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];
				}
           }
 		   echo json_encode($response);
  	}
	
 	
	public function purchase_product_grid_data()
	{
		$this->OuthModel->CSRFVerify();
 		// storing  request (ie, get/post) global array to a variable  
		$requestData = $_REQUEST;
 		//print_r($requestData);
 
  		$table = "products";
		$fields = "id,ProductName,Available_qty, SalePrice, description, company_name,create_date ";
 		$id = '';
		$where = " WHERE type = 'Purchase' ";
 		$sql = "SELECT ".$fields;
		$sql.=" FROM ".$table. $where;
 		//echo $sql;
 		$query = $this->db->query($sql);
		$queryqResults = $query->result();
 		$totalData = $query->num_rows(); // rules datatable
		$totalFiltered = $totalData; // rules datatable
  		
		$where = " WHERE type = 'Purchase' ";
 		$sql = "SELECT ".$fields;
 		$sql.=" FROM ".$table . $where ;
 		
  		
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			
			$searchValue = $requestData['search']['value'];
 				
			$sql.=" AND `ProductName` LIKE '%".$searchValue."%' ";   
 			$sql.=" OR `Available_qty` LIKE '%".$searchValue."%' ";
 			//$sql.=" OR `company_name` LIKE '%".$searchValue."%' ";
		}
 		
		
 		$query = $this->db->query($sql);
 		$totalFiltered = $query->num_rows(); // rules datatable
 		//ORDER BY id DESC	
 		$sql.=" ORDER BY id desc "./*$requestData['order'][0]['dir'].*/"  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
 		$query = $this->db->query($sql);
 		//echo $sql;
 		$SearchResults = $query->result();
		
  		$data = array();
		$counter=0;
		foreach($SearchResults as $row){
			$counter++;
			$nestedData=array(); 
			
			$id = $row->id;
			
			$url_id=$this->OuthModel->Encryptor('encrypt',$row->id);
			
			$tableCheckTD = "<label class='pos-rel'><input type='checkbox' class='ace' /><span class='lbl'></span></label>";
 			$action =  '<div class="action-buttons"><a onclick="view('.$id.')"  class="green" href="javascript:void(0);">
																	<i class="ace-icon fa fa-eye bigger-130"></i>
																</a>&nbsp;&nbsp;&nbsp;
 																<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
 															</div>';
 			
 			$nestedData[] = '<span class="nameID_'.$id.'">'.$counter.'</span>';  
			$nestedData[] = '<span class="nameID_'.$id.'">'.$row->ProductName.'</span>';
			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->Available_qty.'</span>';
			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->SalePrice.'</span>';
			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->company_name.'</span>';
			$nestedData[] = $row->create_date;
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
	
	public function product_view(){ 
	//sleep(5);
		$this->OuthModel->CSRFVerify();
		$id=$this->input->get('id');
 		$product = $this->PurchaseProductModel->GetProductById($id);
		if($product != false){
			$json_data = [ "status"            => 1,  
					"message"    => 'true',   
 					"res"            => $product
					];
		}else{
			$json_data = [ "status"            =>0,  
					"message"    => 'false',   
 					];
		}
		echo json_encode($json_data); 
		
 	}
	
	public function product_trash(){ 
	//sleep(5);
		$this->OuthModel->CSRFVerify();
		$id=$this->input->get('id');
		
 		$product = $this->PurchaseProductModel->TrashProductByID($id);
		if($product != false){
			$json_data = [ "status"            => 1,  
					"message"    => 'One Purchase Proudct Deleted !',   
 					];
		}else{
			$json_data = [ "status" =>0,  
					"message"    => 'false',   
 					];
		}
		echo json_encode($json_data); 
		
 	}
	
	
	 	
	
}
