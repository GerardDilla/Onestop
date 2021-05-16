$(document).ready(function () {

    // init_subjectlists();

    init_queuedlist();

    init_paymentmethod();

    init_assessmentform();

    init_sectionlist();

    // jspdftest();

    $('#subjectTable').DataTable({
        "ordering": false
    });
    
    
    // $('[data-toggle="tooltip"]').tooltip();
    $('#queueTable').DataTable({
        ordering: false,
        "bPaginate": false,
        "bLengthChange": false,
        "responsive": true,
        // "bInfo" : false,
    });
    $('input[type=radio][name=payment-option]').change(function () {

        init_paymentmethod(this.value);

    });

    $('#advise_button').click(function () {

        init_advise();

    });

    $('#section').click(function () {
        init_subjectlists();
    });

    $('.setpaid_test').click(function () {
        init_enroll_test();
        fetch_user_status();
    });

    $('.reset_progress_test').click(function () {
        init_reset_progress();
        fetch_user_status();
    });





});


function init_advise() {

    plan = $('input[type=radio][name=payment-option]:checked').val();
    result = ajax_adviseStudent(plan);
    result.success(function (response) {

        // response = JSON.parse(response);
        init_queuedlist();
        init_assessmentform();
    })

}

function init_assessmentform() {

    result = ajax_assessmentform();
    result.success(function (response) {

        if (response != false) {
            response = JSON.parse(response);
            console.log('-----------');
            assessmentform_renderer(response);
        }

    });

}

function init_sectionlist() {

    subjects = ajax_sectionlist();
    subjects.success(function (response) {
        response = JSON.parse(response);
        section_renderer(response);
        init_subjectlists();
    })

}

function init_subjectlists() {

    subjects = ajax_subjectlist();
    subjects.success(function (response) {
        console.log('tablerun');
        response = JSON.parse(response);
        subject_tablerenderer($('#subjectTable'), response);
        init_scheduleplot();
    })

}

function init_add_queue(row) {
    console.log(row)
    schedcode = $(row).data('schedcode');
    ajax_insertqueue(schedcode);
    init_paymentmethod($('input[type=radio][name=payment-option]').value);
    init_queuedlist();

}


function init_remove_queue(row) {

    sessionid = $(row).data('sessionid');
    ajax_removequeue(sessionid);
    init_paymentmethod($('input[type=radio][name=payment-option]').value);
    init_queuedlist();


}

function computeSched(start,end,this_day,subject,from,to){
    var start_time = parseInt(start);
    var end_time = parseInt(end);
    var day = this_day=='S'?'SA':this_day;
    var schedule_array = [700,730,800,830,900,930,1000,1030,1100,1130,1200,1230,1300,1330,1400,1430,1500,1530,1600,1630,1700,1730,1800,1830,1900,1930,2000,2030,2100];
    var filtered = schedule_array.filter((time) => { return time >= start_time && time <= end_time});
    console.log(filtered);
    console.log(day);
    $.each(filtered,function(index,val){
        
        if(day=="M"){
            var bg_color = "EA49E5"
        }
        else if(day=="T"){
            var bg_color = "18EAC8"
        }
        else if(day=="W"){
            var bg_color = "EA5E18"
        }
        else if(day=="H"){
            var bg_color = "EAD618"
        }
        else if(day=="F"){
            var bg_color = "B1EA18"
        }
        else if(day=="SA"){
            var bg_color = "1860EA"
        }
        else{
            var bg_color = "18EA4A"
        }

        $(`#${val+'_'+day}`).css('background',`#${bg_color}`);
    })
    $(`#${start_time+'_'+day}`).html(`<div class="sched-subject"><strong>${from+' to '+to}</strong><br>${subject}</div>`);
}

function init_queuedlist() {

    queue = ajax_queuedlist();
    queue.success(function (response) {

        response = JSON.parse(response);
        console.log(response);
        queue_tablerenderer($('#queueTable'), response);
    })

}

function init_paymentmethod(value = 'installment') {

    result = ajax_paymentmethod(value);
    result.success(function (response) {

        response = JSON.parse(response);
        console.log(response);
        paymentplan_tablerenderer(response);
    })
}

function init_scheduleplot() {

    schedule_tablerenderer($('#scheduleTable'), get_militarytime());
    paymentplan_tablerenderer
}

