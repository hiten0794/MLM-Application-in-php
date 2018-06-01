 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('include/header');?>

 <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
.imgcls {
    height: 70px;
    width: 120px;
}
.numcls::-webkit-inner-spin-button, 
.numcls::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
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
        Purchase Listing
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?=$this->uri->segment(2).'/'.$this->uri->segment(3);?></li>
      </ol>
    </section>

    <!-- Main content -->
     	<section class="content">
      <div class="row">
        <div class="col-xs-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">&nbsp;</h3>
               
            </div>
            <button style="margin-left: 10px;" type="button" class="btn btn-info" onClick="add();">Add Product</button>
            
            
            <a href="<?=base_url('excel-purchase-product');?>">
            	<button style="margin-left: 10px;" type="button" class="btn btn-info">Export Excel</button>
              </a>
            
            
            <!-- /.box-header -->
            <div class="box-body" id="element_overlapT">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                   <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>CompanyName</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                <tr>
                   <th>ID</th>
                  <th>Product Name</th>
                   <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>CompanyName</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
 

  <!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" id="element_overlap1">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modaltitle"></h4>
        </div>
        <form action="" id="FormId" class="addProudctForm">
        <div class="modal-body"  style="padding:0px;">
          
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter Product Details</h3>
            </div>
            <div class="box-body">
                 
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Product Name</label>
                  <input type="text" class="form-control" required id="ProductName" name="ProductName" placeholder="Enter Product Name">
                  <input type="hidden" value="0" name="ProductId" id="ProductId">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-6" id="ReferenceMemberIdDiv">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Quantity</label>
                  <input type="number" class="form-control numcls" required id="Quantity" name="Quantity" placeholder="Enter Quantity">
                   <p class="help-block"></p>
                </div> 
               </div>
                
               <div class="col-md-4">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Per Unit Price</label>
                  <input type="number" class="form-control numcls" required id="UnitPrice"  name="UnitPrice" placeholder="Enter Unit Price">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-4">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Total Price</label>
                  <input type="number" readonly class="form-control numcls" required id="TotalPrice"  name="TotalPrice" placeholder="Enter Total Price">
                  <p class="help-block"></p>
                </div> 
               </div>
               
                <div class="col-md-4">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Tax Amount</label>
                  <input type="number" class="form-control numcls" required id="TaxAmount"  name="TaxAmount" placeholder="Enter Tax Amount">
                  <p class="help-block"></p>
                </div> 
               </div>
     
               
               <div class="col-md-12"> 
                 <div class="form-group">
                  <label for="exampleInputPassword1">Product Description </label>
                  <textarea class="form-control" required id="Description" name="ProductDescription"></textarea>
                  <p class="help-block"></p>
                </div> 
               </div>
                
                
                    
            </div>
              <!-- /.box-body -->
          </div>
          
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter Product Company Details</h3>
            </div>
            <div class="box-body">
                 
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Company Name</label>
                  <input type="text" class="form-control" required id="CompanyName" name="CompanyName" placeholder="Enter Company Name">
                   
                  <p class="help-block"></p>
                </div> 
               </div>
               
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Company Email Address</label>
                  <input type="email" class="form-control" required id="Email" name="Email" placeholder="Enter Company Email Address">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Company Phone No.</label>
                  <input type="number" class="form-control numcls" required id="PhoneNo" name="PhoneNo" placeholder="Enter Company Phone No.">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">City</label>
                  <input type="text" class="form-control" required id="City" name="City" placeholder="Enter City">
                  <p class="help-block"></p>
                </div> 
               </div> 
                
               <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">State</label>
                  <input type="text" class="form-control" required id="State" name="State" placeholder="Enter State">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Pincode</label>
                  <input type="number" class="form-control numcls" required id="Pincode" name="Pincode" placeholder="Enter Pincode">
                  <p class="help-block"></p>
                </div> 
               </div>
               
               <div class="col-md-12"> 
                 <div class="form-group">
                  <label for="exampleInputPassword1">Company Address Line </label>
                  <textarea class="form-control" required id="Address" name="Address"></textarea>
                  <p class="help-block"></p>
                </div> 
               </div>
               
               
               <div class="col-md-12"> 
                 <div class="form-group">
                  <label for="exampleInputPassword1">&nbsp;</label>
                   <p class="help-block" id="ErrorMessageU"></p>
                </div> 
               </div>
                
                    
            </div>
            
            
            <!-- /.box-body -->
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary btnclass" value="Add Product">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
      
    </div>
  </div>
  <!-- Modal --> 
   
  
