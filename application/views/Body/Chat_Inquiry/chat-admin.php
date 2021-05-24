<script type="text/javascript" src="<?php echo base_url(''); ?>assets/js/timeago.js"></script>
<style>
    #chatinquiryModal .modal-dialog {
        max-width: 650px;
    }

    .chat {
        position: relative;
        width: 60%;
        min-height: 50px;
        border-radius: 10px;
        margin: 5px;
        padding: 10px;
        position: relative;
    }

    .chat-student {
        /* background:#3FD3B6; */
        color: black;
        float: left;
    }

    .chat-admin {
        /* background:#d4d4d4; */
        color: black;
        float: right;
    }

    .message-head {
        font-weight: bold;
        font-size: 18px;
        padding-left: 10px;
    }

    .message-time {
        padding-left: 10px;
        font-weight: 700;
        font-size: 14px;
    }

    .message-body {
        padding: 10px 10px 10px 20px;
        min-height: 50px;
        border-radius: 10px;
        width: 100%;
        white-space: -moz-pre-wrap !important;
        /* Mozilla, since 1999 */
        white-space: -webkit-pre-wrap;
        /* Chrome & Safari */
        white-space: -pre-wrap;
        /* Opera 4-6 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        white-space: pre-wrap;
        /* CSS3 */
        word-wrap: break-word;
        /* Internet Explorer 5.5+ */
        word-break: break-all;
        white-space: normal;
    }

    #someone-typing .message-body {
        min-height: 50px;
    }

    .chat-admin .message-body {
        background: #FF554D;
        color: white;
    }

    .chat-student .message-body {
        background: #d4d4d4;

    }

    /* #someone-typing{
    display:block;
} */
    #someone-typing .chat-student .message-body {
        background: white;

    }

    .chat-textarea {
        display: inline-block;
        width: 84%;
        float: left;
        min-height: 50px;
        max-height: 100px;
        border: 1px #d4d4d4 solid;
        padding: 10px;
        border-radius: 8px;
        white-space: -moz-pre-wrap !important;
        /* Mozilla, since 1999 */
        white-space: -webkit-pre-wrap;
        /* Chrome & Safari */
        white-space: -pre-wrap;
        /* Opera 4-6 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        white-space: pre-wrap;
        /* CSS3 */
        word-wrap: break-word;
        /* Internet Explorer 5.5+ */
        word-break: break-all;
        white-space: normal;
        overflow-y: auto;
    }

    span.chat-status {
        /* transform:translate(50%,50%); */
        bottom: 3px;
        right: -9px;
        position: absolute;
        color: black;
        /* padding-right:10px;
    padding-bottom:10px; */
    }

    /* .modal-dialog{
    position:relative;
} */
    /* #chat-box:last-child{
    border:2px solid red;
} */
    /* .chat:last-child{
    background:red;
} */
    /* .chat-card:last-child{
    border:1px solid red;
} */
</style>
<section class="section col-lg-12">
    <div class="card" style="margin:none;">
        <div class="card-header">
            <!-- <h4>Jhon Norman Fabregas</h4> -->
        </div>
        <div class="card-body">
            <div class="col-md-12 table-responsive">
                <table id="chatInquiryTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th width="15%">Total Messages</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getStudentInquiry as $inquiry_list) : ?>
                            <tr>
                                <td><?php echo $inquiry_list['First_Name'] . ' ' . $inquiry_list['Middle_Name'] . ' ' . $inquiry_list['Last_Name']; ?></td>
                                <td width="15%"><?php echo $inquiry_list['total_message']; ?></td>
                                <td width="15%"><button class="btn btn-info" onclick="openModal('<?php echo $inquiry_list['ref_no']; ?>','<?php echo $inquiry_list['First_Name'] . ' ' . $inquiry_list['Middle_Name'] . ' ' . $inquiry_list['Last_Name']; ?>')" data-bs-toggle="modal" data-bs-target="#chatinquiryModal">open</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

