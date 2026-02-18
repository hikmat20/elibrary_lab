<style>
	.dataTables_scroll {
		margin: 0px !important;
	}
</style>
<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container">
			<div class="d-flex align-items-baseline flex-wrap mr-5 mb-10">
				<a href="<?= base_url('dashboard'); ?>">
					<h4 class="text-dark font-weight-bold my-1 mr-2"><i class="fa fa-home"></i></h4>
				</a>
				
			</div>
			<h1 class="text-white fa-3x">Standard Dan Peraturan</h1>
			<div class="row mb-10">
				<div class="col-md-4">
					<input type="text" name="serarch" id="search" placeholder="Pencarian" class="form-control rounded form-control-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">

					
					<ul class="nav nav-warning nav-pills nav-bolder" id="myTab2" role="tablist">
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link active" id="tab_1" data-toggle="tab" href="#data_1">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Std. Management System
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= count($requirements); ?></div>
									</small>
								</span>
							</a>
						</li>
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link " id="tab_2" data-toggle="tab" href="#data_2">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Regulation
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= count($regulations); ?></div>
									</small>
								</span>
							</a>
						</li>		
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link " id="tab_3" data-toggle="tab" href="#data_3">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Standard Refrences
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= count($standar_referance); ?></div>
									</small>
								</span>
							</a>
						</li>				
					</ul>
					<div class="card rounded-top-0 border-0" style="background-color: zrgba(255,255,255,0.85);">
						<div class="card-body py-3 ">
							
							<div class="tab-content " id="myTabContent2">
								<div class="tab-pane fade active show" id="data_1" role="tabpanel" aria-labelledby="tab_1">	
										<table class="table datatable table-condensed table-hover">
											<thead>
												<tr class="">
													<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
													<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
													<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=0; foreach ($requirements as $row) : $no++; ?>
													<tr class="cursor-pointer" onclick="show('<?= $row->id; ?>','requirements')">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h6 text-dark"><?= $row->name; ?></td>
														<td class="h6 text-center"><i class="fa fa-eye text-dark"></i></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
								</div>

								<div class="tab-pane fade" id="data_2" role="tabpanel" aria-labelledby="tab_2">	
										<table class="table datatable table-condensed table-hover">
											<thead>
												<tr class="">
													<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
													<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
													<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=0; foreach ($regulations as $row1) : $no++; ?>
													<tr class="cursor-pointer" onclick="show('<?= $row1->id; ?>','regulations')">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h6 text-dark"><?= $row1->name; ?></td>
														<td class="h6 text-center"><i class="fa fa-eye text-dark"></i></td>
													</tr>
												<?php endforeach; ?>	
											</tbody>
										</table>
								</div>
								<div class="tab-pane fade" id="data_3" role="tabpanel" aria-labelledby="tab_3">	
									<table class="table datatable table-condensed table-hover">
										<thead>
											<tr class="">
												<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
												<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
												<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; foreach ($standar_referance as $row2) : $no++; ?>
												<tr class="cursor-pointer" onclick="show('<?= $row2->id; ?>','standar_referance')">
													<td class="h6 text-dark"><?= $no; ?></td>
													<td class="h6 text-dark"><?= $row2->name; ?></td>
													<td class="h6 text-center"><i class="fa fa-eye text-dark"></i></td>
												</tr>
											<?php endforeach; ?>	
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="col-md-3">
					<div class="card mt-15 border-0 shadow-lg" style="background-color: srgba(255,255,255,0.85);">
						<div class="card-body pt-5 px-5">
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
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width:90%">
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

	<script>
		function show(id,type='') {
			$('#modelId').modal('show')
			console.log(id)
			if(type=='requirements'){
				$('#data-file').load(siteurl + '/requirements/view/' + id)
			}else if(type=='standar_referance'){
				$('#data-file').load(siteurl + '/standard/view/' + id)
			}else if(type=='regulations'){
				$('#data-file').load(siteurl + '/regulations/view/' + id)		
			}
		}

		$(document).ready(function() {
			$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
				$.fn.dataTable.tables({
					visible: true,
					api: true
				}).columns.adjust();
			});

			$('.datatable').DataTable({
				orderCellsTop: false,
				fixedHeader: true,
				scrollX: true,
				ordering: false,
				info: false
			});
		})
	</script>