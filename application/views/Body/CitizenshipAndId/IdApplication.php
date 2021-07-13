<section class="section" id="id_baseurl" data-baseurl="<?php echo base_url(); ?>">
    <!-- <div class="button-function_div">
        <a href="<?php echo base_url('index.php/Main/selfassesment') ?>" style="color:inherit">
            <button class="btn btn-lg btn-primary btn-hover-red">
                Go Back to Self Assesment
            </button>
        </a>
        <a href="<?php echo base_url('index.php/forms/digital_citizenship') ?>" style="color:inherit">
            <button class="btn btn-lg btn-primary btn-hover-red button-function_next">
                Go to ID Application Form
            </button>
        </a>
    </div> -->
    <?php
    if ($this->data['id_app'] === true) {
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
    <!-- <div class="card"> -->
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="<?php echo base_url(); ?>index.php/Forms/submit_id_application" method="POST" id="id_application_form" enctype="multipart/form-data">
                            <input type="hidden" name="b3df6e650330df4c0e032e16141f" value="<?= $csrf_token ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Reference Number</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_reference_number" name="ref_no" placeholder="Reference Number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Student Number</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_student_number" name="std_num" placeholder="Student Number">
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
                                        if ($this->data['id_app'] === true) {
                                            echo '<input type="text" class="form-control" id="id_first_name" name="first_name" placeholder="First Name" required>';
                                        } else {
                                            echo '<input type="text" readonly class="form-control" id="id_first_name" name="first_name" placeholder="First Name" required>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?php
                                        if ($this->data['id_app'] === true) {
                                            echo '<input type="text" class="form-control" id="id_middle_name" name="middle_name" placeholder="Middle Name" required>';
                                        } else {
                                            echo '<input type="text" class="form-control" readonly id="id_middle_name" name="middle_name" placeholder="Middle Name" required>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?php
                                        if ($this->data['id_app'] === true) {
                                            echo '<input type="text" class="form-control" id="id_last_name" name="last_name" placeholder="Last Name" required>';
                                        } else {
                                            echo '<input type="text" class="form-control" readonly id="id_last_name" name="last_name" placeholder="Last Name" required>';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <span class="title_color">Course</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_course" placeholder="Course">
                                    </div>
                                </div>
                                <?php
                                if ($this->data['id_app'] === true) {
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
                                            <span class="title_color">Signature</span>
                                            <span class="required_field"> *</span>
                                            <small>
                                                <span class="text_note">NOTE</span>: USE YOUR SETUDENT NUMBER TO NAMe YOUR SIGANTURE ONLY
                                            </small>
                                        </p>
                                        <input type="file" class="form-control" name="signature" id="inputGroupFile01" required>
                                        <br>
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Name</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_gurdian_name" placeholder="Guardian Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Address</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_gurdian_address" placeholder="Guardian Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Contact Number</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_gurdian_number" placeholder="Guardian Contact Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="title_color">Guardian Relationship</span>
                                    </p>
                                    <div class="input-group mb-3">
                                        <input type="text" readonly class="form-control" id="id_gurdian_relationship" placeholder="Guardian Email Address">
                                    </div>
                                </div>
                                <?php
                                if ($this->data['id_app'] === true) {
                                ?>
                                    <!-- <div class="col-md-8"></div> -->
                                    <div class="col-md-12" style="text-align:center">
                                        <button class="btn btn-lg btn-primary btn-hover-red">PROCEED</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
</section>
<script>
    <?php
    if ($this->session->flashdata('success') != '') {
    ?>
        iziToast.success({
            title: 'OK',
            message: 'Successfully inserted record!',
        });
    <?php
    }
    if ($this->session->flashdata('error') != '') {
    ?>
        iziToast.error({
            title: 'Error',
            message: '<?php echo $this->session->flashdata('error'); ?>',
        });
    <?php
    }

    ?>
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
            url: '<?= base_url() ?>Forms/ajaxGetStudent',
            dataType: 'JSON',
            success: function(response) {
                $('#id_reference_number').val(response['Reference_Number']);
                $('#id_student_number').val(response['Student_Number']);
                $('#id_first_name').val(response['First_Name']);
                $('#id_middle_name').val(response['Middle_Name']);
                $('#id_last_name').val(response['Last_Name']);
                $('#id_course').val(response['Course'] + " : " + response['Program_Name']);
                $('#id_gurdian_name').val(response['Guardian_Name']);
                $('#id_gurdian_address').val(response['Guardian_Address']);
                $('#id_gurdian_number').val(response['Guardian_Contact']);
                $('#id_gurdian_relationship').val(response['Guardian_Contact']);
            }
        })
    }
</script>