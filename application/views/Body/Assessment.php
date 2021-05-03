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
                                <li id="tab_student_information">
                                    <a href="#student_information_content" data-toggle="tab">
                                        <div id="tab_student_information-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-person-lines-fill" id="bi_resize"></i>
                                        </div>
                                        STUDENT INFORMATION
                                    </a>
                                </li>
                                <li id="tab_advising">
                                    <a href="#tab_advising_content" data-toggle="tab">
                                        <div id="tab_advising-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-clipboard-plus" id="bi_resize"></i>
                                        </div>
                                        ADVISING
                                    </a>
                                </li>
                                <li id="tab_registration">
                                    <a href="#tab_registration_content" data-toggle="tab">
                                        <div id="tab_registration-circle" class="icon-circle">
                                            <!-- <div class="success_check"><i class="bi bi-check"></i></div> -->
                                            <i class="bi bi-cash-stack" id="bi_resize"></i>
                                        </div>
                                        PAYMENT
                                    </a>
                                </li>
                                <li id="tab_payment">
                                    <a href="#tab_payment_content" data-toggle="tab">
                                        <div id="tab_payment-circle" class="icon-circle">
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
                            <div class="tab-pane container" id="tab_advising_content">
                                <?php $this->load->view($this->data['advising']); ?>
                            </div>
                            <div class="tab-pane container" id="tab_registration_content">

                            </div>
                            <div class="tab-pane container" id="tab_payment_content">
                                <?php $this->load->view($this->data['payment']); ?>
                            </div>
                        </div>

                        <div class="col-md-12" style="text-align:center">
                            <hr>
                            <button type="button" class="btn btn-lg btn-primary wizard-proceed">PROCEED</button>
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

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
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