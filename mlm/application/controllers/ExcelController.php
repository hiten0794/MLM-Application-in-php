<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class ExcelController extends CI_Controller { 

	public function __construct() { 

		parent::__construct(); 

 		$this->load->library('excel');

		$this->load->model(['PurchaseProductModel']);

		$this->SeesionModel->not_logged_in();
		$this->SeesionModel->is_logged_Admin();

    }

 

    public function index_purchase_products()

    {

                 $this->excel->setActiveSheetIndex(0);

                //name the worksheet

                $this->excel->getActiveSheet()->setTitle('Product Listing '.date('d-m-Y'));

                //set cell A1 content with some text

                $this->excel->getActiveSheet()->setCellValue('A1', 'Product Id');

                $this->excel->getActiveSheet()->setCellValue('B1', 'Product Name');

                $this->excel->getActiveSheet()->setCellValue('C1', 'Quantity');

                $this->excel->getActiveSheet()->setCellValue('D1', 'Unit Price');

				$this->excel->getActiveSheet()->setCellValue('E1', 'Tax Amount');

				$this->excel->getActiveSheet()->setCellValue('F1', 'Product Description');

				$this->excel->getActiveSheet()->setCellValue('G1', 'Company Name');

				$this->excel->getActiveSheet()->setCellValue('H1', 'Company Email');

				$this->excel->getActiveSheet()->setCellValue('I1', 'Company Phone');

				$this->excel->getActiveSheet()->setCellValue('J1', 'Company City');

				$this->excel->getActiveSheet()->setCellValue('K1', 'Company State');

				$this->excel->getActiveSheet()->setCellValue('M1', 'Company Pincode');

				$this->excel->getActiveSheet()->setCellValue('L1', 'Company Address');

				$this->excel->getActiveSheet()->setCellValue('O1', 'Created');



                 //merge cell A1 until C1

                //$this->excel->getActiveSheet()->mergeCells('A1:C1');

                //set aligment to center for that merged cell (A1 to C1)

                //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //make the font become bold

                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);

 				

				

                //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);

                //$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('J'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);

                 //change the font size

                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        }

                //retrive contries table data  

                $result = $this->PurchaseProductModel->GetProductExcelData();
				 

                $exceldata="";

        foreach ($result as $row){

                $exceldata[] = $row;

        }

 

                 $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

                 

                //$this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //$this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                 

                $filename= 'purchase-products-'.date('d-m-Y').'.xls'; //save our workbook as this file name

                header('Content-Type: application/vnd.ms-excel'); //mime type

                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

                header('Cache-Control: max-age=0'); //no cache

 

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)

                //if you want to save it as .XLSX Excel 2007 format

                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  

                //force user to download the Excel file without writing it to server's HD

                $objWriter->save('php://output');

                 

    }

 

         

}

 

