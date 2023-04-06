<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, CONCAT(lastname,', ',firstname , COALESCE(concat(' ', middlename), '')) as `name` FROM `tutor_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
        if(isset($id)){
            $meta_qry = $conn->query("SELECT * from `tutor_meta` where tutor_id = '{$id}' ");
            while($row = $meta_qry->fetch_assoc()){
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}
?>
<div class="content bg-gradient-primary py-5 px-4">
    <h3 class="font-weight-bolder">Tutor's Profile</h3>
</div>
<div class="row mt-n5 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card card-outline card-primary rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid">
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="description" class="control-label text-muted">Status</label>
                                <div class="pl-4">
                                    <?php if($status == 0): ?>
                                        <span class="badge badge-light bg-gradient-light border px-3 rounded-pill">Waiting For Approval</span>
                                    <?php elseif($status == 1): ?>
                                        <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Verified</span>
                                    <?php elseif($status == 2): ?>
                                        <span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Blocked</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill">Inactive</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <!-- <a class="btn btn-primary btn-flat bg-gradient-primary btn-sm" href="./?page=tutors/manage_tutor&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit Profile</a> -->
                <button id="delete_tutor" class="btn btn-danger btn-flat bg-gradient-danger btn-sm" type="button"><i class="fa fa-trash"></i> Delete</button>
                <button id="update_status" class="btn btn-navy btn-flat bg-gradient-navy btn-sm" type="button"><i class="fa fa-check-square"></i> Update Status</button>
                <a class="btn btn-light btn-flat bg-gradient-light border btn-sm" href="./?page=tutors"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#delete_tutor').click(function(){
			_conf("Are you sure to delete this Tutor permanently?","delete_tutor",['<?= isset($id) ? $id : '' ?>'])
		})
        $('#update_status').click(function(){
			uni_modal("<i class='fa fa-check-square'></i> Update Tutor's Status ","tutors/update_status.php?id=<?= isset($id) ? $id : '' ?>")
		})
        $('#manage-profile-form').submit(function(e){
            e.preventDefault()
            var _this = $(this)
            var el = $('<div>')
                el.addClass('alert alert-danger err_msg')
                el.hide()
            $('.err_msg').remove()
            if(_this[0].checkValidity() == false){
                _this[0].reportValidity();
                return false;
            }
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Users.php?f=registration",
                method:'POST',
                type:'POST',
                data:new FormData($(this)[0]),
                dataType:'json',
                cache:false,
                processData:false,
                contentType: false,
                error:err=>{
                    console.log(err)
                    alert('An error occurred')
                    end_loader()
                },
                success:function(resp){
                    if(resp.status == 'success'){
                    location.reload();
                    }else if(!!resp.msg){
                        el.html(resp.msg)
                        el.show('slow')
                        _this.prepend(el)
                        $('html, body').scrollTop(0)
                    }else{
                        alert('An error occurred')
                        console.log(resp)
                    }
                    end_loader()
                }
            })
        })
    })
    function delete_tutor($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete_tutor",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=tutors");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>