<script type="text/javascript" src="<?php echo base_url('');?>assets/js/timeago.js"></script>
<style>
#chatinquiryModal .modal-dialog{
    max-width: 650px;
}
.chat{
    width:60%;
    min-height:50px;
    border-radius:10px;
    margin:5px;
    padding:10px;
}
.chat-student{
    /* background:#3FD3B6; */
    color:black;
    float:left;
}
.chat-admin{
    /* background:#d4d4d4; */
    color:black;
    float:right;
}
.message-head{
    font-weight:bold;
    font-size:18px;
    padding-left:10px;
}
.message-time{
    padding-left:10px;
    font-weight:700;
    font-size:15px;
}

.message-body{
    padding:10px 10px 10px 20px;
    min-height:50px;
    border-radius:10px;
    width:100%;
}
#someone-typing .message-body{
    min-height:50px;
}
.chat-admin .message-body{
    background:#3FD3B6;
}
.chat-student .message-body{
    background:#d4d4d4;
    
}
/* #someone-typing{
    display:block;
} */
#someone-typing .chat-student .message-body{
    background:white;
    
}
.chat-textarea{
    display:inline-block;
    width:84%;
    float:left;
    min-height:50px;
    max-height:100px;
    border:1px #d4d4d4 solid;
    padding:10px;
    border-radius:8px;
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap;          /* Chrome & Safari */ 
    white-space: -pre-wrap;                 /* Opera 4-6 */
    white-space: -o-pre-wrap;               /* Opera 7 */
    white-space: pre-wrap;                  /* CSS3 */
    word-wrap: break-word;                  /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
    overflow-y:auto;
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th width="15%">Total Unseen Message</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getStudentInquiry as $inquiry_list):?>
                        <tr>
                            <td><?php echo $inquiry_list['First_Name'].' '.$inquiry_list['Middle_Name'].' '.$inquiry_list['Last_Name'];?></td>
                            <td width="15%"><?php echo $inquiry_list['total_message']; ?></td>
                            <td width="15%"><button class="btn btn-info" onclick="openModal('<?php echo $inquiry_list['ref_no'];?>','<?php echo $inquiry_list['First_Name'].' '.$inquiry_list['Middle_Name'].' '.$inquiry_list['Last_Name'];?>')" data-bs-toggle="modal" data-bs-target="#chatinquiryModal">open</button></td>
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
                <h4 class="modal-title" id="myModalLabel16"><img src="<?php echo base_url('assets/images/logo/sdcalogo.png')?>" style="width:150px;height:auto;"> &nbsp;&nbsp;&nbsp;<font id="student-name">SDCA Inquiry</font></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>

            </div>
            <div class="modal-body" style="position:relative;">
                <div class="col-md-12" id="chat-box" style="position:relative;">
                        <div id="chat-message"></div>
                        <!-- <div id="someone-typing"><img src="<?php echo base_url('assets/images/827.gif')?>" style="width:50px;height:auto;"> </div> -->
                    <!-- <div class="col-md-12"><div class="chat-student chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div>
                    <div class="col-md-12"><div class="chat-admin chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div> -->
                </div>
            </div>
            <form id="inquiryForm">
            <div class="modal-footer">
                <div id="someone-typing" class="col-md-12" align="center" style="display:none;"><img src="<?php echo base_url('assets/images/827.gif')?>" style="width:50px;height:auto;"></div>
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
const socket = io('http://localhost:4003');
const app = feathers();
app.configure(feathers.socketio(socket));

$("time.timeago").timeago();
// document.getElementById('form#inquiryForm').addEventListener('submit', sendInquiry);
$('#inquiryForm button').on('click',function(){
    // alert('hello');
    if($('#chat-textarea').html()!=""){
        app.service('chat-inquiry').create({
            message:$('#chat-textarea').html(),
            ref_no:'<?php echo $this->session->userdata('reference_no'); ?>',
            type:'admin'
        });
        $('#chat-textarea').html('');
        // $('.chat-card:last-child').focus();
    }
})
$('#chat-textarea').on('keydown',function(e){
    
    if(e.keyCode==13){
        e.preventDefault();
        if($('#chat-textarea').html()!=""){
            app.service('chat-inquiry').create({
                message:$('#chat-textarea').html(),
                ref_no:choose_ref,
                type:'admin'
            });
            $('#chat-textarea').html('');
            // document.getElementById('chat-box').scrollTo(0,document.getElementById('chat-box').scrollHeight);
            // $('.chat-card:last-child').focus();
            
        }
    }
    else{
        app.service('chat-action').create({
            ref_no:choose_ref,
            type:'admin'
        });
    }
})
function renderIdea(data) {
    console.log(data)
    var current_time = moment(Date.parse(data.date_created)).format('YYYY-MM-DD kk:mm:ss');
    // current_time = timeSince(current_time)
        if(data.user_type=="student"){
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
        }
        else{   
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
            
        }
    // }
    
}
function receivedMessage(data) 
{
    console.log(data)
    var current_time = moment(Date.parse(data.date_created)).format('YYYY-MM-DD kk:mm:ss');
    // current_time = timeSince(current_time)
    if(data.user_type=="student"){
        document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
            +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
    }
    else{   
        document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
            +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</time></div><div class="message-body">${data.message}</div></div></div>`;
        
    }
    $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
    // }
    
}
async function typing(data){
    if(choose_ref==data.ref_no){
        if(data.type=='student'){
            $('#someone-typing').show();
            // $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
            if(typing_timeout != null){
                clearTimeout(typing_timeout)
            }
            typing_timeout = setTimeout(function(){
                typing_timeout = null;
                $('#someone-typing').hide();
            },2000)
        }
    }
}
async function someone_typing(){
    app.service('chat-action').on('created', typing);
}   
async function init(ref) {
// Find ideas
const ideas = await app.service('chat-inquiry').get({ref_no:ref});

console.log(ideas);
    ideas.forEach(renderIdea);
    app.service('chat-inquiry').on('created', receivedMessage);
}
function openModal(ref,name){
    choose_ref = ref;
    $('#student-name').text(name);
    $("#chat-message").empty();
    init(ref);
    someone_typing();
    // setTimeout(function(){
        $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
    // },1000)
}


</script>