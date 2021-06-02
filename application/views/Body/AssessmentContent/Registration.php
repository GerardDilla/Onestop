<div class="row">
    <!-- Assessment Form Content -->
    <div class="col-md-12 row">

        <!--/Regform Header-->
        <div class="col-lg-12" style="text-align:center; color:#000">
            <h3>Welcome, Dominican!</h3>
            <br>
            <p>Below is your Registration Form, you can download this as proof that you are enrolled to <br>St. Dominic College of Asia.</p>
            <img style="width:20%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
            <hr>
            <div class="col-md-12 enrollment-summary" style="margin:0;padding:0;">
                <table style="width:100%">
                    <tbody>
                        <tr class="success" style="font-size: 12px; text-align:left">
                            <td width="40%" style="padding:0px 10px 0px 0px" valign="top">
                                <strong>REFERENCE NUMBER:</strong> <span id="reg_rn"></span> <br>
                                <strong>NAME:</strong> <span id="reg_name" class="capitalizetext"></span> <br>
                                <strong>ADDRESS:</strong> <span id="reg_address"></span> <br>
                            </td>
                            <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                                <strong>SEMESTER:</strong> <span id="reg_sem"></span> <br>
                                <strong>COURSE:</strong> <span id="reg_course"></span> <br>
                            </td>
                            <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                                <strong>SCHOOL YEAR:</strong> <span id="reg_sy"></span> <br>
                                <strong>YEAR LEVEL:</strong> <span id="reg_yl"></span> <br>
                            </td>
                            <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                                <strong>SECTION:</strong> <span id="reg_sec"></span> <br>
                                <strong>DATE:</strong> <span id="reg_date"></span> <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table>
                    <thead>
                        <tr class="success" style="font-size: 13px; text-align:left">
                            <th style="padding-right: 10px;">Sched Code</th>
                            <th style="padding-right: 10px;">Course Code</th>
                            <th style="padding-right: 10px;">Course</th>
                            <th style="padding-right: 10px;">Units</th>
                            <th style="padding-right: 10px;">Day</th>
                            <th style="padding-right: 10px;">Time</th>
                            <th style="padding-right: 10px;">Room</th>
                        </tr>
                    </thead>
                    <tbody id="registration_form" style="font-size: 12px; text-align:left">

                    </tbody>
                </table>
                <hr>
                <table class="pull-right" style="font-size: 13px; width: 80%; text-align:left">
                    <tbody>
                        <tr>
                            <td><strong>Tuition:</strong></td>
                            <td class="feesbox" id="reg_tuition"></td>

                            <td><strong>Initial Payment:</strong></td>
                            <td class="feesbox" id="reg_initial"></td>

                            <td><strong>Total Units:</strong></td>
                            <td class="feesbox" id="reg_total_units"></td>
                        </tr>
                        <tr>
                            <td><strong>Misc Fees:</strong></td>
                            <td class="feesbox" id="reg_misc"></td>

                            <td><strong>First:</strong></td>
                            <td class="feesbox" id="reg_first"></td>

                            <td><strong>Total Subjects:</strong></td>
                            <td class="feesbox" id="reg_total_subject"></td>
                        </tr>
                        <tr>
                            <td><strong>Lab Fees:</strong></td>
                            <td class="feesbox" id="reg_lab"></td>

                            <td><strong>Second:</strong></td>
                            <td class="feesbox" id="reg_second"></td>

                            <td><strong>Scholar:</strong></td>
                            <td class="feesbox" id="reg_scholar"></td>
                        </tr>
                        <tr>
                            <td><strong>Other Fees:</strong></td>
                            <td class="feesbox" id="reg_other"></td>

                            <td><strong>Third:</strong></td>
                            <td class="feesbox" id="reg_third"></td>

                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>Total Fees:</strong></td>
                            <td class="feesbox" id="reg_total_fees"></td>

                            <td><strong>Fourth:</strong></td>
                            <td class="feesbox" id="reg_fourth"></td>

                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('forms/digital_citizenship') ?>" style="color:inherit">
            <button class="btn btn-primary digital-citizenship btn-hover-red">
                Go to Digital Citizenship Form
            </button>
        </a>
        <br><br>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('forms/id_application') ?>" style="color:inherit">
            <button class="btn btn-primary id-application btn-hover-red">
                Go to ID Application Form
            </button>
        </a>
    </div>
    <div class="col-md-4"></div>
</div>