<div class="row">
    <div class="col-md-12">
        <!-- <div id="base_url" class="base_url" data-baseurl="<?php echo base_url(); ?>"></div> -->
        <div class="row">
            <h6 class="col-md-12" style="margin-bottom:15px">YOUR INFORMATION
                <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
            </h6>
            <div class="col-md-6">
                <table class="table table-striped table-hover" style="display: block; overflow: auto;">
                    <tbody>
                        <tr>
                            <td>REFERENCE NUMBER:</td>
                            <td id="stud_info_reference_number"></td>
                        </tr>
                        <tr>
                            <td>FIRST NAME:</td>
                            <td id="stud_info_first_name"></td>
                        </tr>
                        <tr>
                            <td>MIDDLE NAME:</td>
                            <td id="stud_info_middle_name"></td>
                        </tr>
                        <tr>
                            <td>LAST NAME:</td>
                            <td id="stud_info_last_name"></td>
                        </tr>
                        <tr>
                            <td>COURSE:</td>
                            <td id="stud_info_course"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-hover" style="display: block; overflow: auto;">
                    <tbody>
                        <tr>
                            <td>ADDRESS:</td>
                            <td id="stud_info_address"></td>
                        </tr>
                        <tr>
                            <td>CONTACT NUMBER:</td>
                            <td id="stud_info_contact"></td>
                        </tr>
                        <tr>
                            <td>FIRST CHOICE:</td>
                            <td id="stud_info_first_choice"></td>
                        </tr>
                        <tr>
                            <td>SECOND CHOICE:</td>
                            <td id="stud_info_second_name"></td>
                        </tr>
                        <tr>
                            <td>THIRD CHOICE:</td>
                            <td id="stud_info_third_name"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
            <a href="<?php echo base_url('/main/ExportInquiry/' . $this->session->userdata('reference_no')) ?>" target="_blank"  data-step="1"> 
                <div class="btn btn-sm btn-primary" for="success-outlined">
                    DOWNLOAD APPLICATION
                </div>
            </a>
            <br>
            <?php
            $data_course = empty($this->data['course']) ? 'N/A' : $this->data['course'];
            if ($data_course != 'N/A') {
                // Have course

            ?>
                <div class="col-md-12">
                    <HR>
                    <h6>CHOOSE YOUR STATUS</h6>
                    <br>
                    <?php
                    $data_applied_status = empty($this->data['applied_status']) ? 'NULL' : $this->data['applied_status'];
                    if ($data_applied_status == 'freshmen') {
                    ?>
                        <input type="radio" class="btn-check" name="eductype" id="success-outlined" data-etype='freshmen' autocomplete="off" disabled checked="checked">
                        <label class="btn btn-sm btn-outline-primary" for="success-outlined">
                            NEW STUDENT
                        </label>
                    <?php
                    } else {
                    ?>
                        <input type="radio" class="btn-check" name="eductype" id="danger-outlined" data-etype='transferee' autocomplete="off" disabled checked="checked">
                        <label class="btn btn-sm btn-outline-primary" for="danger-outlined">
                            TRANSFEREE
                        </label>
                    <?php
                    }
                    ?>

                </div>
                <?php
                $data_shs_student_number = empty($this->data['shs_student_number']) ? 0 : $this->data['shs_student_number'];
                if ($data_shs_student_number > 0) {
                ?>
                    <div class="col-md-12 shs-verification">
                        <br>
                        <div class="form-check">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="form-check-input form-check-primary" disabled readonly checked>
                                <label class="form-check-label" for="customColorCheck1">I Graduated from St. Dominic College of Asia</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 balance-verification">
                        <br>
                        <div class="form-check" style="padding-left:0px">
                            <div class="form-group">
                                <label for="shs_student_number">Senior Highschool Student Number</label>
                                <input type="text" class="form-control" disabled readonly value="<?php echo $this->data['shs_student_number'] ?>">
                            </div>
                        </div>
                    </div>
                <?php
                }

                ?>
                <div class="col-md-12">
                    <hr>
                    <h6>CONFIRM YOUR COURSE</h6>
                    <small>Contact MIS Department if you have correction.</small>
                    <BR>
                    <fieldset class="form-group">
                        <select class="form-select" id="courses" disabled>
                            <option value="none" disabled selected><?php echo $this->data['program_code'] . ': ' . $this->data['program_name'] ?></option>
                        </select>
                    </fieldset>
                    <small>Major in:</small>
                    <fieldset class="form-group">
                        <select class="form-select" id="majors" disabled>
                            <option value="none" selected><?php echo $this->data['major'] ?></option>

                        </select>
                    </fieldset>
                    <!-- <button class="btn btn-sm btn-primary" onclick="submit_course()" for="success-outlined">
                        SUBMIT COURSE
                    </button> -->
                </div>
            <?php
            } else {
                //No Course
            ?>
                <div class="col-md-12">
                    <HR>
                    <h6>CHOOSE YOUR STATUS</h6>
                    <br>

                    <input type="radio" class="btn-check" name="eductype" id="educ_new_student" value="freshmen" data-etype='freshmen' autocomplete="off">
                    <label class="btn btn-sm btn-outline-primary" for="educ_new_student" id="educ_new_student_label">NEW STUDENT</label>

                    <input type="radio" class="btn-check" name="eductype" id="educ_transferee" value="transferee" data-etype='transferee' autocomplete="off">
                    <label class="btn btn-sm btn-outline-primary" for="educ_transferee" id="educ_transferee_label">TRANSFEREE</label>
                    <!-- <button class="btn btn-sm btn-outline-primary">NEW STUDENT</button> -->

                </div>

                <div class="col-md-12 shs-verification" style="display:none">
                    <br>
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input form-check-primary shsverification" name="shsverification" id="shsverification">
                            <label class="form-check-label" for="customColorCheck1">I Graduated from St. Dominic College of Asia</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 balance-verification" style="display:none">
                    <br>
                    <div class="form-check" style="padding-left:0px">
                        <div class="form-group">
                            <label for="shs_student_number">Senior Highschool Student Number</label>
                            <input type="text" id="shs_student_number" class="form-control" placeholder="Shs Student Number">
                            <!-- <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div> -->
                            <div class="valid-feedback" id="valid-feedback">
                                This Student Number is VALID.
                            </div>
                            <div class="invalid-feedback" id="invalid-feedback">

                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h6>CONFIRM YOUR COURSE</h6>
                    <small>Choose one of your preferred courses</small>
                    <BR>
                    <fieldset class="form-group">
                        <select class="form-select" id="courses" required>
                            <option value="none" disabled selected>PREFERRED COURSES</option>
                            <?php
                            // if ($reference_number_from_session) {
                            if ($this->data['courses']) {
                                // foreach ($this->data['courses'] as $index => $course) {
                                //     echo "<option value='$course'>$course : " . $this->data['courses_info'][$index]['Program_Name'] . "</option>";
                                // }
                                foreach ($this->data['courses'] as $course) {
                                    echo "<option value='" . $course['Program_Code'] . "'>" . $course['Program_Code'] . " : " . $course['Program_Name'] . "</option>";
                                }
                            }
                            // } else {
                            ?>
                            <!-- <option value="none" disabled selected>No Session Get</option> -->
                            <?php
                            // }
                            ?>
                        </select>
                    </fieldset>
                    <fieldset class="form-group">
                        <select class="form-select" id="majors">
                            <option value="none" disabled selected>COURSE MAJOR</option>

                        </select>
                    </fieldset>
                    <!-- <button class="btn btn-sm btn-primary" onclick="submit_course()" for="success-outlined">
                        SUBMIT COURSE
                    </button> -->
                </div>
            <?php
            }
            ?>
        </div>
        <br>
    </div>
</div>

<!-- Will remove later in development -->

<script>

</script>