<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class OrderController extends CI_Controller {

 	public function __construct()

        {

                parent::__construct();

				$this->load->model(['OrderModel','ProductModel','MemberModel']);

                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();

        }

	

	public function index() 

	{

		

		$data['products'] = $this->ProductModel->DropDownProducts();

  		$this->parser->parse('order/add_order_template',$data);

	}

	public function order_list_template() 

	{

  		$this->parser->parse('order/order_list_template',[]);

	}

	

	public function get_product_detail(){

		

		$res = $this->ProductModel->GetProductById($this->input->get('id'));

 		

		if($res != false){

			$data_arr = ['id' =>$res['id'],'ProductName' =>$res['ProductName'],'SalePrice' =>$res['SalePrice'],'qty' =>1,'totalPrice' =>$res['SalePrice'] ];

			echo json_encode(['status' => 1 ,'message' => '' , 'json_ar' => $data_arr ]);

		}else{

			echo json_encode(['status' => 0 ,'message' => 'Unable to fatch product data !']);

		}

	}

	

	public function get_member_details(){

		

		$res = $this->UserModel->GetUserDataById($this->input->get('id'));

 		if($res != false){

			$data_arr = ['id' =>$res['id'],'name' =>$res['name'],'mobile_no' =>$res['mobile_no'],'email' =>$res['email'],'address' =>$res['address'], 'pincode'=>$res['pincode'] ];

			echo json_encode(['status' => 1 ,'message' => '' , 'json_ar' => $data_arr ]);

		}else{

			echo json_encode(['status' => 0 ,'message' => 'Unable to member product data !']);

		}

	}

	

	public function add_order(){

		

		$this->OuthModel->CSRFVerify();

		

 		$this->form_validation->set_rules('product_name', 'Product Name', 'required');

		$this->form_validation->set_rules('qty', 'qty', 'required');

		$this->form_validation->set_rules('price', 'Sale Price', 'required');

		$this->form_validation->set_rules('CustomerName', 'Customer Name', 'required');

		$this->form_validation->set_rules('Email', 'Email', 'required');

		$this->form_validation->set_rules('Address', 'Address', 'required');

		

  		

		 if ($this->form_validation->run() == FALSE)

         {

 			 $response = ['status' => 0 ,'message' => '<span style="color:#900;">'.validation_errors().'</span>' ];

			  

         }else{

			 

				$post = $this->input->post();

				$profile_url='';

				if(isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])){	



					$config['upload_path']          = './uploads/profiles';

					$config['allowed_types']        = 'png|jpg|jpeg';

					$config['max_size']             = 500;

					 //$config['max_width']            = 1024;

 					//$config['max_height']           = 768;

					 $this->load->library('upload', $config);

					 if ( ! $this->upload->do_upload('photo'))

					 {

							$AtError = $this->upload->display_errors();

							echo json_encode(['status' => 0 ,'message' => $AtError]);

							die;

					 }

					 else

					 {

							$file_data = $this->upload->data();

							$profile_url = $file_data['file_name'];

					 }

				}

				

				

				 

				$member_id = $post['id'];

				

					

				if(empty($member_id)){

					

					$e = $this->UserModel->IfExistEmail($post['Email']);

					if($e == false){

						$genreatePassword = $this->OuthModel->RandomPassword(8, true, false,true);
						$mail=1;
						//$mail = $this->SendMail(['templateName' => $post['CustomerName'],'templateEmail' => $post['Email'], 'templatePassword' => $genreatePassword, ]);
						// mail function not local server
						// please uncomment live run server 
						if($mail == 1){

						

							

							

								$member_data = [ 	

											'name' => $post['CustomerName'],

											'username' => $post['Email'],

											'password' => $this->OuthModel->HashPassword($genreatePassword),

											'role' => 'Customer',

											'email' => $post['Email'],

											'mobile_no' => $post['Mobile'],

											'pincode' => $post['Pincode'], 

											'address' => $post['Address'],

											'AccountNumber' => $post['AccountNumber'],

											'IFSCCode' => $post['IFSCCode'],

											'picture_url' => $profile_url,

											'ip_address' => $this->input->ip_address(),

											'created' => date('Y-m-d H:i:s'),

										];

							$create_member = $this->UserModel->AddMember($this->OuthModel->xss_clean($member_data));

							$member_id=$create_member;

							

							$this->MemberModel->AddMemberLog( ['id'=> $member_id, 'name' => $post['CustomerName'], 'parent_id' => $post['ReferenceMemberId'] ]); 

							}else{

								$response = [

								'status' => 0,

								'message' => 'Faild to Send Mail. Please try again !'

							];

							echo json_encode($response); die;

						}

						

					}else{

						$response = ['status' => 0 ,'message' => '<span style="color:#900;">Sorry Your Email already use in the database !</span>' 						];

					 echo json_encode($response); die;

					}

					 

				}

				

 				$order_data = [ 	

									'order_id' => '0'.$member_id.time(),

									'member_id' =>$member_id ,

									'member_name' =>$post['CustomerName'] ,

									'product_id' => $post['product_id'],

									'qty' => $post['qty'],
									'is_igst' => $post['is_igst'],
									'unit_price' => $post['price'],

 									'create_date' => date('Y-m-d H:i:s'),

 								];

				

 				 

 				$query = $this->OrderModel->AddOrder($this->OuthModel->xss_clean($order_data));

				 

				$response='';

				if($query == true){

					$response = ['status' => 1 ,'message' => '<span style="color:#090;">Order added Successfully !</span><p>Order Id : '.$order_data['order_id'].'</p>' ];

				}else{

					$response = ['status' => 0 ,'message' => '<span style="color:#900;">sorry we re having some technical problems. please try again !</span>' 						];

				}

           }

		   

		   echo json_encode($response);

		

 	}

	

	

	public function SendMail($templatedata){

		error_reporting(0);

 
			$from_email = 'your@mail.com';

			$replyemail = 'your@mail.com';

			$to_email= $templatedata['templateEmail'];

			$subject= 'Admin MLM Membership Login Details';

  

			$this->OveModel->SMTP_Config(); //

			$this->email->set_newline("\r\n");

			$this->email->set_mailtype("html");

			$this->email->from($from_email,$name='Admin MLM');

			$this->email->to($to_email);

			$this->email->reply_to($replyemail);

			$this->email->subject($subject);

			$this->email->message($this->parser->parse('mail_template/mail_template', $templatedata , true));

  			return $this->email->send();

	

	}

	

	

	

	

	public function order_grid_data()

	{

		$this->OuthModel->CSRFVerify();

 		// storing  request (ie, get/post) global array to a variable  

		$requestData = $_REQUEST;

 		//print_r($requestData);

 

  		$table = "orders";

		$fields = "id,order_id,product_id, qty, unit_price, create_date,member_id ,member_name";

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

 				

			$sql.=" WHERE `order_id` LIKE '%".$searchValue."%' ";   

 			$sql.=" OR `product_id` LIKE '%".$searchValue."%' ";

			$sql.=" OR `member_name` LIKE '%".$searchValue."%' ";

  			$sql.=" OR `unit_price` LIKE '%".$searchValue."%' ";

		}

 		

		

 		$query = $this->db->query($sql);

 		$totalFiltered = $query->num_rows(); // rules datatable

 		//ORDER BY id DESC	

 		$sql.=" ORDER BY create_date DESC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

 		$query = $this->db->query($sql);

 		//echo $sql;

 		$SearchResults = $query->result();

		

  		$data = array();

		foreach($SearchResults as $row){

			$nestedData=array(); 

			

			$id = $row->id;

			

			$url_id=$this->OuthModel->Encryptor('encrypt',$row->order_id);

			

			$tableCheckTD = "<label class='pos-rel'><input type='checkbox' class='ace' /><span class='lbl'></span></label>";
 			$action =  '<div class="action-buttons"><a target="_blank" href="'.base_url('v3/invoice/print-view?id='.$url_id).'" class="green">
																	<i class="ace-icon fa fa-print bigger-130"></i>
																</a>&nbsp;&nbsp;&nbsp;
 				<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">
																	<i class="ace-icon fa fa-trash bigger-130"></i>
																</a>												
 															</div>';

 			/*<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">
																	<i class="ace-icon fa fa-download bigger-130"></i>
																</a>
																&nbsp;&nbsp;&nbsp;
 																<a onclick="trash('.$id.')"  class="red trashID" href="javascript:void(0);">
																	<i class="ace-icon fa fa-envelope bigger-130"></i>
																</a>*/

 			$nestedData[] = '<span class="nameID_'.$id.'">'.$row->order_id.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->product_id.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$this->UserModel->GetMemberNameById($row->member_id).'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->qty.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">'.$row->unit_price.'</span>';

			$nestedData[] = '<span class="contactID_'.$id.'">Success</span>';

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

				 $post['Tax'] = $post['Tax'];

				 $post['ProductName'] = $post['ProductName'];

				 $post['ProductCategory'] = $post['ProductCategory'];

				 $post['SKU'] = $post['SKU'];

				 $post['Price'] = $post['Price'];

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

	 	
public function order_trash(){ 

	//sleep(5);

		$this->OuthModel->CSRFVerify();

		$id=$this->input->get('id');

  		$product = $this->db->delete('orders',['id' =>$id]);

		if($product){

			$json_data = [ "status"            => 1,  

					"message"    => 'One order Deleted !',   

 					];

		}else{

			$json_data = [ "status" =>0,  

					"message"    => 'false',   

 					];

		}

		echo json_encode($json_data); 

		

 	}

	

}

