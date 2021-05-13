<?php
if ($this->session->flashdata('success') != "") {
    echo "<script>iziToast.show({
        theme: 'dark',
        icon: 'icon-person',
        title: 'Welcome',
        message: '" . $this->session->flashdata('success') . "',
        position: 'topRight',
        progressBarColor: '#cc0000',
        image: '" . base_url('assets/vendors/login_asset/img/sdcalogo.png') . "',
    });</script>";
    $this->session->set_flashdata('success', '');
}
?>
<!-- Unused css
    <link href="<?php echo base_url() ?>assets/js/wizard/bootstrap.min.css" rel="stylesheet" /> -->
<section class="section" id="assessment_section" data-baseurl="<?php echo base_url(); ?>">

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
                                <div id="progress_bar" class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                            </div>
                            <div hidden id="assesment_hidden" data-status='<?php echo $this->data['status'][0] ?>'></div>
                            <!-- Progress Nav -->
                            <ul>
                                <li>
                                    <a href="#student_information_content" id="tab_student_information">
                                        <div id="tab_student_information-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-person-lines-fill" id="bi_resize"></i>
                                        </div>
                                        STUDENT INFORMATION
                                    </a>
                                </li>
                                <li>
                                    <a href="#requirements_content" id="tab_requirements">
                                        <div id="tab_requirements-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-card-checklist" id="bi_resize"></i>
                                        </div>
                                        REQUIREMENTS
                                    </a>
                                </li>
                                <li>
                                    <a href="#advising_content" id="tab_advising">
                                        <div id="tab_advising-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-clipboard-plus" id="bi_resize"></i>
                                        </div>
                                        ADVISING
                                    </a>
                                </li>
                                <li>
                                    <a href="#payment_content" id="tab_payment">
                                        <div id="tab_payment-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-cash-stack" id="bi_resize"></i>
                                        </div>
                                        PAYMENT
                                    </a>
                                </li>
                                <li>
                                    <a href="#registration_content" id="tab_registration">
                                        <div id="tab_registration-circle" class="icon-circle">
                                            <i class="bi bi-file-text" id="bi_resize"></i>
                                        </div>
                                        REGISTRATION
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
                            <div class="tab-pane container" id="student_information_content">
                                <?php $this->load->view($this->data['student_information']); ?>
                            </div>
                            <div class="tab-pane container" id="advising_content">
                                <?php $this->load->view($this->data['advising']); ?>
                            </div>
                            <div class="tab-pane container" id="requirements_content">
                                <h3>REQUIREMENTS</h3>
                                <hr>
                                <?php $this->load->view($this->data['requirementstab']); ?>
                            </div>
                            <div class="tab-pane container" id="payment_content">
                                <?php $this->load->view($this->data['payment']); ?>
                            </div>
                            <div class="tab-pane container" id="registration_content">
                                <?php $this->load->view($this->data['registration']); ?>
                            </div>

                        </div>

                        <div class="col-md-12" style="text-align:center">
                            <hr>
                            <button type="button" class="btn btn-lg btn-success reset_progress_test">Reset Progress (FOR TESTING)</button>

                            <button type="button" class="btn btn-lg btn-primary wizard-proceed" id="proceed-wizard">PROCEED</button>
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
    <?php $this->load->view($this->data['advising_modals']); ?>


</section>
<script>

</script>
<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/js/wizard/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/wizard/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<!--  Plugin for the Wizard -->
<script src="<?php echo base_url() ?>assets/js/wizard/paper-bootstrap-wizard.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/Datatable/DataTables-1.10.23/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/Datatable/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/Datatable2/Responsive-2.2.7/js/dataTables.responsive.min.js"></script>
<!-- Advising -->
<script src="<?php echo base_url(); ?>assets/js/advising.js"></script>

<!-- Temporary Loading script -->
<script>
    $(document).ajaxStart(function() {
        $(".temp_loading").fadeIn();
    });
    $(document).ajaxStop(function() {
        $(".temp_loading").fadeOut();
    });
</script>