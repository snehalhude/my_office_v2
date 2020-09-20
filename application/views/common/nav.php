<?php 

  $getLoginUser =   $this->Common_model->getData('users',"","id = '".$_SESSION['id']."'");
  $userType     =   $getLoginUser[0]->user_type;
  $uri          =   $this->uri->segment(1);

?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">My Office</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>

        <div class="info">
          <a><?php echo  ucwords($getLoginUser[0]->name) ?></a> &nbsp;&nbsp;&nbsp;<a href="<?= site_url('update-profile') ?>" title="Update Profile"><i class="fa fa-user"> </i></a> &nbsp;&nbsp;&nbsp;<a href="<?= site_url('change-password') ?>" title="Change Password"><i class="fa fa-lock"> </i></a>
        </div> 
      </div>
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?php if($uri == 'dashboard') { ?> active <?php } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
         
         <?php if($userType == 'admin'){ ?>
          <li class="nav-item has-treeview <?php if($uri == 'employee-list' || $uri == 'add-employee'|| $uri == 'view-employee' || $uri == 'edit-employee') { ?> menu-open <?php } ?> ">
            <a href="#" class="nav-link <?php if($uri == 'employee-list' || $uri == 'add-employee'|| $uri == 'view-employee' || $uri == 'edit-employee') { ?> active <?php } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Employee
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('employee-list') ?>" class="nav-link <?php if($uri == 'employee-list') { ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= site_url('add-employee') ?>" class="nav-link <?php if($uri == 'add-employee') { ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
             
            </ul>
          </li>
         <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>