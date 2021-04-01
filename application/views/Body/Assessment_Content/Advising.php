<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h4>1. CHOOSE SUBJECTS</h4>
        </div>
    </div>
    <br>
    <h5>Queued Subjects</h5>
    <a href="#" class="btn btn-sm btn-primary load-disable addsubject-button" data-bs-toggle="modal" data-bs-target="#subjectModal">Add Subjects</a>
    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#scheduleModal">View Schedule Plot</a>
    <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
    <br><br>
    <table class="mdl-data-table" id="queueTable">
        <thead>
            <tr>
                <th>Sched Code</th>
                <th>Subject Code</th>
                <th>Subject Title</th>
                <th>Section</th>
                <th>Units</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- <tr>
                <td>20202021</td>
                <td>ITC123</td>
                <td>Programming Fundamentals</td>
                <td>BSIT1A</td>
                <td>5</td>
                <td><a href="#" class="btn btn-sm btn-info">Remove</a></td>
            </tr>
            <tr>
                <td>20202022</td>
                <td>ITC123</td>
                <td>Programming Fundamentals</td>
                <td>BSIT1A</td>
                <td>5</td>
                <td><a href="#" class="btn btn-sm btn-info">Remove</a></td>
            </tr>
            <tr>
                <td>20202023</td>
                <td>ITC123</td>
                <td>Programming Fundamentals</td>
                <td>BSIT1A</td>
                <td>5</td>
                <td><a href="#" class="btn btn-sm btn-info">Remove</a></td>
            </tr>
            <tr>
                <td>20202023</td>
                <td>ITC123</td>
                <td>Programming Fundamentals</td>
                <td>BSIT1A</td>
                <td>5</td>
                <td><a href="#" class="btn btn-sm btn-info">Remove</a></td>
            </tr> -->

        </tbody>
    </table>
    <br><br>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h4>2. SELECT PAYMENT PLAN</h4>
            <br>
            <input type="radio" class="btn-check" name="payment-option" id="installmentchoice" value="installment" autocomplete="off" checked="">
            <label class="btn btn-sm btn-outline-primary" for="installmentchoice">
                INSTALLMENT
            </label>

            <input type="radio" class="btn-check" name="payment-option" id="fullpaymentchoice" value="full" autocomplete="off">
            <label class="btn btn-sm btn-outline-primary" for="fullpaymentchoice">
                FULL PAYMENT
            </label>

            <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
        </div>
        <div class="col-md-6">
            <br>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>OTHER FEES:</td>
                        <td id="other_fee"></td>
                    </tr>
                    <tr>
                        <td>MISC FEES</td>
                        <td id="misc_fee"></td>
                    </tr>
                    <tr>
                        <td>LAB FEES</td>
                        <td id="lab_fee"></td>
                    </tr>
                    <tr>
                        <td>TUITION FEES</td>
                        <td id="tuition_fee"></td>
                    </tr>
                    <tr>
                        <td>TOTAL FEES:</td>
                        <td id="total_fee"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>