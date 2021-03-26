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
        <td><button class="btn btn-info">Add</btn></td>\
        ')
        );
    });

    if (!$.fn.DataTable.isDataTable('#subjectTable')) {
        $('#subjectTable').DataTable({
            "ordering": false
        });
    }

}