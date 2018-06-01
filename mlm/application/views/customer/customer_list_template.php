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

        Member's Listing

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

            <!-- /.box-header -->

            <div class="box-body" id="element_overlapT">

              <table id="example1" class="table table-bordered table-striped">

                <thead>

                <tr>

                  <th>MemberId</th>

                  <th>Member Name</th>

                   <th>Email</th>

                  <th>Mobile No.</th>

                  <!--<th>Net Sale</th>-->

                  <th>Created</th>

                  <th>Actions</th>

                </tr>

                </thead>

                <tbody>

                  

                </tbody>

                <tfoot>

                <tr>

                   <th>MemberId</th>

                  <th>Member Name</th>

                   <th>Email</th>

                  <th>Mobile No.</th>

                 <!-- <th>Net Sale</th>-->

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

    <div class="modal-dialog modal-lg">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Fleet-Deatils</h4>

        </div>

        <div class="modal-body">

          

                <div id="tableData">

                    <div class="progress">

                     <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">

                            Please wait.....

                        </div>

                      </div>

                </div>

          

          

          

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

      </div>

      

    </div>

  </div>

  <!-- Modal --> 

  <div class="modal fade" id="myModal2" role="dialog">

    <div class="modal-dialog modal-lg">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="document_name">document name</h4>

        </div>

        <div class="modal-body">

                 <div id="tableDataDocument">

                    <div class="progress">

                     <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">

                            Please wait..... loading doucment

                        </div>

                      </div>

                </div>

         </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

      </div>

      

    </div>

  </div>

  

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

							url :"<?=base_url('customer-grid-data')?>", 

							type: "post",  

							headers: { 'Authkey': '<?=$this->security->get_csrf_hash();?>'},

							error: function(){  

								$(".contacts-grid-error").html("");

								$("#contacts-grid").append('<tbody class="contacts-grid-error"><tr><th align="center" colspan="5">No data found in the server</th></tr></tbody>');

								$("#contacts-grid_processing").css("display","none");

							} 

						},

	 });

  });

  

function trash(id){

	

   	$("#element_overlapT").LoadingOverlay("show");

 				$.ajax({

						  dataType : "json",

 						  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},

						  url: '<?=base_url('trash-member?id=')?>'+id,

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

 

</script>

 

</body>

</html>

