<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class MemberModel extends CI_Model {



  	public function __construct()

        {

                parent::__construct();

                // Your own constructor code

        }

	

	private $Member = 'member_log';

  	

	public function AddMemberLog($data)

	{  

		$res = $this->db->insert($this->Member,$data);

		if($res == 1)

			return true;

		else

			return false;	

  	}

	public function TrashByID($id)

	{  

  		$res = $this->db->delete($this->Member,['id' => $id ] ); 

		if($res == 1)

			return true;

		else

			return false;

 	}

	

	

	public function GetChildMemberById($parent_id) 

	{  

 		$this->db->select('*');

		$this->db->from($this->Member);

		$this->db->where("parent_id",$parent_id);

   		$query = $this->db->get();

 		if ($query) {

			 return $query->result_array();

		 } else {

			 return false;

		 }

   	}

	

	public function NetSaleVolume($member_id)

	{  

  		$res = $this->db->select('qty,unit_price'); 

		$this->db->from('orders');

		$this->db->where('member_id',$member_id);

   		$query = $this->db->get();

 		if ($query->num_rows()!=0) {

			$total_inr=[];

			foreach($query->result_array() as $row){

				$total_inr[]=$row['unit_price']*$row['qty'];			

			}

 			$total_sale = array_sum($total_inr);

			return $total_sale;

 		 } else {

			 return '0.00';

		 }

 	}

	

	public function GrandTotalNetSaleVolume($member_ids)

	{  

  		$res = $this->db->select('qty,unit_price'); 

		$this->db->from('orders');

		$this->db->where_in('member_id',$member_ids);

   		$query = $this->db->get();

 		if ($query->num_rows()!=0) {

			$total_inr=[];

			foreach($query->result_array() as $row){

				$total_inr[]=$row['unit_price'];			

			}

 			$total_sale = array_sum($total_inr);

			return $total_sale;

 		 } else {

			 return '0.00';

		 }

 	}

/////////////////////////////////////////////Bonus level/////////////////////////////////

	public function MemberIncomePercent($TotalNetSaleVolume){

		

		$NetSaleVolumeRates=[

								['Volume' => 8000,'Bonus'=>6],

								['Volume' => 40000,'Bonus'=>9],

								['Volume' => 96000,'Bonus'=>11],

								['Volume' => 192000,'Bonus'=>13],

								['Volume' => 320000,'Bonus'=>15],

								['Volume' => 560000,'Bonus'=>18],

								['Volume' => 800000,'Bonus'=>21],

 						];

						

		//$forumla = $NetSalesVolume/100*$percent;

		$TotalNetSaleVolume=96000;

		

		$b=['BL' => 0, 'BI' => 0];

		$BL_1='';

		if($TotalNetSaleVolume == 8000 || $TotalNetSaleVolume < 40000){

			

			$BL_1=$TotalNetSaleVolume/100*6;

 			return $b=['BL' => 6, 'BI' => $TotalNetSaleVolume/100*6 ];

		}

		if($TotalNetSaleVolume == 40000 || $TotalNetSaleVolume < 96000){

			

			$BL_1=10000/100*6;

			

			return $b=['BL' => 9, 'BI' => $TotalNetSaleVolume/100*3 + $BL_1];

		}

		

		if($TotalNetSaleVolume == 96000 || $TotalNetSaleVolume < 192000){

			

			$BL_1=10000/100*6;

			

			return $b=['BL' => 11, 'BI' => $TotalNetSaleVolume/100*5 + $BL_1];

		}

		

		

		

						

 		

	}

	

	

 

 }

