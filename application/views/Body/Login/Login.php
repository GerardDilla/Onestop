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
else if($this->session->flashdata('success')!=''){
    echo "<script>
    iziToast.show({
    icon: 'bi bi-check2-square',
    title: 'Success',
    message: `".$this->session->flashdata('success')."`,
    position: 'topCenter',
    progressBarColor: '#cc0000',
    onClosing: function(instance, toast, closedBy){
    },
    onClosed: function(instance, toast, closedBY){
        
    }
});</script>";
    $this->session->set_flashdata('success','');
}
?>
<div class="page login-page page-1">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row bg-white">
        <div class="col-lg-6 col-md-6 col-sm-6 first_row login-row">
            <!-- <div class="info d-flex align-items-center">
            <div class="content title-content">
                <div class="logo">
                <image class="logo-white anim1" src="<?php echo base_url('assets/vendors/login_asset/img/DOSE_FINAL DESIGN.png');?>">
                </div>
                <h1 class="main-title anim1">One Stop Enrollment</h1>
            </div>
            </div> -->
            
            <span class="enrollment">Enrollment</span>
            <span class="made_easy">MADE EASY!</span>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-6 col-sm-6 second_row login-row bg-white" >
            <div class="form d-flex">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/loginProcess')?>">
                <image class="dose-logo" src="<?php echo base_url('assets/vendors/login_asset/css/img/DOSE LOGO.png');?>">
                <span class="white-box"></span>
                <div class="col-md-12" style="margin-bottom:20px;text-align:center;">
                    <h1 class="anim2">SIGN IN</h1>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                    <label for="login-username" class="label-material label-color" style="color:black;font-weight:bold;">User Name</label>
                </div>
                <div class="form-group anim3">
                    
                    
                    <input autocomplete="off" id="login-password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material">
                    <label for="login-password" class="label-material label-color" style="color:black;font-weight:bold;">Password</label>
                    <span class="show-password">
                        <i id="show_loginPassword" class="bi bi-eye-fill" onclick="showPassword('loginPassword')" aria-hidden="true"></i>
                    </span>
                    
                    
                </div>
                <h5><a href="javascript:void(0)" onclick="forgotPassword2()" class="forgot-pass leave_button">Forgot Password?</a></h5>
                <div align="center" style="margin-top:20px;">
                    <button id="login" type="submit" class="btn btn-danger btn-sm submit-button">Login</button>
                </div>
                <div class="col-md-12">
                
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
<script>
if($(window).width()==1024&&$(window).height()==1366){
    console.log('ipad pro')
    $('.first_row').removeClass('col-lg-6');
    $('.first_row').addClass('col-lg-12');
    $('.second_row').removeClass('col-lg-6');
    $('.second_row').addClass('col-lg-12');
}
else{
    $('.first_row').removeClass('col-lg-12');
    $('.first_row').addClass('col-lg-6');
    $('.second_row').removeClass('col-lg-12');
    $('.second_row').addClass('col-lg-6');
}
if($(window).width()==768&&$(window).height()==1024){
    $('.first_row').removeClass('col-md-6');
    $('.first_row').addClass('col-md-12');
    $('.second_row').removeClass('col-md-6');
    $('.second_row').addClass('col-md-12');
    // console.log('iPad')
}
else{
    $('.first_row').removeClass('col-md-12');
    $('.first_row').addClass('col-md-6');
    $('.second_row').removeClass('col-md-12');
    $('.second_row').addClass('col-md-6');
}
$(window).resize(function(){
    // console.log($(window).width());
    if($(window).width()==1024&&$(window).height()==1366){
        $('.first_row').removeClass('col-lg-6');
        $('.first_row').addClass('col-lg-12');
        $('.second_row').removeClass('col-lg-6');
        $('.second_row').addClass('col-lg-12');
        console.log('iPad Pro')
    }
    else{
        $('.first_row').removeClass('col-lg-12');
        $('.first_row').addClass('col-lg-6');
        $('.second_row').removeClass('col-lg-12');
        $('.second_row').addClass('col-lg-6');
    }
    if($(window).width()==768&&$(window).height()==1024){
    $('.first_row').removeClass('col-md-6');
    $('.first_row').addClass('col-md-12');
    $('.second_row').removeClass('col-md-6');
    $('.second_row').addClass('col-md-12');
    // console.log('iPad')
    }
    else{
        $('.first_row').removeClass('col-md-12');
        $('.first_row').addClass('col-md-6');
        $('.second_row').removeClass('col-md-12');
        $('.second_row').addClass('col-md-6');
    }
})
$('form').on('submit',function(){
    var count = 0;
    $('.input-material').each(function(){
        if($(this).val()==""){
            ++count;
        }
    })
    if(count==0){
        $('#login').attr('disabled','disabled');
    }
});
$('#show_'+id).toggle(4000,function(){
        alert('toggled')
    });
function showPassword(id){
    var x = document.querySelector(`[name=${id}]`);
    var icon = document.getElementById('show_'+id);

    if (x.type === "password") {
        x.type = "text";
        icon.classList.remove("bi-eye-fill")
        icon.classList.add("bi-eye-slash")
    } else {
        x.type = "password";
        icon.classList.remove("bi-eye-slash")
        icon.classList.add("bi-eye-fill")
    }
}
function closeAnimation(){
    var playPause = anime({
    targets: '#amazing path',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 1000,
    delay: function(el, i) { return i * 200 },
    direction: 'normal',
    // loop: true,
    autoplay:true,
        begin: function(anim) {
            goToLink();
            var interval2 = window.setInterval(function(){
                // goToLink();
            clearInterval(interval2);  
            },1000);
        }
    });
    playPause.play();
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    var t1 = gsap.timeline();
    t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
    $('.transition-effect').css('z-index','1001');
    $('#amazing').css('z-index','1002');
}
function goToLink(){
    window.location.replace("<?php echo base_url('main/forgotpassword')?>");
}
function forgotPassword2(){
    closeAnimation();
    // goToLink();
}
</script>