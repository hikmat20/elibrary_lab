<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<form id="form-chapter">
				<div class="card card-stretch shadow card-custom">
					<div class="card-header justify-content-between d-flex align-items-center">
						<h2 class="m-0"><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-10">
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2  h6 col-form-label font-weight-bold">Company</label>
									<div class="col-6">:
										<input type="hidden" name="id" value="<?= $Data->id; ?>">
										<input type="hidden" name="company_id" value="<?= $Data->company_id; ?>">
										<label for="" class="col-form-label font-weight-bolder h6 "><?= $Data->nm_perusahaan; ?></label>
										<!-- <select name="company_id" id="status" class="form-control select2">
											<option value=""></option>
											<?php foreach ($Companies as $comp) : ?>
												<option value="<?= $comp->id_perusahaan; ?>" <?= ($comp->id_perusahaan == $Data->company_id) ? 'selected' : ''; ?>><?= $comp->nm_perusahaan; ?></option>
											<?php endforeach; ?>
										</select> -->
									</div>
								</div>
							</div>
						</div>


						<!-- STANDARD -->
						<hr>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">List Standard</h4>
						</div>

						<table id="tableStandard" class="table table-sm table-condensed table-bordered">
							<thead class="text-center ">
								<tr class="table-light">
									<th class="py-2" width="50">No</th>
									<th class="py-2 text-start">Standard Name</th>
									<th class="py-2" width="50">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($datStd)) : ?>
									<?php $n = 0;
									foreach ($datStd as $std) : $n++; ?>
										<tr>
											<td class="text-center"><?= $n; ?>
											</td>
											<td class="">
												<span class="dataIdStd d-none"><?= $std->standard_id; ?></span>
												<?= $std->name; ?>
											</td>
											<td class="text-center">
												<button type="button" class="btn btn-danger btn-icon btn-xs del-row-std" data-id="<?= $std->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr class="empty">
										<td colspan="2" class="text-center text-muted">~ No data avilable ~</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<button type="button" class="btn btn-success btn-sm" id="add_standard"><i class="fa fa-plus mr-2"></i>Add Standard</button>
						<br>
						<br>
						<hr>
						<!-- REGULATIONS -->
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">List Regulations</h4>
						</div>

						<table id="tableRegulations" class="table table-sm table-condensed table-bordered">
							<thead class="text-center ">
								<tr class="table-light">
									<th class="py-2" width="50">No</th>
									<th class="py-2">Regulations Name</th>
									<th class="py-2" width="50">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($dataReg)) : ?>
									<?php $n = 0;
									foreach ($dataReg as $reg) : $n++; ?>
										<tr>
											<td class="text-center"><?= $n; ?></td>
											<td class="">
												<span class="dataIdReg d-none"><?= $reg->regulation_id; ?></span>
												<?= $reg->name; ?>
											</td>
											<td class="text-center">
												<button type="button" class="btn btn-danger btn-icon btn-xs del-row-reg" data-id="<?= $reg->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr class="empty">
										<td colspan="2" class="text-center text-muted">~ No data avilable ~</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
						<button type="button" class="btn btn-success btn-sm" id="add_regulation"><i class="fa fa-plus mr-2"></i>Add Regulations</button>
					</div>
					<div class="card-footer justify-content-between d-flex">
						<button type="submit" class="btn btn-primary w-100px save"><i class="fa fa-save"></i>Save</button>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	.select2-selection--single {
		height: 100% !important;
	}

	.select2-selection__rendered {
		word-wrap: break-word !important;
		text-overflow: inherit !important;
		white-space: normal !important;
	}
