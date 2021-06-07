const {Client,Server,UploadFilesCommand} = require("nextcloud-node-client");
const express = require("express");
let router = express.Router();
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
async function createFolder(name_folder){
    const folder = await client.createFolder(`/Student Requirements/${name_folder}`);
    console.log(folder);
}
async function getUrl(){
    const file = await client.getFile("/Photos/Coast.jpg");
    const url = await file.getUrl();
    console.log(url)
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
async function uploadFiles(){
    const files = [
        {
            sourceFileName: "./assets/Coast 1.jpg",
            targetFileName: "/Student Requirements/Jhon Norman Fabregas/Sample 1.jpg"
        },
        {
            sourceFileName: "./assets/Coast 2.jpg",
            targetFileName: "/Student Requirements/Jhon Norman Fabregas/Sample 2.jpg"
        },
        {
            sourceFileName: "./assets/Coast 3.jpg",
            targetFileName: "/Student Requirements/Jhon Norman Fabregas/Sample 3.jpg"
        }
    ];
    const uc = new UploadFilesCommand(client, { files });
    const process = await uc.execute();
    console.log(process)
}
router.get("/",(req,res)=>{  
    getUrl();
    res.send(client)
})
router.get("/get-quota",(req,res)=>{
    res.send(getQuota());
})
router.get("/delete-folder",(req,res)=>{
    deleteFolder('Jhon Norman Fabregas');
    res.send('success')
})
router.get("/create-folder",(req,res)=>{
    createFolder('Jhon Norman Fabregas');
    res.send('success');
})
router.get("/upload-files",(req,res)=>{
    uploadFiles();
    res.send("success")
})
module.exports = router;
