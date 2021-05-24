<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <table id="chatInquiryTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name (Last, First Middle)</th>
                            <th>Student Number</th>
                            <th width="15%">Blackboard Account</th>
                            <th width="15%">Microsoft Office 365</th>
                            <th width="15%">SDCA Gmail Account</th>
                            <th width="15%">Student Portal</th>
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
    function digital_update_status(id, id_acc) {
        switch_id = $('#switch' + id + id_acc);
        switch_value = switch_id.val();
        account_id = switch_id.data(switch_value);
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
                'account_id': account_id,
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
                    ajax_digital_account(value);
                });
            }
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
</script>