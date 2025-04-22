const mongoose = require('mongoose');
const ListingSchema = new mongoose.Schema({
  type: { type: String, enum: ['здам','продам','зніму','куплю'], required: true },
  address: { type: mongoose.Schema.Types.ObjectId, ref: 'Address', required: true },
  rooms: { type: Number, required: true },
  date: { type: Date, default: Date.now },
  price: { type: Number, required: true },
  owner: { type: mongoose.Schema.Types.ObjectId, ref: 'Owner', required: true },
});
module.exports = mongoose.model('Listing', ListingSchema);