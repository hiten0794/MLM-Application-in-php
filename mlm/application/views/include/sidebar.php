  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <?php
            	$obj=&get_instance();
				$obj->load->model(['UserModel','OuthModel']);
 				$profile_url = $obj->UserModel->PictureUrl();
				$user=$obj->UserModel->GetUserData();
			?>
          <img src="<?=$profile_url;?>" class="img-circle profileImgUrl" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="NameEdt"><?=$user['name'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> 
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <?php $uri=$this->uri->segment(2);?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="<?php if($uri=='dashboard'){echo'active';}?>"><a href="<?=base_url('v3/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
       <?php if($this->session->userdata['Admin']['role'] == 'Admin'){?>
        <li class="treeview <?php if($uri=='product-list'||$uri=='add-product'||$uri=='purchase-product'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-table"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php if($uri=='add-product'){ echo 'active';}?>"><a href="<?=base_url('v3/add-product');?>"><i class="fa fa-plus"></i> Add Product</a></li>
            <li class="<?php if($uri=='product-list'){ echo 'active';}?>"><a href="<?=base_url('v3/product-list');?>"><i class="fa fa-list"></i> Listing</a></li>
            <li class="<?php if($uri=='category-list'){ echo 'active';}?>"><a href="<?=base_url('v3/category-list');?>"><i class="fa fa-list"></i> Category</a></li>
            <li class="<?php if($uri=='purchase-product'){echo'active';}?>"><a href="<?=base_url('v3/purchase-product');?>"><i class="fa fa-product-hunt"></i>Purchase </a></li>
           </ul> 
        </li>
        
        
        <li class="treeview <?php if($uri=='customer-list'||$uri=='member-net-sale-view'){ echo 'active';}?>">
          <a href="#">
            <i class="fa fa-users"></i> <span>Member's</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='customer-list'){ echo 'active';}?>"><a href="<?=base_url('v3/customer-list');?>"><i class="fa fa-list"></i>Network List</a></li>
            
          </ul>
        </li>
        
        
         
         <li class="treeview <?php if($uri=='add-order'||$uri=='order-list'){echo'active';}?>">
          <a href="#">
            <i class="fa fa-reorder"></i> <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($uri=='add-order'){echo'active';}?>"><a href="<?=base_url('v3/add-order');?>"><i class="fa fa-plus"></i> Add</a></li>
            <li class="<?php if($uri=='order-list'){echo'active';}?>"><a href="<?=base_url('v3/order-list');?>"><i class="fa fa-list"></i> List </a></li>
           
          </ul>
        </li>
        
        <?php $invoiceuri=$this->uri->segment(3);?>
        <li class="treeview <?php if($invoiceuri=='generate'||$invoiceuri=='search'||$invoiceuri=='print'){echo'active';}?>">
          <a href="#">
            <i class="fa fa-file-o"></i> <span>Invoice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($invoiceuri=='generate'){echo'active';}?>"><a href="<?=base_url('v3/invoice/generate');?>"><i class="fa fa-plus"></i> Generate Invoice</a></li>
            <li class="<?php if($invoiceuri=='search'){echo'active';}?>"><a href="<?=base_url('v3/invoice/search');?>"><i class="fa fa-search"></i> Search Invoice </a></li>
            <li class="<?php if($invoiceuri=='print'){echo'active';}?>"><a href="<?=base_url('v3/invoice/print');?>"><i class="fa fa-print"></i> Print Invoice</a></li>
            
          </ul>
        </li>
 
        
         <li class="<?php if($invoiceuri=='settings'){echo'active';}?>"><a href="<?=base_url('v3/settings');?>"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
         
          <?php } ?>
          
           <?php if($this->session->userdata['Admin']['role'] == 'Customer'){
			  $id=$obj->OuthModel->Encryptor('encrypt',$this->session->userdata['Admin']['id']);
			   
			  ?>
           	<li class="<?php if($uri=='customer-list'){ echo 'active';}?>">
            <a href="<?=base_url('v3/member-net-sale-view-chart?id='.$id.'#!/country/india');?>">
            <i class="fa fa-users"></i>Network List</a></li>
             <?php } ?>
          
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>