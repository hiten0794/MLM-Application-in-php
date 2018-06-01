<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class InvoiceController extends CI_Controller {

 	public function __construct()

        {

                parent::__construct();

				$this->load->model(['OrderModel','ProductModel','SettingModel']);

                $this->SeesionModel->not_logged_in();
				$this->SeesionModel->is_logged_Admin();

        }

	

	public function index() 

	{

		$this->parser->parse('invoice/generate_invoice_template',[]);

	}

	

 	

	public function genreate_invoice_html(){ 

	

		$order_ID = $this->input->get('id');



		$res = $this->OrderModel->SearchOrderByID($order_ID);

		if($res != false){

			$tax = $this->SettingModel->SettingsByID('tax');

 			$user = $this->UserModel->GetUserDataById($res['member_id']);

			$product = $this->ProductModel->GetProductById($res['product_id']);
			
			 

 	?>

	

			<section class="invoice">

      <!-- title row -->

      <div class="row">

        <div class="col-xs-12">

          <h2 class="page-header">

            <i class="fa fa-globe"></i> Admin MLM Pvt. Ltd.

            <small class="pull-right">Date: <?=date('d/m/Y');?></small>

          </h2>

        </div>

        <!-- /.col -->

      </div>

      <!-- info row -->

      <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">

          From

          <address>
             <strong>Admin MLM Pvt. Ltd.</strong><br>
            Shop No. 122,123 Second Floor<br>
            Kanota Haveli, Dhara Market, Haldiyao ka Rastha,<br>
            Johari Bazar, Jaipur, 302003 <br>

            Phone: +91 9815664828<br>
            Email: your@mail.com
           </address>

        </div>

        <!-- /.col -->

        <div class="col-sm-4 invoice-col">

          To

          <address>

            <strong><?=$user['name'];?></strong><br>

            <?=$user['address'];?> ,<br>

            <?=$user['pincode'];?><br>

            Mobile: <?=$user['mobile_no'];?><br>

            Email: <?=$user['email'];?>

          </address>

        </div>

        <!-- /.col -->

        <div class="col-sm-4 invoice-col">

          <b>Invoice #00<?=$res['id'];?></b><br>

          <br>

          <b>Order ID:</b> <?=$res['order_id'];?><br>

          <b>Date:</b> <?=date('d/m/Y',strtotime($res['create_date']));?><br>

        <!--  <b>Account:</b> 968-34567-->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->



      <!-- Table row -->

      <div class="row">

        <div class="col-xs-12 table-responsive">

          <table class="table table-striped">

            <thead>

            <tr>

              

              <th>Product</th>

              <th>Description</th>

              <th>HSN/SAC</th>

              <th>Unit Price</th>

              <th>Qty</th>

              <th>Subtotal</th>

            </tr>

            </thead>

            <tbody>

            <tr>

              <td><?=$product['ProductName'];?></td>

              <td><?=$product['description'];?></td>

              <td><?=$product['hsn'];?>
              		<br />
                    <?=$product['sac'];?>
              </td>

              <td><i class="fa fa-fw fa-inr"></i> <?=$res['unit_price'];?></td>

              <td><?=$res['qty'];?></td>

              

              <?php $total = $res['unit_price']*$res['qty'];?>

              <td><i class="fa fa-fw fa-inr"></i> <?=$total;?></td>

            </tr>

 

           

            </tbody>

          </table>

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->



      <div class="row">

        <!-- accepted payments column -->

        <div class="col-xs-6">

       <!-- <p class="lead">Payment Methods:</p>

        	<p class="text-muted well well-sm no-shadow">By Cash</p>-->

        </div>

        <!-- /.col -->

        <div class="col-xs-6">

          <p class="lead"><!--Amount Due <?=date('d/m/Y');?>--></p>



          <div class="table-responsive">

            <table class="table">

              <tr>

                <th style="width:50%">Subtotal:</th>

                <td><i class="fa fa-fw fa-inr"></i> <?=$total;?></td>

              </tr>
				<?php
                	$cgst=$product['cgst']/100*$total;
					$sgst=$product['sgst']/100*$total;
				
				$igst=0;	
				if($res['is_igst']=='yes'){	
					$igst=$product['igst']/100*$total;
				}
				?>
                
               <tr>
                 <th>CGST (<?=$product['cgst']?>%)</th>
                <td><i class="fa fa-fw fa-inr"></i> <?=$cgst;?></td>
              </tr>
              <tr>
                 <th>SGST (<?=$product['sgst']?>%)</th>
                <td><i class="fa fa-fw fa-inr"></i> <?=$sgst;?></td>
              </tr>
   			
            <?php if($res['is_igst']=='yes'){?>
              <tr>
                 <th>IGST (<?=$product['igst']?>%)</th>
                <td><i class="fa fa-fw fa-inr"></i> <?=$igst;?></td>
              </tr>
            <?php }?>

              <tr> 

                <th>Shipping:</th>

                <td><i class="fa fa-fw fa-inr"></i> 0.00</td>

              </tr>

              <tr>

                <th>Total:</th>

                <td><i class="fa fa-fw fa-inr"></i> <?=$total+$cgst+$sgst+$igst;?></td>

              </tr>

            </table>

          </div>

        </div>
	 
        <!-- /.col -->

      </div>
      
      
      <div class="row">
      <div class="col-md-12 col-xs-12">
      All subject to jaipur jurisdiction
      </div>
      </div>
      <br />

      <!-- /.row -->



      <!-- this row will not appear when printing -->

      <div class="row no-print">

        <div class="col-xs-12">

          <a href="<?=base_url('v3/invoice/print-view?id='.$this->OuthModel->Encryptor('encrypt',$res['order_id']));?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

          <!--<button type="button" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Send By Email

          </button>

          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">

            <i class="fa fa-download"></i> Generate PDF

          </button>-->

        </div>

      </div>

    </section>

	

	

	<?php 

		}else{

			echo '<section class="invoice"><h5 style="color:red;">Incorrect Order Id Please enter correct order id !</h5></section>';

		}

	

	}

	 

	 

	public function print_view() 

	{

  		$order_ID = $this->OuthModel->Encryptor('decrypt',$this->input->get('id'));



		$res = $this->OrderModel->SearchOrderByID($order_ID);

		if($res != false){

			$data['res'] = $res;

			$data['user'] = $this->UserModel->GetUserDataById($res['member_id']);

			$data['product'] = $this->ProductModel->GetProductById($res['product_id']);

			

			$data['tax'] = $this->SettingModel->SettingsByID('tax');

		

			$this->parser->parse('invoice/generate_invoice_template_print_view',$data);

 	?>

 	<?php 

		}else{

			echo '<section class="invoice"><h5 style="color:red;">Incorrect Order Id Please enter correct order id !</h5></section>';

		}

	

	

	}

  

	

}

