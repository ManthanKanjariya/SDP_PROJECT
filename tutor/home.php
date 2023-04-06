<h1>Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!</h1>
<hr>
<div class="row">
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Active Courses</span>
        <span class="info-box-number text-right">
          <?php 
            $course = $conn->query("SELECT * FROM course_list where delete_flag = 0 and `status` = 1 and tutor_id='{$_settings->userdata('id')}'")->num_rows;
            echo format_num($course);
          ?>
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Inactive Courses</span>
        <span class="info-box-number text-right">
          <?php 
            $course = $conn->query("SELECT * FROM course_list where delete_flag = 0 and `status` = 0 and tutor_id='{$_settings->userdata('id')}'")->num_rows;
            echo format_num($course);
          ?>
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-info-circle"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Inquiries</span>
        <span class="info-box-number text-right">
          <?php 
            $inquiry = $conn->query("SELECT * FROM inquiry_list where tutor_id='{$_settings->userdata('id')}'")->num_rows;
            echo format_num($inquiry);
          ?>
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>

