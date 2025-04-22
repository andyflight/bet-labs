const express = require('express');
const router = express.Router();

const ListingRestController = require('../controllers/api/ListingRestController');
const OwnerRestController = require('../controllers/api/OwnerRestController');
const AddressRestController = require('../controllers/api/AddressRestController');

// Listings API
router.get('/listings', ListingRestController.getAll);
router.post('/listings', ListingRestController.create);
router.get('/listings/:id', ListingRestController.getById);
router.put('/listings/:id', ListingRestController.update);
router.delete('/listings/:id', ListingRestController.delete);

// Owners API
router.get('/owners', OwnerRestController.getAll);
router.post('/owners', OwnerRestController.create);
router.get('/owners/:id', OwnerRestController.getById);
router.put('/owners/:id', OwnerRestController.update);
router.delete('/owners/:id', OwnerRestController.delete);

// Addresses API
router.get('/addresses', AddressRestController.getAll);
router.post('/addresses', AddressRestController.create);
router.get('/addresses/:id', AddressRestController.getById);
router.put('/addresses/:id', AddressRestController.update);
router.delete('/addresses/:id', AddressRestController.delete);

module.exports = router;