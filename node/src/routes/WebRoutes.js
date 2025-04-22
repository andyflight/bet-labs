const express = require('express');
const router = express.Router();

const ListingController = require('../controllers/web/ListingController');
const OwnerController = require('../controllers/web/OwnerController');
const AddressController = require('../controllers/web/AddressController');

// Головна сторінка
router.get('/', (req, res) => res.render('index'));

// Listings web
router.get('/listings', ListingController.list);
router.get('/listings/create', ListingController.showCreate);
router.post('/listings/create', ListingController.create);
router.get('/listings/edit/:id', ListingController.showEdit);
router.post('/listings/edit/:id', ListingController.update);
router.post('/listings/delete/:id', ListingController.delete);

// Owners web
router.get('/owners', OwnerController.list);
router.get('/owners/create', OwnerController.showCreate);
router.post('/owners/create', OwnerController.create);
router.get('/owners/edit/:id', OwnerController.showEdit);
router.post('/owners/edit/:id', OwnerController.update);
router.post('/owners/delete/:id', OwnerController.delete);

// Addresses web
router.get('/addresses', AddressController.list);
router.get('/addresses/create', AddressController.showCreate);
router.post('/addresses/create', AddressController.create);
router.get('/addresses/edit/:id', AddressController.showEdit);
router.post('/addresses/edit/:id', AddressController.update);
router.post('/addresses/delete/:id', AddressController.delete);

module.exports = router;