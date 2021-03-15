<!-- Unused css
    <link href="<?php echo base_url() ?>assets/js/wizard/bootstrap.min.css" rel="stylesheet" /> -->
<link href="<?php echo base_url() ?>assets/js/wizard/paper-bootstrap-wizard.css" rel="stylesheet" />
<style>

</style>
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
                                    <a href="#test1" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-user"></i>
                                        </div>
                                        test 1
                                    </a>
                                </li>
                                <li>
                                    <a href="#test2" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-settings"></i>
                                        </div>
                                        test 2
                                    </a>
                                </li>
                                <li>
                                    <a href="#test3" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-map"></i>
                                        </div>
                                        test 3
                                    </a>
                                </li>
                                <li>
                                    <a href="#test4" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-map"></i>
                                        </div>
                                        test 4
                                    </a>
                                </li>
                            </ul>
                            <!-- /Progress Nav -->
                        </div>
                        <!-- Inside Content -->
                        <div class="tab-content">
                            <div class="tab-pane" id="test1">
                                <div class="row">
                                    <div class="col-sm-6">
                                        tetsing 1
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="test2">
                                testing 2
                            </div>
                            <div class="tab-pane" id="test3">
                                testing 3
                            </div>
                            <div class="tab-pane" id="test4">
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