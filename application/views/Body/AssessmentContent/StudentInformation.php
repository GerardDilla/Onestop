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
                <button class="btn btn-sm btn-primary" onclick="submit_course()" for="success-outlined">
                    SUBMIT COURSE
                </button>
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
            url: base_url + "main/get_student_course_major/" + program_code,
            dataType: "json",
            success: function(response) {
                $('#majors').empty();
                html = ""
                if ($.trim(response) != '') {
                    $.each(response, function(key, value) {
                        html += "<option value='" + value['ID'] + "'>" + value['Program_Major'] + "</option>"
                    });
                    $('#majors').append(html);
                } else {
                    $('#majors').empty();
                    $('#majors').append("<option value='none' disabled selected>NO COURSE MAJOR</option>");
                }
            }
        })
    })

    function izi_toast(title,msg,color) {
        iziToast.show({
            title: title,
            message: msg,
            color: color,
            position: 'center',
            closeOnEscape: true,
            closeOnClick: true,
            timeout: 10000,
            // progressBar: false,
            transitionIn: 'fadeIn',
            transitionOut: 'fadeOut',
        });
    }

    function submit_course() {
        program_code = $('#courses').children("option:selected").val();
        program_course = $("#courses option:selected").text();
        program_major = $("#majors option:selected").text();
        program_major_select = $('#majors').children("option:selected").val();
        confirm_msg = "<b style='color:black'>Are you sure you want:</b><br>" + program_course;
        if (program_major_select != 'none') {
            confirm_msg += "<br>Major in: " + program_major;
        }
        if (program_code != 'none') {
            event.preventDefault();
            // if (confirm(confirm_msg) == true) {
            //     $.ajax({
            //         url: base_url + "main/update_course_by_reference_number",
            //         type: "post",
            //         data: {
            //             course: program_code,
            //             major: program_major_select
            //         },
            //         success: function(response) {
            //             alert(response);
            //         },
            //     })
            // } else {
            //     event.preventDefault();
            // }
            iziToast.question({
                timeout: 200000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                // title: 'Hey',
                message: confirm_msg,
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {

                        $.ajax({
                            url: base_url + "main/update_course_by_reference_number",
                            type: "post",
                            data: {
                                course: program_code,
                                major: program_major_select
                            },
                            dataType: "json",
                            success: function(response) {
                                // alert(response['title']);
                                if(response['status'] == 'success'){
                                    izi_toast(response['title'],response['body'],'green');
                                }else{
                                    izi_toast(response['title'],response['body'],'red');
                                }
                            },
                        })

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function(instance, toast) {

                        event.preventDefault();

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
                onClosing: function(instance, toast, closedBy) {
                    console.info('Closing | closedBy: ' + closedBy);
                },
                onClosed: function(instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                }
            });
        } else {
            event.preventDefault();
            izi_toast('Snap!','You did NOT select a Course!','red');
            // alert("You did NOT select a Course!");
        }
    }
</script>