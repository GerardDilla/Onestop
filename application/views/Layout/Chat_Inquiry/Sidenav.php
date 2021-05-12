<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="<?php echo base_url('assets/images/logo/DOSE LOGO.png');?>" alt="Logo" srcset=""></a>
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
                    <a href="<?php echo base_url('main/sdcaInquiry') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Student Inquiry</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="<?php echo base_url('main/validationOfDocuments') ?>" class='sidebar-link'>
                        <i class="bi bi-card-checklist"></i>
                        <span>Requirements</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo base_url('main/uploadProofOfPayment') ?>" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Proof of Payment</span>
                    </a>
                </li> -->

                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item <?php echo $tab_active == 'Password Reset' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('main/passwordReset') ?>">Reset Password</a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-item">
                    <a href="logout" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>