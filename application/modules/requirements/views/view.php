<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">
     
      <table class="table table-bordered rounded-lg mb-6">
        <tr>
          <th class="text-center" colspan="4">
            <h1><?= $Data->name; ?> : <?= $Data->year; ?> - <?= $Data->number; ?></h1>
          </th>
        </tr>
        <tr class="table-secondary">
          <th width="40" class="text-center">No.</th>
          <th class="text-center">Pasal</th>
          <th width="40%" class="text-center">Des. Indonesia</th>
          <th width="40%" class="text-center">Des. Inggris</th>
        </tr>
        <tbody>
          <?php if (isset($List)) : $n = 0;
            foreach ($List as $list) : $n++;
          ?>
              <tr>
                <td><?= $n; ?></td>
                <td><?= $list->chapter; ?></td>
                <td><?= $list->desc_indo; ?></td>
                <td><?= $list->desc_eng; ?></td>
              </tr>
          <?php endforeach;
          endif; ?>
        </tbody>
      </table>
        <?php if ($Data->pdf_file) : ?>
            <iframe src="<?= base_url("directory/$Data->pdf_file"); ?>#toolbar=0&navpanes=0" scrolling="yes" width="100%" height="550"></iframe>
        <?php else : ?>
            <h5 class="text-center mt-5">~ Not available data ~</h5>
        <?php endif; ?>
    </div>
  </div>
</div>