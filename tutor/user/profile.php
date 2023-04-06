<?php 
$qry = $conn->query("SELECT *, CONCAT(lastname,', ',firstname , COALESCE(concat(' ', middlename), '')) as `name` FROM `tutor_list` where id = '{$_settings->userdata('id')}'");
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
    <h3 class="font-weight-bolder">Your Profile</h3>
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
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <a class="btn btn-primary btn-flat bg-gradient-primary btn-sm" href="./?page=user/manage_profile"><i class="fa fa-edit"></i> Edit Profile</a>
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
</script>