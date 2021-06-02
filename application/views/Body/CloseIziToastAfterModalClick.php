<!-- close all izitoast and chat inquiry button when a modal has been clicked -->

<script>
var student_name = "<?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name');?>";
var status = 'open';
function showIziToastUser(){
    // if(status!='open'){
        // status="open";
        var count_modal = 0;
        $('.modal.show').each(function(){
            ++count_modal;
        })
        if($(window).width()>568){
            iziToast.show({
                class:'izitoast-welcome-user',
                theme: 'dark',
                icon: 'icon-person',
                title: 'Welcome',
                message: student_name,
                position: 'topRight',
                progressBarColor: '#cc0000',
                image: "<?php echo base_url('assets/vendors/login_asset/img/sdcalogo.png'); ?>",
                timeout:false,
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag:false
            });
        }
    // }
}
function showIziToastGuide(){
    iziToast.show({
        class:'izitoast-open-walkthrough',
        theme: 'dark',
        icon: 'bi-info-circle-fill',
        iconColor: 'white',
        title: 'Guide:',
        titleSize:"18",
        message: '',
        messageSize: '18',
        // messageLineHeight: '30',
        position: 'bottomLeft', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
        progressBarColor: '#cc0000',
        overlay: false,
        timeout: false,
        overlayClose: false,
        drag: false,
        close: false,
        closeOnEscape: false,
        closeOnClick: false,
        buttons: [
            // ['<button>Ok</button>', function (instance, toast) {
            //     alert("Hello world!");
            // }, true],
            ['<button>Open Guide</button>', function(instance, toast) {
                // current_this.play();
                var ose_guide1 = new OSE_Guide($('input[name=current_tab_selection]').val());
                ose_guide1.play();
                instance.hide({
                    transitionOut: 'fadeOutUp',
                    onClosing: function(instance, toast, closedBy) {
                        // console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                        
                    }
                }, toast, 'buttonName');
            }]
        ],
        onClosing: function(instance, toast, closedBy) {
            console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
        }
    });
}
function hideIziToast(){
    var toast = document.querySelector('.iziToast');
    var izitoastWalkthrough = document.querySelector('.izitoast-open-walkthrough');
    var iziToastWelcome = document.querySelector('.izitoast-welcome-user');
    iziToast.hide({
        transitionOut: 'fadeOutUp'
    }, toast);
    iziToast.hide({
        transitionOut: 'fadeOutUp'
    },izitoastWalkthrough);
    iziToast.hide({
        transitionOut: 'fadeOutUp'
    },iziToastWelcome);
    status="close";
}
// var toast = document.querySelector('.iziToast');

// $('#chat-logo').click(function(e){
//     hideIziToast()
// });
$('#chatinquiryModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    status="open";
});
$('#chatinquiryModal').on('shown.bs.modal', function () {
    hideIziToast()
    status="close";
});
// subjectModal
$('#subjectModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    $('#chat-logo').show();
    status="open";
});
$('#subjectModal').on('shown.bs.modal', function () {
    hideIziToast()
    $('#chat-logo').hide();
    $('#chat-logo').css('display','none');
    status="close";
    // alert('hello');
});
// scheduleModal
$('#scheduleModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    $('#chat-logo').show();
    status="open";
});
$('#scheduleModal').on('shown.bs.modal', function () {
    hideIziToast()
    $('#chat-logo').hide();
    status="close";
});
// online_payment_form
$('#onlinepaymentModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    $('#chat-logo').show();
    status="open";
});
$('#onlinepaymentModal').on('shown.bs.modal', function () {
    hideIziToast()
    $('#chat-logo').hide();
    status="close";
});
// overthecounterModal
$('#overthecounterModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    $('#chat-logo').show();
    status="open";
});
$('#overthecounterModal').on('shown.bs.modal', function () {
    hideIziToast()
    $('#chat-logo').hide();
    status="close";
});
$('#oldStudentAccountModal').on('hidden.bs.modal', function (e) {
    showIziToastGuide();
    showIziToastUser();
    $('#chat-logo').show();
    status="open";
});
$('#oldStudentAccountModal').on('shown.bs.modal', function () {
    hideIziToast()
    $('#chat-logo').hide();
    status="close";
});

window.addEventListener('scroll',()=>{
    const scrolled = window.scrollY;
    var count_modal = 0;
    $('.modal.show').each(function(){
        ++count_modal;
    })
    
    if(count_modal==0){
        var toast = document.querySelector('.iziToast');
        var iziToastWelcome = document.querySelector('.izitoast-welcome-user');
        var scroll_number = 0;
        if($(window).width()<=768){
            scroll_number = 20;
        }
        else{
            scroll_number = 150;
        }
        if(scrolled>scroll_number){
            if(status=="open"){
                status="close";
                iziToast.hide({
                    transitionOut: 'fadeOutUp'
                },iziToastWelcome);
                iziToast.hide({
                    transitionOut: 'fadeOutUp'
                }, toast);
            }
        }
        else{
            if(status!="open"){
                status="open";
                showIziToastUser();
            }
        }
    }
    // var iziToastWelcome = document.querySelector('.izitoast-welcome-user');
    // if(scrolled>160){
    //     iziToast.hide({
    //         transitionOut: 'fadeOutUp'
    //     },iziToastWelcome);
    // }
    // else{
    //     showIziToastUser();
    // }
})
</script>