<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container">
			<div class="d-flex align-items-baseline flex-wrap mr-5 mb-10">
				<a href="<?= base_url('dashboard'); ?>">
					<h4 class="text-dark font-weight-bold my-1 mr-2"><i class="fa fa-home"></i></h4>
				</a>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="" class="text-muted">PROSEDUR, FORM, IK DAN RECORD</a>
					</li>
				</ul>
			</div>
			<h1 class="text-white fa-3x">PROSEDUR, FORM, IK DAN RECORD</h1>
			<div class="row mb-10">
				<div class="col-md-4">
					<input type="text" name="serarch" id="search" placeholder="Pencarian" class="form-control rounded form-control-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-warning nav-pills nav-bolder" id="myTab2" role="tablist">
						<?php $n = 0;
						foreach ($groups as $grp) : $n++; ?>
							<li class="nav-item mx-0">
								<a class="rounded-bottom-0 nav-link  <?= ($n == '1') ? 'active' : ''; ?>" id="tab_<?= $grp->id; ?>" data-toggle="tab" href="#data_<?= $grp->id; ?>">
									<span class="nav-icon ">
										<i class="fa fa-file-alt"></i>
									</span>
									<span class="text-white h5 my-0"><?= $grp->name; ?>
										<small class="">
											<div class="badge bg-white rounded-circle text-warning"><?= (isset($ArrPro[$grp->id])) ? count($ArrPro[$grp->id]) : '0'; ?></div>
										</small>
									</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="card rounded-top-0 border-0" style="background-color: zrgba(255,255,255,0.85);">
						<div class="card-body py-3 ">
							<?php if (!$groups) : ?>
								<div class="justify-content-center flex-column d-flex py-10">
									<img src="/assets/images/directory/not-found.png" alt="" class="img-cover justify-content-center m-auto" width="200px">
									<h3 class="text-center text-dark-50">File not found</h3>
								</div>
							<?php endif; ?>
							<div class="tab-content " id="myTabContent2">
								<?php $n = 0;
								foreach ($groups as $grp) :  $n++; ?>
									<div class="tab-pane fade <?= ($n == '1') ? 'active show' : ''; ?>" id="data_<?= $grp->id; ?>" role="tabpanel" aria-labelledby="tab_<?= $grp->id; ?>">
										<?php if (isset($ArrPro[$grp->id])) : ?>
											<table class="table table-condensed table-hover">
												<thead>
													<tr class="">
														<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
														<th class="h5 border-2 border-bottom-secondary">File Name</th>
														<th class="h5 border-2 border-bottom-secondary text-center" width="50px"></th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 0;
													foreach ($ArrPro[$grp->id] as $list) : $no++; ?>
														<!-- ondblclick="location.href = siteurl+active_controller+'procedures/<?= $list['id']; ?>'" -->
														<tr class="cursor-pointer list-document">
															<td class="h6 text-dark"><?= $no; ?></td>
															<td class="h5 text-dark d-flex align-items-center my-0 py-2">
																<i class="fa fa-folder text-warning fa-2x mr-2 pt-0"></i>
																<strong class="mt-1">
																	<?= $list['name']; ?>
																</strong>
															</td>
															<td class="h6 text-center">
																<div class="btn-action">
																	<a href="<?= base_url($this->uri->segment(1) . '/procedures/' . $list['id']); ?>" class="btn btn-primary btn-icon btn-xs shadow-xs"><i class="fas fa-chevron-right"></i></a>
																</div>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										<?php else : ?>
											<table class="table">
												<tr>
													<td colspan="2" class="text-center h4"><i>No data available</i></td>
												</tr>
											</table>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-3">
					<div class="card mt-15 border-0 shadow-lg" style="background-color: srgba(255,255,255,0.85);">
						<div class="card-body pt-5 px-5">
							<div class="d-flex flex-center mb-3">
								<span class="align-self-stretch mr-2 my-1 "><i class="fa fa-link text-warning"></i></span>
								<div class="d-flex flex-column flex-grow-1">
									<a href="<?= base_url($this->uri->segment(1) . '/procedures'); ?>" class="text-dark text-hover-warning font-weight-bolder font-size-lg mb-1">PROSEDUR, FORM, IK DAN RECORD</a>
								</div>
							</div>
							<?php foreach ($MainData as $main) : ?>
								<div class="d-flex flex-center mb-3">
									<span class="align-self-stretch mr-2 my-1 "><i class="fa fa-link text-warning"></i></span>
									<div class="d-flex flex-column flex-grow-1">
										<a href="<?= base_url($this->uri->segment(1) . '/' . $main->id); ?>" class="text-dark text-hover-warning font-weight-bolder font-size-lg mb-1"><?= $main->name; ?></a>
									</div>
								</div>
							<?php endforeach; ?>

						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content" data-scroll="true" data-height="700">
				<div class="modal-header">
					<h5 class="modal-title">View Document</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1" id="data-file">
					File not found
				</div>
				<div class="modal-footer py-2">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.btn-action {
		display: none;
	}

	.list-document:hover .btn-action {
		display: block;
	}
</style>
<script>
	function show(id) {
		$('#modelId').modal('show')
		$('#data-file').load(siteurl + active_controller + 'show/' + id)
	}
</script>