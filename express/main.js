// process.env.NODE_TLS_REJECT_UNAUTHORIZED = "0";
const feathers = require('@feathersjs/feathers');
const express = require('@feathersjs/express');
const socketio = require('@feathersjs/socketio');
const ChatService = require('./Service/ChatService');
const ChatActionService = require('./Service/ChatActionService');
const NotificationService = require('./Service/NotificationService');
const bodyParser = require('body-parser');
const uploadToGdrive = require("./route/uploadtogdrive");
const gdriveuploader = require("./route/gdrivelibrary");
// const nextCloud = require("./route/NextCloud");
const moment = require("moment")
const app = express(feathers());
const path = require("path");
const fs = require("fs");
const https = require("https");
const http = require("http");
const ChatChangeDate = require('./Service/ChatChangeDate');
const ChatNotificationService = require('./Service/ChatNotificationService');
const ChatMessage = require('./Service/ConsultationLiveChat/ChatMessage');

app.use(express.json());
app.use(bodyParser.urlencoded({ extended: true }));
// app.use(cors);

app.configure(socketio());
// Enable REST services
app.configure(express.rest());
// Register services
// app.use(cors);
app.get("/", (req, res) => {
  res.send('Welcome to OSE API Date:' + moment().format('YYYY-MM-DD kk:mm:ss'))
});

// SDMC LIVE CHAT
app.use("/consultation-chat-message",new ChatMessage);

app.use('/chat-inquiry',new ChatService());
app.use('/chat-action',new ChatActionService());
app.use('/notification',new NotificationService());
app.use("/uploadtodrive",uploadToGdrive);
app.use("/gdriveuploader",gdriveuploader);
// app.use('/next-cloud',nextCloud); 
app.use('/chat-change-date',new ChatChangeDate);
app.use('/chat-notification',new ChatNotificationService);
// const cors = require("cors");
// app.use(cors)
app.post('/api/ConsultationMessage',(req,res)=>{
  app.service('consultation-chat-message').create({
    name: req.body.name,
    message: req.body.message,
    
  });
  res.send({
    name: req.body.name,
    message: req.body.message
  })
})
app.post("/api/NotifyIfSubmitted",(req,res)=>{
  app.service('notification').create({
    ref_no: req.body.ref_no,
    amount: req.body.amount
  });
  res.send('success');
});

// app.use('/',express.static(path.join(__dirname, '..',directoryToServe)))
app.on('connection', conn => app.channel('stream').join(conn));
// Publish events to stream
app.publish(data => app.channel('stream'));



const PORT = 4003;

app
  .listen(4004)
  .on('listening', () =>
    console.log(`Realtime server running on port ${4004}`)
  );
// const domain_name = 'localhost'
// const httpServer = http.createServer(app);
// const httpPort = 4004;
// httpServer.listen(httpPort, () => console.log(`LISTENING TO REAL TIME API http://${domain_name}:${httpPort}`))
// const sslServer = https.createServer({
//   key: fs.readFileSync(path.join(__dirname,'keys','0021_key-certbot.pem')),
//   cert: fs.readFileSync(path.join(__dirname,'cert','cert.pem'))
// },app)
// app.setup(sslServer);
// sslServer.listen(PORT, () => console.log(`LISTENING TO REAL TIME API https://${domain_name}:${PORT}`))
