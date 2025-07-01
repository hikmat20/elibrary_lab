<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> text-primary mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary" data-toggle="tooltip" title="Cross Proses to Pasal">Add New Checklist</a>
					</div>
				</div>
				<div class="card-body">
					<table id="dtTable" class="table table-bordered table-sm table-condensed table-hover">
						<thead class="text-center table-light">
							<tr class="text-center">
								<th width="10">No.</th>
								<th class="text-left">Process Name</th>
								<th width="80" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($data) foreach ($data as $k => $v) : $k++; ?>
								<tr>
									<td class="text-center"><?= $k; ?></td>
									<td><?= $v->name; ?></td>
									<td class="text-center">
										<a href="<?= base_url($this->uri->segment(1) . "/edit/" . $v->id); ?>" class="btn btn-xs btn-icon btn-warning" data-toggle="tootltip" title="Edit" data-id="<?= $v->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
										<a href="<?= base_url($this->uri->segment(1) . "/audit/" . $v->id); ?>" class="btn btn-xs btn-icon btn-info" data-toggle="tootltip" title="Audit Temuan" data-id="<?= $v->id; ?>"><i class="fa fa-clipboard-check"></i></a>
										<button type="button" class="btn btn-xs btn-icon btn-danger delete" data-toggle="tootltip" title="Delete" data-id="<?= $v->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalID" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"></h5>
				<span class="btn btn-xs btn-icon " data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times text-dark" aria-hidden="true"></i>
				</span>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-primary save min-w-100px"><i class="fa fa-save"></i>Save</button>
				<button type="button" class="btn btn-danger text-end" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		Datatable()

		$(document).on('click', '#add', function() {
			const url = siteurl + active_controller + 'add';
			$('.modal-title').html('Add Badan Sertifikasi')
			$('#modalID').modal()
			$('#modalID .modal-body').load(url)
		})

		$(document).on('click', '.edit', function() {
			const id = $(this).data('id')
			const url = siteurl + active_controller + 'edit/' + id;
			$('.modal-title').html('Edit Company Audit')
			$('#modalID').modal('show')
			$('.modal-body').load(url)
		})

		$(document).on('click', '.save', function(e) {
			let r = validation()
			if (r > 0) {
				return false
			}

			let formdata = new FormData($('#form')[0])
			let btn = $(this)
			Swal.fire({
				title: 'Confirmation!',
				icon: 'question',
				text: 'Are you sure to save this data?',
				showCancelButton: true,
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'save',
						data: formdata,
						type: 'POST',
						dataType: 'JSON',
						processData: false,
						contentType: false,
						cache: false,
						beforeSend: function() {
							btn.attr('disabled', true).html('<i class="spinner spinner-border-sm mr-2"></i> Loading...')
						},
						complete: function() {
							btn.attr('disabled', false).html('<i class="fa fa-save"></i>Save')
						},
						success: function(result) {
							if (result.status == 1) {
								Swal.fire({
									title: 'Success!',
									icon: 'success',
									text: result.msg,
									timer: 3000
								}).then(function() {
									location.reload();
								})
							} else {
								Swal.fire({
									title: 'Warning!',
									icon: 'warning',
									text: result.msg,
									timer: 3000
								})
							}
						},
						error: function(result) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: 'Server timeout, becuase error!',
								timer: 3000
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

	function validation() {
		let e = 0;
		$('.required').each(function() {
			if ($(this).val() == '' || $(this).val() == null) {
				$(this).addClass('is-invalid')
				e++
			} else {
				$(this).removeClass('is-invalid')
			}
		})
		return e;
	}

	function Datatable() {
		$('#dtTable').DataTable({
			fixedHeader: true,
			processing: true,
			destroy: true
			// ordering: false,
			// scrollX: true,
			// info: false
		});
	}
</script>