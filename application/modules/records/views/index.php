<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right "></div>
				</div>
				<div class="card-body">
					<table id="example2" class="table datatable table-bordered table-sm table-hover datatable">
						<thead class="text-center table-light">
							<tr class="text-center">
								<th class="p-2" width="40">No.</th>
								<th class="p-2 text-left">Nama</th>
								<th class="p-2" width="130">Status</th>
								<th class="p-2" width="60">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($dataProcedure) && $dataProcedure) :
								$n = 0;
								foreach ($dataProcedure as $dt) : $n++; ?>
									<tr class="text-center">
										<td class="p-2"><?= $n; ?></td>
										<td class="p-2 text-left">
											<h6 class="my-0"><?= $dt->name; ?></h6>
										</td>
										<td class="p-2"><?= $status[$dt->status]; ?></td>
										<td class="p-2">
											<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dt->id); ?>" class="btn btn-warning btn-icon btn-xs" data-id="<?= $dt->id; ?>" data-toggle="tooltip" title="Edit Records"><i class="fa fa-edit"></i></a>
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

<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<form class="form-horiontal" id="form-input">
				<div class="modal-header">
					<h6 class="modal-title" id="staticBackdropLabel">Modal title</h6>
					<span type="button" onclick="$('#name').val('')" class="btn-close" data-dismiss="modal" aria-label="Close">
						<div class="fa fa-times"></div>
					</span>
				</div>
				<div class="modal-body overflow-auto">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i>Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#name').val('')"><i class="fa fa-times"></i>Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalView" data-keyboard="false" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content" data-scroll="true" data-height="700">
			<form class="form-horiontal" id="form-input">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-view">View Procedure</h6>
					<span type="button" onclick="$('#name').val('')" class="btn-close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</span>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#name').val('')"><i class="fa fa-times"></i>Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modelId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width:90%">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Modal title</h6>
				<button type="button" class="close" onclick="$('#content_modal').html('')" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="content_modal">
			</div>
		</div>
	</div>
</div>

<div class="modal fade px-0 py-0 modalViewImg" id="" tabindex="-1" role="dialog" aria-labelledby="modelTitleImg" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 90%;">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modelTitleImg">Modal title</h6>
				<span type="button" class="btn-close" aria-label="Close">
					<i class="fa fa-times"></i>
				</span>
			</div>
			<div class="modal-body overflow-auto">
			</div>
		</div>
	</div>
</div>

<div id="modalViewImg" class="modal-img">
	<div class="d-flex w-100 position-fixed justify-content-center" style="top:20px;z-index: inherit;">
		<button type="button" class="btn btn-xs shadow-xs border w-60px btn-icon bg-white mr-2 no-zoom" data-toggle="tooltip" title="Normal"><i class="fa fa-sync-alt"></i></button>
		<button type="button" class="btn btn-xs shadow-xs border w-60px btn-icon bg-white mr-2 zoom-out" data-toggle="tooltip" title="Zoom Out"><i class="fa fa-minus"></i></button>
		<button type="button" class="btn btn-xs shadow-xs border w-60px btn-icon bg-white mr-2 zoom-in" data-toggle="tooltip" title="Zoom In"><i class="fa fa-plus"></i></button>
		<button type="button" class="btn btn-xs shadow-xs border w-60px btn-icon bg-white mr-2" id="close-modal"><i class="fa fa-times"></i></button>
	</div>

	<img class="modal-content-img" id="img01">
</div>

