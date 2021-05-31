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
<style>
    .div-th {
        /* margin:0;
    padding:0; */
        /* border:1px solid black; */
        color: black;
        font-weight: bold;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        /* position:relative; */
    }

    .min-th {
        color: black;
        font-weight: bold;
        text-align: center;
        /* display: flex; */
        justify-content: center;
        align-items: center;
        display: none;
        position: relative;
    }

    .div-align-center {
        /* display: flex;
    justify-content: center;
    align-items: center;  */
        /* text-align */
        text-align: center;
    }

    .div-td {
        /* border:1px solid black; */
        margin: 0;
        padding: 10px;
        /* padding:0; */
        /* padding:0; */
        /* border:1px solid black; */
        color: black;
        position: relative;
        /* font-weight:bold; */
        /* text-align: center; */
        /* display: flex;
    justify-content: center;
    align-items: center; */
        /* padding:10px; */
    }

    /* .div-th span{
    border:1px solid black;
    margin:auto;
} */
    /* .div-th span{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
} */
    .responsive-tbl {
        background: #f8f9fa;
        color: #000;
        /* border:1px solid black; */
        /* border-color: #dfe0e1; */
        /* --bs-table-bg: #f8f9fa;
    --bs-table-striped-bg: #ecedee;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #dfe0e1;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #e5e6e7;
    --bs-table-hover-color: #000;
    color: #000;
    border-color: #dfe0e1; */
    }

    .table-header {
        /* border-bottom: 1px solid #dedede!important;
    padding-right:10px; */
        position: relative;
    }

    .table-header::after {
        border-bottom: 2px solid #dedede !important;
        content: '';
        position: absolute;
        left: 10px;
        right: 0;
        width: 100%;
        bottom: 0;
        margin: 0 auto;
    }

    .table-body {}

    .table-row {
        margin: 0px 0px 0px 0px;
        padding: 0px 0px 0px 0px;
        /* border-bottom: 1px solid #dedede!important; */
        position: relative;
    }

    .table-row::before {
        border-bottom: 2px solid #dedede !important;
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        width: 100%;
        bottom: 0;
        margin: 0 auto;
    }

    .column-1 {}

    .column-2 {}

    .column-3 {}

    .column-4 {}

    .column-5 {}

    @media (max-width:993px) {

        .column-1,
        .column-2,
        .column-3,
        .column-4,
        .column-5 {
            display: none;
        }

        .min-th {
            display: flex;
        }

        .div-align-center {
            text-align: left;
        }

        .div-td::before {
            border-bottom: 2px solid #dedede !important;
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            width: 100%;
            bottom: 0;
            margin: 0 auto;
        }

        .header-per-row {
            background: #d4d4d4;
        }
    }

    @media (max-width:576px) {
        .div-align-center {
            text-align: center;
        }
    }

    #are_you_married {
        padding: 10px 10px 10px 20px;
    }

    .interview-status {
        /* margin-left:10px; */
        padding: 10px 10px 10px 20px;
    }
