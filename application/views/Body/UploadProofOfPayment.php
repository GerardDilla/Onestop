
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
        /* text-align:center; */
        height:auto;
        width:50vw;
        max-height:50vh;
        /* margin-left:10vw; */
        border:1px solid #ccc;
        border-radius:10px;
    }
    #uploaded_div{
        /* border:1px solid #ccc;
        border-radius:10px; */
        /* padding:auto; */
    }
    .iziModal-header-title{color:black;}
    /* #view_image.iziModal{
        width:100%;
        max-width:100%;
    } */
</style>
<section class="section col-sm-12">
<?php if(empty($date_submitted)){?>
<form id="proof_of_payment_form" action="<?php echo base_url('main/uploadProofOfPaymentProcess');?>" method="post" enctype="multipart/form-data">
    <div class="card" style="margin:none;">
        <div class="card-header" align="right">
            <button type="submit" class="btn btn-info">Submit</button>
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
<div id="view_image" data-izimodal-group="" data-izimodal-loop="" style="display:none;" data-izimodal-title="">
    <div class="col-md-12" style="margin:10px;" align="center">
        <img src="<?php echo empty($gdrive_link)?'':'https://drive.google.com/uc?export=view&id='.$gdrive_link;?>" id="uploaded_image">
    </div>
</div>
<script>
class StorageData{
    constructor(){
        this.data = [];
    }
    getData(){
        return this.data;
    }
    changeData(changedata){
        this.data = changedata;
    }
}
var image_upload = "";
var storagedata = new StorageData();
// OnloadImage();
// setTimeout(()=>{
//     console.log('Link:'+storagedata.getData());
// },7000)
// var image_url = "";
$('#proof_of_payment_form').on('submit',function(e){
    e.preventDefault();
    var count = 0;
    if($('input[name=images]').val()==""){
        ++count;
    }

    if(count==0){
        $('#proof_of_payment_form button[type=submit]').attr('disabled','disabled');
        $(this)[0].submit();
    }
    else{
        iziToast.error({
            title: 'Error: ',
            message: 'You need to choose a file!!',
            position: 'topRight',
        });
    }
});
$('#view_image').iziModal({
    theme:'light',
    headerColor: '#f2f7ff',
    width: '60vw',
    overlayColor: 'rgba(0, 0, 0, 0.5)',
    top:1,
    fullscreen: true,
    color:'black',
    transitionIn: 'fadeInUp',
    transitionOut: 'fadeOutDown',
    // height: '80',
});
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
async function getImageLink(id){
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: "<?php echo base_url();?>main/getProofOfPaymentImage",
            method: 'get',
            dataType:'json',
            success: function(response) {
                resolve(`https://drive.google.com/uc?export=view&id=${response}`);
                // storagedata
            },
            error: function(response) {
                reject(response);
            }
        });
    })
}


function OnloadImage(){
    $('body').waitMe({
        effect : 'bounce',
        text : '',
        bg : 'rgba(255,255,255,0.7)',
        color : '#000',
        maxSize : '',
        waitTime : -1,
        textPos : 'vertical',
        fontSize : '',
        source : '',
        onClose : function() {}
    });
    setTimeout(() => {
        getImageLink().then(link=>{ $('#uploaded_image').attr('src',link);$('body').waitMe('hide');storagedata.changeData(link);}).catch(error=>console.log(error));
    }, 3000);
    
}
function viewImage(){
    $('#view_image').iziModal('open');
    $('#view_image').iziModal('setTitle',"<b>Proof of Payment:</b>");
}
var img = document.querySelector(".uploaded-image img"); 
    // $('.image-uploader.has-files .uploaded-image').css('height',img.height)
    // $('.image-uploader.has-files .uploaded-image').css('width',img.width)
// console.log(img);
$(window).resize(function(){
    var img = document.querySelector(".uploaded-image img"); 
    $('.image-uploader.has-files .uploaded-image').css('height',img.height)
    $('.image-uploader.has-files .uploaded-image').css('width',img.width)
    // console.log(img.height);
})
$('#upload_form').on('submit',function(e){
    e.preventDefault();
    var count = 0;
    if($('input[name=images]').val()==""){
        ++count;
        iziToast.error({
            title: 'Error: ',
            message: 'Please choose a File!!',
            position: 'topRight',
        });
    }
    if(count==0){
        $('#upload_form button[type=submit]').attr('disabled',true);
        $(this)[0].submit();
    }
})
</script>
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
    echo "OnloadImage();";
    $this->session->set_flashdata('success','');
}
echo '</script>';
?>