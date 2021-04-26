<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Mazer Admin Dashboard</title>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">


<link rel="stylesheet" href="<?php echo base_url('assets/vendors/iconly/bold.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.svg'); ?>" type="image/x-icon">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-datatables/style.css'); ?>"> -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css">
<script src="<?php echo base_url('assets/vendors/login_asset/js/jquery.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<style>
    /* sticky sidenav responsive to content */
    #sidebar {
        position: fixed;
        height: 100%;
        z-index: 100;
    }

    div#main {
        margin-left: 300px;
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
</style>