</style>
<section class="section col-sm-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form id="form_submit" action="<?php echo base_url('index.php/Main/validationDocumentsProcess'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" value="0" name="if_married">
                <!-- <form  id="form_submit" action="http://localhost:4003/uploadtodrive/test_post2" method="post" enctype="multipart/form-data" > -->
                <div class="col-md-12">
                    <div class="col-md-12 responsive-tbl" style="margin-top:10px">
                        <div class="table-header col-md-12 row">
                            <div class="col-lg-3 div-th column-1"><span>Requirements</span></div>
                            <div class="col-lg-4 div-th column-2"><span>Add File / <font style="font-weight:100;font-size:11px;">check the checkbox on TBF column if the requirements is to be followed</font></span></div>
                            <div class="col-lg-1 div-th column-3"><span>To be Follow</span></div>
                            <div class="col-lg-2 div-th column-4"><span>Status</span></div>
                            <div class="col-lg-2 div-th column-5"><span>Date</span></div>
                        </div>
                        <div class="table-body">
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
                            $req = 0;
                            foreach ($requirements as $list) {
                                ++$req;
                                if ($list['id_name'] != "marriage_certificate") {
                                    array_push($requirements_list, $list['id_name']);
                                    $status = $list['status'];
                            ?>
                                    <div class="table-row row col-md-12">
                                        <div class="col-lg-3 row div-td div-align-center header-per-row">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th">Requirements</div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['rq_name']; ?></div>
                                        </div>
                                        <div class="col-lg-4 row div-td">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span><span>Add File / <font style="font-weight:100;font-size:11px;">check the checkbox on TBF column if the requirements is to be followed</font></span></span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8">
                                                <input required <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 row div-td">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>To be Follow</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> <?php if ($req_count > 0) {
                                                                                                                                                        echo $list['status'] == "" ? 'checked="true"' : '';
                                                                                                                                                    } ?> type="checkbox" class="form-check-input <?php echo $req == 1 ? 'requirement-1' : ''; ?>" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></div>
                                        </div>
                                        <div class="col-lg-2 row div-td div-align-center">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>Status</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['status']; ?></div>
                                        </div>
                                        <div class="col-lg-2 row div-td div-align-center">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>Date</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['date']; ?></div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="table-row row col-md-12 are_you_married" id="are_you_married">
                                        <div class="col-md-12">Are you married? Yes <input onchange="ifMarried('yes')" type="checkbox" class="form-check-input" name="yes"> or No <input type="checkbox" onchange="ifMarried('no')" class="form-check-input" name="no" checked="true"></div>
                                    </div>
                                    <div class="table-row row col-md-12" style="display:none;" id="married_certificate_div">
                                        <div class="col-lg-3 row div-td div-align-center header-per-row">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th">Requirements</div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['rq_name']; ?></div>
                                        </div>
                                        <div class="col-lg-4 row div-td">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span><span>Add File / <font style="font-weight:100;font-size:11px;">check the checkbox on TBF column if the requirements is to be followed</font></span></span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8">
                                                <input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> class="form-control form-control-sm" name="<?php echo $list['id_name']; ?>" id="<?php echo $list['id_name']; ?>" type="file">
                                                <div class="invalid-feedback feedback-<?php echo $list['id_name']; ?>"><i class="bx bx-radio-circle"></i>This is required.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 row div-td">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>To be Follow</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><input <?php echo $req_count > 0 ? 'disabled="true"' : ''; ?> <?php if ($req_count > 0) {
                                                                                                                                                        echo $list['status'] == "" ? 'checked="true"' : '';
                                                                                                                                                    } ?> type="checkbox" class="form-check-input <?php echo $req == 1 ? 'requirement-1' : ''; ?>" name="check_<?php echo $list['id_name']; ?>" onclick="toBeFollow(`<?php echo $list['id_name']; ?>`)"></div>
                                        </div>
                                        <div class="col-lg-2 row div-td div-align-center">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>Status</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['status']; ?></div>
                                        </div>
                                        <div class="col-lg-2 row div-td div-align-center">
                                            <div class="col-lg-12 col-md-4 col-sm-4 min-th"><span>Date</span></div>
                                            <div class="col-lg-12 col-md-8 col-sm-8"><?php echo $list['date']; ?></div>
                                        </div>
                                    </div>
                                    <?php   }
                            }
                            if (isset($this->data['requirementstab'])) {
                                $old_student = empty($this->data['old_student']) ? false : $this->data['old_student'];
                                if ($old_student === false) {
                                    if ($this->data['interview_status'] == null) {
                                    ?>
                                        <div class="table-row row col-md-12 interview-status">
                                            <div class="col-md-12">
                                                Do you want to be interviewed?
                                                <label for="interview_yes">YES <input type="radio" checked class="form-check-input" name="interview" value="YES" id="interview_yes" required></label>
                                                <label for="interview_no"> NO <input type="radio" class="form-check-input" name="interview" value="NO" id="interview_no"></label>
                                            </div>
                                        </div>
                            <?php
                                    } else {
                                        echo "<div class='table-row row col-md-12 interview-status'>
                                    <div class='col-md-12'>Do you want to be interviewed?<br><u>";
                                        if ($this->data['interview_status'] == 'YES') {
                                            echo "<span style='color:green'><b>YES</b></span>! I want to be Interviewed.";
                                        } else if ($this->data['interview_status'] == 'NO') {
                                            echo "<span style='color:red'><b>NO</b></span>! I don't want to be Interviewed.";
                                        }
                                        echo "</u></div></div>";
                                    }
                                }
                            }
                            ?>
                            <!-- <div class="table-row row col-md-12">
                                <div class="col-lg-3 div-td div-align-center">Birt Certificate</div>
                                <div class="col-lg-4 div-td">
                                    <input required class="form-control form-control-sm" name="" id="" type="file">
                                    <div class="invalid-feedback feedback-"><i class="bx bx-radio-circle"></i>This is required.</div>
                                </div>
                                <div class="col-lg-2 div-td"><input type="checkbox" class="form-check-input"></div>
                                <div class="col-lg-1 div-td div-align-center">pending</div>
                                <div class="col-lg-2 div-td div-align-center">May. 26,2021 9:59am</div>
                            </div> -->
                        </div>
                    </div>

                    <?php
                    if (isset($this->data['requirementstab'])) {
                        echo '<div>';
                        echo '<div class="col-md-12 student_info_submit_div" style="text-align:center; padding-top:20px">';
                        echo '<button type="submit" class="btn btn-lg btn-primary btn-priamry-hover-transparent" id="submit_val_doc">PROCEED</button>';
                        // echo '<button type="button" class="btn btn-lg btn-primary wizard-proceed-student_info" onclick="submit_course()">PROCEED</button>'
                        echo '<div>';
                    } else {
                        if ($req_count == 0) {
                            echo '<div class="col-md-12 col-sm-12" align="right" style="margin-top:10px">';
                            echo '<button type="submit" class="btn btn-info" id="submit_val_doc">Submit</button>';
                            echo '<div></div>';
                        }
                    }
                    ?>

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
        // if (req_count == 0) {
        //     iziToast.error({
        //         title: 'Error: ',
        //         message: 'You should atleast pass 1 or more requirement/s!!',
        //         position: 'topRight',
        //     });
        // }
        if (count == 0) {
            // FORM SUBMISSION
            $('button[type=submit]').attr('disabled', 'disabled');
            $('#form_submit')[0].submit();
        }
    })
</script>