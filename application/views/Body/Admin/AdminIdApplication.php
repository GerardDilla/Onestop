<style></style>
<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
            <!-- In accordance with the RA 10173 of 2012-DATA Privacy Act. The information gathered in this form shall be utilized by St. Dominic College of Asia as reference for processing the Student Identification Card. 
The name and photo associated with your Google account will be recorded when you upload files and submit this form -->
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <table id="idApplicationTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name (Last, First Middle)</th>
                            <th>Student Number</th>
                            <th>Course</th>
                            <th>Address</th>
                            <th>Guardian Name</th>
                            <th>Guardian Contact</th>
                            <!-- <th>Guardian Email</th> -->
                            <th width="5%">To Gdrive</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="adminIdTbody">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

</section>
<!-- <script src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
<script>
    ajax_id()

    function id_update_status(id) {
        switch_id = $('#switch' + id);
        tr_switch_id = $('#tr-switch' + id);
        student_name = switch_id.data('student_name_'+id);
        // console.log(switch_id);
        // console.log(switch_id.prop("checked"));
        // switch_id.removeClass('checked');
        // switch_value = switch_id.val();
        // account_id = switch_id.data(switch_value);
        q_title = '';
        q_msg = '';
        if (switch_id.prop("checked")) {
            q_msg = '<b style="font-size:20px;color:black;">Are you sure this student is done?</b><br>'+
            '<span style="font-size:15px;color:black">'+
                '<span style="color:red"><b>NOTE</b></span>'+
                ': This action will send an <span style="color:red"><b>EMAIL</b></span> that his/her ID is done.<br><br>'+
                'Student (Last, First Middle) : '+
                '<span style="font-size:15px;color:black"><b><u>'+
                    student_name+
                '</u></b></span>'+
            '</span><br><br>';
        } else {
            q_msg = '<b style="font-size:20px;color:black;">Are you sure you want to uncheck this user?</b><br>';
            q_msg += '<span style="font-size:15px;color:black">'+
                    '<span style="color:red;">NOTE</span>: This will not unsent the sent email for this user.'+
                '</span><br><br>';
            q_msg += '<span style="font-size:15px;color:black">'+
                'Student (Last, First Middle) : '+
                '<span style="font-size:15px;color:black"><b><u>'+
                    student_name+
                '</u></b></span>'+
                // 'This action will send an <span style="color:red"><b>EMAIL</b></span> that his/her ID is done.'+
            '</span><br><br>';
        }


        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: q_title,
            message: q_msg,
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function(instance, toast) {
                    if (switch_id.prop("checked")) {
                        status = 'done';
                        tr_switch_id.addClass('checked_form');
                        switch_id.prop('checked', true);
                    } else {
                        status = 'pending';
                        tr_switch_id.removeClass('checked_form');
                        switch_id.prop('checked', false);
                    }


                    $.ajax({
                        url: 'updateIdApplication',
                        dataType: 'json',
                        method: 'post',
                        data: {
                            'id_application': id,
                            'status': status
                        },
                        success: function(response) {}
                    })

                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                }, true],
                ['<button>NO</button>', function(instance, toast) {
                    if (switch_id.prop("checked")) {
                        switch_id.prop('checked', false);
                    } else {
                        switch_id.prop('checked', true);
                    }
                    // switch_id.prop('checked', false);

                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                    return;
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

    function ajax_id() {
        $.ajax({
            url: 'getIdApplication',
            dataType: 'json',
            success: function(response) {
                $.each(response, function(key, value) {
                    student_name = value['Last_Name'] + ', ' + value['First_Name'] + ' ' + value['Middle_Name'];
                    checked = '';
                    if (value['status'] == 'done') {
                        checked = 'checked class="checked_form"';
                    }
                    html = '<tr ' + checked + 'id="tr-switch' + value['id'] + '">';
                    html += '<td>' +
                        student_name +
                        '</td>' +
                        '<td>' +
                        value['Student_Number'] +
                        '</td>' +
                        '<td>' +
                        value['Course'] +
                        '</td>' +
                        '<td>' +
                        'Address' +
                        // value['Student_Number'] +
                        '</td>' +
                        '<td>' +
                        value['Guardian_Name'] +
                        '</td>' +
                        '<td>' +
                        value['Guardian_Contact'] +
                        '</td>' +
                        // '<td>' +
                        //     value['Guardian_Email'] +
                        // '</td>'+
                        '<td>' +
                        '<a href="https://drive.google.com/drive/folders/' + value['gdrive_folder_id'] + '" target="_blank">' +
                        '<button class="btn action_button">Link</button>' +
                        '</a>' +
                        '</td>';
                    html += '<td><label class="switch">' +
                        '<input type="checkbox" ' + checked + ' data-student_name_' + value['id'] + '="'+student_name+'" id="switch' + value['id'] + '" onclick="id_update_status(' + value['id'] + ')">' +
                        '<span class="slider round"></span>' +
                        '</label>' +
                        '</td>';
                    html += '</tr>';
                    $('#adminIdTbody').append(html);
                });
                $('#idApplicationTable').DataTable();
            }
        })
    }
</script>