<?php $this->load->view('common/start_header'); ?>
  <!-- /.login-logo -->
  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
     <?php if(validation_errors()){ ?>
        <div class="error remove_err">
            <ul>
                <?php if(form_error('password')) { ?>
                    <li><?php echo form_error('password'); ?></li>
                <?php } ?> 

                <?php if(form_error('confirm_password')) { ?>
                    <li><?php echo form_error('confirm_password'); ?></li>
                <?php } ?>
               
            </ul>
        </div>
      <?php } ?>
      <?php echo $this->session->flashdata('error_msg'); ?> 
      <span class="valerr error"></span>
      <form action="<?= site_url('Login/reset_password_action/'.$token) ?>" method="post">
       
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

         <div class="input-group mb-3">
          <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <!-- /.col -->
        
           <div class="col-12">
          
            <button type="button" onclick="return validations_reset_password()" class="btn btn-primary btn-block">Submit</button>
            <button type="submit"  class="btn btn-primary btn-block hide  saveBtn ">Submit</button>
          </div>
           
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('common/start_footer'); ?>



