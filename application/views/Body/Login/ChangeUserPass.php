<style>
/* @media screen (max-width:1049){
    #modal.my_modal{
        max-width:100%;
        width:50%;
    }
} */
.iziModal .iziModal-header.iziModal-noSubtitle .iziModal-header-title {
    font-size: 1.2em;
    margin: 3px 0 0;
    font-weight: bold;
}
#input_username:hover{
    cursor:pointer;
}
</style>
<?php
if($this->session->flashdata('error')!=''){
    echo "<script>
    iziToast.warning({
        title: 'Error: ',
        message: '".$this->session->flashdata('error')."',
        position: 'topCenter',
    });
    </script>";
    $this->session->set_flashdata('error','');
}
?>
<div class="page login-page">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row bg-white">
        <div class="col-lg-6 col-md-6 col-sm-6 first_row login-row">
            <!-- <div class="info d-flex align-items-center">
            <div class="content title-content">
                <div class="logo">
                <image class="logo-white anim1" src="<?php echo base_url('assets/vendors/login_asset/img/DOSE_FINAL DESIGN.png');?>">
                </div>
            </div>
            </div> -->
            
            <span class="enrollment">Enrollment</span>
            <span class="made_easy">MADE EASY!</span>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 col-md-6 col-sm-6 second_row login-row">
            <div class="form d-flex bg-white">
            <div class="content">
                <form method="post" id="form_process" class="form-validate" action="<?php echo base_url('main/changeUserPassProcess');?>">
                    <image class="dose-logo" src="<?php echo base_url('assets/images/logo/DOSE_LOGO.png');?>">
                    <span class="white-box"></span>
                    <br>
                    <input type="hidden" name="JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=" value="<?php echo $key;?>">
                    
                    <!-- <div class="col-md-12" style="margin-bottom:40px">
                    <h1>Forgot Password</h1>
                </div> -->
                <div class="form-group anim3" id="input_username">
                    <input required autocomplete="off" type="text" name="username" data-msg="Please enter your new username" class="input-material">
                    <label for="login-new" class="label-material" style="color:black;font-weight:bold;">Input your Username</label>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" type="password" name="new_password" data-msg="Please enter your new password" class="pr-password input-material">
                    <label for="login-new" class="label-material" style="color:black;font-weight:bold;">Input your Password</label>
                    <span class="show-password">
                        <i id="show_new_password" class="bi bi-eye-fill" onclick="showPassword('new_password')" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="form-group anim3">
                    <input required autocomplete="off" id="login-confirm" type="password" name="confirm_password" data-msg="Incorrect confirm password" class="input-material">
                    <label for="login-confirm" class="label-material" style="color:black;font-weight:bold;">Confirm Password</label>
                    <span class="show-password">
                        <i id="show_confirm_password" class="bi bi-eye-fill" onclick="showPassword('confirm_password')" aria-hidden="true"></i>
                    </span>
                </div>
                <div align="right">
                    <button id="btnSubmit" type="submit" class="btn btn-danger btn-sm submit-button">Submit</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<div id="modal" data-izimodal-group="" data-izimodal-loop="" style="display:none;" data-izimodal-title="Input your code">  
    <div class="col-md-12 content" style="padding:20px 10% 20px 10%;margin:auto;">
        <form id="form-code" class="form-inline col-md-12">
            <div class="form-group-material col-md-12">
                    <input required autocomplete="off" id="login-code" type="text" name="code" required data-msg="Incorrect code" class="input-material">
                    <label for="login-code" class="label-material" style="color:black;font-weight:bold;">Code</label>
            </div>
        </form>
    </div>
</div>
<script>
    var width = '35%';
    $('#modal').iziModal({
        headerColor: '#45abee',
        width: '',
        top:1,
        overlayColor: 'rgba(0, 0, 0, 0.5)',
        fullscreen: true,
        transitionIn: 'fadeInUp',
        transitionOut: 'fadeOutDown',
        appendToOverlay: 'body',
        focusInput: true,
        overlayClose:false,
        closeButton: false,
        fullscreen:false,
        // height: '80',
    });
    // $('#form-process .input-material').attr('disabled','disabled');
    // $('#form-process button[type=submit]').attr('disabled','disabled');
    // $("#modal").addClass('my_modal');
    // $("#modal .label-material").addClass('active');
    // $('#modal').iziModal('open');
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

$('#form_process').on('submit',function(e){
    e.preventDefault();
    var upperCase= new RegExp('[A-Z]');
    var count = 0;
    var strength = 25;
    var str = $('input[name=new_password]').val().split('');
    
    $('#form-process .input-material').each(function(){
        if($(this).val()==""){
            ++count;
        }
    })
    if($('input[name=new_password]').val()!=$('input[name=confirm_password]').val()){
        ++count;
        iziToast.warning({
            title: 'Error: ',
            message: 'Incorrect confirmation password.!!',
            position: 'topCenter',
        });
    }
    if($.isNumeric($('input[name=new_password]').val().replace(/[^\d.-]/g, ''))){
        strength += 25;
    }
    if(str.length>=8){
        strength += 25;
    }
    if(upperCase.test($('input[name=new_password]').val())){
        strength += 25;
    }

    if(strength!=100){
        iziToast.warning({
            title: 'Error: ',
            message: 'Your password is too weak!!',
            position: 'topCenter',
        });
    }
    else if(count==0&&strength==100){
        $('button[type=submit]').attr('disabled','disabled');
        document.getElementById("form_process").submit();
    }
    console.log(strength);
    console.log(count);
    
});
openEffect();
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
function back(){
    closeEffect();
}
</script>