<?php $this->load->view('common/start_header'); ?>
  <!-- /.login-logo -->
  
  <center><?php echo $this->session->flashdata('success_msg'); ?> </center>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <?php if(validation_errors()){ ?>
        <div class="error remove_err">
            <ul>
                <?php if(form_error('email')) { ?>
                    <li><?php echo form_error('email'); ?></li>
                <?php } ?>
               
            </ul>
        </div>
      <?php } ?>
      <?php echo $this->session->flashdata('error_msg'); ?> 
      <span class="valerr error"></span>
      <form action="<?= site_url('Login/forgot_password_action') ?>" method="post">
       
        <div class="input-group mb-3">
          <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <!-- /.col -->
        
           <div class="col-12">
            <button type="button" onclick="return forgot_password_validation()" class="btn btn-primary btn-block">Request new password</button>
            <button type="submit"  class="btn btn-primary btn-block hide saveBtn ">Request new password</button>
          </div>
           
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?= site_url() ?>">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('common/start_footer'); ?>



