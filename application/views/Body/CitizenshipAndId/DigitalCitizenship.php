<style>
    .form-check-input[type="checkbox"][readonly] {
        pointer-events: none;
    }
</style>
<section class="section" id="id_baseurl" data-baseurl="<?php echo base_url(); ?>">
    <?php
    if ($this->data['digital'] === true) {
    ?>
        <div class="alert alert-light-danger color-danger">
            <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
            NOTE: Only NAME can be edited.<br>
            <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
        </div>
    <?php } else { ?>
        <div class="alert alert-light-danger color-danger">
            <i class="bi bi-exclamation-circle" alt="Note!" title="Note!"></i>
            NOTE: You have already submited, Please wait for an update.<br>
            <!-- PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM -->
        </div>
    <?php } ?>
    <div class="card">
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form id="digital_citizen_form" action="<?php echo base_url(); ?>Forms/submit_digital_citizenship" method="POST">
                            <div class="row">
                                <p>
                                    <span class="title_color">Full Name</span>
                                    <span class="required_field"> *</span> (
                                    <small class="text-muted">Last name, Given Name, M.I</small>)
                                </p>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?php
                                        if ($this->data['digital'] === true) {
                                            echo '<input type="text" class="form-control" placeholder="Last Name" name="last_name" id="digital_last_name">';
                                        } else {
                                            echo '<input type="text" class="form-control" readonly placeholder="Last Name" name="last_name" id="digital_last_name">';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?php
                                        if ($this->data['digital'] === true) {
                                            echo '<input type="text" class="form-control" placeholder="Given Name" name="first_name" id="digital_first_name">';
                                        } else {
                                            echo '<input type="text" class="form-control" readonly placeholder="Given Name" name="first_name" id="digital_first_name">';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?php
                                        if ($this->data['digital'] === true) {
                                            echo '<input type="text" class="form-control" placeholder="Middle Initial" name="middle_name" id="digital_middle_name">';
                                        } else {
                                            echo '<input type="text" class="form-control" readonly placeholder="Middle Initial" name="middle_name" id="digital_middle_name">';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Course / Department</span>
                                        <!-- <span class="required_field"> *</span> -->
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Course / Department" readonly name="course" id="digital_course">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Personal Email/ SDCA Gmail</span>
                                        <!-- <span class="required_field"> *</span> -->
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="Email" name="email" readonly id="digital_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Accounts</span><br>
                                        <!-- <span class="title_color">Concern</span> -->
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
                                <!-- <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Request Details</span>
                                        <span class="required_field"> *</span>
                                    </p>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input form-check-primary" name="request_details" id="request_activation" value="Account Activation/Creation">
                                        <label for="customColorCheck1">Account Activation/Creation</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input form-check-primary" name="request_details" id="request_forgot_password" value="Forgot Password">
                                        <label for="customColorCheck2">Forgot Password</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input form-check-primary" name="request_details" id="request_others" value="request_others">
                                        <label for="customColorCheck3">Other:</label>
                                        <input type="text" class="form-control" id="request_others_textfield" style="display: none;" placeholder="Please Specify">
                                        <input type="text" class="form-control" id="request_others_textfield" name="request_others_textfield" placeholder="Please Specify">
                                    </div>
                                    <br><br><br>
                                </div> -->
                                <?php
                                if ($this->data['digital'] === true) {
                                ?>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary" style="float: right;">Submit</button>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            message: 'Already have data',
        });
    <?php
    }

    ?>
    $(document).ready(function() {
        student_information();
        $("#digital_citizen_form").submit(function(e) {

            if ($('input[type=text]').val() == '') {
                e.preventDefault();
            }
        });
    });

    function student_information() {
        $.ajax({
            url: 'ajaxGetStudent',
            dataType: 'JSON',
            success: function(response) {
                $('#digital_first_name').val(response['First_Name']);
                $('#digital_middle_name').val(response['Middle_Name']);
                $('#digital_last_name').val(response['Last_Name']);
                $('#digital_course').val(response['Course'] + " : " + response['Program_Name']);
                $('digital_#email').val(response['Email']);
            }
        })
    }
</script>