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
            </div>
            </div>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-12 second_row login-row">
            <div class="form d-flex">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/changePasswordProcess') ?>">
                <input type="hidden" name="JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=" value="<?php echo $key;?>">
                <div class="col-md-12" style="margin-bottom:40px">
                    <h1>Password Reset</h1>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-new" type="password" name="new_password" required data-msg="Please enter your new password" class="pr-password input-material">
                    <label for="login-new" class="label-material" style="color:black;font-weight:bold;">New Password</label>
                    <!-- <div class="col-md-6" style="margin-top:10px;">
                        <div style="margin:0;padding:0;text-align:center;color:white;background:blue;height:20px;border-radius:10px;width:100%;">Weak</div>
                        <b>Password Must Contain</b>
                        <ul class="password-validator">
                            <li>a capital(uppercase) letter</li>
                            <li>a number</li>
                            <li>Minimum 8 characters</li>
                        </ul>
                        
                    </div> -->
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-confirm" type="password" name="confirm_password" required data-msg="Incorrect confirm password" class="input-material">
                    <label for="login-confirm" class="label-material" style="color:black;font-weight:bold;">Confirm Password</label>
                </div>
                <div align="right">
                    <button id="login" type="submit" class="btn btn-info submit-button">Submit</button>
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
    $(".pr-password").passwordRequirements({
            useLowercase:false,
            useSpecial : false
        });
    $('#login-confirm').on('keyup',function(){
        if($('#login-new').val()==$("#login-confirm").val()){
            $("#login-confirm").removeClass('is-invalid');
        }
        else{
            $("#login-confirm").addClass('is-invalid');
        }
    })
</script>
<script>
openEffect();
function back(){
    closeEffect();
}
// function back(){
//     gsap.from('.page-2',{opacity:0,duration:1,y:-50});
// }
function openEffect(){
    gsap.from('.form-holder',{opacity:0,duration:1,y:-50});
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
    // gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50,delay:1,onComplete:function(){goToLink()}});
}
</script>