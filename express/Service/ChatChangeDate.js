const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatChangeDate {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }
  async get(data) {
    let MessageCountPerRefNoWithoutSearch = await this.cm.MessageCountPerRefNoWithoutSearch(data);
    var filteredByDate = MessageCountPerRefNoWithoutSearch.filter((item)=>{
      return Date.parse(data.search_from) >= Date.parse(item.date_created)&&Date.parse(data.search_to) < Date.parse(item.date_created)
    })
    return MessageCountPerRefNoWithoutSearch;
  }
  
}
module.exports = ChatChangeDate