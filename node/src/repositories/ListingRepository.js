const Listing = require('../models/Listing');
class ListingRepository {
  static getAll() { return Listing.find().populate('address owner'); }
  static getById(id) { return Listing.findById(id).populate('address owner'); }
  static create(data) { return Listing.create(data); }
  static update(id,data){ return Listing.findByIdAndUpdate(id,data,{new:true}); }
  static delete(id){ return Listing.findByIdAndDelete(id); }
}
module.exports = ListingRepository;