<?php $this->load->view('include/footer');?>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>

<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
     $('#example1').DataTable({
	 					"processing": true,
						"serverSide": true, 
						"ajax":{
							url :"<?=base_url('purchase-product-grid-data')?>", 
							type: "post",  
							headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
							error: function(){  
								$(".contacts-grid-error").html("");
								$("#contacts-grid").append('<tbody class="contacts-grid-error"><tr><th align="center" colspan="5">No data found in the server</th></tr></tbody>');
								$("#contacts-grid_processing").css("display","none");
							} 
						},
	 });
  });
  
function add(){
	$('#modaltitle').html('Add New Purchase Product');
	$('.btnclass').val('Add Product');
	$('#FormId').attr('action','<?=base_url('add-purchase-product');?>');
	$(".addProudctForm").trigger('reset');
	$('#myModal').modal({ backdrop: 'static' });
}
function view(id){
	$('#modaltitle').html('Edit Purchase Product');
	$('.btnclass').val('Edit Product');
 	$('#FormId').attr('action','<?=base_url('edit-purchase-product');?>');
	$("#element_overlapT").LoadingOverlay("show");
	
				$.ajax({
						  dataType : "json",
 						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: '<?=base_url('product_view?id=')?>'+id,
						  success:function(data)
								{
  									$("#element_overlapT").LoadingOverlay("hide", true);
									if(data.code == 400)
									{
									  alert(data.error);
									}
									if(data.status == 0)
									{
									  alert(data.message);
									}
									if(data.status == 1)
									{
										$('#myModal').modal({ backdrop: 'static' });
										 
										
										$('#ProductId').val(data.res['id']);
										$('#ProductName').val(data.res['ProductName']);
										$('#Quantity').val(data.res['Available_qty']);
										$('#UnitPrice').val(data.res['Price']);
										$('#TotalPrice').val(data.res['Price']*1);
										$('#Description').val(data.res['description']);
										$('#CompanyName').val(data.res['company_name']);
										$('#Email').val(data.res['company_email']);
										$('#PhoneNo').val(data.res['company_phone']);
										$('#City').val(data.res['City']);
										$('#State').val(data.res['State']);
										$('#Pincode').val(data.res['Pincode']);
										
										  
										$('#Address').val(data.res['company_address']);
									}
						  },
						  error: function (jqXHR, status, err) {
							  $("#element_overlapT").LoadingOverlay("hide", true);
							  alert('Local error callback');
						  }
 					});
}
function trash(id){
   	$("#element_overlapT").LoadingOverlay("show");
 				$.ajax({
						  dataType : "json",
 						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: '<?=base_url('trash-purchase-product?id=')?>'+id,
						  success:function(data)
								{
  									$("#element_overlapT").LoadingOverlay("hide", true);
									if(data.code == 400)
									{
									  alert(data.error);
									}
									if(data.status == 0)
									{
									  alert(data.message);
									}
									if(data.status == 1)
									{
 										alert(data.message);
										 var table = $('#example1').DataTable();
					 						table.ajax.reload(null, false);
 									}
						  },
						  error: function (jqXHR, status, err) {
							  $("#element_overlapT").LoadingOverlay("hide", true);
							  alert('Local error callback');
						  }
 					});
}

$("#Quantity,#UnitPrice").keyup(function(){
  	$("#TotalPrice").val( $("#UnitPrice").val()*$("#Quantity").val()  );
});


$(".addProudctForm").submit('on',function(e){
	e.preventDefault();
      				$("#element_overlap1").LoadingOverlay("show");
    					$.ajax({
						  dataType : "json",
						  type : "post",
						  data : $(".addProudctForm").serialize(),
						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: $(".addProudctForm").attr('action'),
						  success:function(data)
								{
									$("#element_overlap1").LoadingOverlay("hide", true);
									if(data.code == 400)
									{
									  $('#ErrorMessageU').html('<span style="color:red;">'+data.error+'</span>');
									}
									if(data.status == 0)
									{
									  $('#ErrorMessageU').html('<span style="color:red;">'+data.message+'</span>');
									}
									if(data.status == 1)
									{
										  $('#ErrorMessageU').html(data.message);
										  $('#myModal').modal('hide');
										  var table = $('#example1').DataTable();
					 						table.ajax.reload(null, false);
									}
						  },
						  error: function (jqXHR, status, err) {
							  $("#element_overlap1").LoadingOverlay("hide", true);
							  $('#ErrorMessageU').html('<span style="color:red;">Local error callback.</span>');
						  }
 					});
					//} //else
 });
</script>
 
</body>
</html>
