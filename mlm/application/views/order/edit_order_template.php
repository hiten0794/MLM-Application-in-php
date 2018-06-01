 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('include/header');?>
 
 
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
        add product 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        
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
            <form role="form" id="ProductForm" action="<?=base_url('edit_product');?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
              
               <div class="col-md-6">
               
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Id</label>
                  <input type="number" class="form-control" readonly value="<?=$product['id'];?>">
                   <input type="hidden" id="product_Id" value="<?=$product['id'];?>">
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputPassword1">AVAILABLE QUANTITY</label>
                  <input type="number" class="form-control" id="Available_qty" value="<?=$product['Available_qty'];?>">
                  <p class="help-block"></p>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Price</label>
                  <input type="number" class="form-control" id="Price" value="<?=$product['Price'];?>" placeholder="Product">
                  <p class="help-block"></p>
                </div> 
                
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Tax</label>
                  <input type="number" class="form-control" id="Tax" value="<?=$product['Tax'];?>" placeholder="Product">
                  <p class="help-block"></p>
                </div>
              
              </div>
                 
                <div class="col-md-6">
               
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" id="ProductName" value="<?=$product['ProductName'];?>" placeholder="Product Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Product Category</label>
                  <select class="form-control" id="ProductCategory">
                  	<option>option 1</option>
                    <option>option 2</option>
                  </select>
                  <p class="help-block"></p>
                </div>
              
              
                <div class="form-group">
                  <label for="exampleInputPassword1">SKU</label>
                  <input type="text" class="form-control" id="SKU" value="<?=$product['SKU'];?>"  placeholder="SKU Code">
                  <p class="help-block"></p>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Sale Price</label>
                  <input type="number" class="form-control" id="SalePrice" value="<?=$product['SalePrice'];?>" placeholder="Product">
                  <p class="help-block"></p>
                </div>
                
               
                
                </div>
                
                
                <div class="col-md-12">  
                <div class="form-group">
                  <label for="exampleInputPassword1">Product Description</label>
                  <textarea class="form-control" id="description"  placeholder="Product Description"><?=$product['description'];?></textarea>
                  <p class="help-block"></p>
                </div>
               </div>
               
               
                 <div class="col-md-6">    
                    <div class="form-group">
                      <label for="exampleInputFile">Product File</label>
                      <input type="file" id="productImage" >
                       <p class="help-block"></p>
                      <img src="<?=base_url('uploads/products/'.$product['productImage']);?>" style="height: 70px; width: 130px;" class="img-thumbnail">
                    </div>
                     
                  </div>
              
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
  
             
             </div>
              <!-- /.box-body -->
              
            </form>
          </div>
          <!-- /.box -->
         </div>
         
          
        
        </div>
       
    </section>
    <!-- /.content -->
 
  
  </div>
  
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="document_name">Message</h4>
        </div>
        <div class="modal-body">
                 <div id="ErrorMessage">
                     
                </div>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <!-- /.content-wrapper -->
  
<?php $this->load->view('include/footer');?>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
<script>
jQuery("#ProductForm").submit('on',function(e){
					e.preventDefault();
					
					jQuery('#ErrorMessage').html('');
					
					//jQuery("#element_overlap").LoadingOverlay("show");
					
					var file_data = $('#productImage').prop('files')[0];   
					var form_data = new FormData();
					//alert(file_data);
					//if(file_data != 'undefined'){
					form_data.append('product_Image', file_data);
					//}
					
					form_data.append('product_Id', $("#product_Id").val());
					form_data.append('Available_qty', $("#Available_qty").val());
					form_data.append('Tax', $("#Tax").val());
					form_data.append('ProductName', $("#ProductName").val());
					form_data.append('ProductCategory', $("#ProductCategory").val());
					form_data.append('SKU', $("#SKU").val());
					form_data.append('Price', $("#Price").val());
					form_data.append('SalePrice', $("#SalePrice").val());
					form_data.append('description', $("#description").val());
				 
 					jQuery.ajax({
					  dataType : "json",
					  type : "post",
					  cache: false,
					  contentType: false,
					  processData: false,
					  data : form_data,
					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
					  url: jQuery('#ProductForm').attr('action'),
					  success:function(data)
							{
								jQuery("#element_overlap").LoadingOverlay("hide", true);
								
								//alert(data.message);
								$('#myModal2').modal({ backdrop: 'static' });
								if(data.code == 400) { $('#ErrorMessage').html(data.error); }
					
 								if(data.status == 0)
								{
								  jQuery('#ErrorMessage').html(data.message);
								}
								if(data.status == 1)
								{
 									  jQuery('#ErrorMessage').html(data.message);
									  jQuery('#ProductForm').trigger('reset');
 								}
 					  },
					  error: function (jqXHR, status, err) {
						  jQuery('#ErrorMessage').html("Local error callback.");
 					  }
				
					});
					//} //else
});
 </script>
  
</body>
</html>
