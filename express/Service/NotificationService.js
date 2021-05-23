class NotificationService{
    constructor (){
        this.ideas = []
    }
    async find(){
        
    }
    async create(data) {
        console.log(data)
        return {
            type:data.amount,
            ref_no:data.ref_no
          }
    }
}
module.exports = NotificationService