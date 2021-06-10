const {Client,Server,UploadFilesCommand} = require("nextcloud-node-client");
const express = require("express");
let router = express.Router();
const ApiError = require('../error/ApiError');
// const  = require("nextcloud-node-client");
// const client  = new Client();
const server = new Server(
{ basicAuth:
    { password: "7SjdDBEi70mjZfbz",
        username: "dbadmin",
    },
    url: "http://10.0.0.14/",
});
const client = new Client(server);
console.log(client)
async function getFile(){
    const file = await client.getFile("/Photos/Coast.jpg");
    const folder = await client.getFolder("/");
    const subfolders = await folder.getSubFolders();
    console.log(subfolders[1]['memento'])
}

async function getUrl(){
    const file = await client.getFile("/Photos/Coast.jpg");
    const url = await file.getUrl();
    console.log(url)
}
async function getFileUrl(file_name,folder_name,main_folder_id){
    return new Promise((resolve,reject)=>{
        (async () => {
            const file = await client.getFile(`/${main_folder_id}/${folder_name}/${file_name}`);
            const url = await file.getUrl();
            resolve(url)
        })().catch(e => reject(e));
    })
}
async function getFolderUrl(folder_name,main_folder_id){
    return new Promise((resolve,reject)=>{
        (async () => {
            const folder = await client.getFolder(`/${main_folder_id}/${folder_name}`);
            const url = await folder.getUrl();
            resolve(url)
        })().catch(e => reject(e));
    })
}
async function getQuota(){
    const q = await client.getQuota();
    console.log(q);
    return q;
}
async function deleteFolder(folder_name){
    const folder = await client.getFolder(`/Student Requirements/${folder_name}`);
    await folder.delete();
}
async function mergeFiles(data,folder_name,main_folder_name){
    var files1 = [];
    data.forEach(item =>{
        files1.push({
            sourceFileName: `./assets/${item.name}`,
            targetFileName: `/${main_folder_name}/${folder_name}/${item.name}`,
            })
    })
    return files1;
}
async function uploadFiles(data,folder_name,main_folder_name){
    return new Promise((resolve,reject)=>{
        (async () => {
            const files = await mergeFiles(data,folder_name,main_folder_name);
            const uc = new UploadFilesCommand(client, { files });
            const process = await uc.execute();
            resolve('success');
        })().catch(e => reject(e));
    })
    
}
async function getAllFilesInFolder(folder_name){
        const folder = await client.getFolder(`/Student Requirements/${folder_name}`);
        const files = await folder.getFiles();
        console.log(files);
        return files;
}
async function shareFolder(folder_name,main_folder_id){
    return new Promise((resolve,reject)=>{
        (async () => {
            const file = await client.getFolder(`/${main_folder_id}/${folder_name}`);
            // share the file (works also for folder)
            const createShare = { fileSystemElement: file };
            const share = await client.createShare(createShare);
            const shareLink = share.url;
            console.log(shareLink)
            resolve(shareLink)
        })().catch(e => reject(e));
    })
    // delete share, if not required anymore
    // await share.delete();
}
async function shareFileName(file_name,folder_name,main_folder_id){
    return new Promise((resolve,reject)=>{
        (async () => {
            const file = await client.getFile(`/${main_folder_id}/${folder_name}/${file_name}`);
            // share the file (works also for folder)
            const createShare = { fileSystemElement: file };
            const share = await client.createShare(createShare);
            const shareLink = share.url;
            console.log(shareLink)
            resolve(shareLink)
        })().catch(e => reject(e));
    })
}
async function createFolder(name_folder,main_folder_id){
    return new Promise((resolve,reject)=>{
        (async () => {
            const folder = await client.createFolder(`/${main_folder_id}/${name_folder}`);
        })().catch(e => reject(e));
    })
}
router.post("/",(req,res)=>{
    function sendBack(status,data){
        if(status==400){
            res.status(400).send(JSON.stringify(ApiError.badRequest(data)));
            return;
        }
        else{
            res.status(200).send(JSON.stringify({msg:'success',id:data}));
        }
        
    }
    var data_body = req.body.data;
    var folder_name = req.body.folder_name;
    var main_folder_id = req.body.folder_id;

    (async () => {
        createFolder(folder_name,main_folder_id).then(result=>{}).catch(error=>console.log(error));
        uploadFiles(data_body,folder_name,main_folder_id).then(result=>{
            if(result=="success"){
                shareFolder(folder_name,main_folder_id).then(result=>{sendBack(200,result)}).catch(error=>console.log(error));
            }
        }).catch(error=>console.log(error));
        
    })().catch(e => {console.log(e);sendBack(400,e);});
})
router.post("/get_id",(req,res)=>{
    const folder_name = req.body.folder_name;
    const file_name = req.body.file_name;
    const main_folder_id = req.body.folder_id;
    function sendBackToPHP(status,data){
        if(status==400){
            res.status(400).send(ApiError.badRequest(data));
            return;
        }
        else{
            res.status(200).send(JSON.stringify({msg:'success',id:data}));
        }
    }
    if(file_name==""){
        shareFolder(folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
    }
    else{
        shareFileName(file_name,folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
    }
})
router.post("/get_url",(req,res)=>{
    const folder_name = req.body.folder_name;
    const file_name = req.body.file_name;
    const main_folder_id = req.body.folder_id;
    function sendBackToPHP(status,data){
        if(status==400){
            res.status(400).send(ApiError.badRequest(data));
            return;
        }
        else{
            res.status(200).send(JSON.stringify({msg:'success',id:data}));
        }
    }
    if(file_name==""){
        getFolderUrl(folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
        // shareFolder(folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
    }
    else{
        getFileUrl(file_name,folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
        // shareFileName(file_name,folder_name,main_folder_id).then(result=>sendBackToPHP(200,result)).catch(error=>sendBackToPHP(400,error))
    }
})
// router.get("/get-quota",(req,res)=>{
//     res.send(getQuota());
// })
// router.get("/delete-folder",(req,res)=>{
//     deleteFolder('Jhon Norman Fabregas');
//     res.send('success')
// })
// router.get("/create-folder",(req,res)=>{
//     createFolder('Jhon Norman Fabregas');
//     res.send('success');
// })
// router.get("/upload-files",(req,res)=>{
//     uploadFiles();
//     res.send("success")
// })
module.exports = router;
