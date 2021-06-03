<style>
    .checked{
        background-color: rgba(193,255,193,1);
    }
</style>
<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        <!-- In accordance with the RA 10173 of 2012-DATA Privacy Act. The information gathered in this form shall be utilized by St. Dominic College of Asia as reference for processing the Student Identification Card. 
The name and photo associated with your Google account will be recorded when you upload files and submit this form -->
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <table id="chatInquiryTable" class="table table-hover">
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
<script>
    ajax_id()

    function id_update_status(id) {
        switch_id = $('#switch' + id);
        // switch_value = switch_id.val();
        // account_id = switch_id.data(switch_value);
        if (switch_id.prop("checked")) {
            status = 'done';
            switch_id.addClass('checked');
        } else {
            status = 'pending';
            switch_id.removeClass('checked');
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
    }

    function ajax_id() {
        $.ajax({
            url: 'getIdApplication',
            dataType: 'json',
            success: function(response) {
                $.each(response, function(key, value) {
                    checked = '';
                    html = '<tr>';
                    if (value['status'] == 'done') {
                        checked = 'checked class="checked"';
                        html = '<tr style="">';
                    }
                    html += '<td>' +
                        value['Last_Name'] + ', ' + value['First_Name'] + ' ' + value['Middle_Name'] +
                        '</td>' +
                        '<td>' +
                        value['Student_Number'] +
                    '</td>'+
                    '<td>' +
                        value['Course'] +
                    '</td>'+
                    '<td>' +
                    'Address' +
                        // value['Student_Number'] +
                    '</td>'+
                    '<td>' +
                        value['Guardian_Name'] +
                    '</td>'+
                    '<td>' +
                        value['Guardian_Contact'] +
                    '</td>'+
                    // '<td>' +
                    //     value['Guardian_Email'] +
                    // '</td>'+
                    '<td>' +
                        '<a href="https://drive.google.com/drive/folders/'+value['gdrive_folder_id']+'" target="_blank"><button>LINK</button></a>'+
                    '</td>';
                    html += '<td><label class="switch">' +
                        '<input type="checkbox" ' + checked + ' id="switch' + value['id'] + '" onclick="id_update_status(' + value['id'] + ')">' +
                        '<span class="slider round"></span>' +
                        '</label>' +
                        '</td>';
                    html += '</tr>';
                    $('#adminIdTbody').append(html);
                });
            }
        })
    }
</script>