</style>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an Option',
			width: '100%',
			allowClear: true,
		})

		$(document).on('submit', '#form-chapter', function(e) {
			e.preventDefault();
			let formdata = new FormData($(this)[0])
			let btn = $('.save')
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
						})
						$('#modelId').modal('hide')
						location.href = siteurl + active_controller + 'edit/' + result.id
						console.log(result);
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

		$(document).on('click', '#add_standard', function() {
			const row = $('table#tableStandard tbody tr.empty').length
			const num = $('table#tableStandard tbody tr.addStd').length + 1
			var html = `
			<tr class="addStd">
				<td class="text-center" style="vertical-align:middle;">
					<small class="fa fa-plus text-sm"></small>
				</td>
				<td>
					<select class="form-control select2 selectStd" name="standards[` + num + `][standard_id]">
						<option value=""></option>
						<?php foreach ($standards as $std) : ?>
							<option value="<?= $std->id; ?>"><?= $std->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td class="text-center" style="vertical-align:middle;">
					<button type="button" class="btn btn-danger btn-icon btn-xs del-row-std"><i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>
			</tr>
			`;

			if (row == 1) {
				$('table#tableStandard tbody').html(html)
			} else {
				$('table#tableStandard tbody').append(html)
			}
			$('.select2').select2({
				placeholder: 'Choose an option',
				allowClear: true,
				width: '100%'
			})
			selectStd('.selectStd', '.dataIdStd')
		})

		$(document).on('change', '.selectStd', function() {
			selectStd('.selectStd', '.dataIdStd')
		})

		$(document).on('click', '.del-row-std', function() {
			const id = $(this).data('id')
			const btn = $(this)

			if (id != undefined && (id !== null || id !== '')) {
				Swal.fire({
					title: 'Confirmation!',
					text: 'Are you sure want to be delete this data?',
					icon: 'question',
					showCancelButton: true,
				}).then((value) => {
					if (value.isConfirmed) {
						$.ajax({
							url: siteurl + active_controller + 'delete',
							type: 'POST',
							data: {
								id
							},
							dataType: 'JSON',
							beforeSend: function() {
								btn.html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true)
							},
							complete: function() {
								btn.html('<span class="fa fa-trash"></span>').prop('disabled', false)
							},
							success: function(result) {
								if (result.status == 1) {
									Swal.fire('Success!', result.msg, 'success', 1500)
									btn.parents('tr').addClass('table-danger')
									btn.parents('tr').hide('slow')
									setTimeout(() => {
										btn.parents('tr').remove()
									}, 500);
								} else {
									Swal.fire('Failed!', result.msg, 'warning', 1500)
								}
							},
							error: function() {
								Swal.fire('Error!', 'Server timeout. Error!', 'error', 1500)
							}
						})
					}
				})

			} else {
				btn.parents('tr').addClass('table-warning')
				btn.parents('tr').hide('fast')
				setTimeout(function() {
					btn.parents('tr').remove()
				}, 500);
			}
			selectStd('.selectStd', '.dataIdStd')
		})

		$(document).on('click', '#add_regulation', function() {
			const row = $('table#tableRegulations tbody tr.empty').length
			const num = $('table#tableRegulations tbody tr.add').length + 1
			var html = `
			<tr class="add">
				<td class="text-center" style="vertical-align:middle;">
					<small class="fa fa-plus text-sm"></small>
				</td>
				<td>
					<select class="form-control select2 selectReg" name="regulations[` + num + `][regulation_id]">
						<option value=""></option>
						<?php if ($regulations) : ?>
							<?php foreach ($regulations as $reg) : ?>
								<option value="<?= $reg->id; ?>"><?= $reg->name; ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</td>
				<td class="text-center" style="vertical-align:middle;">
					<button type="button" class="btn btn-danger btn-icon btn-xs del-row-reg"><i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>
			</tr>
			`;

			if (row == 1) {
				$('table#tableRegulations tbody').html(html)
			} else {
				$('table#tableRegulations tbody').append(html)
			}
			$('.select2').select2({
				placeholder: 'Choose an option',
				allowClear: true,
				width: '550px'
			})
			selectStd('.selectReg', '.dataIdReg')
		})

		$(document).on('change', '.selectReg', function() {
			selectStd('.selectReg', '.dataIdReg')
		})

		$(document).on('click', '.del-row-reg', function() {
			const id = $(this).data('id')
			const btn = $(this)

			if (id != undefined && (id !== null || id !== '')) {
				Swal.fire({
					title: 'Confirmation!',
					text: 'Are you sure want to be delete this data?',
					icon: 'question',
					showCancelButton: true,
				}).then((value) => {
					if (value.isConfirmed) {
						$.ajax({
							url: siteurl + active_controller + 'delete_reg',
							type: 'POST',
							data: {
								id
							},
							dataType: 'JSON',
							beforeSend: function() {
								btn.html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled', true)
							},
							complete: function() {
								btn.html('<span class="fa fa-trash"></span>').prop('disabled', false)
							},
							success: function(result) {
								if (result.status == 1) {
									Swal.fire('Success!', result.msg, 'success', 1500)
									btn.parents('tr').addClass('table-danger')
									btn.parents('tr').hide('slow')
									setTimeout(() => {
										btn.parents('tr').remove()
									}, 500);
								} else {
									Swal.fire('Failed!', result.msg, 'warning', 1500)
								}
							},
							error: function() {
								Swal.fire('Error!', 'Server timeout. Error!', 'error', 1500)
							}
						})
					}
				})

			} else {
				btn.parents('tr').addClass('table-warning')
				btn.parents('tr').hide('fast')
				setTimeout(function() {
					btn.parents('tr').remove()
				}, 500);
			}

			selectStd('.selectReg', '.dataIdReg')
		})

	})

	function selectStd(s, d) {
		const selectedValue = [];
		$(s)
			.find(':selected')
			.filter(function(idx, el) {
				return $(el).attr('value');
			})
			.each(function(idx, el) {
				selectedValue.push($(el).attr('value'));
			});
		$(d).each(function(idx, el) {
			selectedValue.push($(el).text());
		});

		$(s)
			.find('option')
			.each(function(idx, option) {
				if (selectedValue.indexOf($(option).attr('value')) > -1) {
					if ($(option).is(':checked')) {
						return;
					} else {
						$(this).attr('disabled', true);
					}
				} else {
					$(this).attr('disabled', false);
				}
			});
	}
</script>