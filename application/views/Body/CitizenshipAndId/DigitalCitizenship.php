<style>
    #button_icon {
        color: white;
    }

    .title_color {
        color: rgba(67, 94, 190, 1);
    }

    .required_field {
        color: rgba(255, 0, 0, 1);
    }
</style>
<section class="section" id="id_baseurl" data-baseurl="<?php echo base_url(); ?>">
    <div class="card">
        <div class="alert alert-light-danger color-danger">
            <i class="bi bi-exclamation-circle"></i>
            PLEASE USE CAPITAL LETTERS TO FILL IN THIS FORM
        </div>
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <p>
                                <span class="title_color">Full Name</span>
                                <span class="required_field"> *</span> (
                                <small class="text-muted">Last name, Given Name, M.I</small>)
                            </p>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Last Name" id="last_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Given Name" id="first_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">M.I</span>
                                    <input type="text" class="form-control" placeholder="Middle Initial" id="middle_name">
                                    <!-- <button class="input-group-text btn-primary" title="Edit Data">
                                        <i class="bi bi-pencil-square" id="button_icon"></i>
                                    </button> -->
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Course / Department</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Course / Department">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <span class="title_color">Personal Email/ SDCA Gmail</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Concern</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck1">
                                    <label for="customColorCheck1">SDCA Gmail Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck2">
                                    <label for="customColorCheck2">Student Portal</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck3">
                                    <label for="customColorCheck3">Blackboard Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck4">
                                    <label for="customColorCheck4">Microsoft Office 365</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="title_color">Request Details</span>
                                    <span class="required_field"> *</span>
                                </p>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck1">
                                    <label for="customColorCheck1">Account Activation/Creation</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck2">
                                    <label for="customColorCheck2">Forgot Password</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input form-check-primary" name="customCheck" id="customColorCheck3">
                                    <label for="customColorCheck3">Other:</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>