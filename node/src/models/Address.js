const mongoose = require('mongoose');
const AddressSchema = new mongoose.Schema({
  flat_number: { type: String },
  building_number: { type: String, required: true },
  street: { type: String, required: true },
  city: { type: String, required: true },
  country: { type: String, required: true },
});
module.exports = mongoose.model('Address', AddressSchema);