<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>
				</div>
				<div class="card-body">
					<form id="form-cross">
						<div class="row mb-3">
							<label for="exampleInputEmail1" class="col-2 col-form-label">Select Standard</label>
							<div class="col-3">
								<select name="standard" id="standard" class="form-control form-control-solid select2" data-dropdown-parent=".card-body">
									<option value=""></option>
									<?php foreach ($data as $dt) : ?>
										<option value="<?= $dt->id; ?>"><?= $dt->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="load_data"></div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<form class="form-horiontal" id="form-input">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
					<span type="button" onclick="$('#name').val('')" class="btn-close" data-dismiss="modal" aria-label="Close">
						<div class="fa fa-times"></div>
					</span>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: "Choose an options",
			width: "100%",
			allowClear: true
		});


		$('#example1').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			ordering: false,
			// info: false
		});

		$(document).on('change', '#standard', function() {
			let id = $(this).val();

			if (id) {
				$.ajax({
					url: siteurl + active_controller + 'select_standard/' + id,
					type: 'GET',
					success: function(result) {
						if (result) {
							$('.load_data').html(result)
						} else {
							Swal.fire('Warning', "Can't show data. Please try again!", 'warning', 2000)
						}
					},
					error: function() {
						Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 3000)
					}
				})
			}
		})

		$(document).on('click', '.view_pasal', function() {
			let id = $(this).data('id')
			$.ajax({
				url: siteurl + active_controller + 'view_pasal/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(result) {
					if (result) {
						let html = `
						<div class="form-group">
							<label class="font-weight-bold"><strong>Pasal</strong></label>
							<div class="">
							` + result.chapter + `
							</div>
						</div>

						<div class="form-group">
							<label class="font-weight-bold"><strong>Desc. Indonesian</strong></label>
							<div class="">
							` + result.desc_indo + `
							</div>
						</div>

						<div class="form-group">
							<label class="font-weight-bold"><strong>Desc. English</strong></label>
							<div class="">
								` + result.desc_eng + `
							</div>
						</div>
						`;
						$('.modal-body').html(html);
						$('#modalForm').modal('show')
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}

				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})


		$(document).on('submit', '#form-cross', function(e) {
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
						location.href = siteurl + active_controller;
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