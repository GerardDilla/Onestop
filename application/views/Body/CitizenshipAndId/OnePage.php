<style>
    .form-check-input[type="checkbox"][readonly] {
        pointer-events: none;
    }

    .form_title {
        font-size: 35px;
        font-weight: bolder;
        color: #070773;
    }
</style>
<section class="section" id="id_baseurl" data-baseurl="<?php echo base_url(); ?>">
    <?php
    if ($this->data['id_app'] != '1' && $this->data['digital'] != '1') {
    ?>
        <div class="alert alert-light-danger color-danger">
            <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
            NOTE: You have already submited, Please wait for an update.<br>
            <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
        </div>
    <?php } else { ?>

        <div class="alert alert-light-danger color-danger">
            <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
            NOTE: Once the form is submitted you can't edit anymore.<br>
        </div>
    <?php } ?>
    <!-- <div class="form_title">Digital Citizenship</div> -->
    <?php
    if ($this->data['digital'] === true) {
    ?>
        <!-- <div class="alert alert-light-danger color-danger"> -->
        <!-- <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i> -->
        <!-- NOTE: Only NAME can be edited.<br> -->
        <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
        <!-- </div> -->
    <?php } else { ?>
        <!-- <div class="alert alert-light-danger color-danger"> -->
        <!-- <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i> -->
        <!-- NOTE: You have already submited, Please wait for an update.<br> -->
        <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
        <!-- </div> -->
    <?php } ?>
    <!-- <div class="card"> -->

    <form id="digital_citizen_form" action="<?php echo base_url(); ?>index.php/Forms/digitalAndIdSubmit" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form_title">Personal Info</div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Reference Number</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" readonly class="form-control" id="reference_number" name="ref_no" placeholder="Reference Number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Student Number</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" readonly class="form-control" id="student_number" name="std_num" placeholder="Student Number">
                                </div>
                            </div>
                            <p>
                                <span class="title_color">Full Name</span>
                                <span class="required_field"> *</span> (
                                <small class="text-muted">First Name, Middle Name, Last Name</small>)
                            </p>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <?php
                                    if ($this->data['id_app'] == '1' || $this->data['digital'] == '1') {
                                        echo '<input type="text" readonly class="form-control" id="first_name" name="first_name" placeholder="First Name" required>';
                                    } else {
                                        echo '<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <?php
                                    if ($this->data['id_app'] == '1' || $this->data['digital'] == '1') {
                                        echo '<input type="text" class="form-control" readonly id="middle_name" name="middle_name" placeholder="Middle Name" required>';
                                    } else {
                                        echo '<input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <?php
                                    if ($this->data['id_app'] == '1' || $this->data['digital'] == '1') {
                                        echo '<input type="text" class="form-control" readonly id="last_name" name="last_name" placeholder="Last Name" required>';
                                    } else {
                                        echo '<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>';
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Course / Department</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Course / Department" readonly name="course" id="digital_course">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-light-warning color-danger">
            </div>
            <div class="form_title">Digital Citizenship</div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Personal Email</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email" readonly id="digital_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Accounts</span><br>
                                    <span class="required_field">NOTE</span>: This are the accounts you will get.
                                </p>
                                <div class="form-check">
                                    <input type="checkbox" checked readonly class="form-check-input form-check-primary" name="concern[]" id="concern_gmail" value="sdca_gmail_account" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;">
                                    <label for="customColorCheck1">SDCA Gmail Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked readonly class="form-check-input form-check-primary" name="concern[]" id="concern_portal" value="student_portal" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;">
                                    <label for="customColorCheck2">Student Portal</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked readonly class="form-check-input form-check-primary" name="concern[]" id="concern_blackboard" value="blackboard_account" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;">
                                    <label for="customColorCheck3">Blackboard Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked readonly class="form-check-input form-check-primary" name="concern[]" id="concern_365" value="microsoft_office_365" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;">
                                    <label for="customColorCheck4">Microsoft Office 365</label>
                                </div>
                            </div>
                            <?php
                            if ($this->data['digital'] == '1') {
                            ?>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-light-warning color-danger">
        </div>
        <?php
        if ($this->data['id_app'] == '1') {
        ?>
            <!-- <div class="alert alert-light-danger color-danger"> -->
            <!-- <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
                NOTE: Only NAME can be edited.<br> -->
            <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
            <!-- </div> -->
        <?php } else { ?>
            <!-- <div class="alert alert-light-danger color-danger"> -->
            <!-- <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
                NOTE: You have already submited, Please wait for an update.<br> -->
            <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
            <!-- </div> -->
        <?php } ?>
        <div class="form_title">ID Application</div>

        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            if ($this->data['id_app'] != '1') {
                            ?>
                                <div class="col-md-12">
                                    <p>
                                        <span class="title_color">ID Picture</span>
                                        <span class="required_field"> *</span>
                                        <small><br>
                                            <span class="text_note">Photo Requirements</span>: Half Body Photo only, wearing School Uniform with White Background.
                                            <br>
                                            <span class="text_note">NOTE</span>: USE YOUR STUDENT NUMBER TO NAME YOUR PHOTO ONLY.
                                        </small>
                                    </p>
                                    <input type="file" class="form-control" name="id_picture" id="inputGroupFile01" required>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <span class="title_color">Signature</span><br>
                                        <span class="required_field"> *</span>
                                        <small>
                                            <span class="text_note">NOTE</span>: USE YOUR SETUDENT NUMBER TO NAMe YOUR SIGANTURE ONLY
                                        </small>
                                    </p>
                                    <input type="file" class="form-control" name="signature" id="inputGroupFile01" required>
                                    <br>
                                </div>
                            <?php } ?>
                            <?php
                            if ($this->data['id_app'] == '1') {
                            ?>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Name</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input readonly type="text" class="form-control" id="gurdian_name" name="gurdian_name" placeholder="Guardian Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Address</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input readonly type="text" class="form-control" id="gurdian_address" name="gurdian_address" placeholder="Guardian Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Contact Number</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input readonly type="text" class="form-control" id="gurdian_number" name="gurdian_number" placeholder="Guardian Contact Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Relationship</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input readonly type="text" class="form-control" id="gurdian_relationship" name="gurdian_relationship" placeholder="Guardian Email Address">
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Name</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="gurdian_name" name="gurdian_name" placeholder="Guardian Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Address</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="gurdian_address" name="gurdian_address" placeholder="Guardian Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Contact Number</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="gurdian_number" name="gurdian_number" placeholder="Guardian Contact Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Relationship</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="gurdian_relationship" name="gurdian_relationship" placeholder="Guardian Email Address">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($this->data['id_app'] != '1') {
        ?>
            <div class="col-md-12" style="text-align:center">
                <button class="btn btn-lg btn-primary btn-hover-red">PROCEED</button>
            </div>
    </form>
<?php } else { ?>
    </form>
    <div class="col-md-12" style="text-align:center">
        <a href="<?php echo base_url('index.php/Main/selfassesment') ?>">
            <button class="btn btn-lg btn-primary btn-hover-red">Go back to SelfAssesment</button>
        </a>
    </div>
<?php } ?>

<!-- </div> -->
</section>
<script>
    <?php
    if ($this->session->flashdata('success')) {
    ?>
        iziToast.success({
            title: 'OK',
            message: 'Successfully inserted record!',
        });
    <?php
    }
    if ($this->session->flashdata('error')) {
    ?>
        iziToast.error({
            title: 'Error',
            message: '<?php echo $this->session->flashdata('error'); ?>',
        });
    <?php
    }
    ?>
    $(document).ready(function() {
        // alert('asdsa');
        digital_student_information();
        $("#digital_citizen_form").submit(function(e) {

            if ($('input[type=text]').val() == '') {
                e.preventDefault();
            }
        });
    });

    function digital_student_information() {
        $.ajax({
            url: 'Forms/ajaxGetStudent',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                $('#digital_first_name').val(response['First_Name']);
                $('#digital_middle_name').val(response['Middle_Name']);
                $('#digital_last_name').val(response['Last_Name']);
                $('#digital_course').val(response['Course'] + " : " + response['Program_Name']);
                $('#digital_email').val(response['Email']);
            }
        })
    }

    $(document).ready(function() {
        id_student_information();
        $("#id_application_form").submit(function(e) {

            if ($('input[type=text]').val() == '') {
                e.preventDefault();
            }
        });
    });

    function id_student_information() {
        $.ajax({
            url: 'Forms/ajaxGetStudent',
            dataType: 'JSON',
            success: function(response) {
                $('#reference_number').val(response['Reference_Number']);
                $('#student_number').val(response['Student_Number']);
                $('#first_name').val(response['First_Name']);
                $('#middle_name').val(response['Middle_Name']);
                $('#last_name').val(response['Last_Name']);
                $('#course').val(response['Course'] + " : " + response['Program_Name']);
                $('#gurdian_name').val(response['Guardian_Name']);
                $('#gurdian_address').val(response['Guardian_Address']);
                $('#gurdian_number').val(response['Guardian_Contact']);
                $('#gurdian_relationship').val(response['Guardian_Contact']);
            }
        })
    }
</script>