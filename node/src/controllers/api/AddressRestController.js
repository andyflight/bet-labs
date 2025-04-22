const AddressService = require('../../services/AddressService');
module.exports = {
  async getAll(req,res) {
    try{res.json(await AddressService.getAll());}catch(e){res.status(500).json({error:e.message});}
  },
  
  async getById(req,res) {
    try{res.json(await AddressService.getById(req.params.id));}catch(e){res.status(500).json({error:e.message});}
  },
  
  async create(req,res) {
    try{res.status(201).json(await AddressService.create(req.body));}catch(e){res.status(400).json({error:e.message});}
  },
  
  async update(req,res) {
    try{res.json(await AddressService.update(req.params.id,req.body));}catch(e){res.status(400).json({error:e.message});}
  },
  
  async delete(req,res) {
    try{res.json(await AddressService.delete(req.params.id));}catch(e){res.status(500).json({error:e.message});}
  }
};