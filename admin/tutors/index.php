<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .tutor-avatar{
        width:3rem;
        height:3rem;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Tutors</h3>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<!-- <col width="15%"> -->
					<col width="25%">
					<col width="15%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Updated</th>
						<!-- <th>Avatar</th> -->
						<th>Name</th>
						<th>Email</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *, concat(firstname,' ', coalesce(concat(middlename,' '), '') , lastname) as `name` from `tutor_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_updated'])) ?></td>
							<!-- <td class="text-center">
                                <img src="<?= validate_image($row['avatar']) ?>" alt="" class="img-thumbnail rounded-circle tutor-avatar">
                            </td> -->
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 0): ?>
                                    <span class="badge badge-light bg-gradient-light border px-3 rounded-pill">Waiting For Approval</span>
                                <?php elseif($row['status'] == 1): ?>
                                    <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Verified</span>
                                <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Blocked</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="./?page=tutors/view_tutor&id=<?= $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <!-- <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="./?page=tutors/manage_tutor&id=<?= $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a> -->
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div>
									<a title="print screen" alt="print screen" onclick="window.print();"target="_black" style="cursor:pointer">Print PDF</a>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this tutor permanently?","delete_tutor",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
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
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>