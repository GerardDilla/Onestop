<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header Content -->
    <title><?php if ($Title) echo $Title; ?></title>
    <?php if ($Header) echo $Header; ?>
    <?php if ($Script) echo $Script; ?>
</head>
<style>
    ul.transition{
        display:flex;
        position:absolute;
        z-index:1000;
        height: 100vh;
        width:100%;
        top:0;
        left:0;
        margin:0;
        pointer-events:none;
    }
    ul.transition li{
        transform:scaleY(1);
        background:white;
        width:20%;
    }
    ul{
        list-style:none;
        display:flex;
        padding:0;
        margin-right:auto;
    }
    img.loading{
        /* z-index:1002; */
        /* top:50%; */
        /* right:50%; */
        max-width:400px;
        /* width:100%; */
        /* transform:translateY(-50%); */
        /* margin-top:35%; */
        /* transition:transform 1s cubic-bezier(0.7,0.04,0.66,1.71); */
        /* transition:transform 300ms cubic-bezier(0,0.47,0.32,1.97); */
        /* pointer-events:none; */
    }
    img.loading:hover{
        /* transform:translate(200px,150px) rotate(20deg); */
        /* transform:translate(200px,150px) rotate(20deg) */
    }
    #loading{
        /* display:none; */
        width:100%;
        height:100vh;
        position:absolute;
        z-index:1001;
        background:transparent;
        display:flex;
        align-items:center;
        justify-content:center;
    }
    #loading img.loading{
        clip-path:polygon(0 0,100% 0,100% 0,0 0);
        /* display:none; */
        z-index:1002;
        margin:auto;
        position:absolute;
        /* left:50%; */
        bottom:50%;
        transform:translateY(50%,50%);
        width:100%;
    }
</style>
<body data-barba="wrapper">
<div id="loading" class="transition-effect">
    <img class="loading transition-effect" src="<?php echo base_url('assets/vendors/login_asset/css/img/DOSE_FINAL DESIGN.png')?>">
</div>
<ul class="transition transition-effect">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<div class="content wrapper" data-barba="wrapper">
    <main data-barba="container" data-barba-namespace="<?php echo $Title;?>">
    <?php if ($Body) echo $Body; ?>
    </main>
</div>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script> -->
<script src="https://unpkg.com/@barba/core"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/barba.js')?>"></script>
<script src="<?php echo base_url('assets/js/animations.js')?>"></script>
<!-- <script src="<?php echo base_url('assets/js/anime.js')?>"></script> -->
<?php if ($Footer) echo $Footer; ?>

</body>

</html>