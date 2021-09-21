<?php
$ENABLE_ADD     = has_permission('Folders.Add');
$ENABLE_MANAGE  = has_permission('Folders.Manage');
$ENABLE_VIEW    = has_permission('Folders.View');
$ENABLE_DELETE  = has_permission('Folders.Delete');
$ENABLE_DOWNLOAD  = has_permission('Folders.Download');
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-stretch shadow card-custom">
                <div class="card-body">
                    <button type="button" onclick="history.go(-1)" class="btn btn-icon btn-secondary" title="Kembali">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <!-- <button type="button" onclick="new_folder()" class="btn btn-icon btn-secondary m-1 " title="New Folder">
                        <i class="far fa-folder"></i>
                    </button> -->
                    <button type="button" onclick="add_file('<?= $id_master; ?>','<?= $id_sub; ?>')" id="btn-file" class="btn btn-icon btn-secondary m-1" title="New File">
                        <i class="far fa-file"></i>
                    </button>
                    <hr class="my-5">
                    <h4 for="">Lampiran Dokumen</h4>
                    <table id="example1" class="table table-borderless table-condensed table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama File</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Sts. Approve</th>
                                <th scope="col">Tgl. Approve</th>
                                <th scope="col">Revisi</th>
                                <th scope="col">Sts. Revisi</th>
                                <th scope="col">Prepered By</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($row) : $n = 0;
                                foreach ($row as $doc) : $n++
                            ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $doc->nama_file; ?></td>
                                        <td><?= $doc->ukuran_file; ?></td>
                                        <td><?= $doc->status_approve; ?></td>
                                        <td><?= $doc->approval_on; ?></td>
                                        <td><?= $doc->revisi; ?></td>
                                        <td><?= $doc->status_revisi; ?></td>
                                        <td><?= $doc->prepared_by; ?></td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="<?= $doc->id; ?>" data-file="<?= $doc->nama_file; ?>" data-table="gambar1" class="view btn btn-icon btn-warning btn-xs btn-shadow" title="View Dokumen"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" tooltip="qtip" onclick="location.href = siteurl+'dokumen/download_detail1/<?= $doc->id; ?>'" data-id="<?= $doc->id; ?>" data-file="<?= $doc->nama_file; ?>" data-table="gambar1" class="download btn btn-icon btn-info btn-xs btn-shadow ml-2" title="Download Dokumen"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1360px !Important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#example1').DataTable({
        orderCellsTop: false,
        fixedHeader: true,
        scrollX: true,
        ordering: false,
        info: false
    });

    $(document).ready(function() {
        $('#btn-add').click(function() {
            loading_spinner();
        });

    });

    function new_folder() {
        Swal.fire({
            html: "<input id='folder_name' required class='form-control' name='new-folder' placeholder='New Folder'>",
            showCancelButton: true
        }).then(function(result) {
            if (result.value) {
                let folder_name = $('#folder_name').val()
                if (folder_name == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nama tidak boleh kosong!',
                    })
                } else {
                    $.ajax({
                        url: base_url + active_controller + 'add',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            folder_name
                        },
                        success: function(result) {
                            if (result.status == '1') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Folder baru berhasil dibuat!',
                                }).then(function() {
                                    location.reload()
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjssadi kesalahan tidak terduga!',
                                    text: result.pesan
                                })
                            }
                        },
                        error: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadiaa kesalahan tidak terduga!',
                                text: result.pesan
                            })
                        }
                    })
                }
            }
        });
    }


    function add_file(id_master, id_sub) {
        $("#viewData").html('');
        // console.log(id);
        $(".modal-title").html("Add File");
        $("#viewData").load(siteurl + active_controller + 'load_form_detail/' + id_master + '/' + id_sub);
        $("#ModalView").modal('show');
    }

    $(document).on('focus', '.button-master', function() {
        $('.button-master').removeClass('active');
        $(this).toggleClass('active');
        $('#btn-rename').attr('data-id', $(this).data('id'))
        $('#btn-delete').attr('data-id', $(this).data('id'))
    })

    $(document).on('blur', 'body', function() {

        $('.button-master').removeClass('active');
        $('#btn-rename').attr('data-id', '')
        $('#btn-delete').attr('data-id', '')
    })


    function delData(id) {
        swal({
                title: "Are you sure?",
                text: "You will not be able to process again this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Process it!",
                cancelButtonText: "No, cancel process!",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    loading_spinner();
                    window.location.href = base_url + active_controller + '/delete/' + id;

                } else {
                    swal("Cancelled", "Data can be process again :)", "error");
                    return false;
                }
            });

    }

    $(document).on('click', '.view', function(e) {
        $("#viewData").html('');
        var id = $(this).data('id');
        var table = $(this).data('table');
        var file = $(this).data('file');
        // alert(id + ", " + table + ", " + file)
        $.ajax({
            type: "post",
            url: siteurl + 'dokumen/history_revisi',
            data: "id=" + id + "&table=" + table + "&file=" + file,
            success: function(result) {
                // $(".modal-dialog").css('max-width', '1360px !important');
                $(".modal-title").html("<b>VIEW DATA</b>");
                $("#viewData").html(result);
                $("#ModalView").modal('show');
            }
        })
    })
</script>