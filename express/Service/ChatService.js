const {getQuery,getQuery2} = require('../query/main');
const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatService {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }

  async find() {
    let getdata = this.cm.getChat();
    return getdata;
  }
  async get(data) {
    // console.log(data)
    let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no='${data.ref_no}' ORDER BY id ASC`)
    return getdata.then((result)=>{
      return result;
    }).catch(error=>{ return {error:error}});
  }
  async update(id,data){
    // console.log(data);
    let getdata = getQuery(`UPDATE student_inquiry SET status = 'seen' WHERE ref_no = '${id}' AND user_type <> '${data.type}'`)
    getdata.then((result)=>{
      return result
    }).catch(error=>{ return {error:error}});
    return {
      ref_no:id,
      type:data.type
    }
  }
  async create(data) {
    // console.log()
    const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
    let insert = await this.cm.insertFromChatInquiry(data);
    insert;
    let data4 = await this.cm.MessageCountPerRefNo(data);
    return {
      ref_no:data.ref_no,
      date_created:this_time,
      message:data.message,
      user_type:data.type,
      return_id:data.return_id,
      message_count:data4
    }
  }
}
module.exports = ChatService