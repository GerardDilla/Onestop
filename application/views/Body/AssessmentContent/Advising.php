<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"> -->
<!-- <h1>ADVISING</h1> -->

<br><br>
<div class="col-md-12" id="choose_legend">
    <div class="row">
        <div class="divider divider-left">
            <div class="divider-text">
                <h4>1. CHOOSE SEMESTER</h4>
            </div>
        </div>
        <fieldset class="col-md-4 form-group">
            <p>CURRENT SCHOOLYEAR: <?php echo $this->data['legend']['School_Year']; ?></p>

            <?php
            $legend_sy = explode("-", $this->data['legend']['School_Year']);
            $options = array(

                'none' => 'SELECT SCHOOL YEAR',
                $legend_sy[0] . '-' . $legend_sy[1] => $legend_sy[0] . '-' . $legend_sy[1],
                ($legend_sy[0] - 1) . '-' . ($legend_sy[1] - 1) => ($legend_sy[0] - 1) . '-' . ($legend_sy[1] - 1),

            );
            $attr = array(
                'id' => 'sy_legend',
                'class' => 'form-select',
                'required' => 'required'
            );

            echo form_dropdown('sy_legend', $options, $this->data['sy_session'] != '' ? $this->data['sy_session'] : 'none', $attr);
            ?>

            <!-- <select class="form-select" id="sy_legend" required>
                <option value="none" disabled selected>SELECT SCHOOL YEAR</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2019-2020">2019-2020</option>
            </select> -->
        </fieldset>
        <div class="col-md-12"></div>
        <fieldset class="col-md-4 form-group">
            <p>CURRENT SEMESTER: <?php echo $this->data['legend']['Semester']; ?></p>
            <?php
            $options = array(

                'none' => 'SELECT SECTION',
                'FIRST' => 'FIRST',
                'SECOND' => 'SECOND',
                'SUMMER' => 'SUMMER',

            );
            $attr = array(
                'id' => 'sem_legend',
                'class' => 'form-select',
                'required' => 'required'
            );

            echo form_dropdown('sem_legend', $options, $this->data['sem_session'] != '' ? $this->data['sem_session'] : 'none', $attr);
            ?>
            <!-- <select class="form-select" id="sem_legend" required>
                <option value="none" disabled selected>SELECT SECTION</option>
                <option value="FIRST">FIRST</option>
                <option value="SECOND">SECOND</option>
                <option value="SUMMER">SUMMER</option>
            </select> -->
        </fieldset>
    </div>
</div>

<div class="col-md-12" id="choose_subjects">
    <div class="row">

        <div class="divider divider-left">
            <div class="divider-text">
                <h4>2. CHOOSE SUBJECTS</h4>
            </div>
        </div>
    </div>
    <br>
    <h5>Queued Subjects</h5>
    <a href="#" class="btn btn-primary load-disable addsubject-button btn-hover-red" data-bs-toggle="modal" data-bs-target="#subjectModal">Add Subjects</a>
    <a href="#" class="btn btn-success viewsched-button btn-hover-red" data-bs-toggle="modal" data-bs-target="#scheduleModal">View Schedule Plot</a>
    <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
    <br><br>
    <div class="table-responsive">
        <table class="mdl-data-table table table-hover" id="queueTable" data-queue-result='wqewqewq' width="100%">
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
        <div class="col-md-12 choose_payment_plan">
            <div class="divider divider-left">
                <div class="divider-text">
                    <h4>3. SELECT PAYMENT PLAN</h4>
                </div>
            </div>
            <br>
            <input type="radio" class="btn-check" name="payment-option" id="installmentchoice" value="installment" autocomplete="off" checked="">
            <label class="btn btn-outline-primary" for="installmentchoice">
                INSTALLMENT
            </label>

            <input type="radio" class="btn-check" name="payment-option" id="fullpaymentchoice" value="full" autocomplete="off">
            <label class="btn btn-outline-primary" for="fullpaymentchoice">
                FULL PAYMENT
            </label>

            <img style="width:10%; display:none" class="temp_loading" src="<?php echo base_url('assets/images/barloader.gif'); ?>">
        </div>
        <div class="col-md-6">
            <br>
            <table class="table table-striped fees-table">
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