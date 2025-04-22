const mongoose = require('mongoose');
const OwnerSchema = new mongoose.Schema({
  name: { type: String, required: true },
  email: { type: String, required: true },
});
module.exports = mongoose.model('Owner', OwnerSchema);