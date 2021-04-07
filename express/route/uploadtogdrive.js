
"use strict";
// const { Router } = require("express");
const fs = require('fs');
const readline = require('readline');
const { google } = require('googleapis'); //googleapis not supported module type of export
const express = require("express");
const otherasync = require("async");
let router = express.Router();
const {getQuery} = require('../query/main.js');
var id_number;
const multer = require('multer');
const { pathToFileURL } = require('url');

const storage = multer.diskStorage({
    destination: (req,res,cb) => {
        cb(null,`${__dirname}/assets/`);
    },
    filename:(req,file,cb) => {
        // cb(null,file.fil)
        const {originalname} = file;
        cb(null,file.fieldname+'-'+Date.now()+path.extname(file.originalname))
    }
})
const upload = multer({storage: storage});

router.post('/',(req,res)=>{
    // req.session.id_number = "";
    var data_body = req.body.data;
    var folder_name = req.body.folder_name;
    // var folder_name = "requirements";
    const SCOPES = ['https://www.googleapis.com/auth/drive'];
  // The file token.json stores the user's access and refresh tokens, and is
  // created automatically when the authorization flow completes for the first
  // time.
  const TOKEN_PATH = 'token.json';
    function sendBackToPHP(pass_id){
        // res.send({
        //     status'success',
        //     id:pass_id
        // })
        res.send(pass_id);
        // res.json({
        //     status:'success',
        //     id:pass_id
        // })
    }
  // Load client secrets from a local file.
  fs.readFile('credentials.json', (err, content) => {
      if (err) return console.log('Error loading client secret file:', err);
    //   authorize(JSON.parse(content), createFolder);

        // code use to check for adding folder uploading of files   
      authorize(JSON.parse(content), checkFiles);
      
    //   authorize(JSON.parse(content), insertFileInFolder);
      // authorize(JSON.parse(content), searchFor);
      // authorize(JSON.parse(content), getFile);
      // authorize(JSON.parse(content), uploadFile);
  });

  /**
   * Create an OAuth2 client with the given credentials, and then execute the
   * given callback function.
   * @param {Object} credentials The authorization client credentials.
   * @param {function} callback The callback to call with the authorized client.
   */
  function authorize(credentials, callback) {
      const { client_secret, client_id, redirect_uris } = credentials.installed;
      const oAuth2Client = new google.auth.OAuth2(
          client_id, client_secret, redirect_uris[0]);

      // Check if we have previously stored a token.
      fs.readFile(TOKEN_PATH, (err, token) => {
          if (err) return getAccessToken(oAuth2Client, callback);
          oAuth2Client.setCredentials(JSON.parse(token));

          callback(oAuth2Client);//list files and upload file
          // createFolder(oAuth2Client);
          //callback(oAuth2Client, '0B79LZPgLDaqESF9HV2V3YzYySkE');//get file

      });
  }

  /**
   * Get and store new token after prompting for user authorization, and then
   * execute the given callback with the authorized OAuth2 client.
   * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
   * @param {getEventsCallback} callback The callback for the authorized client.
   */
  function getAccessToken(oAuth2Client, callback) {
      const authUrl = oAuth2Client.generateAuthUrl({
          access_type: 'offline',
          scope: SCOPES,
      });
      console.log('Authorize this app by visiting this url:', authUrl);
      const rl = readline.createInterface({
          input: process.stdin,
          output: process.stdout,
      });
      rl.question('Enter the code from that page here: ', (code) => {
          rl.close();
          oAuth2Client.getToken(code, (err, token) => {
              if (err) return console.error('Error retrieving access token', err);
              oAuth2Client.setCredentials(token);
              // Store the token to disk for later program executions
              fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
                  if (err) return console.error(err);
                  console.log('Token stored to', TOKEN_PATH);
              });
              callback(oAuth2Client);
          });
      });
  }

  /**
   * Lists the names and IDs of up to 10 files.
   * @param {google.auth.OAuth2} auth An authorized OAuth2 client.
   */

  function listFiles(auth) {
      const drive = google.drive({ version: 'v3', auth });
      getList(drive, '');
  }
  function getList(drive, pageToken) {
      drive.files.list({
          corpora: 'user',
          pageSize: 10,
          //q: "name='elvis233424234'",
          pageToken: pageToken ? pageToken : '',
          fields: 'nextPageToken, files(*)',
      }, (err, res) => {
          if (err) return console.log('The API returned an error: ' + err);
          const files = res.data.files;
          // console.log(files);
          var count = 0;
          for(count;count<files.length;count++){
            console.log(files[count].name);
          }
          // console.log(files[0]);
          if (files.length) {
              console.log('Files:');
              // processList(files);
              // if (res.data.nextPageToken) {
              //     getList(drive, res.data.nextPageToken);
              // }

          } else {
              console.log('No files found.');
          }
      });
  }
  function processList(files) {
    console.log('Processing....');
    files.forEach(file => {
        // console.log(file.name + '|' + file.size + '|' + file.createdTime + '|' + file.modifiedTime);
        console.log(file);
    });
    }
  async function checkFiles(auth) {
    const drive = google.drive({ version: 'v3', auth });
    searchFiles(drive, '',auth);
  }
   async function searchFiles(drive, pageToken,auth) {
    drive.files.list({
        corpora: 'user',
        // pageSize: 10,
        q: "mimeType: 'application/vnd.google-apps.folder'",
        pageToken: pageToken ? pageToken : '',
        fields: 'nextPageToken, files(id,name)',
    }, (err, res) => {
        if (err) return console.log('The API returned an error: ' + err);
        const files = res.data.files;
        const found = files.find(element => element.name == folder_name );
        console.log(found)
        // If this folder is not existed it will create a folder for student
        if(found==null){
            // add files into folder
            createFolder(auth).then(result => {
                data_body.forEach(item => {
                    insertFileInFolder(auth,result,item.name,item.type)
                })
                sendBackToPHP(result);
            });
            
            
        }
        else{
            // console.log(found.id)
            var current_id = found.id;
            data_body.forEach(item => {
                insertFileInFolder(auth,current_id,item.name,item.type)
            })
            sendBackToPHP(found.id);
            console.log("folder is existed");
        }
        var list = []
        if (files.length) {
          
        } else {
            console.log('No files found.');
        }
    });
  }
  function jsonReader(filePath,cb){
      fs.readFile(filePath,'utf-8',(err,fileData) => {
          if(err){
            return cb && cb(err);
          }
          try{
              const object = JSON.parse(fileData);
              return cb && cb(null,object)
          }catch(err){
              return cb && cb(err)
          }
      })
  }
  async function createFolder(auth){
    const drive = google.drive({ version: 'v3', auth});
    var this_is_id = '1pqk-GASi0205D9Y8QEi0zGNrEdH8nmap';
    var fileMetadata = {
      'name': folder_name,
      'mimeType': 'application/vnd.google-apps.folder',
      parents: [this_is_id]
    };
    var pageToken = null;
    const create_folder = await new Promise(function(resolve,reject){
        drive.files.create({
            resource: fileMetadata,
            fields: 'id'
        }, function (err, file) {
        if (err) {
            resolve(err)
        } else {
            resolve(file.data.id)
        }
        });
    }).then(function(result){
        return result;
    })
    return create_folder;
  }
  function insertFileInFolder(auth,folder_id,filename,filetype){
    const drive = google.drive({ version: 'v3', auth });
    var folderId = folder_id;
    var fileMetadata = {
      'name': filename,
      parents: [folderId]
    };
    var media = {
      mimeType: filetype,
      body: fs.createReadStream(`assets/${filename}`)
    };
    drive.files.create({
      resource: fileMetadata,
      media: media,
      fields: 'id'
    }, function (err, file) {
      if (err) {
        // Handle error
        console.error(err);
      } else {
        console.log('File Id: ', file.id);
      }
    });
  }
