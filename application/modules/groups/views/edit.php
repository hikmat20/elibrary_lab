 <form id="form-groups">
 	<div class="form-group">
 		<label for="name">Group Name</label>
 		<input type="hidden" name="id_group" id="id" value="<?= $data->id_group; ?>">
 		<input type="text" class="form-control" id="group_name" value="<?= $data->nm_group; ?>" autocomplete="off" title="Group Name" name="name" aria-describedby="group_name" placeholder="Group Name">
 		<small class="invalid-feedback text-danger">Group Name can't empty, please fill this field!</small>
 	</div>
 	<div class="form-group">
 		<label for="name">Description</label>
 		<textarea name="ket" id="desc" cols="" rows="" class="form-control" placeholder="Descriptions" title="Descriptions"><?= $data->ket; ?></textarea>
 	</div>
 </form>