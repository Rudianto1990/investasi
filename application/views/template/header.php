
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?= $this->config->item('sitename_mini')?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= $this->config->item('sitename')?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="label label-warning countNotif"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header withData" style="background: #f5f5f5;">Kamu memiliki <span class="countNotif"></span> pemberitahuan</li>
              <li class="noData">
                <div class="text-center" style="padding-top: 40px;padding-bottom: 40px;">
                  <i class="fa fa-bell fa-2x" style="color: #9e9e9e;"></i> 
                  <div>Belum Ada Pemberitahuan...</div>
                </div>
              </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notif">
                  <!-- <li>
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
                  </li> -->
                </ul>
              </li>
              <!-- <li class="footer"><a href="#">View all</a></li> -->
            </ul>
          </li>

          <?php 
            $user = $this->ion_auth->user()->row();
          ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $user->first_name;?>&nbsp;<?= $user->last_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $user->first_name;?>&nbsp;<?= $user->first_name;?>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url();?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $user->first_name;?>&nbsp;<?= $user->last_name;?></p>
          <a href="#"><?= $user->email;?></a>
        </div>
      </div>
      <!-- search form -->
      <form method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
      

<!-- Sidebar Menu -->
 <ul class="sidebar-menu" data-widget="tree">
  <?php ?>
        <li class="<?php echo ($this->uri->segment(1) == "dashboard") ? "active" : "";?>"><a href="<?php echo base_url();?>dashboard"><i class="fa fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                  
                  <li class="treeview <?php echo ($this->uri->segment(1) == "master") ? "active" : "";?>">
                    <a href="#"><i class="fa fa-folder"></i> <span>Master Data</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                    <ul class="treeview-menu">
                      <?php if($user->role == 1 || $user->role == 2):?>
                      <li><a href="<?php echo base_url();?>master/bidang">Master Bidang</a></li>
                      <li><a href="<?php echo base_url();?>master/vendor">Master Vendor</a></li>
                      <?php endif;?>

                      <?php if($user->role == 1 || $user->role == 3):?>
                      <li><a href="<?php echo base_url();?>master/sewa_kategori">Master Sewa Kategori</a></li>
                      <?php endif;?>
                    </ul>
                  </li>

                  <?php if($user->role == 1 || $user->role == 2):?>
                  <li class="<?php echo ($this->uri->segment(1) == "investasi") ? "active" : "";?>"><a href="<?php echo base_url();?>investasi"><i class="fa fa-briefcase"></i> <span>Investasi</span></a></li>

                  <li class="<?php echo ($this->uri->segment(1) == "eksploitasi") ? "active" : "";?>"><a href="<?php echo base_url();?>eksploitasi"><i class="fa fa-suitcase"></i> <span>Eksploitasi</span></a></li>

                  <li class="<?php echo ($this->uri->segment(1) == "adendum") ? "active" : "";?>"><a href="<?php echo base_url();?>adendum"><i class="fa fa-file"></i> <span>Adendum</span></a></li>
                  <?php endif;?>

                  <?php if($user->role == 1 || $user->role == 3):?>
                  <li class="treeview <?php echo ($this->uri->segment(1) == "sewa_properti") ? "active" : "";?>">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Sewa Properti</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url();?>sewa_properti/all">Sewa Properti All</a></li>
                      <li><a href="<?php echo base_url();?>sewa_properti/hutang">Sewa Properti Hutang</a></li>
                      <li><a href="<?php echo base_url();?>sewa_properti/lunas">Sewa Properti Lunas</a></li>
                    </ul>
                  </li>
                  <?php endif;?>

                  <li class="treeview <?php echo ($this->uri->segment(1) == "laporan") ? "active" : "";?>">
                    <a href="#"><i class="fa fa-book"></i> <span>Laporan</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                    </a>
                    <ul class="treeview-menu">
                      <?php if($user->role == 1 || $user->role == 2):?>
                      <li><a href="<?php echo base_url();?>laporan/laporan_investasi">Laporan Investasi</a></li>
                      <li><a href="<?php echo base_url();?>laporan/laporan_eksploitasi">Laporan Eksploitasi</a></li>
                      <?php endif;?>
                      <?php if($user->role == 1 || $user->role ==3):?>
                      <li><a href="<?php echo base_url();?>laporan/laporan_sewa_properti">Laporan Sewa Properti</a></li>
                      <?php endif;?>
                    </ul>
                  </li>

                  <?php if($user->role == 1):?>
                  <li class="treeview <?php echo ($this->uri->segment(1) == "user") ? "active" : "";?>">
                    <a href="#"><i class="fa fa-user-md"></i> <span>Admin</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url();?>user">User Management</a></li>
                      
                    </ul>
                  </li>
                  <?php endif;?>

                </ul>




    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->


      
    

  
