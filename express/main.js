const feathers = require('@feathersjs/feathers');
const express = require('@feathersjs/express');
const socketio = require('@feathersjs/socketio');
const ChatService = require('./Service/ChatService');
const bodyParser = require('body-parser');
const uploadToGdrive = require("./route/uploadtogdrive");
const gdriveuploader = require("./route/gdrivelibrary");
const moment = require("moment")
const app = express(feathers());

app.use(express.json());
app.use(bodyParser.urlencoded({extended:true}));

app.configure(socketio());
// Enable REST services
app.configure(express.rest());
// Register services
app.get("/",(req,res)=>{
    res.send('Welcome to OSE API Date:'+moment().format('YYYY-MM-DD kk:mm:ss')) 
});
app.use('/chat-inquiry',new ChatService());
app.use("/uploadtodrive",uploadToGdrive);
app.use("/gdriveuploader",gdriveuploader);

app.on('connection', conn => app.channel('stream').join(conn));
// Publish events to stream
app.publish(data => app.channel('stream'));

const PORT = process.env.PORT || 4003;

app
  .listen(PORT)
  .on('listening', () =>
    console.log(`Realtime server running on port ${PORT}`)
  );