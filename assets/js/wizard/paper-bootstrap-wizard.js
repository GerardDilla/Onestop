searchVisible = 0;
transparent = true;
$(document).ready(function () {
	fetch_user_status();
	function fetch_user_status() {
		base_url = $("#assessment_section").data("baseurl");
		reference_number = "1";
		$("tab_registration").removeAttr("class");
		$("tab_advising").removeAttr("class");
		$("tab_student_information").removeAttr("class");
		$.ajax({
			type: "POST",
			url: base_url + "main/wizard_tracker_status",
			data: {
				Reference_Number: reference_number,
			},
			success: function (response) {
				// alert(response);
				result = JSON.parse(response);
				registration = result.registration;
				advising = result.advising;
				student_information = result.student_information;
				// alert(registration);
				if (registration == 1) {
					$("#tab_registration").attr("class", "active");
					$("#tab_registration-circle").addClass("checked");
					$("#tab_advising").attr("class", "active");
					$("#tab_advising-circle").addClass("checked");
					$("#tab_student_information").attr("class", "active");
					$("#tab_student_information-circle").addClass("checked");
					$("#progress_bar").css("width", "62.5%");

					$("#registration").addClass("active");
					// alert('registration');
				} else if (advising == 1) {
					$("#tab_advising").attr("class", "active");
					$("#tab_advising-circle").addClass("checked");
					$("#tab_student_information").attr("class", "active");
					$("#tab_student_information-circle").addClass("checked");
					$("#progress_bar").css("width", "37.5%");

					$("#advising").addClass("active");
					// alert('advising');
				} else if (student_information == 1) {
					$("#tab_student_information").attr("class", "active");
					$("#tab_student_information-circle").addClass("checked");
					$("#progress_bar").css("width", "12.5%");

					$("#student_information").addClass("active");
					// alert("student_information");
				} else {
					tab_payment;
					// $("#tab_registration-circle").addClass("checked");
					$("#progress_bar").css("width", "87.5%");
					// alert('No Data Found');
				}
				
			},
			error: function (response) {},
		});
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

		onInit: function (tab, navigation, index) {
			//check number of tabs and fill the entire row
			var $total = navigation.find("li").length;
			$width = 100 / $total;

			navigation.find("li").css("width", $width + "%");
		},

		onTabClick: function (tab, navigation, index) {
			// alert('clicked');
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
