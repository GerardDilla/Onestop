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
    position:relative;
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
    background:#FF554D;
    color:white;
    
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
span.chat-status{
    /* transform:translate(50%,50%); */
    bottom:3px;
    right:-9px;
    position:absolute;
    color:black;
    /* padding-right:10px;
    padding-bottom:10px; */
}
</style>
<!-- data-bs-toggle="modal" data-bs-target="#chatinquiryModal" -->
<?php 
// echo strtotime(date("Y-m-d H:i:s")) >= strtotime(date("Y-m-d 08:00:00")) && strtotime(date("Y-m-d H:i:s")) < strtotime(date("Y-m-d 17:00:00"))?' onclick="timeWarning()"':' data-bs-toggle="modal" data-bs-target="#chatinquiryModal"'; 
?>
<span class="chat-logo"  id="chat-logo" <?php 
if(strtotime(date("Y-m-d H:i:s")) >= strtotime(date("08:00:00")) && strtotime(date("Y-m-d H:i:s")) < strtotime(date("Y-m-d 17:00:00"))){
    echo ' data-bs-toggle="modal" data-bs-target="#chatinquiryModal"';
}
else{
    echo ' onclick="timeWarning()"';
}
?>>
<!-- <img src="<?php echo base_url('assets/images/inquiry-icon.png');?>"></span> -->
<i class="bi bi-chat-text"></i></span>
<!-- <span class="chat-logo"  id="chat-logo" data-bs-toggle="modal" data-bs-target="#chatinquiryModal"><i class="bi bi-chat-text"></i></span> -->
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
<input type="hidden" name="chat_reference_no" value="<?php echo $this->session->userdata('reference_no'); ?>">
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuidv4.min.js" integrity="sha512-BCMqEPl2dokU3T/EFba7jrfL4FxgY6ryUh4rRC9feZw4yWUslZ3Uf/lPZ5/5UlEjn4prlQTRfIPYQkDrLCZJXA==" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/pages/chat-inquiry.js');?>" crossorigin defer></script>
