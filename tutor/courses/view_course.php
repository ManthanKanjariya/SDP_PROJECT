<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `course_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    #course-logo{
        max-width:100%;
        max-height: 15em;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="container-fluid">
    <!-- <center>
        <img src="<?= validate_image(isset($logo_path) ? $logo_path : '') ?>" alt="" class="img-thumbnail border border-dark bg-gradient-dark" id="course-logo">
    </center> -->
	<dl>
        <dt class="text-muted">Course</dt>
        <dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
        <dt class="text-muted">Description</dt>
        <dd class="pl-4"><?= isset($description) ? str_replace(["\n\r","\n","\r"], "<br/>", $description) : '' ?></dd>
        <dt class="text-muted">Your Experience for this Course</dt>
        <dd class="pl-4"><?= isset($experience) ? $experience : "" ?></dd>
        <dt class="text-muted">Status</dt>
        <dd class="pl-4">
            <?php if($status == 1): ?>
                <span class="badge badge-success px-3 rounded-pill">Active</span>
            <?php else: ?>
                <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix my-3"></div>
    <div class="text-right">
        <button class="btn btn-sm btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>