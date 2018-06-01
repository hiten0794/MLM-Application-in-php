<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('include/header');?>

	<link rel="stylesheet" href="<?=base_url('public/hic');?>/hierarchy-view.css">
    <link rel="stylesheet" href="<?=base_url('public/hic');?>/main.css">
    <style>
		img{ width:45px; height:50px !important;}
		.bl{color:#900;}
		.bc{color:#060;}
	</style>
 
</head><body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper"> 
<?php $this->load->view('include/topbar');?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('include/sidebar');?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Net Sale Growth Report <small>Control panel</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">
        <?=$this->uri->segment(2).'/'.$this->uri->segment(3);?>
      </li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <div class="row"> 
    <!-- left column -->
    <div class="col-md-12"> 
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
           
           
             
          <section class="management-hierarchy hiten">
          
          
          <div class="col-lg-3 col-xs-6" style="position: absolute; top: 0; margin-top: 10px;">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  
    
                  <p>Grand Total Net Sale Volume</p>
                   <h4><i class="fa fa-fw fa-inr"></i> <?=number_format($GrandtotalNetSaleVolume);?></h4>
                   <p>Team Network : <?=$teamNetwork;?></p>
                  <!-- <p>Monthly Bonus % : </p>-->
                   
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
               <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div>
        
        
        
         <?php
            	$obj=&get_instance();
				$obj->load->model('MemberModel');
 				$bonusLevel = $obj->MemberModel->MemberIncomePercent($total_net_sale_v);
				 
			?>
       
        <div class="hv-container">
            <div class="hv-wrapper">

                <!-- Key component -->
                <div class="hv-item">

                    <div class="hv-item-parent">
                        <div class="person">
                            <img src="<?=base_url('public/images/rank/1.png');?>" alt="">
                            <p class="name"> <?=$member['name'];?><b>/ <?=$member['id'];?></b>
                            <br>Bonus Level: <span class="bl"><?=$bonusLevel['BL'];?>% </span>&nbsp;&nbsp;
                            	Bonus : <span class="bc"><?=$bonusLevel['BI'];?></span>&nbsp;&nbsp;
                                <!--Points : <span class="bc"><?=$total_net_sale_v/80;?></span>-->
                                
                            <br>Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($NetSaleVolume1);?>
                            <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($total_net_sale_v);?>
                            </p>
                        </div>
                    </div>

                    <div class="hv-item-children">
                         
                    <?php foreach($memberlist as $level_one){  ?>    
						
                        <div class="hv-item-child">
                            <!-- Key component -->
                            <div class="hv-item">

                                <div class="hv-item-parent">
                                    <div class="person">
                                        <img src="<?=base_url('public/images/rank/2.png');?>" alt="">
                                        <p class="name"><?=$level_one['member_name']?>
                                        	<b>/ <?=$level_one['member_id'];?> &nbsp;&nbsp;</b> 
                                            <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($level_one['sale2']);?>
                                            <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($level_one['total_net_sale_v2']);?>
                                        </p>
                                    </div>
                                </div>

                                <div class="hv-item-children">
                                 <?php foreach($level_one['L_3'] as $three){  ?>  
                                     <div class="hv-item-child">
                                        <div class="person">
                                            <img src="<?=base_url('public/images/rank/3.png');?>" alt="">
                                            <p class="name">
                                               <?=$three['member_name']?>
                                        		<b>/ <?=$three['member_id'];?></b>
                                                <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($three['NetSaleVol3']);?> 
                                                <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($three['total_net_sale_v3']);?>
                                            </p>
                                        </div>
                                       
                                       <!--Level 4 -->
                                        	<div class="hv-item-child">
                                                <!-- Key component -->
                                                <div class="hv-item">
                                                     <div class="hv-item-parent">
                                                     </div>
                                                     <div class="hv-item-children">
                                                     <?php foreach($three['L_4'] as $four){  ?>  
                                                         <div class="hv-item-child">
                                                            <div class="person">
                                                                <img src="<?=base_url('public/images/rank/4.png');?>" alt="">
                                                                <p class="name">
                                                                    <?=$four['member_name']?>
                                        							<b>/ <?=$four['member_id'];?> </b>
                                                                    <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($four['NetSaleVol4']);?> 
                                                                    <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($four['total_net_sale_v4']);?>
                                                                </p>
                                                                
                                                            </div>
                                                            <div class="hv-item-child">
                                                <!-- Key component -->
                                                <div class="hv-item">
                                                     <div class="hv-item-parent">
                                                     </div>
                                                     <div class="hv-item-children">
                                                     <?php foreach($four['L_5'] as $five){  ?>  
                                                         <div class="hv-item-child">
                                                            <div class="person">
                                                                <img src="<?=base_url('public/images/rank/5.png');?>" alt="">
                                                                <p class="name">
                                                                  <?=$five['member_name']?>
                                        							<b>/ <?=$five['member_id'];?></b>
                                                                    <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($five['NetSaleVol5']);?> 
                                                                    <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($five['total_net_sale_v5']);?>
                                                                </p>
                                                             </div>
                                                            
                                                                <div class="hv-item-child">
                                                                    <!-- Key component -->
                                                                    <div class="hv-item">
                                                                         <div class="hv-item-parent">
                                                                         </div>
                                                                         <div class="hv-item-children">
                                                                        <?php foreach($five['L_6'] as $six){  ?>
                                                                             <div class="hv-item-child">
                                                                                <div class="person">
                                                                                    <img src="<?=base_url('public/images/rank/4.png');?>" alt="">
                                                                                    <p class="name">
                                                                                       <?=$six['member_name']?>
                                        												<b>/ <?=$six['member_id'];?></b>
                                                                                        <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($six['NetSaleVol6']);?>
                                                                                         <br>Total Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($six['total_net_sale_v6']);?>
                                                                                                                               </p>
                                                                                    
                                                                                </div>
                                                                                
                                                                                	<div class="hv-item-child">
                                                                                        <!-- Key component -->
                                                                                        <div class="hv-item">
                                                                                             <div class="hv-item-parent">
                                                                                             </div>
                                                                                             <div class="hv-item-children">
                                                                                            <?php foreach($six['L_7'] as $seven){  ?>
                                                                                                 <div class="hv-item-child">
                                                                                                    <div class="person">
                                                                                                        <img src="<?=base_url('public/images/rank/5.png');?>" alt="">
                                                                                                        <p class="name">
                                                                                                          <?=$seven['member_name']?>
                                        																	<b>/ <?=number_format($seven['member_id']);?></b>
                                                                                                            <br> Net Sale Vol. <i class="fa fa-fw fa-inr"></i><?=number_format($seven['NetSaleVol7']);?>
                                                                                                            
                                                                                                        </p>
                                                                                                        
                                                                                                    </div>
                                                                                                 </div>
                                                                                                 
                                                                                            <?php }//end of level_seven?>      
                                                                                              </div>
                                                                                         </div>
                                                                                    </div>
                                                                             </div>
                                                                          <?php }//end of level_six?> 
                                                                          </div>
                                                                     </div>
                                                                </div>
                                                        </div>
                                                      				
                                                       <?php }//end of level_five?>   
                                                      
                                                     </div>
                    
                                                </div>
                                            </div>
                                                            
                                                        </div>
                                                      				
                                                       <?php }//end of level_four?>   
                                                      
                                                     </div>
                    
                                                </div>
                                            </div>
                                         <!--Level 4 -->     
                                    </div>
                                    
                                    
 								 <?php }//end of level_three?>
                                 
                                    
                                  </div>
                                   
     									
                                         

                            </div>
                        </div>                        
                       
                     
                     <?php }//end of level_one?>
 
                    </div>

                </div>

            </div>
        </div>
    </section>
          
          
        </div>
      </div>
    </div>
  </div>
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
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"> Please wait..... </div>
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
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"> Please wait..... loading doucment </div>
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

</body>
</html>