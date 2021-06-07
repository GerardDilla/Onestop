<style>
    .payment-type {
        display: none;
    }
</style>
<section class="section col-sm-12">
    <?php if (empty($date_submitted)) { ?>
        <form id="proof_of_payment_form" action="<?php echo base_url('index.php/Main/uploadProofOfPaymentProcess'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="payment_type" value="online_payment">
            <div class="card" style="margin:none;">
                <div class="card-header">
                    <div class="col-md-12 row">
                        <div class="col-lg-4 ">
                            <div class="form-group payment-type-div">
                                <label class="input-label payment-page"><b>Payment Type</b></label>
                                <select class="form-select payment-page" name="payment-type">
                                    <option value="online_payment">Online Payment</option>
                                    <option value="over_the_counter">Over the Counter</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8" align="right">&nbsp;<button type="button" class="payment-page btn btn-sm btn-danger" id="submit-button">Submit</button></div>
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
                        <!-- <div class="col-md-4 col-lg-4 col-sm-12" style="margin:0;padding:0;">
                    <div class="col-md-12 payment-header">BILLS PAYMENT FACILITIES</div>
                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/sm-department-store-logo.jpg'); ?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>SM Bacoor</strong></p></div>

                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/hypermarket.jfif'); ?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>Imus & Molino</strong></p></div>

                    <div class="col-md-12 payment-body" ><img class="payment-logo" src="<?php echo base_url('assets/images/bank/savemore.png'); ?>"></div>
                    <div class="col-md-12 payment-body" ><p><strong>Zapote</strong></p></div>
                </div> -->
                        <div class="col-md-3 col-lg-3 col-sm-12" style="margin:0;padding:0;">
                            <div class="col-md-12 payment-header">SDCA ONLINE PAYMENT</div>
                            <div class="col-md-12 payment-body" style="margin-top:30px;"><a href="https://stdominiccollege.edu.ph/SDCAPayment/" class="btn btn-success btn-lg btn-semi-round" target="_blank">Pay Here</a></div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 row payment-online">
                <div class="col-lg-5 col-md-5 account-name-card payment-head"><img class="sdcalogo" src="<?php echo base_url('assets/images/logo/sdcalogo.png'); ?>"></div>
                <div class="col-lg-5 col-md-5 account-name-card payment-head-text"><span>Online Payment Accounts</span></div>
                <div class="col-lg-5 col-md-5  col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/bdo.png'); ?>" style="height:67px;"><br><br><span class="account_number">ACCOUNT NUMBER: <br>0000-7016-1291</span><br><font class="account-title">Savings Account</font></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/aub-2.jpg'); ?>"><br><br><span class="account_number">ACCOUNT NUMBER: <br>120-01-890142-6</span><br><font class="account-title">Savings Account</font></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/eastwest-bank-logo-2.jpg'); ?>"><br><br><span class="account_number">ACCOUNT NUMBER: <br>2000-0065-6417</span><br><font class="account-title">Savings / Checking Account</font></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/rcbc1.png'); ?>"><br><br><span class="account_number">ACCOUNT NUMBER: <br>0013-4500-0867</span><br><font class="account-title">Savings Account</font></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/ub-2.jpg'); ?>"><br><br><span class="account_number">ACCOUNT NUMBER: <br>0004-70001-2500</span><br><font class="account-title">Savings Account</font></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><img class="payment-logo" src="<?php echo base_url('assets/images/bank/Gcash-logo-type.png'); ?>"></div>
                <div class="col-lg-5 col-md-5 col-sm-12 payment-card"><font class="sdca_online">SDCA ONLINE PAYMENT SYSTEM</font><br><br><font style="font-weight:bold;color:black;font-size:19px">Type the link below to your browser to explore:</font><br><a class="sdca-link" href="https://stdominiccollege.edu.ph/SDCAPayment/" target="_blank">https://stdominiccollege.edu.ph/SDCAPayment/</a></div>
                <div class="col-lg-5 col-md-5 col-sm-12 account-name-card"><div class="col-md-12 account-name">ACCOUNT NAME: <br>ST. DOMINIC COLLEGE OF ASIA, INC.</div></div>
            </div> -->
                    <div class="col-md-12 row payment-page">
                        <div class="col-md-2 form-group online-payment">
                            <label class="input-label"><b>Bank Type</b></label>
                            <select required class="form-select" name="bank_type">
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
    <?php } else {
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
                            <td><?php echo $payment_type; ?></td>
                            <td style="text-align:center;"><button class="btn btn-sm btn-info" onclick="viewImage()">View</button></td>
                            <td style="text-align:center;"><?php echo date("F j, Y, g:i a", strtotime($date_submitted)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
</section>
<div id="view_image" data-izimodal-group="" data-izimodal-loop="" style="display:none;" data-izimodal-title="">
    <div class="col-md-12" style="margin:10px;" align="center">
        <img src="<?php echo empty($gdrive_link) ? '' : 'https://drive.google.com/uc?export=view&id=' . $gdrive_link; ?>" id="uploaded_image">
    </div>
</div>
<!-- onlinepaymentModal -->
<?php if (empty($date_submitted)) : ?>
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
            ++count;
        }

        if (count == 0) {
            $('#submit-button').attr('disabled', 'disabled');
            $('#proof_of_payment_form')[0].submit();
        } else {
            iziToast.error({
                title: 'Error: ',
                message: 'You need to choose a file!!',
                position: 'topRight',
            });
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
        if (payment == "online_payment") {
            $('input[name=payment_type]').val('Online Payment');
            $('.payment-page').show();
            $('.payment-type').hide();
            $('.online-payment').show();
            $('.other-payment').hide();
            $('.online-payment input.form-control').attr('required', true)
            $('.online-payment select').attr('required', true)
            $('.other-payment input.form-control').attr('required', false)
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
            $('.payment-type').show();
            $('.payment-page').hide();
            $('#upload-proof-button').show();
        }
    }

    function OnloadImage() {
        $('body').waitMe({
            effect: 'bounce',
            text: '',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
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

    function viewImage() {
        $('#view_image').iziModal('open');
        $('#view_image').iziModal('setTitle', "<b>Proof of Payment:</b>");
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
    echo "OnloadImage();";
    $this->session->set_flashdata('success', '');
}
echo '</script>';
?>