</section>
<div class="modal fade text-left w-100" id="chatinquiryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16"><img src="<?php echo base_url('assets/images/logo/sdcalogo.png') ?>" style="width:150px;height:auto;"> &nbsp;&nbsp;&nbsp;<font id="student-name">SDCA Inquiry</font>
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>

            </div>
            <div class="modal-body" style="position:relative;">
                <div class="col-md-12" id="chat-box" style="position:relative;">
                    <div id="chat-message"></div>
                    <!-- <div id="someone-typing"><img src="<?php echo base_url('assets/images/827.gif') ?>" style="width:50px;height:auto;"> </div> -->
                    <!-- <div class="col-md-12"><div class="chat-student chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div>
                    <div class="col-md-12"><div class="chat-admin chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div> -->
                </div>
            </div>
            <form id="inquiryForm">
                <div class="modal-footer">
                    <div id="someone-typing" class="col-md-12" align="center" style="display:none;"><img src="<?php echo base_url('assets/images/827.gif') ?>" style="width:50px;height:auto;"></div>
                    <div class="chat-textarea" contenteditable="true" id="chat-textarea"></div>
                    <!-- <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button> -->
                    <button class="btn btn-info" type="button">
                        <!-- <i class="bx bx-x d-block d-sm-none"></i> -->
                        <span class="d-none d-sm-block">Send</span>
                    </button>

                </div>
            </form>
        </div>

    </div>
