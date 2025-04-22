const ListRepo = require('../repositories/ListingRepository');
const { isNonEmptyString, isPositiveNumber } = require('../utils/validation');
class ListingService {
  static getAll() { return ListRepo.getAll(); }
  static getById(id) { return ListRepo.getById(id); }
  static create(data) {
    if(!['здам','продам','зніму','куплю'].includes(data.type)) throw Error('Invalid type');
    if(!isPositiveNumber(+data.rooms)||!isPositiveNumber(+data.price)) throw Error('Invalid numbers');
    return ListRepo.create(data);
  }
  static update(id,data){ return ListRepo.update(id,data); }
  static delete(id){ return ListRepo.delete(id); }
}
module.exports = ListingService;