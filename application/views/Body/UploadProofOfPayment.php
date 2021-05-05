
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
        max-height:70vh;
    }
    #uploaded_image{
        /* text-align:center; */
        height:auto;
        width:50vw;
        max-height:60vh;
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
    .button{
        background:#C82525;
        color:white;
        margin-bottom:10px;
    }
    .button:hover{
        color:white;
        background:rgba(200,37,37,.7);
    }
    img.payment-logo{
        width:120px;
        height:auto;
    }
    strong.branch{
        color:black;
    }
    .input-label{
        text-indent:10px;
    }
    /* .button-1{
        
    }
    .button-2{
        
    }
    .button-3{

    } */
    /* thead,tbody{
        text-align:center;
    } */
    .payment-header{
        background:#B83232;
        color:white;
        /* margin-left:7px; */
        padding:10px;
        text-align:center;
        font-weight:bold;
    }
    .payment-body{
        text-align:center;
        margin:10px 0px 10px 0px;
    }
    /* .payment-header div{
        padding:10px;
        text-align:center;
        font-weight:bold;
    } */
    .aub{
        padding-top:10px;
    }
    .rcbc{
        /* padding-top:20%; */
        padding-top:10px;
    }
    .bdo{
        padding-top:10px;
    }
    .ub{
        padding-top:10px;
    }
    .eastwest{
        padding-top:10px;
    }
    /* @media (max-width:895px){
        .aub,.rcbc,.bdo,.ub,.eastwest{1
            padding-top:10px;
        }
    } */
    .number-format::placeholder{
        text-align:right;
    }
    .number-format{
        text-align:right;
    }
    .slant{
        /* border-right: 40px solid black;
        border-bottom:40px solid black */
    }
    .slant:before{
        position:absolute;
        content: '';
        width:40px;
        height:55px;
        bottom:-3px;
        left:-6px;
        background-color:white;
        transform:rotate(20deg);
        z-index:1;
    }
    .slant:after{
        position:absolute;
        content: '';
        width:40px;
        height:55px;
        bottom:-8px;
        right:-7px;
        background-color:white;
        transform:rotate(20deg);
        z-index:1;
    }
    .btn-semi-round{
        border-radius:10px;
    }
    .bills-payment-1{
        /* border:solid black 1px; */
        padding-left:90px;
    }
    .bills-payment-2{
        display:none;
    }
    #upload-proof-button{
        font-weight:bold;
    }
    .savings-account{
        margin-left:50px;
    }
    .bank-logo{
        text-align:right;
    }
    .bank-title{
        text-align:left;
    }
    .bank-logo{
         /* position:relative; */
    }
    .bank-logo:first-child{
        padding-top:10px;
    }
    /* .bank-logo img{
        position:absolute;
        top:50%;
        right:0;
    } */
    @media (max-width:768px){
        .slant{
            font-size:80%;
        }
        .bank-logo{
            text-align:center;
        }
    }
    
    @media (max-width:767px){
        .bills-payment-1{
            display:none;
        }
        .bills-payment-2{
            display:block;
        }
    }
    @media (max-width:600px){
        .slant:after{
            background-color:transparent;
        }
        .slant:before{
            background-color:transparent;
        }
        .savings-account{
            margin-left:0px;
        }
        .bank-logo{
            text-align:center;
        }
        .bank-title{
            text-align:center;
        }
    }
    .btn-group-lg>.btn, .btn-lg {
    }
