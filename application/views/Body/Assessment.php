<section class="section">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-lg ">
                            <tbody>
                                <tr>
                                    <td class="text-bold-500" style="font-weight:bold">NAME:</td>
                                    <td>Juan Dela Cruz</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500" style="font-weight:bold">REFERENCE NUMBER:</td>
                                    <td>12345</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500" style="font-weight:bold">COURSE:</td>
                                    <td>BSIT</td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500" style="font-weight:bold">MAJOR:</td>
                                    <td>N/A</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-9 row">
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
                        <h6>SUGGESTED SUBJECTS</h6>
                        <table class="table table-striped" id="table1">
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
                                    <td><a href="#" class="btn btn-warning rounded-pill">Remove</a></td>
                                </tr>
                                <tr>
                                    <td>20202022</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-warning rounded-pill">Remove</a></td>
                                </tr>
                                <tr>
                                    <td>20202023</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-warning rounded-pill">Remove</a></td>
                                </tr>
                                <tr>
                                    <td>20202023</td>
                                    <td>ITC123</td>
                                    <td>Programming Fundamentals</td>
                                    <td>BSIT1A</td>
                                    <td>5</td>
                                    <td><a href="#" class="btn btn-warning rounded-pill">Remove</a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
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
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>