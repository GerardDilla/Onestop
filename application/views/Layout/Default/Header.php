<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
<title>Dashboard - Mazer Admin Dashboard</title>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">


<link rel="stylesheet" href="<?php echo base_url('assets/vendors/iconly/bold.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">

<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.svg'); ?>" type="image/x-icon">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-datatables/style.css'); ?>"> -->
<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-password-validation-while-typing/css/jquery.passwordRequirements.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/iziModal.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/assessmentWizard.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/iziToast.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/waitMe/waitMe.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('');?>assets/css/image-uploader.min.css">
<!-- dataTables.responsive -->
<script src="<?php echo base_url('assets/vendors/login_asset/js/jquery.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/proof_of_payment.css'); ?>">


<link rel="stylesheet" href="<?php echo base_url('assets/vendors/Datatable/DataTables-1.10.23/css/dataTables.bootstrap4.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/Datatable2/Responsive-2.2.7/css/responsive.dataTables.min.css">
<script type="text/javascript" src="<?php echo base_url('');?>assets/js/image-uploader.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/iziToast.min.css'); ?>">
<link href="<?php echo base_url() ?>assets/js/wizard/paper-bootstrap-wizard.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/assesmentWizard.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url('assets/css/assessmentWizard.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/forms.css');?>">
<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('');?>assets/js/timeago.js"></script> -->
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/vendors/fullcalendar/lib/main.css'); ?>"> -->

<link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard_responsiveness.css');?>">
<script src="https://unpkg.com/@popperjs/core@2"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.4.0/introjs.min.css" integrity="sha512-631ugrjzlQYCOP9P8BOLEMFspr5ooQwY3rgt8SMUa+QqtVMbY/tniEUOcABHDGjK50VExB4CNc61g5oopGqCEw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.4.0/intro.min.js" integrity="sha512-QWPjvFqgUJv5X6Sq5NXmwJQSEzUEBxmCCcgqJd5/5luZnS6llRbshsChUNKrFlZ4bshKZEJxAHDB+WWdMsGvUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo base_url('assets/js/walkthrough.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
<!-- <script src="<?php echo base_url('assets/js/notify.js'); ?>"></script> -->
<!-- <script href="<?php echo base_url('assets/vendors/fullcalendar/lib/main.js'); ?>"></script> -->
<style>
    /* sticky sidenav responsive to content */
    #sidebar {
        position: fixed;
        height: 100%;
        z-index: 100;
    }

    div#main {
        /* margin-left: 300px;   */
    }

    #pr-box i {
        border-bottom: 7px solid #05BCC8;
    }

    #pr-box.light p {
        background-color: #05BCC8;
    }

    #pr-box.light ul li span {
        border: 3px solid #05BCC8;
    }

    #pr-box.light ul li span.pr-ok {
        background-color: #05BCC8;
        border: 3px solid #05BCC8;
    }

    #pr-box.dark p {
        background-color: #05BCC8;
    }

    #pr-box.dark ul {
        background-color: #2d2f31;
    }

    #pr-box.dark ul li span {
        background-color: #2d2f31;
        border: 3px solid #05BCC8;
    }

    #pr-box.dark ul li span.pr-ok {
        background-color: #05BCC8;
        border: 3px solid #05BCC8;
    }
    .payment_methods{
        padding-bottom: 10px;
    }
    .btn-hover-red:hover{
        background-color: rgba(128, 0, 0, 1) !important;
        /* background-color: rgba(25, 135, 84, 1) !important; */
        /* color: rgba(255, 0, 0, 1) !important; */
    }
    /* .btn-success-hover-transparent:hover{
        background-color: rgba(255, 0, 0, 1) !important;
        color: rgba(25, 135, 84, 1) !important;
    } */
    
</style>