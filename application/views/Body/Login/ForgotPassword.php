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
            // alert('closed');
            back();
        }
    });</script>";
    $this->session->set_flashdata('success','');
}
?>

    </script>
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
                <!-- <h1 class="main-title anim1">
                    One Stop Enrollment
                </h1> -->
            </div>
            </div>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-12 second_row login-row">
            <div class="form d-flex" style="background:transparent">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/sendEmail');?>">
                <div class="col-md-12" style="margin-bottom:40px">
                    <h1 class="anim2">Forgot Password</h1>
                </div>
                <!-- <div class="form-group">
                    <input required autocomplete="off" id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material">
                    <label for="login-username" class="label-material">User Name</label>
                </div> -->
                <div class="form-group">
                    <input required autocomplete="off" id="login-email" type="text" name="email" required data-msg="Please enter your password" class="input-material anim3">
                    <label for="login-email" class="label-material" style="color:black;font-weight:bold;">Email</label>
                </div>
                <div align="right">
                    <button id="login" type="button" type="submit" class="btn btn-info submit-button">Submit</button>
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
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50,delay:.5,onComplete:function(){goToLink()}});
}
</script>