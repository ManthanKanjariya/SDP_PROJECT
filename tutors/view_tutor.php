<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT *, CONCAT(lastname,', ',firstname , COALESCE(concat(' ', middlename), '')) as `name` FROM `tutor_list` where id = '{$_GET['id']}' and delete_flag = 0 and `status` = 1");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
        if (isset($id)) {
            $meta_qry = $conn->query("SELECT * from `tutor_meta` where tutor_id = '{$id}' ");
            while ($row = $meta_qry->fetch_assoc()) {
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}
?>
<style>
    .course_logo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
    }
</style>
<div class="content bg-gradient-primary py-5 px-4">
    <h3 class="font-weight-bolder">Tutor's Profile</h3>
</div>
<div class="row mt-n5 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card card-outline card-primary rounded-0 shadow">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-light btn-flat bg-gradient-light border btn-sm" href="./?p=tutors"><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <?php if ($_settings->chk_flashdata('inquiry_success')) : ?>
                        <div class="alert alert-success  rounded-0">
                            <div class="d-flex align-items-center">
                                <div class="col-11"><?= $_settings->flashdata('inquiry_success') ?></div>
                                <div class="col-1 text-right">
                                    <a href="javascript:void(0)" class="p-1 text-decoration-none text-reset font-weight-bolder" onclick="$(this).closest('.alert').remove()"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="" class="control-label text-muted">Name</label>
                        <div class="pl-4 font-weight-bolder"><?= isset($name) ? strtoupper($name) : '' ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="dob" class="control-label text-muted">Birthday</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($dob) ? date("F d, Y", strtotime($dob)) : '' ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="gender" class="control-label text-muted">Gender</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($gender) ? strtoupper($gender) : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email" class="control-label text-muted">Email</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($email) ? ($email) : '' ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="contact" class="control-label text-muted">Contact #</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($contact) ? ($contact) : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="address" class="control-label text-muted">Address</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($address) ? str_replace(["\n\r", "\n", "\r"], "<br/>", $address) : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="specialty" class="control-label text-muted">Specialty</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($specialty) ? str_replace(["\n\r", "\n", "\r"], "<br/>", $specialty) : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="description" class="control-label text-muted">Short Description About Your Self</label>
                                <div class="pl-4"><?= isset($description) ? str_replace(["\n\r", "\n", "\r"], "<br/>", $description) : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix my-2"></div>
                    <fieldset>
                        <legend>Courses Offerd</legend>
                        <hr>
                        <div id="course_list" class="list-group">
                            <?php
                            $courses = $conn->query("SELECT * FROM `course_list` where tutor_id = '{$id}' and delete_flag = 0 and `status` = 1 order by `name` asc ");
                            while ($row = $courses->fetch_assoc()) :
                            ?>
                                <div class="list-group-item list-group-action border-top m-3 p-0">
                                    <div class="row mx-0">
                                        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 p-0">
                                            <img src="img\profile.jpg" class="course_logo border" alt="logo">
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 p-0">
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-5 border align-middle">Course</div>
                                                <div class="col-lg-9 col-md-8 col-sm-7 border align-middle"><?= $row['name'] ?></div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-5 border align-middle">Experience</div>
                                                <div class="col-lg-9 col-md-8 col-sm-7 border align-middle"><?= $row['experience'] ?></div>
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-3 col-md-4 col-sm-5 border align-middle">Description</div>
                                                <div class="col-lg-9 col-md-8 col-sm-7 border align-middle"><?= str_replace(['\n\r', '\n', '\r'], '', $row['description']) ?></div>
                                            </div>
                                            <div class="my-3 text-center">
                                                <button class="btn btn-sm rounded-pill px-3 btn-primary bg-gradient-primary inquire" type="button" data-id="<?= $row['id'] ?>" data-name="<?= addslashes($row['name']) ?>"><i class="fa fa-info-circle"></i> Send Inquiry</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.inquire').click(function() {
            var id = $(this).attr('data-id')
            var name = $(this).attr('data-name')
            uni_modal('<i class="fa fa-info-circle"></i> Send Inquiry for <b>' + name + ' Course</b> of <b><?= isset($name) ? $name : '' ?></b>', 'tutors/inquire.php?tutor_id=<?= isset($id) ? $id : '' ?>&course_id=' + id, 'modal-lg')
        })
    })
</script>