<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentTypeModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
 
 	public function DocumentsList(){// vehicles documents
 		return [
				'Vehicle Registration',
				'Vehicle Registration(Back)',
				'Vehicle Insurance',
				'Vehicle Permit - Part A',
				'Vehicle Permit - Part B',
				'Fitness Certificate',
				'Vehicle Registration Slip',
				'Permit Authorisation',
				'Vehicle Loan EMI Details',
				'No Objection Certificate (NOC)/Power of Attorney'
		];
 	}
	
	public function Fleet_Documents(){
		return [
				'Driver License',
				'Police Verification Certificate / Slip',
				'Background Check Consent',
				'Driving Licence (Back)',
				'ACH Mandate Form',
				'Pan Card'
			];
	}
	
	public function Driver_Documents(){
		return [
				'Driver License',
				'Police Verification Certificate / Slip',
				'Background Check Consent',
				'Driving Licence (Back)',
				'ACH Mandate Form',
				'Pan Card'
			];
	}
	
 
 }
