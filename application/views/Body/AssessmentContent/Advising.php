<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"> -->


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
    <div class="table-responsive">
        <table class="mdl-data-table table table-hover" id="queueTable" data-queue-result='wqewqewq' data-units='0' width="100%">
            <thead>
                <tr>
                    <th width="15%">Sched Code</th>
                    <th width="15%">Subject Code</th>
                    <th>Subject Title</th>
                    <th width="10%">Section</th>
                    <th width="10%">Units</th>
                    <th width="10%"></th>
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


            </tbody>
        </table>
    </div>
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

<!-- <div class="col-md-12" style="text-align:center">
    <hr>
    <button type="button" id="advise_button" class="btn btn-lg btn-primary">PROCEED</button>
</div> -->

<!-- <script>
    $('#sampleTable').dataTable({
        responsive: false,
        ordering:false
    });
</script> -->