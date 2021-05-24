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
        <!-- <?php if($inquiry) echo $inquiry;?> -->
        <!-- <span class="chat-logo"><i class="bi bi-chat-text"></i></span> -->
    </div>
    <?php
        if($this->session->flashdata('success')!=''){
            echo "<script>
            iziToast.show({
            icon: 'bi bi-check2-square',
            title: 'Hi! ',
            message: `".$this->session->flashdata('success')."`,
            position: 'topCenter',
            progressBarColor: '#cc0000',
            onClosing: function(instance, toast, closedBy){
            },
            onClosed: function(instance, toast, closedBY){
                
            }
        });</script>";
        }
    ?>
    <!-- Scripts Content -->
    

</body>

</html>