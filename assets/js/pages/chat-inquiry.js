$('time.timeago').timeago();
var ref_no = $('input[name=chat_reference_no]').val();
var typing_timeout = null;
var modal_status = 0;
var connectionOptions =  {          
            "transports" : ["websocket"],
            forceNew: true,
            secure: false,
            requestCert: false,
            rejectUnauthorized: false
        };
const socket = io('http://localhost:4003');
// const socket = io('ws://stdominiccollege.edu.ph:4003/');
const app = feathers();
var array_status = [];
var status_running = false;
app.configure(feathers.socketio(socket));
$('#chatinquiryModal').on('hidden.bs.modal', function (e) {
    $('#chat-logo').show();
    modal_status = 0;
})
function timeWarning(){
    iziToast.show({
        theme: 'light',
        icon: 'bi-exclamation-diamond-fill',
        iconColor: '#cc0000',
        title: 'NOTICE:',
        message: 'SDCA Inquiry is only available from 8:00am to 5:00pm!',
        messageSize: '18',
        // messageLineHeight: '30',
        position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
        progressBarColor: '#cc0000',
        overlay:true,
        timeout:8000,
        buttons: [
            // ['<button>Ok</button>', function (instance, toast) {
            //     alert("Hello world!");
            // }, true],
            ['<button>Ok</button>', function (instance, toast) {
                instance.hide({
                    transitionOut: 'fadeOutUp',
                    onClosing: function(instance, toast, closedBy){
                        // console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                        $('#chat-logo').show();
                    }
                }, toast, 'buttonName');
            }]
        ],
        // onOpening: function(instance, toast){
        //     console.info('callback abriu!');
        // },
        onClosing: function(instance, toast, closedBy){
            $('#chat-logo').show(); // tells if it was closed by 'drag' or 'button'
        }
    });
}
$('#inquiryForm button').on('click',function(){
    if($('#chat-textarea').html()!=""){
        app.service('chat-inquiry').create({
            message:$('#chat-textarea').html(),
            ref_no:ref_no,
            type:'student'
        });
        sendMessage();
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
$('#chatinquiryModal').mouseover(function(){
    app.service('chat-inquiry').update(ref_no,{
        type:'student',
    });
    // updateToSeen();
})
$('#chat-logo').click(function(e){
    // e.preventDefault();
    modal_status = 1;
    $('#chat-logo').hide();
    
    // console.log('asdasd')
    // setTimeout(()=>{
        $('#chatinquiryModal .modal-body').animate({ scrollTop: 100000000000000000000000000000000 }, 'slow');
    // },1000)
    

})
$('#chat-textarea').on('keydown',function(e){
    if(e.keyCode==13){
        e.preventDefault();
        if($('#chat-textarea').html()!=""){
            const uuid = uuidv4();
            app.service('chat-inquiry').create({
                message:$('#chat-textarea').html(),
                ref_no:ref_no,
                type:'student',
                return_id:uuid
            });
            sendMessage(uuid);
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
function sendMessage(id){
    var current_time = moment().format('MMM DD,YYYY h:kk a');
    document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card" tab-index="1" id="${id}"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${$('#chat-textarea').html()}<span class="chat-status"><i id="${id}_icon" class="bi bi-circle not-sent"></i></span></div></div></div>`;
}
function renderIdea(all) {
    
    // if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        var render_count = 0;
        $.each(all,function(index,data){
            var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
            ++render_count;
            if(data.user_type=="student"){
            document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                +`<div class="col-md-12 chat-card"><div class="chat-student chat"><div class="message-head"></div><div class="message-time">${current_time}</div><div class="message-body">${data.message}${data.status=="seen"?'<span class="chat-status"><i id="" class="bi-check2-all"></i></span>':'<span class="chat-status sent"><i class="bi"></i></span>'}</div></div></div>`;
                if(render_count==1){
                    welcomeMessage();
                }
            }
            else{
                document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
                    +`<div class="col-md-12 chat-card"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time">${current_time}</div><div class="message-body">${data.message}</div></div></div>`;  
                    // bi bi-circle
                    // bi bi-check-circle
                    // bi bi-check2-all
            }
            
        })
        
    // }
}
// async function getInquiryTableList(data){
//     // console.log(data.First_Name)
//     $('#chatInquiryTable tbody').empty();
//     var html = "";
//     $.each(data,function(index,val){
//         html += `<tr><td>${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}</td>`;
//         html += `<td>${val.total_message}</td>`;
//         html += `<td><button class="btn btn-info" onclick="openModal('${val.ref_no}','${val.First_Name+' '+val.Middle_Name+' '+val.Last_Name}')" data-bs-toggle="modal" data-bs-target="#chatinquiryModal">open</button></td></tr>`; 
//     })
//     $('#chatInquiryTable tbody').append(html);
// }
function updateToSeen(data){
    if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        if(data.type=="admin"){
            $('.sent').each(function(){
                $(this).removeClass("sent");
                $(this).removeClass("bi-circle");
                $(this).removeClass("bi-check-circle");
                $(this).addClass("bi-check2-all");
            })
        }
    }
}
function setStatus(){
    status_running = true;
    array_status.map(value=>{
        var x = document.getElementById(`${value}_icon`);
        x.classList.remove("bi-circle")
        x.classList.remove("not-sent")
        x.classList.add("bi-check-circle")
        x.classList.add("sent")
        array_status = array_status.filter(this_value => { return this_value!=value });
    })
    status_running = false;
}
window.setInterval(()=>{
    if(status_running==false){
        setStatus()
    }
},2000);
function welcomeMessage(){
    var current_message = "Hi, how can I help you?";
    // setTimeout(()=>{
        document.getElementById('chat-message').innerHTML = document.getElementById('chat-message').innerHTML
            +`<div class="col-md-12 chat-card"><div class="chat-admin chat"><div class="message-head">SDCA ADMIN</div><div class="message-time"></time></div><div class="message-body">${current_message}</div></div></div>`;
    // },2000)
}
function receivedMessage(data) {
    
    // getInquiryTableList(data.total_message);
    console.log(data);
    var get_current_count = data.message_count.find(data=> data.ref_no=="<?php echo $this->session->userdata('reference_no');?>")
    var get
    // total_message
    var current_time = moment(Date.parse(data.date_created)).format('MMM DD,YYYY h:kk a');
    
    // if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        if(data.user_type=="student"){
            array_status.push(data.return_id);
            if(get_current_count.total_message==1){
                setTimeout(()=>{
                    welcomeMessage();
                },2000)
                
            }
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
            // $('#someone-typing').focus();\
            
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
async function init() {
// Find ideas
const ideas = await app.service('chat-inquiry').get({ref_no:"<?php echo $this->session->userdata('reference_no');?>"});
    renderIdea(ideas);
    app.service('chat-inquiry').on('created', receivedMessage);
    app.service('chat-inquiry').on('updated', updateToSeen);

}
someone_typing();
init();

function notifyIfSubmitted(data){
    // alert("hello");
    if(data.ref_no=="<?php echo $this->session->userdata('reference_no');?>"){
        
        iziToast.show({
            theme: 'light',
            icon: 'bi-emoji-laughing',
            iconColor: '#cc0000',
            title: '',
            message: 'Your payment has been successfully processed. Thank you for Paying!',
            // messageSize: '18',
            // messageLineHeight: '30',
            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: '#cc0000',
            // overlay:true,
            timeout:8000,
            buttons: [
                // ['<button>Ok</button>', function (instance, toast) {
                //     alert("Hello world!");
                // }, true],
                ['<button>Ok</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy){
                            // console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                            
                        }
                    }, toast, 'buttonName');
                }]
            ],
            onClosing: function(instance, toast, closedBy){
                
            }
        }); 
    }
}
app.service('notification').on('created', notifyIfSubmitted);