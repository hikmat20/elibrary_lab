<div class="row mb-3">
	<label for="exampleInputEmail1" class="col-2 col-form-label"></label>
	<div class="col-12">
		<?php if ($ArrStd) : ?>
			<?php foreach ($ArrStd as $std) : ?>

				<h3>Standard : <?= $std->name; ?></h3>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th width="100">Pasal</th>
							<th>Desc. Indonesian</th>
							<th>Desc. English</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($ArrData['standards'][$std->requirement_id]) : ?>
							<?php $n = 0;
							foreach ($ArrData['standards'][$std->requirement_id] as $dtStd) : $n++; ?>

								<tr>
									<td><?= $n; ?></td>
									<td><?= $dtStd->chapter; ?>
									</td>
									<td>
										<?= limit_text(strip_tags($dtStd->desc_indo), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $dtStd->id . '">[read]</a>'; ?>
									</td>
									<td>
										<?= limit_text(strip_tags($dtStd->desc_eng), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $dtStd->id . '">[read]</a>'; ?>
									</td>
								</tr>
						<?php endforeach;
						endif; ?>
					</tbody>
				</table>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="text-center">~ Not available data ~</div>
		<?php endif; ?>
	</div>
</div>

<script>
	$('.select2-modal').select2({
		placeholder: "Choose an options",
		width: "100%",
		allowClear: true
	})
</script>