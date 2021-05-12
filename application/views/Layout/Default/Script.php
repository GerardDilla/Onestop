
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url(); ?>assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="<?php echo base_url('assets/vendors/jquery-password-validation-while-typing/js/jquery.passwordRequirements.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/iziModal.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/iziToast.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url('assets/vendors/waitMe/waitMe.js');?>"></script>
<?php
    echo "<script>iziToast.show({
        theme: 'dark',
        icon: 'icon-person',
        title: 'Welcome',
        message: '".$this->session->userdata('first_name')." ".$this->session->userdata('last_name')."',
        position: 'topRight',
        progressBarColor: '#cc0000',
        image: '" . base_url('assets/vendors/login_asset/img/sdcalogo.png') . "',
        timeout:false,
        close: false,
        closeOnEscape: false,
        closeOnClick: false,
        drag:false
    });</script>";
?>
<!-- <script src="<?php echo base_url(); ?>assets/vendors/Datatable/DataTables-1.10.23/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/vendors/Datatable/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script> -->
<!-- <script href="<?php echo base_url('https://cdn.jsdelivr.net/npm/fullcalendar@3.10.1/dist/fullcalendar.min.js'); ?>"></script> -->
