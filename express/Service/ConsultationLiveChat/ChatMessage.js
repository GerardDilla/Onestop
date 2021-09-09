const moment = require('moment');
const ConsultationModel = require('../../Model/ConsultationModel');

class ChatMessage{
    constructor (){
        this.ideas = []
        this.cm = new ConsultationModel();
    }
    async get(data){
        let getAllLiveChatMessage = await this.cm.getAllLiveChatMessage(data);
        return {
            messages:getAllLiveChatMessage
        };
    }
    async create(data) {
        const today = moment().format('YYYY-MM-DD kk:mm:ss');
        this.cm.insertData('live_chat',{
            message:data.message,
            session_id:data.chat_id,
            user_type:data.type,
            status:'not seen',
            date_created:today
        });
        return {
            message:data.message,
            chat_id:data.chat_id,
            type:data.type,
            date_created:today,
            bot_question_id:data.bot_question_id
        };
    }
}
module.exports = ChatMessage