</div>
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuidv4.min.js" integrity="sha512-BCMqEPl2dokU3T/EFba7jrfL4FxgY6ryUh4rRC9feZw4yWUslZ3Uf/lPZ5/5UlEjn4prlQTRfIPYQkDrLCZJXA==" crossorigin="anonymous"></script>
<script>
    // $('#chat-box:last-child').css('background','red');
    var typing_timeout = null;
    // var DURATION_IN_SECONDS = {
    //   epochs: ['year', 'month', 'day', 'hour', 'minute'],
    //   year: 31536000,
    //   month: 2592000,
    //   day: 86400,
    //   hour: 3600,
    //   minute: 60
    // };

    // function getDuration(seconds) {
    //   var epoch, interval;

    //   for (var i = 0; i < DURATION_IN_SECONDS.epochs.length; i++) {
    //     epoch = DURATION_IN_SECONDS.epochs[i];
    //     interval = Math.floor(seconds / DURATION_IN_SECONDS[epoch]);
    //     if (interval >= 1) {
    //       return {
    //         interval: interval,
    //         epoch: epoch
    //       };
    //     }
    //   }

    // };

    function timeSince(date) {
        //   date = date.replace(/T/g, " ");
        //   date = date.replace(/Z/g, "");
        var seconds = Math.floor((new Date() - new Date(date)) / 1000);
        var duration = getDuration(seconds);
        var suffix = (duration.interval > 1 || duration.interval === 0) ? 's' : '';
        return duration.interval + ' ' + duration.epoch + suffix;
    };
    var choose_ref = "";
    const socket = io('http://stdominiccollege.edu.ph:4003/');
    const app = feathers();
    app.configure(feathers.socketio(socket));
    var array_status = [];
    var status_running = false;

    $("time.timeago").timeago();
    // document.getElementById('form#inquiryForm').addEventListener('submit', sendInquiry);
    $('#inquiryForm button').on('click', function() {
        // alert('hello');
        if ($('#chat-textarea').html() != "") {
            const uuid = uuidv4();
            app.service('chat-inquiry').create({
                message: $('#chat-textarea').html(),
                ref_no: choose_ref,
                type: 'admin',
                return_id: uuid
            });
            sendMessage(uuid);
            $('#chat-textarea').html('');

        }
    })
    $('#chatinquiryModal').mouseover(function() {
        app.service('chat-inquiry').update(choose_ref, {
            type: 'admin',
        });
        // updateToSeen();
    })
    $('#chat-textarea').on('keydown', function(e) {

        if (e.keyCode == 13) {
            e.preventDefault();
            if ($('#chat-textarea').html() != "") {
                const uuid = uuidv4();
                app.service('chat-inquiry').create({
                    message: $('#chat-textarea').html(),
                    ref_no: choose_ref,
                    type: 'admin',
                    return_id: uuid
                });
                sendMessage(uuid);
                $('#chat-textarea').html('');
                // document.getElementById('chat-box').scrollTo(0,document.getElementById('chat-box').scrollHeight);
                // $('.chat-card:last-child').focus();

            }
        } else {
            app.service('chat-action').create({
                ref_no: choose_ref,
                type: 'admin'
            });
        }
    })

    function sendMessage(id) {
        var current_time = moment().format('MMM DD,YYYY h:kk a');
        document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML +
            `<div class="col-md-12 chat-card" tab-index="1" id="${id}"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</div><div class="message-body">${$('#chat-textarea').html()}<span class="chat-status"><i id="${id}_icon" class="bi bi-circle not-sent"></i></span></div></div></div>`;
    }

    function renderIdea(data) {
        var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
        // +`(${moment(Date.parse(data.date_created)).fromNow()})`;
        // current_time = timeSince(current_time)
        if (data.user_type == "student") {
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML +
                `<div class="col-md-12 chat-card" tab-index="1"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
        } else {
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML +
                `<div class="col-md-12 chat-card"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</time></div><div class="message-body">${data.message}${data.status=="seen"?'<span class="chat-status"><i class="bi bi-check2-all"></i></span>':'<span class="chat-status sent"><i class="bi"></i></span>'}</div></div></div>`;

        }
        // }

    }

    // $(document). bind("contextmenu",function(e){ return false; });
    async function getInquiryTableList(data) {
        // console.log(data.First_Name)
        $('#chatInquiryTable tbody').empty();
        var html = "";
        $.each(data, function(index, val) {
            html += `<tr><td>${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}</td>`;
            html += `<td>${val.total_message}</td>`;
            html += `<td><button class="btn btn-info" onclick="openModal('${val.ref_no}','${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}')" data-bs-toggle="modal" data-bs-target="#chatinquiryModal">open</button></td></tr>`;
        })
        $('#chatInquiryTable tbody').append(html);
    }

    function updateToSeen(data) {
        console.log(data)
        if (data.ref_no == choose_ref) {
            if (data.type == "student") {
                $('.sent').each(function() {
                    $(this).removeClass("sent");
                    $(this).removeClass("bi-circle");
                    $(this).removeClass("bi-check-circle");
                    $(this).addClass("bi-check2-all");
                })
            }
        }
    }

    function setStatus() {
        status_running = true;
        array_status.map(value => {
            var x = document.getElementById(`${value}_icon`);
            x.classList.remove("bi-circle")
            x.classList.remove("not-sent")
            x.classList.add("bi-check-circle")
            x.classList.add("sent")
            array_status = array_status.filter(this_value => {
                return this_value != value
            });
        })
        status_running = false;
    }
    window.setInterval(() => {
        if (status_running == false) {
            setStatus()
        }
    }, 2000);

    function receivedMessage(data) {
        // console.log(data.message_count);
        getInquiryTableList(data.message_count);
        var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
        // +`(${moment(Date.parse(data.date_created)).fromNow()})`;
        // current_time = timeSince(current_time)
        if (data.user_type == "student") {
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML +
                `<div class="col-md-12 chat-card" tab-index="1"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
        } else {
            array_status.push(data.return_id);
            // document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
            //     +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</time></div><div class="message-body">${data.message}</div></div></div>`;

        }
        $('#chatinquiryModal .modal-body').animate({
            scrollTop: 100000000000000000000000000000000
        }, 'slow');
        // }
        // getInquiryList();

    }
    async function typing(data) {
        console.log(data)
        if (choose_ref == data.ref_no) {
            if (data.type == 'student') {
                $('#someone-typing').show();
                // $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
                if (typing_timeout != null) {
                    clearTimeout(typing_timeout)
                }
                typing_timeout = setTimeout(function() {
                    typing_timeout = null;
                    $('#someone-typing').hide();
                }, 500)
            }
        }
    }

    async function someone_typing() {
        app.service('chat-action').on('created', typing);
    }
    async function init(ref) {
        // Find ideas
        const ideas = await app.service('chat-inquiry').get({
            ref_no: ref
        });

        console.log(ideas);
        ideas.forEach(renderIdea);

    }

    function openModal(ref, name) {
        choose_ref = ref;
        $('#student-name').text(name);
        $("#chat-message").empty();
        init(ref);
        someone_typing();
        // setTimeout(function(){
        $('#chatinquiryModal .modal-body').animate({
            scrollTop: 100000000000000000000000000000000
        }, 'slow');
        // },1000)
    }
    app.service('chat-inquiry').on('created', receivedMessage);
    app.service('chat-inquiry').on('updated', updateToSeen);
    // getInquiryList();
</script>