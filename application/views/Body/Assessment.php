<section class="section">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body row">

            <div class="col-md-12">
                <div class="row">
                    <hr>
                    <h6 class="col-md-12" style="margin-bottom:15px">CHOOSE ONE OF THE FOLLOWING:</h6>
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
                        <h6>SUGGESTED SUBJECTS</h6>
                        <br>
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal">Add Subjects</a>
                        <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="scheduleModal">View Schedule Plot</a>
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

        </div>

        <!-- Modal Content -->
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

    </div>
</section>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let queueTable = document.querySelector('#queueTable');
    let dataTable1 = new simpleDatatables.DataTable(queueTable);

    // Simple Datatable
    let subjectTable = document.querySelector('#subjectTable');
    let dataTable2 = new simpleDatatables.DataTable(subjectTable);
</script>