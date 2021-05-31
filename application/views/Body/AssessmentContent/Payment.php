<style>
    .payment_methods{
        padding-bottom: 10px;
    }
    .payment_methods-button:hover{
        background-color: rgba(65, 94, 190, 0) !important;
        color: rgba(65, 94, 190, 1) !important;
    }
</style>
<div class="row">
    <!-- Assessment Form Content -->
    <div class="col-md-12 row">

        <!--/Regform Header-->
        <div class="col-lg-12 assessment-form" style="text-align:center; color:#000">
            <h3>ASSESSMENT FORM</h3>
            <hr>
            <table style="width:100%">
                <tbody>
                    <tr class="success" style="font-size: 12px; text-align:left">
                        <td width="40%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>REFERENCE NUMBER:</strong> <span id="trf_rn"></span> <br>
                            <strong>NAME:</strong> <span id="trf_name" class="capitalizetext"></span> <br>
                            <strong>ADDRESS:</strong> <span id="trf_address"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SEMESTER:</strong> <span id="trf_sem"></span> <br>
                            <strong>COURSE:</strong> <span id="trf_course"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SCHOOL YEAR:</strong> <span id="trf_sy"></span> <br>
                            <strong>YEAR LEVEL:</strong> <span id="trf_yl"></span> <br>
                        </td>
                        <td width="20%" style="padding:0px 10px 0px 0px" valign="top">
                            <strong>SECTION:</strong> <span id="trf_sec"></span> <br>
                            <strong>DATE:</strong> <span id="trf_date"></span> <br>
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
                <tbody id="temporary_regform_subjects" style="font-size: 12px; text-align:left">

                </tbody>
            </table>
            <hr>
            <table class="pull-right" style="font-size: 13px; width: 80%; text-align:left">
                <tbody>
                    <tr>
                        <td><strong>Tuition:</strong></td>
                        <td class="feesbox" id="trf_tuition"></td>

                        <td><strong>Initial Payment:</strong></td>
                        <td class="feesbox" id="trf_initial"></td>

                        <td><strong>Total Units:</strong></td>
                        <td class="feesbox" id="trf_total_units"></td>
                    </tr>
                    <tr>
                        <td><strong>Misc Fees:</strong></td>
                        <td class="feesbox" id="trf_misc"></td>

                        <td><strong>First:</strong></td>
                        <td class="feesbox" id="trf_first"></td>

                        <td><strong>Total Subjects:</strong></td>
                        <td class="feesbox" id="trf_total_subject"></td>
                    </tr>
                    <tr>
                        <td><strong>Lab Fees:</strong></td>
                        <td class="feesbox" id="trf_lab"></td>

                        <td><strong>Second:</strong></td>
                        <td class="feesbox" id="trf_second"></td>

                        <td><strong>Scholar:</strong></td>
                        <td class="feesbox" id="trf_scholar"></td>
                    </tr>
                    <tr>
                        <td><strong>Other Fees:</strong></td>
                        <td class="feesbox" id="trf_other"></td>

                        <td><strong>Third:</strong></td>
                        <td class="feesbox" id="trf_third"></td>

                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Total Fees:</strong></td>
                        <td class="feesbox" id="trf_total_fees"></td>

                        <td><strong>Fourth:</strong></td>
                        <td class="feesbox" id="trf_fourth"></td>

                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <label>
                <h6><u>NOTE: THIS IS NOT A PROOF OF OFFICIAL ENROLLMENT</u></h6>
            </label>
        </div>
    </div>
    <!-- Spacing -->
    <div style="padding: 30px;"></div>
    <!-- Payment Options -->
    <div class="col-md-12 row">
        <div class="col-md-12">
            <h3>Payment Options</h3>
        </div>
        <div class="col-md-3 payment_methods">
            <!-- <a href="https://stdominiccollege.edu.ph/SDCAPayment/" target=="_blank" type="button" class="btn btn-lg btn-primary">PAY ONLINE</a> -->
            <button type="button" style="width: 100%;" class="btn btn-lg btn-primary online-payment payment_methods-button" data-bs-toggle="modal" data-bs-target="#onlinepaymentModal">PAY ONLINE</button>
        </div>
        <div class="col-md-3 payment_methods">
            <button type="button" style="width: 100%;" class="btn btn-lg btn-primary over-the-counter payment_methods-button" data-bs-toggle="modal" data-bs-target="#overthecounterModal">OVER THE COUNTER</button><br>
        </div>
        <div class="col-md-3 payment_methods">
            <button type="button" style="width: 100%;" class="btn btn-lg btn-primary pay-at-sdca payment_methods-button" data-bs-toggle="modal" data-bs-target="#cashierPayment">Pay at SDCA Cashier</button><br>
        </div>
        <div class="col-md-3 payment_methods">
        </div>
    </div>
    <br>
    <hr>
    <div class="col-md-12 row">
        <div class="col-md-12">
            <h4>Already Paid?</h4>
        </div>
        <div class="col-md-3 payment_methods">
            <a href="<?php echo site_url('main/uploadProofOfPayment'); ?>" style="width: 100%;" target="_blank" type="button" class="btn btn-lg btn-primary upload-proof payment_methods-button">UPLOAD PROOF OF PAYMENT</a>
        </div>
        <div class="col-md-12">
        </div>
    </div>
    <div class="col-md-12 row">
        <hr>
        <div class="col-md-3">
            <h4>Change your Mind?</h4>
            <button type="button" class="btn btn-lg btn-primary payment_methods-button" id="readvise_button">CHOOSE AGAIN</button>
        </div>
        <div class="col-md-3" style="text-align:center">
            <img style="width:50%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>"></li>
        </div>
    </div>
</div>