function init_enroll_test() {

    ajax_enroll_test();


}
function init_reset_progress() {

    ajax_reset_progress();


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

function ajax_assessmentform(paymentplan) {
    return $.ajax({
        url: "/Onestop/index.php/temp_api/temporary_regform_ajax",
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

function ajax_queuedlist() {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/queue_subject_list",
        type: 'POST'
    });

}
function queue_tablerenderer(element = '', data = []) {

    element.DataTable().clear();
    element.DataTable().destroy();


    tablebody = element.find('tbody');
    tablebody.html('');
    //array sched start loop
    $('.schedule-time').css('background','white');
    $('.schedule-time').html('');
    $.each(data, function (index, row) {
        computeSched(row['Start_Time'],row['End_Time'],row['Day'],row['Course_Code'],row['from_time'],row['to_time'])
        tablebody.append($('<tr/>').append('\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Course_Code'] + '</td>\
        <td>'+ row['Course_Title'] + '</td>\
        <td>'+ row['Section_Name'] + '</td>\
        <td>'+ (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
        <td><button type="button" class="btn btn-primary" onclick="init_remove_queue(this)" data-sessionid="'+ row['session_id'] + '">Remove</btn></td>\
        ')
        );
    });

    element.DataTable({
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "responsive":true
    });

}
function subject_tablerenderer(element = '', data = []) {

    element.DataTable().clear();
    element.DataTable().destroy();


    tablebody = element.find('tbody');
    tablebody.html('');

    //array sched start loop
    $.each(data, function (index, row) {

        tablebody.append($('<tr/>').append('\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Course_Code'] + '</td>\
        <td>'+ row['Course_Title'] + '</td>\
        <td>'+ row['Section_Name'] + '</td>\
        <td>'+ (row['Course_Lec_Unit'] + row['Course_Lab_Unit']) + '</td>\
        <td>'+ row['Day'] + '</td>\
        <td>'+ row['Start_Time'] + ' - ' + row['End_Time'] + '</td>\
        <td><button class="btn btn-info" onclick="init_add_queue(this)" data-schedcode="'+ row['Sched_Code'] + '">Add</btn></td>\
        ')
        );
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

    $('#other_fee').html(data['other_fee']);
    $('#misc_fee').html(data['misc_fee']);
    $('#lab_fee').html(data['lab_fee']);
    $('#tuition_fee').html(data['tuition_fee']);
    $('#total_fee').html(data['total_fee']);

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
    $.each(days, function (index, day) {

        tablehead.append('<th class="text-center time-header" width="13%">' + day + '</th>');

    });
    tablehead.append('</tr>');

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

    $('#trf_other').html(resultdata['get_otherfees'][0]['Fees_Amount']);
    $('#trf_initial').html(resultdata['get_Advise'][0]['InitialPayment']);
    $('#trf_first').html(resultdata['get_Advise'][0]['First_Pay']);
    $('#trf_second').html(resultdata['get_Advise'][0]['Second_Pay']);
    $('#trf_third').html(resultdata['get_Advise'][0]['Third_Pay']);
    $('#trf_fourth').html(resultdata['get_Advise'][0]['Fourth_Pay']);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);
    //Lab Fees 
    /*
    labfee = 0;
    $.each(resultdata['get_labfees'], function(index, labresult) 
    {
        labfee = labfee + parseFloat(labresult['Lab_Fee']);  
    }); 
    */
    labfee = parseFloat(resultdata['get_labfees'][0]['Fees_Amount']);
    $('#trf_lab').html(labfee.toFixed(2));

    //Total Fees
    total_fees = parseFloat(resultdata['get_Advise'][0]['tuition_Fee']) +
        parseFloat(resultdata['get_miscfees'][0]['Fees_Amount']) +
        labfee +
        parseFloat(resultdata['get_otherfees'][0]['Fees_Amount']);

    $('#trf_total_fees').html(total_fees.toFixed(2));


    //Displays Sched
    showtable = $('#temporary_regform_subjects');
    //clears the table before append
    showtable.html('');
    sched_checking = '';
    units = 0;
    subjectcount = 0;
    $.each(resultdata['get_Advise'], function (index, result) {
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

function section_renderer(data) {

    $('#section').html('<option value="none" disabled selected>SELECT SECTION</option>');
    $.each(data, function (index, result) {
        $('#section').append('<option value="' + result['Section_ID'] + '">' + result['Section_Name'] + '</option>');
    });
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