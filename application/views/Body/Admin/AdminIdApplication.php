<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
            <!-- <h4>Jhon Norman Fabregas</h4> -->
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <table id="chatInquiryTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name (Last, First Middle)</th>
                            <th>Student Number</th>
                            <th width="15%">To Gdrive</th>
                            <th width="15%">Action</th>
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
        } else {
            status = 'pending';
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
                    html = '<tr>';
                    html += '<td>' +
                        value['Last_Name'] + ', ' + value['First_Name'] + ' ' + value['Middle_Name'] +
                        '</td>' +
                        '<td>' +
                        value['Student_Number'] +
                    '</td>'+
                    '<td>' +
                        'LINK'+
                    '</td>';
                    checked = '';
                    if (value['status'] == 'done') {
                        checked = 'checked';
                    }
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