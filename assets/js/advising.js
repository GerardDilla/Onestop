$(document).ready(function() {

    init_sectionlist();

    init_queuedlist();

    init_assessmentform();

    $('.add-all-subject').hide();

    $('#subjectTable').DataTable({
        "ordering": false
    });

    $('#queueTable').DataTable({
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
    });

    $('input[type=radio][name=payment-option]').change(function() {

        init_paymentmethod(this.value);

    });

    $('#advise_button').click(function() {

        init_advise();

    });

    $('#section').change(function() {

        if ($('#queueTable').data('queueResult') == 0) {
            init_subjectlists();
        } else {

            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'queue_question',
                zindex: 1500,
                message: 'Changing Section will remove all Queued Subjects. Do you want to proceed?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {

                        // Remove Queue Code
                        init_remove_all_queue();

                        // Display new choices
                        init_subjectlists();

                        init_paymentmethod();

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function(instance, toast) {

                        event.preventDefault();
                        $('#section').val('none');
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

        }



    });

    $('.setpaid_test').click(function() {
        init_enroll_test();
        fetch_user_status();
        location.reload();
    });

    $('.reset_progress_test').click(function() {
        init_reset_progress();
        fetch_user_status();
    });

    $('.add-all-subject').click(function() {
        init_addAll();
    });


});


function init_advise() {

    plan = $('input[type=radio][name=payment-option]:checked').val();
    result = ajax_adviseStudent(plan);
    result.success(function(response) {

        // response = JSON.parse(response);
        init_queuedlist();
        init_assessmentform();
        fetch_user_status();
    })

}

function init_assessmentform() {

    result = ajax_assessmentform();
    result.success(function(response) {

        if (response != false) {
            response = JSON.parse(response);
            console.log('-----------');
            assessmentform_renderer(response);
        }

    });

}

function init_registrationform() {

    result = ajax_registrationform();
    result.success(function(response) {
        response = JSON.parse(response);
        registrationform_renderer(response);
    })

}

function init_sectionlist() {

    subjects = ajax_sectionlist();
    subjects.success(function(response) {
        response = JSON.parse(response);
        section_renderer(response);
        init_subjectlists();
    })

}

function init_subjectlists() {

    subjects = ajax_subjectlist();
    subjects.success(function(response) {
        console.log('tablerun');
        response = JSON.parse(response);
        if (response['data'].length != 0) {
            subject_tablerenderer($('#subjectTable'), response);
            $('.add-all-subject').show();
        } else {
            $('.add-all-subject').hide();
        }

    })
}

function init_addAll() {

    result = ajax_add_all_subjects();
    result.success(function(response) {

        init_queuedlist();
        izi_toast('', 'Subjects Added to Queue', 'green', 'bottomRight');
    })

}

function init_add_queue(row) {

    schedcode = $(row).data('schedcode');
    queue_status = ajax_insertqueue(schedcode);
    queue_status.success(function(response) {
        response = JSON.parse(response);
        if (response['status'] == 0) {
            izi_toast('', response['data'], 'red', 'bottomRight');
        } else {
            izi_toast('', 'Added to Queue', 'green', 'bottomRight');
        }

        init_paymentmethod($('input[type=radio][name=payment-option]').value);
        init_queuedlist();
    });

}


function init_remove_queue(row) {

    sessionid = $(row).data('sessionid');
    queue_status = ajax_removequeue(sessionid);
    queue_status.success(function(response) {
        izi_toast('', `Removed from Queue: ${response}`, 'green', 'bottomRight');
        init_paymentmethod($('input[type=radio][name=payment-option]').value);
        init_queuedlist();
    });


}


function init_queuedlist() {

    queue = ajax_queuedlist();
    queue.success(function(response) {

        response = JSON.parse(response);
        if (response['data'].length != 0) {
            // console.log(response['data'][0]['Section']);
            // $('#section').val(response[0]['Section']);
            init_paymentmethod();
        }
        console.log(response);
        queue_tablerenderer($('#queueTable'), response);

    })

}

function init_paymentmethod(value = 'installment') {

    result = ajax_paymentmethod(value);
    result.success(function(response) {

        response = JSON.parse(response);
        console.log(response);
        paymentplan_tablerenderer(response);
    })
}

function init_enroll_test() {

    ajax_enroll_test();


}

function init_reset_progress() {

    reset_status = ajax_reset_progress();
    reset_status.success(function(result) {
        location.reload();
    });

}

function init_remove_all_queue() {

    removal_status = ajax_removeAllqueue();
    removal_status.success(function(result) {
        init_queuedlist();
        init_paymentmethod();
    })

}

function ajax_enroll_test(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/setpaid_test",
        async: true,
    });
}

