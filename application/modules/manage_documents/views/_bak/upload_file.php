<form id="form-upload">
	<div class="form-group row">
		<label class="col-lg-3 col-form-label text-lg-right">Document Name :</label>
		<div class="col-lg-7">
			<input type="hidden" id="id" name="id" class="form-control" placeholder="" value="<?= isset($file) ? $file->id : ''; ?>" />
			<input type="hidden" id="parent_id" name="parent_id" class="form-control" placeholder="" value="<?= $parent_id; ?>" />
			<input type="text" class="form-control" id="description" placeholder="Description" name="description" value="<?= isset($file) ? $file->name : ''; ?>" autocomplete="off" />
			<span class="form-text text-danger invalid-feedback">Deskripsi harus di isi</span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-3 col-form-label text-lg-right">Prepared By :</label>
		<div class="col-lg-7">
			<select name="prepared_by" id="prepared_by" class="form-control select2">;
				<option value=""></option>
				<?php foreach ($users as $usr) : ?>
					<option value="<?= $usr->id_user; ?>" <?= (isset($file) && $file->prepared_by == $usr->id_user) ? 'selected' : ''; ?>><?= $usr->full_name; ?></option>
				<?php endforeach; ?>
			</select>
			<span class="form-text text-danger invalid-feedback">Prepared By harus di isi</span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-3 col-form-label text-lg-right">File Type :</label>
		<div class="col-9 col-form-label">
			<div class="radio-inline">
				<label class="radio radio-primary">
					<input type="radio" name="flag_record" checked="checked" value="N" />
					<span></span>
					Pedoman
				</label>
				<label class="radio radio-primary">
					<input type="radio" name="flag_record" value="Y" />
					<span></span>
					Record
				</label>
			</div>
			<span class="form-text text-muted">pilih salah satu</span>
		</div>
	</div>
	<div id="file-type">
		<div class="form-group row">
			<label class="col-lg-3 col-form-label text-lg-right">Review By :</label>
			<div class="col-lg-7">
				<select name="reviewer_id" id="reviewer_id" class="form-control select2">;
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>" <?= (isset($file) && $file->reviewer_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
				<span class="form-text text-danger invalid-feedback">Review By harus di isi</span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-3 col-form-label text-lg-right">Approval By :</label>
			<div class="col-lg-7">
				<select name="approval_id" id="approval_id" class="form-control select2">;
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>" <?= (isset($file) && $file->approval_id == $jbt->id) ? 'selected' : ''; ?>><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
				<span class="form-text text-danger invalid-feedback">Approval By harus di isi</span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-3 col-form-label text-lg-right">Distribusi :</label>
			<div class="col-lg-7">
				<select name="distribute_id[]" multiple id="distribute_id" data-placeholder="Choose an options" class="form-control select2">;
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>" <?= isset($file) ? ((in_array($jbt->id, explode(',', $file->distribute_id))) ? 'selected' : '') : ''; ?>><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
				<span class="form-text text-danger invalid-feedback">Distribusi By harus di isi</span>
			</div>
		</div>
	</div>
	<div class="form-group row mb-0">
		<label class="col-lg-3 col-form-label text-lg-right">Upload Document :</label>
		<div class="col-lg-7">
			<input type="file" name="image" id="image" class="form-control" placeholder="Upload File">
			<span class="form-text text-muted">File type : PDF</span>
			<span class="form-text text-danger invalid-feedback">Upload Document By harus di isi</span>
		</div>
		<?php if (isset($file)) : ?>
			<input type="hidden" name="old_file" id="old_file" value="<?= isset($file) ? $file->file_name : ''; ?>">
		<?php endif; ?>
	</div>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an options',
			width: '100%',
			allowClear: true
		})
	})
</script>