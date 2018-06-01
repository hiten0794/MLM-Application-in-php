 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>



<?php $this->load->view('include/header');?>



<style>

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

        Add New Order

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

            <form role="form" id="OrderForm" action="<?=base_url('add_order');?>" method="post" enctype="multipart/form-data">

              <div class="box-body">

              

               <div class="col-md-6" id="element_overlap1">

                  <div class="form-group">

                  <label for="exampleInputPassword1">Select Product</label>

                  <select class="form-control" onChange="selectProduct(this.value);">

                  	<option></option>

                    <?php

                    	foreach($products as $p){

							?>

                             <option value="<?=$p['id']?>"><?=$p['ProductName']?> (sale price <?=$p['SalePrice']?>)</option>

					 <?php	}

					?>

                  </select>

                  <p class="help-block" id="ErrorMessagep"></p>

                </div>

                </div>

               	<div class="col-md-1"><p style="margin-top: 30px;"><b>OR</b></p></div>

                <div class="col-md-3">

                	

                 <div class="form-group">

                  <label for="exampleInputPassword1">Search Product</label>

                  <input type="text" class="form-control" id="product_search_id" placeholder="Enter Product Id">

                   <p class="help-block" id="ErrorMessageSearch" style="color:red;"></p> 

                </div> 

               </div>

               <div class="col-md-2">

                 <div class="form-group">

                  <label for="exampleInputPassword1">&nbsp;</label>

                  <input style="margin-top: 25px;" type="button" onClick="searchProduct();" class="btn btn-info" value="Search">

                  <p class="help-block"></p>

                </div> 

               </div>

                

                

                

                <div class="col-md-6">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Product Name</label>

                  <input type="text" class="form-control" required id="product_name" name="product_name" placeholder="Product Name">

                   <input type="hidden" id="product_id" style="display:none;">

                  <p class="help-block"></p>

                </div> 

               </div>

               

                <div class="col-md-6">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Quantity </label>

                  <input type="number" class="form-control" required id="qty" name="qty" min="1" placeholder="Quantity">

                  <p class="help-block"></p>

                </div>

              

              </div>

                 

                 

                  <div class="col-md-6">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Unit Price</label>

                  <input type="number" class="form-control numcls" required id="price" name="price" placeholder="Unit Price">

                  <p class="help-block"></p>

                </div> 

               </div>

               

                <div class="col-md-6">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Total Price</label>

                  <input type="number" class="form-control numcls" required id="totalprice" name="totalprice" placeholder="Total Price">

                  <p class="help-block"></p>

                </div>

              

              </div>
              
              
              <div class="col-md-12">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Is Billing Out of state ?</label>

                  		<input type="radio" name="is_igst" value="yes"> Yes  &nbsp;&nbsp;

                        <input name="is_igst" type="radio" value="no"> No

                  <p class="help-block"></p>

                </div>

              
  
              </div>

                 

  

             

             </div>

              <!-- /.box-body -->



                  <div class="box box-primary">

                <div class="box-header with-border">

                  <h3 class="box-title">Enter Customer Details</h3>

                </div>

                <div class="box-body" id="element_overlap2">

                    

                    <div class="col-md-12">

                        Already member ?  &nbsp;&nbsp; <input type="radio" name="YN" onClick="AlreadyM('Yes');"> Yes  &nbsp;&nbsp;

                        <input name="YN" type="radio" checked onClick="AlreadyM('No');"> No

                    </div>

                    

                    

                    <div class="member" style="display:none;">

                    <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Registerd Member ID</label>

                      <input type="text" class="form-control" id="MembershipID" name="MembershipID" placeholder="Enter Membership ID">

                      

                    </div> 

                   </div>

                   

                    <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">&nbsp; </label>

                        <button style="margin-top: 25px;" type="button" class="btn btn-primary CheckMember">Check Member Details</button>

                      <p class="help-block" id="membererror" style="color:red;"></p>

                    </div>

                  

                  </div>

                    </div>

 
                    <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Customer Name</label>

                      <input type="text" class="form-control" required id="CustomerName"  name="CustomerName" placeholder="Enter Customer Name">

                      <input type="hidden" name="id" id="member_ID" style="display:none;">

                      <p class="help-block"></p>

                    </div> 

                   </div>

                   

                   <div class="col-md-6" id="ReferenceMemberIdDiv">

                   

                   

                  

                  

                     <div class="form-group">

                      <label for="inputSuccess">Reference Member Id</label>

                      

                       <div class="mId1">

                        <span class="input-group-addon mId2" style="display:none;">

                            

                        </span>

                        

                         <input type="number" class="form-control numcls" id="ReferenceMemberId" name="ReferenceMemberId" placeholder="Enter Reference Member Id">

                      </div>

                         <p class="help-block mName">

                        

                       </p>

                    </div> 

                   </div>

                   

                   <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Mobile No.</label>

                      <input type="number" class="form-control numcls" required id="Mobile"  name="Mobile" placeholder="Enter Mobile No.">

                      <p class="help-block"></p>

                    </div> 

                   </div>

                   

                   <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Email Address</label>

                      <input type="email" class="form-control" required id="Email"  name="Email" placeholder="Enter Mobile No.">

                      <p class="help-block"></p>

                    </div> 

                   </div>

                   

                   <div class="col-md-6">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Pincode No.</label>

                      <input type="number" class="form-control numcls" required id="Pincode" name="Pincode" placeholder="Enter Mobile No.">

                      <p class="help-block"></p>

                    </div> 

                   </div>

                    <div class="col-md-6 bankDiv">

                     <div class="form-group">

                      <label for="exampleInputPassword1">Photo</label>

                      <input type="file" class="form-control"  id="c_Image">

                      <p class="help-block"></p>

                    </div> 

                   </div>

                   

                   <div class="col-md-12"> 

                     <div class="form-group">

                      <label for="exampleInputPassword1">Address </label>

                      <textarea class="form-control" required id="Address" name="Address"></textarea>

                      <p class="help-block"></p>

                    </div> 

                   </div>

                         

                </div>

                

                

                <!-- /.box-body -->

              </div>

          

          		

             <div class="box box-primary">

            <div class="box-header with-border bankDiv">

              <h3 class="box-title">Enter Customer Bank Details</h3>

            </div>

            <div class="box-body">

               	

                 <div class="col-md-6 bankDiv">

                 <div class="form-group">

                  <label for="exampleInputPassword1">Account Number</label>

                  <input type="text" class="form-control" id="AccountNumber" value="" name="AccountNumber" placeholder="Enter Account Number">

                   

                  <p class="help-block"></p>

                </div> 

               </div>

               

               <div class="col-md-6 bankDiv">

               

                 <div class="form-group">

                  <label for="inputSuccess">IFSC Code</label>

                       <input type="text" class="form-control" id="IFSCCode" placeholder="Enter IFSC Code">

                      <p class="help-block"> </p>

                </div> 

               </div>

               

                 <div class="col-md-6">

                <button type="submit" class="btn btn-primary">Create Order</button>

              </div>

                    

            </div>

            

            

            <!-- /.box-body -->

          </div>

          

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

