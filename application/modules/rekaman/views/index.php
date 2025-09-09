
<style>
	.btn-opsi {
		display: none;
	}

	tr:hover .btn-opsi {
		display: block;
	}

	tr:hover .text-name {
		color: #0bb783;
	}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<form id="form-procedure" enctype="multipart/form-data">
				<div class="card card-stretch shadow card-custom">
					<div class="card-header justify-content-between d-flex align-items-center">
						<h2 class="m-0"><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>

					<div class="card-body">
						<!-- Nav tabs -->
						

						<!-- Tab panes -->
						<div class="tab-content p-3 rounded-lg border">
							

							<div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
								<button type="button" class="btn btn-primary mb-3" id="add_form"><i class="fa fa-plus"></i> Add Form</button>
								<div id="form-data-content">
									<table class="table datatable table-bordered table-hover">
										<thead>
											<tr class="table-light">
												<th width="50" class="p-2 text-center">No</th>
												<th class="p-2 text-center">Name</th>
												<th width="100" class="p-2 text-">Link Form</th>
												<!-- <th width="100" class="p-2 text-">Jumlah Revisi</th> -->
												<th width="50" class="p-2 text-center">File</th>
												<th width="200" class="p-2 text-center">Update</th>
												<th width="150" class="p-2 text-center">Opis</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($getdForms)) : $n = 0; ?>
												<?php foreach ($getdForms as $form) : $n++; ?>
													<tr>
														<td class="p-2 text-center"><?= $n; ?></td>
														<td class="p-2"><?= $form->name; ?></td>
														<td class="p-2 text-center">
															<a target="_blank" href="<?= $form->link_form; ?>">
																<span class="badge bg-primary text-white"><?= $form->link_form; ?></span>
															</a>
														</td>
														<!-- <td class="p-2 text-center"><?= $form->jmlh_revisi; ?></td> -->
														<td class="p-2 text-center">
															<?php if ($form->file_name) : ?>
																<button type="button" class="btn p-0 btn-sm btn-link text-success btn-icon view-form" data-id="<?= $form->id; ?>"><i class="fas fa-file-pdf text-success"></i></button>
																<a href="<?= base_url("directory/FORMS/$form->company_id/$form->file_name"); ?>" target="_blank" class="btn p-0 btn-sm btn-link text-success btn-icon" data-id="<?= $form->id; ?>"><i class="fas fa-download text-success"></i></a>
															<?php else : ?>
																<i class="fa fa-times text-danger"></i>
															<?php endif; ?>
														</td>
														<td class="p-2 text-center"><?= $form->created_at; ?></td>
														<td class="p-2 text-center">
															<button type="button" class="btn btn-xs btn-icon btn-warning edit-form" data-id="<?= $form->id; ?>"><i class="fa fa-edit"></i></button>
															<button type="button" class="btn btn-xs btn-icon btn-danger delete-form" data-id="<?= $form->id; ?>"><i class="fa fa-trash"></i></button>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>

							
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" onclick="$('#content_modal').html('')" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-flow-detail">
				<div id="content_modal">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRecord" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="max-width:90%" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Upload Record</h5>
				<button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-records">
				 <input type="hidden" value="Master Form" name="description" id="hidden_description">
				<input type="hidden" value="<?php  $this->auth->user_id() ?>" name="prepared_by" id="hidden_prepared_by">
				<input type="hidden" value="<?php  $this->auth->user_id() ?>"  name="reviewer_id" id="hidden_reviewer_id">
				<input type="hidden" value="<?php  $this->auth->user_id() ?>" name="approval_id" id="hidden_approval_id">
				<div id="record-content">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		let id = ''



		$('button[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$.fn.dataTable.tables({
				visible: true,
				api: true
			}).columns.adjust();
		});

		$('.datatable').DataTable()
		$('.select2').select2({
			placeholder: "Choose an options",
			width: "100%",
			allowClear: true
		})

		function handlePromise(promiseList) {
			return promiseList.map(promise =>
				promise.then((res) => ({
					status: 'ok',
					res
				}), (err) => ({
					status: 'not ok',
					err
				}))
			)
		}

		Promise.allSettled = function(promiseList) {
			return Promise.all(handlePromise(promiseList))
		}



		/* FLOW DETAIL */
		$(document).on('submit', '#form-flow-detail', function(e) {
			e.preventDefault();
			let formdata = new FormData($(this)[0])
			let btn = $('.save')

			$.ajax({
				url: siteurl + active_controller + 'saveFlowDetail',
				data: formdata,
				type: 'POST',
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm mr-3"></i> Loading...')
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
						}).then(() => {
							// location.reload()
							$('#modelId').modal('hide')
							$('#flowDetail table tbody').load(siteurl + active_controller + 'loadFlow/' + result.id)
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

		$(document).on('change', ".dropzone", function() {
			readFile(this);
		});

		$('.dropzone-wrapper').on('dragover', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).addClass('dragover');
		});

		$('.dropzone-wrapper').on('dragleave', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).removeClass('dragover');
		});

		$('.remove-preview').on('click', function() {
			var boxZone = $(this).parents('.preview-zone').find('.box-body');
			var previewZone = $(this).parents('.preview-zone');
			var dropzone = $(this).parents('.form-group').find('.dropzone');
			boxZone.empty();
			previewZone.addClass('hidden');
			reset(dropzone);
		});


		/*    FORMS    */
		/* =========== */

		$(document).on('click', '.view-form', function() {
			const id = $(this).data('id')
			if (id) {
				$('.modal-title').html('View Form')
				$('#content_modal').load(siteurl + active_controller + 'view_form/' + id)
				$('#modelId').modal('show')
			} else {
				Swal.fire('Warning!!', 'Not available data to process', 'waring', 2000);
			}
		})

		$(document).on('click', '#add_form', function() {
			console.log('test');
			const id = $('#procedure_id').val() || null;
			$('#modalRecord').modal('show')
			// $('.modal-dialog').css('max-width', '70%')
			$('.modal-title').text('Add Form')
			$('#record-content').load(siteurl + active_controller + 'upload_form/' + id)

		})

		$(document).on('click', '.edit-form', function() {
			const id = $(this).data('id') || null;
			const procedure_id = $('#procedure_id').val() || null;
			$('#modalRecord').modal('show')

			$('.modal-title').text('Edit Form')
			$('#record-content').load(siteurl + active_controller + 'edit_form/' + id)

		})


		/* change form type */
		$(document).on('change', 'input[name="form_type"]:checked', function() {
			const form_type = $(this).val()

			if (form_type == 'upload_file') {
				html = `
					<div class="form-group row mb-0">
						<label class="col-12 col-form-label"><span class="text-danger">*</span> Upload Document :</label>
						<div class="col-12">
							<input type="file" name="forms_image" id="image" class="form-control" placeholder="Upload File">
							<span class="form-text text-muted">File type : PDF</span>
							<span class="form-text text-danger invalid-feedback">Upload Document By harus di isi</span>
						</div>
					</div>`
			} else if (form_type == 'online_form') {
				html = `
					<div class="form-group row">
						<label class="col-12 col-form-label"><span class="text-danger">*</span> Link Google Form</label>
						<div class="col-12">
							<div class="input-group mb-3">
								<span class="input-group-text rounded-right-0"><i class="fa fa-link"></i></span>
								<input type="text" class="form-control" id="link-form" placeholder="Link Form" name="forms[link_form]" value="" autocomplete="off" />
							</div>
							<span class="form-text text-danger invalid-feedback">Link Form harus di isi</span>
						</div>
					</div>`
			}
			$('#type-form').html(html)
		})

		$(document).on('click', '.delete-form', function() {
			const id = $(this).data('id') || null;
			const btn = $(this)
			Swal.fire({
				title: 'Are you sure to delete this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#ee2d41',
				confirmButtonText: 'Yes, Delete <i class="fa fa-trash text-white"></i>',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete_form/' + id,
						type: 'GET',
						dataType: 'JSON',
						success: function(result) {
							if (result.status == '1') {
								Swal.fire({
									title: 'Success!!',
									text: result.msg,
									icon: 'success',
									timer: 1500
								});


								$(btn).parents('tr').remove();
								// $(btn).parents('tr').css('display', 'none').slideUp('slow');
								// setTimeout(function() {
								// }, 800)

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

		/* SAVE */
		$(document).on('click', '#save-form', function() {
			const pro_id = $('#procedure_id').val() || '';
			let formdata = new FormData($('#form-records')[0])
			let btn = $('.save')

			$('#description').removeClass('is-invalid')
			$('#prepared_by').removeClass('is-invalid')
			$('#approval_id').removeClass('is-invalid')
			$('#reviewer_id').removeClass('is-invalid')
			$('#distribute_id').removeClass('is-invalid')
			$('#image').removeClass('is-invalid')
			$('#group_procedure').removeClass('is-invalid')
			$('#status').removeClass('is-invalid')
			$('#name').removeClass('is-invalid')
			$('#scope').removeClass('is-invalid')
			$('#object').removeClass('is-invalid')
			$('#performance').removeClass('is-invalid')
			$('#link-form').removeClass('is-invalid')



			const group_procedure = $('#group_procedure').val()
			
			const description = $('#description').val();
			const prepared_by = $('#prepared_by').val();
			const reviewer_id = $('#reviewer_id').val();
			const approval_id = $('#approval_id').val();
			const distribute_id = $('#distribute_id').val();
			const image = $('#image').val();
			const status = $('#status').val();
			const name = $('#name').val()
			const scope = $('#scope').val()
			const object = $('#object').val()
			const performance = $('#performance').val()
			const link_form = $('#link-form').val()

			if (group_procedure !== undefined && (group_procedure == '' || group_procedure == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Group Procedure, please input Group Procedure  first.....',
					icon: "warning"
				});
				$('#group_procedure').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
			if (status !== undefined && (status == '' || status == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Status, please input Status first.....',
					icon: "warning"
				});
				$('#status').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
			if (name !== undefined && (name == '' || name == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Name Procedure, please input Name Procedure first.....',
					icon: "warning"
				});
				$('#name').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
		
	
			
			if (description !== undefined && (description == '' || description == null)) {
				$('#description').addClass('is-invalid')
				return false;
			}
			if (link_form == '') {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Link form, please input link form first.....',
					icon: "warning"
				});
				$('#link-form').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}

			if (prepared_by !== undefined && (prepared_by == '' || prepared_by == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty User Prepared, please input User Prepared  first.....',
					icon: "warning"
				});
				$('#prepared_by').addClass('is-invalid')

				return false;
			}
			if ((reviewer_id == '' && reviewer_id != undefined) || (reviewer_id == null && reviewer_id != undefined)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty reviewer, please input reviewer first.....',
					icon: "warning"
				});
				$('#reviewer_id').addClass('is-invalid')

				return false;
			}
			if ((approval_id == '' && approval_id != undefined) || (approval_id == null && approval_id != undefined)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty approval, please input approval first!',
					icon: "warning"
				});
				$('#approval_id').addClass('is-invalid')

				return false;
			}

			// if ((distribute_id == '' && distribute_id != undefined) || (distribute_id == null && distribute_id != undefined)) {
			// 	$('#distribute_id').addClass('is-invalid')
			// 	Swal.fire({
			// 		title: "Error Message!",
			// 		text: 'Empty distribusi, please input distribusi first.....',
			// 		icon: "warning"
			// 	});

			// 	return false;
			// }

			if (image !== undefined && (image == '' || image == null)) {
				$('#image').addClass('is-invalid')
				Swal.fire({
					title: "Error Message!",
					text: 'Empty file, please input file first.....',
					icon: "warning"
				});

				return false;
			}

			$.ajax({
				url: siteurl + active_controller + 'saveForm',
				data: formdata,
				type: 'POST',
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm mr-3"></i> Loading...')
				},
				complete: function() {
					btn.attr('disabled', false)
					btn.html('<i class="fa fa-save"></i>Save')
				},
				success: function(result) {
					console.log(result);
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							icon: 'success',
							text: result.msg,
							timer: 2000
						})
						$('.close-btn').click();
						reload_form(pro_id)
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
})

  function reload_form(pro_id) {
	 $('#form-data-content').load(siteurl + active_controller + 'loadDataForm/' + pro_id)
  }
		

</script>