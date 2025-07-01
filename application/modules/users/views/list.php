<div class="container mt-10">
	<div class="card">
		<div class="card-header py-3">
			<div class="d-flex justify-content-between align-items-center">
				<h3 for=""><i class="fa fa-users mr-2"></i>Users</h3>
				<a href="<?= site_url('users/setting/create') ?>" class="shadow-sm shadow-primary btn btn-success" title="Add New User"><i class="fa fa-plus"></i>Add New User</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="card-body">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-pills border-0 mb-5" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="act-tab" data-toggle="tab" data-target="#act" type="button" role="tab" aria-controls="home" aria-selected="true">Active</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="nac-tab" data-toggle="tab" data-target="#nac" type="button" role="tab" aria-controls="nac" aria-selected="false">Non Active</button>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="act" role="tabpanel" aria-labelledby="act-tab">
					<div class="table-responsive">
						<table id="example1" class="table table-hover table-condensed">
							<thead>
								<tr class="table-secondary">
									<th width="20">No.</th>
									<th width="50">Picture</th>
									<th><?= lang('users_username') ?></th>
									<th><?= lang('users_nm_lengkap') ?></th>
									<th><?= lang('users_email') ?></th>
									<!-- <th><?= lang('users_alamat') ?></th> -->
									<!-- <th><?= lang('users_kota') ?></th> -->
									<th><?= lang('users_hp') ?></th>
									<th width="80"><?= lang('users_st_aktif') ?></th>
									<th width="50" class="text-center">Opsi</th>
								</tr>
							</thead>

							<tbody>
								<?php $n = 0;
								foreach ($userActive as $record) : $n++; ?>
									<tr>
										<td class="text-center"><?= $n; ?></td>
										<td class="text-left">
											<img src="<?= base_url('assets/img/avatar/' . (($record->photo) ?: 'no-user.jpg')); ?>" alt="<?= $record->full_name; ?>" width="50px" class="img-thumbnail">
										</td>
										<td><?= $record->username ?></td>
										<td><?= $record->full_name ?></td>
										<td><?= $record->email ?></td>
										<!-- <td><?= $record->address ?></td> -->
										<!-- <td><?= $record->city ?></td> -->
										<td><?= $record->phone ?></td>
										<td><?= ($record->status == 'ACT') ? "<label class='label label-inline label-primary'>Active</label>" : "<label class='label label-danger label-inline'>Non Active</label>" ?></td>
										<td class="text-center">
											<?php if ($record->id_user != '1') : ?>
												<a class="btn btn-xs btn-icon btn-warning" href="<?= site_url('users/setting/edit/' . $record->id_user); ?>" data-toggle="tooltip" data-placement="left" title="Edit User"><i class="fa fa-pen"></i></a>
												<a class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="right" title="Delete User"><i class="fa fa-trash"></i></a>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="nac" role="tabpanel" aria-labelledby="nac-tab">
					<div class="table-responsive">
						<table id="example2" class="table table-hover table-condensed">
							<thead>
								<tr class="table-secondary">
									<th width="20">No.</th>
									<th width="100">Picture</th>
									<th><?= lang('users_username') ?></th>
									<th><?= lang('users_nm_lengkap') ?></th>
									<th><?= lang('users_email') ?></th>
									<!-- <th><?= lang('users_alamat') ?></th> -->
									<!-- <th><?= lang('users_kota') ?></th> -->
									<th><?= lang('users_hp') ?></th>
									<th width="80"><?= lang('users_st_aktif') ?></th>
									<th width="50" class="text-center">Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $n = 0;
								foreach ($userNonActive as $record) : $n++; ?>
									<tr>
										<td class="text-center"><?= $n; ?></td>
										<td class="">
											<img src="<?= base_url('assets/img/avatar/' . (($record->photo) ?: 'no-user.jpg')); ?>" alt="<?= $record->full_name; ?>" width="50px" class="img-thumbnail">
										</td>
										<td><?= $record->username ?></td>
										<td><?= $record->full_name ?></td>
										<td><?= $record->email ?></td>
										<!-- <td><?= $record->address ?></td> -->
										<!-- <td><?= $record->city ?></td> -->
										<td><?= $record->phone ?></td>
										<td><?= ($record->status == 'ACT') ? "<label class='label label-inline label-primary'>Active</label>" : "<label class='label label-danger label-inline'>Non Active</label>" ?></td>
										<td class="text-center">
											<a class="btn btn-xs btn-icon btn-warning" href="<?= site_url('users/setting/edit/' . $record->id_user); ?>" data-toggle="tooltip" data-placement="left" title="Edit User"><i class="fa fa-pen"></i></a>
											<a class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-placement="right" title="Delete User"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<!-- /.box-body -->
	</div>
</div>

<!-- page script -->
<script>
	$(function() {
		$(document).ready(function() {
			$('button[data-toggle="tab"]').on('shown.bs.tab', function(e) {
				$.fn.dataTable.tables({
					visible: true,
					api: true
				}).columns.adjust();
			});

			$('#example1,#example2').DataTable({
				scrollCollapse: true,
				responsive: true
			});
		});
	});
</script>