// student_information
// requirements
// advising
// payment
// registration
class OSE_Guide {
    constructor(tabs) {
        this.tabs = tabs;
        this.intro = introJs();
    }
    student_information() {
        return [
            {
                intro: 'This is the <strong>Student Information</strong> tab'
            },
            {
                element: document.querySelector('.your_information'),
                intro: 'This is your information'
            },
            {
                element: document.querySelector('.intro-step-1'),
                intro: 'Click this button if you like to download your application summary. <strong>(not required)</strong>'
            }
            , {
                element: document.querySelector('#choose_your_status'),
                intro: 'Click this button and choose your status, Are you a <strong>NEW STUDENT</strong> or a <strong>TRANSFEREE?</strong>'
            }
            // ,{
            //     element:document.querySelector('#shsverification'),
            //     intro:'Click this button to download your application summary'
            // }
            , {
                element: document.querySelector('#confirm_your_course'),
                intro: 'Choose 1 of your Preferred <strong>COURSE</strong> and <strong>MAJOR</strong>'
            }
            , {
                element: document.querySelector('.wizard-proceed-student_info'),
                intro: 'Click this button to submit your changes'
            }
        ]
    }
    requirements() {
        return [
            {
                intro: 'This is the <strong>Requirements tab</strong> where you will upload all needed requirements.'
            },
            {
                element: document.querySelector(".requirement-1"),
                intro: 'Check this requirements if it is to be follow. <br><strong>NOTE: You can just check all the requirements as to be follow if you still dont have any requirements to submit.</strong.'
            },
            {
                element: document.querySelector(".are_you_married"),
                intro: "Are you married? if you are married you need to submit a <strong>PSA Marriage Certificate</strong>"
            },
            {
                element: document.querySelector(".interview-status"),
                intro: 'Do you want to be Interviewed? if you want it click <strong>Yes</strong> and if you dont click <strong>No</strong>'
            },
            {
                element: document.querySelector("#submit_val_doc"),
                intro: 'Click this button to submit all your requirements!'
            }
        ]
    }
    advising() {
        return [
            {
                intro: 'This is the <strong>Advising Tab</strong>.'
            },
            {
                element: document.querySelector('#choose_legend'),
                intro: 'Choose the School Year and Semester you want to be Advised'
            },
            {
                element: document.querySelector('#choose_subjects'),
                intro: 'Here is the <strong>SUBJECT SECTION!</strong>',
            },
            {
                element: document.querySelector('.addsubject-button'),
                intro: 'Click this to choose the subject you want to take. <strong>NOTE: Only Old students are allowed to choose subjects that they want to take.</strong>'
            },
            {
                element: document.querySelector('.viewsched-button'),
                intro: 'Click this to view the <strong>Summary</strong> of your <strong>schedule</strong>.'
            },
            {
                element: document.querySelector('.choose_payment_plan'),
                intro: 'Choose a payment plan, Is it <strong>INSTALLMENT</strong> or <strong>FULL PAYMENT?</strong>'
            },
            {
                element: document.querySelector('.fees-table'),
                intro: 'It will show your payment information. <strong>NOTE: The fees will show if the accounting already processed your enrollment request.</strong>'
            },
            {
                element: document.querySelector('.wizard-proceed-advising'),
                intro: ' If you are finished then click proceed.'
            }

        ]
    }
    payment() {
        return [
            {
                intro: "Here is the <strong>Assesment Form tab</strong>!"
            },
            {
                element: document.querySelector(".assessment-form"),
                intro: "Here is the OVER ALL <strong>Summary of your Assessment</strong>"
            },
            {
                element: document.querySelector(".paymentbullet"),
                intro: "Here is your <strong>Payment Options</strong>"
            },
            {
                element: document.querySelector(".online-payment"),
                intro: "You can <strong>pay via Online</strong>"
            },
            {
                element: document.querySelector(".over-the-counter"),
                intro: "Or <strong>pay over the counter</strong>"
            },
            {
                element: document.querySelector(".pay-at-sdca"),
                intro: "or else <strong>pay On our SDCA cashier</strong>"
            },
            {
                element: document.querySelector(".upload-proof"),
                intro: "You need to upload your <strong>proof of payment</strong> if you are already paid"
            },
            {
                element: document.querySelector(".readvise_tab"),
                intro: "You can choose subjects again by clicking the <strong>CHOOSE AGAIN</strong> button"
            }

        ]
    }
    registration() {
        return [
            {
                intro: "<h5>You are now officially enrolled.</h5>"
            },
            {
                element: document.querySelector(".enrollment-summary"),
                intro: "Here is the <strong>Summary of your enrollment</strong>, It shows your <strong>schedule</strong> and <strong>fees</strong> for this semester."
            }
            , {
                element: document.querySelector(".digital-citizenship"),
                intro: ""
            }
            , {
                element: document.querySelector(".id-application"),
                intro: "Click this to request for your <strong>ID Application</strong>"
            }
            , {
                element: document.querySelector(".print-registration-form"),
                intro: "Click this to print a <strong>registration form.</strong>"
            }
        ]
    }
    play() {
        var steps = [];
        if (this.tabs == "student_information") {
            steps = this.student_information()
        }
        else if (this.tabs == "requirements") {
            steps = this.requirements()
        }
        else if (this.tabs == "advising") {
            steps = this.advising()
        }
        else if (this.tabs == "payment") {
            steps = this.payment()
        }
        else if (this.tabs == "registration") {
            steps = this.registration()
        }
        this.intro.setOptions({
            steps: steps
        })
        var current_this = this;
        this.intro.onbeforeexit(function () {
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
                    ['<button>Open Guide</button>', function (instance, toast) {
                        current_this.play();
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function (instance, toast, closedBy) {
                                // console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'

                            }
                        }, toast, 'buttonName');
                    }]
                ],
                onClosing: function (instance, toast, closedBy) {
                    console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                }
            });
        }).start();
    }
}
