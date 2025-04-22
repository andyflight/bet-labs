const mongoose = require('mongoose');
const MONGO_URI = process.env.MONGO_URI || 'mongodb://mongo:27017/realestate';

mongoose.connect(MONGO_URI, {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Connection error:'));
db.once('open', () => console.log('Connected to MongoDB'));