function ajax_reset_progress(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/reset_progress",
        async: true,
    });
}

function ajax_adviseStudent(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/advise_student",
        async: true,
        type: 'GET',
        data: {
            plan: paymentplan,
            section: $('#section').val(),
        }
    });
}

function ajax_add_all_subjects(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/queue_all_subjects",
        async: true,
        type: 'POST',
        data: {
            section: $('#section').val(),
        }
    });
}

function ajax_assessmentform(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/temporary_regform_ajax",
        async: true,
    });
}

function ajax_registrationform(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/Forms",
        async: true,
    });
}

function ajax_paymentmethod(paymentplan) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/payment_plan",
        async: true,
        type: 'GET',
        data: {
            plan: paymentplan,
            section: $('#section').val(),
        }
    });

}

function ajax_subjectlist() {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/subjects",
        type: 'GET',
        data: {
            section: $('#section').val(),
        }
    });
}

function ajax_sectionlist() {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/get_section",
        async: true,
    });
}

function ajax_insertqueue(schedcode) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/queue_subject",
        async: false,
        type: 'POST',
        data: {
            schedcode: schedcode,
            section: $('#section').val(),
        }
    });
}

function ajax_removequeue(sessionID) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/unqueue_subject",
        async: false,
        type: 'POST',
        data: {
            sessionId: sessionID,
        }
    });
}

function ajax_removeAllqueue(sessionID) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/unqueue_all",
        async: true,
    });
}

function ajax_queuedlist() {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/queue_subject_list",
        async: true,
        type: 'POST'
    });

}

