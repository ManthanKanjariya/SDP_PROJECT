<?php
require_once('../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT * from `course_list` where id = '{$_GET['id']}' ");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
	}
}
?>
<style>
	#course-logo {
		max-width: 100%;
		max-height: 20em;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="container-fluid">
	<form action="" id="course-form">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="tutor_id" value="<?php echo isset($tutor_id) ? $tutor_id : '' ?>">
		<div class="form-group">
			<label for="name" class="control-label">Name</label>
			<input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea type="text" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="experience" class="control-label">Experience</label>
			<input type="text" name="experience" id="experience" class="form-control form-control-sm rounded-0" value="<?php echo isset($experience) ? $experience : ''; ?>" required />
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
		<!-- <div class="form-group">
			<label for="img" class="control-label">Course Logo</label>
			<div class="custom-file rounded-0">
				<input type="file" class="custom-file-input rounded-0" id="customFile1" name="img" onchange="displayImg(this)" accept="images/png, images.jpeg">
				<label class="custom-file-label rounded-0" for="customFile1">Choose file</label>
			</div>
		</div>
		<div class="form-group">
			<img src="<?= validate_image(isset($logo_path) ? $logo_path : '') ?>" alt="" class="border rounded-0 bg-gradient-dark" id="course-logo">
		</div> -->
	</form>
</div>
<script>
	function displayImg(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#course-logo').attr('src', e.target.result);
				$(input).siblings('.custom-file-label').html(input.files[0].name)
			}
			reader.readAsDataURL(input.files[0]);
		} else {
			$('#course-logo').attr('src', '<?= validate_image(isset($logo_path) ? $logo_path : '') ?>');
			$(input).siblings('.custom-file-label').html(input.files[0].name)
		}
	}
	$(document).ready(function() {
		$('#course-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_course",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err)
					alert_toast("An error occured", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.reload()
					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						$("html, body").animate({
							scrollTop: _this.closest('.card').offset().top
						}, "fast");
						end_loader()
					} else {
						alert_toast("An error occured", 'error');
						end_loader();
						console.log(resp)
					}
				}
			})
		})

	})
</script>