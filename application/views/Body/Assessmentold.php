<?php $are ?>
<section class="section">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body row">

            <!-- STUDENT INFORMATION TAB -->
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
                            <!-- </fieldset>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect">
                                <option>COURSE MAJOR</option>
                                <option>BSIT</option>
                                <option>BSBA</option>
                                <option>ABMMA</option>
                            </select>
                        </fieldset> -->
                    </div>
                </div>
                <br>
            </div>
            <!-- /STUDENT INFORMATION TAB -->

            <!-- ADVISING TAB -->
            <div class="col-md-12">
                <div class="row">
                    <hr>
                    <h6 class="col-md-12" style="margin-bottom:15px">1. COMPLETE THE FOLLOWING:</h6>
                    <div class="col-md-6 mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">School Year</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">2020-2021</option>
                                <option value="2">2020-2021</option>
                                <option value="3">2020-2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">FIRST</option>
                                <option value="2">SECOND</option>
                                <option value="3">SUMMER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Curriculum</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">FIRST</option>
                                <option value="2">SECOND</option>
                                <option value="3">SUMMER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Section</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                <option value="1">FIRST</option>
                                <option value="2">SECOND</option>
                                <option value="3">SUMMER</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

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
            <!-- /ADVISING TAB -->

            <!-- PRE REGISTRATION TAB -->
            <!-- /PRE REGISTRATION TAB -->

            <!-- PAYMENT TAB -->
            <!-- /PAYMENT TAB -->

        </div>

        <!-- Modal Contents -->

        <!-- Subject Choices -->
        <div class="modal fade text-left w-100" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">ADD SUBJECTS</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped" id="subjectTable">
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
                                    <td><a href="#" class="btn btn-primary">Add Subject</a></td>
                                </tr>
                                <tr>
                                    <td>20202022</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-primary">Add Subject</a></td>
                                </tr>
                                <tr>
                                    <td>20202023</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-primary">Add Subject</a></td>
                                </tr>
                                <tr>
                                    <td>20202023</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-primary">Add Subject</a></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Plotting -->
        <div class="modal fade text-left w-100" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">SCHEDULE PLOT</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>MON</th>
                                    <th>TUE</th>
                                    <th>WED</th>
                                    <th>THURS</th>
                                    <th>FRI</th>
                                    <th>SAT</th>
                                    <th>SUN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>7:00 AM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th>7:30 AM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th>8:00 AM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th>8:30 AM</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="<?php echo base_url(); ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let queueTable = document.querySelector('#queueTable');
    let dataTable1 = new simpleDatatables.DataTable(queueTable);

    // Simple Datatable
    let subjectTable = document.querySelector('#subjectTable');
    let dataTable2 = new simpleDatatables.DataTable(subjectTable);
</script>