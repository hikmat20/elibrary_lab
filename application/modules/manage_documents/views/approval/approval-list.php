<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="container mt-10">
		<div class="mb-10">
			<h1 style="font-size: 36px;" class="text-white font-weight-bolder"><U>APPROVAL DOCUMENTS</U></h1>
			<p class="text-dark-50"></p>
		</div>
		<div class="card">
			<div class="pt-1 px-3 card-body">
				<table class="table">
					<thead>
						<tr>
							<th width="40px">No</th>
							<th>File Name</th>
							<th width="180px" class="text-center">Created Date</th>
							<th width="150px" class="text-center">Created By</th>
							<th width="150px" class="text-center">Status</th>
							<th width="100px" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 0;
						if ($files) :
							foreach ($files as $list) : $n++; ?>
								<tr class="<?= ($list->flag_type == 'FOLDER') ? 'folder' : 'file'; ?>" data-id="<?= $list->id; ?>">
									<td style="vertical-align: middle;" class="text-center"><?= $n; ?></td>
									<td class="text-dark-75" style="vertical-align: middle;">
										<?= ($list->flag_type == 'FOLDER') ? "<i class='fa fa-folder text-warning mr-2 py-0' style='vertical-align:middle;'></i>" : "<i class='text-success fa fa-file-alt mr-2 fa-2x py-0' style='vertical-align:middle;'></i>"; ?> <span class="h5"><?= $list->name; ?></span>
									</td>
									<td class="text-center" style="vertical-align: middle;"><?= $list->created_at; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1"><?= $list->created_by; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1">
										<?= ($list->flag_type == 'FILE') ? $sts[$list->status] : "" ?>
									</td>
									<td class="text-center">
										<button type="button" data-id="<?= $list->id; ?>" class="btn btn-pirmary btn-icon update btn-warning btn-xs shadow-sm"><i class="fa fa-cog"></i></button>
									</td>
								</tr>
							<?php endforeach;
						else : ?>
							<tr>
								<td colspan="6" style="vertical-align: middle;" class="text-dark-50 py-4 text-center h5">Not available data</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content" style="min-height: 650px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Review File</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body pt-0" data-scroll="true" id="viewReviewData"></div>
			<!-- <div class="modal-footer py-1">
				<button type="button" class="btn btn-light-primary save-upload font-weight-bold">Save</button>
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal" onclick="setTimeout(function(){$('#viewData').html('')},1000)">Close</button>
			</div> -->
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.update', function() {
		const id = $(this).data('id')
		$('#reviewModal').modal('show')
		$('#viewReviewData').load(siteurl + active_controller + 'load_form_approval/' + id)
	})

	$(document).on('click', '#save-approval', function() {
		$('.status').removeClass('is-invalid')
		$('#note').removeClass('is-invalid')

		const id = $('#id').val();
		const status = $('input[name="status"]').is(':checked');
		const note = $('#note').val();
		console.log(id + ", " + status + ", " + note);
		if (status == false) {
			$('.status').addClass('is-invalid')
			return false;
		}
		if ((note == '') || (note == null)) {
			$('#note').addClass('is-invalid')
			return false;
		}

		Swal.fire({
			title: "Are you sure?",
			text: "You will not be able to process again this data!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Process it!",
			cancelButtonText: "No, cancel process!",
		}).then((value) => {
			if (value.isConfirmed) {
				var formData = new FormData($('#form')[0]);
				var baseurl = siteurl + active_controller + 'save_approval';
				$.ajax({
					url: baseurl,
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					dataType: 'json',
					success: function(data) {
						if (data.status == 1) {
							Swal.fire({
								title: "Upload Success!",
								text: data.msg,
								icon: "success",
								timer: 2000,
								showCancelButton: false,
								showConfirmButton: false,
								allowOutsideClick: false
							}).then(function() {
								$('#reviewModal').modal('hide')
								$('#viewReviewData').html('')
								location.reload()
							});
						} else {
							if (data.status == 0) {
								Swal.fire({
									title: "Failed!",
									html: data.msg,
									icon: "warning",
									timer: 5000,
								});
							}
						}
					},
					error: function() {
						Swal.fire({
							title: "Error Message !",
							text: 'An Error Occured During Process. Please try again..',
							icon: "warning",
							timer: 3000,
						});
					}
				});
			}
		});
	});
</script>