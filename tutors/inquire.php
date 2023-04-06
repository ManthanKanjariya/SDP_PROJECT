<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <form action="" id="inquiry-form">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="tutor_id" value="<?= isset($_GET['tutor_id']) ? $_GET['tutor_id'] : '' ?>">
        <input type="hidden" name="course_id" value="<?= isset($_GET['course_id']) ? $_GET['course_id'] : '' ?>">
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="fullname" class="control-label">Fullname</label>
                <input type="text" class="form-control form-control-sm rounded-0" name="fullname" id="fullname" required="required">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="email" class="control-label">Email</label>
                <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" >
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="contact" class="control-label">Contact #</label>
                <input type="text" class="form-control form-control-sm rounded-0" name="contact" id="contact" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="message" class="control-label">Message</label>
                <textarea name="message" id="message" class="form-control form-control-sm rounded-0" rows="5" placeholder="Write your Inquiry here."></textarea>
            </div>
        </div>
    </form>
</div>
<div class="mx-n3 pt-3 py-1 px-3 text-end border-top">
    <button class="btn btn-primary btn-sm btn-flat bg-gradient-primary" type="submit" form="inquiry-form"><i class="fa fa-paper-plane"></i> Send Inquiry</button>
    <button class="btn btn-light btn-sm btn-flat bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>
<script>
    $(function(){
		$('#inquiry-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_inquiry",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.replace('./?p=tutors/view_tutor&id=<?= isset($_GET['tutor_id']) ? $_GET['tutor_id'] : '' ?>')
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0);
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

    })
</script>