 <header class="main-header">

    <!-- Logo -->

    <a href="<?=base_url()?>" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>MLM</b></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>MLM</b></span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->

          <li class="dropdown messages-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-envelope-o"></i>

              <span class="label label-success">0</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 0 messages</li>

              <li>

                <!-- inner menu: contains the actual data -->

                <!--<ul class="menu">

                  <li> 

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?=base_url('public')?>/images/user-icon.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        Support Team

                        <small><i class="fa fa-clock-o"></i> 5 mins</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                   

                  <li>

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?=base_url('public')?>/images/user-icon.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        AdminLTE Design Team

                        <small><i class="fa fa-clock-o"></i> 2 hours</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?=base_url('public')?>/images/user-icon.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        Developers

                        <small><i class="fa fa-clock-o"></i> Today</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?=base_url('public')?>/images/user-icon.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        Sales Department

                        <small><i class="fa fa-clock-o"></i> Yesterday</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <div class="pull-left">

                        <img src="<?=base_url('public')?>/images/user-icon.jpg" class="img-circle" alt="User Image">

                      </div>

                      <h4>

                        Reviewers

                        <small><i class="fa fa-clock-o"></i> 2 days</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                </ul>-->

              </li>

              <li class="footer"><a href="#">See All Messages</a></li>

            </ul>

          </li>

          <!-- Notifications: style can be found in dropdown.less -->

          <li class="dropdown notifications-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-bell-o"></i>

              <span class="label label-warning">0</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 0 notifications</li>

              <li>

                <!-- inner menu: contains the actual data -->

                <!--<ul class="menu">

                  <li>

                    <a href="#">

                      <i class="fa fa-users text-aqua"></i> 5 new members joined today

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the

                      page and may cause design problems

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-users text-red"></i> 5 new members joined

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-user text-red"></i> You changed your username

                    </a>

                  </li>

                </ul>-->

              </li>

              <li class="footer"><a href="#">View all</a></li>

            </ul>

          </li>

          <!-- Tasks: style can be found in dropdown.less -->

           

          <!-- User Account: style can be found in dropdown.less -->

          <?php

            	$obj=&get_instance();

				$obj->load->model('UserModel');

 				$profile_url = $obj->UserModel->PictureUrl();

				$user=$obj->UserModel->GetUserData();

			?>

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="<?=$profile_url;?>" class="user-image profileImgUrl" alt="User Image">

              <span class="hidden-xs NameEdt"><?=$user['name'];?></span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

              

                <img src="<?=$profile_url;?>" class="img-circle profileImgUrl" alt="User Image">



                <p>

                  <span class="NameEdt"><?=$user['name'];?></span> - <?=$this->session->userdata['Admin']['role'];?>

                  <small>Member since <?=date('M. Y',strtotime($this->session->userdata['Admin']['created']) );?></small>

                </p>

              </li>

              <!-- Menu Body -->

              <!--<li class="user-body">

                <div class="row">

                  <div class="col-xs-4 text-center">

                    <a href="#">Followers</a>

                  </div>

                  <div class="col-xs-4 text-center">

                    <a href="#">Sales</a>

                  </div>

                  <div class="col-xs-4 text-center">

                    <a href="#">Friends</a>

                  </div>

                </div>

                

              </li>-->

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="pull-left">

                  <a href="<?=base_url('v3/profile');?>" class="btn btn-default btn-flat">Profile</a>

                </div>

                <div class="pull-right">

                  <a href="<?=base_url('admin-logout');?>" class="btn btn-default btn-flat">Sign out</a>

                </div>

              </li>

            </ul>

          </li>

           

        </ul>

      </div>

    </nav>

  </header>