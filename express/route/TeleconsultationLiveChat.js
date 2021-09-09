const express = require('express');
const app = express();
// const router = express.Router();
// const feathers = require('@feathersjs/feathers');
// const express = require('@feathersjs/express');
const ChatMessage = require('../Service/ConsultationLiveChat/ChatMessage');
// const app = express(feathers());
app.use('chat-message',new ChatMessage)

module.exports = app;