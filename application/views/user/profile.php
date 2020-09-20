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
            <h1>Update Profile</h1> 

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Update Profile</li>
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


                <center><?php if(isset($_SESSION['edit']['errors'])){ ?>

                <div class="alert alert-danger remove_err" role="alert">
                    <?php echo $_SESSION['edit']['errors'] ?>
                </div>
             
                <?php } ?></center>

            <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method = "POST" action= "<?= site_url('Welcome/profile_action') ?>" enctype="multipart/form-data">
             
                <div class="card-body">
                  <div class="form-group ">
                    <label for="name">Name <span class="error">*</span><span id="nameErr" class="error"></span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $name ?>">
                   
                  </div>
                  <div class="form-group ">
                    <label for="price">Email <span class="error">*</span><span id="emailErr" class="error"></span></label>
                    <input type="text" class="form-control" id="email" name=email placeholder="Enter Email" value="<?php echo $email ?>">
                   
				          </div>
				          <div class="form-group ">
                    <label for="quantity">Phone No <span class="error">*</span><span id="phoneErr" class="error"></span></label>
                    <input type="text" class="form-control is_number" id="phone" name="phone" placeholder="Enter Phone No" value="<?php echo $phone ?>" maxlength="10">
               
                  </div>

                

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <input type="hidden" id="button" name="button" value="Update" >
                <input type="hidden" name="id" value="<?= $id ?>" >
				        <button type="button" class="btn btn-sm btn-primary" onclick="return users_validation()">Update</button>
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
