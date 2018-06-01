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
        Category Listing
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
            <button style="margin-left: 10px;" type="button" class="btn btn-info" onClick="add();">Add Category</button>
            
 
            
            
            <!-- /.box-header -->
            <div class="box-body" id="element_overlapT">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                   <th>Description</th>
                   <th>Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                <tr>
                   <th>ID</th>
                  <th>Category Name</th>
                   <th>Description</th>
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
              <h3 class="box-title">Enter Category Details</h3>
            </div>
            <div class="box-body">
                 
                <div class="col-md-12">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Category Name</label>
                  <input type="text" class="form-control" required id="ProductName" name="ProductName" placeholder="Enter Product Name">
                  <input type="hidden" value="0" name="ProductId" id="ProductId">
                  <p class="help-block"></p>
                </div> 
               </div>
             
              
               
               
               
               <div class="col-md-12"> 
                 <div class="form-group">
                  <label for="exampleInputPassword1">Category Description </label>
                  <textarea class="form-control" required id="Description" name="ProductDescription"></textarea>
                  <p class="help-block"></p>
                </div> 
               </div>
                
                
                    
            </div>
              <!-- /.box-body -->
          </div>
          
            
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary btnclass" value="Add Category">
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
							url :"<?=base_url('category-grid-data')?>", 
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
	$('#modaltitle').html('Add New Purchase Category');
	$('.btnclass').val('Add Category');
	$('#FormId').attr('action','<?=base_url('add-category');?>');
	$(".addProudctForm").trigger('reset');
	$('#myModal').modal({ backdrop: 'static' });
}
function view(id){
	$('#modaltitle').html('Edit Category');
	$('.btnclass').val('Edit Category');
 	$('#FormId').attr('action','<?=base_url('edit-category');?>');
	$("#element_overlapT").LoadingOverlay("show");
	
				$.ajax({
						  dataType : "json",
 						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
						  url: '<?=base_url('category_view?id=')?>'+id,
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
										$('#ProductName').val(data.res['name']);
 										$('#Description').val(data.res['description']);
									 
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
						  url: '<?=base_url('trash-category?id=')?>'+id,
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
