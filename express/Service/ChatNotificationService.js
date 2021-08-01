const { exists } = require('fs');
const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatNotificationService {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }
  async find() {
    var getMessageNotifications = await this.cm.getMessageNotifications();
    var TotalNotif = getMessageNotifications.length;
    // var getMessageNotifications = JSON.parse(JSON.stringify(getMessageNotifications))
    getMessageNotifications = Object.values(JSON.parse(JSON.stringify(getMessageNotifications)))
    // console.log(getMessageNotifications)
    var ChangeMessageValue = getMessageNotifications;
    // getMessageNotifications[0]['message'] = "";
    // console.log(getMessageNotifications);
    // return false;
    // console.log(getMessageNotifications)
    var count_m = 0;
    const lastMessage = async(ref_no) => {
        var last_message = await this.cm.getLastMessage({ref_no:ref_no});
        
        var last_message = JSON.parse(JSON.stringify(last_message))
        // console.log(last_message)
        return last_message[0]['message'];
    }
    
      getMessageNotifications.forEach((item)=>{
        (async()=>{
          ChangeMessageValue[0].message = "";
          ChangeMessageValue[0].message = await lastMessage(item.ref_no);
              ++count_m;
        })()
      })
    
    // console.log(getMessageNotifications);
    // return getMessageNotifications;
    return {
      notif:getMessageNotifications,
      notif_number:TotalNotif
    }
    // var filteredByDate = MessageCountPerRefNoWithoutSearch.filter((item)=>{
    //   return Date.parse(data.search_from) >= Date.parse(item.date_created)&&Date.parse(data.search_to) < Date.parse(item.date_created)
    // })
    // return MessageCountPerRefNoWithoutSearch;
  }
  
}
module.exports = ChatNotificationService