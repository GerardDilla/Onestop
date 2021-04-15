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
<link rel="stylesheet" href="<?php echo base_url('');?>assets/css/image-uploader.min.css">
<script type="text/javascript" src="<?php echo base_url('');?>assets/js/image-uploader.min.js"></script>
<style>
    .image-uploader.has-files .uploaded-image{
        width:80%;
        /* background:blue; */
        margin-right:10px;
        max-height:50vh;
        /* height:auto; */
    }
    .image-uploader.has-files .uploaded-image img{
        display:block;
        height:auto;
        width:50vw;
        max-height:50vh;
    }
    #uploaded_image{
        height:auto;
        width:50vw;
        max-height:50vh;
        margin-left:10vw;
        border:1px solid #ccc;
        border-radius:10px;
    }
    #uploaded_div{
        /* border:1px solid #ccc;
        border-radius:10px; */
        /* padding:auto; */
    }
</style>
<section class="section col-sm-12">
<?php if(empty($date_submitted)){?>
<form action="<?php echo base_url('main/uploadProofOfPaymentProcess');?>" method="post" enctype="multipart/form-data">
    <div class="card" style="margin:none;">
        <div class="card-header" align="right">
            <button class="btn btn-info">Submit</button>
        </div>
        <div class="card-body">
            <div class="input-field">
                <!-- <label class="active">Photos</label> -->
                <div class="input-images-1" style="padding-top: .5rem;"></div>
            </div>
            
        </div>
    </div>
</form>
<?php }
else{
?>
<div class="card" style="margin:none;">
    <div class="card-header">
        <!-- <button class="btn btn-info">Submit</button> -->
    </div>
    <div class="card-body">
        <table class="table table-light mb-0">
            <thead>
                <tr>
                    <th>Requirements</th>
                    <th style="text-align:center;" width="15%">View</th>
                    <th style="text-align:center;" width="20%">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Proof of Payment</td>
                    <td  style="text-align:center;"><button class="btn btn-sm btn-info" onclick="viewImage()">View</button></td>
                    <td  style="text-align:center;"><?php echo date("F j, Y, g:i a",strtotime($date_submitted)); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>
</section>
<script>
var image_upload = "";
$('.input-images-1').imageUploader({
    maxFiles: 1
});
$('input[type=file]').attr('multiple',false);
$('input[type=file]').on('change',function(){
    image_upload = this.value;
    var imgInterval = window.setInterval(() => {
        var img = document.querySelector(".uploaded-image img"); 
        // console.log(img.height)
        // console.log(img.width)
        $('.image-uploader.has-files .uploaded-image').css('height',img.height)
        $('.image-uploader.has-files .uploaded-image').css('width',img.width)
        clearInterval(imgInterval)
    }, 100);
    // console.log(image_upload)
});
$('.input-images-1').on('mouseover',function(){
    if($('input[type=file]').val()!=image_upload){
        image_upload = $('input[type=file]').val();
        var imgInterval2 = window.setInterval(() => {
            var img = document.querySelector(".uploaded-image img"); 
            // console.log(img.height)
            // console.log(img.width)
            $('.image-uploader.has-files .uploaded-image').css('height',img.height)
            $('.image-uploader.has-files .uploaded-image').css('width',img.width)
            clearInterval(imgInterval2)
        }, 100);
    }
});
function viewImage(){
    $.ajax({
        url: "<?php echo base_url();?>main/getProofOfPaymentImage",
        method: 'get',
        dataType:'json',
        success: function(response) {
            console.log(response)
            // console.log(response);
            // $('input[name=first]').val(response.us_first);
            // $('input[name=last]').val(response.us_last);
            // $('input[name=nickname]').val(response.us_nickname);
        },
        error: function(response) {
            // console.log(response)
        }
    });
}
$(window).resize(function(){
    // alert('resize');
    var img = document.querySelector(".uploaded-image img"); 
    $('.image-uploader.has-files .uploaded-image').css('height',img.height)
    $('.image-uploader.has-files .uploaded-image').css('width',img.width)
})
</script>