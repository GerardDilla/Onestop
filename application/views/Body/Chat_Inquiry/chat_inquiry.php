<style>
#chatinquiryModal .modal-dialog{
    max-width: 650px;
}
.chat{
    width:60%;
    min-height:100px;
    border-radius:10px;
    margin:5px;
    padding:10px;
}
.chat-student{
    /* background:#3FD3B6; */
    color:black;
    float:right;
}
.chat-admin{
    /* background:#d4d4d4; */
    color:black;
    float:left;
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
    min-height:100px;
    border-radius:10px;
    width:100%;
}
.chat-admin .message-body{
    background:#d4d4d4;
}
.chat-student .message-body{
    background:#3FD3B6;
    
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
/* #chat-box:last-child{
    border:2px solid red;
} */
</style>
<span class="chat-logo" data-bs-toggle="modal" data-bs-target="#chatinquiryModal"><i class="bi bi-chat-text"></i></span>
<div class="modal fade text-left w-100" id="chatinquiryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16"><img src="<?php echo base_url('assets/images/logo/sdcalogo.png')?>" style="width:150px;height:auto;"> &nbsp;&nbsp;&nbsp;SDCA Inquiry</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>

            </div>
            <div class="modal-body">
                <div class="col-md-12" id="chat-box">
                    <!-- <div class="col-md-12"><div class="chat-student chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div>
                    <div class="col-md-12"><div class="chat-admin chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div> -->
                </div>
            </div>
            <form id="inquiryForm">
            <div class="modal-footer">
                <!-- <textarea></textarea> -->
                
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
$('#chat-box:last-child').css('background','red');
const socket = io('http://localhost:4003');
const app = feathers();
app.configure(feathers.socketio(socket));

// document.getElementById('form#inquiryForm').addEventListener('submit', sendInquiry);
$('#inquiryForm button').on('click',function(){
    // alert('hello');
    if($('#chat-textarea').html()!=""){
        app.service('chat-inquiry').create({
            message:$('#chat-textarea').html(),
            ref_no:'<?php echo $this->session->userdata('reference_no'); ?>'
        });
        $('#chat-textarea').html('');
    }
})
$('#chat-textarea').on('keydown',function(e){
    
    if(e.keyCode==13){
        e.preventDefault();
        if($('#chat-textarea').html()!=""){
            app.service('chat-inquiry').create({
                message:$('#chat-textarea').html(),
                ref_no:'<?php echo $this->session->userdata('reference_no'); ?>'
            });
            $('#chat-textarea').html('');
        }
    }
})
function renderIdea(data) {
    console.log(data);
        document.getElementById('chat-box').innerHTML = document.getElementById('chat-box').innerHTML
        +`<div class="col-md-12"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${data.date_created}</div><div class="message-body">${data.message}</div></div></div>`;
      }
async function init() {
// Find ideas
const ideas = await app.service('chat-inquiry').find();

console.log(ideas);
ideas.forEach(renderIdea);
app.service('chat-inquiry').on('created', renderIdea);
}

init();
</script>