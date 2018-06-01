 <?php defined('BASEPATH') OR exit('No direct script access allowed');?>

  <!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>MLM | Forgot</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="<?=base_url('public')?>/components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?=base_url('public')?>/components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="<?=base_url('public')?>/components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=base_url('public')?>/dist/css/AdminLTE.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/iCheck/square/blue.css">





  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo">

    <a href=""><b>MLM</b></a>

  </div>

  <!-- /.login-logo -->

  <div class="login-box-body">

    <p class="login-box-msg">Forgot Your Password</p>



    <form action="<?=base_url('authlogincheck');?>" method="post" class="UpdateDetails" id="element_overlap">

    

    

      <div class="form-group has-feedback">

        <input type="email" name="email" required class="form-control" placeholder="Email">

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      

      

      <p class="help-block" style="color:red;"><?=$this->session->flashdata('message');?></p>

      <div class="row">

        <div class="col-xs-6">

          <div class="checkbox icheck">

           <!-- <label>

              <input type="checkbox"> Remember Me

            </label>-->

          </div>

        </div>

        

        <!-- /.col -->

        <div class="col-xs-6">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Forget Password</button>

        </div>

        <!-- /.col -->

      </div>

    </form>



    <!--<div class="social-auth-links text-center">

      <p>- OR -</p>

      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using

        Facebook</a>

      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using

        Google+</a>

    </div>-->

    <!-- /.social-auth-links -->



    <a href="<?=base_url();?>">Back to login</a><br>

    <!--<a href="register.html" class="text-center">Register a new membership</a>-->



  </div>

  <!-- /.login-box-body -->

</div>

<!-- /.login-box -->



<!-- jQuery 3 -->

<script src="<?=base_url('public')?>/components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->

<script src="<?=base_url('public')?>/components/bootstrap/dist/js/bootstrap.min.js"></script>

 



<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>

<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>



<script>

$(".UpdateDetails").submit('on',function(e){

					e.preventDefault();

  

 					$("#element_overlap").LoadingOverlay("show");

 

   					$.ajax({

					  dataType : "json",

 					  data : $(".UpdateDetails").serialize(),

 					  headers: { 'Authkey': '<?=$this->security->get_csrf_hash();?>'},

					  url: '<?=base_url('forgot-password');?>',

					  success:function(data)

							{

								$("#element_overlap").LoadingOverlay("hide", true);

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

