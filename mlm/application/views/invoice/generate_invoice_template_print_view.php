 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('include/header');?>
 
  
</head>
 
 <body onLoad="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     
 	  <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> MLM Pvt. Ltd.
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
             <strong>MLM Pvt. Ltd.</strong><br>
            Shop No. 122,123 Second Floor<br>
            Kanota Haveli, Dhara Market, Haldiyao ka Rastha,<br>
            Johari Bazar, Jaipur, 302003<br>
			 
            Phone: +91 9815664828<br>
            Email: infoMLM@gmail.com
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
          <!--<b>Account:</b> 968-34567-->
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
        	<!--<p class="lead">Payment Methods:</p>
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
               
              <!--<tr>
                <th>Shipping:</th>
                <td><i class="fa fa-fw fa-inr"></i> 5.80</td>
              </tr>-->
              <tr>
                <th>Total:</th>
                <td><i class="fa fa-fw fa-inr"></i> <?=$total+$cgst+$sgst+$igst;?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
       
      <div class="row">
      <div class="col-md-12 col-xs-12">
      All subject to jaipur jurisdiction
      </div>
      </div>
      <br />
     
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
 
</html>
