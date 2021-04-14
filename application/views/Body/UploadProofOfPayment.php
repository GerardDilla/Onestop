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
        /* object-fit:cover; */
    }
    .image-uploader.has-files .uploaded-image  > .image-uploader.has-files .uploaded-image img{
        top: 50%;
        left: 50%;
        min-height: 100%;
        min-width: 100%;
        transform: translate(-50%, -50%);
        /* min-height: 100%;
        min-width: 100%; */
    }
</style>
<section class="section col-sm-12">
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
</section>
<script>
$('.input-images-1').imageUploader({
    maxFiles: 1
});
$('input[type=file]').attr('multiple',false);
$('input[type=file]').on('change',function(){
    alert('change')
    var imgInterval = window.setInterval(() => {
        var img = document.querySelector(".uploaded-image img"); 
        // console.log(img.height)
        // console.log(img.width)
        $('.image-uploader.has-files .uploaded-image').css('height',img.height)
        $('.image-uploader.has-files .uploaded-image').css('width',img.width)
        clearInterval(imgInterval)
    }, 100);
});
$(window).resize(function(){
    // alert('resize');
    var img = document.querySelector(".uploaded-image img"); 
    $('.image-uploader.has-files .uploaded-image').css('height',img.height)
    $('.image-uploader.has-files .uploaded-image').css('width',img.width)
})
</script>