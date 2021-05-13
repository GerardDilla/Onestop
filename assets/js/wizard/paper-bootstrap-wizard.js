searchVisible = 0;
transparent = true;
$(document).ready(function() {

    $('.wizard-proceed').click(function() {

        // Event handler when proceeding to next step
        if ($('#advising_content').hasClass('active')) {
            console.log('ready to advise');
            // Came from advising.js
            init_advise();

        }
        $('.tab-content .tab-pane').removeClass('active');
        fetch_user_status();

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

function fetch_user_status() {
    base_url = $("#assessment_section").data("baseurl");
    // reference_number = "14174";
    $("tab_registration").removeAttr("class");
    $("tab_advising").removeAttr("class");
    $("tab_student_information").removeAttr("class");
    $.ajax({
        type: "POST",
        url: base_url + "main/wizard_tracker_status",
        success: function(response) {
            // alert(response);
            result = JSON.parse(response);
            registration = result.registration;
            advising = result.advising;
            student_information = result.student_information;
            // alert(registration);
            if (registration == 1) {
                tab_student_information();
                tab_advising();
                tab_payment();
                tab_registration();
                $("#progress_bar").css("width", "90%");
                // $("#payment").addClass("active");
                $("#registration_content").addClass("active");
                init_registrationform();
                $('.wizard-proceed').hide();
            } else if (advising == 1) {
                tab_student_information();
                tab_advising();
                tab_payment();

                // alert('test');
                $("#progress_bar").css("width", "70%");
                $("#payment_content").addClass("active");
            } else if (student_information == 1) {
                tab_student_information();
                tab_advising();
                init_sectionlist();
                $("#progress_bar").css("width", "50%");
                // $("#progress_bar").css("width", "62.5%");
                $("#advising_content").addClass("active");
                // $("#requirements").addClass("active");
            } else {
                tab_student_information();
                $("#progress_bar").css("width", "12.5%");
                $("#student_information_content").addClass("active");
            }

        },
        error: function(response) {},
    });


}

function tab_registration() {
    $("#tab_registration").attr("class", "active");
    $("#tab_registration-circle").addClass("checked");

    $("#tab_payment-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_requirements-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_registration").attr("data-toggle", "tab");
    $("#tab_payment").removeAttr("data-toggle");
}

function tab_payment() {
    $("#tab_payment").attr("class", "active");
    $("#tab_payment-circle").addClass("checked");

    $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
    // $("#tab_registration-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_payment").attr("data-toggle", "tab");
    $("#tab_advising").removeAttr("data-toggle");
}

function tab_advising() {
    $("#tab_advising").attr("class", "active");
    $("#tab_advising-circle").addClass("checked");
    $("#tab_requirements-circle").addClass("checked");

    $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    // $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

    $("#tab_requirements").attr("data-toggle", "tab");
    $("#tab_advising").attr("data-toggle", "tab");

}

function tab_student_information() {
    $("#tab_student_information").attr("class", "active");
    $("#tab_student_information-circle").addClass("checked");

}