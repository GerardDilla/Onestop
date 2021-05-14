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
    font-size:14px;
}
.message-body{
    padding:10px 10px 10px 20px;
    min-height:50px;
    border-radius:10px;
    width:100%;
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap;          /* Chrome & Safari */ 
    white-space: -pre-wrap;                 /* Opera 4-6 */
    white-space: -o-pre-wrap;               /* Opera 7 */
    white-space: pre-wrap;                  /* CSS3 */
    word-wrap: break-word;                  /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
}
.chat-admin .message-body{
    background:#d4d4d4;
}
.chat-student .message-body{
    background:#F54222;
    
}
#someone-typing .chat-admin .message-body{
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
#hidden-div{
    display:hidden;
}
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
<span class="chat-logo"  id="chat-logo" data-bs-toggle="modal" data-bs-target="#chatinquiryModal"><i class="bi bi-chat-text"></i></span>
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
                <div id="chat-message"></div>
                    <!-- <div class="col-md-12"><div class="chat-student chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div>
                    <div class="col-md-12"><div class="chat-admin chat"><div class="message-head">Jhon Norman Fabregas</div><div class="message-time">10:00 AM</div><div class="message-body">Hello</div></div></div> -->
                </div>
            </div>
            <form id="inquiryForm">
            <div class="modal-footer">
                <!-- <textarea></textarea> -->
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
$('time.timeago').timeago();
var typing_timeout = null;
const socket = io('http://localhost:4003');
const app = feathers();
app.configure(feathers.socketio(socket));

// document.getElementById('form#inquiryForm').addEventListener('submit', sendInquiry);
$('#inquiryForm button').on('click',function(){
    if($('#chat-textarea').html()!=""){
        app.service('chat-inquiry').create({
            message:$('#chat-textarea').html(),
            ref_no:'<?php echo $this->session->userdata('reference_no'); ?>',
            type:'student'
        });
        $('#chat-textarea').html('');
        // document.getElementById('chat-box').scrollTo(0,document.body.scrollHeight);
        var child_count = 0;
        if(typing_timeout != null){
            clearTimeout(typing_timeout)
            typing_timeout = null 
        }
        $('#someone-typing').hide();
        // $('.chat-card:last-child').focus();
        
    }
})
$('#chat-logo').click(function(){
    // console.log('asdasd')
    // setTimeout(()=>{
        $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
    // },1000)
    

})
$('#chat-textarea').on('keydown',function(e){
    if(e.keyCode==13){
        e.preventDefault();
        if($('#chat-textarea').html()!=""){
            app.service('chat-inquiry').create({
                message:$('#chat-textarea').html(),
                ref_no:'<?php echo $this->session->userdata('reference_no'); ?>',
                type:'student'
            });
            $('#chat-textarea').html('');

            if(typing_timeout != null){
                clearTimeout(typing_timeout)
                typing_timeout = null 
            }
            $('#someone-typing').hide();
            // $('.chat-card')[21].focus();
        }
    }
})
$('#chat-textarea').on('keyup',function(){
    app.service('chat-action').create({
        ref_no:"<?php echo $this->session->userdata('reference_no');?>",
        type:'student'
    });
})
function renderIdea(data) {
    var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
    // if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
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
async function getInquiryTableList(data){
    // console.log(data.First_Name)
    $('#chatInquiryTable tbody').empty();
    var html = "";
    $.each(data,function(index,val){
        html += `<tr><td>${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}</td>`;
        html += `<td>${val.total_message}</td>`;
        html += `<td><button class="btn btn-info" onclick="openModal('${val.ref_no}','${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}')" data-bs-toggle="modal" data-bs-target="#chatinquiryModal">open</button></td></tr>`; 
    })
    $('#chatInquiryTable tbody').append(html);
}
function receivedMessage(data) {
    getInquiryTableList(data.message_count);
    var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
    // if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        if(data.user_type=="student"){
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;
        }
        else{
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card" tab-index="1"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;  
        }
        $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
    // }
}
async function typing(data){
    // console.log(data.type)
    if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        if(data.type=="admin"){
            $('#someone-typing').show();
            // $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
            // $('#chat-box').animate({scrollTop:10000000},800);
            document.getElementById("chat-box").scrollTo(0,document.getElementById("chat-box").scrollHeight);
            // $('#someone-typing').focus();
            if(typing_timeout != null){
                clearTimeout(typing_timeout)
            }
            typing_timeout = setTimeout(function(){
                typing_timeout = null;
                $('#someone-typing').hide();
            },500)
        }
    }
}
async function someone_typing(){
    app.service('chat-action').on('created', typing);
}   
async function init(ref_no) {
// Find ideas
const ideas = await app.service('chat-inquiry').get({ref_no:"<?php echo $this->session->userdata('reference_no');?>"});
    ideas.forEach(renderIdea);
    app.service('chat-inquiry').on('created', receivedMessage);
}

someone_typing();
init();
</script>