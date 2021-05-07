searchVisible = 0;
transparent = true;
$(document).ready(function() {
    // registration = ;
    // advising = response.advising;
    // student_information = response.student_information;
    // alert(registration);
    // tracker_condition();
    tracker_status = $('#assesment_hidden').data('status');
    registration = 0;
    advising = 0;
    student_information = 0;
    if (tracker_status == 'registration') {
        registration = 1;
    } else if (tracker_status == 'advising') {
        advising = 1;
    } else if (tracker_status == 'student_information') {
        student_information = 1;
    } else {

    }
    tracker_condition();

    // fetch_user_status();

    // function fetch_user_status() {
    //     base_url = $("#assessment_section").data("baseurl");
    //     $("tab_registration").removeAttr("class");
    //     $("tab_advising").removeAttr("class");
    //     $("tab_student_information").removeAttr("class");
    //     $.ajax({
    //         url: base_url + "main/wizard_tracker_status/",
    //         dataType: "json",
    //         success: function(response) {
    //             // alert(response);
    //             // result = JSON.parse(response);
    //             registration = response.registration;
    //             advising = response.advising;
    //             student_information = response.student_information;
    //             // alert(registration);
    //             tracker_condition();
    //         },
    //         error: function(response) {},
    //     });
    // }

    function tracker_condition() {
        if (registration == 1) {
            tab_tab_payment();
            tab_registration();
            tab_advising();
            tab_student_information();
            $("#progress_bar").css("width", "85.5%");
            $("#payment").addClass("active");
            $("#tab_payment").attr("class", "active");
            $("#tab_payment_content").addClass("active");
        } else if (advising == 1) {
            tab_registration();
            tab_advising();
            tab_student_information();
            $("#progress_bar").css("width", "62.5%");
            $("#registration").addClass("active");
            $("#tab_registration").attr("class", "active");
            $("#tab_registration_content").addClass("active");
        } else if (student_information == 1) {
            tab_advising();
            tab_student_information();
            $("#progress_bar").css("width", "37.5%");
            $("#advising").addClass("active");
            $("#tab_advising").attr("class", "active");
            $("#tab_advising_content").addClass("active");
        } else {
            tab_student_information();
            $("#progress_bar").css("width", "12.5%");
            $("#student_information").addClass("active");
            $("#tab_student_information").attr("class", "active");
            $("#student_information_content").addClass("active");
        }
    }

    function tab_tab_payment() {
        // $("#tab_payment").attr("class", "active");
        $("#tab_payment-circle").addClass("checked");
        // $("#tab_payment-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
        $("#tab_registration-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
        $("#tab_payment-circle").addClass("wizard_tab_done");

    }

    function tab_registration() {
        // $("#tab_registration").attr("class", "active");
        $("#tab_registration-circle").addClass("checked");
        $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
        $("#tab_registration-circle").addClass("wizard_tab_done");
        // $("#tab_advising-circle").addClass("wizard_tab_done");

    }

    function tab_advising() {
        // $("#tab_advising").attr("class", "active");
        $("#tab_advising-circle").addClass("checked");
        $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
        $("#tab_advising-circle").addClass("wizard_tab_done");
        // $("#tab_student_information-circle").addClass("wizard_tab_done");

    }

    function tab_student_information() {
        // $("#tab_student_information").attr("class", "active");
        $("#tab_student_information-circle").addClass("checked");
        $("#tab_student_information-circle").addClass("wizard_tab_done");

    }
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
            // Ginagamit para mag palit ng content
            // alert('clicked');
            var $valid = $('.wizard-card form').valid();
            if (!$valid) {
                return false;
            } else {
                return true;
            }
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
                // .addClass("checked");
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
                tab_tab_payment();
                tab_registration();
                tab_advising();
                tab_student_information();
                $("#progress_bar").css("width", "85.5%");
                // $("#payment").addClass("active");
                $("#registration").addClass("active");
            } else if (advising == 1) {
                tab_registration();
                tab_advising();
                tab_student_information();
                // alert('test');
                $("#progress_bar").css("width", "62.5%");
                $("#payment").addClass("active");
            } else if (student_information == 1) {
                tab_advising();
                tab_student_information();
                init_sectionlist();
                $("#progress_bar").css("width", "37.5%");
                $("#advising").addClass("active");
            } else {
                tab_student_information();
                $("#progress_bar").css("width", "12.5%");
                $("#student_information").addClass("active");
            }

        },
        error: function(response) {},
    });


}

function tab_tab_payment() {
    $("#tab_payment").attr("class", "active");
    $("#tab_payment-circle").addClass("checked");
    // $("#tab_payment-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
    $("#tab_registration-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");
}

function tab_registration() {
    $("#tab_registration").attr("class", "active");
    $("#tab_registration-circle").addClass("checked");
    $("#tab_advising-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

}

function tab_advising() {
    $("#tab_advising").attr("class", "active");
    $("#tab_advising-circle").addClass("checked");
    $("#tab_student_information-circle").append("<div class='success_check'><i class='bi bi-check'></i></div>");

}

function tab_student_information() {
    $("#tab_student_information").attr("class", "active");
    $("#tab_student_information-circle").addClass("checked");

}