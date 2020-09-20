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
            <h1><?= $title ?> </h1> 

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="<?= $back_url ?>"><?= $back_title ?></a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
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
            <!-- general form elements -->
             <span class="account_error error flash"></span>


            <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                  <div class="form-group ">
                    <label for="name">Employee ID </label>
                    <input type="text" class="form-control" id="emp_id" value="<?php echo $emp_id ?>" readonly>
                   
                  </div>

                  <div class="form-group ">
                    <label for="name">Name <span class="error">*</span><span id="nameErr" class="error"></span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $name ?>">
                   
                  </div>

                  <div class="form-group ">
                    <label for="price">Email<span class="error">*</span><span id="emailErr" class="error"></span></label>
                    <input type="text" class="form-control" id="email" name=email placeholder="Enter Email" value="<?php echo $email ?>">
                   
				          </div>
				          <div class="form-group ">
                    <label for="quantity">Phone No <span class="error">*</span><span id="phoneErr" class="error"></span></label>
                    <input type="text" class="form-control is_number" id="phone" name="phone" placeholder="Enter Phone No" value="<?php echo $phone ?>" maxlength="10">
                    
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <input type="hidden" id="button" name="button" value="<?= $button ?>" >
                <input type="hidden" name="id" id="id" value="<?= $id ?>" >
				        <button type="button" class="btn btn-sm btn-primary" onclick="return submit_employee()"><?= $button ?></button>
				        
				        <a href="<?= $back_url ?>"  class="btn  btn-sm btn-danger">Cancel</a>
                </div>
              <!-- </form> -->
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
