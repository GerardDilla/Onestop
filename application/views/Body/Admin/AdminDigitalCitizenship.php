<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <div>
                    <div id="sdcapassword"></div>
                </div>
                <table id="chatInquiryTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name (Last, First Middle)</th>
                            <th>Course</th>
                            <th>Student Number</th>
                            <th>Emails for Account</th>
                            <th>Posible Password</th>
                            <!-- <th>Action</th> -->
                            <!-- <th width="15%">Blackboard Account</th>
                            <th width="15%">Microsoft Office 365</th>
                            <th width="15%">SDCA Gmail Account</th>
                            <th width="15%">Student Portal</th> -->
                        </tr>
                    </thead>
                    <tbody id="adminDigitalTbody">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
<script>
    ajax_digital()
    var new_date = new Date();
    year_today = new_date.getFullYear();
    sdca_pass = 'Password this year : sdca' + year_today;
    $('#sdcapassword').html(sdca_pass);

    function digital_update_status(id, id_acc) {
        switch_id = $('#switch' + id + id_acc);
        switch_value = switch_id.val();
        digital_id = switch_id.data(switch_value);
        if (switch_id.prop("checked")) {
            status = 'done';
        } else {
            status = 'pending';
        }
        $.ajax({
            url: 'updateDigitalCitizenshipAccount',
            dataType: 'json',
            method: 'post',
            data: {
                'digital_id': digital_id,
                'status': status
            },
            success: function(response) {}
        })
    }


    function ajax_digital() {
        $.ajax({
            url: 'getDigitalCitizenship',
            dataType: 'json',
            success: function(response) {
                $.each(response, function(key, value) {
                    year = '';
                    date_created = value['created_at'];
                    year = new Date(date_created).getFullYear();
                    // ajax_digital_account(value);
                    sdca_email = '';
                    sdca_email = remove_space_regex(value['First_Name']) + '.' + remove_space_regex(value['Last_Name']) + '@sdca.edu.ph';
                    console.log(sdca_email);
                    html = '<tr>' +
                        '<td>' +
                        value['Last_Name'] + ', ' + value['First_Name'] + ' ' + value['Middle_Name'] +
                        '</td>' +
                        '<td>' +
                        value['Course'] +
                        '</td>' +
                        '<td>' +
                        value['Student_Number'] +
                        '</td>' +
                        '<td>' +
                        sdca_email +
                        '</td>' +
                        '<td>' +
                        'sdca' + year +
                        '</td>' +
                        // html += '<td><label class="switch">' +
                        //     '<input type="checkbox">' +
                        //     '<span class="slider round"></span>' +
                        //     '</label>' +
                        //     '</td>';
                        '</tr>';
                    $('#adminDigitalTbody').append(html);
                });
            },
        })
    }

    function ajax_digital_account(data) {
        $.ajax({
            url: 'getDigitalCitizenshipAccount',
            dataType: 'json',
            method: 'post',
            data: {
                'digital_id': data['id']
            },
            success: function(response) {
                html = '<tr>';
                html += '<td>' +
                    data['Last_Name'] + ', ' + data['First_Name'] + ' ' + data['Middle_Name'] +
                    '</td>' +
                    '<td>' +
                    data['Student_Number']
                '</td>';
                $.each(response, function(key_acc, value_acc) {
                    checked = '';
                    if (value_acc['status'] == 'done') {
                        checked = 'checked';
                    }
                    html += '<td><label class="switch">' +
                        '<input type="checkbox" ' + checked + ' id="switch' + data['id'] + value_acc['id'] + '" data-' + value_acc['request'] + '="' + value_acc['id'] + '"value="' + value_acc['request'] + '" onclick="digital_update_status(' + data['id'] + ',' + value_acc['id'] + ')">' +
                        '<span class="slider round"></span>' +
                        '</label>' +
                        '</td>';
                });
                html += '</tr>';
                $('#adminDigitalTbody').append(html);
            }
        })
    }

    // alert('Juan Pedro'.replace(/\s/g, ''));
    function remove_space_regex(string) {
        var reg = /\s+/g;
        if (string != null) {
            lowercase = string.toLowerCase();
        }

        replace = lowercase.replace(reg, '');
        // alert(replace);

        return replace;
    }
</script>