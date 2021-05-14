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
            <form id="form_submit" action="<?php echo base_url('main/validationDocumentsProcess'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" value="0" name="if_married">
                <!-- <form  id="form_submit" action="http://localhost:4003/uploadtodrive/test_post2" method="post" enctype="multipart/form-data" > -->
                <div class="col-md-12" align="center">
                    <div class="table-responsive col-lg-12">
                        <table id="validationDocumentsTable" class="table table-light mb-0" style="min-width:900px;">
                            <thead>
                                <tr>
                                    <th>Requirements</th>
                                    <th max-width="20%">Add File / <font style="font-weight:100;font-size:11px;">check the checkbox on TBF column if the requirements is to be followed</font>
                                    </th>
                                    <th style="text-align:center;">TBF</th>
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
                                // $requirements = $this->data['requirements'];
                                // echo json_encode($requirements);
                                $requirements_list = [];
                                $req_count = 0;
                                foreach ($requirements as $list) {
                                    if ($list['status'] != "") {
                                        ++$req_count;
                                    }
                                }

                                foreach ($requirements as $list) {
                                    if ($list['id_name'] != "marriage_certificate") {
                                        array_push($requirements_list, $list['id_name']);
                                        $status = $list['status'];
                                ?>
                                        <tr>
                                            <td><?php echo $list['rq_name']; ?></td>
                                            <td>
                                                <input required <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                            </td>
                                            <td><input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> <?php if ($req_count > 0) {
                                                                                                                    echo $list['status'] == "" ? 'checked="true"' : '';
                                                                                                                } ?> type="checkbox" class="form-check-input" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></td>
                                            <td style="text-align:center;"><?php echo $list['status']; ?></td>
                                            <td style="text-align:center;"><?php echo $list['date']; ?></td>

                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <!-- <tr>
                                            <th colspan="5">Are you married? Yes <input onchange="ifMarried('yes')" type="checkbox" class="form-check-input" name="yes"> or No <input type="checkbox" onchange="ifMarried('no')" class="form-check-input" name="no" checked="true"></th>
                                        </tr> -->
                                        <tr style="display:none;" id="married_certificate_div">
                                            <td><?php echo $list['rq_name']; ?></td>
                                            <td>
                                                <input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                            </td>
                                            <td><input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> checked="checked" type="checkbox" class="form-check-input" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></td>
                                            <td style="text-align:center;"><?php echo $list['status']; ?></td>
                                            <td style="text-align:center;"><?php echo $list['date']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                if (isset($this->data['requirementstab'])) {
                                    if($this->data['interview_status'] == null){
                                ?>
                                    <!-- <tr>
                                        <th colspan="5">
                                            Do you want to be interviewed?
                                        <br>
                                            <input type="radio" class="form-check-input" name="interview" value="YES">  YES
                                        <br>
                                            <input type="radio" class="form-check-input" name="interview" value="NO">  NO
                                        </th>
                                    </tr>    -->
                                <?php
                                    }else{
                                        echo "<tr><th colspan='2'>Do you want to be interviewed?<br><u>";
                                        if($this->data['interview_status'] == 'YES'){
                                            echo "<span style='color:green'><b>YES</b></span>! I want to be Interviewed.";
                                        }
                                        else if($this->data['interview_status'] == 'NO'){
                                            echo "<span style='color:red'><b>NO</b></span>! I don't want to be Interviewed.";
                                        }
                                        echo "</u></th></tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right" style="margin-top:10px">
                        <?php
                        if ($req_count == 0) {
                            echo '<button type="submit" class="btn btn-info">Submit</button>';
                        }
                        ?>
                        <div>
                        </div>
            </form>
        </div>
</section>

<script>
    function ifMarried(val) {
        if (val == "yes") {
            $(`input[name=yes]`).attr('checked', true);
            $("input[name=no]").prop('checked', false);
            $('input[name=if_married]').val('1');
            $('#married_certificate_div').show();
            $(`input[name=marriage_certificate]`).attr('required', true);
            $("input[name=check_marriage_certificate]").attr('checked', false);
        } else if (val == "no") {
            // alert('hello')
            $("input[name=check_marriage_certificate]").attr('checked', true);
            $(`input[name=no]`).attr('checked', true)
            // $(`input[name=yes]`).attr('checked',false)
            $("input[name=yes]").prop('checked', false);
            $('input[name=if_married]').val('0');
            $('#married_certificate_div').hide();
            $(`input[name=marriage_certificate]`).attr('required', false);

        }
    }

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
        alert('asdasd');
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