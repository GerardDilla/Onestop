<style>
    .payment-type {
        display: none;
    }
    .form-label{
        text-align:left;
        text-indent:5px;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/numeral.min.js');?>"></script>
<section class="section col-sm-12">
        <form id="proof_of_payment_form" action="<?php echo base_url('index.php/Main/uploadProofOfPaymentProcess'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="payment_type" value="Bank Deposit">
            <input type="hidden" name="b3df6e650330df4c0e032e16141f" value="<?= $csrf_token ?>">
            <input type="hidden" name="payment_term" value="DP">
            <div class="card" style="margin:none;<?= empty($proof_of_payment)?'':'display:none;';?>" id="proofOfPaymentDiv">
                <div class="card-header">
                    <div class="col-md-12 row">
                        <div class="col-md-12" align="right">
                            <?php if(!empty($proof_of_payment)):?>
                            <button type="button" class="btn btn-secondary" id="goBackToList"><i class="bi bi-backspace-reverse"></i> Go Back</button>
                            <?php endif;?>
                            &nbsp;<button type="button" class="payment-page btn btn-danger" id="submit-button">Submit</button>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group payment-type-div">
                                <label class="input-label payment-page"><b>Payment Type</b></label>
                                <select class="form-select payment-page" name="payment-type">
                                    <!-- <option value="online_payment">Online Payment</option>x
                                    <option value="over_the_counter">Over the Counter</option> -->
                                    <option value="online_payment">Bank Deposit</option>
                                    <option value="SDCA Online Payment">SDCA Online Payment</option>
                                    <option value="Online Fund Transfer">Online Fund Transfer</option>
                                    <option value="Scan QR">Scan QR</option>
                                    <option value="Partner Cash-in">Partner Cash-in</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group payment-type-div">
                                <label class="input-label payment-page"><b>School Year</b></label>
                                <select class="form-select payment-page" name="school_year" required>
                                    <!-- <option value="online_payment">Online Payment</option>x
                                    <option value="over_the_counter">Over the Counter</option> -->
                                    <option value="">Choose School Year</option>
                                    <option value="<?= date("Y",strtotime('-7 year')).'-'.date("Y",strtotime('-6 year'));?>"><?= date("Y",strtotime('-7 year')).'-'.date("Y",strtotime('-6 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-6 year')).'-'.date("Y",strtotime('-5 year'));?>"><?= date("Y",strtotime('-6 year')).'-'.date("Y",strtotime('-5 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-5 year')).'-'.date("Y",strtotime('-4 year'));?>"><?= date("Y",strtotime('-5 year')).'-'.date("Y",strtotime('-4 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-4 year')).'-'.date("Y",strtotime('-3 year'));?>"><?= date("Y",strtotime('-4 year')).'-'.date("Y",strtotime('-3 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-3 year')).'-'.date("Y",strtotime('-2 year'));?>"><?= date("Y",strtotime('-3 year')).'-'.date("Y",strtotime('-2 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-2 year')).'-'.date("Y",strtotime('-1 year'));?>"><?= date("Y",strtotime('-2 year')).'-'.date("Y",strtotime('-1 year'));?></option>
                                    <option value="<?= date("Y",strtotime('-1 year')).'-'.date("Y");?>"><?= date("Y",strtotime('-1 year')).'-'.date("Y");?></option>
                                    <option value="<?= date("Y").'-'.date("Y",strtotime('+1 year'));?>"><?= date("Y").'-'.date("Y",strtotime('+1 year'));?></option>
                                </select>
                                <div class="invalid-feedback">
                                    This is required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group payment-type-div">
                                <label class="input-label payment-page"><b>Semester</b></label>
                                <select class="form-select payment-page" name="semester" required>
                                    <!-- <option value="online_payment">Online Payment</option>x
                                    <option value="over_the_counter">Over the Counter</option> -->
                                    <option value="">Choose Semester</option>
                                    <option value="FIRST">FIRST</option>
                                    <option value="SECOND">SECOND</option>
                                    <option value="SUMMER">SUMMER</option>
                                </select>
                                <div class="invalid-feedback">
                                    This is required.
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 ">
                            <div class="form-group payment-type-div">
                                <label class="input-label payment-page"><b>Payment Term</b></label>
                                <select class="form-select payment-page" name="payment_term">
                                    <option value="DP">Downpayment</option>
                                    <option value="PT">Prelim Term</option>
                                    <option value="MT">Mid Term</option>
                                    <option value="FT">Final Term</option>
                                    <option value="FP">Fully Paid</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <button style="display:none;" type="button" onclick="choosePayment('cancel')" class="payment-page btn btn-sm btn-secondary" >Cancel</button> -->
                    </div>
                    <div class="col-md-12">
                        <button style="display:none;" type="button" id="upload-proof-button" onclick="choosePayment('online_payment')" class="btn btn-lg btn-warning">Upload Proof of Payment</button>
                    </div>
                </div>
                <!-- <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#onlinepaymentModal">Online Payment</a><a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#overthecounterModal">Over the Counter</a> -->
                <div class="card-body">
                    <div class="col-md-12 row payment-type">
                        <div class="col-md-12" align="center" style="margin-bottom:10px;">
                            <h4>Type of Payment</h4>
                        </div>
                        <div class="col-md-9 col-lg-9 col-sm-12 row" style="margin:0;padding:0;">
                            <div class="col-md-6 payment-header">OVER THE COUNTER</div>
                            <div class="col-md-6 payment-header bills-payment-1" align="center">BILLS PAYMENT FACILITIES</div>
                            <div class="col-md-12 payment-header slant" style="margin-top:20px;position:relative;">
                                <font style="font-weight:400;">ACCOUNT NAME:</font> ST DOMINIC COLLEGE OF ASIA, INC.
                            </div>
                            <div class="col-md-12 row" style="margin:0;padding:0;">
                                <div class="col-md-8 row">
                                    <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/aub-2.jpg'); ?>"></div>
                                    <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title">
                                        <p class="aub"><strong>Account Number : 120-01-890142-6<br><span class="savings-account">Savings</span></strong></p>
                                    </div>

                                    <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/rcbc1.png'); ?>"></div>
                                    <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title">
                                        <p class="rcbc"><strong>Account Number : 0013-4500-0867<br><span class="savings-account">Savings</span></strong></p>
                                    </div>

                                    <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/bdo.png'); ?>"></div>
                                    <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title">
                                        <p class="bdo"><strong>Account Number : 0000-7016-1291<br><span class="savings-account">Savings</span></strong></p>
                                    </div>

                                    <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/eastwest-bank-logo-2.jpg'); ?>" style="height:50px;"></div>
                                    <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title">
                                        <p class="eastwest"><strong>Account Number : 2000-0065-6417<br><span class="savings-account">Savings / Check Account</span></strong></p>
                                    </div>

                                    <div class="col-md-12 col-lg-4 col-sm-12 payment-body bank-logo"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/ub-2.jpg'); ?>" style="height:50px;"></div>
                                    <div class="col-md-12 col-lg-8 col-sm-12 payment-body bank-title">
                                        <p class="ub"><strong>Account Number : 0004-70001-2500<br><span class="savings-account">Savings</span></strong></p>
                                    </div>
                                </div>
                                <div class="col-md-4 row" style="margin:0;padding:0;">
                                    <div class="col-md-12 payment-header bills-payment-2" align="center">BILLS PAYMENT FACILITIES</div>
                                    <div class="col-md-12 payment-body"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/sm-department-store-logo-2.jpg'); ?>"></div>
                                    <div class="col-md-12 payment-body">
                                        <p><strong>SM Bacoor</strong></p>
                                    </div>

                                    <div class="col-md-12 payment-body"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/hypermarket-2.jfif'); ?>"></div>
                                    <div class="col-md-12 payment-body">
                                        <p><strong>Imus & Molino</strong></p>
                                    </div>

                                    <div class="col-md-12 payment-body"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/savemore.png'); ?>"></div>
                                    <div class="col-md-12 payment-body">
                                        <p><strong>Zapote</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12" style="margin:0;padding:0;">
                            <div class="col-md-12 payment-header">SDCA ONLINE PAYMENT</div>
                            <div class="col-md-12 payment-body" style="margin-top:30px;"><a href="https://stdominiccollege.edu.ph/SDCAPayment/" class="btn btn-success btn-lg btn-semi-round" target="_blank">Pay Here</a></div>
                        </div>
                    </div>
                    <div class="col-md-12 row payment-page ">
                        <div class="col-md-2 form-group bank-name-div">
                            <label class="input-label"><b class="bank-name-label">Bank Type</b></label>
                            <select required class="form-select" name="bank_type">
                                <option value="">Choose</option>
                                <option value="AUB">AUB</option>
                                <option value="RCBC">RCBC</option>
                                <option value="BDO">BDO</option>
                                <option value="Eastwest">Eastwest</option>
                                <option value="Union Bank">Union Bank</option>
                            </select>
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-3 online-payment">
                            <label class="input-label"><b>Account Number</b></label>
                            <input required type="text" class="form-control" name="account_number" placeholder="...." style="">
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-4 online-payment">
                            <label class="input-label"><b>Account Holder Name</b></label>
                            <input required type="text" class="form-control" name="holder_name" placeholder="...." style="">
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-6 other-payment" style="display:none;">
                            <label class="input-label"><b>Reference Number/Receipt No.</b></label>
                            <input type="text" class="form-control" name="reference_number" placeholder="....">
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="input-label"><b>Amount Paid</b></label>
                            <input required type="text" class="form-control number-format" name="amount_paid" placeholder="₱ 0.00">
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="input-label"><b>Student Number</b></label>
                            <input type="text" class="form-control" value="<?php echo $student_number == 0 ? '' : $student_number; ?>" placeholder="You still have no Student Number" readonly>
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="input-label"><b>Student Name</b></label>
                            <input type="text" class="form-control" placeholder="Name" value="<?php echo strtoupper($this->session->userdata('first_name') . ' ' . $this->session->userdata('middle_name') . ' ' . $this->session->userdata('last_name')); ?>" readonly>
                            <div class="invalid-feedback">
                                This is required.
                            </div>
                        </div>
                        <div class="input-field col-md-12">
                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php if (!empty($proof_of_payment)) : ?>
        <div class="card" style="margin:none;" id="proofOfPaymentList">
            <div class="card-header" align="right">
                <button type="button" class="btn btn-secondary" id="addProofOfPayment"><i class="bi bi-plus-circle-dotted"></i> Add Proof of Payment</button>
            </div>
            <div class="card-body">
                <table class="table data-table table-striped">
                    <thead>
                        <tr>
                            <th>Payment Type</th>
                            <th style="text-align:center;" width="15%">View</th>
                            <th style="text-align:center;" width="20%">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($proof_of_payment as $list)
                        {
                        ?>
                        <tr>
                            <td><?= $list['payment_type']; ?></td>
                            <td style="text-align:center;"><button class="btn btn-sm btn-info" onclick="viewImage('<?= $list['id'];?>')">View</button></td>
                            <td style="text-align:center;"><?php echo date("F j, Y, g:i a", strtotime($list['requirements_date'])); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</section>
<div id="view_image" data-izimodal-group="" data-izimodal-loop="" style="display:none;" data-izimodal-title="">
    <div class="col-md-12 row" style="padding:10px 10% 10px 10%;">
        <div class="form-group col-md-12">
            <label class="form-label">Payment Type</label>
            <input type="text" name="view_payment_type" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12 over_counter">
            <label class="form-label">Payment Reference Number</label>
            <input type="text" name="view_payment_reference" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label">Bank Type</label>
            <input type="text" name="view_bank_type" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12 online_payment">
            <label class="form-label">Card Number</label>
            <input type="text" name="view_card_number" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12 online_payment">
            <label class="form-label">Account Holder Name</label>
            <input type="text" name="view_acc_holder_name" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label">Amount Paid</label>
            <input type="text" name="view_amount_paid" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label">File Type of Image you submitted</label>
            <input type="text" name="view_file_type" class="form-control" value="" readonly>
        </div>
        <div class="form-group col-md-12">
            <label class="form-label">Date and Time Submitted</label>
            <input type="text" name="date_submitted" class="form-control" value="" readonly>
        </div>
    </div>
</div>

<!-- onlinepaymentModal -->
<?php if (empty($proof_of_payment)) : ?>
    <script>
        iziToast.show({
            theme: 'light',
            icon: 'bi-exclamation-diamond-fill',
            iconColor: '#cc0000',
            title: 'NOTICE:',
            message: 'If you are already paid, please upload your proof of payment!',
            messageSize: '18',
            // messageLineHeight: '30',
            position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '#cc0000',
            overlay: true,
            timeout: 8000,
            buttons: [
                // ['<button>Ok</button>', function (instance, toast) {
                //     alert("Hello world!");
                // }, true],
                ['<button>Ok</button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy) {
                            console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                        }
                    }, toast, 'buttonName');
                }]
            ],
            // onOpening: function(instance, toast){
            //     console.info('callback abriu!');
            // },
            onClosing: function(instance, toast, closedBy) {
                console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
            }
        });
    </script>
