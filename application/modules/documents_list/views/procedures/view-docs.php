<table class="table table-bordered rounded-lg mb-6">
	<tr>
		<th class="table-dark text-center">
			<h1><?= $docs->name; ?></h1>
		</th>
	</tr>
	<tr>
		<td class="py-6">
			<h2 class="fw-extra-bold"><strong><u>Tujuan</u></strong></h2>
			<di class="font-size-h4">
				<?= $docs->object; ?>
			</di>
		</td>
	</tr>
	<tr>
		<td class="py-6">
			<h2 class="fw-extra-bold"><strong><u>RUANG LINGKUP</u></strong></h2>
			<di class="font-size-h4">
				<?= $docs->scope; ?>
			</di>
		</td>
	</tr>
	<tr>
		<td class="py-6">
			<h2 class="fw-extra-bold"><strong><u>DEFINISI</u></strong></h2>
			<di class="font-size-h4">
				<?= $docs->define; ?>
			</di>
		</td>
	</tr>
	<tr>
		<td class="py-6">
			<h2 class="fw-extra-bold"><strong><u>Performa Indikator</u></strong></h2>
			<di class="font-size-h4">
				<?= $docs->performance; ?>
			</di>
		</td>
	</tr>
</table>
<table class="table table-bordered mb-6">
	<thead>
		<tr class="table-secondary">
			<th>
				<h3>FLOW PROCEDURE</h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($docs->image_flow_1) : ?>
			<tr>
				<td>
					<img src="<?= base_url("/image_flow/$docs->image_flow_1"); ?>" alt="image_flow_1" class="img-fluid">
				</td>
			</tr>
		<?php endif; ?>
		<?php if ($docs->image_flow_2) : ?>
			<tr>
				<td>
					<img src="<?= base_url("/image_flow/$docs->image_flow_2"); ?>" alt="image_flow_2" class="img-fluid">
				</td>
			</tr>
		<?php endif; ?>
		<?php if ($docs->image_flow_3) : ?>
			<tr>
				<td>
					<img src="<?= base_url("/image_flow/$docs->image_flow_3"); ?>" alt="image_flow_3" class="img-fluid">
				</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

<!-- VIDEO -->
<table class="table table-bordered mb-6">
	<thead>
		<tr class="table-secondary">
			<th>
				<h3>VIDEO</h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($docs->link_video) : ?>
			<tr>
				<td class="text-center">
					<?= $docs->link_video; ?>
				</td>
			</tr>
		<?php endif; ?>
</table>

<!-- FLOW -->
<table class="table table-bordered">
	<thead>
		<tr class="table-secondary">
			<th colspan="4">
				<h4>DETAIL FLOW PROCEDURE</h4>
			</th>
		</tr>
		<tr>
			<th class="text-center">No.</th>
			<th class="text-center">PIC/TANGGUNG JAWAB</th>
			<th class="text-center">DESKRIPSI</th>
			<th class="text-center">DOKUMEN TERKAIT</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($detail) :
			foreach ($detail as $dtl) : ?>
				<tr>
					<td class="text-center"><?= $dtl->number; ?></td>
					<td class="text-center"><?= $dtl->pic; ?></td>
					<td><?= $dtl->description; ?></td>
					<td class="">
						<?php $relDocs = json_decode($dtl->relate_doc); ?>
						<?php if (is_array($relDocs)) : ?>
							<?php foreach ($relDocs as $relDoc) { ?>
								<span class="badge bg-success btn btn-success view-form-2 mb-1" data-id="<?= $relDoc; ?>"><?= $ArrForms[$relDoc]->name; ?></span>
							<?php } ?>
						<?php else : ?>
							<?= $dtl->relate_doc; ?>
						<?php endif; ?>
					</td>
				</tr>
		<?php endforeach;
		endif; ?>
	</tbody>
</table>

<!-- APPROVAL -->
<table class="table table-bordered">
	<thead>
		<tr class="table-secondary">
			<th>
				<h3>DATA APPROVAL</h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table class="table table-bordered table-sm">
					<tr>
						<th width="180">Prepared By</th>
						<td><?= ($docs->reviewer_id) ? $ArrUsr[$docs->prepared_by]->full_name : '-'; ?></td>
					</tr>
					<tr>
						<th style="vertical-align: middle;" rowspan="2">Review By</th>
						<td><?= ($docs->reviewer_id) ? $ArrJab[$docs->reviewer_id]->nm_jabatan : '-'; ?></td>
					</tr>
					<tr>
						<td><?= ($docs->reviewed_by) ? $ArrUsr[$docs->reviewed_by]->full_name : '-'; ?></td>
					</tr>
					<tr>
						<th style="vertical-align: middle;" rowspan="2">Approval By</th>
						<td><?= ($docs->approval_id) ? $ArrJab[$docs->approval_id]->nm_jabatan : '-'; ?></td>
					</tr>
					<tr>
						<td><?= ($docs->approved_by) ? $ArrUsr[$docs->approved_by]->full_name : '-'; ?></td>
					</tr>
					<tr>
						<th style="vertical-align: middle;">Distribution By</th>
						<td>
							<?php $lsJab = explode(',', $docs->distribute_id);
							foreach ($lsJab as $jab) {
								echo ($jab) ? $ArrJab[$jab]->nm_jabatan . "<br>" : '-';
							}
							?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>