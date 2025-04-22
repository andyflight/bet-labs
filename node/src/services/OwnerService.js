const OwnerRepo = require('../repositories/OwnerRepository');
const { isEmail, isNonEmptyString } = require('../utils/validation');
class OwnerService {
  static getAll() { return OwnerRepo.getAll(); }
  static getById(id) { return OwnerRepo.getById(id); }
  static create(data) {
    if(!isNonEmptyString(data.name)||!isEmail(data.email)) throw Error('Invalid data');
    return OwnerRepo.create(data);
  }
  static update(id,data){ return OwnerRepo.update(id,data); }
  static delete(id){ return OwnerRepo.delete(id); }
}
module.exports = OwnerService;