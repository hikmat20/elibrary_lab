<!-- <div class="modal-header py-2 px-2">
    <ul class="nav nav-pills nav-light-success py-0" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#file">
                <span class="nav-icon">
                    <i class="fa fa-file-alt"></i>
                </span>
                <span class="nav-text">File</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#home">
                <span class="nav-icon">
                    <i class="fa fa-history"></i>
                </span>
                <span class="nav-text">History</span>
            </a>
        </li>
    </ul>
</div> -->
<?php if ($review) { ?>
    <div class="tab-content mt-5">
        <div class="tab-pane fade show active" id="file" role="tabpanel" aria-labelledby="file-tab">
            <div style="width:92%;height:400px;background-color: red;position: absolute;opacity: 0;"></div>
            <?php if (isset($review->document)) : ?>
                <iframe src="<?= base_url(); ?>directory/COMPILATIONS/<?= $review->document; ?>#toolbar=0&navpanes=0" frameborder="0" width="100%" height="400px"></iframe>
            <?php endif; ?>
            <hr>
        </div>
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row overflow-auto">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <label for="">Tracking File</label>
                    <div class="timeline timeline-5">
                        <div class="timeline-items">
                            <!-- <div class="timeline-item">
                            <div class="timeline-media bg-light-primary">
                                <i class="fa fa-upload text-success"></i>
                            </div>
                            <div class="timeline-desc timeline-desc-light-primary">
                                <span class="font-weight-bolder text-primary"> <?= date('Y-m-d'); ?> 09:30 AM</span>
                                <span class="label label-pill label-inline label-light-danger">Upload File</span>
                                <p class="font-weight-normal text-dark-50 pb-2">
                                    To start a blog, think of a topic about and first brainstorm ways to write details
                                </p>
                            </div>
                        </div> -->
                            <?php if (isset($history)) :


                                foreach ($history as $his) : ?>
                                    <div class="timeline-item">
                                        <div class="timeline-media <?= ($his->new_status == 'OPN') ? 'bg-light-success' : 'bg-light-danger'; ?>">
                                            <span class="<?= ($his->new_status == 'OPN') ? 'fa fa-upload text-success' : 'fa fa-circle text-danger'; ?>"></span>
                                        </div>

                                        <div class="timeline-desc timeline-desc-light-danger">
                                            <span class="font-weight-bolder text-danger"> <?= $his->updated_at; ?></span>
                                            <?= $sts[$his->new_status]; ?>
                                            <p class="font-weight-normal text-dark-50 pt-1">
                                                <strong for="">Processed by <?= $his->updated_by; ?></strong>
                                            </p>
                                            <p>
                                                <?= $his->note; ?>
                                            </p>
                                        </div>
                                    </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php } else { ?>
    <div class="text-center">~ Not available data</div>
<?php } ?>