<?php endif ?>
<script>
    class StorageData {
        constructor() {
            this.data = [];
        }
        getData() {
            return this.data;
        }
        changeData(changedata) {
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
    $('.data-table').DataTable({
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "searching":false,
        "responsive":true,
        lengthMenu:[[8,10,25,50,-1],[8,10,25,50,"All"]],
    });
    $('.number-format').on('focusout',function(){
        $(this).val(numeral(this.value).format('0,0.00'));
    })
    $('.number-format').on('focus',function(){
        $(this).val(this.value.replace(/,/g, ""));
    })
    $('.number-format').on('keyup',function(){
        $(this).val(this.value.replace(/[^\d.-]/g, ''))
        // $(this).val(parseFloat(this.value).toFixed(2));
        // $(this).val(this.value.replace(/[^a-zA-Z ]/g, ''))
    })
    $('#addProofOfPayment').click(function(){
        $('#proofOfPaymentList').hide();
        $('#proofOfPaymentDiv').show();
    })
    $('#goBackToList').click(function(){
        $('#proofOfPaymentDiv').hide();
        $('#proofOfPaymentList').show(); 
    })
    $(".number-format").click(function() {
        $(this).select();
    });
    $('select[name=payment-type]').on('change', function() {
        // console.log()
        choosePayment(this.value)
    });
    $('#submit-button').on('click', function(e) {
        e.preventDefault();
        var count = 0;
        $('input.form-control[required]').each(function() {
            $(this).removeClass('is-invalid')
            if (this.value == "") {
                ++count;
                $(this).addClass('is-invalid')
                setTimeout(() => {
                    $(this).removeClass('is-invalid')
                }, 3000);
            }
        })
        $('select.form-select[required]').each(function() {
            $(this).removeClass('is-invalid')
            if (this.value == "") {
                ++count;
                $(this).addClass('is-invalid')
                setTimeout(() => {
                    $(this).removeClass('is-invalid')
                }, 3000);
            }
        })
        if ($('input[name=images]').val() == "") {
            iziToast.error({
                title: 'Error: ',
                message: 'You need to choose a file!!',
                position: 'topRight',
            });
            ++count;
        }
        
        if (count == 0) {
            iziToast.show({
                theme: 'light',
                title: 'Are you sure?',
                // message: 'Are you sure?',
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: '#cc0000',
                overlay:true,
                timeout:false,
                titleSize:21,
                buttons: [
                    ['<button>Yes</button>', function (instance, toast) {
                        // alert("Hello world!");
                        $('body').waitMe({
                            effect: 'win8',
                            text: 'Please wait...',
                            bg: 'rgba(255,255,255,0.7)',
                            color: '#cc0000',
                            maxSize: '',
                            waitTime: -1,
                            textPos: 'vertical',
                            fontSize: '',
                            source: '',
                            onClose: function() {

                            }
                        });
                        $('#submit-button').attr('disabled', 'disabled');
                        $('.number-format').val($('.number-format').val().replace(/,/g, ""));
                        $('#proof_of_payment_form')[0].submit();
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(instance, toast, closedBy){

                            }
                        }, toast, 'buttonName');
                    }, true], // true to focus
                    ['<button>No</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(instance, toast, closedBy){

                            }
                        }, toast, 'buttonName');
                    }]
                ],
                onOpening: function(instance, toast){

                },
                onClosing: function(instance, toast, closedBy){

                }
            });
            // $('#submit-button').attr('disabled', 'disabled');
            // $('#proof_of_payment_form')[0].submit();
        }
    });
    $('#view_image').iziModal({
        theme: 'light',
        headerColor: '#f2f7ff',
        width: '60vw',
        overlayColor: 'rgba(0, 0, 0, 0.5)',
        top: 1,
        fullscreen: true,
        color: 'black',
        transitionIn: 'fadeInUp',
        transitionOut: 'fadeOutDown',
        // height: '80',
    });
    $('.input-images-1').imageUploader({
        maxFiles: 1
    });
    $('input[type=file]').attr('multiple', false);
    $('input[type=file]').on('change', function() {
        image_upload = this.value;
        var imgInterval = window.setInterval(() => {
            var img = document.querySelector(".uploaded-image img");
            // console.log(img.height)
            // console.log(img.width)
            $('.image-uploader.has-files .uploaded-image').css('height', img.height)
            $('.image-uploader.has-files .uploaded-image').css('width', img.width)
            clearInterval(imgInterval)
        }, 100);
        // console.log(image_upload)
    });
    $('.input-images-1').on('mouseover', function() {
        if ($('input[type=file]').val() != image_upload) {
            image_upload = $('input[type=file]').val();
            var imgInterval2 = window.setInterval(() => {
                var img = document.querySelector(".uploaded-image img");
                // console.log(img.height)
                // console.log(img.width)
                $('.image-uploader.has-files .uploaded-image').css('height', img.height)
                $('.image-uploader.has-files .uploaded-image').css('width', img.width)
                clearInterval(imgInterval2)
            }, 100);
        }
    });
    async function getImageLink(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/main/getProofOfPaymentImage",
                method: 'get',
                dataType: 'json',
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

    function choosePayment(payment) {
        $('#upload-proof-button').hide();
        $('.payment-type-div').show();
        $('.bank-name-div').show();
        $('select[name=bank_type]').attr('required',true);
        console.log(payment)
        if (payment == "online_payment") {
            $('input[name=payment_type]').val('Bank Deposit');
            $('.payment-page').show();
            $('.payment-type').hide();
            $('.online-payment').show();
            $('.other-payment').hide();
            $('.online-payment input.form-control').attr('required', true)
            $('.online-payment select').attr('required', true)
            $('.other-payment input.form-control').attr('required', false)
            $('input[name=reference_number]').val('');
            var option = `
                <option value="">Choose</option>
                <option value="AUB">AUB</option>
                <option value="RCBC">RCBC</option>
                <option value="BDO">BDO</option>
                <option value="Eastwest">Eastwest</option>
                <option value="Union Bank">Union Bank</option>
                `;
            $('.bank-name-label').text('Bank Name');
            $('select[name=bank_type]').empty();
            $('select[name=bank_type]').append(option);
        } else if (payment == "over_the_counter") {
            // $("#payment-title").text('Over the Counter');
            $('input[name=payment_type]').val('Over the Counter');
            $('.payment-page').show();
            $('.payment-type').hide();
            $('.other-payment').show();
            $('.online-payment').hide();
            $('.online-payment input.form-control').attr('required', false)
            $('.online-payment select').attr('required', false)
            $('.other-payment input.form-control').attr('required', true)
        } else if (payment == "sdca_online_payment") {
            // $("#payment-title").text('SDCA Online Payment');
            $('input[name=payment_type]').val('SDCA Online Payment');
            $('.payment-page').show();
            $('.payment-type').hide();
            $('.other-payment').show();
            $('.online-payment').hide();
            $('.online-payment input.form-control').attr('required', false)
            $('.online-payment select').attr('required', false)
            $('.other-payment input.form-control').attr('required', true)
        } else {
            // $('.payment-type').show();
            // $('.payment-page').hide();
            // $('#upload-proof-button').show();
            $("#payment-title").text(payment);
            $('input[name=payment_type]').val(payment);
            $('.payment-page').show();
            $('.payment-type-div').show();
            // $('.payment-type').hide();
            $('.other-payment').show();
            $('.online-payment').hide();
            // $('.online-payment input.form-control').attr('required', false)
            // $('.online-payment select').attr('required', false)
            $('.other-payment input.form-control').attr('required', true)
            $('.online-payment input.form-control').attr('required', false)
            

            $('select[name=bank_type]').empty();
            if(payment=="Online Fund Transfer"){
                var option = `
                <option value="">Choose</option>
                <option value="InstaPay">InstaPay</option>
                <option value="PesoNet">PesoNet</option>
                `;
                $('.bank-name-label').text('Payment Method');
                $('select[name=bank_type]').append(option);
            }
            else if(payment=="Scan QR"){
                var option = `
                <option value="">Choose</option>
                <option value="GCASH">GCASH</option>
                <option value="Other QR Payment">Other QR Payment</option>
                `;
                $('.bank-name-label').text('Payment Method');
                $('select[name=bank_type]').append(option);
            }
            else if(payment=="Partner Cash-in"){
                var option = `
                <option value="">Choose</option>
                <option value="SM">SM</option>
                <option value="7/11">7/11</option>
                <option value="Other Remittance Center">Other Remittance Center</option>
                `;
                $('.bank-name-label').text('Payment Method');
                $('select[name=bank_type]').append(option);
            }
            else if(payment=="SDCA Online Payment"){
                $('select[name=bank_type]').attr('required',false);
                $('select[name=bank_type]').val('');
                $('.bank-name-div').hide();
            }
        }
    }

    function OnloadImage() {
        $('body').waitMe({
            effect: 'win8',
            text: 'Please wait...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#cc0000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function() {}
        });
        setTimeout(() => {
            getImageLink().then(link => {
                $('#uploaded_image').attr('src', link);
                $('body').waitMe('hide');
                storagedata.changeData(link);
            }).catch(error => console.log(error));
        }, 3000);
    }

    function viewImage(id) {
        $('body').waitMe({
            effect: 'win8',
            text: 'Please wait...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#cc0000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function() {}
        });
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/main/getProofOfPaymentInfo",
            method: 'post',
            data:{
                id:id
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if(response.payment_type=='Bank Deposit'){
                    $('.online_payment').show();
                    $('.over_counter').hide();
                }
                else{
                    $('.over_counter').show();
                    $('.online_payment').hide();
                }
                $('input[name=view_payment_type]').val(response.payment_type);
                $('input[name=view_payment_reference]').val(response.payment_reference_no);
                $('input[name=view_bank_type]').val(response.bank_type);
                $('input[name=view_card_number]').val(response.acc_num);
                $('input[name=view_acc_holder_name]').val(response.acc_holder_name);
                $('input[name=view_amount_paid]').val(numeral(response.amount_paid).format('0,0.00'));
                $('input[name=view_file_type]').val(response.file_type);
                $('input[name=date_submitted]').val(response.requirements_date);

                if(response.payment_type=='SDCA Online Payment'){
                    $('input[name=view_bank_type]').val(response.payment_type);
                }
                // view_payment_type
                // view_payment_reference
                // view_bank_type
                // view_card_number
                // view_acc_holder_name
                // view_amount_paid
                // view_file_type
                $('#view_image').iziModal('open');
                $('#view_image').iziModal('setTitle', "<b>Proof of Payment:</b>");
                $('body').waitMe('hide');
            },
            error: function(response) {
                console.log(response)
            }
        });
        
    }
    var img = document.querySelector(".uploaded-image img");
    // $('.image-uploader.has-files .uploaded-image').css('height',img.height)
    // $('.image-uploader.has-files .uploaded-image').css('width',img.width)
    // console.log(img);
    $(window).resize(function() {
        var img = document.querySelector(".uploaded-image img");
        $('.image-uploader.has-files .uploaded-image').css('height', img.height)
        $('.image-uploader.has-files .uploaded-image').css('width', img.width)
        // console.log(img.height);
    })
    $('#upload_form').on('submit', function(e) {
        e.preventDefault();
        var count = 0;
        if ($('input[name=images]').val() == "") {
            ++count;
            iziToast.error({
                title: 'Error: ',
                message: 'Please choose a File!!',
                position: 'topRight',
            });
        }
        if (count == 0) {
            $('#upload_form button[type=submit]').attr('disabled', true);
            $(this)[0].submit();
        }
    })
</script>
<?php
echo '<script>';
if (!empty($this->session->flashdata('error'))) {
    echo "iziToast.error({
                title: 'Error: ',
                message: '" . $this->session->flashdata('error') . "',
                position: 'topRight',
            });";
    $this->session->set_flashdata('error', '');
} else if (!empty($this->session->flashdata('success'))) {
    echo "iziToast.success({
            title: 'Success: ',
            message: '" . $this->session->flashdata('success') . "',
            position: 'topRight',
        });";
    // echo "OnloadImage();";
    $this->session->set_flashdata('success', '');
}
echo '</script>';
?>