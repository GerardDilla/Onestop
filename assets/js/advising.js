$(document).ready(function () {

    $('.addsubject-button').click(function () {
        init_subjectlists();
    })


});

function init_subjectlists() {

    subjects = ajax_subjectlist();
    subjects.success(function (response) {
        console.log('tablerun');
        response = JSON.parse(response);
        subject_tablerenderer($('#subjectTable'), response);
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
function subject_tablerenderer(element = '', data = []) {

    tablebody = element.find('tbody');
    tablebody.html('');

    //array sched start loop
    $.each(data, function (index, row) {

        tablebody.append($('<tr/>'));
        tablebody.append('\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Course_Code'] + '</td>\
        <td>'+ row['Course_Title'] + '</td>\
        <td>'+ row['Section'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        <td>'+ row['Sched_Code'] + '</td>\
        ');

        // <th>Sched Code</th>
        // <th>Course Code</th>
        // <th>Course Title</th>
        // <th>Section</th>
        // <th>Lec Unit</th>
        // <th>Lab Unit</th>
        // <th>Day</th>
        // <th>Time</th>
        // <th>Room</th>
        // <th>Remaining Slot</th>
        // <th>Instructor Name</th>
        // <th></th>
    });
    tablebody.html(content);
}