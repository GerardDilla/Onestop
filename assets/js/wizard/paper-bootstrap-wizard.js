searchVisible = 0;
transparent = true;
$(document).ready(function () {
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
    $('.wizard-proceed-requirements').click(function () {

    });

    $('.wizard-proceed-advising').click(function (e) {
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
                ['<button><b>YES</b></button>', function (instance, toast) {

                    console.log('ready to advise');
                    // Came from advising.js

                    // wizard_payment();
                    init_advise();
                    // location.reload();

                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    e.preventDefault();
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                }, true],
            ],
            onClosing: function (instance, toast, closedBy) {
                console.info('Closing | closedBy: ' + closedBy);
            },
            onClosed: function (instance, toast, closedBy) {
                console.info('Closed | closedBy: ' + closedBy);
            }
        });
    });

    $('.wizard-proceed-student_info').click(function () {

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

        onInit: function (tab, navigation, index) {
            //check number of tabs and fill the entire row
            var $total = navigation.find("li").length;
            $width = 100 / $total;

            navigation.find("li").css("width", $width + "%");
        },

        onTabClick: function (tab, navigation, index) {
            alert(index);
            // var $valid = $('.wizard-card form').valid();
            // if (!$valid) {
            //     return false;
            // } else {
            //     return true;
            // }
        },

        onTabShow: function (tab, navigation, index) {
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
    $("#wizard-picture").change(function () {
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function () {
        wizard = $(this).closest(".wizard-card");
        wizard.find('[data-toggle="wizard-radio"]').removeClass("active");
        $(this).addClass("active");
        $(wizard).find('[type="radio"]').removeAttr("checked");
        $(this).find('[type="radio"]').attr("checked", "true");
    });

    $('[data-toggle="wizard-checkbox"]').click(function () {
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
        success: function (response) {
            // alert(response);
            result = JSON.parse(response);
            payment = result.payment;
            advising = result.advising;
            requirements = result.requirements;
            student_information = result.student_information;
            $('.tab-pane .container').removeClass('active');
            if (payment == 1) {
                $('input[name=current_tab_selection]').val('registration');
                wizard_registration()
            } else if (advising == 1) {
                $('input[name=current_tab_selection]').val('payment');
                wizard_payment();
            } else if (requirements == 1) {
                $('input[name=current_tab_selection]').val('advising');
                wizard_advising();
            } else if (student_information == 1) {
                $('input[name=current_tab_selection]').val('requirements');
                wizard_requirements();
            } else {
                $('input[name=current_tab_selection]').val('student_information');
                wizard_student_info();
            }
            var ose_guide1 = new OSE_Guide($('input[name=current_tab_selection]').val());
            ose_guide1.play();
        },
        error: function (response) { },
    });


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

    $("#li_registration").attr("class", "active");

    $("#tab_payment").attr("class", "wizard_li");
    $(".bi-cash-stack").addClass("wizard_li");
}

function tab_payment() {
    // $("#tab_payment").attr("class", "wizard_li");
    $("#tab_payment-circle").addClass("checked");

    $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
    // $("#tab_registration-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_payment").attr("data-toggle", "tab");
    $("#tab_advising").removeAttr("data-toggle");

    $("#li_payment").attr("class", "active");

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

}

function tab_requirements() {
    // $("#tab_requirements").attr("class", "wizard_li");
    $("#tab_requirements-circle").addClass("checked");
    // $("#tab_requirements-circle").addClass("checked");

    $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_requirements").attr("data-toggle", "tab");

    // $("#li_requirements").attr("class", "active");
    $("#tab_student_information").attr("class", "wizard_li");
    $(".bi-person-lines-fill").addClass("wizard_li");
}

function tab_student_information() {
    // $("#tab_student_information").attr("class", "wizard_li");
    $("#tab_student_information-circle").addClass("checked");

    $("#li_student_information").attr("class", "active");
}