jQuery("#OrderForm").submit('on',function(e){

					e.preventDefault();

					

					jQuery('#ErrorMessage').html('');

					jQuery("#element_overlap").LoadingOverlay("show");

					

					var file_data = $('#c_Image').prop('files')[0];   

					var form_data = new FormData();

					form_data.append('photo', file_data);

					

 					form_data.append('product_id', $("#product_id").val());

					form_data.append('product_name', $("#product_name").val());

					form_data.append('qty', $("#qty").val());

					form_data.append('price', $("#price").val());
					form_data.append('is_igst', $("input[name='is_igst']:checked").val() );

					form_data.append('CustomerName', $("#CustomerName").val());

					

					form_data.append('id', $("#member_ID").val());

					form_data.append('ReferenceMemberId', $("#ReferenceMemberId").val());

					form_data.append('Mobile', $("#Mobile").val());

					form_data.append('Email', $("#Email").val());

					form_data.append('Pincode', $("#Pincode").val());

					form_data.append('Address', $("#Address").val());

					form_data.append('AccountNumber', $("#AccountNumber").val());

					form_data.append('IFSCCode', $("#IFSCCode").val());

 

 

  					jQuery.ajax({

					  dataType : "json",

					  type : "post",

					  cache: false,

					  contentType: false,

					  processData: false,

					  data : form_data,

					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},

					  url: jQuery('#OrderForm').attr('action'),

					  success:function(data)

							{

								jQuery("#element_overlap").LoadingOverlay("hide", true);

								

 								$('#myModal2').modal({ backdrop: 'static' });

 								if(data.status == 0)

								{

								  jQuery('#ErrorMessage').html(data.message);

								}

								if(data.status == 1)

								{

 									  jQuery('#ErrorMessage').html(data.message);

									  jQuery('#OrderForm').trigger('reset');

 								}

 					  },

					  error: function (jqXHR, status, err) {

						  jQuery('#ErrorMessage').html("Local error callback.");

 					  }

				

					});

					//} //else



});

$("#qty").change('on',function(e){

 	if($("#qty").val() != 0){

 		$("#totalprice").val( $("#price").val()*$("#qty").val()  );

	}else{

		$("#qty").val(1);

	}

});

