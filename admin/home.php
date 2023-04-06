<h1>Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!</h1>
<hr>
<div class="row">
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-th-list"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Active Courses</span>
        <span class="info-box-number">
          <?php 
            $course = $conn->query("SELECT * FROM course_list where delete_flag = 0 and `status` = 1")->num_rows;
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
        <span class="info-box-number">
          <?php 
            $course = $conn->query("SELECT * FROM course_list where delete_flag = 0 and `status` = 0")->num_rows;
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
      <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-user-tie"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Waiting for Approval Tutors</span>
        <span class="info-box-number">
          <?php 
            $tutor = $conn->query("SELECT * FROM tutor_list where delete_flag = 0 and `status` = 0")->num_rows;
            echo format_num($tutor);
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
      <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-user-tie"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Verified Tutors</span>
        <span class="info-box-number">
          <?php 
            $tutor = $conn->query("SELECT * FROM tutor_list where delete_flag = 0 and `status` = 1")->num_rows;
            echo format_num($tutor);
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
      <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-user-tie"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Inactive Tutors</span>
        <span class="info-box-number">
          <?php 
            $tutor = $conn->query("SELECT * FROM tutor_list where delete_flag = 0 and `status` = 2")->num_rows;
            echo format_num($tutor);
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
      <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-user-tie"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Blocked Tutors</span>
        <span class="info-box-number">
          <?php 
            $tutor = $conn->query("SELECT * FROM tutor_list where delete_flag = 0 and `status` = 3")->num_rows;
            echo format_num($tutor);
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
      <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-info-circle"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Read Inquiries</span>
        <span class="info-box-number">
          <?php 
            $inquiry = $conn->query("SELECT * FROM inquiry_list where `status` = 1")->num_rows;
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
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-info-circle"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Unread Inquiries</span>
        <span class="info-box-number">
          <?php 
            $inquiry = $conn->query("SELECT * FROM inquiry_list where `status` = 0")->num_rows;
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

  
 
