const { getQuery, getQuery2 } = require('../Query/main');
const moment = require('moment');
const ChatModel = require('../Model/ChatModel')
class ChatService {
  constructor() {
    this.ideas = [];
    this.messages = [];
    this.cm = new ChatModel();
  }

  async find(data) {
    data_sample['search_date'] = data; 
    let data4 = await this.cm.MessageCountPerRefNo(data_sample);
    // let getdata = this.cm.getChat();
    return data4;
  }
  async get(data) {
    // console.log(data)
    let getdata = getQuery(`SELECT * FROM student_inquiry WHERE ref_no='${data.ref_no}' ORDER BY id ASC`)
    let data4 = await this.cm.MessageCountPerRefNo(data);
    return getdata.then((result) => {
      return result;
    }).catch(error => { return { error: error } });
  }
  async update(id, data) {
    // console.log(data);
    let getdata = getQuery(`UPDATE student_inquiry SET status = 'seen' WHERE ref_no = '${id}' AND user_type <> '${data.type}'`)
    getdata.then((result) => {
      return result
    }).catch(error => { return { error: error } });
    return {
      ref_no: id,
      type: data.type
    }
  }
  async create(data) {
    // console.log()
    // const this_time = moment().format('YYYY-MM-DD kk:mm:ss')
    // console.log(this_time)
    try{
    this.cm.insertFromChatInquiry(data);
    }
    catch(err){
      console.log(err)
    }
    
    console.log(data)
    let data4 = await this.cm.MessageCountPerRefNoWithoutSearch(data);
    let TotalMessageCountPerRefNo = await this.cm.TotalMessageCountPerRefNo(data);
    return {
      ref_no:data.ref_no,
      date_created:moment().format('YYYY-MM-DD kk:mm:ss'),
      message:data.message,
      user_type:data.type,
      return_id:data.return_id,
      message_count:data4,
      total_message:TotalMessageCountPerRefNo
    }
  }
}
module.exports = ChatService