searchVisible = 0;
transparent = true;

// $('.nav-pills li').each(function(){
//     if($(this).hasClass('active')){
//         console.log()
//     }
// })

// student_information
// requirements
// advising
// payment
// registration
$(document).ready(function() {


    $('#readvise_button').click(function() {
        wizard_advising();
        hasclass_oldstudent();
        init_paymentmethod();
        $("#payment_content").removeClass("active");
        var ose_guide1 = new OSE_Guide('advising');
        ose_guide1.play();
    });

    ref__ = $('#assessment_section').data('ref');

    function hideIziToastGuide() {
        var izitoastWalkthrough = document.querySelector('.izitoast-open-walkthrough');
        iziToast.hide({
            transitionOut: 'fadeOutUp'
        }, izitoastWalkthrough);
    }

    function showIziToastGuide() {
        iziToast.show({
            class: 'izitoast-open-walkthrough',
            theme: 'dark',
            icon: 'bi-info-circle-fill',
            iconColor: 'white',
            title: 'Guide:',
            titleSize: "18",
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
    $('#tab_student_information').click(function() {
        setTimeout(() => {
            if ($('#li_student_information').hasClass('active')) {
                $('input[name=current_tab_selection]').val('student_information');
                hideIziToastGuide();
                // showIziToastGuide();
                var ose_guide1 = new OSE_Guide('student_information');
                ose_guide1.play();
            }
        }, 500)
    })
    $('#tab_requirements').click(function() {
        setTimeout(() => {
            if ($('#li_requirements').hasClass('active')) {
                $('input[name=current_tab_selection]').val('requirements');
                hideIziToastGuide();
                // showIziToastGuide();
                var ose_guide1 = new OSE_Guide('requirements');
                ose_guide1.play();
            }
        }, 500)
    })
    $('#tab_advising').click(function() {
        setTimeout(() => {
            if ($('#li_advising').hasClass('active')) {
                $('input[name=current_tab_selection]').val('advising');
                hideIziToastGuide();
                // showIziToastGuide();
                var ose_guide1 = new OSE_Guide('advising');
                ose_guide1.play();
            }
        }, 500)
    })
    $('#tab_payment').click(function() {
        setTimeout(() => {
            if ($('#li_payment').hasClass('active')) {
                $('input[name=current_tab_selection]').val('payment');
                hideIziToastGuide();
                // showIziToastGuide();
                var ose_guide1 = new OSE_Guide('payment');
                ose_guide1.play();
            }
        }, 500)
    })

    $('#tab_registration').click(function() {
        setTimeout(() => {
            if ($('#li_registration').hasClass('active')) {
                $('input[name=current_tab_selection]').val('registration');
                hideIziToastGuide();
                // showIziToastGuide();
                var ose_guide1 = new OSE_Guide('registration');
                ose_guide1.play();
            }
        }, 500)
    })




    // $('#submit_val_doc').click(function(e) {
    //     baseurl = $('#assessment_section').data('baseurl');
    //     var interview_value = $("input[name='interview']:checked").val();
    //     if (interview_value == 'YES' || interview_value == 'NO') {
    //         $('.tab-content .tab-pane').removeClass('active');
    //         $.ajax({
    //                 url: baseurl + 'main/interview_status',
    //                 type: 'POST',
    //                 data: {
    //                     'interview': interview_value,
    //                 },
    //                 success: function() {},
    //             })
    //             // fetch_user_status();
    //     } else {
    //         iziToast.show({
    //             title: 'Do you want to be interviewed? is REQUIRED',
    //             message: 'Must select one to proceed',
    //             position: 'center',
    //             color: 'red',

    //         });
    //         e.preventDefault();
    //         e.stopPropagation();
    //     }
    // });

    $('.wizard-proceed-advising').click(function(e) {

        $.ajax({
            url: 'https://stdominiccollege.edu.ph/SDCALMSv2/index.php/API/BalanceAPI?Reference_Number=' + ref__,
            dataType: 'JSON',
            success: function(response) {
                // console.log(response['Output']['Outstanding_Balance']);
                balance = response['Output']['Outstanding_Balance'];
                if (balance >= 1) {
                    iziToast.show({
                        title: 'You still have Balance.',
                        message: 'You cannot proceed to the next step.',
                        position: 'topCenter',
                        color: 'red',
                    });
                } else {

                    // if ($(this).hasClass('old-student')) {
                    //     console.log('has class');
                    // }
                    // console.log($(this).hasClass('old-student'));
                    // Event handler when proceeding to next step
                    // if ($('#advising_content').hasClass('active')) {
                    // init_advise();

                    // console.log('ready to advise');
                    iziToast.question({
                        timeout: false,
                        close: false,
                        overlay: true,
                        displayMode: 'once',
                        id: 'advise_question',
                        zindex: 1500,
                        message: 'You cannot change subjects after the Assessment. Do you want to proceed?',
                        position: 'center',
                        buttons: [
                            ['<button><b>YES</b></button>', function(instance, toast) {
                                console.log('ready to advise');
                                // Came from advising.js

                                // wizard_payment();
                                init_advise();
                                // location.reload();
                                hideIziToastGuide();
                                var ose_guide1 = new OSE_Guide('payment');
                                ose_guide1.play();
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');

                            }, true],
                            ['<button>NO</button>', function(instance, toast) {

                                e.preventDefault();
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');

                            }, true],
                        ],
                        onClosing: function(instance, toast, closedBy) {
                            console.info('Closing | closedBy: ' + closedBy);
                        },
                        onClosed: function(instance, toast, closedBy) {
                            console.info('Closed | closedBy: ' + closedBy);
                        }
                    });
                }
            }
        })

    });

    $('.wizard-proceed-student_info').click(function() {

    });

    fetch_user_status();


    // Wizard Initialization
    $(".wizard-card").bootstrapWizard({
        tabClass: "nav nav-pills",
        nextSelector: ".btn-next",
        previousSelector: ".btn-previous",

        // onNext: function (tab, navigation, index) {
        //     var $valid = $('.wizard-card form').valid();
        //     if (!$valid) {
        //         $validator.focusInvalid();
        //         return false;
        //     }
        // },

        onInit: function(tab, navigation, index) {
            //check number of tabs and fill the entire row
            var $total = navigation.find("li").length;
            $width = 100 / $total;

            navigation.find("li").css("width", $width + "%");
        },

        onTabClick: function(tab, navigation, index) {
            alert(index);
            // var $valid = $('.wizard-card form').valid();
            // if (!$valid) {
            //     return false;
            // } else {
            //     return true;
            // }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find("li").length;
            var $current = index + 1;

            var $wizard = navigation.closest(".wizard-card");

            // If it's the last tab then hide the last button and show the finish instead
            // if ($current >= $total) {
            //     $($wizard).find('.btn-next').hide();
            //     $($wizard).find('.btn-finish').show();
            // } else {
            //     $($wizard).find('.btn-next').show();
            //     $($wizard).find('.btn-finish').hide();
            // }

            //update progress
            var move_distance = 100 / $total;
            move_distance = move_distance * index + move_distance / 2;

            $wizard.find($(".progress-bar")).css({ width: move_distance + "%" });
            //e.relatedTarget // previous tab

            $wizard
                .find($(".wizard-card .nav-pills li.active a .icon-circle"))
                .addClass("checked");
        },
    });

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
        readURL(this);
    });

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function() {
        wizard = $(this).closest(".wizard-card");
        wizard.find('[data-toggle="wizard-radio"]').removeClass("active");
        $(this).addClass("active");
        $(wizard).find('[type="radio"]').removeAttr("checked");
        $(this).find('[type="radio"]').attr("checked", "true");
    });

    $('[data-toggle="wizard-checkbox"]').click(function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).find('[type="checkbox"]').removeAttr("checked");
        } else {
            $(this).addClass("active");
            $(this).find('[type="checkbox"]').attr("checked", "true");
        }
    });

    $(".set-full-height").css("height", "auto");
});

