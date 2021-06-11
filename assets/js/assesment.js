$(document).ready(function () {

    checksession();
    setInterval(function () {
        checksession();
    }, 60000);

});


function checksession() {

    $.ajax({
        url: "/Onestop/index.php/Main/checksession",
        success: function (response) {
            if (response != '') {
                window.location.replace(response);
            }
        }
    });

}


base_url = $('#assessment_section').data('baseurl');
// alert(base_url);
function hideIziToastGuide() {
    var izitoastWalkthrough = document.querySelector('.izitoast-open-walkthrough');
    // iziToast.hide({
    //     transitionOut: 'fadeOutUp'
    // }, izitoastWalkthrough);
}
$('input[type=radio][name=eductype]').change(function () {

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

$('input[type=checkbox][name=shsverification]').change(function () {
    shsChecker = $('.shsverification:checkbox:checked').length > 0
    if (shsChecker) {
        $('.balance-verification').fadeIn();
    } else {
        $('.balance-verification').fadeOut();
    }
});

if ($('input[type=checkbox][name=shsverification]').prop("checked") == true) {
    $('.balance-verification').fadeIn();
}


$('#shs_student_number').on('change', function () {
    applied_status = $('input[type=radio][name=eductype]:checked').val();
    if (applied_status == 'transferee') {
        stundent_number_text = '';
        $("input.shsverification").prop("checked", false)
    } else {
        stundent_number_text = $('#shs_student_number').val();
        if (stundent_number_text.length > 0) {
            $("#educ_new_student_label").prop("checked", true);
        }
        $.ajax({
            url: base_url + "main/shs_balance_checker_echo/" + stundent_number_text + "/" + applied_status,
            dataType: "json",
            success: function (response) {
                if ($.trim(response) != '') {
                    if (response['status'] == 'empty') {
                        $('#shs_student_number').removeClass('is-valid');
                        $('#shs_student_number').addClass('is-invalid');
                        $('#invalid-feedback').html('No Data Found in Database.');
                    } else if (response['status'] == 'dept') {
                        $('#shs_student_number').removeClass('is-valid');
                        $('#shs_student_number').addClass('is-invalid');
                        $('#invalid-feedback').html('You still have BALANCE.');
                    } else if (response['status'] == 'no_dept') {
                        $('#shs_student_number').addClass('is-valid');
                        $('#shs_student_number').removeClass('is-invalid');
                    }
                } else {
                    $('#shs_student_number').removeClass('is-valid');
                    $('#shs_student_number').addClass('is-invalid');
                    $('#invalid-feedback').html('No Data Found in Database.');
                }
                return response['status'];
            }
        })
    }
})
$('#courses').on('change', function () {
    program_code = $('#courses').children("option:selected").val();
    $.ajax({
        url: base_url + "main/get_student_course_major/" + program_code,
        dataType: "json",
        success: function (response) {
            $('#majors').empty();
            html = ""
            if ($.trim(response) != '') {
                $.each(response, function (key, value) {
                    html += "<option value='" + value['ID'] + "'>" + value['Program_Major'] + "</option>"
                });
                $('#majors').append(html);
            } else {
                $('#majors').empty();
                $('#majors').append("<option value='0' disabled selected>NO COURSE MAJOR</option>");
            }
        }
    })
})
init_student_info();
// init_have_course();
$('#courses').on('change', function () {
    program_code = $('#courses').children("option:selected").val();
    $.ajax({
        url: "get_student_information",
        dataType: "json",
        success: function (response) {
            $('#majors').empty();
            $('#majors').append("<option value='0' disabled selected>NO COURSE MAJOR</option>");
            html = ""
            if (response.length > 0) {
                $.each(response, function (key, value) {
                    html += "<option value='" + value['ID'] + "'>" + value['Program_Major'] + "</option>"
                });
                $('#majors').empty();
                $('#majors').append(html);
            }
        }
    })
})
// init_student_info();
// init_have_course();
// });

function init_student_info() {
    $.ajax({
        url: "get_student_information",
        dataType: "json",
        success: function (response) {
            $('#stud_info_reference_number').html(response['Reference_Number']);
            $('#stud_info_first_name').html(response['First_Name']);
            $('#stud_info_middle_name').html(response['Middle_Name']);
            $('#stud_info_last_name').html(response['Last_Name']);
            $('#stud_info_course').html(response['Course']);

            $('#stud_info_address').html('address');
            $('#stud_info_contact').html(response['CP_No']);
            $('#stud_info_first_choice').html(response['Course_1st']);
            $('#stud_info_second_name').html(response['Course_2nd']);
            $('#stud_info_third_name').html(response['Course_3rd']);
            //
            course = 'undefined';
            major = 'undefined';
            if (response['Course'] != 'N/A') {
                course = response['Course'];
                major = response['Major'];
                have_course = $('#have_course');
                have_course.removeAttr('data-have_course');
                have_course.removeAttr('data-have_major');
                have_course.attr('data-have_course', course);
                have_course.attr('data-have_major', major);
                have_course.addClass('have_course');
                // init_have_course(response['Course'], response['Major']);
            }
            init_have_course(course, major);
        }
    })
}
// $('#courses').on('change', function() {
//     if ($('#have_course').data('have_course') != 'undefined') {
//         init_student_info()
//             // alert($('#have_course').data('have_course'));
//     }
// })

function init_have_course(course, major) {
    // course = $('#have_course').data('have_course');
    // major = $('#have_course').data('have_major');
    // alert(course);
    if (course != 'undefined') {
        // alert(course);
        $.ajax({
            url: 'echo_get_student_course_info',
            type: 'post',
            data: {
                program_code: course,
                program_major: major,
            },
            dataType: 'JSON',
            success: function (response) {
                $('#have_course').html('');
                html = 'Your Chosen Program : <br>';
                html += response.Program_Code + ' : ' + response.Program_Name + '<br>';
                if (response.Program_Major != 'N/A') {
                    html += 'Major : ' + response.Program_Major;
                }
                $('#have_course').html(html);
            }
        })
    } else {
        // alert('no course');
        html = 'Choose a Program';
        $('#have_course').html(html);
    }
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
    if ($('#have_course').hasClass('have_course')) {
        // alert($('#have_course').data('have_course'));
        confirm_msg += "<br><b style='color:black'>Changing Course will reset the Subject selected</b><br>";
    }
    stundent_number_text = $('#shs_student_number').val();
    applied_status = $('input[type=radio][name=eductype]:checked').val();
    // alert(applied_status);
    if ($('.wizard-proceed-advising').hasClass('old-student')) {
        wizard_requirements();
        $('#student_information_content').removeClass('active');
    } else {
        if (applied_status == 'transferee') {
            // console.log(applied_status);
            stundent_number_text = '';
            $("input.shsverification").prop("checked", false)
        } else if (applied_status == 'freshmen') {
            $("#educ_new_student_label").prop("checked", true);
        } else {
            izi_toast('You did NOT select your STATUS!', 'Are you a new student or tranferee?', 'red');
            event.preventDefault();
            return
        }
        if (program_code != 'none') {
            if ($('input.shsverification').is(':checked')) {
                if (stundent_number_text == "" || stundent_number_text == null) {
                    izi_toast('Snap!', 'You did NOT enter your Senior high Student Number!', 'red');
                    event.preventDefault();
                    return;
                }
            } else {
                $('#shs_student_number').val('');
                stundent_number_text = '';
            }

            event.preventDefault();
            iziToast.question({
                timeout: 200000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: confirm_msg,
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function (instance, toast) {
                        $.ajax({
                            url: base_url + "index.php/main/update_course_by_reference_number",
                            type: "post",
                            data: {
                                course: program_code,
                                major: program_major_select,
                                student_number: stundent_number_text,
                                status: applied_status,
                            },
                            dataType: "json",
                            success: function (response) {
                                // alert(response['title']);
                                if (response['status'] == 'success') {
                                    izi_toast(response['title'], response['body'], 'green');
                                    // location.reload();
                                    wizard_requirements();
                                    if ($('#have_course').data('have_course') != 'undefined') {
                                        init_remove_all_queue();
                                        init_subjectlists();
                                        init_paymentmethod();
                                    }
                                    init_student_info();
                                    // init_have_course();
                                    $("#student_information_content").removeClass("active");
                                    hideIziToastGuide();
                                    var ose_guide1 = new OSE_Guide('requirements');
                                    ose_guide1.play();
                                } else {
                                    izi_toast(response['title'], response['body'], 'red');
                                }
                            },
                        })

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        event.preventDefault();

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
                onClosing: function (instance, toast, closedBy) {
                    console.info('Closing | closedBy: ' + closedBy);
                },
                onClosed: function (instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                }
            });
        } else {
            event.preventDefault();
            izi_toast('Snap!', 'You did NOT select a Course!', 'red');
            // alert("You did NOT select a Course!");
        }
    }
}

function izi_toast(title = '', msg = '', color = 'green', position = 'topCenter') {
    iziToast.show({
        title: title,
        message: msg,
        color: color,
        position: position,
        closeOnEscape: true,
        closeOnClick: true,
        timeout: 10000,
        // progressBar: false,
        transitionIn: 'fadeIn',
        transitionOut: 'fadeOut',
    });
}