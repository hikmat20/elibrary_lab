<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h2><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
					<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
				</div>
				<form id="form-chapter">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="id" value="<?= isset($Data->id) ? $Data->id : ''; ?>">
								<input type="hidden" name="requirement_id" value="<?= $DataStd->id; ?>">
								<div class="mb-1 row flex-nowrap">
									<label for="Name" class="col-3 col-form-label font-weight-bold">Standard</label>
									<div class="col-10">
										<input type="text" readonly class="mb-5 form-control bg-light-secondary form-control-solid" id="Name" placeholder="Name of Requirement" value="<?= $DataStd->name; ?>" />
										<button class="btn btn-primary" type="submit" id="save"><i class="fa fa-save"></i>Save</button>
									</div>
								</div>
							</div>
						</div>

						<hr>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">List Pasal</h4>
						</div>
						<table class="table table-sm table-striped table-bordered">
							<thead class="">
								<tr class="">
									<th width="40">No</th>
									<th width="100">Pasal</th>
									<th width="">Desc. Indonesian</th>
									<th width="">Desc. English</th>
									<th class="w-25">Proses Terkait</th>
									<th class="w-25">Dokumen Lain</th>
								</tr>
							</thead>
							<tbody>

								<?php if (!$DetailStd) : ?>
									<tr>
										<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
									</tr>
									<?php else :
									$n = 0;
									$inArray = '';
									foreach ($DetailStd as $k => $dtl) : $n++;
										$inArray = isset($ArrPro[$dtl['id']]) ? $ArrPro[$dtl['id']] : [];
									?>
										<tr>
											<td class="text-center"><?= $n; ?></td>
											<td class="">
												<?= $dtl['chapter']; ?>
												<?php
												$comb = array_combine(array_column($Detail, 'chapter_id'), array_column($Detail, 'id'));
												?>
												<input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= (((in_array($dtl['id'], array_column($Detail, 'chapter_id'))) ? $comb[$dtl['id']] : '')) ?>">
												<input type="hidden" name="detail[<?= $n; ?>][chapter]" value="<?= $dtl['id'] ?>">
											</td>
											<td class="">
												<?= ($dtl['desc_indo']) ? limit_text(strip_tags($dtl['desc_indo']), 100) . ' <a href="#read" class="link view_pasal" data-id="' . $dtl['id'] . '">[read]</a>' : ''; ?></td>
											</td>
											<td class="">
												<?= ($dtl['desc_eng']) ? limit_text(strip_tags($dtl['desc_eng']), 100) . ' <a href="#read" class="link view_pasal" data-id="' . $dtl['id'] . '">[read]</a>' : ''; ?></td>
											</td>
											<td class="text-center">
												<?php if ($dtl['desc_indo'] || $dtl['desc_eng']) : ?>
													<select name="detail[<?= $n; ?>][procedure_id][]" multiple class="select2 form-control">
														<option value=""></option>
														<?php
														foreach ($procedures as $p) : ?>
															<option value="<?= $p['id']; ?>" <?= (isset($inArray) && in_array($p['id'], $inArray)) ? 'selected' : 'oo'; ?>><?= $p['name']; ?></option>
														<?php endforeach; ?>
													</select>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($dtl['desc_indo'] || $dtl['desc_eng']) : ?>
													<input type="text" class="form-control" placeholder="Dokumen lain" name="detail[<?= $n; ?>][other_docs]" value="<?= isset($other_docs[$dtl['id']]) ? ($other_docs[$dtl['id']]) : ''; ?>">
												<?php endif; ?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
						<div class="d-flex justify-content-between align-items-center">
							<button class="btn btn-primary" type="submit" id="save"><i class="fa fa-save"></i>Save</button>
							<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalView" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid" id="modal_content_view"></div>
			</div>
			<div class="modal-footer justify-content-end align-items-center">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: "Choose an options",
			width: "100%",
			allowClear: true
		})

		$(document).on('click', '.view_pasal', function() {
			let id = $(this).data('id')
			$('.modal-title').html('View Detail')
			$.ajax({
				url: siteurl + active_controller + 'view_pasal/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(result) {
					let html = `
						<div class="form-group">
							<label class="font-weight-bold"><strong>Pasal</strong></label>
							<div class="">
							` + result.chapter + `
							</div>
						</div>

						<!-- Nav tabs -->
						<ul class="nav nav-fill nav-pills" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link nav-pill active" id="indo-tab" data-toggle="tab" data-target="#indo" type="button" role="tab" aria-controls="indo" aria-selected="true">Indonesian</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link nav-pill" id="eng-tab" data-toggle="tab" data-target="#eng" type="button" role="tab" aria-controls="eng" aria-selected="false">English</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content mt-4 border rounded-lg p-5">
							<div class="tab-pane active pt-4 pb-4" id="indo" role="tabpanel" aria-labelledby="indo-tab">
							` + result.desc_indo + `
							</div>
							<div class="tab-pane pt-4 pb-4" id="eng" role="tabpanel" aria-labelledby="eng-tab">
							` + result.desc_eng + `
							</div>
						</div>
					`;
					$('#modal_content_view').html(html)
					$('#modalView').modal('show')
				},
				error: function(result) {
					Swal.fire({
						title: 'Error!!',
						text: 'Server timeout, becuase error. Please try again.',
						icon: 'error',
						timer: 3000
					})
				}
			})
		})

		$(document).on('submit', '#form-chapter', function(e) {
			e.preventDefault();
			let form = $(this)[0]
			let formdata = new FormData(form)
			let btn = $('#save')
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
						location.reload();
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
</script>