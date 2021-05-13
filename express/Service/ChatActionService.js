class ChatActionService{
    constructor (){
        this.ideas = []
    }
    async find(){
        
    }
    async create(data) {
        return {
            type:data.type,
            ref_no:data.ref_no
          }
    }
}
module.exports = ChatActionService