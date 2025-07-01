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
						<ul class="nav nav-tabs nav-pills border-0 mb-5" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="procedures-tab" data-toggle="tab" data-target="#procedures" type="button" role="tab" aria-controls="procedures" aria-selected="true">PROCEDURE</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="form-tab" data-toggle="tab" data-target="#form" type="button" role="tab" aria-controls="form" aria-selected="false">FORM</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="guides-tab" data-toggle="tab" data-target="#guides" type="button" role="tab" aria-controls="guides" aria-selected="false">IK</button>
							</li>
							<!-- <li class="nav-item" role="presentation">
								<button class="nav-link" id="records-tab" data-toggle="tab" data-target="#records" type="button" role="tab" aria-controls="records" aria-selected="false">RECORD</button>
							</li> -->
						</ul>

						<!-- Tab panes -->
						<div class="tab-content p-3 rounded-lg border">
							<div class="tab-pane fade show active" id="procedures" role="tabpanel" aria-labelledby="procedures-tab">
								<div id="accProcedure" role="tablist" aria-multiselectable="true">

									<!--  DETAIL PROSES-->
									<div class="card border-0 mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionDetail" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#detailProcess" aria-expanded="true" aria-controls="detailProcess">
												DETAIL PROSES
											</h4>
										</div>
										<div id="detailProcess" class="collapse in show" role="tabpanel" aria-labelledby="sectionDetail">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Kelompok Proses</strong></label>
															<div class="">
																<select name="group_procedure" id="group_procedure" class="form-control select2">
																	<option value=""></option>
																	<?php foreach ($grProcess as $pro) : ?>
																		<option value="<?= $pro->id; ?>" <?= ($pro->id == $data->group_procedure) ? 'selected' : ''; ?>><?= $pro->name; ?></option>
																	<?php endforeach; ?>
																</select>
																<small class="text-danger invalid-feedback">Kelompok Proses</small>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Status</strong></label>
															<div class="">
																<select name="status" id="status" class="form-control select2" <?= ($data->status == 'DFT') ? '' : 'disabled'; ?>>
																	<option value="<?= ($data->status) ?: 'DFT'; ?>" selected><?= ($data->status) ? $sts[$data->status] : 'Draft'; ?></option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Nama Proses</strong></label>
															<div class="">
																<input type="hidden" name="id" id="procedure_id" value="<?= $data->id; ?>">
																<input name="name" id="name" required class="form-control" placeholder="Nama Proses" aria-describedby="helpId" value="<?= $data->name; ?>">
																<small class="text-danger invalid-feedback">Nama Proses</small>
															</div>
														</div>
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Objektif Proses</strong></label>
															<div class="">
																<textarea name="object" id="object" rows="5" required class="form-control summernote" placeholder="Objektif Proses" aria-describedby="helpId"><?= $data->object; ?></textarea>
																<small class="text-danger invalid-feedback">Objektif Proses</small>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Nomor</strong></label>
															<div class="">
																<input name="nomor" id="nomor" required class="form-control" placeholder="Nomor" aria-describedby="helpId" value="<?= $data->nomor; ?>">
																<small class="text-danger invalid-feedback">Nomor</small>
															</div>
														</div>
														<div class="form-group">
															<label class="font-size-h5"><strong>Ruang Lingkup</strong></label>
															<div class="">
																<textarea name="scope" id="scope" rows="5" class="form-control summernote" placeholder="Ruang Lingkup" aria-describedby="helpId"><?= $data->scope; ?></textarea>
																<small class="text-danger invalid-feedback">Ruang Lingkup</small>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="font-size-h5"><strong><span class="text-danger">*</span> Performa Indikator</strong></label>
															<div class="">
																<textarea name="performance" rows="5" id="performance" class="form-control summernote" placeholder="Performa Indikator" aria-describedby="helpId"><?= $data->performance; ?></textarea>
																<small class="text-danger invalid-feedback">Performa Indikator</small>
															</div>
														</div>
														<div class="form-group">
															<label class="font-size-h5"><strong>Definisi</strong></label>
															<div class="">
																<textarea name="define" id="define" class="form-control summernote" placeholder="Definisi" aria-describedby="helpId"><?= $data->define; ?></textarea>
																<small class="text-danger invalid-feedback">Definisi Proses</small>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>

									<!-- SIPOCOR -->
									<div class="card border-0  mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionSipocor" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#sipocor" aria-expanded="true" aria-controls="sipocor">
												SIPOCOR
											</h4>
										</div>

										<div id="sipocor" class="collapse in" role="tabpanel" aria-labelledby="sectionSipocor">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="Supplier" class="font-weight-bold font-size-"><strong>1. Supplier</strong></label>
															<div class="">
																<textarea rows="5" name="supplier" id="supplier" class="form-control summernote" placeholder="Supplier" aria-describedby="helpId"><?= $data->supplier; ?></textarea>
																<small class="text-danger invalid-feedback">Supplier</small>
															</div>
														</div>
														<div class="form-group">
															<label for="Proses" class="font-weight-bold font-size-"><strong>3. Proses</strong></label>
															<div class="">
																<textarea rows="5" name="process" id="process" class="form-control summernote" placeholder="Proses" aria-describedby="helpId"><?= $data->process; ?></textarea>
																<small class="text-danger invalid-feedback">Proses</small>
															</div>
														</div>
														<div class="form-group">
															<label for="Customer" class="font-weight-bold font-size-"><strong>5. Customer</strong></label>
															<div class="">
																<textarea rows="5" name="customer" id="customer" class="form-control summernote" placeholder="Customer" aria-describedby="helpId"><?= $data->customer; ?></textarea>
																<small class="text-danger invalid-feedback">Customer</small>
															</div>
														</div>
														<div class="form-group">
															<label for="Risk" class="font-weight-bold font-size-"><strong>7. Risk</strong></label>
															<div class="">
																<textarea rows="5" name="risk" id="risk" class="form-control summernote" placeholder="Risk" aria-describedby="helpId"><?= $data->risk; ?></textarea>
																<small class="text-danger invalid-feedback">Risk</small>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="Input" class="font-weight-bold font-size-"><strong>2. Input</strong></label>
															<div class="">
																<textarea rows="5" name="input" id="input" class="form-control summernote" placeholder="Input" aria-describedby="helpId"><?= $data->input; ?></textarea>
																<small class="text-danger invalid-feedback">Input</small>
															</div>
														</div>
														<div class="form-group">
															<label for="Output" class="font-weight-bold font-size-"><strong>4. Output</strong></label>
															<div class="">
																<textarea rows="5" name="output" id="output" class="form-control summernote" placeholder="Output" aria-describedby="helpId"><?= $data->output; ?></textarea>
																<small class="text-danger invalid-feedback">Output</small>
															</div>
														</div>
														<div class="form-group">
															<label for="Objective" class="font-weight-bold font-size-"><strong>6. Objective</strong></label>
															<div class="">
																<textarea rows="5" name="objective" id="objective" class="form-control summernote" placeholder="Objective" aria-describedby="helpId"><?= $data->objective; ?></textarea>
																<small class="text-danger invalid-feedback">Order</small>
															</div>
														</div>
														<div class="form-group">
															<label for="mitigation" class="font-weight-bold font-size-"><strong>8. Mitigation</strong></label>
															<div class="">
																<textarea rows="5" name="mitigation" id="mitigation" class="form-control summernote" placeholder="Mitigation" aria-describedby="helpId"><?= $data->mitigation; ?></textarea>
																<small class="text-danger invalid-feedback">Mitigation</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- FLOW IMAGES -->
									<div class="card border-0 mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionFlowImages" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#flowImages" aria-expanded="true" aria-controls="flowImages">
												FLOW IMAGES
											</h4>
										</div>
										<div id="flowImages" class="collapse in" role="tabpanel" aria-labelledby="sectionFlowImages">
											<div class="card-body">
												<h5 class="mb-4">Flow Images</h5>
												<div class="mb-4">
													<div class="preview-zone hidden">
														<div class="box box-solid">
															<div class="box-body d-flex justify-content-start align-items-center">
																<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
																	<div class="dropzone-desc">
																		<?php if ($data->image_flow_1) : ?>
																			<img width="150" src="<?= base_url("./directory/FLOW_IMG/$data->company_id/$data->image_flow_1"); ?>" />
																		<?php else : ?>
																			<i class="fa fa-upload"></i>
																			<p>Choose an image file or drag it here.</p>
																		<?php endif; ?>
																	</div>
																	<input type="file" name="img_flow[]" accept="image/*" data-index="1" class="dropzone dropzone-1">
																	<?php if ($data->image_flow_1) : ?>
																		<div class="middle d-flex justify-content-center align-items-center">
																			<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
																			<button type="button" onclick="remove_image(this)" data-id="<?= $data->id; ?>" data-img="image_flow_1" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash text-white"></i></button>
																		</div>
																	<?php endif; ?>
																	<div class="for-delete"></div>
																</div>

																<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
																	<div class="dropzone-desc">
																		<?php if ($data->image_flow_2) : ?>
																			<img width="150" src="<?= base_url("./directory/FLOW_IMG/$data->company_id/$data->image_flow_2"); ?>" />
																		<?php else : ?>
																			<i class="fa fa-upload"></i>
																			<p>Choose an image file or drag it here.</p>
																		<?php endif; ?>
																	</div>

																	<input type="file" name="img_flow[]" accept="image/*" data-index="2" class="dropzone dropzone-2">
																	<?php if ($data->image_flow_2) : ?>
																		<div class="middle d-flex justify-content-center align-items-center">
																			<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
																			<button type="button" onclick="remove_image(this)" data-id="<?= $data->id; ?>" data-img="image_flow_2" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash text-white"></i></button>
																		</div>
																	<?php endif; ?>
																	<div class="for-delete"></div>
																</div>

																<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
																	<div class="dropzone-desc">
																		<?php if ($data->image_flow_3) : ?>
																			<img width="150" src="<?= base_url("./directory/FLOW_IMG/$data->company_id/$data->image_flow_3"); ?>" />
																		<?php else : ?>
																			<i class="fa fa-upload"></i>
																			<p>Choose an image file or drag it here.</p>
																		<?php endif; ?>
																	</div>
																	<input type="file" name="img_flow[]" accept="image/*" data-index="3" class="dropzone dropzone-3">
																	<?php if ($data->image_flow_3) : ?>
																		<div class="middle d-flex justify-content-center align-items-center">
																			<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
																			<button type="button" onclick="remove_image(this)" data-id="<?= $data->id; ?>" data-img="image_flow_3" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
																		</div>
																	<?php endif; ?>
																	<div class="for-delete"></div>
																</div>

															</div>
														</div>
													</div>
												</div>

												<h5 class="mb-4">Upload File</h5>
												<div class="mb-4">
													<div class="preview-zone hidden">
														<div class="box box-solid">
															<div class="box-body d-flex justify-content-start align-items-center">
																<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
																	<div class="dropzone-desc">
																		<?php if ($data->flow_file) : ?>
																			<img width="150" src="" alt="flow-file" />
																		<?php else : ?>
																			<i class="fa fa-upload"></i>
																			<p>Choose an PDF file or drag it here.</p>
																		<?php endif; ?>
																	</div>
																	<input type="file" id="pdf-file" name="flow_file" value="<?= $data->flow_file; ?>" accept="application/pdf" data-index="1" class="dropzone dropzone-file">
																	<canvas id="pdf-preview" class="" width="150"></canvas>
																	<?php if ($data->flow_file) : ?>
																		<div class="middle d-flex justify-content-center align-items-center">
																			<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
																			<button type="button" onclick="remove_image(this)" data-id="<?= $data->id; ?>" data-img="flow_file" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
																		</div>
																	<?php endif; ?>
																	<div class="for-delete"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- MEDIA VIDEO -->
									<div class="card shadow- border-0 mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionMediaVideo" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#MediaVideo" aria-expanded="true" aria-controls="MediaVideo">
												MEDIA VIDEO
											</h4>
										</div>
										<div id="MediaVideo" class="collapse in" role="tabpanel" aria-labelledby="sectionMediaVideo">
											<div class="card-body">
												<div class="mb-3">
													<h4 class="">Embed Video Link</h4>
													<div class="mt-1 mb-2">
														<div class="row">
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fa fa-link"></i></span>
																</div>
																<input type="text" name="link_video" class="form-control" placeholder="Link Video" value="<?= html_escape($data->link_video); ?>">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- FLOW DETAIL -->
									<div class="card border-0 mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionFlowDetail" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#flowDetail" aria-expanded="true" aria-controls="flowDetail">
												PROSES TERKAIT
											</h4>
										</div>
										<div id="flowDetail" class="collapse in" role="tabpanel" aria-labelledby="sectionFlowDetail">
											<div class="card-body">
												<button type="button" class="btn btn-primary btn-sm mb-3" id="add_flow" data-id="<?= $data->id; ?>"><i class="fa fa-plus mr-2"></i>Tambah Proses</button>
												<table class="table table-sm table-bordered">
													<thead class="text-center ">
														<tr class="table-light">
															<th width="80">No</th>
															<th width="15%">PIC</th>
															<th width="">Deskripsi</th>
															<th width="35%">Dokumen Terkait</th>
															<th width="100">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php if ($detail) :
															$n = 0;
															foreach ($detail as $key => $dtl) : $n++; ?>
																<tr>

																	<td style="vertical-align:middle;" class="text-center"><?= $dtl->number; ?></td>
																	<td style="vertical-align:middle;" class="text-center"><?= $dtl->pic; ?></td>
																	<td><?= $dtl->description; ?></td>
																	<td style="vertical-align: middle;">
																		<?php $relDocs = json_decode($dtl->relate_doc); ?>
																		<?php if (is_array($relDocs)) : ?>
																			<?php foreach ($relDocs as $relDoc) { ?>
																				<span class="badge bg-success btn btn-success view-form mb-1" data-id="<?= $relDoc; ?>"><?= $ArrForms[$relDoc]->name; ?></span>
																			<?php } ?>
																		<?php endif; ?>
																		<?php $relIk = json_decode($dtl->relate_ik_doc); ?>
																		<?php if (is_array($relIk)) : ?>
																			<?php foreach ($relIk as $ik) { ?>
																				<span class="badge bg-danger btn btn-danger view-guide mb-1" data-id="<?= $ik; ?>"><?= $ArrGuides[$ik]->name; ?></span>
																			<?php } ?>
																		<?php endif; ?>
																	</td>
																	<td class="text-center" style="vertical-align: middle;">
																		<button type="button" data-proc_id="<?= $data->id; ?>" class="btn btn-warning btn-icon rounded-circle btn-sm edit_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-edit"></i></button>
																		<button type="button" class="btn btn-danger btn-icon rounded-circle btn-sm delete_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-trash"></i></button>
																	</td>
																</tr>
															<?php endforeach;
														else : ?>
															<tr>
																<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
															</tr>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<!-- APPROVAL -->
									<div class="card border-0 mb-3" style="border-radius: 10px;">
										<div class="card-header bg-light border-0 py-4 cursor-pointer" role="tab" id="sectionApproval" style="border-radius: 10px;">
											<h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accProcedure" href="#approvalDocs" aria-expanded="true" aria-controls="approvalDocs">
												DATA APPROVAL
											</h4>
										</div>
										<div id="approvalDocs" class="collapse in" role="tabpanel" aria-labelledby="sectionApproval">
											<div class="card-body">
												<div class="row">
													<div class="col-6">
														<div class="form-group row">
															<label class="col-12 col-form-label">Prepared By :</label>
															<div class="col-12">
																<select name="prepared_by" id="prepared_by" class="form-control select2">;
																	<option value=""></option>
																	<?php foreach ($users as $usr) : ?>
																		<option value="<?= $usr->id_user; ?>" <?= (isset($data) && $data->prepared_by == $usr->id_user) ? 'selected' : ''; ?>><?= $usr->full_name; ?></option>
																	<?php endforeach; ?>
																</select>
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>

														<div class="form-group">
															<h5 class="col-12 px-0">This document requires approval :</h5>
														</div>

														<div class="form-group row">
															<label class="col-lg-3">Review By</label>
															<div class="col-lg-9">
																<select name="reviewer_id" id="reviewer_id" class="form-control select2">;
																	<option value=""></option>
																	<?php foreach ($jabatan as $jbt) : ?>
																		<option value="<?= $jbt->id; ?>" <?= (isset($data) && $data->reviewer_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->name; ?></option>
																	<?php endforeach; ?>
																</select>
																<span class="form-text text-danger invalid-feedback">Review By harus di isi</span>
															</div>
														</div>

														<div class="form-group row">
															<label class="col-lg-3">Approval By</label>
															<div class="col-lg-9">
																<select name="approval_id" id="approval_id" class="form-control select2">;
																	<option value=""></option>
																	<?php foreach ($jabatan as $jbt) : ?>
																		<option value="<?= $jbt->id; ?>" <?= (isset($data) && $data->approval_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->name; ?></option>
																	<?php endforeach; ?>
																</select>
																<span class="form-text text-danger invalid-feedback">Approval By harus di isi</span>
															</div>
														</div>

														<div class="form-group row">
															<label class="col-lg-3"> Distribusi</label>
															<div class="col-lg-9">
																<select name="distribute_id[]" multiple id="distribute_id" data-placeholder="Choose an options" class="form-control select2">;
																	<option value=""></option>
																	<?php foreach ($jabatan as $jbt) : ?>
																		<option value="<?= $jbt->id; ?>" <?= isset($data) ? ((in_array($jbt->id, explode(',', $data->distribute_id))) ? 'selected' : '') : ''; ?>><?= $jbt->name; ?></option>
																	<?php endforeach; ?>
																</select>
																<span class="form-text text-danger invalid-feedback">Distribusi By harus di isi</span>
															</div>
														</div>

													</div>

													<!-- <div class="col-6">
														<div class="row">
															<label class="col-12 col-form-label">Nomor :</label>
															<div class="col-12">
																<input type="text" name="number" id="number" class="form-control" placeholder="Nomor" value="<?= isset($data) ? $data->number_publish : ''; ?>">
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>

														<div class="row">
															<label class="col-12 col-form-label">Determination Date :</label>
															<div class="col-12">
																<input type="date" name="determination_date" id="determination_date" class="form-control datepicker" placeholder="<?= date('Y-m-d'); ?>" value="<?= isset($data) ? $data->determination_date : ''; ?>">
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>

														<div class="row">
															<label class="col-12 col-form-label">About :</label>
															<div class="col-12">
																<input type="text" name="about" id="about" class="form-control" placeholder="About" value="<?= isset($data) ? $data->about : ''; ?>">
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>

														<div class="row">
															<label class="col-12 col-form-label">Status :</label>
															<div class="col-12">
																<input type="text" name="doc_status" id="doc_status" class="form-control" placeholder="Doc. Status" value="<?= isset($data) ? $data->doc_status : ''; ?>">
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>

														<div class="row">
															<label class="col-12 col-form-label">Publisher :</label>
															<div class="col-12">
																<input type="text" name="publisher" id="publisher" class="form-control" placeholder="Publisher" value="<?= isset($data) ? $data->publisher : ''; ?>">
																<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
															</div>
														</div>
													</div> -->
												</div>
											</div>
										</div>
									</div>

								</div>
								<hr>
								<div class="mb-6 d-flex justify-content-between align-items-center">
									<button class="btn btn-primary w-100px" id="save"><i class="fa fa-save"></i>Save</button>
									<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
								</div>

							</div>

							<div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="form-tab">
								<button type="button" class="btn btn-primary mb-3" id="add_form"><i class="fa fa-plus"></i> Add Form</button>
								<div id="form-data-content">
									<table class="table datatable table-bordered table-hover">
										<thead>
											<tr class="table-light">
												<th width="50" class="p-2 text-center">No</th>
												<th class="p-2 text-center">Name</th>
												<th width="100" class="p-2 text-">Link Form</th>
												<th width="50" class="p-2 text-center">File</th>
												<th width="200" class="p-2 text-center">Update</th>
												<th width="150" class="p-2 text-center">Opis</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($getForms)) : $n = 0; ?>
												<?php foreach ($getForms as $form) : $n++; ?>
													<tr>
														<td class="p-2 text-center"><?= $n; ?></td>
														<td class="p-2"><?= $form->name; ?></td>
														<td class="p-2 text-center">
															<a target="_blank" href="<?= $form->link_form; ?>">
																<span class="badge bg-primary text-white"><?= $form->link_form; ?></span>
															</a>
														</td>
														<td class="p-2 text-center">
															<?php if ($form->file_name) : ?>
																<button type="button" class="btn p-0 btn-sm btn-link text-success btn-icon view-form" data-id="<?= $form->id; ?>"><i class="fas fa-file-pdf text-success"></i></button>
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

							<div class="tab-pane fade" id="guides" role="tabpanel" aria-labelledby="guides-tab">
								<button type="button" class="btn btn-primary mb-3" id="add_guide"><i class="fa fa-plus"></i> Add IK</button>
								<div id="guide-data-content">
									<table class="table datatable table-bordered table-hover">
										<thead>
											<tr class="table-light">
												<th width="50" class="p-2 text-center">No</th>
												<th class="p-2 text-center">Name</th>
												<th width="50" class="p-2 text-center">File</th>
												<th width="200" class="p-2 text-center">Update</th>
												<th width="150" class="p-2 text-center">Opis</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($getGuides)) : $n = 0; ?>
												<?php foreach ($getGuides as $ik) : $n++; ?>
													<tr>
														<td class="p-2 text-center"><?= $n; ?></td>
														<td class="p-2"><?= $ik->name; ?></td>
														<td class="p-2 text-center">
															<?php if ($ik->file_name) : ?>
																<button type="button" class="btn p-0 btn-sm btn-link text-success btn-icon view-guide" data-id="<?= $ik->id; ?>"><i class="fas fa-file-pdf text-success"></i></button>
															<?php else : ?>
																<i class="fa fa-times text-danger"></i>
															<?php endif; ?>
														</td>
														<td class="p-2 text-center"><?= $ik->created_at; ?></td>
														<td class="p-2 text-center">
															<button type="button" class="btn btn-xs btn-icon btn-warning edit-guide" data-id="<?= $ik->id; ?>"><i class="fa fa-edit"></i></button>
															<button type="button" class="btn btn-xs btn-icon btn-danger delete-guide" data-id="<?= $ik->id; ?>"><i class="fa fa-trash"></i></button>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="tab-pane fade" id="records" role="tabpanel" aria-labelledby="records-tab">
								<div id="data-records">
									<button type="button" class="btn btn-warning mb-3" id="add_folder"><i class="fa fa-folder-plus"></i> Add Folder</button>
									<button type="button" class="btn btn-primary mb-3" disabled id="add_record"><i class="fa fa-plus"></i> Add Record</button>
									<button type="button" class="btn btn-success btn-icon mb-3" id="refresh" title="Refresh"><i class="fa fa-sync-alt"></i></button>
									<hr>
									<input type="hidden" id="refresh_id" value="">
									<table class="table datatable table-hover">
										<thead>
											<tr>
												<th class="py-0">File or Folder Name</th>
												<th class="py-0 text-right">Last Update</th>
												<th class="py-0 text-center">Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($getRecords)) : $n = 0; ?>
												<?php foreach ($getRecords as $form) : $n++; ?>
													<tr class="">
														<td class="py-1">
															<a href="javascript:void(0)" data-id="<?= $form->id; ?>" class="cursor-pointer folder text-dark">
																<div class="d-flex justify-content-start align-items-center">
																	<i class="fa fa-folder text-warning fa-3x mr-3"></i>
																	<span class="text-name mt-3 h5"><?= $form->name; ?></span>
																</div>
															</a>
														</td>
														<td class="py-1 text-right">
															<div class="d-flex justify-content-end align-items-center">
																<h6 class="mt-4 ml-4"><?= $form->created_at; ?></h6>
															</div>
														</td>
														<td class="py-1 text-right" width="135">
															<div class="btn-opsi mt-1">
																<?php if ($form->flag_type == 'FILE') : ?>
																	<button type="button" class="btn btn-sm btn-icon btn-default view-record" title="View Document" data-id="<?= $form->id; ?>"><i class="fas fa-file-pdf  text-primary"></i></button>
																	<button type="button" class="btn btn-sm btn-icon btn-white edit-record" title="Edit Document" data-id="<?= $form->id; ?>"><i class="fa fa-edit text-warning"></i></button>
																<?php else : ?>
																	<button type="button" class="btn btn-sm btn-icon btn-white edit-folder" title="Edit Folder" data-id="<?= $form->id; ?>"><i class="fa fa-edit text-warning"></i></button>
																<?php endif; ?>
																<button type="button" class="btn btn-sm btn-icon btn-white delete-record" title="Delete" data-id="<?= $form->id; ?>"><i class="fa fa-trash text-danger"></i></button>
															</div>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php else : ?>
												<tr>
													<td colspan="3" class="text-center py-3">
														<h5 class="text-light-secondary">~ No data available~ </h5>
													</td>
												</tr>
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
				<div id="record-content">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		let id = '<?= $data->id; ?>'
		$.getJSON(siteurl + active_controller + 'load_file_flow/' + id, function(result) {
			var data = result.data
			var d = ''
			const url = siteurl + 'directory/FLOW_FILE/' + data.company_id + '/' + data.flow_file;
			console.log(url);
			if (!data.flow_file) {
				$("#pdf-preview").css('display', 'none');
			}
			if (data.flow_file) {
				fetch(url)
					.then((res) => res.blob())
					.then((myBlob) => {
						// console.log(myBlob);
						// logs: Blob { size: 1024, type: "image/jpeg" }
						myBlob.name = data.flow_file;
						myBlob.lastModified = new Date();
						// console.log(myBlob instanceof File);
						// logs: false
						_OBJECT_URL = URL.createObjectURL(myBlob)
						// console.log(_OBJECT_URL);
						showPDF(_OBJECT_URL);
					});
			}
		});


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


		// tinymce.init({
		// 	selector: 'textarea',
		// 	height: 100,
		// 	resize: true,
		// 	fontsize_formats: "6pt 8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt",
		// 	plugins: 'autoresize autosave emoticons preview importcss searchreplace autolink autosave save ' +
		// 		'directionality  visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
		// 	toolbar: 'restoredraft preview searchreplace | undo redo | blocks ' +
		// 		'fontsizeselect bold italic backcolor forecolor | alignleft aligncenter ' +
		// 		'alignright alignjustify | template codesample bullist numlist outdent indent | link image ' +
		// 		'table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol' +
		// 		'removeformat emoticons | help',
		// 	content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
		// 	autoresize_bottom_margin: 50,
		// 	link_default_protocol: 'https'
		// 	// 	content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
		// });

		$(document).on('click', '#add_flow', function() {
			const proc_id = $(this).data('id')
			const url = siteurl + active_controller + 'add_flow/' + proc_id
			$('#content_modal').load(url)
			$('#modelId').modal('show')
		})

		$(document).on('click', '.edit_flow', function() {
			let id = $(this).data('id')
			const proc_id = $(this).data('proc_id')
			const url = siteurl + active_controller + 'edit_flow/' + proc_id + "/" + id
			$('#content_modal').load(url)
			$('#modelId').modal('show')
		})

		$(document).on('click', '.delete_flow', function() {
			let id = $(this).data('id')
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
						url: siteurl + active_controller + 'delete_flow/' + id,
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
									btn.parents('tr').fadeOut('1500')
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


		/* SAVE */
		$(document).on('submit', '#form-procedure', function(e) {
			e.preventDefault();
			let formdata = new FormData($(this)[0])
			let btn = $('.save')

			$('#description').removeClass('is-invalid')
			$('#prepared_by').removeClass('is-invalid')
			$('#approval_id').removeClass('is-invalid')
			$('#reviewer_id').removeClass('is-invalid')
			$('#distribute_id').removeClass('is-invalid')
			$('#image').removeClass('is-invalid')

			const description = $('#description').val();
			const prepared_by = $('#prepared_by').val();
			const reviewer_id = $('#reviewer_id').val();
			const approval_id = $('#approval_id').val();
			const distribute_id = $('#distribute_id').val();
			const id_master = $('#id_master').val();
			const image = $('#image').val();
			const parent_id = $('#parent_id').val();

			// console.log(description);
			if (prepared_by !== undefined && (prepared_by == '' || prepared_by == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty User Prepared, please input User Prepared  first.....',
					icon: "warning"
				});
				$('#prepared_by').addClass('is-invalid')
				$('#approvalDocs').addClass('show');
				return false;
			}

			// if ((reviewer_id == '' && reviewer_id != undefined) || (reviewer_id == null && reviewer_id != undefined)) {
			// 	Swal.fire({
			// 		title: "Error Message!",
			// 		text: 'Empty reviewer, please input reviewer first.....',
			// 		icon: "warning"
			// 	});
			// 	$('#reviewer_id').addClass('is-invalid')
			// 	$('#approvalDocs').addClass('show');
			// 	return false;
			// }

			// if ((approval_id == '' && approval_id != undefined) || (approval_id == null && approval_id != undefined)) {
			// 	Swal.fire({
			// 		title: "Error Message!",
			// 		text: 'Empty approval, please input approval first!',
			// 		icon: "warning"
			// 	});
			// 	$('#approval_id').addClass('is-invalid')
			// 	$('#approvalDocs').addClass('show');
			// 	return false;
			// }


			var validate = true
			$('input[name="img_flow[]"]').each(function() {
				console.log(this.files[0]);
				if (this.files[0]) {
					size = this.files[0].size
					if (size > 5 * 1024 * 1024) {
						Swal.fire('Warning', 'ukuran file lebih dari 5MB', 'warning', 3000)
						validate = false
					}
				}
			});

			if (!validate) {
				return false
			}
			// console.log(img);
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
							location.reload()
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



			const group_procedure = $('#group_procedure').val();
			const description = $('#description').val();
			const prepared_by = $('#prepared_by').val();
			const reviewer_id = $('#reviewer_id').val();
			const approval_id = $('#approval_id').val();
			const distribute_id = $('#distribute_id').val();
			const id_master = $('#id_master').val();
			const image = $('#image').val();
			const parent_id = $('#parent_id').val();
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
			if (scope !== undefined && (scope == '' || scope == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Ruang Lingkup, please input Ruang Lingkup first.....',
					icon: "warning"
				});
				$('#scope').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
			if (object !== undefined && (object == '' || object == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Objective Process, please input Objective Process first.....',
					icon: "warning"
				});
				$('#object').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
			if (performance !== undefined && (performance == '' || performance == null)) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Performa Indikator, please input Performa Indikator first.....',
					icon: "warning"
				});
				$('#performance').addClass('is-invalid')
				// $('#approvalDocs').addClass('show');
				return false;
			}
			if (description !== undefined && (description == '' || description == null)) {
				$('#description').addClass('is-invalid')
				return false;
			}
			if (link_form !== undefined && (link_form == '' || name == null)) {
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


		/* UPLOAD IK */

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

		$(document).on('click', '#add_guide', function() {
			const id = $('#procedure_id').val() || null;
			$('#modalRecord').modal('show')
			// $('.modal-dialog').css('max-width', '70%')
			$('.modal-title').text('Add IK')
			$('#record-content').load(siteurl + active_controller + 'upload_guide/' + id)

		})

		$(document).on('click', '.edit-guide', function() {
			const id = $(this).data('id') || null;
			const procedure_id = $('#procedure_id').val() || null;
			$('#modalRecord').modal('show')
			$('.modal-title').text('Edit IK')
			$('#record-content').load(siteurl + active_controller + 'edit_guide/' + id)

		})

		$(document).on('click', '.delete-guide', function() {
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
						url: siteurl + active_controller + 'delete_guide/' + id,
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

		$(document).on('change', 'input[name="forms[flag_record]"]:checked', function() {
			const mode = $(this).val()

			if (mode == 'Y') {
				$('#file-type').html('')
			} else {
				const html = `
			<div class="form-group row">
				<label class="col-lg-3 col-form-label text-lg-right">Review By :</label>
				<div class="col-lg-9">
					<select name="reviewer_id" id="reviewer_id" class="form-control select2">;
						<option value=""></option>
						<?php foreach ($jabatan as $jbt) : ?>
							<option value="<?= $jbt->id; ?>" <?= (isset($file) && $file->reviewer_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->name; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="form-text text-danger invalid-feedback">Review By harus di isi</span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label text-lg-right">Approval By :</label>
				<div class="col-lg-9">
					<select name="approval_id" id="approval_id" class="form-control select2">;
						<option value=""></option>
						<?php foreach ($jabatan as $jbt) : ?>
							<option value="<?= $jbt->id; ?>" <?= (isset($file) && $file->approval_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->name; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="form-text text-danger invalid-feedback">Approval By harus di isi</span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label text-lg-right">Distribusi :</label>
				<div class="col-lg-9">
					<select name="distribute_id[]" multiple id="distribute_id" data-placeholder="Choose an options" class="form-control select2">;
						<option value=""></option>
						<?php foreach ($jabatan as $jbt) : ?>
							<option value="<?= $jbt->id; ?>" <?= isset($file) ? ((in_array($jbt->id, explode(',', $file->distribute_id))) ? 'selected' : '') : ''; ?>><?= $jbt->name; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="form-text text-danger invalid-feedback">Distribusi By harus di isi</span>
				</div>
			</div>`
				$('#file-type').html(html)
				$('.select2').select2({
					placeholder: 'Choose an options',
					width: '100%',
					allowClear: true
				})

			}

		})

		/* SAVE */
		$(document).on('click', '#save-guide', function() {
			const pro_id = $('#procedure_id').val() || '';
			let formdata = new FormData($('#form-records')[0])
			let btn = $('.save')

			$('#description').removeClass('is-invalid')
			$('#prepared_by').removeClass('is-invalid')
			$('#approval_id').removeClass('is-invalid')
			$('#reviewer_id').removeClass('is-invalid')
			$('#distribute_id').removeClass('is-invalid')
			$('#image').removeClass('is-invalid')

			const description = $('#description').val();
			const prepared_by = $('#prepared_by').val();
			const reviewer_id = $('#reviewer_id').val();
			const approval_id = $('#approval_id').val();
			const distribute_id = $('#distribute_id').val();
			const id_master = $('#id_master').val();
			const image = $('#image').val();
			const parent_id = $('#parent_id').val();

			if (description !== undefined && (description == '' || description == null)) {
				$('#description').addClass('is-invalid')
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
				url: siteurl + active_controller + 'saveGuide',
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
						})
						$('.close-btn').click();
						reload_guides(pro_id)
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


		/* UPLOAD RECORDS */

		$(document).on('click', '.view-record', function() {
			const id = $(this).data('id')
			if (id) {
				$('.modal-title').html('View Records')
				$('#content_modal').load(siteurl + active_controller + 'view_record/' + id)
				$('#modelId').modal('show')
			} else {
				Swal.fire('Warning!!', 'Not available data to process', 'waring', 2000);
			}
		})

		$(document).on('click', '#add_record', function() {
			const id = $('#procedure_id').val() || null;
			const parent_id = $('#refresh_id').val() || null
			$('#modalRecord').modal('show')
			$('.modal-title').text('Add Records')
			$('#record-content').load(siteurl + active_controller + 'upload_record/' + id + "/" + parent_id)
		})

		$(document).on('click', '.edit-record', function() {
			const id = $(this).data('id') || null;
			const procedure_id = $('#procedure_id').val() || null;
			$('#modalRecord').modal('show')
			$('.modal-title').text('Edit Records')
			$('#record-content').load(siteurl + active_controller + 'edit_record/' + id)
		})

		$(document).on('click', '#save-record', function() {
			let formdata = new FormData($('#form-records')[0])
			let btn = $('.save')
			$('#description').removeClass('is-invalid')
			$('#image').removeClass('is-invalid')
			const description = $('#description').val();
			const image = $('#image').val();

			if (description !== undefined && (description == '' || description == null)) {
				$('#description').addClass('is-invalid')
				return false;
			}

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
				url: siteurl + active_controller + 'saveFileRecord',
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
						})
						$('#modalRecord').modal('hide')
						$('#refresh').click();
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

		$(document).on('click', '.delete-record', function() {
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
						url: siteurl + active_controller + 'delete_record/' + id,
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
								$(btn).parents('tr').fadeOut(1000);
								setTimeout(function() {
									$(btn).parents('tr').remove();
								}, 1200)

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

		/* FOLDER RECORDS */

		$(document).on('click', '#add_folder', function() {
			$('#modelId').modal('show')
			$('.modal-title').text('Add Folder')
			$('.modal-dialog').css('max-width', '50%')
			$('#content_modal').html(`
			<div class="modal-body row">
				<div class="col-12">
					<div class="form-group">
						<label>New Folder</label>
						<input type="text" class="form-control" placeholder="Folder Name" id="folder_name" name="folder_name">
						<span class="form-text text-danger invalid-feedback">Nama folder harus di isi</span>
					</div>
					<div class="d-flex justify-content-between">
						<button type="button" class="btn btn-success save-folder"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
					</div>
				</div>
			</div>`);
		})

		$(document).on('click', '.edit-folder', function() {
			const id = $(this).data('id')
			const name = $(this).parents('tr').find('.text-name').text()
			$('#modelId').modal('show')
			$('.modal-title').text('Add Folder')
			$('.modal-dialog').css('max-width', '50%')
			$('#content_modal').html(`
			<div class="modal-body row">
				<div class="col-12">
					<div class="form-group">
						<label>New Folder</label>
						<input type="hidden" class="form-control" placeholder="Folder Name" id="folder_id" name="folder_id" value="` + id + `">
						<input type="text" class="form-control" placeholder="Folder Name" id="folder_name" name="folder_name" value="` + name + `">
						<span class="form-text text-danger invalid-feedback">Nama folder harus di isi</span>
					</div>
					<div class="d-flex justify-content-between">
						<button type="button" class="btn btn-success save-folder"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
					</div>
				</div>
			</div>`);
		})

		$(document).on('click', '.save-folder', function() {
			const folder_id = $('#folder_id').val() || ''
			const procedure_id = $('#procedure_id').val()
			const parent_id = $('#refresh_id').val() || ''
			const btn = $(this)
			const folder_name = $('#folder_name').val()

			if (folder_name !== undefined && (folder_name == '' || folder_name == null)) {
				$('#folder_name').addClass('is-invalid')
				Swal.fire({
					title: "Error Message!",
					text: 'Empty Folder name, please input folder name first.....',
					icon: "warning"
				});

				return false;
			}

			$.ajax({
				url: siteurl + active_controller + 'saveFolder',
				data: {
					folder_id,
					procedure_id,
					parent_id,
					folder_name
				},
				type: 'POST',
				dataType: 'JSON',
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm mr-3"></i> Loading...')
				},
				complete: function() {
					btn.attr('disabled', false)
					btn.html('<i class="fa fa-save"></i> Save')
				},
				success: function(result) {
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							icon: 'success',
							text: result.msg,
							timer: 2000
						}).then(function() {
							$('#modelId').modal('hide')
							$('#refresh').click()
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

		$(document).on('click', '.folder', function() {
			const procedure_id = $('#procedure_id').val()
			const folder_id = $(this).data('id')
			$('#refresh_id').val(folder_id) || null
			if (folder_id) {
				$('#data-records').load(siteurl + active_controller + 'records_folder/' + folder_id + "/" + procedure_id)
			}
		})

		$(document).on('click', '.up_folder', function() {
			const procedure_id = $('#procedure_id').val()
			const parent_id = $(this).data('id') || null
			$('#refresh_id').val(parent_id) || null
			$('#data-records').load(siteurl + active_controller + 'up_folder/' + parent_id + "/" + procedure_id)
		})

		$(document).on('click', '#refresh', function() {
			const procedure_id = $('#procedure_id').val()
			const refresh_id = $('#refresh_id').val() || null
			if (refresh_id) {
				$('#data-records').load(siteurl + active_controller + 'refresh/' + refresh_id + "/" + procedure_id)
			} else {
				$('#data-records').load(siteurl + active_controller + 'refresh/' + refresh_id + "/" + procedure_id)
			}
		})

	})


	function reload_form(pro_id) {
		$('#form-data-content').load(siteurl + active_controller + 'loadDataForm/' + pro_id)
	}

	function reload_guides(pro_id) {
		$('#guide-data-content').load(siteurl + active_controller + 'loadDataGuide/' + pro_id)
	}

	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			index = $(input).data('index')

			reader.onload = function(e) {
				console.log(e)
				var htmlPreview = '<img width="150" src="' + e.target.result + '" />';

				var overlay = `<div class="middle d-flex justify-content-center align-items-center">
					<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
					<button type="button" onclick="remove_image(this)" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash text-white"></i></button>
					</div>`;
				var wrapperZone = $(input).parent();
				var previewZone = $(input).parent().parent().find('.preview-zone');
				var boxZone = $(input).parent().find('.dropzone-desc');

				wrapperZone.removeClass('dragover');
				previewZone.removeClass('hidden');
				boxZone.html('');
				boxZone.append(htmlPreview);
				wrapperZone.find('.middle').remove();
				wrapperZone.append(overlay);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	function reset(e) {
		// e.wrap('<form>').closest('form').get(0).reset();
		// e.unwrap();
	}

	function remove_image(e) {
		let id = $(e).data('id')
		let dataImg = $(e).data('img')
		Swal.fire({
			title: 'Are you sure to delete this data?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#ee2d41',
			confirmButtonText: 'Yes, Delete <i class="fa fa-trash text-white"></i>',
		}).then((value) => {
			if (value.isConfirmed) {
				if (id && dataImg) {
					$.ajax({
						url: siteurl + active_controller + 'delete_img/' + id + '/' + dataImg,
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

								let srcFile = $(e).parent().parent().find('.dropzone-desc').find('img').attr('src')
								$(e).parent().parent().find('input.dropzone').val('');
								$(e).parent().parent().find('input.dropzone').off();
								$(e).parent().parent().find('.dropzone-desc').empty().append('<i class="fa fa-upload"></i><p> Choose an image file or drag it here. </p>');
								// $(e).parent().parent().find('.for-delete').empty().append('<input type="hidden" name="delete_image[]" value="' + srcFile + '">');
								$(e).parent().remove();

							} else {
								Swal.fire('Warning', "Can't delete data. Please try again!", 'warning', 2000)
							}
						},
						error: function() {
							Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 3000)
						}
					})
				} else {
					let srcFile = $(e).parent().parent().find('.dropzone-desc').find('img').attr('src')
					$(e).parent().parent().find('input.dropzone').val('');
					$(e).parent().parent().find('input.dropzone').off();
					$(e).parent().parent().find('.dropzone-desc').empty().append('<i class="fa fa-upload"></i><p> Choose an image file or drag it here. </p>');
					// $(e).parent().parent().find('.for-delete').empty().append('<input type="hidden" name="delete_image[]" value="' + srcFile + '">');
					$(e).parent().remove();
				}
			}
		})

	}



	var _PDF_DOC,
		_CANVAS = document.querySelector('#pdf-preview'),
		_OBJECT_URL;

	function showPDF(pdf_url) {

		PDFJS.getDocument({
			url: pdf_url
		}).then(function(pdf_doc) {
			_PDF_DOC = pdf_doc;

			// Show the first page
			showPage(1);

			// destroy previous object url
			URL.revokeObjectURL(_OBJECT_URL);
		}).catch(function(error) {
			// trigger Cancel on error
			$("#cancel-pdf").click();

			// error reason
			alert(error.message);
		});;
	}

	function showPage(page_no) {
		var _CANVAS = document.querySelector('#pdf-preview');
		// fetch the page
		// console.log(page_no);
		// console.log(_PDF_DOC.getPage(page_no));
		_PDF_DOC.getPage(page_no).then(function(page) {
			// set the scale of viewport
			var scale_required = _CANVAS.width / page.getViewport(1).width;

			// get viewport of the page at required scale
			var viewport = page.getViewport(scale_required);

			// set canvas height
			_CANVAS.height = viewport.height;

			var renderContext = {
				canvasContext: _CANVAS.getContext('2d'),
				viewport: viewport
			};

			// render the page contents in the canvas
			page.render(renderContext).then(function() {
				$("#pdf-preview").css('display', 'inline-block');
				$("#pdf-loader").css('display', 'none');
			});
		});
	}

	/* Selected File has changed */
	$(document).on('change', "#pdf-file", function() {
		// user selected file
		console.log($(this));
		var file = $(this)[0].files[0];

		// allowed MIME types
		var mime_types = ['application/pdf'];

		// Validate whether PDF
		if (mime_types.indexOf(file.type) == -1) {
			alert('Error : Incorrect file type');
			return;
		}

		// validate file size
		if (file.size > 10 * 1024 * 1024) {
			alert('Error : Exceeded size 10MB');
			return;
		}

		// validation is successful

		// hide upload dialog button
		$("#upload-dialog").css('display', 'none');

		// set name of the file
		// $("#pdf-name").text(file.name);
		// $("#pdf-name").css('display', 'inline-block');

		// show cancel and upload buttons now
		$("#cancel-pdf").removeClass('d-none');
		$("#pdf-preview").removeClass('d-none');
		$("#remove-file").removeClass('d-none');
		// $("#upload-button").css('display', 'inline-block');

		// Show the PDF preview loader
		$("#pdf-loader").css('display', 'inline-block');

		// object url of PDF 
		// console.log(file);
		_OBJECT_URL = URL.createObjectURL(file)

		// send the object url of the pdf to the PDF preview function
		showPDF(_OBJECT_URL);
	});

	/* Reset file input */
	$(document).on('click', "#cancel-pdf,.remove-image", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		// $("#pdf-preview").css('display', 'none');
		$("#pdf-preview").addClass('d-none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});

	$(document).on('click', "#remove-file", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');
		$("#remove-document").val('x');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		$("#pdf-preview").addClass('d-none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});
</script>