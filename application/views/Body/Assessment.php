<section class="section">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-12">
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
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">FIRST</option>
                                    <option value="2">SECOND</option>
                                    <option value="3">SUMMER</option>
                                </select>
                                <label class="input-group-text" for="inputGroupSelect01">Semester</label>
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
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">FIRST</option>
                                    <option value="2">SECOND</option>
                                    <option value="3">SUMMER</option>
                                </select>
                                <label class="input-group-text" for="inputGroupSelect01">Section</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h6>BLOCK SUBJECTS FOR: BSIT1A</h6>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Sched Code</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Section</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>20202021</td>
                                <td>ITC123</td>
                                <td>Programming Fundamentals</td>
                                <td>BSIT1A</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>20202022</td>
                                <td>ITC123</td>
                                <td>Programming Fundamentals</td>
                                <td>BSIT1A</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>20202023</td>
                                <td>ITC123</td>
                                <td>Programming Fundamentals</td>
                                <td>BSIT1A</td>
                                <td>5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
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