//   res.send("success");
});

router.get("/generateToken",(req,res) => {
    
  const TOKEN_PATH = 'token.json';
  const SCOPES = ['https://www.googleapis.com/auth/drive'];
  // Load client secrets from a local file.
  fs.readFile('credentials.json', (err, content) => {
      if (err) return console.log('Error loading client secret file:', err);
    //   authorize(JSON.parse(content), createFolder);

        // code use to check for adding folder uploading of files   
      authorize(JSON.parse(content), checkFiles);
      
    //   authorize(JSON.parse(content), insertFileInFolder);
      // authorize(JSON.parse(content), searchFor);
      // authorize(JSON.parse(content), getFile);
      // authorize(JSON.parse(content), uploadFile);
  });
  
  /**
   * Create an OAuth2 client with the given credentials, and then execute the
   * given callback function.
   * @param {Object} credentials The authorization client credentials.
   * @param {function} callback The callback to call with the authorized client.
   */
  function checkFiles(auth){
    console.log('Success')
  }
  function authorize(credentials, callback) {
      const { client_secret, client_id, redirect_uris } = credentials.installed;
      const oAuth2Client = new google.auth.OAuth2(
          client_id, client_secret, redirect_uris[0]);

      // Check if we have previously stored a token.
      fs.readFile(TOKEN_PATH, (err, token) => {
          if (err) return getAccessToken(oAuth2Client, callback);
          oAuth2Client.setCredentials(JSON.parse(token));

          callback(oAuth2Client);//list files and upload file
          // createFolder(oAuth2Client);
          //callback(oAuth2Client, '0B79LZPgLDaqESF9HV2V3YzYySkE');//get file

      });
  }

  /**
   * Get and store new token after prompting for user authorization, and then
   * execute the given callback with the authorized OAuth2 client.
   * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
   * @param {getEventsCallback} callback The callback for the authorized client.
   */
  function getAccessToken(oAuth2Client, callback) {
      const authUrl = oAuth2Client.generateAuthUrl({
          access_type: 'offline',
          scope: SCOPES,
      });
      console.log('Authorize this app by visiting this url:', authUrl);
      const rl = readline.createInterface({
          input: process.stdin,
          output: process.stdout,
      });
      rl.question('Enter the code from that page here: ', (code) => {
          rl.close();
          oAuth2Client.getToken(code, (err, token) => {
              if (err) return console.error('Error retrieving access token', err);
              oAuth2Client.setCredentials(token);
              // Store the token to disk for later program executions
              fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
                  if (err) return console.error(err);
                  console.log('Token stored to', TOKEN_PATH);
              });
              callback(oAuth2Client);
          });
      });
  }
//   res.send("success")
})
router.get("/getjson",(req,res)=>{
    // res.json({

    // })
})
module.exports = router;
