<style>
	span p {
		margin-bottom: 0px;
	}
</style>

<div class="row mb-0">
	<label for="exampleInputEmail1" class="col-2 col-form-label">Nama Proses</label>
	<div class="col-3">
		<label for="exampleInputEmail1" class="col-form-label">: <?= $Data->name; ?></label>
	</div>
</div>
<div class="row mb-0">
	<label for="exampleInputEmail1" class="col-2 col-form-label">Tahun</label>
	<div class="col-3">
		<label for="exampleInputEmail1" class="col-form-label">: <?= $Data->year; ?></label>
	</div>
</div>
<div class="row mb-0">
	<label for="exampleInputEmail1" class="col-2 col-form-label">Nomor</label>
	<div class="col-3">
		<label for="exampleInputEmail1" class="col-form-label">: <?= $Data->number; ?></label>
	</div>
</div>
<hr>
<table class="table table-sm table-bordered table-stiped">
	<thead>
		<tr>
			<th>No</th>
			<th width="150">Pasal</th>
			<th width="400">Desc. Indonesian</th>
			<th width="400">Desc. English</th>
			<th>Proses Terkait</th>
			<th width="150">Dokumen Lain</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$n = 0;
		foreach ($Detail as $dtl) : $n++; ?>
			<tr>
				<td><?= $n; ?></td>
				<td><?= $dtl->chapter; ?></td>
				<td><?= ($dtl->desc_indo); ?></td>
				<td><?= ($dtl->desc_eng); ?></td>
				<td>
					<?php
					if (isset($Procedure[$dtl->id])) {
						$explode = explode(',', $Procedure[$dtl->id]);
						if (isset($explode) && $explode) {
							foreach ($explode as $exp) {
								// echo isset($list_procedure[$exp]) ? (($ArrProcedures[$exp] == 'PUB') ? "<a href='" . base_url($this->uri->segment(1) . '/download/' . $exp) . "'>" . $list_procedure[$exp] . "</a>" : $list_procedure[$exp]) : '';
								echo isset($list_procedure[$exp]) ? $list_procedure[$exp]: '';
								// echo "<button type='button' class='btn btn-xs btn-primary'>sdsd</button>";
							}
						}
					}
					?>
				</td>
				<td><?= isset($other_docs[$dtl->id]) ? ($other_docs[$dtl->id]) : ''; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>