$(document).ready(function () {

    $('.addsubject-button').click(function () {
        init_subjectlists();
    })

    init_queuedlist();

    if (!$.fn.DataTable.isDataTable('#subjectTable')) {
        $('#subjectTable').DataTable({
            "ordering": false
        });
    }

    if (!$.fn.DataTable.isDataTable('#queueTable')) {
        $('#queueTable').DataTable({
            "ordering": false,
            "bPaginate": false,
            "bLengthChange": false,
        });
    }


});

function init_subjectlists() {

    subjects = ajax_subjectlist();
    subjects.success(function (response) {
        console.log('tablerun');
        response = JSON.parse(response);
        subject_tablerenderer($('#subjectTable'), response);
    })

}

function init_add_queue(row) {

    schedcode = $(row).data('schedcode');
    ajax_insertqueue(schedcode);
    init_queuedlist();

}


function init_remove_queue(row) {

    sessionid = $(row).data('sessionid');
    ajax_removequeue(sessionid);
    init_queuedlist();

}


function init_queuedlist() {

    queue = ajax_queuedlist();
    queue.success(function (response) {

        response = JSON.parse(response);
        console.log(response);
        queue_tablerenderer($('#queueTable'), response);
    })

}

function ajax_subjectlist() {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/subjects",
        type: 'GET',
        data: {
            school_year: '2020-2021',
            semester: 'FIRST',
            section: '833',
        }
    });
}
function ajax_insertqueue(schedcode) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/queue_subject",
        type: 'POST',
        data: {
            schedcode: schedcode,
        }
    });
}

function ajax_removequeue(sessionID) {

    return $.ajax({
        url: "/Onestop/index.php/temp_api/unqueue_subject",
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
        <td><button type="button" class="btn btn-primary" onclick="init_remove_queue(this)" data-sessionid="'+ row['session_id'] + '">Remove</btn></td>\
        ')
        );
    });
    element.ajax.reload();



}
function subject_tablerenderer(element = '', data = []) {

    tablebody = element.find('tbody');
    tablebody.html('');

    //array sched start loop
    $.each(data, function (index, row) {

        tablebody.append($('<tr/>').append('\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Course_Code'] + '</td>\
        <td>'+ row['Course_Title'] + '</td>\
        <td>'+ row['Section_Name'] + '</td>\
        <td>'+ row['Course_Lec_Unit'] + '</td>\
        <td>'+ row['Course_Lab_Unit'] + '</td>\
        <td>'+ row['Day'] + '</td>\
        <td>'+ row['Start_Time'] + ' - ' + row['End_Time'] + '</td>\
        <td>'+ row['Room'] + '</td>\
        <td> 40 (Static)</td>\
        <td>'+ row['Instructor_Name'] + '</td>\
        <td><button class="btn btn-info" onclick="init_add_queue(this)" data-schedcode="'+ row['Sched_Code'] + '">Add</btn></td>\
        ')
        );
    });
    element.ajax.reload();

}

