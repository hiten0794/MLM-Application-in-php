 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('include/header');?>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
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
        Settings
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">

      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom" id="element_overlap">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Tax</a></li>
               <li><a href="#settings" data-toggle="tab">Other</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
               	<form class="form-horizontal UpdateDetails">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Tax %</label>

                    <div class="col-sm-10">
                      
                      <input type="number" class="form-control" value="<?=$tax['value'];?>" name="tax">
                    </div>
                  </div>
                   
                  
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            

              <div class="tab-pane" id="settings">
                
                
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
 
  
  </div>
 
 
 
  
   <!-- /.content-wrapper -->
  
<?php $this->load->view('include/footer');?>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>

<script>
$(".UpdateDetails").submit('on',function(e){
					e.preventDefault();
  
 					$("#element_overlap").LoadingOverlay("show");
 
   					$.ajax({
					  dataType : "json",
 					  data : $(".UpdateDetails").serialize(),
 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},
					  url: '<?=base_url('settings-update-tax');?>',
					  success:function(data)
							{
								$("#element_overlap").LoadingOverlay("hide", true);
								if(data.code == 400) { alert(data.error); }
   								if(data.status == 0)
								{
								  	alert(data.message);
								}
								if(data.status == 1)
								{
 									alert(data.message);
  								}
 					  },
					  error: function (jqXHR, status, err) {
						  $("#element_overlap").LoadingOverlay("hide", true);
						  alert('Local error callback.');
 						   
 					  }
 					});
					//} //else
 });
 
 
 
 </script>
  
</body>
</html>
