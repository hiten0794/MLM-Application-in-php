<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class ProductController extends CI_Controller {

 	public function __construct()

        {

                parent::__construct();

				$this->load->model(['ProductModel','CategoryModel']);

                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();

        }

	

	public function index() 

	{

		$data['category']=$this->CategoryModel->DropDownCategory();

  		$this->parser->parse('product/add_product_template',$data);

	}

	public function product_list_template() 

	{

  		$this->parser->parse('product/product_list_template',[]);

	}

	

	public function add_product(){

		$this->OuthModel->CSRFVerify();

		

 		//$this->form_validation->set_rules('product_Id', 'product id', 'required');

		$this->form_validation->set_rules('ProductName', 'Product Name', 'required');

		$this->form_validation->set_rules('Price', 'Price', 'required');

		$this->form_validation->set_rules('SalePrice', 'Sale Price', 'required');

 

 		

 		

		 if ($this->form_validation->run() == FALSE)

         {

 			 $response = ['status' => 0 ,'message' => '<span style="color:#900;">'.validation_errors().'</span>' ];

			  

         }else{

			 

				$post = $this->input->post();

				

 				if(isset($_FILES['product_Image']['name']) && !empty($_FILES['product_Image']['name'])){	



					$config['upload_path']          = './uploads/products';

					$config['allowed_types']        = 'png|jpg|jpeg';

					$config['max_size']             = 500;

					 //$config['max_width']            = 1024;

 					//$config['max_height']           = 768;

					 $this->load->library('upload', $config);

					 if ( ! $this->upload->do_upload('product_Image'))

					 {

							$AtError = $this->upload->display_errors();

							echo json_encode(['status' => 0 ,'message' => $AtError]);

							die;

					 }

					 else

					 {

							$file_data = $this->upload->data();

							$post['productImage'] = $file_data['file_name'];

					 }

				}

			

				 

				 $post['user_id'] = $this->session->userdata['Admin']['id'];

				 //$post['product_Id'] = $post['product_Id'];

				 $post['Available_qty'] = $post['Available_qty'];

				 $post['sgst'] = $post['sgst'];
				 $post['cgst'] = $post['cgst'];
				 $post['igst'] = $post['igst'];

				 $post['ProductName'] = $post['ProductName'];

				 $post['ProductCategory'] = $post['ProductCategory'];

				 $post['SKU'] = $post['SKU'];

				 $post['Price'] = $post['Price'];
				  $post['hsn'] = $post['hsn']; 
				   $post['sac'] = $post['sac'];

				 $post['SalePrice'] = $post['SalePrice'];

				 $post['description'] = $post['description'];

 				 $post['ip_address'] = $this->input->ip_address();

				 $post['create_date'] = date('Y-m-d H:i:s');

				 

				 unset($post['product_Id'],$post['product_Image']);

				  

 				$query = $this->ProductModel->AddProduct($this->OuthModel->xss_clean($post));

				 

				$response='';

				if($query == true){

					$response = ['status' => 1 ,'message' => '<span style="color:#090;">Product added Successfully !</span>' ];

				}else{

					$response = ['status' => 0 ,'message' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];

				}

           }

		   

		   echo json_encode($response);

		

 	}

	

	

	

	

	

	

	

	public function product_grid_data()

	{

		$this->OuthModel->CSRFVerify();

 		// storing  request (ie, get/post) global array to a variable  

		$requestData = $_REQUEST;

 		//print_r($requestData);

 

  		$table = "products";

		$fields = "id,ProductName,Price, SalePrice, productImage, create_date ";

 		$id = '';

		$where = " ";

 		$sql = "SELECT ".$fields;

		$sql.=" FROM ".$table. $where;

 		//echo $sql;

 		$query = $this->db->query($sql);

		$queryqResults = $query->result();

 		$totalData = $query->num_rows(); // rules datatable

		$totalFiltered = $totalData; // rules datatable

  		

		$where = " ";

 		$sql = "SELECT ".$fields;

 		$sql.=" FROM ".$table . $where ;

 		

  		

		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

			

			$searchValue = $requestData['search']['value'];

 				

			$sql.=" WHERE `ProductName` LIKE '%".$searchValue."%' ";   

 			$sql.=" OR `Price` LIKE '%".$searchValue."%' ";

 			$sql.=" OR `SalePrice` LIKE '%".$searchValue."%' ";

		}

 		

		

 		$query = $this->db->query($sql);

 		$totalFiltered = $query->num_rows(); // rules datatable

 		//ORDER BY id DESC	

 		$sql.=" ORDER BY create_date  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

 		$query = $this->db->query($sql);

 		//echo $sql;

 		$SearchResults = $query->result();

		

  		$data = array();

		foreach($SearchResults as $row){

			$nestedData=array(); 

			

			$id = $row->id;

			

			$url_id=$this->OuthModel->Encryptor('encrypt',$row->id);

			

			$tableCheckTD = "<label class='pos-rel'><input type='checkbox' class='ace' /><span class='lbl'></span></label>";

 			$action =  '<div class="action-buttons"><a href="'.base_url('v3/product-view?id='.$url_id).'" class="green" href="javascript:void(0);">

																	<i class="ace-icon fa fa-eye bigger-130"></i>

																</a>&nbsp;&nbsp;&nbsp;

 																<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">

																	<i class="ace-icon fa fa-trash-o bigger-130"></i>

																</a>

 															</div>';

 			

 			$nestedData[] = '<span class="nameID_'.$id.'"><img src="'.base_url('uploads/products/'.$row->productImage).'" class="img-thumbnail imgcls"></span>';

			$nestedData[] = '<span class="nameID_'.$id.'">'.$row->ProductName.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->Price.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->SalePrice.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">Active</span>';

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

		

		$id=$this->OuthModel->Encryptor('decrypt',$this->input->get('id'));

		//echo $id;

		$data['product'] = $this->ProductModel->GetProductById($id);

		$data['category']=$this->CategoryModel->DropDownCategory();

		$this->parser->parse('product/edit_product_template',$data);

	}

	public function edit_product(){

		$this->OuthModel->CSRFVerify();

		

 		//$this->form_validation->set_rules('product_Id', 'product id', 'required');

		$this->form_validation->set_rules('ProductName', 'Product Name', 'required');

		$this->form_validation->set_rules('Price', 'Price', 'required');

		$this->form_validation->set_rules('SalePrice', 'Sale Price', 'required');

 

 		

 		

		 if ($this->form_validation->run() == FALSE)

         {

 			 $response = ['status' => 0 ,'message' => '<span style="color:#900;">'.validation_errors().'</span>' ];

			  

         }else{

			 

				$post = $this->input->post();

				

				//print_r($_FILES['productImage']); die;

				

 				if(isset($_FILES['product_Image']['name']) && !empty($_FILES['product_Image']['name'])){	



					$config['upload_path']          = './uploads/products';

					$config['allowed_types']        = 'png|jpg|jpeg';

					$config['max_size']             = 500;

					 //$config['max_width']            = 1024;

 					//$config['max_height']           = 768;

					 $this->load->library('upload', $config);

					 if ( ! $this->upload->do_upload('product_Image'))

					 {

							$AtError = $this->upload->display_errors();

							echo json_encode(['status' => 0 ,'message' => $AtError]);

							die;

					 }

					 else

					 {

							$file_data = $this->upload->data();

							$post['productImage'] = $file_data['file_name'];

					 }

				}

				

				 

 				 $post['Available_qty'] = $post['Available_qty'];

				  $post['sgst'] = $post['sgst'];
				 $post['cgst'] = $post['cgst'];
				 $post['igst'] = $post['igst'];

				 $post['ProductName'] = $post['ProductName'];

				 $post['ProductCategory'] = $post['ProductCategory'];

				 $post['SKU'] = $post['SKU'];

				 $post['Price'] = $post['Price'];
				  $post['hsn'] = $post['hsn'];
				   $post['sac'] = $post['sac'];

				 $post['SalePrice'] = $post['SalePrice'];

				 $post['description'] = $post['description'];

 				 $post['ip_address'] = $this->input->ip_address();

				 $post['create_date'] = date('Y-m-d H:i:s');

				 

				 $id = $post['product_Id'];

				 unset($post['product_Id'],$post['product_Image']);

				 

 				  

 				$query = $this->ProductModel->UpdateProductByID($this->OuthModel->xss_clean($post),$id);

				 

				$response='';

				if($query == true){

					$response = ['status' => 1 ,'message' => '<span style="color:#090;">Product Updated Successfully !</span>' ];

				}else{

					$response = ['status' => 0 ,'message' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];

				}

           }

		   

		   echo json_encode($response);

		

 	}

	

	public function product_trash(){ 

	//sleep(5);

		$this->OuthModel->CSRFVerify();

		$id=$this->input->get('id');

		

 		$product = $this->ProductModel->TrashProductByID($id);

		if($product != false){

			$json_data = [ "status"            => 1,  

					"message"    => 'One Product Deleted !',   

 					];

		}else{

			$json_data = [ "status" =>0,  

					"message"    => 'false',   

 					];

		}

		echo json_encode($json_data); 

		

 	}

	 	

	

}