</style>
<section class="section col-sm-12">
<?php if(empty($date_submitted)){?>
<form id="proof_of_payment_form" action="<?php echo base_url('main/uploadProofOfPaymentProcess');?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="payment_type" value="">
    <div class="card" style="margin:none;">
        <div class="card-header">
            <div class="col-md-12 row">
                <div class="col-lg-4 ">
                    <div class="form-group payment-type-div">
                        <label class="input-label payment-page" style="display:none;"><b>Payment Type</b></label>
                        <select class="form-select payment-page" name="payment-type" style="display:none;">
                            <option value="online_payment">Online Payment</option>
                            <option value="over_the_counter">Over the Counter</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8" align="right"><button style="display:none;" type="button" onclick="choosePayment('cancel')" class="payment-page btn btn-sm btn-secondary" >Cancel</button>&nbsp;<button style="display:none;" type="button" class="payment-page btn btn-sm btn-danger" id="submit-button">Submit</button></div>
            </div>
            <div class="col-md-12">
                <button type="button" id="upload-proof-button" onclick="choosePayment('online_payment')" class="btn btn-lg btn-success">Upload Proof of Payment</button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12 row payment-type">
                <div class="col-md-12" align="center" style="margin-bottom:10px;">
                    <h4>Type of Payment</h4>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 row" style="margin:0;padding:0;">
                    <div class="col-md-6 payment-header" >OVER THE COUNTER</div>
                    <div class="col-md-6 payment-header bills-payment-1" align="center">BILLS PAYMENT FACILITIES</div>
                    <div class="col-md-12 payment-header slant" style="margin-top:20px;position:relative;"><font style="font-weight:400;">ACCOUNT NAME:</font> ST DOMINIC COLLEGE OF ASIA, INC.</div>
                    <div class="col-md-12 row" style="margin:0;padding:0;">
                        <div class="col-md-8 row">
                            <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/aub-2.jpg');?>"></div>
                            <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title"><p class="aub"><strong>Account Number : 120-01-890142-6<br><span class="savings-account">Savings</span></strong></p></div>

                            <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/rcbc1.png');?>"></div>
                            <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title"><p class="rcbc"><strong>Account Number : 0013-4500-0867<br><span class="savings-account">Savings</span></strong></p></div>

                            <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/bdo.png');?>"></div>
                            <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title"><p class="bdo"><strong>Account Number : 0000-7016-1291<br><span class="savings-account">Savings</span></strong></p></div>

                            <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/eastwest-bank-logo-2.jpg');?>" style="height:50px;"></div>
                            <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title"><p class="eastwest"><strong>Account Number : 2000-0065-6417<br><span class="savings-account">Savings / Check Account</span></strong></p></div>

                            <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/ub-2.jpg');?>" style="height:50px;"></div>
                            <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title"><p class="ub"><strong>Account Number : 0004-70001-2500<br><span class="savings-account">Savings</span></strong></p></div>
                        </div>
                        <div class="col-md-4 row" style="margin:0;padding:0;">
                            <div class="col-md-12 payment-header bills-payment-2" align="center">BILLS PAYMENT FACILITIES</div>
                            <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/sm-department-store-logo-2.jpg');?>"></div>
                            <div class="col-md-12 payment-body" ><p><strong>SM Bacoor</strong></p></div>

                            <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/hypermarket-2.jfif');?>"></div>
                            <div class="col-md-12 payment-body" ><p><strong>Imus & Molino</strong></p></div>

                            <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/savemore.png');?>"></div>
                            <div class="col-md-12 payment-body" ><p><strong>Zapote</strong></p></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-lg-4 col-sm-12" style="margin:0;padding:0;">
                    <div class="col-md-12 payment-header">BILLS PAYMENT FACILITIES</div>
                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/sm-department-store-logo.jpg');?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>SM Bacoor</strong></p></div>

                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/hypermarket.jfif');?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>Imus & Molino</strong></p></div>

                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/savemore.png');?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>Zapote</strong></p></div>
                </div> -->
                <div class="col-md-3 col-lg-3 col-sm-12" style="margin:0;padding:0;">
                    <div class="col-md-12 payment-header">SDCA ONLINE PAYMENT</div>
                    <div class="col-md-12 payment-body" style="margin-top:30px;"><a href="https://stdominiccollege.edu.ph/SDCAPayment/" class="btn btn-success btn-lg btn-semi-round" target="_blank">Pay Here</a></div>
                </div>
            </div>
            <div class="col-md-12 row payment-page" style="display:none">
                <div class="col-md-2 form-group online-payment">
                    <label class="input-label"><b>Bank Type</b></label>
                    <select class="form-select" name="bank_type">
                        <option value="">Choose</option>
                        <option value="aub">AUB</option>
                        <option value="rcbc">RCBC</option>
                        <option value="bdo">BDO</option>
                        <option value="eastwest">Eastwest</option>
                        <option value="union bank">Union Bank</option>
                    </select>
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-3 online-payment">
                    <label class="input-label"><b>Account Number</b></label>
                    <input type="text" class="form-control" name="account_number" placeholder="...." style="">
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-4 online-payment">
                    <label class="input-label"><b>Account Holder Name</b></label>
                    <input type="text" class="form-control" name="holder_name" placeholder="...." style="">
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-6 other-payment">
                    <label class="input-label"><b>Reference Number/Receipt No.</b></label>
                    <input type="text" class="form-control" name="reference_number" placeholder="....">
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="input-label"><b>Amount Paid</b></label>
                    <input type="text" class="form-control number-format" name="amount_paid" placeholder="₱ 0.00">
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="input-label"><b>Student Number</b></label>
                    <input type="text" class="form-control" value="<?php echo $student_number==0?'':$student_number;?>" placeholder="You still have no Student Number" readonly>
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="input-label"><b>Student Name</b></label>
                    <input type="text" class="form-control" placeholder="Name" value="<?php echo strtoupper($this->session->userdata('first_name').' '.$this->session->userdata('middle_name').' '.$this->session->userdata('last_name'));?>" readonly>
                    <div class="invalid-feedback">
                        This is required.
                    </div>
                </div>
                <div class="input-field col-md-12" >
                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                </div>
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
                    <th>Payment Type</th>
                    <th style="text-align:center;" width="15%">View</th>
                    <th style="text-align:center;" width="20%">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $payment_type;?></td>
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

// var datacatcher = storage.getData();
// OnloadImage();
// setTimeout(()=>{
//     console.log('Link:'+storagedata.getData());
// },7000)
// var image_url = "";
$(".number-format").click(function () {
   $(this).select();
});
$('select[name=payment-type]').on('change',function(){
    // console.log()
    choosePayment(this.value)
});
$('#submit-button').on('click',function(e){
    e.preventDefault();
    var count = 0;
    $('input.form-control[required]').each(function(){
        $(this).removeClass('is-invalid')
        if(this.value==""){
            ++count;
            $(this).addClass('is-invalid')
            setTimeout(() => {
                $(this).removeClass('is-invalid') 
            }, 3000);
        }
    })
    $('select.form-select[required]').each(function(){
        $(this).removeClass('is-invalid')
        if(this.value==""){
            ++count;
            $(this).addClass('is-invalid')
            setTimeout(() => {
                $(this).removeClass('is-invalid') 
            }, 3000);
        }
    })
    if($('input[name=images]').val()==""){
        ++count;
    }

    if(count==0){
        $('#submit-button').attr('disabled','disabled');
        $('#proof_of_payment_form')[0].submit();
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

function choosePayment(payment){
    $('#upload-proof-button').hide();
    $('.payment-type-div').show();
    if(payment=="online_payment"){
        $('input[name=payment_type]').val('Online Payment');
        $('.payment-page').show();
        $('.payment-type').hide();
        $('.online-payment').show();
        $('.other-payment').hide();
        $('.online-payment input.form-control').attr('required',true)
        $('.online-payment select').attr('required',true)
        $('.other-payment input.form-control').attr('required',false)
    }
    else if(payment=="over_the_counter"){
        // $("#payment-title").text('Over the Counter');
        $('input[name=payment_type]').val('Over the Counter');
        $('.payment-page').show();
        $('.payment-type').hide();
        $('.other-payment').show();
        $('.online-payment').hide();
        $('.online-payment input.form-control').attr('required',false)
        $('.online-payment select').attr('required',false)
        $('.other-payment input.form-control').attr('required',true)
    }
    else if(payment=="sdca_online_payment"){
        // $("#payment-title").text('SDCA Online Payment');
        $('input[name=payment_type]').val('SDCA Online Payment');
        $('.payment-page').show();
        $('.payment-type').hide();
        $('.other-payment').show();
        $('.online-payment').hide();
        $('.online-payment input.form-control').attr('required',false)
        $('.online-payment select').attr('required',false)
        $('.other-payment input.form-control').attr('required',true)
    }
    else{
        $('.payment-type').show();
        $('.payment-page').hide();
        $('#upload-proof-button').show();
    }
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