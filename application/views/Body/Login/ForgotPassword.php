<div class="page login-page">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row">
        <div class="col-lg-6 col-md-12 first_row login-row">
            <div class="info d-flex align-items-center">
            <div class="content title-content">
                <div class="logo">
                <image class="logo-white anim1" src="<?php echo base_url('assets/vendors/login_asset/img/DOSE_FINAL DESIGN.png');?>">
                </div>
                <h1 class="main-title anim1">
                    One Stop Enrollment
                <!-- Steps to reset password<br><br> -->
                <!-- <font class="steps">1. Type your email in Forgot Password page.</font><br>
                <font class="steps">1. Type your email in Forgot Password page.</font><br> -->
                </h1>
            </div>
            </div>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-12 bg-white second_row login-row">
            <div class="form d-flex">
            <div class="content">
                <form method="post" class="form-validate">
                <div class="col-md-12" style="margin-bottom:40px">
                    <h1 class="anim2">Forgot Password</h1>
                </div>
                <!-- <div class="form-group">
                    <input required autocomplete="off" id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                    <label for="login-username" class="label-material">User Name</label>
                </div> -->
                <div class="form-group">
                    <input required autocomplete="off" id="login-email" type="text" name="loginPassword" required data-msg="Please enter your password" class="input-material anim3">
                    <label for="login-email" class="label-material" style="color:black;font-weight:bold;">Email</label>
                </div>
                <div align="right">
                    <button id="login" type="submit" class="btn btn-info submit-button">Submit</button>
                </div>
                <div style="bottom:2;position:absolute;">
                    <a href="javascript:void(0)" onclick="back()" type="button" class="btn btn-default" style="font-weight:bold;"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<script>
openEffect();
function back(){
    closeEffect();
}
// function back(){
//     gsap.from('.page-2',{opacity:0,duration:1,y:-50});
// }
function openEffect(){
    gsap.from('.login-page',{opacity:0,duration:1,y:-50});
    gsap.from('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
}
function goToLink(){
    window.location.replace("<?php echo base_url('/')?>")
}
function closeEffect(){
    var this_window = window;
    gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    gsap.to('.login-page',{opacity:0,duration:1,y:-50,delay:.5,onComplete:function(){goToLink()}});
}
</script>