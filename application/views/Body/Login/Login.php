<!-- <script>
    iziToast.warning({
          title: 'Error:',
          message: ' Incorrect Username or Password!!',
          position: 'topCenter',
      });
</script> -->
<?php
if($this->session->flashdata('msg')!=''){
    echo "<script>
    iziToast.warning({
        title: 'Error: ',
        message: '".$this->session->flashdata('msg')."',
        position: 'topCenter',
    });
    </script>";
    $this->session->set_flashdata('msg','');
}
?>
<div class="page login-page page-1">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row">
        <div class="col-lg-6 col-md-12 first_row login-row">
            <div class="info d-flex align-items-center">
            <div class="content title-content">
                <div class="logo">
                <image class="logo-white anim1" src="<?php echo base_url('assets/vendors/login_asset/img/DOSE_FINAL DESIGN.png');?>">
                </div>
                <!-- <h1 class="main-title anim1">One Stop Enrollment</h1> -->
            </div>
            </div>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-12 second_row login-row" style="background:transparent">
            <div class="form d-flex" style="background:transparent">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/loginProcess')?>">
                <div class="col-md-12" style="margin-bottom:20px">
                    <h1 class="anim2">Sign In</h1>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                    <label for="login-username" class="label-material label-color" style="color:black;font-weight:bold;">User Name</label>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material">
                    <label for="login-password" class="label-material label-color" style="color:black;font-weight:bold;">Password</label>
                </div>
                <div align="right">
                    <button id="login" type="submit" class="btn btn-info submit-button">Login</button>
                </div>
                <div class="col-md-12">
                <h2><a href="javascript:void(0)" onclick="forgotPassword()" class="forgot-pass">Forgot Password?</a></h2>
                </div>
                </form>
            </div>
            </div>
            <!-- <?php echo base_url('main/forgotpassword')?> -->
        </div>
        </div>
    </div>
    </div>
</div>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TimelineLite.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/CSSRulePlugin3.min.js"></script>
<script>
openEffect();
function forgotPassword(){
    closeEffect();
}
function back(){
    gsap.from('.page-2',{opacity:0,duration:1,y:-50});
}
function openEffect(){
    gsap.from('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.from('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
}
function goToLink(){
    window.location.replace("<?php echo base_url('main/forgotpassword')?>")
}
function closeEffect(){
    var this_window = window;
    gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50,delay:.5,onComplete:function(){goToLink()}});
}
</script>