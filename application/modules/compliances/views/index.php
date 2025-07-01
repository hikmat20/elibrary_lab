<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<!-- <button type="button" class="btn btn-primary" id="add" title="Add New Scope">
							<i class="fa fa-plus mr-1"></i>Add New Scope
						</button> -->
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content mt-3">
						<div class="tab-pane fade active show" id="Published" role="tabpanel" aria-labelledby="Published-tab">
							<table id="example1" class="table table-bordered table-sm table-hover display">
								<thead class="text-center table-light">
									<tr class="text-center">
										<th width="30">No.</th>
										<th width="200" class="text-left">Company Name</th>
										<th class="text-left">Branch</th>
										<th width="100">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($list) && $list) :
										$n = 0;
										foreach ($list as $dt) : $n++; ?>
											<tr class="">
												<td><?= $n; ?></td>
												<td class="text-left"><?= $dt->nm_perusahaan; ?></td>
												<td class="text-left"><?= ($dt->branch_name) ?: 'Main Company'; ?></td>
												<td class="text-center">
													<a href="<?= base_url($this->uri->segment(1) . "?b=" . $dt->id); ?>" class="btn btn-sm btn-icon btn-warning detail" data-id="<?= $dt->id; ?>" title="Edit Data"><i class="fa fa-arrow-circle-right"></i></a>
												</td>
											</tr>
									<?php endforeach;
									endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalView" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">View Standard</h5>
				<span class="close btn-cls" data-dismiss="modal" aria-label="Close"></span>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-primary save w-100px"><i class="fa fa-save"></i>Save</button>
				<button type="button" class="btn btn-danger text-end" onclick="clear($('.modal-body'));setTimeout(()=>{$('.save').removeClass('d-none')},500)" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('button[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$.fn.dataTable.tables({
				visible: true,
				api: true
			}).columns.adjust();
		});

		$('#example1').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			ordering: false,
			// info: false
		});

		$(document).on('click', '#add', function() {
			const url = siteurl + active_controller + 'add';
			$('.modal-title').html('Add New Scope')
			$('#modalView').modal('show')
			$('.modal-body').load(url)
		})

		$(document).on('click', '.edit', function() {
			const id = $(this).data('id')
			const url = siteurl + active_controller + 'edit/' + id;
			$('.modal-title').html('Edit Scope')
			$('#modalView').modal('show')
			$('.modal-body').load(url)
		})


		$(document).on('click', '.save', function(e) {
			const name = $('#name')
			validation(name)

			let formdata = new FormData($('#form')[0])
			let btn = $(this)
			$.ajax({
				url: siteurl + active_controller + 'save',
				data: formdata,
				type: 'POST',
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm"></i>Loading...')
				},
				complete: function() {
					btn.attr('disabled', false)
					btn.html('<i class="fa fa-save"></i>Save')
				},
				success: function(result) {
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							icon: 'success',
							text: result.msg,
							timer: 2000
						}).then(function() {
							$('#modalView').modal('hide')
							clear($('.modal-body'))
							// $('table#example1 tbody').load(siteurl + active_controller + 'load_data')
							location.reload();
						})

					} else {
						Swal.fire({
							title: 'Warning!',
							icon: 'warning',
							text: result.msg,
							timer: 2000
						})
					}
				},
				error: function(result) {
					Swal.fire({
						title: 'Error!',
						icon: 'error',
						text: 'Server timeout, becuase error!',
						timer: 4000
					})
				}
			})
		})

		$(document).on('click', '.choose-user', function(e) {
			const user_id = $(this).data('id')
			const position = $(this).data('position')
			let btn = $(this)
			Swal.fire({
				title: 'Select User!',
				icon: 'question',
				text: 'Are you sure you want to select this user??',
				showCancelButton: true,
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'save_assign',
						data: {
							user_id,
							position
						},
						type: 'POST',
						dataType: 'JSON',
						beforeSend: function() {
							btn.attr('disabled', true).removeClass('btn-icon')
							btn.html('<i class="spinner spinner-border-sm"></i> Loading..')
						},
						complete: function() {
							btn.attr('disabled', false).addClass('btn-icon')
							btn.html('<i class="fa fa-check"></i>')
						},
						success: function(result) {
							if (result.status == 1) {
								Swal.fire({
									title: 'Success!',
									icon: 'success',
									text: result.msg,
									timer: 2000
								}).then(function() {
									$('#modalView').modal('hide')
									clear($('.modal-body'))
									// $('table#example1 tbody').load(siteurl + active_controller + 'load_data')
									location.reload();
								})

							} else {
								Swal.fire({
									title: 'Warning!',
									icon: 'warning',
									text: result.msg,
									timer: 2000
								})
							}
						},
						error: function(result) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: 'Server timeout, becuase error!',
								timer: 4000
							})
						}
					})
				}
			})
		})

		$(document).on('click', '.remove-user', function(e) {
			const user_id = $(this).data('id')
			const position = $(this).data('position')
			let btn = $(this)
			Swal.fire({
				title: 'Select User!',
				icon: 'question',
				text: 'Are you sure you want to remove this user??',
				showCancelButton: true,
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'remove_assign',
						data: {
							user_id,
							position
						},
						type: 'POST',
						dataType: 'JSON',
						beforeSend: function() {
							btn.attr('disabled', true).removeClass('btn-icon')
							btn.html('<i class="spinner spinner-border-sm"></i> Loading..')
						},
						complete: function() {
							btn.attr('disabled', false).addClass('btn-icon')
							btn.html('<i class="fa fa-check"></i>')
						},
						success: function(result) {
							if (result.status == 1) {
								Swal.fire({
									title: 'Success!',
									icon: 'success',
									text: result.msg,
									timer: 2000
								}).then(function() {
									$('#modalView').modal('hide')
									clear($('.modal-body'))
									// $('table#example1 tbody').load(siteurl + active_controller + 'load_data')
									location.reload();
								})

							} else {
								Swal.fire({
									title: 'Warning!',
									icon: 'warning',
									text: result.msg,
									timer: 2000
								})
							}
						},
						error: function(result) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: 'Server timeout, becuase error!',
								timer: 4000
							})
						}
					})
				}
			})
		})

		$(document).on('click', '.delete', function(e) {
			const id = $(this).data('id')
			const btn = $(this)
			Swal.fire({
				title: 'Delete!',
				icon: 'question',
				text: 'Are you sure to delete this data?',
				showCancelButton: true,
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete',
						data: {
							id
						},
						type: 'POST',
						dataType: 'JSON',
						success: function(result) {
							if (result.status == 1) {
								Swal.fire({
									title: 'Success!',
									icon: 'success',
									text: result.msg,
									timer: 2000
								}).then(function() {
									$('#modalView').modal('hide')
									clear($('.modal-body'))
									// $('table#example1 tbody').load(siteurl + active_controller + 'load_data')
									location.reload();
								})

							} else {
								Swal.fire({
									title: 'Warning!',
									icon: 'warning',
									text: result.msg,
									timer: 2000
								})
							}
						},
						error: function(result) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: 'Server timeout, becuase error!',
								timer: 4000
							})
						}
					})
				}
			})
		})
	})

	function validation(field) {
		if (field.val() == '' || field.val() == null) {
			field.addClass('is-invalid')
		} else {
			field.removeClass('is-invalid')
		}
	}

	function clear(e) {
		setTimeout(() => {
			$(e).html('');
		}, 500)
	}
</script>