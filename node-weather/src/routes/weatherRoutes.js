const express = require('express');
const router = express.Router();
const weatherController = require('../controllers/weatherController');

router.get('/', weatherController.getHomePage);
router.get('/weather/:city', weatherController.getWeatherByCity);
router.get('/weather', weatherController.getWeatherByLocation);

module.exports = router;