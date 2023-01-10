<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<form id="form-reference">
				<div class="card card-stretch shadow card-custom">
					<div class="card-header justify-content-between d-flex align-items-center">
						<h2 class="m-0"><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-10">
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-3 col-form-label font-weight-bold">Select Copmany</label>
									<div class="col-6">
										<label class="font-weight-bolder col-form-label"><?= $this->session->company->nm_perusahaan; ?></label>
										<!-- <select name="company_id" id="company_id" class="form-control select2">
											<option value=""></option>
											<?php foreach ($Companies as $comp) : ?>
												<option value="<?= $comp->id_perusahaan; ?>"><?= $comp->nm_perusahaan; ?></option>
											<?php endforeach; ?>
										</select> -->
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-3 col-form-label font-weight-bold">Start Date</label>
									<div class="col-6">
										<input type="date" name="sdate" id="sdate" class="form-control">
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-3 col-form-label font-weight-bold">Descriptions</label>
									<div class="col-6">
										<textarea name="descriptions" id="desc" class="form-control" rows="5" placeholder="Descriptions"></textarea>
									</div>
								</div>

							</div>
						</div>


						<!-- STANDARD -->
						<div class="card shadow-xs border-0">
							<div class="card-body">
								<hr>
								<div class="d-flex justify-content-between align-items-center mb-3">
									<h4 class="">Standard</h4>
								</div>

								<table id="tableStandard" class="table table-sm table-condensed table-bordered">
									<thead class="text-center ">
										<tr class="table-light">
											<th class="py-2" width="50">No</th>
											<th class="py-2" width="350">Standard Name</th>
											<th class="py-2">Descriptions</th>
											<th class="py-2" width="80">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr class="empty">
											<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
										</tr>
									</tbody>
								</table>
								<button type="button" class="btn btn-success btn-sm" id="add_standard"><i class="fa fa-plus mr-2"></i>Add Standard</button>
							</div>
						</div>
						<br>

						<!-- REGULATIONS -->
						<div class="card shadow-xs border-0">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center mb-3">
									<h4 class="">Regulations</h4>
								</div>

								<table id="tableRegulations" class="table table-sm table-condensed table-bordered">
									<thead class="text-center ">
										<tr class="table-light">
											<th class="py-2" width="50">No</th>
											<th class="py-2" width="350">Regulations Name</th>
											<th class="py-2">Descriptions</th>
											<th class="py-2" width="80">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr class="empty">
											<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
										</tr>
									</tbody>
								</table>
								<button type="button" class="btn btn-success btn-sm" id="add_regulation"><i class="fa fa-plus mr-2"></i>Add Regulations</button>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" id="save" class="btn btn-primary w-100px save"><i class="fa fa-save"></i>Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	span.select2-selection.select2-selection--single.is-invalid {
		border-color: #f64e60;
		padding-right: calc(1.5em + 1.3rem);
		background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23F64E60' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23F64E60' stroke='none'/%3e%3c/svg%3e");
		background-repeat: no-repeat;
		background-position: right calc(0.375em + 0.325rem) center;
		background-size: calc(0.75em + 0.65rem) calc(0.75em + 0.65rem);
	}
</style>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an Option',
			width: '100%',
			allowClear: true,
		})

		$(document).on('click', '#save', function(e) {
			$('#company_id').next('span').find('span.select2-selection').removeClass('is-invalid')
			$('#sdate').removeClass('is-invalid')

			const company_id = $('#company_id').val()
			const sdate = $('#sdate').val()

			// if (!company_id) {
			// 	$('#company_id').next('span').find('span.select2-selection').addClass('is-invalid')
			// 	$('body,html').animate({
			// 		scrollTop: $("#company_id").offset().top - 220
			// 	}, 1000);

			// 	return false;
			// }
			if (!sdate) {
				$('#sdate').addClass('is-invalid')
				$('body,html').animate({
					scrollTop: $("#sdate").offset().top - 210
				}, 1000);
				return false;
			}

			let formdata = new FormData($('#form-reference')[0])
			let btn = $(this)
			Swal.fire({
				title: 'Confirmation!',
				text: 'Are you sure you want to save this data?',
				icon: 'question',
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
							btn.attr('disabled', true).html('<i class="spinner spinner-border-sm"></i>Loading...')
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

				}
			})
		})


		$(document).on('click', '.del-row-reg', function() {
			$(this).parents('tr').remove()
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
				<td>
					<input name="standards[` + num + `][descriptions]" placeholder="Descriptions" type="text" class="form-control" maxLength="200">
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
				<td>
					<input name="regulations[` + num + `][descriptions]" placeholder="Descriptions" type="text" class="form-control" maxLength="200">
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
				width: '100%'
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