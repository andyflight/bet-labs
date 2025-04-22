const ListingService = require('../../services/ListingService');
const OwnerService = require('../../services/OwnerService');
const AddressService = require('../../services/AddressService');
module.exports = {
  async list(req,res) {
    const [listings, owners, addresses] = await Promise.all([
      ListingService.getAll(),
      OwnerService.getAll(),
      AddressService.getAll()
    ]);
    res.render('listings/list',{listings, owners, addresses});
  },
  
  async showCreate(req,res) {
    const [owners, addresses] = await Promise.all([OwnerService.getAll(),AddressService.getAll()]);
    res.render('listings/create',{owners,addresses});
  },
  
  async create(req,res) {
    await ListingService.create(req.body);
    res.redirect('/listings');
  },
  
  async showEdit(req,res) {
    const [listing, owners, addresses] = await Promise.all([
      ListingService.getById(req.params.id),
      OwnerService.getAll(),
      AddressService.getAll()
    ]);
    res.render('listings/edit',{listing,owners,addresses});
  },
  
  async update(req,res) {
    await ListingService.update(req.params.id,req.body);
    res.redirect('/listings');
  },
  
  async delete(req,res) {
    await ListingService.delete(req.params.id);
    res.redirect('/listings');
  }
};