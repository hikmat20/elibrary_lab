<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="container mt-10">
		<div class="mb-10">
			<h1 style="font-size: 36px;" class="text-white font-weight-bolder"><u>REVIEW DOCUMENTS</u></h1>
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
										<!-- <div class="dropdown dropdown-inline">
											<button type="button" class="btn btn-light-default btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="ki ki-bold-more-ver"></i>
											</button>
											<div class="dropdown-menu">
												<?php if ($list->flag_type == 'FILE') : ?>
													<a class="dropdown-item <?= ($list->status != 'OPN') ? 'disabled' : ''; ?>" onclick="edit_file('<?= $list->id; ?>','<?= $list->parent_id; ?>')" data-id="<?= $list->id; ?>" href="#"><i class="fa fa-file text-warning mr-2"></i>Edit File</a>
													<a class="dropdown-item <?= ($list->status == 'REV') ? 'disabled' : ''; ?>"" onclick=" review_process('<?= $list->id; ?>','<?= $list->parent_id; ?>')" href="#"><i class="fab fa-telegram text-success mr-2"></i>Process to Review</a>
													<div class="dropdown-divider"></div>
												<?php endif; ?>
												<a class="dropdown-item" onclick="rename('<?= $list->id; ?>')" href="#"><i class="fa fa-edit text-info mr-2"></i>Rename</a>
												<a class="dropdown-item" href="#"><i class="fa fa-arrows-alt text-primary mr-2"></i>Move</a>
												<a class="dropdown-item <?= ($list->status != 'OPN') ? 'disabled' : ''; ?>" onclick="delete_folder('<?= $list->id; ?>','<?= $list->parent_id; ?>')" href="#"><i class="fa fa-trash text-danger mr-2"></i>Delete</a>
											</div>
										</div> -->
										<?= ($list->flag_type == 'FOLDER') ? "<i class='fa fa-folder text-warning mr-2 py-0' style='vertical-align:middle;'></i>" : "<i class='text-success fa fa-file-alt mr-2 fa-2x py-0' style='vertical-align:middle;'></i>"; ?> <span class="h5"><?= $list->name; ?></span>
									</td>
									<td class="text-center" style="vertical-align: middle;"><?= $list->created_at; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1"><?= $list->created_by; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1">
										<?= ($list->flag_type == 'FILE') ? $sts[$list->status] : "" ?>
									</td>
									<td class="text-center">
										<button type="button" data-id="<?= $list->id; ?>" class="btn btn-pirmary btn-icon update-review btn-warning btn-xs shadow-sm"><i class="fa fa-cog"></i></button>
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
	$(document).on('click', '.update-review', function() {
		const id = $(this).data('id')
		$('#reviewModal').modal('show')
		$('#viewReviewData').load(siteurl + active_controller + 'load_form_review/' + id)
	})

	$(document).on('click', '#save-review', function() {
		$('#invalid-action').addClass('d-none')
		$('#note').removeClass('is-invalid')

		const id = $('#id').val();
		const status = $('input[name="status"]').is(':checked');
		const note = $('#note').val();

		if (status == '' || status == null) {
			$('#invalid-action').removeClass('d-none')
			return false;
		}
		if ((note == '' && status == 'COR') || (note == null && status == 'COR')) {
			// Swal.fire({
			// 	title: "Error Message!",
			// 	text: 'Empty User Prepared, please input User Prepared  first.....',
			// 	icon: "warning"
			// });
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
				var formData = new FormData($('#form-review')[0]);
				var baseurl = siteurl + active_controller + 'save_review';
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
							});
							$('#reviewModal').modal('hide')
							$('#viewReviewData').html('')
							location.reload()
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