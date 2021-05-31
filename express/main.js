process.env.NODE_TLS_REJECT_UNAUTHORIZED = "0";
const feathers = require('@feathersjs/feathers');
const express = require('@feathersjs/express');
const socketio = require('@feathersjs/socketio');
const ChatService = require('./Service/ChatService');
const ChatActionService = require('./Service/ChatActionService');
const NotificationService = require('./Service/NotificationService');
const bodyParser = require('body-parser');
const uploadToGdrive = require("./route/uploadtogdrive");
const gdriveuploader = require("./route/gdrivelibrary");
const moment = require("moment")
const app = express(feathers());
const path = require("path");
const fs = require("fs");
const https = require("https");
const http = require("http");
const NodeRSA = require("node-rsa");
const pfxLoad = require("pfx-load");
const openssl = require("openssl")
// const loadPfx = new pfxLoad();

// const cert = loadPfx("cred/server.pfx");
// const obj = pfxLoad('cred/server.pfx')
// const proxy = require('redbird')({port: 80});
// proxy.register("localhost/api_ose", "http://10.0.0.81:4003");
const pem = require("pem");
const options = {
  pfx: fs.readFileSync('./cred/server.pfx'),
  passphrase: 'sdca'
};
const pfx = fs.readFileSync(__dirname + "/cred/server.pfx");
// pem.readPkcs12(pfx, { p12Password: "sdca" }, (err, cert) => {
//     console.log(cert);
// });

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
app.use('/chat-inquiry',new ChatService());
app.use('/chat-action',new ChatActionService());
app.use('/notification',new NotificationService());
app.use("/uploadtodrive",uploadToGdrive);
app.use("/gdriveuploader",gdriveuploader);

// const cors = require("cors");
// app.use(cors)

app.post("/api/NotifyIfSubmitted",(req,res)=>{
  console.log(req.body);
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

// app
//   .listen(PORT)
//   .on('listening', () =>
//     console.log(`Realtime server running on port ${PORT}`)
//   );
// const credentials = {
//   key: fs.readFileSync('cred/key.pem','utf8'),
//   cert: fs.readFileSync('cred/cert.pem','utf8')
// }
// var httpServer = http.createServer(app);
// var httpsServer = https.createServer(app);

// httpServer.listen(4003);
// httpsServer.listen(4003);
const domain_name = 'localhost'
// https.createServer(options, (req, res) => {
//   res.writeHead(200);
//   res.end(`LISTENING TO REAL TIME API https://${domain_name}:${PORT}`);
// }).listen(PORT);
// const RSAKey = cert.key;
// const key = new NodeRSA(RSAKey);
// const privateKey = key.exportKey("pkcs8");

// const sslServer = https.createServer({
//   pfx: fs.readFileSync('./cred/server.pfx'),
//   passphrase: 'sdca',
//   key: privateKey,
// },app)
const sslServer = https.createServer({
  key: fs.readFileSync(path.join(__dirname,'cred','server.key')),
  cert: fs.readFileSync(path.join(__dirname,'cred','server.crt')),
  rejectUnauthorized: false,
  requestCert: false
},app)
// pem.createCertificate({ days: 500, selfSigned: true }, function (err, keys) {
 
//   if (err) {
//     console.log(err)
//   }
//   // var app = express()
 
//   app.get('/', function (req, res) {
//     res.send('o hai!')
//   })
 
//   https.createServer({ key: keys.serviceKey, cert: keys.certificate }, app).listen(4003)
// })
app.setup(sslServer);
sslServer.listen(PORT, () => console.log(`LISTENING TO REAL TIME API https://${domain_name}:${PORT}`))

const httpServer = http.createServer(app);
const httpPort = 4004;
httpServer.listen(httpPort, () => console.log(`LISTENING TO REAL TIME API http://${domain_name}:${httpPort}`))


// const sslServer = https.createServer({
//   key: fs.readFileSync(path.join(__dirname,'cred','server.key')),
//   cert: fs.readFileSync(path.join(__dirname,'cred','server.crt')),
//   rejectUnauthorized: false,
//   requestCert: false
// },app)