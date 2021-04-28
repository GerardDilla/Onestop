<div class="page login-page">
    <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
        <div class="row bg-white">
        <div class="col-lg-6 col-md-12 first_row login-row">
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
        <div class="col-lg-6 col-md-12 second_row login-row">
            <div class="form d-flex bg-white">
            <div class="content">
                <form method="post" class="form-validate" action="<?php echo base_url('main/changePasswordProcess');?>" id="form_submit">
                <image class="dose-logo" src="<?php echo base_url('assets/vendors/login_asset/css/img/DOSE LOGO.png');?>">
                <span class="white-box"></span>
                <input type="hidden" name="JoduXy33bU2EUwRsdjR0uhodvplaX54c5mVbGBNBYRU=" value="<?php echo $key;?>">
                <div class="col-md-12" style="margin-bottom:40px">
                    <h1>Password Reset</h1>
                </div>
                <div class="form-group anim3">
                    <input required="required" id="login-new" type="password" name="new_password"  data-msg="Please enter your new password" class="pr-password input-material">
                    <label for="login-new" class="label-material" style="color:black;font-weight:bold;">New Password</label>
                    <span class="show-password">
                        <i id="show_new_password" class="bi bi-eye-fill" onclick="showPassword('new_password')" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="form-group anim3">
                    <input id="login-confirm" type="password" name="confirm_password" required="required" data-msg="Incorrect confirm password" class="input-material">
                    <label for="login-confirm" class="label-material" style="color:black;font-weight:bold;">Confirm Password</label>
                    <span class="show-password">
                        <i id="show_confirm_password" class="bi bi-eye-fill" onclick="showPassword('confirm_password')" aria-hidden="true"></i>
                    </span>
                </div>
                <div align="right">
                    <!-- <button id="submit" type="submit" class="btn btn-info">Submit</button> -->
                    <input type="submit" class="btn btn-info" value="Submit">
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
</script>
<script>

$('form').on('submit',function(e){
    e.preventDefault();
    var upperCase= new RegExp('[A-Z]');
    var count = 0;
    var strength = 25;
    var str = $('input[name=new_password]').val().split('');
    
    $('.input-material').each(function(){
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
        $('input[type=submit]').attr('disabled','disabled');
        $('#form_submit')[0].submit();
    }
});
</script>