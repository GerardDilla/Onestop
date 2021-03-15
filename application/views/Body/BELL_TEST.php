<!-- Unused css
    <link href="<?php echo base_url() ?>assets/js/wizard/bootstrap.min.css" rel="stylesheet" /> -->
<link href="<?php echo base_url() ?>assets/js/wizard/paper-bootstrap-wizard.css" rel="stylesheet" />

<section class="section">
    <div class="card">
        <!-- <div class="card-header">
        </div> -->
        <div class="row">
            <!-- Wizard container -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="red" id="wizardProfile">
                    <form action="" method="">
                        <div class="wizard-navigation">
                            <div class="progress-with-circle">
                                <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                            </div>
                            <!-- Progress Nav -->
                            <ul>
                                <li>
                                    <a href="#student_information" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-user"></i>
                                        </div>
                                        STUDENT INFORMATION
                                    </a>
                                </li>
                                <li>
                                    <a href="#advising" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-settings"></i>
                                        </div>
                                        ADVISING
                                    </a>
                                </li>
                                <li>
                                    <a href="#registration" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-map"></i>
                                        </div>
                                        REGISTRATION
                                    </a>
                                </li>
                                <li>
                                    <a href="#payment" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-map"></i>
                                        </div>
                                        PAYMENT
                                    </a>
                                </li>
                            </ul>
                            <!-- /Progress Nav -->
                        </div>
                        <br>
                        <br>
                        <br>
                        <!-- Inside Content -->
                        <div class="tab-content">
                            <div class="tab-pane" id="student_information">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h6 class="col-md-12" style="margin-bottom:15px">YOUR INFORMATION</h6>
                                            <div class="col-md-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>FIRST NAME:</td>
                                                            <td>JUAN</td>
                                                        </tr>
                                                        <tr>
                                                            <td>MIDDLE NAME:</td>
                                                            <td>DELA</td>
                                                        </tr>
                                                        <tr>
                                                            <td>LAST NAME:</td>
                                                            <td>CRUZ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>REFERENCE NUMBER:</td>
                                                            <td>123456</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                            </div>
                                            <HR>
                                            <h6 class="col-md-12">CONFIRM YOUR COURSE</h6>
                                            <small class="col-md-12">Choose one of your preferred courses</small>
                                            <div class="col-md-6">
                                                <BR>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect">
                                                        <option>PREFERRED COURSES</option>
                                                        <option>BSIT</option>
                                                        <option>BSBA</option>
                                                        <option>ABMMA</option>
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect">
                                                        <option>COURSE MAJOR</option>
                                                        <option>BSIT</option>
                                                        <option>BSBA</option>
                                                        <option>ABMMA</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="advising">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>2. CHOOSE SUBJECTS</h6>
                                            <br>
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal">Add Subjects</a>
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#scheduleModal">View Schedule Plot</a>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-striped" id="queueTable">
                                        <thead>
                                            <tr>
                                                <th>Sched Code</th>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Section</th>
                                                <th>Units</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
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
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>3. SELECT PAYMENT PLAN</h6>
                                            <br>
                                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked="">
                                            <label class="btn btn-sm btn-outline-primary" for="success-outlined">
                                                INSTALLMENT
                                            </label>

                                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-primary" for="danger-outlined">
                                                FULL PAYMENT
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>OTHER FEES:</td>
                                                        <td>10000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>MISC FEES</td>
                                                        <td>10000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>LAB FEES</td>
                                                        <td>10000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TUITION FEES</td>
                                                        <td>10000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TOTAL FEES:</td>
                                                        <td>10000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="registration">
                                testing 3
                            </div>
                            <div class="tab-pane" id="payment">
                                testing 4
                            </div>
                        </div>
                        <!-- /Inside Content -->
                        <!-- For Button Next 
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                    <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div> 
                        -->
                    </form>
                </div>
            </div>
            <!-- /wizard container -->
        </div>
    </div>
</section>
<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/js/wizard/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/wizard/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<!--  Plugin for the Wizard -->
<script src="<?php echo base_url() ?>assets/js/wizard/paper-bootstrap-wizard.js" type="text/javascript"></script>