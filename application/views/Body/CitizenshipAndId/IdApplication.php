<section class="section" id="id_baseurl" data-baseurl="<?php echo base_url(); ?>">
    <div class="alert alert-light-danger color-danger">
        <i class="bi bi-exclamation-circle"></i>
        PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM
    </div>
    <div class="card">
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">ID Application Status</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck1">
                                    <label for="customColorCheck1">New ͏Student</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck2">
                                    <label for="customColorCheck2">Old Student</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck3">
                                    <label for="customColorCheck3">Replacement</label>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Receipt Number</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Receipt Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">LRN - Learner's Reference Number</span>
                                    <!-- <span class="required_field"> *</span> -->
                                    (<small class="text-muted">for BEd and SHS only</small>)
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Learner's Reference Number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Student Number</span>
                                    <span class="required_field"> *</span><br>
                                    <small class="text-muted">Can be found on your registration form.
                                        <br>
                                        <span class="text_note">Note</span>: If not found, proceed to Registrars Office for your Student Number

                                    </small>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Student Number">
                                </div>
                            </div>
                            <p>
                                <span class="title_color">Full Name</span>
                                <span class="required_field"> *</span> (
                                <small class="text-muted">First Name, M.I, Lastname</small>)
                            </p>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="First Name" id="first_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" title="Middle Initial">M.I</span>
                                    <input type="text" class="form-control" placeholder="Middle Initial" id="middle_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Last Name" id="last_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Course</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Course">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">ID Picture</span>
                                    <span class="required_field"> *</span>
                                    <small><br>
                                        <span class="text_note">Photo Requirements</span>: Half Body Photo only, wearing School Uniform with White Background.
                                        <br>
                                        <span class="text_note">NOTE</span>: USE YOUR STUDENT NUMBER TO NAME YOUR PHOTO ONLY.
                                    </small>
                                </p>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Signature</span>
                                    <span class="required_field"> *</span>
                                    <small><br>
                                        <span class="text_note">Reminder</span>: For Higher Education (HED) Students only.
                                        <br>
                                        <span class="text_note">NOTE</span>: USE YOUR SETUDENT NUMBER TO NAM EYOUR SIGANTURE ONLY
                                    </small>
                                </p>
                                <input type="file" class="form-control" id="inputGroupFile01">
                                <br>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Guardian Name</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Guardian Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Guardian Address</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Guardian Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Guardian Contact Number</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Guardian Contact Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Guardian Email Address</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Guardian Email Address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>