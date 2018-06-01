 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('include/header');?>
 <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
.imgcls {
    height: 70px;
    width: 120px;
}
</style>
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('include/topbar');?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('include/sidebar');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Generate Invoice
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?=$this->uri->segment(2).'/'.$this->uri->segment(3);?></li>
          </ol>
        </section>
    <!-- Main content -->
     	 <section class="content">
      <div class="row" id="element_overlap">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
             <!-- form start -->
            <form role="form" id="OrderForm" action="<?=base_url('add_order');?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
              
                
                <div class="col-md-6">
                         <div class="form-group">
                          <label for="exampleInputPassword1">Enter Order No.</label>
                          <input type="text" class="form-control" id="InvoiceNo" name="InvoiceNo" placeholder="Enter Order No.">
                          <p class="help-block" id="envoiceerror" style="color:red;"></p>
                        </div> 
                       </div>
               
                <div class="col-md-6"> 
                 <div class="form-group">
                  <label for="exampleInputPassword1">&nbsp; </label>
                  	<button style="margin-top: 25px;" type="button" class="btn btn-primary GetInvoiceBtn">Get Invoice</button>
                  
                </div>
              
              </div>
              
              <div class="col-md-12" style="display:none;" id="progressBar"> 
              <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                   Please wait Generating Invoice.....
                </div>
              </div>
              </div>
                 
  
             
             </div>
              <!-- /.box-body -->
               
            </form>
          </div>
          <!-- /.box -->
         </div>
         
          
        
        </div>
       
    </section>
    
    
    
    <div id="invoiceHTML"></div>
      
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
 
  <!-- Modal -->
   
  <!-- Modal --> 
   
  
<?php $this->load->view('include/footer');?>
 
<script>  
$(".GetInvoiceBtn").click('on',function(e){
 	if($("#InvoiceNo").val() != ''){
 		$("#envoiceerror").html('');
		$("#progressBar").show();
		
		
		
			$.ajax({  
 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
					  url: '<?=base_url('genreate_invoice_html?id=');?>'+$("#InvoiceNo").val(),
					  success:function(data)
							{
								
								setTimeout(function(){ $("#progressBar").hide(); }, 400);
								
								
 								 $('#invoiceHTML').html(data);
								 
 					  },
					  error: function (jqXHR, status, err) {
						  $("#progressBar").hide();
						  $('#envoiceerror').html("Local error callback.");
 					  }
				
					});
		 
	}else{
		$("#InvoiceNo").focus();
		$("#envoiceerror").html('Please enter inovice no.'); 
	}
});
 
</script>
 
</body>
</html>
