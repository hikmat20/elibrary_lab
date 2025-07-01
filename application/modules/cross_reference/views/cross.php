<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row mb-3">
				<label for="exampleInputEmail1" class="col-3 col-form-label">Select Standard</label>
				<div class="col-5">
					<select name="standard" id="standard" class="form-control form-control-solid select2 mb-5" data-dropdown-parent=".card-body">
						<option value=""></option>
						<?php foreach ($Data as $dt) : ?>
							<option value="<?= $dt->id; ?>"><?= $dt->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<button type="button" class="btn btn-primary send">Next <i class="fa fa-arrow-right"></i></button>
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
		});

		$(document).on('click', '.send', function() {
			let id = $('#standard').val();
			if (id) {
				location.href = siteurl + active_controller + 'cross_pasal/' + id, '_blank'
			} else {
				Swal.fire('Warning!', 'Pilih Stadard terlebih dahulu', 'warning', 200)
			}
		})

	})
</script>