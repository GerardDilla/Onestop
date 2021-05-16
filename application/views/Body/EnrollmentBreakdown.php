<style>
    .breakdown_table_label {
        font-size: 25px;
        color: #0045ff;
    }

    .breakdisplaynone {
        display: none;
    }
</style>
<section class="section" id="assessment_section" data-baseurl="<?php echo base_url(); ?>">
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <label for="personal_information_table" class="breakdown_table_label"><b>Personal Information</b></label>
                <table class="table table-striped" id="personal_information_table" style="display: block; overflow: auto;">
                    <tr>
                        <td>Reference Number</td>
                        <td id="breakdown_refnum"></td>
                    </tr>
                    <tr>
                        <td>Student Number</td>
                        <td id="breakdown_stdnum"></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td id="breakdown_name"></td>
                    </tr>
                    <tr>
                        <td>Birthday</td>
                        <td id="breakdown_bday"></td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td id="breakdown_nationality"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td id="breakdown_address"></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <!-- <label for="course_year_table" class="breakdown_table_label"><b>Year and Courses</b></label> -->
                <table class="table table-striped" id="course_year_table" style="display: block; overflow: auto;">
                    <tr>
                        <td>Email</td>
                        <td id="breakdown_email"></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td id="breakdown_contact"></td>
                    </tr>
                    <tr>
                        <td>Course</td>
                        <td id="breakdown_course"></td>
                    </tr>
                    <tr>
                        <td>Year Level</td>
                        <td id="breakdown_yl"></td>
                    </tr>
                    <tr>
                        <td>Applied School Year</td>
                        <td id="breakdown_asy"></td>
                    </tr>
                    <tr>
                        <td>Applied Semester</td>
                        <td id="breakdown_as"></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <label for="requirements_table" class="breakdown_table_label"><b>Requirements</b></label>
                <table class="table table-striped" id="requirements_table" style="display: block; overflow: auto;">
                    <tr>
                        <th></th>
                        <th>STATUS</th>
                    </tr>
                    <tr>
                        <td>Form 9 (Report Card)</td>
                        <td id="breakdown_f9"></td>
                    </tr>
                    <tr>
                        <td>Original Form ID</td>
                        <td id="breakdown_fid"></td>
                    </tr>
                    <tr>
                        <td>Certificate of Good Moral</td>
                        <td id="breakdown_gmoral"></td>
                    </tr>
                    <tr>
                        <td>PSA Birth Certificate</td>
                        <td id="breakdown_psa"></td>
                    </tr>
                    <tr>
                        <td>Passport size ID picture</td>
                        <td id="breakdown_passport"></td>
                    </tr>
                    <tr id="breakdown_marriage_tr" class="breakdisplaynone">
                        <td>PSA Marriage Certificate</td>
                        <td id="breakdown_marriage_cert"></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <label for="proof_payment_table" class="breakdown_table_label"><b>Proof of Payments</b></label>
                <table class="table table-striped" id="proof_payment_table" style="display: block; overflow: auto;">
                    <tr>
                        <th></th>
                        <th>STATUS</th>
                    </tr>
                    <tr>
                        <td>Proof of Payment</td>
                        <td id="breakdown_proof_pay"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    init_breakdown_si()
    init_breakdown_req()

    function init_breakdown_si() {
        $.ajax({
            url: "get_student_information",
            dataType: "JSON",
            success: function(response) {
                // alert(response['Reference_Number']);
                monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                datetime = new Date(response['Birth_Date']);

                date = datetime.getDate().toString();
                month = monthNames[datetime.getMonth()].toString();
                year = datetime.getFullYear().toString();

                fullname = response['Last_Name'] + ", " + response['First_Name'] + " " + response['Middle_Name'];
                fulladdress = response['Address_No'] + " " + response['Address_Street'] + " " + response['Address_Subdivision'] + " " + response['Address_City'] + " " + response['Address_Province']
                $('#breakdown_refnum').html(response['Reference_Number']);
                $('#breakdown_stdnum').html(response['Student_Number']);
                $('#breakdown_name').html(fullname);
                $('#breakdown_bday').html(date + " " + month + " " + year);
                $('#breakdown_nationality').html(response['Nationality']);
                $('#breakdown_address').html(fulladdress);
                $('#breakdown_email').html(response['Email']);
                $('#breakdown_contact').html(response['CP_No']);
                $('#breakdown_course').html(response['Course']);
                $('#breakdown_yl').html(response['YearLevel']);
                $('#breakdown_asy').html(response['AppliedSchoolYear']);
                $('#breakdown_as').html(response['Applied_Semester']);
            }
        })
    }

    function init_breakdown_req() {
        $.ajax({
            url: "ajaxBreakdownRequirements",
            dataType: "JSON",
            success: function(response) {
                $.each(response, function(key, values) {
                    // console.log(values['requirements_name']);
                    if (values['requirements_name'] == 'report_card') {
                        $('#breakdown_f9').html(values['status']);
                    } else if (values['requirements_name'] == 'original_form_id') {
                        $('#breakdown_fid').html(values['status']);
                    } else if (values['requirements_name'] == 'good_moral') {
                        $('#breakdown_gmoral').html(values['status']);
                    } else if (values['requirements_name'] == 'birth_certificate') {
                        $('#breakdown_psa').html(values['status']);
                    } else if (values['requirements_name'] == 'passport_id_pic') {
                        $('#breakdown_passport').html(values['status']);
                    } else if (values['requirements_name'] == 'marriage_certificate') {
                        $('#breakdown_marriage_tr').removeClass('breakdisplaynone');
                        $('#breakdown_marriage_cert').html(values['status']);
                    } else if (values['requirements_name'] == 'proof_of_payment') {
                        $('#breakdown_proof_pay').html(values['status']);
                    }
                });
            }
        })
    }
</script>