function queue_tablerenderer(element = '', data = []) {

    element.DataTable().clear();
    element.DataTable().destroy();


    tablebody = element.find('tbody');
    tablebody.html('');
    count = 0;
    units = 0;
    //array sched start loop
    $.each(data['data'], function(index, row) {
        computeSched(row['Start_Time'], row['End_Time'], row['Day'], row['Course_Code'], row['Course_Title'], row['from_time'], row['to_time'])
        if (data['status'] == true) {
            tablebody.append($('<tr/>').append('\
            <td>' + row['Sched_Code'] + '</td>\
            <td>' + row['Course_Code'] + '</td>\
            <td>' + row['Course_Title'] + '</td>\
            <td>' + row['Section_Name'] + '</td>\
            <td>' + (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
            <td><button type="button" class="btn btn-primary" onclick="init_remove_queue(this)" data-sessionid="' + row['session_id'] + '">Remove</btn></td>\
            '));
        } else {
            tablebody.append($('<tr/>').append('\
            <td>' + row['Sched_Code'] + '</td>\
            <td>' + row['Course_Code'] + '</td>\
            <td>' + row['Course_Title'] + '</td>\
            <td>' + row['Section_Name'] + '</td>\
            <td>' + (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
            <td></td>\
            '));
        }
        count++;
        units = units + (parseInt(row['Course_Lec_Unit']) + parseInt(row['Course_Lab_Unit']));
        console.log(units);
    });
    $('#queueTable').data('queueResult', count);
    $('#queueTable').data('units', units);
    // alert($('#queueTable').data('units'));

    element.DataTable({
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,

    });

}

function subject_tablerenderer(element = '', data = []) {

    element.DataTable().clear();
    element.DataTable().destroy();

    tablebody = element.find('tbody');
    tablebody.html('');
    //array sched start loop
    $.each(data['data'], function(index, row) {

        if (data['status'] == true) {
            tablebody.append($('<tr/>').append('\
            <td>' + row['Sched_Code'] + '</td>\
            <td>' + row['Course_Code'] + '</td>\
            <td>' + row['Course_Title'] + '</td>\
            <td>' + row['Section_Name'] + '</td>\
            <td>' + (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
            <td>' + row['Day'] + '</td>\
            <td>' + row['Start_Time'] + ' - ' + row['End_Time'] + '</td>\
            <td> <button class="btn btn-info" onclick="init_add_queue(this)" data-schedcode="' + row['Sched_Code'] + '">Add</btn></td>\
            '));
        } else {
            tablebody.append($('<tr/>').append('\
            <td>' + row['Sched_Code'] + '</td>\
            <td>' + row['Course_Code'] + '</td>\
            <td>' + row['Course_Title'] + '</td>\
            <td>' + row['Section_Name'] + '</td>\
            <td>' + (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
            <td>' + row['Day'] + '</td>\
            <td>' + row['Start_Time'] + ' - ' + row['End_Time'] + '</td>\
            <td></td>\
            '));
        }
    });

    element.DataTable({
        "ordering": false,
        "bPaginate": false,
        "columns": [
            null,
            null,
            { "width": "40%" },
            null,
            null,
            null,
            null,
            null,
        ]
    });

}

function paymentplan_tablerenderer(data = []) {

    if ($('#queueTable').data('queueResult') == 0) {

        default_val = '0.00';
        $('#other_fee').html(default_val);
        $('#misc_fee').html(default_val);
        $('#lab_fee').html(default_val);
        $('#tuition_fee').html(default_val);
        $('#total_fee').html(default_val);

    } else {

        other_fee = parseFloat(data['other_fee']);
        misc_fee = parseFloat(data['misc_fee']);
        lab_fee = parseFloat(data['lab_fee']);
        tuition_fee = parseFloat(data['tuition_fee']);
        total_fee = parseFloat(data['total_fee']);

        $('#other_fee').html(other_fee.toFixed(2));
        $('#misc_fee').html(misc_fee.toFixed(2));
        $('#lab_fee').html(lab_fee.toFixed(2));
        $('#tuition_fee').html(tuition_fee.toFixed(2));
        $('#total_fee').html(total_fee.toFixed(2));


    }



}

function schedule_tablerenderer(element, time = []) {

    days = {
        M: 'Monday',
        T: 'Tuesday',
        W: 'Wednesday',
        TH: 'Thursday',
        F: 'Friday',
        S: 'Saturday',
        SUN: 'Sunday'
    };

    //Make Columns
    tablehead = element.find('thead');
    tablehead.html('');
    tablehead.append('<tr>');
    tablehead.append('<th></th>');
    $.each(days, function(index, day) {

        tablehead.append('<th>' + day + '</th>');

    });
    tablehead.append('</tr>');

}

$('#online_payment_form').submit(function(e) {
    if (!$('.downpayment:checkbox').prop("checked")) {
        if ($('.payment_check:checkbox:checked').length <= 0) {
            iziToast.error({
                title: 'Error: ',
                message: 'Error',
                position: 'topRight',
            });
            e.stopPropagation();
            e.preventDefault();
            return;
        }
    }
});
// $('#select_pay_submit').on('click', function(e) {
//     $('input[name=select_pay]:checkbox:checked').each(function(i) {
//         if ($(this).data('payment') == "" || $(this).data('payment') == null) {
//             iziToast.error({
//                 title: 'Error: ',
//                 message: 'Error',
//                 position: 'topRight',
//             });
//             e.stopPropagation();
//             e.preventDefault();
//             return;
//         }
//     });
// })
function downpayment_checked() {
    if ($('.downpayment:checkbox').prop("checked")) {
        $('.payment_check:checkbox').each(function(i) {
            $(this).prop("disabled", true);
            $(this).prop("checked", false);
            $('#payment_total_value').html('5000.00');
        });
    } else {
        $('.payment_check:checkbox').each(function(i) {
            $(this).removeAttr('disabled');
        });
        $('#payment_total_value').html('0');
    }
}

function get_total_value() {
    var total = 0;
    $('.payment_check:checkbox:checked').each(function(i) {
        total += parseFloat($(this).data('paymentvalue'));
    });
    $('#payment_total_value').html(total);
}

function assessmentform_renderer(resultdata = []) {

    //Displays DATA
    //Displays Basic Info
    $('#trf_rn').html(resultdata['get_Advise'][0]['Reference_Number']);
    $('#trf_name').html(resultdata['get_Advise'][0]['First_Name'] + ' ' + resultdata['get_Advise'][0]['Middle_Name'][0] + ' ' + resultdata['get_Advise'][0]['Last_Name']);
    $('#trf_address').html(
        resultdata['get_Advise'][0]['Address_No'] + ', ' +
        resultdata['get_Advise'][0]['Address_Street'] + ', ' +
        resultdata['get_Advise'][0]['Address_Subdivision'] + ', ' +
        resultdata['get_Advise'][0]['Address_Barangay'] + ', ' +
        resultdata['get_Advise'][0]['Address_City'] + ', ' +
        resultdata['get_Advise'][0]['Address_Province']
    );
    $('#trf_sem').html(resultdata['get_Advise'][0]['Semester']);
    $('#trf_course').html(resultdata['get_Advise'][0]['Course']);
    $('#trf_sy').html(resultdata['get_Advise'][0]['School_Year']);
    $('#trf_yl').html(resultdata['get_Advise'][0]['Year_Level']);
    $('#trf_sec').html(resultdata['get_Advise'][0]['Section']);

    //Displays Payments
    $('#trf_tuition').html(resultdata['get_Advise'][0]['tuition_Fee']);
    $('#trf_misc').html(resultdata['get_miscfees'][0]['Fees_Amount']);

    get_advise_initial = resultdata['get_Advise'][0]['InitialPayment'];
    get_advise_first = resultdata['get_Advise'][0]['First_Pay'];
    get_advise_second = resultdata['get_Advise'][0]['Second_Pay'];
    get_advise_third = resultdata['get_Advise'][0]['Third_Pay'];
    get_advise_fourth = resultdata['get_Advise'][0]['Fourth_Pay'];

    $('#trf_other').html(resultdata['get_otherfees'][0]['Fees_Amount']);
    $('#trf_initial').html(get_advise_initial);
    $('#trf_first').html(get_advise_first);
    $('#trf_second').html(get_advise_second);
    $('#trf_third').html(get_advise_third);
    $('#trf_fourth').html(get_advise_fourth);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);


    total = parseFloat(get_advise_initial) + parseFloat(get_advise_first) +
        parseFloat(get_advise_second) + parseFloat(get_advise_third) +
        parseFloat(get_advise_fourth);
    $('#initial_checkbox').attr('data-paymentvalue', get_advise_initial);
    $('#initial_value').html(get_advise_initial);
    $('#first_checkbox').attr('data-paymentvalue', get_advise_first);
    $('#first_value').html(get_advise_first);
    $('#second_checkbox').attr('data-paymentvalue', get_advise_second);
    $('#second_value').html(get_advise_second);
    $('#third_checkbox').attr('data-paymentvalue', get_advise_third);
    $('#third_value').html(get_advise_third);
    $('#fourth_checkbox').attr('data-paymentvalue', get_advise_fourth);
    $('#fourth_value').html(get_advise_fourth);
    if (
        get_advise_first == 0 &&
        get_advise_second == 0 &&
        get_advise_third == 0 &&
        get_advise_fourth == 0
    ) {
        $('#downpayment_tr').remove();
    }
    //Lab Fees
    /*
    labfee = 0;
    $.each(resultdata['get_labfees'], function(index, labresult) 
    {
        labfee = labfee + parseFloat(labresult['Lab_Fee']);  
    });
    */
    labfee = parseFloat(resultdata['get_labfees'][0]['Fees_Amount']);
    $('#trf_lab').html(labfee);

    //Total Fees
    total_fees = parseFloat(resultdata['get_Advise'][0]['tuition_Fee']) +
        parseFloat(resultdata['get_miscfees'][0]['Fees_Amount']) +
        labfee +
        parseFloat(resultdata['get_otherfees'][0]['Fees_Amount']);

    $('#trf_total_fees').html(total_fees);


    //Displays Sched
    showtable = $('#temporary_regform_subjects');
    //clears the table before append
    showtable.html('');
    sched_checking = '';
    units = 0;
    subjectcount = 0;
    $.each(resultdata['get_Advise'], function(index, result) {
        row = $("<tr/>");
        if (sched_checking != result['Sched_Code']) {

            //Set custom attribute 'sched-code'
            units = units + (parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit']));
            subjectcount++;
            row.append($("<td/>").text(result['Sched_Code']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Course_Code']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Course_Title']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit'])).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Day']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_day' }));
            row.append($("<td/>").text(result['START'] + ' - ' + result['END']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_time' }));
            row.append($("<td/>").text(result['Room']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_room' }));


        } else {
            $('#' + result['Sched_Code'] + '_day').append(' , ' + result['Day']);
            $('#' + result['Sched_Code'] + '_time').append(' , ' + result['START'] + ' - ' + result['END']);
            $('#' + result['Sched_Code'] + '_room').append(' , ' + result['Room']);
        }

        showtable.append(row);
        sched_checking = result['Sched_Code'];

    });

    //Total Units and Subjects
    $('#trf_total_units').html(units);
    $('#trf_total_subject').html(subjectcount);

    $('#regform').modal('show');

}

function registrationform_renderer(resultdata = []) {

    //Displays DATA
    //Displays Basic Info
    $('#reg_rn').html(resultdata['student_data'][0]['Reference_Number']);
    $('#reg_name').html(resultdata['student_data'][0]['First_Name'] + ' ' + resultdata['student_data'][0]['Middle_Name'][0] + ' ' + resultdata['student_data'][0]['Last_Name']);
    $('#reg_address').html(
        resultdata['student_data'][0]['Address_No'] + ', ' +
        resultdata['student_data'][0]['Address_Street'] + ', ' +
        resultdata['student_data'][0]['Address_Subdivision'] + ', ' +
        resultdata['student_data'][0]['Address_Barangay'] + ', ' +
        resultdata['student_data'][0]['Address_City'] + ', ' +
        resultdata['student_data'][0]['Address_Province']
    );
    $('#reg_sem').html(resultdata['student_data'][0]['Semester']);
    $('#reg_course').html(resultdata['student_data'][0]['Course']);
    $('#reg_sy').html(resultdata['student_data'][0]['School_Year']);
    $('#reg_yl').html(resultdata['student_data'][0]['Year_Level']);
    $('#reg_sec').html(resultdata['student_data'][0]['Section']);

    //Displays Payments
    $('#reg_tuition').html(resultdata['student_data'][0]['tuition_Fee']);
    $('#reg_misc').html(resultdata['get_miscfees'][0]['Fees_Amount']);

    $('#reg_other').html(resultdata['get_otherfees'][0]['Fees_Amount']);
    $('#reg_initial').html(resultdata['student_data'][0]['InitialPayment']);
    $('#reg_first').html(resultdata['student_data'][0]['First_Pay']);
    $('#reg_second').html(resultdata['student_data'][0]['Second_Pay']);
    $('#reg_third').html(resultdata['student_data'][0]['Third_Pay']);
    $('#reg_fourth').html(resultdata['student_data'][0]['Fourth_Pay']);
    $('#reg_scholar').html(resultdata['student_data'][0]['Scholarship']);
    $('#reg_scholar').html(resultdata['student_data'][0]['Scholarship']);
    //Lab Fees 
    /*
    labfee = 0;
    $.each(resultdata['get_labfees'], function(index, labresult) 
    {
        labfee = labfee + parseFloat(labresult['Lab_Fee']);  
    }); 
    */
    labfee = parseFloat(resultdata['get_labfees'][0]['Fees_Amount']);
    $('#reg_lab').html(labfee);

    //Total Fees
    total_fees = parseFloat(resultdata['student_data'][0]['tuition_Fee']) +
        parseFloat(resultdata['get_miscfees'][0]['Fees_Amount']) +
        labfee +
        parseFloat(resultdata['get_otherfees'][0]['Fees_Amount']);

    $('#reg_total_fees').html(total_fees);


    //Displays Sched
    showtable = $('#registration_form');
    //clears the table before append
    showtable.html('');
    sched_checking = '';
    units = 0;
    subjectcount = 0;
    $.each(resultdata['student_data'], function(index, result) {
        row = $("<tr/>");
        if (sched_checking != result['Sched_Code']) {

            //Set custom attribute 'sched-code'
            units = units + (parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit']));
            subjectcount++;
            row.append($("<td/>").text(result['Sched_Code']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Course_Code']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Course_Title']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit'])).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;' }));
            row.append($("<td/>").text(result['Day']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_day' }));
            row.append($("<td/>").text(result['START'] + ' - ' + result['END']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_time' }));
            row.append($("<td/>").text(result['Room']).attr({ valign: 'top', width: '10%', style: 'padding-right: 10px;  padding-top: 1px;', id: result['Sched_Code'] + '_room' }));


        } else {
            $('#' + result['Sched_Code'] + '_day').append(' , ' + result['Day']);
            $('#' + result['Sched_Code'] + '_time').append(' , ' + result['START'] + ' - ' + result['END']);
            $('#' + result['Sched_Code'] + '_room').append(' , ' + result['Room']);
        }

        showtable.append(row);
        sched_checking = result['Sched_Code'];

    });

    //Total Units and Subjects
    $('#reg_total_units').html(units);
    $('#reg_total_subject').html(subjectcount);

    $('#regform').modal('show');

}

function section_renderer(data) {

    $('#section').html('<option value="none" disabled selected>SELECT SECTION</option>');
    $.each(data['sections'], function(index, result) {
        $('#section').append('<option value="' + result['Section_ID'] + '">' + result['Section_Name'] + '</option>');
    });
    $('#section').val(data['section_id']);
}

function assessment_exporter(url) {

    exportpage = window.open(url, '_blank');
}

function get_militarytime() {

    starttime = 700;
    endtime = 2100;
    time = [];
    while (starttime < endtime) {

        time.push(starttime);
        lastcharacter = starttime.toString().length == 3 ? starttime.toString().substr(1) : starttime.toString().substr(2);
        if (lastcharacter == 30) {
            starttime = starttime + 70;
        } else {
            starttime = starttime + 30;
        }
        // console.log(starttime + '| Last:' + lastcharacter);
    }
    console.log(time);
    return time;

}

function computeSched(start, end, this_day, subject, title, from, to) {
    var start_time = parseInt(start);
    var end_time = parseInt(end);
    var day = this_day == 'S' ? 'SA' : this_day;
    var schedule_array = [700, 730, 800, 830, 900, 930, 1000, 1030, 1100, 1130, 1200, 1230, 1300, 1330, 1400, 1430, 1500, 1530, 1600, 1630, 1700, 1730, 1800, 1830, 1900, 1930, 2000, 2030, 2100];
    var filtered = schedule_array.filter((time) => { return time >= start_time && time <= end_time });
    console.log(filtered);
    console.log(day);
    $.each(filtered, function(index, val) {

            if (day == "M") {
                var bg_color = "EA49E5"
            } else if (day == "T") {
                var bg_color = "18EAC8"
            } else if (day == "W") {
                var bg_color = "EA5E18"
            } else if (day == "H") {
                var bg_color = "EAD618"
            } else if (day == "F") {
                var bg_color = "B1EA18"
            } else if (day == "SA") {
                var bg_color = "1860EA"
            } else {
                var bg_color = "18EA4A"
            }

            $(`#${val + '_' + day}`).css('background', `#${bg_color}`);
        })
        // $(`#${start_time + '_' + day}`).html(`<div class="sched-subject"><strong>${from + ' to ' + to}</strong><br>${subject}</div>`);
    $(`#${start_time + '_' + day}`).html(`<div class="sched-subject"><strong>${title}</strong><br>${subject}</div>`);
}