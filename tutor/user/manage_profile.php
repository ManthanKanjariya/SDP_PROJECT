<?php 
$qry = $conn->query("SELECT * FROM `tutor_list` where id = '{$_settings->userdata('id')}'");
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
?>
<div class="content bg-gradient-primary py-5 px-4">
    <h3 class="font-weight-bolder">Manage Profile</h3>
</div>
<div class="row mt-n5 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card card-outline card-primary rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="manage-profile-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <div class="form-group">
                            <label for="" class="control-label">Name <em>(last name, first name middle name)</em></label>
                            <div class="input-group input-group-sm align-items-end">
                                <input type="text" class="form-control form-control-sm form-control-border rounded-0" id="lastname" name="lastname" value="<?= isset($lastname) ? $lastname : "" ?>" required="required" placeholder="First Name">
                                <span class="mr-1">,</span>
                                <input type="text" class="form-control form-control-sm form-control-border rounded-0" id="firstname" name="firstname" value="<?= isset($firstname) ? $firstname : "" ?>" required="required" placeholder="Last Name">
                                <input type="text" class="form-control form-control-sm form-control-border rounded-0" id="middlename" name="middlename" value="<?= isset($middlename) ? $middlename : "" ?>" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="dob" class="control-label">Birthday</label>
                                    <input type="date" name="dob" id="dob" class="form-control form-control-sm form-control-border" value="<?= isset($dob) ? date("Y-m-d", strtotime($dob)) : "" ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="gender" class="control-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control form-control-sm form-control-border" required="required">
                                        <option <?= isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option <?= isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm form-control-border" value="<?= isset($email) ? $email : "" ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="contact" class="control-label">Contact #</label>
                                    <input type="text" name="contact" id="contact" class="form-control form-control-sm form-control-border" value="<?= isset($contact) ? $contact : "" ?>" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Address</label>
                                    <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" style="resize:none" required="required"><?= isset($address) ? $address : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="specialty" class="control-label">Specialty</label>
                                    <textarea rows="3" name="specialty" id="specialty" class="form-control form-control-sm rounded-0" style="resize:none" required="required"><?= isset($specialty) ? $specialty : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Short Description About Your Self</label>
                                    <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" style="resize:none" required="required"><?= isset($description) ? $description : "" ?></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <button class="btn btn-primary btn-flat btn-sm bg-gradient-primary" form="manage-profile-form"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
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
                    location.replace('./?page=user/profile');
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
</script>