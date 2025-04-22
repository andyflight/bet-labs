const Address = require('../models/Address');
class AddressRepository {
  static getAll() { return Address.find(); }
  static getById(id) { return Address.findById(id); }
  static create(data) { return Address.create(data); }
  static update(id,data){ return Address.findByIdAndUpdate(id,data,{new:true}); }
  static delete(id){ return Address.findByIdAndDelete(id); }
}
module.exports = AddressRepository;