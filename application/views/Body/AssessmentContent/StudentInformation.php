<div class="row">
    <div class="col-md-12">
        <!-- <div id="base_url" class="base_url" data-baseurl="<?php echo base_url(); ?>"></div> -->
        <div class="row">
            <h6 class="col-md-12" style="margin-bottom:15px">YOUR INFORMATION</h6>
            <div class="col-md-6">
                <table class="table" style="display: block; overflow: auto;">
                    <tbody>
                        <tr>
                            <td>FIRST NAME:</td>
                            <td>JUAN</td>
                        </tr>
                        <tr>
                            <td>MIDDLE NAME:</td>
                            <td>DELA</td>
                        </tr>
                        <tr>
                            <td>LAST NAME:</td>
                            <td>CRUZ</td>
                        </tr>
                        <tr>
                            <td>REFERENCE NUMBER:</td>
                            <td>123456</td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="col-md-12">
                <HR>
                <h6>CHOOSE YOUR STATUS</h6>
                <br>
                <input type="radio" class="btn-check" name="eductype" id="success-outlined" data-etype='freshmen' autocomplete="off" checked="checked">
                <label class="btn btn-sm btn-outline-primary" for="success-outlined">
                    NEW STUDENT
                </label>

                <input type="radio" class="btn-check" name="eductype" id="danger-outlined" data-etype='transferee' autocomplete="off">
                <label class="btn btn-sm btn-outline-primary" for="danger-outlined">
                    TRANSFEREE
                </label>

            </div>

            <div class="col-md-12 shs-verification">
                <br>
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input form-check-primary shsverification" name="shsverification">
                        <label class="form-check-label" for="customColorCheck1">I Graduated from St. Dominic College of Asia</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12 balance-verification" style="display:none">
                <br>
                <div class="form-check" style="padding-left:0px">
                    <div class="form-group">
                        <label for="helperText">Senior Highschool Student Number</label>
                        <input type="text" id="helperText" class="form-control" placeholder="Shs Student Number">
                        <!-- <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div> -->
                        <div class="valid-feedback" id="valid-feedback">
                            This Student Number is VALID.
                        </div>
                        <div class="invalid-feedback" id="invalid-feedback">

                        </div>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
                <h6>CONFIRM YOUR COURSE</h6>
                <small>Choose one of your preferred courses</small>
                <BR>
                <fieldset class="form-group">
                    <select class="form-select" id="courses" required>
                        <option value="none" disabled selected>PREFERRED COURSES</option>
                        <?php
                        // if ($reference_number_from_session) {
                        if ($this->data['courses']) {
                            foreach ($this->data['courses'] as $index => $course) {
                                echo "<option value='$course'>$course : " . $this->data['courses_info'][$index]['Program_Name'] . "</option>";
                            }
                        }
                        // } else {
                        ?>
                        <!-- <option value="none" disabled selected>No Session Get</option> -->
                        <?php
                        // }
                        ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <select class="form-select" id="majors">
                        <option value="none" disabled selected>COURSE MAJOR</option>

                    </select>
                </fieldset>
            </div>
        </div>
        <br>
    </div>
</div>

<!-- Will remove later in development -->

<script>
    $(document).ready(function() {
        base_url = $('#assessment_section').data('baseurl');

        $('input[type=radio][name=eductype]').change(function() {
            type = $(this).data('etype');
            if (type == 'freshmen') {
                $('.shs-verification').fadeIn();
                shsChecker = $('.shsverification:checkbox:checked').length > 0
                if (shsChecker) {
                    $('.balance-verification').fadeIn();
                } else {
                    $('.balance-verification').fadeOut();
                }
            } else {
                $('.shs-verification').fadeOut();
                $('.balance-verification').fadeOut();
            }
            // console.log('Changed');
        });

        $('input[type=checkbox][name=shsverification]').change(function() {

            shsChecker = $('.shsverification:checkbox:checked').length > 0
            if (shsChecker) {
                $('.balance-verification').fadeIn();
            } else {
                $('.balance-verification').fadeOut();
            }

        });



    });
    $('#helperText').on('change', function() {
        stundent_number_text = $('#helperText').val();
        $.ajax({
            url: base_url + "main/shs_balance_checker/" + stundent_number_text,
            dataType: "json",
            success: function(response) {
                if ($.trim(response) != '') {

                    if (response['status'] == 'empty') {
                        $('#helperText').removeClass('is-valid');
                        $('#helperText').addClass('is-invalid');
                        $('#invalid-feedback').html('No Data Found in Database.');
                    } else if (response['status'] == 'dept') {
                        $('#helperText').removeClass('is-valid');
                        $('#helperText').addClass('is-invalid');
                        $('#invalid-feedback').html('You still have BALANCE.');
                    } else if (response['status'] == 'no_dept') {
                        $('#helperText').addClass('is-valid');
                        $('#helperText').removeClass('is-invalid');
                    }
                } else {
                    $('#helperText').removeClass('is-valid');
                    $('#helperText').addClass('is-invalid');
                    $('#invalid-feedback').html('No Data Found in Database.');
                }
            }
        })
    })
    $('#courses').on('change', function() {
        program_code = $('#courses').children("option:selected").val();
        $.ajax({
            url: base_url + "main/get_student_course_major/" + program_code_selected,
            dataType: "json",
            success: function(response) {
                // alert(response);
                // $('#majors').;
                if ($.trim(response) != '') {
                    alert('May nakuha');
                } else {
                    alert('walang nakuha');
                }
            }
        })
    })
</script>