const OwnerService = require('../../services/OwnerService');
module.exports = {
  async getAll(req,res) {
    try{res.json(await OwnerService.getAll());}catch(e){res.status(500).json({error:e.message});}
  },

  async getById(req,res) {
    try{res.json(await OwnerService.getById(req.params.id));}catch(e){res.status(500).json({error:e.message});}
  },

  async create(req,res) {
    try{res.status(201).json(await OwnerService.create(req.body));}catch(e){res.status(400).json({error:e.message});}
  },

  async update(req,res) {
    try{res.json(await OwnerService.update(req.params.id,req.body));}catch(e){res.status(400).json({error:e.message});}
  },

  async delete(req,res) {
    try{res.json(await OwnerService.delete(req.params.id));}catch(e){res.status(500).json({error:e.message});}
  }
};