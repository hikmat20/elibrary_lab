<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-stretch shadow card-custom">
        <div class="card-body">
          <div class="mb-3 row flex-nowrap">
            <label for="Name" class="col-2 col-form-label h4 font-weight-bolder">Company Name</label>
            <div class="col-9">
              : <label class="col-form-label h4 font-weight-bolder"><?= $data->nm_perusahaan; ?></label>
            </div>
          </div>

          <div class="mb-3 row flex-nowrap">
            <label for="Name" class="col-2 col-form-label font-weight-bolder">Select Regulation</label>
            <div class="col-9">
              <select name="regulation_id" id="regulation" class="form-control select2" data-placeholder="Choose an options" data-allow-clear="true">
                <option value=""></option>
                <?php if ($regulations) : ?>
                  <?php foreach ($regulations as $reg) : ?>
                    <option value="<?= $reg->regulation_id; ?>"><?= $reg->name; ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <hr>
          <div class="mb-3">
            <div id="list-description"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.select2').select2({
      width: "100%"
    })

    $(document).on('change', '#regulation', function() {
      const id = $(this).val() || ''
      $('#list-description').html('')
      if (id) {
        $('#list-description').load(siteurl + active_controller + 'loadDesc/' + id)
      }
    })
  })
</script>