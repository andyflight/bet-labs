const Owner = require('../models/Owner');
class OwnerRepository {
  static getAll() { return Owner.find(); }
  static getById(id) { return Owner.findById(id); }
  static create(data) { return Owner.create(data); }
  static update(id,data){ return Owner.findByIdAndUpdate(id,data,{new:true}); }
  static delete(id){ return Owner.findByIdAndDelete(id); }
}
module.exports = OwnerRepository;