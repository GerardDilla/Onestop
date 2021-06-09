<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header Content -->
    <title><?php if ($Title) echo $Title; ?></title>
    <?php if ($Header) echo $Header; ?>

</head>

<body>

    <div id="app">
        <!-- Sidebar Content -->
        <?php if ($Sidenav) echo $Sidenav; ?>

        <div id="main">

            <!-- Sidenav Toggle -->
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Title -->
            <div class="page-heading">
                <h3><?php if ($Title) echo $Title; ?></h3>
            </div>
            <?php if ($Script) echo $Script; ?>
            <!-- Body Content -->
            <div class="page-content">
                <?php if ($Body) echo $Body; ?>
            </div>

            <!-- Footer Content -->
            <?php if ($Footer) echo $Footer; ?>

        </div>
        <?php if ($inquiry) echo $inquiry; ?>
        <?php
        $this->load->view('Body/CloseIziToastAfterModalClick');
        $this->load->view('Body/StudentModal');
        // $this->load->view('TokenHandler');
        ?>

        <!-- <span class="chat-logo"><i class="bi bi-chat-text"></i></span> -->
    </div>

    <!-- Scripts Content -->


</body>

</html>