<style>
	/* The Modal (background) */
	.modal-img {
		display: none;
		/* Hidden by default */
		position: fixed;
		/* Stay in place */
		z-index: 9999;
		/* Sit on top */
		padding-top: 100px;
		/* Location of the box */
		left: 0;
		top: 0;
		width: 100%;
		/* Full width */
		height: 100%;
		/* Full height */
		overflow: auto;
		/* Enable scroll if needed */
		background-color: rgb(0, 0, 0);
		/* Fallback color */
		background-color: rgba(0, 0, 0, 0.9);
		/* Black w/ opacity */
	}

	/* Modal Content (image) */
	.modal-img .modal-content-img {
		margin: auto;
		display: block;
		width: 100%;
		/* max-width: 700px; */
	}

	/* Caption of Modal Image */
	#caption {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
		text-align: center;
		color: #ccc;
		padding: 10px 0;
		height: 150px;
	}

	/* Add Animation */
	.modal-img .modal-content-img,
	#caption {
		-webkit-animation-name: zoom;
		-webkit-animation-duration: 0.6s;
		animation-name: zoom;
		animation-duration: 0.6s;
	}

	@-webkit-keyframes zoom {
		from {
			-webkit-transform: scale(0)
		}

		to {
			-webkit-transform: scale(1)
		}
	}

	@keyframes zoom {
		from {
			transform: scale(0)
		}

		to {
			transform: scale(1)
		}
	}

	/* The Close Button */
	.close-modal {
		position: absolute;
		top: 15px;
		right: 35px;
		color: #f1f1f1;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
	}

	.close-modal:hover,
	.close-modal:focus {
		color: #bbb;
		text-decoration: none;
		cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px) {
		.modal-content-img {
			width: 100%;
		}
	}
</style>

