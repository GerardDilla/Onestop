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
                intro: 'This is the Student Information tab'
            },
            {
                element: document.querySelector('.intro-step-1'),
                intro: 'Click this button if you like to download your application summary. <strong>(not required)</strong>'
            }
            , {
                element: document.querySelector('#choose_your_status'),
                intro: 'Click this button and choose your status, Are you a NEW STUDENT or a TRANSFEREE?'
            }
            // ,{
            //     element:document.querySelector('#shsverification'),
            //     intro:'Click this button to download your application summary'
            // }
            , {
                element: document.querySelector('#confirm_your_course'),
                intro: 'Choose 1 of your Preferred COURSE and MAJOR'
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
                intro: 'This is the Requirements tab where you will upload all needed requirements.'
            },
            {
                element: document.querySelector(".requirement-1"),
                intro: 'Check this requirements if it is to be follow. <br><strong>NOTE: You can just check all the requirements as to be follow if you still dont have any requirements to submit.</strong.'
            },
            {
                element: document.querySelector(".are_you_married"),
                intro: "Are you married? if you are married you need to submit a PSA Marriage Certificate"
            },
            {
                element: document.querySelector(".interview-status"),
                intro: 'Do you want to be Interviewed? if you want it click Yes and if you dont click No'
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
                intro: 'Welcome to the Advising Tab!'
            },
            {
                element: document.querySelector('#choose_legend'),
                intro: 'Choose the School Year and Semester you want to be Advised'
            },
            {
                element: document.querySelector('#choose_subjects'),
                intro: 'Here is where you can see your Queued Subjects',
            },
            {
                element: document.querySelector('.addsubject-button'),
                intro: 'Click this to choose the subject you want to take.'
            },
            {
                element: document.querySelector('.viewsched-button'),
                intro: 'Once you made a Queue, you can view their schedules here'
            },
            {
                element: document.querySelector('.choose_payment_plan'),
                intro: 'Choose a payment plan, Is it INSTALLMENT or FULL PAYMENT?'
            },
            {
                element: document.querySelector('.fees-table'),
                intro: 'It will show your payment information. NOTE: The fees will show if the accounting already processed your enrollment request.'
            },
            {
                element: document.querySelector('.wizard-proceed-advising'),
                intro: ' If your are finished then click proceed.'
            }

        ]
    }
    payment() {
        return [
            {
                intro: "Here is the Assesment Form tab!"
            },
            {
                element: document.querySelector(".assessment-form"),
                intro: "Here is the OVER ALL Summary of your Assessment"
            },
            {
                element: document.querySelector(".paymentbullet"),
                intro: "Here is your Payment Options"
            },
            {
                element: document.querySelector(".online-payment"),
                intro: "You can pay via Online"
            },
            {
                element: document.querySelector(".over-the-counter"),
                intro: "Or pay over the counter"
            },
            {
                element: document.querySelector(".pay-at-sdca"),
                intro: "or else pay On our SDCA cashier"
            },
            {
                element: document.querySelector(".upload-proof"),
                intro: "You need to upload your proof of payment if you are already paid"
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
                intro: "Here is the summary of your enrollment, It shows your schedule and fees for this semester."
            }
            , {
                element: document.querySelector(".digital-citizenship"),
                intro: "You need to request for accounts like"
            }
            , {
                element: document.querySelector(".id-application"),
                intro: "Click this to request for your ID Application"
            }
            , {
                element: document.querySelector(".print-registration-form"),
                intro: "Click this to print a registration form."
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
