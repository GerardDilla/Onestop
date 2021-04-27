<section class="section col-sm-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="col-md-12" align="center">
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text password-validate" for="inputGroupSelect01">Old Password</label>
                        <input class="form-control" placeholder="type here...." type="password" name="old_password" id="old_password">
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_old_password" onchange="showPassword('old_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                    
                </div>
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">New Password</label>
                        <input class="form-control" placeholder="type here...." type="password" name="new_password" id="new_password">
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_new_password" onchange="showPassword('new_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Conf. Password</label>
                        <input class="form-control" placeholder="type here...." type="password" name="confirm_password" id="confirm_password">
                    </div>
                    <div class="col-md-12" align="right">
                        Show Password <input name="show_confirm_password" onchange="showPassword('confirm_password')" align="right" class="form-check-input" type="checkbox">
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="btn btn-sm btn-info">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
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