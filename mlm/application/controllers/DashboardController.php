<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
 	public function __construct()
        {
                parent::__construct();
				$this->load->model(['OrderModel','MemberModel']);
                $this->SeesionModel->not_logged_in();
        }
	
	public function Month(){
	
	}
	
	public function index() 
	{
		
		if($this->session->userdata['Admin']['role'] == 'Admin'){
 			
			$data['orders']=$this->db->count_all_results('orders');
			$data['members']=$this->OveModel->TotalMembers();
			$data['products']=$this->db->count_all_results('products');
			$data['purchase_products']=$this->db->count_all_results('purchase_products');
			
			$sales = $this->OrderModel->MonthWiseSale();
			
			/*echo date('F',strtotime('2018-02'));
			echo date('m',strtotime('February'));
			
					echo '<pre>';
			print_r($sales); die;*/
			 
 			$this->parser->parse('dashboard/dashboard_template',$data);
			
			
		}else{
			$id=$this->session->userdata['Admin']['id'];
			
			
		 
			$data['members']=$this->Parent();
			
			$this->parser->parse('dashboard/dashboard_customer_template',$data);
		}
 		
 	}
	
	public function Parent(){
		
 
			$id=$this->session->userdata['Admin']['id'];
	 
		 
		$member = $this->UserModel->GetUserDataById($id);
		
 		$getChildMember = $this->MemberModel->GetChildMemberById($id);
		
 		$arr=[];
 		
		foreach($getChildMember as $row){///level 2
						$NetSaleVolume3=$this->MemberModel->NetSaleVolume($row['id']);
					$arr[] = [ 
						 'ibo' => $row['name'].' ['.$row['id'].']',
						 'imgUrl' => $this->UserModel->MemberPictureUrl($row['id']),
 						'bv' => $NetSaleVolume3,
 						'children' => $this->Children($row['id']),
 					 ];
		}
		$NetSaleVolume1=$this->MemberModel->NetSaleVolume($id);
		$json = [	'ibo' => $member['name'].' ['.$member['id'].']',
					'imgUrl' => $this->UserModel->MemberPictureUrl($member['id']),
					'bv' => $NetSaleVolume1,
					'children' => $arr
				];
				
 
		return count($json['ibo']);
		
		
	}
	
	public function Children($id){
		
  		$getChildMember = $this->MemberModel->GetChildMemberById($id);
		
 		$arr=[];
 		
		foreach($getChildMember as $row){///level 2
						$NetSaleVolume3=$this->MemberModel->NetSaleVolume($row['id']);
					$arr[] = [ 
						 'ibo' => $row['name'].' ['.$row['id'].']',
						 'imgUrl' => $this->UserModel->MemberPictureUrl($row['id']),
 						'bv' => $NetSaleVolume3,
 						'children' => $this->Children($row['id']),
 					 ];
		}
 		return $arr;
 	}
	 
 	
	
}
