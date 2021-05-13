class ChatActionService{
    constructor (){
        this.ideas = []
    }
    async find(){
        
    }
    async create(data) {
        console.log('hello')
        return {
            type:data.type,
            ref_no:data.ref_no
          }

    }
}
module.exports = ChatActionService