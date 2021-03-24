<div class="row">
    <div class="col-md-12">
        <div class="row">
            <h6 class="col-md-12" style="margin-bottom:15px">YOUR INFORMATION</h6>
            <div class="col-md-6">
                <table class="table" style="display: block; overflow: auto;">
                    <tbody>
                        <tr>
                            <td>FIRST NAME:</td>
                            <td><?php echo $this->session->userdata('first_name');?></td>
                        </tr>
                        <tr>
                            <td>MIDDLE NAME:</td>
                            <td><?php echo $this->session->userdata('middle_name');?></td>
                        </tr>
                        <tr>
                            <td>LAST NAME:</td>
                            <td><?php echo $this->session->userdata('last_name');?></td>
                        </tr>
                        <tr>
                            <td>REFERENCE NUMBER:</td>
                            <td><?php echo $this->session->userdata('reference_no');?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="col-md-12">
                <HR>
                <h6>CHOOSE YOUR STATUS</h6>
                <br>
                <input type="radio" class="btn-check" name="eductype" id="success-outlined" data-etype='freshmen' autocomplete="off" checked="checked">
                <label class="btn btn-sm btn-outline-primary" for="success-outlined">
                    NEW STUDENT
                </label>

                <input type="radio" class="btn-check" name="eductype" id="danger-outlined" data-etype='transferee' autocomplete="off">
                <label class="btn btn-sm btn-outline-primary" for="danger-outlined">
                    TRANSFEREE
                </label>

            </div>

            <div class="col-md-12 shs-verification">
                <br>
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input form-check-primary shsverification" name="shsverification">
                        <label class="form-check-label" for="customColorCheck1">I Graduated from St. Dominic College of Asia</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12 balance-verification" style="display:none">
                <br>
                <div class="form-check" style="padding-left:0px">
                    <div class="form-group">
                        <label for="helperText">Senior Highschool Student Number</label>
                        <input type="text" id="helperText" class="form-control" placeholder="20202020">
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
                <h6>CONFIRM YOUR COURSE</h6>
                <small>Choose one of your preferred courses</small>
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

<!-- Will remove later in development -->

<script>
    $(document).ready(function() {

        $('input[type=radio][name=eductype]').change(function() {
            type = $(this).data('etype');
            if (type == 'freshmen') {
                $('.shs-verification').fadeIn();
                shsChecker = $('.shsverification:checkbox:checked').length > 0
                if (shsChecker) {
                    $('.balance-verification').fadeIn();
                } else {
                    $('.balance-verification').fadeOut();
                }
            } else {
                $('.shs-verification').fadeOut();
                $('.balance-verification').fadeOut();
            }
            console.log('Changed');
        });

        $('input[type=checkbox][name=shsverification]').change(function() {

            shsChecker = $('.shsverification:checkbox:checked').length > 0
            if (shsChecker) {
                $('.balance-verification').fadeIn();
            } else {
                $('.balance-verification').fadeOut();
            }

        });

    });
</script>