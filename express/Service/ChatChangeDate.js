const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatChangeDate {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }
  async get(data) {
    // let MessageCountPerRefNoWithoutSearch = await this.cm.MessageCountPerRefNoWithoutSearch(data);
    let getMessageWithFilterDate = await this.cm.getMessageWithFilterDate(data);
    getMessageWithFilterDate = JSON.parse(JSON.stringify(getMessageWithFilterDate))

    const getTotalUnseenMessages = async(data) =>{
      // try{
      var messageData = await this.cm.getTotalUnseenMessages(data);
      messageData = JSON.parse(JSON.stringify(messageData))
      console.log(messageData[0].total_unseen)
      // return messageData[0]['total_unseen'];
      console.log(messageData[0]['total_unseen'])
      return messageData[0]['total_unseen'];
    }
    var count = 0;

    // getMessageWithFilterDate.forEach((item)=>{
    //   (async()=>{
    //     var messageData = await this.cm.getTotalUnseenMessages(data);
    //     messageData = JSON.parse(JSON.stringify(messageData))
    //     messageData.map((item)=>{
    //       item.total_unseen = messageData[0]['total_unseen']==undefined?0:messageData[0]['total_unseen'];
    //     })
    //   })()
    //   ++count;
      
    // })
    console.log(data)
    getMessageWithFilterDate.map((item)=>{
      (async()=>{
        var messageData = await this.cm.getTotalUnseenMessages(item);
        messageData = JSON.parse(JSON.stringify(messageData))
        var findData = messageData.find((value)=>{return value.ref_no==item.ref_no})
        item.total_unseen = findData.total_unseen
        console.log(item.total_unseen)
      })
      return item
    });
    // console.log(getMessageWithFilterDate)
    // var filteredByDate = MessageCountPerRefNoWithoutSearch.filter((item)=>{
    //   return Date.parse(data.search_from) >= Date.parse(item.date_created)&&Date.parse(data.search_to) < Date.parse(item.date_created)
    // })
    // try{
    // console.log(getMessageWithFilterDate)
    // return getMessageWithFilterDate;
    // }
    // catch(err){
    //   console.log(err)
    // }
    return getMessageWithFilterDate;
  }
  
}
module.exports = ChatChangeDate