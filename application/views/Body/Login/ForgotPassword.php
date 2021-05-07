<?php
echo '<script> $(document).ready(function(){';
if($this->session->flashdata('msg')!=''){
    echo "
    var error = window.setInterval(function(){
    iziToast.warning({
        title: 'Error: ',
        message: '".$this->session->flashdata('msg')."',
        position: 'topCenter',
    });
    clearInterval(error);
    },500);
    ";
    $this->session->set_flashdata('msg','');
}
else if($this->session->flashdata('success')!=''){
    echo "
    var success = window.setInterval(function(){
        iziToast.show({
        icon: 'bi bi-check2-square',
        title: 'Success',
        message: `".$this->session->flashdata('success')."`,
        position: 'topCenter',
        progressBarColor: '#cc0000',
        onClosing: function(instance, toast, closedBy){
        },
        onClosed: function(instance, toast, closedBY){
            // alert('closed');
            back();
        }
    });
    clearInterval(success);
    },500);
    ";
    $this->session->set_flashdata('success','');
}
echo '});</script>';
?>

    </script>
<div class="page login-page">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row bg-white">
        <div class="col-lg-6 col-md-6 col-sm-12 first_row login-row">
            <!-- <div class="info d-flex align-items-center">
            <div class="content title-content">
                <div class="logo">
                <image class="logo-white anim1" src="<?php echo base_url('assets/vendors/login_asset/img/DOSE_FINAL DESIGN.png');?>">
                </div>
            </div>
            </div> -->
            <span class="enrollment">Enrollment</span>
            <span class="made_easy">MADE EASY!</span>
            <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-6 col-sm-12 second_row login-row">
            <div class="form d-flex bg-white" style="background:transparent">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/sendEmail');?>" tabindex="1">
                <image class="dose-logo" src="<?php echo base_url('assets/vendors/login_asset/css/img/DOSE LOGO.png');?>">
                <span class="white-box"></span>
                <div class="col-md-12" style="margin-bottom:40px">
                    <h1 class="anim2">Forgot Password</h1>
                </div>
                <!-- <div class="form-group">
                    <input required autocomplete="off" id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                    <label for="login-username" class="label-material">User Name</label>
                </div> -->
                <div class="form-group">
                    <input required autocomplete="off" id="login-email" type="text" name="email" required data-msg="Please enter your email" class="input-material anim3">
                    <label for="login-email" class="label-material" style="color:black;font-weight:bold;">Email</label>
                </div>
                <div align="right">
                <a href="javascript:void(0)" onclick="back()" type="button" class="btn btn-default btn-sm leave_button" style="font-weight:bold;"><i class="bi bi-arrow-left-circle"></i> Back</a>&nbsp;<button id="submit" type="submit" class="btn btn-danger btn-sm submit-button">Submit</button>
                </div>
                <!-- <div style="bottom:2;position:absolute;">
                    
                </div> -->
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<script>
$('form').on('submit',function(){
    var count = 0;
    $('.input-material').each(function(){
        if($(this).val()==""){
            ++count;
        }
    })
    if(count==0){
        $('#submit').attr('disabled','disabled');
    }
});
function submitForm(){
    $.ajax({
        url: "<?php echo base_url('main/sendEmail')?>",
        method: 'get',
        data:{
            'email':$('#login-email').val()
        },
        dataType:'json',
        success: function(response) {
            if(response.type=='error'){
                iziToast.warning({
                    title: 'Error: ',
                    message: response.msg,
                    position: 'topCenter',
                });
            }
            else{
                iziToast.show({
                    icon: 'bi bi-check2-square',
                    title: 'Success',
                    message: response.msg,
                    position: 'topCenter',
                    progressBarColor: '#cc0000',
                    onClosing: function(instance, toast, closedBy){
                    },
                    onClosed: function(instance, toast, closedBY){
                        alert('closed');
                    }
                })
            }
        },
        error: function(response) {

        }
    });
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
    autoplay:false,
        begin: function(anim) {
            // goToLink();
            setTimeout(() => {
                goToLink()
            }, 2000);
        }
    });
    // playPause.play();
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    
    if( /Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        setTimeout(() => {
            goToLink()
        }, 2000);
    }
    else{
        var t1 = gsap.timeline();
        t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
        $('.transition-effect').css('z-index','1001');
        $('#amazing').css('z-index','1002');
        playPause.play();
        console.log('mobile')
    }
}
function goToLink(){
    window.location.replace("<?php echo base_url('/')?>");
}
function back(){
    // goToLink();
    closeAnimation();
}
</script>