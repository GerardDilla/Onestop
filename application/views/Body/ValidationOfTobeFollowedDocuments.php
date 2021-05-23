<?php
echo '<script>';
if (!empty($this->session->flashdata('error'))) {
    echo "iziToast.error({
                title: 'Error: ',
                message: '" . $this->session->flashdata('error') . "',
                position: 'topRight',
            });";
    $this->session->set_flashdata('error', '');
} else if (!empty($this->session->flashdata('success'))) {
    echo "iziToast.success({
            title: 'Success: ',
            message: '" . $this->session->flashdata('success') . "',
            position: 'topRight',
        });";
    $this->session->set_flashdata('success', '');
}
echo '</script>';
?>
<section class="section col-sm-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form id="form_submit" action="<?php echo base_url('index.php/Main/validationDocumentsProcess'); ?>" method="post" enctype="multipart/form-data">
                <!-- <form  id="form_submit" action="http://localhost:4003/uploadtodrive/test_post2" method="post" enctype="multipart/form-data" > -->
                <div class="col-md-12" align="center">
                    <div class="table-responsive col-lg-12">
                        <table class="table table-light mb-0">
                            <thead>
                                <tr>
                                    <th>Requirements</th>
                                    <th>Add File</th>
                                    <!-- <th style="text-align:center;"></th> -->
                                    <th style="text-align:center;" width="15%">Status</th>
                                    <th style="text-align:center;" width="15%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                <td>Documents</td>
                                <td>
                                    <input required class="form-control form-control-sm" name="document" id="document" type="file"><div class="invalid-feedback feedback-3"><i class="bx bx-radio-circle"></i>This is required.</div>
                                </td>
                                <td style="text-align:center;">Active</td>
                                <td style="text-align:center;"><?php echo date("Y-m-d H:i:s") ?></td>
                            </tr> -->
                                <?php
                                $status = "";
                                $requirements_list = [];
                                $req_count = 0;
                                $total_count = 0;
                                foreach ($requirements as $list) {
                                    ++$total_count;
                                    if ($list['status'] == 'pending') {
                                        ++$req_count;
                                    }
                                }

                                foreach ($requirements as $list) {
                                    if ($list['id_name'] != 'marriage_certificate') {
                                        array_push($requirements_list, $list['id_name']);
                                        $status = $list['status'];
                                ?>
                                        <tr>
                                            <td><?php echo $list['rq_name']; ?></td>
                                            <td>
                                                <input <?php echo  $list['status'] == "pending" ? 'disabled="true"' : 'required'; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                            </td>
                                            <!-- <td><input <?php echo  $list['status'] == "pending" ? '' : 'disabled="true"'; ?> <?php if ($req_count > 0) {
                                                                                                                                echo $list['status'] == "" ? 'checked="true"' : '';
                                                                                                                            } ?> type="checkbox" class="form-check-input" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></td> -->
                                            <td style="text-align:center;"><?php echo $list['status']; ?></td>
                                            <td style="text-align:center;"><?php echo $list['status'] == "pending" ? $list['date'] : ''; ?></td>

                                        </tr>
                                        <?php
                                    } else {
                                        if ($list['if_married'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?php echo $list['rq_name']; ?></td>
                                                <td>
                                                    <input <?php echo  $list['status'] == "pending" ? 'disabled="true"' : 'required'; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                    <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                                </td>
                                                <!-- <td><input <?php echo  $list['status'] == "pending" ? '' : 'disabled="true"'; ?> <?php if ($req_count > 0) {
                                                                                                                                    echo $list['status'] == "" ? 'checked="true"' : '';
                                                                                                                                } ?> type="checkbox" class="form-check-input" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></td> -->
                                                <td style="text-align:center;"><?php echo $list['status']; ?></td>
                                                <td style="text-align:center;"><?php echo $list['status'] == "pending" ? $list['date'] : ''; ?></td>

                                            </tr>
                                <?php       }
                                    }
                                }
                                ?>
                                <!-- <tr class="table-active">
                                <th colspan="4">Payment</th>
                            </tr>
                            <tr>
                                <td>Proof of Payment</th>
                                <td max-width="20%"><input type="file" class="form-control form-control-sm"></td>
                                <td style="text-align:center;">pending</td>
                                <td style="text-align:center;"><?php echo date("M. j,Y g:ia"); ?></td>
                            </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right" style="margin-top:10px">
                        <!-- <button type="submit" class="btn btn-info">Submit</button> -->
                        <?php
                        if ($req_count != $total_count && $req_count != 0) {
                            echo '<button type="submit" class="btn btn-info">Submit</button>';
                        }
                        ?>
                        <div>
                        </div>
            </form>
        </div>
</section>

<script>
    function toBeFollow(id) {
        if ($(`input[name=check_${id}]`).is(':checked')) {
            $(`input[name=${id}]`).attr('required', false);
            $(`input[name=${id}]`).attr('disabled', true);
        } else {
            $(`input[name=${id}]`).attr('required', true);
            $(`input[name=${id}]`).attr('disabled', false);
        }

    }
    $('#form_submit').on('submit', function(e) {
        e.preventDefault();
        var count = 0;
        var req_count = 0;
        $('.form-control[required]').each(function() {
            ++req_count;
            $(this).removeClass('is-invalid');
            // check for empty fields
            if ($(this).val() == "") {
                $('.feedback-' + this.id).text('This is required.');
                $(this).addClass('is-invalid');
                ++count;
            }
            var ext2 = this.value.split('.');
            var ext = ext2[1];
            // validate file format
            if (ext != "PNG" &&
                ext != "JPG" &&
                ext != "png" &&
                ext != "jpg" &&
                ext != "JPEG" &&
                ext != "jpeg" &&
                ext != "PDF" &&
                ext != "pdf" &&
                ext != "docm" &&
                ext != "DOCM" &&
                ext != "doc" &&
                ext != "DOC" &&
                ext != "docx" &&
                ext != "DOCX" &&
                ext != "xls" &&
                ext != "xlsx" &&
                ext != "XLS" &&
                ext != "XLSX") {
                $('.feedback-' + this.id).text('Invalid File Format!');
                $(this).addClass('is-invalid');
                ++count;
            }
            // 50mb file size limit
            if (this.files[0].size > 50000000) {
                $('.feedback-' + this.id).text('You have reached the 50mb file size limit.');
                $(this).addClass('is-invalid');
                ++count;
            }
        })
        if (req_count == 0) {
            iziToast.error({
                title: 'Error: ',
                message: 'You should atleast pass 1 or more requirement/s!!',
                position: 'topRight',
            });
        }
        if (count == 0 && req_count > 0) {
            // FORM SUBMISSION
            $('button[type=submit]').attr('disabled', 'disabled');
            $('#form_submit')[0].submit();
        }
    })
</script>