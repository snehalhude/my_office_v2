<?php
 $this->load->view('common/header'); 
 $this->load->view('common/nav'); 
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1> 

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
          
            <!-- general form elements -->

            <center> <?php echo $this->session->flashdata('error_msg'); ?></center>

            <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method = "POST" action= "<?= site_url('Welcome/change_password_action') ?>" enctype="multipart/form-data">
             
                <div class="card-body">
                 
                  <div class="form-group ">
                    <label for="password">Current Password </label> <span class="error">*</span><span id="passwordErr" class="error"></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?= set_value('password') ?>">
                    <small class="error"><?= form_error('password') ?></small>
                   
                  </div>
                  <div class="form-group ">
                    <label for="new_password">New Password</label> <span class="error">*</span><span id="new_passwordErr" class="error"></span>
                    <input type="password" class="form-control" id="new_password" name=new_password placeholder="Enter New Password" value="<?= set_value('new_password') ?>">
                     <small class="error"><?= form_error('new_password') ?></small>
                   
				          </div>
				          <div class="form-group ">
                    <label for="confirm_password">Confirm Password</label> <span class="error">*</span><span id="confirm_passwordErr" class="error"></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="<?= set_value('confirm_password') ?>" >
                     <small class="error"><?= form_error('confirm_password') ?></small>
               
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
				        <button type="button" class="btn btn-sm btn-primary" onclick="return change_password_validation()">Update</button>
				        <button type="submit" class="btn btn-sm btn-primary hide saveBtn" >Update</button>
				        <a href="<?= site_url('dashboard') ?>"  class="btn  btn-sm btn-danger">Cancel</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

          
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script src="<?= base_url() ?>custom/js/users.js"> </script>
  <?php $this->load->view('common/footer') ?>
