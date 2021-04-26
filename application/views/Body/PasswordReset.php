<?php
echo '<script>';
if(!empty($this->session->flashdata('error'))){
    echo "iziToast.error({
                title: 'Error: ',
                message: '".$this->session->flashdata('error')."',
                position: 'topRight',
            });";
    $this->session->set_flashdata('error','');
}
else if(!empty($this->session->flashdata('success'))){
    echo "iziToast.success({
            title: 'Success: ',
            message: '".$this->session->flashdata('success')."',
            position: 'topRight',
        });";
    $this->session->set_flashdata('success','');
}
echo '</script>';
?>
<section class="section col-sm-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
        <form id="form_submit" action="<?php echo base_url('main/passwordResetProcess');?>" method="post">
            <div class="col-md-12" align="center">
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text password-validate" for="inputGroupSelect01">Old Password</label>
                        <input required class="form-control" placeholder="type here...." type="password" name="old_password" id="old_password">
                        <div class="invalid-feedback feedback-1">
                            <i class="bx bx-radio-circle"></i>
                            This is required.
                        </div>
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_old_password" onchange="showPassword('old_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">New Password</label>
                        <input required class="form-control pr-password" placeholder="type here...." type="password" name="new_password" id="new_password">
                        <div class="invalid-feedback feedback-2">
                            <i class="bx bx-radio-circle"></i>
                            This is required.
                        </div>
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_new_password" onchange="showPassword('new_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Conf. Password</label>
                        <input required class="form-control" placeholder="type here...." type="password" name="confirm_password" id="confirm_password">
                        <div class="invalid-feedback feedback-3"><i class="bx bx-radio-circle"></i>This is required.</div>
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_confirm_password" onchange="showPassword('confirm_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                </div>
                <div class="col-lg-12">
                    <button  type="button" class="btn btn-secondary btn-info">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>
<script>

$('.form-control').keypress(function(e){
    if(e.keyCode==13){
        $('button[type=button]').click();
    }
})
$('button[type=button]').on('click',function(e){
    // e.preventDefault();
    var upperCase= new RegExp('[A-Z]');
    var count = 0;
    var strength = 25;
    var str = $('input[name=new_password]').val().split('');
    $('.form-control[required]').removeClass('is-invalid');
    // $('.feedback-1').text('hello');
    $('.invalid-feedback').text('This field is required');
    $('.form-control[required]').each(function(){
        if($(this).val()==""){
            ++count;
            $(this).addClass('is-invalid');
        }
    })
    if($('input[name=new_password]').val()!=$('input[name=confirm_password]').val()){
        ++count;
        $('.feedback-3').text('Incorrect confirmation password.!!');
        $('#confirm_password').addClass('is-invalid');
        // iziToast.warning({
        //     title: 'Error: ',
        //     message: 'Incorrect confirmation password.!!',
        //     position: 'topCenter',
        // });
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
        // iziToast.warning({
        //     title: 'Error: ',
        //     message: 'Your password is too weak!!',
        //     position: 'topCenter',
        // });
        $('.feedback-2').text('Your password is too weak!!');
        $('#new_password').addClass('is-invalid');
    }
    else if(count==0&&strength==100){
        $('button[type=button]').attr('disabled','disabled');
        $('#form_submit').submit();
    }
    
});
    $(".pr-password").passwordRequirements({
            useLowercase:false,
            useSpecial : false
        });
    if( /Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $('.input-group').addClass('form-group');
        $('.form-group').removeClass('input-group');
    }
    function showPassword(id){
        if ($('input[name=show_'+id+']').is(':checked')) {
            $('input[name='+id+']').prop('type','text');
        }
        else{
            $('input[name='+id+']').prop('type','password');
        }
    }
</script>