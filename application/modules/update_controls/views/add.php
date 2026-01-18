<form id="form">
  <input type="hidden" name="type" id="type" value="<?= $type; ?>">
  <div class="mb-3 row flex-nowrap d-none">
    <label for="" class="col-3 col-form-label font-weight-bold">Name</label>
    <div class="col-9">
      <input type="text" name="name" class="form-control" id="name" placeholder="Name" />
      <span class="invalid-feedback">Name can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Year</label>
    <div class="col-3">
      <input type="text" name="latest_version" class="form-control" id="latest_version" placeholder="Latest Version" />
    </div>
    <div class="col-3">
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Source</label>
    <div class="col-9">
      <input type="text" name="source" class="form-control" id="source" placeholder="Source" />
      <span class="invalid-feedback">Source can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Chacking Date</label>
    <div class="col-9">
      <input type="date" name="checking_date" class="form-control" id="checking_date" placeholder="Date" />
      <span class="invalid-feedback">Date can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Status</label>
    <div class="col-9">
      <select name="status" id="status" class="form-control select2">
        <option value=""></option>
        <option value="NA">No Updates</option>
        <option value="PLN">Planning</option>
        <option value="REV">Revision</option>
        <option value="REP">Invalidation</option>
      </select>
      <span class="invalid-feedback">Status can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Descriptions</label>
    <div class="col-9">
      <textarea name="descriptions" id="descriptions" class="form-control" rows="5" placeholder="Descriptions"></textarea>
      <span class="invalid-feedback">Descriptions can't be empty</span>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    $('.select2').select2({
      width: '100%',
      allowClear: true,
      placeholder: 'Choose an options'
    });

  })
</script>