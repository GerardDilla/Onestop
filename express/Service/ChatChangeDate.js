const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatChangeDate {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }
  async get(data) {
    let data4 = await this.cm.MessageCountPerRefNo(data);
    return data4;
  }
  
}
module.exports = ChatChangeDate