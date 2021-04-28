<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header Content -->
    <title><?php if ($Title) echo $Title; ?></title>
    <?php if ($Header) echo $Header; ?>
    <?php if ($Script) echo $Script; ?>
</head>

<ul class="transition transition-effect">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<div class="content wrapper" data-barba="wrapper">
    <main data-barba="container" data-barba-namespace="<?php echo $Title; ?>">
        <?php if ($Body) echo $Body; ?>
    </main>
</div>

<script src="https://unpkg.com/@barba/core"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/barba.js') ?>"></script>
<script src="<?php echo base_url('assets/js/animations.js') ?>"></script>
<!-- <?php if ($Footer) echo $Footer; ?> -->

</body>

</html>