$(".set-full-height").css("height", "auto");
// });

function fetch_user_status() {
    base_url = $("#assessment_section").data("baseurl");
    // reference_number = "14174";
    $("tab_registration").removeAttr("class");
    $("tab_advising").removeAttr("class");
    $("tab_student_information").removeAttr("class");
    $.ajax({
        type: "POST",
        url: base_url + "index.php/Main/wizard_tracker_status",
        async: true,
        dataType: "JSON",
        success: function(response) {
            // alert(response);
            // result = JSON.parse(response);
            payment = response.payment;
            advising = response.advising;
            old_student = response.old_student;
            requirements = response.requirements;
            student_information = response.student_information;
            $('.tab-pane .container').removeClass('active');
            // Walkthrough ids
            // student_information
            // requirements
            // advising
            // payment
            // registration
            if (old_student == 1) {
                // wizard_payment();
                // wizard_advising();
                $('.wizard-proceed-advising').addClass('old-student');

                wizard_old_student();
                // hasclass_oldstudent()
            }
            if (payment == 1) {

                $('input[name=current_tab_selection]').val('registration');
                wizard_registration();
                hasclass_oldstudent();
                $("#advising_content").removeClass("active");
                var ose_guide1 = new OSE_Guide('registration');
                check_next_enrollment();

            } else if (advising == 1) {

                wizard_payment();
                var ose_guide1 = new OSE_Guide('payment');

            } else if (requirements == 1) {
                wizard_advising();
                var ose_guide1 = new OSE_Guide('advising');
                hasclass_oldstudent();

            } else if (student_information == 1) {
                $('input[name=current_tab_selection]').val('requirements');
                // wizard_requirements();
                if ($('.wizard-proceed-advising').hasClass('old-student')) {
                    // $("#progress_bar").css("width", "50%");
                } else {
                    wizard_requirements();
                }
                var ose_guide1 = new OSE_Guide('requirements');

            } else {
                wizard_student_info();
                hasclass_oldstudent();
                var ose_guide1 = new OSE_Guide('student_information');

            }
            ose_guide1.play();
        },
        error: function(response) {},
    });


}

