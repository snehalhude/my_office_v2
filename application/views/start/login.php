<?php $this->load->view('common/start_header'); ?>
  <!-- /.login-logo -->
  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg "  >Sign in to start your session</p>
    
      <span class="account_error error"></span>
      <span class="remove_err">
            <?php echo $this->session->flashdata('success_msg'); ?>
            <?php echo $this->session->flashdata('error_msg'); ?>
      </span>
      <div class="error" id="emailErr"></div>
      <div class="error" id="passwordErr"></div>
       
        <div class="input-group mb-3">
          <input type="text" name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <p class="error" id="emailErr"></p>
        <div class="clearfix"></div>
        <div class="input-group mb-3">
          <input type="password" id="password"  name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
           
          </div>
           <div class="col-4">
            <button type="button" onclick="return login_action()" class="btn btn-primary btn-block">Sign In</button>
           
          </div>
           <div class="col-4">
           
          </div>
          <!-- /.col -->
        </div>
   

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?= site_url('forgot-password') ?>">I forgot my password</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php $this->load->view('common/start_footer'); ?>



