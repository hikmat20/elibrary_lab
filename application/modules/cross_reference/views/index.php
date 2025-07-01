<style>
	.modal {
		overflow: auto !important;
	}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<!-- <button type="button" class="btn btn-primary cross" data-toggle="tooltip" title="Cross Pasal to Proses">Cross Pasal to Proses</button> -->
						<!-- <a href="<?= base_url($this->uri->segment(1) . '/pasal_to_process'); ?>" class="btn btn-primary" title="Cross Pasal to Proses">
							Cross Pasal to Proses
						</a> -->
						<a href="<?= base_url($this->uri->segment(1) . '/process_to_pasal'); ?>" class="btn btn-success" data-toggle="tooltip" title="Cross Proses to Pasal">Cross Proses to Pasal</a>
						<a target="_blank" href="<?= base_url($this->uri->segment(1) . '/print_process_to_pasal/' . $company_id); ?>" class="btn btn-light btn-icon" data-toggle="tooltip" title="Print Cross Pasal to Proses"><i class="fa fa-print"></i></a>
					</div>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover table-sm datatable">
						<thead class="text-center">
							<tr class="text-center">
								<th class="p-2" width="40">No.</th>
								<th class="p-2 text-left">Nama</th>
								<th class="p-2" width="100">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($data) && $data) :
								$n = 0;
								foreach ($data as $dt) : $n++; ?>
									<tr class="text-center">
										<td class="p-2"><?= $n; ?></td>
										<td class="p-2 text-left"><?= $dt->name; ?></td>
										<td class="p-2">
											<button type="button" class="btn btn-xs btn-icon btn-info view" data-id="<?= $dt->id; ?>" data-toggle="tooltip" title="View Data"><i class="fa fa-search"></i></button>
											<a href="<?= base_url($this->uri->segment(1) . '/print_cross_pasal_to_process/' . $dt->id); ?>" class="btn btn-xs btn-icon btn-light print" data-id="<?= $dt->id; ?>" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></a>
											<a href="<?= base_url($this->uri->segment(1) . '/cross_pasal/' . $dt->standard_id); ?>" class="btn btn-xs btn-icon btn-success edit" data-id="<?= $dt->id; ?>" data-toggle="tooltip" title="Edit Cross Reference"><i class="fa fa-random"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<form class="form-horiontal" id="form-input">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
					<span onclick="$('#name').val('')" class="btn-close" data-dismiss="modal" aria-label="Close">
						<div class="fa fa-times"></div>
					</span>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id=""></h5>
				<span class="btn-close" data-dismiss="modal" aria-label="Close">
					<div class="fa fa-times"></div>
				</span>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#example1').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			// ordering: false,
			// info: false
		});

		$(document).on('click', '.view-procedure', function() {
			let id = $(this).data('id')
			$('#modalView').modal('show')
			$('#modalView .modal-dialog').css("max-width", "70%")
			$('#modalView .modal-title').text('View Procedure')
			$.ajax({
				url: siteurl + 'procedures/view/' + id,
				type: 'POST',
				success: function(result) {
					if (result) {
						$('#modalView .modal-body').html(result);
						let download = `<a href="${siteurl+active_controller}download/${id}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-download"></i>Download</a>`
						$('#modalView .modal-body').prepend(download);
					}
				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})

		})

		$(document).on('click', '.view', function() {
			let id = $(this).data('id')
			$.ajax({
				url: siteurl + active_controller + 'view/' + id,
				type: 'GET',
				success: function(result) {
					if (result) {
						$('#modalForm').modal('show')
						$('#modalForm .modal-title').text('View Cross Reference (Pasal to Proses)')
						$('#modalForm .modal-body').html(result);
						$('#modalForm .modal-dialog').css("max-width", "90%")
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}
				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})

		$(document).on('click', '.cross', function() {
			let id = $(this).data('id')
			$('.modal-title').text('View Cross Reference (Pasal to Proses)')
			$('.modal-body').load(siteurl + active_controller + 'cross');
			$('#modalForm').modal('show')
			$('.modal-dialog').attr("style", false)
		})

		$(document).on('click', '.delete', function() {
			let id = $(this).data('id')
			Swal.fire({
				title: 'Are you sure to delete this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Yes, Delete <i class="fa fa-trash"></i>',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete/' + id,
						type: 'GET',
						dataType: 'JSON',
						success: function(result) {
							if (result.status == '1') {
								Swal.fire({
									title: 'Success!!',
									text: result.msg,
									icon: 'success',
									timer: 1500
								}).then(() => {
									location.reload()
								})

							} else {
								Swal.fire('Warning', "Can't delete data. Please try again!", 'warning', 2000)
							}
						},
						error: function() {
							Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 3000)
						}
					})
				}
			})

		})

		$(document).on('submit', '#form-input', function(e) {
			e.preventDefault();
			let btn = $('#save')
			let formdata = new FormData($(this)[0])

			$.ajax({
				url: siteurl + active_controller + 'save',
				data: formdata,
				dataType: 'JSON',
				type: 'POST',
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
					if (result.status == '1') {
						Swal.fire({
							title: 'Success!',
							text: result.msg,
							icon: 'success',
							timer: 2000
						})
						$('#modalForm').modal('hide')
						$('#name').val('')
						location.reload();
					} else {
						Swal.fire({
							title: 'Warning!',
							text: result.msg,
							icon: 'warning',
							timer: 3000
						})
					}
				},
				error: function() {
					Swal.fire({
						title: 'Error!',
						text: 'Server timeout, becuase error. Please try again!',
						icon: 'error',
						timer: 5000
					})
				}
			})
		})
	})

	function load_tinymce(el) {
		tinymce.init({
			selector: el, // change this value according to the HTML
			resize: false,
			autosave_ask_before_unload: false,
			powerpaste_allow_local_images: true,
			plugins: [
				'a11ychecker', 'advcode', 'advlist', 'anchor', 'autolink', 'codesample', 'fullscreen', 'help',
				'image', 'tinydrive', 'lists', 'link', 'media', 'powerpaste', 'preview',
				'searchreplace', 'template', 'tinymcespellchecker', 'visualblocks', 'wordcount'
			],
			templates: [{
					title: 'Non-editable Example',
					description: 'Non-editable example.',
				},
				{
					title: 'Simple Table Example',
					description: 'Simple Table example.',
				}
			],
			toolbar: 'insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
			spellchecker_dialog: true,
			spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
			tinydrive_demo_files_url: '../_images/tiny-drive-demo/demo_files.json',
			tinydrive_token_provider: (success, failure) => {
				success({
					token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo'
				});
			},
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

		});
	}
</script>