<script>
	$(document).ready(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$.fn.dataTable.tables({
				visible: true,
				api: true
			}).columns.adjust();
		});

		$('.datatable').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			// ordering: false,
			// info: false
		});

		$(document).on('click', '#add_new', function() {
			$('#modalForm').modal('show')
			let html = `
			
			`;
			$('.modal-body').html(html);
			load_tinymce('textarea')

		})

		$(document).on('click', '.edit', function() {
			let id = $(this).data('id')
			$('#modalForm').modal('show')
			$.ajax({
				url: siteurl + active_controller + 'edit/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(result) {
					if (result) {
						let html = `
						<div class="form-group row">
							<label class="col-3">Name Procedure</label>
							<div class="col-9">
								<input type="hidden" name="id" id="id" class="form-control" value="` + result.id + `">
								<input type="text" name="name" id="name" class="form-control" required placeholder="Name Procedure" value="` + result.name + `">
								<small class="text-danger invalid-feedback">Name procedure</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Objektif Proses</label>
							<div class="">
								<input type="text" name="object" id="object" class="form-control" value="` + result.object + `" required placeholder="Objektif Proses" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Objektif Proses</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Definisi</label>
							<div class="">
								<input type="text" name="define" id="define" class="form-control" value="` + result.define + `" required placeholder="Definisi Proses" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Definisi Proses</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Performa Indikator</label>
							<div class="">
								<input type="text" name="performance" id="performance" class="form-control" value="` + result.performance + `" required placeholder="Performa Indikator" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Performa Indikator</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Ruang Lingkup</label>
							<div class="">
								<input type="text" name="scope" id="scope" class="form-control" value="` + result.scope + `" required placeholder="Ruang Lingkup" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Ruang Lingkup</small>
							</div>
						</div>
						<div class="form-group">
							<label for="sipocor" class="">SIPOCOR</label>
							<div class="">
								<textarea  name="sipocor" id="sipocor" class="form-control" placeholder="SIPOCOR"  aria-describedby="helpId">` + result.name + `</textarea>
								<small class="text-danger invalid-feedback">SIPOCOR</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Nomor</label>
							<div class="">
								<input type="text" name="number" id="number" class="form-control" value="` + result.number + `" required placeholder="Nomor" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Nomor</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">PIC</label>
							<div class="">
								<input type="text" name="pic" id="pic" class="form-control" required placeholder="PIC" value="` + result.pic + `" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">PIC</small>
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="">Deskripsi</label>
							<div class="">
								<textarea name="description" id="description" class="form-control" placeholder="Deskripsi" aria-describedby="helpId">` + result.name + `</textarea>
								<small class="text-danger invalid-feedback">Deskripsi</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Dok. Terkait</label>
							<div class="">
								<input type="text" name="relate_doc" id="relate_doc" class="form-control" value="` + result.relate_doc + `" required placeholder="Dokumen terkait" aria-describedby="helpId"/>
								<small class="text-danger invalid-feedback">Dokumen terkait</small>
							</div>
						</div>
						`;
						$('.modal-body').html(html);

						load_tinymce('textarea')
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}

				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})

		$(document).on('click', '.view', function() {
			let id = $(this).data('id')
			let status = $(this).data('status')
			$.ajax({
				url: siteurl + active_controller + 'view/' + id + "/" + status,
				type: 'GET',
				success: function(result) {
					if (result) {
						$('#modalView').find('.modal-body').html(result);
						$('#modalView').modal('show')
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}
				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})

		$(document).on('click', '.delete', function() {
			let id = $(this).data('id')
			Swal.fire({
				title: 'Are you sure to delete this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Yes, Delete <i class="fa fa-trash text-white"></i>',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete_procedure/' + id,
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

		$(document).on('click', '.review', function() {
			let id = $(this).data('id')
			Swal.fire({
				title: 'Are you sure to review this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'review/' + id,
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
								Swal.fire('Warning', result.msg, 'warning', 2000)
							}
						},
						error: function() {
							Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 3000)
						}
					})
				}
			})

		})

		$(document).on('click', '.cancle-review', function() {
			let id = $(this).data('id')
			Swal.fire({
				title: 'Are you sure to cancle review this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes, Cancel <i class="fa fa-undo text-white"></i>',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'cancel_review/' + id,
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
								Swal.fire('Warning', result.msg, 'warning', 2000)
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

		$(document).on('click', '.view-form', function() {
			const id = $(this).data('id')
			if (id) {
				$('.modal-title').html('View Form')
				$('#content_modal').load(siteurl + active_controller + 'view_form/' + id)
				$('#modelId').modal('show')
				$('.modal-dialog').css('max-width', '')
			} else {
				Swal.fire('Warning!!', 'Not available data to process', 'waring', 2000);
			}
		})

		$(document).on('click', '.view-guide', function() {
			const id = $(this).data('id')
			if (id) {
				$('.modal-title').html('View IK')
				$('#content_modal').load(siteurl + active_controller + 'view_guide/' + id)
				$('#modelId').modal('show')
			} else {
				Swal.fire('Warning!!', 'Not available data to process', 'waring', 2000);
			}
		})

		/* PREVIEW IMAGE */
		$(document).on('click', '.view-image', function() {
			const urlImg = $(this).parents('.dropzone-wrapper').find('img').attr('src')
			const img = "<img src='" + urlImg + "' class='img-'>"
			// $('#modalViewImg').modal('show')
			// $('#modalViewImg .modal-body').html(img)
			// var reader = new FileReader();


			// reader.onload = function(e) {
			// 	console.log(e)
			// 	var htmlPreview = '<img width="100" src="' + e.target.result + '" />';
			// 	boxZone.append(htmlPreview);
			// };

			// Get the modal
			var modal = document.getElementById("modalViewImg");

			// Get the image and insert it inside the modal - use its "alt" text as a caption
			// var img = document.getElementById("myImg");
			var modalImg = document.getElementById("img01");
			// var captionText = document.getElementById("caption");
			// img.onclick = function() {
			modal.style.display = "block";
			modalImg.src = urlImg;
			// 	captionText.innerHTML = this.alt;
			// }

			// Get the <span> element that closes the modal
			var btn = document.getElementById("close-modal");

			// When the user clicks on <span> (x), close the modal
			btn.onclick = function() {
				modal.style.display = "none";
			}
		})

		/* ZOOM-IN & ZOOM-OUT */

		let n = 100
		$(document).on('click', '.zoom-in', function() {
			n = n + 5
			$('.modal-img img.modal-content-img ').css('width', n + '%')
		})
		$(document).on('click', '.zoom-out', function() {
			n = n - 5
			$('.modal-img img.modal-content-img ').css('width', n + "%")
		})
		$(document).on('click', '.no-zoom', function() {
			n = 100
			$('.modal-img img.modal-content-img ').css('width', n + "%")
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