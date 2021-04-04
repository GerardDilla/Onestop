const bodyParser = require('body-parser');
const express = require('express');
const port = 4003;
const app = express();

const session = require("express-session")
const upload = require('express-fileupload');
const uploadToGdrive = require("./route/uploadtogdrive");
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));
app.use(upload())
app.get('/',(req,res)=>{
  res.send('welcome to homepage');
})
app.use(session({
  secret: 'secret-key',
  resave: false,
  saveUninitialized: false
}));
app.use("/uploadtodrive",uploadToGdrive);

app.listen(port,()=>console.log(`Running in Localhost:${port}`))
//Drive API, v3
//https://www.googleapis.com/auth/drive	See, edit, create, and delete all of your Google Drive files
//https://www.googleapis.com/auth/drive.file View and manage Google Drive files and folders that you have opened or created with this app
//https://www.googleapis.com/auth/drive.metadata.readonly View metadata for files in your Google Drive
//https://www.googleapis.com/auth/drive.photos.readonly View the photos, videos and albums in your Google Photos
//https://www.googleapis.com/auth/drive.readonly See and download all your Google Drive files
// If modifying these scopes, delete token.json.
