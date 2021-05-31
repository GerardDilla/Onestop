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
                <!-- 
                <li class="sidebar-item">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Enrollment Guide</span>
                    </a>
                </li> -->
                <li class="sidebar-item <?php echo $tab_active == 'Self Assessment' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('index.php/Main/selfassesment') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Self Assesment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('index.php/Main/validationOfDocuments') ?>" class='sidebar-link'>
                        <i class="bi bi-card-checklist"></i>
                        <span>Requirements</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo base_url('index.php/Main/uploadProofOfPayment') ?>" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Proof of Payment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('index.php/Main/enrollment_breakdown') ?>" class='sidebar-link'>
                        <i class="bi bi-menu-app-fill"></i>
                        <span>Enrollment Breakdown</span>
                    </a>
                </li>

                <!-- <li class="sidebar-item">
                    <a href="<?php echo base_url('forms/digital_citizenship') ?>" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Digital Citizenship</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo base_url('forms/id_application') ?>" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>ID Application</span>
                    </a>
                </li> -->

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item <?php echo $tab_active == 'Password Reset' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('index.php/Main/passwordReset') ?>">Reset Password</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>DevTools</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="<?php echo base_url(); ?>index.php/main/resetEnrollmentLegend" target="_blank">Reset Assessment and Enrollment</a>
                        </li>
                        <li class="submenu-item">
                            <a href="<?php echo base_url(); ?>index.php/ose_api/setpaid_test" target="_blank">Set As Enrolled</a>
                        </li>
                        <li class="submenu-item">
                            <a href="void(0)" data-bs-toggle="modal" data-bs-target="#oldStudentAccountModal">Old Student Account Creation</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo base_url('index.php/main/logout'); ?>" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>