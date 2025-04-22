const AddrRepo = require('../repositories/AddressRepository');
const { isNonEmptyString } = require('../utils/validation');
class AddressService {
  static getAll() { return AddrRepo.getAll(); }
  static getById(id) { return AddrRepo.getById(id); }
  static create(data) {
    ['building_number','street','city','country'].forEach(f=>{if(!isNonEmptyString(data[f])) throw Error(`Invalid ${f}`);});
    return AddrRepo.create(data);
  }
  static update(id,data){ return AddrRepo.update(id,data); }
  static delete(id){ return AddrRepo.delete(id); }
}
module.exports = AddressService;