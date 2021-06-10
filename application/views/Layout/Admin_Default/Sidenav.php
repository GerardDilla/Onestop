<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="<?php echo base_url('assets/images/logo/DOSE_LOGO.png'); ?>" alt="Logo" srcset=""></a>
                    <hr>
                    <h6 style="text-align: center;">ADMISSIONS PORTAL</h6>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title" style="text-align: center;">
                    <h6>Welcome, <?php echo $this->session->userdata('first_name'); ?>!</h6>
                </li>
                <li class="sidebar-item <?php echo $tab_active == 'Self Assessment' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('index.php/Main/sdcaInquiry') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Student Inquiry</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo $tab_active == 'Digital Citizenship' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('index.php/Admin/digitalCitizenship') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Digital Citizenship</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo $tab_active == 'ID Application' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('index.php/Admin/idApplication') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>ID Application</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('index.php/admin/logout'); ?>" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>