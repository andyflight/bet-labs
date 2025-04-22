const OwnerService = require('../../services/OwnerService');
module.exports = {
  
  async list(req,res) {
    res.render('owners/list',{owners:await OwnerService.getAll()});
  },

  async showCreate(req,res) {
    res.render('owners/create');
  },

  async create(req,res) {
    await OwnerService.create(req.body);res.redirect('/owners');
  },

  async showEdit(req,res) {
    res.render('owners/edit',{owner:await OwnerService.getById(req.params.id)});
  },
  
  async update(req,res) {
    await OwnerService.update(req.params.id,req.body);res.redirect('/owners');
  },
  
  async delete(req,res) {
    await OwnerService.delete(req.params.id);res.redirect('/owners');
  }
};