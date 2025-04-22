const AddressService = require('../../services/AddressService');
module.exports = {
  
  async list(req,res) {
    res.render('addresses/list',{addresses:await AddressService.getAll()});
  },

  async showCreate(req,res) {
    res.render('addresses/create');
  },

  async create(req,res) {
    await AddressService.create(req.body);res.redirect('/addresses');
  },

  async showEdit(req,res) {
    res.render('addresses/edit',{address:await AddressService.getById(req.params.id)});
  },

  async update(req,res) {
    await AddressService.update(req.params.id,req.body);res.redirect('/addresses');
  },
  
  async delete(req,res) {
    await AddressService.delete(req.params.id);res.redirect('/addresses');
  }
};