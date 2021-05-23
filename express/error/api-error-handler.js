const ApiError = require('./ApiError')

function apiErrorHandler(err,req,res,next){
    if(err instanceof ApiError){
        res.status(err.code).json(err.msg);
        return;
    }
    res.status(500).json({msg:'something went wrong'})
}
module.exports = apiErrorHandler;