$("#ReferenceMemberId").keyup('on',function(){

	var ReferenceMemberId = $("#ReferenceMemberId").val();

	if(ReferenceMemberId != ''){

		$('.mId1').addClass('input-group');

		$('.mId2').show();

		$('.mId2').html('<img style="height: 20px;" src="<?=base_url('public/images/ajax-loader.gif');?>">');

		  

 		$.ajax({ 	dataType : "json",

 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},

					  url: '<?=base_url('get_member_detail?id=');?>'+ReferenceMemberId,

					  success:function(data)

							{

								/*if(data.status == 0)

								{

								  alert(data.message);

								}*/

 								if(data.status == 1)

								{

									//alert('Member Id verified : '+data.json_ar['name']); 

									$('.mName').html('<span style="color:green;">Member Id verified : '+data.json_ar['name']+'</span>');

									$('.mId2').html('<img style="height: 20px;" src="<?=base_url('public/images/green_checkmark.jpg');?>">');

   								}else{

									$('.mName').html('<span style="color:red;">Unknown Member Id</span>'); 

									$('.mId2').html('<img style="height: 20px;" src="<?=base_url('public/images/cross_mark.jpg');?>">');

								}

								

 					  },

					  error: function (jqXHR, status, err) {

 						 // alert("Local error callback.");

 					  }

				

					});

		

	}else{

		$('.mId1').removeClass('input-group');

		$('.mId2').hide();

		$('.mName').html(''); 

	}	

 

	

	

 		

		console.log(ReferenceMemberId);

 

});





$(".CheckMember").click('on',function(e){

 	if($("#MembershipID").val() != ''){

			$('#membererror').html('');

 		 	$("#element_overlap2").LoadingOverlay("show");

 			$.ajax({ 	dataType : "json",

 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},

					  url: '<?=base_url('get_member_detail?id=');?>'+$("#MembershipID").val(),

					  success:function(data)

							{

								$("#element_overlap2").LoadingOverlay("hide", true);

								

  								if(data.status == 0)

								{

								  $('#membererror').html(data.message);

								}

 								if(data.status == 1)

								{

									 

									   $("#member_ID").val(data.json_ar['id']);

									  $("#CustomerName").val(data.json_ar['name']);

									  $("#Mobile").val(data.json_ar['mobile_no']);

									  $("#Email").val(data.json_ar['email']);

									  $("#Pincode").val(data.json_ar['pincode']);

									  $("#Address").val(data.json_ar['address']);  

  								}

 					  },

					  error: function (jqXHR, status, err) {

						  $("#element_overlap2").LoadingOverlay("hide", true);

						  $('#membererror').html("Local error callback.");

 					  }

				

					});

	}else{

		$('#membererror').html('Please enter membership Id !'); 

	}

});









function AlreadyM(type){

	if(type=='Yes'){$('.member').show(); $('#ReferenceMemberIdDiv').hide(); $("#ReferenceMemberId").val('');

		$('.mId1').removeClass('input-group');

		$('.mId2').hide();

		$('.mName').html('');

		$('.bankDiv').hide();

		

	}

	if(type=='No'){$('.member').hide();

		$('#ReferenceMemberIdDiv').show();

 	    

		$("#MembershipID").val('');

		$("#CustomerName").val('');

		$("#Mobile").val('');

		$("#Email").val('');

		$("#Pincode").val('');

		$("#Address").val(''); 

		

		$('.bankDiv').show();

	}

}

function searchProduct(){

	if($("#product_search_id").val() != ''){

		selectProduct($("#product_search_id").val());

		$('#ErrorMessageSearch').html('');

	}else{

		$('#ErrorMessageSearch').html('Please enter Product Id !'); 

	}

}

function selectProduct(id){

	$("#element_overlap1").LoadingOverlay("show");

 		$.ajax({ 	dataType : "json",

 					  headers: {  'Authkey': '<?=$this->security->get_csrf_hash();?>'},

					  url: '<?=base_url('get_product_detail?id=');?>'+id,

					  success:function(data)

							{

								$("#element_overlap1").LoadingOverlay("hide", true);

								

  								if(data.status == 0)

								{

								  $('#ErrorMessagep').html(data.message);

								}

								

								if(data.status == 1)

								{

 									  

									  

									  $("#product_id").val(data.json_ar['id']);

									  $("#product_name").val(data.json_ar['ProductName']);

									  $("#qty").val(data.json_ar['qty']);

									  $("#price").val(data.json_ar['SalePrice']);

									  $("#totalprice").val(data.json_ar['totalPrice']);

									  

									  $('#ErrorMessagep').html('');

  								}

 					  },

					  error: function (jqXHR, status, err) {

						  $('#ErrorMessagep').html("Local error callback.");

 					  }

				

					});

}

 </script>

  

</body>

</html>