function hasclass_oldstudent() {
    if ($('.wizard-proceed-advising').hasClass('old-student')) {
        // console.log('has class');
        // $("#tab_advising").removeAttr("data-toggle");
        // $("#tab_requirements").removeAttr("data-t?" "
        $("#li_requirements").removeClass("active");
        $("#student_information_content").removeClass("active");
        $("#requirements_content").removeClass("active");
        // $("#advising_content").removeClass("active");
        // $("#progress_bar").css("width", "50%");
    }
}

function wizard_old_student() {
    tab_student_information();
    tab_requirements();
    tab_advising();

    // $("#tab_advising").removeAttr("data-toggle");
    $("#tab_requirements").removeAttr("data-toggle");
    $("#tab_student_information").removeAttr("data-toggle");

    $("#progress_bar").css("width", "50%");

    $("#advising_content").addClass("active");
    $("#student_information_content").removeClass("active");
    $("#requirements_content").removeClass("active");

    $("#tab_requirements").addClass("wizard_li");
    $(".bi-card-checklist").addClass("wizard_li");
    $("#tab_requirements-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
}

function wizard_registration() {
    tab_student_information();
    tab_requirements();
    tab_advising();
    tab_payment();
    tab_registration();
    $("#progress_bar").css("width", "90%");
    // $("#payment").addClass("active");
    $("#registration_content").addClass("active");
    init_registrationform();
    $('.wizard-proceed').hide();
}

function wizard_payment() {
    tab_student_information();
    tab_requirements();
    tab_advising();
    tab_payment();
    // alert('test');
    $("#progress_bar").css("width", "70%");
    $("#payment_content").addClass("active");
    $("#advising_content").removeClass("active");
}

function wizard_advising() {
    tab_student_information();
    tab_requirements();
    tab_advising();
    // alert('test');
    $("#progress_bar").css("width", "50%");
    // $("#requirements_content").addClass("active");
    $("#advising_content").addClass("active");
}

function wizard_requirements() {
    tab_student_information();
    tab_requirements();
    init_sectionlist();
    $("#progress_bar").css("width", "30%");
    // $("#progress_bar").css("width", "62.5%");
    // $("#advising_content").addClass("active");
    $("#requirements_content").addClass("active");
    // $("#wizard-button-requirements").removeClass("wizard-proceed-hide");
    // $("#wizard-button").addClass("wizard-proceed-hide");
}

function wizard_student_info() {
    tab_student_information();
    $("#progress_bar").css("width", "12.5%");
    $("#student_information_content").addClass("active");
}

function tab_registration() {
    // $("#tab_registration").attr("class", "wizard_li");
    $("#tab_registration-circle").addClass("checked");

    $("#tab_payment-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_requirements-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_registration").attr("data-toggle", "tab");
    $("#tab_payment").removeAttr("data-toggle");
    $("#tab_advising").removeAttr("data-toggle");
    $("#tab_student_information").removeAttr("data-toggle");

    $("#li_registration").attr("class", "active");
    $("#li_payment").removeClass("active");

    $("#tab_payment").attr("class", "wizard_li");
    $(".bi-cash-stack").addClass("wizard_li");
}

function tab_payment() {
    // $("#tab_payment").attr("class", "wizard_li");
    $("#tab_payment-circle").addClass("checked");

    $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
    // $("#tab_registration-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_payment").attr("data-toggle", "tab");
    // $("#tab_advising").removeAttr("data-toggle");

    // $("#li_payment").attr("class", "active");
    $("#li_payment").attr("class", "active");
    $("#li_advising").removeClass("active");


    $("#tab_advising").attr("class", "wizard_li");
    $(".bi-clipboard-plus").addClass("wizard_li");
}

function tab_advising() {
    // $("#tab_advising").attr("class", "wizard_li");
    $("#tab_advising-circle").addClass("checked");
    // $("#tab_requirements-circle").addClass("checked");

    // $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_advising").attr("data-toggle", "tab");

    $("#li_advising").attr("class", "active");
    $("#li_requirements").removeClass("active");
    // $("#li_advising").attr("class", "active");

}

function tab_requirements() {
    // $("#tab_requirements").attr("class", "wizard_li");
    $("#tab_requirements-circle").addClass("checked");
    // $("#tab_requirements-circle").addClass("checked");

    $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_requirements").attr("data-toggle", "tab");

    $("#li_requirements").attr("class", "active");
    $("#li_student_information").removeClass("active");

    $("#tab_student_information").attr("class", "wizard_li");
    $(".bi-person-lines-fill").addClass("wizard_li");
}

function tab_student_information() {
    // $("#tab_student_information").attr("class", "wizard_li");
    $("#tab_student_information-circle").addClass("checked");
    $("#li_student_information").attr("class", "active");

    $("#tab_student_information").attr("data-toggle", "tab");
}