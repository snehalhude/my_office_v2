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
            <h1>Add Employee</h1> 

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="<?= site_url('employee-list') ?>">Employee List</a></li>
              <li class="breadcrumb-item active">Add Employee</li>
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
            <?php if(isset($_SESSION['error'])) { ?> <span class="error"><?= $_SESSION['error'] ?></span><?php } ?>

            <span class="account_error error flash"></span>
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
             <!--  <form role="form" method = "POST" action= "<?= site_url('Employee/add_action') ?>" enctype="multipart/form-data"> -->
             
                <div class="card-body">
                 
                  <div class="form-group ">
                    <label for="name">Name <span class="error">*</span><span id="nameErr" class="error"></span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo set_value('name') ?>">
                    <div class="flash error"><small><?= form_error('name') ?></small></div>
                  </div>
                  <div class="form-group ">
                    <label for="price">Email<span class="error">*</span><span id="emailErr" class="error"></span></label>
                    <input type="text" class="form-control" id="email" name=email placeholder="Enter Email" value="<?php echo set_value('email') ?>">
                    <div class="flash error"><small><?= form_error('email') ?></small></div>
				          </div>
				          <div class="form-group ">
                    <label for="quantity">Phone No <span class="error">*</span><span id="phoneErr" class="error"></span></label>
                    <input type="text" class="form-control is_number" id="phone" name="phone" placeholder="Enter Phone No" value="<?php  echo set_value('phone') ?>" maxlength="10">
                    <div class="flash error"><small><?= form_error('phone') ?></small></div>
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <input type="hidden" id="button" name="button" value="Add" >
                <input type="hidden" name="id"  id="id" value="<?= set_value('id') ?>" >
				        <button type="button" class="btn btn-sm btn-primary" onclick="return submit_employee()">Add</button>
				        <a href="<?= site_url('employee-list') ?>"  class="btn  btn-sm btn-danger">Cancel</a>
                </div>
             <!--  </form> -->
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
 
<script src="<?= base_url() ?>custom/js/employee.js"> </script>
  <?php $this->load->view('common/footer') ?>
