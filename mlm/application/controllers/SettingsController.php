<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class SettingsController extends CI_Controller {

 	public function __construct()

        {

                parent::__construct();

				$this->load->model(['SettingModel']);

                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();

        }

	

	public function index() 

	{

		$data['tax'] = $this->SettingModel->SettingsByID('tax');

		

  		$this->parser->parse('settings/settings_template',$data);

	}

	

	public function update_tax(){

		 

		$this->OuthModel->CSRFVerify();

		$value=$this->input->get('tax');

		

 		$tax = $this->db->update('settings',['value' =>$value], ['type' =>'tax']);

		if($tax != false){

			$json_data = [ "status"            => 1,  

					"message"    => 'Tax Updated !',   

 					];

		}else{

			$json_data = [ "status" =>0,  

					"message"    => 'false',   

 					];

		}

		echo json_encode($json_data); 

	}

	 	

	

}

