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
									<label for="" class="col-3 col-form-label font-weight-bold">Select Copmany</label>
									<div class="col-6">
										<select name="company_id" id="status" class="form-control select2">
											<option value=""></option>
											<?php foreach ($Companies as $comp) : ?>
												<option value="<?= $comp->id_perusahaan; ?>"><?= $comp->nm_perusahaan; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-3 col-form-label font-weight-bold">Descriptions</label>
									<div class="col-6">
										<textarea name="descriptions" id="desc" class="form-control" rows="5" placeholder="Descriptions"></textarea>
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-3 col-form-label font-weight-bold">Start Date</label>
									<div class="col-6">
										<input type="date" name="sdate" id="sdate" class="form-control">
									</div>
								</div>
							</div>
						</div>


						<!-- STANDARD -->
						<div class="card shadow-xs border-0">
							<div class="card-body">
								<hr>
								<div class="d-flex justify-content-between align-items-center mb-3">
									<h4 class="">List Standard</h4>
								</div>

								<table id="tableStandard" class="table table-sm table-condensed table-bordered">
									<thead class="text-center ">
										<tr class="table-light">
											<th class="py-2" width="50">No</th>
											<th class="py-2">Standard Name</th>
											<th class="py-2">Descriptions</th>
											<th class="py-2" width="100">Status</th>
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
									<h4 class="">List Regulations</h4>
								</div>

								<table id="tableRegulations" class="table table-sm table-condensed table-bordered">
									<thead class="text-center ">
										<tr class="table-light">
											<th class="py-2" width="50">No</th>
											<th class="py-2">Regulations Name</th>
											<th class="py-2">Descriptions</th>
											<th class="py-2" width="100">Status</th>
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
						<button type="submit" class="btn btn-primary w-100px save"><i class="fa fa-save"></i>Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

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
						location.href = siteurl + active_controller + '/edit/' + result.id
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
					<select class="form-control select2" name="standard[` + num + `][standard_id]">
						<option value=""></option>
						<option value="1">test</option>
						<option value="2">test2</option>
					</select>
				</td>
				<td>
					<input name="standard[` + num + `][descriptions]" placeholder="Descriptions" type="text" class="form-control" maxLength="200">
				</td>
				<td>
					<select class="form-control select2" name="standard[` + num + `][status]">
						<option value=""></option>
						<option value="1">test</option>
						<option value="2">test2</option>
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
		})

		$(document).on('click', '.del-row-std', function() {
			$(this).parents('tr').remove()
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
					<select class="form-control select2" name="regulation[` + num + `][regulation_id]">
						<option value=""></option>
						<option value="1">test</option>
						<option value="2">test2</option>
					</select>
				</td>
				<td>
					<input name="regulation[` + num + `][descriptions]" placeholder="Descriptions" type="text" class="form-control" maxLength="200">
				</td>
				<td>
					<select class="form-control select2" name="regulation[` + num + `][status]">
						<option value=""></option>
						<option value="1">test</option>
						<option value="2">test2</option>
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
				width: '100%'
			})
		})

		$(document).on('click', '.del-row-reg', function() {
			$(this).parents('tr').remove()
		})

	})
</script>