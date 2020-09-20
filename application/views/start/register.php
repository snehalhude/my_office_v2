<?php $this->load->view('common/start_header'); ?>


  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new user</p>
      <div class="error" id="nameErr"></div>
      <div class="error" id="emailErr"></div>
      <div class="error" id="passwordErr"></div>
      <div class="error" id="confirm_passwordErr"></div>
      <?php echo $this->session->flashdata('err_msg'); ?>
      <form action="<?= site_url('Login/register_action') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" id="name" name="name" class="form-control" placeholder="Full name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }   ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; }   ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button"  onclick="return register_validation()" class="btn btn-primary btn-block" >Register</button>
            <button type="submit" class="btn btn-primary btn-block hide saveBtn">Register</button>
            
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <a href="<?= site_url('login') ?>" class="text-center">I am already  a user</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<script>
 
</script>

<?php $this->load->view('common/start_footer'); ?>

