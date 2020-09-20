<?php
 $this->load->view('common/header'); 
 $this->load->view('common/nav'); 
 ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--  <center><?php echo $this->session->flashdata('success_msg'); ?> </center> -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?> </h1>
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
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
          <div class="col-12">
           
            <!-- /.card -->
           
            <div class="card">
              <div class="card-header">
      				<a href="<?= $add_url ?>" class="btn btn-sm btn-primary"><?= $add_btn ?></a>

              <a href="<?= $export_url ?>" class="btn btn-sm btn-warning right_float"><?= $export_btn ?></a> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Sr No</th>
                      <th>Employee ID</th>
                      <th>Name</th>
  				  	        <th>Email</th>
                      <th>Phone No</th>
                      <th>Status</th>
					            <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sr =1;   
                    foreach ($getEmployees as $row) {
                   /* print_r($row);*/
                      ?>
                    <tr>
                      <td><?= $sr ?></td>
                      <td><?= $row->emp_id ?></td>
                      <td><?= ucfirst($row->name) ?></td>
                      <td><?= $row->email ?></td>
                      <td><?= $row->phone ?></td>
                      <?php if($row->status == 0){ ?>
                      <td  id="status<?= $row->id ?>"><button class="btn btn-xs btn-danger" onclick="return change_status(<?= $row->id ?>,<?= $row->status ?>)">Inactive</button></td>
                      <?php } else { ?>
                      <td  id="status<?= $row->id ?>"><button class="btn btn-xs btn-success" onclick="return change_status(<?= $row->id ?>,<?= $row->status ?>)">Active</button></td>
                      <?php } ?>
                      <td >
                        <a href="<?= site_url('view-employee/'.$row->id) ?>" class="btn btn-info btn-xs" title="View"><i class="fa fa-eye"></i></a>  | 
                        <a href="<?= site_url('edit-employee/'.$row->id) ?>" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>  
                       
                      </td>
                      
                    </tr>

                     <?php $sr++; } ?>

                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--   <script type="text/javascript">
    function change_status() {
      alert("hii");
    }
  </script> -->
  <script src="<?= base_url() ?>custom/js/employee.js"> </script>
  <?php $this->load->view('common/footer') ?>

  