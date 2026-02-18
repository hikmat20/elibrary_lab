<h1 class="text-center px-10 mb-10"><?= $Data->name; ?></h1>
<hr>
  <?php if ($Data->document) : ?>
    <iframe src="<?= base_url("directory/REGULATIONS/21/$Data->document"); ?>#toolbar=0&navpanes=0" scrolling="yes" width="100%" height="550"></iframe>
  <?php else : ?>
      <h5 class="text-center mt-5"></h5>
  <?php endif; ?>
<?php if (isset($Pasal)) : ?>
  <?php foreach ($Pasal as $psl) : ?>
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-body">
        <h3 class="text-center mb-10 font-weight-bolder"><u><?= $psl->name; ?></u></h3>
        <div class="col-9 m-auto">
          <table class="table table-sm table-borderless mb-10">
            <tbody>
              <?php if (isset($ArrDesc[$psl->id])) : $n = 0;
                foreach ($ArrDesc[$psl->id] as $dsc) : $n++; ?>
                  <tr>
                    <td class="" width="100"><?= $dsc->name; ?></td>
                    <td class=""><?= $dsc->description; ?></td>
                  </tr>
              <?php endforeach;
              endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>